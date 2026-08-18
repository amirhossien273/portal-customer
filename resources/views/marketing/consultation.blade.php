@extends('layouts.marketing')

@php
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
            'question' => 'آیا سپند برای شرکت‌های حمل‌ونقل بین‌المللی و Freight Forwarder مناسب است؟',
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
@endphp

@push('head')
    <script type="application/ld+json">{!! json_encode($structuredData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endpush

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/marketing-consultation.css') }}?v=20260818-1">
@endpush

@section('content')
<section class="page-hero consultation-hero">
    <div class="container hero-inner">
        <div class="hero-copy reveal">
            <div class="breadcrumb"><a href="{{ route('home') }}">صفحه اصلی</a><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg><span>درخواست دمو و مشاوره</span></div>
            <h1><span class="h1-primary">درخواست دمو و مشاوره خرید</span><br><span>نرم‌افزار حمل‌ونقل سپند</span></h1>
            <p>جلسه دمو سپند صرفاً نمایش عمومی فهرست امکانات نیست. ابتدا نوع فعالیت، روش‌های حمل، ساختار تیم و فرایند فعلی فروش، Booking، عملیات، اسناد و مالی شرکت شما بررسی می‌شود. سپس بخش‌ها و ماژول‌های مرتبط نرم‌افزار حمل‌ونقل سپند با تمرکز بر مسئله‌های اصلی تیم نمایش داده می‌شوند. هدف این جلسه آن است که پیش از تصمیم خرید، مشخص شود کدام قسمت‌های سپند CRM با نیازهای واقعی شرکت تطابق دارند، چه موضوعاتی به بررسی بیشتر نیاز دارند و ادامه ارزیابی یا استقرار باید با چه دامنه‌ای انجام شود.</p>
            <div class="hero-actions">
                <a class="btn btn-primary" href="#consultation-form" data-ga-event="cta_click" data-ga-label="consultation_hero_form">ثبت درخواست دمو و نیازسنجی</a>
            </div>
        </div>
        <figure class="consultation-product-shot hero-art reveal">
            <div class="product-shot-frame">
                <span class="product-shot-label">نمای واقعی محصول</span>
                <img src="{{ asset('assets/images/marketing/sepand-cargo-details.webp') }}" width="835" height="335" loading="eager" fetchpriority="high" alt="نمای نرم افزار مدیریت حمل و نقل سپند">
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

        <form class="consultation-form reveal" id="consultation-form" method="POST" action="{{ route('consultation.store') }}" data-ga-form="consultation_submit" data-consultation-form aria-labelledby="consultation-form-title">
            @csrf
            <input type="hidden" name="source_page" value="{{ old('source_page', url()->previous()) }}">
            <div class="honeypot" aria-hidden="true"><label for="website">وب‌سایت</label><input id="website" name="website" type="text" tabindex="-1" autocomplete="off"></div>
            <div class="form-heading">
                <span class="consultation-eyebrow">اطلاعات اولیه</span>
                <p class="form-title" id="consultation-form-title">برای هماهنگی دمو، این فرم کوتاه را تکمیل کنید</p>
                <p>فیلدهای ستاره‌دار برای بررسی اولیه درخواست لازم هستند.</p>
            </div>
            @if(session('status'))<div class="form-status" id="consultation-form-status" role="status" tabindex="-1">{{ session('status') }}</div>@endif
            <div class="form-grid">
                <div class="field">
                    <label for="name">نام و نام خانوادگی <span aria-hidden="true">*</span></label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" maxlength="100" autocomplete="name" required @error('name') aria-invalid="true" aria-describedby="name-error" @enderror>
                    @error('name')<span class="form-error" id="name-error">{{ $message }}</span>@enderror
                </div>
                <div class="field">
                    <label for="company">نام شرکت <span aria-hidden="true">*</span></label>
                    <input id="company" name="company" type="text" value="{{ old('company') }}" maxlength="150" autocomplete="organization" required @error('company') aria-invalid="true" aria-describedby="company-error" @enderror>
                    @error('company')<span class="form-error" id="company-error">{{ $message }}</span>@enderror
                </div>
                <div class="field">
                    <label for="mobile">شماره تماس <span aria-hidden="true">*</span></label>
                    <input id="mobile" name="mobile" type="tel" value="{{ old('mobile') }}" maxlength="30" inputmode="tel" autocomplete="tel" required @error('mobile') aria-invalid="true" aria-describedby="mobile-error" @enderror>
                    @error('mobile')<span class="form-error" id="mobile-error">{{ $message }}</span>@enderror
                </div>
                <div class="field">
                    <label for="email">ایمیل سازمانی <span class="optional">اختیاری</span></label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" maxlength="190" inputmode="email" autocomplete="email" @error('email') aria-invalid="true" aria-describedby="email-error" @enderror>
                    @error('email')<span class="form-error" id="email-error">{{ $message }}</span>@enderror
                </div>
                <div class="field">
                    <label for="company_type">نوع کسب‌وکار <span aria-hidden="true">*</span></label>
                    <select id="company_type" name="company_type" required @error('company_type') aria-invalid="true" aria-describedby="company-type-error" @enderror>
                        <option value="">انتخاب کنید</option>
                        @foreach(['شرکت حمل‌ونقل بین‌المللی','شرکت فورواردری','NVOCC','نماینده خط حمل','شرکت لجستیک','سایر'] as $type)
                            <option value="{{ $type }}" @selected(old('company_type') === $type)>{{ $type }}</option>
                        @endforeach
                    </select>
                    @error('company_type')<span class="form-error" id="company-type-error">{{ $message }}</span>@enderror
                </div>
                <div class="field">
                    <label for="approximate_users">تعداد تقریبی کاربران <span class="optional">اختیاری</span></label>
                    <select id="approximate_users" name="approximate_users" @error('approximate_users') aria-invalid="true" aria-describedby="approximate-users-error" @enderror>
                        <option value="">انتخاب کنید</option>
                        @foreach(['1 تا 5 نفر','6 تا 15 نفر','16 تا 30 نفر','بیش از 30 نفر'] as $range)
                            <option value="{{ $range }}" @selected(old('approximate_users') === $range)>{{ $range }}</option>
                        @endforeach
                    </select>
                    @error('approximate_users')<span class="form-error" id="approximate-users-error">{{ $message }}</span>@enderror
                </div>
                <div class="field full">
                    <label for="primary_need">مهم‌ترین نیاز فعلی شرکت شما چیست؟ <span aria-hidden="true">*</span></label>
                    <select id="primary_need" name="primary_need" required @error('primary_need') aria-invalid="true" aria-describedby="primary-need-error" @enderror>
                        <option value="">انتخاب کنید</option>
                        @foreach(['CRM و فروش','استعلام و نرخ‌دهی','Booking','عملیات حمل','مدیریت اسناد','مالی','پرتال مشتری','گزارش‌های مدیریتی','یکپارچه‌سازی فرایندها','سایر'] as $need)
                            <option value="{{ $need }}" @selected(old('primary_need') === $need)>{{ $need }}</option>
                        @endforeach
                    </select>
                    @error('primary_need')<span class="form-error" id="primary-need-error">{{ $message }}</span>@enderror
                </div>
                <div class="field full">
                    <label for="message">توضیحات تکمیلی <span class="optional">اختیاری</span></label>
                    <textarea id="message" name="message" maxlength="2000" placeholder="مثلاً روش‌های حمل، ساختار تیم یا گلوگاهی که می‌خواهید در جلسه بررسی شود" @error('message') aria-invalid="true" aria-describedby="message-error" @enderror>{{ old('message') }}</textarea>
                    @error('message')<span class="form-error" id="message-error">{{ $message }}</span>@enderror
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
            @foreach($faqs as $faq)
                <details class="reveal"><summary>{{ $faq['question'] }}</summary><p>{{ $faq['answer'] }}</p></details>
            @endforeach
        </div>
    </div>
</section>

<section class="consultation-links" aria-labelledby="consultation-links-title">
    <div class="container">
        <h2 id="consultation-links-title">قبل از درخواست دمو بیشتر بررسی کنید</h2>
        <nav aria-label="صفحات مرتبط با انتخاب نرم‌افزار سپند">
            <a href="{{ route('pricing') }}">تعرفه‌های سپند</a>
            <a href="{{ route('modules') }}">ماژول‌های نرم‌افزار سپند</a>
            <a href="{{ route('compare.sepand-other-transport-software') }}">مقایسه سپند با سایر نرم‌افزارهای حمل‌ونقل</a>
            <a href="{{ route('site.modules.show', ['module' => 'crm']) }}">CRM حمل‌ونقل</a>
            <a href="{{ route('site.modules.show', ['module' => 'transport-operations']) }}">عملیات حمل</a>
        </nav>
    </div>
</section>
@endsection

@push('scripts')
<script>
(()=>{const form=document.querySelector('[data-consultation-form]');if(!form)return;form.addEventListener('submit',event=>{if(form.dataset.submitting==='true'){event.preventDefault();return}form.dataset.submitting='true';const button=form.querySelector('[data-submit-button]'),label=form.querySelector('[data-submit-label]');if(button){button.disabled=true;button.setAttribute('aria-busy','true')}if(label)label.textContent='در حال ثبت درخواست…'});const status=document.getElementById('consultation-form-status');if(status)status.focus()})();
</script>
@endpush
