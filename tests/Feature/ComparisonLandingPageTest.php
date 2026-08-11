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
            ->assertSee('<title>سپند یا نرم‌افزارهای دیگر حمل‌ونقل؟ مقایسه | سپند</title>', false)
            ->assertSee('<meta name="description" content="مقایسه سپند با نرم‌افزارهای دیگر بازار از نظر تخصص حمل، یکپارچگی CRM تا مالی، بازاریابی پیامکی، پرتال مشتریان و استقرار.">', false)
            ->assertSee('<link rel="canonical" href="'.self::SITE_URL.self::COMPARISON_PATH.'">', false)
            ->assertSee('<meta name="robots" content="index,follow,max-image-preview:large">', false)
            ->assertSee('سپند یا نرم‌افزارهای دیگر؛', false)
            ->assertSee('تفاوت اصلی در دامنه تخصص و میزان یکپارچگی است', false)
            ->assertSee('نرم‌افزار تخصصی حمل‌ونقل سپند', false)
            ->assertSee('نرم‌افزارهای دیگر', false)
            ->assertSee('<table class="comparison-table">', false)
            ->assertSee('CRM، لید و استعلام', false)
            ->assertSee('پیامک و سابقه ارتباطات', false)
            ->assertSee('پرتال مشتری و رهگیری', false)
            ->assertSee('کدام گزینه برای شما', false)
            ->assertSee('در نهایت کدام را انتخاب کنیم؟', false)
            ->assertSee('درخواست مشاوره', false);

        $this->assertSame(1, substr_count($content, '<h1'));
        $this->assertStringNotContainsString('noindex', strtolower($content));
        $this->assertStringNotContainsString('Microsoft Excel', $content);
    }

    public function test_comparison_page_has_valid_structured_data_and_real_internal_links(): void
    {
        $response = $this->get(self::COMPARISON_PATH)->assertOk();
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
