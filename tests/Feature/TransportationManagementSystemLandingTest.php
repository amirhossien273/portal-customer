<?php

namespace Tests\Feature;

use App\Models\ConsultationRequest;
use App\Services\ConsultationSmsNotifier;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Mockery;
use Tests\TestCase;

class TransportationManagementSystemLandingTest extends TestCase
{
    private const SITE_URL = 'https://sepandcrm.ir';

    private const PATH = '/solutions/transportation-management-system';

    protected function setUp(): void
    {
        parent::setUp();

        config([
            'app.url' => self::SITE_URL,
            'marketing.site_url' => self::SITE_URL,
            'database.default' => 'tms_test',
            'database.connections.tms_test' => [
                'driver' => 'sqlite',
                'database' => ':memory:',
                'prefix' => '',
                'foreign_key_constraints' => true,
            ],
        ]);
        DB::purge('tms_test');
        DB::setDefaultConnection('tms_test');
        URL::forceRootUrl(self::SITE_URL);
        URL::forceScheme('https');

        Schema::create('consultation_requests', function (Blueprint $table): void {
            $table->id();
            $table->string('name', 100);
            $table->string('company', 150);
            $table->string('mobile', 30);
            $table->string('email', 190)->nullable();
            $table->string('company_type', 100)->nullable();
            $table->string('approximate_users', 30)->nullable();
            $table->string('primary_need', 100)->nullable();
            $table->text('message')->nullable();
            $table->string('source_page', 2048)->nullable();
            $table->timestamps();
        });

        $notifier = Mockery::mock(ConsultationSmsNotifier::class);
        $notifier->shouldReceive('send')->zeroOrMoreTimes();
        $this->app->instance(ConsultationSmsNotifier::class, $notifier);
    }

    public function test_tms_page_has_the_expected_seo_scenario_evidence_and_links(): void
    {
        $canonical = self::SITE_URL.self::PATH;
        $description = 'رزرو، اجرای حمل، اسناد، وضعیت محموله و هزینه‌های هر سفارش را در سپند مدیریت کنید و فرایند فروش را به پرونده حمل وصل کنید.';
        $demoUrl = self::SITE_URL.'/consultation?source_page='.rawurlencode($canonical);
        $response = $this->get(self::PATH)->assertOk();
        $content = $response->getContent();

        $response
            ->assertSee('<title>نرم‌افزار TMS برای شرکت‌های حمل‌ونقل و فورواردری | سپند</title>', false)
            ->assertSee('<meta name="description" content="'.e($description).'">', false)
            ->assertSee('<meta property="og:title" content="نرم‌افزار TMS برای شرکت‌های حمل‌ونقل و فورواردری | سپند">', false)
            ->assertSee('<meta name="twitter:description" content="'.e($description).'">', false)
            ->assertSee('<link rel="canonical" href="'.$canonical.'">', false)
            ->assertSee('<meta name="robots" content="index,follow,max-image-preview:large">', false)
            ->assertSee('<h1>نرم‌افزار TMS سپند با CRM یکپارچه</h1>', false)
            ->assertSee('id="tms-scenario"', false)
            ->assertSee('مثال آموزشی · حمل دریایی نینگبو به بندرعباس', false)
            ->assertSee('<h2 class="section-title" id="tms-scenario-title">مدیریت حمل کالا از رزرو تا تحویل و بررسی هزینه</h2>', false)
            ->assertSee('نرم‌افزار مدیریت حمل کالا', false)
            ->assertSee('مدیریت سفارش حمل کالا', false)
            ->assertSee('پیگیری حمل کالا تا تحویل', false)
            ->assertSee('href="#tms-scenario">مشاهده چرخه حمل نینگبو تا بندرعباس</a>', false)
            ->assertSee('assets/images/marketing/modules/screenshots/pricing-sales-workflow.webp', false)
            ->assertSee('assets/images/marketing/modules/screenshots/operations-calendar-list.webp', false)
            ->assertSee('assets/images/marketing/modules/screenshots/booking-profitability.webp', false)
            ->assertSee('href="'.self::SITE_URL.'/modules/crm"', false)
            ->assertSee('href="'.self::SITE_URL.'/modules/booking"', false)
            ->assertSee('href="'.self::SITE_URL.'/modules/transport-operations"', false)
            ->assertSee('href="'.self::SITE_URL.'/modules/document-management"', false)
            ->assertSee('href="'.self::SITE_URL.'/modules/customer-portal-tracking"', false)
            ->assertSee('href="'.self::SITE_URL.'/modules/finance-accounting"', false)
            ->assertSee('href="'.self::SITE_URL.'/pricing"', false)
            ->assertSee('href="'.self::SITE_URL.'/compare/sepand-vs-other-transport-software#erp-vs-tms"', false)
            ->assertSee('تفاوت ERP و TMS برای شرکت‌های حمل‌ونقل', false)
            ->assertSee('href="'.$demoUrl.'"', false)
            ->assertSee('data-ga-label="tms_hero_demo"', false)
            ->assertSee('data-ga-label="tms_scenario_demo"', false)
            ->assertSee('data-ga-label="tms_bottom_demo"', false)
            ->assertSee('اتصال فروش به عملیات حمل چه کمکی می‌کند؟', false)
            ->assertSee('ورود خودکار لید از کانال‌های بازاریابی', false)
            ->assertSee('<h2 class="section-title" id="tms-scope-title">پیش از خرید نرم‌افزار TMS چه چیزی را در دمو بررسی کنید؟</h2>', false)
            ->assertSee('یک پیشنهاد تأییدشده را انتخاب کنید و ببینید چه اطلاعاتی از', false)
            ->assertSee('وضعیت محموله و اسناد همان حمل', false)
            ->assertSee('هزینه‌های ثبت‌شده و نتیجه مالی همان پرونده', false)
            ->assertSee('href="'.self::SITE_URL.'/pricing">مشاهده تعرفه و محاسبه قیمت نرم‌افزار TMS</a>', false)
            ->assertSee('"@type":"WebPage"', false)
            ->assertSee('"@type":"SoftwareApplication"', false)
            ->assertSee('"@type":"BreadcrumbList"', false)
            ->assertSee('"@type":"FAQPage"', false);

        $this->assertSame(1, substr_count($content, '<h1'));
        $this->assertStringContainsString('dir="rtl"', $content);

        preg_match_all('/<script type="application\/ld\+json">(.*?)<\/script>/s', $content, $structuredData);
        $this->assertNotEmpty($structuredData[1]);
        foreach ($structuredData[1] as $json) {
            $this->assertIsArray(json_decode($json, true, 512, JSON_THROW_ON_ERROR));
        }

        foreach ([
            'pricing-sales-workflow.webp',
            'operations-calendar-list.webp',
            'booking-profitability.webp',
        ] as $image) {
            $this->assertFileExists(public_path('assets/images/marketing/modules/screenshots/'.$image));
        }
    }

    public function test_tms_page_is_in_sitemap_menu_hub_and_has_required_inbound_links(): void
    {
        $canonical = self::SITE_URL.self::PATH;
        $sitemap = $this->get('/sitemap.xml')->assertOk()->getContent();

        $this->assertSame(1, substr_count($sitemap, '<loc>'.$canonical.'</loc>'));

        foreach (['/', '/product', '/compare/sepand-vs-other-transport-software'] as $path) {
            $this->get($path)
                ->assertOk()
                ->assertSee('href="'.$canonical.'"', false);
        }

        $this->get('/solutions')
            ->assertOk()
            ->assertSee('href="'.$canonical.'"', false)
            ->assertSee('سیستم مدیریت حمل‌ونقل (TMS)', false);
    }

    public function test_tms_source_is_carried_to_consultation_and_successful_request_keeps_existing_events(): void
    {
        $sourcePage = self::SITE_URL.self::PATH;

        $this->get('/consultation?source_page='.rawurlencode($sourcePage))
            ->assertOk()
            ->assertSee('name="source_page" value="'.$sourcePage.'"', false);

        $this->post('/consultation', [
            'name' => 'مدیر عملیات',
            'company' => 'شرکت حمل نمونه',
            'mobile' => '09121234567',
            'company_type' => 'شرکت فورواردری',
            'primary_need' => 'یکپارچه‌سازی فرایندها',
            'source_page' => $sourcePage,
        ])->assertRedirect(self::SITE_URL.'/consultation');

        $this->assertDatabaseHas('consultation_requests', [
            'company' => 'شرکت حمل نمونه',
            'source_page' => $sourcePage,
        ]);
        $this->assertSame($sourcePage, ConsultationRequest::query()->sole()->source_page);

        $this->withSession([
            'status' => 'درخواست شما ثبت شد. اطلاعات اولیه بررسی می‌شود و برای هماهنگی جلسه دمو با شما تماس می‌گیریم.',
        ])->get('/consultation?source_page='.rawurlencode($sourcePage))
            ->assertOk()
            ->assertSee("window.gtag('event','consultation_success'", false)
            ->assertSee("event:'consultation_success'", false)
            ->assertSee("event_label:'consultation_form_success'", false);
    }
}
