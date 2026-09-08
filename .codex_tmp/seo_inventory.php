<?php

declare(strict_types=1);

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

putenv('APP_ENV=testing');
putenv('APP_URL=https://sepandcrm.ir');
putenv('VIEW_COMPILED_PATH='.__DIR__.'/views');
$_ENV['APP_ENV'] = 'testing';
$_SERVER['APP_ENV'] = 'testing';
if (! is_dir(__DIR__.'/views')) {
    mkdir(__DIR__.'/views', 0777, true);
}

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../tests/bootstrap.php';

$app = require __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);

$fetch = static function (string $path) use ($kernel): array {
    $response = $kernel->handle(Request::create($path, 'GET', [], [], [], [
        'HTTP_HOST' => 'sepandcrm.ir',
        'HTTPS' => 'on',
    ]));

    return [$response->getStatusCode(), (string) $response->getContent()];
};

[, $sitemap] = $fetch('/sitemap.xml');
$sitemapDocument = new DOMDocument();
$sitemapDocument->loadXML($sitemap);
$sitemapXPath = new DOMXPath($sitemapDocument);
$sitemapXPath->registerNamespace('sm', 'http://www.sitemaps.org/schemas/sitemap/0.9');
$paths = [];
foreach ($sitemapXPath->query('//sm:url/sm:loc') as $location) {
    $path = (string) parse_url(trim($location->textContent), PHP_URL_PATH);
    $paths[] = $path === '' ? '/' : $path;
}
if (count($argv) > 1) {
    $paths = array_slice($argv, 1);
}

$inventory = [];
foreach ($paths as $path) {
    [$status, $html] = $fetch($path);
    $document = new DOMDocument();
    @$document->loadHTML('<?xml encoding="utf-8" ?>'.$html);
    $xpath = new DOMXPath($document);
    $first = static fn (string $query): string => trim(preg_replace('/\s+/u', ' ', $xpath->query($query)->item(0)?->textContent ?? '') ?: '');
    $attribute = static fn (string $query, string $name): string => trim($xpath->query($query)->item(0)?->attributes?->getNamedItem($name)?->nodeValue ?? '');
    $h2 = [];
    foreach ($xpath->query('//h2') as $heading) {
        $h2[] = trim(preg_replace('/\s+/u', ' ', $heading->textContent) ?: '');
    }
    $links = [];
    foreach ($xpath->query('//main//a[@href]') as $link) {
        $href = trim($link->attributes?->getNamedItem('href')?->nodeValue ?? '');
        $host = (string) parse_url($href, PHP_URL_HOST);
        if ($href === '' || str_starts_with($href, '#') || ($host !== '' && $host !== 'sepandcrm.ir')) {
            continue;
        }
        $linkPath = (string) parse_url($href, PHP_URL_PATH);
        $links[] = $linkPath === '' ? '/' : (rtrim($linkPath, '/') ?: '/');
    }
    $schemaTypes = [];
    foreach ($xpath->query('//script[@type="application/ld+json"]') as $script) {
        $data = json_decode($script->textContent, true);
        $walk = static function (mixed $value) use (&$walk, &$schemaTypes): void {
            if (! is_array($value)) {
                return;
            }
            if (isset($value['@type']) && is_string($value['@type'])) {
                $schemaTypes[] = $value['@type'];
            }
            foreach ($value as $child) {
                $walk($child);
            }
        };
        $walk($data);
    }

    $inventory[] = [
        'url' => $path,
        'status' => $status,
        'title' => $first('//title'),
        'meta_description' => $attribute('//meta[@name="description"]', 'content'),
        'h1' => $first('//h1'),
        'h1_count' => $xpath->query('//h1')->length,
        'h2' => $h2,
        'canonical' => $attribute('//link[@rel="canonical"]', 'href'),
        'robots' => $attribute('//meta[@name="robots"]', 'content'),
        'schema_types' => array_values(array_unique($schemaTypes)),
        'outbound_main' => array_values(array_unique($links)),
    ];
}

if (getenv('SEO_SUMMARY') === '1') {
    foreach ($inventory as $item) {
        echo implode("\t", [
            $item['url'],
            (string) $item['status'],
            $item['title'],
            $item['h1'],
            $item['canonical'],
            $item['robots'],
            implode(' | ', $item['h2']),
        ]).PHP_EOL;
    }
} else {
    echo json_encode($inventory, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
}
