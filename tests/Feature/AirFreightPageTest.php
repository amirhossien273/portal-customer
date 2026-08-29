<?php

namespace Tests\Feature;

use Tests\TestCase;

class AirFreightPageTest extends TestCase
{
    public function test_air_page_has_a_persian_data_driven_chargeable_weight_example(): void
    {
        $response = $this->get('/transport-modes/air')->assertOk();
        $content = $response->getContent();

        $response
            ->assertSee('محاسبه Chargeable Weight در حمل هوایی', false)
            ->assertSee('وزن واقعی / ناخالص', false)
            ->assertSee('وزن حجمی', false)
            ->assertSee('Chargeable Weight', false)
            ->assertSee('80 × 60 × 50 × 3 ÷ 6000 = 120 kg', false)
            ->assertSee('ضریب محاسبه وزن حجمی', false)
            ->assertSee('قابل تنظیم · ۶۰۰۰ / ۵۰۰۰', false)
            ->assertSee('عدد بزرگ‌تر انتخاب می‌شود', false)
            ->assertSee('ورودی محاسبه نرخ حمل هوایی', false)
            ->assertSee('data-air-weight-example', false)
            ->assertSee('data-air-evidence="chargeable-weight"', false)
            ->assertSee('assets/css/marketing-air-freight.css?v=20260829-1', false);

        $this->assertSame(1, substr_count($content, '<h1'));
        $this->assertStringNotContainsString('TODO:', $content);
    }

    public function test_air_page_localizes_the_consistent_multi_leg_transshipment_and_delay_scenario(): void
    {
        $response = $this->get('/transport-modes/air')->assertOk();
        $content = $response->getContent();

        $response
            ->assertSee('مدیریت مسیرهای چندمرحله‌ای در حمل هوایی', false)
            ->assertSee('PVG → DXB → IKA', false)
            ->assertSee('۲ بخش پرواز · ۱ ترانشیپمنت', false)
            ->assertSee('بخش پرواز 01', false)
            ->assertSee('بخش پرواز 02', false)
            ->assertSee('EK303', false)
            ->assertSee('EK971', false)
            ->assertSee('Emirates', false)
            ->assertSee('29 Aug 2026 · 23:00', false)
            ->assertSee('30 Aug 2026 · 04:40', false)
            ->assertSee('30 Aug 2026 · 07:45', false)
            ->assertSee('30 Aug 2026 · 09:30', false)
            ->assertSee('30 Aug 2026 · 09:10', false)
            ->assertSee('30 Aug 2026 · 10:55', false)
            ->assertSee('+1h 25m', false)
            ->assertSee('ترانشیپمنت · دبی', false)
            ->assertSee('اتصال تأییدشده', false)
            ->assertSee('زمان اتصال برنامه‌ریزی‌شده', false)
            ->assertSee('زمان اتصال به‌روزشده', false)
            ->assertSee('رویداد تأخیر', false)
            ->assertSee('زمان حرکت (ETD)', false)
            ->assertSee('زمان رسیدن (ETA)', false)
            ->assertSee('data-air-evidence="flight-segment-timeline"', false);

        $this->assertSame(2, substr_count($content, 'class="air-segment is-'));
        foreach (['برنامه‌ریزی‌شده', 'تأییدشده', 'حرکت‌کرده', 'رسیده', 'با تأخیر', 'لغوشده', 'اتصال', 'تکمیل‌شده'] as $status) {
            $this->assertStringContainsString($status, $content);
        }
    }

    public function test_air_page_has_four_continuously_numbered_operational_views(): void
    {
        $response = $this->get('/transport-modes/air')->assertOk();
        $content = $response->getContent();

        foreach (['نمای عملیاتی حمل هوایی 01', 'نمای عملیاتی حمل هوایی 02', 'نمای عملیاتی حمل هوایی 03', 'نمای عملیاتی حمل هوایی 04'] as $label) {
            $response->assertSee($label, false);
        }

        $response
            ->assertSee('نمای کلی پرونده حمل هوایی؛ اطلاعات کلیدی در یک ساختار', false)
            ->assertSee('خط زمانی بخش‌های پرواز', false)
            ->assertSee('رابطه MAWB و HAWB در پرونده حمل هوایی', false)
            ->assertSee('تخصیص ULD در بستر پرواز و محموله', false)
            ->assertSee('AF-2026-0084', false)
            ->assertSee('176-12345675', false)
            ->assertSee('SPN-001', false)
            ->assertSee('SPN-002', false)
            ->assertSee('SPN-003', false)
            ->assertSee('بارنامه مادر هوایی', false)
            ->assertSee('PMC12345EK', false)
            ->assertSee('1,850 kg', false)
            ->assertSee('دریافت محموله', false)
            ->assertSee('ورود به فرودگاه ترانزیت', false)
            ->assertSee('ETA مقصد', false)
            ->assertSee('data-air-evidence="shipment-overview"', false)
            ->assertSee('data-air-evidence="mawb-hawb"', false)
            ->assertSee('data-air-evidence="uld-assignment"', false)
            ->assertDontSee('Air-specific Product Evidence', false)
            ->assertDontSee('Product-style', false);

        $this->assertSame(5, substr_count($content, 'data-air-evidence='));
        $this->assertGreaterThanOrEqual(5, substr_count($content, '<figcaption'));
    }

    public function test_air_page_preserves_technical_entities_in_a_persian_experience_without_product_overlap(): void
    {
        $response = $this->get('/transport-modes/air')->assertOk();

        foreach (['Air Freight', 'Chargeable Weight', 'Actual Weight', 'Gross Weight', 'Volumetric Weight', 'Flight Segment', 'Transshipment', 'MAWB', 'HAWB', 'ULD', 'ETD', 'ETA', 'IATA'] as $entity) {
            $response->assertSee($entity, false);
        }

        $response
            ->assertSee('پرونده حمل هوایی', false)
            ->assertSee('محموله', false)
            ->assertSee('ابعاد', false)
            ->assertSee('بخش پرواز', false)
            ->assertSee('فرودگاه مبدأ / مقصد', false)
            ->assertSee('نقطه عطف فرودگاهی', false)
            ->assertDontSee('یک پرونده در سپند چه مسیری را طی می‌کند؟', false)
            ->assertDontSee('مقایسه چندمعیاره تأمین‌کننده', false)
            ->assertDontSee('پیشنهاد نرخ تأمین‌کننده', false)
            ->assertDontSee('Quote Approval', false)
            ->assertDontSee('Margin', false)
            ->assertDontSee('از اولین تماس مشتری تا تسویه پرونده', false);
    }
}
