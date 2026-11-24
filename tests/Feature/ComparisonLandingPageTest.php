<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class ComparisonLandingPageTest extends TestCase
{
    private const SITE_URL = 'https://sepandcrm.ir';

    private const COMPARISON_PATH = '/compare/sepand-vs-other-transport-software';

    protected function setUp(): void
    {
        parent::setUp();

        config([
            'app.url' => self::SITE_URL,
            'marketing.site_url' => self::SITE_URL,
        ]);
        URL::forceRootUrl(self::SITE_URL);
        URL::forceScheme('https');
    }

    public function test_sepand_vs_other_software_is_a_scannable_comparison_landing_page(): void
    {
        $response = $this->get(self::COMPARISON_PATH)->assertOk();
        $content = $response->getContent();

        $response
            ->assertSee('<title>مقایسه انواع نرم‌افزار حمل‌ونقل؛ TMS، CRM و مالی | سپند</title>', false)
            ->assertSee('<meta name="description" content="انواع نرم‌افزار حمل‌ونقل را مقایسه کنید: تفاوت ERP و TMS، CRM، مالی و ناوگان؛ برای هر گلوگاه، گزینه مناسب و سؤال‌های دمو را مشخص کنید.">', false)
            ->assertSee('<link rel="canonical" href="'.self::SITE_URL.self::COMPARISON_PATH.'">', false)
            ->assertSee('<meta name="robots" content="index,follow,max-image-preview:large">', false)
            ->assertSee('مقایسه انواع نرم‌افزار حمل‌ونقل؛', false)
            ->assertSee('دامنه و نقطه شروع هر دسته نرم‌افزار را چگونه تشخیص دهیم؟', false)
            ->assertSee('<table class="comparison-table">', false)
            ->assertSee('حسابداری‌محور', false)
            ->assertSee('CRM عمومی', false)
            ->assertSee('مدیریت ناوگان', false)
            ->assertSee('id="erp-vs-tms"', false)
            ->assertSee('تفاوت ERP و TMS برای شرکت‌های حمل‌ونقل چیست؟', false)
            ->assertSee('مقایسه ERP و TMS', false)
            ->assertSee('ERP یا TMS برای شرکت حمل‌ونقل', false)
            ->assertSee('اتصال TMS به ERP', false)
            ->assertSee('نرم‌افزار TMS با CRM یکپارچه چه زمانی مناسب است؟', false)
            ->assertSee('شرکت ERP دارد، اما اطلاعات فروش برای هر رزرو دوباره وارد می‌شود', false)
            ->assertSee('ببینید CRM و TMS در سپند چگونه به هم وصل می‌شوند', false)
            ->assertSee('https://www.oracle.com/erp/what-is-erp/', false)
            ->assertSee('https://www.oracle.com/scm/logistics/transportation-management/what-is-transportation-management-system/', false)
            ->assertSee('https://help.sap.com/docs/SAP_ERP/', false)
            ->assertSee('تفاوت سپند با نرم‌افزارهای حسابداری حمل‌ونقل چیست؟', false)
            ->assertSee('تفاوت سپند با CRMهای عمومی چیست؟', false)
            ->assertSee('تفاوت سپند با نرم‌افزارهای مدیریت ناوگان چیست؟', false)
            ->assertSee('سپند برای چه شرکت‌هایی مناسب‌تر است؟', false)
            ->assertSee('اگر ERP داریم، چه زمانی TMS جداگانه لازم می‌شود؟', false)
            ->assertSee('مشاهده اجرای TMS با CRM یکپارچه', false);

        $this->assertSame(1, substr_count($content, '<h1'));
        $this->assertStringNotContainsString('noindex', strtolower($content));
        $this->assertStringNotContainsString('Microsoft Excel', $content);
        $this->assertStringNotContainsString('نه با یک برند مشخص', $content);
        $this->assertStringNotContainsString('Lead / Customer → Inquiry → Quotation → Booking → Operation → Documents → Financial → Profit Report', $content);
        $this->assertStringNotContainsString('target="_blank"', $content);
    }

    public function test_comparison_page_has_valid_structured_data_and_real_internal_links(): void
    {
        $response = $this->get(self::COMPARISON_PATH)->assertOk();
        $content = $response->getContent();

        foreach ([
            '/compare',
            '/compare/sepand-vs-royan',
            '/compare/sepand-vs-saba',
            '/compare/best-transport-software',
            '/solutions/transportation-management-system',
            '/modules',
            '/modules/crm',
            '/modules/pricing-sales',
            '/modules/booking',
            '/modules/transport-operations',
            '/modules/document-management',
            '/modules/finance-accounting',
            '/modules/customer-portal-tracking',
            '/transport-modes/air',
            '/transport-modes/sea',
            '/transport-modes/road',
            '/transport-modes/rail',
            '/consultation',
        ] as $path) {
            $response->assertSee('href="'.self::SITE_URL.$path.'"', false);
        }

        $response
            ->assertSee('"@type":"WebPage"', false)
            ->assertSee('"@type":"BreadcrumbList"', false)
            ->assertSee('"@type":"ItemList"', false)
            ->assertSee('"@type":"FAQPage"', false);

        preg_match_all('/<script type="application\/ld\+json">(.*?)<\/script>/s', $content, $structuredData);
        $this->assertNotEmpty($structuredData[1]);

        foreach ($structuredData[1] as $json) {
            $this->assertIsArray(json_decode($json, true, 512, JSON_THROW_ON_ERROR));
        }
    }

    public function test_old_excel_comparison_url_redirects_permanently_to_the_new_page(): void
    {
        $this->get('/compare/transport-software-vs-excel')
            ->assertStatus(301)
            ->assertRedirect(self::SITE_URL.self::COMPARISON_PATH);
    }

    public function test_comparison_page_is_present_once_in_the_sitemap(): void
    {
        $location = '<loc>'.self::SITE_URL.self::COMPARISON_PATH.'</loc>';
        $oldLocation = '<loc>'.self::SITE_URL.'/compare/transport-software-vs-excel</loc>';
        $content = $this->get('/sitemap.xml')->assertOk()->getContent();

        $this->assertSame(1, substr_count($content, $location));
        $this->assertStringNotContainsString($oldLocation, $content);
    }
}
