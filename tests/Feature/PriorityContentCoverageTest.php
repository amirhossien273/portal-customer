<?php

namespace Tests\Feature;

use Tests\TestCase;

class PriorityContentCoverageTest extends TestCase
{
    public function test_all_ten_priority_content_scenarios_have_a_dedicated_destination(): void
    {
        $destinations = [
            '/solutions/operations-automation' => 'دموی واقعی چرخه Rule تا Exception',
            '/solutions/security-access-management' => 'جداسازی فضای کاری',
            '/solutions/payment-workflow' => 'درخواست پرداخت تا پرداخت نهایی',
            '/solutions/booking-reconciliation' => 'دریافت و تطبیق مالی Booking',
            '/modules/customer-portal-tracking' => 'انتخاب حساب در ساختار چندسازمانی',
            '/solutions/container-management' => 'live/container-control.png',
            '/solutions/fleet-management' => 'live/fleet-compliance-control.png',
            '/solutions/supplier-management' => 'Supplier Master و مقایسه تأمین‌کنندگان',
            '/solutions/rate-management' => 'Rate Break & Minimum',
            '/customers/case-studies/operational-control-snapshot' => 'اعداد مشاهده‌شده، نه وعده بازاریابی',
        ];

        foreach ($destinations as $path => $evidence) {
            $this->get($path)->assertOk()->assertSee($evidence, false);
        }

        $this->assertCount(10, $destinations);
    }

    public function test_every_live_product_capture_used_by_content_exists(): void
    {
        $usedImages = collect(config('site_platform_solutions.pages'))
            ->flatMap(fn (array $page) => collect($page['evidence'])->pluck('image'))
            ->filter(fn (string $image) => str_starts_with($image, 'live/'))
            ->push(config('site_case_studies.operational-control-snapshot.image'))
            ->unique();

        foreach ($usedImages as $image) {
            $this->assertFileExists(public_path('assets/images/marketing/'.$image));
        }
    }
}
