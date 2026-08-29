<?php

namespace Tests\Feature;

use Tests\TestCase;

class AirFreightPageTest extends TestCase
{
    public function test_air_page_has_data_driven_chargeable_weight_logic_and_product_evidence(): void
    {
        $response = $this->get('/transport-modes/air')->assertOk();
        $content = $response->getContent();

        $response
            ->assertSee('محاسبه Chargeable Weight در حمل هوایی', false)
            ->assertSee('Actual / Gross Weight', false)
            ->assertSee('Volumetric Weight', false)
            ->assertSee('Chargeable Weight', false)
            ->assertSee('80 × 60 × 50 × 3 ÷ 6000 = 120 kg', false)
            ->assertSee('Volumetric Divisor', false)
            ->assertSee('Configurable · 6000 / 5000', false)
            ->assertSee('عدد بزرگ‌تر انتخاب می‌شود', false)
            ->assertSee('Air Freight Rating', false)
            ->assertSee('data-air-weight-example', false)
            ->assertSee('data-air-evidence="chargeable-weight"', false)
            ->assertSee('aria-label="محاسبه Actual Weight Volumetric Weight و Chargeable Weight در Air Shipment سپند"', false)
            ->assertSee('assets/css/marketing-air-freight.css?v=20260829-1', false);

        $this->assertSame(1, substr_count($content, '<h1'));
        $this->assertStringNotContainsString('TODO:', $content);
    }

    public function test_air_page_contains_a_consistent_multi_leg_transshipment_and_delay_scenario(): void
    {
        $response = $this->get('/transport-modes/air')->assertOk();
        $content = $response->getContent();

        $response
            ->assertSee('مدیریت مسیرهای چندمرحله‌ای در حمل هوایی', false)
            ->assertSee('PVG → DXB → IKA', false)
            ->assertSee('2 Flight Segments', false)
            ->assertSee('Leg 01', false)
            ->assertSee('Leg 02', false)
            ->assertSee('EK303', false)
            ->assertSee('EK971', false)
            ->assertSee('Emirates', false)
            ->assertSee('23:00', false)
            ->assertSee('04:40', false)
            ->assertSee('07:45', false)
            ->assertSee('09:30', false)
            ->assertSee('09:10', false)
            ->assertSee('10:55', false)
            ->assertSee('+1h 25m', false)
            ->assertSee('Transshipment · Dubai', false)
            ->assertSee('Connection Confirmed', false)
            ->assertSee('3h 05m', false)
            ->assertSee('4h 30m', false)
            ->assertSee('Planned Departure', false)
            ->assertSee('Updated Departure', false)
            ->assertSee('Segment ETD', false)
            ->assertSee('Segment ETA', false)
            ->assertSee('data-air-evidence="flight-segment-timeline"', false);

        $this->assertSame(2, substr_count($content, 'class="air-segment is-'));
        foreach (['Scheduled', 'Confirmed', 'Departed', 'Arrived', 'Delayed', 'Cancelled', 'Connection', 'Completed'] as $status) {
            $this->assertStringContainsString($status, $content);
        }
    }

    public function test_air_page_has_air_specific_overview_documents_uld_and_milestone_evidence(): void
    {
        $response = $this->get('/transport-modes/air')->assertOk();
        $content = $response->getContent();

        $response
            ->assertSee('AF-2026-0084', false)
            ->assertSee('176-12345675', false)
            ->assertSee('SPN-2408064', false)
            ->assertSee('SPN-001', false)
            ->assertSee('SPN-002', false)
            ->assertSee('SPN-003', false)
            ->assertSee('Master Air Waybill', false)
            ->assertSee('Air Shipment Overview', false)
            ->assertSee('ULD Assignment', false)
            ->assertSee('PMC12345EK', false)
            ->assertSee('1,850 kg', false)
            ->assertSee('Cargo Received', false)
            ->assertSee('Arrived at Hub', false)
            ->assertSee('Destination ETA', false)
            ->assertSee('data-air-evidence="shipment-overview"', false)
            ->assertSee('data-air-evidence="mawb-hawb"', false)
            ->assertSee('data-air-evidence="uld-assignment"', false)
            ->assertSee('aria-label="نمای اطلاعات MAWB HAWB وزن قابل محاسبه و مسیر چندمرحله‌ای در پرونده حمل هوایی سپند"', false);

        $this->assertSame(5, substr_count($content, 'data-air-evidence='));
        $this->assertGreaterThanOrEqual(5, substr_count($content, '<figcaption'));
    }

    public function test_air_page_exposes_entity_relationships_and_does_not_duplicate_the_product_journey(): void
    {
        $response = $this->get('/transport-modes/air')->assertOk();

        $response
            ->assertSee('Air Shipment', false)
            ->assertSee('Cargo', false)
            ->assertSee('Dimensions', false)
            ->assertSee('Flight Segment', false)
            ->assertSee('Origin / Destination Airport', false)
            ->assertSee('ETD / ETA / Status', false)
            ->assertSee('MAWB', false)
            ->assertSee('HAWB', false)
            ->assertSee('ULD', false)
            ->assertSee('Airport Milestone', false)
            ->assertDontSee('یک پرونده در سپند چه مسیری را طی می‌کند؟', false)
            ->assertDontSee('مقایسه چندمعیاره تأمین‌کننده', false)
            ->assertDontSee('پیشنهاد نرخ تأمین‌کننده', false)
            ->assertDontSee('Quote Approval', false)
            ->assertDontSee('Margin', false)
            ->assertDontSee('از اولین تماس مشتری تا تسویه پرونده', false);
    }
}
