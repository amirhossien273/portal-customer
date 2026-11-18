<?php
    $title = 'قیمت نرم‌افزار حمل‌ونقل بین‌المللی | تعرفه سپند';
    $description = 'قیمت نرم‌افزار حمل‌ونقل بین‌المللی سپند را بر اساس تعداد کاربران و پرداخت ماهانه یا سالانه محاسبه کنید و برای دریافت پیشنهاد نهایی درخواست دمو بدهید.';
    $canonical = route('pricing');
    $pricing = config('marketing_pricing');
    $tiers = $pricing['tiers'];
    $defaultUsers = $pricing['default_users'];
    $defaultBilling = $pricing['default_billing'];
    $defaultTier = collect($tiers)->first(
        static fn (array $tier): bool => $defaultUsers >= $tier['min'] && $defaultUsers <= $tier['max']
    );
    $defaultRate = $defaultTier[$defaultBilling];
    $defaultMonthlyTotal = $defaultRate * $defaultUsers;
    $defaultPayable = $defaultBilling === 'annual' ? $defaultMonthlyTotal * 12 : $defaultMonthlyTotal;
    $defaultSaving = $defaultBilling === 'annual'
        ? ($defaultTier['monthly'] - $defaultTier['annual']) * $defaultUsers * 12
        : 0;
    $toPersian = static fn (int|string $value): string => strtr((string) $value, [
        '0' => '۰', '1' => '۱', '2' => '۲', '3' => '۳', '4' => '۴',
        '5' => '۵', '6' => '۶', '7' => '۷', '8' => '۸', '9' => '۹',
    ]);
    $formatPrice = static fn (int $value): string => strtr(number_format($value), [
        ',' => '٬', '0' => '۰', '1' => '۱', '2' => '۲', '3' => '۳', '4' => '۴',
        '5' => '۵', '6' => '۶', '7' => '۷', '8' => '۸', '9' => '۹',
    ]);
    $faqs = [
        ['question' => 'قیمت اشتراک چگونه محاسبه می‌شود؟', 'answer' => 'تعداد کاربران، بازه نرخ هر کاربر را مشخص می‌کند. نرخ انتخاب‌شده در تعداد کاربران ضرب می‌شود؛ در پرداخت سالانه، حاصل ماهانه در ۱۲ ضرب می‌شود تا مبلغ قابل پرداخت یک‌ساله به دست آید.'],
        ['question' => 'تفاوت پرداخت ماهانه و سالانه چیست؟', 'answer' => 'در پرداخت ماهانه، مبلغ همان ماه پرداخت می‌شود. در اشتراک سالانه، نرخ هر کاربر کمتر است اما مبلغ ۱۲ ماه یک‌جا پرداخت می‌شود. محاسبه‌گر هر دو مبلغ را جدا نشان می‌دهد.'],
        ['question' => 'کدام امکانات در مبلغ اشتراک قرار دارند؟', 'answer' => 'قیمت اشتراک سپند فقط بر اساس تعداد کاربران محاسبه می‌شود و تعداد یا ترکیب ماژول‌ها مبلغ اشتراک را تغییر نمی‌دهد. دامنه امکانات هر ماژول را می‌توانید در صفحه ماژول‌ها بررسی کنید.'],
        ['question' => 'چه هزینه‌هایی در محاسبه‌گر منظور نشده‌اند؟', 'answer' => 'محاسبه‌گر فقط اشتراک کاربران را برآورد می‌کند. دامنه و مبلغ آموزش، پشتیبانی، انتقال داده، استقرار، سفارشی‌سازی، اتصال به سامانه‌های دیگر و مالیات باید در پیشنهاد نهایی مشخص شوند.'],
        ['question' => 'آیا می‌توان تعداد کاربران را افزایش داد؟', 'answer' => 'امکان افزایش کاربران وجود دارد. اگر تعداد کل وارد بازه دیگری شود، نرخ هر کاربر بر اساس بازه جدید محاسبه می‌شود و شرایط تجاری تغییر باید در پیشنهاد یا قرارداد تأیید شود.'],
        ['question' => 'استقرار روی سرور شرکت چگونه قیمت‌گذاری می‌شود؟', 'answer' => 'محاسبه‌گر هزینه استقرار روی سرور شرکت را پوشش نمی‌دهد. ظرفیت، زیرساخت، امنیت، پشتیبان‌گیری و مرز مسئولیت‌ها ابتدا بررسی و شرایط و مبلغ در پیشنهاد رسمی مشخص می‌شوند.'],
    ];
    $structuredData = [
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'WebPage',
                '@id' => $canonical.'#webpage',
                'name' => $title,
                'description' => $description,
                'url' => $canonical,
                'inLanguage' => 'fa-IR',
                'isPartOf' => ['@id' => route('home').'#website'],
            ],
            [
                '@type' => 'BreadcrumbList',
                '@id' => $canonical.'#breadcrumb',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => 'صفحه اصلی', 'item' => route('home')],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => 'قیمت نرم‌افزار حمل‌ونقل بین‌المللی', 'item' => $canonical],
                ],
            ],
            [
                '@type' => 'FAQPage',
                '@id' => $canonical.'#faq',
                'mainEntity' => array_map(static fn (array $faq): array => [
                    '@type' => 'Question',
                    'name' => $faq['question'],
                    'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['answer']],
                ], $faqs),
            ],
        ],
    ];
?>

<?php $__env->startPush('head'); ?>
    <script type="application/ld+json"><?php echo json_encode($structuredData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/marketing-pricing-calculator.css')); ?>?v=20261114-1">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<section class="page-hero pricing-page-hero">
    <div class="container hero-inner">
        <div class="hero-copy reveal">
            <div class="breadcrumb"><a href="<?php echo e(route('home')); ?>">صفحه اصلی</a><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg><span>تعرفه‌ها</span></div>
            <h1>قیمت نرم‌افزار حمل‌ونقل بین‌المللی</h1>
            <p>قیمت اشتراک سپند فقط بر اساس تعداد کاربران محاسبه می‌شود. تعداد کاربران، بازه نرخ را مشخص می‌کند و با انتخاب پرداخت ماهانه یا سالانه می‌توانید مبلغ قابل پرداخت را ببینید؛ جزئیات خدمات جانبی در پیشنهاد نهایی روشن می‌شود.</p>
            <div class="hero-actions"><a class="btn btn-primary" href="#plans">محاسبه هزینه اشتراک</a><a class="btn btn-outline" href="<?php echo e(route('consultation.create')); ?>">درخواست پیشنهاد قیمت</a></div>
        </div>
        <div class="hero-art reveal"><div class="art-panel"><div class="art-content"><div class="art-head"><span class="art-mark"><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 7h16v12H4V7Zm3-3h10v3H7V4Zm2 8h6m-3-3v6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg></span><span class="art-chip">محاسبه روشن</span></div><h2 class="art-title">متناسب با اندازه تیم شما</h2><p class="art-desc">نرخ هر کاربر بر اساس تعداد کاربران و دوره پرداخت محاسبه می‌شود</p><div class="art-bars"><i></i><i></i><i></i><i></i><i></i><i></i></div></div></div></div>
    </div>
</section>

<section class="section" id="plans" aria-labelledby="pricing-section-title">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label">محاسبه تعرفه سپند</span>
            <h2 class="section-title" id="pricing-section-title">تعداد کاربران و دوره پرداخت را انتخاب کنید</h2>
            <p class="section-sub">مبنای تمام اعداد جدول «تومان برای هر کاربر در ماه» است. اشتراک از ۵ کاربر آغاز می‌شود و محاسبه‌گر تا ۱۰۰ کاربر را پوشش می‌دهد.</p>
        </div>

        <section class="pricing-calculator reveal" data-pricing-calculator aria-labelledby="pricing-calculator-title">
            <div class="pricing-calculator__controls">
                <div class="pricing-calculator__intro">
                    <span>محاسبه‌گر اشتراک کاربران</span>
                    <h3 id="pricing-calculator-title">برآورد هزینه تیم شما</h3>
                    <p>در نتیجه، تعداد کاربران، دوره پرداخت، نرخ هر کاربر، جمع ماهانه تیم و مبلغ قابل پرداخت نمایش داده می‌شود.</p>
                </div>

                <div class="pricing-billing-toggle" role="group" aria-label="انتخاب دوره پرداخت">
                    <button type="button" data-billing="monthly" aria-pressed="false">پرداخت ماهانه</button>
                    <button type="button" data-billing="annual" aria-pressed="true">پرداخت سالانه <span>نرخ کمتر</span></button>
                </div>

                <div class="pricing-user-control">
                    <div class="pricing-user-control__heading">
                        <label for="pricing-users">تعداد کاربران</label>
                        <div class="pricing-user-stepper">
                            <button type="button" data-user-step="-1" aria-label="کاهش یک کاربر">−</button>
                            <output for="pricing-users" aria-live="polite"><strong data-user-output><?php echo e($toPersian($defaultUsers)); ?></strong><span>کاربر</span></output>
                            <button type="button" data-user-step="1" aria-label="افزایش یک کاربر">+</button>
                        </div>
                    </div>
                    <input id="pricing-users" type="range" min="<?php echo e($pricing['min_users']); ?>" max="<?php echo e($pricing['max_users']); ?>" step="1" value="<?php echo e($defaultUsers); ?>" data-user-range aria-describedby="pricing-user-help">
                    <div class="pricing-range-labels" aria-hidden="true"><span><?php echo e($toPersian($pricing['min_users'])); ?> کاربر</span><span><?php echo e($toPersian($pricing['max_users'])); ?> کاربر</span></div>
                    <p id="pricing-user-help">برای بیش از <?php echo e($toPersian($pricing['max_users'])); ?> کاربر، شرایط و مبلغ باید در پیشنهاد رسمی مشخص شود.</p>
                </div>

                <div class="pricing-tier-list" aria-label="بازه‌های تعرفه هر کاربر">
                    <?php $__currentLoopData = $tiers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <article class="<?php echo \Illuminate\Support\Arr::toCssClasses(['is-active' => $defaultUsers >= $tier['min'] && $defaultUsers <= $tier['max']]); ?>" data-price-tier data-min-users="<?php echo e($tier['min']); ?>" data-max-users="<?php echo e($tier['max']); ?>" data-monthly-rate="<?php echo e($tier['monthly']); ?>" data-annual-rate="<?php echo e($tier['annual']); ?>" <?php if($defaultUsers >= $tier['min'] && $defaultUsers <= $tier['max']): ?> aria-current="true" <?php endif; ?>>
                            <strong><?php echo e($toPersian($tier['min'])); ?> تا <?php echo e($toPersian($tier['max'])); ?> کاربر</strong>
                            <span>پرداخت ماهانه: <?php echo e($formatPrice($tier['monthly'])); ?> تومان برای هر کاربر در ماه</span>
                            <span>اشتراک سالانه: معادل ماهانه <?php echo e($formatPrice($tier['annual'])); ?> تومان برای هر کاربر</span>
                        </article>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <aside class="pricing-summary" aria-live="polite">
                <div class="pricing-summary__top"><span data-billing-title>اشتراک سالانه</span><strong data-tier-label>بازه <?php echo e($toPersian($defaultTier['min'])); ?> تا <?php echo e($toPersian($defaultTier['max'])); ?> کاربر</strong></div>
                <div class="pricing-summary__unit"><span data-per-user-price><?php echo e($formatPrice($defaultRate)); ?></span><small>تومان برای هر کاربر در ماه</small></div>
                <dl>
                    <div><dt>دوره پرداخت</dt><dd data-summary-billing>سالانه؛ پرداخت یک‌جای ۱۲ ماه</dd></div>
                    <div><dt>تعداد کاربران</dt><dd><span data-summary-users><?php echo e($toPersian($defaultUsers)); ?></span> کاربر</dd></div>
                    <div><dt>نرخ هر کاربر در ماه</dt><dd><span data-summary-rate><?php echo e($formatPrice($defaultRate)); ?></span> تومان</dd></div>
                    <div><dt data-monthly-total-label>معادل هزینه ماهانه تیم در اشتراک سالانه</dt><dd><span data-monthly-total><?php echo e($formatPrice($defaultMonthlyTotal)); ?></span> تومان</dd></div>
                    <div class="pricing-summary__payable"><dt data-payable-label>مبلغ قابل پرداخت یک‌ساله</dt><dd><span data-payable-total><?php echo e($formatPrice($defaultPayable)); ?></span> تومان</dd></div>
                    <div class="pricing-summary__saving" data-annual-saving><dt>صرفه‌جویی سالانه نسبت به پرداخت ماهانه</dt><dd><span data-saving-total><?php echo e($formatPrice($defaultSaving)); ?></span> تومان</dd></div>
                </dl>
                <a class="btn" href="<?php echo e(route('consultation.create', ['pricing_users' => $defaultUsers, 'billing' => $defaultBilling])); ?>" data-pricing-consultation data-base-url="<?php echo e(route('consultation.create')); ?>" data-ga-event="cta_click" data-ga-label="pricing_calculator_consultation">درخواست دمو و پیشنهاد قیمت</a>
                <p>این برآورد مربوط به اشتراک کاربران است. خدمات جانبی، شرایط استقرار و نحوه اعمال مالیات در پیشنهاد رسمی مشخص می‌شوند.</p>
            </aside>
        </section>
    </div>
</section>

<section class="section soft" aria-labelledby="pricing-scope-title">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label">دامنه مبلغ و خدمات</span>
            <h2 class="section-title" id="pricing-scope-title">مبلغ محاسبه‌گر چه چیزی را نشان می‌دهد؟</h2>
            <p class="section-sub">اگر در حال خرید نرم‌افزار فورواردری هستید، مبلغ اشتراک کاربران را از شرایط خدمات جانبی و استقرار جدا ببینید.</p>
        </div>
        <div class="pricing-scope-grid">
            <article class="pricing-scope-card reveal"><span>در محاسبه‌گر</span><h3>اشتراک کاربران</h3><p>نرخ هر کاربر، جمع ماهانه تیم و مبلغ پرداخت بر اساس دوره انتخاب‌شده محاسبه می‌شوند.</p></article>
            <article class="pricing-scope-card reveal"><span>بدون تغییر در قیمت</span><h3>ماژول‌ها و امکانات</h3><p>تعداد یا ترکیب ماژول‌ها مبلغ اشتراک را تغییر نمی‌دهد؛ قیمت فقط بر اساس تعداد کاربران محاسبه می‌شود.</p><a href="<?php echo e(route('modules')); ?>">مشاهده ماژول‌ها و امکانات سپند</a></article>
            <article class="pricing-scope-card reveal"><span>نیازمند تعیین دامنه</span><h3>آموزش، پشتیبانی و انتقال داده</h3><p>دامنه، مسئولیت‌ها و مبلغ این خدمات در محاسبه‌گر منظور نشده و باید پس از بررسی نیاز شرکت در پیشنهاد نهایی مشخص شوند.</p></article>
            <article class="pricing-scope-card reveal"><span>نیازمند پیشنهاد رسمی</span><h3>سفارشی‌سازی، اتصال‌ها و مالیات</h3><p>محاسبه‌گر مبلغی برای این موارد اضافه نمی‌کند. دامنه سفارشی‌سازی و اتصال، و نحوه اعمال مالیات باید در پیشنهاد رسمی روشن باشد.</p></article>
        </div>
    </div>
</section>

<section class="section" aria-labelledby="deployment-pricing-title">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label">مدل استقرار</span>
            <h2 class="section-title" id="deployment-pricing-title">محاسبه‌گر مربوط به اشتراک کاربران است</h2>
            <p class="section-sub">هزینه و مسئولیت‌های استقرار باید جدا از مبلغ اشتراک بررسی شوند.</p>
        </div>
        <div class="pricing-deployment-grid">
            <article class="pricing-deployment-card reveal"><h3>مدل محاسبه‌گر</h3><p>اعداد این صفحه فقط نرخ اشتراک هر کاربر و مبلغ پرداخت ماهانه یا سالانه تیم را نشان می‌دهند.</p></article>
            <article class="pricing-deployment-card reveal"><h3>استقرار روی سرور شرکت</h3><p>ظرفیت سرور، شبکه، امنیت، پشتیبان‌گیری، به‌روزرسانی و مرز مسئولیت‌ها باید تحلیل شوند. مبلغ، شرایط و نوع مجوز فقط در پیشنهاد رسمی قابل تأیید است.</p><a href="<?php echo e(route('solutions.on-premise')); ?>">بررسی الزامات استقرار داخلی</a></article>
        </div>
    </div>
</section>

<section class="section soft" aria-labelledby="pricing-faq-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">پرسش‌های پیش از خرید</span><h2 class="section-title" id="pricing-faq-title">پرسش‌های متداول درباره تعرفه سپند</h2></div>
        <div class="faq reveal">
            <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <details><summary><?php echo e($faq['question']); ?></summary><p><?php echo e($faq['answer']); ?></p></details>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<section class="cta-wrap"><div class="container"><div class="cta reveal"><div class="cta-copy"><h2>پیشنهاد قیمت متناسب با شرکت خودتان دریافت کنید</h2><p>تعداد کاربران و شرایط خدمات یا استقرار موردنیاز را در جلسه دمو بررسی کنید تا پیشنهاد نهایی روشن باشد.</p></div><div class="cta-action"><a class="btn" href="<?php echo e(route('consultation.create')); ?>" data-ga-event="cta_click" data-ga-label="pricing_bottom_consultation">درخواست دمو و پیشنهاد قیمت</a></div></div></div></section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
(()=>{
    const calculator=document.querySelector('[data-pricing-calculator]');
    if(!calculator)return;
    const range=calculator.querySelector('[data-user-range]');
    const billingButtons=[...calculator.querySelectorAll('[data-billing]')];
    const tierElements=[...calculator.querySelectorAll('[data-price-tier]')];
    const consultationLink=calculator.querySelector('[data-pricing-consultation]');
    const tiers=tierElements.map(element=>({
        element,
        min:Number(element.dataset.minUsers),
        max:Number(element.dataset.maxUsers),
        monthly:Number(element.dataset.monthlyRate),
        annual:Number(element.dataset.annualRate),
        label:element.querySelector('strong').textContent.trim(),
    }));
    const formatter=new Intl.NumberFormat('fa-IR');
    let billing='<?php echo e($defaultBilling); ?>';

    const findTier=users=>tiers.find(tier=>users>=tier.min&&users<=tier.max)||tiers[tiers.length-1];
    const setText=(selector,value)=>{const element=calculator.querySelector(selector);if(element)element.textContent=value};
    const updateConsultationLink=users=>{
        if(!consultationLink)return;
        const url=new URL(consultationLink.dataset.baseUrl,window.location.origin);
        url.searchParams.set('pricing_users',String(users));
        url.searchParams.set('billing',billing);
        consultationLink.href=url.toString();
    };
    const render=()=>{
        const users=Number(range.value);
        const tier=findTier(users);
        const perUser=tier[billing];
        const monthlyTotal=perUser*users;
        const payable=billing==='annual'?monthlyTotal*12:monthlyTotal;
        const saving=(tier.monthly-tier.annual)*users*12;
        const progress=((users-Number(range.min))/(Number(range.max)-Number(range.min)))*100;
        const annual=billing==='annual';

        range.style.setProperty('--range-progress',progress+'%');
        setText('[data-user-output]',formatter.format(users));
        setText('[data-summary-users]',formatter.format(users));
        setText('[data-tier-label]','بازه '+tier.label);
        setText('[data-per-user-price]',formatter.format(perUser));
        setText('[data-summary-rate]',formatter.format(perUser));
        setText('[data-monthly-total]',formatter.format(monthlyTotal));
        setText('[data-payable-total]',formatter.format(payable));
        setText('[data-saving-total]',formatter.format(saving));
        setText('[data-billing-title]',annual?'اشتراک سالانه':'اشتراک ماهانه');
        setText('[data-summary-billing]',annual?'سالانه؛ پرداخت یک‌جای ۱۲ ماه':'ماهانه؛ پرداخت همان ماه');
        setText('[data-monthly-total-label]',annual?'معادل هزینه ماهانه تیم در اشتراک سالانه':'جمع هزینه تیم در ماه');
        setText('[data-payable-label]',annual?'مبلغ قابل پرداخت یک‌ساله':'مبلغ قابل پرداخت ماه جاری');
        calculator.querySelector('[data-annual-saving]').hidden=!annual;
        updateConsultationLink(users);

        billingButtons.forEach(button=>button.setAttribute('aria-pressed',String(button.dataset.billing===billing)));
        tiers.forEach(item=>{
            const active=item===tier;
            item.element.classList.toggle('is-active',active);
            if(active)item.element.setAttribute('aria-current','true');
            else item.element.removeAttribute('aria-current');
        });
    };

    range.addEventListener('input',render);
    calculator.querySelectorAll('[data-user-step]').forEach(button=>button.addEventListener('click',()=>{
        const next=Math.min(Number(range.max),Math.max(Number(range.min),Number(range.value)+Number(button.dataset.userStep)));
        range.value=String(next);
        render();
    }));
    billingButtons.forEach(button=>button.addEventListener('click',()=>{billing=button.dataset.billing;render()}));
    render();
})();
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.marketing', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\project\sepand\portal-customer\resources\views\marketing\pricing.blade.php ENDPATH**/ ?>