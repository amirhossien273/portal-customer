@extends('layouts.marketing')

@php
    $capabilities = [
        [
            'title' => 'ثبت درخواست نرخ',
            'action' => 'کارشناس مشتری، مبدأ و مقصد، روش حمل، نوع خدمت، شرایط پرداخت و مشخصات محموله را در همان استعلام ثبت می‌کند.',
            'output' => 'یک پرونده نرخ‌دهی با اطلاعات پایه مشترک برای فروش و Pricing ساخته می‌شود.',
        ],
        [
            'title' => 'جمع‌آوری پیشنهاد تأمین‌کنندگان',
            'action' => 'برای هر پیشنهاد، تأمین‌کننده، اعتبار، Transit Time، Free Time و اقلام هزینه با واحد، تعداد، ارز و قیمت واحد ثبت می‌شوند.',
            'output' => 'پیشنهادها به همان استعلام متصل می‌مانند و برای بررسی کنار هم در دسترس‌اند.',
        ],
        [
            'title' => 'بررسی اعتبار و شرایط نرخ',
            'action' => 'کارشناس تاریخ اعتبار، مسیر یا نوع خدمت، زمان حمل، Free Time، شرایط پرداخت و داده عملکردی موجود را همراه مبلغ می‌سنجد.',
            'output' => 'انتخاب تأمین‌کننده فقط به ارزان‌ترین مبلغ محدود نمی‌شود و شرایط انتخاب قابل بازبینی می‌ماند.',
        ],
        [
            'title' => 'آماده‌سازی پیشنهاد فروش',
            'action' => 'اقلام نرخ با ارز، تعداد، قیمت واحد و هزینه افزوده ثبت‌شده بازبینی و Quotation، یعنی پیشنهاد قیمت قابل ارائه به مشتری، آماده می‌شود.',
            'output' => 'جمع هر قلم و مجموع هر ارز دیده می‌شود؛ مبنای خرید و مبلغ ارائه‌شده برای کنترل حاشیه پیش از ارسال بازبینی می‌شوند.',
        ],
        [
            'title' => 'ثبت و پیگیری وضعیت پیشنهاد',
            'action' => 'ارسال پیشنهاد ثبت می‌شود و وضعیت‌های پیش‌نویس، ارسال‌شده، پذیرفته‌شده یا تبدیل‌شده همراه سابقه پرونده قابل پیگیری‌اند.',
            'output' => 'فروش می‌داند پیشنهاد در کدام مرحله است و برای ثبت پاسخ یا اقدام بعدی به پرونده مشتری برمی‌گردد.',
        ],
        [
            'title' => 'ادامه پیشنهاد تأییدشده در Booking',
            'action' => 'پس از پذیرش و تأیید پیشنهاد، مشتری، روش حمل، مسیر، محموله، شرایط پرداخت، تأمین‌کننده، اعتبار و اقلام نرخ مبنای Booking می‌شوند.',
            'output' => 'پرونده رزرو بدون ورود دوباره داده‌های پایه شکل می‌گیرد و پیشنهاد به وضعیت تبدیل‌شده می‌رسد.',
        ],
    ];

    $faqs = [
        ['question' => 'نرم‌افزار نرخ‌دهی حمل‌ونقل چه کاری انجام می‌دهد؟', 'answer' => 'استعلام مشتری، مشخصات حمل، پیشنهادهای تأمین‌کنندگان و Quotation فروش را در یک پرونده مرتبط نگه می‌دارد و نتیجه پیشنهاد را تا ادامه در Booking قابل پیگیری می‌کند.'],
        ['question' => 'آیا می‌توان چند پیشنهاد تأمین‌کننده را برای یک استعلام مقایسه کرد؟', 'answer' => 'بله. در نمای مقایسه می‌توان پیشنهادهای تأمین‌کنندگان را از نظر نرخ خرید و ارز، مسیر یا خدمت، اعتبار، زمان حمل، Free Time، شرایط پرداخت و داده عملکردی موجود کنار هم دید.'],
        ['question' => 'اعتبار نرخ و شرایط پیشنهاد چگونه بررسی می‌شوند؟', 'answer' => 'تاریخ اعتبار و شرایطی مانند Transit Time و Free Time همراه همان پیشنهاد ثبت می‌شوند. کارشناس پیش از انتخاب نرخ و آماده‌سازی Quotation آن‌ها را بازبینی می‌کند.'],
        ['question' => 'قیمت خرید و فروش و حاشیه سود چگونه نمایش یا محاسبه می‌شوند؟', 'answer' => 'هر قلم نرخ، واحد، تعداد، ارز، قیمت واحد و هزینه افزوده ثبت‌شده دارد و جمع آن محاسبه می‌شود. این داده‌ها مبنای بازبینی فاصله خرید و مبلغ پیشنهادی‌اند؛ سود واقعی پس از ثبت درآمد و هزینه واقعی در فرایند مالی و عملیات مشخص می‌شود.'],
        ['question' => 'تفاوت پیشنهاد قیمت با پیش‌فاکتور در سپند چیست؟', 'answer' => 'Quotation پیشنهاد تجاری شامل نرخ و شرایط خدمت است. پیش‌فاکتور یک سند مالی پس از انتخاب نرخ و ورود پرونده به مرحله مربوط است؛ بنابراین با خود پیشنهاد قیمت یکسان نیست.'],
        ['question' => 'پیشنهاد تأییدشده چگونه به Booking متصل می‌شود؟', 'answer' => 'پیشنهاد پذیرفته‌شده به Booking تبدیل می‌شود و تصویر ثابتی از اطلاعات مشتری، مسیر، محموله، شرایط پرداخت، تأمین‌کننده، اعتبار و اقلام نرخ در پرونده رزرو نگهداری می‌شود.'],
    ];

    $scenarioSteps = [
        ['title' => 'ثبت اطلاعات درخواست حمل', 'text' => 'مشتری، مسیر دریایی نینگبو به بندرعباس، نوع خدمت و مشخصات محموله در استعلام ثبت می‌شوند.'],
        ['title' => 'ثبت پیشنهادهای تأمین‌کنندگان', 'text' => 'دو پیشنهاد نمونه با ارز، قیمت واحد، اعتبار، Transit Time و Free Time به همان استعلام افزوده می‌شوند.'],
        ['title' => 'مقایسه نرخ و شرایط', 'text' => 'کارشناس تفاوت مبلغ، زمان حمل، اعتبار، Free Time، شرایط پرداخت و سابقه داخلی موجود را کنار هم می‌سنجد.'],
        ['title' => 'بررسی اعتبار و هزینه‌های مرتبط', 'text' => 'اعتبار پیشنهاد انتخابی و اقلام هزینه بازبینی می‌شوند تا نرخ منقضی یا قلم ثبت‌نشده وارد پیشنهاد فروش نشود.'],
        ['title' => 'آماده‌سازی پیشنهاد فروش', 'text' => 'Quotation با اقلام، تعداد، ارز و مبلغ قابل ارائه آماده می‌شود و نسخه فارسی یا انگلیسی PDF در دسترس است.'],
        ['title' => 'ثبت پاسخ مشتری و اقدام بعدی', 'text' => 'ارسال پیشنهاد و پاسخ مشتری در وضعیت پرونده ثبت می‌شوند؛ پیگیری مذاکره و اقدام بعدی در سابقه CRM ادامه پیدا می‌کند.'],
        ['title' => 'ادامه پیشنهاد تأییدشده در Booking', 'text' => 'پس از پذیرش، داده‌های تأییدشده استعلام و پیشنهاد به Booking منتقل می‌شوند و پرونده وارد ادامه فرایند می‌شود.'],
    ];

    $moduleCanonical = route('site.modules.show', ['module' => $slug]);
@endphp

@push('head')
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'SoftwareApplication',
            '@id' => $moduleCanonical.'#software',
            'name' => 'نرم‌افزار نرخ‌دهی و فروش خدمات حمل‌ونقل سپند',
            'applicationCategory' => 'BusinessApplication',
            'operatingSystem' => 'Web',
            'description' => $module['meta_description'],
            'url' => $moduleCanonical,
            'featureList' => array_column($capabilities, 'title'),
            'audience' => ['@type' => 'BusinessAudience', 'audienceType' => 'مدیران فروش، کارشناسان Pricing و تیم‌های فروش شرکت‌های حمل‌ونقل و فورواردری'],
        ],
        [
            '@type' => 'HowTo',
            '@id' => $moduleCanonical.'#scenario',
            'name' => 'از استعلام مشتری تا پیشنهاد قیمت حمل',
            'step' => array_map(static fn (array $step, int $index): array => [
                '@type' => 'HowToStep',
                'position' => $index + 1,
                'name' => $step['title'],
                'text' => $step['text'],
            ], $scenarioSteps, array_keys($scenarioSteps)),
        ],
        [
            '@type' => 'FAQPage',
            '@id' => $moduleCanonical.'#faq',
            'mainEntity' => array_map(static fn (array $faq): array => [
                '@type' => 'Question',
                'name' => $faq['question'],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['answer']],
            ], $faqs),
        ],
        [
            '@type' => 'BreadcrumbList',
            '@id' => $moduleCanonical.'#breadcrumb',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'صفحه اصلی', 'item' => route('home')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'ماژول‌ها', 'item' => route('modules')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => 'نرخ‌دهی و فروش', 'item' => $moduleCanonical],
            ],
        ],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endpush

@include('marketing.partials.module-rich-styles')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/marketing-pricing-sales.css') }}?v=20261107-1">
@endpush

@section('content')
<section class="page-hero pricing-page-hero">
    <div class="container hero-inner">
        <div class="hero-copy crm-hero-copy reveal">
            <nav class="breadcrumb" aria-label="مسیر راهنما"><a href="{{ route('home') }}">صفحه اصلی</a><svg viewBox="0 0 24 24" fill="none"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg><a href="{{ route('modules') }}">ماژول‌ها</a><svg viewBox="0 0 24 24" fill="none"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg><span>نرخ‌دهی و فروش</span></nav>
            <h1 class="module-hero-title"><span class="module-hero-title-main">نرم‌افزار نرخ‌دهی و فروش</span><span class="module-hero-title-accent">خدمات حمل‌ونقل</span></h1>
            <p class="crm-lead">درخواست حمل به مشتری و اطلاعات محموله متصل است؛ نرخ خرید و شرایط تأمین‌کنندگان کنار هم بررسی می‌شوند و کارشناس بر پایه اطلاعات تأییدشده، پیشنهاد فروش را آماده و وضعیت آن را پیگیری می‌کند.</p>
            <p class="crm-lead">وقتی نرخ‌ها میان ایمیل و فایل‌های مختلف پخش‌اند، قالب شرایط یکسان نیست و اعتبار نرخ یا هزینه جانبی ممکن است هنگام آماده‌سازی قیمت نادیده بماند. سپند این داده‌ها را در پرونده همان استعلام نگه می‌دارد.</p>
            <div class="hero-actions">
                <a class="btn btn-primary" href="{{ route('consultation.legacy') }}" data-ga-event="cta_click" data-ga-label="pricing_sales_hero_consultation">درخواست دموی نرخ‌دهی حمل‌ونقل</a>
                <a class="btn btn-outline" href="#pricing-process">مشاهده فرایند نرخ‌دهی</a>
            </div>
        </div>
        <figure class="pricing-hero-photo reveal">
            <img src="{{ asset('assets/images/marketing/modules/pricing-sales-hero.webp') }}" width="1536" height="1024" alt="گفت‌وگوی فروش خدمات حمل‌ونقل در کنار بندر و شیوه‌های مختلف حمل" fetchpriority="high">
            <figcaption>از درخواست مشتری تا پیشنهاد فروش و ادامه پرونده تأییدشده</figcaption>
        </figure>
    </div>
</section>

<section class="section" id="pricing-comparison" aria-labelledby="pricing-comparison-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">مقایسه تأمین‌کنندگان</span><h2 class="section-title" id="pricing-comparison-title">نرخ خرید را همراه<br><span>شرایط واقعی پیشنهاد مقایسه کنید</span></h2><p class="section-sub">مبلغ به‌تنهایی مبنای مناسبی برای انتخاب نیست. نمای مقایسه، اطلاعات ثبت‌شده هر تأمین‌کننده را کنار هم می‌گذارد تا تفاوت مسیر، اعتبار، زمان حمل و شرایط خدمت دیده شود.</p></div>
        <figure class="pricing-product-shot reveal">
            <a href="{{ asset('assets/images/marketing/modules/screenshots/pricing-supplier-comparison.webp') }}" target="_blank" rel="noopener" aria-label="مشاهده تصویر مقایسه تأمین‌کنندگان در اندازه کامل">
                <img src="{{ asset('assets/images/marketing/modules/screenshots/pricing-supplier-comparison.webp') }}" width="1600" height="839" alt="نمای واقعی مقایسه تأمین‌کنندگان با نرخ خرید، مسیر، اعتبار، زمان حمل و Free Time در سپند" loading="eager">
            </a>
            <figcaption><strong>نمای واقعی محصول:</strong> کارشناس تأمین‌کنندگان انتخاب‌شده را با نرخ خرید و ارز، Transit Time یا زمان حمل، مسیر یا نوع خدمت، تاریخ اعتبار، Free Time، شرایط پرداخت و داده عملکردی موجود مقایسه می‌کند. تصویر را برای جزئیات باز کنید.</figcaption>
        </figure>
        <ul class="pricing-criteria reveal" aria-label="معیارهای مقایسه تأمین‌کنندگان">
            <li>تأمین‌کننده</li><li>مسیر و نوع خدمت</li><li>نرخ خرید و ارز</li><li>اعتبار پیشنهاد</li><li>زمان حمل</li><li><span dir="ltr">Free Time</span></li><li>شرایط پرداخت</li><li>سابقه تأخیر و پاسخ‌گویی، اگر داده وجود داشته باشد</li>
        </ul>
        <p class="pricing-term-note reveal"><strong>Free Time چیست؟</strong> مهلت مجاز ثبت‌شده برای بارگیری یا انتقال است. مقدار آن بخشی از شرایط همان پیشنهاد است و در کنار مبلغ بررسی می‌شود.</p>
    </div>
</section>

<section class="section soft" id="pricing-process" aria-labelledby="pricing-process-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">فرایند کار کارشناس</span><h2 class="section-title" id="pricing-process-title">از استعلام نرخ حمل تا<br><span>Quotation و Booking</span></h2><p class="section-sub">هر مرحله یک اقدام روشن و یک خروجی قابل مشاهده دارد؛ بدون اینکه Rate Master، CRM یا مالی با خود فرایند پیشنهاد قیمت یکی فرض شوند.</p></div>
        <div class="pricing-process-grid">
            @foreach($capabilities as $capability)
                <article class="pricing-process-card reveal">
                    <span class="pricing-process-number">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    <h3>{{ $capability['title'] }}</h3>
                    <p><strong>اقدام کاربر:</strong> {{ $capability['action'] }}</p>
                    <p class="pricing-process-output"><strong>خروجی:</strong> {{ $capability['output'] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="section" aria-labelledby="pricing-offers-title">
    <div class="container pricing-evidence-layout">
        <div class="pricing-evidence-copy reveal">
            <span class="section-label">نرخ‌های همان استعلام</span>
            <h2 id="pricing-offers-title">پیشنهادها در زمینه<br><span>همان درخواست بررسی می‌شوند</span></h2>
            <p>کارشناس از پرونده استعلام به نرخ‌دهی می‌رود، پیشنهادهای مرتبط را می‌بیند و نرخ تازه را با تأمین‌کننده، اعتبار، شرایط و اقلام هزینه ثبت می‌کند. این اتصال مانع جداشدن نرخ از مشتری، مسیر و محموله می‌شود.</p>
            <p>نمای «نرخ‌های پیشنهادی» نرخ مشابهی پیدا نکرده است؛ این پیام هم یک خروجی واقعی است و به کاربر می‌گوید برای این استعلام باید پیشنهاد جدید ثبت کند، نه اینکه نرخ زنده بازار به‌طور خودکار پیدا شده باشد.</p>
        </div>
        <figure class="pricing-product-shot compact reveal">
            <a href="{{ asset('assets/images/marketing/modules/screenshots/pricing-proposed-rates.webp') }}" target="_blank" rel="noopener" aria-label="مشاهده نرخ‌های پیشنهادی استعلام در اندازه کامل"><img src="{{ asset('assets/images/marketing/modules/screenshots/pricing-proposed-rates.webp') }}" width="1600" height="701" alt="نمای واقعی بررسی نرخ‌های پیشنهادی مشابه در پرونده استعلام حمل سپند" loading="lazy"></a>
            <figcaption>کاربر نرخ‌های مرتبط با استعلام را بررسی می‌کند و در صورت نبود پیشنهاد مشابه، نرخ جدید را در همان پرونده می‌افزاید.</figcaption>
        </figure>
    </div>
</section>

<section class="section soft" id="pricing-scenario" aria-labelledby="pricing-scenario-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">مثال آموزشی</span><h2 class="section-title" id="pricing-scenario-title">از استعلام مشتری تا<br><span>پیشنهاد قیمت حمل</span></h2><p class="section-sub">یک مشتری برای حمل دریایی از نینگبو به بندرعباس درخواست نرخ دارد. مراحل و داده‌های زیر صرفاً برای توضیح کار با محصول‌اند و نرخ جاری بازار یا تجربه مشتری واقعی نیستند.</p></div>
        <div class="pricing-example-table reveal" role="region" aria-label="مقایسه آموزشی دو پیشنهاد فرضی" tabindex="0">
            <table>
                <caption>مثال آموزشی — همه اعداد فرضی هستند</caption>
                <thead><tr><th>پیشنهاد</th><th>نرخ خرید</th><th>اعتبار</th><th>زمان حمل</th><th>Free Time</th><th>شرایط پرداخت</th></tr></thead>
                <tbody>
                    <tr><th>تأمین‌کننده نمونه الف</th><td dir="ltr">1,280 USD / Container</td><td>۱۰ روز</td><td>۲۳ روز</td><td>۷ روز بارگیری / ۳ روز انتقال</td><td>پیش‌پرداخت</td></tr>
                    <tr><th>تأمین‌کننده نمونه ب</th><td dir="ltr">1,340 USD / Container</td><td>۱۴ روز</td><td>۲۰ روز</td><td>۱۰ روز بارگیری / ۵ روز انتقال</td><td>پس‌پرداخت</td></tr>
                </tbody>
            </table>
        </div>
        <ol class="pricing-scenario-grid">
            @foreach($scenarioSteps as $step)
                <li class="pricing-scenario-step reveal"><span>{{ $loop->iteration }}</span><div><h3>{{ $step['title'] }}</h3><p>{{ $step['text'] }}</p></div></li>
            @endforeach
        </ol>
    </div>
</section>

<section class="section" aria-labelledby="pricing-board-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">وضعیت پیشنهادها</span><h2 class="section-title" id="pricing-board-title">هر استعلام در کدام مرحله است؟</h2><p class="section-sub">برد مراحل، جای استعلام‌ها و پیشنهادها را در جریان فروش نشان می‌دهد؛ از بررسی نیاز تا نرخ تأمین‌کننده، ارسال پیشنهاد، پیگیری پاسخ و تبدیل به Booking.</p></div>
        <figure class="pricing-product-shot reveal">
            <a href="{{ asset('assets/images/marketing/modules/screenshots/pricing-sales-workflow.webp') }}" target="_blank" rel="noopener" aria-label="مشاهده برد مراحل فروش در اندازه کامل"><img src="{{ asset('assets/images/marketing/modules/screenshots/pricing-sales-workflow.webp') }}" width="1600" height="687" alt="برد واقعی مراحل استعلام، پیشنهاد نرخ، پیگیری مشتری و تبدیل به Booking در سپند" loading="lazy"></a>
            <figcaption>مدیر و کارشناس جای هر پرونده را می‌بینند و برای پاسخ مشتری یا ادامه پیشنهاد تأییدشده اقدام می‌کنند.</figcaption>
        </figure>
    </div>
</section>

<section class="dark-section" aria-labelledby="pricing-boundaries-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">یک فرایند، چهار مسئولیت</span><h2 class="section-title" id="pricing-boundaries-title">هر بخش سپند<br><span>کدام قسمت کار را ادامه می‌دهد؟</span></h2></div>
        <div class="pricing-boundary-grid">
            <article class="reveal"><h3><a href="{{ route('site.modules.show', ['module' => 'crm']) }}">CRM حمل‌ونقل</a></h3><p>مشتری، سابقه مذاکره، پاسخ و اقدام بعدی فروش را نگه می‌دارد.</p></article>
            <article class="reveal"><h3>نرخ‌دهی و فروش</h3><p>نرخ خرید و شرایط را بررسی و Quotation یا پیشنهاد تجاری مشتری را آماده می‌کند.</p></article>
            <article class="reveal"><h3><a href="{{ route('site.modules.show', ['module' => 'finance-accounting']) }}">مالی و حسابداری</a></h3><p>پیش‌فاکتور و رویدادهای مالی را پس از مرحله تجاری، در دامنه مالی پرونده ادامه می‌دهد.</p></article>
            <article class="reveal"><h3><a href="{{ route('site.modules.show', ['module' => 'booking']) }}">Booking</a></h3><p>پیشنهاد پذیرفته‌شده را با اطلاعات پایه تأییدشده به پرونده رزرو و عملیات تبدیل می‌کند.</p></article>
        </div>
        <p class="pricing-boundary-note reveal"><strong>Quotation با پیش‌فاکتور یکی نیست:</strong> Quotation نرخ و شرایط تجاری پیشنهادی است؛ پیش‌فاکتور سند مالی مرحله بعد است و تنها پس از انتخاب نرخ و ورود پرونده به وضعیت مربوط صادر می‌شود.</p>
    </div>
</section>

<section class="section" aria-labelledby="pricing-related-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">راهکارهای مرتبط</span><h2 class="section-title" id="pricing-related-title">جزئیات نرخ، تأمین‌کننده و<br><span>پیگیری پیشنهاد ارسالی</span></h2></div>
        <div class="pricing-related-grid">
            <article class="crm-audience reveal"><span class="section-label">Rate Master</span><h3>مدیریت نرخ و اعتبار تعرفه‌ها</h3><p>برای ثبت دامنه نرخ، دوره اعتبار، Rate Break و هزینه‌های جانبی در مخزن نرخ.</p><a href="{{ route('solutions.platform.show', ['solution' => 'rate-management']) }}">مشاهده راهکار مدیریت نرخ</a></article>
            <article class="crm-audience reveal"><span class="section-label">Supplier</span><h3>مقایسه و مدیریت تأمین‌کنندگان</h3><p>برای پروفایل تأمین‌کننده، پوشش خدمت و بررسی نرخ و سابقه عملکرد داخلی.</p><a href="{{ route('solutions.platform.show', ['solution' => 'supplier-management']) }}">مشاهده راهکار تأمین‌کنندگان</a></article>
            <article class="crm-audience reveal"><span class="section-label">Follow-up</span><h3>پیگیری پیشنهادهای ارسال‌شده</h3><p>برای مسئول، موعد، سابقه مذاکره و اقدام بعدی پس از ارسال پیشنهاد.</p><a href="{{ route('solutions.freight-sales-automation') }}">مشاهده راهکار پیگیری فروش</a></article>
        </div>
    </div>
</section>

<section class="section soft" aria-labelledby="pricing-faq-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">سؤالات متداول</span><h2 class="section-title" id="pricing-faq-title">پرسش‌های رایج درباره<br><span>نرم‌افزار نرخ‌دهی حمل‌ونقل</span></h2></div>
        <div class="faq">
            @foreach($faqs as $faq)
                <details class="reveal"><summary>{{ $faq['question'] }}</summary><p>{{ $faq['answer'] }}</p></details>
            @endforeach
        </div>
    </div>
</section>

<section class="cta-wrap"><div class="container"><div class="cta reveal"><div class="cta-copy"><h2>یک استعلام واقعی را در سپند نرخ‌دهی کنید</h2><p>در دمو، مسیر ثبت درخواست، مقایسه پیشنهادها و آماده‌سازی قیمت فروش را با یک سناریوی نمونه بررسی می‌کنیم؛ مطابق روال واقعی دمو.</p></div><div class="cta-action"><a class="btn" href="{{ route('consultation.legacy') }}" data-ga-event="cta_click" data-ga-label="pricing_sales_bottom_consultation">درخواست دموی نرخ‌دهی و فروش</a></div></div></div></section>
@endsection
