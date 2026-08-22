<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomepageProductShowcaseTest extends TestCase
{
    public function test_homepage_renders_automatic_laptop_and_phone_slider_inside_hero_without_controls(): void
    {
        $content = $this->get('/')
            ->assertOk()
            ->assertSee('class="hero-device-showcase"', false)
            ->assertSee('data-hero-device-showcase', false)
            ->assertSee('data-autoplay="5200"', false)
            ->assertSee('class="hero-showcase-laptop"', false)
            ->assertSee('class="hero-showcase-phone"', false)
            ->assertSee('class="laptop-frame"', false)
            ->assertSee('class="phone-frame"', false)
            ->assertSee('window.setInterval', false)
            ->assertSee('prefers-reduced-motion: reduce', false)
            ->assertDontSee('id="product-showcase"', false)
            ->assertDontSee('class="product-shot"', false)
            ->assertDontSee('data-device-slider', false)
            ->assertDontSee('data-slider-prev', false)
            ->assertDontSee('data-slider-next', false)
            ->assertDontSee('data-slider-dot', false)
            ->assertDontSee('data-slider-toggle', false)
            ->assertDontSee('touchstart', false)
            ->assertDontSee('touchend', false)
            ->getContent();

        preg_match_all('/<figure class="device-slide(?: is-active)?"[^>]*data-desktop-slide/', $content, $desktopSlides);
        preg_match_all('/<figure class="device-slide(?: is-active)?"[^>]*data-mobile-slide/', $content, $mobileSlides);

        $this->assertCount(3, $desktopSlides[0]);
        $this->assertCount(3, $mobileSlides[0]);
        $this->assertSame(1, substr_count($content, '<h1'));
        $this->assertStringNotContainsString('C:/temp/', $content);
    }

    public function test_product_showcase_uses_optimized_webp_images_with_expected_dimensions(): void
    {
        $images = [
            'desktop-dashboard.webp' => [1600, 799],
            'desktop-calendar.webp' => [1600, 840],
            'desktop-reports.webp' => [1600, 844],
            'mobile-dashboard.webp' => [720, 1447],
            'mobile-inquiry.webp' => [720, 1451],
            'mobile-operation.webp' => [720, 1438],
        ];

        foreach ($images as $filename => [$expectedWidth, $expectedHeight]) {
            $path = public_path('assets/images/marketing/product-showcase/'.$filename);
            $this->assertFileExists($path);

            $size = getimagesize($path);
            $this->assertIsArray($size);
            $this->assertSame($expectedWidth, $size[0]);
            $this->assertSame($expectedHeight, $size[1]);
            $this->assertSame('image/webp', $size['mime']);
            $this->assertLessThan(100_000, filesize($path));
        }
    }

    public function test_hero_product_showcase_has_responsive_device_layout_rules(): void
    {
        $styles = file_get_contents(public_path('assets/css/home.css'));

        $this->assertIsString($styles);
        $this->assertStringContainsString('.hero-device-showcase', $styles);
        $this->assertStringContainsString('.hero-showcase-laptop', $styles);
        $this->assertStringContainsString('.hero-showcase-phone', $styles);
        $this->assertStringContainsString('.device-viewport-desktop', $styles);
        $this->assertStringContainsString('.device-viewport-mobile', $styles);
        $this->assertStringContainsString('@media (max-width: 820px)', $styles);
        $this->assertStringContainsString('@media (max-width: 580px)', $styles);
        $this->assertStringNotContainsString('.product-showcase-stage', $styles);
        $this->assertStringNotContainsString('.device-slider-controls', $styles);
        $this->assertStringNotContainsString('.slider-control', $styles);
    }
}
