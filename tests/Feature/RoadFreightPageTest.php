<?php

namespace Tests\Feature;

use Tests\TestCase;

class RoadFreightPageTest extends TestCase
{
    public function test_road_page_has_a_nine_step_vehicle_to_trip_cost_journey(): void
    {
        $response = $this->get('/transport-modes/road')->assertOk();
        $content = $response->getContent();

        $response
            ->assertSee('جریان واقعی سفر زمینی از تخصیص کامیون تا هزینه نهایی', false)
            ->assertSee('ایجاد پرونده حمل', false)
            ->assertSee('تخصیص کامیون', false)
            ->assertSee('تخصیص راننده', false)
            ->assertSee('بارگیری و شروع سفر', false)
            ->assertSee('ورود به مرز', false)
            ->assertSee('رویدادهای مرزی و گمرکی', false)
            ->assertSee('ادامه مسیر پس از مرز', false)
            ->assertSee('تحویل و POD', false)
            ->assertSee('هزینه و تسویه سفر', false)
            ->assertSee('assets/css/marketing-road-freight.css?v=20260829-1', false);

        $this->assertSame(9, substr_count($content, 'class="road-journey-step'));
        $this->assertSame(1, substr_count($content, '<h1'));
        $this->assertStringNotContainsString('TODO:', $content);
    }

    public function test_road_page_has_consistent_vehicle_driver_route_and_border_demo_data(): void
    {
        $response = $this->get('/transport-modes/road')->assertOk();

        $response
            ->assertSee('RD-2026-0148', false)
            ->assertSee('Istanbul → Gürbulak → Bazargan → Tehran', false)
            ->assertSee('Industrial Parts', false)
            ->assertSee('18,400 kg', false)
            ->assertSee('Curtain-side Trailer', false)
            ->assertSee('34 ABC 789', false)
            ->assertSee('TR 45821', false)
            ->assertSee('Mehmet Kaya', false)
            ->assertSee('DRV-10458', false)
            ->assertSee('نمای تخصیص کامیون و راننده در پرونده حمل زمینی سپند', false)
            ->assertSee('data-road-evidence="vehicle-driver-assignment"', false)
            ->assertSee('Road Shipment', false)
            ->assertSee('Trip Structure', false)
            ->assertSee('Border Structure', false)
            ->assertSee('Delivery Structure', false)
            ->assertSee('Cost Structure', false);
    }

    public function test_road_page_models_border_waiting_delay_and_updated_eta_in_order(): void
    {
        $response = $this->get('/transport-modes/road')->assertOk();
        $content = $response->getContent();

        foreach (['06:30', '06:40', '08:15', '09:20', '13:50', '14:45', '15:05'] as $time) {
            $response->assertSee($time, false);
        }

        $response
            ->assertSee('مدت حضور در مرز', false)
            ->assertSee('8h 15m', false)
            ->assertSee('انتظار ثبت‌شده 8h 05m', false)
            ->assertSee('+3h 15m', false)
            ->assertSee('Customs Inspection', false)
            ->assertSee('30 Aug · 19:15', false)
            ->assertSee('30 Aug · 22:30', false)
            ->assertSee('تأخیر مرزی', false)
            ->assertSee('ETA به‌روزشده', false)
            ->assertSee('برنامه تحویل', false)
            ->assertSee('data-road-evidence="border-timeline"', false)
            ->assertSee('Driver Change History', false)
            ->assertSee('Vehicle Change Ready', false);

        $this->assertSame(
            ['06:30', '06:40', '08:15', '09:20', '13:50', '14:45', '15:05'],
            array_column(config('site_road_demo.border_events'), 'value')
        );
        foreach (['برنامه‌ریزی‌شده', 'در انتظار', 'در حال بررسی', 'تأییدشده', 'با تأخیر', 'عبور کرده', 'تکمیل‌شده'] as $status) {
            $this->assertStringContainsString($status, $content);
        }
    }

    public function test_road_page_has_pod_and_trip_cost_claim_to_proof_flows(): void
    {
        $response = $this->get('/transport-modes/road')->assertOk();
        $content = $response->getContent();

        $response
            ->assertSee('تحویل و POD؛ پایان قابل اثبات همان سفر', false)
            ->assertSee('30 Aug 2026 · 22:12', false)
            ->assertSee('Demo Consignee', false)
            ->assertSee('POD-2026-0148.pdf', false)
            ->assertSee('30 Aug 2026 · 22:25', false)
            ->assertSee('Signed Delivery Receipt', false)
            ->assertSee('POD بارگذاری‌شده', false)
            ->assertSee('data-road-evidence="delivery-pod"', false)
            ->assertSee('کرایه راننده', false)
            ->assertSee('1,850 USD', false)
            ->assertSee('620 USD', false)
            ->assertSee('145 USD', false)
            ->assertSee('210 USD', false)
            ->assertSee('95 USD', false)
            ->assertSee('80 USD', false)
            ->assertSee('3,000 USD', false)
            ->assertSee('4,250 USD', false)
            ->assertSee('1,250 USD', false)
            ->assertSee('پرونده مالی همان حمل', false)
            ->assertSee('data-road-evidence="trip-cost-flow"', false);

        $this->assertLessThan(strpos($content, '30 Aug 2026 · 22:25'), strpos($content, '30 Aug 2026 · 22:12'));
        $this->assertSame(4, substr_count($content, 'data-road-evidence='));
    }

    public function test_road_page_has_continuous_evidence_numbering_and_no_product_journey_overlap(): void
    {
        $response = $this->get('/transport-modes/road')->assertOk();

        foreach (['نمای عملیاتی حمل زمینی 01', 'نمای عملیاتی حمل زمینی 02', 'نمای عملیاتی حمل زمینی 03', 'نمای عملیاتی حمل زمینی 04'] as $label) {
            $response->assertSee($label, false);
        }

        foreach (['Road Shipment', 'Trip', 'Vehicle', 'Driver', 'Route', 'Border Event', 'Waiting', 'Clearance', 'Border Exit', 'Delivery', 'POD', 'Trip Cost', 'Finance'] as $entity) {
            $response->assertSee($entity, false);
        }

        foreach (['road freight software', 'truck management', 'driver management', 'border tracking', 'proof of delivery', 'trip cost management', 'customs border tracking'] as $keyword) {
            $this->assertContains($keyword, config('site_transport_modes.road.keywords'));
        }

        $response
            ->assertDontSee('یک پرونده در سپند چه مسیری را طی می‌کند؟', false)
            ->assertDontSee('از اولین تماس مشتری تا تسویه پرونده', false)
            ->assertDontSee('مقایسه چندمعیاره تأمین‌کننده', false)
            ->assertDontSee('Quote Approval', false)
            ->assertDontSee('Lead / Customer', false);
    }
}
