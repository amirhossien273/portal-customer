<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class PlatformSolutionPagesTest extends TestCase
{
    private const SITE_URL = 'https://sepandcrm.ir';

    private const PAGES = [
        'operations-automation' => 'اتوماسیون عملیات حمل‌ونقل با قواعد قابل تنظیم',
        'freight-finance' => 'سود واقعی هر پرونده حمل را محاسبه کنید',
        'fleet-management' => 'نرم‌افزار مدیریت ناوگان برای بررسی آمادگی خودرو و راننده پیش از اعزام',
        'document-management' => 'چرخه تأیید اسناد حمل را از Draft تا نسخه نهایی کنترل کنید',
        'multimodal-transport' => 'مدیریت حمل چندوجهی؛ یک Journey، چند Leg هماهنگ',
        'schedule-management' => 'مدیریت برنامه حرکت؛ یک مرجع برای ETD، ETA و تغییرات',
        'rate-management' => 'نرم‌افزار مدیریت و مقایسه نرخ حمل‌ونقل بین‌المللی',
        'security-access-management' => 'امنیت و مدیریت دسترسی؛ هر کاربر فقط در دامنه مسئولیت خودش',
        'payment-workflow' => 'درخواست پرداخت تا پرداخت نهایی؛ یک زنجیره کنترل‌شده و قابل ردیابی',
        'booking-reconciliation' => 'دریافت و تطبیق مالی Booking؛ هر مبلغ با منشأ و مصرف روشن',
        'supplier-management' => 'مدیریت تأمین‌کنندگان حمل‌ونقل، از پرونده ایجنت تا انتخاب برای هر مسیر',
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

        $this->assertCount(23, $catalogUrls);
        $this->assertSame($catalogUrls, array_values(array_unique($catalogUrls)));
        $this->assertStringContainsString('"numberOfItems":23', $response->getContent());
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
        $content = $this->get('/solutions/operations-automation')
            ->assertOk()
            ->assertSee('<title>اتوماسیون عملیات حمل‌ونقل بین‌المللی | سپند</title>', false)
            ->assertSee('پس از ثبت زمان جدید رسیدن محموله', false)
            ->assertSee('دموی واقعی چرخه Rule تا Exception', false)
            ->assertSee('پنج‌شنبه ساعت ۱۰', false)
            ->assertSee('جمعه ساعت ۱۰', false)
            ->assertSee('مقدار تغییر ETA را با مقدار قبلی مقایسه نمی‌کند', false)
            ->assertSee('live/control-center-rules.png', false)
            ->assertSee('live/control-center-exceptions.png', false)
            ->assertSee('شفافیت داده:', false)
            ->assertSee('اجرای یک قاعده عملیاتی را در سپند ببینید', false)
            ->assertSee('هشدار کسری مدارک حمل', false)
            ->assertSee('هشدار پایان مهلت رایگان', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/shipment-visibility"', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/operation-exception-management"', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/operational-workflow-management"', false)
            ->assertSee('<link rel="canonical" href="'.self::SITE_URL.'/solutions/operations-automation">', false)
            ->assertSee('<meta name="robots" content="index,follow,max-image-preview:large">', false)
            ->assertDontSee('noindex', false)
            ->getContent();

        $this->assertSame(1, substr_count($content, '<h1'));
        $this->assertSame(3, substr_count($content, 'شاهد محصول '));
        $this->assertSame(1, substr_count($this->get('/sitemap.xml')->assertOk()->getContent(), '<loc>'.self::SITE_URL.'/solutions/operations-automation</loc>'));
    }

    public function test_rate_management_page_focuses_on_validity_conditions_and_real_product_evidence(): void
    {
        $content = $this->get('/solutions/rate-management')
            ->assertOk()
            ->assertSee('<title>نرم‌افزار مدیریت نرخ حمل‌ونقل بین‌المللی | سپند</title>', false)
            ->assertSee('با نرم‌افزار مدیریت نرخ حمل‌ونقل سپند، نرخ خرید ایجنت‌ها', false)
            ->assertSee('نرم‌افزار مدیریت و مقایسه نرخ حمل‌ونقل بین‌المللی', false)
            ->assertSee('مقایسه سه نرخ در دموی سپند', false)
            ->assertSee('مقایسه نرخ ایجنت‌های حمل', false)
            ->assertSee('live/rate-management.png', false)
            ->assertSee('pricing-supplier-comparison.webp', false)
            ->assertSee('مثال آموزشی با اعداد فرضی', false)
            ->assertSee('کانتینر ۴۰ فوت از نینگبو به بندرعباس', false)
            ->assertSee('تأمین‌کننده الف', false)
            ->assertSee('نیازمند تأیید', false)
            ->assertSee('گزینه الف', false)
            ->assertSee('انتقال خودکار', false)
            ->assertSee('شاخص‌های قابل‌سنجش برای تیم نرخ‌دهی', false)
            ->assertSee('نرخ خرید چند ایجنت حمل چطور مقایسه می‌شود؟', false)
            ->assertSee('href="'.url('/modules/pricing-sales').'"', false)
            ->assertSee('href="'.url('/solutions/freight-sales-automation').'"', false)
            ->assertSee('href="'.url('/solutions/supplier-management').'"', false)
            ->assertSee('نرخ‌های یک استعلام واقعی را در دموی سپند مقایسه کنید', false)
            ->assertSee('href="'.self::SITE_URL.'/modules/pricing-sales"', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/supplier-management"', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/freight-sales-automation"', false)
            ->getContent();

        $this->assertSame(1, substr_count($content, '<h1'));
    }

    public function test_fleet_management_page_explains_pre_dispatch_readiness_with_verified_controls(): void
    {
        $content = $this->get('/solutions/fleet-management')
            ->assertOk()
            ->assertSee('<title>نرم‌افزار مدیریت ناوگان حمل‌ونقل و رانندگان | سپند</title>', false)
            ->assertSee('در سپند، پرونده خودرو و راننده، ظرفیت، اعتبار مدارک و وضعیت سرویس را پیش از تخصیص به مأموریت حمل بررسی کنید.', false)
            ->assertSee('مثال آموزشی', false)
            ->assertSee('کامیون ۱', false)
            ->assertSee('کامیون ۲ و راننده', false)
            ->assertSee('کامیون ۳ و راننده', false)
            ->assertSee('آمادگی خودرو و راننده را در دموی سپند بررسی کنید', false)
            ->assertSee('live/fleet-compliance-control.png', false)
            ->assertSee('operations-calendar-month.webp', false)
            ->assertSee('document-attachment-upload.webp', false)
            ->assertSee('برنامه‌ریز مستقل سرویس دوره‌ای در نسخه بررسی‌شده تأیید نشد', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/truck-movement-planning"', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/fleet-dispatch-planning"', false)
            ->assertSee('<link rel="canonical" href="'.self::SITE_URL.'/solutions/fleet-management">', false)
            ->assertSee('<meta name="robots" content="index,follow,max-image-preview:large">', false)
            ->assertDontSee('noindex', false)
            ->getContent();

        $this->assertSame(1, substr_count($content, '<h1'));
        $this->assertSame(3, substr_count($content, 'شاهد محصول '));
        $this->assertSame(1, substr_count($this->get('/sitemap.xml')->assertOk()->getContent(), '<loc>'.self::SITE_URL.'/solutions/fleet-management</loc>'));
    }

    public function test_supplier_management_page_separates_master_related_views_and_manual_capacity_follow_up(): void
    {
        $content = $this->get('/solutions/supplier-management')
            ->assertOk()
            ->assertSee('<title>مدیریت و ارزیابی تأمین‌کنندگان حمل‌ونقل | سپند</title>', false)
            ->assertSee('در سپند، خدمات، مسیرها، نرخ‌های معتبر و سابقه همکاری با ایجنت‌ها و تأمین‌کنندگان حمل را بررسی کنید', false)
            ->assertSee('مثال آموزشی', false)
            ->assertSee('ایجنت A', false)
            ->assertSee('ایجنت B', false)
            ->assertSee('تا ساعت ۱۵', false)
            ->assertSee('پیگیری B در اولویت', false)
            ->assertSee('انتخاب ایجنت برای یک مسیر را در سپند ببینید', false)
            ->assertSee('live/supplier-master.png', false)
            ->assertSee('pricing-supplier-comparison.webp', false)
            ->assertSee('live/rate-management.png', false)
            ->assertSee('موعد پاسخ و تأیید ظرفیت در نمای مقایسه فعلی محاسبه نمی‌شوند', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/rate-management"', false)
            ->assertSee('<link rel="canonical" href="'.self::SITE_URL.'/solutions/supplier-management">', false)
            ->assertSee('<meta name="robots" content="index,follow,max-image-preview:large">', false)
            ->assertDontSee('noindex', false)
            ->getContent();

        $this->assertSame(1, substr_count($content, '<h1'));
        $this->assertSame(3, substr_count($content, 'شاهد محصول '));
        $this->assertSame(1, substr_count($this->get('/sitemap.xml')->assertOk()->getContent(), '<loc>'.self::SITE_URL.'/solutions/supplier-management</loc>'));
    }

    public function test_freight_finance_page_explains_profit_variance_with_verified_product_boundaries(): void
    {
        $content = $this->get('/solutions/freight-finance')
            ->assertOk()
            ->assertSee('<title>محاسبه سود پرونده حمل و کنترل هزینه‌ها | سپند</title>', false)
            ->assertSee('در سپند، درآمد و هزینه‌های هر پرونده حمل را کنار هم ببینید، اختلاف هزینه برآوردی و واقعی را بررسی کنید و دلیل تغییر سود پرونده را پیدا کنید.', false)
            ->assertSee('سود واقعی هر پرونده حمل را محاسبه کنید', false)
            ->assertSee('مثال آموزشی با اعداد فرضی', false)
            ->assertSee('۴٬۸۰۰ دلار', false)
            ->assertSee('۴٬۰۰۰ دلار هزینه برآوردی', false)
            ->assertSee('۴٬۲۵۰ دلار با احتساب تعهد ۲۵۰ دلاری', false)
            ->assertSee('۴٬۳۲۰ دلار هزینه واقعی', false)
            ->assertSee('فاکتور نهایی ۷۰ دلار بیشتر از مبلغ تعهدشده است', false)
            ->assertSee('کاهش کل سود: <b>۳۲۰ دلار</b>', false)
            ->assertSee('درآمد با دریافت وجه و هزینه با پرداخت وجه یکسان فرض نشده‌اند.', false)
            ->assertSee('live/booking-finance-control.png', false)
            ->assertSee('finance-booking-reconciliation.webp', false)
            ->assertSee('booking-profitability.webp', false)
            ->assertSee('محاسبه سود یک پرونده حمل را در سپند ببینید', false)
            ->assertSee('لینک مستقیم از سلول سود یا Snapshot به یک ردیف هزینه مشخص در کد نسخه فعلی تأیید نشد', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/rate-management"', false)
            ->assertSee('href="'.self::SITE_URL.'/modules/pricing-sales"', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/freight-sales-automation"', false)
            ->assertSee('href="'.self::SITE_URL.'/modules/finance-accounting"', false)
            ->assertSee('سود پرونده چطور محاسبه می‌شود؟', false)
            ->assertSee('اگر فاکتور ایجنت هنوز نرسیده، سود موقت چه معنایی دارد؟', false)
            ->assertSee('هزینه‌های چندارزی در گزارش چگونه نمایش داده می‌شوند؟', false)
            ->assertSee('"@type":"HowTo"', false)
            ->assertSee('"@type":"FAQPage"', false)
            ->assertSee('<link rel="canonical" href="'.self::SITE_URL.'/solutions/freight-finance">', false)
            ->assertSee('<meta name="robots" content="index,follow,max-image-preview:large">', false)
            ->assertDontSee('noindex', false)
            ->getContent();

        $this->assertSame(1, substr_count($content, '<h1'));
        $this->assertSame(3, substr_count($content, 'شاهد محصول '));
        $this->assertSame(1, substr_count($this->get('/sitemap.xml')->assertOk()->getContent(), '<loc>'.self::SITE_URL.'/solutions/freight-finance</loc>'));
    }
}
