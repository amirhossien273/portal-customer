<?php
    $faqPage = config('site_faq');
    $title = $faqPage['title'];
    $description = $faqPage['description'];
    $canonical = route('faq');
    $sections = $faqPage['sections'];
    $questions = collect($sections)->flatMap(fn (array $section) => $section['questions'])->values();
    $plainAnswer = static fn (array $parts): string => collect($parts)
        ->map(static fn (array $part): string => $part['text'] ?? $part['label'])
        ->implode('');
    $schemaQuestions = $questions->map(static fn (array $faq): array => [
        '@type' => 'Question',
        'name' => $faq['question'],
        'acceptedAnswer' => [
            '@type' => 'Answer',
            'text' => $plainAnswer($faq['answer']),
        ],
    ])->all();
?>

<?php $__env->startPush('head'); ?>
    <script type="application/ld+json"><?php echo json_encode([
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'FAQPage',
                '@id' => route('faq').'#faq',
                'url' => route('faq'),
                'name' => $title,
                'description' => $description,
                'inLanguage' => 'fa-IR',
                'dateModified' => $faqPage['updated_at'],
                'mainEntity' => $schemaQuestions,
            ],
            [
                '@type' => 'BreadcrumbList',
                '@id' => route('faq').'#breadcrumb',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => 'صفحه اصلی', 'item' => route('home')],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => 'سؤالات متداول', 'item' => route('faq')],
                ],
            ],
        ],
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/marketing-faq.css')); ?>?v=20260805-1">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<section class="page-hero faq-page-hero">
    <div class="container hero-inner">
        <div class="hero-copy reveal">
            <div class="breadcrumb"><a href="<?php echo e(route('home')); ?>">صفحه اصلی</a><svg viewBox="0 0 24 24" fill="none"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg><span>سؤالات متداول</span></div>
            <h1>پاسخ پرسش‌های مهم درباره<br><span>نرم‌افزار CRM حمل‌ونقل</span></h1>
            <p>پاسخ‌های تخصصی و روشن درباره انتخاب نرم‌افزار فورواردری، مدیریت مشتریان، نرخ‌دهی، Booking، عملیات حمل، اسناد، حسابداری چندارزی و رهگیری محموله را در این راهنما بخوانید.</p>
            <div class="hero-actions"><a class="btn btn-primary" href="#faq-content">مشاهده پاسخ‌ها</a><a class="btn btn-outline" href="<?php echo e(route('consultation.create')); ?>">درخواست مشاوره</a></div>
        </div>
        <div class="hero-art faq-hero-art reveal" role="img" aria-label="راهنمای سؤالات متداول نرم‌افزار CRM حمل‌ونقل سپند">
            <div class="art-panel faq-hero-panel">
                <div class="faq-hero-content">
                    <span class="faq-hero-label">راهنمای انتخاب و استقرار</span>
                    <div class="faq-hero-question">CRM تخصصی حمل‌ونقل چه تفاوتی دارد؟</div>
                    <div class="faq-hero-question">کدام ماژول برای شرکت ما مناسب است؟</div>
                    <div class="faq-hero-question">فروش، عملیات و مالی چگونه یکپارچه می‌شوند؟</div>
                    <p class="faq-hero-foot">۲۰ پاسخ کاربردی با لینک مستقیم به راهکارهای مرتبط سپند</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section soft" id="faq-content" aria-labelledby="faq-page-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">راهنمای جامع سپند</span><h2 class="section-title" id="faq-page-title">سؤالات متداول نرم‌افزار<br><span>مدیریت حمل‌ونقل و فورواردری</span></h2></div>
        <p class="faq-intro reveal">این پاسخ‌ها برای مدیران شرکت‌های حمل‌ونقل بین‌المللی، فورواردرها، تیم‌های فروش، عملیات، اسناد و مالی تهیه شده‌اند تا پیش از انتخاب یا استقرار نرم‌افزار، مسیرهای مرتبط را سریع‌تر پیدا کنند.</p>
        <div class="faq-content-layout">
            <aside class="faq-directory reveal" aria-label="دسته‌بندی سؤالات متداول">
                <strong>موضوع موردنظر</strong>
                <nav>
                    <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="#<?php echo e($section['id']); ?>"><?php echo e($section['title']); ?></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </nav>
            </aside>
            <div class="faq-main">
                <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <section class="faq-cluster reveal" id="<?php echo e($section['id']); ?>" aria-labelledby="<?php echo e($section['id']); ?>-title">
                        <header class="faq-cluster-head">
                            <span>دسته <?php echo e(str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT)); ?></span>
                            <h2 id="<?php echo e($section['id']); ?>-title"><?php echo e($section['title']); ?></h2>
                            <p><?php echo e($section['description']); ?></p>
                        </header>
                        <div class="faq-page-list">
                            <?php $__currentLoopData = $section['questions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <article class="faq-page-item" id="<?php echo e($faq['id']); ?>">
                                    <span class="faq-item-number"><?php echo e(str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT)); ?></span>
                                    <h3><a href="#<?php echo e($faq['id']); ?>"><?php echo e($faq['question']); ?></a></h3>
                                    <p>
                                        <?php $__currentLoopData = $faq['answer']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $part): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(isset($part['route'])): ?>
                                                <a href="<?php echo e(route($part['route'], $part['parameters'] ?? [])); ?>"><?php echo e($part['label']); ?></a>
                                            <?php else: ?>
                                                <?php echo e($part['text']); ?>

                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </p>
                                </article>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </section>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>

<section class="section faq-links-section" aria-labelledby="faq-links-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">دسترسی سریع</span><h2 class="section-title" id="faq-links-title">مسیرهای مهم برای<br><span>شناخت نرم‌افزار سپند</span></h2></div>
        <div class="faq-link-grid">
            <a class="faq-link-card reveal" href="<?php echo e(route('modules')); ?>">مشاهده تمام ماژول‌ها</a>
            <a class="faq-link-card reveal" href="<?php echo e(route('site.modules.show', ['module' => 'crm'])); ?>">CRM حمل‌ونقل</a>
            <a class="faq-link-card reveal" href="<?php echo e(route('site.modules.show', ['module' => 'pricing-sales'])); ?>">نرخ‌دهی و فروش</a>
            <a class="faq-link-card reveal" href="<?php echo e(route('site.modules.show', ['module' => 'transport-operations'])); ?>">مدیریت عملیات حمل</a>
            <a class="faq-link-card reveal" href="<?php echo e(route('site.modules.show', ['module' => 'finance-accounting'])); ?>">مالی و حسابداری چندارزی</a>
            <a class="faq-link-card reveal" href="<?php echo e(route('site.transport-modes.show', ['mode' => 'sea'])); ?>">مدیریت حمل دریایی</a>
            <a class="faq-link-card reveal" href="<?php echo e(route('pricing')); ?>">تعرفه نرم‌افزار</a>
            <a class="faq-link-card reveal" href="<?php echo e(route('consultation.create')); ?>">درخواست دمو و مشاوره</a>
        </div>
    </div>
</section>

<section class="cta-wrap">
    <div class="container"><div class="cta reveal"><div class="cta-copy"><h2>پاسخ دقیق‌تر را بر اساس فرایند شرکت خود دریافت کنید</h2><p>در جلسه نیازسنجی، اولویت‌های فروش، عملیات، اسناد و مالی مجموعه شما بررسی می‌شود.</p></div><div class="cta-action"><a class="btn" href="<?php echo e(route('consultation.create')); ?>" data-ga-event="cta_click" data-ga-label="faq_consultation">درخواست دمو و مشاوره</a></div></div></div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.marketing', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\project\sepand\portal-customer\resources\views/marketing/faq.blade.php ENDPATH**/ ?>