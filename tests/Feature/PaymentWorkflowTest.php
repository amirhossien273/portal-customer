<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\Accounting\App\Http\Controllers\PaymentController;
use Modules\Accounting\App\Models\Payment;
use Modules\Auth\App\Http\Middleware\CheckPermission;
use Modules\Auth\App\Models\Group;
use Modules\Auth\App\Models\Permission;
use Modules\Auth\App\Models\User;
use Modules\Customer\App\Models\Customer;
use Tests\TestCase;

class PaymentWorkflowTest extends TestCase
{
    use DatabaseTransactions;

    public function test_payment_request_is_normalized_stored_and_attached_to_its_job_customer(): void
    {
        Storage::fake('public');
        [$user, $customer, $jobId, $supplierId] = $this->makeOperationJob();

        $response = $this->withoutMiddleware(CheckPermission::class)
            ->actingAs($user)
            ->post(route('payments.store'), [
                'job_id' => $jobId,
                'customer_id' => $customer->id,
                'supplier_id' => $supplierId,
                'amount' => '۱۲۳,۴۵۶,۷۸۹',
                'type_number' => 'iban',
                'number' => '۱۲۳۴۵۶۷۸۹۰۱۲۳۴۵۶۷۸۹۰۱۲۳۴',
                'purpose' => 'هزینه حمل',
                'description' => 'پرداخت مرحله نخست',
                'file' => UploadedFile::fake()->create('payment.pdf', 100, 'application/pdf'),
            ]);

        $payment = Payment::with('medias')->latest('id')->firstOrFail();

        $response->assertRedirect(route('payments.index'));
        $this->assertSame($jobId, $payment->job_id);
        $this->assertSame($customer->id, $payment->customer_id);
        $this->assertSame($supplierId, $payment->supplier_id);
        $this->assertSame('تأمین‌کننده آزمایشی', $payment->pay_to);
        $this->assertSame('123456789', $payment->amount);
        $this->assertSame('IR123456789012345678901234', $payment->number);
        $this->assertSame($user->id, $payment->created_by);
        $this->assertMatchesRegularExpression('/^payment-\d{8}A\d{5,}$/', $payment->code);
        $this->assertFalse($payment->is_paid);
        $this->assertCount(1, $payment->medias);
        Storage::disk('public')->assertExists($payment->medias->first()->path);

        $this->actingAs($user)
            ->getJson('/media/relation?'.http_build_query([
                'parent_type' => \Modules\Operation\App\Models\OperationJob::class,
                'parent_id' => $jobId,
                'relation' => 'payments',
            ]))
            ->assertOk()
            ->assertJsonPath('data.0.id', $payment->medias->first()->id)
            ->assertJsonPath('data.0.title', 'سند پرداخت '.$payment->code.' - تأمین‌کننده آزمایشی');
    }

    public function test_customer_must_belong_to_the_selected_job(): void
    {
        [$user, $customer, $jobId, $supplierId] = $this->makeOperationJob();
        $otherCustomer = Customer::create([
            'firstname' => 'مشتری',
            'lastname' => 'دیگر',
            'mobile' => '09120000002',
            'status' => 'actual',
            'type' => 'person',
        ]);

        $response = $this->withoutMiddleware(CheckPermission::class)
            ->actingAs($user)
            ->from(route('payments.create'))
            ->post(route('payments.store'), [
                'job_id' => $jobId,
                'customer_id' => $otherCustomer->id,
                'supplier_id' => $supplierId,
                'amount' => '1000',
                'type_number' => 'card_number',
                'number' => '6037991234567890',
                'purpose' => 'تست',
            ]);

        $response->assertRedirect(route('payments.create'));
        $response->assertSessionHasErrorsIn('payment', ['customer_id']);
        $this->assertDatabaseMissing('payments', [
            'job_id' => $jobId,
            'customer_id' => $otherCustomer->id,
        ]);
        $this->assertNotSame($customer->id, $otherCustomer->id);
    }

    public function test_pending_payment_can_be_confirmed_as_paid(): void
    {
        Storage::fake('public');
        [$user, $customer, $jobId, $supplierId] = $this->makeOperationJob();
        $payment = Payment::create([
            'job_id' => $jobId,
            'customer_id' => $customer->id,
            'supplier_id' => $supplierId,
            'created_by' => $user->id,
            'pay_to' => 'دریافت‌کننده',
            'amount' => 500000,
            'type_number' => 'account_number',
            'number' => '123456789',
            'purpose' => 'هزینه خدمات',
        ]);

        $this->withoutMiddleware(CheckPermission::class)
            ->actingAs($user)
            ->from(route('payments.index'))
            ->patch(route('payments.mark-paid', $payment))
            ->assertSessionHasErrors(['receipt']);

        $this->assertFalse($payment->fresh()->is_paid);

        $response = $this->withoutMiddleware(CheckPermission::class)
            ->actingAs($user)
            ->from(route('payments.index'))
            ->patch(route('payments.mark-paid', $payment), [
                'receipt' => UploadedFile::fake()->image('receipt.jpg'),
            ]);

        $response->assertRedirect(route('payments.index'));
        $payment->refresh();
        $this->assertTrue($payment->is_paid);
        $this->assertSame($user->id, $payment->paid_by);
        $this->assertNotNull($payment->paid_at);
        $receipt = $payment->medias()->firstOrFail();
        $this->assertSame('فیش پرداخت '.$payment->code.' - دریافت‌کننده', $receipt->title);
        Storage::disk('public')->assertExists($receipt->path);
    }

    public function test_payment_request_and_list_pages_render_with_project_data(): void
    {
        [$user, $customer, $jobId, $supplierId] = $this->makeOperationJob();
        $payment = Payment::create([
            'job_id' => $jobId,
            'customer_id' => $customer->id,
            'supplier_id' => $supplierId,
            'created_by' => $user->id,
            'pay_to' => 'شرکت نمونه',
            'amount' => 250000,
            'type_number' => 'card_number',
            'number' => '6037991234567890',
            'purpose' => 'هزینه عملیات',
        ]);

        $this->withoutMiddleware(CheckPermission::class)
            ->actingAs($user)
            ->get(route('payments.create', ['job_id' => $jobId]))
            ->assertOk()
            ->assertSee('ثبت درخواست پرداخت جدید');

        $this->get(route('payments.index'))
            ->assertOk()
            ->assertSee($payment->code)
            ->assertSee('شرکت نمونه')
            ->assertSee('ثبت فیش و تأیید')
            ->assertSee('مشاهده کامل درخواست')
            ->assertSee('payment-view-btn', false)
            ->assertDontSee('<input type="checkbox"', false);
    }

    public function test_authorized_operation_page_contains_the_financial_panel(): void
    {
        [$user, $customer, $jobId, $supplierId] = $this->makeOperationJob();
        $group = Group::create(['name' => 'گروه مالی '.uniqid(), 'is_active' => true]);
        $user->groups()->attach($group->id);

        $permissionIds = Permission::query()
            ->where('controller', PaymentController::class)
            ->pluck('id');

        foreach ($permissionIds as $permissionId) {
            DB::table('group_has_permissions')->insert([
                'group_id' => $group->id,
                'permission_id' => $permissionId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        Payment::create([
            'job_id' => $jobId,
            'customer_id' => $customer->id,
            'supplier_id' => $supplierId,
            'created_by' => $user->id,
            'pay_to' => 'دریافت‌کننده عملیات',
            'amount' => 750000,
            'type_number' => 'account_number',
            'number' => '123456789',
            'purpose' => 'هزینه Job',
        ]);

        $this->withoutMiddleware(CheckPermission::class)
            ->actingAs($user->fresh())
            ->get(route('operation.show', $jobId).'#financial')
            ->assertOk()
            ->assertSee('مدیریت مالی Job')
            ->assertSee('دریافت‌کننده عملیات')
            ->assertSee('ثبت فیش و تأیید')
            ->assertSee('operation-payment-confirm-btn', false)
            ->assertDontSee('operation-payment-check', false);
    }

    private function makeOperationJob(): array
    {
        $suffix = str_replace('.', '', uniqid('', true));
        $user = User::create([
            'first_name' => 'کاربر',
            'last_name' => 'مالی',
            'mobile' => '09'.substr($suffix, -9),
            'password' => bcrypt('password'),
        ]);
        $customer = Customer::create([
            'firstname' => 'مشتری',
            'lastname' => 'آزمایشی',
            'mobile' => '09'.substr(strrev($suffix), 0, 9),
            'status' => 'actual',
            'type' => 'person',
        ]);
        $now = now();
        $transactionId = (string) Str::uuid();
        DB::table('transactions')->insert([
            'id' => $transactionId,
            'code' => 'TR-'.$suffix,
            'name' => 'تراکنش آزمایشی',
            'customer_id' => $customer->id,
            'customer_type' => Customer::class,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        $bookingId = (string) Str::uuid();
        DB::table('bookings')->insert([
            'id' => $bookingId,
            'code' => 'BK-'.$suffix,
            'transaction_id' => $transactionId,
            'customer_id' => $customer->id,
            'status' => 'pending',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        $jobId = (string) Str::uuid();
        DB::table('operation_jobs')->insert([
            'id' => $jobId,
            'code' => 'JOB-'.$suffix,
            'transaction_id' => $transactionId,
            'booking_id' => $bookingId,
            'service_name' => 'حمل آزمایشی',
            'status' => 'pending',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $supplierId = (string) Str::uuid();
        DB::table('suppliers')->insert([
            'id' => $supplierId,
            'name_fa' => 'تأمین‌کننده آزمایشی',
            'ownership' => 'حقوقی',
            'is_active' => true,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        return [$user, $customer, $jobId, $supplierId];
    }
}
