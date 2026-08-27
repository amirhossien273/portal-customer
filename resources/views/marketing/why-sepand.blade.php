@extends('layouts.marketing')

@php
    $title = 'چرا سپند؟ | نرم افزار تخصصی مدیریت شرکت‌های حمل‌ونقل و فورواردری';
    $description = 'ببینید چرا سپند برای مدیریت یکپارچه CRM، نرخ‌دهی، Booking، عملیات، اسناد و مالی شرکت‌های حمل‌ونقل و فورواردری طراحی شده و چه تفاوتی با ابزارهای پراکنده و CRMهای عمومی دارد.';
    $canonical = route('why-sepand');
    $image = asset('assets/images/marketing/modules/screenshots/pricing-sales-workflow.webp');
    $imageAlt = 'جریان واقعی نرخ‌دهی و تبدیل استعلام به Booking در نرم‌افزار سپند';
    $imageWidth = 1600;
    $imageHeight = 687;

    $fragmentedTools = ['Excel', 'WhatsApp', 'Email', 'CRM عمومی', 'فایل‌های شخصی', 'گزارش دستی'];
    $sepandFlow = ['CRM', 'Inquiry', 'Pricing', 'Booking', 'Operations', 'Documents', 'Finance'];

    $dailyProblems = [
        ['number' => '01', 'title' => 'ورود چندباره اطلاعات', 'text' => 'اطلاعات مشتری و Shipment در چند فایل یا سیستم دوباره وارد می‌شود.'],
        ['number' => '02', 'title' => 'نسخه‌های متفاوت از یک پرونده', 'text' => 'فروش، عملیات و مالی ممکن است اطلاعات متفاوتی از یک Shipment داشته باشند.'],
        ['number' => '03', 'title' => 'پیگیری وابسته به حافظه افراد', 'text' => 'بخشی از Follow-upها، Deadlineها و اقدامات بعدی در پیام‌ها یا ذهن افراد باقی می‌ماند.'],
        ['number' => '04', 'title' => 'گزارش مدیریتی با تأخیر', 'text' => 'مدیر برای دیدن وضعیت واقعی شرکت باید از چند واحد اطلاعات جمع کند.'],
        ['number' => '05', 'title' => 'مشتری برای Status تماس می‌گیرد', 'text' => 'وقتی اطلاعات پرونده یکپارچه نیست، پاسخ‌گویی به مشتری هم وابسته به هماهنگی داخلی می‌شود.'],
    ];

    $genericCrmFlow = ['Lead', 'Opportunity', 'Deal', 'Sale'];
    $specializedFlow = ['Lead', 'Inquiry', 'Pricing', 'Quote', 'Booking', 'Operations', 'Documents', 'Finance'];

    $pillars = [
        [
            'number' => '01',
            'title' => 'تخصصی برای فورواردری',
            'description' => 'سپند یک CRM عمومی نیست که امکانات حمل‌ونقل بعداً به آن اضافه شده باشد. ساختار CRM، استعلام نرخ، Booking، عملیات، اسناد و مالی بر اساس جریان واقعی Freight Forwarding طراحی شده است.',
            'outcome' => 'یک ساختار متناسب با زبان و فرایند واقعی صنعت.',
        ],
        [
            'number' => '02',
            'title' => 'اطلاعات فقط یک بار وارد می‌شوند',
            'description' => 'اطلاعات مشتری، درخواست حمل و Booking به‌جای ورود مجدد در واحدهای مختلف، همراه همان پرونده در طول فرایند حرکت می‌کنند.',
            'outcome' => 'ورود کمتر اطلاعات تکراری و کاهش اختلاف بین واحدها.',
        ],
        [
            'number' => '03',
            'title' => 'فروش و عملیات از هم جدا نیستند',
            'description' => 'Quote تأییدشده پایان کار فروش نیست؛ شروع Booking و عملیات است. سپند این ارتباط را در همان پرونده حفظ می‌کند.',
            'outcome' => 'تحویل روان‌تر پرونده از Sales به Operations.',
        ],
        [
            'number' => '04',
            'title' => 'کار به حافظه افراد وابسته نمی‌ماند',
            'description' => 'Task، Deadline، Reminder و Workflow مشخص می‌کنند چه اقدامی، توسط چه کسی و در چه زمانی باید انجام شود.',
            'outcome' => 'Follow-upهای قابل مشاهده و مسئولیت‌های شفاف‌تر.',
        ],
        [
            'number' => '05',
            'title' => 'مدیر نتیجه را می‌بیند، نه فقط داده را',
            'description' => 'اطلاعات فروش، عملیات و مالی در Dashboard و گزارش‌ها به دید مدیریتی تبدیل می‌شوند.',
            'outcome' => 'درک سریع‌تر وضعیت Lead، Booking، فعالیت‌ها، هزینه و عملکرد پرونده‌ها.',
        ],
    ];

    $comparisonRows = [
        ['label' => 'مدیریت مشتری', 'fragmented' => 'Excel / WhatsApp', 'generic' => 'دارد', 'sepand' => 'دارد'],
        ['label' => 'Follow-up', 'fragmented' => 'دستی', 'generic' => 'دارد', 'sepand' => 'دارد + ارتباط با پرونده حمل'],
        ['label' => 'Inquiry و استعلام نرخ', 'fragmented' => 'فایل و پیام', 'generic' => 'معمولاً ندارد', 'sepand' => 'دارد'],
        ['label' => 'مقایسه Supplier', 'fragmented' => 'دستی', 'generic' => 'معمولاً ندارد', 'sepand' => 'دارد'],
        ['label' => 'Booking', 'fragmented' => 'فایل یا سیستم جدا', 'generic' => 'نیازمند توسعه یا Integration', 'sepand' => 'دارد'],
        ['label' => 'عملیات حمل', 'fragmented' => 'جدا از فروش', 'generic' => 'معمولاً ندارد', 'sepand' => 'متصل به Booking'],
        ['label' => 'اسناد Shipment', 'fragmented' => 'Folder / Email', 'generic' => 'محدود یا جدا', 'sepand' => 'متصل به پرونده'],
        ['label' => 'امور مالی متصل به Booking', 'fragmented' => 'سیستم جدا', 'generic' => 'معمولاً ندارد', 'sepand' => 'دارد'],
        ['label' => 'سود پرونده', 'fragmented' => 'محاسبه دستی', 'generic' => 'معمولاً ندارد', 'sepand' => 'قابل بررسی در Context پرونده'],
        ['label' => 'Dashboard مدیریتی', 'fragmented' => 'گزارش دستی', 'generic' => 'عمدتاً Sales-based', 'sepand' => 'فروش + عملیات + مالی'],
    ];

    $problemSolutions = [
        ['number' => '01', 'title' => 'اطلاعات پراکنده است', 'problem' => 'بخشی از اطلاعات مشتری در CRM، بخشی در Excel و بخشی در پیام‌ها قرار دارد.', 'solution' => 'اطلاعات مرتبط با مشتری و پرونده حمل در یک ساختار مشترک نگهداری می‌شوند.'],
        ['number' => '02', 'title' => 'پیگیری‌ها فراموش می‌شوند', 'problem' => 'Follow-upها و اقدامات بعدی به حافظه یا یادداشت شخصی کارشناسان وابسته می‌شوند.', 'solution' => 'Task، Deadline، Reminder و وضعیت فعالیت، قدم بعدی را قابل مشاهده می‌کنند.'],
        ['number' => '03', 'title' => 'فروش و عملیات از هم جدا هستند', 'problem' => 'بعد از تأیید Quote، اطلاعات دوباره به تیم عملیات منتقل یا وارد می‌شود.', 'solution' => 'اطلاعات از Quote به Booking و عملیات در همان جریان ادامه پیدا می‌کنند.'],
        ['number' => '04', 'title' => 'نتیجه مالی پرونده دیر مشخص می‌شود', 'problem' => 'درآمد و هزینه خارج از Context Shipment نگهداری می‌شوند.', 'solution' => 'اطلاعات مالی به Booking و پرونده مربوط متصل می‌شوند.'],
    ];

    $metrics = [
        ['code' => 'Data', 'title' => 'ورود مجدد اطلاعات', 'question' => 'چند بار اطلاعات یک مشتری یا Shipment دوباره ثبت می‌شود؟'],
        ['code' => 'Task', 'title' => 'Taskهای عقب‌افتاده', 'question' => 'چه تعداد فعالیت از موعد خود عبور کرده‌اند؟'],
        ['code' => 'SLA', 'title' => 'زمان پاسخ به مشتری', 'question' => 'کارشناس چقدر سریع به Status پرونده دسترسی دارد؟'],
        ['code' => 'Rate', 'title' => 'نرخ‌های منقضی‌شده', 'question' => 'چند Quote یا Rate بدون اقدام بعدی منقضی شده‌اند؟'],
        ['code' => 'Job', 'title' => 'سود هر پرونده', 'question' => 'درآمد و هزینه هر Booking چگونه با هم مقایسه می‌شوند؟'],
        ['code' => 'CRM', 'title' => 'سود هر مشتری', 'question' => 'کدام مشتری فقط حجم بالا دارد و کدام مشتری واقعاً ارزشمند است؟'],
        ['code' => 'BI', 'title' => 'زمان تهیه گزارش', 'question' => 'مدیر برای دیدن وضعیت شرکت چقدر به جمع‌آوری دستی اطلاعات وابسته است؟'],
    ];

    $evidence = [
        [
            'number' => '01',
            'title' => 'از Lead تا Booking',
            'caption' => 'اطلاعات فروش در همان جریان وارد Booking می‌شوند.',
            'path' => 'modules/screenshots/pricing-sales-workflow.webp',
            'alt' => 'برد واقعی سپند از استعلام قیمت تا تأیید مشتری و تبدیل به Booking',
            'width' => 1600,
            'height' => 687,
            'cta' => 'مشاهده این مرحله در محصول',
            'url' => route('product').'#pricing',
        ],
        [
            'number' => '02',
            'title' => 'از Booking تا Finance',
            'caption' => 'هزینه و درآمد در Context همان پرونده قابل بررسی هستند.',
            'path' => 'modules/screenshots/finance-booking-reconciliation.webp',
            'alt' => 'نمای واقعی تطبیق مالی Booking شامل Offer، دریافت، پرداخت و نرخ تبدیل در سپند',
            'width' => 1600,
            'height' => 811,
            'cta' => 'مشاهده بخش مالی در محصول',
            'url' => route('product').'#finance',
        ],
        [
            'number' => '03',
            'title' => 'دید مدیریتی',
            'caption' => 'داده‌های فروش، عملیات و فعالیت‌ها در یک Dashboard مدیریتی قابل مشاهده‌اند.',
            'path' => 'product-showcase/desktop-reports.webp',
            'alt' => 'گزارش‌های واقعی مدیریتی سپند برای مقایسه لید، مشتری، استعلام و Booking',
            'width' => 1600,
            'height' => 844,
            'cta' => 'مشاهده Dashboard واقعی',
            'url' => route('product').'#dashboard',
        ],
    ];

    $fitItems = [
        'Freight Forwarder هستید.',
        'شرکت حمل‌ونقل بین‌المللی دارید.',
        'Sales و Operations هر دو روی پرونده مشتری کار می‌کنند.',
        'نرخ‌دهی و Booking بخشی از کار روزانه شماست.',
        'اطلاعات بین چند ابزار یا فایل پراکنده شده‌اند.',
        'بیش از یک واحد به اطلاعات Shipment نیاز دارد.',
        'به دید مدیریتی از فروش تا مالی نیاز دارید.',
        'می‌خواهید فرایندها با رشد تیم وابسته به حافظه افراد باقی نمانند.',
    ];

    $notFitItems = [
        'فقط یک CRM ساده برای ثبت تماس مشتری می‌خواهید.',
        'Booking یا عملیات حمل ندارید.',
        'فقط نرم‌افزار حسابداری می‌خواهید.',
        'فقط ابزار صدور Invoice نیاز دارید.',
        'فرایند شرکت شما ارتباطی با Freight Forwarding ندارد.',
    ];

    $finalFlow = ['Customer', 'CRM', 'Inquiry', 'Quote', 'Booking', 'Operations', 'Documents / Finance', 'Management'];

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
    <link rel="stylesheet" href="{{ asset('assets/css/marketing-why-sepand.css') }}?v=20260827-1">
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
                <p>در بسیاری از شرکت‌های حمل‌ونقل، CRM، نرخ‌دهی، Booking، عملیات، اسناد و امور مالی در ابزارها و فایل‌های جدا مدیریت می‌شوند. سپند این فرایندها را روی یک جریان مشترک قرار می‌دهد تا اطلاعات همراه پرونده حرکت کنند، نه بین افراد و فایل‌ها.</p>
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
                    <div><small>جریان مشترک</small><strong>Sepand</strong></div>
                    <p>فروش <i></i> عملیات <i></i> مالی</p>
                </div>
            </div>
        </div>
    </section>

    <section class="why-fragmented" aria-labelledby="fragmented-title">
        <div class="container">
            <header class="why-section-head reveal">
                <span>مسئله اصلی</span>
                <h2 id="fragmented-title">مشکل یک ابزار نیست؛ تعداد ابزارهایی است که باید به هم متصل شوند</h2>
                <p>وقتی هر واحد با ابزار خودش کار می‌کند، حتی اگر هر ابزار به‌تنهایی مناسب باشد، ارتباط بین فروش، عملیات و مالی از بین می‌رود.</p>
            </header>

            <div class="why-system-comparison reveal">
                <article class="why-system-card is-fragmented">
                    <div class="why-system-card-head"><span aria-hidden="true">×</span><div><small>روش اول</small><h3>روش پراکنده</h3></div></div>
                    <ul>
                        @foreach($fragmentedTools as $tool)<li>{{ $tool }}</li>@endforeach
                    </ul>
                    <p>چند منبع اطلاعات، چند مالک و چند نسخه از واقعیت.</p>
                </article>
                <div class="why-comparison-divider" aria-hidden="true"><span>در برابر</span></div>
                <article class="why-system-card is-sepand">
                    <div class="why-system-card-head"><span aria-hidden="true">✓</span><div><small>روش دوم</small><h3>Sepand</h3></div></div>
                    <ol>
                        @foreach($sepandFlow as $step)<li>{{ $step }}</li>@endforeach
                    </ol>
                    <p>همه مراحل در یک جریان مشترک و متصل به همان پرونده.</p>
                </article>
            </div>

            <div class="why-problem-grid">
                @foreach($dailyProblems as $problem)
                    <article class="why-problem-card reveal">
                        <span>{{ $problem['number'] }}</span>
                        <h3>{{ $problem['title'] }}</h3>
                        <p>{{ $problem['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="why-crm" aria-labelledby="crm-comparison-title">
        <div class="container">
            <header class="why-section-head is-light reveal">
                <span>CRM عمومی یا سیستم تخصصی فورواردری؟</span>
                <h2 id="crm-comparison-title">در فورواردری، فروش پایان فرایند نیست؛ شروع یک پرونده عملیاتی است</h2>
            </header>

            <div class="why-pipeline-comparison">
                <article class="why-pipeline-card reveal">
                    <div class="why-pipeline-title"><small>تمرکز اصلی</small><h3>CRM عمومی</h3></div>
                    <ol>
                        @foreach($genericCrmFlow as $step)<li><span>{{ sprintf('%02d', $loop->iteration) }}</span>{{ $step }}</li>@endforeach
                    </ol>
                    <p>مدیریت ارتباط و Pipeline فروش</p>
                </article>
                <article class="why-pipeline-card is-sepand reveal">
                    <div class="why-pipeline-title"><small>جریان تخصصی صنعت</small><h3>Sepand</h3></div>
                    <ol>
                        @foreach($specializedFlow as $step)<li><span>{{ sprintf('%02d', $loop->iteration) }}</span>{{ $step }}</li>@endforeach
                    </ol>
                    <p>ادامه پرونده از ارتباط مشتری تا عملیات و نتیجه مالی</p>
                </article>
            </div>

            <div class="why-crm-explanation reveal">
                <p>CRM عمومی برای مدیریت ارتباط و Pipeline فروش طراحی شده است. اما در شرکت حمل‌ونقل، Quote تأییدشده باید وارد Booking شود، Booking وارد عملیات شود، اسناد و هزینه‌ها به همان پرونده متصل بمانند و نتیجه مالی نیز قابل مشاهده باشد. سپند بر اساس همین زنجیره طراحی شده است.</p>
                <div>
                    <a href="{{ route('product') }}#product-flow">مشاهده این جریان در محصول</a>
                    <a href="{{ route('site.modules.show', ['module' => 'crm']) }}">مشاهده CRM تخصصی سپند</a>
                    <a href="{{ route('site.modules.show', ['module' => 'pricing-sales']) }}">بررسی نرخ‌دهی و فروش</a>
                </div>
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
                        <strong>{{ $pillar['outcome'] }}</strong>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="why-table-section" aria-labelledby="comparison-table-title">
        <div class="container">
            <header class="why-section-head reveal">
                <span>مقایسه ساختاری</span>
                <h2 id="comparison-table-title">مقایسه روش‌های مختلف مدیریت شرکت حمل‌ونقل</h2>
                <p>این مقایسه درباره الگوی رایج استفاده است؛ برخی CRMهای عمومی می‌توانند با توسعه اختصاصی یا Integration بخشی از این نیازها را پوشش دهند.</p>
            </header>
            <div class="why-table-wrap reveal" role="region" aria-label="جدول مقایسه روش پراکنده، CRM عمومی و سپند" tabindex="0">
                <table>
                    <thead><tr><th scope="col">معیار</th><th scope="col">روش پراکنده</th><th scope="col">CRM عمومی</th><th scope="col" class="is-sepand">سپند</th></tr></thead>
                    <tbody>
                        @foreach($comparisonRows as $row)
                            <tr>
                                <th scope="row">{{ $row['label'] }}</th>
                                <td>{{ $row['fragmented'] }}</td>
                                <td>{{ $row['generic'] }}</td>
                                <td class="is-sepand">{{ $row['sepand'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section class="why-solutions" aria-labelledby="solutions-title">
        <div class="container">
            <header class="why-section-head reveal">
                <span>Problem → Difference</span>
                <h2 id="solutions-title">سپند برای حل چه مشکلاتی ساخته شده است؟</h2>
            </header>
            <div class="why-solution-grid">
                @foreach($problemSolutions as $item)
                    <article class="why-solution-card reveal">
                        <header><span>{{ $item['number'] }}</span><h3>{{ $item['title'] }}</h3></header>
                        <div class="why-solution-side is-problem"><small>در روش پراکنده</small><p>{{ $item['problem'] }}</p></div>
                        <div class="why-solution-side is-solution"><small>در سپند</small><p>{{ $item['solution'] }}</p></div>
                    </article>
                @endforeach
            </div>
            <div class="why-module-context reveal">
                <p>برای دیدن ادامه همین زنجیره در محصول، جزئیات هر بخش را جداگانه بررسی کنید:</p>
                <nav aria-label="ماژول‌های مرتبط با جریان یکپارچه سپند">
                    <a href="{{ route('site.modules.show', ['module' => 'booking']) }}">مدیریت Booking</a>
                    <a href="{{ route('site.modules.show', ['module' => 'transport-operations']) }}">عملیات حمل</a>
                    <a href="{{ route('site.modules.show', ['module' => 'finance-accounting']) }}">مالی و سود پرونده</a>
                </nav>
            </div>
        </div>
    </section>

    <section class="why-metrics" aria-labelledby="metrics-title">
        <div class="container">
            <header class="why-section-head is-light reveal">
                <span>Business Outcome</span>
                <h2 id="metrics-title">بعد از استقرار چه چیزهایی قابل اندازه‌گیری می‌شوند؟</h2>
                <p>ارزش یک سیستم فقط به تعداد Featureها نیست؛ باید بتوان تأثیر آن را روی فرایندهای روزانه اندازه‌گیری کرد. اندازه‌گیری از وضعیت واقعی خود شرکت شروع می‌شود، نه از درصدهای تبلیغاتی.</p>
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
                <h2 id="evidence-title">تفاوت سپند را در خود محصول ببینید</h2>
                <p>سه نمای واقعی از نقاطی که اتصال فرایندها را قابل مشاهده می‌کنند.</p>
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
                            <a href="{{ $item['url'] }}">{{ $item['cta'] }} <span aria-hidden="true">←</span></a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="why-audience" aria-labelledby="audience-title">
        <div class="container">
            <header class="why-section-head reveal">
                <span>تناسب محصول</span>
                <h2 id="audience-title">سپند برای چه شرکت‌هایی مناسب است؟</h2>
                <p>سپند برای همه کسب‌وکارها ساخته نشده است؛ ارزش آن زمانی روشن می‌شود که فروش، پرونده حمل، عملیات و مالی باید روی یک جریان مشترک کار کنند.</p>
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

    <section class="why-growth">
        <div class="container why-growth-inner reveal">
            <span aria-hidden="true">↗</span>
            <div><h2>قبل از بزرگ‌تر شدن عملیات، ساختار اطلاعات را درست کنید</h2><p>هرچه تعداد مشتری، Shipment و اعضای تیم بیشتر شود، انتقال از فایل‌های پراکنده و فرایندهای وابسته به افراد دشوارتر می‌شود. ایجاد ساختار یکپارچه زمانی ساده‌تر است که پیچیدگی هنوز کنترل‌پذیر است.</p></div>
        </div>
    </section>

    <section class="why-summary" aria-labelledby="summary-title">
        <div class="container">
            <header class="why-section-head reveal">
                <span>جمع‌بندی</span>
                <h2 id="summary-title">مزیت اصلی سپند یک Feature نیست؛ اتصال فرایندها به یکدیگر است</h2>
                <p>داده‌ها بین نرم‌افزارهای مختلف جابه‌جا نمی‌شوند؛ در طول چرخه پرونده همراه همان فرایند باقی می‌مانند.</p>
            </header>
            <ol class="why-final-flow reveal" aria-label="جریان یکپارچه سپند">
                @foreach($finalFlow as $step)<li><span>{{ sprintf('%02d', $loop->iteration) }}</span><b>{{ $step }}</b></li>@endforeach
            </ol>
            <a class="why-summary-link reveal" href="{{ route('product') }}#product-flow">مشاهده این جریان در سپند <span aria-hidden="true">←</span></a>
        </div>
    </section>

    <section class="cta-wrap why-final-cta">
        <div class="container">
            <div class="cta reveal">
                <div class="cta-copy">
                    <h2>سپند را با فرایند فعلی شرکت خود مقایسه کنید</h2>
                    <p>در جلسه دمو، به‌جای نمایش عمومی Featureها، مسیر واقعی CRM، نرخ‌دهی، Booking، عملیات و مالی شرکت شما را با ساختار سپند مرور می‌کنیم.</p>
                </div>
                <div class="why-final-actions">
                    <a class="btn" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="why_bottom_consultation">درخواست دمو</a>
                    <a class="btn why-final-secondary" href="{{ route('product') }}">مشاهده محصول</a>
                </div>
            </div>
        </div>
    </section>
@endsection
