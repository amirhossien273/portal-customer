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
            ->assertSee('<title>قیمت نرم افزار حمل و نقل و خرید نرم افزار فورواردری | سپند</title>', false)
            ->assertSee('<meta name="description" content="قیمت نرم افزار حمل و نقل سپند را بر اساس تعداد کاربران محاسبه کنید و برای خرید نرم افزار فورواردری، دمو و مشاوره تخصصی دریافت کنید.">', false)
            ->assertSee('<meta name="keywords" content="قیمت نرم افزار حمل و نقل، خرید نرم افزار فورواردری، خرید نرم افزار فورواردی، تعرفه نرم افزار حمل و نقل">', false)
            ->assertSee('assets/css/marketing-pricing-calculator.css', false)
            ->assertSee('data-pricing-calculator', false)
            ->assertSee('type="range" min="5" max="100" step="1" value="5"', false)
            ->assertSee('data-billing="monthly" aria-pressed="false"', false)
            ->assertSee('data-billing="annual" aria-pressed="true"', false)
            ->assertSee('پنل اختصاصی', false)
            ->assertSee('href="'.self::SITE_URL.'/consultation" data-ga-event="cta_click" data-ga-label="pricing_custom_panel_demo"', false)
            ->assertSee('pricing-tier-list', false)
            ->assertSee('pricing-summary', false)
            ->assertSee('data-price-tier', false)
            ->assertDontSee('استعلام تعرفه', false);

        $this->assertSame(1, substr_count($content, '<h1'));
        $this->assertSame(4, preg_match_all('/<article[^>]+data-price-tier/', $content));
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
            ->assertSee('const saving=(tier.monthly-tier.annual)*users*12', false);
    }
}
