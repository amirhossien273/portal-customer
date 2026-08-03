<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#0f305b">
    <meta name="robots" content="index,follow,max-image-preview:large">
    <meta name="description" content="سپند نرم‌افزار یکپارچه CRM و مدیریت عملیات حمل‌ونقل برای شرکت‌های فورواردری، لجستیک و حمل‌ونقل بین‌المللی است؛ از نرخ‌دهی تا اسناد، مالی و رهگیری.">
    <meta property="og:locale" content="fa_IR">
    <meta property="og:type" content="website">
    <meta property="og:title" content="نرم‌افزار CRM و مدیریت عملیات حمل‌ونقل | سپند">
    <meta property="og:description" content="مدیریت مشتریان، نرخ‌دهی، Booking، عملیات حمل، اسناد، مالی و رهگیری مشتری در یک نرم‌افزار تخصصی.">
    <meta property="og:url" content="{{ route('home') }}">
    <meta property="og:image" content="{{ asset('assets/images/marketing/sepand-cargo-details.webp') }}">
    <meta property="og:site_name" content="سپند">
    <link rel="canonical" href="{{ route('home') }}">
    <title>نرم‌افزار CRM و مدیریت عملیات حمل‌ونقل فورواردینگ | سپند</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon.png') }}?v=20260801">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=20260801">
    @if(config('services.ga4.measurement_id'))
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ rawurlencode(config('services.ga4.measurement_id')) }}"></script>
        <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments)}gtag('js',new Date());gtag('config',@json(config('services.ga4.measurement_id')));</script>
    @endif
    <script type="application/ld+json">{!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'SoftwareApplication',
        'name' => 'نرم‌افزار سپند',
        'applicationCategory' => 'BusinessApplication',
        'operatingSystem' => 'Web',
        'url' => route('home'),
        'description' => 'نرم‌افزار CRM و مدیریت عملیات حمل‌ونقل برای شرکت‌های حمل‌ونقل بین‌المللی، فورواردرینگ و لجستیک.',
        'featureList' => ['CRM و مدیریت مشتریان', 'نرخ‌دهی و فروش', 'رزرو و Booking', 'عملیات حمل', 'مدیریت اسناد', 'مالی و حسابداری چند ارزی', 'Workflow و وظایف', 'پرتال و رهگیری مشتری'],
        'audience' => ['@type' => 'BusinessAudience', 'audienceType' => 'شرکت‌های حمل‌ونقل، فورواردرینگ و لجستیک'],
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
    <script>document.documentElement.classList.add('js');</script>
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}?v=20260803-2">
</head>
<body>
    <a class="skip-link" href="#main-content">رفتن به محتوای اصلی</a>

    <header class="site-header" id="site-header">
        <div class="container nav-wrap">
            <a class="brand" href="{{ route('home') }}" aria-label="سپند، صفحه اصلی">
                <img src="{{ asset('assets/images/brand/sepand-provided-header.png') }}" alt="" aria-hidden="true">
                <span class="brand-copy" aria-hidden="true">
                    <strong>سپند</strong>
                    <small>CRM هوشمند حمل‌ونقل</small>
                </span>
            </a>
            <nav class="main-nav" id="main-nav" aria-label="منوی اصلی">
                <a href="{{ route('modules') }}">ماژول‌ها</a>
                <a href="{{ route('pricing') }}">تعرفه‌ها</a>
                <a href="{{ route('about') }}">درباره ما</a>
                <a href="#why-us">چرا سپند؟</a>
                <div class="portal-actions mobile-portals" aria-label="ورود به سامانه‌های سپند">
                    <a class="portal-link tracking" href="{{ route('tracking') }}" data-ga-event="portal_click" data-ga-label="mobile_tracking">
                        <span class="portal-new">جدید</span>
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M3 15h13V6H7L3 10v5Zm13-6h3l2 3v3h-5V9Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><circle cx="7" cy="17" r="2" stroke="currentColor" stroke-width="1.6"/><circle cx="18" cy="17" r="2" stroke="currentColor" stroke-width="1.6"/></svg>
                        رهگیری محموله
                    </a>
                    <a class="portal-link" href="{{ route('login') }}">
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 19V8h16v11M2 19h20M8 8V5h8v3M8 12h2m4 0h2m-8 3h2m4 0h2" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        پورتال مشتریان
                    </a>
                    <a class="portal-link organization" href="{{ route('organization.portal') }}" data-ga-event="portal_click" data-ga-label="mobile_organization_portal">
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 20V4h10v16M15 9h4v11M3 20h18M8 8h4m-4 4h4m-4 4h4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        پرتال سازمان
                    </a>
                </div>
            </nav>
            <div class="portal-actions desktop-portals" aria-label="ورود به سامانه‌های سپند">
                <a class="portal-link tracking" href="{{ route('tracking') }}" data-ga-event="portal_click" data-ga-label="desktop_tracking">
                    <span class="portal-new">جدید</span>
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M3 15h13V6H7L3 10v5Zm13-6h3l2 3v3h-5V9Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><circle cx="7" cy="17" r="2" stroke="currentColor" stroke-width="1.6"/><circle cx="18" cy="17" r="2" stroke="currentColor" stroke-width="1.6"/></svg>
                    رهگیری محموله
                </a>
                <a class="portal-link" href="{{ route('login') }}">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 19V8h16v11M2 19h20M8 8V5h8v3M8 12h2m4 0h2m-8 3h2m4 0h2" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    پورتال مشتریان
                </a>
                <a class="portal-link organization" href="{{ route('organization.portal') }}" data-ga-event="portal_click" data-ga-label="desktop_organization_portal">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 20V4h10v16M15 9h4v11M3 20h18M8 8h4m-4 4h4m-4 4h4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    پرتال سازمان
                </a>
            </div>
            <button class="menu-toggle" id="menu-toggle" type="button" aria-expanded="false" aria-controls="main-nav" aria-label="باز کردن منو">
                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
            </button>
        </div>
    </header>

    <main id="main-content">
        <section class="hero" id="top">
            <div class="hero-orb" aria-hidden="true"></div>
            <div class="container hero-grid">
                <div class="hero-copy reveal is-visible">
                    <div class="eyebrow"><span class="eyebrow-dot"></span>مسیر هوشمند تجارت شما</div>
                    <h1><span class="hero-title-main">تحول دیجیتال در مدیریت</span><span class="hero-title-accent">حمل‌ونقل و لجستیک</span></h1>
                    <p>یک سامانه متمرکز بر کنترل و هماهنگی تمامی فرآیندهای حمل‌ونقل بین‌المللی، با پشتیبانی از شیوه‌های مختلف حمل، مدیریت هوشمند اطلاعات، اتوماسیون فرآیندها، گزارش‌های مدیریتی و استقرار در زیرساخت‌های داخلی.</p>
                    <div class="hero-actions">
                        <a class="btn btn-primary" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="hero_consultation">
                            درخواست دمو و مشاوره
                            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M19 12H5m6 6-6-6 6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>
                        <a class="btn btn-secondary" href="{{ route('modules') }}" data-ga-event="cta_click" data-ga-label="hero_modules">
                            مشاهده ماژول‌های نرم‌افزار
                            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m8 10 4 4 4-4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>
                    </div>
                    <div class="hero-points" aria-label="مزیت‌های کلیدی">
                        <span class="hero-point"><svg viewBox="0 0 24 24" fill="none"><path d="m5 12 4 4L19 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>CRM و پیگیری فروش</span>
                        <span class="hero-point"><svg viewBox="0 0 24 24" fill="none"><path d="m5 12 4 4L19 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>عملیات و اسناد</span>
                        <span class="hero-point"><svg viewBox="0 0 24 24" fill="none"><path d="m5 12 4 4L19 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>مالی و سود هر پرونده</span>
                    </div>
                </div>

                <div class="hero-visual reveal is-visible delay-2">
                    <div class="visual-glow" aria-hidden="true"></div>
                    <div class="visual-ring" aria-hidden="true"></div>
                    <figure class="product-shot">
                        <img src="{{ asset('assets/images/marketing/sepand-cargo-details.webp') }}" width="835" height="335" fetchpriority="high" decoding="async" alt="نمای واقعی فرم اطلاعات کالا در نرم‌افزار مدیریت حمل‌ونقل سپند">
                        <figcaption>نمای واقعی نرم‌افزار سپند با داده‌های نمونه و بدون اطلاعات مشتری</figcaption>
                    </figure>
                </div>
            </div>
        </section>

        <div class="trust-bar reveal">
            <div class="container trust-inner">
                <div class="trust-copy"><strong>یک نرم‌افزار برای تمام فرایند</strong><span>از اولین تماس مشتری تا سود و گزارش پرونده</span></div>
                <div class="trust-item"><svg viewBox="0 0 24 24" fill="none"><path d="M16 20v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M9 10a4 4 0 1 0 0-8 4 4 0 0 0 0 8" stroke="currentColor" stroke-width="1.6"/></svg>CRM و فروش</div>
                <div class="trust-item"><svg viewBox="0 0 24 24" fill="none"><path d="M4 5h16v14H4V5Zm4 4h8m-8 4h8" stroke="currentColor" stroke-width="1.6"/></svg>Booking و عملیات</div>
                <div class="trust-item"><svg viewBox="0 0 24 24" fill="none"><path d="M5 4h14v16H5V4Zm4 4h6m-6 4h6" stroke="currentColor" stroke-width="1.6"/></svg>اسناد و مالی</div>
                <div class="trust-item"><svg viewBox="0 0 24 24" fill="none"><path d="M7 7h11m0 0-3-3m3 3-3 3M17 17H6m0 0 3 3m-3-3 3-3" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>حسابداری چند ارزی</div>
                <div class="trust-item"><svg viewBox="0 0 24 24" fill="none"><path d="M21 15a4 4 0 0 1-4 4H8l-5 3 1.5-4.5A7 7 0 0 1 3 13V9a6 6 0 0 1 6-6h6a6 6 0 0 1 6 6v6Z" stroke="currentColor" stroke-width="1.6"/></svg>پرتال مشتری</div>
            </div>
        </div>

        <section class="section" id="software-modules">
            <div class="container">
                <div class="section-head reveal">
                    <span class="section-label">محصول سپند</span>
                    <h2 class="section-title">ماژول‌های نرم‌افزار سپند</h2>
                    <p class="section-subtitle">ماژول‌های متصل برای مدیریت مشتری، فروش، رزرو، عملیات، اسناد و مالی؛ بدون ورود چندباره اطلاعات و بدون جزیره‌های نرم‌افزاری.</p>
                </div>
                <div class="services-grid">
                    @foreach(config('site_modules') as $slug => $module)
                        <article class="service-card reveal delay-{{ ($loop->index % 4) + 1 }}">
                            <span class="service-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M4 5h16v14H4V5Zm4 4h8m-8 4h8m-8 4h5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></span>
                            <h3>{{ $module['name'] }}</h3>
                            <p>{{ $module['summary'] }}</p>
                            <a class="service-link" href="{{ route('site.modules.show', ['module' => $slug]) }}">مشاهده ماژول {{ $module['name'] }} <svg viewBox="0 0 24 24" fill="none"><path d="M19 12H5m6 6-6-6 6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></a>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="section transport-modes" id="transport-modes">
            <div class="container">
                <div class="section-head transport-head reveal">
                    <span class="transport-label">حالت‌های حمل</span>
                    <h2 class="section-title transport-title">یک پلتفرم، تمامی حالات حمل</h2>
                    <p class="section-subtitle">مدیریت سفر، کانتینر، پرواز، ULD، واگن، ناوگان زمینی و رویدادهای رهگیری — همگی در یک تجربه منسجم.</p>
                </div>
                <div class="transport-grid">
                    <article class="transport-card reveal delay-1">
                        <span class="transport-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="M4 12 6 7h12l2 5-3 6H7l-3-6Zm2 0 6-3 6 3M12 4v5M9 4h6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        <h3>حمل دریایی</h3>
                        <p>D&amp;D، VGM، HBL/MBL و رادار ناوگان.</p>
                    </article>
                    <article class="transport-card reveal delay-2">
                        <span class="transport-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="m3 11 7.5 1.5L14 21l2-1-1-7 5-2.5a2.5 2.5 0 0 0 1.3-3.1 2.5 2.5 0 0 0-3.2-1.2L13 8.5 7 3 5 4l4 6-5.5-1L3 11Z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        <h3>حمل هوایی</h3>
                        <p>ULD، MAWB/HAWB و وزن قابل وصول.</p>
                    </article>
                    <article class="transport-card reveal delay-3">
                        <span class="transport-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="M3 6h11v11H3V6Zm11 4h4l3 4v3h-7v-7ZM7 20a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm10 0a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        <h3>حمل زمینی</h3>
                        <p>ناوگان، راننده، برنامه و مسیر.</p>
                    </article>
                    <article class="transport-card reveal delay-4">
                        <span class="transport-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="M7 3h10a2 2 0 0 1 2 2v10a3 3 0 0 1-3 3H8a3 3 0 0 1-3-3V5a2 2 0 0 1 2-2Zm-2 7h14M8 21l2-3m6 0 2 3M8.5 14h.01m6.99 0h.01" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        <h3>حمل ریلی</h3>
                        <p>واگن، ایستگاه و کنترل اسناد.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="section section-soft" id="audiences">
            <div class="container">
                <div class="section-head reveal">
                    <span class="section-label">مخاطبان نرم‌افزار</span>
                    <h2 class="section-title">سپند برای چه کسب‌وکارهایی طراحی شده است؟</h2>
                    <p class="section-subtitle">سپند برای سازمان‌هایی ساخته شده که فروش، عملیات حمل، اسناد و مالی آن‌ها باید روی یک داده مشترک کار کنند.</p>
                </div>
                <div class="audience-grid">
                    <article class="audience-card reveal"><h3>شرکت‌های حمل‌ونقل بین‌المللی</h3><p>برای یکپارچه‌کردن پرونده‌های حمل، مشتریان، اسناد، هزینه‌ها و گزارش‌های مدیریتی.</p></article>
                    <article class="audience-card reveal"><h3>شرکت‌های فورواردری</h3><p>برای مدیریت نرخ‌دهی، Booking، تأمین‌کنندگان و هماهنگی عملیات چندوجهی.</p></article>
                    <article class="audience-card reveal"><h3>NVOCCها</h3><p>برای کنترل رزرو، ظرفیت، اسناد و ارتباط منظم میان نمایندگان و مشتریان.</p></article>
                    <article class="audience-card reveal"><h3>نمایندگان خطوط حمل</h3><p>برای ثبت ساختاریافته درخواست‌ها، پیگیری تعهدات و پاسخ‌گویی سریع‌تر به مشتری.</p></article>
                    <article class="audience-card reveal"><h3>شرکت‌های لجستیک</h3><p>برای داشتن دید یکپارچه از مشتری، عملیات، مالی و کیفیت اجرای خدمات.</p></article>
                    <article class="audience-card reveal"><h3>تیم‌های فروش، عملیات و مالی</h3><p>برای کار روی یک پرونده مشترک با مسئولیت، مهلت و داده‌های قابل‌اعتماد.</p></article>
                </div>
            </div>
        </section>

        <section class="section" id="problems">
            <div class="container">
                <div class="section-head reveal">
                    <span class="section-label">از مسئله تا راهکار</span>
                    <h2 class="section-title">سپند چه مشکلاتی را حل می‌کند؟</h2>
                    <p class="section-subtitle">هر مسئله عملیاتی با یک قابلیت مشخص در نرم‌افزار پاسخ داده می‌شود؛ نه با یک وعده کلی.</p>
                </div>
                <div class="problem-grid">
                    <article class="problem-card reveal"><h3>پراکندگی اطلاعات میان Excel، واتساپ و ایمیل</h3><p><strong>راهکار سپند:</strong> پرونده یکپارچه مشتری و محموله، اطلاعات مرتبط را در یک منبع مشترک و جست‌وجوپذیر نگه می‌دارد.</p></article>
                    <article class="problem-card reveal"><h3>فراموش‌شدن پیگیری مشتری</h3><p><strong>راهکار سپند:</strong> CRM، وظایف زمان‌دار و یادآوری اقدام بعدی، مالک هر پیگیری و موعد آن را روشن می‌کند.</p></article>
                    <article class="problem-card reveal"><h3>نبود دید یکپارچه از وضعیت محموله‌ها</h3><p><strong>راهکار سپند:</strong> داشبورد عملیات، مرحله جاری، رویدادها و پرونده‌های نیازمند اقدام را در یک نما نشان می‌دهد.</p></article>
                    <article class="problem-card reveal"><h3>تأخیر در صدور و کنترل اسناد</h3><p><strong>راهکار سپند:</strong> مدیریت اسناد، نسخه جاری، وضعیت تأیید، مسئول کنترل و مهلت هر سند را ثبت می‌کند.</p></article>
                    <article class="problem-card reveal"><h3>نامشخص‌بودن سود هر پرونده</h3><p><strong>راهکار سپند:</strong> اتصال درآمد و هزینه به پرونده عملیاتی، حاشیه سود واقعی هر حمل و مشتری را قابل‌مشاهده می‌کند.</p></article>
                    <article class="problem-card reveal"><h3>وابستگی زیاد عملیات به افراد</h3><p><strong>راهکار سپند:</strong> Workflow استاندارد و تاریخچه اقدامات، دانش فرایند را از حافظه افراد به سامانه منتقل می‌کند.</p></article>
                    <article class="problem-card reveal"><h3>نبود گزارش مدیریتی لحظه‌ای</h3><p><strong>راهکار سپند:</strong> داده‌های متصل فروش، عملیات و مالی، گزارش قابل‌فیلتر را بدون جمع‌آوری دستی آماده می‌کنند.</p></article>
                </div>
            </div>
        </section>

        <section class="section section-soft" id="about">
            <div class="container about-grid">
                <div class="about-visual reveal">
                    <div class="about-panel">
                        <div class="about-content-card">
                            <span class="about-logo"><img src="{{ asset('assets/images/brand/sepand-provided-header.png') }}" alt=""></span>
                            <p class="about-quote">فروش، عملیات، اسناد و مالی روی یک پرونده مشترک کار می‌کنند؛ هر داده فقط یک‌بار ثبت می‌شود و در مرحله بعدی قابل‌استفاده است.</p>
                            <div class="about-meta">کاربرد واقعی نرم‌افزار سپند</div>
                        </div>
                    </div>
                    <div class="about-badge"><strong>یک پرونده واحد</strong><span>از سرنخ فروش تا تسویه مالی</span><div class="about-badge-line"><i></i><i></i><i></i></div></div>
                </div>
                <div class="about-copy reveal delay-2">
                    <span class="section-label">کاربرد واقعی محصول</span>
                    <h2 class="section-title">از اولین درخواست مشتری تا<br><span>عملیات، اسناد و سود پرونده</span></h2>
                    <p>کاربر فروش درخواست مشتری و نرخ را ثبت می‌کند؛ پس از تأیید، همان اطلاعات وارد Booking و پرونده عملیات می‌شود. تیم اسناد و مالی نیز بدون ساخت پرونده جداگانه، وظایف و اطلاعات مرتبط را تکمیل می‌کنند و مدیر وضعیت کل جریان را در گزارش‌ها می‌بیند.</p>
                    <div class="about-list">
                        <div class="about-list-item"><span><svg viewBox="0 0 24 24" fill="none"><path d="m5 12 4 4L19 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></span>تبدیل پیشنهاد فروش به پرونده حمل</div>
                        <div class="about-list-item"><span><svg viewBox="0 0 24 24" fill="none"><path d="m5 12 4 4L19 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></span>اتصال اسناد به Booking و عملیات</div>
                        <div class="about-list-item"><span><svg viewBox="0 0 24 24" fill="none"><path d="m5 12 4 4L19 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></span>محاسبه سود بر پایه هزینه واقعی</div>
                        <div class="about-list-item"><span><svg viewBox="0 0 24 24" fill="none"><path d="m5 12 4 4L19 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></span>رهگیری کنترل‌شده برای مشتری</div>
                    </div>
                    <a class="btn btn-primary" href="{{ route('modules') }}">مشاهده همه ماژول‌ها <svg viewBox="0 0 24 24" fill="none"><path d="M19 12H5m6 6-6-6 6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></a>
                </div>
            </div>
        </section>

        <section class="why" id="why-us">
            <div class="container">
                <div class="why-top reveal">
                    <div><span class="section-label">نتیجه قابل اندازه‌گیری</span><h2 class="section-title">مزیت‌های قابل سنجش<br><span>استفاده از سپند</span></h2></div>
                    <p class="why-intro">شاخص‌های زیر را می‌توان پیش و پس از استقرار برای هر تیم اندازه‌گیری کرد؛ از تعداد ورود تکراری داده تا زمان پیگیری و گزارش‌گیری.</p>
                </div>
                <div class="why-grid">
                    <article class="why-card reveal delay-1"><span class="why-num">۰۱</span><span class="why-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M4 19V9m5 10V5m5 14v-7m5 7V3" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg></span><h3>ورود یک‌باره اطلاعات</h3><p>تعداد دفعات ثبت مجدد اطلاعات مشتری، نرخ و Booking میان فروش، عملیات و مالی کاهش می‌یابد.</p></article>
                    <article class="why-card reveal delay-2"><span class="why-num">۰۲</span><span class="why-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M12 3a9 9 0 1 0 9 9M12 7v5l3 2" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/><path d="m17 3 4 1-1 4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg></span><h3>پیگیری زمان‌مند</h3><p>وظایف عقب‌افتاده، زمان پاسخ به مشتری و درصد پیگیری‌های انجام‌شده قابل‌اندازه‌گیری می‌شوند.</p></article>
                    <article class="why-card reveal delay-3"><span class="why-num">۰۳</span><span class="why-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M4 5h16v14H4V5Zm4 4h8m-8 4h8" stroke="currentColor" stroke-width="1.7"/></svg></span><h3>سود هر پرونده</h3><p>درآمد، هزینه و حاشیه سود هر پرونده به‌جای برآورد کلی، از داده‌های متصل عملیاتی دیده می‌شود.</p></article>
                    <article class="why-card reveal delay-4"><span class="why-num">۰۴</span><span class="why-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M5 19V5h14v14H5Zm3-4 3-3 2 2 3-4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg></span><h3>گزارش بدون تجمیع دستی</h3><p>زمان آماده‌سازی گزارش و تعداد فایل‌های جانبی لازم برای تصمیم‌گیری مدیریتی قابل‌کاهش و سنجش است.</p></article>
                </div>
            </div>
        </section>

        <section class="section" id="process">
            <div class="container">
                <div class="section-head reveal">
                    <span class="section-label">Workflow محصول</span>
                    <h2 class="section-title">فرایند واقعی کار با<br><span>نرم‌افزار سپند</span></h2>
                    <p class="section-subtitle">اطلاعات در طول فرایند حمل تکمیل می‌شوند و بدون ساخت پرونده‌های جداگانه، میان تیم‌ها جریان پیدا می‌کنند.</p>
                </div>
                <div class="process-grid">
                    <article class="process-item reveal delay-1"><span class="process-num">۱</span><h3>CRM و درخواست مشتری</h3><p>مشتری، نیاز حمل، تعاملات و اقدام بعدی در پرونده CRM ثبت می‌شود.</p></article>
                    <article class="process-item reveal delay-2"><span class="process-num">۲</span><h3>نرخ‌دهی و پیشنهاد فروش</h3><p>هزینه، قیمت فروش، اعتبار نرخ و حاشیه سود پیشنهادی کنترل می‌شود.</p></article>
                    <article class="process-item reveal delay-3"><span class="process-num">۳</span><h3>رزرو و Booking</h3><p>پیشنهاد تأییدشده با همان داده‌ها به رزرو و پرونده حمل تبدیل می‌شود.</p></article>
                    <article class="process-item reveal delay-1"><span class="process-num">۴</span><h3>اجرای عملیات حمل</h3><p>رویدادها، مسئولیت‌ها، مهلت‌ها و وضعیت محموله مرحله‌به‌مرحله ثبت می‌شوند.</p></article>
                    <article class="process-item reveal delay-2"><span class="process-num">۵</span><h3>اسناد و اطلاع‌رسانی</h3><p>اسناد کنترل می‌شوند و وضعیت مجاز از طریق پرتال در اختیار مشتری قرار می‌گیرد.</p></article>
                    <article class="process-item reveal delay-3"><span class="process-num">۶</span><h3>مالی، سود و گزارش</h3><p>دریافت، پرداخت و سود پرونده برای گزارش مدیریتی نهایی تکمیل می‌شود.</p></article>
                </div>
            </div>
        </section>

        <section class="cta-wrap" id="contact">
            <div class="container">
                <div class="cta reveal">
                    <div class="cta-copy"><h2>فرایند واقعی شرکت خود را در سپند ببینید</h2><p>در یک جلسه دمو، سناریوی فروش، عملیات، اسناد و مالی شما را روی نرم‌افزار بررسی می‌کنیم.</p></div>
                    <div class="cta-actions"><a class="btn" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="home_bottom_consultation">درخواست دمو و مشاوره <svg viewBox="0 0 24 24" fill="none"><path d="M19 12H5m6 6-6-6 6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></a></div>
                </div>
            </div>
        </section>
    </main>

    <footer class="site-footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand"><a href="{{ route('home') }}"><img src="{{ asset('assets/images/brand/sepand-provided-header.png') }}" alt="سپند"></a><p>سپند، نرم‌افزار یکپارچه CRM و مدیریت عملیات حمل‌ونقل برای شرکت‌های فورواردری، لجستیک و حمل‌ونقل بین‌المللی.</p></div>
                <div class="footer-col"><h3>دسترسی سریع</h3><a href="{{ route('modules') }}">ماژول‌ها</a><a href="{{ route('pricing') }}">تعرفه‌ها</a><a href="{{ route('about') }}">درباره ما</a></div>
                <div class="footer-col"><h3>راهکارها</h3><a href="{{ route('site.modules.show', ['module' => 'crm']) }}">CRM حمل‌ونقل</a><a href="{{ route('site.modules.show', ['module' => 'transport-operations']) }}">مدیریت عملیات</a><a href="{{ route('site.modules.show', ['module' => 'finance-accounting']) }}">مالی و سود پرونده</a></div>
                <div class="footer-col"><h3>ارتباط با ما</h3><a class="footer-contact" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="footer_consultation"><svg viewBox="0 0 24 24" fill="none"><path d="M4 5h16v14H4V5Zm0 1 8 7 8-7" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>درخواست دمو و مشاوره</a><a class="footer-contact" href="{{ route('login') }}"><svg viewBox="0 0 24 24" fill="none"><path d="M4 13a8 8 0 0 1 16 0v5a2 2 0 0 1-2 2h-2v-7h4M4 13v7H2a2 2 0 0 1-2-2v-5h4Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>ورود مشتریان</a></div>
            </div>
            <div class="footer-bottom"><span>© {{ date('Y') }} سپند؛ تمامی حقوق محفوظ است.</span><span class="footer-status"><i></i>سامانه‌های سپند فعال هستند</span></div>
        </div>
    </footer>

    <script>
        (() => {
            const header = document.getElementById('site-header');
            const menu = document.getElementById('main-nav');
            const toggle = document.getElementById('menu-toggle');

            const track = (eventName, eventLabel, url) => {
                const payload = { event_category: 'marketing', event_label: eventLabel, link_url: url || window.location.href };
                if (typeof window.gtag === 'function') {
                    window.gtag('event', eventName, payload);
                } else {
                    window.dataLayer = window.dataLayer || [];
                    window.dataLayer.push({ event: eventName, ...payload });
                }
            };

            document.addEventListener('click', event => {
                const link = event.target.closest('[data-ga-event]');
                if (link) track(link.dataset.gaEvent, link.dataset.gaLabel || link.textContent.trim(), link.href);
            });

            const updateHeader = () => header.classList.toggle('scrolled', window.scrollY > 18);
            updateHeader();
            window.addEventListener('scroll', updateHeader, { passive: true });

            toggle.addEventListener('click', () => {
                const open = menu.classList.toggle('open');
                toggle.setAttribute('aria-expanded', String(open));
                toggle.setAttribute('aria-label', open ? 'بستن منو' : 'باز کردن منو');
                document.body.classList.toggle('menu-open', open);
            });

            menu.querySelectorAll('a').forEach(link => link.addEventListener('click', () => {
                menu.classList.remove('open');
                toggle.setAttribute('aria-expanded', 'false');
                document.body.classList.remove('menu-open');
            }));

            const revealItems = document.querySelectorAll('.reveal:not(.is-visible)');
            if ('IntersectionObserver' in window) {
                const observer = new IntersectionObserver((entries, instance) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('is-visible');
                            instance.unobserve(entry.target);
                        }
                    });
                }, { threshold: .12, rootMargin: '0px 0px -35px' });
                revealItems.forEach(item => observer.observe(item));
            } else {
                revealItems.forEach(item => item.classList.add('is-visible'));
            }

        })();
    </script>
</body>
</html>
