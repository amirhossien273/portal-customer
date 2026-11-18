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

        config(['app.url' => self::SITE_URL, 'marketing.site_url' => self::SITE_URL]);
        URL::forceRootUrl(self::SITE_URL);
        URL::forceScheme('https');
    }

    public function test_why_sepand_page_supports_evidence_based_purchase_evaluation(): void
    {
        $response = $this->get('/why-sepand')->assertOk();
        $content = $response->getContent();
        $consultationUrl = self::SITE_URL.'/consultation?source_page='.rawurlencode(self::SITE_URL.'/why-sepand');

        $response
            ->assertSee('<title>چرا سپند؟ | مزایای نرم‌افزار سپند برای شرکت‌های فورواردری</title>', false)
            ->assertSee('<meta name="description" content="ببینید سپند چطور پیگیری استعلام، تبدیل نرخ به Booking و ثبت دریافت و پرداخت هر پرونده حمل را به هم متصل می‌کند. تصاویر محصول و نمونه کاربرد واقعی را ببینید.">', false)
            ->assertSee('<meta property="og:title" content="چرا سپند؟ | مزایای نرم‌افزار سپند برای شرکت‌های فورواردری">', false)
            ->assertSee('<meta name="twitter:title" content="چرا سپند؟ | مزایای نرم‌افزار سپند برای شرکت‌های فورواردری">', false)
            ->assertSee('<link rel="canonical" href="'.self::SITE_URL.'/why-sepand">', false)
            ->assertSee('<meta name="robots" content="index,follow,max-image-preview:large">', false)
            ->assertSee('<h1 id="why-sepand-title">چرا سپند برای شرکت‌های فورواردری؟</h1>', false)
            ->assertSee('در سپند می‌توانید ببینید کدام استعلام منتظر پیگیری است', false)
            ->assertSee('href="'.$consultationUrl.'"', false)
            ->assertSee('data-ga-label="why_hero_consultation"', false)
            ->assertSee('data-ga-label="why_bottom_consultation"', false)
            ->assertSee('href="#product-evidence"', false)
            ->assertSee('id="product-evidence"', false)
            ->assertSee('سه نمای مستقل برای ارزیابی مسیر استعلام تا مالی', false)
            ->assertSee('به ستون‌های «استعلام قیمت از تأمین‌کننده»', false)
            ->assertSee('مبلغ Offer، پرداخت تأییدشده، دریافت تأییدشده', false)
            ->assertSee('این تصویر روند حجمی را نشان می‌دهد', false)
            ->assertSee('به‌عنوان مراحل ثبت‌شده یک پرونده واحد معرفی نمی‌شوند', false)
            ->assertSee('assets/images/marketing/modules/screenshots/pricing-sales-workflow.webp', false)
            ->assertSee('assets/images/marketing/modules/screenshots/finance-booking-reconciliation.webp', false)
            ->assertSee('assets/images/marketing/product-showcase/desktop-reports.webp', false)
            ->assertSee('مشاهده در یک مقطع زمانی', false)
            ->assertSee('۷ مورد نیازمند اقدام', false)
            ->assertSee('۳ پیگیری عقب‌افتاده و ۴ استعلام بدون اقدام بعدی', false)
            ->assertSee('href="'.self::SITE_URL.'/customers/case-studies/operational-control-snapshot"', false)
            ->assertSee('شاخص‌هایی که می‌توانید قبل و بعد از استقرار بسنجید', false)
            ->assertSee('استعلام بدون اقدام بعدی', false)
            ->assertSee('ثبت دوباره اطلاعات', false)
            ->assertSee('زمان دسترسی به وضعیت پرونده', false)
            ->assertSee('در دموی سپند چه چیزهایی را بررسی کنید؟', false)
            ->assertSee('مقایسه TMS، CRM و نرم‌افزار مالی برای شرکت حمل', false)
            ->assertSee('href="'.self::SITE_URL.'/compare/sepand-vs-other-transport-software"', false)
            ->assertSee('href="'.self::SITE_URL.'/compare"', false)
            ->assertSee('سپند برای چه شرکت‌هایی مناسب است؟', false)
            ->assertSee('href="'.self::SITE_URL.'/pricing"', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/on-premise"', false)
            ->assertSee('href="'.self::SITE_URL.'/product"', false)
            ->assertSee('href="'.self::SITE_URL.'/about"', false)
            ->assertSee('href="'.self::SITE_URL.'">نرم‌افزار حمل‌ونقل بین‌المللی</a>', false)
            ->assertSee('"@type":"WebPage"', false)
            ->assertSee('"headline":"چرا سپند برای شرکت‌های فورواردری؟"', false)
            ->assertSee('"publisher":{"@id":"'.self::SITE_URL.'#organization"}', false)
            ->assertSee('"@type":"BreadcrumbList"', false)
            ->assertDontSee('این موضوع در کدام بخش فرایند ادامه پیدا می‌کند؟', false);

        $this->assertSame(1, substr_count($content, '<h1'));
        $this->assertStringContainsString('<html lang="fa" dir="rtl">', $content);
        $this->assertLessThan(strpos($content, 'id="problems-title"'), strpos($content, 'id="product-evidence"'));
        $this->assertSame(3, substr_count($content, 'class="why-evidence-card reveal"'));
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
            $this->get($path)->assertOk()->assertSee('href="'.self::SITE_URL.'/why-sepand"', false)->assertSee('چرا سپند؟', false);
        }

        $this->get('/')->assertOk()->assertSee('id="why-us"', false);
    }

    public function test_why_sepand_page_is_in_sitemap_once_with_a_real_product_image(): void
    {
        $content = $this->get('/sitemap.xml')->assertOk()->getContent();

        $this->assertSame(1, substr_count($content, '<loc>'.self::SITE_URL.'/why-sepand</loc>'));
        $this->assertStringContainsString('<image:loc>'.self::SITE_URL.'/assets/images/marketing/modules/screenshots/pricing-sales-workflow.webp</image:loc>', $content);
    }
}
