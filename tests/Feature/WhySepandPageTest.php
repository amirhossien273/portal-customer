<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class WhySepandPageTest extends TestCase
{
    private const SITE_URL = 'https://sepandcrm.ir';

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

    public function test_why_sepand_page_explains_the_business_reason_without_repeating_product_or_compare_pages(): void
    {
        $response = $this->get('/why-sepand')->assertOk();
        $content = $response->getContent();

        $response
            ->assertSee('<title>چرا سپند؟ | نرم افزار تخصصی مدیریت شرکت‌های حمل‌ونقل و فورواردری</title>', false)
            ->assertSee('<meta name="description" content="ببینید چرا سپند برای اتصال CRM، نرخ‌دهی، Booking، عملیات، اسناد و امور مالی شرکت‌های حمل‌ونقل و فورواردری طراحی شده است.">', false)
            ->assertSee('<link rel="canonical" href="'.self::SITE_URL.'/why-sepand">', false)
            ->assertSee('مشکل فقط پراکندگی اطلاعات نیست', false)
            ->assertSee('وقتی ابزارها جدا هستند، فرایند هم تکه‌تکه می‌شود', false)
            ->assertSee('چرا سپند با ابزارهای عمومی متفاوت است؟', false)
            ->assertSee('CRM عمومی برای فروش طراحی شده؛ سپند برای ادامه مسیر بعد از فروش هم ساخته شده است', false)
            ->assertSee('در فورواردری، فروش پایان فرایند نیست؛ شروع یک پرونده عملیاتی است.', false)
            ->assertSee('مشاهده مرکز مقایسه', false)
            ->assertSee('href="'.self::SITE_URL.'/compare"', false)
            ->assertSee('href="'.self::SITE_URL.'/compare/sepand-vs-other-transport-software"', false)
            ->assertSee('بعد از استقرار چه چیزهایی قابل اندازه‌گیری می‌شوند؟', false)
            ->assertSee('ارزش مالی هر مشتری', false)
            ->assertSee('تفاوت سپند را در خود نرم‌افزار ببینید', false)
            ->assertSee('سپند احتمالاً مناسب شماست اگر:', false)
            ->assertSee('سپند احتمالاً بیش از نیاز شماست اگر...', false)
            ->assertSee('مزیت اصلی سپند یک قابلیت نیست؛ اتصال فرایندها به یکدیگر است', false)
            ->assertSee('assets/images/marketing/modules/screenshots/pricing-sales-workflow.webp', false)
            ->assertSee('assets/images/marketing/modules/screenshots/finance-booking-reconciliation.webp', false)
            ->assertSee('assets/images/marketing/product-showcase/desktop-reports.webp', false)
            ->assertSee('"@type":"WebPage"', false)
            ->assertSee('"@type":"SoftwareApplication"', false)
            ->assertSee('"@type":"BreadcrumbList"', false);

        $this->assertSame(1, substr_count($content, '<h1'));
        $this->assertSame(4, substr_count($content, 'class="why-problem-card reveal"'));
        $this->assertSame(5, substr_count($content, 'class="why-pillar-card reveal"'));
        $this->assertSame(3, substr_count($content, 'class="why-evidence-card reveal"'));
        $this->assertStringNotContainsString('مقایسه روش‌های مختلف مدیریت شرکت حمل‌ونقل', $content);
        $this->assertStringNotContainsString('سپند برای حل چه مشکلاتی ساخته شده است؟', $content);
        $this->assertStringNotContainsString('<table', $content);
        $this->assertStringNotContainsString('Business Outcome', $content);
        $this->assertStringNotContainsString('Problem → Difference', $content);
        $this->assertStringNotContainsString('Shipment', $content);
        $this->assertStringNotContainsString('Follow-up', $content);
        $this->assertStringNotContainsString('Dashboard', $content);
        $this->assertStringNotContainsString('Feature', $content);
        $this->assertStringNotContainsString('<meta name="keywords"', strtolower($content));
        $this->assertStringNotContainsString('data-missing-screenshot=', $content);
        $this->assertStringNotContainsString('TODO', $content);
        $this->assertStringNotContainsString('<img src=""', $content);

        preg_match_all('/<script type="application\/ld\+json">(.*?)<\/script>/s', $content, $structuredData);
        $this->assertNotEmpty($structuredData[1]);

        foreach ($structuredData[1] as $json) {
            $this->assertIsArray(json_decode($json, true, 512, JSON_THROW_ON_ERROR));
        }
    }

    public function test_marketing_navigation_links_to_the_independent_why_sepand_page(): void
    {
        foreach (['/', '/product', '/modules'] as $path) {
            $this->get($path)
                ->assertOk()
                ->assertSee('href="'.self::SITE_URL.'/why-sepand"', false)
                ->assertSee('چرا سپند؟', false);
        }

        $this->get('/')
            ->assertOk()
            ->assertSee('id="why-us"', false);
    }

    public function test_why_sepand_page_is_in_sitemap_once_with_a_real_product_image(): void
    {
        $content = $this->get('/sitemap.xml')->assertOk()->getContent();

        $this->assertSame(1, substr_count($content, '<loc>'.self::SITE_URL.'/why-sepand</loc>'));
        $this->assertStringContainsString(
            '<image:loc>'.self::SITE_URL.'/assets/images/marketing/modules/screenshots/pricing-sales-workflow.webp</image:loc>',
            $content
        );
    }
}
