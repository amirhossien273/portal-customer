<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class FloatingConsultationCtaTest extends TestCase
{
    private const SITE_URL = 'https://sepandcrm.ir';

    protected function setUp(): void
    {
        parent::setUp();

        config(['app.url' => self::SITE_URL]);
        URL::forceRootUrl(self::SITE_URL);
        URL::forceScheme('https');
    }

    public function test_floating_consultation_cta_is_available_on_all_marketing_page_types(): void
    {
        $paths = [
            '/',
            '/modules',
            '/pricing',
            '/about',
            '/faq',
            '/compare/sepand-vs-other-transport-software',
            '/modules/crm',
            '/transport-modes/air',
            '/consultation',
        ];

        foreach ($paths as $path) {
            $response = $this->get($path)->assertOk();
            $content = $response->getContent();

            $response
                ->assertSee('assets/css/marketing-floating-cta.css', false)
                ->assertSee('درخواست دمو و مشاوره نرم‌افزار حمل‌ونقل سپند', false)
                ->assertSee('درخواست دمو و مشاوره', false)
                ->assertSee('data-floating-consultation-cta', false)
                ->assertDontSee('target="_blank"', false);

            $this->assertSame(1, substr_count($content, 'class="floating-consultation-cta"'));

            if ($path === '/consultation') {
                $response
                    ->assertSee('href="#consultation-form"', false)
                    ->assertSee('data-ga-label="floating_consultation_form"', false);
            } else {
                $response
                    ->assertSee('href="'.self::SITE_URL.'/consultation"', false)
                    ->assertSee('data-ga-label="floating_consultation_global"', false);
            }
        }
    }
}
