<?php
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
                'dateModified' => '2026-11-07',
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
                    ['@type' => 'ListItem', 'position' => 2, 'name' => 'بررسی رایگان فرایندها', 'item' => $canonical],
                ],
            ],
        ],
    ];

    $initialStep = 1;
    foreach ([2, 3, 4] as $responseStep) {
        if ($errors->has('responses.'.$responseStep)) {
            $initialStep = $responseStep;
            break;
        }
    }
    if ($errors->has('message')) {
        $initialStep = 5;
    }
    if ($errors->hasAny(['name', 'mobile', 'company', 'source_page', 'utm', 'submission'])) {
        $initialStep = 6;
    }
    if ($errors->has('topic')) {
        $initialStep = 1;
    }
    $selectedTopic = old('topic');
    $initialStepLabel = strtr((string) $initialStep, [
        '0' => '۰', '1' => '۱', '2' => '۲', '3' => '۳', '4' => '۴',
        '5' => '۵', '6' => '۶', '7' => '۷', '8' => '۸', '9' => '۹',
    ]);
?>

<?php $__env->startPush('head'); ?>
    <script type="application/ld+json"><?php echo json_encode($structuredData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/marketing-consultation.css')); ?>?v=20261107-1">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<section class="page-hero process-review-hero">
    <div class="container process-review-hero__layout">
        <div class="process-review-hero__copy reveal">
            <div class="breadcrumb"><a href="<?php echo e(route('home')); ?>">صفحه اصلی</a><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg><span>بررسی رایگان فرایندها</span></div>
            <p class="process-review-kicker">مشاوره رایگان ویژه شرکت‌های حمل‌ونقل بین‌المللی</p>
            <h1>کدام بخش از کار شرکت شما به <span>راهکار بهتری</span> نیاز دارد؟</h1>
            <p class="process-review-lead">از فروش و نرخ‌گیری تا بوکینگ، عملیات و امور مالی؛ به چند سؤال کوتاه پاسخ دهید تا مسئله شرکت شما را بررسی کنیم و برای بهبود فرایندها راهکار پیشنهاد بدهیم.</p>
            <div class="process-review-hero__action">
                <a class="btn btn-primary" href="#consultation-form" data-form-start>شروع بررسی رایگان</a>
                <span><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 6v6l4 2M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>چند سؤال کوتاه، متناسب با نیاز شرکت شما</span>
            </div>
        </div>

        <div class="process-review-map reveal" aria-label="مسیر بررسی درخواست">
            <div class="process-review-map__head">
                <span>بررسی مسئله شرکت شما</span>
                <span class="process-review-map__badge">۶ مرحله کوتاه</span>
            </div>
            <ol>
                <li><span class="process-review-map__number">۱</span><div><strong>انتخاب مسئله اصلی</strong><small>فروش، نرخ، بوکینگ، عملیات، اسناد، مالی یا مدیریت</small></div></li>
                <li><span class="process-review-map__number">۲</span><div><strong>پاسخ‌های مرتبط</strong><small>فقط سؤال‌هایی که به موضوع انتخابی شما مربوط‌اند</small></div></li>
                <li><span class="process-review-map__number">۳</span><div><strong>بررسی توسط تیم سپند</strong><small>برای پیشنهاد راهکار متناسب با فرایند شرکت شما</small></div></li>
            </ol>
        </div>
    </div>
</section>

<section class="review-outcomes" aria-labelledby="review-outcomes-title">
    <div class="container">
        <div class="review-outcomes__heading"><span>خروجی این بررسی</span><h2 id="review-outcomes-title">یک تصویر روشن‌تر از مسئله و اقدام بعدی</h2></div>
        <ul>
            <li><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m8 12 2.5 2.5L16 9" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.5"/></svg><span>بررسی چالش اصلی شرکت شما</span></li>
            <li><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m8 12 2.5 2.5L16 9" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.5"/></svg><span>پیشنهاد اقدام‌های عملی برای بهبود فرایند</span></li>
            <li><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m8 12 2.5 2.5L16 9" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.5"/></svg><span>بررسی اینکه سپند چگونه می‌تواند به اجرای راهکار کمک کند</span></li>
        </ul>
    </div>
</section>

<section class="process-review-form-section" aria-labelledby="process-review-form-section-title">
    <div class="container">
        <div class="process-review-form-section__head reveal">
            <span>شروع بررسی</span>
            <h2 id="process-review-form-section-title">مسئله اصلی شرکتتان را قدم‌به‌قدم بررسی کنیم</h2>
            <p>در هر مرحله فقط یک سؤال می‌بینید و پاسخ‌ها هنگام رفت‌وبرگشت حفظ می‌شوند.</p>
        </div>

        <?php if(session('status') === 'success'): ?>
            <section class="consultation-success" id="consultation-form" data-consultation-success tabindex="-1" aria-labelledby="consultation-success-title">
                <div class="consultation-success__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="m7 12.5 3.1 3L17.5 8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.5"/></svg></div>
                <p class="consultation-success__eyebrow">ثبت با موفقیت انجام شد</p>
                <h2 id="consultation-success-title">درخواست شما ثبت شد</h2>
                <p>پاسخ‌های شما برای تیم سپند ارسال شد. برای بررسی مسئله شرکتتان و گفت‌وگو درباره راهکارهای پیشنهادی با شما تماس می‌گیریم.</p>
                <a class="btn btn-outline" href="<?php echo e(route('product')); ?>">آشنایی بیشتر با سپند</a>
            </section>
        <?php else: ?>
            <form class="consultation-wizard reveal" id="consultation-form" method="POST" action="<?php echo e(route('process-review.store')); ?>" data-consultation-form data-initial-step="<?php echo e($initialStep); ?>" data-current-topic="<?php echo e($selectedTopic); ?>" novalidate>
                <?php echo csrf_field(); ?>
                <input type="hidden" name="source_page" value="<?php echo e(old('source_page', $sourcePage)); ?>">
                <?php $__currentLoopData = $utmParameters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <input type="hidden" name="utm[<?php echo e($key); ?>]" value="<?php echo e(old('utm.'.$key, $value)); ?>">
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="honeypot" aria-hidden="true"><label for="website">وب‌سایت</label><input id="website" name="website" type="text" tabindex="-1" autocomplete="off"></div>

                <div class="consultation-wizard__progress">
                    <div class="consultation-wizard__progress-copy"><span data-step-label>مرحله <?php echo e($initialStepLabel); ?> از ۶</span><strong data-step-context>انتخاب موضوع</strong></div>
                    <div class="consultation-wizard__progress-track" role="progressbar" aria-label="پیشرفت فرم" aria-valuemin="1" aria-valuemax="6" aria-valuenow="<?php echo e($initialStep); ?>" data-progressbar><span data-progress-fill style="width: <?php echo e(($initialStep / 6) * 100); ?>%"></span></div>
                </div>

                <div class="consultation-wizard__body">
                    <fieldset class="consultation-stage" data-stage="1" <?php if($initialStep !== 1): ?> hidden <?php endif; ?>>
                        <legend class="sr-only">انتخاب موضوع</legend>
                        <div class="consultation-question"><span class="consultation-question__number">۱</span><div><h3 tabindex="-1" data-question-heading>کدام بخش از شرکت شما بیشتر به بهبود نیاز دارد؟</h3><p>اگر چند موضوع دارید، مهم‌ترین مورد را انتخاب کنید.</p></div></div>
                        <div class="consultation-options consultation-options--topics">
                            <?php $__currentLoopData = $topics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topicKey => $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label class="consultation-option">
                                    <input type="radio" name="topic" value="<?php echo e($topicKey); ?>" <?php if($selectedTopic === $topicKey): echo 'checked'; endif; ?>>
                                    <span class="consultation-option__check" aria-hidden="true"><svg viewBox="0 0 20 20" fill="none"><path d="m5 10.5 3 3L15 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                                    <span><?php echo e($topic['label']); ?></span>
                                </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <p class="consultation-step-error" data-step-error="1" role="alert"><?php $__errorArgs = ['topic'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></p>
                    </fieldset>

                    <?php $__currentLoopData = $topics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topicKey => $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $topic['questions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $questionStep => $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <fieldset class="consultation-stage" data-stage="<?php echo e($questionStep); ?>" data-topic="<?php echo e($topicKey); ?>" <?php if($initialStep !== $questionStep || $selectedTopic !== $topicKey): ?> hidden <?php endif; ?>>
                                <legend class="sr-only"><?php echo e($question['text']); ?></legend>
                                <div class="consultation-question"><span class="consultation-question__number"><?php echo e($questionStep); ?></span><div><span class="consultation-question__topic"><?php echo e($topic['label']); ?></span><h3 tabindex="-1" data-question-heading><?php echo e($question['text']); ?></h3></div></div>
                                <div class="consultation-options">
                                    <?php $__currentLoopData = $question['options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionKey => $optionLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <label class="consultation-option">
                                            <input type="radio" name="responses[<?php echo e($questionStep); ?>]" value="<?php echo e($optionKey); ?>" <?php if(old('responses.'.$questionStep) === $optionKey): echo 'checked'; endif; ?>>
                                            <span class="consultation-option__check" aria-hidden="true"><svg viewBox="0 0 20 20" fill="none"><path d="m5 10.5 3 3L15 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                                            <span><?php echo e($optionLabel); ?></span>
                                        </label>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <p class="consultation-step-error" data-step-error="<?php echo e($questionStep); ?>" role="alert"><?php $__errorArgs = ['responses.'.$questionStep];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></p>
                            </fieldset>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <section class="consultation-stage" data-stage="5" <?php if($initialStep !== 5): ?> hidden <?php endif; ?> aria-labelledby="optional-note-title">
                        <div class="consultation-question"><span class="consultation-question__number">۵</span><div><span class="consultation-question__topic">اختیاری</span><h3 id="optional-note-title" tabindex="-1" data-question-heading>درباره مسئله شرکتتان، چه نکته دیگری باید بدانیم؟</h3><p>اگر توضیح بیشتری ندارید، می‌توانید از این مرحله عبور کنید.</p></div></div>
                        <div class="consultation-textarea-field">
                            <label class="sr-only" for="message">توضیح اختیاری درباره مسئله شرکت</label>
                            <textarea id="message" name="message" maxlength="2000" rows="5" placeholder="مثلاً مشکلی که مرتب تکرار می‌شود یا کاری که وقت زیادی از تیم شما می‌گیرد."><?php echo e(old('message')); ?></textarea>
                            <div><span>اختیاری</span><span data-message-count>۰ از ۲۰۰۰</span></div>
                            <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="consultation-step-error" role="alert"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </section>

                    <section class="consultation-stage" data-stage="6" <?php if($initialStep !== 6): ?> hidden <?php endif; ?> aria-labelledby="contact-details-title">
                        <div class="consultation-question"><span class="consultation-question__number">۶</span><div><span class="consultation-question__topic">اطلاعات تماس</span><h3 id="contact-details-title" tabindex="-1" data-question-heading>برای بررسی پاسخ‌ها و ارائه راهکار، چطور با شما در ارتباط باشیم؟</h3><p>تیم سپند پاسخ‌های شما را بررسی می‌کند و برای گفت‌وگو درباره مسئله شرکتتان و راهکارهای پیشنهادی با شما تماس می‌گیرد.</p></div></div>
                        <div class="consultation-contact-fields">
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
                                <label for="mobile">شماره موبایل <span aria-hidden="true">*</span></label>
                                <input id="mobile" name="mobile" type="tel" value="<?php echo e(old('mobile')); ?>" maxlength="20" inputmode="tel" autocomplete="tel" placeholder="۰۹۱۲۱۲۳۴۵۶۷" dir="ltr" required <?php $__errorArgs = ['mobile'];
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
                            <div class="field field--company">
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
                        </div>
                        <?php $__errorArgs = ['submission'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="consultation-submit-error" role="alert"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </section>
                </div>

                <div class="consultation-wizard__actions">
                    <button class="btn consultation-back" type="button" data-back <?php if($initialStep === 1): ?> hidden <?php endif; ?>><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m15 6-6 6 6 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>مرحله قبل</button>
                    <button class="btn btn-primary consultation-next" type="button" data-next <?php if($initialStep === 6): ?> hidden <?php endif; ?>><span data-next-label><?php echo e($initialStep === 5 && blank(old('message')) ? 'ادامه بدون توضیح' : 'ادامه'); ?></span><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 6 6 6-6 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
                    <button class="btn btn-primary consultation-submit" type="submit" data-submit-button <?php if($initialStep !== 6): ?> hidden <?php endif; ?>><span data-submit-label>ثبت درخواست بررسی رایگان</span></button>
                </div>
                <p class="consultation-privacy">اطلاعات تماس شما فقط برای بررسی و پیگیری همین درخواست استفاده می‌شود.</p>
                <noscript><p class="consultation-noscript">برای تکمیل فرم مرحله‌ای، جاوااسکریپت مرورگر باید فعال باشد.</p></noscript>
            </form>
        <?php endif; ?>
    </div>
</section>

<section class="review-process" aria-labelledby="review-process-title">
    <div class="container">
        <div class="review-process__head reveal"><span>روند کار</span><h2 id="review-process-title">از انتخاب مسئله تا گفت‌وگو درباره راهکار</h2></div>
        <ol class="review-process__steps">
            <li class="reveal"><span>۱</span><div><strong>موضوع موردنظر را انتخاب می‌کنید</strong><p>مهم‌ترین بخشی را که اکنون به بهبود نیاز دارد مشخص می‌کنید.</p></div></li>
            <li class="reveal"><span>۲</span><div><strong>به سؤال‌های مرتبط پاسخ می‌دهید</strong><p>سه سؤال کوتاه فقط بر اساس همان موضوع نمایش داده می‌شود.</p></div></li>
            <li class="reveal"><span>۳</span><div><strong>تیم سپند با شما تماس می‌گیرد</strong><p>پاسخ‌ها برای بررسی مسئله و ارائه راهکار متناسب مرور می‌شوند.</p></div></li>
        </ol>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
(()=>{
    const form=document.querySelector('[data-consultation-form]');
    const success=document.querySelector('[data-consultation-success]');
    const track=(name,detail={})=>{
        const payload={event_category:'consultation_process_review',form_id:'process_review',...detail};
        if(typeof window.gtag==='function')window.gtag('event',name,payload);
        else{window.dataLayer=window.dataLayer||[];window.dataLayer.push({event:name,...payload})}
    };
    if(success){success.focus({preventScroll:true});track('consultation_process_success');return}
    if(!form)return;

    const panels=[...form.querySelectorAll('[data-stage]')];
    const progress=form.querySelector('[data-progressbar]');
    const progressFill=form.querySelector('[data-progress-fill]');
    const stepLabel=form.querySelector('[data-step-label]');
    const stepContext=form.querySelector('[data-step-context]');
    const back=form.querySelector('[data-back]');
    const next=form.querySelector('[data-next]');
    const nextLabel=form.querySelector('[data-next-label]');
    const submit=form.querySelector('[data-submit-button]');
    const message=form.querySelector('#message');
    const messageCount=form.querySelector('[data-message-count]');
    const contexts=['','انتخاب موضوع','سؤال مرتبط اول','سؤال مرتبط دوم','سؤال مرتبط سوم','توضیح اختیاری','اطلاعات تماس'];
    let step=Number(form.dataset.initialStep||1);
    let topic=form.querySelector('input[name="topic"]:checked')?.value||'';
    let started=false;

    const activePanel=(targetStep)=>panels.find(panel=>Number(panel.dataset.stage)===targetStep&&(!panel.dataset.topic||panel.dataset.topic===topic));
    const setError=(targetStep,message='')=>{
        const panel=activePanel(targetStep);
        const error=panel?.querySelector(`[data-step-error="${targetStep}"]`);
        if(error)error.textContent=message;
    };
    const startTracking=()=>{if(started)return;started=true;track('consultation_process_start')};
    const updateMessageMeta=()=>{
        if(!message)return;
        if(messageCount)messageCount.textContent=`${message.value.length.toLocaleString('fa-IR')} از ۲۰۰۰`;
        if(step===5&&nextLabel)nextLabel.textContent=message.value.trim()?'ادامه':'ادامه بدون توضیح';
    };
    const render=(focusQuestion=false)=>{
        panels.forEach(panel=>panel.hidden=true);
        const panel=activePanel(step);
        if(!panel){step=1;topic='';return render(focusQuestion)}
        panel.hidden=false;
        stepLabel.textContent=`مرحله ${step.toLocaleString('fa-IR')} از ۶`;
        stepContext.textContent=contexts[step];
        progress.setAttribute('aria-valuenow',String(step));
        progressFill.style.width=`${(step/6)*100}%`;
        back.hidden=step===1;
        next.hidden=step===6;
        submit.hidden=step!==6;
        updateMessageMeta();
        if(focusQuestion){
            const reduceMotion=window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            form.scrollIntoView({behavior:reduceMotion?'auto':'smooth',block:'start'});
            window.setTimeout(()=>panel.querySelector('[data-question-heading]')?.focus({preventScroll:true}),reduceMotion?0:260);
        }
    };
    const validateStep=(targetStep)=>{
        if(targetStep===1){
            const checked=form.querySelector('input[name="topic"]:checked');
            if(!checked){setError(1,'لطفاً یک موضوع را انتخاب کنید.');return false}
            topic=checked.value;
            return true;
        }
        if(targetStep>=2&&targetStep<=4){
            const panel=activePanel(targetStep);
            const checked=panel?.querySelector(`input[name="responses[${targetStep}]"]:checked`);
            if(!checked){setError(targetStep,'لطفاً یک گزینه را انتخاب کنید.');return false}
        }
        return true;
    };

    form.addEventListener('focusin',startTracking,{once:true});
    document.querySelector('[data-form-start]')?.addEventListener('click',startTracking,{once:true});
    form.addEventListener('change',event=>{
        if(event.target.name==='topic'){
            const previousTopic=topic;
            topic=event.target.value;
            form.dataset.currentTopic=topic;
            setError(1);
            if(previousTopic&&previousTopic!==topic){
                form.querySelectorAll('input[name^="responses["]').forEach(input=>input.checked=false);
                [2,3,4].forEach(responseStep=>setError(responseStep));
            }
        }
        if(event.target.matches('input[name^="responses["]'))setError(step);
    });
    message?.addEventListener('input',updateMessageMeta);
    next.addEventListener('click',()=>{
        startTracking();
        if(!validateStep(step))return;
        track('consultation_process_step_complete',{step_number:step,topic:topic||undefined});
        step=Math.min(6,step+1);
        render(true);
    });
    back.addEventListener('click',()=>{step=Math.max(1,step-1);render(true)});
    form.addEventListener('submit',event=>{
        if(form.dataset.submitting==='true'){event.preventDefault();return}
        for(let requiredStep=1;requiredStep<=4;requiredStep++){
            if(!validateStep(requiredStep)){event.preventDefault();step=requiredStep;render(true);return}
        }
        const fields=[form.querySelector('#name'),form.querySelector('#mobile'),form.querySelector('#company')];
        const invalid=fields.find(field=>field&&!field.checkValidity());
        if(invalid){event.preventDefault();invalid.reportValidity();invalid.focus();return}
        form.dataset.submitting='true';
        submit.disabled=true;
        submit.setAttribute('aria-busy','true');
        form.querySelector('[data-submit-label]').textContent='در حال ثبت درخواست…';
        track('consultation_process_submit',{step_number:6,topic:topic||undefined});
    });
    updateMessageMeta();
    render(false);
})();
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.marketing', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/portal-customer/resources/views/marketing/consultation.blade.php ENDPATH**/ ?>