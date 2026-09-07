<?php

declare(strict_types=1);

/**
 * Crawl every indexable URL in the marketing sitemap and measure the internal
 * linking graph by placement. The script deliberately runs outside Laravel so
 * it can audit the rendered application exactly as a crawler receives it.
 *
 * Usage:
 * php scripts/seo/internal-link-audit.php \
 *   --base=http://127.0.0.1:8000 \
 *   --site=https://sepandcrm.ir \
 *   --out=.codex_tmp/internal-links.json
 */

$options = getopt('', ['base:', 'site:', 'out:']);
$baseUrl = rtrim((string) ($options['base'] ?? ''), '/');
$siteUrl = rtrim((string) ($options['site'] ?? ''), '/');
$outputPath = (string) ($options['out'] ?? '');

if ($baseUrl === '' || $siteUrl === '' || $outputPath === '') {
    fwrite(STDERR, "Required options: --base, --site and --out\n");
    exit(2);
}

function fetchUrl(string $url): array
{
    $context = stream_context_create([
        'http' => [
            'ignore_errors' => true,
            'follow_location' => 0,
            'timeout' => 20,
            'header' => "User-Agent: SepandCRM-Internal-Link-Audit/1.0\r\n",
        ],
    ]);

    $body = @file_get_contents($url, false, $context);
    $headers = $http_response_header ?? [];
    $status = 0;

    foreach ($headers as $header) {
        if (preg_match('/^HTTP\/\S+\s+(\d{3})/', $header, $matches) === 1) {
            $status = (int) $matches[1];
            break;
        }
    }

    return [
        'status' => $status,
        'body' => is_string($body) ? $body : '',
        'headers' => $headers,
    ];
}

function normalizePath(string $path): string
{
    $decoded = rawurldecode($path === '' ? '/' : $path);
    $normalized = preg_replace('#/+#', '/', $decoded) ?: '/';

    return $normalized === '/' ? '/' : rtrim($normalized, '/');
}

function classTokens(DOMElement $element): array
{
    return preg_split('/\s+/', trim($element->getAttribute('class'))) ?: [];
}

function placementFor(DOMElement $link): string
{
    $node = $link;
    $insideParagraph = false;

    while ($node instanceof DOMElement) {
        $tag = strtolower($node->tagName);
        $tokens = classTokens($node);
        $id = strtolower($node->getAttribute('id'));
        $classes = strtolower(implode(' ', $tokens));

        if ($tag === 'header' || in_array('site-header', $tokens, true) || in_array('main-nav', $tokens, true)) {
            return 'header';
        }

        if ($tag === 'footer' || in_array('site-footer', $tokens, true)) {
            return 'footer';
        }

        if (str_contains($classes, 'breadcrumb') || str_contains($id, 'breadcrumb')) {
            return 'breadcrumb';
        }

        if (
            str_contains($classes, 'related') ||
            str_contains($classes, 'connection') ||
            str_contains($id, 'related') ||
            str_contains($id, 'connection')
        ) {
            return 'related';
        }

        if ($tag === 'p') {
            $insideParagraph = true;
        }

        $node = $node->parentNode;
    }

    if ($insideParagraph || in_array('contextual-link', classTokens($link), true)) {
        return 'contextual';
    }

    return 'other';
}

function textOf(DOMElement $element): string
{
    return trim(preg_replace('/\s+/u', ' ', $element->textContent) ?: '');
}

function absoluteTarget(string $href, string $sourceUrl): ?string
{
    $href = trim($href);

    if ($href === '' || str_starts_with($href, '#') || preg_match('#^(?:mailto|tel|javascript):#i', $href) === 1) {
        return null;
    }

    if (str_starts_with($href, '//')) {
        return 'https:'.$href;
    }

    if (preg_match('#^https?://#i', $href) === 1) {
        return $href;
    }

    $source = parse_url($sourceUrl);
    $origin = ($source['scheme'] ?? 'https').'://'.($source['host'] ?? '');

    if (str_starts_with($href, '/')) {
        return $origin.$href;
    }

    $sourcePath = $source['path'] ?? '/';
    $directory = rtrim(str_replace('\\', '/', dirname($sourcePath)), '/');

    return $origin.($directory === '' ? '' : $directory).'/'.$href;
}

function isInternalHost(string $url, array $allowedHosts): bool
{
    $host = strtolower((string) parse_url($url, PHP_URL_HOST));

    return $host === '' || in_array($host, $allowedHosts, true);
}

$sitemapResponse = fetchUrl($baseUrl.'/sitemap.xml');

if ($sitemapResponse['status'] !== 200) {
    fwrite(STDERR, "Unable to fetch sitemap: HTTP {$sitemapResponse['status']}\n");
    exit(1);
}

$sitemap = new DOMDocument();
libxml_use_internal_errors(true);
$sitemap->loadXML($sitemapResponse['body']);
$xpath = new DOMXPath($sitemap);
$xpath->registerNamespace('sm', 'http://www.sitemaps.org/schemas/sitemap/0.9');
$sitemapNodes = $xpath->query('//sm:url/sm:loc');
$indexablePaths = [];
$sitemapHosts = [];

foreach ($sitemapNodes ?: [] as $node) {
    $loc = trim($node->textContent);
    $path = normalizePath((string) parse_url($loc, PHP_URL_PATH));
    $indexablePaths[$path] = true;
    $host = strtolower((string) parse_url($loc, PHP_URL_HOST));

    if ($host !== '') {
        $sitemapHosts[$host] = true;
    }
}

$siteHost = strtolower((string) parse_url($siteUrl, PHP_URL_HOST));
$baseHost = strtolower((string) parse_url($baseUrl, PHP_URL_HOST));
$allowedHosts = array_values(array_unique(array_filter([$siteHost, $baseHost])));
$pages = [];
$edges = [];
$allInternalTargets = [];

foreach (array_keys($indexablePaths) as $path) {
    $response = fetchUrl($baseUrl.($path === '/' ? '/' : $path));
    $document = new DOMDocument();
    $loaded = $response['body'] !== '' && @$document->loadHTML('<?xml encoding="utf-8" ?>'.$response['body']);
    $page = [
        'url' => $path,
        'status' => $response['status'],
        'title' => '',
        'canonical' => '',
        'robots' => '',
        'has_breadcrumb' => false,
        'tier' => null,
        'cluster' => null,
        'outbound_internal_links' => 0,
        'outbound_unique_targets' => 0,
        'outbound_by_type' => array_fill_keys(['header', 'footer', 'breadcrumb', 'related', 'contextual', 'other'], 0),
    ];

    if (! $loaded) {
        $pages[$path] = $page;
        continue;
    }

    $pageXpath = new DOMXPath($document);
    $page['title'] = trim((string) ($pageXpath->query('//title')->item(0)?->textContent ?? ''));
    $page['canonical'] = trim((string) ($pageXpath->query('//link[translate(@rel,"ABCDEFGHIJKLMNOPQRSTUVWXYZ","abcdefghijklmnopqrstuvwxyz")="canonical"]')->item(0)?->attributes?->getNamedItem('href')?->nodeValue ?? ''));
    $page['robots'] = trim((string) ($pageXpath->query('//meta[translate(@name,"ABCDEFGHIJKLMNOPQRSTUVWXYZ","abcdefghijklmnopqrstuvwxyz")="robots"]')->item(0)?->attributes?->getNamedItem('content')?->nodeValue ?? ''));
    $page['has_breadcrumb'] = (bool) ($pageXpath->query('//*[contains(translate(@class,"ABCDEFGHIJKLMNOPQRSTUVWXYZ","abcdefghijklmnopqrstuvwxyz"), "breadcrumb")]')->length ?? 0);
    $linkingSection = $pageXpath->query('//*[@data-internal-link-tier and @data-internal-link-cluster]')->item(0);
    if ($linkingSection instanceof DOMElement) {
        $page['tier'] = (int) $linkingSection->getAttribute('data-internal-link-tier');
        $page['cluster'] = $linkingSection->getAttribute('data-internal-link-cluster');
    }
    $uniqueTargets = [];

    foreach ($pageXpath->query('//a[@href]') ?: [] as $anchor) {
        if (! $anchor instanceof DOMElement) {
            continue;
        }

        $href = $anchor->getAttribute('href');
        $targetUrl = absoluteTarget($href, $siteUrl.$path);

        if ($targetUrl === null || ! isInternalHost($targetUrl, $allowedHosts)) {
            continue;
        }

        $targetPath = normalizePath((string) parse_url($targetUrl, PHP_URL_PATH));
        $query = (string) parse_url($targetUrl, PHP_URL_QUERY);
        $placement = placementFor($anchor);
        $allInternalTargets[$targetPath] = true;

        if (! isset($indexablePaths[$targetPath])) {
            continue;
        }

        $edge = [
            'source' => $path,
            'target' => $targetPath,
            'anchor' => textOf($anchor),
            'type' => $placement,
            'query' => $query,
        ];
        $edges[] = $edge;

        if ($targetPath !== $path) {
            $page['outbound_internal_links']++;
            $page['outbound_by_type'][$placement]++;
            $uniqueTargets[$targetPath] = true;
        }
    }

    $page['outbound_unique_targets'] = count($uniqueTargets);
    $pages[$path] = $page;
}

$anchorMap = [];
$inboundEdges = [];

foreach ($edges as $edge) {
    if ($edge['source'] === $edge['target']) {
        continue;
    }

    $inboundEdges[$edge['target']][] = $edge;
    $anchor = $edge['anchor'] === '' ? '[بدون متن]' : $edge['anchor'];
    $anchorMap[$edge['target']][$anchor] = ($anchorMap[$edge['target']][$anchor] ?? 0) + 1;
}

foreach ($pages as $path => &$page) {
    $incoming = $inboundEdges[$path] ?? [];
    $sourcePages = [];
    $contextualSources = [];
    $typeCounts = array_fill_keys(['header', 'footer', 'breadcrumb', 'related', 'contextual', 'other'], 0);

    foreach ($incoming as $edge) {
        $sourcePages[$edge['source']] = true;
        $typeCounts[$edge['type']]++;

        if ($edge['type'] === 'contextual') {
            $contextualSources[$edge['source']] = true;
        }
    }

    $anchors = $anchorMap[$path] ?? [];
    arsort($anchors);
    $page['inbound_internal_links'] = count($incoming);
    $page['inbound_source_pages'] = count($sourcePages);
    $page['contextual_inbound_links'] = $typeCounts['contextual'];
    $page['contextual_inbound_sources'] = count($contextualSources);
    $page['navigation_inbound_links'] = $typeCounts['header'] + $typeCounts['footer'] + $typeCounts['breadcrumb'];
    $page['inbound_by_type'] = $typeCounts;
    $page['main_anchor_texts'] = array_slice($anchors, 0, 8, true);
    $page['orphan_risk'] = count($sourcePages) === 0
        ? 'orphan'
        : ($typeCounts['contextual'] === 0 && $typeCounts['related'] === 0 ? 'navigation-only' : ($typeCounts['contextual'] === 0 ? 'near-orphan' : 'low'));
}
unset($page);

$brokenTargets = [];
$redirectTargets = [];

foreach (array_keys($allInternalTargets) as $targetPath) {
    if (str_starts_with($targetPath, '/assets/')) {
        continue;
    }

    $response = fetchUrl($baseUrl.($targetPath === '/' ? '/' : $targetPath));

    if ($response['status'] >= 400 || $response['status'] === 0) {
        $brokenTargets[$targetPath] = $response['status'];
    } elseif ($response['status'] >= 300) {
        $location = '';
        foreach ($response['headers'] as $header) {
            if (stripos($header, 'Location:') === 0) {
                $location = trim(substr($header, 9));
                break;
            }
        }
        $redirectTargets[$targetPath] = ['status' => $response['status'], 'location' => $location];
    }
}

$contextualEdges = array_values(array_filter($edges, static fn (array $edge): bool => $edge['type'] === 'contextual' && $edge['source'] !== $edge['target']));
$nonSelfEdges = array_values(array_filter($edges, static fn (array $edge): bool => $edge['source'] !== $edge['target']));
$summary = [
    'indexable_pages' => count($pages),
    'internal_links' => count($nonSelfEdges),
    'unique_internal_edges' => count(array_unique(array_map(static fn (array $edge): string => $edge['source'].'>'.$edge['target'], $nonSelfEdges))),
    'contextual_links' => count($contextualEdges),
    'contextual_unique_edges' => count(array_unique(array_map(static fn (array $edge): string => $edge['source'].'>'.$edge['target'], $contextualEdges))),
    'orphan_pages' => count(array_filter($pages, static fn (array $page): bool => $page['orphan_risk'] === 'orphan')),
    'near_orphan_pages' => count(array_filter($pages, static fn (array $page): bool => in_array($page['orphan_risk'], ['near-orphan', 'navigation-only'], true))),
    'broken_internal_targets' => count($brokenTargets),
    'redirecting_internal_targets' => count($redirectTargets),
    'sitemap_hosts' => array_keys($sitemapHosts),
];

$report = [
    'generated_at' => date(DATE_ATOM),
    'base_url' => $baseUrl,
    'site_url' => $siteUrl,
    'summary' => $summary,
    'pages' => array_values($pages),
    'edges' => $edges,
    'technical' => [
        'broken_targets' => $brokenTargets,
        'redirect_targets' => $redirectTargets,
    ],
];

$directory = dirname($outputPath);
if (! is_dir($directory) && ! mkdir($directory, 0777, true) && ! is_dir($directory)) {
    fwrite(STDERR, "Unable to create output directory: {$directory}\n");
    exit(1);
}

$encoded = json_encode($report, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

if (! is_string($encoded) || file_put_contents($outputPath, $encoded."\n") === false) {
    fwrite(STDERR, "Unable to write audit: {$outputPath}\n");
    exit(1);
}

fwrite(STDOUT, json_encode($summary, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)."\n");
