<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class ModuleScreenshotGalleryTest extends TestCase
{
    private const SITE_URL = 'https://sepandcrm.ir';

    protected function setUp(): void
    {
        parent::setUp();

        config(['app.url' => self::SITE_URL, 'marketing.site_url' => self::SITE_URL]);
        URL::forceRootUrl(self::SITE_URL);
        URL::forceScheme('https');
    }

    public function test_real_screenshots_are_mapped_to_their_related_module_pages(): void
    {
        $configured = config('module_screenshots');

        $this->assertSame(
            [
                'crm', 'pricing-sales', 'booking', 'transport-operations', 'document-management',
                'finance-accounting', 'workflow-tasks', 'automatic-tasks', 'customer-portal-tracking',
                'email-workflow-automation',
                'operations-control-tower', 'document-checklists', 'fleet-dispatch',
            ],
            array_keys($configured)
        );
        $this->assertSame(23, array_sum(array_map('count', $configured)));

        foreach ($configured as $slug => $screenshots) {
            $content = $this->get('/modules/'.$slug)
                ->assertOk()
                ->assertSee('data-module-screenshot-slider', false)
                ->assertSee('aria-roledescription="carousel"', false)
                ->assertSee('touchstart', false)
                ->getContent();

            preg_match_all('/<figure[^>]*data-module-screenshot\b/', $content, $renderedScreenshots);
            $this->assertCount(count($screenshots), $renderedScreenshots[0]);
            $this->assertSame(1, substr_count($content, '<h1'));
            $this->assertStringNotContainsString('C:/temp/', $content);

            foreach ($screenshots as $screenshot) {
                $contentPath = 'assets/images/marketing/'.$screenshot['path'];
                $this->assertStringContainsString($contentPath, $content);
                $this->assertStringContainsString(e($screenshot['alt']), $content);
            }

            $primary = $screenshots[0];
            $this->assertStringContainsString('<meta property="og:image" content="'.self::SITE_URL.'/assets/images/marketing/'.$primary['path'].'">', $content);
            $this->assertStringContainsString('<meta property="og:image:width" content="'.$primary['width'].'">', $content);
            $this->assertStringContainsString('<meta property="og:image:height" content="'.$primary['height'].'">', $content);
        }
    }

    public function test_every_configured_screenshot_is_an_optimized_webp_with_declared_dimensions(): void
    {
        foreach (config('module_screenshots') as $screenshots) {
            foreach ($screenshots as $screenshot) {
                $path = public_path('assets/images/marketing/'.$screenshot['path']);
                $this->assertFileExists($path);

                $size = getimagesize($path);
                $this->assertIsArray($size);
                $this->assertSame($screenshot['width'], $size[0]);
                $this->assertSame($screenshot['height'], $size[1]);
                $this->assertSame('image/webp', $size['mime']);
                $this->assertLessThan(100_000, filesize($path));
            }
        }
    }

    public function test_module_sitemap_lists_all_real_screenshots(): void
    {
        $sitemap = $this->get('/sitemap.xml')->assertOk()->getContent();

        foreach (config('module_screenshots') as $screenshots) {
            foreach ($screenshots as $screenshot) {
                $url = self::SITE_URL.'/assets/images/marketing/'.$screenshot['path'];
                $expectedOccurrences = collect(config('module_screenshots'))
                    ->flatten(1)
                    ->where('path', $screenshot['path'])
                    ->count();

                $expectedOccurrences += collect(['guides', 'solutions'])
                    ->flatMap(fn (string $group) => config('site_content_pages.'.$group, []))
                    ->where('image', $screenshot['path'])
                    ->count();

                $expectedOccurrences += collect(config('site_platform_solutions.pages', []))
                    ->flatMap(fn (array $page) => $page['evidence'] ?? [])
                    ->where('image', $screenshot['path'])
                    ->count();

                if ($screenshot['path'] === 'product-showcase/desktop-dashboard.webp') {
                    // Product overview and the platform-solutions hub each publish this image.
                    $expectedOccurrences += 2;
                }

                if ($screenshot['path'] === 'modules/screenshots/pricing-sales-workflow.webp') {
                    $expectedOccurrences++;
                }

                $this->assertSame($expectedOccurrences, substr_count($sitemap, '<image:loc>'.$url.'</image:loc>'));
            }
        }

        $this->assertSame(array_keys(config('site_modules')), array_keys(config('module_screenshots')));
    }
}
