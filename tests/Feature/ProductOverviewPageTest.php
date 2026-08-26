<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class ProductOverviewPageTest extends TestCase
{
    private const SITE_URL = 'https://sepandcrm.ir';

    protected function setUp(): void
    {
        parent::setUp();

        config(['app.url' => self::SITE_URL]);
        URL::forceRootUrl(self::SITE_URL);
        URL::forceScheme('https');
    }

    public function test_product_overview_tells_the_full_workflow_with_real_evidence(): void
    {
        $response = $this->get('/product')->assertOk();
        $content = $response->getContent();

        $response
            ->assertSee('<title>معرفی نرم افزار سپند | مدیریت یکپارچه شرکت‌های حمل‌ونقل و فورواردری</title>', false)
            ->assertSee('<link rel="canonical" href="'.self::SITE_URL.'/product">', false)
            ->assertSee('از اولین تماس مشتری تا تسویه پرونده؛', false)
            ->assertSee('همه‌چیز در یک سیستم', false)
            ->assertSee('id="product-flow"', false)
            ->assertSee('قابلیت‌هایی که در کار روزانه تفاوت می‌سازند', false)
            ->assertSee('مشتریان با بیشترین درآمد', false)
            ->assertSee('مشتریان با بیشترین سود', false)
            ->assertSee('کار زیاد، سود کم', false)
            ->assertSee('کم‌حجم و ارزشمند', false)
            ->assertSee('مقایسه چندمعیاره تأمین‌کننده', false)
            ->assertSee('نرخ پیشنهادی و هشدار انقضا', false)
            ->assertSee('تطبیق مالی Booking', false)
            ->assertSee('قانون تسک و تقویم‌های جدا', false)
            ->assertSee('crm-customer-profit-analysis.webp', false)
            ->assertSee('pricing-supplier-comparison.webp', false)
            ->assertSee('pricing-proposed-rate.webp', false)
            ->assertSee('data-missing-screenshot="document-management"', false)
            ->assertSee('document-management-shipment-files.webp', false)
            ->assertSee('مشتری هم وضعیت پرونده را از همان داده واقعی می‌بیند', false)
            ->assertSee('/assets/images/marketing/modules/screenshots/customer-portal-dashboard.webp', false)
            ->assertSee('"@type":"SoftwareApplication"', false)
            ->assertSee('"@type":"BreadcrumbList"', false);

        foreach (['crm', 'pricing', 'booking', 'operations', 'documents', 'finance', 'dashboard'] as $section) {
            $response->assertSee('id="'.$section.'"', false);
        }

        foreach ([
            '/assets/images/marketing/product-showcase/desktop-dashboard.webp',
            '/assets/images/marketing/modules/screenshots/crm-customers.webp',
            '/assets/images/marketing/modules/screenshots/pricing-sales-workflow.webp',
            '/assets/images/marketing/modules/screenshots/booking-profitability.webp',
            '/assets/images/marketing/modules/screenshots/operations-calendar-month.webp',
            '/assets/images/marketing/modules/screenshots/finance-booking-reconciliation.webp',
            '/assets/images/marketing/modules/screenshots/automatic-task-rules.webp',
            '/assets/images/marketing/modules/screenshots/customer-portal-dashboard.webp',
        ] as $asset) {
            $response->assertSee($asset, false);
        }

        foreach (['crm', 'pricing-sales', 'booking', 'transport-operations', 'document-management', 'finance-accounting', 'customer-portal-tracking'] as $module) {
            $response->assertSee('href="'.self::SITE_URL.'/modules/'.$module.'"', false);
        }

        $this->assertSame(1, substr_count($content, '<h1'));
        $this->assertStringNotContainsString('<meta name="keywords"', strtolower($content));
        $this->assertStringNotContainsString('<img src=""', $content);
    }

    public function test_home_and_shared_navigation_link_to_product_page(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('href="'.self::SITE_URL.'/product"', false)
            ->assertSee('مشاهده سپند در عمل', false)
            ->assertSee('معرفی کامل محصول', false);

        $this->get('/modules')
            ->assertOk()
            ->assertSee('href="'.self::SITE_URL.'/product"', false)
            ->assertSee('معرفی محصول', false);
    }

    public function test_product_page_is_in_sitemap_once_with_real_dashboard_image(): void
    {
        $content = $this->get('/sitemap.xml')->assertOk()->getContent();

        $this->assertSame(1, substr_count($content, '<loc>'.self::SITE_URL.'/product</loc>'));
        $this->assertStringContainsString(
            '<image:loc>'.self::SITE_URL.'/assets/images/marketing/product-showcase/desktop-dashboard.webp</image:loc>',
            $content
        );
    }
}
