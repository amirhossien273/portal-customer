<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class ComparisonLandingPageTest extends TestCase
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

    public function test_transport_software_vs_excel_is_a_scannable_comparison_landing_page(): void
    {
        $path = '/compare/transport-software-vs-excel';
        $response = $this->get($path)->assertOk();
        $content = $response->getContent();

        $response
            ->assertSee('<title>نرم‌افزار حمل‌ونقل یا Excel؟ مقایسه کاربردی | سپند</title>', false)
            ->assertSee('<meta name="description" content="مقایسه نرم‌افزار تخصصی حمل‌ونقل با Excel از نظر یکپارچگی، خطا، گزارش‌گیری، امنیت و رشد؛ ببینید کدام گزینه برای شرکت شما مناسب‌تر است.">', false)
            ->assertSee('<link rel="canonical" href="'.self::SITE_URL.$path.'">', false)
            ->assertSee('<meta name="robots" content="index,follow,max-image-preview:large">', false)
            ->assertSee('نرم‌افزار تخصصی حمل‌ونقل یا Excel؛', false)
            ->assertSee('تفاوت اصلی در «ثبت داده» و «مدیریت فرایند» است', false)
            ->assertSee('نرم‌افزار تخصصی حمل‌ونقل سپند', false)
            ->assertSee('Microsoft Excel', false)
            ->assertSee('<table class="comparison-table">', false)
            ->assertSee('CRM، لید و استعلام', false)
            ->assertSee('پیامک و سابقه ارتباطات', false)
            ->assertSee('کدام گزینه برای شما', false)
            ->assertSee('در نهایت کدام را انتخاب کنیم؟', false)
            ->assertSee('درخواست مشاوره', false);

        $this->assertSame(1, substr_count($content, '<h1'));
        $this->assertStringNotContainsString('noindex', strtolower($content));
    }

    public function test_comparison_page_has_valid_structured_data_and_real_internal_links(): void
    {
        $response = $this->get('/compare/transport-software-vs-excel')->assertOk();
        $content = $response->getContent();

        foreach ([
            '/modules',
            '/modules/crm',
            '/modules/transport-operations',
            '/pricing',
            '/consultation',
        ] as $path) {
            $response->assertSee('href="'.self::SITE_URL.$path.'"', false);
        }

        $response
            ->assertSee('"@type":"WebPage"', false)
            ->assertSee('"@type":"BreadcrumbList"', false)
            ->assertSee('"@type":"FAQPage"', false);

        preg_match_all('/<script type="application\/ld\+json">(.*?)<\/script>/s', $content, $structuredData);
        $this->assertNotEmpty($structuredData[1]);

        foreach ($structuredData[1] as $json) {
            $this->assertIsArray(json_decode($json, true, 512, JSON_THROW_ON_ERROR));
        }
    }

    public function test_comparison_page_is_present_once_in_the_sitemap(): void
    {
        $location = '<loc>'.self::SITE_URL.'/compare/transport-software-vs-excel</loc>';
        $content = $this->get('/sitemap.xml')->assertOk()->getContent();

        $this->assertSame(1, substr_count($content, $location));
    }
}
