@extends('layouts.marketing')

@php
    $title = 'نرم‌افزار مدیریت حمل‌ونقل | راهنمای انتخاب جامع';
    $description = 'راهنمای انتخاب نرم‌افزار مدیریت حمل‌ونقل با معیارهای عمومی CRM، نرخ، عملیات، مالی، اسناد، گزارش‌گیری، امنیت و پشتیبانی از حمل چندوجهی.';
    $canonical = route('compare.best-transport-software');
    $criteria = [
        ['title' => 'CRM و مدیریت ارتباط با مشتری', 'description' => 'پرونده مشتری، سابقه ارتباط، مسئول پیگیری و فرصت‌های فروش باید در یک نمای مشترک و قابل جست‌وجو قرار گیرند.', 'href' => route('site.modules.show', ['module' => 'crm'])],
        ['title' => 'مدیریت نرخ و تعرفه', 'description' => 'ثبت، اعتبارسنجی، مقایسه و بازیابی نرخ‌ها باید با قواعد تجاری و دسترسی‌های سازمان هماهنگ باشد.', 'href' => route('site.modules.show', ['module' => 'pricing-sales'])],
        ['title' => 'مدیریت عملیات', 'description' => 'وضعیت کار، مسئول هر مرحله، موعدها، تأخیرها و استثناهای عملیاتی باید در یک جریان قابل پیگیری باشند.', 'href' => route('site.modules.show', ['module' => 'transport-operations'])],
        ['title' => 'مالی، هزینه و درآمد', 'description' => 'درآمد، هزینه، دریافت و پرداخت باید به خدمت یا پرونده مربوط متصل و برای واحد مالی قابل کنترل باشند.', 'href' => route('site.modules.show', ['module' => 'finance-accounting'])],
        ['title' => 'مدیریت اسناد', 'description' => 'نسخه جاری، تأیید، مهلت، مسئول و ارتباط هر سند با مشتری و عملیات را بررسی کنید.', 'href' => route('site.modules.show', ['module' => 'document-management'])],
        ['title' => 'گزارش‌گیری و کنترل مدیریتی', 'description' => 'گزارش‌ها باید از نمای کلان تا رکورد سازنده عدد قابل پیگیری باشند و گلوگاه، عملکرد و نتیجه مالی را نشان دهند.', 'href' => route('site.modules.show', ['module' => 'workflow-tasks'])],
        ['title' => 'حمل چندوجهی و یکپارچگی داده', 'description' => 'پوشش دریایی، هوایی، زمینی و ریلی را همراه با تبادل داده میان فروش، عملیات، مالی و پرتال مشتری بسنجید.', 'href' => route('site.modules.show', ['module' => 'customer-portal-tracking'])],
        ['title' => 'امنیت، استقرار و هزینه کل', 'description' => 'سطح دسترسی، پشتیبان‌گیری، تعهد خدمت، انتقال داده، آموزش، اتصال‌ها و هزینه تغییرات آینده را مکتوب مقایسه کنید.', 'href' => route('pricing')],
    ];
    $faqs = [
        ['question' => 'نرم‌افزار مدیریت حمل‌ونقل مناسب چه ویژگی‌هایی دارد؟', 'answer' => 'راهکار مناسب باید داده مشتری، نرخ، عملیات، اسناد، مالی و گزارش‌ها را متناسب با اندازه و روش‌های حمل سازمان یکپارچه کند و از ورود دوباره اطلاعات بکاهد.'],
        ['question' => 'در ارزیابی نرم‌افزار مدیریت حمل‌ونقل چه چیزی را آزمایش کنیم؟', 'answer' => 'یک خدمت واقعی را از ثبت درخواست و نرخ تا اجرا، کنترل سند، ثبت مالی و گزارش مدیریتی پیش ببرید و نقاط دستی، دسترسی‌ها و خروجی هر مرحله را ثبت کنید.'],
        ['question' => 'هزینه نرم‌افزار مدیریت حمل‌ونقل چگونه مقایسه شود؟', 'answer' => 'تعداد کاربران و قابلیت‌ها را کنار زیرساخت، انتقال داده، آموزش، پشتیبانی، اتصال‌ها، سفارشی‌سازی و هزینه مالکیت چندساله قرار دهید.'],
        ['question' => 'آیا یک نرم‌افزار عمومی حمل برای شرکت فورواردری کافی است؟', 'answer' => 'نه همیشه. شرکت فورواردر معمولاً به گردش‌کار تخصصی استعلام، درخواست نرخ، پیشنهاد، رزرو، هماهنگی نماینده و حمل‌کننده، اسناد House و Master و سود هر محموله نیاز دارد که باید جداگانه ارزیابی شود.'],
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
            'dateModified' => '2026-09-08',
            'isPartOf' => ['@id' => route('compare.index').'#webpage'],
            'about' => ['@type' => 'Thing', 'name' => 'انتخاب نرم‌افزار مدیریت حمل‌ونقل'],
            'significantLink' => array_merge(
                [route('compare.index'), route('compare.best-freight-forwarding-software'), route('pricing'), route('consultation.create')],
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
                ['@type' => 'ListItem', 'position' => 3, 'name' => 'راهنمای نرم‌افزار مدیریت حمل‌ونقل', 'item' => $canonical],
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
            <h1>نرم‌افزار مدیریت حمل‌ونقل را چگونه انتخاب کنیم؟</h1>
            <p>این راهنما معیارهای عمومی انتخاب یک سامانه یکپارچه برای مدیریت مشتری، نرخ، عملیات، مالی، اسناد، گزارش‌گیری و حمل چندوجهی را بررسی می‌کند. نیازهای تخصصی شرکت‌های فورواردری در راهنمای جداگانه ارزیابی شده‌اند.</p>
            <div class="hero-actions"><a class="btn btn-primary" href="#selection-checklist">مشاهده چک‌لیست انتخاب</a><a class="btn btn-outline" href="{{ route('compare.index') }}">همه مقایسه‌ها</a></div>
        </div>
        <div class="hero-art comparison-hero-art reveal" role="img" aria-label="چک‌لیست انتخاب نرم‌افزار مدیریت حمل‌ونقل"><div class="hub-visual"><span>راهنمای انتخاب</span><strong>تناسب با فرایند<br>مهم‌تر از شعار</strong><ul><li>معیارهای عمومی</li><li>هزینه کل مالکیت</li><li>تعهد فنی مکتوب</li></ul></div></div>
    </div>
</section>

<section class="section" id="selection-checklist" aria-labelledby="selection-checklist-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">چک‌لیست انتخاب</span><h2 class="section-title" id="selection-checklist-title">هشت معیار عمومی برای ارزیابی نرم‌افزار مدیریت حمل‌ونقل</h2><p class="section-sub">این معیارها برای مقایسه کلی سامانه‌های حمل طراحی شده‌اند؛ برای هر مورد وضعیت «نمایش داده شد»، «تعهد شد» یا «نیازمند بررسی» را ثبت کنید.</p></div>
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
    <div class="container"><div class="section-head reveal"><span class="section-label">سناریوی ارزیابی</span><h2 class="section-title" id="demo-scenario-title">یک فرایند عمومی حمل را از درخواست تا گزارش اجرا کنید</h2></div><ol class="workflow-grid best-workflow"><li class="workflow-card reveal"><span class="workflow-number">۱</span><h3>مشتری و درخواست</h3><p>مشتری، نوع خدمت، مسیر و نیاز او را ثبت کنید و سابقه پیگیری را ببینید.</p></li><li class="workflow-card reveal"><span class="workflow-number">۲</span><h3>نرخ و برنامه اجرا</h3><p>نرخ‌ها و شرایط خدمت را بررسی و نتیجه تأییدشده را بدون ورود دوباره به عملیات منتقل کنید.</p></li><li class="workflow-card reveal"><span class="workflow-number">۳</span><h3>عملیات و اسناد</h3><p>وضعیت، مسئول، مهلت و نسخه سند را ثبت کنید و یک تأخیر یا تغییر را مدیریت کنید.</p></li><li class="workflow-card reveal"><span class="workflow-number">۴</span><h3>مالی و گزارش مدیریتی</h3><p>هزینه، درآمد، وضعیت تسویه و گزارش عملکرد را در سطح خدمت و سازمان بررسی کنید.</p></li></ol></div>
</section>

<section class="section" aria-labelledby="forwarding-guide-title">
    <div class="container"><div class="comparison-answer reveal"><span class="section-label">مسیر تخصصی</span><h2 id="forwarding-guide-title">اگر شرکت شما فورواردر است، گردش‌کار تخصصی را جداگانه بسنجید</h2><p>معیارهای عمومی این صفحه نقطه شروع هستند؛ اما مدیریت استعلام، درخواست نرخ، پیشنهاد، رزرو، هماهنگی نماینده و حمل‌کننده، اسناد House و Master و سود هر محموله به ارزیابی تخصصی‌تری نیاز دارد.</p><div class="answer-actions"><a class="btn btn-primary" href="{{ route('compare.best-freight-forwarding-software') }}">راهنمای انتخاب نرم‌افزار تخصصی فورواردری</a></div></div></div>
</section>

<section class="section soft" aria-labelledby="pricing-deployment-title"><div class="container"><div class="comparison-answer reveal"><span class="section-label">قیمت و استقرار</span><h2 id="pricing-deployment-title">قیمت پایین‌تر الزاماً هزینه کل کمتر نیست</h2><p>قیمت را برای دامنه و دوره یکسان مقایسه کنید: لایسنس یا اشتراک، زیرساخت، کاربران، ماژول‌ها، Migration، آموزش، اتصال‌ها، سفارشی‌سازی، پشتیبانی، Backup و ارتقا. سپس مدل Cloud یا On-Premise، محل داده، SLA و مسئولیت بازیابی را به تصمیم اضافه کنید.</p><div class="answer-actions"><a class="btn btn-primary" href="{{ route('pricing') }}">روش محاسبه تعرفه سپند</a><a class="btn btn-outline dark" href="{{ route('consultation.create') }}">دریافت پیشنهاد متناسب</a></div></div></div></section>

@include('marketing.partials.comparison-cluster-links', ['comparisons' => $comparisons])

<section class="section soft" aria-labelledby="best-faq-title"><div class="container"><div class="section-head reveal"><span class="section-label">پرسش‌های متداول</span><h2 class="section-title" id="best-faq-title">سؤالات متداول انتخاب نرم‌افزار مدیریت حمل‌ونقل</h2></div><div class="faq">@foreach($faqs as $faq)<details class="reveal"><summary>{{ $faq['question'] }}</summary><p>{{ $faq['answer'] }}</p></details>@endforeach</div></div></section>

<section class="cta-wrap"><div class="container"><div class="cta reveal"><div class="cta-copy"><h2>معیارهای عمومی را در دموی سپند ارزیابی کنید</h2><p>یک فرایند واقعی شرکت خود را انتخاب کنید تا ارتباط مشتری، نرخ، عملیات، اسناد، مالی و گزارش‌ها در همان سناریو بررسی شود.</p></div><div class="cta-action"><a class="btn" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="best_transport_software_consultation">درخواست دمو سپند</a></div></div></div></section>
@endsection
