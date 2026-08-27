<?php

namespace Tests\Feature;

use Tests\TestCase;

class RailFreightPageTest extends TestCase
{
    public function test_rail_page_has_a_nine_step_rail_specific_journey(): void
    {
        $response = $this->get('/transport-modes/rail')->assertOk();
        $content = $response->getContent();

        $response
            ->assertSee('از تخصیص واگن تا آخرین ایستگاه؛ یک Journey نه‌مرحله‌ای', false)
            ->assertSee('تخصیص واگن', false)
            ->assertSee('ایستگاه مبدأ', false)
            ->assertSee('ایستگاه‌های میانی', false)
            ->assertSee('رویداد و استثنا', false)
            ->assertSee('ایستگاه مقصد', false)
            ->assertSee('اسناد ریلی', false)
            ->assertSee('هزینه و تسویه', false)
            ->assertSee('Rail Shipment', false)
            ->assertSee('Wagon', false)
            ->assertSee('Route', false)
            ->assertSee('Station', false)
            ->assertSee('Rail Event', false)
            ->assertSee('assets/css/marketing-rail-freight.css', false);

        $this->assertSame(9, substr_count($content, 'class="rail-journey-step'));
        $this->assertSame(1, substr_count($content, '<h1'));
    }

    public function test_rail_page_contains_three_consistent_demo_scenarios_and_two_evidence_views(): void
    {
        $response = $this->get('/transport-modes/rail')->assertOk();
        $content = $response->getContent();

        $response
            ->assertSee('R-2026-0142', false)
            ->assertSee('74821', false)
            ->assertSee('74822', false)
            ->assertSee('74823', false)
            ->assertSee('74824', false)
            ->assertSee('10:30', false)
            ->assertSee('16:20', false)
            ->assertSee('+5h 50m', false)
            ->assertSee('توقف عملیاتی', false)
            ->assertSee('75208', false)
            ->assertSee('Bogie Change', false)
            ->assertSee('Gauge Change', false)
            ->assertSee('data-rail-evidence="wagon-assignment"', false)
            ->assertSee('data-rail-evidence="station-timeline"', false)
            ->assertSee('داده‌های این نما نمونه‌اند', false)
            ->assertSee('پیش‌نمایش رابط محصول است، نه اسکرین‌شات داده زنده', false);

        $this->assertSame(4, substr_count($content, 'class="rail-wagon-card'));
        $this->assertSame(2, substr_count($content, 'data-rail-evidence='));
        $this->assertStringNotContainsString('TODO:', $content);
    }

    public function test_rail_page_discloses_planned_product_boundaries_and_does_not_repeat_product_journey(): void
    {
        $this->get('/transport-modes/rail')
            ->assertOk()
            ->assertSee('موجودیت اختصاصی واگن در Backend فعلی هنوز پیاده‌سازی نشده است', false)
            ->assertSee('Entity تخصصی Station ندارد', false)
            ->assertSee('منطق اختصاصی این دو رویداد در محصول فعلی تأیید نشد', false)
            ->assertDontSee('یک پرونده در سپند چه مسیری را طی می‌کند؟', false)
            ->assertDontSee('Lead / Customer', false)
            ->assertDontSee('مقایسه تأمین‌کننده', false)
            ->assertDontSee('مدیریت ارتباط با مشتری', false);
    }
}
