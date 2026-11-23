<?php

namespace Tests\Feature;

use Illuminate\Contracts\Http\Kernel as HttpKernel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class MarketingContentPagesTest extends TestCase
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

    public function test_every_requested_non_integration_page_is_indexable_unique_and_structured(): void
    {
        $pages = [
            '/compare/best-freight-forwarding-software' => ['title' => 'بهترین نرم‌افزار فورواردری | راهنمای انتخاب حرفه‌ای', 'h1' => 'بهترین نرم‌افزار فورواردری را چگونه انتخاب کنیم؟'],
            '/compare/best-crm-for-transport-companies' => ['title' => 'بهترین CRM برای شرکت حمل‌ونقل | چک‌لیست انتخاب', 'h1' => 'بهترین CRM برای شرکت حمل‌ونقل چه ویژگی‌هایی دارد؟'],
            '/compare/best-transport-accounting-software' => ['title' => 'بهترین نرم افزار حسابداری حمل و نقل | راهنمای انتخاب', 'h1' => 'بهترین نرم افزار حسابداری حمل و نقل چه معیارهایی دارد؟'],
            '/solutions/nvocc' => ['title' => 'نرم‌افزار NVOCC | مدیریت عملیات، اسناد و مالی', 'h1' => 'عملیات NVOCC را از رزرو تا سود پرونده یکپارچه مدیریت کنید'],
            '/solutions/container-management' => ['title' => 'نرم افزار مدیریت کانتینر، دپو و اجاره | سپند', 'h1' => 'نرم افزار مدیریت کانتینر؛ از Depot و Lease تا Return'],
            '/solutions/on-premise' => ['title' => 'نرم‌افزار حمل‌ونقل بین‌المللی روی سرور شرکت | سپند', 'h1' => 'نرم‌افزار حمل‌ونقل بین‌المللی قابل نصب روی سرور شرکت'],
            '/solutions/bill-of-lading-management' => ['title' => 'کنترل بارنامه HBL و MBL با نرم افزار سپند', 'h1' => 'کنترل بارنامه‌های HBL و MBL از Draft تا نسخه نهایی'],
            '/solutions/freight-sales-automation' => ['title' => 'نرم‌افزار پیگیری استعلام و پیشنهاد قیمت حمل‌ونقل | سپند', 'h1' => 'پیگیری استعلام‌های حمل و پیشنهادهای قیمت در سپند'],
        ];

        $renderedTitles = [];
        $renderedDescriptions = [];

        foreach ($pages as $path => $expected) {
            $response = $this->get($path)->assertOk();
            $content = $response->getContent();

            $response
                ->assertSee('<title>'.$expected['title'].'</title>', false)
                ->assertSee('<link rel="canonical" href="'.self::SITE_URL.$path.'">', false)
                ->assertSee('<meta name="robots" content="index,follow,max-image-preview:large">', false)
                ->assertSee($expected['h1'], false)
                ->assertSee('"@type":"WebPage"', false)
                ->assertSee('"@type":"BreadcrumbList"', false)
                ->assertSee('"@type":"FAQPage"', false)
                ->assertSee('درخواست دمو و مشاوره', false)
                ->assertDontSee('<meta name="keywords"', false)
                ->assertDontSee('/integrations', false);

            if ($path === '/solutions/freight-sales-automation') {
                $response
                    ->assertSee('"@type":"HowTo"', false)
                    ->assertSee('id="sales-solutions"', false)
                    ->assertSee('id="product-evidence"', false)
                    ->assertSee('id="educational-scenario"', false)
                    ->assertSee('id="manual-and-automatic"', false)
                    ->assertSee('id="verifiable-results"', false);
            } else {
                $response
                    ->assertSee('"@type":"ItemList"', false)
                    ->assertSee('id="diagnostic-section"', false)
                    ->assertSee('id="deep-dive-section"', false)
                    ->assertSee('id="metrics-section"', false)
                    ->assertSee('id="rollout-section"', false)
                    ->assertSee('آخرین بازبینی محتوایی: شهریور ۱۴۰۵', false);
            }

            $this->assertSame(1, substr_count($content, '<h1'));
            $this->assertGreaterThanOrEqual($path === '/solutions/freight-sales-automation' ? 7 : 10, substr_count($content, '<h2'));
            $this->assertGreaterThan($path === '/solutions/freight-sales-automation' ? 5000 : 7000, mb_strlen(strip_tags($content)));
            $this->assertStringNotContainsString('noindex', strtolower($content));
            $this->assertValidJsonLd($content);

            preg_match('/<title>(.*?)<\/title>/s', $content, $titleMatch);
            preg_match('/<meta name="description" content="([^"]+)">/', $content, $descriptionMatch);
            $renderedTitles[] = $titleMatch[1] ?? '';
            $renderedDescriptions[] = html_entity_decode($descriptionMatch[1] ?? '', ENT_QUOTES | ENT_HTML5, 'UTF-8');
        }

        $this->assertSame($renderedTitles, array_values(array_unique($renderedTitles)));
        $this->assertSame($renderedDescriptions, array_values(array_unique($renderedDescriptions)));
    }

    public function test_freight_sales_solution_matches_the_customer_follow_up_brief(): void
    {
        $response = $this->get('/solutions/freight-sales-automation')->assertOk();
        $content = $response->getContent();

        $response
            ->assertSee('<title>نرم‌افزار پیگیری استعلام و پیشنهاد قیمت حمل‌ونقل | سپند</title>', false)
            ->assertSee('<meta name="description" content="با سپند، پیشنهادهای قیمت ارسال‌شده، آخرین تماس، مسئول و موعد پیگیری هر استعلام حمل را در یک پرونده ببینید و پیگیری‌های عقب‌افتاده را پیدا کنید.">', false)
            ->assertSee('<meta property="og:title" content="نرم‌افزار پیگیری استعلام و پیشنهاد قیمت حمل‌ونقل | سپند">', false)
            ->assertSee('<meta name="twitter:title" content="نرم‌افزار پیگیری استعلام و پیشنهاد قیمت حمل‌ونقل | سپند">', false)
            ->assertSee('<link rel="canonical" href="'.self::SITE_URL.'/solutions/freight-sales-automation">', false)
            ->assertSee('<h1>پیگیری استعلام‌های حمل و پیشنهادهای قیمت در سپند</h1>', false)
            ->assertSee('درخواست دموی پیگیری فروش', false)
            ->assertSee('href="#educational-scenario">مشاهده سناریوی نینگبو تا بندرعباس</a>', false)
            ->assertSee('پیگیری پیشنهاد نینگبو به بندرعباس؛ از ارسال تا Booking', false)
            ->assertSee('پیشنهاد ارسال شد', false)
            ->assertSee('موعد پیگیری رسید', false)
            ->assertSee('مشتری برای تصمیم‌گیری فرصت خواست', false)
            ->assertSee('مشتری پیشنهاد را تأیید کرد', false)
            ->assertSee('دو روز بعد ساعت ۹', false)
            ->assertSee('آخرین اقدام چه بوده؟', false)
            ->assertSee('مسئول پیگیری کیست؟', false)
            ->assertSee('اقدام بعدی چه زمانی است؟', false)
            ->assertSee('پیگیری یک پیشنهاد قیمت را در سپند ببینید', false)
            ->assertSee('<th>رویداد</th><th>اقدام کارشناس</th><th>رفتار سپند با قاعده فعال</th>', false)
            ->assertSee('قالب آماده مستقلی برای تعیین موعد جدید', false)
            ->assertSee('بعد از تأیید مشتری، چه چیزی به Booking می‌رود؟', false)
            ->assertSee('شاخص‌های پیشنهادی', false)
            ->assertSee('وجود گزارش آماده با همین نام‌ها', false)
            ->assertSee('assets/images/marketing/product-showcase/desktop-dashboard.webp', false)
            ->assertSee('assets/images/marketing/modules/screenshots/crm-overdue-inquiries.webp', false)
            ->assertSee('assets/images/marketing/modules/screenshots/automatic-task-rules.webp', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/rate-management"', false)
            ->assertSee('href="'.self::SITE_URL.'/modules/pricing-sales"', false)
            ->assertSee('href="'.self::SITE_URL.'/modules/crm"', false)
            ->assertSee('href="'.self::SITE_URL.'/modules/automatic-tasks"', false)
            ->assertSee('href="'.self::SITE_URL.'/modules/booking"', false)
            ->assertSee('استعلام‌های نیازمند پیگیری را کجا می‌بینم؟', false)
            ->assertSee('آیا بعد از ارسال پیشنهاد، تسک خودکار ساخته می‌شود؟', false)
            ->assertSee('اگر مشتری پاسخ ندهد، موعد بعدی کجا ثبت می‌شود؟', false)
            ->assertSee('بعد از تأیید مشتری، چه اطلاعاتی وارد Booking می‌شود؟', false)
            ->assertSee('"@type":"HowTo"', false)
            ->assertSee('"@type":"FAQPage"', false)
            ->assertDontSee('RevOps', false)
            ->assertDontSee('Handoff', false)
            ->assertDontSee('Escalation', false)
            ->assertDontSee('Rule Catalog', false);

        $this->assertSame(1, substr_count($content, '<h1'));
        $this->assertSame(4, substr_count($content, '<details class="reveal">'));
        $this->assertLessThan(strpos($content, 'id="product-evidence"'), strpos($content, 'id="sales-solutions"'));
        $this->assertValidJsonLd($content);
    }

    public function test_on_premise_page_matches_the_technical_review_brief(): void
    {
        $response = $this->get('/solutions/on-premise')->assertOk();
        $content = $response->getContent();

        $response
            ->assertSee('<title>نرم‌افزار حمل‌ونقل بین‌المللی روی سرور شرکت | سپند</title>', false)
            ->assertSee('<meta name="description" content="امکان نصب نرم‌افزار حمل‌ونقل بین‌المللی سپند روی سرور شرکت را بررسی کنید. با پیش‌نیازهای زیرساخت، هزینه راه‌اندازی، پشتیبان‌گیری و شرایط پشتیبانی آشنا شوید.">', false)
            ->assertSee('<meta property="og:title" content="نرم‌افزار حمل‌ونقل بین‌المللی روی سرور شرکت | سپند">', false)
            ->assertSee('<meta name="twitter:title" content="نرم‌افزار حمل‌ونقل بین‌المللی روی سرور شرکت | سپند">', false)
            ->assertSee('<link rel="canonical" href="'.self::SITE_URL.'/solutions/on-premise">', false)
            ->assertSee('نام فنی این مدل استقرار On-Premise است', false)
            ->assertSee('درخواست بررسی نصب روی سرور شرکت', false)
            ->assertSee('href="#installation-requirements">مشاهده پیش‌نیازهای نصب</a>', false)
            ->assertSee('آیا سپند روی سرور شرکت ما نصب می‌شود؟', false)
            ->assertSee('CRM و فروش', false)
            ->assertSee('استعلام و نرخ‌دهی', false)
            ->assertSee('Booking و پرونده حمل', false)
            ->assertSee('مدیریت اسناد', false)
            ->assertSee('مالی و گزارش‌ها', false)
            ->assertSee('پیش‌نیازهای نصب و مسئولیت نگهداری', false)
            ->assertSee('در بررسی فنی مشخص می‌شود', false)
            ->assertSee('محاسبه‌گر صفحه تعرفه', false)
            ->assertSee('نرم‌افزار فورواردری روی سرور سازمان', false)
            ->assertSee('assets/images/marketing/product-showcase/desktop-dashboard.webp', false)
            ->assertSee('"name":"نرم‌افزار حمل‌ونقل بین‌المللی روی سرور شرکت | سپند"', false)
            ->assertSee('"description":"امکان نصب نرم‌افزار حمل‌ونقل بین‌المللی سپند روی سرور شرکت را بررسی کنید.', false);

        $this->assertSame(1, substr_count($content, '<h1'));
        $this->assertSame(count(config('site_content_pages.solutions.on-premise.faqs')), substr_count($content, '<details class="reveal">'));
        $this->assertValidJsonLd($content);
    }

    public function test_every_page_has_unique_decision_depth_metrics_and_rollout_content(): void
    {
        $base = config('site_content_pages');
        $depth = config('site_content_depth');
        $deepHeadings = [];
        $metricHeadings = [];

        foreach (['guides', 'solutions'] as $group) {
            foreach ($base[$group] as $slug => $page) {
                $this->assertArrayHasKey($slug, $depth[$group]);
                $content = $depth[$group][$slug];

                $this->assertSame(['editorial', 'diagnostic', 'deep_dive', 'metrics', 'rollout'], array_keys($content));
                $this->assertGreaterThanOrEqual(3, count($content['diagnostic']['items']));
                $this->assertGreaterThanOrEqual(3, count($content['deep_dive']['items']));
                $this->assertCount(4, $content['metrics']['items']);
                $this->assertCount(4, $content['rollout']['steps']);

                foreach ($content['deep_dive']['items'] as $item) {
                    $this->assertGreaterThanOrEqual(3, count($item['bullets']));
                }

                $deepHeadings[] = $content['deep_dive']['heading'];
                $metricHeadings[] = $content['metrics']['heading'];
            }
        }

        $this->assertSame($deepHeadings, array_values(array_unique($deepHeadings)));
        $this->assertSame($metricHeadings, array_values(array_unique($metricHeadings)));
    }

    public function test_topic_hubs_and_contextual_modules_link_to_specialized_pages_without_a_megamenu_dump(): void
    {
        $solutionPaths = [
            '/solutions/nvocc',
            '/solutions/container-management',
            '/solutions/on-premise',
            '/solutions/bill-of-lading-management',
            '/solutions/freight-sales-automation',
        ];
        $guidePaths = [
            '/compare/best-freight-forwarding-software',
            '/compare/best-crm-for-transport-companies',
            '/compare/best-transport-accounting-software',
        ];

        $menuAuthorityPaths = [
            '/solutions',
            '/modules/crm',
            '/modules/transport-operations',
            '/modules/finance-accounting',
            '/modules/document-management',
            '/solutions/fleet-management',
            '/solutions/nvocc',
        ];

        foreach (['/', '/product', '/solutions/nvocc'] as $path) {
            $response = $this->get($path)->assertOk()->assertSee('class="nav-solutions"', false);
            foreach ($menuAuthorityPaths as $authorityPath) {
                $this->assertStringContainsString('href="'.self::SITE_URL.$authorityPath.'"', $response->getContent(), "Missing {$authorityPath} from {$path}");
            }
        }

        $solutionHub = $this->get('/solutions')->assertOk();
        foreach ($solutionPaths as $solutionPath) {
            $solutionHub->assertSee('href="'.self::SITE_URL.$solutionPath.'"', false);
        }

        $compareHub = $this->get('/compare')->assertOk();
        foreach ($guidePaths as $guidePath) {
            $compareHub->assertSee('href="'.self::SITE_URL.$guidePath.'"', false);
        }

        $moduleLinks = [
            '/modules/crm' => ['/compare/best-crm-for-transport-companies', '/solutions/freight-sales-automation'],
            '/modules/finance-accounting' => ['/compare/best-transport-accounting-software'],
            '/modules/document-management' => ['/solutions/document-management', '/solutions/document-readiness', '/solutions/bill-of-lading-management'],
            '/modules/transport-operations' => ['/solutions/shipment-visibility', '/solutions/operation-exception-management', '/solutions/operations-automation'],
        ];

        foreach ($moduleLinks as $modulePath => $relatedPaths) {
            $response = $this->get($modulePath)->assertOk();
            foreach ($relatedPaths as $relatedPath) {
                $this->assertStringContainsString('href="'.self::SITE_URL.$relatedPath.'"', $response->getContent(), "Missing {$relatedPath} from {$modulePath}");
            }
        }
    }

    public function test_new_pages_are_in_sitemap_once_and_integration_pages_were_not_created(): void
    {
        $paths = [
            '/compare/best-freight-forwarding-software',
            '/compare/best-crm-for-transport-companies',
            '/compare/best-transport-accounting-software',
            '/solutions/nvocc',
            '/solutions/container-management',
            '/solutions/on-premise',
            '/solutions/bill-of-lading-management',
            '/solutions/freight-sales-automation',
        ];
        $sitemap = $this->get('/sitemap.xml')->assertOk()->getContent();

        foreach ($paths as $path) {
            $this->assertSame(1, substr_count($sitemap, '<loc>'.self::SITE_URL.$path.'</loc>'));
            $request = Request::create(self::SITE_URL.$path.'/', 'GET');
            $response = app(HttpKernel::class)->handle($request);
            $this->assertSame(301, $response->getStatusCode());
            $this->assertSame(self::SITE_URL.$path, $response->headers->get('Location'));
        }

        $this->assertStringNotContainsString('/integrations', $sitemap);
        $this->get('/integrations')->assertNotFound();
        $this->get('/integrations/sepindar')->assertNotFound();
    }

    public function test_keyword_intents_have_explicit_content_boundaries(): void
    {
        $this->get('/compare/best-crm-for-transport-companies')
            ->assertOk()
            ->assertSee('راهنمای Selection؛ نه صفحه محصول CRM یا اتوماسیون فروش', false)
            ->assertSee('href="'.self::SITE_URL.'/modules/crm"', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/freight-sales-automation"', false);

        $this->get('/solutions/container-management')
            ->assertOk()
            ->assertSee('مالک چرخه دارایی کانتینر؛ نه مدل کسب‌وکار NVOCC یا روش حمل دریایی', false)
            ->assertSee('href="'.self::SITE_URL.'/transport-modes/sea"', false);

        $this->get('/solutions/bill-of-lading-management')
            ->assertOk()
            ->assertSee('کنترل بارنامه یعنی اطلاعات طرف‌ها و محموله', false)
            ->assertSee('صدور رسمی بارنامه جاده‌ای یا اتصال حاکمیتی در دامنه این صفحه ادعا نمی‌شود', false)
            ->assertSee('href="'.self::SITE_URL.'/modules/document-management"', false)
            ->assertSee('href="'.self::SITE_URL.'/consultation"', false)
            ->assertSee('درخواست دموی مدیریت بارنامه سپند', false);
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
