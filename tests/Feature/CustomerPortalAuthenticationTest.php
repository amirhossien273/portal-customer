<?php

namespace Tests\Feature;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CustomerPortalAuthenticationTest extends TestCase
{
    private string $tenantId = '00000000-0000-0000-0000-000000000001';

    protected function setUp(): void
    {
        parent::setUp();

        config([
            'customer_portal.connection' => 'crm',
            'customer_portal.tenant_id' => $this->tenantId,
            'customer_portal.otp.preview' => true,
            'database.connections.crm' => [
                'driver' => 'sqlite',
                'database' => ':memory:',
                'prefix' => '',
                'foreign_key_constraints' => false,
            ],
        ]);
        DB::purge('crm');

        $this->createCrmSchema();
    }

    public function test_registered_customer_can_sign_in_with_the_preview_otp(): void
    {
        $this->seedCustomer('customer-a', 'personal-a', '09121234567');

        $request = $this->post(route('login.otp'), ['mobile' => '۰۹۱۲۱۲۳۴۵۶۷']);

        $request->assertRedirect(route('login.verify'));
        $otp = $request->getSession()->get('preview_otp');
        $this->assertMatchesRegularExpression('/^\d{6}$/', $otp);

        $this->get(route('login.verify'))
            ->assertOk()
            ->assertSee($otp)
            ->assertSee('علی رضایی');

        $this->post(route('login.verify.submit'), ['digits' => str_split($otp)])
            ->assertRedirect(route('portal.dashboard'))
            ->assertSessionHas('customer_portal.customer_id', 'customer-a');
    }

    public function test_unregistered_mobile_cannot_request_an_otp(): void
    {
        $this->post(route('login.otp'), ['mobile' => '09129999999'])
            ->assertRedirect()
            ->assertSessionHasErrors('mobile')
            ->assertSessionMissing('customer_portal_otp');
    }

    public function test_customer_cannot_open_another_customers_inquiry(): void
    {
        $this->seedCustomer('customer-a', 'personal-a', '09121234567');
        $this->seedCustomer('customer-b', 'personal-b', '09123334444');
        $this->seedInquiry('inquiry-b', 'customer-b');

        $this->withSession([
            'customer_portal' => [
                'customer_id' => 'customer-a',
                'personal_id' => 'personal-a',
                'tenant_id' => $this->tenantId,
                'mobile' => '09121234567',
                'authenticated_at' => now()->timestamp,
            ],
        ])->get(route('portal.inquiries.show', 'inquiry-b'))->assertNotFound();
    }

    public function test_authenticated_customer_sees_only_customer_visible_tracking_events(): void
    {
        $this->seedCustomer('customer-a', 'personal-a', '09121234567');
        $this->seedInquiry('inquiry-a', 'customer-a');

        DB::connection('crm')->table('bookings')->insert([
            'id' => 'booking-a', 'tenant_id' => $this->tenantId, 'transaction_id' => 'inquiry-a',
            'customer_id' => 'customer-a', 'code' => 'BOOK-001', 'status' => 'operational',
            'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::connection('crm')->table('operation_jobs')->insert([
            'id' => 'job-a', 'tenant_id' => $this->tenantId, 'code' => 'JOB-001',
            'transaction_id' => 'inquiry-a', 'booking_id' => 'booking-a', 'status' => 'running',
            'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::connection('crm')->table('operation_shipments')->insert([
            'id' => 'shipment-a', 'tenant_id' => $this->tenantId, 'operation_job_id' => 'job-a',
            'transaction_id' => 'inquiry-a', 'booking_id' => 'booking-a', 'service_name' => 'حمل دریایی',
            'origin_city' => 'شانگهای', 'destination_city' => 'بندرعباس', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::connection('crm')->table('booking_trackings')->insert([
            [
                'id' => 'tracking-public', 'tenant_id' => $this->tenantId, 'shipment_id' => 'shipment-a',
                'event_title' => 'حرکت از مبدأ', 'status' => 'completed', 'source' => 'manual',
                'is_customer_visible' => true, 'event_time' => now(), 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'id' => 'tracking-private', 'tenant_id' => $this->tenantId, 'shipment_id' => 'shipment-a',
                'event_title' => 'یادداشت محرمانه عملیات', 'status' => 'completed', 'source' => 'manual',
                'is_customer_visible' => false, 'event_time' => now(), 'created_at' => now(), 'updated_at' => now(),
            ],
        ]);

        $this->withSession([
            'customer_portal' => [
                'customer_id' => 'customer-a', 'personal_id' => 'personal-a', 'tenant_id' => $this->tenantId,
                'mobile' => '09121234567', 'authenticated_at' => now()->timestamp,
            ],
        ])->get(route('portal.shipments.show', 'shipment-a'))
            ->assertOk()
            ->assertSee('حرکت از مبدأ')
            ->assertDontSee('یادداشت محرمانه عملیات');
    }

    private function seedCustomer(string $customerId, string $personalId, string $mobile): void
    {
        DB::connection('crm')->table('customers')->insert([
            'id' => $customerId, 'tenant_id' => $this->tenantId, 'company' => 'شرکت نمونه',
            'status' => 'actual', 'type' => 'company', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::connection('crm')->table('customer_personal')->insert([
            'id' => $personalId, 'tenant_id' => $this->tenantId, 'customer_id' => $customerId,
            'first_name' => 'علی', 'last_name' => 'رضایی', 'mobile' => $mobile,
            'created_at' => now(), 'updated_at' => now(),
        ]);
    }

    private function seedInquiry(string $id, string $customerId): void
    {
        DB::connection('crm')->table('transactions')->insert([
            'id' => $id, 'tenant_id' => $this->tenantId, 'customer_id' => $customerId,
            'code' => 'INQ-001', 'name' => 'استعلام حمل نمونه', 'status' => 'running',
            'payment_method' => 'cash', 'created_at' => now(), 'updated_at' => now(),
        ]);
    }

    private function createCrmSchema(): void
    {
        $schema = Schema::connection('crm');

        $schema->create('customers', function (Blueprint $table): void {
            $table->string('id')->primary(); $table->string('tenant_id'); $table->string('company')->nullable();
            $table->string('company_phone')->nullable(); $table->text('address')->nullable(); $table->string('status')->default('actual');
            $table->string('type')->default('person'); $table->timestamps(); $table->softDeletes();
        });
        $schema->create('customer_personal', function (Blueprint $table): void {
            $table->string('id')->primary(); $table->string('tenant_id'); $table->string('customer_id');
            $table->string('first_name')->nullable(); $table->string('last_name')->nullable(); $table->string('position')->nullable();
            $table->string('mobile')->nullable(); $table->timestamps();
        });
        $schema->create('transactions', function (Blueprint $table): void {
            $table->string('id')->primary(); $table->string('tenant_id'); $table->string('customer_id')->nullable();
            $table->string('code')->nullable(); $table->string('name'); $table->string('status')->default('running');
            $table->string('payment_method')->default('cash'); $table->string('shipping_mode')->nullable(); $table->string('service_type')->nullable();
            $table->string('cargo_type')->nullable(); $table->decimal('weight')->nullable(); $table->decimal('total_volume')->nullable();
            $table->string('volume_cbm')->nullable(); $table->integer('quantity')->nullable(); $table->string('shipping_term')->nullable();
            $table->string('hs_code')->nullable(); $table->boolean('need_clearance')->default(false); $table->boolean('need_warehousing')->default(false);
            $table->decimal('approximate_amount')->nullable(); $table->text('description')->nullable(); $table->json('routes')->nullable();
            $table->timestamps(); $table->softDeletes();
        });
        $schema->create('bookings', function (Blueprint $table): void {
            $table->string('id')->primary(); $table->string('tenant_id'); $table->string('transaction_id'); $table->string('customer_id')->nullable();
            $table->string('code')->nullable(); $table->string('status')->default('draft'); $table->timestamp('booking_date')->nullable();
            $table->json('transaction_data')->nullable(); $table->json('offer_data')->nullable(); $table->json('totals')->nullable();
            $table->timestamps(); $table->softDeletes();
        });
        $schema->create('operation_jobs', function (Blueprint $table): void {
            $table->string('id')->primary(); $table->string('tenant_id'); $table->string('code'); $table->string('transaction_id');
            $table->string('booking_id'); $table->string('status')->default('pending'); $table->timestamps();
        });
        $schema->create('operation_shipments', function (Blueprint $table): void {
            $table->string('id')->primary(); $table->string('tenant_id'); $table->string('operation_job_id'); $table->string('transaction_id');
            $table->string('booking_id'); $table->string('service_name'); $table->string('origin_country')->nullable();
            $table->string('origin_city')->nullable(); $table->string('origin_port')->nullable(); $table->string('destination_country')->nullable();
            $table->string('destination_city')->nullable(); $table->string('destination_port')->nullable(); $table->date('departure_date')->nullable();
            $table->json('route_data')->nullable(); $table->timestamps();
        });
        $schema->create('booking_trackings', function (Blueprint $table): void {
            $table->string('id')->primary(); $table->string('tenant_id'); $table->string('shipment_id'); $table->string('event_code')->nullable();
            $table->string('event_title'); $table->text('event_description')->nullable(); $table->string('location')->nullable();
            $table->string('country')->nullable(); $table->dateTime('event_time')->nullable(); $table->dateTime('expected_time')->nullable();
            $table->dateTime('actual_time')->nullable(); $table->integer('delay_days')->default(0); $table->string('source')->default('manual');
            $table->string('status')->default('completed'); $table->boolean('is_customer_visible')->default(true); $table->timestamps(); $table->softDeletes();
        });
        $schema->create('invoices', function (Blueprint $table): void {
            $table->string('id')->primary(); $table->string('tenant_id'); $table->string('customer_id'); $table->string('invoice_number')->nullable();
            $table->string('proforma_invoice_number')->nullable(); $table->string('status')->default('draft'); $table->decimal('payable_amount')->default(0);
            $table->decimal('total_items_amount')->default(0); $table->string('payment_type')->nullable(); $table->timestamp('proforma_at')->nullable(); $table->timestamps();
        });
        $schema->create('payments', function (Blueprint $table): void {
            $table->string('id')->primary(); $table->string('tenant_id'); $table->string('customer_id'); $table->string('code')->nullable();
            $table->string('number')->nullable(); $table->string('pay_to')->nullable(); $table->string('purpose')->nullable(); $table->decimal('amount')->default(0);
            $table->boolean('is_paid')->default(false); $table->timestamp('paid_at')->nullable(); $table->timestamps();
        });
        $schema->create('receipts', function (Blueprint $table): void {
            $table->string('id')->primary(); $table->string('tenant_id'); $table->string('customer_id'); $table->string('code')->nullable();
            $table->string('invoice_number')->nullable(); $table->string('purpose')->nullable(); $table->decimal('amount')->default(0);
            $table->string('status')->default('pending'); $table->timestamps();
        });
    }
}
