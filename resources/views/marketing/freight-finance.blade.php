@extends('layouts.marketing')

@php
    $exampleRows = [
        ['stage' => 'زمان فروش', 'revenue' => '۴٬۸۰۰ دلار', 'cost' => '۴٬۰۰۰ دلار هزینه برآوردی', 'profit' => '۸۰۰ دلار سود برآوردی'],
        ['stage' => 'پس از شناسایی هزینه جانبی و پیش از فاکتور', 'revenue' => '۴٬۸۰۰ دلار', 'cost' => '۴٬۲۵۰ دلار با احتساب تعهد ۲۵۰ دلاری', 'profit' => '۵۵۰ دلار سود موقت'],
        ['stage' => 'پس از ثبت فاکتور نهایی', 'revenue' => '۴٬۸۰۰ دلار', 'cost' => '۴٬۳۲۰ دلار هزینه واقعی', 'profit' => '۴۸۰ دلار سود نهایی مثال'],
    ];
    $breadcrumb = [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'صفحه اصلی', 'item' => route('home')],
        ['@type' => 'ListItem', 'position' => 2, 'name' => 'راهکارها', 'item' => route('solutions.index')],
        ['@type' => 'ListItem', 'position' => 3, 'name' => $page['nav_title'], 'item' => $canonical],
    ];
    $howToSteps = [
        ['@type' => 'HowToStep', 'position' => 1, 'name' => 'کنترل مبنای فروش', 'text' => 'درآمد پیشنهادی و هزینه برآوردی پرونده را کنترل کنید.'],
        ['@type' => 'HowToStep', 'position' => 2, 'name' => 'شناسایی هزینه‌های قطعی‌نشده', 'text' => 'هزینه در انتظار تأیید و Accrualهای باز را از مبلغ واقعی جدا کنید.'],
        ['@type' => 'HowToStep', 'position' => 3, 'name' => 'تطبیق مبلغ واقعی', 'text' => 'فاکتور نهایی را با ردیف Accrual مرتبط و Variance را بررسی کنید.'],
        ['@type' => 'HowToStep', 'position' => 4, 'name' => 'تصمیم برای بستن پرونده', 'text' => 'نرخ تبدیل، ردیف‌های باز و علت اختلاف سود را پیش از بستن پرونده تأیید کنید.'],
    ];
@endphp

@push('head')
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        ['@type' => 'WebPage', '@id' => $canonical.'#webpage', 'url' => $canonical, 'name' => $title, 'description' => $description, 'inLanguage' => 'fa-IR', 'dateModified' => config('site_platform_solutions.updated_at'), 'breadcrumb' => ['@id' => $canonical.'#breadcrumb'], 'mainEntity' => [['@id' => $canonical.'#software'], ['@id' => $canonical.'#profit-review'], ['@id' => $canonical.'#faq']]],
        ['@type' => 'SoftwareApplication', '@id' => $canonical.'#software', 'name' => 'راهکار محاسبه سود پرونده حمل سپند', 'applicationCategory' => 'BusinessApplication', 'operatingSystem' => 'Web', 'url' => $canonical, 'description' => $description, 'featureList' => array_column($page['capabilities'], 'title')],
        ['@type' => 'BreadcrumbList', '@id' => $canonical.'#breadcrumb', 'itemListElement' => $breadcrumb],
        ['@type' => 'HowTo', '@id' => $canonical.'#profit-review', 'name' => 'بررسی اختلاف سود پرونده حمل', 'step' => $howToSteps],
        ['@type' => 'FAQPage', '@id' => $canonical.'#faq', 'mainEntity' => array_map(static fn (array $faq): array => ['@type' => 'Question', 'name' => $faq['q'], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['a']]], $page['faqs'])],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endpush

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/marketing-platform-solutions.css') }}?v=20261107-1">
<link rel="stylesheet" href="{{ asset('assets/css/marketing-freight-finance.css') }}?v=20261122-1">
@endpush

@section('content')
<section class="finance-hero">
    <div class="container finance-hero-grid">
        <div class="finance-hero-copy reveal">
            <nav class="breadcrumb" aria-label="مسیر صفحه"><a href="{{ route('home') }}">صفحه اصلی</a><span aria-hidden="true">/</span><a href="{{ route('solutions.index') }}">راهکارها</a><span aria-hidden="true">/</span><span>{{ $page['nav_title'] }}</span></nav>
            <span class="finance-eyebrow">{{ $page['eyebrow'] }}</span>
            <h1>{{ $page['h1'] }}</h1>
            <p>موقع فروش، سود پرونده حمل را ۸۰۰ دلار برآورد کردید. بعد از تحویل، فاکتور ایجنت می‌رسد و با اضافه‌شدن یک هزینه جانبی، سود پرونده به ۴۸۰ دلار می‌رسد. برای بستن پرونده باید مشخص باشد کدام هزینه تغییر کرده و چه مبلغی هنوز قطعی نشده است.</p>
            <p>در سپند، درآمد و هزینه‌ها به همان پرونده حمل متصل‌اند. با مقایسه مبلغ برآوردی و هزینه‌های ثبت‌شده، می‌توانید بررسی کنید سود پرونده چقدر تغییر کرده و کدام ردیف هزینه باعث این اختلاف شده است.</p>
            <div class="hero-actions"><a class="btn btn-primary" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="freight_finance_hero_demo">درخواست دموی کنترل سود پرونده</a><a class="btn btn-outline" href="#profit-example">مشاهده مثال تغییر سود</a></div>
        </div>
        <aside class="finance-hero-panel reveal" aria-label="خلاصه تغییر سود پرونده نمونه">
            <span>دامنه و کاربرد راهکار · از برآورد فروش تا نتیجه نهایی</span>
            <div><small>سود زمان فروش</small><strong>۸۰۰ دلار</strong></div>
            <div><small>سود با تعهد شناخته‌شده</small><strong>۵۵۰ دلار</strong></div>
            <div class="is-final"><small>سود پس از فاکتور نهایی</small><strong>۴۸۰ دلار</strong></div>
            <p>کاهش کل سود: <b>۳۲۰ دلار</b>؛ شامل ۲۵۰ دلار هزینه جانبی و ۷۰ دلار اختلاف فاکتور با تعهد.</p>
        </aside>
    </div>
</section>

<section class="section finance-example" id="profit-example" aria-labelledby="profit-example-title">
    <div class="container">
        <header class="section-head reveal"><span class="section-label">مثال آموزشی با اعداد فرضی</span><h2 class="section-title" id="profit-example-title">ادامه حمل دریایی نینگبو به بندرعباس؛ سود در سه مقطع</h2><p class="section-sub">در این مثال، سود پرونده برابر درآمد تجاری منهای هزینه‌های مستقیم همان حمل است. درآمد با دریافت وجه و هزینه با پرداخت وجه یکسان فرض نشده‌اند.</p></header>
        <div class="finance-example-grid">
            <div class="finance-example-copy reveal">
                <div class="finance-table-wrap" role="region" aria-label="جدول تغییر سود پرونده حمل نینگبو به بندرعباس" tabindex="0">
                    <table><thead><tr><th>مرحله</th><th>درآمد پرونده</th><th>هزینه مستقیم حمل</th><th>سود پرونده</th></tr></thead><tbody>@foreach($exampleRows as $row)<tr><th>{{ $row['stage'] }}</th><td>{{ $row['revenue'] }}</td><td>{{ $row['cost'] }}</td><td><strong>{{ $row['profit'] }}</strong></td></tr>@endforeach</tbody></table>
                </div>
                <small class="finance-table-hint">برای مشاهده ستون سود، جدول را افقی به سمت چپ بکشید.</small>
                <div class="finance-math"><strong>اختلاف چگونه ساخته شد؟</strong><p>تعهد ۲۵۰ دلاری و مبلغ نهایی ۳۲۰ دلاری به یک ردیف هزینه جانبی مربوط‌اند. فاکتور نهایی ۷۰ دلار بیشتر از مبلغ تعهدشده است؛ بنابراین هزینه نسبت به زمان فروش ۳۲۰ دلار افزایش و سود از ۸۰۰ به ۴۸۰ دلار کاهش پیدا کرده است.</p></div>
                <div class="finance-example-boundary"><strong>مرز مثال و محصول</strong><p>اعداد این جدول فرضی‌اند. در نسخه فعلی، نمای سه‌لایه هزینه تعهدشده را از پرداخت‌های هزینه‌ای در انتظار تأیید می‌سازد و ثبت Accrual مسیر جداگانه‌ای دارد؛ اثر دقیق Accrual بر سود موقت باید در جریان مالی شرکت بررسی شود.</p></div>
            </div>
            <figure class="finance-product-shot reveal">
                <a href="{{ asset('assets/images/marketing/live/booking-finance-control.png') }}" target="_blank" rel="noopener" aria-label="مشاهده نمای کنترل مالی سپند در اندازه کامل"><img src="{{ asset('assets/images/marketing/live/booking-finance-control.png') }}" width="1264" height="600" loading="eager" alt="نمای واقعی کنترل مالی سه‌لایه سپند شامل انتخاب Job، ارز گزارش، ثبت نرخ و هزینه تحقق‌یافته"></a>
                <figcaption><span>شاهد محصول 01 · Product Evidence</span><strong>نمای واقعی کنترل مالی سپند</strong><p>این تصویر انتخاب Job، ارز گزارش، ثبت نرخ و فرم هزینه تحقق‌یافته را نشان می‌دهد. اعداد فرضی جدول بالا در این تصویر وجود ندارند.</p></figcaption>
            </figure>
        </div>
        <div class="finance-example-cta reveal"><a class="btn btn-primary" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="freight_finance_example_demo">محاسبه سود یک پرونده حمل را در سپند ببینید</a></div>
    </div>
</section>

<section class="section soft finance-path" aria-labelledby="finance-path-title">
    <div class="container">
        <header class="section-head reveal"><span class="section-label">مسیر تصمیم مدیر مالی</span><h2 class="section-title" id="finance-path-title">برای پیدا کردن علت اختلاف سود، چه چیزی را بررسی می‌کنید؟</h2><p class="section-sub">هر مرحله یک منبع داده متفاوت دارد؛ نتیجه مالی زمانی قابل توضیح است که این منابع با هم مخلوط نشوند.</p></header>
        <ol class="finance-path-list">
            <li class="reveal"><span>۱</span><div><h3>مبنای خرید پیش از فروش</h3><p>نرخ خرید انتخاب‌شده و شرایط ایجنت را در <a href="{{ route('solutions.platform.show', ['solution' => 'rate-management']) }}">مدیریت نرخ خرید حمل</a> کنترل کنید.</p><strong>خروجی: هزینه برآوردی قابل دفاع.</strong></div></li>
            <li class="reveal"><span>۲</span><div><h3>سود پیشنهادی زمان فروش</h3><p>درآمد پیشنهادی و اقلام قیمت را در <a href="{{ route('site.modules.show', ['module' => 'pricing-sales']) }}">ماژول نرخ‌دهی و فروش</a> بررسی کنید.</p><strong>خروجی: سود برآوردی پیش از ارسال قیمت.</strong></div></li>
            <li class="reveal"><span>۳</span><div><h3>تأیید مشتری و شروع اجرا</h3><p>وضعیت پیشنهاد را در <a href="{{ route('solutions.freight-sales-automation') }}">پیگیری پیشنهاد قیمت حمل</a> دنبال کنید تا مبنای فروش پرونده روشن بماند.</p><strong>خروجی: پیشنهاد پذیرفته‌شده و قابل انتقال به اجرا.</strong></div></li>
            <li class="reveal"><span>۴</span><div><h3>هزینه واقعی و تصمیم بستن پرونده</h3><p>تعهد، فاکتور، دریافت، پرداخت و نرخ ارز را در <a href="{{ route('site.modules.show', ['module' => 'finance-accounting']) }}">نرم‌افزار حسابداری حمل‌ونقل بین‌المللی سپند</a> کنترل کنید.</p><strong>خروجی: علت اختلاف و وضعیت آماده‌بودن پرونده برای بستن.</strong></div></li>
        </ol>
    </div>
</section>

<section class="section finance-evidence" id="product-evidence" aria-labelledby="finance-evidence-title">
    <div class="container">
        <header class="section-head reveal"><span class="section-label">Product Evidence</span><h2 class="section-title" id="finance-evidence-title">در نمای پرونده و Booking دنبال چه اطلاعاتی بگردید؟</h2><p class="section-sub">تصاویر زیر از نسخه فعلی سپند هستند و فقط اطلاعاتی را توصیف می‌کنند که واقعاً در تصویر دیده می‌شود.</p></header>
        <div class="finance-evidence-grid">
            <figure class="finance-evidence-card reveal"><a href="{{ asset('assets/images/marketing/modules/screenshots/finance-booking-reconciliation.webp') }}" target="_blank" rel="noopener"><img src="{{ asset('assets/images/marketing/modules/screenshots/finance-booking-reconciliation.webp') }}" width="1600" height="811" loading="lazy" alt="نمای واقعی تطبیق مالی Booking با مبلغ Offer، پرداخت، دریافت و وضعیت نرخ تبدیل"></a><figcaption><span>شاهد محصول 02</span><strong>تطبیق مالی Booking</strong><p>مبلغ Offer، پرداخت تأییدشده، دریافت تأییدشده و Bookingهای فاقد نرخ تبدیل را کنار هم نشان می‌دهد.</p></figcaption></figure>
            <figure class="finance-evidence-card reveal"><a href="{{ asset('assets/images/marketing/modules/screenshots/booking-profitability.webp') }}" target="_blank" rel="noopener"><img src="{{ asset('assets/images/marketing/modules/screenshots/booking-profitability.webp') }}" width="1595" height="626" loading="lazy" alt="نمای واقعی Bookingها با مبلغ Offer، پرداخت، دریافت و نرخ تبدیل ثبت‌شده"></a><figcaption><span>شاهد محصول 03</span><strong>ورودی و خروج وجه در Booking</strong><p>برای هر Booking مبلغ Offer، پرداخت، دریافت و وضعیت نرخ تبدیل دیده می‌شود؛ این نما به‌تنهایی سود فرضی مثال را نمایش نمی‌دهد.</p></figcaption></figure>
        </div>
    </div>
</section>

<section class="section soft finance-layers" id="operational-depth" aria-labelledby="finance-layers-title">
    <div class="container">
        <header class="section-head reveal"><span class="section-label">Operational Depth</span><h2 class="section-title" id="finance-layers-title">تفاوت هزینه برآوردی، تعهدشده، Accrual و واقعی</h2><p class="section-sub">واژه‌ها زمانی مفیدند که منبع داده و اثرشان بر تصمیم مدیر مالی روشن باشد.</p></header>
        <div class="finance-layer-grid">
            <article class="reveal"><span>Estimated</span><h3>هزینه برآوردی</h3><p>برآوردی است که پیش از اجرا برای سنجش سود فروش ثبت شده و هنوز فاکتور نهایی نیست.</p></article>
            <article class="reveal"><span>Committed</span><h3>هزینه تعهدشده</h3><p>در گزارش سه‌لایه فعلی، پرداخت هزینه‌ای در انتظار تأیید منبع Committed Cost است؛ یعنی تعهد شناخته شده اما Actual تأییدشده نیست.</p></article>
            <article class="reveal"><span>Accrual</span><h3>هزینه تحقق‌یافته بدون فاکتور</h3><p>هزینه‌ای است که رخ داده اما سند نهایی آن هنوز نرسیده است. سپند آن را با ارز، تاریخ و گروه تطبیق ثبت می‌کند.</p></article>
            <article class="reveal"><span>Actual</span><h3>هزینه واقعی</h3><p>در تطبیق Accrual، ردیف Actual به ردیف تعهد مرتبط می‌شود، مبلغ اختلاف ثبت و Accrual قبلی لغو می‌شود تا همان دو ردیف هم‌زمان هزینه فعال نسازند.</p></article>
        </div>
        <div class="finance-drilldown reveal"><div><span>مرز نمای فعلی محصول</span><h3>آیا از سود پرونده مستقیماً به ردیف هزینه می‌رسید؟</h3></div><p>گزارش سه‌لایه، اختلاف کل و Variance Driverها را در سطح دسته هزینه نشان می‌دهد و فهرست تطبیق هزینه نیز در همان فضای مالی وجود دارد. لینک مستقیم از سلول سود یا Snapshot به یک ردیف هزینه مشخص در کد نسخه فعلی تأیید نشد؛ بنابراین متن صفحه چنین Drill-down مستقیمی را ادعا نمی‌کند.</p></div>
    </div>
</section>

<section class="section finance-currency" aria-labelledby="finance-currency-title">
    <div class="container finance-currency-layout">
        <div class="reveal"><span class="section-label">کنترل چندارزی</span><h2 class="section-title" id="finance-currency-title">ارز هزینه با ارز گزارش چه تفاوتی دارد؟</h2><p>مثلاً هزینه ایجنت با USD ثبت می‌شود، اما مدیر مالی می‌تواند Snapshot سود را با ارز گزارش IRR بگیرد. هر ردیف مبلغ، ارز و نرخ تبدیل خودش را نگه می‌دارد؛ در سرویس تبدیل، آخرین نرخ دارای تاریخ مؤثر مساوی یا قبل از تاریخ هزینه انتخاب می‌شود.</p><p>برای پرداخت‌ها، اگر نرخ تاریخ‌دار پیدا نشود، نرخ تبدیل ثبت‌شده همان ردیف می‌تواند مبنای جایگزین باشد. به همین دلیل تاریخ هزینه، ارز گزارش و نرخ ثبت‌شده باید پیش از بستن پرونده کنترل شوند.</p><a href="{{ route('site.modules.show', ['module' => 'finance-accounting']) }}">مشاهده امکانات مالی چندارزی، دریافت و پرداخت سپند ←</a></div>
        <aside class="finance-close-card reveal"><span>چک‌لیست بستن پرونده</span><ul><li>آیا هزینه برآوردی و Actual مقایسه شده‌اند؟</li><li>آیا Accrual باز یا فاکتور تطبیق‌نشده باقی مانده است؟</li><li>آیا اختلاف ۷۰ دلاری مثال به همان ردیف هزینه متصل است؟</li><li>آیا نرخ تبدیل و تاریخ مؤثر آن مشخص است؟</li><li>آیا درآمد پرونده از دریافت وجه و هزینه از پرداخت وجه تفکیک شده است؟</li></ul></aside>
    </div>
</section>

<section class="section soft" id="solution-faq" aria-labelledby="faq-title">
    <div class="container platform-faq-layout">
        <header class="reveal"><span class="section-label">پرسش‌های مدیر مالی</span><h2 class="section-title" id="faq-title">سؤالات متداول محاسبه سود پرونده حمل</h2><p>پاسخ‌ها بر رفتار قابل مشاهده نسخه فعلی و مرز مثال آموزشی تکیه دارند.</p></header>
        <div class="faq">@foreach($page['faqs'] as $faq)<details class="reveal"><summary>{{ $faq['q'] }}</summary><p>{{ $faq['a'] }}</p></details>@endforeach</div>
    </div>
</section>

<section class="cta-wrap"><div class="container"><div class="cta reveal"><div class="cta-copy"><h2>{{ $page['cta_title'] }}</h2><p>{{ $page['cta_text'] }}</p></div><div class="cta-action"><a class="btn" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="freight_finance_bottom_demo">{{ $page['cta_button'] }}</a></div></div></div></section>
@endsection
