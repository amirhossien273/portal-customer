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
            '/compare/best-transport-accounting-software' => ['title' => 'بهترین نرم‌افزار حسابداری حمل‌ونقل بین‌المللی', 'h1' => 'بهترین نرم‌افزار حسابداری حمل‌ونقل بین‌المللی چه معیارهایی دارد؟'],
            '/solutions/nvocc' => ['title' => 'نرم‌افزار NVOCC | مدیریت عملیات، اسناد و مالی', 'h1' => 'عملیات NVOCC را از رزرو تا سود پرونده یکپارچه مدیریت کنید'],
            '/solutions/container-management' => ['title' => 'نرم‌افزار مدیریت کانتینر | کنترل چرخه و هزینه', 'h1' => 'کانتینر، مهلت‌ها و هزینه‌ها را در متن همان پرونده حمل مدیریت کنید'],
            '/solutions/on-premise' => ['title' => 'نرم‌افزار حمل‌ونقل On-Premise | راهنمای استقرار', 'h1' => 'استقرار On-Premise نرم‌افزار حمل‌ونقل را با مسئولیت‌های روشن انتخاب کنید'],
            '/solutions/bill-of-lading-management' => ['title' => 'نرم‌افزار مدیریت بارنامه حمل | HBL و MBL', 'h1' => 'بارنامه را از پیش‌نویس تا تأیید و آرشیو در پرونده حمل کنترل کنید'],
            '/solutions/freight-sales-automation' => ['title' => 'اتوماسیون فروش شرکت حمل‌ونقل و فورواردری', 'h1' => 'فروش حمل‌ونقل را از لید تا Booking به یک جریان قابل پیگیری تبدیل کنید'],
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
                ->assertSee('"@type":"ItemList"', false)
                ->assertSee('"@type":"FAQPage"', false)
                ->assertSee('id="diagnostic-section"', false)
                ->assertSee('id="deep-dive-section"', false)
                ->assertSee('id="metrics-section"', false)
                ->assertSee('id="rollout-section"', false)
                ->assertSee('آخرین بازبینی محتوایی: شهریور ۱۴۰۵', false)
                ->assertSee('درخواست دمو و مشاوره', false)
                ->assertDontSee('<meta name="keywords"', false)
                ->assertDontSee('/integrations', false);

            $this->assertSame(1, substr_count($content, '<h1'));
            $this->assertGreaterThanOrEqual(10, substr_count($content, '<h2'));
            $this->assertGreaterThan(7000, mb_strlen(strip_tags($content)));
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

    public function test_header_compare_hub_and_relevant_modules_link_to_the_new_pages(): void
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

        foreach (['/', '/product', '/solutions/nvocc'] as $path) {
            $response = $this->get($path)->assertOk()->assertSee('class="nav-solutions"', false);
            foreach ($solutionPaths as $solutionPath) {
                $response->assertSee('href="'.self::SITE_URL.$solutionPath.'"', false);
            }
        }

        $compareHub = $this->get('/compare')->assertOk();
        foreach ($guidePaths as $guidePath) {
            $compareHub->assertSee('href="'.self::SITE_URL.$guidePath.'"', false);
        }

        $moduleLinks = [
            '/modules/crm' => ['/compare/best-crm-for-transport-companies', '/solutions/freight-sales-automation'],
            '/modules/finance-accounting' => ['/compare/best-transport-accounting-software'],
            '/modules/document-management' => ['/solutions/bill-of-lading-management'],
            '/modules/transport-operations' => ['/solutions/nvocc', '/solutions/container-management'],
        ];

        foreach ($moduleLinks as $modulePath => $relatedPaths) {
            $response = $this->get($modulePath)->assertOk();
            foreach ($relatedPaths as $relatedPath) {
                $response->assertSee('href="'.self::SITE_URL.$relatedPath.'"', false);
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
            ->assertSee('انتخاب CRM تخصصی؛ جدا از معرفی محصول', false)
            ->assertSee('href="'.self::SITE_URL.'/modules/crm"', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/freight-sales-automation"', false);

        $this->get('/solutions/container-management')
            ->assertOk()
            ->assertSee('مدیریت کانتینر با ردیابی عمومی محموله متفاوت است', false)
            ->assertSee('href="'.self::SITE_URL.'/transport-modes/sea"', false);

        $this->get('/solutions/bill-of-lading-management')
            ->assertOk()
            ->assertSee('این محتوا ادعای سامانه صدور بارنامه جاده‌ای رسمی یا اتصال به سامانه‌های حاکمیتی ندارد', false)
            ->assertSee('href="'.self::SITE_URL.'/modules/document-management"', false);
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
