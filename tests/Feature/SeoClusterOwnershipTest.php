<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class SeoClusterOwnershipTest extends TestCase
{
    private const SITE_URL = 'https://sepandcrm.ir';

    protected function setUp(): void
    {
        parent::setUp();

        config(['app.url' => self::SITE_URL, 'marketing.site_url' => self::SITE_URL]);
        URL::forceRootUrl(self::SITE_URL);
        URL::forceScheme('https');
    }

    public function test_every_primary_query_has_exactly_one_indexable_owner(): void
    {
        $ownersByUrl = [];
        $ownersByQuery = [];

        foreach (config('site_seo_strategy.clusters') as $cluster => $definition) {
            $this->assertContains($definition['priority'], ['P0', 'P1']);
            $this->assertArrayHasKey($definition['pillar'], $definition['pages']);

            foreach ($definition['pages'] as $path => $owner) {
                $this->assertNotEmpty($owner['query']);
                $this->assertNotEmpty($owner['intent']);
                $this->assertNotEmpty($owner['audience']);
                $this->assertNotEmpty($owner['outcome']);

                if (isset($ownersByUrl[$path])) {
                    $this->assertSame($ownersByUrl[$path], $owner['query'], "Conflicting query owner for {$path}");
                }

                $ownersByUrl[$path] = $owner['query'];

                if (isset($ownersByQuery[$owner['query']])) {
                    $this->assertSame($ownersByQuery[$owner['query']], $path, "Query is owned by more than one URL: {$owner['query']}");
                }

                $ownersByQuery[$owner['query']] = $path;
            }
        }

        $this->assertGreaterThanOrEqual(25, count($ownersByUrl));
        $this->assertSame(count($ownersByUrl), count($ownersByQuery));
    }

    public function test_cluster_titles_h1s_and_snippets_are_unique(): void
    {
        foreach (config('site_seo_strategy.clusters') as $cluster => $definition) {
            $titles = [];
            $headings = [];
            $descriptions = [];

            foreach (array_keys($definition['pages']) as $path) {
                $content = $this->get($path)
                    ->assertOk()
                    ->assertSee('<link rel="canonical" href="'.self::SITE_URL.$path.'">', false)
                    ->getContent();

                preg_match('/<title>(.*?)<\/title>/s', $content, $title);
                preg_match('/<h1[^>]*>(.*?)<\/h1>/s', $content, $h1);
                preg_match('/<meta name="description" content="([^"]+)">/', $content, $description);

                $titles[] = trim(strip_tags($title[1] ?? ''));
                $headings[] = trim(preg_replace('/\s+/u', ' ', strip_tags($h1[1] ?? '')));
                $descriptions[] = html_entity_decode($description[1] ?? '', ENT_QUOTES | ENT_HTML5, 'UTF-8');
                $this->assertSame(1, substr_count($content, '<h1'), "Unexpected H1 count for {$path}");
            }

            $this->assertSame($titles, array_values(array_unique($titles)), "Duplicate title in {$cluster}");
            $this->assertSame($headings, array_values(array_unique($headings)), "Duplicate H1 in {$cluster}");
            $this->assertSame($descriptions, array_values(array_unique($descriptions)), "Duplicate description in {$cluster}");
        }
    }

    public function test_consolidated_urls_redirect_once_and_are_absent_from_sitemap_and_internal_links(): void
    {
        $sitemap = $this->get('/sitemap.xml')->assertOk()->getContent();
        $indexablePaths = collect(config('site_seo_strategy.clusters'))
            ->flatMap(fn (array $cluster): array => array_keys($cluster['pages']))
            ->unique()
            ->values();

        foreach (config('site_seo_strategy.redirects') as $legacyPath => $primaryPath) {
            $this->get($legacyPath)
                ->assertMovedPermanently()
                ->assertRedirect(self::SITE_URL.$primaryPath);

            $this->assertSame(0, substr_count($sitemap, '<loc>'.self::SITE_URL.$legacyPath.'</loc>'));
            $this->assertSame(1, substr_count($sitemap, '<loc>'.self::SITE_URL.$primaryPath.'</loc>'));

            foreach ($indexablePaths as $indexablePath) {
                $this->get($indexablePath)
                    ->assertOk()
                    ->assertDontSee('href="'.self::SITE_URL.$legacyPath.'"', false);
            }
        }
    }

    public function test_fleet_pages_have_distinct_intent_evidence_and_kpis(): void
    {
        $fleetManagement = $this->get('/solutions/fleet-management')
            ->assertOk()
            ->assertSee('Master Data، Driver Compliance و Availability', false)
            ->assertSee('live/fleet-compliance-control.png', false)
            ->assertSee('درصد آمادگی ناوگان', false);

        $fleetDispatch = $this->get('/modules/fleet-dispatch')
            ->assertOk()
            ->assertSee('دیسپچ اجرایی ناوگان', false)
            ->assertSee('modules/screenshots/operations-calendar-list.webp', false)
            ->assertSee('Start، Complete یا Cancel', false);

        $fleetPlanning = $this->get('/solutions/fleet-dispatch-planning')
            ->assertOk()
            ->assertSee('برنامه‌ریزی پیش از اعزام', false)
            ->assertSee('modules/screenshots/operations-calendar-month.webp', false)
            ->assertSee('Conflict-free Plan Rate', false);

        $this->assertNotSame(hash('sha256', $fleetManagement->getContent()), hash('sha256', $fleetDispatch->getContent()));
        $this->assertNotSame(hash('sha256', $fleetDispatch->getContent()), hash('sha256', $fleetPlanning->getContent()));
    }

    public function test_compare_pages_own_hub_category_general_and_vertical_selection_intents(): void
    {
        $this->get('/compare')
            ->assertOk()
            ->assertSee('مرکز مقایسه و راهنمای انتخاب نرم‌افزار حمل‌ونقل', false)
            ->assertSee('این صفحه هاب مسیریابی است', false);

        $this->get('/compare/sepand-vs-other-transport-software')
            ->assertOk()
            ->assertSee('مقایسه انواع نرم‌افزار حمل‌ونقل', false)
            ->assertSee('راهکار یکپارچه، TMS عملیاتی، CRM عمومی', false);

        $this->get('/compare/best-transport-software')
            ->assertOk()
            ->assertSee('نرم‌افزار مدیریت حمل‌ونقل را چگونه انتخاب کنیم؟', false);

        $this->get('/compare/best-freight-forwarding-software')
            ->assertOk()
            ->assertSee('راهنمای تخصصی Freight Forwarder', false);
    }
}
