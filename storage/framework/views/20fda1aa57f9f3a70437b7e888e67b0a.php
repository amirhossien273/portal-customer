<?php
    $solutionUrl = static fn (string $relatedSlug): string => route('solutions.platform.show', ['solution' => $relatedSlug]);
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
        ['@type' => 'WebPage', '@id' => $canonical.'#webpage', 'url' => $canonical, 'name' => $title, 'description' => $description, 'inLanguage' => 'fa-IR', 'dateModified' => config('site_platform_solutions.updated_at'), 'breadcrumb' => ['@id' => $canonical.'#breadcrumb'], 'mainEntity' => [['@id' => $canonical.'#software'], ['@id' => $canonical.'#faq']]],
        ['@type' => 'SoftwareApplication', '@id' => $canonical.'#software', 'name' => 'راهکار '.$page['nav_title'].' سپند', 'applicationCategory' => 'BusinessApplication', 'operatingSystem' => 'Web', 'url' => $canonical, 'description' => $description, 'featureList' => array_column($page['capabilities'], 'title')],
        ['@type' => 'BreadcrumbList', '@id' => $canonical.'#breadcrumb', 'itemListElement' => $breadcrumb],
        ['@type' => 'FAQPage', '@id' => $canonical.'#faq', 'mainEntity' => array_map(static fn (array $faq): array => ['@type' => 'Question', 'name' => $faq['q'], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['a']]], $page['faqs'])],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/css/marketing-platform-solutions.css')); ?>?v=20260906-1">
<?php if(isset($page['demo'])): ?><link rel="stylesheet" href="<?php echo e(asset('assets/css/marketing-real-demo.css')); ?>?v=20260906-1"><?php endif; ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<section class="platform-hero">
    <div class="container platform-hero-grid">
        <div class="platform-hero-copy reveal">
            <nav class="breadcrumb" aria-label="مسیر صفحه">
                <a href="<?php echo e(route('home')); ?>">صفحه اصلی</a><span aria-hidden="true">/</span>
                <a href="<?php echo e(route('solutions.index')); ?>">راهکارها</a><span aria-hidden="true">/</span>
                <span><?php echo e($page['nav_title']); ?></span>
            </nav>
            <span class="platform-eyebrow"><?php echo e($page['eyebrow']); ?></span>
            <h1><?php echo e($page['h1']); ?></h1>
            <p><?php echo e($page['lead']); ?></p>
            <div class="hero-actions">
                <a class="btn btn-primary" href="#product-evidence"><?php echo e($page['hero_primary_label'] ?? 'مشاهده شواهد واقعی محصول'); ?></a>
                <a class="btn btn-outline" href="<?php echo e(route('consultation.create')); ?>" data-ga-event="cta_click" data-ga-label="<?php echo e($slug); ?>_hero_demo"><?php echo e($page['hero_secondary_label'] ?? 'درخواست دمو'); ?></a>
            </div>
        </div>
        <aside class="platform-hero-panel reveal" aria-label="دامنه این راهکار">
            <span>مسئله‌ای که حل می‌شود</span>
            <h2><?php echo e($page['intent_heading'] ?? ($page['nav_title'].' چه زمانی ضروری است؟')); ?></h2>
            <p><?php echo e($page['problem']); ?></p>
            <div class="platform-mini-metrics">
                <?php $__currentLoopData = array_slice($page['metrics'], 0, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $metric): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><small><?php echo e($metric); ?></small><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </aside>
    </div>
</section>

<section class="platform-boundary" aria-labelledby="intent-title">
    <div class="container">
        <article class="platform-boundary-card reveal">
            <span aria-hidden="true">◎</span>
            <div><small>دامنه و کاربرد راهکار</small><h2 id="intent-title">این صفحه دقیقاً درباره چیست؟</h2><p><?php echo e($page['boundary']); ?></p></div>
        </article>
    </div>
</section>

<nav class="platform-toc" aria-label="فهرست بخش‌های راهکار">
    <div class="container">
        <span>در این صفحه</span>
        <a href="#capabilities">قابلیت‌ها</a><a href="#product-evidence">شواهد محصول</a><?php if(isset($page['demo'])): ?><a href="#real-demo">دموی واقعی</a><?php endif; ?><a href="#workflow">جریان اجرا</a><a href="#operational-depth">عمق عملیاتی</a><a href="#controls">کنترل‌ها</a><a href="#metrics">شاخص‌ها</a><a href="#related-solutions">راهکارهای مرتبط</a><a href="#solution-faq">پرسش‌ها</a>
    </div>
</nav>

<section class="section" id="capabilities" aria-labelledby="capabilities-title">
    <div class="container">
        <header class="section-head reveal"><span class="section-label">معماری راهکار</span><h2 class="section-title" id="capabilities-title">سه قابلیت محوری <?php echo e($page['nav_title']); ?></h2><p class="section-sub">هر قابلیت به داده عملیاتی و خروجی قابل پیگیری متصل است؛ نه یک داشبورد جدا از فرایند.</p></header>
        <div class="platform-capability-grid">
            <?php $__currentLoopData = $page['capabilities']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $capability): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="platform-capability-card reveal"><span>۰<?php echo e($loop->iteration); ?></span><h3><?php echo e($capability['title']); ?></h3><p><?php echo e($capability['text']); ?></p></article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<section class="section platform-evidence-section" id="product-evidence" aria-labelledby="evidence-title">
    <div class="container">
        <header class="section-head reveal"><span class="section-label">Product Evidence</span><h2 class="section-title" id="evidence-title">شواهد واقعی محصول؛ این راهکار در سپند کجا دیده می‌شود؟</h2><p class="section-sub">تصاویر زیر اسکرین‌شات واقعی محصول‌اند. هر شاهد به صفحه قابلیت مرتبط لینک شده تا ادعا، زمینه و مرز فعلی محصول قابل بررسی باشد.</p></header>
        <div class="platform-evidence-list">
            <?php $__currentLoopData = $page['evidence']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $evidence): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="platform-evidence-card reveal">
                    <a class="platform-evidence-media" href="<?php echo e(route($evidence['route'], $evidence['parameters'] ?? [])); ?>" aria-label="<?php echo e($evidence['cta']); ?>">
                        <img src="<?php echo e(asset('assets/images/marketing/'.$evidence['image'])); ?>" width="1600" height="900" loading="lazy" alt="<?php echo e($evidence['alt']); ?>">
                    </a>
                    <div><span>شاهد محصول <?php echo e(str_pad($loop->iteration, 2, '0', STR_PAD_LEFT)); ?></span><h3><?php echo e($evidence['title']); ?></h3><p><?php echo e($evidence['text']); ?></p><a href="<?php echo e(route($evidence['route'], $evidence['parameters'] ?? [])); ?>"><?php echo e($evidence['cta']); ?> <b aria-hidden="true">←</b></a></div>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<?php if(isset($page['demo'])): ?>
<section class="section platform-real-demo" id="real-demo" aria-labelledby="real-demo-title">
    <div class="container">
        <header class="platform-real-demo-head reveal">
            <div><span class="section-label">REAL PRODUCT WALKTHROUGH</span><h2 class="section-title" id="real-demo-title"><?php echo e($page['demo']['title']); ?></h2></div>
            <p><?php echo e($page['demo']['intro']); ?></p>
        </header>
        <div class="platform-demo-strip" role="list">
            <?php $__currentLoopData = $page['demo']['steps']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="platform-demo-step reveal" role="listitem">
                    <div class="platform-demo-media"><img src="<?php echo e(asset('assets/images/marketing/'.$step['image'])); ?>" width="1600" height="900" loading="lazy" alt="<?php echo e($step['alt']); ?>"><span aria-hidden="true"><?php echo e($loop->iteration); ?></span></div>
                    <small><?php echo e($step['label']); ?></small><h3><?php echo e($step['title']); ?></h3><p><?php echo e($step['text']); ?></p>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <p class="platform-demo-note reveal"><strong>شفافیت داده:</strong> <?php echo e($page['demo']['note']); ?></p>
    </div>
</section>
<?php endif; ?>

<section class="section soft" id="workflow" aria-labelledby="workflow-title">
    <div class="container">
        <header class="section-head reveal"><span class="section-label">جریان عملیاتی</span><h2 class="section-title" id="workflow-title"><?php echo e($page['nav_title']); ?> از کجا شروع و چگونه پایدار می‌شود؟</h2><p class="section-sub">این توالی، مرز میان ثبت داده، کنترل سیستمی و تصمیم انسانی را روشن می‌کند.</p></header>
        <ol class="platform-workflow">
            <?php $__currentLoopData = $page['workflow']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li class="reveal"><span><?php echo e($loop->iteration); ?></span><div><h3><?php echo e($step['title']); ?></h3><p><?php echo e($step['text']); ?></p></div></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ol>
    </div>
</section>

<section class="section platform-depth-section" id="operational-depth" aria-labelledby="depth-title">
    <div class="container platform-depth-layout">
        <header class="platform-depth-heading reveal"><span class="section-label">Operational Depth</span><h2 class="section-title" id="depth-title">عمق عملیاتی <?php echo e($page['nav_title']); ?></h2><p>برای ارزیابی حرفه‌ای، فقط وجود یک فرم یا گزارش کافی نیست. باید ببینید داده از کجا می‌آید، چه کنترلی روی آن اجرا می‌شود و خروجی تا کجا قابل ردیابی است.</p></header>
        <div class="platform-depth-grid">
            <?php $__currentLoopData = $page['depth']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><article class="reveal"><span><?php echo e(str_pad($loop->iteration, 2, '0', STR_PAD_LEFT)); ?></span><h3><?php echo e($item['title']); ?></h3><p><?php echo e($item['text']); ?></p></article><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<section class="section soft" id="controls" aria-labelledby="controls-title">
    <div class="container platform-controls-layout">
        <div class="reveal"><span class="section-label">کنترل و مسئولیت</span><h2 class="section-title" id="controls-title">کنترل‌هایی که کیفیت اجرا را حفظ می‌کنند</h2><ul class="platform-check-list"><?php $__currentLoopData = $page['controls']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $control): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($control); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul></div>
        <aside class="platform-role-card reveal"><small>مالکیت فرایند</small><h2>چه کسانی در این راهکار نقش دارند؟</h2><ul><?php $__currentLoopData = $page['roles']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($role); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul></aside>
    </div>
</section>

<section class="section" id="metrics" aria-labelledby="metrics-title">
    <div class="container">
        <header class="section-head reveal"><span class="section-label">شاخص‌های نتیجه</span><h2 class="section-title" id="metrics-title">چهار KPI برای سنجش اثربخشی <?php echo e($page['nav_title']); ?></h2><p class="section-sub">مقدار هدف باید با خط مبنای واقعی سازمان تعیین شود؛ این شاخص‌ها نقطه شروع اندازه‌گیری‌اند.</p></header>
        <div class="platform-metric-grid"><?php $__currentLoopData = $page['metrics']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $metric): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><article class="reveal"><span>KPI <?php echo e(str_pad($loop->iteration, 2, '0', STR_PAD_LEFT)); ?></span><h3><?php echo e($metric); ?></h3><p>به تفکیک دوره، مسئول و نوع عملیات پایش شود تا علت تغییر قابل پیگیری بماند.</p></article><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div>
    </div>
</section>

<section class="section soft" id="related-solutions" aria-labelledby="related-title">
    <div class="container">
        <header class="section-head reveal"><span class="section-label">مسیرهای مرتبط</span><h2 class="section-title" id="related-title">راهکارها و صفحات مکمل</h2><p class="section-sub">برای ادامه بررسی فرایند، صفحه تخصصی مرتبط را انتخاب کنید.</p></header>
        <div class="platform-related-grid">
            <?php $__currentLoopData = $page['related']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relatedSlug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php ($related = $allSolutions[$relatedSlug]); ?>
                <a class="platform-related-card reveal" href="<?php echo e($solutionUrl($relatedSlug)); ?>"><span><?php echo e($related['eyebrow']); ?></span><h3><?php echo e($related['nav_title']); ?></h3><p><?php echo e($related['nav_description']); ?></p><b>مطالعه راهکار ←</b></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php $__currentLoopData = $page['existing_links']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a class="platform-related-card is-existing reveal" href="<?php echo e(route($link['route'], $link['parameters'] ?? [])); ?>"><span>صفحه تخصصی</span><h3><?php echo e($link['label']); ?></h3><p><?php echo e($link['description'] ?? 'جزئیات این بخش را در صفحه تخصصی مرتبط ببینید.'); ?></p><b>مشاهده صفحه ←</b></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<section class="section" id="solution-faq" aria-labelledby="faq-title">
    <div class="container platform-faq-layout">
        <header class="reveal"><span class="section-label">پرسش‌های متداول</span><h2 class="section-title" id="faq-title">سؤالات متداول <?php echo e($page['nav_title']); ?></h2><p>پاسخ‌های کوتاه برای روشن‌شدن دامنه، داده و نحوه ارزیابی راهکار.</p></header>
        <div class="faq"><?php $__currentLoopData = $page['faqs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><details class="reveal"><summary><?php echo e($faq['q']); ?></summary><p><?php echo e($faq['a']); ?></p></details><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div>
    </div>
</section>

<section class="cta-wrap"><div class="container"><div class="cta reveal"><div class="cta-copy"><h2><?php echo e($page['cta_title'] ?? ($page['nav_title'].' را با یک سناریوی واقعی ارزیابی کنید')); ?></h2><p><?php echo e($page['cta_text'] ?? 'یک پرونده نمونه و گلوگاه اصلی تیم را آماده کنید تا داده، کنترل، مسئولیت و خروجی در جلسه دمو بررسی شوند.'); ?></p></div><div class="cta-action"><a class="btn" href="<?php echo e(route('consultation.create')); ?>" data-ga-event="cta_click" data-ga-label="<?php echo e($slug); ?>_bottom_demo"><?php echo e($page['cta_button'] ?? 'درخواست دمو و مشاوره'); ?></a></div></div></div></section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.marketing', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\project\sepand\portal-customer\resources\views/marketing/platform-solutions/show.blade.php ENDPATH**/ ?>