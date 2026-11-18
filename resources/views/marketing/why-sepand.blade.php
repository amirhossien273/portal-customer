@extends('layouts.marketing')

@php
    $title = 'چرا سپند؟ | مزایای نرم‌افزار سپند برای شرکت‌های فورواردری';
    $description = 'ببینید سپند چطور پیگیری استعلام، تبدیل نرخ به Booking و ثبت دریافت و پرداخت هر پرونده حمل را به هم متصل می‌کند. تصاویر محصول و نمونه کاربرد واقعی را ببینید.';
    $canonical = route('why-sepand');
    $consultationUrl = route('consultation.create', ['source_page' => $canonical]);
    $image = asset('assets/images/marketing/modules/screenshots/pricing-sales-workflow.webp');
    $imageAlt = 'برد واقعی استعلام، پیشنهاد نرخ و تبدیل به Booking در نرم‌افزار سپند';
    $imageWidth = 1600;
    $imageHeight = 687;
    $caseStudy = config('site_case_studies.operational-control-snapshot');
    $actionMetric = collect($caseStudy['metrics'])->firstWhere('label', 'مورد نیازمند اقدام');

    $fragmentedTools = ['اکسل', 'پیام‌رسان', 'ایمیل', 'CRM عمومی', 'فایل شخصی', 'گزارش دستی'];

    $evidence = [
        [
            'number' => '۰۱',
            'question' => 'استعلام در کدام مرحله است؟',
            'title' => 'برد استعلام تا Booking',
            'caption' => 'به ستون‌های «استعلام قیمت از تأمین‌کننده»، «ثبت و ارسال پیشنهاد نرخ»، «پیگیری و دریافت تأیید مشتری» و «تبدیل به بوکینگ» نگاه کنید؛ کارت هر استعلام جای آن را در جریان فروش نشان می‌دهد.',
            'path' => 'modules/screenshots/pricing-sales-workflow.webp',
            'alt' => 'برد واقعی سپند با ستون‌های استعلام قیمت، پیشنهاد نرخ، تأیید مشتری و تبدیل به Booking',
            'width' => 1600,
            'height' => 687,
            'url' => route('product').'#pricing',
        ],
        [
            'number' => '۰۲',
            'question' => 'مالی همان Booking را کجا می‌بیند؟',
            'title' => 'تطبیق مالی Booking',
            'caption' => 'در نوار بالای تصویر مبلغ Offer، پرداخت تأییدشده، دریافت تأییدشده و وضعیت تسویه را مقایسه کنید؛ فهرست پایین نیز Bookingهای فاقد نرخ تبدیل را برای تکمیل مالی نشان می‌دهد.',
            'path' => 'modules/screenshots/finance-booking-reconciliation.webp',
            'alt' => 'نمای واقعی تطبیق مالی Booking شامل مبلغ Offer، پرداخت، دریافت و وضعیت تسویه',
            'width' => 1600,
            'height' => 811,
            'url' => route('product').'#finance',
        ],
        [
            'number' => '۰۳',
            'question' => 'مدیر چه روندی را می‌بیند؟',
            'title' => 'دید مدیریتی از فروش',
            'caption' => 'نمودار «مقایسه استعلام و Booking در ۶ ماه اخیر» را ببینید. این تصویر روند حجمی را نشان می‌دهد؛ موارد بدون اقدام بعدی در مطالعه موردی کنترل عملیات مستند شده‌اند.',
            'path' => 'product-showcase/desktop-reports.webp',
            'alt' => 'گزارش واقعی سپند برای مقایسه تعداد استعلام و Booking در شش ماه اخیر',
            'width' => 1600,
            'height' => 844,
            'url' => route('product').'#dashboard',
        ],
    ];

    $evaluationMetrics = [
        ['code' => '۰۱', 'title' => 'استعلام بدون اقدام بعدی', 'text' => 'پیش و پس از استقرار، تعداد استعلام‌های باز بدون مسئول، موعد یا اقدام بعدی را در یک بازه هم‌طول مقایسه کنید.'],
        ['code' => '۰۲', 'title' => 'ثبت دوباره اطلاعات', 'text' => 'بررسی کنید مشخصات مشتری، مسیر، محموله و نرخ در تحویل از فروش به عملیات چند بار دوباره وارد می‌شوند.'],
        ['code' => '۰۳', 'title' => 'زمان دسترسی به وضعیت پرونده', 'text' => 'زمان لازم برای پاسخ به این سؤال را بسنجید: پرونده اکنون کجاست، اقدام بعدی چیست و چه کسی مسئول آن است؟'],
    ];

    $structuredData = [
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'WebPage',
                '@id' => $canonical.'#webpage',
                'url' => $canonical,
                'name' => $title,
                'headline' => 'چرا سپند برای شرکت‌های فورواردری؟',
                'description' => $description,
                'inLanguage' => 'fa-IR',
                'isPartOf' => ['@id' => route('home').'#website'],
                'about' => ['@id' => route('home').'#software'],
                'publisher' => ['@id' => route('home').'#organization'],
                'primaryImageOfPage' => ['@type' => 'ImageObject', 'url' => $image, 'width' => $imageWidth, 'height' => $imageHeight],
                'dateModified' => '2026-11-18',
            ],
            [
                '@type' => 'BreadcrumbList',
                '@id' => $canonical.'#breadcrumb',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => 'صفحه اصلی', 'item' => route('home')],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => 'چرا سپند؟', 'item' => $canonical],
                ],
            ],
        ],
    ];
@endphp

@push('head')
    <script type="application/ld+json">{!! json_encode($structuredData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endpush

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/marketing-why-sepand.css') }}?v=20261118-1">
@endpush

@section('content')
    <section class="why-hero" aria-labelledby="why-sepand-title">
        <div class="container why-hero-grid">
            <div class="why-hero-copy reveal visible">
                <nav class="breadcrumb" aria-label="مسیر راهنما"><a href="{{ route('home') }}">صفحه اصلی</a><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg><span>چرا سپند؟</span></nav>
                <span class="why-eyebrow">چرا سپند؟</span>
                <h1 id="why-sepand-title">چرا سپند برای شرکت‌های فورواردری؟</h1>
                <p>در سپند می‌توانید ببینید کدام استعلام منتظر پیگیری است، بعد از تأیید نرخ چه اطلاعاتی به عملیات می‌رسد و دریافت و پرداخت هر رزرو کجا ثبت می‌شود. مسیر یک پرونده را از استعلام تا مالی در تصاویر واقعی محصول ببینید.</p>
                <div class="why-hero-actions">
                    <a class="btn btn-primary" href="{{ $consultationUrl }}" data-ga-event="cta_click" data-ga-label="why_hero_consultation">درخواست دموی فرایند شرکت شما</a>
                    <a class="btn btn-outline" href="#product-evidence" data-ga-event="cta_click" data-ga-label="why_hero_evidence">مشاهده نمونه از استعلام تا مالی</a>
                </div>
            </div>
            <div class="why-hero-visual reveal visible" role="img" aria-label="ابزارهای پراکنده در برابر جریان مشترک سپند">
                <div class="why-tools-panel"><span>روش پراکنده</span><div class="why-tools-cloud">@foreach($fragmentedTools as $tool)<b>{{ $tool }}</b>@endforeach</div></div>
                <div class="why-visual-connector" aria-hidden="true"><span>اطلاعات یک پرونده</span><i>←</i></div>
                <div class="why-sepand-panel"><div class="why-sepand-mark" aria-hidden="true">S</div><div><small>جریان مشترک</small><strong>سپند</strong></div><p>فروش <i></i> عملیات <i></i> مالی</p></div>
            </div>
        </div>
    </section>

    <section class="why-evidence" id="product-evidence" aria-labelledby="evidence-title">
        <div class="container">
            <header class="why-section-head reveal"><span>تصاویر واقعی محصول</span><h2 id="evidence-title">سه نمای مستقل برای ارزیابی مسیر استعلام تا مالی</h2><p>این تصاویر بخش‌های متفاوت محصول را نشان می‌دهند و به‌عنوان مراحل ثبت‌شده یک پرونده واحد معرفی نمی‌شوند.</p></header>
            <div class="why-evidence-grid">
                @foreach($evidence as $item)
                    <article class="why-evidence-card reveal">
                        <a class="why-evidence-media" href="{{ $item['url'] }}" aria-label="{{ $item['title'] }} در معرفی محصول"><img src="{{ asset('assets/images/marketing/'.$item['path']) }}" alt="{{ $item['alt'] }}" width="{{ $item['width'] }}" height="{{ $item['height'] }}" loading="lazy" decoding="async"></a>
                        <div class="why-evidence-copy"><span>{{ $item['number'] }} · {{ $item['question'] }}</span><h3>{{ $item['title'] }}</h3><p>{{ $item['caption'] }}</p></div>
                    </article>
                @endforeach
            </div>

            <aside class="why-case-snapshot reveal" aria-labelledby="case-snapshot-title">
                <div><span>مشاهده در یک مقطع زمانی</span><h2 id="case-snapshot-title">صف اقدام در یک محیط عملیاتی واقعی</h2><p>در یک شرکت حمل‌ونقل که از سپند استفاده می‌کرد، داشبورد در زمان ثبت تصویر {{ $actionMetric['value'] }} مورد نیازمند اقدام نشان داد؛ {{ $actionMetric['meaning'] }}.</p></div>
                <a class="btn btn-outline" href="{{ route('case-studies.show', ['caseStudy' => $caseStudy['slug']]) }}" data-ga-event="cta_click" data-ga-label="why_case_study">مطالعه کامل کنترل عملیات</a>
            </aside>
        </div>
    </section>

    <section class="why-fragmented" aria-labelledby="problems-title">
        <div class="container">
            <header class="why-section-head reveal"><span>مزایای نرم‌افزار سپند در کار روزانه</span><h2 id="problems-title">سه گسست که باید در دمو بررسی شوند</h2><p>دلیل انتخاب سپند را می‌توان با سه مسئله مشخص سنجید، نه با یک فهرست کلی از قابلیت‌ها.</p></header>
            <div class="why-problem-grid why-three-grid">
                <article class="why-problem-card reveal"><span>۰۱</span><h3>پیگیری استعلام</h3><p>استعلام باز باید مسئول، موعد و اقدام بعدی مشخص داشته باشد؛ مدیر نیز باید موارد متوقف‌شده را بدون جمع‌آوری گزارش دستی پیدا کند.</p><strong><span>در سپند:</span> وضعیت و مرحله هر استعلام در برد فروش قابل مشاهده است.</strong></article>
                <article class="why-problem-card reveal"><span>۰۲</span><h3>تحویل فروش به عملیات</h3><p>تأیید نرخ در شرکت فورواردری پایان فروش نیست؛ آغاز Booking و کار عملیاتی است و اطلاعات نباید دوباره از مشتری یا فروش گرفته شوند.</p><strong><span>در سپند:</span> پیشنهاد تأییدشده به مسیر Booking متصل می‌شود.</strong></article>
                <article class="why-problem-card reveal"><span>۰۳</span><h3>دسترسی به مالی پرونده</h3><p>کارشناس مالی باید مبلغ پیشنهاد، دریافت، پرداخت و وضعیت تسویه را در ارتباط با همان Booking بررسی کند.</p><strong><span>در سپند:</span> کنترل مالی در نمای تطبیق Booking انجام می‌شود.</strong></article>
            </div>
        </div>
    </section>

    <section class="why-crm" aria-labelledby="crm-comparison-title">
        <div class="container why-short-comparison">
            <div class="reveal"><span class="why-eyebrow">مقایسه با ابزار عمومی</span><h2 id="crm-comparison-title">در فورواردری، تأیید نرخ آغاز کار عملیاتی است</h2><p>CRM عمومی می‌تواند ارتباط و فرصت فروش را مدیریت کند. هنگام ارزیابی برای شرکت فورواردری، بررسی کنید پس از تأیید نرخ، اطلاعات مسیر و محموله چگونه به Booking، عملیات و مالی می‌رسند؛ این نقطه، دامنه تخصصی سپند است.</p></div>
            <nav class="why-comparison-links reveal" aria-label="راهنماهای مقایسه"><a href="{{ route('compare.sepand-other-transport-software') }}">مقایسه TMS، CRM و نرم‌افزار مالی برای شرکت حمل</a><a href="{{ route('compare.index') }}">بررسی گزینه‌های دیگر در مرکز مقایسه</a></nav>
        </div>
    </section>

    <section class="why-metrics" aria-labelledby="metrics-title">
        <div class="container">
            <header class="why-section-head is-light reveal"><span>معیار تصمیم خرید</span><h2 id="metrics-title">شاخص‌هایی که می‌توانید قبل و بعد از استقرار بسنجید</h2><p>برای هر شاخص، دامنه پرونده‌ها و بازه زمانی یکسان تعریف کنید تا مقایسه قابل اتکا باشد.</p></header>
            <div class="why-metric-grid why-three-metrics">@foreach($evaluationMetrics as $metric)<article class="why-metric-card reveal"><span>{{ $metric['code'] }}</span><h3>{{ $metric['title'] }}</h3><p>{{ $metric['text'] }}</p></article>@endforeach</div>
        </div>
    </section>

    <section class="why-pillars" id="demo-checklist" aria-labelledby="demo-title">
        <div class="container">
            <header class="why-section-head reveal"><span>چک‌لیست ارزیابی</span><h2 id="demo-title">در دموی سپند چه چیزهایی را بررسی کنید؟</h2><p>یک استعلام یا پرونده نمونه همراه داشته باشید و این سه کار را در محصول دنبال کنید.</p></header>
            <div class="why-pillar-grid why-demo-grid">
                <article class="why-pillar-card reveal"><div class="why-pillar-number">۰۱</div><h3>استعلام بدون اقدام بعدی</h3><p>ببینید مدیر فروش چگونه استعلام بدون مسئول، موعد یا اقدام بعدی را پیدا می‌کند و کار بعدی کجا ثبت می‌شود.</p></article>
                <article class="why-pillar-card reveal"><div class="why-pillar-number">۰۲</div><h3>انتقال پیشنهاد به رزرو</h3><p>یک پیشنهاد تأییدشده را تا Booking دنبال کنید و مشخص کنید کدام اطلاعات مشتری، مسیر و محموله به عملیات منتقل می‌شوند.</p></article>
                <article class="why-pillar-card reveal"><div class="why-pillar-number">۰۳</div><h3>دریافت و پرداخت همان پرونده</h3><p>در نمای مالی همان Booking، مبلغ Offer، دریافت‌ها، پرداخت‌ها، نرخ تبدیل و وضعیت تسویه را بررسی کنید.</p></article>
            </div>
        </div>
    </section>

    <section class="why-audience" aria-labelledby="audience-title">
        <div class="container">
            <header class="why-section-head reveal"><span>تناسب محصول</span><h2 id="audience-title">سپند برای چه شرکت‌هایی مناسب است؟</h2><p>مزایای سپند برای شرکت‌های فورواردری زمانی قابل ارزیابی است که فروش، عملیات و مالی روی یک جریان مشترک کار کنند.</p></header>
            <div class="why-fit-compact reveal"><p><strong>سپند را بررسی کنید اگر</strong> شرکت شما استعلام و نرخ‌دهی دارد، پیشنهاد تأییدشده را به Booking و عملیات تحویل می‌دهد و مالی باید دریافت و پرداخت همان پرونده را کنترل کند.</p><p><strong>راهکار ساده‌تر را بررسی کنید اگر</strong> فقط ثبت تماس مشتری یا حسابداری مستقل می‌خواهید و Booking یا عملیات حمل در دامنه کار شما نیست.</p></div>
            <div class="why-purchase-paths reveal"><p>برای شناخت دامنه کامل، <a href="{{ route('product') }}">معرفی کامل محصول</a> را ببینید. برای آشنایی با داستان و شیوه همکاری، صفحه <a href="{{ route('about') }}">درباره سپند</a> را بخوانید. عبارت عمومی <a href="{{ route('home') }}">نرم‌افزار حمل‌ونقل بین‌المللی</a> در صفحه اصلی معرفی شده است.</p></div>
        </div>
    </section>

    <section class="cta-wrap why-final-cta" id="purchase-next-steps">
        <div class="container"><div class="cta reveal"><div class="cta-copy"><h2>فرایند واقعی شرکت خود را در سپند دنبال کنید</h2><p>یک استعلام یا Booking نمونه آماده کنید تا مسیر پیگیری، تحویل به عملیات و کنترل مالی آن در جلسه دمو بررسی شود.</p><nav class="why-final-links" aria-label="اطلاعات پیش از خرید"><a href="{{ route('pricing') }}">مشاهده تعرفه‌ها</a><a href="{{ route('solutions.on-premise') }}">بررسی نصب روی سرور شرکت</a><a href="{{ route('product') }}">معرفی کامل محصول</a></nav></div><div class="why-final-actions"><a class="btn" href="{{ $consultationUrl }}" data-ga-event="cta_click" data-ga-label="why_bottom_consultation">درخواست دموی فرایند شرکت شما</a></div></div></div>
    </section>
@endsection
