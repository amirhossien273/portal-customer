@extends('layouts.marketing')

@php
    $demoUrl = route('consultation.create', ['source_page' => $canonical]);
    $breadcrumb = [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'صفحه اصلی', 'item' => route('home')],
        ['@type' => 'ListItem', 'position' => 2, 'name' => 'راهکارها', 'item' => route('solutions.index')],
        ['@type' => 'ListItem', 'position' => 3, 'name' => $page['nav_title'], 'item' => $canonical],
    ];
    $scenarioSteps = [
        ['@type' => 'HowToStep', 'position' => 1, 'name' => 'استعلام و پیشنهاد نرخ', 'text' => 'فروش اطلاعات مشتری، مسیر و محموله را ثبت می‌کند و پیشنهاد پذیرفته‌شده را برای تبدیل آماده می‌کند.'],
        ['@type' => 'HowToStep', 'position' => 2, 'name' => 'Booking و تحویل به عملیات', 'text' => 'Booking و پرونده عملیات از پیشنهاد تأییدشده و اطلاعات سفارش ساخته می‌شوند.'],
        ['@type' => 'HowToStep', 'position' => 3, 'name' => 'اجرای حمل و اسناد', 'text' => 'تیم عملیات رویداد، اقدام و مدارک مرتبط با Shipment را پیگیری می‌کند.'],
        ['@type' => 'HowToStep', 'position' => 4, 'name' => 'وضعیت و تحویل', 'text' => 'وضعیت داخلی و رویدادهای مجاز مشتری در نماهای مربوط بررسی می‌شوند.'],
        ['@type' => 'HowToStep', 'position' => 5, 'name' => 'هزینه و نتیجه مالی', 'text' => 'مبلغ پیشنهاد، دریافت و پرداخت مرتبط برای بررسی نتیجه مالی پرونده مرور می‌شوند.'],
    ];
@endphp

@push('head')
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'WebPage',
            '@id' => $canonical.'#webpage',
            'url' => $canonical,
            'name' => $title,
            'description' => $description,
            'inLanguage' => 'fa-IR',
            'dateModified' => config('site_platform_solutions.updated_at'),
            'breadcrumb' => ['@id' => $canonical.'#breadcrumb'],
            'mainEntity' => [
                ['@id' => $canonical.'#software'],
                ['@id' => $canonical.'#scenario'],
                ['@id' => $canonical.'#faq'],
            ],
        ],
        [
            '@type' => 'SoftwareApplication',
            '@id' => $canonical.'#software',
            'name' => 'نرم‌افزار TMS سپند',
            'applicationCategory' => 'BusinessApplication',
            'operatingSystem' => 'Web',
            'url' => $canonical,
            'description' => $description,
            'featureList' => [
                'تبدیل پیشنهاد تأییدشده به Booking و پرونده عملیات',
                'پیگیری اجرای حمل و اسناد مرتبط',
                'نمایش رویدادهای مجاز محموله در پرتال مشتری',
                'اتصال هزینه، دریافت و پرداخت به پرونده حمل',
                'اتصال CRM و پیگیری فروش به چرخه حمل',
            ],
        ],
        ['@type' => 'BreadcrumbList', '@id' => $canonical.'#breadcrumb', 'itemListElement' => $breadcrumb],
        ['@type' => 'HowTo', '@id' => $canonical.'#scenario', 'name' => 'چرخه یک پرونده حمل در نرم‌افزار TMS سپند', 'step' => $scenarioSteps],
        [
            '@type' => 'FAQPage',
            '@id' => $canonical.'#faq',
            'mainEntity' => array_map(static fn (array $faq): array => [
                '@type' => 'Question',
                'name' => $faq['q'],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['a']],
            ], $page['faqs']),
        ],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endpush

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/marketing-platform-solutions.css') }}?v=20261107-1">
<link rel="stylesheet" href="{{ asset('assets/css/marketing-tms.css') }}?v=20261123-1">
@endpush

@section('content')
<section class="tms-hero">
    <div class="container tms-hero-grid">
        <div class="tms-hero-copy reveal">
            <nav class="breadcrumb" aria-label="مسیر صفحه">
                <a href="{{ route('home') }}">صفحه اصلی</a><span>/</span>
                <a href="{{ route('solutions.index') }}">راهکارها</a><span>/</span>
                <span>{{ $page['nav_title'] }}</span>
            </nav>
            <span class="tms-eyebrow">{{ $page['eyebrow'] }}</span>
            <h1>{{ $page['h1'] }}</h1>
            <p>مشتری پیشنهاد نرخ را پذیرفته، اما اطلاعات خرید و فروش در ایمیل مانده است؛ کارشناس عملیات دوباره مشخصات بار را وارد می‌کند و واحد مالی باید هزینه‌های همان حمل را از چند جای مختلف جمع کند.</p>
            <p>در نرم‌افزار TMS سپند، پیشنهاد تأییدشده به Booking و ادامه همان پرونده می‌رسد. اطلاعات مشتری، خدمت، روش حمل، مسیر و محموله همراه Snapshot پیشنهاد نگهداری می‌شوند تا عملیات، اسناد و مالی از یک مرجع مشترک ادامه پیدا کنند.</p>
            <div class="hero-actions">
                <a class="btn btn-primary" href="{{ $demoUrl }}" data-ga-event="cta_click" data-ga-label="tms_hero_demo">فرایند حمل شرکتتان را در دموی سپند ببینید</a>
                <a class="btn btn-outline" href="#tms-scenario">مشاهده چرخه حمل نینگبو تا بندرعباس</a>
            </div>
        </div>
        <aside class="tms-hero-answer reveal" aria-label="پاسخ کوتاه درباره دامنه TMS سپند">
            <span>پاسخ کوتاه مدیر عملیات</span>
            <strong>بعد از تأیید مشتری چه اتفاقی می‌افتد؟</strong>
            <ol>
                <li><b>فروش</b><small>پیشنهاد پذیرفته‌شده و اطلاعات سفارش</small></li>
                <li><b>Booking</b><small>مرجع تحویل پرونده به عملیات</small></li>
                <li><b>اجرا</b><small>Shipment، رویداد، وضعیت و سند</small></li>
                <li><b>مالی</b><small>هزینه، دریافت، پرداخت و نتیجه پرونده</small></li>
            </ol>
            <p>این دامنه اجرای حمل است؛ موقعیت GPS لحظه‌ای، بهینه‌سازی مسیر و اتصال مستقیم به کریر در این صفحه ادعا نمی‌شوند.</p>
        </aside>
    </div>
</section>

<section class="section tms-scenario" id="tms-scenario" aria-labelledby="tms-scenario-title">
    <div class="container">
        <header class="section-head reveal">
            <span class="section-label">مثال آموزشی · حمل دریایی نینگبو به بندرعباس</span>
            <h2 class="section-title" id="tms-scenario-title">یک پرونده از تأیید پیشنهاد تا بررسی نتیجه مالی چه مسیری دارد؟</h2>
            <p class="section-sub">داده‌های مسیر این سناریو آموزشی‌اند. تصویرهای این بخش از نسخه فعلی سپند هستند و داده فرضی مثال را نمایش نمی‌دهند.</p>
        </header>

        <div class="tms-scenario-layout">
            <ol class="tms-stage-list">
                <li class="tms-stage reveal">
                    <span class="tms-stage-number">۱</span>
                    <div>
                        <div class="tms-stage-meta"><b>نقش: فروش و نرخ‌دهی</b><small>خروجی: پیشنهاد پذیرفته‌شده</small></div>
                        <h3>استعلام و پیشنهاد نرخ</h3>
                        <p>کارشناس در مسیر <a href="{{ route('site.modules.show', ['module' => 'crm']) }}">CRM شرکت حمل‌ونقل</a> و نرخ‌دهی، مشتری و استعلام را پیگیری می‌کند. پس از ثبت پذیرش مشتری، اطلاعات سفارش شامل نوع خدمت و روش حمل، مسیر، تجهیزات، اقلام بار، وزن و حجم و همچنین تأمین‌کننده، اعتبار، زمان حمل، مهلت رایگان و ردیف‌های مبلغ پیشنهاد برای مرحله بعد نگهداری می‌شوند.</p>
                    </div>
                </li>
                <li class="tms-stage reveal">
                    <span class="tms-stage-number">۲</span>
                    <div>
                        <div class="tms-stage-meta"><b>نقش: Booking و عملیات</b><small>خروجی: Booking و Job عملیاتی</small></div>
                        <h3>بوکینگ و تحویل پرونده به عملیات</h3>
                        <p>تبدیل فقط برای پیشنهاد پذیرفته‌شده و دارای زمان تأیید انجام می‌شود. سپند <a href="{{ route('site.modules.show', ['module' => 'booking']) }}">Booking</a> را به Transaction و Offer متصل می‌کند و بر اساس خدمت و مسیر، Job و Shipment عملیاتی می‌سازد. تیم عملیات کار را از همین Booking و پرونده مرتبط ادامه می‌دهد.</p>
                    </div>
                </li>
                <li class="tms-stage reveal">
                    <span class="tms-stage-number">۳</span>
                    <div>
                        <div class="tms-stage-meta"><b>نقش: عملیات و اسناد</b><small>خروجی: وضعیت و اقدام بعدی ثبت‌شده</small></div>
                        <h3>اجرای حمل و اسناد</h3>
                        <p>در <a href="{{ route('site.modules.show', ['module' => 'transport-operations']) }}">پرونده عملیات حمل</a>، Shipment، رویدادهای ثبت‌شده و وضعیت اجرا مرور می‌شوند. مدارک و پیوست‌ها در <a href="{{ route('site.modules.show', ['module' => 'document-management']) }}">مدیریت اسناد حمل</a> به زمینه پرونده مرتبط می‌مانند تا کارشناس بداند کدام مدرک و اقدام هنوز باید بررسی شود.</p>
                    </div>
                </li>
                <li class="tms-stage reveal">
                    <span class="tms-stage-number">۴</span>
                    <div>
                        <div class="tms-stage-meta"><b>نقش: عملیات و مشتری</b><small>خروجی: مشاهده وضعیت مجاز</small></div>
                        <h3>اطلاع از وضعیت و تحویل</h3>
                        <p>تیم داخلی آخرین وضعیت ثبت‌شده را در نماهای عملیات می‌بیند. مشتری احراز هویت‌شده در <a href="{{ route('site.modules.show', ['module' => 'customer-portal-tracking']) }}">پرتال مشتریان و رهگیری</a> فقط رویدادهای مجاز، وضعیت محموله و اطلاعات مرتبط خودش را مشاهده می‌کند؛ این قابلیت جای GPS لحظه‌ای را ادعا نمی‌کند.</p>
                    </div>
                </li>
                <li class="tms-stage reveal">
                    <span class="tms-stage-number">۵</span>
                    <div>
                        <div class="tms-stage-meta"><b>نقش: مالی و مدیر پرونده</b><small>خروجی: مبنای بررسی نتیجه حمل</small></div>
                        <h3>ثبت هزینه و بررسی سود</h3>
                        <p>مبلغ Offer، هزینه‌ها، دریافت‌ها و پرداخت‌های مرتبط در <a href="{{ route('site.modules.show', ['module' => 'finance-accounting']) }}">مالی و حسابداری حمل</a> و نمای Booking بررسی می‌شوند تا نتیجه مالی همان پرونده قابل مرور باشد. تکمیل هزینه‌ها و کنترل اختلاف‌ها همچنان به ثبت و بررسی تیم مالی نیاز دارد.</p>
                    </div>
                </li>
            </ol>

            <figure class="tms-product-shot reveal">
                <a href="{{ asset('assets/images/marketing/modules/screenshots/pricing-sales-workflow.webp') }}" target="_blank" rel="noopener">
                    <img src="{{ asset('assets/images/marketing/modules/screenshots/pricing-sales-workflow.webp') }}" width="1600" height="687" loading="eager" fetchpriority="high" alt="برد واقعی استعلام، پیشنهاد قیمت، تأیید مشتری و تبدیل پیشنهاد به Booking در نرم‌افزار سپند">
                </a>
                <figcaption><span>شاهد واقعی محصول</span><strong>جریان فروش تا Booking در سپند</strong><p>در این نما، مراحل استعلام، پیشنهاد، تأیید مشتری و تبدیل به Booking دیده می‌شوند. مسیر نینگبو–بندرعباس و داده‌های آموزشی این صفحه داخل تصویر نیستند.</p></figcaption>
            </figure>
        </div>

        <div class="tms-scenario-cta reveal">
            <a class="btn btn-primary" href="{{ $demoUrl }}" data-ga-event="cta_click" data-ga-label="tms_scenario_demo">فرایند حمل شرکتتان را در دموی سپند ببینید</a>
        </div>
    </div>
</section>

<section class="section soft tms-crm" aria-labelledby="tms-crm-title">
    <div class="container">
        <header class="section-head reveal">
            <span class="section-label">CRM + TMS</span>
            <h2 class="section-title" id="tms-crm-title">اتصال فروش به عملیات حمل چه کمکی می‌کند؟</h2>
            <p class="section-sub">هدف، حذف مرز مسئولیت‌ها نیست؛ هر تیم کار خودش را انجام می‌دهد، اما نتیجه مرحله قبل همراه پرونده به مرحله بعد می‌رسد.</p>
        </header>
        <ol class="tms-connected-flow reveal" aria-label="جریان اتصال فروش به عملیات حمل">
            <li><span>۱</span><b>ثبت سرنخ و استعلام</b></li>
            <li><span>۲</span><b>پیگیری پیشنهاد قیمت</b></li>
            <li><span>۳</span><b>تأیید مشتری</b></li>
            <li><span>۴</span><b>Booking</b></li>
            <li><span>۵</span><b>اجرای حمل</b></li>
            <li><span>۶</span><b>بررسی مالی پرونده</b></li>
        </ol>
        <div class="tms-boundary-grid">
            <article class="reveal"><span>قابلیت تأییدشده</span><h3>ثبت و پیگیری لید و استعلام</h3><p>پرونده مشتری، سابقه ارتباط، مسئول پیگیری و استعلام در CRM و فروش مدیریت می‌شوند و نتیجه پذیرفته‌شده به Booking متصل می‌ماند.</p></article>
            <article class="reveal"><span>نیازمند بررسی در دمو</span><h3>ورود خودکار لید از کانال‌های بازاریابی</h3><p>ورود خودکار لید از وب‌سایت، شبکه‌های اجتماعی یا همه کانال‌های بازاریابی در شواهد بررسی‌شده تأیید نشد؛ اگر این جریان برای شرکت شما مهم است، منبع و روش ورود باید در جلسه فنی بررسی شود.</p></article>
        </div>
    </div>
</section>

<section class="section tms-evidence" aria-labelledby="tms-evidence-title">
    <div class="container">
        <header class="section-head reveal">
            <span class="section-label">شواهد محصول</span>
            <h2 class="section-title" id="tms-evidence-title">بعد از Booking، عملیات و مالی چه چیزی می‌بینند؟</h2>
            <p class="section-sub">هر تصویر یک بخش واقعی از محصول را نشان می‌دهد؛ جزئیات کامل جریان شرکت شما باید با سناریوی خودتان در دمو آزموده شود.</p>
        </header>
        <div class="tms-evidence-grid">
            <figure class="tms-evidence-card reveal">
                <a href="{{ asset('assets/images/marketing/modules/screenshots/operations-calendar-list.webp') }}" target="_blank" rel="noopener"><img src="{{ asset('assets/images/marketing/modules/screenshots/operations-calendar-list.webp') }}" width="1600" height="861" loading="lazy" alt="فهرست واقعی Shipmentها و زمان‌بندی عملیات حمل در نرم‌افزار سپند"></a>
                <figcaption><span>عملیات</span><strong>فهرست Shipment و زمان‌های ثبت‌شده</strong><p>کارشناس پرونده‌های عملیات، زمان‌ها و وضعیت‌های قابل مشاهده را در نمای فهرستی مرور می‌کند.</p></figcaption>
            </figure>
            <figure class="tms-evidence-card reveal">
                <a href="{{ asset('assets/images/marketing/modules/screenshots/booking-profitability.webp') }}" target="_blank" rel="noopener"><img src="{{ asset('assets/images/marketing/modules/screenshots/booking-profitability.webp') }}" width="1595" height="626" loading="lazy" alt="فهرست واقعی Bookingها و مبلغ پیشنهاد و پرداخت و دریافت مرتبط در سپند"></a>
                <figcaption><span>Booking و مالی</span><strong>مبلغ Offer، دریافت و پرداخت مرتبط</strong><p>این نما مرجع بررسی وضعیت مالی Booking است؛ سود نهایی تنها پس از کامل‌شدن هزینه‌ها قابل اتکاست.</p></figcaption>
            </figure>
        </div>
    </div>
</section>

<section class="section soft tms-scope" aria-labelledby="tms-scope-title">
    <div class="container">
        <header class="section-head reveal">
            <span class="section-label">مرز صفحه و تصمیم خرید</span>
            <h2 class="section-title" id="tms-scope-title">برای ارزیابی سیستم مدیریت حمل‌ونقل (TMS) چه چیزی را جداگانه بررسی کنیم؟</h2>
        </header>
        <div class="tms-scope-grid">
            <article class="reveal"><span>اجرای حمل</span><h3>این صفحه TMS</h3><p>از پیشنهاد پذیرفته‌شده تا Booking، اجرای حمل، اسناد، وضعیت و نتیجه مالی پرونده را به‌صورت یک چرخه بررسی می‌کند.</p></article>
            <article class="reveal"><span>عمق عملیات</span><h3>کار داخل Shipment</h3><p>برای ثبت رویداد، وضعیت و اقدام روزانه، جزئیات <a href="{{ route('site.modules.show', ['module' => 'transport-operations']) }}">ماژول عملیات حمل</a> را ببینید.</p></article>
            <article class="reveal"><span>رابطه مشتری</span><h3>لید و پیگیری فروش</h3><p>برای پرونده مشتری، ارتباطات و پیگیری فرصت‌ها، صفحه <a href="{{ route('site.modules.show', ['module' => 'crm']) }}">CRM حمل‌ونقل</a> مرجع تخصصی است.</p></article>
            <article class="reveal"><span>تصمیم خرید</span><h3>مقایسه و هزینه اشتراک</h3><p>برای انتخاب نوع سیستم، بخش <a href="{{ route('compare.sepand-other-transport-software') }}#erp-vs-tms">تفاوت ERP و TMS برای شرکت‌های حمل‌ونقل</a> را بخوانید و مبنای هزینه را در <a href="{{ route('pricing') }}">تعرفه‌های سپند</a> بررسی کنید.</p></article>
        </div>
    </div>
</section>

<section class="section tms-faq" id="solution-faq" aria-labelledby="tms-faq-title">
    <div class="container tms-faq-layout">
        <header class="reveal">
            <span class="section-label">پرسش‌های خریدار</span>
            <h2 class="section-title" id="tms-faq-title">سؤالات متداول درباره نرم‌افزار TMS سپند</h2>
            <p>پاسخ‌ها بر رفتار قابل مشاهده نسخه فعلی و مرز ادعاهای تأییدشده تکیه دارند.</p>
        </header>
        <div class="faq">
            @foreach($page['faqs'] as $faq)
                <details class="reveal"><summary>{{ $faq['q'] }}</summary><p>{{ $faq['a'] }}</p>@if($loop->last)<a href="{{ route('pricing') }}">مشاهده تعرفه‌ها و مبنای محاسبه قیمت سپند</a>@endif</details>
            @endforeach
        </div>
    </div>
</section>

<section class="cta-wrap">
    <div class="container">
        <div class="cta reveal">
            <div class="cta-copy"><h2>{{ $page['cta_title'] }}</h2><p>{{ $page['cta_text'] }}</p></div>
            <div class="cta-action"><a class="btn" href="{{ $demoUrl }}" data-ga-event="cta_click" data-ga-label="tms_bottom_demo">{{ $page['cta_button'] }}</a></div>
        </div>
    </div>
</section>
@endsection
