@extends('layouts.marketing')

@php
    $title = 'چرا سپند؟ | نرم افزار تخصصی مدیریت شرکت‌های حمل‌ونقل و فورواردری';
    $description = 'ببینید چرا سپند برای اتصال CRM، نرخ‌دهی، Booking، عملیات، اسناد و امور مالی شرکت‌های حمل‌ونقل و فورواردری طراحی شده است.';
    $canonical = route('why-sepand');
    $image = asset('assets/images/marketing/modules/screenshots/pricing-sales-workflow.webp');
    $imageAlt = 'جریان واقعی نرخ‌دهی و تبدیل استعلام به Booking در نرم‌افزار سپند';
    $imageWidth = 1600;
    $imageHeight = 687;

    $fragmentedTools = ['اکسل', 'واتس‌اپ', 'ایمیل', 'CRM عمومی', 'فایل‌های شخصی', 'گزارش دستی'];

    $dailyProblems = [
        [
            'number' => '۰۱',
            'title' => 'اطلاعات پراکنده',
            'text' => 'اطلاعات مشتری و پرونده حمل بین چند ابزار و فایل پخش می‌شود.',
            'solution' => 'اطلاعات مرتبط را در یک ساختار مشترک نگه می‌دارد.',
        ],
        [
            'number' => '۰۲',
            'title' => 'پیگیری وابسته به افراد',
            'text' => 'کارها، موعدها و اقدامات بعدی ممکن است در پیام‌ها یا حافظه افراد باقی بمانند.',
            'solution' => 'کار بعدی، مسئول و مهلت انجام را قابل مشاهده می‌کند.',
        ],
        [
            'number' => '۰۳',
            'title' => 'فاصله بین فروش و عملیات',
            'text' => 'پس از تأیید پیشنهاد نرخ، اطلاعات باید دوباره به تیم عملیات منتقل شوند.',
            'solution' => 'اطلاعات فروش را در همان پرونده به Booking و عملیات حمل می‌رساند.',
        ],
        [
            'number' => '۰۴',
            'title' => 'دیر مشخص شدن نتیجه مالی',
            'text' => 'هزینه و درآمد همیشه در کنار همان پرونده حمل قابل مشاهده نیستند.',
            'solution' => 'هزینه، درآمد و نتیجه مالی را به همان پرونده متصل می‌کند.',
        ],
    ];

    $genericCrmFlow = ['سرنخ فروش', 'فرصت فروش', 'فروش'];
    $specializedFlow = ['سرنخ فروش', 'استعلام', 'نرخ‌دهی', 'پیشنهاد نرخ', 'Booking', 'عملیات حمل', 'اسناد و مالی'];
    $flowNumbers = ['۰۱', '۰۲', '۰۳', '۰۴', '۰۵', '۰۶', '۰۷', '۰۸'];

    $pillars = [
        [
            'number' => '۰۱',
            'title' => 'تخصصی برای فورواردری',
            'description' => 'ساختار سپند بر اساس زبان، نقش‌ها و مسیر واقعی پرونده در شرکت‌های فورواردری طراحی شده است.',
        ],
        [
            'number' => '۰۲',
            'title' => 'اطلاعات فقط یک بار وارد می‌شوند',
            'description' => 'اطلاعات مشتری و درخواست حمل همراه همان پرونده حرکت می‌کنند و در هر واحد از نو ساخته نمی‌شوند.',
        ],
        [
            'number' => '۰۳',
            'title' => 'فروش و عملیات از هم جدا نیستند',
            'description' => 'پیشنهاد نرخ تأییدشده در همان جریان به Booking و عملیات حمل می‌رسد و تحویل پرونده شفاف‌تر می‌شود.',
        ],
        [
            'number' => '۰۴',
            'title' => 'کار به حافظه افراد وابسته نمی‌ماند',
            'description' => 'کارها، مسئولیت‌ها، مهلت انجام و یادآوری‌ها ثبت می‌شوند تا پیگیری به حافظه افراد وابسته نماند.',
        ],
        [
            'number' => '۰۵',
            'title' => 'مدیر نتیجه را می‌بیند، نه فقط داده را',
            'description' => 'اطلاعات فروش، عملیات و مالی کنار هم قرار می‌گیرند تا وضعیت پرونده‌ها و نتیجه کسب‌وکار روشن باشد.',
        ],
    ];

    $metrics = [
        ['code' => '۰۱', 'title' => 'ورود مجدد اطلاعات', 'question' => 'اطلاعات مشتری یا پرونده حمل چند بار دوباره ثبت می‌شوند؟'],
        ['code' => '۰۲', 'title' => 'کارهای عقب‌افتاده', 'question' => 'چه تعداد کار از مهلت انجام خود عبور کرده‌اند؟'],
        ['code' => '۰۳', 'title' => 'زمان پاسخ به مشتری', 'question' => 'کارشناس چقدر سریع به وضعیت پرونده دسترسی پیدا می‌کند؟'],
        ['code' => '۰۴', 'title' => 'نرخ‌های منقضی‌شده', 'question' => 'چند پیشنهاد نرخ بدون اقدام بعدی منقضی شده‌اند؟'],
        ['code' => '۰۵', 'title' => 'سود هر پرونده', 'question' => 'درآمد و هزینه هر Booking چگونه با هم مقایسه می‌شوند؟'],
        ['code' => '۰۶', 'title' => 'ارزش مالی هر مشتری', 'question' => 'کدام مشتری در کنار حجم کار، ارزش مالی بیشتری ایجاد می‌کند؟'],
        ['code' => '۰۷', 'title' => 'زمان تهیه گزارش مدیریتی', 'question' => 'تهیه تصویر مدیریتی شرکت چقدر به جمع‌آوری دستی اطلاعات وابسته است؟'],
    ];

    $evidence = [
        [
            'number' => '۰۱',
            'title' => 'از فروش تا Booking',
            'caption' => 'اطلاعات فروش بدون ورود مجدد، وارد مرحله Booking می‌شوند.',
            'path' => 'modules/screenshots/pricing-sales-workflow.webp',
            'alt' => 'برد واقعی سپند از استعلام قیمت تا تأیید مشتری و تبدیل به Booking',
            'width' => 1600,
            'height' => 687,
            'cta' => 'مشاهده این مرحله در نرم‌افزار',
            'url' => route('product').'#pricing',
        ],
        [
            'number' => '۰۲',
            'title' => 'از Booking تا مالی',
            'caption' => 'هزینه‌ها و درآمدها در کنار همان پرونده حمل قابل بررسی هستند.',
            'path' => 'modules/screenshots/finance-booking-reconciliation.webp',
            'alt' => 'نمای واقعی تطبیق مالی Booking شامل پیشنهاد نرخ، دریافت، پرداخت و نرخ تبدیل در سپند',
            'width' => 1600,
            'height' => 811,
            'cta' => 'مشاهده بخش مالی در محصول',
            'url' => route('product').'#finance',
        ],
        [
            'number' => '۰۳',
            'title' => 'دید مدیریتی',
            'caption' => 'اطلاعات فروش، عملیات و فعالیت‌های تیم در داشبورد مدیریتی قابل مشاهده‌اند.',
            'path' => 'product-showcase/desktop-reports.webp',
            'alt' => 'گزارش‌های واقعی مدیریتی سپند برای مقایسه لید، مشتری، استعلام و Booking',
            'width' => 1600,
            'height' => 844,
            'cta' => 'مشاهده نمونه واقعی داشبورد',
            'url' => route('product').'#dashboard',
        ],
    ];

    $fitItems = [
        'شرکت فورواردری یا حمل‌ونقل بین‌المللی دارید.',
        'فروش و عملیات روی یک پرونده مشتری کار می‌کنند.',
        'نرخ‌دهی و Booking بخشی از کار روزانه شماست.',
        'اطلاعات بین چند ابزار یا فایل پراکنده شده‌اند.',
        'به دید مدیریتی از فروش تا نتیجه مالی نیاز دارید.',
    ];

    $notFitItems = [
        'فقط یک CRM ساده برای ثبت تماس مشتری می‌خواهید.',
        'Booking یا عملیات حمل ندارید.',
        'فقط نرم‌افزار حسابداری می‌خواهید.',
        'فرایند اصلی شما ارتباطی با فورواردری ندارد.',
    ];

    $finalFlow = ['مشتری', 'CRM', 'استعلام', 'پیشنهاد نرخ', 'Booking', 'عملیات حمل', 'اسناد و مالی', 'مدیریت'];

    $structuredData = [
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'WebPage',
                '@id' => route('why-sepand').'#webpage',
                'url' => route('why-sepand'),
                'name' => $title,
                'description' => $description,
                'inLanguage' => 'fa-IR',
                'primaryImageOfPage' => ['@type' => 'ImageObject', 'url' => $image, 'width' => $imageWidth, 'height' => $imageHeight],
                'about' => ['@id' => route('why-sepand').'#software'],
            ],
            [
                '@type' => 'SoftwareApplication',
                '@id' => route('why-sepand').'#software',
                'name' => 'سپند CRM',
                'applicationCategory' => 'BusinessApplication',
                'operatingSystem' => 'Web',
                'url' => route('product'),
                'description' => $description,
                'image' => $image,
                'inLanguage' => 'fa-IR',
            ],
            [
                '@type' => 'BreadcrumbList',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => 'صفحه اصلی', 'item' => route('home')],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => 'چرا سپند؟', 'item' => route('why-sepand')],
                ],
            ],
        ],
    ];
@endphp

@push('head')
    <script type="application/ld+json">{!! json_encode($structuredData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endpush

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/marketing-why-sepand.css') }}?v=20260827-2">
@endpush

@section('content')
    <section class="why-hero" aria-labelledby="why-sepand-title">
        <div class="container why-hero-grid">
            <div class="why-hero-copy reveal visible">
                <nav class="breadcrumb" aria-label="مسیر راهنما">
                    <a href="{{ route('home') }}">صفحه اصلی</a>
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                    <span>چرا سپند؟</span>
                </nav>
                <span class="why-eyebrow">چرا سپند؟</span>
                <h1 id="why-sepand-title">وقتی فروش، عملیات و مالی جدا از هم کار می‌کنند، <span>مشکل فقط پراکندگی اطلاعات نیست</span></h1>
                <p>سپند برای شرکت‌های حمل‌ونقل و فورواردری طراحی شده تا اطلاعات مشتری، نرخ‌دهی، Booking، عملیات، اسناد و مالی در یک جریان مشترک مدیریت شوند.</p>
                <div class="why-hero-actions">
                    <a class="btn btn-primary" href="{{ route('product') }}" data-ga-event="cta_click" data-ga-label="why_hero_product">مشاهده سپند در عمل</a>
                    <a class="btn btn-outline" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="why_hero_consultation">درخواست دمو</a>
                </div>
            </div>

            <div class="why-hero-visual reveal visible" role="img" aria-label="ابزارهای پراکنده در برابر جریان یکپارچه سپند">
                <div class="why-tools-panel">
                    <span>روش پراکنده</span>
                    <div class="why-tools-cloud">
                        @foreach($fragmentedTools as $tool)
                            <b>{{ $tool }}</b>
                        @endforeach
                    </div>
                </div>
                <div class="why-visual-connector" aria-hidden="true"><span>اطلاعات یک پرونده</span><i>←</i></div>
                <div class="why-sepand-panel">
                    <div class="why-sepand-mark" aria-hidden="true">S</div>
                    <div><small>جریان مشترک</small><strong>سپند</strong></div>
                    <p>فروش <i></i> عملیات <i></i> مالی</p>
                </div>
            </div>
        </div>
    </section>

    <section class="why-fragmented" aria-labelledby="fragmented-title">
        <div class="container">
            <header class="why-section-head reveal">
                <span>مسئله اصلی</span>
                <h2 id="fragmented-title">وقتی ابزارها جدا هستند، فرایند هم تکه‌تکه می‌شود</h2>
                <p>پراکندگی فقط محل نگهداری اطلاعات را تغییر نمی‌دهد؛ تحویل کار بین فروش، عملیات و مالی را هم دشوار می‌کند.</p>
            </header>
            <div class="why-problem-grid">
                @foreach($dailyProblems as $problem)
                    <article class="why-problem-card reveal">
                        <span>{{ $problem['number'] }}</span>
                        <h3>{{ $problem['title'] }}</h3>
                        <p>{{ $problem['text'] }}</p>
                        <strong><span>نقش سپند:</span> {{ $problem['solution'] }}</strong>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="why-pillars" aria-labelledby="pillars-title">
        <div class="container">
            <header class="why-section-head reveal">
                <span>دلیل انتخاب</span>
                <h2 id="pillars-title">چرا سپند با ابزارهای عمومی متفاوت است؟</h2>
                <p>تفاوت اصلی در تعداد منوها نیست؛ در ساختاری است که ارتباط بین واحدها را حفظ می‌کند.</p>
            </header>
            <div class="why-pillar-grid">
                @foreach($pillars as $pillar)
                    <article class="why-pillar-card reveal">
                        <div class="why-pillar-number">{{ $pillar['number'] }}</div>
                        <h3>{{ $pillar['title'] }}</h3>
                        <p>{{ $pillar['description'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="why-crm" aria-labelledby="crm-comparison-title">
        <div class="container">
            <header class="why-section-head is-light reveal">
                <span>CRM عمومی در برابر سیستم تخصصی فورواردری</span>
                <h2 id="crm-comparison-title">CRM عمومی برای فروش طراحی شده؛ سپند برای ادامه مسیر بعد از فروش هم ساخته شده است</h2>
            </header>

            <div class="why-pipeline-comparison">
                <article class="why-pipeline-card reveal">
                    <div class="why-pipeline-title"><small>مسیر فروش</small><h3>CRM عمومی</h3></div>
                    <ol>
                        @foreach($genericCrmFlow as $step)<li><span>{{ $flowNumbers[$loop->index] }}</span>{{ $step }}</li>@endforeach
                    </ol>
                </article>
                <article class="why-pipeline-card is-sepand reveal">
                    <div class="why-pipeline-title"><small>مسیر کامل پرونده</small><h3>سپند</h3></div>
                    <ol>
                        @foreach($specializedFlow as $step)<li><span>{{ $flowNumbers[$loop->index] }}</span>{{ $step }}</li>@endforeach
                    </ol>
                </article>
            </div>

            <div class="why-crm-explanation reveal">
                <p>در فورواردری، فروش پایان فرایند نیست؛ شروع یک پرونده عملیاتی است.</p>
                <a href="{{ route('compare.sepand-other-transport-software') }}">مقایسه کامل سپند با CRMهای عمومی <span aria-hidden="true">←</span></a>
            </div>
        </div>
    </section>

    <section class="why-compare-cta" aria-labelledby="compare-cta-title">
        <div class="container">
            <div class="why-compare-cta-inner reveal">
                <div>
                    <h2 id="compare-cta-title">نیاز به مقایسه دقیق دارید؟</h2>
                    <p>سپند را با CRMهای عمومی و سایر راهکارهای مدیریت حمل‌ونقل مقایسه کنید.</p>
                </div>
                <a class="btn btn-outline" href="{{ route('compare.index') }}">مشاهده مرکز مقایسه</a>
            </div>
        </div>
    </section>

    <section class="why-metrics" aria-labelledby="metrics-title">
        <div class="container">
            <header class="why-section-head is-light reveal">
                <span>نتیجه‌های قابل اندازه‌گیری</span>
                <h2 id="metrics-title">بعد از استقرار چه چیزهایی قابل اندازه‌گیری می‌شوند؟</h2>
                <p>اندازه‌گیری از وضعیت واقعی خود شرکت شروع می‌شود و نشان می‌دهد فرایندهای روزانه کجا نیاز به بهبود دارند.</p>
            </header>
            <div class="why-metric-grid">
                @foreach($metrics as $metric)
                    <article class="why-metric-card reveal">
                        <span>{{ $metric['code'] }}</span>
                        <h3>{{ $metric['title'] }}</h3>
                        <p>{{ $metric['question'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="why-evidence" aria-labelledby="evidence-title">
        <div class="container">
            <header class="why-section-head reveal">
                <span>نمونه واقعی محصول</span>
                <h2 id="evidence-title">تفاوت سپند را در خود نرم‌افزار ببینید</h2>
                <p>سه نمای واقعی از نقاطی که اتصال فروش، عملیات و مالی را نشان می‌دهند.</p>
            </header>
            <div class="why-evidence-grid">
                @foreach($evidence as $item)
                    <article class="why-evidence-card reveal">
                        <a class="why-evidence-media" href="{{ $item['url'] }}" aria-label="{{ $item['cta'] }}">
                            <img src="{{ asset('assets/images/marketing/'.$item['path']) }}" alt="{{ $item['alt'] }}" width="{{ $item['width'] }}" height="{{ $item['height'] }}" loading="lazy" decoding="async">
                        </a>
                        <div class="why-evidence-copy">
                            <span>{{ $item['number'] }}</span>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['caption'] }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
            <a class="why-summary-link reveal" href="{{ route('product') }}">مشاهده کامل محصول <span aria-hidden="true">←</span></a>
        </div>
    </section>

    <section class="why-audience" aria-labelledby="audience-title">
        <div class="container">
            <header class="why-section-head reveal">
                <span>تناسب محصول</span>
                <h2 id="audience-title">سپند برای چه شرکت‌هایی مناسب است؟</h2>
                <p>ارزش سپند زمانی روشن می‌شود که چند واحد باید روی یک پرونده حمل مشترک کار کنند.</p>
            </header>
            <div class="why-audience-grid">
                <article class="why-audience-card is-fit reveal">
                    <header><span aria-hidden="true">✓</span><h3>سپند احتمالاً مناسب شماست اگر:</h3></header>
                    <ul>@foreach($fitItems as $item)<li>{{ $item }}</li>@endforeach</ul>
                </article>
                <article class="why-audience-card is-not-fit reveal">
                    <header><span aria-hidden="true">—</span><h3>سپند احتمالاً بیش از نیاز شماست اگر...</h3></header>
                    <ul>@foreach($notFitItems as $item)<li>{{ $item }}</li>@endforeach</ul>
                    <p>در این شرایط، یک ابزار ساده‌تر و محدودتر ممکن است انتخاب متناسب‌تری باشد.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="why-summary" aria-labelledby="summary-title">
        <div class="container">
            <header class="why-section-head reveal">
                <span>جمع‌بندی</span>
                <h2 id="summary-title">مزیت اصلی سپند یک قابلیت نیست؛ اتصال فرایندها به یکدیگر است</h2>
                <p>اطلاعات در طول چرخه پرونده همراه همان فرایند حرکت می‌کنند و لازم نیست بین چند ابزار و واحد دوباره ساخته شوند.</p>
            </header>
            <ol class="why-final-flow reveal" aria-label="جریان یکپارچه سپند">
                @foreach($finalFlow as $step)<li><span>{{ $flowNumbers[$loop->index] }}</span><b>{{ $step }}</b></li>@endforeach
            </ol>
            <a class="why-summary-link reveal" href="{{ route('product') }}#product-flow">مشاهده نحوه کار سپند <span aria-hidden="true">←</span></a>
        </div>
    </section>

    <section class="cta-wrap why-final-cta">
        <div class="container">
            <div class="cta reveal">
                <div class="cta-copy">
                    <h2>ببینید سپند با فرایند واقعی شرکت شما چگونه کار می‌کند</h2>
                    <p>در جلسه دمو، مسیر CRM، نرخ‌دهی، Booking، عملیات و مالی شرکت شما را در یک پرونده واقعی مرور می‌کنیم.</p>
                </div>
                <div class="why-final-actions">
                    <a class="btn" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="why_bottom_consultation">درخواست دمو</a>
                    <a class="btn why-final-secondary" href="{{ route('product') }}">مشاهده محصول</a>
                </div>
            </div>
        </div>
    </section>
@endsection
