<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\Auth\App\Http\Middleware\CheckPermission;
use Modules\Auth\App\Models\User;
use Modules\Customer\App\Models\Customer;
use Tests\TestCase;

class BookingReconciliationTest extends TestCase
{
    use DatabaseTransactions;

    public function test_successful_booking_is_converted_and_marked_balanced_when_both_sides_match_offer(): void
    {
        [$user, $bookingCode] = $this->makeReconciliationData(8_600_000, 8_600_000);

        $response = $this->withoutMiddleware(CheckPermission::class)
            ->actingAs($user)
            ->get(route('reconciliation.index', ['rates' => ['USD' => 850_000]]));

        $response->assertOk()
            ->assertSee('تطبیق مالی بوکینگ‌های موفق')
            ->assertSee($bookingCode)
            ->assertSee('8,600,000')
            ->assertSee('تسویه کامل')
            ->assertSee('1 USD = 850,000 IRR');
    }

    public function test_booking_with_payment_gap_is_not_marked_as_fully_balanced(): void
    {
        [$user, $bookingCode] = $this->makeReconciliationData(7_000_000, 8_600_000);

        $response = $this->withoutMiddleware(CheckPermission::class)
            ->actingAs($user)
            ->get(route('reconciliation.index', [
                'rates' => ['USD' => 850_000],
                'status' => 'payment_gap',
            ]));

        $response->assertOk()
            ->assertSee($bookingCode)
            ->assertSee('1,600,000 ریال کسری پرداخت')
            ->assertSee('نیازمند پیگیری');
    }

    public function test_exchange_rate_modal_requests_only_foreign_currencies_in_successful_offers(): void
    {
        [$user] = $this->makeReconciliationData(0, 0);

        $this->withoutMiddleware(CheckPermission::class)
            ->actingAs($user)
            ->get(route('reconciliation.index'))
            ->assertOk()
            ->assertSee('نرخ تبدیل ارزهای Offer')
            ->assertSee('name="rates[USD]"', false)
            ->assertDontSee('name="rates[IRR]"', false);
    }

    private function makeReconciliationData(float $paidAmount, float $receivedAmount): array
    {
        $suffix = str_replace('.', '', uniqid('', true));
        $now = now();
        $user = User::create([
            'first_name' => 'کاربر',
            'last_name' => 'تطبیق',
            'mobile' => '09'.substr($suffix, -9),
            'password' => bcrypt('password'),
        ]);
        $customer = Customer::create([
            'firstname' => 'مشتری',
            'lastname' => 'موفق',
            'mobile' => '09'.substr(strrev($suffix), 0, 9),
            'status' => 'actual',
            'type' => 'person',
        ]);
        $transactionId = (string) Str::uuid();
        DB::table('transactions')->insert([
            'id' => $transactionId,
            'code' => 'TR-'.$suffix,
            'name' => 'تراکنش موفق',
            'status' => 'success',
            'customer_id' => $customer->id,
            'customer_type' => Customer::class,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        $bookingCode = 'BOOK-'.$suffix;
        $bookingId = (string) Str::uuid();
        DB::table('bookings')->insert([
            'id' => $bookingId,
            'code' => $bookingCode,
            'transaction_id' => $transactionId,
            'customer_id' => $customer->id,
            'status' => 'operational',
            'totals' => json_encode(['USD' => 10, 'IRR' => 100_000]),
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

        if ($paidAmount > 0) {
            DB::table('payments')->insert([
                'id' => (string) Str::uuid(),
                'job_id' => $jobId,
                'customer_id' => $customer->id,
                'created_by' => $user->id,
                'pay_to' => 'تأمین‌کننده تست',
                'amount' => $paidAmount,
                'type_number' => 'account_number',
                'number' => '123456',
                'purpose' => 'هزینه حمل',
                'is_paid' => true,
                'paid_at' => $now,
                'paid_by' => $user->id,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
        if ($receivedAmount > 0) {
            DB::table('receipts')->insert([
                'id' => (string) Str::uuid(),
                'job_id' => $jobId,
                'customer_id' => $customer->id,
                'created_by' => $user->id,
                'company_account_type' => 'account_number',
                'company_account_number' => '123456789',
                'amount' => $receivedAmount,
                'payment_scope' => 'full',
                'purpose' => 'تسویه فاکتور',
                'status' => 'approved',
                'reviewed_at' => $now,
                'reviewed_by' => $user->id,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        return [$user, $bookingCode];
    }
}
