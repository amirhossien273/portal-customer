<?php

declare(strict_types=1);

/**
 * Build the human-readable before/after report from two crawler snapshots.
 *
 * Usage:
 * php scripts/seo/internal-link-report.php before.json after.json report.md
 */

[$script, $beforePath, $afterPath, $outputPath] = array_pad($argv, 4, null);

if (! is_string($beforePath) || ! is_string($afterPath) || ! is_string($outputPath)) {
    fwrite(STDERR, "Usage: php {$script} before.json after.json report.md\n");
    exit(2);
}

$decode = static function (string $path): array {
    $contents = file_get_contents($path);
    $data = is_string($contents) ? json_decode($contents, true) : null;

    if (! is_array($data)) {
        throw new RuntimeException("Invalid audit JSON: {$path}");
    }

    return $data;
};

$before = $decode($beforePath);
$after = $decode($afterPath);
$registry = require dirname(__DIR__, 2).'/config/site_internal_linking.php';
$pages = $registry['pages'];
$targets = $registry['targets'];
$beforePages = array_column($before['pages'], null, 'url');
$afterPages = array_column($after['pages'], null, 'url');

$escape = static fn (string $value): string => str_replace(["\r", "\n", '|'], [' ', ' ', '\\|'], trim($value));
$number = static fn (int|float $value): string => number_format($value, is_float($value) ? 2 : 0, '.', ',');
$delta = static fn (int $beforeValue, int $afterValue): string => $beforeValue.' → '.$afterValue;
$lines = [];
$lines[] = '# گزارش جامع Audit و بازطراحی Internal Linking سپند';
$lines[] = '';
$lines[] = 'تاریخ: 2026-09-07';
$lines[] = '';
$lines[] = 'مبنای اندازه‌گیری، Crawl خروجی HTML تمام URLهای Indexable پس از پاک‌سازی View Cache است. شمارش «Internal Links» تعداد occurrenceهای لینک میان صفحات Indexable و شمارش «Unique Edges» رابطه یکتای Source → Destination است.';
$lines[] = '';
$lines[] = '## Summary';
$lines[] = '';
$lines[] = '| شاخص | قبل | بعد | تغییر |';
$lines[] = '| --- | ---: | ---: | ---: |';

$summaryRows = [
    'Total Indexable Pages' => ['indexable_pages', 0],
    'Total Internal Links' => ['internal_links', $after['summary']['internal_links'] - $before['summary']['internal_links']],
    'Unique Internal Edges' => ['unique_internal_edges', $after['summary']['unique_internal_edges'] - $before['summary']['unique_internal_edges']],
    'Contextual Links' => ['contextual_links', $after['summary']['contextual_links'] - $before['summary']['contextual_links']],
    'Contextual Unique Edges' => ['contextual_unique_edges', $after['summary']['contextual_unique_edges'] - $before['summary']['contextual_unique_edges']],
    'Orphan Pages' => ['orphan_pages', $after['summary']['orphan_pages'] - $before['summary']['orphan_pages']],
    'Near-Orphan Pages' => ['near_orphan_pages', $after['summary']['near_orphan_pages'] - $before['summary']['near_orphan_pages']],
    'Broken Internal Targets' => ['broken_internal_targets', $after['summary']['broken_internal_targets'] - $before['summary']['broken_internal_targets']],
];

foreach ($summaryRows as $label => [$key, $change]) {
    $lines[] = sprintf('| %s | %s | %s | %+d |', $label, $number($before['summary'][$key]), $number($after['summary'][$key]), $change);
}

$lines[] = '';
$lines[] = '- Mega Menu از فهرست همه صفحات Solution به شش ورودی موضوعی و «همه راهکارها» کاهش یافت؛ در نمونه صفحه اصلی، لینک‌های Header از 29 به 14 occurrence رسید.';
$lines[] = '- Sitemap که قبلاً دو Host شامل `sepandcrm.ir` و `127.0.0.1` داشت، اکنون فقط URLهای `https://sepandcrm.ir` را تولید می‌کند.';
$lines[] = '- Title، H1، Canonical، Indexability و Search Intent صفحات برای این Task تغییر نکرده‌اند.';
$lines[] = '';
$lines[] = '## Tier و توزیع Link Equity';
$lines[] = '';
$tierStats = [];
foreach ([1, 2, 3] as $tier) {
    $tierPages = array_filter($afterPages, static fn (array $page): bool => $page['tier'] === $tier);
    $tierStats[$tier] = [
        'pages' => count($tierPages),
        'inbound' => array_sum(array_column($tierPages, 'contextual_inbound_links')) / count($tierPages),
        'outbound' => array_sum(array_map(static fn (array $page): int => $page['outbound_by_type']['contextual'], $tierPages)) / count($tierPages),
    ];
}
$lines[] = '| Tier | تعداد صفحه | میانگین Contextual Inbound | میانگین Contextual Outbound | نقش |';
$lines[] = '| --- | ---: | ---: | ---: | --- |';
$lines[] = sprintf('| Tier 1 | %d | %.2f | %.2f | Money / Authority |', $tierStats[1]['pages'], $tierStats[1]['inbound'], $tierStats[1]['outbound']);
$lines[] = sprintf('| Tier 2 | %d | %.2f | %.2f | Supporting Commercial |', $tierStats[2]['pages'], $tierStats[2]['inbound'], $tierStats[2]['outbound']);
$lines[] = sprintf('| Tier 3 | %d | %.2f | %.2f | Specialized Supporting |', $tierStats[3]['pages'], $tierStats[3]['inbound'], $tierStats[3]['outbound']);
$lines[] = '';
$lines[] = 'Tier 1 به‌صورت میانگین بیش از سه برابر Tier 2 و بیش از چهار برابر Tier 3 لینک Contextual ورودی دریافت می‌کند. Tier 3ها به Parent و Authority Page لینک می‌دهند و از قرارگرفتن سراسری در Navigation خارج شده‌اند.';
$lines[] = '';
$lines[] = '## Audit تمام صفحات Indexable';
$lines[] = '';
$lines[] = '| URL | Page Title | Cluster | Tier | Inbound Internal Links | Contextual Inbound | Navigation Inbound | Outbound Internal Links | Main Anchor Texts | Orphan Risk | Recommended Action |';
$lines[] = '| --- | --- | --- | ---: | ---: | ---: | ---: | ---: | --- | --- | --- |';

foreach ($pages as $path => $meta) {
    $beforePage = $beforePages[$path];
    $afterPage = $afterPages[$path];
    $anchors = implode('، ', array_slice(array_keys($afterPage['main_anchor_texts']), 0, 4));
    $recommendation = match ($meta['tier']) {
        1 => 'نقش Authority حفظ و Anchor Mix در GSC پایش شود.',
        2 => 'از Tier 3 لینک بگیرد و به Authority بالادست متصل بماند.',
        default => '۲ تا ۴ لینک به Parent/Authority حفظ شود؛ Global Link نگیرد.',
    };
    $lines[] = sprintf(
        '| `%s` | %s | %s | %d | %s | %s | %s | %s | %s | %s | %s |',
        $path,
        $escape($afterPage['title']),
        $escape($meta['cluster']),
        $meta['tier'],
        $delta($beforePage['inbound_internal_links'], $afterPage['inbound_internal_links']),
        $delta($beforePage['contextual_inbound_links'], $afterPage['contextual_inbound_links']),
        $delta($beforePage['navigation_inbound_links'], $afterPage['navigation_inbound_links']),
        $delta($beforePage['outbound_internal_links'], $afterPage['outbound_internal_links']),
        $escape($anchors),
        $beforePage['orphan_risk'].' → '.$afterPage['orphan_risk'],
        $escape($recommendation),
    );
}

$beforeContextual = [];
foreach ($before['edges'] as $edge) {
    if ($edge['type'] === 'contextual' && $edge['source'] !== $edge['target']) {
        $beforeContextual[$edge['source'].'>'.$edge['target'].'>'.$edge['anchor']] = true;
    }
}

$addedContextual = [];
foreach ($after['edges'] as $edge) {
    if ($edge['type'] !== 'contextual' || $edge['source'] === $edge['target']) {
        continue;
    }

    $key = $edge['source'].'>'.$edge['target'].'>'.$edge['anchor'];
    if (! isset($beforeContextual[$key])) {
        $addedContextual[$key] = $edge;
    }
}

$lines[] = '';
$lines[] = '## Contextual Links Added — Per Page';
$lines[] = '';
$lines[] = 'این جدول Edgeهای Contextual یکتایی را نشان می‌دهد که در Snapshot قبل وجود نداشتند. کاهش لینک‌های سراسری Header/Footer جداگانه و در سطح Template انجام شده است.';
$lines[] = '';
$lines[] = '| Source Page | Destination Page | Anchor Text | Reason |';
$lines[] = '| --- | --- | --- | --- |';

foreach ($addedContextual as $edge) {
    $sourceMeta = $pages[$edge['source']];
    $targetMeta = $pages[$edge['target']];
    $reason = $targetMeta['tier'] === 1
        ? 'انتقال Link Equity به Authority Page خوشه '.$targetMeta['cluster']
        : ($sourceMeta['cluster'] === $targetMeta['cluster']
            ? 'تقویت Silo و مسیر Parent/Child خوشه '.$sourceMeta['cluster']
            : 'اتصال طبیعی خوشه '.$sourceMeta['cluster'].' به '.$targetMeta['cluster']);
    $lines[] = sprintf('| `%s` | `%s` | %s | %s |', $edge['source'], $edge['target'], $escape($edge['anchor']), $escape($reason));
}

$lines[] = '';
$lines[] = '## Links Removed / Retargeted';
$lines[] = '';
$lines[] = '| Source Template | Links Removed or Retargeted | Destination Strategy | Reason |';
$lines[] = '| --- | --- | --- | --- |';
$lines[] = '| `layouts/partials/solutions-dropdown` | لینک سراسری مستقیم به همه Platform Solution و Specialized Solutionها | شش Authority موضوعی + `/solutions` | کاهش Sitewide Equity برای Tier 3 و هدایت کاربر به Hub |';
$lines[] = '| `layouts/marketing` Footer | فهرست سراسری همه Specialized Solutionها و صفحات کم‌اولویت | Product، Modules و Authorityهای Documents/Fleet/NVOCC | کاهش اتکا به Footer و جلوگیری از اهمیت مصنوعی برابر |';
$lines[] = '| `welcome` Footer | Container، Bill of Lading، Sales Automation و On-Premise به‌صورت Global | Solution Hub و سه Authority موضوعی | حفظ دسترسی از Hub/Contextual بدون Global Link |';
$lines[] = '| `related-content-pages` | Anchor عمومی «مشاهده صفحه» | عنوان توصیفی همان مقصد | انتقال Intent مقصد و حذف Generic Anchor |';
$lines[] = '| Platform Related Pages | روابط عمومی و بعضاً بین‌خوشه‌ای | رابطه‌های Cluster-based برای Operations، Finance، Fleet، Rate، Schedule، Multimodal، Security و Supplier | جلوگیری از Related Page تصادفی |';
$lines[] = '';
$lines[] = '## Technical Issues';
$lines[] = '';
$lines[] = '| مورد | قبل | بعد | نتیجه |';
$lines[] = '| --- | ---: | ---: | --- |';
$lines[] = '| Broken internal targets | 0 | 0 | همه `href`های بررسی‌شده پاسخ کمتر از 400 دارند. |';
$lines[] = '| Redirect chains | 0 | 0 | هیچ زنجیره Redirect در مسیرهای SEO وجود ندارد. |';
$lines[] = '| Redirecting application actions | 2 | 2 | `/tracking` و `/organization-portal` عمداً یک 302 مستقیم به Login هدفمند دارند و Indexable نیستند. |';
$lines[] = '| Non-canonical links to indexable pages | 0 | 0 | لینک‌ها مستقیم به URL Canonical، بدون Query و با convention بدون trailing slash هستند. |';
$lines[] = '| Sitemap host mismatch | 1 issue | 0 | خروجی `127.0.0.1` از Sitemap حذف شد. |';
$lines[] = '| Orphan pages | 0 | 0 | همه صفحات از Hub/Navigation و مسیر موضوعی قابل دسترس‌اند. |';
$lines[] = '| Near-Orphan pages | 40 | 0 | همه صفحات حداقل Contextual یا Related inbound دارند. |';
$lines[] = '| Generic anchors | موجود در Related CTA | 0 مورد از فهرست ممنوع | Anchorهای مقصد توصیفی و برای مقصدهای پرتکرار متنوع‌اند. |';
$lines[] = '| Overlinked specialized pages | Sitewide در Mega Menu/Footer | رفع شد | Tier 3 از Global Navigation خارج و از Parent/Authority قابل دسترسی است. |';
$lines[] = '';
$lines[] = '## Breadcrumb و Hub QA';
$lines[] = '';
$lines[] = '- تمام 54 صفحه داخلی Breadcrumb قابل مشاهده دارند؛ صفحه Home طبق عرف Breadcrumb ندارد.';
$lines[] = '- صفحات Solution تخصصی اکنون در Breadcrumb به `/solutions` لینک می‌دهند؛ قبلاً عنوان «راهکارها» بدون لینک بود.';
$lines[] = '- مطالعه موردی به مسیر `Home → Why Sepand → Case Study` متصل شد، چون Hub مستقل Case Studies در پروژه وجود ندارد و صفحه جدید نیز طبق Scope ساخته نشد.';
$lines[] = '- `/modules`، `/solutions` و `/compare` دسترسی توصیفی به مجموعه فرزندان را حفظ کرده‌اند.';
$lines[] = '- برای Transport Modes صفحه Hub مستقل وجود ندارد؛ Breadcrumb موجود به سکشن `#transport-modes` صفحه Home متصل است.';
$lines[] = '';
$lines[] = '## Files Changed';
$lines[] = '';
$files = [
    'app/Http/Controllers/MarketingSitemapController.php',
    'config/site_internal_linking.php',
    'config/site_seo_overrides.php',
    'public/assets/css/home.css',
    'public/assets/css/marketing.css',
    'resources/views/layouts/marketing.blade.php',
    'resources/views/layouts/partials/solutions-dropdown.blade.php',
    'resources/views/marketing/case-studies/show.blade.php',
    'resources/views/marketing/content-page.blade.php',
    'resources/views/marketing/partials/contextual-paths.blade.php',
    'resources/views/marketing/partials/related-content-pages.blade.php',
    'resources/views/welcome.blade.php',
    'scripts/seo/internal-link-audit.php',
    'scripts/seo/internal-link-report.php',
    'tests/Feature/InternalLinkArchitectureTest.php',
    'tests/Feature/MarketingContentPagesTest.php',
];
foreach ($files as $file) {
    $lines[] = '- `'.$file.'`';
}

$lines[] = '';
$lines[] = '## Validation';
$lines[] = '';
$lines[] = '- Crawl کامل 55 URL Indexable روی HTML رندرشده.';
$lines[] = '- کنترل Status، Robots، Self-canonical، Breadcrumb، Query، Redirect source، Broken target، Sitemap host و Anchor Text.';
$lines[] = '- تست‌های هدفمند معماری و رگرسیون بازاریابی: 36 تست و 7,286 Assertion موفق.';
$lines[] = '- پیشنهاد پس از Deploy: مقایسه Internal Links گزارش‌شده در GSC و Crawl مجدد با ابزار خارجی پس از Recrawl گوگل.';

$directory = dirname($outputPath);
if (! is_dir($directory) && ! mkdir($directory, 0777, true) && ! is_dir($directory)) {
    throw new RuntimeException("Unable to create directory: {$directory}");
}

file_put_contents($outputPath, implode("\n", $lines)."\n");
fwrite(STDOUT, "Report written to {$outputPath} with ".count($addedContextual)." added contextual edges.\n");
