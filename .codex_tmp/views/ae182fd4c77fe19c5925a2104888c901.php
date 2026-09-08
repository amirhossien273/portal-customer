<?php $__env->startPush('head'); ?>
<script type="application/ld+json"><?php echo json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        ['@type' => 'Article', '@id' => $canonical.'#article', 'headline' => $page['h1'], 'description' => $description, 'image' => $image, 'datePublished' => '2026-09-06', 'dateModified' => '2026-09-06', 'inLanguage' => 'fa-IR', 'author' => ['@type' => 'Organization', 'name' => 'سپند'], 'publisher' => ['@type' => 'Organization', 'name' => 'سپند']],
        ['@type' => 'BreadcrumbList', 'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'صفحه اصلی', 'item' => route('home')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'چرا سپند', 'item' => route('why-sepand')],
            ['@type' => 'ListItem', 'position' => 3, 'name' => 'مطالعه موردی کنترل عملیات', 'item' => $canonical],
        ]],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/css/marketing-case-study.css')); ?>?v=20260906-1">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<section class="case-hero">
    <div class="container case-hero-grid">
        <div class="reveal">
            <nav class="breadcrumb" aria-label="مسیر صفحه"><a href="<?php echo e(route('home')); ?>">صفحه اصلی</a><span>/</span><a href="<?php echo e(route('why-sepand')); ?>">چرا سپند</a><span>/</span><span>مطالعه موردی</span></nav>
            <span class="case-eyebrow"><?php echo e($page['eyebrow']); ?></span>
            <h1><?php echo e($page['h1']); ?></h1>
            <p><?php echo e($page['lead']); ?></p>
            <div class="case-meta"><span>تاریخ Snapshot: <?php echo e($page['captured_at']); ?></span><span>داده واقعی، هویت ناشناس</span></div>
        </div>
        <figure class="case-hero-visual reveal"><img src="<?php echo e(asset('assets/images/marketing/'.$page['image'])); ?>" width="<?php echo e($page['image_width']); ?>" height="<?php echo e($page['image_height']); ?>" alt="<?php echo e($page['image_alt']); ?>"><figcaption><?php echo e($page['scope']); ?></figcaption></figure>
    </div>
</section>

<section class="section" aria-labelledby="case-kpi-title">
    <div class="container">
        <header class="section-head reveal"><span class="section-label">Observed KPI Snapshot</span><h2 class="section-title" id="case-kpi-title">اعداد مشاهده‌شده، نه وعده بازاریابی</h2><p class="section-sub">این KPIها وضعیت یک لحظه واقعی را نشان می‌دهند و با KPI بهبود یا نتیجه علّی اشتباه گرفته نمی‌شوند.</p></header>
        <div class="case-kpis"><?php $__currentLoopData = $page['metrics']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $metric): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><article class="reveal"><strong><?php echo e($metric['value']); ?></strong><h3><?php echo e($metric['label']); ?></h3><p><?php echo e($metric['meaning']); ?></p></article><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div>
    </div>
</section>

<section class="section soft" aria-labelledby="case-story-title">
    <div class="container case-story-layout">
        <header class="reveal"><span class="section-label">Operational Narrative</span><h2 class="section-title" id="case-story-title">از مشاهده تا اقدام قابل سنجش</h2><p>داستان این استقرار را بدون پرکردن فاصله‌های داده با ادعای تخمینی می‌خوانیم.</p></header>
        <ol class="case-story"><?php $__currentLoopData = $page['story']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li class="reveal"><span><?php echo e(str_pad($loop->iteration, 2, '0', STR_PAD_LEFT)); ?></span><div><h3><?php echo e($item['title']); ?></h3><p><?php echo e($item['text']); ?></p></div></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ol>
    </div>
</section>

<section class="section case-method" aria-labelledby="case-method-title">
    <div class="container case-method-grid">
        <div class="reveal"><span class="section-label">روش و محدودیت</span><h2 class="section-title" id="case-method-title">چگونه این مطالعه را قابل اعتماد نگه داشتیم؟</h2><ul><?php $__currentLoopData = $page['methodology']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($item); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul></div>
        <aside class="reveal"><small>NEXT MEASUREMENT WINDOW</small><h2>چهار KPI برای مطالعه قبل/بعد واقعی</h2><?php $__currentLoopData = $page['next_kpis']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><article><h3><?php echo e($item['title']); ?></h3><p><?php echo e($item['text']); ?></p></article><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></aside>
    </div>
</section>

<section class="cta-wrap"><div class="container"><div class="cta reveal"><div class="cta-copy"><h2>مطالعه موردی بعدی را با خط مبنای واقعی سازمان شما بسازیم</h2><p>دامنه، دوره پایه و KPIها را پیش از استقرار توافق می‌کنیم تا نتیجه پس از اجرا قابل دفاع باشد.</p></div><div class="cta-action"><a class="btn" href="<?php echo e(route('consultation.create')); ?>" data-ga-event="cta_click" data-ga-label="case_study_demo">درخواست جلسه ارزیابی</a></div></div></div></section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.marketing', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\project\sepand\portal-customer\resources\views/marketing/case-studies/show.blade.php ENDPATH**/ ?>