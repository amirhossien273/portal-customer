<?php
    $depth = $page['depth'];
    $consultationUrl = route('consultation.create', ['source_page' => $canonical]);
    $structuredData = [
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'WebPage',
                '@id' => $canonical.'#webpage',
                'url' => $canonical,
                'name' => $title,
                'description' => $description,
                'inLanguage' => 'fa-IR',
                'dateModified' => config('marketing.content_last_modified'),
                'isPartOf' => ['@id' => route('solutions.index').'#webpage'],
                'breadcrumb' => ['@id' => $canonical.'#breadcrumb'],
                'mainEntity' => [
                    ['@id' => $canonical.'#checklist'],
                    ['@id' => $canonical.'#faq'],
                ],
                'about' => [
                    ['@type' => 'Thing', 'name' => 'نصب نرم‌افزار حمل‌ونقل روی سرور شرکت'],
                    ['@type' => 'Thing', 'name' => 'استقرار داخلی نرم‌افزار حمل‌ونقل'],
                    ['@type' => 'Thing', 'name' => 'پیش‌نیازهای On-Premise'],
                ],
                'significantLink' => [$consultationUrl, route('product'), route('pricing')],
            ],
            [
                '@type' => 'BreadcrumbList',
                '@id' => $canonical.'#breadcrumb',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => 'صفحه اصلی', 'item' => route('home')],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => 'راهکارها', 'item' => route('solutions.index')],
                    ['@type' => 'ListItem', 'position' => 3, 'name' => $page['nav_title'], 'item' => $canonical],
                ],
            ],
            [
                '@type' => 'ItemList',
                '@id' => $canonical.'#checklist',
                'name' => $page['checklist_heading'],
                'itemListElement' => array_map(static fn (array $item, int $index): array => [
                    '@type' => 'ListItem',
                    'position' => $index + 1,
                    'name' => $item['criterion'],
                    'description' => $item['question'],
                ], $page['checklist'], array_keys($page['checklist'])),
            ],
            [
                '@type' => 'FAQPage',
                '@id' => $canonical.'#faq',
                'mainEntity' => array_map(static fn (array $faq): array => [
                    '@type' => 'Question',
                    'name' => $faq['question'],
                    'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['answer']],
                ], $page['faqs']),
            ],
        ],
    ];
?>

<?php $__env->startPush('head'); ?>
<script type="application/ld+json"><?php echo json_encode($structuredData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/css/marketing-content-page.css')); ?>?v=20261114-1">
<link rel="stylesheet" href="<?php echo e(asset('assets/css/marketing-on-premise.css')); ?>?v=20261118-1">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<section class="page-hero content-page-hero on-premise-hero">
    <div class="container hero-inner">
        <div class="hero-copy reveal">
            <nav class="breadcrumb" aria-label="مسیر صفحه">
                <a href="<?php echo e(route('home')); ?>">صفحه اصلی</a><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                <a href="<?php echo e(route('solutions.index')); ?>">راهکارها</a><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                <span><?php echo e($page['nav_title']); ?></span>
            </nav>
            <span class="content-eyebrow"><?php echo e($page['eyebrow']); ?></span>
            <h1><?php echo e($page['h1']); ?></h1>
            <p><?php echo e($page['lead']); ?></p>
            <div class="hero-actions">
                <a class="btn btn-primary" href="<?php echo e($consultationUrl); ?>" data-ga-event="cta_click" data-ga-label="on-premise_hero_technical_review"><?php echo e($page['hero_primary_label']); ?></a>
                <a class="btn btn-outline" href="#installation-requirements"><?php echo e($page['hero_secondary_label']); ?></a>
            </div>
        </div>
        <aside class="content-answer-card reveal" aria-label="پاسخ کوتاه درباره امکان نصب">
            <span>پاسخ کوتاه</span>
            <p><?php echo e($page['answer']); ?></p>
            <ul><?php $__currentLoopData = $page['outcomes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $outcome): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($outcome['title']); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
        </aside>
    </div>
</section>

<section class="content-intent-strip" id="diagnostic-section" aria-labelledby="installation-answer-title">
    <div class="container">
        <div class="content-intent-card reveal"><span aria-hidden="true">◎</span><div><h2 id="installation-answer-title"><?php echo e($page['intent_title']); ?></h2><p><?php echo e($page['intent_text']); ?></p></div></div>
    </div>
</section>

<section class="content-toc-section" aria-label="راهنمای مطالعه صفحه">
    <div class="container content-toc-wrap reveal">
        <div class="content-editorial-note">
            <div><strong><?php echo e($depth['editorial']['label']); ?></strong><span><?php echo e($depth['editorial']['reviewed']); ?></span></div>
            <p><?php echo e($depth['editorial']['note']); ?></p>
        </div>
        <nav class="content-toc" aria-label="فهرست مطالب">
            <span>در این صفحه</span>
            <a href="#evaluation-output">فرآیند ارزیابی</a><a href="#product-scope">دامنه محصول</a><a href="#installation-requirements">پیش‌نیازها</a><a href="#installation-cost">هزینه نصب</a><a href="#technical-meeting">اطلاعات جلسه</a><a href="#content-faq-section">سؤالات متداول</a>
        </nav>
    </div>
</section>

<section class="section" id="evaluation-output" aria-labelledby="evaluation-output-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">فرآیند ارزیابی و تأیید</span><h2 class="section-title" id="evaluation-output-title"><?php echo e($page['outcomes_heading']); ?></h2><p class="section-sub">ابتدا اطلاعات فنی و عملیاتی جمع‌آوری می‌شود، سپس موارد نیازمند آزمون یا تصمیم قراردادی روشن می‌شوند و نتیجه در پیشنهاد رسمی می‌آید.</p></div>
        <div class="content-outcomes-grid"><?php $__currentLoopData = $page['outcomes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $outcome): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><article class="content-outcome-card reveal"><span><?php echo e(str_pad($loop->iteration, 2, '0', STR_PAD_LEFT)); ?></span><h3><?php echo e($outcome['title']); ?></h3><p><?php echo e($outcome['description']); ?></p></article><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div>
    </div>
</section>

<section class="section soft content-evidence-section" id="product-scope" aria-labelledby="product-scope-title">
    <div class="container content-evidence-layout">
        <figure class="content-evidence-media reveal">
            <img src="<?php echo e(asset('assets/images/marketing/'.$page['image'])); ?>" alt="<?php echo e($page['image_alt']); ?>" width="<?php echo e($page['image_width']); ?>" height="<?php echo e($page['image_height']); ?>" loading="lazy">
            <figcaption><?php echo e($page['product_scope']['caption']); ?></figcaption>
        </figure>
        <div class="content-evidence-copy reveal">
            <span class="section-label">دامنه پیشنهادی</span><h2 class="section-title" id="product-scope-title"><?php echo e($page['product_scope']['heading']); ?></h2><p><?php echo e($page['product_scope']['intro']); ?></p>
            <ul class="on-premise-scope-list"><?php $__currentLoopData = $page['product_scope']['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($item); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
            <a class="on-premise-text-link" href="<?php echo e(route('product')); ?>">مشاهده معرفی کامل محصول <span aria-hidden="true">←</span></a>
        </div>
    </div>
</section>

<section class="section" id="installation-requirements" aria-labelledby="installation-requirements-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">زیرساخت و نگهداری</span><h2 class="section-title" id="installation-requirements-title"><?php echo e($page['requirements_heading']); ?></h2><p class="section-sub"><?php echo e($page['requirements_intro']); ?></p></div>
        <div class="on-premise-table-wrap reveal" id="deep-dive-section">
            <table class="on-premise-table">
                <caption class="sr-only">موضوعات بررسی فنی و نحوه تعیین مسئولیت نگهداری</caption>
                <thead><tr><th scope="col">موضوع</th><th scope="col">مواردی که بررسی می‌شوند</th><th scope="col">تعیین مسئولیت</th></tr></thead>
                <tbody><?php $__currentLoopData = $page['requirements']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $requirement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><tr><th scope="row"><?php echo e($requirement['topic']); ?></th><td><?php echo e($requirement['review']); ?></td><td><strong><?php echo e($requirement['responsibility']); ?></strong></td></tr><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></tbody>
            </table>
        </div>
    </div>
</section>

<section class="section soft" id="installation-cost" aria-labelledby="installation-cost-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">مبنای برآورد</span><h2 class="section-title" id="installation-cost-title"><?php echo e($page['cost_heading']); ?></h2><p class="section-sub"><?php echo e($page['cost_intro']); ?></p></div>
        <div class="content-pillars-grid" id="metrics-section"><?php $__currentLoopData = $page['cost_factors']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $factor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><article class="content-pillar-card reveal"><span class="content-pillar-index">۰<?php echo e($loop->iteration); ?></span><h3><?php echo e($factor['title']); ?></h3><p><?php echo e($factor['description']); ?></p></article><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div>
        <aside class="on-premise-note reveal"><strong>نکته درباره تعرفه:</strong><p><?php echo e($page['cost_note']); ?></p><a href="<?php echo e(route('pricing')); ?>">مشاهده محاسبه‌گر تعرفه <span aria-hidden="true">←</span></a></aside>
    </div>
</section>

<section class="section" id="technical-meeting" aria-labelledby="technical-meeting-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">آماده‌سازی درخواست</span><h2 class="section-title" id="technical-meeting-title"><?php echo e($page['meeting_heading']); ?></h2><p class="section-sub"><?php echo e($page['meeting_intro']); ?></p></div>
        <div class="on-premise-meeting-grid"><?php $__currentLoopData = $page['meeting_items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><article class="content-diagnostic-card reveal"><span class="content-card-number"><?php echo e(str_pad($loop->iteration, 2, '0', STR_PAD_LEFT)); ?></span><h3><?php echo e($item['title']); ?></h3><p><?php echo e($item['description']); ?></p></article><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div>
    </div>
</section>

<section class="section soft content-workflow-section" id="rollout-section" aria-labelledby="workflow-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">از درخواست تا پیشنهاد</span><h2 class="section-title" id="workflow-title"><?php echo e($page['workflow_heading']); ?></h2><p class="section-sub"><?php echo e($page['workflow_intro']); ?></p></div>
        <ol class="content-workflow"><?php $__currentLoopData = $page['workflow']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li class="reveal"><span><?php echo e($loop->iteration); ?></span><div><h3><?php echo e($step['title']); ?></h3><p><?php echo e($step['description']); ?></p></div></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ol>
    </div>
</section>

<section class="section" id="checklist-section" aria-labelledby="checklist-title">
    <div class="container content-checklist-layout">
        <div class="content-checklist-copy reveal"><span class="section-label">چک‌لیست فنی</span><h2 class="section-title" id="checklist-title"><?php echo e($page['checklist_heading']); ?></h2><p><?php echo e($page['checklist_intro']); ?></p></div>
        <div class="content-checklist"><?php $__currentLoopData = $page['checklist']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><article class="reveal"><strong><?php echo e($item['criterion']); ?></strong><p><?php echo e($item['question']); ?></p></article><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div>
    </div>
</section>

<section class="section soft" id="boundaries-section" aria-labelledby="boundaries-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">ادامه بررسی</span><h2 class="section-title" id="boundaries-title"><?php echo e($page['boundary_heading']); ?></h2></div>
        <div class="content-boundaries-grid"><?php $__currentLoopData = $page['boundaries']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $boundary): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><article class="content-boundary-card reveal"><h3><?php echo e($boundary['title']); ?></h3><p><?php echo e($boundary['description']); ?></p><a href="<?php echo e(route($boundary['link']['route'], $boundary['link']['parameters'] ?? [])); ?>"><?php echo e($boundary['link']['label']); ?> <span aria-hidden="true">←</span></a></article><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div>
    </div>
</section>

<section class="section" id="content-faq-section" aria-labelledby="content-faq-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">پرسش‌های خریداران</span><h2 class="section-title" id="content-faq-title">سؤالات متداول نصب سپند روی سرور شرکت</h2></div>
        <div class="faq"><?php $__currentLoopData = $page['faqs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><details class="reveal"><summary><?php echo e($faq['question']); ?></summary><p><?php echo e($faq['answer']); ?></p></details><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div>
    </div>
</section>

<section class="cta-wrap"><div class="container"><div class="cta reveal"><div class="cta-copy"><h2><?php echo e($page['cta_title']); ?></h2><p><?php echo e($page['cta_text']); ?></p></div><div class="cta-action"><a class="btn" href="<?php echo e($consultationUrl); ?>" data-ga-event="cta_click" data-ga-label="on-premise_bottom_technical_review"><?php echo e($page['cta_button']); ?></a></div></div></div></section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.marketing', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\project\sepand\portal-customer\resources\views/marketing/on-premise.blade.php ENDPATH**/ ?>