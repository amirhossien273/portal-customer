<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class OperationalMarketingPagesTest extends TestCase
{
    private const SITE_URL = 'https://sepandcrm.ir';

    private const MODULES = [
        'operations-control-tower' => [
            'h1' => 'برج کنترل عملیات حمل',
            'solution' => '/solutions/shipment-visibility',
        ],
        'fleet-dispatch' => [
            'h1' => 'دیسپچ اجرایی ناوگان',
            'solution' => '/solutions/fleet-dispatch-planning',
        ],
    ];

    private const SOLUTIONS = [
        'shipment-visibility' => [
            'h1' => 'دیدپذیری داخلی محموله؛ وضعیت و Milestone معتبر برای اقدام',
            'module' => '/modules/operations-control-tower',
            'anchor' => 'برج کنترل عملیات حمل',
        ],
        'operation-exception-management' => [
            'h1' => 'هشدار عملیاتی را به اقدام دارای مسئول و نتیجه تبدیل کنید',
            'module' => '/solutions/operations-automation',
            'anchor' => 'اتوماسیون عملیات سپند',
        ],
        'transport-governance' => [
            'h1' => 'تصمیم‌های ریسک، تعهد و سود را میان واحدها هماهنگ کنید',
            'module' => '/modules/operations-control-tower',
            'anchor' => 'برج کنترل عملیات سپند',
        ],
        'document-readiness' => [
            'h1' => 'آمادگی اسناد حمل؛ پرونده کامل پیش از نقطه حساس',
            'module' => '/modules/document-management',
            'anchor' => 'ماژول مدیریت اسناد حمل',
        ],
        'fleet-dispatch-planning' => [
            'h1' => 'برنامه‌ریزی پیش از اعزام؛ ظرفیت و Assignment بدون تداخل',
            'module' => '/modules/fleet-dispatch',
            'anchor' => 'دیسپچ و تخصیص ناوگان سپند',
        ],
    ];

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

    public function test_operational_capabilities_are_listed_as_full_module_pages(): void
    {
        $index = $this->get('/modules')->assertOk();

        foreach (self::MODULES as $slug => $expected) {
            $path = '/modules/'.$slug;
            $index->assertSee('href="'.self::SITE_URL.$path.'"', false);

            $content = $this->get($path)
                ->assertOk()
                ->assertSee($expected['h1'], false)
                ->assertSee('href="'.self::SITE_URL.$expected['solution'].'"', false)
                ->assertSee('<link rel="canonical" href="'.self::SITE_URL.$path.'">', false)
                ->assertSee('"@type":"SoftwareApplication"', false)
                ->assertDontSee('<meta name="keywords"', false)
                ->getContent();

            $this->assertSame(1, substr_count($content, '<h1'));
        }
    }

    public function test_each_operational_solution_has_unique_content_and_keyword_rich_links(): void
    {
        $titles = [];
        $descriptions = [];

        foreach (self::SOLUTIONS as $slug => $expected) {
            $path = '/solutions/'.$slug;
            $response = $this->get($path)->assertOk();
            $content = $response->getContent();

            $response
                ->assertSee($expected['h1'], false)
                ->assertSee('href="'.self::SITE_URL.$expected['module'].'"', false)
                ->assertSee($expected['anchor'], false)
                ->assertSee('id="boundaries-section"', false)
                ->assertSee('"@type":"FAQPage"', false)
                ->assertSee('<link rel="canonical" href="'.self::SITE_URL.$path.'">', false)
                ->assertDontSee('<meta name="keywords"', false);

            preg_match('/<title>(.*?)<\/title>/s', $content, $title);
            preg_match('/<meta name="description" content="([^"]+)">/', $content, $description);
            $titles[] = $title[1] ?? '';
            $descriptions[] = html_entity_decode($description[1] ?? '', ENT_QUOTES | ENT_HTML5, 'UTF-8');

            $this->assertSame(1, substr_count($content, '<h1'));
            $this->assertGreaterThanOrEqual(10, substr_count($content, '<h2'));
        }

        $this->assertSame($titles, array_values(array_unique($titles)));
        $this->assertSame($descriptions, array_values(array_unique($descriptions)));
    }

    public function test_new_keyword_targets_do_not_overlap(): void
    {
        $moduleTargets = collect(self::MODULES)
            ->keys()
            ->mapWithKeys(fn (string $slug): array => [
                config('site_modules.'.$slug.'.primary_keyword') => 'module:'.$slug,
            ]);
        $solutionTargets = collect(config('site_operational_solutions.keywords'))
            ->mapWithKeys(fn (array $keywords, string $slug): array => [$keywords[0] => 'solution:'.$slug]);
        $targets = $moduleTargets->merge($solutionTargets);

        $this->assertCount(7, $targets);
        $this->assertCount(7, $targets->keys()->unique());

        foreach (self::MODULES as $slug => $_) {
            $module = config('site_modules.'.$slug);
            $this->assertSame($module['primary_keyword'], $module['keywords'][0]);
            $this->assertNotEmpty($module['search_intent']);
        }
    }

    public function test_navigation_footer_and_sitemap_link_every_new_page(): void
    {
        $home = $this->get('/')->assertOk()
            ->assertSee('href="'.self::SITE_URL.'/solutions"', false);
        $hub = $this->get('/solutions')->assertOk();
        $sitemap = $this->get('/sitemap.xml')->assertOk()->getContent();

        foreach (self::SOLUTIONS as $slug => $_) {
            $url = self::SITE_URL.'/solutions/'.$slug;
            $hub->assertSee('href="'.$url.'"', false);
            $this->assertSame(1, substr_count($sitemap, '<loc>'.$url.'</loc>'));
        }

        foreach (self::MODULES as $slug => $_) {
            $url = self::SITE_URL.'/modules/'.$slug;
            $this->assertSame(1, substr_count($sitemap, '<loc>'.$url.'</loc>'));
        }

        foreach (config('site_seo_strategy.redirects') as $legacyPath => $primaryPath) {
            $this->assertSame(0, substr_count($sitemap, '<loc>'.self::SITE_URL.$legacyPath.'</loc>'));
            $this->get($legacyPath)
                ->assertMovedPermanently()
                ->assertRedirect(self::SITE_URL.$primaryPath);
        }
    }
}
