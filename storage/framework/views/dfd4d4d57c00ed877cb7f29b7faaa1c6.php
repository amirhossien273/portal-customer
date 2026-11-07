<?php
    $isGuide = $group === 'guides';
    $depth = $page['depth'];
    $parentLabel = $isGuide ? 'مرکز مقایسه' : 'راهکارها';
    $parentUrl = $isGuide ? route('compare.index') : route('solutions.index');
    $linkUrl = static fn (array $link): string => route($link['route'], $link['parameters'] ?? []);
    $significantLinks = array_values(array_unique(array_merge(
        [$canonical, route('consultation.create')],
        $isGuide ? [route('compare.index')] : [],
        array_map(static fn (array $item): string => $linkUrl($item['link']), $page['pillars']),
        array_map(static fn (array $item): string => $linkUrl($item['link']), $page['boundaries']),
    )));
    $breadcrumbItems = [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'صفحه اصلی', 'item' => route('home')],
    ];
    if ($isGuide) {
        $breadcrumbItems[] = ['@type' => 'ListItem', 'position' => 2, 'name' => 'مرکز مقایسه', 'item' => route('compare.index')];
    }
    $breadcrumbItems[] = [
        '@type' => 'ListItem',
        'position' => count($breadcrumbItems) + 1,
        'name' => $page['nav_title'],
        'item' => $canonical,
    ];
?>

<?php $__env->startPush('head'); ?>
<script type="application/ld+json"><?php echo json_encode([
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
            'isPartOf' => ['@id' => $parentUrl.'#webpage'],
            'breadcrumb' => ['@id' => $canonical.'#breadcrumb'],
            'mainEntity' => [
                ['@id' => $canonical.'#checklist'],
                ['@id' => $canonical.'#faq'],
            ],
            'about' => array_map(static fn (array $item): array => [
                '@type' => 'Thing',
                'name' => $item['title'],
            ], array_merge($page['pillars'], $depth['deep_dive']['items'])),
            'significantLink' => $significantLinks,
        ],
        [
            '@type' => 'BreadcrumbList',
            '@id' => $canonical.'#breadcrumb',
            'itemListElement' => $breadcrumbItems,
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
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/css/marketing-content-page.css')); ?>?v=20260908-1">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<section class="page-hero content-page-hero">
    <div class="container hero-inner">
        <div class="hero-copy reveal">
            <nav class="breadcrumb" aria-label="مسیر صفحه">
                <a href="<?php echo e(route('home')); ?>">صفحه اصلی</a>
                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                <?php if($parentUrl): ?><a href="<?php echo e($parentUrl); ?>"><?php echo e($parentLabel); ?></a><?php else: ?><span><?php echo e($parentLabel); ?></span><?php endif; ?>
                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                <span><?php echo e($page['nav_title']); ?></span>
            </nav>
            <span class="content-eyebrow"><?php echo e($page['eyebrow']); ?></span>
            <h1><?php echo e($page['h1']); ?></h1>
            <p><?php echo e($page['lead']); ?></p>
            <div class="hero-actions">
                <a class="btn btn-primary" href="#decision-framework"><?php echo e($page['hero_primary_label'] ?? ($isGuide ? 'مشاهده معیارهای انتخاب' : 'مشاهده اجزای راهکار')); ?></a>
                <a class="btn btn-outline" href="<?php echo e(route('consultation.create')); ?>" data-ga-event="cta_click" data-ga-label="<?php echo e($slug); ?>_hero_consultation"><?php echo e($page['hero_secondary_label'] ?? 'درخواست دمو و مشاوره'); ?></a>
            </div>
        </div>
        <aside class="content-answer-card reveal" aria-label="پاسخ کوتاه">
            <span><?php echo e($isGuide ? 'پاسخ کوتاه برای تصمیم‌گیرنده' : 'دامنه راهکار'); ?></span>
            <p><?php echo e($page['answer']); ?></p>
            <ul>
                <?php $__currentLoopData = $page['outcomes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $outcome): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($outcome['title']); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </aside>
    </div>
</section>

<section class="content-intent-strip" aria-labelledby="content-intent-title">
    <div class="container">
        <div class="content-intent-card reveal">
            <span aria-hidden="true">◎</span>
            <div><h2 id="content-intent-title"><?php echo e($page['intent_title']); ?></h2><p><?php echo e($page['intent_text']); ?></p></div>
        </div>
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
            <a href="#outcomes-section">خروجی‌ها</a>
            <?php if(isset($page['specialist_difference'])): ?><a href="#specialist-difference-section">تفاوت دو دسته</a><?php endif; ?>
            <a href="#diagnostic-section">تشخیص نیاز</a>
            <a href="#decision-framework">اجزای اصلی</a>
            <a href="#workflow-section">جریان کار</a>
            <a href="#deep-dive-section">بررسی عمیق</a>
            <a href="#metrics-section">شاخص‌ها</a>
            <a href="#rollout-section">پیاده‌سازی</a>
            <a href="#content-faq-section">سؤالات متداول</a>
        </nav>
    </div>
</section>

<section class="section" id="outcomes-section" aria-labelledby="outcomes-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">خروجی مورد انتظار</span><h2 class="section-title" id="outcomes-title"><?php echo e($page['outcomes_heading']); ?></h2></div>
        <div class="content-outcomes-grid">
            <?php $__currentLoopData = $page['outcomes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $outcome): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="content-outcome-card reveal"><span><?php echo e(str_pad($loop->iteration, 2, '0', STR_PAD_LEFT)); ?></span><h3><?php echo e($outcome['title']); ?></h3><p><?php echo e($outcome['description']); ?></p></article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<?php if(isset($page['specialist_difference'])): ?>
<section class="section soft content-specialist-difference" id="specialist-difference-section" aria-labelledby="specialist-difference-title">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label">تفکیک موضوعی</span>
            <h2 class="section-title" id="specialist-difference-title"><?php echo e($page['specialist_difference']['heading']); ?></h2>
            <p class="section-sub"><?php echo e($page['specialist_difference']['intro']); ?></p>
        </div>
        <div class="content-difference-grid">
            <?php $__currentLoopData = ['general', 'forwarding']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $differenceKey): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php ($difference = $page['specialist_difference'][$differenceKey]); ?>
                <article class="content-difference-card reveal">
                    <span><?php echo e($loop->iteration === 1 ? 'دسته عمومی' : 'دسته تخصصی'); ?></span>
                    <h3><?php echo e($difference['title']); ?></h3>
                    <p><?php echo e($difference['description']); ?></p>
                    <ul><?php $__currentLoopData = $difference['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($item); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="content-difference-action reveal"><a href="<?php echo e($linkUrl($page['specialist_difference']['link'])); ?>"><?php echo e($page['specialist_difference']['link']['label']); ?> <span aria-hidden="true">←</span></a></div>
    </div>
</section>
<?php endif; ?>

<section class="section content-diagnostic-section" id="diagnostic-section" aria-labelledby="diagnostic-title">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label"><?php echo e($depth['diagnostic']['label']); ?></span>
            <h2 class="section-title" id="diagnostic-title"><?php echo e($depth['diagnostic']['heading']); ?></h2>
            <p class="section-sub"><?php echo e($depth['diagnostic']['intro']); ?></p>
        </div>
        <div class="content-diagnostic-grid">
            <?php $__currentLoopData = $depth['diagnostic']['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="content-diagnostic-card reveal">
                    <span class="content-card-number"><?php echo e(str_pad($loop->iteration, 2, '0', STR_PAD_LEFT)); ?></span>
                    <h3><?php echo e($item['title']); ?></h3>
                    <p><?php echo e($item['description']); ?></p>
                    <strong><?php echo e($item['signal']); ?></strong>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<section class="section soft" id="decision-framework" aria-labelledby="pillars-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label"><?php echo e($isGuide ? 'چارچوب ارزیابی' : 'معماری راهکار'); ?></span><h2 class="section-title" id="pillars-title"><?php echo e($page['pillars_heading']); ?></h2><p class="section-sub"><?php echo e($page['pillars_intro']); ?></p></div>
        <div class="content-pillars-grid">
            <?php $__currentLoopData = $page['pillars']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pillar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="content-pillar-card reveal">
                    <span class="content-pillar-index">۰<?php echo e($loop->iteration); ?></span>
                    <h3><?php echo e($pillar['title']); ?></h3>
                    <p><?php echo e($pillar['description']); ?></p>
                    <a href="<?php echo e($linkUrl($pillar['link'])); ?>"><?php echo e($pillar['link']['label']); ?> <span aria-hidden="true">←</span></a>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<section class="section content-workflow-section" id="workflow-section" aria-labelledby="workflow-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">جریان عملیاتی</span><h2 class="section-title" id="workflow-title"><?php echo e($page['workflow_heading']); ?></h2><p class="section-sub"><?php echo e($page['workflow_intro']); ?></p></div>
        <ol class="content-workflow">
            <?php $__currentLoopData = $page['workflow']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="reveal"><span><?php echo e($loop->iteration); ?></span><div><h3><?php echo e($step['title']); ?></h3><p><?php echo e($step['description']); ?></p></div></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ol>
    </div>
</section>

<section class="section soft content-deep-dive-section" id="deep-dive-section" aria-labelledby="deep-dive-title">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label"><?php echo e($depth['deep_dive']['label']); ?></span>
            <h2 class="section-title" id="deep-dive-title"><?php echo e($depth['deep_dive']['heading']); ?></h2>
            <p class="section-sub"><?php echo e($depth['deep_dive']['intro']); ?></p>
        </div>
        <div class="content-deep-dive-list">
            <?php $__currentLoopData = $depth['deep_dive']['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="content-deep-dive-card reveal">
                    <div class="content-deep-dive-heading">
                        <span><?php echo e(str_pad($loop->iteration, 2, '0', STR_PAD_LEFT)); ?></span>
                        <div><h3><?php echo e($item['title']); ?></h3><p><?php echo e($item['description']); ?></p></div>
                    </div>
                    <ul>
                        <?php $__currentLoopData = $item['bullets']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bullet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($bullet); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<section class="section content-metrics-section" id="metrics-section" aria-labelledby="metrics-title">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label"><?php echo e($depth['metrics']['label']); ?></span>
            <h2 class="section-title" id="metrics-title"><?php echo e($depth['metrics']['heading']); ?></h2>
            <p class="section-sub"><?php echo e($depth['metrics']['intro']); ?></p>
        </div>
        <div class="content-metrics-grid">
            <?php $__currentLoopData = $depth['metrics']['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="content-metric-card reveal">
                    <span>KPI <?php echo e(str_pad($loop->iteration, 2, '0', STR_PAD_LEFT)); ?></span>
                    <h3><?php echo e($item['name']); ?></h3>
                    <p><?php echo e($item['description']); ?></p>
                    <small><?php echo e($item['source']); ?></small>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<section class="section soft content-rollout-section" id="rollout-section" aria-labelledby="rollout-title">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label"><?php echo e($depth['rollout']['label']); ?></span>
            <h2 class="section-title" id="rollout-title"><?php echo e($depth['rollout']['heading']); ?></h2>
            <p class="section-sub"><?php echo e($depth['rollout']['intro']); ?></p>
        </div>
        <ol class="content-rollout-list">
            <?php $__currentLoopData = $depth['rollout']['steps']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="reveal">
                    <span><?php echo e($loop->iteration); ?></span>
                    <div><h3><?php echo e($step['title']); ?></h3><p><?php echo e($step['description']); ?></p><strong><?php echo e($step['deliverable']); ?></strong></div>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ol>
    </div>
</section>

<section class="section" id="checklist-section" aria-labelledby="checklist-title">
    <div class="container content-checklist-layout">
        <div class="content-checklist-copy reveal"><span class="section-label">چک‌لیست اجرایی</span><h2 class="section-title" id="checklist-title"><?php echo e($page['checklist_heading']); ?></h2><p><?php echo e($page['checklist_intro']); ?></p></div>
        <div class="content-checklist">
            <?php $__currentLoopData = $page['checklist']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="reveal"><strong><?php echo e($item['criterion']); ?></strong><p><?php echo e($item['question']); ?></p></article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<section class="section soft" id="boundaries-section" aria-labelledby="boundaries-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">مسیرهای مرتبط</span><h2 class="section-title" id="boundaries-title"><?php echo e($page['boundary_heading']); ?></h2><p class="section-sub">برای ادامه بررسی هر بخش، از مسیر تخصصی مرتبط استفاده کنید.</p></div>
        <div class="content-boundaries-grid">
            <?php $__currentLoopData = $page['boundaries']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $boundary): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="content-boundary-card reveal"><h3><?php echo e($boundary['title']); ?></h3><p><?php echo e($boundary['description']); ?></p><a href="<?php echo e($linkUrl($boundary['link'])); ?>"><?php echo e($boundary['link']['label']); ?> <span aria-hidden="true">←</span></a></article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<section class="section" id="content-faq-section" aria-labelledby="content-faq-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">پرسش‌های متداول</span><h2 class="section-title" id="content-faq-title">سؤالات متداول <?php echo e($page['nav_title']); ?></h2></div>
        <div class="faq"><?php $__currentLoopData = $page['faqs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><details class="reveal"><summary><?php echo e($faq['question']); ?></summary><p><?php echo e($faq['answer']); ?></p></details><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div>
    </div>
</section>

<section class="cta-wrap"><div class="container"><div class="cta reveal"><div class="cta-copy"><h2><?php echo e($page['cta_title']); ?></h2><p><?php echo e($page['cta_text']); ?></p></div><div class="cta-action"><a class="btn" href="<?php echo e(route('consultation.create')); ?>" data-ga-event="cta_click" data-ga-label="<?php echo e($slug); ?>_bottom_consultation"><?php echo e($page['cta_button'] ?? 'درخواست دمو و مشاوره'); ?></a></div></div></div></section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.marketing', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\project\sepand\portal-customer\resources\views/marketing/content-page.blade.php ENDPATH**/ ?>