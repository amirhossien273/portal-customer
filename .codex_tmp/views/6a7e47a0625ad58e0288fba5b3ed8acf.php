<?php
    $isTower = $slug === 'operations-control-tower';
    $relatedUrls = array_map(
        static fn (array $item): string => route($item['route'], $item['parameters'] ?? []),
        $page['related']
    );
    $breadcrumb = [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'صفحه اصلی', 'item' => route('home')],
        ['@type' => 'ListItem', 'position' => 2, 'name' => 'راهکارها', 'item' => route('solutions.index')],
        ['@type' => 'ListItem', 'position' => 3, 'name' => $page['nav_title'], 'item' => $canonical],
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
            'isPartOf' => ['@id' => route('solutions.index').'#collection'],
            'breadcrumb' => ['@id' => $canonical.'#breadcrumb'],
            'mainEntity' => [['@id' => $canonical.'#software'], ['@id' => $canonical.'#faq']],
            'significantLink' => array_merge([route('product'), route('consultation.create')], $relatedUrls),
        ],
        [
            '@type' => 'SoftwareApplication',
            '@id' => $canonical.'#software',
            'name' => $page['nav_title'].' سپند',
            'applicationCategory' => 'BusinessApplication',
            'operatingSystem' => 'Web',
            'url' => $canonical,
            'description' => $description,
            'image' => $image,
            'featureList' => array_column($page[$isTower ? 'signals' : 'capabilities'], 'title'),
        ],
        [
            '@type' => 'BreadcrumbList',
            '@id' => $canonical.'#breadcrumb',
            'itemListElement' => $breadcrumb,
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
<link rel="stylesheet" href="<?php echo e(asset('assets/css/marketing-operational-solutions.css')); ?>?v=20260908-1">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<section class="ops-hero">
    <div class="container ops-hero-grid">
        <div class="ops-hero-copy reveal">
            <nav class="breadcrumb" aria-label="مسیر صفحه">
                <a href="<?php echo e(route('home')); ?>">صفحه اصلی</a>
                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                <a href="<?php echo e(route('solutions.index')); ?>">راهکارها</a>
                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                <span><?php echo e($page['nav_title']); ?></span>
            </nav>
            <span class="ops-eyebrow"><?php echo e($page['eyebrow']); ?></span>
            <h1><?php echo e($page['h1']); ?></h1>
            <p><?php echo e($page['lead']); ?></p>
            <div class="ops-hero-actions">
                <a class="btn btn-primary" href="<?php echo e(route('consultation.create')); ?>" data-ga-event="cta_click" data-ga-label="<?php echo e($slug); ?>_hero_consultation"><?php echo e($page['hero_primary_label']); ?></a>
                <a class="btn btn-outline" href="<?php echo e(route('product')); ?>"><?php echo e($page['hero_secondary_label']); ?></a>
            </div>
            <blockquote><?php echo e($page['promise']); ?></blockquote>
        </div>
        <figure class="ops-hero-media reveal">
            <div class="ops-window-bar"><span></span><span></span><span></span><strong><?php echo e($isTower ? 'نمای پایش عملیات' : 'طراح گردش کار عملیات'); ?></strong></div>
            <img src="<?php echo e($image); ?>" width="<?php echo e($page['image_width']); ?>" height="<?php echo e($page['image_height']); ?>" alt="<?php echo e($page['image_alt']); ?>" fetchpriority="high">
            <figcaption>نمای واقعی از نرم‌افزار سپند</figcaption>
        </figure>
    </div>
</section>

<nav class="ops-page-nav" aria-label="فهرست بخش‌های صفحه">
    <div class="container">
        <a href="#problem-section">چالش امروز</a>
        <a href="#solution-section">نحوه کار</a>
        <a href="#benefits-section">مزایا</a>
        <a href="#related-section">راهکارهای مرتبط</a>
        <a href="#faq-section">پرسش‌های متداول</a>
    </div>
</nav>

<section class="section ops-problem" id="problem-section" aria-labelledby="problem-title">
    <div class="container ops-problem-grid">
        <div class="ops-problem-copy reveal">
            <span class="section-label">چالش عملیاتی</span>
            <h2 class="section-title" id="problem-title"><?php echo e($page['problem_heading']); ?></h2>
            <p><?php echo e($page['problem_intro']); ?></p>
            <?php if(!$isTower): ?><aside class="ops-inline-example"><strong>نمونه واقعی</strong><p><?php echo e($page['example']); ?></p></aside><?php endif; ?>
        </div>
        <div class="ops-problem-panel reveal">
            <ul>
                <?php $__currentLoopData = $page['problems']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $problem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><span aria-hidden="true">!</span><?php echo e($problem); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <?php if($isTower): ?>
                <div class="ops-morning">
                    <strong>مدیر عملیات باید در آغاز روز پاسخ این پرسش‌ها را بداند:</strong>
                    <?php $__currentLoopData = $page['morning_questions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><p><?php echo e($question); ?></p><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php if($isTower): ?>
    <section class="section soft" id="solution-section" aria-labelledby="signals-title">
        <div class="container">
            <header class="section-head reveal">
                <span class="section-label">مرکز توجه روزانه</span>
                <h2 class="section-title" id="signals-title"><?php echo e($page['monitor_heading']); ?></h2>
                <p class="section-sub"><?php echo e($page['monitor_intro']); ?></p>
            </header>
            <div class="ops-signal-grid">
                <?php $__currentLoopData = $page['signals']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $signal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <article class="ops-signal-card reveal">
                        <div class="ops-signal-number"><?php echo e(str_pad($loop->iteration, 2, '0', STR_PAD_LEFT)); ?></div>
                        <h3><?php echo e($signal['title']); ?></h3>
                        <p><?php echo e($signal['description']); ?></p>
                        <dl><div><dt>نمونه</dt><dd><?php echo e($signal['example']); ?></dd></div><div><dt>اقدام</dt><dd><?php echo e($signal['action']); ?></dd></div></dl>
                    </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
<?php else: ?>
    <section class="section soft" id="solution-section" aria-labelledby="templates-title">
        <div class="container">
            <header class="section-head reveal">
                <span class="section-label">الگوی استاندارد هر حمل</span>
                <h2 class="section-title" id="templates-title"><?php echo e($page['templates_heading']); ?></h2>
                <p class="section-sub"><?php echo e($page['templates_intro']); ?></p>
            </header>
            <div class="ops-template-grid">
                <?php $__currentLoopData = $page['templates']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <article class="ops-template-card reveal">
                        <div><span><?php echo e(str_pad($loop->iteration, 2, '0', STR_PAD_LEFT)); ?></span><h3><?php echo e($template['title']); ?></h3></div>
                        <ol><?php $__currentLoopData = $template['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><span><?php echo e($loop->iteration); ?></span><?php echo e($item); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ol>
                    </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <section class="section" aria-labelledby="capabilities-title">
        <div class="container">
            <header class="section-head reveal"><span class="section-label">اجزای راهکار</span><h2 class="section-title" id="capabilities-title"><?php echo e($page['capabilities_heading']); ?></h2></header>
            <div class="ops-capability-grid">
                <?php $__currentLoopData = $page['capabilities']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $capability): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <article class="ops-capability-card reveal"><span><?php echo e(str_pad($loop->iteration, 2, '0', STR_PAD_LEFT)); ?></span><h3><?php echo e($capability['title']); ?></h3><p><?php echo e($capability['description']); ?></p><strong><?php echo e($capability['example']); ?></strong></article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <section class="section ops-controls-section" aria-labelledby="controls-title">
        <div class="container">
            <header class="section-head reveal"><span class="section-label">پیشگیری از خطا</span><h2 class="section-title" id="controls-title"><?php echo e($page['controls_heading']); ?></h2><p class="section-sub"><?php echo e($page['controls_intro']); ?></p></header>
            <div class="ops-controls-grid">
                <?php $__currentLoopData = $page['controls']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $control): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <article class="<?php echo \Illuminate\Support\Arr::toCssClasses(['ops-control-card', 'reveal', 'is-'.$control['tone']]); ?>"><span aria-hidden="true"><?php echo e($control['tone'] === 'danger' ? '×' : ($control['tone'] === 'warning' ? '!' : '✓')); ?></span><h3><?php echo e($control['title']); ?></h3><p><?php echo e($control['description']); ?></p><strong><?php echo e($control['example']); ?></strong></article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <section class="section" aria-labelledby="scenario-title">
        <div class="container ops-scenario-grid">
            <div class="ops-scenario-copy reveal"><span class="section-label">سناریوی روزانه</span><h2 class="section-title" id="scenario-title"><?php echo e($page['scenario']['title']); ?></h2><dl><div><dt>مسیر</dt><dd><?php echo e($page['scenario']['route']); ?></dd></div><div><dt>روش حمل</dt><dd><?php echo e($page['scenario']['mode']); ?></dd></div></dl><p><?php echo e($page['scenario']['result']); ?></p></div>
            <div class="ops-scenario-table reveal">
                <table>
                    <thead><tr><th>فعالیت</th><th>مسئول</th><th>وضعیت</th></tr></thead>
                    <tbody><?php $__currentLoopData = $page['scenario']['rows']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><tr><td><?php echo e($row['task']); ?></td><td><?php echo e($row['owner']); ?></td><td><span class="is-<?php echo e($row['tone']); ?>"><?php echo e($row['status']); ?></span></td></tr><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></tbody>
                </table>
            </div>
        </div>
    </section>
<?php endif; ?>

<section class="section <?php echo e($isTower ? '' : 'soft'); ?>" id="benefits-section" aria-labelledby="benefits-title">
    <div class="container">
        <header class="section-head reveal"><span class="section-label">نتیجه برای تیم عملیات</span><h2 class="section-title" id="benefits-title"><?php echo e($page['benefits_heading']); ?></h2></header>
        <div class="ops-benefit-grid">
            <?php $__currentLoopData = $page['benefits']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $benefit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><article class="ops-benefit-card reveal"><span aria-hidden="true">✓</span><h3><?php echo e($benefit['title']); ?></h3><p><?php echo e($benefit['description']); ?></p></article><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<?php if($isTower): ?>
    <section class="section ops-before-after" aria-labelledby="change-title">
        <div class="container">
            <header class="section-head reveal"><span class="section-label">تغییر روش کار</span><h2 class="section-title" id="change-title">از پیگیری پراکنده تا فرماندهی یکپارچه</h2></header>
            <div class="ops-change-grid">
                <article class="ops-change-card is-before reveal"><span>پیش از سپند</span><ul><?php $__currentLoopData = $page['before']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($item); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul></article>
                <div class="ops-change-arrow reveal" aria-hidden="true">←</div>
                <article class="ops-change-card is-after reveal"><span>با سپند</span><ul><?php $__currentLoopData = $page['after']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($item); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul></article>
            </div>
        </div>
    </section>
<?php else: ?>
    <section class="ops-bridge" aria-labelledby="bridge-title">
        <div class="container ops-bridge-grid">
            <div class="reveal"><span class="section-label">ارتباط دو راهکار</span><h2 id="bridge-title"><?php echo e($page['bridge_heading']); ?></h2><p><?php echo e($page['bridge_text']); ?></p><a class="btn" href="<?php echo e(route('site.modules.show', ['module' => 'operations-control-tower'])); ?>">مشاهده برج کنترل عملیات</a></div>
            <div class="ops-bridge-signals reveal" aria-label="داده‌های منتقل‌شده به برج کنترل"><span>مرحله ناقص</span><span>مدرک ثبت‌نشده</span><span>کار عقب‌افتاده</span><span>اقدام در انتظار</span></div>
        </div>
    </section>
<?php endif; ?>

<section class="section soft" id="related-section" aria-labelledby="related-title">
    <div class="container">
        <header class="section-head reveal"><span class="section-label">ادامه مسیر</span><h2 class="section-title" id="related-title">راهکارهای مرتبط با این فرایند</h2></header>
        <div class="ops-related-grid">
            <?php $__currentLoopData = $page['related']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a class="ops-related-card reveal" href="<?php echo e(route($item['route'], $item['parameters'] ?? [])); ?>"><span><?php echo e(str_pad($loop->iteration, 2, '0', STR_PAD_LEFT)); ?></span><h3><?php echo e($item['title']); ?></h3><p><?php echo e($item['description']); ?></p><strong>مشاهده راهکار <b aria-hidden="true">←</b></strong></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="ops-mode-links reveal">
            <span>بررسی بر اساس روش حمل:</span>
            <a href="<?php echo e(route('site.transport-modes.show', ['mode' => 'air'])); ?>">حمل هوایی</a>
            <a href="<?php echo e(route('site.transport-modes.show', ['mode' => 'road'])); ?>">حمل جاده‌ای</a>
            <a href="<?php echo e(route('site.transport-modes.show', ['mode' => $isTower ? 'sea' : 'rail'])); ?>"><?php echo e($isTower ? 'حمل دریایی' : 'حمل ریلی'); ?></a>
        </div>
    </div>
</section>

<section class="section" id="faq-section" aria-labelledby="faq-title">
    <div class="container">
        <header class="section-head reveal"><span class="section-label">پرسش‌های متداول</span><h2 class="section-title" id="faq-title">سؤالات متداول <?php echo e($page['nav_title']); ?></h2></header>
        <div class="faq"><?php $__currentLoopData = $page['faqs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><details class="reveal"><summary><?php echo e($faq['question']); ?></summary><p><?php echo e($faq['answer']); ?></p></details><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div>
    </div>
</section>

<section class="cta-wrap"><div class="container"><div class="cta reveal"><div class="cta-copy"><h2><?php echo e($page['cta_title']); ?></h2><p><?php echo e($page['cta_text']); ?></p></div><div class="cta-action"><a class="btn" href="<?php echo e(route('consultation.create')); ?>" data-ga-event="cta_click" data-ga-label="<?php echo e($slug); ?>_bottom_consultation"><?php echo e($page['cta_button']); ?></a></div></div></div></section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.marketing', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\project\sepand\portal-customer\resources\views/marketing/operational-solutions/show.blade.php ENDPATH**/ ?>