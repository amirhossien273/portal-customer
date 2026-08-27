<?php

namespace Tests\Feature;

use Tests\TestCase;

class AirFreightPageTest extends TestCase
{
    public function test_air_page_uses_verified_weight_fields_and_a_truthful_calculation_example(): void
    {
        $response = $this->get('/transport-modes/air')->assertOk();
        $content = $response->getContent();

        $response
            ->assertSee('محاسبه Chargeable Weight در حمل هوایی', false)
            ->assertSee('Actual / Gross Weight', false)
            ->assertSee('Volumetric Weight', false)
            ->assertSee('Chargeable Weight', false)
            ->assertSee('80 × 60 × 50 × 3 ÷ 6000 = 120 kg', false)
            ->assertSee('ضریب قراردادی نمونه', false)
            ->assertSee('عدد بزرگ‌تر انتخاب می‌شود', false)
            ->assertSee('Air Freight Rating', false)
            ->assertSee('در منطق فعلی محصول، ضریب ثابت ۵۰۰۰ یا ۶۰۰۰ و محاسبه خودکار آن تأیید نشده است', false)
            ->assertSee('data-air-weight-example', false)
            ->assertSee('assets/css/marketing-air-freight.css', false);

        $this->assertSame(1, substr_count($content, '<h1'));
        $this->assertGreaterThanOrEqual(1, substr_count($content, '<h2'));
        $this->assertGreaterThanOrEqual(1, substr_count($content, '<h3'));
    }

    public function test_air_page_does_not_claim_unverified_air_capabilities_or_duplicate_product_workflows(): void
    {
        $this->get('/transport-modes/air')
            ->assertOk()
            ->assertDontSee('MAWB', false)
            ->assertDontSee('HAWB', false)
            ->assertDontSee('ULD', false)
            ->assertDontSee('Flight Segment', false)
            ->assertDontSee('رویدادهای چند پرواز', false)
            ->assertDontSee('ترانشیپ', false)
            ->assertDontSee('مقایسه تأمین‌کننده', false)
            ->assertDontSee('Margin', false)
            ->assertDontSee('Quote Approval', false)
            ->assertDontSee('استعلام و نرخ هوایی', false)
            ->assertDontSee('هزینه و تسویه', false)
            ->assertDontSee('air-evidence', false);
    }
}
