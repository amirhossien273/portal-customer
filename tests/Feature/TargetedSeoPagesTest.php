<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class TargetedSeoPagesTest extends TestCase
{
    private const SITE_URL = 'https://sepandcrm.ir';

    protected function setUp(): void
    {
        parent::setUp();

        config(['app.url' => self::SITE_URL, 'marketing.site_url' => self::SITE_URL]);
        URL::forceRootUrl(self::SITE_URL);
        URL::forceScheme('https');
    }

    public function test_bill_of_lading_page_targets_software_intent_without_losing_its_specialized_scope(): void
    {
        $response = $this->get('/solutions/bill-of-lading-management')->assertOk();
        $content = $response->getContent();

        $response
            ->assertSee('<title>کنترل بارنامه HBL و MBL با نرم افزار سپند</title>', false)
            ->assertSee('<meta name="description" content="بارنامه‌های HBL و MBL، Draft، Revision، تأیید و نسخه نهایی را در ارتباط با Booking و پرونده حمل کنترل کنید؛ دامنه قابل نمایش سپند را ببینید.">', false)
            ->assertSee('<link rel="canonical" href="'.self::SITE_URL.'/solutions/bill-of-lading-management">', false)
            ->assertSee('<meta name="robots" content="index,follow,max-image-preview:large">', false)
            ->assertSee('<h1>کنترل بارنامه‌های HBL و MBL از Draft تا نسخه نهایی</h1>', false)
            ->assertSee('کنترل بارنامه یعنی اطلاعات طرف‌ها و محموله', false)
            ->assertSee('درخواست دموی مدیریت بارنامه سپند', false)
            ->assertSee('دامنه تأییدشده نسخه فعلی سپند', false)
            ->assertSee('فیلدهای تخصصی، کنترل نسخه، شماره‌گذاری و خروجی باید در دمو بررسی شوند', false)
            ->assertSee('از ثبت اطلاعات بارنامه تا تأیید نهایی', false)
            ->assertSee('assets/images/marketing/modules/screenshots/document-attachment-upload.webp', false)
            ->assertSee('href="'.self::SITE_URL.'/consultation"', false)
            ->assertSee('href="'.self::SITE_URL.'/transport-modes/sea"', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/nvocc"', false)
            ->assertSee('href="'.self::SITE_URL.'/modules/document-management"', false)
            ->assertSee('صدور رسمی بارنامه جاده‌ای یا اتصال حاکمیتی در دامنه این صفحه ادعا نمی‌شود', false);

        $this->assertSame(1, substr_count($content, '<h1'));
        $this->assertValidJsonLd($content);

        foreach (['/transport-modes/sea', '/solutions/nvocc', '/modules/document-management', '/product'] as $sourcePath) {
            $this->get($sourcePath)
                ->assertOk()
                ->assertSee('href="'.self::SITE_URL.'/solutions/bill-of-lading-management"', false);
        }
    }

    public function test_pricing_sales_page_targets_rate_quotation_and_sales_intent(): void
    {
        $response = $this->get('/modules/pricing-sales')->assertOk();
        $content = $response->getContent();

        $response
            ->assertSee('<title>نرم افزار نرخ دهی و پیشنهاد قیمت حمل و نقل | سپند</title>', false)
            ->assertSee('<meta name="description" content="با سپند، استعلام‌های حمل را ثبت کنید، نرخ و شرایط تأمین‌کنندگان را مقایسه کنید و پیشنهاد فروش را با کنترل اعتبار نرخ و حاشیه سود آماده کنید.">', false)
            ->assertSee('<link rel="canonical" href="'.self::SITE_URL.'/modules/pricing-sales">', false)
            ->assertSee('<meta name="robots" content="index,follow,max-image-preview:large">', false)
            ->assertSee('نرم‌افزار نرخ‌دهی و فروش', false)
            ->assertSee('خدمات حمل‌ونقل', false)
            ->assertSee('درخواست دموی نرخ‌دهی حمل‌ونقل', false)
            ->assertSee('href="#pricing-process">مشاهده فرایند نرخ‌دهی</a>', false)
            ->assertSee('نرخ خرید را همراه', false)
            ->assertSee('از استعلام مشتری تا', false)
            ->assertSee('مثال آموزشی — همه اعداد فرضی هستند', false)
            ->assertSee('Quotation با پیش‌فاکتور یکی نیست', false)
            ->assertSee('یک استعلام واقعی را در سپند نرخ‌دهی کنید', false)
            ->assertSee('href="'.self::SITE_URL.'/consultation"', false)
            ->assertSee('href="'.self::SITE_URL.'/modules/crm"', false)
            ->assertSee('href="'.self::SITE_URL.'/modules/booking"', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/rate-management"', false)
            ->assertSee('assets/images/marketing/modules/screenshots/pricing-supplier-comparison.webp', false)
            ->assertSee('assets/images/marketing/modules/screenshots/pricing-sales-workflow.webp', false)
            ->assertSee('assets/images/marketing/modules/screenshots/pricing-proposed-rates.webp', false)
            ->assertSee('alt="نمای واقعی مقایسه تأمین‌کنندگان با نرخ خرید، مسیر، اعتبار، زمان حمل و Free Time در سپند"', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/supplier-management"', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/freight-sales-automation"', false)
            ->assertSee('href="'.self::SITE_URL.'/modules/finance-accounting"', false)
            ->assertSee('"@type":"HowTo"', false);

        $this->assertSame(1, substr_count($content, '<h1'));
        $this->assertValidJsonLd($content);

        foreach (['/modules/crm', '/product', '/modules', '/solutions/rate-management'] as $sourcePath) {
            $this->get($sourcePath)
                ->assertOk()
                ->assertSee('href="'.self::SITE_URL.'/modules/pricing-sales"', false);
        }
    }

    public function test_workflow_tasks_page_targets_human_workflow_in_transport_companies(): void
    {
        $response = $this->get('/modules/workflow-tasks')->assertOk();
        $content = $response->getContent();

        $response
            ->assertSee('<title>نرم افزار گردش کار و مدیریت وظایف حمل‌ونقل | سپند</title>', false)
            ->assertSee('<meta name="description" content="نرم افزار گردش کار سپند، مراحل، وظایف، مسئول، مهلت و وضعیت اقدامات انسانی را به مشتری، Booking و پرونده حمل متصل می‌کند.">', false)
            ->assertSee('<link rel="canonical" href="'.self::SITE_URL.'/modules/workflow-tasks">', false)
            ->assertSee('<meta name="robots" content="index,follow,max-image-preview:large">', false)
            ->assertSee('نرم افزار مدیریت گردش کار حمل و نقل', false)
            ->assertSee('مرحله، مسئول، مهلت و نتیجه قابل پیگیری', false)
            ->assertSee('پیگیری‌ها فراموش می‌شوند، مسئول اقدام روشن نیست و مدیر دید کافی از وضعیت کارها ندارد', false)
            ->assertSee('بررسی یک سند از «ارجاع به کارشناس» تا «کنترل، اصلاح و تأیید نهایی»', false)
            ->assertSee('درخواست دموی مدیریت وظایف سپند', false)
            ->assertSee('مدیریت وظایف در یک پرونده حمل چگونه انجام می‌شود؟', false)
            ->assertSee('تیم فروش و نرخ‌دهی', false)
            ->assertSee('تیم عملیات و اسناد', false)
            ->assertSee('مدیران و سرپرستان', false)
            ->assertSee('href="'.self::SITE_URL.'/consultation"', false)
            ->assertSee('href="'.self::SITE_URL.'/modules/automatic-tasks"', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/operational-workflow-management"', false)
            ->assertSee('assets/images/marketing/product-showcase/desktop-calendar.webp', false)
            ->assertSee('alt="تقویم فعالیت‌ها و وظایف تیم در ماژول گردش کار سپند"', false)
            ->assertSee('assets/images/marketing/modules/screenshots/workflow-notifications.webp', false);

        $this->assertSame(1, substr_count($content, '<h1'));
        $this->assertSame(3, count(config('site_module_pages.workflow-tasks.audiences')));
        $this->assertValidJsonLd($content);

        foreach (['/modules', '/product', '/modules/transport-operations'] as $sourcePath) {
            $this->get($sourcePath)
                ->assertOk()
                ->assertSee('href="'.self::SITE_URL.'/modules/workflow-tasks"', false);
        }
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
