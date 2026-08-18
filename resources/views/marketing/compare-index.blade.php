@extends('layouts.marketing')

@php
    $title = 'مقایسه نرم‌افزارهای حمل‌ونقل بین‌المللی | سپند';
    $description = 'مرکز مقایسه نرم‌افزار سپند با رویان، سبا سیستم و سایر راهکارهای حمل‌ونقل؛ جدول‌ها، معیارهای انتخاب، موارد نیازمند بررسی و راهنمای دمو.';
    $canonical = route('compare.index');
    $faqs = [
        ['question' => 'چطور یک نرم‌افزار حمل‌ونقل را بی‌طرفانه مقایسه کنیم؟', 'answer' => 'سناریوی یکسانی را از ثبت مشتری و استعلام تا نرخ، Booking، عملیات، اسناد، مالی و گزارش سود در هر محصول اجرا کنید و فقط قابلیت‌های نمایش‌داده‌شده یا تعهدشده در قرارداد را قطعی بدانید.'],
        ['question' => 'آیا اطلاعات صفحات مقایسه جایگزین دمو است؟', 'answer' => 'خیر. اطلاعات عمومی ممکن است کامل یا به‌روز نباشد. نسخه، پلن، استقرار، قیمت، انتقال داده و پشتیبانی باید در دموی رسمی و پیشنهاد مکتوب بررسی شوند.'],
        ['question' => 'برای دریافت قیمت چه اطلاعاتی آماده کنیم؟', 'answer' => 'تعداد کاربران، روش‌های حمل، ماژول‌های لازم، حجم داده مهاجرت، مدل استقرار، اتصال‌های فنی و سطح آموزش و پشتیبانی موردنیاز را مشخص کنید.'],
    ];
@endphp

@push('head')
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'CollectionPage',
            '@id' => $canonical.'#webpage',
            'name' => $title,
            'description' => $description,
            'url' => $canonical,
            'inLanguage' => 'fa-IR',
            'isPartOf' => ['@id' => route('home').'#website'],
            'mainEntity' => ['@id' => $canonical.'#comparisons'],
        ],
        [
            '@type' => 'BreadcrumbList',
            '@id' => $canonical.'#breadcrumb',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'صفحه اصلی', 'item' => route('home')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'مرکز مقایسه نرم‌افزارها', 'item' => $canonical],
            ],
        ],
        [
            '@type' => 'ItemList',
            '@id' => $canonical.'#comparisons',
            'name' => 'صفحات مقایسه نرم‌افزار حمل‌ونقل',
            'itemListElement' => array_map(static fn (array $item, int $index): array => [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'name' => $item['title'],
                'url' => route($item['route']),
            ], $comparisons, array_keys($comparisons)),
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
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endpush

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/marketing-comparison.css') }}?v=20260818-2">
@endpush

@section('content')
<section class="page-hero comparison-hub-hero">
    <div class="container hero-inner">
        <div class="hero-copy reveal">
            <div class="breadcrumb"><a href="{{ route('home') }}">صفحه اصلی</a><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg><span>مرکز مقایسه</span></div>
            <h1>مقایسه نرم‌افزار سپند با سایر نرم‌افزارهای حمل‌ونقل</h1>
            <p>این مرکز برای تصمیم‌گیری مرحله Comparison طراحی شده است: اطلاعات عمومی محصولات را جدا از موارد نیازمند بررسی نشان می‌دهد و کمک می‌کند یک سناریوی ثابت را در دموهای مختلف اجرا کنید. هدف، اعلام برنده عمومی نیست؛ هدف، انتخاب راهکاری است که با فرایند، استقرار و بودجه شرکت شما تطابق بیشتری دارد.</p>
            <div class="hero-actions"><a class="btn btn-primary" href="#comparison-pages">مشاهده مقایسه‌ها</a><a class="btn btn-outline" href="{{ route('compare.best-transport-software') }}">راهنمای انتخاب</a></div>
        </div>
        <div class="hero-art comparison-hero-art reveal" role="img" aria-label="مرکز مقایسه نرم‌افزار سپند با راهکارهای حمل‌ونقل">
            <div class="hub-visual">
                <span>Comparison Hub</span>
                <strong>یک سناریو،<br>چند انتخاب</strong>
                <ul><li>قابلیت‌های تأییدشده</li><li>موارد نیازمند بررسی</li><li>چک‌لیست دمو و قرارداد</li></ul>
            </div>
        </div>
    </div>
</section>

<section class="section comparison-hub-pages" id="comparison-pages" aria-labelledby="comparison-pages-title">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label">صفحات Cluster</span>
            <h2 class="section-title" id="comparison-pages-title">مقایسه موردنظر را انتخاب کنید</h2>
            <p class="section-sub">در مقایسه با رقبا، فقط اطلاعات منتشرشده در منابع رسمی قطعی تلقی شده و بقیه موارد برای بررسی در دمو علامت‌گذاری شده‌اند.</p>
        </div>
        <div class="hub-card-grid">
            @foreach($comparisons as $index => $item)
                <a class="hub-card reveal" href="{{ route($item['route']) }}">
                    <span class="hub-card-number">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                    <small>{{ $item['eyebrow'] }}</small>
                    <h2>{{ $item['title'] }}</h2>
                    <p>{{ $item['description'] }}</p>
                    <b>مشاهده صفحه <span aria-hidden="true">←</span></b>
                </a>
            @endforeach
        </div>
    </div>
</section>

<section class="section soft" aria-labelledby="comparison-method-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">روش ارزیابی</span><h2 class="section-title" id="comparison-method-title">سه اصل برای یک مقایسه قابل اعتماد</h2></div>
        <div class="criteria-grid">
            <article class="criteria-card reveal"><span class="criteria-number">۰۱</span><h3>ادعا را از سند جدا نکنید</h3><p>هر قابلیت را در نسخه قابل خرید، مستند فنی یا قرارداد تأیید کنید؛ شباهت نام ماژول‌ها به معنای یکسان بودن گردش کار نیست.</p></article>
            <article class="criteria-card reveal"><span class="criteria-number">۰۲</span><h3>سناریوی واحد اجرا کنید</h3><p>همان مشتری، مسیر، استعلام، نرخ، Booking، سند و هزینه را در تمام دموها وارد کنید تا دوباره‌کاری و نقاط کور آشکار شوند.</p></article>
            <article class="criteria-card reveal"><span class="criteria-number">۰۳</span><h3>هزینه کل را بسنجید</h3><p>قیمت لایسنس را کنار استقرار، Migration، آموزش، پشتیبانی، توسعه، زیرساخت و هزینه تغییرات آینده قرار دهید.</p></article>
            <article class="criteria-card reveal"><span class="criteria-number">۰۴</span><h3>نتیجه را مکتوب کنید</h3><p>موارد نمایش‌داده‌شده، موارد تعهدشده و موارد نیازمند توسعه را جداگانه ثبت کنید تا تصمیم به برداشت شفاهی وابسته نباشد.</p></article>
        </div>
    </div>
</section>

<section class="section" aria-labelledby="hub-faq-title">
    <div class="container"><div class="section-head reveal"><span class="section-label">FAQ</span><h2 class="section-title" id="hub-faq-title">پرسش‌های متداول مرکز مقایسه</h2></div><div class="faq">@foreach($faqs as $faq)<details class="reveal"><summary>{{ $faq['question'] }}</summary><p>{{ $faq['answer'] }}</p></details>@endforeach</div></div>
</section>

<section class="cta-wrap"><div class="container"><div class="cta reveal"><div class="cta-copy"><h2>سپند را با سناریوی واقعی شرکت خودتان بررسی کنید</h2><p>در جلسه دمو می‌توانید فرایند فعلی خود را مطرح کنید و پاسخ قابلیت‌ها، استقرار و هزینه را متناسب با همان دامنه دریافت کنید.</p></div><div class="cta-action"><a class="btn" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="comparison_hub_consultation">درخواست دمو و مشاوره</a></div></div></div></section>
@endsection
