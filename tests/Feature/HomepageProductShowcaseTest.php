<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomepageProductShowcaseTest extends TestCase
{
    public function test_homepage_renders_laptop_and_phone_sliders_with_accessible_controls(): void
    {
        $content = $this->get('/')
            ->assertOk()
            ->assertSee('id="product-showcase"', false)
            ->assertSee('id="product-showcase-title"', false)
            ->assertSee('نمای کامل نسخه دسکتاپ', false)
            ->assertSee('تجربه روان روی موبایل', false)
            ->assertSee('class="laptop-frame"', false)
            ->assertSee('class="phone-frame"', false)
            ->assertSee('aria-label="توقف نمایش خودکار نسخه دسکتاپ"', false)
            ->assertSee('aria-label="توقف نمایش خودکار نسخه موبایل"', false)
            ->assertSee('touchstart', false)
            ->assertSee('prefers-reduced-motion: reduce', false)
            ->getContent();

        preg_match_all('/<div class="device-slider"[^>]*data-device-slider/', $content, $sliders);
        preg_match_all('/<figure class="device-slide(?: is-active)?"[^>]*data-device-slide/', $content, $slides);
        preg_match_all('/<button class="slider-control slider-toggle"[^>]*data-slider-toggle/', $content, $toggles);

        $this->assertCount(2, $sliders[0]);
        $this->assertCount(6, $slides[0]);
        $this->assertSame(6, substr_count($content, 'data-slider-dot='));
        $this->assertCount(2, $toggles[0]);
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

    public function test_product_showcase_has_mobile_specific_layout_rules(): void
    {
        $styles = file_get_contents(public_path('assets/css/home.css'));

        $this->assertIsString($styles);
        $this->assertStringContainsString('.product-showcase-stage', $styles);
        $this->assertStringContainsString('.device-viewport-desktop', $styles);
        $this->assertStringContainsString('.device-viewport-mobile', $styles);
        $this->assertStringContainsString('@media (max-width: 820px)', $styles);
        $this->assertStringContainsString('@media (max-width: 580px)', $styles);
    }
}
