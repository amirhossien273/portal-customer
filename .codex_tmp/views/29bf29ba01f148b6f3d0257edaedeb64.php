<?php
    $capabilities = $mode['capabilities'];
    $faqs = $mode['faqs'];
?>

<?php $__env->startPush('head'); ?>
<script type="application/ld+json"><?php echo json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'SoftwareApplication',
            'name' => $mode['h1'],
            'applicationCategory' => 'BusinessApplication',
            'operatingSystem' => 'Web',
            'description' => $mode['meta_description'],
            'url' => route('site.transport-modes.show', ['mode' => $slug]),
            'featureList' => array_column($capabilities, 'title'),
        ],
        [
            '@type' => 'FAQPage',
            'mainEntity' => array_map(static fn (array $faq): array => [
                '@type' => 'Question',
                'name' => $faq['question'],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['answer']],
            ], $faqs),
        ],
        [
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'صفحه اصلی', 'item' => route('home')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'حالت‌های حمل', 'item' => route('home').'#transport-modes'],
                ['@type' => 'ListItem', 'position' => 3, 'name' => $mode['name'], 'item' => route('site.transport-modes.show', ['mode' => $slug])],
            ],
        ],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('marketing.partials.module-rich-styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if($slug === 'air'): ?>
    <?php $__env->startPush('styles'); ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/marketing-air-freight.css')); ?>?v=20260829-2">
    <?php $__env->stopPush(); ?>
<?php elseif($slug === 'road'): ?>
    <?php $__env->startPush('styles'); ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/marketing-road-freight.css')); ?>?v=20260829-1">
    <?php $__env->stopPush(); ?>
<?php elseif($slug === 'rail'): ?>
    <?php $__env->startPush('styles'); ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/marketing-rail-freight.css')); ?>?v=20260827-1">
    <?php $__env->stopPush(); ?>
<?php endif; ?>


<?php $__env->startSection('content'); ?>
<section class="page-hero">
    <div class="container hero-inner">
        <div class="hero-copy crm-hero-copy reveal">
            <nav class="breadcrumb" aria-label="مسیر راهنما">
                <a href="<?php echo e(route('home')); ?>">صفحه اصلی</a>
                <svg viewBox="0 0 24 24" fill="none"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                <a href="<?php echo e(route('home')); ?>#transport-modes">حالت‌های حمل</a>
                <svg viewBox="0 0 24 24" fill="none"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                <span><?php echo e($mode['name']); ?></span>
            </nav>
            <h1 class="module-hero-title">
                <span class="module-hero-title-main"><?php echo e($mode['h1_main']); ?></span>
                <span class="module-hero-title-accent"><?php echo e($mode['h1_accent']); ?></span>
            </h1>
            <?php $__currentLoopData = $mode['hero']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paragraph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <p class="crm-lead"><?php echo e($paragraph); ?></p>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="hero-actions">
                <a class="btn btn-primary" href="<?php echo e(route('consultation.create')); ?>" data-ga-event="cta_click" data-ga-label="transport_<?php echo e($slug); ?>_hero_consultation"><?php echo e($mode['cta']['primary']); ?></a>
                <a class="btn btn-outline" href="#transport-features"><?php echo e($mode['cta']['secondary']); ?></a>
            </div>
        </div>
        <div class="hero-art crm-hero-art reveal">
            <div class="art-panel module-hero-image-panel">
                <img
                    class="module-hero-image"
                    src="<?php echo e(asset('assets/images/marketing/transport-modes/'.$slug.'-hero.webp')); ?>"
                    alt="<?php echo e($slug === 'road' ? 'تصویر مفهومی تخصیص کامیون، مسیر و عبور مرزی در حمل زمینی سپند' : (in_array($slug, ['air', 'rail'], true) ? 'تصویر مفهومی عملیات ' . $mode['name'] . ' سپند' : 'تصویر سه‌بعدی ' . $mode['name'] . ' در نرم‌افزار سپند')); ?>"
                    width="1536"
                    height="1024"
                    loading="eager"
                    fetchpriority="high"
                >
                <span class="module-hero-brand" aria-label="سپند، CRM هوشمند حمل‌ونقل">
                    <img src="<?php echo e(asset('assets/images/brand/sepand-provided-header.png')); ?>" alt="" width="45" height="30">
                    <span>
                        <strong>سپند</strong>
                        <small>CRM هوشمند حمل‌ونقل</small>
                    </span>
                </span>
            </div>
        </div>
    </div>
</section>

<section class="section soft" id="transport-features" aria-labelledby="transport-features-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">امکانات تخصصی</span><h2 class="section-title" id="transport-features-title"><?php echo e($mode['features_heading']); ?></h2><p class="section-sub"><?php echo e($mode['features_intro']); ?></p></div>
        <div class="crm-capability-grid">
            <?php $__currentLoopData = $capabilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $capability): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="crm-capability reveal"><span class="crm-capability-num"><?php echo e(str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT)); ?></span><h3><?php echo e($capability['title']); ?></h3><p><?php echo e($capability['description']); ?></p></article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<?php if($slug === 'air'): ?>
    <?php echo $__env->make('marketing.transport-modes.air-shipment-overview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('marketing.transport-modes.air-chargeable-weight', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('marketing.transport-modes.air-flight-journey', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('marketing.transport-modes.air-documents-uld', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif($slug === 'road'): ?>
    <?php echo $__env->make('marketing.transport-modes.road-trip-overview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('marketing.transport-modes.road-border-journey', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('marketing.transport-modes.road-delivery-pod', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('marketing.transport-modes.road-trip-costs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif($slug === 'rail'): ?>
    <?php echo $__env->make('marketing.transport-modes.rail-operations-depth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(! empty($mode['workflow_heading']) && ! empty($mode['workflow_intro']) && ! empty($mode['workflow'])): ?>
<section class="section" aria-labelledby="transport-workflow-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">فرایند یکپارچه</span><h2 class="section-title" id="transport-workflow-title"><?php echo e($mode['workflow_heading']); ?></h2><p class="section-sub"><?php echo e($mode['workflow_intro']); ?></p></div>
        <div class="crm-process-grid">
            <?php $__currentLoopData = $mode['workflow']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="crm-process reveal"><span class="crm-process-step"><?php echo e($loop->iteration); ?></span><h3><?php echo e($step['title']); ?></h3><p><?php echo e($step['description']); ?></p></article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<section class="dark-section" aria-labelledby="transport-benefits-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">مزیت‌های عملیاتی</span><h2 class="section-title" id="transport-benefits-title"><?php echo e($mode['benefits_heading']); ?></h2></div>
        <p class="crm-benefit-intro reveal"><?php echo e($mode['benefits_intro']); ?></p>
        <ul class="crm-benefits-grid">
            <?php $__currentLoopData = $mode['benefits']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $benefit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="reveal"><?php echo e($benefit); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
</section>

<section class="section" aria-labelledby="related-transport-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">سایر حالت‌های حمل</span><h2 class="section-title" id="related-transport-title">مدیریت حمل چندوجهی در سپند</h2><p class="section-sub"><?php echo e($mode['related_intro'] ?? 'پرونده‌های دریایی، هوایی، زمینی و ریلی در یک ساختار مشترک به فروش، مدیریت عملیات حمل، اسناد و مالی متصل می‌شوند.'); ?></p></div>
        <div class="crm-process-grid">
            <?php $__currentLoopData = $relatedModes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relatedSlug => $relatedMode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a class="crm-process mode-related reveal" href="<?php echo e(route('site.transport-modes.show', ['mode' => $relatedSlug])); ?>"><span class="crm-process-step"><?php echo e($loop->iteration); ?></span><h3><?php echo e($relatedMode['name']); ?></h3><p><?php echo e($relatedMode['card_summary']); ?></p><span class="mode-related-link">مشاهده جزئیات ←</span></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<section class="section soft" aria-labelledby="transport-faq-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">سؤالات متداول</span><h2 class="section-title" id="transport-faq-title"><?php echo e($mode['faq_heading']); ?></h2></div>
        <p class="crm-faq-intro reveal"><?php echo e($mode['faq_intro']); ?></p>
        <div class="faq">
            <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <details class="reveal"><summary><?php echo e($faq['question']); ?></summary><p><?php echo e($faq['answer']); ?></p></details>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<section class="cta-wrap"><div class="container"><div class="cta reveal"><div class="cta-copy"><h2><?php echo e($mode['cta']['title']); ?></h2><p><?php echo e($mode['cta']['text']); ?></p></div><div class="cta-action"><a class="btn" href="<?php echo e(route('consultation.create')); ?>" data-ga-event="cta_click" data-ga-label="transport_<?php echo e($slug); ?>_bottom_consultation"><?php echo e($mode['cta']['primary']); ?></a></div></div></div></section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.marketing', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\project\sepand\portal-customer\resources\views/marketing/transport-mode-detail.blade.php ENDPATH**/ ?>