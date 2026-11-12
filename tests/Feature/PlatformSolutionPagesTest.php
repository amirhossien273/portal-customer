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
        'fleet-management' => 'نرم افزار مدیریت ناوگان؛ آمادگی خودرو و راننده پیش از اعزام',
        'document-management' => 'چرخه تأیید اسناد حمل را از Draft تا نسخه نهایی کنترل کنید',
        'multimodal-transport' => 'مدیریت حمل چندوجهی؛ یک Journey، چند Leg هماهنگ',
        'schedule-management' => 'مدیریت برنامه حرکت؛ یک مرجع برای ETD، ETA و تغییرات',
        'rate-management' => 'راهکار مدیریت نرخ و تعرفه حمل‌ونقل',
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
            ->assertSee('<title>راهکارهای نرم‌افزاری حمل‌ونقل و فورواردری | سپند</title>', false)
            ->assertSee('راهکارهای نرم‌افزاری برای شرکت‌های حمل‌ونقل بین‌المللی', false)
            ->assertSee('کدام مشکل شرکت شما را می‌خواهید حل کنید؟', false)
            ->assertSee('data-solution-finder', false)
            ->assertSee('وقتی چند بخش شرکت درگیر یک مسئله‌اند', false)
            ->assertSee('درخواست دمو بر اساس نیاز شرکت', false)
            ->assertSee('"@type":"CollectionPage"', false)
            ->assertSee('"@type":"ItemList"', false);

        $this->assertSame(1, substr_count($response->getContent(), '<h1'));

        foreach (array_keys(self::PAGES) as $slug) {
            $response->assertSee('href="'.self::SITE_URL.'/solutions/'.$slug.'"', false);
        }
    }

    public function test_solution_hub_groups_every_existing_solution_once(): void
    {
        $response = $this->get('/solutions')->assertOk();
        $groups = config('site_platform_solutions.hub.problem_groups');
        $catalogUrls = [];

        $response->assertSee('data-solution-filter="all"', false);
        foreach ($groups as $groupKey => $group) {
            $response->assertSee('data-solution-filter="'.$groupKey.'"', false)
                ->assertSee($group['title'], false);

            foreach ($group['solutions'] as $solution) {
                $url = route($solution['route'], $solution['parameters'] ?? []);
                $catalogUrls[] = $url;
                $response->assertSee('href="'.$url.'"', false)
                    ->assertSee($solution['problem'], false)
                    ->assertSee($solution['link_label'], false);
                $targetResponse = $this->get(parse_url($url, PHP_URL_PATH));
                $this->assertSame(200, $targetResponse->getStatusCode(), 'Broken solution destination: '.$url);
            }
        }

        $this->assertCount(22, $catalogUrls);
        $this->assertSame($catalogUrls, array_values(array_unique($catalogUrls)));
        $this->assertStringContainsString('"numberOfItems":22', $response->getContent());
        $this->assertStringContainsString("replace(/[\\u200c\\u200d\\s]+/g, ' ')", $response->getContent());
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

    public function test_rate_management_page_focuses_on_validity_conditions_and_real_product_evidence(): void
    {
        $content = $this->get('/solutions/rate-management')
            ->assertOk()
            ->assertSee('<title>مدیریت نرخ و تعرفه حمل‌ونقل | راهکار سپند</title>', false)
            ->assertSee('نرخ‌های خرید و شرایط حمل را در سپند منظم کنید', false)
            ->assertSee('راهکار مدیریت نرخ و تعرفه حمل‌ونقل', false)
            ->assertSee('درخواست دموی مدیریت نرخ', false)
            ->assertSee('ببینید سپند چگونه کمک می‌کند', false)
            ->assertSee('live/rate-management.png', false)
            ->assertSee('pricing-supplier-comparison.webp', false)
            ->assertSee('pricing-proposed-rates.webp', false)
            ->assertSee('سناریوی آموزشی نینگبو تا بندرعباس', false)
            ->assertSee('این اعداد نرخ بازار نیستند', false)
            ->assertSee('پایین‌ترین مبلغ به‌تنهایی برنده نیست', false)
            ->assertSee('انتقال خودکار', false)
            ->assertSee('شاخص‌های پیشنهادی برای استقرار', false)
            ->assertSee('نرخ‌های یک استعلام نمونه را در سپند مقایسه کنید', false)
            ->assertSee('href="'.self::SITE_URL.'/modules/pricing-sales"', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/supplier-management"', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/freight-sales-automation"', false)
            ->assertSee('href="'.self::SITE_URL.'/modules/booking"', false)
            ->getContent();

        $this->assertSame(1, substr_count($content, '<h1'));
    }
}
