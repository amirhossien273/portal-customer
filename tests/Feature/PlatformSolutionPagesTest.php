<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class PlatformSolutionPagesTest extends TestCase
{
    private const SITE_URL = 'https://sepandcrm.ir';

    private const PAGES = [
        'operations-automation' => 'اتوماسیون عملیات حمل‌ونقل؛ از سیگنال تا اقدام قابل پیگیری',
        'freight-finance' => 'مدیریت مالی حمل‌ونقل؛ از هزینه تعهدی تا سود واقعی پرونده',
        'fleet-management' => 'مدیریت ناوگان؛ آمادگی خودرو و راننده پیش از تصمیم اعزام',
        'document-management' => 'چرخه تأیید اسناد حمل را از Draft تا نسخه نهایی کنترل کنید',
        'multimodal-transport' => 'مدیریت حمل چندوجهی؛ یک Journey، چند Leg هماهنگ',
        'schedule-management' => 'مدیریت برنامه حرکت؛ یک مرجع برای ETD، ETA و تغییرات',
        'rate-management' => 'مدیریت نرخ حمل؛ محاسبه یکسان، معتبر و قابل ردیابی',
        'security-access-management' => 'امنیت و مدیریت دسترسی؛ هر کاربر فقط در دامنه مسئولیت خودش',
        'payment-workflow' => 'درخواست پرداخت تا پرداخت نهایی؛ یک زنجیره کنترل‌شده و قابل ردیابی',
        'booking-reconciliation' => 'دریافت و تطبیق مالی Booking؛ هر مبلغ با منشأ و مصرف روشن',
        'supplier-management' => 'Supplier Master و مقایسه تأمین‌کنندگان؛ انتخاب بر پایه نرخ و توان اجرا',
    ];

    protected function setUp(): void
    {
        parent::setUp();

        config(['app.url' => self::SITE_URL, 'marketing.site_url' => self::SITE_URL]);
        URL::forceRootUrl(self::SITE_URL);
        URL::forceScheme('https');
    }

    public function test_platform_solution_hub_links_every_page(): void
    {
        $response = $this->get('/solutions')
            ->assertOk()
            ->assertSee('<link rel="canonical" href="'.self::SITE_URL.'/solutions">', false)
            ->assertSee('از گلوگاه عملیاتی', false)
            ->assertSee('راهنمای انتخاب راهکار', false)
            ->assertSee('data-solution-finder', false)
            ->assertSee('یک پرونده؛ شش نقطه تصمیم متصل', false)
            ->assertSee('Product Evidence', false)
            ->assertSee('"@type":"CollectionPage"', false);

        foreach (array_keys(self::PAGES) as $slug) {
            $response->assertSee('href="'.self::SITE_URL.'/solutions/'.$slug.'"', false);
        }
    }

    public function test_solution_hub_covers_filters_evidence_and_every_specialized_scenario(): void
    {
        $response = $this->get('/solutions')->assertOk();

        foreach (array_keys(config('site_platform_solutions.hub.categories')) as $category) {
            $response->assertSee('data-solution-filter="'.$category.'"', false);
        }

        foreach (config('site_platform_solutions.hub.evidence') as $evidence) {
            $response->assertSee($evidence['title'], false);
            $this->assertFileExists(public_path('assets/images/marketing/'.$evidence['image']));
        }

        foreach (config('site_content_pages.solutions') as $solution) {
            $response->assertSee('href="'.route($solution['route']).'"', false);
        }
    }

    public function test_every_platform_solution_has_unique_seo_product_evidence_and_operational_depth(): void
    {
        $titles = [];
        $descriptions = [];

        foreach (self::PAGES as $slug => $h1) {
            $path = '/solutions/'.$slug;
            $content = $this->get($path)
                ->assertOk()
                ->assertSee($h1, false)
                ->assertSee('<link rel="canonical" href="'.self::SITE_URL.$path.'">', false)
                ->assertSee('Product Evidence', false)
                ->assertSee('Operational Depth', false)
                ->assertSee('دامنه و کاربرد راهکار', false)
                ->assertSee('"@type":"SoftwareApplication"', false)
                ->assertSee('"@type":"FAQPage"', false)
                ->assertDontSee('<meta name="keywords"', false)
                ->getContent();

            $this->assertSame(1, substr_count($content, '<h1'));
            $this->assertSame(3, substr_count($content, 'شاهد محصول '));

            preg_match('/<title>(.*?)<\/title>/s', $content, $title);
            preg_match('/<meta name="description" content="([^"]+)">/', $content, $description);
            $titles[] = $title[1] ?? '';
            $descriptions[] = html_entity_decode($description[1] ?? '', ENT_QUOTES | ENT_HTML5, 'UTF-8');
        }

        $this->assertSame($titles, array_values(array_unique($titles)));
        $this->assertSame($descriptions, array_values(array_unique($descriptions)));
    }

    public function test_navigation_sitemap_and_evidence_assets_cover_every_platform_solution(): void
    {
        $this->get('/')->assertOk()->assertSee('href="'.self::SITE_URL.'/solutions"', false);
        $hub = $this->get('/solutions')->assertOk();
        $sitemap = $this->get('/sitemap.xml')->assertOk()->getContent();

        foreach (config('site_platform_solutions.pages') as $slug => $page) {
            $url = self::SITE_URL.'/solutions/'.$slug;
            $hub->assertSee('href="'.$url.'"', false);
            $this->assertSame(1, substr_count($sitemap, '<loc>'.$url.'</loc>'));

            foreach ($page['evidence'] as $evidence) {
                $this->assertFileExists(public_path('assets/images/marketing/'.$evidence['image']));
            }
        }
    }

    public function test_overlapping_topics_link_to_their_more_specific_existing_pages(): void
    {
        $this->get('/solutions/container-nvocc')
            ->assertMovedPermanently()
            ->assertRedirect(self::SITE_URL.'/solutions/container-management');

        $this->get('/solutions/container-management')
            ->assertOk()
            ->assertSee('Container Master، Depot، Lease و Utilization', false)
            ->assertSee('live/container-control.png', false);

        $this->get('/solutions/fleet-management')
            ->assertOk()
            ->assertSee('href="'.self::SITE_URL.'/solutions/fleet-dispatch-planning"', false);

        $this->get('/solutions/document-management')
            ->assertOk()
            ->assertSee('href="'.self::SITE_URL.'/solutions/document-readiness"', false)
            ->assertSee('href="'.self::SITE_URL.'/modules/document-management"', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/operations-automation"', false);
    }

    public function test_operations_automation_contains_real_rule_to_exception_walkthrough(): void
    {
        $this->get('/solutions/operations-automation')
            ->assertOk()
            ->assertSee('دموی واقعی چرخه Rule تا Exception', false)
            ->assertSee('live/control-center-rules.png', false)
            ->assertSee('live/control-center-exceptions.png', false)
            ->assertSee('شفافیت داده:', false);
    }
}
