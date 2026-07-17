<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\Auth\App\Models\User;
use Modules\Booking\App\Models\Booking;
use Modules\Customer\App\Models\Customer;
use Modules\Task\App\Models\Task;
use Modules\Task\App\Models\TaskTitle;
use Modules\Transaction\App\Models\Transaction;
use Tests\TestCase;

class BookingAndInquiryAttachmentGroupingTest extends TestCase
{
    use DatabaseTransactions;

    public function test_booking_attachments_separate_direct_files_from_task_files(): void
    {
        Storage::fake('public');
        [$user, $transaction, $booking] = $this->makeRecords();

        $this->assertGroupedAttachments(
            $user,
            $booking,
            TaskTitle::TYPE_BOOKING,
            'فایل‌های بوکینگ',
            'آپلود مستقیم در بوکینگ'
        );
    }

    public function test_inquiry_attachments_separate_direct_files_from_task_files(): void
    {
        Storage::fake('public');
        [$user, $transaction] = $this->makeRecords();

        $this->assertGroupedAttachments(
            $user,
            $transaction,
            TaskTitle::TYPE_TRANSACTION,
            'فایل‌های استعلام',
            'آپلود مستقیم در استعلام'
        );
    }

    private function assertGroupedAttachments(
        User $user,
        Booking|Transaction $parent,
        string $taskType,
        string $directSectionLabel,
        string $directSourceLabel
    ): void {
        $suffix = uniqid();
        Storage::disk('public')->put("attachments/direct-{$suffix}.pdf", 'direct file');
        $directMedia = $parent->files()->create([
            'title' => 'سند مستقیم',
            'name' => "direct-{$suffix}.pdf",
            'path' => "attachments/direct-{$suffix}.pdf",
            'type' => 'application/pdf',
        ]);

        $taskTitle = TaskTitle::create([
            'title' => 'پیگیری اسناد '.$suffix,
            'type' => $taskType,
            'is_active' => true,
        ]);
        $task = Task::create([
            'src_id' => $parent->id,
            'src_type' => $parent::class,
            'title_id' => $taskTitle->id,
            'description' => 'تسک دارای پیوست',
            'status' => 'pending',
        ]);
        Storage::disk('public')->put("tasks/task-{$suffix}.pdf", 'task file');
        $taskMedia = $task->files()->create([
            'title' => 'سند تسک',
            'name' => "task-{$suffix}.pdf",
            'path' => "tasks/task-{$suffix}.pdf",
            'type' => 'application/pdf',
        ]);

        $this->actingAs($user)
            ->getJson('/media/fileable?'.http_build_query([
                'fileable_type' => $parent::class,
                'fileable_id' => $parent->id,
            ]))
            ->assertOk()
            ->assertJsonFragment([
                'id' => $directMedia->id,
                'section' => 'direct',
                'section_label' => $directSectionLabel,
                'source_label' => $directSourceLabel,
            ]);

        $this->actingAs($user)
            ->getJson('/media/relation?'.http_build_query([
                'parent_type' => $parent::class,
                'parent_id' => $parent->id,
                'relation' => 'tasks',
            ]))
            ->assertOk()
            ->assertJsonFragment([
                'id' => $taskMedia->id,
                'section' => 'tasks',
                'section_label' => 'فایل‌های تسک‌ها',
                'source_label' => 'تسک '.$taskTitle->title,
            ]);
    }

    private function makeRecords(): array
    {
        $suffix = str_replace('.', '', uniqid('', true));
        $now = now();
        $user = User::create([
            'first_name' => 'کاربر',
            'last_name' => 'پیوست',
            'mobile' => '09'.substr($suffix, -9),
            'password' => bcrypt('password'),
        ]);
        $customer = Customer::create([
            'firstname' => 'مشتری',
            'lastname' => 'پیوست',
            'mobile' => '09'.substr(strrev($suffix), 0, 9),
            'status' => 'actual',
            'type' => 'person',
        ]);
        $transactionId = (string) Str::uuid();
        DB::table('transactions')->insert([
            'id' => $transactionId,
            'code' => 'INQ-'.$suffix,
            'name' => 'استعلام آزمایشی',
            'status' => 'running',
            'customer_id' => $customer->id,
            'customer_type' => Customer::class,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        $bookingId = (string) Str::uuid();
        DB::table('bookings')->insert([
            'id' => $bookingId,
            'code' => 'BOOK-'.$suffix,
            'transaction_id' => $transactionId,
            'customer_id' => $customer->id,
            'status' => 'operational',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        return [
            $user,
            Transaction::findOrFail($transactionId),
            Booking::findOrFail($bookingId),
        ];
    }
}
