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
        'operational-control-center' => [
            'h1' => 'مرکز کنترل عملیات',
            'solution' => '/solutions/operation-exception-management',
        ],
        'enterprise-command-center' => [
            'h1' => 'مرکز فرمان سازمانی',
            'solution' => '/solutions/transport-governance',
        ],
        'document-checklists' => [
            'h1' => 'چک‌لیست استاندارد اسناد',
            'solution' => '/solutions/document-readiness',
        ],
        'fleet-dispatch' => [
            'h1' => 'دیسپچ و تخصیص ناوگان',
            'solution' => '/solutions/fleet-dispatch-planning',
        ],
    ];

    private const SOLUTIONS = [
        'shipment-visibility' => [
            'h1' => 'وضعیت جاری محموله‌ها را بدون گزارش‌گیری دستی ببینید',
            'module' => '/modules/operations-control-tower',
            'anchor' => 'نرم‌افزار برج کنترل عملیات حمل',
        ],
        'operation-exception-management' => [
            'h1' => 'هشدار عملیاتی را به اقدام دارای مسئول و نتیجه تبدیل کنید',
            'module' => '/modules/operational-control-center',
            'anchor' => 'نرم‌افزار مدیریت استثناهای عملیات حمل',
        ],
        'transport-governance' => [
            'h1' => 'تصمیم‌های ریسک، تعهد و سود را میان واحدها هماهنگ کنید',
            'module' => '/modules/enterprise-command-center',
            'anchor' => 'مرکز فرمان سازمانی شرکت حمل‌ونقل',
        ],
        'document-readiness' => [
            'h1' => 'کامل‌بودن مدارک هر پرونده را پیش از نقطه حساس کنترل کنید',
            'module' => '/modules/document-checklists',
            'anchor' => 'چک‌لیست استاندارد اسناد حمل',
        ],
        'fleet-dispatch-planning' => [
            'h1' => 'اعزام خودرو و راننده را با ظرفیت و محدودیت واقعی برنامه‌ریزی کنید',
            'module' => '/modules/fleet-dispatch',
            'anchor' => 'نرم‌افزار دیسپچ ناوگان حمل',
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

        $this->assertCount(10, $targets);
        $this->assertCount(10, $targets->keys()->unique());

        foreach (self::MODULES as $slug => $_) {
            $module = config('site_modules.'.$slug);
            $this->assertSame($module['primary_keyword'], $module['keywords'][0]);
            $this->assertNotEmpty($module['search_intent']);
        }
    }

    public function test_navigation_footer_and_sitemap_link_every_new_page(): void
    {
        $home = $this->get('/')->assertOk();
        $sitemap = $this->get('/sitemap.xml')->assertOk()->getContent();

        foreach (self::SOLUTIONS as $slug => $_) {
            $url = self::SITE_URL.'/solutions/'.$slug;
            $home->assertSee('href="'.$url.'"', false);
            $this->assertSame(1, substr_count($sitemap, '<loc>'.$url.'</loc>'));
        }

        foreach (self::MODULES as $slug => $_) {
            $url = self::SITE_URL.'/modules/'.$slug;
            $this->assertSame(1, substr_count($sitemap, '<loc>'.$url.'</loc>'));
        }
    }
}
