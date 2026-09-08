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

    public function test_operations_control_tower_page_has_complete_content_and_seo_data(): void
    {
        $path = '/solutions/operations-control-tower';
        $content = $this->get($path)
            ->assertOk()
            ->assertSee('برج کنترل عملیات حمل‌ونقل؛ مرکز فرماندهی عملیات فورواردری', false)
            ->assertSee('یک نمای واحد از تمام عملیات حمل', false)
            ->assertSee('حرکت‌های امروز', false)
            ->assertSee('رسید تحویل ثبت‌نشده', false)
            ->assertSee('از پیگیری پراکنده تا فرماندهی یکپارچه', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/operational-workflow-management"', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/document-management"', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/schedule-management"', false)
            ->assertSee('<link rel="canonical" href="'.self::SITE_URL.$path.'">', false)
            ->assertSee('"@type":"FAQPage"', false)
            ->assertSee('"@type":"SoftwareApplication"', false)
            ->getContent();

        $this->assertSame(1, substr_count($content, '<h1'));
        $this->assertGreaterThanOrEqual(5, substr_count($content, '<h2'));
    }

    public function test_operational_workflow_page_has_templates_controls_and_scenario(): void
    {
        $path = '/solutions/operational-workflow-management';
        $content = $this->get($path)
            ->assertOk()
            ->assertSee('مدیریت گردش کار عملیات حمل‌ونقل؛ استانداردسازی فرایندهای فورواردری', false)
            ->assertSee('چک‌لیست هوشمند عملیات چگونه کار می‌کند؟', false)
            ->assertSee('گردش کار الگومحور', false)
            ->assertSee('توقف اجباری', false)
            ->assertSee('مدرک انجام کار', false)
            ->assertSee('یک روز کاری با سپند', false)
            ->assertSee('از چک‌لیست عملیات تا برج کنترل', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/operations-control-tower"', false)
            ->assertSee('href="'.self::SITE_URL.'/transport-modes/air"', false)
            ->assertSee('href="'.self::SITE_URL.'/transport-modes/road"', false)
            ->assertSee('href="'.self::SITE_URL.'/transport-modes/rail"', false)
            ->assertSee('<link rel="canonical" href="'.self::SITE_URL.$path.'">', false)
            ->assertSee('"@type":"FAQPage"', false)
            ->getContent();

        $this->assertSame(1, substr_count($content, '<h1'));
        $this->assertGreaterThanOrEqual(8, substr_count($content, '<h2'));
    }

    public function test_hub_navigation_footer_and_sitemap_discover_both_pages(): void
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
