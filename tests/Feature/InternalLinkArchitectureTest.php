<?php

namespace Tests\Feature;

use DOMDocument;
use DOMElement;
use DOMXPath;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class InternalLinkArchitectureTest extends TestCase
{
    private const SITE_URL = 'https://sepandcrm.ir';

    /** @var array<string, string> */
    private array $htmlByPath = [];

    protected function setUp(): void
    {
        parent::setUp();

        config()->set('app.url', self::SITE_URL);
        config()->set('marketing.site_url', self::SITE_URL);
        URL::forceRootUrl(self::SITE_URL);
    }

    public function test_internal_link_registry_covers_every_indexable_page_with_a_valid_tier_and_cluster(): void
    {
        $sitemapPaths = $this->sitemapPaths();
        $registeredPages = config('site_internal_linking.pages', []);
        $registeredPaths = array_keys($registeredPages);
        sort($sitemapPaths);
        sort($registeredPaths);

        $this->assertCount(58, $sitemapPaths);
        $this->assertSame($sitemapPaths, $registeredPaths);

        foreach ($registeredPages as $path => $page) {
            $this->assertContains($page['tier'], [1, 2, 3], $path);
            $this->assertNotSame('', trim($page['cluster']), $path);

            $linkCount = count($page['links']);
            if (in_array($page['tier'], [1, 2], true)) {
                $this->assertGreaterThanOrEqual(3, $linkCount, $path);
                $this->assertLessThanOrEqual(6, $linkCount, $path);
            } else {
                $this->assertGreaterThanOrEqual(2, $linkCount, $path);
                $this->assertLessThanOrEqual(4, $linkCount, $path);
            }

            $this->assertSame($page['links'], array_values(array_unique($page['links'])), $path.' has duplicate targets');
        }
    }

    public function test_every_contextual_link_is_descriptive_direct_and_points_to_an_indexable_canonical_page(): void
    {
        $targets = config('site_internal_linking.targets', []);
        $registeredPages = config('site_internal_linking.pages', []);
        $redirectSources = array_keys(config('site_seo_strategy.redirects', []));
        $genericAnchors = ['بیشتر بدانید', 'مشاهده بیشتر', 'کلیک کنید', 'اینجا', 'مشاهده راهکار', 'مشاهده صفحه'];
        $anchorsByTarget = [];

        foreach ($registeredPages as $path => $page) {
            $document = $this->documentFor($path);
            $xpath = new DOMXPath($document);
            $links = $xpath->query('//a[contains(concat(" ", normalize-space(@class), " "), " contextual-link ")]');

            $this->assertSame(count($page['links']), $links->length, $path);

            foreach ($links as $link) {
                $this->assertInstanceOf(DOMElement::class, $link);
                $href = $link->getAttribute('href');
                $targetPath = $this->normalizePath((string) parse_url($href, PHP_URL_PATH));
                $anchor = trim(preg_replace('/\s+/u', ' ', $link->textContent) ?: '');

                $this->assertNotContains($anchor, $genericAnchors, $path);
                $this->assertNotContains($targetPath, $redirectSources, $path);
                $this->assertArrayHasKey($targetPath, $registeredPages, $path.' => '.$targetPath);
                $this->assertSame('', (string) parse_url($href, PHP_URL_QUERY), $path.' => '.$href);
                $this->assertNotSame($path, $targetPath, $path);

                $anchorsByTarget[$targetPath][$anchor] = true;
            }
        }

        foreach ($anchorsByTarget as $targetPath => $anchors) {
            $inboundCount = $this->contextualInboundCount($targetPath, $registeredPages, $targets);
            if ($inboundCount > 1) {
                $this->assertGreaterThan(1, count($anchors), $targetPath.' needs anchor variation');
            }
        }
    }

    public function test_tier_one_receives_the_strongest_contextual_link_equity(): void
    {
        $targets = config('site_internal_linking.targets', []);
        $pages = config('site_internal_linking.pages', []);
        $inbound = array_fill_keys(array_keys($pages), 0);

        foreach ($pages as $page) {
            foreach ($page['links'] as $targetKey) {
                $inbound[$targets[$targetKey]['path']]++;
            }
        }

        $averages = [];
        foreach ([1, 2, 3] as $tier) {
            $paths = array_keys(array_filter($pages, static fn (array $page): bool => $page['tier'] === $tier));
            $averages[$tier] = array_sum(array_intersect_key($inbound, array_flip($paths))) / count($paths);
        }

        $this->assertGreaterThan($averages[2], $averages[1]);
        $this->assertGreaterThan($averages[3], $averages[2]);
    }

    public function test_sitemap_breadcrumbs_and_all_rendered_internal_targets_are_technically_clean(): void
    {
        $sitemap = $this->get('/sitemap.xml')->assertOk()->getContent();
        $this->assertStringNotContainsString('127.0.0.1', $sitemap);
        $this->assertStringNotContainsString('localhost', $sitemap);
        $this->assertSame([parse_url(self::SITE_URL, PHP_URL_HOST)], $this->sitemapHosts($sitemap));

        $redirectSources = array_keys(config('site_seo_strategy.redirects', []));
        $checkedTargets = [];

        foreach ($this->sitemapPaths() as $path) {
            $document = $this->documentFor($path);
            $xpath = new DOMXPath($document);

            if ($path !== '/') {
                $this->assertGreaterThan(0, $xpath->query('//*[contains(translate(@class,"ABCDEFGHIJKLMNOPQRSTUVWXYZ","abcdefghijklmnopqrstuvwxyz"), "breadcrumb")]')->length, $path);
            }

            foreach ($xpath->query('//a[@href]') as $link) {
                if (! $link instanceof DOMElement) {
                    continue;
                }

                $href = trim($link->getAttribute('href'));
                if ($href === '' || str_starts_with($href, '#') || preg_match('#^(?:mailto|tel|javascript):#i', $href)) {
                    continue;
                }

                $host = (string) parse_url($href, PHP_URL_HOST);
                if ($host !== '' && $host !== parse_url(self::SITE_URL, PHP_URL_HOST)) {
                    continue;
                }

                $targetPath = $this->normalizePath((string) parse_url($href, PHP_URL_PATH));
                $this->assertNotContains($targetPath, $redirectSources, $path.' contains a legacy SEO URL');

                if (isset($checkedTargets[$targetPath]) || in_array($targetPath, ['/tracking', '/organization-portal'], true)) {
                    continue;
                }

                $checkedTargets[$targetPath] = true;
                $response = $this->get($targetPath);
                $this->assertLessThan(400, $response->getStatusCode(), $path.' => '.$targetPath);
            }
        }
    }

    public function test_megamenu_exposes_only_the_solution_hub_and_six_topic_authorities(): void
    {
        $expected = [
            '/solutions',
            '/modules/crm',
            '/modules/transport-operations',
            '/modules/finance-accounting',
            '/modules/document-management',
            '/solutions/fleet-management',
            '/solutions/nvocc',
        ];

        foreach (['/', '/product', '/solutions/operation-exception-management'] as $path) {
            $xpath = new DOMXPath($this->documentFor($path));
            $actual = [];
            foreach ($xpath->query('//*[contains(concat(" ", normalize-space(@class), " "), " solutions-menu ")]//a[@href]') as $link) {
                $actual[] = $this->normalizePath((string) parse_url($link->getAttribute('href'), PHP_URL_PATH));
            }

            $this->assertSame($expected, $actual, $path);
        }
    }

    /** @return list<string> */
    private function sitemapPaths(): array
    {
        $document = new DOMDocument();
        $document->loadXML($this->get('/sitemap.xml')->assertOk()->getContent());
        $xpath = new DOMXPath($document);
        $xpath->registerNamespace('sm', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        $paths = [];

        foreach ($xpath->query('//sm:url/sm:loc') as $node) {
            $paths[] = $this->normalizePath((string) parse_url(trim($node->textContent), PHP_URL_PATH));
        }

        return $paths;
    }

    /** @return list<string> */
    private function sitemapHosts(string $sitemap): array
    {
        preg_match_all('#<loc>(https?://[^/]+)#', $sitemap, $matches);

        return array_values(array_unique(array_map(static fn (string $url): string => (string) parse_url($url, PHP_URL_HOST), $matches[1])));
    }

    private function documentFor(string $path): DOMDocument
    {
        if (! isset($this->htmlByPath[$path])) {
            $this->htmlByPath[$path] = $this->get($path)->assertOk()->getContent();
        }

        $document = new DOMDocument();
        @$document->loadHTML('<?xml encoding="utf-8" ?>'.$this->htmlByPath[$path]);

        return $document;
    }

    private function normalizePath(string $path): string
    {
        $path = rawurldecode($path === '' ? '/' : $path);
        $path = preg_replace('#/+#', '/', $path) ?: '/';

        return $path === '/' ? '/' : rtrim($path, '/');
    }

    private function contextualInboundCount(string $targetPath, array $pages, array $targets): int
    {
        $count = 0;

        foreach ($pages as $page) {
            foreach ($page['links'] as $targetKey) {
                if ($targets[$targetKey]['path'] === $targetPath) {
                    $count++;
                }
            }
        }

        return $count;
    }
}
