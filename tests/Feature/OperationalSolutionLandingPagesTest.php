<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class OperationalSolutionLandingPagesTest extends TestCase
{
    private const SITE_URL = 'https://sepandcrm.ir';

    protected function setUp(): void
    {
        parent::setUp();

        config(['app.url' => self::SITE_URL, 'marketing.site_url' => self::SITE_URL]);
        URL::forceRootUrl(self::SITE_URL);
        URL::forceScheme('https');
    }

    public function test_duplicate_control_tower_solution_redirects_directly_to_the_module_owner(): void
    {
        $path = '/solutions/operations-control-tower';
        $this->get($path)
            ->assertMovedPermanently()
            ->assertRedirect(self::SITE_URL.'/modules/operations-control-tower');
    }

    public function test_operational_workflow_page_has_templates_controls_and_scenario(): void
    {
        $path = '/solutions/operational-workflow-management';
        $content = $this->get($path)
            ->assertOk()
            ->assertSee('اجرای عملیات فورواردری را با چک‌لیست مرحله‌ای استاندارد کنید', false)
            ->assertSee('چک‌لیست اجرای رویه عملیاتی چگونه کار می‌کند؟', false)
            ->assertSee('الگوی رویه عملیاتی', false)
            ->assertSee('توقف اجباری', false)
            ->assertSee('مدرک انجام کار', false)
            ->assertSee('یک روز کاری با سپند', false)
            ->assertSee('از چک‌لیست عملیات تا برج کنترل', false)
            ->assertSee('href="'.self::SITE_URL.'/modules/operations-control-tower"', false)
            ->assertSee('href="'.self::SITE_URL.'/transport-modes/air"', false)
            ->assertSee('href="'.self::SITE_URL.'/transport-modes/road"', false)
            ->assertSee('href="'.self::SITE_URL.'/transport-modes/rail"', false)
            ->assertSee('<link rel="canonical" href="'.self::SITE_URL.$path.'">', false)
            ->assertSee('"@type":"FAQPage"', false)
            ->getContent();

        $this->assertSame(1, substr_count($content, '<h1'));
        $this->assertGreaterThanOrEqual(8, substr_count($content, '<h2'));
    }

    public function test_hub_navigation_footer_and_sitemap_only_discover_indexable_pages(): void
    {
        $hub = $this->get('/solutions')->assertOk();
        $sitemap = $this->get('/sitemap.xml')->assertOk()->getContent();

        foreach (array_keys(config('site_operational_landing_pages')) as $slug) {
            $url = self::SITE_URL.'/solutions/'.$slug;
            $hub->assertSee('href="'.$url.'"', false);
            $this->assertSame(1, substr_count($sitemap, '<loc>'.$url.'</loc>'));
        }
    }
}
