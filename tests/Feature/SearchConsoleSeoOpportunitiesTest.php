<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class SearchConsoleSeoOpportunitiesTest extends TestCase
{
    private const SITE_URL = 'https://sepandcrm.ir';

    private const PAGES = [
        '/modules/workflow-tasks' => ['نرم افزار مدیریت گردش کار حمل و نقل', 'گردش کار چیست و این ماژول چه کاری انجام می‌دهد؟'],
        '/solutions/bill-of-lading-management' => ['نرم افزار مدیریت بارنامه', 'صدور رسمی بارنامه جاده‌ای یا اتصال حاکمیتی در دامنه این صفحه ادعا نمی‌شود'],
        '/product' => ['نرم افزار سپند', 'این صفحه معرفی محصول و شواهد واقعی آن است'],
        '/modules/fleet-dispatch' => ['نرم افزار دیسپچ ناوگان', 'دیسپچ ناوگان چیست؟'],
        '/solutions/fleet-management' => ['نرم افزار مدیریت ناوگان حمل و نقل', 'این صفحه مالک Vehicle Master، Driver Profile، نگهداری، Compliance و Availability است'],
        '/modules/crm' => ['نرم افزار CRM حمل و نقل', 'نرم افزار CRM حمل و نقل چه تفاوتی با CRM عمومی دارد؟'],
        '/modules/booking' => ['نرم افزار بوکینگ حمل و نقل', 'Booking حمل چیست؟'],
        '/solutions/container-management' => ['نرم افزار مدیریت کانتینر', 'این صفحه مالک چرخه دارایی کانتینر است'],
        '/transport-modes/sea' => ['نرم افزار حمل دریایی', 'این صفحه مالک روش حمل دریایی است'],
        '/compare/best-transport-accounting-software' => ['بهترین نرم افزار حسابداری حمل و نقل', 'این صفحه راهنمای Shortlist و سناریوی دمو است'],
    ];

    protected function setUp(): void
    {
        parent::setUp();

        config(['app.url' => self::SITE_URL, 'marketing.site_url' => self::SITE_URL]);
        URL::forceRootUrl(self::SITE_URL);
        URL::forceScheme('https');
    }

    public function test_search_console_opportunity_pages_are_unique_indexable_and_intent_bounded(): void
    {
        $owners = [];
        foreach (config('site_seo_strategy.clusters') as $cluster) {
            foreach ($cluster['pages'] as $path => $definition) {
                $owners[$path] = $definition['query'];
            }
        }

        $titles = [];
        $headings = [];
        $descriptions = [];

        foreach (self::PAGES as $path => [$query, $boundaryMarker]) {
            $this->assertSame($query, $owners[$path] ?? null, "Unexpected query owner for {$path}");

            $content = $this->get($path)
                ->assertOk()
                ->assertSee('<meta name="robots" content="index,follow,max-image-preview:large">', false)
                ->assertSee('<link rel="canonical" href="'.self::SITE_URL.$path.'">', false)
                ->assertSee($boundaryMarker, false)
                ->getContent();

            preg_match('/<title>(.*?)<\/title>/s', $content, $title);
            preg_match('/<h1[^>]*>(.*?)<\/h1>/s', $content, $h1);
            preg_match('/<meta name="description" content="([^"]+)">/', $content, $description);

            $titles[$path] = trim(strip_tags($title[1] ?? ''));
            $headings[$path] = trim(preg_replace('/\s+/u', ' ', strip_tags($h1[1] ?? '')));
            $descriptions[$path] = html_entity_decode($description[1] ?? '', ENT_QUOTES | ENT_HTML5, 'UTF-8');

            $this->assertNotSame('', $titles[$path], $path);
            $this->assertNotSame('', $headings[$path], $path);
            $this->assertNotSame('', $descriptions[$path], $path);
            $this->assertSame(1, substr_count($content, '<h1'), $path);
        }

        $this->assertSame(count(self::PAGES), count(array_unique($titles)));
        $this->assertSame(count(self::PAGES), count(array_unique($headings)));
        $this->assertSame(count(self::PAGES), count(array_unique($descriptions)));
    }

    public function test_neighbouring_topics_keep_separate_keyword_owners_and_contextual_links(): void
    {
        $this->assertNotSame(
            config('site_modules.fleet-dispatch.primary_keyword'),
            config('site_seo_strategy.clusters.fleet.pages./solutions/fleet-management.query')
        );

        $this->assertNotContains('نرم افزار مدیریت کانتینر', config('site_transport_modes.sea.keywords'));

        $this->get('/transport-modes/sea')
            ->assertOk()
            ->assertSee('href="'.self::SITE_URL.'/solutions/container-management"', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/bill-of-lading-management"', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/nvocc"', false);
    }
}
