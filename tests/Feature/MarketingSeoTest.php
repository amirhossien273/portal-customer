<?php

namespace Tests\Feature;

use Illuminate\Contracts\Http\Kernel as HttpKernel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class MarketingSeoTest extends TestCase
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

    public function test_priority_marketing_pages_are_indexable_and_self_canonical(): void
    {
        $pages = [
            '/transport-modes/air' => [
                'title' => 'نرم‌افزار مدیریت حمل هوایی | سپند',
                'description' => 'رزرو ظرفیت، اطلاعات پرواز، MAWB و HAWB، وزن قابل وصول، ULD و رویدادهای فرودگاهی را در پرونده حمل هوایی سپند مدیریت کنید.',
                'h1' => 'حمل هوایی سپند',
            ],
            '/transport-modes/sea' => [
                'title' => 'نرم‌افزار مدیریت حمل دریایی | سپند',
                'description' => 'عملیات حمل دریایی را از Booking و اطلاعات کانتینر تا HBL/MBL، VGM، رویدادهای بندری و روزهای آزاد در یک پرونده مدیریت کنید.',
                'h1' => 'حمل دریایی سپند',
            ],
            '/transport-modes/road' => [
                'title' => 'نرم‌افزار مدیریت حمل زمینی | سپند',
                'description' => 'اطلاعات خودرو و راننده، مسیر، مرزها، رویدادهای محموله و هزینه هر سفر زمینی را در پرونده عملیاتی سپند مدیریت کنید.',
                'h1' => 'حمل زمینی سپند',
            ],
            '/modules/transport-operations' => [
                'title' => 'نرم‌افزار مدیریت عملیات حمل‌ونقل | سپند',
                'description' => 'ماژول عملیات حمل سپند برای مدیریت پرونده عملیاتی، رویدادها، مسئولیت‌ها، موارد استثنا و وضعیت جاری هر حمل طراحی شده است.',
                'h1' => 'عملیات',
            ],
        ];

        foreach ($pages as $path => $expected) {
            $response = $this->get($path);
            $content = $response->getContent();

            $response->assertOk();
            $response->assertSee('<meta name="robots" content="index,follow,max-image-preview:large">', false);
            $response->assertSee('<link rel="canonical" href="'.self::SITE_URL.$path.'">', false);
            $response->assertSee('<title>'.$expected['title'].'</title>', false);
            $response->assertSee('content="'.e($expected['description']).'"', false);
            $response->assertSee($expected['h1'], false);
            $response->assertSee('"@type":"BreadcrumbList"', false);
            $this->assertSame(1, substr_count($content, '<h1'));
            $this->assertStringNotContainsString('noindex', strtolower($content));

            preg_match_all('/<script type="application\/ld\+json">(.*?)<\/script>/s', $content, $structuredData);
            $this->assertNotEmpty($structuredData[1]);

            foreach ($structuredData[1] as $json) {
                $this->assertIsArray(json_decode($json, true, 512, JSON_THROW_ON_ERROR));
            }
        }
    }

    public function test_priority_pages_are_present_once_in_the_sitemap(): void
    {
        $content = $this->get('/sitemap.xml')->assertOk()->getContent();

        preg_match_all('/<loc>(.*?)<\/loc>/', $content, $locations);
        $this->assertNotEmpty($locations[1]);
        $this->assertSame($locations[1], array_values(array_unique($locations[1])));

        foreach ($locations[1] as $location) {
            $this->assertStringStartsWith(self::SITE_URL.'/', $location);
            $this->assertTrue($location === self::SITE_URL.'/' || ! str_ends_with($location, '/'));
        }

        foreach ([
            '/transport-modes/air',
            '/transport-modes/sea',
            '/transport-modes/road',
            '/modules/transport-operations',
        ] as $path) {
            $this->assertSame(1, substr_count($content, '<loc>'.self::SITE_URL.$path.'</loc>'));
        }
    }

    public function test_keyword_map_remains_internal_and_meta_keywords_are_not_rendered(): void
    {
        $pages = [
            '/' => config('marketing.page_keywords.home'),
            '/modules' => config('marketing.page_keywords.modules'),
            '/modules/crm' => config('site_modules.crm.keywords'),
            '/modules/pricing-sales' => config('site_modules.pricing-sales.keywords'),
            '/modules/booking' => config('site_modules.booking.keywords'),
            '/modules/transport-operations' => config('site_modules.transport-operations.keywords'),
            '/modules/document-management' => config('site_modules.document-management.keywords'),
            '/modules/finance-accounting' => config('site_modules.finance-accounting.keywords'),
            '/modules/workflow-tasks' => config('site_modules.workflow-tasks.keywords'),
            '/modules/customer-portal-tracking' => config('site_modules.customer-portal-tracking.keywords'),
            '/transport-modes/sea' => config('site_transport_modes.sea.keywords'),
            '/transport-modes/air' => config('site_transport_modes.air.keywords'),
            '/transport-modes/road' => config('site_transport_modes.road.keywords'),
            '/transport-modes/rail' => config('site_transport_modes.rail.keywords'),
            '/pricing' => config('marketing.page_keywords.pricing'),
            '/consultation' => config('marketing.page_keywords.consultation'),
        ];

        $this->assertCount(16, $pages);
        $this->assertSame(45, array_sum(array_map('count', $pages)));

        foreach ($pages as $path => $keywords) {
            $response = $this->get($path)->assertOk();
            $content = $response->getContent();

            $this->assertNotEmpty($keywords, 'No keyword map defined for '.$path);
            $this->assertStringNotContainsString('<meta name="keywords"', strtolower($content));
        }

        $planned = config('marketing.planned_pages.tms_transportation_management_system');
        $this->assertSame('/guides/tms-transportation-management-system', $planned['url']);
        $this->assertSame('planned_not_created', $planned['status']);
        $this->assertSame('سیستم TMS حمل و نقل', $planned['primary_keyword']);
        $this->get($planned['url'])->assertNotFound();
        $this->get('/sitemap.xml')->assertDontSee($planned['url'], false);
    }

    public function test_intent_mismatch_keywords_are_excluded_from_normal_secondary_maps(): void
    {
        $normalKeywords = [
            ...config('marketing.page_keywords.modules'),
            ...config('site_modules.document-management.keywords'),
            ...config('site_modules.customer-portal-tracking.keywords'),
            ...config('site_transport_modes.road.keywords'),
        ];
        $opportunities = [
            config('marketing.page_keyword_opportunities.modules.0'),
            config('site_modules.document-management.keyword_opportunities.0'),
            config('site_modules.customer-portal-tracking.keyword_opportunities.0'),
            config('site_transport_modes.road.keyword_opportunities.0'),
        ];

        $this->assertSame(
            ['ERP حمل و نقل', 'نرم افزار صدور بارنامه', 'رهگیری آنلاین بار', 'نرم افزار مدیریت ناوگان حمل و نقل'],
            array_column($opportunities, 'keyword')
        );

        foreach ($opportunities as $opportunity) {
            $this->assertSame('intent_mismatch', $opportunity['status']);
            $this->assertFalse($opportunity['automatic_targeting']);
            $this->assertNotContains($opportunity['keyword'], $normalKeywords);
        }

        $this->assertSame(
            ['پرتال مشتریان حمل و نقل', 'رهگیری وضعیت محموله'],
            config('site_modules.customer-portal-tracking.keywords')
        );
    }

    public function test_risky_secondary_keywords_do_not_change_page_intent(): void
    {
        $this->get('/transport-modes/road')
            ->assertOk()
            ->assertDontSee('نرم‌افزار مدیریت ناوگان حمل‌ونقل', false)
            ->assertDontSee('GPS', false)
            ->assertDontSee('تلماتیک', false);

        $this->get('/modules/customer-portal-tracking')
            ->assertOk()
            ->assertDontSee('رهگیری آنلاین بار', false)
            ->assertDontSee('موقعیت لحظه‌ای GPS', false);

        $this->get('/modules')
            ->assertOk()
            ->assertDontSee('ERP حمل‌ونقل', false)
            ->assertDontSee('سیستم TMS حمل‌ونقل', false);

        $this->get('/modules/document-management')
            ->assertOk()
            ->assertSee('<title>نرم‌افزار مدیریت اسناد حمل‌ونقل | سپند</title>', false)
            ->assertSee('<meta name="description" content="مدیریت، کنترل نسخه، تأیید و آرشیو اسناد حمل در سپند؛ متصل به مشتری، Booking و پرونده عملیاتی.">', false)
            ->assertSee('<span class="module-hero-title-main">نرم‌افزار مدیریت اسناد</span>', false)
            ->assertSee('در پرونده‌های حمل دریایی، نرم افزار مدیریت HBL و MBL سپند، اطلاعات این اسناد را در همین چرخه کنترل نسخه، تأیید و آرشیو نگهداری می‌کند.', false)
            ->assertDontSee('نرم افزار صدور بارنامه', false);
    }

    public function test_transport_pages_and_operations_page_have_contextual_html_links(): void
    {
        $modes = ['air', 'sea', 'road', 'rail'];

        foreach ($modes as $mode) {
            $response = $this->get('/transport-modes/'.$mode)
                ->assertOk()
                ->assertSee('href="'.self::SITE_URL.'/modules/transport-operations"', false)
                ->assertSee('مدیریت عملیات حمل', false);

            foreach (array_diff($modes, [$mode]) as $relatedMode) {
                $response->assertSee('href="'.self::SITE_URL.'/transport-modes/'.$relatedMode.'"', false);
            }
        }

        $operations = $this->get('/modules/transport-operations')->assertOk();

        foreach (['air' => 'حمل هوایی', 'sea' => 'حمل دریایی', 'road' => 'حمل زمینی', 'rail' => 'حمل ریلی'] as $mode => $anchor) {
            $operations
                ->assertSee('href="'.self::SITE_URL.'/transport-modes/'.$mode.'"', false)
                ->assertSee($anchor, false);
        }
    }

    public function test_trailing_slash_variants_permanently_redirect_to_canonical_urls(): void
    {
        foreach ([
            '/transport-modes/air/',
            '/transport-modes/sea/',
            '/transport-modes/road/',
            '/modules/transport-operations/',
        ] as $path) {
            $request = Request::create(self::SITE_URL.$path.'?utm_source=seo', 'GET');
            $response = app(HttpKernel::class)->handle($request);

            $this->assertSame(301, $response->getStatusCode());
            $this->assertSame(
                self::SITE_URL.rtrim($path, '/').'?utm_source=seo',
                $response->headers->get('Location')
            );
        }
    }
}
