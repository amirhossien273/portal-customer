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

    public function test_consultation_cta_is_in_the_header_on_all_marketing_page_types(): void
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
            '/consultation/process-review',
        ];

        foreach ($paths as $path) {
            $response = $this->get($path)->assertOk();
            $content = $response->getContent();

            $response
                ->assertSee('assets/css/marketing-floating-cta.css', false)
                ->assertSee('درخواست دمو و مشاوره نرم‌افزار حمل‌ونقل سپند', false)
                ->assertSee('درخواست دمو و مشاوره', false)
                ->assertSee('راهکار مناسب شما', false)
                ->assertSee('data-floating-consultation-cta', false);

            $this->assertSame(2, substr_count($content, 'class="floating-consultation-cta '));
            $this->assertSame(1, substr_count($content, 'data-floating-consultation-cta="mobile-header"'));
            $this->assertSame(1, substr_count($content, 'data-floating-consultation-cta="desktop-floating"'));
            $this->assertLessThan(
                strpos($content, '</header>'),
                strpos($content, 'data-floating-consultation-cta="mobile-header"')
            );
            $this->assertGreaterThan(
                strpos($content, '</header>'),
                strpos($content, 'data-floating-consultation-cta="desktop-floating"')
            );

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

    public function test_process_review_replaces_tracking_in_both_navigation_variants(): void
    {
        $content = $this->get('/')->assertOk()->getContent();

        $this->assertSame(2, substr_count($content, 'راهکار مناسب شما'));
        $this->assertStringContainsString('data-ga-label="mobile_process_review"', $content);
        $this->assertStringContainsString('data-ga-label="desktop_process_review"', $content);
        $this->assertStringNotContainsString('data-ga-label="mobile_tracking"', $content);
        $this->assertStringNotContainsString('data-ga-label="desktop_tracking"', $content);
    }
}
