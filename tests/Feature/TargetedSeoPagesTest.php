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
            ->assertSee('<title>نرم‌افزار مدیریت بارنامه حمل‌ونقل | سپند</title>', false)
            ->assertSee('<meta name="description" content="نرم‌افزار مدیریت بارنامه سپند برای کنترل اطلاعات HBL و MBL، ارتباط House/Master، نسخه‌های Draft و نهایی و اتصال بارنامه به Booking و پرونده حمل.">', false)
            ->assertSee('<link rel="canonical" href="'.self::SITE_URL.'/solutions/bill-of-lading-management">', false)
            ->assertSee('<meta name="robots" content="index,follow,max-image-preview:large">', false)
            ->assertSee('<h1>مدیریت بارنامه‌های حمل‌ونقل با نرم‌افزار سپند</h1>', false)
            ->assertSee('شرکت‌های حمل‌ونقل و فورواردری زمانی با خطا و تأخیر روبه‌رو می‌شوند', false)
            ->assertSee('درخواست دموی مدیریت بارنامه در سپند', false)
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
            ->assertSee('<title>نرم‌افزار نرخ‌دهی حمل‌ونقل و مدیریت استعلام | سپند</title>', false)
            ->assertSee('<meta name="description" content="نرم‌افزار نرخ‌دهی حمل‌ونقل سپند برای ثبت استعلام، مقایسه نرخ خرید، کنترل اعتبار و حاشیه سود، تهیه Quotation و پیگیری پیشنهاد تا Booking.">', false)
            ->assertSee('<link rel="canonical" href="'.self::SITE_URL.'/modules/pricing-sales">', false)
            ->assertSee('<meta name="robots" content="index,follow,max-image-preview:large">', false)
            ->assertSee('نرم‌افزار نرخ‌دهی و فروش', false)
            ->assertSee('خدمات حمل‌ونقل', false)
            ->assertSee('استعلام‌های متعدد مشتریان، نرخ‌های خرید تأمین‌کنندگان، اعتبار نرخ، حاشیه فروش', false)
            ->assertSee('Rate Master و منطق Rate Break در راهکار مدیریت نرخ نگهداری می‌شوند', false)
            ->assertSee('مشاهده دموی نرخ‌دهی و فروش سپند', false)
            ->assertSee('href="'.self::SITE_URL.'/consultation"', false)
            ->assertSee('href="'.self::SITE_URL.'/modules/crm"', false)
            ->assertSee('href="'.self::SITE_URL.'/modules/booking"', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/rate-management"', false)
            ->assertSee('assets/images/marketing/modules/screenshots/pricing-sales-workflow.webp', false)
            ->assertSee('alt="برد مراحل استعلام و پیشنهاد نرخ در ماژول فروش سپند"', false);

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
            ->assertSee('<title>نرم‌افزار مدیریت گردش کار و وظایف حمل‌ونقل | سپند</title>', false)
            ->assertSee('<meta name="description" content="نرم‌افزار مدیریت گردش کار و وظایف سپند برای تعیین مسئول، مهلت و وضعیت اقدامات مرتبط با مشتری و پرونده حمل و هماهنگی تیم‌های فروش، عملیات و اسناد.">', false)
            ->assertSee('<link rel="canonical" href="'.self::SITE_URL.'/modules/workflow-tasks">', false)
            ->assertSee('<meta name="robots" content="index,follow,max-image-preview:large">', false)
            ->assertSee('مدیریت گردش کار و وظایف', false)
            ->assertSee('در شرکت‌های حمل‌ونقل', false)
            ->assertSee('پیگیری‌ها فراموش می‌شوند، مسئول اقدام روشن نیست و مدیر دید کافی از وضعیت کارها ندارد', false)
            ->assertSee('بررسی یک سند از «ارجاع به کارشناس» تا «کنترل، اصلاح و تأیید نهایی»', false)
            ->assertSee('درخواست دموی مدیریت گردش کار سپند', false)
            ->assertSee('href="'.self::SITE_URL.'/consultation"', false)
            ->assertSee('href="'.self::SITE_URL.'/modules/automatic-tasks"', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/operational-workflow-management"', false)
            ->assertSee('assets/images/marketing/product-showcase/desktop-calendar.webp', false)
            ->assertSee('alt="تقویم فعالیت‌ها و وظایف تیم در ماژول گردش کار سپند"', false)
            ->assertSee('assets/images/marketing/modules/screenshots/workflow-notifications.webp', false);

        $this->assertSame(1, substr_count($content, '<h1'));
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
