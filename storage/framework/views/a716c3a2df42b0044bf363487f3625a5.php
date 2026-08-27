<?php
    $capabilities = $page['capabilities'];
    $faqs = $page['faqs'];
?>

<?php $__env->startPush('head'); ?>
<script type="application/ld+json"><?php echo json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'SoftwareApplication',
            'name' => $page['h1'],
            'applicationCategory' => 'BusinessApplication',
            'operatingSystem' => 'Web',
            'description' => $module['meta_description'],
            'url' => route('site.modules.show', ['module' => $slug]),
            'featureList' => array_column($capabilities, 'title'),
            'audience' => [
                '@type' => 'BusinessAudience',
                'audienceType' => implode('، ', array_column($page['audiences'], 'title')),
            ],
        ],
        [
            '@type' => 'FAQPage',
            'mainEntity' => array_map(static fn (array $faq): array => [
                '@type' => 'Question',
                'name' => $faq['question'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $faq['answer'],
                ],
            ], $faqs),
        ],
        [
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'صفحه اصلی', 'item' => route('home')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'ماژول‌ها', 'item' => route('modules')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => $module['name'], 'item' => route('site.modules.show', ['module' => $slug])],
            ],
        ],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('marketing.partials.module-rich-styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>
<section class="page-hero">
    <div class="container hero-inner">
        <div class="hero-copy crm-hero-copy reveal">
            <nav class="breadcrumb" aria-label="مسیر راهنما"><a href="<?php echo e(route('home')); ?>">صفحه اصلی</a><svg viewBox="0 0 24 24" fill="none"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg><a href="<?php echo e(route('modules')); ?>">ماژول‌ها</a><svg viewBox="0 0 24 24" fill="none"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg><span><?php echo e($module['name']); ?></span></nav>
            <h1 class="module-hero-title">
                <span class="module-hero-title-main"><?php echo e($page['h1_main']); ?></span>
                <span class="module-hero-title-accent"><?php echo e($page['h1_accent']); ?></span>
            </h1>
            <?php $__currentLoopData = $page['hero']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paragraph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <p class="crm-lead"><?php echo e($paragraph); ?></p>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="hero-actions">
                <a class="btn btn-primary" href="<?php echo e(route('consultation.create')); ?>" data-ga-event="cta_click" data-ga-label="module_<?php echo e($slug); ?>_hero_consultation"><?php echo e($page['cta']['primary']); ?></a>
                <a class="btn btn-outline" href="#module-features"><?php echo e($page['cta']['secondary']); ?></a>
            </div>
        </div>
        <div class="hero-art crm-hero-art reveal">
            <?php echo $__env->make('marketing.partials.module-screenshot-slider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</section>

<section class="section" aria-labelledby="module-problems-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">مسئله و راهکار</span><h2 class="section-title" id="module-problems-title"><?php echo e($page['problem_heading']); ?></h2></div>
        <p class="crm-intro reveal"><?php echo e($page['problem_intro']); ?></p>
        <div class="crm-problem reveal"><strong>چالش رایج کسب‌وکار</strong><p><?php echo e($page['problem_summary']); ?></p></div>
        <div class="crm-problem-grid">
            <?php $__currentLoopData = $page['problems']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $problem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="crm-problem-card reveal"><h3><?php echo e($problem['title']); ?></h3><p><?php echo e($problem['description']); ?></p></article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <ul class="crm-outcomes">
            <?php $__currentLoopData = $page['outcomes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $outcome): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="reveal"><?php echo e($outcome); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
</section>

<section class="section soft" id="module-features" aria-labelledby="module-features-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">امکانات اصلی</span><h2 class="section-title" id="module-features-title"><?php echo e($page['features_heading']); ?></h2><p class="section-sub"><?php echo e($page['features_intro']); ?></p></div>
        <div class="crm-capability-grid">
            <?php $__currentLoopData = $capabilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $capability): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="crm-capability reveal"><span class="crm-capability-num"><?php echo e(str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT)); ?></span><h3><?php echo e($capability['title']); ?></h3><p><?php echo e($capability['description']); ?></p></article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<?php if(! empty($page['insights'])): ?>
<section class="section" id="<?php echo e($slug === 'pricing-sales' ? 'pricing-intelligence' : 'module-insights'); ?>" aria-labelledby="module-insights-title">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label">داشبورد تصمیم‌گیری</span>
            <h2 class="section-title" id="module-insights-title"><?php echo e($page['insights_heading']); ?></h2>
            <p class="section-sub"><?php echo e($page['insights_intro']); ?></p>
        </div>
        <div class="crm-capability-grid">
            <?php $__currentLoopData = $page['insights']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $insight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="crm-capability reveal">
                    <span class="crm-capability-num"><?php echo e(str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT)); ?></span>
                    <h3><?php echo e($insight['title']); ?></h3>
                    <p><?php echo e($insight['description']); ?></p>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<section class="section" aria-labelledby="module-integration-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">فرایند یکپارچه</span><h2 class="section-title" id="module-integration-title"><?php echo e($page['integration_heading']); ?></h2><p class="section-sub"><?php echo e($page['integration_intro']); ?></p></div>
        <?php if($slug === 'transport-operations'): ?>
            <nav class="section-sub reveal" aria-label="روش‌های حمل مرتبط">مدیریت عملیات در سپند برای <a href="<?php echo e(route('site.transport-modes.show', ['mode' => 'air'])); ?>">حمل هوایی</a>، <a href="<?php echo e(route('site.transport-modes.show', ['mode' => 'sea'])); ?>">حمل دریایی</a>، <a href="<?php echo e(route('site.transport-modes.show', ['mode' => 'road'])); ?>">حمل زمینی</a> و <a href="<?php echo e(route('site.transport-modes.show', ['mode' => 'rail'])); ?>">حمل ریلی</a> در دسترس است.</nav>
        <?php endif; ?>
        <div class="crm-process-grid">
            <?php $__currentLoopData = $page['connections']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $connection): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="crm-process reveal"><span class="crm-process-step"><?php echo e($loop->iteration); ?></span><h3><?php echo e($connection['title']); ?></h3><p><?php echo e($connection['description']); ?></p><a href="<?php echo e(route('site.modules.show', ['module' => $connection['slug']])); ?>">مشاهده ماژول <?php echo e(config('site_modules.'.$connection['slug'].'.short_name')); ?></a></article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<section class="dark-section" aria-labelledby="module-benefits-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">مزیت‌های عملیاتی</span><h2 class="section-title" id="module-benefits-title"><?php echo e($page['benefits_heading']); ?></h2></div>
        <p class="crm-benefit-intro reveal"><?php echo e($page['benefits_intro']); ?></p>
        <ul class="crm-benefits-grid">
            <?php $__currentLoopData = $page['benefits']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $benefit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="reveal"><?php echo e($benefit); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
</section>

<section class="section" aria-labelledby="module-audience-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">مخاطبان ماژول</span><h2 class="section-title" id="module-audience-title"><?php echo e($page['audience_heading']); ?></h2><p class="section-sub"><?php echo e($page['audience_intro']); ?></p></div>
        <div class="crm-audience-grid">
            <?php $__currentLoopData = $page['audiences']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $audience): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="crm-audience reveal"><h3><?php echo e($audience['title']); ?></h3><p><?php echo e($audience['description']); ?></p></article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<section class="section soft" aria-labelledby="module-faq-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">سؤالات متداول</span><h2 class="section-title" id="module-faq-title"><?php echo e($page['faq_heading']); ?></h2></div>
        <p class="crm-faq-intro reveal"><?php echo e($page['faq_intro']); ?></p>
        <div class="faq">
            <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <details class="reveal"><summary><?php echo e($faq['question']); ?></summary><p><?php echo e($faq['answer']); ?></p></details>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<section class="cta-wrap"><div class="container"><div class="cta reveal"><div class="cta-copy"><h2><?php echo e($page['cta']['title']); ?></h2><p><?php echo e($page['cta']['text']); ?></p></div><div class="cta-action"><a class="btn" href="<?php echo e(route('consultation.create')); ?>" data-ga-event="cta_click" data-ga-label="module_<?php echo e($slug); ?>_bottom_consultation"><?php echo e($page['cta']['primary']); ?></a></div></div></div></section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.marketing', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\project\sepand\portal-customer\resources\views/marketing/module-detail.blade.php ENDPATH**/ ?>