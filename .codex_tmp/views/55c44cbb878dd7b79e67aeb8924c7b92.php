<?php
    $faqs = [
        [
            'question' => 'در جلسه دمو چه بخش‌هایی نمایش داده می‌شود؟',
            'answer' => 'پس از بررسی نیاز شرکت، بخش‌های مرتبط سپند مانند CRM و فروش، Booking، عملیات، اسناد، مالی یا گزارش‌ها نمایش داده می‌شوند؛ بنابراین جلسه به مرور عمومی همه امکانات محدود نیست.',
        ],
        [
            'question' => 'آیا دمو بر اساس فرایند شرکت ما انجام می‌شود؟',
            'answer' => 'اطلاعات اولیه درباره نوع فعالیت، روش حمل، ساختار تیم و مسئله اصلی کمک می‌کند جلسه روی فرایندهای مرتبط شرکت شما متمرکز شود؛ دامنه دقیق در هماهنگی پیش از جلسه مشخص می‌شود.',
        ],
        [
            'question' => 'برای درخواست دمو چه اطلاعاتی لازم است؟',
            'answer' => 'نام متقاضی و شرکت، شماره تماس، نوع کسب‌وکار و مهم‌ترین نیاز فعلی لازم است. ایمیل، تعداد تقریبی کاربران و توضیحات تکمیلی اختیاری هستند.',
        ],
        [
            'question' => 'بعد از جلسه دمو چگونه ماژول‌های مناسب مشخص می‌شوند؟',
            'answer' => 'نیازها و گلوگاه‌های مطرح‌شده با دامنه ماژول‌های سپند تطبیق داده می‌شوند تا بخش‌های مرتبط و موضوعات نیازمند بررسی بیشتر برای ادامه تصمیم‌گیری مشخص شوند.',
        ],
        [
            'question' => 'آیا سپند برای شرکت‌های حمل‌ونقل بین‌المللی و شرکت‌های فورواردری مناسب است؟',
            'answer' => 'سپند برای فرایندهای شرکت‌های حمل‌ونقل بین‌المللی و فورواردری طراحی شده است و CRM، نرخ‌دهی، Booking، عملیات، اسناد و مالی پرونده حمل را پوشش می‌دهد. تناسب دقیق در جلسه نیازسنجی بررسی می‌شود.',
        ],
    ];
    $structuredData = [
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'ContactPage',
                '@id' => $canonical.'#webpage',
                'name' => $title,
                'description' => $description,
                'url' => $canonical,
                'inLanguage' => 'fa-IR',
                'dateModified' => '2026-08-18',
                'isPartOf' => ['@id' => route('home').'#website'],
                'about' => [
                    '@type' => 'SoftwareApplication',
                    'name' => 'نرم‌افزار مدیریت حمل‌ونقل سپند',
                    'url' => route('home'),
                ],
            ],
            [
                '@type' => 'BreadcrumbList',
                '@id' => $canonical.'#breadcrumb',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => 'صفحه اصلی', 'item' => route('home')],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => 'درخواست دمو و مشاوره خرید', 'item' => $canonical],
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
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/marketing-consultation.css')); ?>?v=20260818-1">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<section class="page-hero consultation-hero">
    <div class="container hero-inner">
        <div class="hero-copy reveal">
            <div class="breadcrumb"><a href="<?php echo e(route('home')); ?>">صفحه اصلی</a><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg><span>درخواست دمو و مشاوره</span></div>
            <h1><span class="h1-primary">درخواست دمو و مشاوره خرید</span><br><span>نرم‌افزار حمل‌ونقل سپند</span></h1>
            <p>جلسه دمو سپند صرفاً نمایش عمومی فهرست امکانات نیست. ابتدا نوع فعالیت، روش‌های حمل، ساختار تیم و فرایند فعلی فروش، Booking، عملیات، اسناد و مالی شرکت شما بررسی می‌شود. سپس بخش‌ها و ماژول‌های مرتبط نرم‌افزار حمل‌ونقل سپند با تمرکز بر مسئله‌های اصلی تیم نمایش داده می‌شوند. هدف این جلسه آن است که پیش از تصمیم خرید، مشخص شود کدام قسمت‌های سپند CRM با نیازهای واقعی شرکت تطابق دارند، چه موضوعاتی به بررسی بیشتر نیاز دارند و ادامه ارزیابی یا استقرار باید با چه دامنه‌ای انجام شود.</p>
            <div class="hero-actions">
                <a class="btn btn-primary" href="#consultation-form" data-ga-event="cta_click" data-ga-label="consultation_hero_form">ثبت درخواست دمو و نیازسنجی</a>
            </div>
        </div>
        <figure class="consultation-product-shot hero-art reveal">
            <div class="product-shot-frame">
                <span class="product-shot-label">نمای واقعی محصول</span>
                <img src="<?php echo e(asset('assets/images/marketing/sepand-cargo-details.webp')); ?>" width="835" height="335" loading="eager" fetchpriority="high" alt="نمای نرم افزار مدیریت حمل و نقل سپند">
            </div>
            <figcaption>نمای نرم‌افزار سپند با اطلاعات نمونه</figcaption>
        </figure>
    </div>
</section>

<section class="section consultation-section" aria-label="فرم درخواست دمو و جزئیات جلسه">
    <div class="container consultation-layout">
        <div class="consultation-side">
            <section class="consultation-copy reveal" aria-labelledby="demo-review-title">
                <span class="consultation-eyebrow">مسیر جلسه</span>
                <h2 id="demo-review-title">در جلسه دمو سپند چه چیزی بررسی می‌شود؟</h2>
                <ol class="demo-steps">
                    <li><span>شناخت ساختار و فرایند فعلی شرکت</span></li>
                    <li><span>بررسی گلوگاه‌ها و نیازهای اصلی</span></li>
                    <li><span>نمایش بخش‌های مرتبط سپند</span></li>
                    <li><span>مشخص‌کردن ماژول‌ها و قابلیت‌های موردنیاز</span></li>
                    <li><span>پیشنهاد مسیر مناسب برای ادامه بررسی یا استقرار</span></li>
                </ol>
            </section>

            <section class="consultation-focus reveal" aria-labelledby="process-based-demo-title">
                <span class="consultation-eyebrow">جلسه متمرکز</span>
                <h2 id="process-based-demo-title">دمو بر اساس فرایند واقعی شرکت شما</h2>
                <p>اگر نوع فعالیت، روش‌های حمل، ساختار تیم و مسئله اصلی را در فرم مشخص کنید، نمایش محصول روی بخش‌های مرتبط متمرکز می‌شود. این اطلاعات به معنی شخصی‌سازی قطعی محصول نیست و دامنه نهایی پس از بررسی دقیق‌تر مشخص خواهد شد.</p>
            </section>
        </div>

        <form class="consultation-form reveal" id="consultation-form" method="POST" action="<?php echo e(route('consultation.store')); ?>" data-ga-form="consultation_submit" data-consultation-form aria-labelledby="consultation-form-title">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="source_page" value="<?php echo e(old('source_page', url()->previous())); ?>">
            <div class="honeypot" aria-hidden="true"><label for="website">وب‌سایت</label><input id="website" name="website" type="text" tabindex="-1" autocomplete="off"></div>
            <div class="form-heading">
                <span class="consultation-eyebrow">اطلاعات اولیه</span>
                <p class="form-title" id="consultation-form-title">برای هماهنگی دمو، این فرم کوتاه را تکمیل کنید</p>
                <p>فیلدهای ستاره‌دار برای بررسی اولیه درخواست لازم هستند.</p>
            </div>
            <?php if(session('status')): ?><div class="form-status" id="consultation-form-status" role="status" tabindex="-1"><?php echo e(session('status')); ?></div><?php endif; ?>
            <div class="form-grid">
                <div class="field">
                    <label for="name">نام و نام خانوادگی <span aria-hidden="true">*</span></label>
                    <input id="name" name="name" type="text" value="<?php echo e(old('name')); ?>" maxlength="100" autocomplete="name" required <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> aria-invalid="true" aria-describedby="name-error" <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>>
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="form-error" id="name-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="field">
                    <label for="company">نام شرکت <span aria-hidden="true">*</span></label>
                    <input id="company" name="company" type="text" value="<?php echo e(old('company')); ?>" maxlength="150" autocomplete="organization" required <?php $__errorArgs = ['company'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> aria-invalid="true" aria-describedby="company-error" <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>>
                    <?php $__errorArgs = ['company'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="form-error" id="company-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="field">
                    <label for="mobile">شماره تماس <span aria-hidden="true">*</span></label>
                    <input id="mobile" name="mobile" type="tel" value="<?php echo e(old('mobile')); ?>" maxlength="30" inputmode="tel" autocomplete="tel" required <?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> aria-invalid="true" aria-describedby="mobile-error" <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>>
                    <?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="form-error" id="mobile-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="field">
                    <label for="email">ایمیل سازمانی <span class="optional">اختیاری</span></label>
                    <input id="email" name="email" type="email" value="<?php echo e(old('email')); ?>" maxlength="190" inputmode="email" autocomplete="email" <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> aria-invalid="true" aria-describedby="email-error" <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>>
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="form-error" id="email-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="field">
                    <label for="company_type">نوع کسب‌وکار <span aria-hidden="true">*</span></label>
                    <select id="company_type" name="company_type" required <?php $__errorArgs = ['company_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> aria-invalid="true" aria-describedby="company-type-error" <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>>
                        <option value="">انتخاب کنید</option>
                        <?php $__currentLoopData = ['شرکت حمل‌ونقل بین‌المللی','شرکت فورواردری','NVOCC','نماینده خط حمل','شرکت لجستیک','سایر']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($type); ?>" <?php if(old('company_type') === $type): echo 'selected'; endif; ?>><?php echo e($type); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['company_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="form-error" id="company-type-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="field">
                    <label for="approximate_users">تعداد تقریبی کاربران <span class="optional">اختیاری</span></label>
                    <select id="approximate_users" name="approximate_users" <?php $__errorArgs = ['approximate_users'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> aria-invalid="true" aria-describedby="approximate-users-error" <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>>
                        <option value="">انتخاب کنید</option>
                        <?php $__currentLoopData = ['1 تا 5 نفر','6 تا 15 نفر','16 تا 30 نفر','بیش از 30 نفر']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $range): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($range); ?>" <?php if(old('approximate_users') === $range): echo 'selected'; endif; ?>><?php echo e($range); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['approximate_users'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="form-error" id="approximate-users-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="field full">
                    <label for="primary_need">مهم‌ترین نیاز فعلی شرکت شما چیست؟ <span aria-hidden="true">*</span></label>
                    <select id="primary_need" name="primary_need" required <?php $__errorArgs = ['primary_need'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> aria-invalid="true" aria-describedby="primary-need-error" <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>>
                        <option value="">انتخاب کنید</option>
                        <?php $__currentLoopData = ['CRM و فروش','استعلام و نرخ‌دهی','Booking','عملیات حمل','مدیریت اسناد','مالی','پرتال مشتری','گزارش‌های مدیریتی','یکپارچه‌سازی فرایندها','سایر']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $need): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($need); ?>" <?php if(old('primary_need') === $need): echo 'selected'; endif; ?>><?php echo e($need); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['primary_need'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="form-error" id="primary-need-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="field full">
                    <label for="message">توضیحات تکمیلی <span class="optional">اختیاری</span></label>
                    <textarea id="message" name="message" maxlength="2000" placeholder="مثلاً روش‌های حمل، ساختار تیم یا گلوگاهی که می‌خواهید در جلسه بررسی شود" <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> aria-invalid="true" aria-describedby="message-error" <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>><?php echo e(old('message')); ?></textarea>
                    <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="form-error" id="message-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="field full form-submit">
                    <button class="btn btn-primary" type="submit" data-submit-button><span data-submit-label>ثبت درخواست دمو و نیازسنجی</span></button>
                    <p class="form-help">اطلاعات ثبت‌شده فقط برای بررسی و پیگیری درخواست دمو و مشاوره شما استفاده می‌شود.</p>
                </div>
            </div>
        </form>
    </div>
</section>

<section class="section soft after-submit" aria-labelledby="after-submit-title">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label">مسیر بعدی</span>
            <h2 class="section-title" id="after-submit-title">بعد از ثبت درخواست چه اتفاقی می‌افتد؟</h2>
        </div>
        <ol class="after-submit-grid">
            <li class="reveal"><span>۰۱</span><p>اطلاعات اولیه درخواست بررسی می‌شود.</p></li>
            <li class="reveal"><span>۰۲</span><p>برای هماهنگی جلسه دمو با متقاضی تماس گرفته می‌شود.</p></li>
            <li class="reveal"><span>۰۳</span><p>در جلسه، نیازها و بخش‌های مرتبط نرم‌افزار حمل‌ونقل سپند بررسی می‌شوند.</p></li>
        </ol>
    </div>
</section>

<section class="section consultation-faq" aria-labelledby="consultation-faq-title">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label">پیش از ثبت درخواست</span>
            <h2 class="section-title" id="consultation-faq-title">سؤالات متداول درباره درخواست دمو سپند</h2>
        </div>
        <div class="faq">
            <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <details class="reveal"><summary><?php echo e($faq['question']); ?></summary><p><?php echo e($faq['answer']); ?></p></details>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<section class="consultation-links" aria-labelledby="consultation-links-title">
    <div class="container">
        <h2 id="consultation-links-title">قبل از درخواست دمو بیشتر بررسی کنید</h2>
        <nav aria-label="صفحات مرتبط با انتخاب نرم‌افزار سپند">
            <a href="<?php echo e(route('pricing')); ?>">تعرفه‌های سپند</a>
            <a href="<?php echo e(route('modules')); ?>">ماژول‌های نرم‌افزار سپند</a>
            <a href="<?php echo e(route('compare.sepand-other-transport-software')); ?>">مقایسه سپند با سایر نرم‌افزارهای حمل‌ونقل</a>
            <a href="<?php echo e(route('site.modules.show', ['module' => 'crm'])); ?>">CRM حمل‌ونقل</a>
            <a href="<?php echo e(route('site.modules.show', ['module' => 'transport-operations'])); ?>">عملیات حمل</a>
        </nav>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
(()=>{const form=document.querySelector('[data-consultation-form]');if(!form)return;form.addEventListener('submit',event=>{if(form.dataset.submitting==='true'){event.preventDefault();return}form.dataset.submitting='true';const button=form.querySelector('[data-submit-button]'),label=form.querySelector('[data-submit-label]');if(button){button.disabled=true;button.setAttribute('aria-busy','true')}if(label)label.textContent='در حال ثبت درخواست…'});const status=document.getElementById('consultation-form-status');if(status)status.focus()})();
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.marketing', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\project\sepand\portal-customer\resources\views/marketing/consultation.blade.php ENDPATH**/ ?>