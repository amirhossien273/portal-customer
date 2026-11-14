<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class TruckMovementPlanningSolutionTest extends TestCase
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

    public function test_page_explains_split_truck_supply_scenario_with_unique_search_intent(): void
    {
        $response = $this->get('/solutions/truck-movement-planning')->assertOk();
        $content = $response->getContent();

        $response
            ->assertSee('<title>برنامه حرکت و اعزام کامیون؛ تأمین مرحله‌ای ظرفیت | سپند</title>', false)
            ->assertSee('<meta name="description" content="راهکار برنامه حرکت کامیون در سپند برای ثبت نیاز کل بار، تعهد مرحله‌ای تأمین‌کننده، تقسیم اعزام به چند موج و کنترل ظرفیت باقی‌مانده.">', false)
            ->assertSee('<link rel="canonical" href="'.self::SITE_URL.'/solutions/truck-movement-planning">', false)
            ->assertSee('<h1>برنامه حرکت و اعزام کامیون؛ وقتی ظرفیت در چند نوبت تأمین می‌شود</h1>', false)
            ->assertSee('۱۰ کامیون موردنیاز؛ ۵ دستگاه امروز و ۵ دستگاه فردا', false)
            ->assertSee('ظرفیت تأییدشده', false)
            ->assertSee('تعهد آتی تأمین‌کننده', false)
            ->assertSee('مانده ظرفیت', false)
            ->assertSee('Supplier Commitment؛ تعهد ظرفیت', false)
            ->assertSee('Movement Wave؛ موج حرکت', false)
            ->assertSee('نرخ پوشش تقاضای حمل', false)
            ->assertSee('درخواست دموی برنامه حرکت', false)
            ->assertSee('id="operational-scenario-section"', false)
            ->assertSee('assets/images/marketing/modules/screenshots/operations-calendar-month.webp', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/fleet-dispatch-planning"', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/supplier-management"', false)
            ->assertSee('href="'.self::SITE_URL.'/transport-modes/road"', false)
            ->assertSee('href="'.self::SITE_URL.'/modules/transport-operations"', false)
            ->assertSee('"@type":"WebPage"', false)
            ->assertSee('"@type":"BreadcrumbList"', false)
            ->assertSee('"@type":"FAQPage"', false)
            ->assertDontSee('noindex', false);

        $this->assertSame(1, substr_count($content, '<h1'));
        $this->assertGreaterThanOrEqual(11, substr_count($content, '<h2'));
        $this->assertGreaterThan(7000, mb_strlen(strip_tags($content)));
        $this->assertValidJsonLd($content);
    }

    public function test_page_is_discoverable_from_solution_hub_related_pages_and_sitemap(): void
    {
        $path = '/solutions/truck-movement-planning';

        $this->get('/solutions')
            ->assertOk()
            ->assertSee('href="'.self::SITE_URL.$path.'"', false)
            ->assertSee('برنامه حرکت کامیون', false);

        foreach (['/solutions/fleet-management', '/solutions/fleet-dispatch-planning', '/solutions/supplier-management', '/transport-modes/road'] as $sourcePath) {
            $this->get($sourcePath)
                ->assertOk()
                ->assertSee('href="'.self::SITE_URL.$path.'"', false);
        }

        $sitemap = $this->get('/sitemap.xml')->assertOk()->getContent();
        $this->assertSame(1, substr_count($sitemap, '<loc>'.self::SITE_URL.$path.'</loc>'));
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
