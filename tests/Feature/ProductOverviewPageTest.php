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
            ->assertSee('<title>نرم‌افزار فورواردری سپند | مدیریت فروش، عملیات و مالی</title>', false)
            ->assertSee('<meta name="description" content="نرم‌افزار فورواردری سپند، مدیریت مشتریان، استعلام نرخ، بوکینگ، عملیات حمل، اسناد و مالی را در یک سیستم یکپارچه فراهم می‌کند. امکانات را ببینید و دمو بگیرید.">', false)
            ->assertSee('<link rel="canonical" href="'.self::SITE_URL.'/product">', false)
            ->assertSee('از اولین تماس مشتری تا تسویه پرونده؛', false)
            ->assertSee('نرم‌افزار فورواردری سپند؛', false)
            ->assertSee('سپند برای چه شرکت‌هایی مناسب است؟', false)
            ->assertSee('شرکت‌های فورواردری', false)
            ->assertSee('عملیات چندوجهی و NVOCC', false)
            ->assertSee('id="product-flow"', false)
            ->assertSee('یک پرونده حمل در سپند چگونه مدیریت می‌شود؟', false)
            ->assertSee('قابلیت‌های تخصصی نرم‌افزار فورواردری', false)
            ->assertSee('یکپارچگی فروش، عملیات و مالی', false)
            ->assertSee('پرتال مشتری و خودکارسازی پیگیری‌ها', false)
            ->assertSee('استقرار، آموزش و پشتیبانی', false)
            ->assertSee('استقرار داخلی سپند تأیید شده است', false)
            ->assertSee('مشاهده نرم‌افزار در یک دموی واقعی', false)
            ->assertSee('مشتریان با بیشترین درآمد', false)
            ->assertSee('مشتریان با بیشترین سود', false)
            ->assertSee('کار زیاد، سود کم', false)
            ->assertSee('کم‌حجم و ارزشمند', false)
            ->assertSee('مقایسه چندمعیاره تأمین‌کننده', false)
            ->assertSee('نرخ پیشنهادی و هشدار انقضا', false)
            ->assertSee('تطبیق مالی Booking', false)
            ->assertSee('قانون تسک و تقویم‌های جدا', false)
            ->assertSee('pricing-supplier-comparison.webp', false)
            ->assertSee('pricing-proposed-rates.webp', false)
            ->assertSee('document-attachment-upload.webp', false)
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
            '/assets/images/marketing/modules/screenshots/crm-customer-insights.webp',
            '/assets/images/marketing/modules/screenshots/crm-overdue-inquiries.webp',
            '/assets/images/marketing/modules/screenshots/pricing-sales-workflow.webp',
            '/assets/images/marketing/modules/screenshots/pricing-supplier-comparison.webp',
            '/assets/images/marketing/modules/screenshots/pricing-proposed-rates.webp',
            '/assets/images/marketing/modules/screenshots/booking-profitability.webp',
            '/assets/images/marketing/modules/screenshots/operations-calendar-month.webp',
            '/assets/images/marketing/modules/screenshots/document-attachment-upload.webp',
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
        $this->assertStringNotContainsString('crm-customer-profit-analysis.webp', $content);
        $this->assertStringNotContainsString('data-missing-screenshot=', $content);
        $this->assertStringNotContainsString('product-missing-evidence', $content);
    }

    public function test_home_and_shared_navigation_link_to_product_page(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('href="'.self::SITE_URL.'/product"', false)
            ->assertSee('مشاهده سپند در عمل', false)
            ->assertSee('نرم‌افزار فورواردری سپند', false);

        $this->get('/modules')
            ->assertOk()
            ->assertSee('href="'.self::SITE_URL.'/product"', false)
            ->assertSee('معرفی محصول', false);
    }

    public function test_relevant_pages_use_contextual_internal_links_to_product(): void
    {
        $this->get('/modules/crm')
            ->assertOk()
            ->assertSee('href="'.self::SITE_URL.'/product">نرم‌افزار یکپارچه فورواردری</a>', false);

        $this->get('/modules/pricing-sales')
            ->assertOk()
            ->assertSee('href="'.self::SITE_URL.'/product">مدیریت فروش و عملیات فورواردری</a>', false);

        $this->get('/modules/transport-operations')
            ->assertOk()
            ->assertSee('href="'.self::SITE_URL.'/product">نرم‌افزار مدیریت فرایندهای فورواردری</a>', false);

        $this->get('/compare/best-freight-forwarding-software')
            ->assertOk()
            ->assertSee('href="'.self::SITE_URL.'/product">بررسی امکانات نرم‌افزار فورواردری سپند', false);
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
