@extends('layouts.marketing')

@php
    $title = 'بهترین نرم‌افزار حمل‌ونقل بین‌المللی | راهنمای انتخاب';
    $description = 'راهنمای انتخاب بهترین نرم‌افزار حمل‌ونقل بین‌المللی با معیارهای CRM، نرخ‌دهی، Booking، عملیات، اسناد، مالی، استقرار، قیمت و سناریوی دمو.';
    $canonical = route('compare.best-transport-software');
    $criteria = [
        ['title' => 'CRM و مدیریت مشتری', 'description' => 'پرونده مشتری، سوابق ارتباط، مسئول پیگیری، استعلام‌ها و ارزش مالی مشتری باید در یک نمای قابل استفاده قرار گیرند.', 'href' => route('site.modules.show', ['module' => 'crm'])],
        ['title' => 'استعلام، نرخ‌دهی و فروش', 'description' => 'بانک نرخ، اعتبار نرخ، مقایسه تأمین‌کننده، پیشنهاد فروش و تبدیل نتیجه به پرونده اجرایی را با سناریوی واقعی بسنجید.', 'href' => route('site.modules.show', ['module' => 'pricing-sales'])],
        ['title' => 'Booking و عملیات حمل', 'description' => 'اطلاعات فروش نباید دوباره وارد شود؛ رویدادها، مسئولیت‌ها، تأخیرها و وضعیت هر پرونده باید قابل پیگیری باشند.', 'href' => route('site.modules.show', ['module' => 'booking'])],
        ['title' => 'اسناد و کنترل نسخه', 'description' => 'نسخه جاری، تأیید، مهلت، مسئول و اتصال سند به مشتری و محموله را بررسی کنید.', 'href' => route('site.modules.show', ['module' => 'document-management'])],
        ['title' => 'مالی و سود پرونده', 'description' => 'چندارزی بودن، درآمد، هزینه، دریافت، پرداخت و سود واقعی باید به همان پرونده حمل متصل شوند.', 'href' => route('site.modules.show', ['module' => 'finance-accounting'])],
        ['title' => 'Workflow، Task و گزارش', 'description' => 'مسئول، مهلت، یادآوری، گلوگاه‌ها و گزارش‌های نقش‌محور را در حجم کاری واقعی تیم آزمایش کنید.', 'href' => route('site.modules.show', ['module' => 'workflow-tasks'])],
        ['title' => 'پرتال مشتری و رهگیری', 'description' => 'دقیقاً مشخص کنید مشتری چه اطلاعات عملیاتی، استعلامی و مالی را با چه سطح امنیتی می‌بیند.', 'href' => route('site.modules.show', ['module' => 'customer-portal-tracking'])],
        ['title' => 'استقرار، امنیت و هزینه کل', 'description' => 'Cloud یا On-Premise، Backup، SLA، Migration، آموزش، Integration و هزینه تغییرات آینده را مکتوب مقایسه کنید.', 'href' => route('pricing')],
    ];
    $faqs = [
        ['question' => 'بهترین نرم‌افزار حمل‌ونقل بین‌المللی کدام است؟', 'answer' => 'یک برنده عمومی برای همه شرکت‌ها وجود ندارد. گزینه مناسب راهکاری است که سناریوهای واقعی، روش‌های حمل، سطح کنترل، استقرار و بودجه شرکت شما را با کمترین دوباره‌کاری پوشش دهد.'],
        ['question' => 'در دموی نرم‌افزار حمل‌ونقل چه چیزی را تست کنیم؟', 'answer' => 'یک پرونده را از مشتری و استعلام تا نرخ، Booking، عملیات، اسناد، هزینه، درآمد، سود و نمایش اطلاعات به مشتری اجرا کنید و هر مرحله دستی یا نیازمند ورود دوباره داده را ثبت کنید.'],
        ['question' => 'قیمت نرم‌افزار حمل‌ونقل چگونه مقایسه شود؟', 'answer' => 'تعداد کاربران و ماژول‌ها را کنار استقرار، زیرساخت، Migration، آموزش، پشتیبانی، توسعه، Integration و هزینه مالکیت چندساله قرار دهید.'],
        ['question' => 'آیا فهرست امکانات برای انتخاب کافی است؟', 'answer' => 'خیر. عنوان یکسان قابلیت ممکن است گردش کار، سطح دسترسی و خروجی متفاوتی داشته باشد. نمایش در دمو، مستند فنی و تعهد قرارداد معیارهای قابل اتکاتری هستند.'],
    ];
@endphp

@push('head')
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'WebPage',
            '@id' => $canonical.'#webpage',
            'name' => $title,
            'description' => $description,
            'url' => $canonical,
            'inLanguage' => 'fa-IR',
            'dateModified' => '2026-08-18',
            'isPartOf' => ['@id' => route('compare.index').'#webpage'],
            'about' => ['@type' => 'Thing', 'name' => 'انتخاب نرم‌افزار مدیریت حمل‌ونقل بین‌المللی'],
            'significantLink' => array_merge(
                [route('compare.index'), route('pricing'), route('consultation.create')],
                array_map(static fn (array $item): string => route($item['route']), $comparisons),
                array_column($criteria, 'href'),
            ),
        ],
        [
            '@type' => 'BreadcrumbList',
            '@id' => $canonical.'#breadcrumb',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'صفحه اصلی', 'item' => route('home')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'مرکز مقایسه', 'item' => route('compare.index')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => 'بهترین نرم‌افزار حمل‌ونقل بین‌المللی', 'item' => $canonical],
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
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endpush

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/marketing-comparison.css') }}?v=20260818-2">
@endpush

@section('content')
<section class="page-hero comparison-hub-hero">
    <div class="container hero-inner">
        <div class="hero-copy reveal">
            <div class="breadcrumb"><a href="{{ route('home') }}">صفحه اصلی</a><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg><a href="{{ route('compare.index') }}">مرکز مقایسه</a><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg><span>راهنمای انتخاب</span></div>
            <h1>بهترین نرم‌افزار حمل‌ونقل بین‌المللی را چگونه انتخاب کنیم؟</h1>
            <p>بهترین نرم‌افزار برای همه شرکت‌ها یکسان نیست. انتخاب حرفه‌ای با تطبیق فرایند واقعی فروش، Booking، عملیات، اسناد و مالی با محصول، بررسی چهار روش حمل، اجرای سناریوی ثابت در دمو و محاسبه هزینه کل استقرار انجام می‌شود.</p>
            <div class="hero-actions"><a class="btn btn-primary" href="#selection-checklist">مشاهده چک‌لیست انتخاب</a><a class="btn btn-outline" href="{{ route('compare.index') }}">همه مقایسه‌ها</a></div>
        </div>
        <div class="hero-art comparison-hero-art reveal" role="img" aria-label="چک‌لیست انتخاب بهترین نرم‌افزار حمل‌ونقل بین‌المللی"><div class="hub-visual"><span>Selection Guide</span><strong>تناسب فرایند<br>مهم‌تر از شعار</strong><ul><li>سناریوی واقعی</li><li>هزینه کل مالکیت</li><li>تعهد فنی مکتوب</li></ul></div></div>
    </div>
</section>

<section class="section" id="selection-checklist" aria-labelledby="selection-checklist-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">چک‌لیست انتخاب</span><h2 class="section-title" id="selection-checklist-title">هشت معیار برای ارزیابی نرم‌افزار حمل‌ونقل</h2><p class="section-sub">برای هر معیار، وضعیت «نمایش داده شد»، «در قرارداد تعهد شد» یا «نیازمند بررسی» ثبت کنید.</p></div>
        <div class="capability-detail-grid">
            @foreach($criteria as $index => $criterion)
                <article class="capability-detail-card reveal"><span class="capability-index">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span><h3><a href="{{ $criterion['href'] }}">{{ $criterion['title'] }}</a></h3><p>{{ $criterion['description'] }}</p></article>
            @endforeach
        </div>
    </div>
</section>

<section class="section soft" aria-labelledby="transport-modes-check-title">
    <div class="container"><div class="section-head reveal"><span class="section-label">روش‌های حمل</span><h2 class="section-title" id="transport-modes-check-title">پوشش روش حمل را با پرونده واقعی بسنجید</h2><p class="section-sub">وجود نام یک روش حمل کافی نیست؛ فیلدها، رویدادها، اسناد، هزینه‌ها و گزارش همان روش را بررسی کنید.</p></div><div class="transport-check-grid"><a href="{{ route('site.transport-modes.show', ['mode' => 'sea']) }}"><strong>حمل دریایی</strong><span>کانتینر، مسیر، اسناد و رویدادها</span></a><a href="{{ route('site.transport-modes.show', ['mode' => 'air']) }}"><strong>حمل هوایی</strong><span>رزرو، بارنامه، وزن و زمان‌بندی</span></a><a href="{{ route('site.transport-modes.show', ['mode' => 'road']) }}"><strong>حمل زمینی</strong><span>خودرو، راننده، مرز و هزینه سفر</span></a><a href="{{ route('site.transport-modes.show', ['mode' => 'rail']) }}"><strong>حمل ریلی</strong><span>واگن، ایستگاه، مسیر و اسناد ریلی</span></a></div></div>
</section>

<section class="section" aria-labelledby="demo-scenario-title">
    <div class="container"><div class="section-head reveal"><span class="section-label">سناریوی دمو</span><h2 class="section-title" id="demo-scenario-title">دمو را از Lead تا سود پرونده اجرا کنید</h2></div><ol class="workflow-grid best-workflow"><li class="workflow-card reveal"><span class="workflow-number">۱</span><h3>مشتری و استعلام</h3><p>مشتری، مسیر، محموله و درخواست نرخ را ثبت کنید و تاریخچه پیگیری را ببینید.</p></li><li class="workflow-card reveal"><span class="workflow-number">۲</span><h3>نرخ و Booking</h3><p>تأمین‌کننده‌ها را مقایسه، پیشنهاد فروش را تأیید و بدون ورود دوباره به Booking منتقل کنید.</p></li><li class="workflow-card reveal"><span class="workflow-number">۳</span><h3>عملیات و اسناد</h3><p>رویداد، مسئول، مهلت و نسخه سند را ثبت کنید و یک تأخیر یا تغییر را مدیریت کنید.</p></li><li class="workflow-card reveal"><span class="workflow-number">۴</span><h3>مالی، سود و پرتال</h3><p>هزینه و درآمد چندارزی، سود پرونده و اطلاعات مجاز قابل نمایش به مشتری را بررسی کنید.</p></li></ol></div>
</section>

<section class="section soft" aria-labelledby="pricing-deployment-title"><div class="container"><div class="comparison-answer reveal"><span class="section-label">قیمت و استقرار</span><h2 id="pricing-deployment-title">قیمت پایین‌تر الزاماً هزینه کل کمتر نیست</h2><p>قیمت را برای دامنه و دوره یکسان مقایسه کنید: لایسنس یا اشتراک، زیرساخت، کاربران، ماژول‌ها، Migration، آموزش، اتصال‌ها، سفارشی‌سازی، پشتیبانی، Backup و ارتقا. سپس مدل Cloud یا On-Premise، محل داده، SLA و مسئولیت بازیابی را به تصمیم اضافه کنید.</p><div class="answer-actions"><a class="btn btn-primary" href="{{ route('pricing') }}">روش محاسبه تعرفه سپند</a><a class="btn btn-outline dark" href="{{ route('consultation.create') }}">دریافت پیشنهاد متناسب</a></div></div></div></section>

@include('marketing.partials.comparison-cluster-links', ['comparisons' => $comparisons])

<section class="section soft" aria-labelledby="best-faq-title"><div class="container"><div class="section-head reveal"><span class="section-label">FAQ</span><h2 class="section-title" id="best-faq-title">سؤالات متداول انتخاب نرم‌افزار حمل‌ونقل</h2></div><div class="faq">@foreach($faqs as $faq)<details class="reveal"><summary>{{ $faq['question'] }}</summary><p>{{ $faq['answer'] }}</p></details>@endforeach</div></div></section>

<section class="cta-wrap"><div class="container"><div class="cta reveal"><div class="cta-copy"><h2>چک‌لیست را در دموی سپند اجرا کنید</h2><p>یک پرونده واقعی شرکت خودتان را انتخاب کنید تا زنجیره فروش، عملیات، اسناد و مالی در همان سناریو بررسی شود.</p></div><div class="cta-action"><a class="btn" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="best_transport_software_consultation">درخواست دمو سپند</a></div></div></div></section>
@endsection
