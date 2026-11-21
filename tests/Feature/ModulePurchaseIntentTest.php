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
            ->assertSee('<link rel="canonical" href="'.self::SITE_URL.'/modules/finance-accounting">', false)
            ->assertSee('<summary>قیمت نرم‌افزار حسابداری حمل‌ونقل بین‌المللی سپند چطور محاسبه می‌شود؟</summary>', false)
            ->assertSee('در <a href="'.self::SITE_URL.'/pricing">محاسبه‌گر تعرفه سپند</a> انتخاب کنید.', false);

        $this->assertSame(1, substr_count($content, '<h1'));
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
