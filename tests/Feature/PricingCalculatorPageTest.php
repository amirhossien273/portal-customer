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
            ->assertSee('assets/css/marketing-pricing-calculator.css', false)
            ->assertSee('data-pricing-calculator', false)
            ->assertSee('type="range" min="5" max="100" step="1" value="5"', false)
            ->assertSee('data-billing="monthly" aria-pressed="false"', false)
            ->assertSee('data-billing="annual" aria-pressed="true"', false)
            ->assertSee('درخواست دمو و مشاوره خرید', false)
            ->assertDontSee('استعلام تعرفه', false);

        preg_match_all('/<article[^>]+data-price-tier\b/', $content, $tierElements);
        $this->assertCount(4, $tierElements[0]);
        $this->assertSame(1, substr_count($content, '<h1'));
    }

    public function test_all_user_tiers_and_default_annual_totals_are_rendered(): void
    {
        $response = $this->get('/pricing')->assertOk();

        foreach ([
            ['5', '10', '2500000', '2200000'],
            ['11', '15', '2200000', '1900000'],
            ['16', '25', '1900000', '1600000'],
            ['26', '100', '1600000', '1300000'],
        ] as [$min, $max, $monthly, $annual]) {
            $response->assertSee(
                'data-min-users="'.$min.'" data-max-users="'.$max.'" data-monthly-rate="'.$monthly.'" data-annual-rate="'.$annual.'"',
                false
            );
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
