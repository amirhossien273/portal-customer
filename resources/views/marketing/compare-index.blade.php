@extends('layouts.marketing')

@php
    $pageName = 'مقایسه و راهنمای انتخاب نرم‌افزار حمل‌ونقل';
    $title = $pageName.' | سپند';
    $description = 'نرم‌افزارهای حمل‌ونقل را از نظر امکانات، گردش کار، هزینه استقرار، آموزش و پشتیبانی بررسی کنید و راهنمای مناسب انتخاب را بیابید.';
    $canonical = route('compare.index');
    $evaluationCriteria = [
        ['number' => '۰۱', 'title' => 'پوشش فرایندها', 'description' => 'بررسی کنید نرم‌افزار کدام مراحل را از ثبت مشتری و استعلام تا عملیات، مالی و بستن پرونده پوشش می‌دهد.'],
        ['number' => '۰۲', 'title' => 'اتصال فروش به عملیات', 'description' => 'مشخص کنید اطلاعات تأییدشده فروش چگونه و با چه میزان ورود دوباره اطلاعات به تیم عملیات می‌رسد.'],
        ['number' => '۰۳', 'title' => 'مدیریت اسناد', 'description' => 'ثبت، نسخه‌بندی، تأیید، مهلت و دسترسی به اسناد را در همان پرونده حمل آزمایش کنید.'],
        ['number' => '۰۴', 'title' => 'مالی چندارزی', 'description' => 'نرخ ارز، هزینه و درآمد، دریافت‌وپرداخت و مانده حساب طرف‌های پرونده را با نمونه واقعی بسنجید.'],
        ['number' => '۰۵', 'title' => 'گزارش سود پرونده', 'description' => 'ببینید سود هر پرونده چگونه محاسبه می‌شود و مدیر تا چه سطحی می‌تواند جزئیات آن را پیگیری کند.'],
        ['number' => '۰۶', 'title' => 'انتقال اطلاعات', 'description' => 'دامنه انتقال اطلاعات قبلی، پاک‌سازی داده‌ها و اتصال به سامانه‌های موردنیاز شرکت را مکتوب کنید.'],
        ['number' => '۰۷', 'title' => 'استقرار', 'description' => 'زمان‌بندی، مسئولیت‌ها، زیرساخت، آزمون نهایی و هزینه‌های اجرای نرم‌افزار را در پیشنهاد رسمی بررسی کنید.'],
        ['number' => '۰۸', 'title' => 'آموزش و پشتیبانی', 'description' => 'روش آموزش کاربران، زمان پاسخ‌گویی، دامنه پشتیبانی و هزینه خدمات پس از راه‌اندازی را روشن کنید.'],
    ];
    $faqs = [
        ['question' => 'چطور نرم‌افزارهای حمل‌ونقل را منصفانه مقایسه کنیم؟', 'answer' => 'یک سناریوی واقعی و یکسان را در همه نرم‌افزارها اجرا کنید و قابلیت نمایش‌داده‌شده، تعهد مکتوب و مورد نیازمند توسعه را جداگانه ثبت کنید.'],
        ['question' => 'اگر درباره یکی از نرم‌افزارها اطلاعات عمومی پیدا نشد چه نتیجه‌ای بگیریم؟', 'answer' => 'نبود اطلاعات عمومی به معنی نبود قابلیت نیست. وجود قابلیت، قیمت و محدودیت‌ها باید با منبع رسمی دارای تاریخ بررسی، جلسه نمایش و پیشنهاد مکتوب تأمین‌کننده تأیید شود.'],
        ['question' => 'آیا این مرکز مقایسه بی‌طرف است؟', 'answer' => 'این مرکز توسط سپند منتشر شده است. برای کاهش جانبداری، پیشنهاد می‌کنیم هر گزینه را با سناریوی یکسان، منابع رسمی و تعهدات مکتوب ارزیابی کنید.'],
    ];
    $listedGuides = collect($hubGuides)->flatMap(static function (array $guide): array {
        return [
            ['title' => $guide['title'], 'route' => $guide['route']],
            ...array_map(static fn (array $link): array => [
                'title' => $link['label'],
                'route' => $link['route'],
            ], $guide['secondary_links']),
        ];
    })->values()->all();
@endphp

@push('head')
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'CollectionPage',
            '@id' => $canonical.'#webpage',
            'name' => $pageName,
            'description' => $description,
            'url' => $canonical,
            'inLanguage' => 'fa-IR',
            'isPartOf' => ['@id' => route('home').'#website'],
            'publisher' => ['@type' => 'Organization', 'name' => 'سپند', 'url' => route('home')],
            'mainEntity' => ['@id' => $canonical.'#guides'],
        ],
        [
            '@type' => 'BreadcrumbList',
            '@id' => $canonical.'#breadcrumb',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'صفحه اصلی', 'item' => route('home')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => $pageName, 'item' => $canonical],
            ],
        ],
        [
            '@type' => 'ItemList',
            '@id' => $canonical.'#guides',
            'name' => 'راهنماهای مقایسه و انتخاب نرم‌افزار حمل‌ونقل',
            'itemListElement' => array_map(static fn (array $item, int $index): array => [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'name' => $item['title'],
                'url' => route($item['route']),
            ], $listedGuides, array_keys($listedGuides)),
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
<link rel="stylesheet" href="{{ asset('assets/css/marketing-comparison.css') }}?v=20261114-1">
@endpush

@section('content')
<section class="page-hero comparison-hub-hero">
    <div class="container hero-inner">
        <div class="hero-copy reveal">
            <div class="breadcrumb"><a href="{{ route('home') }}">صفحه اصلی</a><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg><span>مرکز مقایسه</span></div>
            <h1>{{ $pageName }}</h1>
            <p>در این مرکز می‌توانید نرم‌افزارهای حمل‌ونقل را از نظر امکانات، گردش کار، هزینه استقرار، آموزش و پشتیبانی بررسی کنید و راهنمای متناسب با تصمیم خود را پیدا کنید.</p>
            <div class="hero-actions"><a class="btn btn-primary" href="#comparison-pages">انتخاب راهنمای مناسب</a><a class="btn btn-outline" href="{{ route('compare.best-transport-software') }}">مشاهده معیارهای انتخاب</a></div>
        </div>
        <div class="hero-art comparison-hero-art reveal" role="img" aria-label="راهنمای مقایسه و انتخاب نرم‌افزار حمل‌ونقل">
            <div class="hub-visual">
                <span>راهنمای انتخاب</span>
                <strong>یک فرایند واقعی،<br>چند گزینه</strong>
                <ul><li>پوشش فرایندهای شرکت</li><li>هزینه اجرا و استقرار</li><li>آموزش و پشتیبانی</li></ul>
            </div>
        </div>
    </div>
</section>

<aside class="comparison-publisher-strip" aria-label="درباره ناشر و روش بررسی اطلاعات">
    <div class="container">
        <strong>درباره این مرکز</strong>
        <p>این مرکز مقایسه توسط سپند منتشر شده است. اطلاعات مربوط به سایر نرم‌افزارها فقط بر پایه منابع رسمی و با تاریخ بررسی بیان می‌شود. نبود اطلاعات عمومی به معنی نبود قابلیت نیست؛ قابلیت‌ها، قیمت و محدودیت‌ها را در جلسه رسمی و پیشنهاد مکتوب هر تأمین‌کننده تأیید کنید.</p>
    </div>
</aside>

<section class="section comparison-hub-pages" id="comparison-pages" aria-labelledby="comparison-pages-title">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label">راهنماهای مقایسه و انتخاب</span>
            <h2 class="section-title" id="comparison-pages-title">کدام راهنما به پرسش شما پاسخ می‌دهد؟</h2>
            <p class="section-sub">بر اساس موضوع تصمیم‌گیری، یکی از راهنماهای زیر را انتخاب کنید. هر راهنما پرسش‌ها و معیارهای همان حوزه را توضیح می‌دهد.</p>
        </div>
        <div class="hub-card-grid">
            @foreach($hubGuides as $index => $guide)
                <article class="hub-card reveal">
                    <span class="hub-card-number">{{ ['۰۱', '۰۲', '۰۳', '۰۴'][$index] }}</span>
                    <small>{{ $guide['eyebrow'] }}</small>
                    <h3>{{ $guide['title'] }}</h3>
                    <p class="hub-card-question"><strong>پرسش این راهنما:</strong> {{ $guide['question'] }}</p>
                    <p>{{ $guide['description'] }}</p>
                    <div class="hub-card-actions">
                        <a class="hub-card-primary" href="{{ route($guide['route']) }}">{{ $guide['link_label'] }} <span aria-hidden="true">←</span></a>
                        @foreach($guide['secondary_links'] as $link)
                            <a class="hub-card-secondary" href="{{ route($link['route']) }}">{{ $link['label'] }}</a>
                        @endforeach
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="section soft comparison-hub-criteria" aria-labelledby="comparison-method-title">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label">چارچوب سریع ارزیابی</span>
            <h2 class="section-title" id="comparison-method-title">در ارزیابی هر نرم‌افزار این ۸ موضوع را بررسی کنید</h2>
            <p class="section-sub">برای همه گزینه‌ها یک سناریوی واقعی و یکسان اجرا کنید و نتیجه نمایش، تعهد مکتوب و نیاز به توسعه را جداگانه ثبت کنید.</p>
        </div>
        <div class="criteria-grid">
            @foreach($evaluationCriteria as $criterion)
                <article class="criteria-card reveal">
                    <span class="criteria-number">{{ $criterion['number'] }}</span>
                    <h3>{{ $criterion['title'] }}</h3>
                    <p>{{ $criterion['description'] }}</p>
                </article>
            @endforeach
        </div>
        <aside class="verification-note reveal">
            <strong>نکته درباره اطلاعات رقبا:</strong>
            قابلیت‌ها، قیمت و محدودیت‌های هر نرم‌افزار فقط با منبع معتبر و تاریخ بررسی قابل استناد است. نبود اطلاعات عمومی را معادل نبود قابلیت در نظر نگیرید.
        </aside>
    </div>
</section>

<section class="section" aria-labelledby="hub-faq-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">پرسش‌های رایج</span><h2 class="section-title" id="hub-faq-title">پیش از مقایسه نرم‌افزارها بدانید</h2></div>
        <div class="faq">@foreach($faqs as $faq)<details class="reveal"><summary>{{ $faq['question'] }}</summary><p>{{ $faq['answer'] }}</p></details>@endforeach</div>
    </div>
</section>

<section class="cta-wrap"><div class="container"><div class="cta reveal"><div class="cta-copy"><h2>سپند را با فرایند شرکت خودتان ارزیابی کنید</h2><p>یک پرونده واقعی را از استعلام تا عملیات و مالی در جلسه دمو بررسی کنید و دامنه قابلیت‌ها، استقرار و پشتیبانی موردنیازتان را مکتوب تحویل بگیرید.</p></div><div class="cta-action"><a class="btn" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="comparison_hub_consultation">درخواست جلسه دمو</a></div></div></div></section>
@endsection
