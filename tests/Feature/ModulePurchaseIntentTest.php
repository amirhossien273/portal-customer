<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class ModulePurchaseIntentTest extends TestCase
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

    public function test_crm_page_covers_purchase_and_pricing_intent_without_changing_page_identity(): void
    {
        $response = $this->get('/modules/crm')->assertOk();
        $content = $response->getContent();

        $response
            ->assertSee('<title>نرم افزار CRM حمل و نقل؛ فروش و پیگیری | سپند</title>', false)
            ->assertSee('<link rel="canonical" href="'.self::SITE_URL.'/modules/crm">', false)
            ->assertSee('id="crm-purchase"', false)
            ->assertSee('<h2 class="section-title" id="crm-purchase-title">خرید و راه‌اندازی CRM حمل‌ونقل سپند</h2>', false)
            ->assertSee('برای ارزیابی CRM حمل‌ونقل سپند، یکی از استعلام‌های نمونه شرکتتان را برای جلسه دمو آماده کنید.', false)
            ->assertSee('href="'.self::SITE_URL.'/consultation" data-ga-event="cta_click" data-ga-label="crm_purchase_consultation">درخواست دموی CRM حمل‌ونقل</a>', false)
            ->assertSee('href="'.self::SITE_URL.'/pricing">محاسبه هزینه اشتراک سپند</a>', false)
            ->assertSee('<summary>قیمت CRM حمل‌ونقل سپند چطور محاسبه می‌شود؟</summary>', false)
            ->assertSee('از <a href="'.self::SITE_URL.'/pricing">محاسبه‌گر تعرفه سپند</a> استفاده کنید.', false);

        $this->assertSame(1, substr_count($content, '<h1'));
        $this->assertLessThan(strpos($content, 'id="crm-purchase"'), strpos($content, 'id="crm-audience-title"'));
        $this->assertLessThan(strpos($content, 'id="crm-faq-title"'), strpos($content, 'id="crm-purchase"'));
        $this->assertFaqSchemaMatchesVisibleContent(
            $content,
            'قیمت CRM حمل‌ونقل سپند چطور محاسبه می‌شود؟',
            'اشتراک سپند بر اساس تعداد کاربران و دوره پرداخت ماهانه یا سالانه محاسبه می‌شود. طبق تعرفه فعلی، ترکیب ماژول‌ها مبلغ اشتراک را تغییر نمی‌دهد. برای برآورد هزینه تیم خود، از محاسبه‌گر تعرفه سپند استفاده کنید. خدمات جانبی و شرایط استقرار در پیشنهاد رسمی مشخص می‌شوند.'
        );
    }

    public function test_finance_page_covers_accounting_pricing_intent_and_keeps_faq_schema_in_sync(): void
    {
        $response = $this->get('/modules/finance-accounting')->assertOk();
        $content = $response->getContent();

        $response
            ->assertSee('<title>نرم‌افزار حسابداری حمل‌ونقل بین‌المللی | سپند</title>', false)
            ->assertSee('<meta name="description" content="در سپند، مبالغ فروش Booking، هزینه و پرداخت هر پرونده حمل را با ارز ثبت‌شده ببینید و دریافت، نرخ تبدیل تاریخ‌دار و نتیجه مالی را در ارز گزارش بررسی کنید.">', false)
            ->assertSee('<meta property="og:title" content="نرم‌افزار حسابداری حمل‌ونقل بین‌المللی | سپند">', false)
            ->assertSee('<meta property="og:description" content="در سپند، مبالغ فروش Booking، هزینه و پرداخت هر پرونده حمل را با ارز ثبت‌شده ببینید و دریافت، نرخ تبدیل تاریخ‌دار و نتیجه مالی را در ارز گزارش بررسی کنید.">', false)
            ->assertSee('<meta name="twitter:title" content="نرم‌افزار حسابداری حمل‌ونقل بین‌المللی | سپند">', false)
            ->assertSee('<meta name="twitter:description" content="در سپند، مبالغ فروش Booking، هزینه و پرداخت هر پرونده حمل را با ارز ثبت‌شده ببینید و دریافت، نرخ تبدیل تاریخ‌دار و نتیجه مالی را در ارز گزارش بررسی کنید.">', false)
            ->assertSee('<link rel="canonical" href="'.self::SITE_URL.'/modules/finance-accounting">', false)
            ->assertSee('"@type":"WebPage","@id":"'.self::SITE_URL.'/modules/finance-accounting#webpage","url":"'.self::SITE_URL.'/modules/finance-accounting","name":"نرم‌افزار حسابداری حمل‌ونقل بین‌المللی | سپند","description":"در سپند، مبالغ فروش Booking، هزینه و پرداخت هر پرونده حمل را با ارز ثبت‌شده ببینید و دریافت، نرخ تبدیل تاریخ‌دار و نتیجه مالی را در ارز گزارش بررسی کنید."', false)
            ->assertSee('id="finance-multicurrency-scenario"', false)
            ->assertSee('<h2 class="section-title" id="module-early-scenario-title">حسابداری چندارزی حمل‌ونقل در یک پرونده چگونه انجام می‌شود؟</h2>', false)
            ->assertSee('ثبت درآمد و هزینه با ارز اصلی', false)
            ->assertSee('انتخاب مبنای تبدیل و ارز گزارش', false)
            ->assertSee('ثبت دریافت و پرداخت و بررسی مانده', false)
            ->assertSee('alt="نمای واقعی تطبیق مالی Booking در سپند با مبلغ پیشنهاد، پرداخت، دریافت و نرخ تبدیل"', false)
            ->assertSee('href="'.self::SITE_URL.'/consultation" data-ga-event="cta_click" data-ga-label="module_finance-accounting_scenario_consultation">مالی یک پرونده چندارزی را در دموی سپند ببینید</a>', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/freight-finance">راهکار کنترل مالی پرونده حمل</a>', false)
            ->assertSee('href="'.self::SITE_URL.'/compare/best-transport-accounting-software">راهنمای مقایسه نرم‌افزارهای حسابداری حمل‌ونقل</a>', false)
            ->assertSee('<summary>آیا سپند برای حسابداری باربری و شرکت‌های حمل زمینی مناسب است؟</summary>', false)
            ->assertSee('<summary>آیا شرکت بازرگانی خارجی می‌تواند مالی حمل‌های وارداتی و صادراتی را در سپند مدیریت کند؟</summary>', false)
            ->assertSee('<summary>قیمت نرم‌افزار حسابداری حمل‌ونقل بین‌المللی سپند چطور محاسبه می‌شود؟</summary>', false)
            ->assertSee('در <a href="'.self::SITE_URL.'/pricing">محاسبه‌گر تعرفه سپند</a> انتخاب کنید.', false);

        $this->assertSame(1, substr_count($content, '<h1'));
        $this->assertLessThan(strpos($content, 'id="module-problems-title"'), strpos($content, 'id="finance-multicurrency-scenario"'));
        $this->assertLessThan(strpos($content, 'id="module-features"'), strpos($content, 'id="finance-multicurrency-scenario"'));
        $this->assertFaqSchemaMatchesVisibleContent(
            $content,
            'آیا سپند برای حسابداری باربری و شرکت‌های حمل زمینی مناسب است؟',
            'نرم‌افزار حسابداری باربری سپند برای حمل زمینی، دسته‌های هزینه راننده، سوخت، عوارض مسیر، هزینه مرزی، گمرک، پارکینگ، توقف و حق خواب کامیون را در سطح پرونده دارد. گردش اختصاصی سهم راننده، کمیسیون یا تسویه پیمانکار در کد فعلی تأیید نشد و باید در دمو بررسی شود.'
        );
        $this->assertFaqSchemaMatchesVisibleContent(
            $content,
            'آیا شرکت بازرگانی خارجی می‌تواند مالی حمل‌های وارداتی و صادراتی را در سپند مدیریت کند؟',
            'سپند هزینه‌های حمل و گمرک را به پرونده حمل مرتبط می‌کند؛ اما یک نرم‌افزار حسابداری بازرگانی خارجی کامل به محاسبه بهای تمام‌شده هر قلم، تخصیص هزینه به اقلام و حسابداری تخصصی واردات یا صادرات نیاز دارد. این قابلیت‌ها در شواهد فعلی تأیید نشدند و باید جداگانه ارزیابی شوند.'
        );
        $this->assertFaqSchemaMatchesVisibleContent(
            $content,
            'قیمت نرم‌افزار حسابداری حمل‌ونقل بین‌المللی سپند چطور محاسبه می‌شود؟',
            'برای برآورد هزینه استفاده از ماژول مالی و حسابداری چندارزی، تعداد کاربران و دوره پرداخت را در محاسبه‌گر تعرفه سپند انتخاب کنید. طبق تعرفه فعلی، مبلغ اشتراک بر اساس تعداد کاربران محاسبه می‌شود و ترکیب ماژول‌ها آن را تغییر نمی‌دهد. هزینه خدمات جانبی و شرایط استقرار در پیشنهاد رسمی مشخص می‌شوند.'
        );
    }

    private function assertFaqSchemaMatchesVisibleContent(string $content, string $question, string $answer): void
    {
        preg_match_all('/<script type="application\/ld\+json">(.*?)<\/script>/s', $content, $matches);
        $this->assertNotEmpty($matches[1]);

        $faqQuestions = [];
        foreach ($matches[1] as $json) {
            $data = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
            foreach ($data['@graph'] ?? [] as $node) {
                if (($node['@type'] ?? null) === 'FAQPage') {
                    $faqQuestions = array_merge($faqQuestions, $node['mainEntity'] ?? []);
                }
            }
        }

        $matchedQuestion = collect($faqQuestions)->firstWhere('name', $question);
        $this->assertNotNull($matchedQuestion);
        $this->assertSame($answer, $matchedQuestion['acceptedAnswer']['text']);
    }
}
