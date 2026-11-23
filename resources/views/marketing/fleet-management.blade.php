@extends('layouts.marketing')

@php
    $breadcrumb = [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'صفحه اصلی', 'item' => route('home')],
        ['@type' => 'ListItem', 'position' => 2, 'name' => 'راهکارها', 'item' => route('solutions.index')],
        ['@type' => 'ListItem', 'position' => 3, 'name' => $page['nav_title'], 'item' => $canonical],
    ];
@endphp

@push('head')
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        ['@type' => 'WebPage', '@id' => $canonical.'#webpage', 'url' => $canonical, 'name' => $title, 'description' => $description, 'inLanguage' => 'fa-IR', 'dateModified' => config('site_platform_solutions.updated_at'), 'breadcrumb' => ['@id' => $canonical.'#breadcrumb'], 'mainEntity' => [['@id' => $canonical.'#software'], ['@id' => $canonical.'#faq']]],
        ['@type' => 'SoftwareApplication', '@id' => $canonical.'#software', 'name' => 'نرم‌افزار مدیریت ناوگان حمل‌ونقل سپند', 'applicationCategory' => 'BusinessApplication', 'operatingSystem' => 'Web', 'url' => $canonical, 'description' => $description, 'featureList' => ['مدیریت خودرو و راننده', 'کنترل ظرفیت وزن، حجم و پالت', 'کنترل اعتبار مدارک خودرو و راننده', 'کنترل تداخل بازه تخصیص', 'کنترل سازگاری راننده و نوع خودرو']],
        ['@type' => 'BreadcrumbList', '@id' => $canonical.'#breadcrumb', 'itemListElement' => $breadcrumb],
        ['@type' => 'FAQPage', '@id' => $canonical.'#faq', 'mainEntity' => array_map(static fn (array $faq): array => ['@type' => 'Question', 'name' => $faq['q'], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['a']]], $page['faqs'])],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endpush

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/marketing-platform-solutions.css') }}?v=20261107-1">
<link rel="stylesheet" href="{{ asset('assets/css/marketing-fleet-management.css') }}?v=20261122-1">
@endpush

@section('content')
<section class="fm-hero"><div class="container fm-hero-grid">
    <div class="fm-hero-copy reveal">
        <nav class="breadcrumb" aria-label="مسیر صفحه"><a href="{{ route('home') }}">صفحه اصلی</a><span>/</span><a href="{{ route('solutions.index') }}">راهکارها</a><span>/</span><span>{{ $page['nav_title'] }}</span></nav>
        <span class="fm-eyebrow">{{ $page['eyebrow'] }}</span><h1>{{ $page['h1'] }}</h1>
        <p>برای نوبت فردای خروج بار از بندرعباس هنوز یک کامیون لازم دارید. یک خودرو ظرفیت لازم را دارد، اما وضعیت سرویس آن باید بررسی شود. خودروی دوم آزاد است، ولی اعتبار مدرک راننده برای روز اعزام روشن نیست. اگر این اطلاعات در فایل‌ها و پیام‌های جدا باشند، انتخاب خودرو با چند تماس و بررسی دوباره انجام می‌شود.</p>
        <p>در سپند می‌توانید مشخصات خودرو و راننده، ظرفیت، اعتبار مدارک و وضعیت جاری آن‌ها را پیش از تخصیص بررسی کنید. سپس گزینه آماده را برای مرحله برنامه‌ریزی اعزام معرفی کنید؛ ثبت نهایی کنترل‌های ظرفیت، مدارک و تداخل را دوباره اجرا می‌کند.</p>
        <div class="hero-actions"><a class="btn btn-primary" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="fleet_management_hero_demo">درخواست دموی مدیریت ناوگان</a><a class="btn btn-outline" href="#fleet-example">مشاهده مثال سه گزینه</a></div>
    </div>
    <aside class="fm-question reveal"><span>سؤال محوری مدیر ناوگان</span><strong>کدام خودرو و راننده برای نوبت فردا آماده‌اند؟</strong><ul><li>ظرفیت و تجهیز با بار سازگار است؟</li><li>مدارک در تاریخ شروع مأموریت معتبرند؟</li><li>خودرو یا راننده Trip هم‌زمان ندارد؟</li><li>وضعیت خودرو maintenance نیست؟</li></ul></aside>
</div></section>

<section class="section fm-example" id="fleet-example" aria-labelledby="fleet-example-title"><div class="container">
    <header class="section-head reveal"><span class="section-label">مثال آموزشی</span><h2 class="section-title" id="fleet-example-title">بررسی سه گزینه برای یک جای خالی در نوبت فردا</h2><p class="section-sub">این سناریو ادامه برنامه اعزام چندنوبتی است. تعداد کامیون موردنیاز هر روز یا شیفت در <a href="{{ route('solutions.truck-movement-planning') }}">برنامه‌ریزی حرکت و تأمین کامیون</a> مشخص می‌شود؛ اینجا فقط آمادگی یک گزینه باقی‌مانده بررسی می‌شود.</p></header>
    <div class="fm-example-grid">
        <div class="fm-table-wrap reveal" role="region" aria-label="جدول آموزشی بررسی آمادگی سه گزینه ناوگان" tabindex="0"><table><caption>نمونه آموزشی؛ وضعیت‌ها متعلق به تصویر محصول نیستند</caption><thead><tr><th>گزینه</th><th>وضعیت</th><th>اقدام مدیر ناوگان</th></tr></thead><tbody>
            <tr><th>کامیون ۱</th><td><span class="fm-state is-warning">نیازمند بررسی سرویس</span><p>ظرفیت مناسب دارد، اما برای سرویس برنامه‌ریزی شده است.</p></td><td>زمان آزادشدن خودرو بررسی شود. نسخه فعلی فقط وضعیت maintenance را هنگام تخصیص مسدود می‌کند؛ برنامه‌ریز مستقل سرویس دوره‌ای در نسخه بررسی‌شده تأیید نشد.</td></tr>
            <tr><th>کامیون ۲ و راننده</th><td><span class="fm-state is-danger">مدرک تأییدنشده</span><p>خودرو آزاد است، اما اعتبار مدرک راننده برای روز اعزام هنوز تأیید نشده است.</p></td><td>تاریخ مدرک و Policy آن بررسی شود. مدرک منقضیِ دارای گزینه «مانع تخصیص» ثبت نهایی را رد می‌کند.</td></tr>
            <tr><th>کامیون ۳ و راننده</th><td><span class="fm-state is-ready">آماده معرفی</span><p>ظرفیت مناسب، مدارک معتبر و نبود تداخل در نوبت موردنظر.</p></td><td>گزینه برای تخصیص به برنامه‌ریز اعزام معرفی شود؛ سرویس تخصیص کنترل‌ها را هنگام ثبت دوباره اجرا می‌کند.</td></tr>
        </tbody></table></div>
        <figure class="fm-primary-shot reveal"><a href="{{ asset('assets/images/marketing/live/fleet-compliance-control.png') }}" target="_blank" rel="noopener"><img src="{{ asset('assets/images/marketing/live/fleet-compliance-control.png') }}" width="1264" height="600" loading="eager" alt="نمای واقعی مرکز فرمان سپند با Vehicle Master، Driver Profile، وضعیت ناوگان و کنترل Trip"></a><figcaption><span>شاهد محصول 01 · Product Evidence</span><strong>نمای واقعی مدیریت خودرو و راننده</strong><p>فرم‌های Vehicle Master، Driver Profile و Trip Assignment و کارت‌های وضعیت ناوگان و اعتبار مدارک راننده در تصویر دیده می‌شوند. وضعیت‌های فرضی سه کامیون جدول داخل این تصویر نیستند.</p></figcaption></figure>
    </div>
    <div class="fm-example-cta reveal"><a class="btn btn-primary" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="fleet_management_example_demo">آمادگی خودرو و راننده را در دموی سپند بررسی کنید</a></div>
</div></section>

<section class="section soft fm-evidence" aria-labelledby="evidence-title"><div class="container">
    <header class="section-head reveal"><span class="section-label">Product Evidence · شواهد محصول</span><h2 class="section-title" id="evidence-title">کدام داده برای بررسی آمادگی ناوگان قبل از اعزام وجود دارد؟</h2><p class="section-sub">تصاویر از نسخه فعلی سپند هستند؛ کپشن هر تصویر مرز اطلاعات قابل مشاهده را روشن می‌کند.</p></header>
    <div class="fm-evidence-grid">
        <figure class="fm-shot reveal"><a href="{{ asset('assets/images/marketing/modules/screenshots/operations-calendar-month.webp') }}" target="_blank" rel="noopener"><img src="{{ asset('assets/images/marketing/modules/screenshots/operations-calendar-month.webp') }}" width="1600" height="769" loading="lazy" alt="تقویم واقعی حرکت محموله‌ها و نوبت‌های برنامه‌ریزی‌شده در سپند"></a><figcaption><span>شاهد محصول 02</span><strong>زمینه زمانی حرکت‌ها</strong><p>تقویم تاریخ حرکت محموله‌ها را نشان می‌دهد. کنترل تداخل واقعی خودرو و راننده هنگام ثبت Assignment، روی بازه شروع و پایان انجام می‌شود.</p></figcaption></figure>
        <figure class="fm-shot reveal"><a href="{{ asset('assets/images/marketing/modules/screenshots/document-attachment-upload.webp') }}" target="_blank" rel="noopener"><img src="{{ asset('assets/images/marketing/modules/screenshots/document-attachment-upload.webp') }}" width="1600" height="900" loading="lazy" alt="پنجره واقعی بارگذاری فایل مدرک در پرونده سپند"></a><figcaption><span>شاهد محصول 03</span><strong>ثبت فایل مدرک</strong><p>این تصویر فقط بارگذاری فایل را تأیید می‌کند. نوع مدرک، تاریخ انقضا، روزهای هشدار و گزینه مانع تخصیص در فرم تخصصی Compliance ثبت می‌شوند و در این تصویر دیده نمی‌شوند.</p></figcaption></figure>
    </div>
</div></section>

<section class="section fm-controls" id="operational-depth" aria-labelledby="controls-title"><div class="container">
    <header class="section-head reveal"><span class="section-label">Operational Depth · کنترل پیش از تخصیص</span><h2 class="section-title" id="controls-title">نمایش، هشدار یا جلوگیری از تخصیص؛ رفتار هر کنترل چیست؟</h2></header>
    <div class="fm-control-grid">
        <article class="reveal"><span>ظرفیت و تجهیز</span><h3>کنترل مسدودکننده</h3><p>ظرفیت وزن، حجم و پالت و نوع تجهیز در پرونده خودرو ثبت می‌شوند. اگر نیاز بار از ظرفیت بیشتر باشد یا تجهیز سازگار نباشد، تخصیص ثبت نمی‌شود.</p></article>
        <article class="reveal"><span>مدارک اصلی</span><h3>کنترل تاریخ روز اعزام</h3><p>انقضای بیمه و مدرک اصلی خودرو و تاریخ گواهینامه، گذرنامه یا مجوز راننده با شروع Trip مقایسه می‌شوند و انقضا مانع تخصیص است.</p></article>
        <article class="reveal"><span>مدارک کنترلی</span><h3>Policy قابل انتخاب</h3><p>برای مدرک تاریخ‌دار می‌توان روزهای هشدار و گزینه «مدرک منقضی مانع تخصیص شود» را ثبت کرد. هشدار ۳۰روزه در نمای راننده دیده می‌شود؛ مسدودسازی به فعال‌بودن Policy وابسته است.</p></article>
        <article class="reveal"><span>Availability · دسترس‌پذیری</span><h3>تداخل بازه و وضعیت</h3><p>Trip فعال هم‌زمان برای خودرو یا راننده مانع ثبت می‌شود. خودروی دارای وضعیت maintenance نیز رد می‌شود؛ وجود تقویم مستقل تعمیرات پیشرفته تأیید نشد.</p></article>
        <article class="reveal"><span>سازگاری راننده</span><h3>نوع خودروی مجاز</h3><p>نوع خودروهای مجاز در پروفایل راننده ثبت می‌شود و ناسازگاری با نوع خودرو، تخصیص را رد می‌کند.</p></article>
        <article class="reveal"><span>مرحله بعد</span><h3>تخصیص به اعزام زمینی</h3><p>گزینه آماده در <a href="{{ route('solutions.fleet-dispatch-planning') }}">برنامه‌ریزی تخصیص خودرو و راننده و کنترل تداخل</a> به اعزام و Shipment متصل می‌شود.</p></article>
    </div>
    <p class="fm-boundary reveal"><strong>دامنه و کاربرد راهکار:</strong> این صفحه روی مدیریت خودرو و راننده و کنترل اعتبار مدارک خودرو و راننده متمرکز است. GPS، تله‌ماتیک، ثبت تعمیر، قطعه، کارکرد و برنامه نگهداری پیشرفته در جریان بررسی‌شده این نسخه تأیید نشدند.</p>
</div></section>

<section class="section soft" id="solution-faq" aria-labelledby="faq-title"><div class="container fm-faq-layout"><div class="reveal"><span class="section-label">پرسش‌های مدیر ناوگان</span><h2 class="section-title" id="faq-title">سؤال‌های رایج درباره نرم‌افزار مدیریت ناوگان حمل‌ونقل</h2><p>پاسخ‌ها از مدل داده، فرم مرکز فرمان و سرویس واقعی ثبت تخصیص استخراج شده‌اند.</p></div><div class="faq">@foreach($page['faqs'] as $faq)<details class="reveal"><summary>{{ $faq['q'] }}</summary><p>{{ $faq['a'] }}</p></details>@endforeach</div></div></section>

<section class="cta-wrap"><div class="container"><div class="cta reveal"><div class="cta-copy"><h2>{{ $page['cta_title'] }}</h2><p>{{ $page['cta_text'] }}</p></div><div class="cta-action"><a class="btn" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="fleet_management_bottom_demo">{{ $page['cta_button'] }}</a></div></div></div></section>
@endsection
