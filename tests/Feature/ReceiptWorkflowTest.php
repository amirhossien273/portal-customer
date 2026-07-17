<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\Accounting\App\Http\Controllers\ReceiptController;
use Modules\Accounting\App\Models\Receipt;
use Modules\Auth\App\Http\Middleware\CheckPermission;
use Modules\Auth\App\Models\Group;
use Modules\Auth\App\Models\Permission;
use Modules\Auth\App\Models\User;
use Modules\Customer\App\Models\Customer;
use Modules\Operation\App\Models\OperationJob;
use Modules\Task\App\Models\Task;
use Modules\Task\App\Models\TaskTitle;
use Tests\TestCase;

class ReceiptWorkflowTest extends TestCase
{
    use DatabaseTransactions;

    protected function tearDown(): void
    {
        Cache::forget('settings.all');
        parent::tearDown();
    }

    public function test_customer_receipt_is_stored_with_company_account_snapshot_and_attached_to_job(): void
    {
        Storage::fake('public');
        set_setting('setting_company', [
            'company_name' => 'سپند',
            'card_info' => '6037991234567890',
            'account_number' => '123456789',
            'sheba_number' => 'IR123456789012345678901234',
        ]);
        [$user, $customer, $jobId] = $this->makeOperationJob();

        $response = $this->withoutMiddleware(CheckPermission::class)
            ->actingAs($user)
            ->post(route('receipts.store'), [
                'job_id' => $jobId,
                'customer_id' => $customer->id,
                'company_account_type' => 'account_number',
                'amount' => '۱۲۳,۴۵۶,۷۸۹',
                'payment_scope' => 'partial',
                'purpose' => 'بخشی از هزینه حمل',
                'invoice_number' => 'INV-1405-11',
                'description' => 'واریز مرحله نخست',
                'file' => UploadedFile::fake()->image('customer-receipt.jpg'),
                'from_operation' => 1,
            ]);

        $receipt = Receipt::with('medias')->latest('id')->firstOrFail();

        $response->assertRedirect(route('operation.show', $jobId).'#financial');
        $this->assertSame($jobId, $receipt->job_id);
        $this->assertSame($customer->id, $receipt->customer_id);
        $this->assertSame('account_number', $receipt->company_account_type);
        $this->assertSame('123456789', $receipt->company_account_number);
        $this->assertSame('123456789', $receipt->amount);
        $this->assertSame('partial', $receipt->payment_scope);
        $this->assertSame(Receipt::STATUS_PENDING, $receipt->status);
        $this->assertSame($user->id, $receipt->created_by);
        $this->assertMatchesRegularExpression('/^receipt-\d{8}A\d{5,}$/', $receipt->code);
        $this->assertCount(1, $receipt->medias);
        Storage::disk('public')->assertExists($receipt->medias->first()->path);

        $this->actingAs($user)
            ->getJson('/media/relation?'.http_build_query([
                'parent_type' => \Modules\Operation\App\Models\OperationJob::class,
                'parent_id' => $jobId,
                'relation' => 'payments,receipts',
            ]))
            ->assertOk()
            ->assertJsonPath('data.0.id', $receipt->medias->first()->id);
    }

    public function test_receipt_customer_must_belong_to_selected_job(): void
    {
        set_setting('setting_company', ['account_number' => '123456789']);
        [$user, $customer, $jobId] = $this->makeOperationJob();
        $otherCustomer = Customer::create([
            'firstname' => 'مشتری',
            'lastname' => 'دیگر',
            'mobile' => '09120000002',
            'status' => 'actual',
            'type' => 'person',
        ]);

        $response = $this->withoutMiddleware(CheckPermission::class)
            ->actingAs($user)
            ->post(route('receipts.store'), [
                'job_id' => $jobId,
                'customer_id' => $otherCustomer->id,
                'company_account_type' => 'account_number',
                'amount' => '1000',
                'payment_scope' => 'full',
                'purpose' => 'تسویه',
                'file' => UploadedFile::fake()->image('receipt.jpg'),
                'from_operation' => 1,
            ]);

        $response->assertSessionHasErrorsIn('receipt', ['customer_id']);
        $this->assertDatabaseMissing('receipts', ['job_id' => $jobId, 'customer_id' => $otherCustomer->id]);
        $this->assertNotSame($customer->id, $otherCustomer->id);
    }

    public function test_pending_receipt_can_be_approved_or_rejected_only_once(): void
    {
        [$user, $customer, $jobId] = $this->makeOperationJob();
        $approvedReceipt = $this->makeReceipt($user, $customer, $jobId);
        $rejectedReceipt = $this->makeReceipt($user, $customer, $jobId);

        $this->withoutMiddleware(CheckPermission::class)
            ->actingAs($user)
            ->patch(route('receipts.review', $approvedReceipt), ['decision' => 'approved'])
            ->assertSessionHas('success');

        $approvedReceipt->refresh();
        $this->assertSame(Receipt::STATUS_APPROVED, $approvedReceipt->status);
        $this->assertSame($user->id, $approvedReceipt->reviewed_by);
        $this->assertNotNull($approvedReceipt->reviewed_at);

        $this->withoutMiddleware(CheckPermission::class)
            ->actingAs($user)
            ->patch(route('receipts.review', $rejectedReceipt), ['decision' => 'rejected'])
            ->assertSessionHasErrors(['rejection_reason']);

        $this->withoutMiddleware(CheckPermission::class)
            ->actingAs($user)
            ->patch(route('receipts.review', $rejectedReceipt), [
                'decision' => 'rejected',
                'rejection_reason' => 'مبلغ در گردش حساب مشاهده نشد.',
            ])
            ->assertSessionHas('success');

        $rejectedReceipt->refresh();
        $this->assertSame(Receipt::STATUS_REJECTED, $rejectedReceipt->status);
        $this->assertSame('مبلغ در گردش حساب مشاهده نشد.', $rejectedReceipt->rejection_reason);

        $this->withoutMiddleware(CheckPermission::class)
            ->actingAs($user)
            ->patch(route('receipts.review', $rejectedReceipt), ['decision' => 'approved'])
            ->assertSessionHas('info');
        $this->assertSame(Receipt::STATUS_REJECTED, $rejectedReceipt->fresh()->status);
    }

    public function test_accounting_list_and_operation_panel_show_receipt_workflow(): void
    {
        set_setting('setting_company', ['card_info' => '6037991234567890']);
        [$user, $customer, $jobId] = $this->makeOperationJob();
        $group = Group::create(['name' => 'گروه دریافت '.uniqid(), 'is_active' => true]);
        $user->groups()->attach($group->id);

        Permission::query()
            ->where('controller', ReceiptController::class)
            ->pluck('id')
            ->each(fn (string $permissionId) => DB::table('group_has_permissions')->insert([
                'group_id' => $group->id,
                'permission_id' => $permissionId,
                'created_at' => now(),
                'updated_at' => now(),
            ]));

        $receipt = $this->makeReceipt($user, $customer, $jobId);

        $this->withoutMiddleware(CheckPermission::class)
            ->actingAs($user->fresh())
            ->get(route('receipts.index'))
            ->assertOk()
            ->assertSee('رسیدهای دریافت از مشتری')
            ->assertSee($receipt->code)
            ->assertSee('تأیید شد')
            ->assertSee('جزئیات کامل دریافت')
            ->assertSee('receipt-approve-check', false);

        $this->withoutMiddleware(CheckPermission::class)
            ->actingAs($user->fresh())
            ->get(route('operation.show', $jobId).'#financial')
            ->assertOk()
            ->assertSee('گردش پرداخت‌ها و دریافت‌ها')
            ->assertSee('ثبت دریافت')
            ->assertSee('دریافت / ورود وجه')
            ->assertSee($receipt->purpose)
            ->assertSee('operation-receipt-check', false);
    }

    public function test_operation_attachments_include_task_files_with_section_metadata(): void
    {
        Storage::fake('public');
        [$user, $customer, $jobId] = $this->makeOperationJob();
        $job = OperationJob::findOrFail($jobId);
        $title = TaskTitle::create([
            'title' => 'کنترل اسناد '.uniqid(),
            'type' => TaskTitle::TYPE_OPERATION,
            'is_active' => true,
        ]);
        $task = Task::create([
            'src_id' => $job->id,
            'src_type' => OperationJob::class,
            'title_id' => $title->id,
            'description' => 'بررسی فایل‌های حمل',
            'status' => 'pending',
        ]);
        Storage::disk('public')->put('tasks/checklist.pdf', 'task attachment');
        $media = $task->files()->create([
            'title' => 'چک‌لیست تسک',
            'name' => 'checklist.pdf',
            'path' => 'tasks/checklist.pdf',
            'type' => 'application/pdf',
        ]);

        $this->actingAs($user)
            ->getJson('/media/relation?'.http_build_query([
                'parent_type' => OperationJob::class,
                'parent_id' => $jobId,
                'relation' => 'payments,receipts,tasks',
            ]))
            ->assertOk()
            ->assertJsonFragment([
                'id' => $media->id,
                'section' => 'tasks',
                'section_label' => 'فایل‌های تسک‌ها',
                'source_label' => 'تسک '.$title->title,
            ]);

        $this->withoutMiddleware(CheckPermission::class)
            ->actingAs($user)
            ->get(route('operation.show', $jobId).'#attachments')
            ->assertOk()
            ->assertSee('payments,receipts,tasks', false);
    }

    private function makeReceipt(User $user, Customer $customer, string $jobId): Receipt
    {
        return Receipt::create([
            'job_id' => $jobId,
            'customer_id' => $customer->id,
            'created_by' => $user->id,
            'company_account_type' => 'account_number',
            'company_account_number' => '123456789',
            'amount' => 500000,
            'payment_scope' => 'full',
            'purpose' => 'تسویه فاکتور آزمایشی',
            'invoice_number' => 'INV-TEST',
            'status' => Receipt::STATUS_PENDING,
        ]);
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

        return [$user, $customer, $jobId];
    }
}
