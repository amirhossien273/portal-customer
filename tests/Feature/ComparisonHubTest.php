<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class ComparisonHubTest extends TestCase
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

    public function test_comparison_hub_links_to_every_cluster_page(): void
    {
        $response = $this->get('/compare')->assertOk();
        $content = $response->getContent();

        $response
            ->assertSee('<title>مقایسه نرم‌افزارهای حمل‌ونقل بین‌المللی | سپند</title>', false)
            ->assertSee('<link rel="canonical" href="'.self::SITE_URL.'/compare">', false)
            ->assertSee('مقایسه نرم‌افزار سپند با سایر نرم‌افزارهای حمل‌ونقل', false)
            ->assertSee('سپند در برابر رویان', false)
            ->assertSee('سپند در برابر سبا سیستم', false)
            ->assertSee('سپند در برابر سایر نرم‌افزارهای حمل‌ونقل', false)
            ->assertSee('بهترین نرم‌افزار حمل‌ونقل بین‌المللی', false)
            ->assertSee('"@type":"CollectionPage"', false)
            ->assertSee('"@type":"BreadcrumbList"', false)
            ->assertSee('"@type":"ItemList"', false)
            ->assertSee('"@type":"FAQPage"', false);

        foreach ($this->clusterPaths() as $path) {
            $response->assertSee('href="'.self::SITE_URL.$path.'"', false);
        }

        $this->assertSame(1, substr_count($content, '<h1'));
        $this->assertValidJsonLd($content);
    }

    public function test_competitor_pages_are_neutral_complete_and_internally_linked(): void
    {
        $pages = [
            '/compare/sepand-vs-royan' => [
                'title' => 'مقایسه نرم‌افزار سپند و رویان | راهنمای بی‌طرفانه انتخاب',
                'h1' => 'مقایسه نرم‌افزار سپند و رویان برای شرکت‌های حمل‌ونقل بین‌المللی',
                'competitor' => 'رویان',
            ],
            '/compare/sepand-vs-saba' => [
                'title' => 'مقایسه سپند و سبا سیستم | راهنمای بی‌طرفانه انتخاب',
                'h1' => 'مقایسه سپند و سبا سیستم؛ کدام نرم‌افزار برای شرکت حمل‌ونقل مناسب‌تر است؟',
                'competitor' => 'سبا سیستم',
            ],
        ];
        $capabilities = ['CRM', 'مدیریت مشتری', 'مدیریت استعلام', 'نرخ‌دهی', 'Booking', 'عملیات حمل', 'مدیریت اسناد', 'امور مالی', 'Workflow و Task', 'پرتال مشتری', 'حمل دریایی', 'حمل هوایی', 'حمل زمینی', 'حمل ریلی', 'گزارش‌گیری', 'قیمت و نحوه استقرار'];
        $internalPaths = ['/modules/crm', '/modules/pricing-sales', '/modules/booking', '/modules/transport-operations', '/modules/document-management', '/modules/finance-accounting', '/modules/workflow-tasks', '/modules/customer-portal-tracking', '/pricing', '/consultation'];

        foreach ($pages as $path => $expected) {
            $response = $this->get($path)->assertOk();
            $content = $response->getContent();

            $response
                ->assertSee('<title>'.$expected['title'].'</title>', false)
                ->assertSee('<link rel="canonical" href="'.self::SITE_URL.$path.'">', false)
                ->assertSee($expected['h1'], false)
                ->assertSee('نیازمند بررسی', false)
                ->assertSee('اطلاعات عمومی قابل تأیید', false)
                ->assertSee('تفاوت اصلی سپند و '.$expected['competitor'].' چیست؟', false)
                ->assertSee('سپند برای چه شرکت‌هایی مناسب‌تر است؟', false)
                ->assertSee($expected['competitor'].' برای چه شرکت‌هایی مناسب‌تر است؟', false)
                ->assertSee('قیمت، نحوه استقرار و چک‌لیست دموی مقایسه‌ای', false)
                ->assertSee('درخواست دمو سپند', false)
                ->assertSee('"@type":"WebPage"', false)
                ->assertSee('"@type":"BreadcrumbList"', false)
                ->assertSee('"@type":"FAQPage"', false);

            foreach ($capabilities as $capability) {
                $response->assertSee($capability, false);
            }

            foreach ([...$this->clusterPaths(), ...$internalPaths] as $internalPath) {
                $response->assertSee('href="'.self::SITE_URL.$internalPath.'"', false);
            }

            $this->assertSame(1, substr_count($content, '<h1'));
            $this->assertStringNotContainsString($expected['competitor'].' ضعیف', $content);
            $this->assertStringNotContainsString($expected['competitor'].' ندارد', $content);
            $this->assertStringNotContainsString('سپند بهترین است', $content);
            $this->assertValidJsonLd($content);
        }
    }

    public function test_best_transport_software_page_supports_commercial_investigation_intent(): void
    {
        $response = $this->get('/compare/best-transport-software')->assertOk();
        $content = $response->getContent();

        $response
            ->assertSee('<title>بهترین نرم‌افزار حمل‌ونقل بین‌المللی | راهنمای انتخاب</title>', false)
            ->assertSee('<link rel="canonical" href="'.self::SITE_URL.'/compare/best-transport-software">', false)
            ->assertSee('بهترین نرم‌افزار حمل‌ونقل بین‌المللی را چگونه انتخاب کنیم؟', false)
            ->assertSee('هشت معیار برای ارزیابی نرم‌افزار حمل‌ونقل', false)
            ->assertSee('دمو را از Lead تا سود پرونده اجرا کنید', false)
            ->assertSee('قیمت پایین‌تر الزاماً هزینه کل کمتر نیست', false)
            ->assertSee('"@type":"BreadcrumbList"', false)
            ->assertSee('"@type":"FAQPage"', false);

        foreach ($this->clusterPaths() as $path) {
            $response->assertSee('href="'.self::SITE_URL.$path.'"', false);
        }

        $this->assertSame(1, substr_count($content, '<h1'));
        $this->assertValidJsonLd($content);
    }

    public function test_every_comparison_url_is_present_once_in_sitemap(): void
    {
        $content = $this->get('/sitemap.xml')->assertOk()->getContent();

        foreach (['/compare', ...$this->clusterPaths()] as $path) {
            $this->assertSame(1, substr_count($content, '<loc>'.self::SITE_URL.$path.'</loc>'));
        }
    }

    private function clusterPaths(): array
    {
        return [
            '/compare/sepand-vs-royan',
            '/compare/sepand-vs-saba',
            '/compare/sepand-vs-other-transport-software',
            '/compare/best-transport-software',
        ];
    }

    private function assertValidJsonLd(string $content): void
    {
        preg_match_all('/<script type="application\/ld\+json">(.*?)<\/script>/s', $content, $structuredData);
        $this->assertNotEmpty($structuredData[1]);

        foreach ($structuredData[1] as $json) {
            $this->assertIsArray(json_decode($json, true, 512, JSON_THROW_ON_ERROR));
        }
    }
}
