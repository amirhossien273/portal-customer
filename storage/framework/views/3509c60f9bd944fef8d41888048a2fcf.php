

<?php
    $title = 'ماژول‌های نرم‌افزار حمل‌ونقل و لجستیک | سپند';
    $description = 'ماژول‌های نرم‌افزار حمل‌ونقل سپند شامل CRM، نرخ‌دهی، بوکینگ، عملیات حمل، مدیریت اسناد، مالی و اتوماسیون است. امکانات هر ماژول را جداگانه بررسی کنید.';
    $canonical = route('modules');
    $moduleGroups = [
        [
            'id' => 'sales-customer-modules',
            'title' => 'فروش و مدیریت مشتریان',
            'modules' => ['crm', 'marketing-sms', 'pricing-sales', 'email-workflow-automation'],
        ],
        [
            'id' => 'transport-operation-modules',
            'title' => 'مدیریت عملیات حمل',
            'modules' => ['booking', 'transport-operations', 'operations-control-tower', 'fleet-dispatch'],
        ],
        [
            'id' => 'documents-finance-modules',
            'title' => 'مدیریت اسناد و امور مالی',
            'modules' => ['document-management', 'document-checklists', 'finance-accounting'],
        ],
        [
            'id' => 'automation-customer-service-modules',
            'title' => 'اتوماسیون و خدمات مشتری',
            'modules' => ['workflow-tasks', 'automatic-tasks', 'customer-portal-tracking'],
        ],
    ];
    $marketingSmsModule = [
        'name' => 'بازاریابی و پیامک',
        'short_name' => 'بازاریابی پیامکی',
        'summary' => 'از پنل فراز اس‌ام‌اس یا مستقیماً از پرونده مشتری، لید و استعلام پیامک بفرستید و نتیجه هر ارسال را در تاریخچه ارتباطات نگه دارید.',
        'benefits' => ['ارسال پیامک از پرونده CRM', 'لاگ متمرکز و پیگیری وضعیت ارسال', 'تنظیمات مستقل پنل برای هر سازمان'],
    ];
    $moduleListItems = collect($moduleGroups)
        ->flatMap(static function (array $group) use ($marketingSmsModule): array {
            return collect($group['modules'])
                ->map(static function (string $slug) use ($marketingSmsModule): array {
                    $module = $slug === 'marketing-sms' ? $marketingSmsModule : config('site_modules.'.$slug);

                    return [
                        '@type' => 'ListItem',
                        'position' => 0,
                        'name' => $module['name'],
                        'url' => $slug === 'marketing-sms'
                            ? route('site.modules.show', ['module' => 'crm']).'#crm-sms'
                            : route('site.modules.show', ['module' => $slug]),
                    ];
                })
                ->all();
        })
        ->values()
        ->map(static fn (array $item, int $index): array => [...$item, 'position' => $index + 1])
        ->all();
?>

<?php $__env->startPush('head'); ?>
<script type="application/ld+json"><?php echo json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'CollectionPage',
            '@id' => route('modules').'#webpage',
            'name' => $title,
            'description' => $description,
            'url' => route('modules'),
            'inLanguage' => 'fa-IR',
            'isPartOf' => ['@id' => route('home').'#website'],
        ],
        [
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'صفحه اصلی', 'item' => route('home')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'ماژول‌های نرم‌افزار', 'item' => route('modules')],
            ],
        ],
        [
            '@type' => 'ItemList',
            'name' => 'ماژول‌های نرم‌افزار سپند',
            'numberOfItems' => count($moduleListItems),
            'itemListElement' => $moduleListItems,
        ],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?></script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<section class="page-hero">
    <div class="container hero-inner">
        <div class="hero-copy reveal">
            <div class="breadcrumb"><a href="<?php echo e(route('home')); ?>">صفحه اصلی</a><svg viewBox="0 0 24 24" fill="none"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg><span>ماژول‌ها</span></div>
            <h1>ماژول‌های یکپارچه سپند؛<br><span>از جذب مشتری تا تصمیم‌گیری و عملیات</span></h1>
            <p>ماژول‌های نرم‌افزار حمل‌ونقل سپند، فرآیندهای مدیریت مشتریان، نرخ‌دهی، رزرو حمل، عملیات، اسناد و امور مالی را در یک سیستم یکپارچه پوشش می‌دهند. هر ماژول برای پاسخ‌گویی به بخشی از نیازهای شرکت‌های فورواردری و حمل‌ونقل بین‌المللی طراحی شده است.</p>
            <div class="hero-actions"><a class="btn btn-primary" href="#all-modules">مشاهده ماژول‌ها <svg viewBox="0 0 24 24" fill="none"><path d="m8 10 4 4 4-4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></a><a class="btn btn-outline" href="<?php echo e(route('pricing')); ?>">مشاهده تعرفه‌ها</a></div>
        </div>
        <div class="hero-art reveal">
            <div class="art-panel"><div class="art-content"><div class="art-head"><span class="art-mark"><svg viewBox="0 0 24 24" fill="none"><path d="M4 4h6v6H4V4Zm10 0h6v6h-6V4ZM4 14h6v6H4v-6Zm10 0h6v6h-6v-6Z" stroke="currentColor" stroke-width="1.6"/></svg></span><span class="art-chip">اکوسیستم یکپارچه</span></div><p class="art-title">مرکز فرمان کسب‌وکار شما</p><p class="art-desc">داده‌های هماهنگ، فرایندهای متصل و دید مدیریتی کامل</p><div class="art-bars"><i></i><i></i><i></i><i></i><i></i><i></i></div></div></div>
        </div>
    </div>
</section>

<section class="section" id="all-modules">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">۱۴ ماژول در چهار گروه</span><h2 class="section-title">ابزارهای تخصصی برای<br><span>فروش، عملیات و خدمات مشتری</span></h2><p class="section-sub">ماژول‌های نرم‌افزار فورواردری سپند را بر اساس نیاز تیم خود انتخاب و جزئیات هر بخش را در صفحه اختصاصی آن بررسی کنید.</p></div>
        <nav class="module-group-nav reveal" aria-label="دسترسی سریع به گروه‌های ماژول‌ها">
            <?php $__currentLoopData = $moduleGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="#<?php echo e($group['id']); ?>"><?php echo e($group['title']); ?></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </nav>
        <div class="module-groups">
            <?php $__currentLoopData = $moduleGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <section class="module-group" id="<?php echo e($group['id']); ?>" aria-labelledby="<?php echo e($group['id']); ?>-title">
                    <div class="module-group-head reveal">
                        <span class="section-label">گروه <?php echo e($loop->iteration); ?></span>
                        <h2 class="section-title" id="<?php echo e($group['id']); ?>-title"><?php echo e($group['title']); ?></h2>
                    </div>
                    <div class="card-grid">
                        <?php $__currentLoopData = $group['modules']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php ($module = $slug === 'marketing-sms' ? $marketingSmsModule : config('site_modules.'.$slug)); ?>
                            <article class="content-card reveal" data-module-card="<?php echo e($slug); ?>">
                                <span class="card-icon"><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 5h16v14H4V5Zm4 4h8m-8 4h8m-8 4h5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg></span>
                                <h3><?php echo e($module['name']); ?></h3>
                                <p><?php echo e($module['summary']); ?></p>
                                <ul class="feature-list"><?php $__currentLoopData = $module['benefits']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $benefit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($benefit); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
                                <?php if($slug === 'marketing-sms'): ?>
                                    <a class="tag" href="<?php echo e(route('site.modules.show', ['module' => 'crm'])); ?>#crm-sms" aria-label="مشاهده امکانات بازاریابی پیامکی سپند">مشاهده بازاریابی پیامکی</a>
                                <?php else: ?>
                                    <a class="tag" href="<?php echo e(route('site.modules.show', ['module' => $slug])); ?>" aria-label="مشاهده جزئیات ماژول <?php echo e($module['name']); ?>">مشاهده ماژول <?php echo e($module['short_name']); ?></a>
                                <?php endif; ?>
                            </article>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </section>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<section class="section modules-insights" id="management-insights" aria-labelledby="management-insights-title">
    <div class="container">
        <div class="section-head modules-insights-head reveal">
            <span class="section-label">هوشمندی فروش و پیگیری</span>
            <h2 class="section-title" id="management-insights-title">گزارش‌هایی که فقط عدد نشان نمی‌دهند؛<br><span>اقدام بعدی را مشخص می‌کنند</span></h2>
            <p class="section-sub">قابلیت‌های تحلیلی جدید سپند به مدیر فروش کمک می‌کنند مشتری ارزشمند، تأمین‌کننده مناسب و پرونده‌ای را که نیازمند اقدام فوری است سریع‌تر تشخیص دهد.</p>
        </div>
        <div class="modules-insights-grid">
            <article class="modules-insight-card reveal">
                <span class="modules-insight-number" aria-hidden="true">01</span>
                <h3>تحلیل درآمد و سود مشتریان</h3>
                <p>مشتریان بر پایه دریافت‌های تأییدشده، پرداخت‌های انجام‌شده، سود خالص و تعداد کار عملیاتی رتبه‌بندی می‌شوند؛ نه بر اساس حدس یا حجم تماس.</p>
                <a class="modules-insight-link" href="<?php echo e(route('site.modules.show', ['module' => 'crm'])); ?>#crm-analytics">مشاهده تحلیل مشتریان</a>
            </article>
            <article class="modules-insight-card reveal">
                <span class="modules-insight-number" aria-hidden="true">02</span>
                <h3>شناسایی مشتری پرکار یا کم‌حجمِ ارزشمند</h3>
                <p>دو نمای مکمل نشان می‌دهند کدام مشتری کار زیادی با سود متوسط پایین ایجاد می‌کند و کدام مشتری با حجم کمتر، سود بیشتری به ازای هر کار دارد.</p>
                <a class="modules-insight-link" href="<?php echo e(route('site.modules.show', ['module' => 'crm'])); ?>#crm-analytics">بررسی فرمول‌ها</a>
            </article>
            <article class="modules-insight-card reveal">
                <span class="modules-insight-number" aria-hidden="true">03</span>
                <h3>مقایسه چندمعیاره تأمین‌کنندگان</h3>
                <p>نرخ خرید، زمان حمل، مستقیم یا غیرمستقیم‌بودن مسیر، اعتبار نرخ، زمان آزاد، سابقه تأخیر، کیفیت پاسخ و شرایط پرداخت کنار هم دیده می‌شوند.</p>
                <a class="modules-insight-link" href="<?php echo e(route('site.modules.show', ['module' => 'pricing-sales'])); ?>#pricing-intelligence">مشاهده مقایسه تأمین‌کننده</a>
            </article>
            <article class="modules-insight-card reveal">
                <span class="modules-insight-number" aria-hidden="true">04</span>
                <h3>هشدار نرخ و پیش‌فاکتور نیازمند اقدام</h3>
                <p>داشبورد نرخ‌های رو به انقضا را پیش از پایان اعتبار برجسته می‌کند و گزارش ۴۸ ساعته، پیش‌فاکتورهای متوقف‌شده را با نام ایجادکننده نمایش می‌دهد.</p>
                <a class="modules-insight-link" href="<?php echo e(route('site.modules.show', ['module' => 'pricing-sales'])); ?>#pricing-intelligence">مشاهده هشدارهای فروش</a>
            </article>
        </div>
    </div>
</section>

<section class="section soft">
    <div class="container split">
        <div class="split-copy reveal"><span class="section-label">یکپارچگی واقعی</span><h2 class="section-title">ماژول‌های متصل، اطلاعات یکپارچه</h2><p>ماژول‌های سپند اطلاعات مشتری، استعلام، رزرو حمل، عملیات و مالی را در یک جریان مشترک مدیریت می‌کنند. هر واحد به اطلاعات مرتبط با مسئولیت خود دسترسی دارد و تغییرات پرونده بدون نیاز به ثبت دوباره اطلاعات در اختیار بخش‌های مرتبط قرار می‌گیرد.</p><p>این ساختار به کاهش دوباره‌کاری، هماهنگی بیشتر تیم‌ها و تصمیم‌گیری دقیق‌تر بر اساس اطلاعات ثبت‌شده کمک می‌کند.</p><p class="module-product-link">برای مشاهده ارتباط این ماژول‌ها در جریان کامل محصول، <a href="<?php echo e(route('product')); ?>">آشنایی با نرم‌افزار فورواردری سپند</a> را ادامه دهید.</p><div class="check-grid"><span class="check"><i>✓</i>کاهش ورود اطلاعات تکراری</span><span class="check"><i>✓</i>گزارش‌های مدیریتی دقیق</span><span class="check"><i>✓</i>خدمات سلف‌سرویس مشتری</span><span class="check"><i>✓</i>دسترسی تفکیک‌شده و امن</span></div></div>
        <div class="visual-box reveal"><span class="section-label">نتیجه در کار روزانه</span><h3 class="marketing-visual-heading">هماهنگی بیشتر<br>برای تیم و مشتری</h3><div class="feature-list marketing-visual-list"><li>دید کامل بر عملکرد تیم‌ها</li><li>کاهش خطا و دوباره‌کاری</li><li>رهگیری شفاف‌تر برای مشتری</li><li>هماهنگی فروش، عملیات و مالی</li></div></div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.marketing', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\project\sepand\portal-customer\resources\views/marketing/modules.blade.php ENDPATH**/ ?>