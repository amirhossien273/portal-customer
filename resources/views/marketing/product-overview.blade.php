@extends('layouts.marketing')

@php
    $title = 'معرفی نرم افزار سپند | مدیریت یکپارچه شرکت‌های حمل‌ونقل و فورواردری';
    $description = 'با نحوه کار نرم افزار سپند از CRM و نرخ‌دهی تا Booking، عملیات حمل، اسناد و امور مالی آشنا شوید و بخش‌های واقعی محصول را مشاهده کنید.';
    $canonical = route('product');
    $image = asset('assets/images/marketing/product-showcase/desktop-dashboard.webp');
    $imageAlt = 'داشبورد واقعی نرم‌افزار مدیریت شرکت حمل‌ونقل سپند';
    $imageWidth = 1600;
    $imageHeight = 799;

    $flowSteps = [
        ['id' => 'crm', 'label' => 'CRM', 'title' => 'مشتری و پیگیری'],
        ['id' => 'pricing', 'label' => 'Pricing', 'title' => 'استعلام و نرخ'],
        ['id' => 'booking', 'label' => 'Booking', 'title' => 'رزرو حمل'],
        ['id' => 'operations', 'label' => 'Operations', 'title' => 'عملیات'],
        ['id' => 'documents', 'label' => 'Documents', 'title' => 'اسناد'],
        ['id' => 'finance', 'label' => 'Finance', 'title' => 'مالی'],
        ['id' => 'dashboard', 'label' => 'Dashboard', 'title' => 'مدیریت'],
    ];

    $sections = [
        [
            'id' => 'crm',
            'eyebrow' => '۰۱ — CRM حمل‌ونقل',
            'title' => 'هیچ پیگیری‌ای گم نمی‌شود',
            'lead' => 'هر مشتری، تماس، فعالیت و اقدام بعدی در یک پرونده قابل پیگیری می‌ماند.',
            'problem' => 'اطلاعات مشتری، تماس‌ها و Follow-upها بین Excel، WhatsApp، تماس تلفنی و حافظه کارشناسان پراکنده می‌شوند و بخشی از فرصت‌ها بدون اقدام می‌مانند.',
            'action' => 'سپند اطلاعات مشتری، Lead، استعلام، فعالیت و Task را یکپارچه ثبت می‌کند؛ مسئول، مهلت و وضعیت هر اقدام مشخص است و پیگیری‌های عقب‌افتاده، امروز و آینده جدا دیده می‌شوند.',
            'outcome' => 'کارشناس می‌داند امروز چه کسی را پیگیری کند و مدیر علاوه بر وضعیت کارها، مشتریان با بیشترین درآمد، بیشترین سود، کار زیاد با سود کم و مشتریان کم‌حجم و ارزشمند را می‌بیند.',
            'module' => 'crm',
            'cta' => 'مشاهده ماژول CRM',
            'images' => [
                ['path' => 'product-showcase/desktop-dashboard.webp', 'width' => 1600, 'height' => 799, 'alt' => 'داشبورد واقعی پیگیری‌های امروز، عقب‌افتاده و آینده در CRM سپند', 'caption' => 'داشبورد پیگیری‌های من؛ کارهای عقب‌افتاده، امروز، بدون اقدام بعدی و پیگیری‌های آینده'],
                ['path' => 'modules/screenshots/crm-customers.webp', 'width' => 1600, 'height' => 818, 'alt' => 'فهرست واقعی مشتریان و نماهای تحلیلی درآمد و سود در CRM سپند', 'caption' => 'فهرست مشتریان با نماهای بیشترین درآمد، بیشترین سود، کار زیاد با سود کم و کم‌حجم و ارزشمند'],
            ],
        ],
        [
            'id' => 'pricing',
            'eyebrow' => '۰۲ — نرخ‌دهی و فروش',
            'title' => 'از استعلام مشتری تا پیشنهاد نرخ، همه‌چیز قابل ردیابی است',
            'lead' => 'تصمیم نرخ‌دهی فقط «ارزان‌ترین عدد» نیست؛ تأمین‌کننده، اعتبار نرخ، Margin و اقدام بعدی هم‌زمان اهمیت دارند.',
            'problem' => 'نرخ Supplierها در Email، WhatsApp و Excel پخش می‌شود و مقایسه Quoteها، تاریخ اعتبار و حاشیه سود پیشنهادی دشوار می‌ماند.',
            'action' => 'سپند استعلام مشتری، قیمت تأمین‌کننده، مقایسه چندمعیاره Supplierها، نرخ پیشنهادی، Margin، تاریخ اعتبار و وضعیت پیشنهاد فروش را در یک جریان نگه می‌دارد.',
            'outcome' => 'کارشناس بهترین گزینه را فقط بر اساس کمترین قیمت انتخاب نمی‌کند؛ نرخ رو به انقضا و پیش‌فاکتور ۴۸ ساعته بدون پیگیری نیز به اقدام قابل مشاهده تبدیل می‌شوند.',
            'module' => 'pricing-sales',
            'cta' => 'مشاهده ماژول نرخ‌دهی و فروش',
            'reverse' => true,
            'images' => [
                ['path' => 'modules/screenshots/pricing-sales-workflow.webp', 'width' => 1600, 'height' => 687, 'alt' => 'برد واقعی استعلام قیمت تأمین‌کننده و ارسال پیشنهاد نرخ در سپند', 'caption' => 'جریان واقعی بررسی مسیر، استعلام قیمت تأمین‌کننده، ثبت و ارسال پیشنهاد نرخ، تأیید مشتری و تبدیل به Booking'],
                ['path' => 'modules/screenshots/pricing-supplier-comparison.webp', 'width' => 1600, 'height' => 839, 'alt' => 'مقایسه واقعی تأمین‌کنندگان بر اساس نرخ خرید، مسیر، اعتبار، Free Time و سابقه عملکرد در سپند', 'caption' => 'مقایسه کنارهم تأمین‌کنندگان با نرخ خرید، Transit Time، مسیر، اعتبار نرخ، Free Time، سابقه تأخیر و کیفیت پاسخ‌گویی'],
            ],
            'missing_evidence' => [
                ['file' => 'pricing-proposed-rate.webp', 'label' => 'نمای ثبت نرخ پیشنهادی و Margin فروش پیش از ارسال Quote به مشتری'],
            ],
        ],
        [
            'id' => 'booking',
            'eyebrow' => '۰۳ — Booking',
            'title' => 'وقتی نرخ تأیید شد، پرونده از نو ساخته نمی‌شود',
            'lead' => 'اطلاعات تأییدشده فروش همراه پرونده به مرحله رزرو و اجرا می‌رود.',
            'problem' => 'در سیستم‌های پراکنده، اطلاعات مشتری و حمل پس از تأیید نرخ دوباره وارد فایل یا نرم‌افزار دیگری می‌شود و خطای انسانی بالا می‌رود.',
            'action' => 'در سپند Inquiry و Quote تأییدشده به Booking متصل می‌شوند و اطلاعات اصلی مسیر، مشتری، Offer و پرونده Shipment حفظ می‌شود.',
            'outcome' => 'ورود تکراری کمتر می‌شود؛ فروش، عملیات و مالی روی یک Booking مشترک کار می‌کنند و وضعیت پرداخت و دریافت همان پرونده قابل مشاهده است.',
            'module' => 'booking',
            'cta' => 'مشاهده ماژول Booking',
            'images' => [
                ['path' => 'modules/screenshots/booking-profitability.webp', 'width' => 1595, 'height' => 626, 'alt' => 'نمای واقعی Booking و ارتباط مبلغ Offer با پرداخت و دریافت در سپند', 'caption' => 'Bookingهای واقعی با مبلغ Offer، وضعیت نرخ تبدیل و دریافت‌ها و پرداخت‌های متصل به همان پرونده'],
            ],
        ],
        [
            'id' => 'operations',
            'eyebrow' => '۰۴ — عملیات حمل',
            'title' => 'تیم عملیات می‌داند هر Shipment دقیقاً در چه مرحله‌ای است',
            'lead' => 'تقویم حرکت و فهرست استثناها، پرونده‌های نیازمند اقدام را از دل عملیات روزانه بیرون می‌کشد.',
            'problem' => 'پس از Booking، Milestoneها، مهلت‌ها و هماهنگی‌های متعدد وارد پرونده می‌شوند و کنترل آن‌ها از طریق پیام و فایل پراکنده دشوار است.',
            'action' => 'سپند رویدادهای عملیات حمل، مسئول‌ها و برنامه حرکت Shipment را به همان پرونده Booking متصل می‌کند و موارد بدون برنامه، بدون شماره کانتینر یا نیازمند اقدام را جدا نشان می‌دهد.',
            'outcome' => 'تیم عملیات پرونده متوقف یا ناقص را سریع‌تر پیدا می‌کند و مدیر برای گرفتن Status مجبور نیست از چند نفر گزارش جمع کند.',
            'module' => 'transport-operations',
            'cta' => 'مشاهده ماژول عملیات حمل',
            'reverse' => true,
            'images' => [
                ['path' => 'modules/screenshots/operations-calendar-month.webp', 'width' => 1600, 'height' => 773, 'alt' => 'تقویم ماهانه واقعی حرکت Shipmentها و هشدار عملیات در سپند', 'caption' => 'تقویم ماهانه حرکت Shipmentها با وضعیت عادی، نیازمند اقدام و اطلاعات ناقص'],
                ['path' => 'modules/screenshots/operations-calendar-list.webp', 'width' => 1600, 'height' => 861, 'alt' => 'نمای فهرستی واقعی حرکت محموله و استثناهای عملیاتی در سپند', 'caption' => 'نمای فهرستی حرکت‌ها و صف‌های بدون تاریخ حرکت، بدون برنامه و بدون شماره کانتینر'],
            ],
        ],
        [
            'id' => 'documents',
            'eyebrow' => '۰۵ — مدیریت اسناد',
            'title' => 'اسناد از پرونده حمل جدا نمی‌شوند',
            'lead' => 'نسخه، وضعیت تأیید و مهلت هر سند باید در Context همان مشتری و Shipment دیده شود.',
            'problem' => 'BL، Invoice، Packing List و Draftها در Folder، Email و پیام‌های مختلف قرار می‌گیرند و تشخیص آخرین نسخه دشوار می‌شود.',
            'action' => 'سپند فایل‌ها و وضعیت اسناد را به مشتری، Booking و پرونده عملیاتی مربوط متصل می‌کند تا نسخه جاری، اصلاحات و مسئول کنترل روشن باشد.',
            'outcome' => 'تیم سریع‌تر به سند موردنیاز می‌رسد و ارتباط مدرک با Shipment، مشتری و مرحله عملیات حفظ می‌شود.',
            'module' => 'document-management',
            'cta' => 'مشاهده ماژول مدیریت اسناد',
            'placeholder' => 'برای تکمیل Evidence این بخش، تصویری از فایل‌های متصل به Shipment همراه وضعیت نسخه یا تأیید نیاز است؛ این کادر UI جعلی نیست و عمداً جای تصویر واقعی را مشخص می‌کند.',
            'images' => [],
        ],
        [
            'id' => 'finance',
            'eyebrow' => '۰۶ — مالی چندارزی',
            'title' => 'در پایان فقط درآمد مهم نیست؛ سود واقعی پرونده باید مشخص باشد',
            'lead' => 'پرداخت، دریافت، نرخ تبدیل و سند مالی در Context همان Booking بررسی می‌شوند.',
            'problem' => 'وقتی هزینه و درآمد بیرون از پرونده حمل ثبت شوند، تشخیص Profitability واقعی Shipment و علت مغایرت دشوار می‌شود.',
            'action' => 'سپند درخواست‌های پرداخت، دریافت‌ها، نرخ تبدیل، اسناد و تأییدکننده را به Booking مربوط متصل می‌کند و نمای تطبیق مالی در اختیار تیم قرار می‌دهد.',
            'outcome' => 'مالی و مدیریت می‌توانند پرداخت‌های معلق، تسویه، کسری دریافت یا پرداخت و سود پرونده را بدون جدا کردن عملیات از حسابداری بررسی کنند.',
            'module' => 'finance-accounting',
            'cta' => 'مشاهده ماژول مالی',
            'reverse' => true,
            'images' => [
                ['path' => 'modules/screenshots/finance-payments.webp', 'width' => 1600, 'height' => 830, 'alt' => 'فهرست واقعی درخواست‌های پرداخت و وضعیت تأیید در سپند', 'caption' => 'درخواست‌های پرداخت، مبلغ، دریافت‌کننده، مشتری و وضعیت تأیید هر پرونده'],
                ['path' => 'modules/screenshots/finance-booking-reconciliation.webp', 'width' => 1600, 'height' => 811, 'alt' => 'نمای واقعی تطبیق مالی Booking و کنترل نرخ تبدیل در سپند', 'caption' => 'تطبیق مالی Booking؛ Offer، پرداخت، دریافت، نرخ تبدیل و کسری‌های قابل پیگیری'],
                ['path' => 'modules/screenshots/finance-payment-details.webp', 'width' => 1576, 'height' => 922, 'alt' => 'جزئیات واقعی پرداخت و اسناد پیوست‌شده در نرم‌افزار سپند', 'caption' => 'جزئیات پرداخت با Booking مرتبط، تأییدکننده، حساب مقصد و فایل سند'],
            ],
        ],
        [
            'id' => 'dashboard',
            'eyebrow' => '۰۷ — مدیریت',
            'title' => 'مدیر برای فهمیدن وضعیت شرکت لازم نیست از چند واحد گزارش بگیرد',
            'lead' => 'شاخص‌های CRM، فروش، عملیات و فعالیت‌ها از داده ثبت‌شده در همان سیستم ساخته می‌شوند.',
            'problem' => 'وقتی فروش، عملیات و فعالیت کارکنان در سیستم‌های جدا ثبت شوند، دید مدیریتی لحظه‌ای و قابل اتکا شکل نمی‌گیرد.',
            'action' => 'سپند داده Lead، Customer، Inquiry، Booking، Task و عملیات را به Dashboard و گزارش‌های تحلیلی متصل می‌کند.',
            'outcome' => 'مدیر در یک نما حجم کار، پیگیری‌های معوق، مسیر تبدیل Lead به Customer، روند Inquiry تا Booking و ریزش مشتری را مشاهده می‌کند.',
            'module' => 'crm',
            'cta' => 'درخواست نمایش آنلاین سپند',
            'cta_url' => route('consultation.create'),
            'featured' => true,
            'images' => [
                ['path' => 'product-showcase/desktop-dashboard.webp', 'width' => 1600, 'height' => 799, 'alt' => 'داشبورد مدیریتی واقعی سپند با وضعیت لید، مشتری، استعلام و Booking', 'caption' => 'داشبورد واقعی سپند بر اساس اطلاعات ثبت‌شده در CRM، فروش و عملیات'],
                ['path' => 'product-showcase/desktop-reports.webp', 'width' => 1600, 'height' => 844, 'alt' => 'گزارش تحلیلی واقعی لید، مشتری، استعلام و Booking در سپند', 'caption' => 'گزارش‌های واقعی مقایسه لید و مشتری، استعلام و Booking، تگ مشتری و ریزش'],
            ],
        ],
    ];

    $differentiators = [
        ['group' => 'CRM', 'title' => 'مشتریان با بیشترین درآمد', 'text' => 'رتبه‌بندی بر اساس دریافت‌های تأییدشده، نه حدس یا حجم تماس.', 'href' => '#crm'],
        ['group' => 'CRM', 'title' => 'مشتریان با بیشترین سود', 'text' => 'درآمد منهای هزینه قطعی برای تشخیص ارزش واقعی ارتباط.', 'href' => '#crm'],
        ['group' => 'CRM', 'title' => 'کار زیاد، سود کم', 'text' => 'نمایی برای مشتریانی که فشار عملیاتی بالا و بازده پایین دارند.', 'href' => '#crm'],
        ['group' => 'CRM', 'title' => 'کم‌حجم و ارزشمند', 'text' => 'مشتریانی که با تعداد کار کمتر، سود بالاتری در هر پرونده می‌سازند.', 'href' => '#crm'],
        ['group' => 'Pricing', 'title' => 'مقایسه چندمعیاره تأمین‌کننده', 'text' => 'نرخ خرید، مدت حمل، مستقیم یا غیرمستقیم بودن، اعتبار، Free Time و شرایط پرداخت کنار هم دیده می‌شوند.', 'href' => '#pricing'],
        ['group' => 'Pricing', 'title' => 'نرخ پیشنهادی و هشدار انقضا', 'text' => 'Margin و اعتبار Quote پیش از ارسال و هنگام نزدیک‌شدن انقضا دیده می‌شوند.', 'href' => '#pricing'],
        ['group' => 'Finance', 'title' => 'تطبیق مالی Booking', 'text' => 'Offer، نرخ تبدیل، دریافت، پرداخت و کسری در یک کارت پرونده.', 'href' => '#finance'],
        ['group' => 'Workflow', 'title' => 'قانون تسک و تقویم‌های جدا', 'text' => 'تسک خودکار، تقویم فعالیت تیم و تقویم حرکت Shipment هر کدام Context خود را دارند.', 'href' => '#workflow-evidence'],
    ];

    $roles = [
        ['title' => 'فروش', 'text' => 'مشتری، Lead، Inquiry، Quote، Follow-up و تحلیل ارزش مشتری.'],
        ['title' => 'عملیات', 'text' => 'Booking، Shipment، Task، Milestone، تقویم حرکت و استثناها.'],
        ['title' => 'اسناد', 'text' => 'مدارک، نسخه‌ها، وضعیت تأیید و فایل‌های مرتبط با پرونده.'],
        ['title' => 'مالی', 'text' => 'هزینه، پرداخت، دریافت، نرخ تبدیل، تسویه و سود پرونده.'],
        ['title' => 'مدیریت', 'text' => 'Dashboard، KPI، گزارش روند، گلوگاه و عملکرد واحدها.'],
    ];

    $portalScreenshot = config('module_screenshots.customer-portal-tracking.0');

    $structuredData = [
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'SoftwareApplication',
                '@id' => route('product').'#software',
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
                    ['@type' => 'ListItem', 'position' => 2, 'name' => 'معرفی محصول', 'item' => route('product')],
                ],
            ],
        ],
    ];
@endphp

@push('head')
    <script type="application/ld+json">{!! json_encode($structuredData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endpush

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/marketing-product.css') }}?v=20260826-2">
@endpush

@section('content')
    <section class="product-hero" aria-labelledby="product-title">
        <div class="container product-hero-grid">
            <div class="product-hero-copy reveal visible">
                <nav class="breadcrumb" aria-label="مسیر راهنما">
                    <a href="{{ route('home') }}">صفحه اصلی</a>
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                    <span>معرفی محصول</span>
                </nav>
                <span class="product-kicker">سپند در عمل</span>
                <h1 id="product-title">از اولین تماس مشتری تا تسویه پرونده؛ <span>همه‌چیز در یک سیستم</span></h1>
                <p>سپند CRM، نرخ‌دهی، Booking، عملیات حمل، اسناد و امور مالی شرکت‌های حمل‌ونقل و فورواردری را در یک جریان یکپارچه به هم متصل می‌کند. اینجا هر ادعا با بخشی واقعی از نرم‌افزار همراه است.</p>
                <div class="product-hero-actions">
                    <a class="btn btn-primary" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="product_hero_consultation">درخواست دمو</a>
                    <a class="btn btn-outline" href="#product-flow">مشاهده فرایند سپند</a>
                </div>
                <div class="product-proof-note">
                    <span aria-hidden="true">✓</span>
                    <p><strong>بدون Mockup تبلیغاتی</strong> — تصاویر این صفحه از محیط واقعی سپند گرفته شده‌اند.</p>
                </div>
            </div>

            <figure class="product-hero-shot reveal visible">
                <button
                    class="product-screenshot-button"
                    type="button"
                    data-product-lightbox-open
                    data-image-src="{{ $image }}"
                    data-image-alt="{{ $imageAlt }}"
                    data-image-caption="داشبورد واقعی سپند؛ پیگیری‌ها، نرخ‌های در حال انقضا و روند CRM تا Booking"
                    aria-label="نمایش بزرگ‌تر داشبورد واقعی سپند"
                >
                    <img src="{{ $image }}" alt="{{ $imageAlt }}" width="1600" height="799" fetchpriority="high" decoding="async">
                    <span class="product-screenshot-zoom" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none"><circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="1.7"/><path d="m20 20-4-4M8 11h6M11 8v6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
                        بزرگ‌نمایی
                    </span>
                </button>
                <figcaption><span>تصویر واقعی نرم‌افزار سپند</span> داشبورد پیگیری، فروش و عملیات</figcaption>
            </figure>
        </div>
    </section>

    <section class="product-flow" id="product-flow" aria-labelledby="product-flow-title">
        <div class="container">
            <div class="product-section-head reveal">
                <span>چرخه یک پرونده</span>
                <h2 id="product-flow-title">یک پرونده در سپند چه مسیری را طی می‌کند؟</h2>
                <p>سپند مجموعه‌ای از ماژول‌های جدا از هم نیست. اطلاعات پرونده از اولین ارتباط با مشتری تا عملیات و امور مالی همراه همان پرونده حرکت می‌کند.</p>
            </div>
            <p class="product-flow-context reveal">برای یک فورواردر، نرم‌افزار مدیریت شرکت حمل‌ونقل زمانی ارزشمند است که CRM حمل‌ونقل، مدیریت Booking و مدیریت عملیات حمل را به همان پرونده متصل کند؛ مسیر زیر همین پیوستگی را نشان می‌دهد.</p>
            <nav class="product-flow-steps reveal" aria-label="مراحل فرایند سپند">
                @foreach($flowSteps as $step)
                    <a href="#{{ $step['id'] }}">
                        <span>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <b dir="ltr">{{ $step['label'] }}</b>
                        <small>{{ $step['title'] }}</small>
                    </a>
                @endforeach
            </nav>
        </div>
    </section>

    @foreach($sections as $section)
        <x-marketing.product-evidence :section="$section" />
    @endforeach

    <section class="product-differentiators" aria-labelledby="differentiators-title">
        <div class="container">
            <div class="product-section-head reveal">
                <span>تفاوت در جزئیات</span>
                <h2 id="differentiators-title">قابلیت‌هایی که در کار روزانه تفاوت می‌سازند</h2>
                <p>این‌ها Featureهای تزئینی نیستند؛ هرکدام یک تصمیم یا پیگیری واقعی را از داده موجود در پرونده قابل انجام می‌کنند.</p>
            </div>
            <div class="product-differentiator-grid">
                @foreach($differentiators as $item)
                    <a class="product-differentiator-card reveal" href="{{ $item['href'] }}">
                        <span>{{ $item['group'] }}</span>
                        <h3>{{ $item['title'] }}</h3>
                        <p>{{ $item['text'] }}</p>
                        <small>مشاهده Evidence ←</small>
                    </a>
                @endforeach
            </div>

            <div class="product-workflow-proof reveal" id="workflow-evidence">
                <div>
                    <span>Automation & Calendar</span>
                    <h3>پیگیری فقط به حافظه کارشناس وابسته نیست</h3>
                    <p>قانون ساخت تسک خودکار، مرکز اعلان‌ها، تقویم فعالیت تیم و تقویم حرکت Shipment چهار نمای متفاوت از «اقدام بعدی» می‌سازند.</p>
                    <div class="product-workflow-links">
                        <a href="{{ route('site.modules.show', ['module' => 'automatic-tasks']) }}">قوانین تسک خودکار</a>
                        <a href="{{ route('site.modules.show', ['module' => 'workflow-tasks']) }}">گردش کار و تقویم فعالیت</a>
                    </div>
                </div>
                <div class="product-workflow-thumbs">
                    <button type="button" data-product-lightbox-open data-image-src="{{ asset('assets/images/marketing/modules/screenshots/automatic-task-rules.webp') }}" data-image-alt="قوانین واقعی ساخت تسک خودکار در سپند" data-image-caption="قوانین ساخت تسک خودکار، وضعیت فعال‌بودن و گزارش اجرا" aria-label="نمایش بزرگ‌تر قوانین تسک خودکار">
                        <img src="{{ asset('assets/images/marketing/modules/screenshots/automatic-task-rules.webp') }}" alt="قوانین واقعی ساخت تسک خودکار در سپند" width="1600" height="851" loading="lazy" decoding="async">
                    </button>
                    <button type="button" data-product-lightbox-open data-image-src="{{ asset('assets/images/marketing/modules/screenshots/workflow-notifications.webp') }}" data-image-alt="مرکز اعلان و یادآوری واقعی سپند" data-image-caption="اعلان‌های خوانده‌نشده، تسک‌های ارجاع‌شده و امکان تعویق یادآوری" aria-label="نمایش بزرگ‌تر مرکز اعلان‌ها">
                        <img src="{{ asset('assets/images/marketing/modules/screenshots/workflow-notifications.webp') }}" alt="مرکز اعلان و یادآوری واقعی سپند" width="1600" height="859" loading="lazy" decoding="async">
                    </button>
                </div>
            </div>
        </div>
    </section>

    <section class="product-integration" aria-labelledby="integration-title">
        <div class="container">
            <div class="product-section-head reveal">
                <span>یکپارچگی محصول</span>
                <h2 id="integration-title">مزیت اصلی سپند یک Feature نیست؛ اتصال فرایندها به یکدیگر است</h2>
                <p>اطلاعات یک بار وارد سیستم می‌شوند و در طول چرخه فروش، عملیات و مالی همراه همان پرونده حرکت می‌کنند.</p>
            </div>
            <div class="product-integration-track reveal" aria-label="اتصال مراحل پرونده در سپند">
                @foreach(['Customer', 'CRM', 'Inquiry', 'Quote', 'Booking', 'Operations', 'Finance', 'Management Reporting'] as $item)
                    <div><span>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span><b dir="ltr">{{ $item }}</b></div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="product-portal-proof" aria-labelledby="portal-proof-title">
        <div class="container product-portal-proof-grid">
            <div class="product-portal-proof-copy reveal">
                <span class="product-evidence-eyebrow">دید مشتری خارج از سازمان</span>
                <h2 id="portal-proof-title">مشتری هم وضعیت پرونده را از همان داده واقعی می‌بیند</h2>
                <p>پرتال مشتری پایگاه داده جداگانه‌ای برای ورود دوباره اطلاعات نیست. استعلام، محموله، رویدادهای مجاز رهگیری و اطلاعات مالی از پرونده‌های ثبت‌شده در سپند خوانده می‌شوند.</p>
                <ul>
                    <li><strong>مسئله:</strong> تماس‌های مکرر برای وضعیت استعلام و محموله.</li>
                    <li><strong>اقدام سپند:</strong> ورود امن OTP و نمایش فقط اطلاعات مجاز همان مشتری.</li>
                    <li><strong>خروجی:</strong> پاسخ‌گویی سلف‌سرویس، بدون ساخت یک جزیره اطلاعاتی تازه.</li>
                </ul>
                <a href="{{ route('site.modules.show', ['module' => 'customer-portal-tracking']) }}">
                    مشاهده پرتال مشتریان و رهگیری
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M19 12H5m6 6-6-6 6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                </a>
            </div>
            <figure class="product-portal-proof-shot reveal">
                <button
                    class="product-screenshot-button"
                    type="button"
                    data-product-lightbox-open
                    data-image-src="{{ asset('assets/images/marketing/'.$portalScreenshot['path']) }}"
                    data-image-alt="{{ $portalScreenshot['alt'] }}"
                    data-image-caption="{{ $portalScreenshot['caption'] }}"
                    aria-label="نمایش بزرگ‌تر داشبورد واقعی پرتال مشتری سپند"
                >
                    <img src="{{ asset('assets/images/marketing/'.$portalScreenshot['path']) }}" alt="{{ $portalScreenshot['alt'] }}" width="{{ $portalScreenshot['width'] }}" height="{{ $portalScreenshot['height'] }}" loading="lazy" decoding="async">
                    <span class="product-screenshot-zoom" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none"><circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="1.7"/><path d="m20 20-4-4M8 11h6M11 8v6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
                        بزرگ‌نمایی
                    </span>
                </button>
                <figcaption><span>تصویر واقعی پرتال مشتری سپند</span>{{ $portalScreenshot['caption'] }}</figcaption>
            </figure>
        </div>
    </section>

    <section class="product-roles" aria-labelledby="roles-title">
        <div class="container">
            <div class="product-section-head reveal">
                <span>یک پرونده، چند زاویه</span>
                <h2 id="roles-title">هر واحد، همان پرونده را از زاویه خودش می‌بیند</h2>
            </div>
            <div class="product-role-grid">
                @foreach($roles as $role)
                    <article class="product-role-card reveal">
                        <span>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <h3>{{ $role['title'] }}</h3>
                        <p>{{ $role['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="cta-wrap product-final-cta">
        <div class="container">
            <div class="cta reveal">
                <div class="cta-copy">
                    <h2>سپند را با فرایند واقعی شرکت خودتان ببینید</h2>
                    <p>در جلسه دمو، فرایند فروش، نرخ‌دهی، Booking، عملیات و مالی سپند را بر اساس سناریوی واقعی یک شرکت حمل‌ونقل بررسی می‌کنیم.</p>
                </div>
                <div class="product-cta-actions">
                    <a class="btn" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="product_bottom_consultation">درخواست دمو</a>
                    <a class="btn product-cta-secondary" href="{{ route('about') }}">تماس با ما</a>
                </div>
            </div>
        </div>
    </section>

    <dialog class="product-lightbox" data-product-lightbox aria-labelledby="product-lightbox-caption">
        <div class="product-lightbox-toolbar">
            <p id="product-lightbox-caption" data-product-lightbox-caption></p>
            <button type="button" data-product-lightbox-close aria-label="بستن تصویر بزرگ">×</button>
        </div>
        <div class="product-lightbox-body">
            <img alt="" data-product-lightbox-image>
        </div>
    </dialog>
@endsection

@push('scripts')
    <script>
        (() => {
            document.querySelectorAll('[data-evidence-gallery]').forEach(gallery => {
                const slides = Array.from(gallery.querySelectorAll('[data-evidence-slide]'));
                const dots = Array.from(gallery.querySelectorAll('[data-evidence-dot]'));
                const caption = gallery.querySelector('[data-evidence-caption]');
                let current = 0;
                let touchStart = 0;

                const show = index => {
                    current = (index + slides.length) % slides.length;
                    slides.forEach((slide, slideIndex) => {
                        const active = slideIndex === current;
                        slide.classList.toggle('is-active', active);
                        slide.setAttribute('aria-hidden', String(!active));
                    });
                    dots.forEach((dot, dotIndex) => {
                        const active = dotIndex === current;
                        dot.classList.toggle('is-active', active);
                        dot.setAttribute('aria-current', String(active));
                    });
                    if (caption) caption.textContent = slides[current].dataset.caption;
                };

                gallery.querySelector('[data-evidence-previous]')?.addEventListener('click', () => show(current - 1));
                gallery.querySelector('[data-evidence-next]')?.addEventListener('click', () => show(current + 1));
                dots.forEach(dot => dot.addEventListener('click', () => show(Number(dot.dataset.evidenceDot))));
                gallery.addEventListener('touchstart', event => { touchStart = event.changedTouches[0].clientX; }, { passive: true });
                gallery.addEventListener('touchend', event => {
                    const distance = event.changedTouches[0].clientX - touchStart;
                    if (Math.abs(distance) > 45 && slides.length > 1) show(current + (distance < 0 ? 1 : -1));
                }, { passive: true });
            });

            const dialog = document.querySelector('[data-product-lightbox]');
            const dialogImage = dialog?.querySelector('[data-product-lightbox-image]');
            const dialogCaption = dialog?.querySelector('[data-product-lightbox-caption]');
            let lastTrigger = null;

            const closeDialog = () => {
                if (!dialog?.open) return;
                dialog.close();
                lastTrigger?.focus();
            };

            document.querySelectorAll('[data-product-lightbox-open]').forEach(button => button.addEventListener('click', () => {
                if (!dialog || !dialogImage || !dialogCaption) return;
                lastTrigger = button;
                dialogImage.src = button.dataset.imageSrc;
                dialogImage.alt = button.dataset.imageAlt;
                dialogCaption.textContent = button.dataset.imageCaption;
                dialog.showModal();
            }));

            dialog?.querySelector('[data-product-lightbox-close]')?.addEventListener('click', closeDialog);
            dialog?.addEventListener('click', event => { if (event.target === dialog) closeDialog(); });
        })();
    </script>
@endpush
