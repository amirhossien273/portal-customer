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
        ['@type' => 'HowToStep', 'position' => 2, 'name' => 'بوکینگ و تحویل پرونده به عملیات', 'text' => 'کارشناس سفارش حمل کالا را از Booking متصل به مشتری، Transaction و Offer تحویل می‌گیرد و Job و Shipment مرتبط با خدمت و مسیر ساخته می‌شوند.'],
        ['@type' => 'HowToStep', 'position' => 3, 'name' => 'اجرای حمل و اسناد', 'text' => 'تیم عملیات رویداد، اقدام و مدارک مرتبط با Shipment را پیگیری می‌کند.'],
        ['@type' => 'HowToStep', 'position' => 4, 'name' => 'اطلاع از وضعیت و تحویل', 'text' => 'پیگیری حمل کالا تا تحویل بر پایه رویدادها و وضعیت‌های ثبت‌شده در پرونده عملیات و رویدادهای مجاز پرتال مشتری انجام می‌شود.'],
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
        ['@type' => 'HowTo', '@id' => $canonical.'#scenario', 'name' => 'مدیریت حمل کالا از رزرو تا تحویل و بررسی هزینه', 'step' => $scenarioSteps],
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
<link rel="stylesheet" href="{{ asset('assets/css/marketing-tms.css') }}?v=20261124-1">
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
            <h2 class="section-title" id="tms-scenario-title">مدیریت حمل کالا از رزرو تا تحویل و بررسی هزینه</h2>
            <p class="section-sub">برای یک شرکت فورواردری، نرم‌افزار مدیریت حمل کالا باید به تیم عملیات کمک کند پس از تأیید پیشنهاد نرخ، رزرو، وضعیت محموله، اسناد و هزینه‌ها را در همان پرونده دنبال کند. در مثال نینگبو به بندرعباس می‌بینید اطلاعات پیشنهاد پذیرفته‌شده چطور به بوکینگ می‌رسد و تیم عملیات و مالی ادامه کار را از کجا پیگیری می‌کنند. داده‌های مسیر این سناریو آموزشی‌اند؛ تصویرهای این بخش از نسخه فعلی سپند هستند و داده فرضی مثال را نمایش نمی‌دهند.</p>
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
                        <p>تبدیل فقط برای پیشنهاد پذیرفته‌شده و دارای زمان تأیید انجام می‌شود. کارشناس برای <strong>مدیریت سفارش حمل کالا</strong>، پرونده را از نمای <a href="{{ route('site.modules.show', ['module' => 'booking']) }}">Booking</a> تحویل می‌گیرد. Booking به مشتری، Transaction و Offer متصل است و اطلاعات نوع خدمت و روش حمل، تجهیزات، مسیر، اقلام و نوع بار، HS Code، وزن، تعداد و حجم را همراه با Snapshot پیشنهاد شامل تأمین‌کننده، اعتبار، زمان حمل، مهلت رایگان، ردیف مبلغ، ارز و واحد نگه می‌دارد. سپند بر اساس خدمت و مسیر، Job و Shipment مرتبط را می‌سازد و تیم عملیات ادامه کار را از همین Booking و پرونده عملیات پیگیری می‌کند.</p>
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
                        <p>کارشناس عملیات آخرین وضعیت ثبت‌شده و رویدادهای Shipment را در <a href="{{ route('site.modules.show', ['module' => 'transport-operations']) }}">پرونده عملیات و فهرست Shipmentها</a> می‌بیند. <strong>پیگیری حمل کالا تا تحویل</strong> بر پایه همین رویدادها و وضعیت‌های ثبت‌شده انجام می‌شود. مشتری احراز هویت‌شده در <a href="{{ route('site.modules.show', ['module' => 'customer-portal-tracking']) }}">پرتال مشتریان و رهگیری</a> برای محموله‌های خودش وضعیت، مبدأ و مقصد، آخرین رویداد مجاز و زمان و موقعیت ثبت‌شده آن را مشاهده می‌کند؛ این نمایش GPS لحظه‌ای یا دریافت خودکار وضعیت از کریر نیست.</p>
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
            <span class="section-label">چک‌لیست ارزیابی در دمو</span>
            <h2 class="section-title" id="tms-scope-title">پیش از خرید نرم‌افزار TMS چه چیزی را در دمو بررسی کنید؟</h2>
            <p class="section-sub">برای ارزیابی پیش از خرید نرم‌افزار TMS، یک پرونده واقعی شرکت را انتخاب کنید و پیوستگی اطلاعات آن را در سه ایستگاه زیر ببینید.</p>
        </header>
        <ol class="tms-scope-grid tms-buying-checklist">
            <li class="reveal"><span>۱ · فروش تا رزرو</span><h3>تحویل پیشنهاد تأییدشده به Booking</h3><p>یک پیشنهاد تأییدشده را انتخاب کنید و ببینید چه اطلاعاتی از <a href="{{ route('site.modules.show', ['module' => 'crm']) }}">CRM</a> به <a href="{{ route('site.modules.show', ['module' => 'booking']) }}">Booking</a> می‌رسد.</p></li>
            <li class="reveal"><span>۲ · اجرای حمل</span><h3>وضعیت محموله و اسناد همان پرونده</h3><p>از تیم عملیات بخواهید وضعیت محموله و اسناد همان حمل را در <a href="{{ route('site.modules.show', ['module' => 'transport-operations']) }}">پرونده عملیات</a> نشان دهد.</p></li>
            <li class="reveal"><span>۳ · نتیجه مالی</span><h3>هزینه‌های ثبت‌شده همان پرونده</h3><p>بررسی کنید هزینه‌های ثبت‌شده و نتیجه مالی همان پرونده از کدام نمای <a href="{{ route('site.modules.show', ['module' => 'finance-accounting']) }}">مالی و Booking</a> در دسترس‌اند.</p></li>
        </ol>
        <p class="tms-scope-note reveal">اگر هنوز درباره تقسیم مسئولیت سفارش، عملیات حمل و ثبت نهایی مالی تصمیم نگرفته‌اید، معیارهای بخش <a href="{{ route('compare.sepand-other-transport-software') }}#erp-vs-tms">تفاوت ERP و TMS برای شرکت‌های حمل‌ونقل</a> را هم در ارزیابی خرید مرور کنید.</p>
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
                <details class="reveal"><summary>{{ $faq['q'] }}</summary><p>{{ $faq['a'] }}</p></details>
            @endforeach
        </div>
    </div>
</section>

<section class="cta-wrap">
    <div class="container">
        <div class="cta reveal">
            <div class="cta-copy"><h2>{{ $page['cta_title'] }}</h2><p>{{ $page['cta_text'] }}</p></div>
            <div class="cta-action tms-final-actions"><a class="btn" href="{{ $demoUrl }}" data-ga-event="cta_click" data-ga-label="tms_bottom_demo">{{ $page['cta_button'] }}</a><a class="tms-pricing-link" href="{{ route('pricing') }}">مشاهده تعرفه و محاسبه قیمت نرم‌افزار TMS</a></div>
        </div>
    </div>
</section>
@endsection
