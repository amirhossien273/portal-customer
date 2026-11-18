@extends('layouts.marketing')

@php
    $title = 'درباره سپند | داستان و شیوه همکاری با شرکت‌های حمل‌ونقل';
    $description = 'سپند چرا و برای چه شرکت‌هایی ساخته شده است؟ با داستان نرم‌افزار سپند، روش همکاری با شرکت‌های حمل‌ونقل بین‌المللی و یک نمونه واقعی از کاربرد آن آشنا شوید.';
    $canonical = route('about');
    $consultationUrl = route('consultation.create', ['source_page' => $canonical]);
    $caseStudy = config('site_case_studies.operational-control-snapshot');
    $actionMetric = collect($caseStudy['metrics'])->firstWhere('label', 'مورد نیازمند اقدام');
@endphp

@push('head')
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'AboutPage',
            '@id' => $canonical.'#webpage',
            'url' => $canonical,
            'name' => $title,
            'headline' => 'درباره سپند',
            'description' => $description,
            'inLanguage' => 'fa-IR',
            'isPartOf' => ['@id' => route('home').'#website'],
            'about' => ['@id' => route('home').'#organization'],
            'publisher' => ['@id' => route('home').'#organization'],
            'dateModified' => '2026-11-18',
        ],
        [
            '@type' => 'BreadcrumbList',
            '@id' => $canonical.'#breadcrumb',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'صفحه اصلی', 'item' => route('home')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'درباره سپند', 'item' => $canonical],
            ],
        ],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endpush

@section('content')
<section class="page-hero">
    <div class="container hero-inner">
        <div class="hero-copy reveal">
            <div class="breadcrumb"><a href="{{ route('home') }}">صفحه اصلی</a><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg><span>درباره سپند</span></div>
            <h1>درباره سپند</h1>
            <p>سپند نرم‌افزاری برای شرکت‌های حمل‌ونقل بین‌المللی، فورواردرها و تیم‌های لجستیک است. سپند برای حل یک مسئله مشخص شکل گرفت: اطلاعات استعلام، نرخ، محموله و هزینه‌ها میان فروش، عملیات و مالی پراکنده می‌شود. با سپند، هر تیم می‌تواند روی همان پرونده حمل کار کند و ببیند اقدام بعدی چیست و چه کسی مسئول آن است.</p>
            <div class="hero-actions">
                <a class="btn btn-primary" href="{{ $consultationUrl }}" data-ga-event="cta_click" data-ga-label="about_hero_consultation">درخواست جلسه آشنایی با سپند</a>
                <a class="btn btn-outline" href="#case-study" data-ga-event="cta_click" data-ga-label="about_hero_case_study">مشاهده نمونه واقعی کاربرد سپند</a>
            </div>
        </div>
        <div class="hero-art reveal" aria-label="ارتباط تیم‌های فروش، عملیات و مالی در سپند">
            <div class="art-panel"><div class="art-content"><div class="art-head"><span class="art-mark"><img class="about-mark-image" src="{{ asset('assets/images/brand/sepand-provided-header.png') }}" alt=""></span><span class="art-chip">یک پرونده حمل مشترک</span></div><h2 class="art-title">فروش، عملیات و مالی در یک جریان</h2><p class="art-desc">از استعلام و نرخ تا رزرو، اجرای حمل و ثبت هزینه</p><div class="art-bars" aria-hidden="true"><i></i><i></i><i></i><i></i><i></i><i></i></div></div></div>
        </div>
    </div>
</section>

<section class="section" id="story">
    <div class="container split">
        <div class="visual-box reveal">
            <span class="section-label">یک موقعیت کاری آشنا</span>
            <h2 class="about-mission-title">اطلاعات یک حمل، در چند جای جدا</h2>
            <p class="about-mission-copy">نرخ تأمین‌کننده در ایمیل است، نتیجه پیگیری مشتری در پیام‌رسان مانده و تیم عملیات برای شروع پرونده دوباره مشخصات محموله را از فروش می‌پرسد. مالی هم برای تطبیق هزینه باید سراغ همان اطلاعات را از چند نفر بگیرد.</p>
        </div>
        <div class="split-copy reveal">
            <span class="section-label">داستان سپند</span>
            <h2 class="section-title">یک پرونده از استعلام تا مالی؛<br><span>بدون گسست میان تیم‌ها</span></h2>
            <p>سپند از نیاز به پیوند دادن همین کارهای روزمره شکل گرفت: استعلام مشتری به نرخ‌دهی برسد، نرخ تأییدشده به رزرو و عملیات تحویل شود و هزینه‌ها در ادامه همان پرونده ثبت شوند. درباره نرم‌افزار سپند، مهم‌ترین نکته این است که اطلاعات با تغییر مسئول یا مرحله، دوباره از ابتدا جمع‌آوری نشود.</p>
            <p>برای آشنایی کلی با <a class="contextual-link" href="{{ route('home') }}">نرم‌افزار حمل‌ونقل بین‌المللی</a> سپند، صفحه اصلی را ببینید؛ در <a class="contextual-link" href="{{ route('product') }}">معرفی نرم‌افزار سپند</a> نیز می‌توانید مسیر کامل محصول را دنبال کنید. اگر می‌خواهید معیارهای انتخاب و تفاوت رویکرد سپند را بررسی کنید، صفحه <a class="contextual-link" href="{{ route('why-sepand') }}">چرا سپند</a> ادامه این بحث است.</p>
            <div class="check-grid"><span class="check"><i>✓</i>استعلام و نرخ در یک مسیر</span><span class="check"><i>✓</i>تحویل روشن به عملیات</span><span class="check"><i>✓</i>مسئول و اقدام بعدی مشخص</span><span class="check"><i>✓</i>هزینه متصل به پرونده حمل</span></div>
        </div>
    </div>
</section>

<section class="section soft" id="collaboration">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">روش همکاری</span><h2 class="section-title">از جلسه اول تا راه‌اندازی</h2><p class="section-sub">پیش از تصمیم خرید یا تعیین دامنه استقرار، فرایند واقعی شرکت و تناسب محصول با آن مرحله‌به‌مرحله بررسی می‌شود.</p></div>
        <div class="card-grid about-steps">
            <article class="content-card reveal"><span class="about-step-number">۱</span><h3>شناخت فرایند شرکت</h3><p>مسیر فعلی یک استعلام یا پرونده حمل، نقش تیم‌ها و نقطه‌ای که اطلاعات یا پیگیری در آن متوقف می‌شود مرور می‌شود. در این مرحله می‌توانید بررسی کنید آیا مسئله شما با دامنه سپند هم‌خوان است.</p></article>
            <article class="content-card reveal"><span class="about-step-number">۲</span><h3>نمایش یک سناریوی واقعی در دمو</h3><p>یک سناریوی نزدیک به کار شرکت، از ثبت استعلام و نرخ تا تحویل به عملیات یا مالی در محصول دنبال می‌شود. شما می‌توانید داده‌های لازم، مسئول هر مرحله و خروجی قابل مشاهده را ارزیابی کنید.</p></article>
            <article class="content-card reveal"><span class="about-step-number">۳</span><h3>بررسی دامنه راه‌اندازی و همراهی</h3><p>ماژول‌ها، کاربران، داده‌های اولیه و اولویت‌های راه‌اندازی مرور می‌شوند تا موارد آماده محصول و نیازهای خاص شرکت از هم تفکیک شوند. دامنه همکاری پیش از شروع باید روشن و قابل بررسی باشد.</p></article>
        </div>
    </div>
</section>

<section class="dark-section">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">ارزش‌ها در عمل</span><h2 class="section-title">سه معیار روشن برای همکاری</h2></div>
        <div class="values about-values">
            <article class="value reveal"><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M3 12s3-6 9-6 9 6 9 6-3 6-9 6-9-6-9-6Z" stroke="currentColor" stroke-width="1.7"/><circle cx="12" cy="12" r="2.5" stroke="currentColor" stroke-width="1.7"/></svg><b>شفافیت</b><p>مسئول، موعد و اقدام بعدی هر پرونده برای تیم مشخص باشد؛ نه اینکه وضعیت فقط در گفت‌وگوهای پراکنده بماند.</p></article>
            <article class="value reveal"><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm8 0a4 4 0 1 0 0-8M2 21a6 6 0 0 1 12 0m2-6a6 6 0 0 1 6 6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg><b>همراهی</b><p>در جلسه، فرایند واقعی شرکت و یک پرونده نمونه بررسی شود تا گفت‌وگو به فهرست کلی قابلیت‌ها محدود نماند.</p></article>
            <article class="value reveal"><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 19V9m5 10V5m5 14v-7m5 7V3" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg><b>بهبود مبتنی بر مشاهده</b><p>گلوگاه و نتیجه با داده همان فرایند سنجیده شود؛ یک Snapshot به‌عنوان مشاهده مقطعی گزارش شود، نه وعده نتیجه.</p></article>
        </div>
    </div>
</section>

<section class="section" id="case-study">
    <div class="container about-case-study reveal">
        <div class="about-case-study__copy">
            <span class="section-label">مطالعه موردی ناشناس</span>
            <h2 class="section-title">یک تصویر واقعی از صف اقدام</h2>
            <p>در یک محیط عملیاتی واقعی سپند، داشبورد در یک مقطع زمانی <strong>{{ $actionMetric['value'] }} مورد نیازمند اقدام</strong> را نشان داد: {{ $actionMetric['meaning'] }}. این مشاهده، Snapshot ناشناس از همان لحظه است و به‌تنهایی ادعای بهبود یا صرفه‌جویی نیست.</p>
            <p>در مطالعه کامل، دامنه مشاهده، روش خواندن اعداد و شاخص‌هایی که برای سنجش بعدی لازم‌اند توضیح داده شده است.</p>
            <div class="hero-actions"><a class="btn btn-primary" href="{{ route('case-studies.show', ['caseStudy' => $caseStudy['slug']]) }}" data-ga-event="cta_click" data-ga-label="about_case_study_full">مطالعه کامل کنترل عملیات</a></div>
        </div>
        <figure class="about-case-study__media"><img src="{{ asset('assets/images/marketing/'.$caseStudy['image']) }}" alt="{{ $caseStudy['image_alt'] }}" width="{{ $caseStudy['image_width'] }}" height="{{ $caseStudy['image_height'] }}" loading="lazy"><figcaption>{{ $caseStudy['scope'] }}</figcaption></figure>
    </div>
</section>

<section class="cta-wrap"><div class="container"><div class="cta reveal"><div class="cta-copy"><h2>سپند را با فرایند واقعی شرکت خود ارزیابی کنید</h2><p>یک نمونه استعلام یا پرونده حمل و گلوگاه اصلی میان فروش، عملیات یا مالی را آماده کنید تا در جلسه آشنایی بررسی شود.</p></div><div class="cta-action"><a class="btn" href="{{ $consultationUrl }}" data-ga-event="cta_click" data-ga-label="about_bottom_consultation">درخواست جلسه آشنایی با سپند</a></div></div></div></section>
@endsection
