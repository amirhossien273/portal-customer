@extends('layouts.marketing')

@php
    $decisionSteps = [
        ['title' => 'نرخ منقضی میان نتایج مانده', 'problem' => 'کارشناس ممکن است پیشنهاد قدیمی را مبنای قیمت تازه قرار دهد.', 'action' => 'تاریخ محاسبه در Rate Finder مشخص می‌شود و فقط تعرفه فعال و داخل بازه اعتبار برمی‌گردد.', 'output' => 'اعتبار گزینه پیش از اعلام قیمت دیده و کنترل می‌شود.'],
        ['title' => 'پیشنهادها مبنای یکسان ندارند', 'problem' => 'ارز، واحد، مسیر، نوع خدمت یا تجهیزات با هم فرق دارند.', 'action' => 'مسیر، خدمت، تجهیزات، ارز و واحد مبنای مقایسه همسان و موارد نامشخص علامت‌گذاری می‌شوند.', 'output' => 'مقایسه نرخ خرید حمل دریایی بر پایه داده‌های هم‌معنا انجام می‌شود.'],
        ['title' => 'کرایه پایه همه هزینه را نشان نمی‌دهد', 'problem' => 'Surcharge یا هزینه مقصد ممکن است جدا از نرخ پایه اعلام شده باشد.', 'action' => 'اقلام هزینه و اجباری‌بودن آن‌ها در Breakdown بازبینی و هزینه نامشخص از ایجنت تأیید می‌شود.', 'output' => 'کارشناس می‌داند کدام مبلغ قطعی و کدام قلم نیازمند تأیید است.'],
        ['title' => 'ارزان‌ترین عدد با نیاز مشتری سازگار نیست', 'problem' => 'زمان حمل، مهلت رایگان یا سابقه اجرا می‌تواند تصمیم را تغییر دهد.', 'action' => 'نرخ خرید در کنار زمان حمل، Free Time و داده عملکردی موجود تأمین‌کننده بررسی می‌شود.', 'output' => 'دلیل انتخاب نرخ به شرایط استعلام وصل می‌ماند، نه فقط پایین‌ترین عدد.'],
    ];

    $faqs = $page['faqs'];
    $canonicalUrl = $canonical;
@endphp

@push('head')
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        ['@type' => 'WebPage', '@id' => $canonicalUrl.'#webpage', 'url' => $canonicalUrl, 'name' => $title, 'description' => $description, 'inLanguage' => 'fa-IR', 'primaryImageOfPage' => ['@type' => 'ImageObject', 'url' => $image]],
        ['@type' => 'SoftwareApplication', '@id' => $canonicalUrl.'#software', 'name' => 'نرم‌افزار مدیریت نرخ حمل‌ونقل سپند', 'applicationCategory' => 'BusinessApplication', 'operatingSystem' => 'Web', 'url' => $canonicalUrl, 'description' => $description, 'featureList' => ['جست‌وجوی نرخ معتبر', 'مقایسه نرخ خرید ایجنت‌ها', 'کنترل بازه اعتبار نرخ', 'بررسی هزینه‌های جانبی', 'مقایسه زمان حمل و Free Time']],
        ['@type' => 'FAQPage', '@id' => $canonicalUrl.'#faq', 'mainEntity' => array_map(static fn (array $faq): array => ['@type' => 'Question', 'name' => $faq['q'], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['a']]], $faqs)],
        ['@type' => 'BreadcrumbList', '@id' => $canonicalUrl.'#breadcrumb', 'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'صفحه اصلی', 'item' => route('home')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'راهکارها', 'item' => route('solutions.index')],
            ['@type' => 'ListItem', 'position' => 3, 'name' => 'مدیریت نرخ حمل‌ونقل', 'item' => $canonicalUrl],
        ]],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endpush

@include('marketing.partials.module-rich-styles')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/marketing-rate-management.css') }}?v=20261122-1">
@endpush

@section('content')
<section class="page-hero rm-hero">
    <div class="container hero-inner">
        <div class="hero-copy crm-hero-copy reveal">
            <nav class="breadcrumb" aria-label="مسیر راهنما"><a href="{{ route('home') }}">صفحه اصلی</a><span>/</span><a href="{{ route('solutions.index') }}">راهکارها</a><span>/</span><span>مدیریت نرخ حمل‌ونقل</span></nav>
            <span class="section-label">RATE MANAGEMENT</span>
            <h1 class="module-hero-title">نرم‌افزار مدیریت و مقایسه نرخ حمل‌ونقل بین‌المللی</h1>
            <p class="crm-lead">برای یک استعلام حمل، سه ایجنت نرخ داده‌اند. یکی کرایه پایه کمتری دارد، دیگری هزینه مقصد را جدا حساب کرده و اعتبار نرخ سوم تا فرداست. وقتی پیشنهادها در ایمیل، پیام و اکسل پراکنده‌اند، مقایسه آن‌ها قبل از اعلام قیمت به مشتری زمان می‌برد و ممکن است بخشی از هزینه یا شرایط حمل جا بماند.</p>
            <p class="crm-lead">در سپند، نرخ خرید، تاریخ اعتبار، هزینه‌های جانبی، زمان حمل (Transit Time) و مهلت رایگان (Free Time) را کنار هم می‌بینید. نرخ‌های معتبر مسیر و سرویس موردنظر را پیدا می‌کنید و شرایط هر پیشنهاد را پیش از انتخاب بررسی می‌کنید.</p>
            <div class="hero-actions"><a class="btn btn-primary" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="rate_management_hero_demo">درخواست دموی مدیریت نرخ</a><a class="btn btn-outline" href="#sample-comparison">مشاهده مقایسه سه نرخ</a></div>
        </div>
        <aside class="rm-hero-summary reveal" aria-label="خروجی مورد انتظار مدیر فروش و کارشناس نرخ‌دهی">
            <span>خروجی مورد انتظار</span>
            <strong>یک انتخاب قابل دفاع پیش از قیمت‌دهی</strong>
            <ul><li>نرخ معتبر برای مسیر و خدمت موردنظر</li><li>هزینه‌های روشن و موارد نیازمند تأیید</li><li>زمان حمل و Free Time متناسب با درخواست مشتری</li></ul>
        </aside>
    </div>
</section>

<section class="section rm-scenario" id="sample-comparison" aria-labelledby="scenario-title"><div class="container">
    <header class="section-head reveal"><span class="section-label">مثال آموزشی با اعداد فرضی</span><h2 class="section-title" id="scenario-title">مقایسه سه نرخ برای کانتینر ۴۰ فوت از نینگبو به بندرعباس</h2><p class="section-sub">این جدول برای توضیح تصمیم کارشناس نرخ‌دهی ساخته شده است و نرخ روز بازار یا داده داخل تصویر محصول نیست.</p></header>
    <div class="rm-comparison-layout">
        <div class="rm-comparison-copy">
            <div class="rm-table reveal" role="region" aria-label="جدول مقایسه آموزشی سه نرخ حمل دریایی" tabindex="0"><table>
                <caption>نمونه آموزشی — همه اعداد و نام ایجنت‌ها فرضی هستند</caption>
                <thead><tr><th>ایجنت</th><th>نرخ پایه</th><th>ارز</th><th>هزینه‌های جانبی</th><th>اعتبار نرخ</th><th>زمان حمل</th><th>Free Time</th></tr></thead>
                <tbody>
                    <tr><th>تأمین‌کننده الف</th><td dir="ltr">1,280 / Container</td><td>USD</td><td>THC در مبلغ لحاظ شده</td><td>۱۲ روز دیگر</td><td>۲۲ روز</td><td>۱۴ روز</td></tr>
                    <tr><th>تأمین‌کننده ب</th><td dir="ltr">1,180 / Container</td><td>USD</td><td dir="ltr">THC: 160 USD</td><td>۵ روز دیگر</td><td>۲۹ روز</td><td>۷ روز</td></tr>
                    <tr><th>تأمین‌کننده ج</th><td dir="ltr">1,140 / Container</td><td>EUR</td><td><strong class="rm-needs-confirmation">نیازمند تأیید</strong></td><td>تا فردا</td><td>۲۵ روز</td><td>۱۰ روز</td></tr>
                </tbody>
            </table></div>
            <p class="rm-basis reveal"><strong>مبنای مقایسه:</strong> حمل دریایی FCL یک کانتینر ۴۰ فوت، از بندر نینگبو تا بندرعباس. تبدیل ارز و مالیات در مثال لحاظ نشده است؛ گزینه ج تا تبدیل ارز و تأیید هزینه جانبی، قابل مقایسه نهایی نیست.</p>
            <div class="rm-decision reveal"><strong>انتخاب آموزشی: گزینه الف</strong><p>اگر مشتری زمان حمل کوتاه‌تر و ۱۴ روز Free Time بخواهد، گزینه الف از ب مناسب‌تر است: جمع نرخ پایه و THC گزینه ب به ۱٬۳۴۰ دلار می‌رسد، زمان حمل آن طولانی‌تر و Free Time آن کمتر است. گزینه ج نیز با ارز متفاوت، اعتبار تا فردا و هزینه نامشخص، پیش از انتخاب نیازمند تأیید است.</p></div>
            <div class="hero-actions reveal"><a class="btn btn-primary" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="rate_management_scenario_demo">مقایسه سه نرخ در دموی سپند</a></div>
        </div>
        <figure class="rm-rate-finder-shot reveal"><a href="{{ asset('assets/images/marketing/live/rate-management.png') }}" target="_blank" rel="noopener" aria-label="مشاهده تصویر Rate Finder سپند در اندازه کامل"><img src="{{ asset('assets/images/marketing/live/rate-management.png') }}" width="1264" height="600" loading="eager" alt="نمای واقعی Rate Finder سپند برای فیلتر نرخ معتبر بر اساس روش حمل، تأمین‌کننده، تاریخ، مبدأ و مقصد"></a><figcaption><span>شاهد محصول 01</span><strong>تصویر واقعی از نسخه فعلی سپند:</strong> Rate Finder نرخ منطبق را با روش حمل، تأمین‌کننده، تاریخ محاسبه، مبدأ، مقصد و مقدار جست‌وجو می‌کند. جدول کنار آن یک مثال آموزشی مستقل است.</figcaption></figure>
    </div>
</div></section>

<section class="section soft" id="rate-workflow" aria-labelledby="workflow-title"><div class="container">
    <header class="section-head reveal"><span class="section-label">Operational Depth · مراحل بررسی نرخ</span><h2 class="section-title" id="workflow-title">از نرخ پراکنده تا انتخاب نرخ خرید</h2><p class="section-sub">در مدیریت نرخ حمل بین‌المللی، هر قابلیت باید یک خطای تصمیم را کم کند و خروجی روشنی به کارشناس بدهد.</p></header>
    <div class="rm-problem-grid">@foreach($decisionSteps as $step)<article class="rm-problem-card reveal"><span>۰{{ $loop->iteration }}</span><h3>{{ $step['title'] }}</h3><dl><div><dt>مشکل</dt><dd>{{ $step['problem'] }}</dd></div><div><dt>بررسی در سپند</dt><dd>{{ $step['action'] }}</dd></div><div><dt>خروجی</dt><dd>{{ $step['output'] }}</dd></div></dl></article>@endforeach</div>
    <div class="rm-workflow-note reveal"><p><strong>دامنه و کاربرد راهکار:</strong> پس از انتخاب، فرایند در <a href="{{ route('site.modules.show', ['module' => 'pricing-sales']) }}">ماژول نرخ‌دهی و تبدیل نرخ منتخب به پیشنهاد فروش</a> ادامه پیدا می‌کند. پس از ارسال پیشنهاد نیز مسئول، موعد و اقدام بعدی در <a href="{{ route('solutions.freight-sales-automation') }}">راهکار پیگیری پیشنهادهای فروش حمل</a> دنبال می‌شود.</p></div>
</div></section>

<section class="section" id="product-evidence" aria-labelledby="evidence-title"><div class="container">
    <header class="section-head reveal"><span class="section-label">Product Evidence · شواهد محصول</span><h2 class="section-title" id="evidence-title">مقایسه نرخ ایجنت‌های حمل در نمای فعلی سپند</h2><p class="section-sub">تصویر زیر از نسخه فعلی محصول است. مقدارهای داخل تصویر داده ثبت‌شده همان محیط‌اند و نرخ روز بازار محسوب نمی‌شوند.</p></header>
    <figure class="rm-evidence reveal"><a href="{{ asset('assets/images/marketing/modules/screenshots/pricing-supplier-comparison.webp') }}" target="_blank" rel="noopener" aria-label="مشاهده تصویر مقایسه تأمین‌کنندگان در اندازه کامل"><img src="{{ asset('assets/images/marketing/modules/screenshots/pricing-supplier-comparison.webp') }}" width="1600" height="839" loading="lazy" alt="نمای واقعی مقایسه نرخ خرید ایجنت‌های حمل، اعتبار نرخ، زمان حمل و Free Time در سپند"></a><figcaption><span>شاهد محصول 02</span><strong>نمای واقعی مقایسه تأمین‌کنندگان:</strong> نرخ خرید و ارز، زمان حمل، مسیر، اعتبار نرخ، Free Time و داده عملکردی موجود در کنار هم دیده می‌شوند. علامت خط تیره یعنی آن داده برای پیشنهاد نمایش‌داده‌شده ثبت نشده است.</figcaption></figure>
    <div class="rm-evidence-grid">
        <article class="reveal"><h3>کنترل اعتبار نرخ حمل</h3><p>Rate Master تاریخ شروع و پایان دارد و Rate Finder نرخ فعال و منطبق با تاریخ محاسبه را پیدا می‌کند؛ هشدار مستقل نزدیک انقضا در نسخه بررسی‌شده ادعا نمی‌شود.</p></article>
        <article class="reveal"><span class="rm-evidence-label">شاهد محصول 03</span><h3>هزینه و مبنای محاسبه</h3><p>Currency، Unit، Base Rate، Rate Break &amp; Minimum Charge و هزینه‌های جانبی در ساختار تعرفه نگهداری می‌شوند تا مبنای محاسبه قابل بازبینی باشد.</p></article>
        <article class="reveal"><h3>سابقه اجرای ایجنت</h3><p>برای ارزیابی داده مرجع، پوشش خدمت و کیفیت اجرای تأمین‌کننده، <a href="{{ route('solutions.platform.show', ['solution' => 'supplier-management']) }}">مدیریت و ارزیابی تأمین‌کنندگان حمل</a> را ببینید؛ نمایش سابقه به وجود داده ثبت‌شده وابسته است.</p></article>
    </div>
</div></section>

<section class="section dark-section" aria-labelledby="kpi-title"><div class="container">
    <header class="section-head reveal"><span class="section-label">اندازه‌گیری فرایند</span><h2 class="section-title" id="kpi-title">شاخص‌های قابل‌سنجش برای تیم نرخ‌دهی</h2><p class="section-sub">این موارد پیشنهاد اندازه‌گیری پس از استقرارند، نه آمار نتیجه یا گزارش آماده‌ای که وجود آن در محصول ادعا شود.</p></header>
    <div class="rm-kpi-grid">@foreach($page['metrics'] as $metric)<article class="reveal"><span>KPI ۰{{ $loop->iteration }}</span><h3>{{ $metric }}</h3></article>@endforeach</div>
</div></section>

<section class="section" id="solution-faq" aria-labelledby="faq-title"><div class="container crm-faq-layout"><div class="crm-faq-intro reveal"><span class="section-label">پرسش‌های خریداران</span><h2 id="faq-title">سؤال‌های رایج درباره نرم‌افزار مدیریت نرخ حمل‌ونقل</h2><p>پاسخ‌ها با رفتار تأییدشده Rate Finder و نمای مقایسه فعلی هماهنگ‌اند.</p></div><div class="faq">@foreach($faqs as $faq)<details class="reveal"><summary>{{ $faq['q'] }}</summary><p>{{ $faq['a'] }}</p></details>@endforeach</div></div></section>

<section class="cta-wrap"><div class="container"><div class="cta reveal"><div class="cta-copy"><h2>نرخ‌های یک استعلام واقعی را در دموی سپند مقایسه کنید</h2><p>مسیر، نوع خدمت و سه پیشنهاد ایجنت را آماده کنید تا اعتبار، هزینه‌های جانبی، زمان حمل و Free Time آن‌ها در جلسه دمو بررسی شود.</p></div><div class="cta-action"><a class="btn" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="rate_management_bottom_demo">مقایسه سه نرخ در دموی سپند</a></div></div></div></section>
@endsection
