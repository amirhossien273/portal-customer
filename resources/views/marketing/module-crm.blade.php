@extends('layouts.marketing')

@php
    $capabilities = [
        [
            'title' => 'پرونده یکپارچه مشتری و افراد مرتبط',
            'description' => 'مشخصات مشتری حقیقی یا حقوقی، افراد مرتبط، اطلاعات تماس، فایل‌ها و درخواست‌های حمل را در یک پرونده ثبت می‌کنید؛ خروجی، سابقه‌ای مشترک و قابل‌جست‌وجو برای فروش و عملیات است.',
        ],
        [
            'title' => 'مدیریت سرنخ و فرصت فروش',
            'description' => 'سرنخ را از ورود تا تبدیل پیگیری می‌کنید و برای هر فرصت، مرحله مذاکره، مسئول، ارزش احتمالی، اقدام بعدی و نتیجه را مشخص نگه می‌دارید؛ بنابراین وضعیت فرصت‌های باز و بسته قابل مشاهده است.',
        ],
        [
            'title' => 'سوابق تماس، مذاکره، پیامک و فعالیت‌ها',
            'description' => 'تماس، جلسه، یادداشت، مذاکره و پیامک را در سابقه همان مشتری یا لید ثبت می‌کنید؛ پیش از ارتباط بعدی، کارشناس می‌بیند چه اقدامی انجام شده و آخرین وضعیت چه بوده است.',
        ],
        [
            'title' => 'پیگیری استعلام، مسئول و اقدام بعدی',
            'description' => 'برای استعلام یا درخواست حمل، مسئول، تسک زمان‌دار و اقدام بعدی تعیین می‌کنید؛ داشبورد، موارد عقب‌افتاده، امروز، آینده و استعلام‌های بدون پیگیری بعدی را جدا نشان می‌دهد.',
        ],
        [
            'title' => 'دید مدیر از پیگیری‌های تیم',
            'description' => 'مدیر وضعیت فرصت‌ها، مسئول هر پیگیری و نقاط نیازمند اقدام را بررسی می‌کند؛ پیش‌فاکتورهای دست‌کم ۴۸ ساعت بدون به‌روزرسانی نیز در نمای مخصوص و متناسب با سطح دسترسی دیده می‌شوند.',
        ],
        [
            'title' => 'تحلیل ارزش مشتری بر اساس عملکرد واقعی',
            'description' => 'دریافت‌های تأییدشده، پرداخت‌های انجام‌شده و تعداد کارهای عملیاتی را کنار هم می‌بینید؛ خروجی، نماهای مشتریان پردرآمد، پرسود، پرکار با سود کم و کم‌حجم اما ارزشمند است.',
        ],
    ];

    $faqs = [
        [
            'question' => 'CRM حمل‌ونقل چه تفاوتی با CRM عمومی دارد؟',
            'answer' => 'در CRM حمل‌ونقل، پرونده مشتری به استعلام، پیشنهاد نرخ، Booking و ادامه عملیات متصل است. تیم فروش و عملیات به‌جای پرونده‌های جدا، سابقه مرتبط با همان مشتری و درخواست را دنبال می‌کنند.',
        ],
        [
            'question' => 'پیگیری‌های عقب‌افتاده و موارد بدون اقدام بعدی چگونه مشخص می‌شوند؟',
            'answer' => 'داشبورد «پیگیری‌های من» استعلام‌های دارای تسک گذشته از موعد و استعلام‌های بازِ بدون تسک زمان‌دار بعدی را در دو فهرست جدا نشان می‌دهد. تسک‌های امروز و آینده نیز بر اساس موعد واقعی تفکیک می‌شوند.',
        ],
        [
            'question' => 'سوابق ارتباط و استعلام‌های هر مشتری کجا نگهداری می‌شوند؟',
            'answer' => 'اطلاعات تماس، افراد مرتبط، تماس‌ها، جلسات، یادداشت‌ها، پیامک‌ها و استعلام‌ها در پرونده همان مشتری یا لید نگهداری می‌شوند و کاربران مجاز می‌توانند سابقه را یکجا ببینند.',
        ],
        [
            'question' => 'CRM چگونه به نرخ‌دهی و Booking متصل می‌شود؟',
            'answer' => 'درخواست حمل از پرونده مشتری برای بررسی نرخ و آماده‌سازی پیشنهاد ادامه پیدا می‌کند. پس از تأیید مشتری، پرونده تأییدشده می‌تواند به Booking تبدیل شود و اطلاعات پایه در همان جریان باقی بماند.',
        ],
        [
            'question' => 'مدیر فروش چه اطلاعاتی از وضعیت مشتریان و پیگیری‌ها می‌بیند؟',
            'answer' => 'مدیر وضعیت فرصت‌ها، مسئول پیگیری، اقدام‌های عقب‌افتاده یا بدون اقدام بعدی و نماهای تحلیلی مشتریان بر اساس درآمد تأییدشده، سود و تعداد کارهای عملیاتی را می‌بیند؛ نتیجه‌ها مطابق سطح دسترسی نمایش داده می‌شوند.',
        ],
    ];
@endphp

@push('head')
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'SoftwareApplication',
            'name' => 'نرم افزار CRM حمل و نقل سپند',
            'applicationCategory' => 'BusinessApplication',
            'operatingSystem' => 'Web',
            'description' => $module['meta_description'],
            'url' => route('site.modules.show', ['module' => $slug]),
            'featureList' => array_column($capabilities, 'title'),
            'audience' => [
                '@type' => 'BusinessAudience',
                'audienceType' => 'شرکت‌های حمل‌ونقل، فورواردری، لجستیکی و بازرگانی',
            ],
        ],
        [
            '@type' => 'FAQPage',
            'mainEntity' => array_map(static fn (array $faq): array => [
                '@type' => 'Question',
                'name' => $faq['question'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $faq['answer'],
                ],
            ], $faqs),
        ],
        [
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'صفحه اصلی', 'item' => route('home')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'ماژول‌های نرم‌افزار', 'item' => route('modules')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => 'CRM حمل‌ونقل', 'item' => route('site.modules.show', ['module' => $slug])],
            ],
        ],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endpush

@include('marketing.partials.module-rich-styles')

@section('content')
<section class="page-hero">
    <div class="container hero-inner">
        <div class="hero-copy crm-hero-copy reveal">
            <div class="breadcrumb"><a href="{{ route('home') }}">صفحه اصلی</a><svg viewBox="0 0 24 24" fill="none"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg><a href="{{ route('modules') }}">ماژول‌ها</a><svg viewBox="0 0 24 24" fill="none"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg><span>CRM حمل‌ونقل</span></div>
            <h1 class="module-hero-title">
                <span class="module-hero-title-main">نرم‌افزار CRM برای شرکت‌های</span>
                <span class="module-hero-title-accent">حمل‌ونقل و فورواردری</span>
            </h1>
            <p class="crm-lead">برای شرکت‌های حمل‌ونقل بین‌المللی، فورواردری و تیم‌های فروش آن‌ها، پراکندگی سوابق مشتری و فراموش‌شدن پیگیری‌ها یعنی فرصت‌هایی که بدون اقدام بعدی می‌مانند. در CRM سپند، مشتری، افراد مرتبط، مذاکره، استعلام، مسئول، موعد و اقدام بعدی در یک پرونده مرتبط ثبت می‌شوند.</p>
            <div class="hero-actions">
                <a class="btn btn-primary" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="crm_hero_consultation">درخواست دموی CRM حمل‌ونقل</a>
                <a class="btn btn-outline" href="#crm-features">مشاهده امکانات CRM</a>
            </div>
        </div>
        <div class="hero-art crm-hero-art reveal">
            @include('marketing.partials.module-screenshot-slider')
        </div>
    </div>
</section>

@if (! empty($page['search_answer'] ?? null))
<section class="section soft" id="crm-search-answer">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label">پاسخ کوتاه برای انتخاب درست</span>
            <h2 class="section-title">{{ $page['search_answer']['heading'] }}</h2>
            <p class="crm-intro">{{ $page['search_answer']['text'] }}</p>
        </div>
        @if (! empty($page['search_answer']['items'] ?? []))
            <div class="crm-outcomes">
                @foreach ($page['search_answer']['items'] as $item)
                    <div class="crm-outcome reveal">{{ $item }}</div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endif

<section class="section soft" id="crm-follow-ups" aria-labelledby="crm-follow-ups-title">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label">پیگیری‌های من</span>
            <h2 class="section-title" id="crm-follow-ups-title">اولویت پیگیری فروش را<br><span>پیش از شروع روز ببینید</span></h2>
            <p class="section-sub">داشبورد واقعی سپند، وضعیت استعلام‌های باز و تسک‌های زمان‌دار را در چهار فهرست جدا نمایش می‌دهد تا کارشناس بداند کدام مشتری اکنون به اقدام نیاز دارد.</p>
        </div>
        <figure class="crm-follow-up-figure reveal">
            <a href="{{ asset('assets/images/marketing/product-showcase/desktop-dashboard.webp') }}" target="_blank" rel="noopener">
                <img src="{{ asset('assets/images/marketing/product-showcase/desktop-dashboard.webp') }}" alt="داشبورد واقعی پیگیری‌های من با نمایش استعلام‌های عقب‌افتاده، بدون اقدام بعدی، کارهای امروز و پیگیری‌های آینده" width="1600" height="799">
            </a>
            <figcaption>داشبورد «پیگیری‌های من»؛ برای بزرگ‌نمایی تصویر را باز کنید.</figcaption>
        </figure>
        <div class="crm-capability-grid crm-follow-up-grid">
            <article class="crm-capability reveal"><span class="crm-capability-num">01</span><h3>پیگیری‌های عقب‌افتاده</h3><p>استعلام‌های بازی که تسک فعال آن‌ها از موعد گذشته است جدا می‌شوند. در جزئیات، مشتری، مالک پرونده، عنوان تسک، سررسید و میزان تأخیر دیده می‌شود.</p></article>
            <article class="crm-capability reveal"><span class="crm-capability-num">02</span><h3>موارد بدون اقدام بعدی</h3><p>استعلام بازِ بدون تسک فعال و زمان‌دار مشخص می‌شود تا کارشناس پس از دیدن آخرین فعالیت، پیگیری تازه‌ای برای آن ثبت کند.</p></article>
            <article class="crm-capability reveal"><span class="crm-capability-num">03</span><h3>کارهای امروز</h3><p>تسک‌های فعال تا پایان روز، بر اساس نزدیک‌ترین موعد مرتب می‌شوند. هر موردی که از موعد بگذرد به گروه عقب‌افتاده منتقل می‌شود.</p></article>
            <article class="crm-capability reveal"><span class="crm-capability-num">04</span><h3>پیگیری‌های آینده</h3><p>تسک‌های فعال از فردا به بعد به ترتیب موعد دیده می‌شوند تا برنامه تماس‌ها و اقدام‌های روزهای بعد از قبل روشن باشد.</p></article>
        </div>
        <div class="crm-problem crm-follow-up-note reveal">
            <strong>مسئول، موعد و نتیجه پیگیری</strong>
            <p>مسئول و موعد هر تسک در پرونده مشخص است. کارشناس پس از تماس، فعالیت یا پاسخ مشتری را در سابقه ثبت می‌کند و در صورت نیاز اقدام بعدی تازه‌ای می‌سازد. یادآوری داخلی و در صورت انتخاب کاربر، پیامکی است؛ تعویق یادآوری، موعد اصلی تسک را تغییر نمی‌دهد.</p>
        </div>
    </div>
</section>

<section class="section" aria-labelledby="crm-problems-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">مسئله و راهکار</span><h2 class="section-title" id="crm-problems-title">نرم‌افزار CRM حمل‌ونقل چه<br><span>مشکلاتی را حل می‌کند؟</span></h2></div>
        <p class="crm-intro reveal">وقتی آخرین مذاکره، درخواست حمل و اقدام بعدی در فایل‌ها و پیام‌های جدا بماند، پاسخ‌گویی به مشتری و تحویل کار میان اعضای تیم کند می‌شود. CRM سپند این اطلاعات را در پرونده همان مشتری به هم مرتبط نگه می‌دارد.</p>
        <div class="crm-problem reveal"><strong>چالش رایج شرکت‌های حمل‌ونقل و لجستیک</strong><p>وقتی آخرین مذاکره، درخواست حمل و اقدام بعدی مشتری در منابع مختلف ثبت شده باشد، تیم فروش تصویر کاملی از وضعیت رابطه با مشتری ندارد و واحد عملیات نیز اطلاعات اولیه را دوباره جمع‌آوری می‌کند.</p></div>
        <div class="crm-problem-grid">
            <article class="crm-problem-card reveal"><h3>پرونده یکپارچه مشتری</h3><p>اطلاعات تماس، سوابق مکالمات، استعلام‌ها، درخواست‌های حمل، اسناد و فعالیت‌های انجام‌شده برای هر مشتری در یک پرونده ثبت می‌شود. کارشناسان بدون جست‌وجو در فایل‌ها و پیام‌های پراکنده، سابقه همکاری را مشاهده می‌کنند.</p></article>
            <article class="crm-problem-card reveal"><h3>مدیریت سرنخ و فرصت فروش</h3><p>سرنخ‌های جدید از لحظه ورود تا تبدیل‌شدن به مشتری قابل پیگیری هستند. مرحله مذاکره، مسئول پیگیری، ارزش احتمالی، تاریخ اقدام بعدی و نتیجه نهایی هر فرصت مشخص باقی می‌ماند.</p></article>
            <article class="crm-problem-card reveal"><h3>پیگیری عملیاتی و قابل‌ردیابی</h3><p>داشبورد شخصی، استعلام‌های عقب‌افتاده یا بدون اقدام بعدی و تسک‌های امروز و آینده را تفکیک می‌کند. تماس‌ها، جلسات، پیامک‌ها و یادآوری‌ها نیز در سابقه پرونده باقی می‌مانند.</p></article>
        </div>
        <ul class="crm-outcomes"><li class="reveal">سابقه مشترک مشتری</li><li class="reveal">مسئول و اقدام بعدی روشن</li><li class="reveal">پیگیری قابل مشاهده برای تیم</li></ul>
    </div>
</section>

<section class="section soft" id="crm-features" aria-labelledby="crm-features-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">امکانات اصلی</span><h2 class="section-title" id="crm-features-title">امکانات ماژول CRM و<br><span>مدیریت مشتریان سپند</span></h2><p class="section-sub">ابزارهای موردنیاز تیم بازاریابی و فروش، از ثبت نخستین سرنخ تا انتقال اطلاعات مشتری به فرایند اجرایی، در یک مسیر قابل‌ردیابی کنار هم قرار می‌گیرند.</p></div>
        <div class="crm-capability-grid">
            @foreach($capabilities as $index => $capability)
                <article class="crm-capability reveal"><span class="crm-capability-num">{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</span><h3>{{ $capability['title'] }}</h3><p>{{ $capability['description'] }}</p></article>
            @endforeach
        </div>
        <p class="crm-feature-links reveal">برای آماده‌سازی پیشنهاد، <a href="{{ route('site.modules.show', ['module' => 'pricing-sales']) }}">نرخ‌گیری و فروش حمل</a> را ببینید. اگر پیگیری‌های پرتکرار باید بر اساس رویداد ساخته شوند، جزئیات <a href="{{ route('site.modules.show', ['module' => 'automatic-tasks']) }}">ساخت خودکار وظایف</a> در صفحه تخصصی آن آمده است.</p>
    </div>
</section>

<section class="section" id="crm-scenario" aria-labelledby="crm-scenario-title">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label">سناریوی آموزشی</span>
            <h2 class="section-title" id="crm-scenario-title">از درخواست حمل تا<br><span>پیگیری پاسخ مشتری</span></h2>
            <p class="section-sub">فرض کنید مشتری برای حمل دریایی از نینگبو به بندرعباس درخواست نرخ داده است. این مثال آموزشی است و تجربه یک مشتری واقعی نیست.</p>
        </div>
        <ol class="crm-scenario-grid">
            <li class="crm-scenario-step reveal"><span>۱</span><div><h3>ثبت مشتری و درخواست حمل</h3><p>کارشناس مشتری، افراد مرتبط و درخواست حمل را ثبت می‌کند؛ نتیجه در پرونده مشتری و فهرست استعلام‌ها دیده می‌شود.</p></div></li>
            <li class="crm-scenario-step reveal"><span>۲</span><div><h3>تعیین مسئول و اقدام بعدی</h3><p>مالک استعلام و تسک بعدی با موعد مشخص می‌شوند؛ مسئول و سررسید در جزئیات پیگیری قابل مشاهده‌اند.</p></div></li>
            <li class="crm-scenario-step reveal"><span>۳</span><div><h3>ارجاع برای بررسی نرخ</h3><p>مسیر و مشخصات درخواست برای بررسی نرخ ادامه پیدا می‌کند. محاسبه و مقایسه تأمین‌کننده در <a href="{{ route('site.modules.show', ['module' => 'pricing-sales']) }}">ماژول نرخ‌دهی و فروش</a> انجام می‌شود.</p></div></li>
            <li class="crm-scenario-step reveal"><span>۴</span><div><h3>ثبت ارسال پیشنهاد و موعد پیگیری</h3><p>ارسال پیشنهاد در پرونده ثبت و برای تماس یا دریافت پاسخ، تسک زمان‌دار تعیین می‌شود.</p></div></li>
            <li class="crm-scenario-step reveal"><span>۵</span><div><h3>ثبت پاسخ یا ادامه پیگیری</h3><p>پاسخ مشتری یا فعالیت انجام‌شده در سابقه ثبت می‌شود؛ اگر تصمیم نهایی نشده باشد، اقدام بعدی تازه‌ای ساخته می‌شود.</p></div></li>
            <li class="crm-scenario-step reveal"><span>۶</span><div><h3>ادامه پرونده تأییدشده در Booking</h3><p>پس از تأیید پیشنهاد، استعلام، مشتری و پیشنهاد پذیرفته‌شده در <a href="{{ route('site.modules.show', ['module' => 'booking']) }}">Booking مرتبط</a> ادامه پیدا می‌کنند.</p></div></li>
        </ol>
    </div>
</section>

<section class="section soft" aria-labelledby="crm-sales-solution-title">
    <div class="container">
        <div class="crm-solution-card reveal">
            <div><span class="section-label">راهکار مرتبط</span><h2 id="crm-sales-solution-title">پیگیری استعلام و پیشنهاد نرخ</h2><p>برای هر استعلام، مسئول و موعد پیگیری را روشن کنید و موارد عقب‌افتاده یا بدون اقدام بعدی را در فهرست‌های جدا ببینید. صفحه راهکار، کاربرد این امکانات را در جریان فروش حمل توضیح می‌دهد.</p></div>
            <a class="btn btn-outline" href="{{ route('solutions.freight-sales-automation') }}">مشاهده راهکار پیگیری فروش حمل</a>
        </div>
    </div>
</section>

<section class="section" id="crm-analytics" aria-labelledby="crm-analytics-title">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label">تحلیل ارزش مشتری</span>
            <h2 class="section-title" id="crm-analytics-title">کدام مشتری فقط پرکار است و<br><span>کدام مشتری واقعاً ارزش می‌سازد؟</span></h2>
            <p class="section-sub">چهار نمای تحلیلی با داده‌های مالی تأییدشده و تعداد کارهای عملیاتی، کیفیت رابطه تجاری با هر مشتری را از زاویه متفاوت نشان می‌دهند.</p>
        </div>
        <div class="crm-capability-grid">
            <article class="crm-capability reveal">
                <span class="crm-capability-num">01</span>
                <h3>مشتریان با بیشترین درآمد</h3>
                <p><strong>فرمول:</strong> مجموع مبالغ دریافت‌های تأییدشده هر مشتری. این نما مشتریانی را مشخص می‌کند که بیشترین جریان ورودی مالی را ایجاد کرده‌اند.</p>
            </article>
            <article class="crm-capability reveal">
                <span class="crm-capability-num">02</span>
                <h3>مشتریان با بیشترین سود</h3>
                <p><strong>فرمول:</strong> دریافت‌های تأییدشده منهای پرداخت‌های انجام‌شده. رتبه‌بندی بر اساس سود خالص است، نه صرفاً مبلغ فروش یا تعداد پرونده.</p>
            </article>
            <article class="crm-capability reveal">
                <span class="crm-capability-num">03</span>
                <h3>کار زیاد با سود کم</h3>
                <p><strong>فرمول:</strong> ابتدا تعداد کارهای عملیاتی بیشتر و سپس سود متوسط کمتر به ازای هر کار. این نما پرونده‌های پرتعداد با بازده پایین را برای بازنگری قیمت یا فرایند آشکار می‌کند.</p>
            </article>
            <article class="crm-capability reveal">
                <span class="crm-capability-num">04</span>
                <h3>حجم کم اما بسیار ارزشمند</h3>
                <p><strong>فرمول:</strong> سود خالص تقسیم بر تعداد کارهای عملیاتی؛ با اولویت سود بیشتر به ازای هر کار و تعداد کار کمتر. این مشتریان می‌توانند گزینه مناسبی برای توسعه رابطه باشند.</p>
            </article>
        </div>
    </div>
</section>

<section class="section" id="crm-sms" aria-labelledby="crm-sms-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">بازاریابی پیامکی در CRM</span><h2 class="section-title" id="crm-sms-title">ارسال پیامک و مشاهده سوابق<br><span>ارتباط با مشتری</span></h2><p class="section-sub">پنل پیامکی CRM سپند، ارسال و پیگیری پیام را به‌جای یک ابزار جداگانه، به پرونده مشتری و جریان واقعی فروش متصل می‌کند.</p></div>
        <div class="crm-problem-grid">
            <article class="crm-problem-card reveal"><h3>ارسال مستقیم از پرونده</h3><p>در صفحه مشتری، لید یا استعلام، دکمه ارسال پیامک پنجره‌ای باز می‌کند تا کاربر مجاز شماره ثبت‌شده و متن پیام را انتخاب کند؛ بدون اینکه از پرونده جاری خارج شود.</p></article>
            <article class="crm-problem-card reveal"><h3>لاگ کامل پیامک‌ها</h3><p>زمان، گیرنده، متن، کاربر ارسال‌کننده، شناسه درخواست و وضعیت ارسال در تاریخچه ذخیره می‌شود. سوابق مرتبط نیز در صفحه همان مشتری یا لید قابل مشاهده‌اند.</p></article>
            <article class="crm-problem-card reveal"><h3>مرکز فراز اس‌ام‌اس</h3><p>لاگ ارسال‌ها، جزئیات و وضعیت گیرندگان، صندوق ورودی، موجودی حساب و فرایند شارژ کیف پول از بخش مارکتینگ در دسترس قرار می‌گیرند.</p></article>
            <article class="crm-problem-card reveal"><h3>تنظیمات مستقل هر سازمان</h3><p>هر سازمان کلید API و شماره خط فراز اس‌ام‌اس خود را در فضای کاری‌اش ثبت می‌کند. این تنظیمات جداگانه و امن نگهداری می‌شوند و فقط در همان سازمان استفاده خواهند شد.</p></article>
        </div>
    </div>
</section>

<section class="section" aria-labelledby="crm-integration-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">فرایند یکپارچه</span><h2 class="section-title" id="crm-integration-title">اتصال CRM به بازاریابی، فروش و<br><span>عملیات حمل</span></h2><p class="section-sub">CRM سپند یک سیستم جدا از عملیات شرکت نیست. اطلاعات ثبت‌شده در بازاریابی و فروش، از پیامک و وظیفه پیگیری تا استعلام و پیشنهاد، بدون ورود مجدد به مراحل قرارداد، Booking و عملیات منتقل می‌شود؛ در نتیجه خطا و دوباره‌کاری کاهش می‌یابد.</p></div>
        <p class="section-sub reveal">برای مشاهده این مسیر در کنار نرخ‌دهی، اسناد و مالی، نمای کامل <a href="{{ route('product') }}">نرم‌افزار یکپارچه فورواردری</a> را ببینید.</p>
        <div class="crm-process-grid">
            <article class="crm-process reveal"><span class="crm-process-step">۱</span><h3>بازاریابی و فروش</h3><p>لیدها، استعلام‌ها، پیامک‌ها، مذاکرات، فعالیت‌های پیگیری و فرصت‌های فروش در این مرحله مدیریت می‌شوند. مدیر فروش وضعیت هر فرصت، مسئول پیگیری و مرحله فعلی مذاکره را مشاهده می‌کند.</p><a href="{{ route('site.modules.show', ['module' => 'pricing-sales']) }}">مشاهده ماژول نرخ‌دهی و فروش</a></article>
            <article class="crm-process reveal"><span class="crm-process-step">۲</span><h3>قرارداد و Booking</h3><p>پس از تأیید پیشنهاد و توافق با مشتری، مشخصات مشتری و درخواست حمل به ادامه فرایند منتقل می‌شود. به این ترتیب نیازی به ثبت مجدد اطلاعات پایه و جزئیات اولیه درخواست نیست.</p><a href="{{ route('site.modules.show', ['module' => 'booking']) }}">مشاهده ماژول Booking</a></article>
            <article class="crm-process reveal"><span class="crm-process-step">۳</span><h3>عملیات حمل</h3><p>تیم عملیات به اطلاعات مرتبط با مشتری، درخواست ثبت‌شده و سوابق موردنیاز دسترسی دارد. وضعیت پرونده حمل نیز مبنایی برای پاسخ‌گویی سریع‌تر و دقیق‌تر واحدهای مرتبط به مشتری خواهد بود.</p><a href="{{ route('site.modules.show', ['module' => 'transport-operations']) }}">مشاهده ماژول عملیات حمل</a></article>
        </div>
    </div>
</section>

<section class="dark-section" aria-labelledby="crm-benefits-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">مزیت‌های عملیاتی</span><h2 class="section-title" id="crm-benefits-title">مزایای استفاده از CRM سپند در<br><span>شرکت‌های حمل‌ونقل</span></h2></div>
        <p class="crm-benefit-intro reveal">تفاوت این CRM فورواردری با یک دفترچه مشتری عمومی، ارتباط پرونده مشتری با استعلام، پیشنهاد و Booking است. خروجی‌های زیر در خود محصول قابل مشاهده‌اند.</p>
        <ul class="crm-benefits-grid">
            <li class="reveal">تشخیص استعلام‌های بدون اقدام بعدی</li>
            <li class="reveal">تفکیک تسک‌های عقب‌افتاده، امروز و آینده</li>
            <li class="reveal">یادآوری داخلی و پیامکی متناسب با انتخاب کاربر</li>
            <li class="reveal">پیگیری مشتریان دارای پیش‌فاکتور ۴۸ ساعته</li>
            <li class="reveal">ردیابی پیامک‌های ارسالی در پرونده مشتری</li>
            <li class="reveal">تحلیل درآمد، سود و حجم کار مشتری</li>
        </ul>
    </div>
</section>

<section class="section" aria-labelledby="crm-audience-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">مخاطبان ماژول</span><h2 class="section-title" id="crm-audience-title">ماژول CRM سپند مناسب<br><span>چه شرکت‌هایی است؟</span></h2><p class="section-sub">این ماژول برای مجموعه‌هایی طراحی شده است که ارتباط مستمر با مشتری، پیگیری استعلام‌ها و هماهنگی میان فروش و عملیات بخش مهمی از فعالیت روزانه آن‌هاست.</p></div>
        <div class="crm-audience-grid">
            <article class="crm-audience reveal"><h3>شرکت‌های حمل‌ونقل بین‌المللی</h3><p>برای مدیریت مشتریان، درخواست‌های حمل و پیگیری فرصت‌ها در مسیرهای مختلف.</p></article>
            <article class="crm-audience reveal"><h3>شرکت‌های فورواردری و لجستیکی</h3><p>برای اتصال مذاکرات فروش و استعلام‌ها به Booking و اجرای عملیات.</p></article>
            <article class="crm-audience reveal"><h3>تیم‌های فروش سازمانی</h3><p>برای تعیین مسئول، مرحله مذاکره و اقدام بعدی هر مشتری یا فرصت.</p></article>
            <article class="crm-audience reveal"><h3>مدیران فروش و عملیات</h3><p>برای داشتن دید مشترک از مشتری، مذاکره، تعهدات و مرحله اجرای خدمت.</p></article>
        </div>
    </div>
</section>

@include('marketing.partials.related-content-pages')

<section class="section soft" aria-labelledby="crm-faq-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">سؤالات متداول</span><h2 class="section-title" id="crm-faq-title">سؤالات متداول درباره<br><span>نرم‌افزار CRM حمل‌ونقل</span></h2></div>
        <p class="crm-faq-intro reveal">پاسخ پرسش‌های رایج شرکت‌های حمل‌ونقل و لجستیک درباره کاربرد CRM تخصصی سپند و ارتباط آن با سایر بخش‌های نرم‌افزار.</p>
        <div class="faq">
            @foreach($faqs as $faq)
                <details class="reveal"><summary>{{ $faq['question'] }}</summary><p>{{ $faq['answer'] }}</p></details>
            @endforeach
        </div>
    </div>
</section>

<section class="cta-wrap"><div class="container"><div class="cta reveal"><div class="cta-copy"><h2>پیگیری مشتریان خود را در CRM سپند ببینید</h2><p>در جلسه دمو، ثبت مشتری و استعلام، تعیین مسئول و موعد، «پیگیری‌های من»، سوابق پیامک و تحلیل ارزش مشتری را با سناریوی تیم شما مرور می‌کنیم.</p></div><div class="cta-action"><a class="btn" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="crm_bottom_consultation">درخواست دموی CRM حمل‌ونقل</a></div></div></div></section>
@endsection
