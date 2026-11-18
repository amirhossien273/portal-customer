<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class PricingCalculatorPageTest extends TestCase
{
    private const SITE_URL = 'https://sepandcrm.ir';

    protected function setUp(): void
    {
        parent::setUp();

        config(['app.url' => self::SITE_URL]);
        URL::forceRootUrl(self::SITE_URL);
        URL::forceScheme('https');
    }

    public function test_pricing_page_has_an_accessible_user_and_billing_calculator(): void
    {
        $response = $this->get('/pricing')->assertOk();
        $content = $response->getContent();

        $response
            ->assertSee('<title>قیمت نرم‌افزار حمل‌ونقل بین‌المللی | تعرفه سپند</title>', false)
            ->assertSee('<meta name="description" content="قیمت نرم‌افزار حمل‌ونقل بین‌المللی سپند را بر اساس تعداد کاربران و پرداخت ماهانه یا سالانه محاسبه کنید و برای دریافت پیشنهاد نهایی درخواست دمو بدهید.">', false)
            ->assertSee('<link rel="canonical" href="'.self::SITE_URL.'/pricing">', false)
            ->assertSee('<h1>قیمت نرم‌افزار حمل‌ونقل بین‌المللی</h1>', false)
            ->assertDontSee('<meta name="keywords"', false)
            ->assertSee('assets/css/marketing-pricing-calculator.css', false)
            ->assertSee('data-pricing-calculator', false)
            ->assertSee('type="range" min="5" max="100" step="1" value="5"', false)
            ->assertSee('data-billing="monthly" aria-pressed="false"', false)
            ->assertSee('data-billing="annual" aria-pressed="true"', false)
            ->assertSee('قیمت اشتراک سپند فقط بر اساس تعداد کاربران محاسبه می‌شود', false)
            ->assertSee('تومان برای هر کاربر در ماه', false)
            ->assertSee('معادل هزینه ماهانه تیم در اشتراک سالانه', false)
            ->assertSee('مبلغ قابل پرداخت یک‌ساله', false)
            ->assertSee('درخواست دمو و پیشنهاد قیمت', false)
            ->assertSee('href="'.self::SITE_URL.'/consultation?pricing_users=5&amp;billing=annual"', false)
            ->assertSee('href="'.self::SITE_URL.'/product"', false)
            ->assertSee('href="'.self::SITE_URL.'/modules"', false)
            ->assertSee('href="'.self::SITE_URL.'/compare"', false)
            ->assertSee('data-summary-billing', false)
            ->assertSee('data-summary-rate', false)
            ->assertSee('pricing-tier-list', false)
            ->assertSee('pricing-summary', false)
            ->assertSee('data-price-tier', false)
            ->assertSee('"@type":"WebPage"', false)
            ->assertSee('"@type":"BreadcrumbList"', false)
            ->assertSee('"@type":"FAQPage"', false)
            ->assertDontSee('"@type":"Offer"', false)
            ->assertDontSee('Query', false)
            ->assertDontSee('Intent', false)
            ->assertDontSee('Cluster', false)
            ->assertDontSee('صفحه مالک', false)
            ->assertDontSee('قیمت بر اساس کاربران و ماژول‌ها', false);

        $this->assertSame(1, substr_count($content, '<h1'));
        $this->assertSame(4, preg_match_all('/<article[^>]+data-price-tier/', $content));
        preg_match_all('/<script type="application\/ld\+json">(.*?)<\/script>/s', $content, $structuredData);
        $this->assertNotEmpty($structuredData[1]);
        foreach ($structuredData[1] as $json) {
            $this->assertIsArray(json_decode($json, true, 512, JSON_THROW_ON_ERROR));
        }
    }

    public function test_all_user_tiers_and_default_annual_totals_are_rendered(): void
    {
        $response = $this->get('/pricing')->assertOk();

        foreach ([
            'data-min-users="5" data-max-users="10" data-monthly-rate="2500000" data-annual-rate="2200000"',
            'data-min-users="11" data-max-users="15" data-monthly-rate="2200000" data-annual-rate="1900000"',
            'data-min-users="16" data-max-users="25" data-monthly-rate="1900000" data-annual-rate="1600000"',
            'data-min-users="26" data-max-users="100" data-monthly-rate="1600000" data-annual-rate="1300000"',
        ] as $tier) {
            $response->assertSee($tier, false);
        }

        $response
            ->assertSee('<span data-per-user-price>۲٬۲۰۰٬۰۰۰</span>', false)
            ->assertSee('<span data-monthly-total>۱۱٬۰۰۰٬۰۰۰</span>', false)
            ->assertSee('<span data-payable-total>۱۳۲٬۰۰۰٬۰۰۰</span>', false)
            ->assertSee('<span data-saving-total>۱۸٬۰۰۰٬۰۰۰</span>', false)
            ->assertSee('const payable=billing===\'annual\'?monthlyTotal*12:monthlyTotal', false)
            ->assertSee('const saving=(tier.monthly-tier.annual)*users*12', false)
            ->assertSee("setText('[data-monthly-total-label]',annual?'معادل هزینه ماهانه تیم در اشتراک سالانه':'جمع هزینه تیم در ماه')", false)
            ->assertSee("setText('[data-payable-label]',annual?'مبلغ قابل پرداخت یک‌ساله':'مبلغ قابل پرداخت ماه جاری')", false);
    }

    public function test_pricing_math_is_correct_at_every_tier_boundary_for_both_billing_periods(): void
    {
        $tiers = config('marketing_pricing.tiers');
        $this->assertSame(5, config('marketing_pricing.min_users'));
        $this->assertSame(100, config('marketing_pricing.max_users'));
        $this->assertSame(5, $tiers[0]['min']);
        $this->assertSame(100, $tiers[array_key_last($tiers)]['max']);
        foreach (array_slice($tiers, 1) as $index => $tier) {
            $this->assertSame($tiers[$index]['max'] + 1, $tier['min']);
        }

        $expectations = [
            5 => [2_500_000, 2_200_000, 12_500_000, 132_000_000],
            10 => [2_500_000, 2_200_000, 25_000_000, 264_000_000],
            11 => [2_200_000, 1_900_000, 24_200_000, 250_800_000],
            15 => [2_200_000, 1_900_000, 33_000_000, 342_000_000],
            16 => [1_900_000, 1_600_000, 30_400_000, 307_200_000],
            25 => [1_900_000, 1_600_000, 47_500_000, 480_000_000],
            26 => [1_600_000, 1_300_000, 41_600_000, 405_600_000],
            100 => [1_600_000, 1_300_000, 160_000_000, 1_560_000_000],
        ];

        foreach ($expectations as $users => [$monthlyRate, $annualRate, $monthlyPayable, $annualPayable]) {
            $tier = collect($tiers)->first(
                static fn (array $candidate): bool => $users >= $candidate['min'] && $users <= $candidate['max']
            );

            $this->assertNotNull($tier, "No tier found for {$users} users.");
            $this->assertSame($monthlyRate, $tier['monthly']);
            $this->assertSame($annualRate, $tier['annual']);
            $this->assertSame($monthlyPayable, $tier['monthly'] * $users);
            $this->assertSame($annualPayable, $tier['annual'] * $users * 12);
        }
    }

    public function test_calculator_selection_is_transferred_to_the_consultation_form(): void
    {
        $response = $this->get('/consultation?pricing_users=16&billing=monthly')->assertOk();

        $response
            ->assertSee('انتخاب محاسبه‌گر منتقل شد:', false)
            ->assertSee('<strong>16 کاربر، پرداخت ماهانه</strong>', false)
            ->assertSee('<option value="16 تا 30 نفر" selected>16 تا 30 نفر</option>', false)
            ->assertSee('انتخاب از محاسبه‌گر تعرفه: 16 کاربر، پرداخت ماهانه.', false);
    }

    public function test_mobile_styles_stack_controls_and_keep_the_result_action_easy_to_use(): void
    {
        $styles = file_get_contents(public_path('assets/css/marketing-pricing-calculator.css'));

        $this->assertIsString($styles);
        $this->assertStringContainsString('@media(max-width:980px)', $styles);
        $this->assertStringContainsString('.pricing-calculator{grid-template-columns:1fr}', $styles);
        $this->assertStringContainsString('.pricing-summary{position:relative;top:auto}', $styles);
        $this->assertStringContainsString('@media(max-width:620px)', $styles);
        $this->assertStringContainsString('.pricing-billing-toggle{grid-template-columns:1fr}', $styles);
        $this->assertStringContainsString('.pricing-user-stepper{width:100%;justify-content:space-between}', $styles);
        $this->assertStringContainsString('.pricing-summary>.btn{min-height:52px}', $styles);
    }
}
