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

class AboutPageTest extends TestCase
{
    private const SITE_URL = 'https://sepandcrm.ir';

    protected function setUp(): void
    {
        parent::setUp();

        config([
            'app.url' => self::SITE_URL,
            'marketing.site_url' => self::SITE_URL,
            'database.default' => 'about_test',
            'database.connections.about_test' => [
                'driver' => 'sqlite',
                'database' => ':memory:',
                'prefix' => '',
                'foreign_key_constraints' => true,
            ],
        ]);
        DB::purge('about_test');
        DB::setDefaultConnection('about_test');
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

    public function test_about_page_has_expected_brand_seo_content_and_links(): void
    {
        $response = $this->get('/about')->assertOk();
        $content = $response->getContent();
        $consultationUrl = self::SITE_URL.'/consultation?source_page='.rawurlencode(self::SITE_URL.'/about');

        $response
            ->assertSee('<title>درباره سپند | داستان و شیوه همکاری با شرکت‌های حمل‌ونقل</title>', false)
            ->assertSee('<meta name="description" content="سپند چرا و برای چه شرکت‌هایی ساخته شده است؟ با داستان نرم‌افزار سپند، روش همکاری با شرکت‌های حمل‌ونقل بین‌المللی و یک نمونه واقعی از کاربرد آن آشنا شوید.">', false)
            ->assertSee('<meta property="og:title" content="درباره سپند | داستان و شیوه همکاری با شرکت‌های حمل‌ونقل">', false)
            ->assertSee('<meta name="twitter:title" content="درباره سپند | داستان و شیوه همکاری با شرکت‌های حمل‌ونقل">', false)
            ->assertSee('<link rel="canonical" href="'.self::SITE_URL.'/about">', false)
            ->assertSee('<meta name="robots" content="index,follow,max-image-preview:large">', false)
            ->assertSee('سپند نرم‌افزاری برای شرکت‌های حمل‌ونقل بین‌المللی', false)
            ->assertSee('href="'.$consultationUrl.'"', false)
            ->assertSee('data-ga-label="about_hero_consultation"', false)
            ->assertSee('data-ga-label="about_bottom_consultation"', false)
            ->assertSee('href="#case-study"', false)
            ->assertSee('href="'.self::SITE_URL.'/product"', false)
            ->assertSee('href="'.self::SITE_URL.'/why-sepand"', false)
            ->assertSee('href="'.self::SITE_URL.'/customers/case-studies/operational-control-snapshot"', false)
            ->assertSee('۷ مورد نیازمند اقدام', false)
            ->assertSee('۳ پیگیری عقب‌افتاده و ۴ استعلام بدون اقدام بعدی', false)
            ->assertSee('assets/images/marketing/live/operations-dashboard.png', false)
            ->assertSee('"@type":"AboutPage"', false)
            ->assertSee('"about":{"@id":"'.self::SITE_URL.'#organization"}', false)
            ->assertDontSee('این موضوع در کدام بخش فرایند ادامه پیدا می‌کند؟', false);

        $this->assertSame(1, substr_count($content, '<h1'));
        $this->assertStringContainsString('dir="rtl"', $content);

        preg_match_all('/<script type="application\/ld\+json">(.*?)<\/script>/s', $content, $structuredData);
        $this->assertNotEmpty($structuredData[1]);
        foreach ($structuredData[1] as $json) {
            $this->assertIsArray(json_decode($json, true, 512, JSON_THROW_ON_ERROR));
        }
    }

    public function test_about_page_is_present_once_in_sitemap(): void
    {
        $sitemap = $this->get('/sitemap.xml')->assertOk()->getContent();

        $this->assertSame(1, substr_count($sitemap, '<loc>'.self::SITE_URL.'/about</loc>'));
    }

    public function test_about_source_is_carried_to_consultation_and_stored(): void
    {
        $sourcePage = self::SITE_URL.'/about';

        $this->get('/consultation?source_page='.rawurlencode($sourcePage))
            ->assertOk()
            ->assertSee('name="source_page" value="'.$sourcePage.'"', false);

        $this->post('/consultation', [
            'name' => 'مدیر عملیات',
            'company' => 'شرکت نمونه',
            'mobile' => '09121234567',
            'company_type' => 'شرکت حمل‌ونقل بین‌المللی',
            'primary_need' => 'یکپارچه‌سازی فرایندها',
            'source_page' => $sourcePage,
        ])->assertRedirect(self::SITE_URL.'/consultation');

        $this->assertDatabaseHas('consultation_requests', [
            'company' => 'شرکت نمونه',
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
