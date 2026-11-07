@extends('layouts.marketing')

@php
    $problems = [
        ['title' => 'نرخ‌ها بین ایمیل و فایل پخش‌اند', 'impact' => 'نسخه درست و آخرین شرایط به حافظه کارشناس وابسته می‌شود.', 'action' => 'نرخ را با تأمین‌کننده، مسیر، روش حمل، خدمت، ارز، واحد و توضیحات در Rate Master ثبت کنید.', 'output' => 'یک رکورد دارای کد و قابل جست‌وجو برای استفاده دوباره.'],
        ['title' => 'اعتبار نرخ روشن نیست', 'impact' => 'یک نرخ قدیمی ممکن است مبنای محاسبه تازه قرار بگیرد.', 'action' => 'تاریخ شروع و پایان را ثبت و تاریخ محاسبه را در Rate Finder مشخص کنید.', 'output' => 'فقط نرخ فعال و داخل بازه تاریخ در نتایج منطبق دیده می‌شود.'],
        ['title' => 'مقایسه فقط با مبلغ انجام می‌شود', 'impact' => 'تفاوت ارز، مسیر، خدمت، زمان حمل، Free Time، پرداخت و عملکرد تأمین‌کننده نادیده می‌ماند.', 'action' => 'نرخ منطبق را کنار نمای مقایسه تأمین‌کنندگان و شرایط پیشنهاد بررسی کنید.', 'output' => 'تصمیم چندمعیاره؛ پایین‌ترین عدد لزوماً انتخاب نهایی نیست.'],
        ['title' => 'هزینه جانبی و شرط مصرف جا می‌افتد', 'impact' => 'جمع محاسبه‌شده با شرایط واقعی خرید فاصله می‌گیرد.', 'action' => 'کد، شرح، مبلغ و روش محاسبه ثابت، واحدی یا روزانه را ثبت و اجباری‌بودن قلم را مشخص کنید.', 'output' => 'Breakdown شامل کرایه و اجزای هزینه، با نمایش جداگانه قلم‌ها.'],
        ['title' => 'اطلاعات برای پیشنهاد دوباره وارد می‌شود', 'impact' => 'کپی دستی می‌تواند ارز، واحد یا یکی از اجزای نرخ را تغییر دهد.', 'action' => 'خروجی Rate Finder را به‌عنوان مرجع انتخاب نرخ بازبینی و پیشنهاد تأمین‌کننده را در پرونده استعلام ثبت کنید.', 'output' => 'کد نرخ، مسیر، تأمین‌کننده، پلکان، جمع و ارز قابل مشاهده‌اند؛ انتقال خودکار Tariff به اقلام Quotation در نسخه بررسی‌شده ادعا نمی‌شود.'],
    ];

    $faqs = $page['faqs'];
    $canonicalUrl = $canonical;
@endphp

@push('head')
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        ['@type' => 'SoftwareApplication', '@id' => $canonicalUrl.'#software', 'name' => 'راهکار مدیریت نرخ و تعرفه حمل‌ونقل سپند', 'applicationCategory' => 'BusinessApplication', 'operatingSystem' => 'Web', 'url' => $canonicalUrl, 'description' => $description, 'featureList' => ['Rate Master مسیرمحور', 'کنترل بازه اعتبار', 'Rate Break و Minimum Charge', 'اجزای هزینه جانبی']],
        ['@type' => 'FAQPage', '@id' => $canonicalUrl.'#faq', 'mainEntity' => array_map(static fn (array $faq): array => ['@type' => 'Question', 'name' => $faq['q'], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['a']]], $faqs)],
        ['@type' => 'BreadcrumbList', '@id' => $canonicalUrl.'#breadcrumb', 'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'صفحه اصلی', 'item' => route('home')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'راهکارها', 'item' => route('solutions.index')],
            ['@type' => 'ListItem', 'position' => 3, 'name' => 'مدیریت نرخ و تعرفه', 'item' => $canonicalUrl],
        ]],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endpush

@include('marketing.partials.module-rich-styles')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/marketing-rate-management.css') }}?v=20261107-1">
@endpush

@section('content')
<section class="page-hero rm-hero">
    <div class="container hero-inner">
        <div class="hero-copy crm-hero-copy reveal">
            <nav class="breadcrumb" aria-label="مسیر راهنما"><a href="{{ route('home') }}">صفحه اصلی</a><span>/</span><a href="{{ route('solutions.index') }}">راهکارها</a><span>/</span><span>مدیریت نرخ و تعرفه</span></nav>
            <span class="section-label">RATE MANAGEMENT</span>
            <h1 class="module-hero-title"><span class="module-hero-title-main">راهکار مدیریت نرخ و تعرفه</span><span class="module-hero-title-accent">حمل‌ونقل</span></h1>
            <p class="crm-lead">برای یک مسیر، چند تأمین‌کننده نرخ فرستاده‌اند؛ بخشی در ایمیل و بخشی در فایل مانده، تاریخ اعتبار همه روشن نیست و Surcharge، Transit Time و Free Time آن‌ها با هم فرق دارد. سپند این داده‌ها را به مرجعی ساختاریافته برای جست‌وجو و مقایسه تبدیل می‌کند.</p>
            <div class="hero-actions"><a class="btn btn-primary" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="rate_management_hero_demo">درخواست دموی مدیریت نرخ</a><a class="btn btn-outline" href="#rate-problems">ببینید سپند چگونه کمک می‌کند</a></div>
        </div>
        <figure class="rm-hero-shot reveal"><img src="{{ asset('assets/images/marketing/live/rate-management.png') }}" width="1264" height="600" alt="صفحه واقعی مدیریت نرخ و تعرفه سپند"><figcaption><strong>نمای واقعی محصول:</strong> فیلتر نرخ‌های معتبر و Rate Finder در سپند</figcaption></figure>
    </div>
</section>

<section class="section" id="rate-problems" aria-labelledby="problems-title"><div class="container">
    <header class="section-head reveal"><span class="section-label">از مسئله تا خروجی</span><h2 class="section-title" id="problems-title">پنج نقطه‌ای که نرخ پراکنده را به تصمیم پرریسک تبدیل می‌کند</h2><p class="section-sub">در هر مرحله، مسئله، اثر آن، اقدام کاربر و خروجی قابل مشاهده از هم جدا شده‌اند.</p></header>
    <div class="rm-problem-grid">@foreach($problems as $problem)<article class="rm-problem-card reveal"><span>۰{{ $loop->iteration }}</span><h3>{{ $problem['title'] }}</h3><dl><div><dt>اثر</dt><dd>{{ $problem['impact'] }}</dd></div><div><dt>اقدام کاربر</dt><dd>{{ $problem['action'] }}</dd></div><div><dt>خروجی قابل مشاهده</dt><dd>{{ $problem['output'] }}</dd></div></dl></article>@endforeach</div>
</div></section>

<section class="section soft" id="product-evidence" aria-labelledby="evidence-title"><div class="container">
    <header class="section-head reveal"><span class="section-label">Product Evidence</span><h2 class="section-title" id="evidence-title">سه نمای محصول، سه بخش متفاوت از تصمیم نرخ</h2><p class="section-sub">تصاویر زیر اسکرین‌شات واقعی‌اند؛ داده‌های داخل آن‌ها نمونه محیط ثبت‌شده‌اند و به‌عنوان نرخ روز بازار تفسیر نمی‌شوند.</p></header>
    <div class="rm-evidence-list">
        <figure class="rm-evidence reveal"><img src="{{ asset('assets/images/marketing/live/rate-management.png') }}" width="1264" height="600" loading="lazy" alt="فیلتر و محاسبه نرخ معتبر در سپند"><figcaption><span>شاهد محصول 01</span><strong>Rate Master و Rate Finder:</strong> روش حمل، تأمین‌کننده، تاریخ، مبدأ، مقصد و مقدار برای پیدا کردن نرخ معتبر به کار می‌روند.</figcaption></figure>
        <figure class="rm-evidence reveal"><img src="{{ asset('assets/images/marketing/modules/screenshots/pricing-supplier-comparison.webp') }}" width="1600" height="800" loading="lazy" alt="مقایسه واقعی تأمین‌کنندگان در سپند"><figcaption><span>شاهد محصول 02</span><strong>مقایسه تأمین‌کنندگان:</strong> نرخ خرید در کنار مسیر، اعتبار، Free Time و داده عملکردی موجود بررسی می‌شود.</figcaption></figure>
        <figure class="rm-evidence reveal"><img src="{{ asset('assets/images/marketing/modules/screenshots/pricing-proposed-rates.webp') }}" width="1600" height="800" loading="lazy" alt="نمای نرخ‌های پیشنهادی مشابه در استعلام سپند"><figcaption><span>شاهد محصول 03</span><strong>پیشنهادهای مشابه:</strong> سابقه نرخ‌های ثبت‌شده در زمینه استعلام دیده می‌شود؛ نبود نتیجه نیز صریح نمایش داده می‌شود.</figcaption></figure>
    </div>
</div></section>

<section class="section rm-scenario" id="sample-comparison" aria-labelledby="scenario-title"><div class="container">
    <header class="section-head reveal"><span class="section-label">سناریوی آموزشی</span><h2 class="section-title" id="scenario-title">سناریوی آموزشی نینگبو تا بندرعباس؛ سه پیشنهاد برای کانتینر ۴۰ فوت</h2><p class="section-sub">ابتدا درخواست و پیشنهادها ثبت می‌شوند؛ سپس مسیر، خدمت و مبنای قیمت همسان می‌شود و مبلغ، ارز، اعتبار و شرایط کنار هم قرار می‌گیرند.</p></header>
    <div class="rm-table reveal"><table><caption>این اعداد نرخ بازار نیستند و فقط برای توضیح جریان مقایسه ساخته شده‌اند.</caption><thead><tr><th>پیشنهاد</th><th>مبلغ پایه</th><th>اعتبار</th><th>Transit Time</th><th>Free Time</th><th>شرط/هزینه جانبی</th></tr></thead><tbody><tr><th>تأمین‌کننده الف</th><td>۱٬۲۸۰ USD / Container</td><td>۱۲ روز</td><td>۲۲ روز</td><td>۱۴ روز</td><td>THC در مبلغ لحاظ شده</td></tr><tr><th>تأمین‌کننده ب</th><td>۱٬۱۸۰ USD / Container</td><td>۵ روز</td><td>۲۹ روز</td><td>۷ روز</td><td>THC جداگانه: ۱۶۰ USD</td></tr><tr><th>تأمین‌کننده ج</th><td>۱٬۱۴۰ EUR / Container</td><td>۱۸ روز</td><td>۲۵ روز</td><td>۱۰ روز</td><td>پرداخت پیش از بارگیری</td></tr></tbody></table></div>
    <div class="rm-decision reveal"><strong>پایین‌ترین مبلغ به‌تنهایی برنده نیست.</strong><p>کارشناس پس از همسان‌کردن ارز و مبنای قیمت، اعتبار، زمان حمل، Free Time، هزینه‌های اجباری، پرداخت و سابقه عملکرد را بررسی می‌کند؛ سپس نرخ منتخب را به‌عنوان مبنای پیشنهاد تأمین‌کننده در استعلام به کار می‌گیرد.</p></div>
</div></section>

<section class="section dark-section" aria-labelledby="terms-title"><div class="container">
    <header class="section-head reveal"><span class="section-label">Operational Depth</span><h2 class="section-title" id="terms-title">چهار مفهوم، با معنای ساده در کار روزانه</h2></header>
    <div class="rm-term-grid"><article><h3>Rate Master</h3><p>رکورد مرجع نرخ با تأمین‌کننده، مسیر، خدمت، ارز، واحد و بازه اعتبار.</p></article><article><h3>Rate Break</h3><p>پلکان قیمت واحد برای بازه‌های مختلف مقدار یا وزن؛ مثلاً قیمت متفاوت از یک حد به بالا.</p></article><article><h3>Minimum Charge</h3><p>کف مبلغ قرارداد؛ اگر محاسبه کمتر باشد، این حداقل اعمال می‌شود.</p></article><article><h3>Charge Breakdown</h3><p>تفکیک کرایه پایه و هزینه‌های جانبی ثابت، واحدی یا روزانه؛ فقط اقلام اجباری در جمع خودکار موتور وارد می‌شوند.</p></article></div>
</div></section>

<section class="section" aria-labelledby="kpi-title"><div class="container">
    <header class="section-head reveal"><span class="section-label">اندازه‌گیری استقرار</span><h2 class="section-title" id="kpi-title">شاخص‌های پیشنهادی برای استقرار</h2><p class="section-sub">این موارد پیشنهاد سنجش‌اند، نه گزارش‌های آماده‌ای که وجودشان در محصول ادعا شود. هدف و خط مبنا باید با داده شرکت شما تعیین شود.</p></header>
    <div class="rm-kpi-grid">@foreach($page['metrics'] as $metric)<article class="reveal"><span>KPI ۰{{ $loop->iteration }}</span><h3>{{ $metric }}</h3></article>@endforeach</div>
</div></section>

<section class="section soft" aria-labelledby="boundary-title"><div class="container">
    <header class="section-head reveal"><span class="section-label">دامنه و کاربرد راهکار</span><h2 class="section-title" id="boundary-title">برای هر مسئله، صفحه تخصصی خودش را ببینید</h2></header>
    <div class="rm-related-grid"><a href="{{ route('site.modules.show', ['module' => 'pricing-sales']) }}"><span>استعلام تا Quotation</span><h3>ماژول نرخ‌دهی و فروش</h3><p>ثبت درخواست، پیشنهاد تأمین‌کننده و آماده‌سازی پیشنهاد فروش.</p></a><a href="{{ route('solutions.platform.show', ['solution' => 'supplier-management']) }}"><span>داده و ارزیابی Supplier</span><h3>مدیریت تأمین‌کنندگان</h3><p>پروفایل، پوشش خدمت و سابقه عملکرد تأمین‌کننده.</p></a><a href="{{ route('solutions.freight-sales-automation') }}"><span>پس از ارسال پیشنهاد</span><h3>پیگیری فروش حمل</h3><p>مسئول، موعد و اقدام بعدی مذاکره.</p></a><a href="{{ route('site.modules.show', ['module' => 'booking']) }}"><span>پس از پذیرش</span><h3>مدیریت Booking</h3><p>ادامه پرونده تأییدشده در رزرو و عملیات.</p></a></div>
</div></section>

<section class="section" id="solution-faq" aria-labelledby="faq-title"><div class="container crm-faq-layout"><div class="crm-faq-intro reveal"><span class="section-label">پرسش‌های متداول</span><h2 id="faq-title">پرسش‌های رایج درباره مدیریت نرخ</h2><p>مرز قابلیت فعلی و اصطلاحات اصلی را کوتاه و روشن مرور کنید.</p></div><div class="faq">@foreach($faqs as $faq)<details class="reveal"><summary>{{ $faq['q'] }}</summary><p>{{ $faq['a'] }}</p></details>@endforeach</div></div></section>

<section class="cta-wrap"><div class="container"><div class="cta reveal"><div class="cta-copy"><h2>نرخ‌های یک استعلام نمونه را در سپند مقایسه کنید</h2><p>یک مسیر و چند پیشنهاد واقعی خود را آماده کنید تا اعتبار، مبنای قیمت و اجزای هزینه در جلسه دمو بررسی شوند.</p></div><div class="cta-action"><a class="btn" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="rate_management_bottom_demo">درخواست دموی مدیریت نرخ</a></div></div></div></section>
@endsection
