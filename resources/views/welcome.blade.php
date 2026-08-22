<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    @include('layouts.partials.google-analytics')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#0f305b">
    <meta name="robots" content="index,follow,max-image-preview:large">
    <meta name="googlebot" content="index,follow,max-image-preview:large,max-snippet:-1,max-video-preview:-1">
    <meta name="description" content="سپند، نرم‌افزار مدیریت حمل‌ونقل با CRM، تحلیل مشتری، مقایسه تأمین‌کننده، هشدار نرخ، عملیات، مالی و پرتال مشتریان برای رهگیری محموله.">
    <meta property="og:locale" content="fa_IR">
    <meta property="og:type" content="website">
    <meta property="og:title" content="نرم‌افزار مدیریت حمل‌ونقل بین‌المللی و فورواردری | سپند">
    <meta property="og:description" content="سامانه یکپارچه شرکت‌های حمل‌ونقل؛ از CRM، تحلیل مشتری و تأمین‌کننده تا عملیات، مالی و پرتال مشتریان با ورود OTP و رهگیری محموله.">
    <meta property="og:url" content="{{ route('home') }}">
    <meta property="og:image" content="{{ asset('assets/images/marketing/sepand-cargo-details.webp') }}">
    <meta property="og:image:alt" content="نرم‌افزار CRM و مدیریت عملیات حمل‌ونقل سپند">
    <meta property="og:site_name" content="سپند">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="نرم‌افزار مدیریت حمل‌ونقل بین‌المللی و فورواردری | سپند">
    <meta name="twitter:description" content="سامانه یکپارچه شرکت‌های حمل‌ونقل؛ از CRM، تحلیل مشتری و تأمین‌کننده تا عملیات، مالی و پرتال مشتریان با ورود OTP و رهگیری محموله.">
    <meta name="twitter:image" content="{{ asset('assets/images/marketing/sepand-cargo-details.webp') }}">
    <link rel="canonical" href="{{ route('home') }}">
    <title>نرم‌افزار مدیریت حمل‌ونقل بین‌المللی و فورواردری | سپند</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon.png') }}?v=20260801">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=20260801">
    <script type="application/ld+json">{!! json_encode([
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'Organization',
                '@id' => route('home').'#organization',
                'name' => 'سپند',
                'url' => route('home'),
                'logo' => asset('assets/images/brand/sepand-provided-header.png'),
            ],
            [
                '@type' => 'WebSite',
                '@id' => route('home').'#website',
                'url' => route('home'),
                'name' => 'سپند',
                'alternateName' => ['Sepand', 'SepandCRM'],
                'inLanguage' => 'fa-IR',
                'publisher' => ['@id' => route('home').'#organization'],
            ],
            [
                '@type' => 'SoftwareApplication',
                '@id' => route('home').'#software',
                'name' => 'نرم‌افزار سپند',
                'applicationCategory' => 'BusinessApplication',
                'operatingSystem' => 'Web',
                'url' => route('home'),
                'image' => asset('assets/images/marketing/sepand-cargo-details.webp'),
                'description' => 'نرم‌افزار یکپارچه CRM، تحلیل مشتری، نرخ‌دهی، عملیات، مالی و پرتال مشتریان برای شرکت‌های حمل‌ونقل بین‌المللی، فورواردرینگ و لجستیک.',
                'featureList' => ['CRM و مدیریت مشتریان', 'تحلیل درآمد و سود مشتریان', 'بازاریابی و ارسال پیامک از CRM', 'مقایسه تأمین‌کنندگان', 'هشدار انقضای نرخ', 'پیگیری پیش‌فاکتورهای ۴۸ ساعته', 'رزرو و Booking', 'عملیات حمل', 'مدیریت اسناد', 'مالی و حسابداری چند ارزی', 'گردش کار هوشمند و وظایف', 'ورود OTP پرتال مشتریان', 'مشاهده وضعیت استعلام', 'رهگیری رویدادهای مجاز محموله', 'صورتحساب و رسید مشتری'],
                'audience' => ['@type' => 'BusinessAudience', 'audienceType' => 'شرکت‌های حمل‌ونقل، فورواردرینگ و لجستیک'],
                'publisher' => ['@id' => route('home').'#organization'],
            ],
        ],
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
    <script>document.documentElement.classList.add('js');</script>
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}?v=20260822-2">
    <link rel="stylesheet" href="{{ asset('assets/css/marketing-floating-cta.css') }}?v=20260818-1">
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
                <a href="{{ route('faq') }}">سؤالات متداول</a>
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
                    <h1><span class="hero-title-main">نرم‌افزار مدیریت حمل‌ونقل بین‌المللی</span><span class="hero-title-accent">و فورواردری سپند</span></h1>
                    <div class="hero-description">
                        <p>سپند یک نرم افزار حمل و نقل بین المللی برای مدیریت فرایندهای شرکت‌های حمل، فورواردری و لجستیک است؛ از ثبت لید، ارتباط پیامکی و پیگیری فرصت فروش تا استعلام، رزرو، عملیات اجرایی، اسناد و امور مالی.</p>
                        <p>پرتال مشتریان سپند همین جریان را تا خدمات پس از فروش ادامه می‌دهد؛ مشتری با کد یک‌بارمصرف وارد می‌شود و وضعیت استعلام، محموله، رویدادهای مجاز رهگیری، صورتحساب و رسیدهای خود را مشاهده می‌کند.</p>
                    </div>
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
                </div>

                <div class="hero-visual reveal is-visible delay-2">
                    <div class="visual-glow" aria-hidden="true"></div>
                    <div class="visual-ring" aria-hidden="true"></div>
                    <div class="hero-device-showcase" data-hero-device-showcase data-autoplay="5200" role="group" aria-label="نمای خودکار نسخه دسکتاپ و موبایل نرم‌افزار سپند">
                        <div class="hero-showcase-laptop" aria-label="تصاویر نسخه دسکتاپ نرم‌افزار سپند">
                            <div class="laptop-frame">
                                <div class="laptop-camera" aria-hidden="true"></div>
                                <div class="device-viewport device-viewport-desktop">
                                    <figure class="device-slide is-active" data-desktop-slide aria-hidden="false">
                                        <img src="{{ asset('assets/images/marketing/product-showcase/desktop-dashboard.webp') }}" width="1600" height="799" fetchpriority="high" decoding="async" alt="داشبورد مدیریتی نسخه دسکتاپ نرم‌افزار حمل‌ونقل سپند">
                                    </figure>
                                    <figure class="device-slide" data-desktop-slide aria-hidden="true">
                                        <img src="{{ asset('assets/images/marketing/product-showcase/desktop-calendar.webp') }}" width="1600" height="840" loading="lazy" decoding="async" alt="تقویم فعالیت‌ها و تسک‌های نسخه دسکتاپ نرم‌افزار سپند">
                                    </figure>
                                    <figure class="device-slide" data-desktop-slide aria-hidden="true">
                                        <img src="{{ asset('assets/images/marketing/product-showcase/desktop-reports.webp') }}" width="1600" height="844" loading="lazy" decoding="async" alt="گزارش‌ها و نمودارهای تحلیلی نسخه دسکتاپ نرم‌افزار سپند">
                                    </figure>
                                </div>
                            </div>
                            <div class="laptop-base" aria-hidden="true"><span></span></div>
                        </div>

                        <div class="hero-showcase-phone" aria-label="تصاویر نسخه موبایل نرم‌افزار سپند">
                            <div class="phone-frame">
                                <div class="phone-speaker" aria-hidden="true"></div>
                                <div class="device-viewport device-viewport-mobile">
                                    <figure class="device-slide is-active" data-mobile-slide aria-hidden="false">
                                        <img src="{{ asset('assets/images/marketing/product-showcase/mobile-dashboard.webp') }}" width="720" height="1447" loading="eager" decoding="async" alt="داشبورد واکنش‌گرای نرم‌افزار سپند در گوشی موبایل">
                                    </figure>
                                    <figure class="device-slide" data-mobile-slide aria-hidden="true">
                                        <img src="{{ asset('assets/images/marketing/product-showcase/mobile-inquiry.webp') }}" width="720" height="1451" loading="lazy" decoding="async" alt="جزئیات استعلام در نسخه موبایل نرم‌افزار سپند">
                                    </figure>
                                    <figure class="device-slide" data-mobile-slide aria-hidden="true">
                                        <img src="{{ asset('assets/images/marketing/product-showcase/mobile-operation.webp') }}" width="720" height="1438" loading="lazy" decoding="async" alt="جزئیات عملیات حمل در نسخه موبایل نرم‌افزار سپند">
                                    </figure>
                                </div>
                                <span class="phone-home-indicator" aria-hidden="true"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="trust-bar reveal" aria-label="مزیت‌های کلیدی سپند">
            <div class="container trust-inner">
                <article class="trust-item">
                    <span class="trust-icon"><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="5" cy="12" r="2" stroke="currentColor" stroke-width="1.7"/><circle cx="19" cy="5" r="2" stroke="currentColor" stroke-width="1.7"/><circle cx="19" cy="19" r="2" stroke="currentColor" stroke-width="1.7"/><circle cx="12" cy="12" r="2" stroke="currentColor" stroke-width="1.7"/><path d="m7 12 3 0m3.4-1.4 4.2-4.2m-4.2 7 4.2 4.2" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg></span>
                    <span class="trust-text"><strong>مدیریت یکپارچه</strong><small>فرایندها و حسابداری چندارزی در یک سامانه متمرکز</small></span>
                </article>
                <article class="trust-item">
                    <span class="trust-icon"><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M9.7 3.5h4.6l.6 2.1 1.4.8 2.1-.6 2.3 4-1.5 1.5v1.6l1.5 1.5-2.3 4-2.1-.6-1.4.8-.6 2.1H9.7l-.6-2.1-1.4-.8-2.1.6-2.3-4 1.5-1.5v-1.6L3.3 9.8l2.3-4 2.1.6 1.4-.8.6-2.1Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/><circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.6"/></svg></span>
                    <span class="trust-text"><strong>اتوماسیون هوشمند</strong><small>کاهش خطاهای انسانی و افزایش سرعت عملیات</small></span>
                </article>
                <article class="trust-item">
                    <span class="trust-icon"><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 4h16v16H4V4Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><path d="m7 16 3.3-3.5 2.8 2 4.2-6M16 8.5h1.5V10" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                    <span class="trust-text"><strong>گزارش‌های تحلیلی</strong><small>داشبوردهای هوشمند برای تصمیم‌گیری بهتر</small></span>
                </article>
                <article class="trust-item">
                    <span class="trust-icon"><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 3 20 6v5c0 5.2-3.2 8.3-8 10-4.8-1.7-8-4.8-8-10V6l8-3Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><path d="m8.5 12 2.2 2.2 4.8-5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                    <span class="trust-text"><strong>امنیت و استقرار داخلی</strong><small>استقرار امن در زیرساخت‌های داخلی سازمان</small></span>
                </article>
            </div>
        </div>

        <section class="section" id="software-modules">
            <div class="container">
                <div class="section-head reveal">
                    <span class="section-label">محصول سپند</span>
                    <h2 class="section-title">سامانه جامع حمل و نقل بین المللی برای فرایندهای یکپارچه</h2>
                    <p class="section-subtitle">CRM، بازاریابی پیامکی، تسک خودکار، نرخ‌دهی، Booking، عملیات، اسناد، امور مالی و پرتال مشتریان سپند روی داده‌ای مشترک کار می‌کنند تا رویدادهای فروش به اقدام مشخص تبدیل شوند و اطلاعات بدون ثبت تکراری جریان داشته باشد.</p>
                </div>
                <div class="services-grid">
                    @foreach(config('site_modules') as $slug => $module)
                        <article class="service-card reveal delay-{{ ($loop->index % 4) + 1 }}">
                            <span class="service-icon" aria-hidden="true">
                                @switch($slug)
                                    @case('crm')
                                        <svg viewBox="0 0 24 24" fill="none"><circle cx="9" cy="8" r="3" stroke="currentColor" stroke-width="1.7"/><path d="M3.5 19v-1.5A4.5 4.5 0 0 1 8 13h2a4.5 4.5 0 0 1 4.5 4.5V19M16 5.5a3 3 0 0 1 0 5.8M17 14a4.5 4.5 0 0 1 3.5 4.4V19" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
                                        @break
                                    @case('pricing-sales')
                                        <svg viewBox="0 0 24 24" fill="none"><path d="m4 11 7-7h7l2 2v7l-7 7-9-9Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><circle cx="15.5" cy="8.5" r="1.4" stroke="currentColor" stroke-width="1.6"/><path d="M8 13.5h5M9 16h2" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
                                        @break
                                    @case('booking')
                                        <svg viewBox="0 0 24 24" fill="none"><rect x="3.5" y="5" width="17" height="15" rx="2" stroke="currentColor" stroke-width="1.7"/><path d="M7.5 3v4M16.5 3v4M3.5 9h17m-12 5 2 2 4-4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        @break
                                    @case('transport-operations')
                                        <svg viewBox="0 0 24 24" fill="none"><path d="M3 6h11v10H3V6Zm11 4h4l3 3v3h-7v-6Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><circle cx="7" cy="18" r="2" stroke="currentColor" stroke-width="1.7"/><circle cx="18" cy="18" r="2" stroke="currentColor" stroke-width="1.7"/><path d="M6 10h5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
                                        @break
                                    @case('document-management')
                                        <svg viewBox="0 0 24 24" fill="none"><path d="M7 3h7l4 4v14H7V3Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M14 3v5h4M10 12h5m-5 3h5m-5 3h3M4 7v11" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        @break
                                    @case('finance-accounting')
                                        <svg viewBox="0 0 24 24" fill="none"><circle cx="8" cy="8" r="4" stroke="currentColor" stroke-width="1.7"/><circle cx="16" cy="16" r="4" stroke="currentColor" stroke-width="1.7"/><path d="M6.3 8h3.4M8 6.3v3.4m6.3 6.3h3.4M16 14.3v3.4M13.5 5.5H19v5.5M10.5 18.5H5V13" stroke="currentColor" stroke-width="1.55" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        @break
                                    @case('workflow-tasks')
                                        <svg viewBox="0 0 24 24" fill="none"><rect x="3" y="4" width="6" height="5" rx="1.5" stroke="currentColor" stroke-width="1.7"/><rect x="15" y="15" width="6" height="5" rx="1.5" stroke="currentColor" stroke-width="1.7"/><path d="M9 6.5h4a3 3 0 0 1 3 3V12M15 17.5h-4a3 3 0 0 1-3-3V12m5.5-2 2.5 2 2.5-2M10.5 14 8 12l-2.5 2" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        @break
                                    @case('automatic-tasks')
                                        <svg viewBox="0 0 24 24" fill="none"><path d="M5 4h10v16H5V4Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M8 8h4M8 12h3m-3 4h4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/><path d="M18 7v4m-2-2h4m-5.5 6.5 1.7 1.7 3.3-3.7" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        @break
                                    @case('customer-portal-tracking')
                                        <svg viewBox="0 0 24 24" fill="none"><rect x="3" y="4" width="18" height="15" rx="2" stroke="currentColor" stroke-width="1.7"/><path d="M3 8h18M8 22h8M12 19v3" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/><path d="M15.5 11.5c0 2-3 4.5-3 4.5s-3-2.5-3-4.5a3 3 0 1 1 6 0Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/><circle cx="12.5" cy="11.5" r=".8" fill="currentColor"/></svg>
                                        @break
                                    @default
                                        <svg viewBox="0 0 24 24" fill="none"><path d="M4 5h16v14H4V5Zm4 4h8m-8 4h8m-8 4h5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
                                @endswitch
                            </span>
                            <h3>{{ $module['card_title'] ?? $module['name'] }}</h3>
                            <p>{{ $module['card_summary'] ?? $module['summary'] }}</p>
                            <a class="service-link" href="{{ route('site.modules.show', ['module' => $slug]) }}">{{ $module['card_cta'] ?? 'مشاهده جزئیات' }} <svg viewBox="0 0 24 24" fill="none"><path d="M19 12H5m6 6-6-6 6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></a>
                        </article>
                        @if($slug === 'crm')
                            <article class="service-card reveal delay-2">
                                <span class="service-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="M4 5h16v11H8l-4 4V5Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M8 9h8m-8 3h5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg></span>
                                <h3>بازاریابی پیامکی و ارتباط با مشتری</h3>
                                <p>از پرونده مشتری، لید یا استعلام پیامک بفرستید و متن، زمان، فرستنده و وضعیت هر ارسال را در سابقه ارتباطات نگه دارید.</p>
                                <a class="service-link" href="{{ route('site.modules.show', ['module' => 'crm']) }}#crm-sms">مشاهده امکانات پیامکی CRM <svg viewBox="0 0 24 24" fill="none"><path d="M19 12H5m6 6-6-6 6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></a>
                            </article>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>

        <section class="section transport-modes" id="transport-modes">
            <div class="container">
                <div class="section-head transport-head reveal">
                    <span class="section-label">حالت‌های حمل</span>
                    <h2 class="section-title transport-title">یک پلتفرم، تمامی حالات حمل</h2>
                    <p class="section-subtitle">مدیریت سفر، کانتینر، پرواز، ULD، واگن، ناوگان زمینی و رویدادهای رهگیری — همگی در یک تجربه منسجم.</p>
                </div>
                <div class="transport-grid">
                    @foreach(config('site_transport_modes') as $modeSlug => $mode)
                        <article class="service-card transport-card reveal delay-{{ $loop->iteration }}">
                            <span class="service-icon transport-icon" aria-hidden="true">
                                @switch($modeSlug)
                                    @case('sea')
                                        <svg viewBox="0 0 24 24" fill="none"><path d="M4 12 6 7h12l2 5-3 6H7l-3-6Zm2 0 6-3 6 3M12 4v5M9 4h6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        @break
                                    @case('air')
                                        <svg viewBox="0 0 24 24" fill="none"><path d="m3 11 7.5 1.5L14 21l2-1-1-7 5-2.5a2.5 2.5 0 0 0 1.3-3.1 2.5 2.5 0 0 0-3.2-1.2L13 8.5 7 3 5 4l4 6-5.5-1L3 11Z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        @break
                                    @case('road')
                                        <svg viewBox="0 0 24 24" fill="none"><path d="M3 6h11v11H3V6Zm11 4h4l3 4v3h-7v-7ZM7 20a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm10 0a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        @break
                                    @case('rail')
                                        <svg viewBox="0 0 24 24" fill="none"><path d="M7 3h10a2 2 0 0 1 2 2v10a3 3 0 0 1-3 3H8a3 3 0 0 1-3-3V5a2 2 0 0 1 2-2Zm-2 7h14M8 21l2-3m6 0 2 3M8.5 14h.01m6.99 0h.01" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        @break
                                @endswitch
                            </span>
                            <h3>{{ $mode['name'] }}</h3>
                            <p>{{ $mode['card_summary'] }}</p>
                            <a class="service-link transport-link" href="{{ route('site.transport-modes.show', ['mode' => $modeSlug]) }}">مشاهده جزئیات {{ $mode['short_name'] }} <svg viewBox="0 0 24 24" fill="none"><path d="M19 12H5m6 6-6-6 6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></a>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="section section-soft" id="audiences">
            <div class="container">
                <div class="section-head reveal">
                    <span class="section-label">مخاطبان نرم‌افزار</span>
                    <h2 class="section-title">سپند برای چه کسب‌وکارهایی طراحی شده است؟</h2>
                    <p class="section-subtitle">سپند به‌عنوان نرم افزار شرکت های حمل و نقل، فورواردری و لجستیک برای سازمان‌هایی ساخته شده که بازاریابی، فروش، عملیات حمل، اسناد و مالی آن‌ها باید روی یک داده مشترک کار کنند.</p>
                </div>
                <div class="audience-grid">
                    <article class="audience-card reveal"><h3>شرکت‌های حمل‌ونقل بین‌المللی</h3><p>برای یکپارچه‌کردن پرونده‌های حمل، مشتریان، اسناد، هزینه‌ها و گزارش‌های مدیریتی.</p></article>
                    <article class="audience-card reveal"><h3>نرم افزار فورواردری برای شرکت‌های بین‌المللی</h3><p>سپند به‌عنوان نرم افزار مدیریت شرکت فورواردری، مشتریان، نرخ‌دهی و پرونده‌های حمل را به Booking، اسناد، عملیات و امور مالی مرتبط می‌کند.</p></article>
                    <article class="audience-card reveal"><h3>NVOCCها</h3><p>برای کنترل رزرو، ظرفیت، اسناد و ارتباط منظم میان نمایندگان و مشتریان.</p></article>
                    <article class="audience-card reveal"><h3>نمایندگان خطوط حمل</h3><p>برای ثبت ساختاریافته درخواست‌ها، پیگیری تعهدات و پاسخ‌گویی سریع‌تر به مشتری.</p></article>
                    <article class="audience-card reveal"><h3>نرم افزار لجستیک برای عملیات یکپارچه</h3><p>سپند به‌عنوان نرم افزار مدیریت شرکت لجستیک، دیدی یکپارچه از مشتریان، پرونده‌های حمل، عملیات، امور مالی و کیفیت اجرای خدمات فراهم می‌کند.</p></article>
                    <article class="audience-card reveal"><h3>تیم‌های فروش، عملیات و مالی</h3><p>برای کار روی یک پرونده مشترک با مسئولیت، مهلت و داده‌های قابل‌اعتماد.</p></article>
                </div>
            </div>
        </section>

        <section class="section" id="problems">
            <div class="container">
                <div class="section-head reveal">
                    <span class="section-label">از مسئله تا راهکار</span>
                    <h2 class="section-title">سپند چه مشکلاتی را حل می‌کند؟</h2>
                    <p class="section-subtitle">سپند تنها مجموعه‌ای از قابلیت‌ها نیست؛ هر چالش عملیاتی را با یک راهکار مشخص و قابل اجرا برطرف می‌کند.</p>
                </div>
                <div class="problem-grid">
                    <article class="problem-card reveal">
                        <div class="problem-card-head"><span class="problem-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="M4 7h6l2 2h8v10H4V7Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M8 13h8m-8 3h5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg></span><span class="problem-index">چالش ۰۱</span></div>
                        <h3>اطلاعات مشتریان و ارتباطات در Excel، واتساپ، پیامک و ایمیل پراکنده است.</h3>
                        <p><strong>راهکار سپند</strong><span>با پرونده یکپارچه مشتری، اطلاعات، مکاتبات، پیامک‌ها، اسناد و سوابق در یک محل متمرکز و قابل جست‌وجو نگهداری می‌شود.</span></p>
                    </article>
                    <article class="problem-card reveal">
                        <div class="problem-card-head"><span class="problem-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><circle cx="9" cy="8" r="3" stroke="currentColor" stroke-width="1.7"/><path d="M3.5 19a5.5 5.5 0 0 1 11 0M17 5v5l3 2m-3-7a5 5 0 1 1-2.2 9.5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg></span><span class="problem-index">چالش ۰۲</span></div>
                        <h3>پیگیری مشتریان فراموش می‌شود یا بین همکاران گم می‌شود.</h3>
                        <p><strong>راهکار سپند</strong><span>سیستم CRM با یادآوری هوشمند، وظایف زمان‌بندی‌شده، تعیین مسئول و ارسال پیامک از پرونده، هیچ فرصت فروشی را بدون اقدام رها نمی‌کند.</span></p>
                    </article>
                    <article class="problem-card reveal">
                        <div class="problem-card-head"><span class="problem-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="M3 12s3.5-6 9-6 9 6 9 6-3.5 6-9 6-9-6-9-6Z" stroke="currentColor" stroke-width="1.7"/><circle cx="12" cy="12" r="2.7" stroke="currentColor" stroke-width="1.7"/><path d="M18.5 5.5 20 4m-2 15 2 1.5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg></span><span class="problem-index">چالش ۰۳</span></div>
                        <h3>مشتری برای وضعیت استعلام، محموله و صورتحساب بارها تماس می‌گیرد.</h3>
                        <p><strong>راهکار سپند</strong><span>پرتال مشتریان با ورود OTP، وضعیت استعلام، رویدادهای مجاز رهگیری، صورتحساب‌ها و رسیدهای همان مشتری را در یک فضای اختصاصی نمایش می‌دهد.</span></p>
                    </article>
                    <article class="problem-card reveal">
                        <div class="problem-card-head"><span class="problem-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="M6 3h8l4 4v14H6V3Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M14 3v5h4m-9 5 2 2 4-4m-6 7h6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg></span><span class="problem-index">چالش ۰۴</span></div>
                        <h3>کنترل و صدور اسناد زمان‌بر و مستعد خطاست.</h3>
                        <p><strong>راهکار سپند</strong><span>سیستم مدیریت اسناد، نسخه‌های مختلف، وضعیت تأیید، مسئول بررسی و مهلت هر سند را به‌صورت متمرکز مدیریت می‌کند.</span></p>
                    </article>
                    <article class="problem-card reveal">
                        <div class="problem-card-head"><span class="problem-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="M4 20V5m0 15h16M8 16l3-4 3 2 5-7" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/><circle cx="18" cy="8" r="3" stroke="currentColor" stroke-width="1.5"/></svg></span><span class="problem-index">چالش ۰۵</span></div>
                        <h3>سود واقعی هر پرونده یا مشتری مشخص نیست.</h3>
                        <p><strong>راهکار سپند</strong><span>با اتصال درآمدها و هزینه‌ها به پرونده عملیاتی، سود و زیان هر حمل، هر مشتری و هر پروژه به‌صورت دقیق قابل‌مشاهده خواهد بود.</span></p>
                    </article>
                    <article class="problem-card reveal">
                        <div class="problem-card-head"><span class="problem-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><rect x="3" y="4" width="6" height="5" rx="1.5" stroke="currentColor" stroke-width="1.7"/><rect x="15" y="15" width="6" height="5" rx="1.5" stroke="currentColor" stroke-width="1.7"/><path d="M9 6.5h4a3 3 0 0 1 3 3V12M15 17.5h-4a3 3 0 0 1-3-3V12m5.5-2 2.5 2 2.5-2M10.5 14 8 12l-2.5 2" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg></span><span class="problem-index">چالش ۰۶</span></div>
                        <h3>انجام کارها به تجربه و حافظه افراد وابسته است.</h3>
                        <p><strong>راهکار سپند</strong><span>گردش کار هوشمند، مراحل انجام کار، مسئول هر مرحله و تاریخچه فعالیت‌ها را استاندارد می‌کند تا فرایندها مستقل از افراد اجرا شوند.</span></p>
                    </article>
                    <article class="problem-card reveal">
                        <div class="problem-card-head"><span class="problem-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="M4 20V4h16v16H4Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M8 16v-3m4 3V8m4 8v-5M7 7h4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg></span><span class="problem-index">چالش ۰۷</span></div>
                        <h3>مشخص نیست کدام مشتری، نرخ یا تأمین‌کننده نیازمند اقدام است.</h3>
                        <p><strong>راهکار سپند</strong><span>تحلیل سودآوری مشتری، مقایسه تأمین‌کنندگان و هشدار نرخ‌های رو به انقضا، اولویت واقعی تیم فروش را روی داشبورد مشخص می‌کنند.</span></p>
                    </article>
                </div>
            </div>
        </section>

        <section class="section section-soft" id="about">
            <div class="container about-grid">
                <div class="about-visual reveal">
                    <div class="about-panel">
                        <div class="about-content-card">
                            <span class="about-logo"><img src="{{ asset('assets/images/brand/sepand-provided-header.png') }}" alt=""></span>
                            <p class="about-quote">بازاریابی، فروش، عملیات، مالی و پرتال مشتری روی یک پرونده مشترک کار می‌کنند؛ هر داده یک‌بار ثبت می‌شود و در مرحله بعدی قابل‌استفاده است.</p>
                            <div class="about-meta">کاربرد واقعی نرم‌افزار سپند</div>
                        </div>
                    </div>
                    <div class="about-badge"><strong>یک پرونده واحد</strong><span>از سرنخ فروش تا تسویه مالی</span><div class="about-badge-line"><i></i><i></i><i></i></div></div>
                </div>
                <div class="about-copy reveal delay-2">
                    <span class="section-label">کاربرد واقعی محصول</span>
                    <h2 class="section-title">از اولین درخواست مشتری تا<br><span>عملیات، اسناد و سود پرونده</span></h2>
                    <p>کاربر فروش لید یا مشتری را ثبت می‌کند، پیامک‌ها و اقدامات بعدی را در همان پرونده نگه می‌دارد و درخواست نرخ را پیگیری می‌کند؛ پس از تأیید، همان اطلاعات وارد Booking و پرونده عملیات می‌شود. تیم اسناد و مالی نیز بدون ساخت پرونده جداگانه، وظایف و اطلاعات مرتبط را تکمیل می‌کنند و مدیر وضعیت کل جریان را در گزارش‌ها می‌بیند.</p>
                    <div class="about-list">
                        <div class="about-list-item"><span><svg viewBox="0 0 24 24" fill="none"><path d="m5 12 4 4L19 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></span>تبدیل پیشنهاد فروش به پرونده حمل</div>
                        <div class="about-list-item"><span><svg viewBox="0 0 24 24" fill="none"><path d="m5 12 4 4L19 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></span>اتصال اسناد به Booking و عملیات</div>
                        <div class="about-list-item"><span><svg viewBox="0 0 24 24" fill="none"><path d="m5 12 4 4L19 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></span>محاسبه سود بر پایه هزینه واقعی</div>
                        <div class="about-list-item"><span><svg viewBox="0 0 24 24" fill="none"><path d="m5 12 4 4L19 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></span>ورود OTP و رهگیری کنترل‌شده مشتری</div>
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
                    <article class="why-card reveal delay-3"><span class="why-num">۰۳</span><span class="why-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M4 5h16v14H4V5Zm4 4h8m-8 4h8" stroke="currentColor" stroke-width="1.7"/></svg></span><h3>سود و ارزش هر مشتری</h3><p>درآمد تأییدشده، هزینه پرداخت‌شده، سود خالص و سود متوسط هر کار، مشتریان واقعاً ارزشمند را مشخص می‌کنند.</p></article>
                    <article class="why-card reveal delay-4"><span class="why-num">۰۴</span><span class="why-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M5 6h14M7 11h10M9 16h6M12 3v16" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg></span><h3>مقایسه تأمین‌کنندگان</h3><p>نرخ خرید در کنار زمان حمل، اعتبار، Free Time، تأخیر، پاسخ‌گویی و شرایط پرداخت سنجیده می‌شود.</p></article>
                    <article class="why-card reveal delay-1"><span class="why-num">۰۵</span><span class="why-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M12 8v5m0 4h.01M4 20h16L12 4 4 20Z" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg></span><h3>هشدار پیش از انقضا</h3><p>نرخ‌های معتبر تا ۷ روز آینده با شدت هشدار مشخص می‌شوند تا تیم پیش از پایان اعتبار برای تمدید یا دریافت نرخ جدید اقدام کند.</p></article>
                    <article class="why-card reveal delay-2"><span class="why-num">۰۶</span><span class="why-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M5 19V5h14v14H5Zm3-4 3-3 2 2 3-4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg></span><h3>گزارش بدون تجمیع دستی</h3><p>پیش‌فاکتورهای ۴۸ ساعته و پرونده‌های نیازمند پیگیری، با رعایت سطح دسترسی و نام ایجادکننده در دسترس‌اند.</p></article>
                </div>
            </div>
        </section>

        <section class="section" id="process">
            <div class="container">
                <div class="section-head reveal">
                    <span class="section-label">گردش کار هوشمند محصول</span>
                    <h2 class="section-title">فرایند واقعی کار با<br><span>نرم‌افزار سپند</span></h2>
                    <p class="section-subtitle">اطلاعات در طول فرایند حمل تکمیل می‌شوند و بدون ساخت پرونده‌های جداگانه، میان تیم‌ها جریان پیدا می‌کنند.</p>
                </div>
                <div class="process-grid">
                    <article class="process-item reveal delay-1"><span class="process-num">۱</span><h3>CRM، بازاریابی و درخواست مشتری</h3><p>لید، مشتری، نیاز حمل، پیامک‌ها، تعاملات و اقدام بعدی در پرونده CRM ثبت می‌شود.</p></article>
                    <article class="process-item reveal delay-2"><span class="process-num">۲</span><h3>نرخ‌دهی و پیشنهاد فروش</h3><p>هزینه، قیمت فروش، اعتبار نرخ و حاشیه سود پیشنهادی کنترل می‌شود.</p></article>
                    <article class="process-item reveal delay-3"><span class="process-num">۳</span><h3>رزرو و Booking</h3><p>پیشنهاد تأییدشده با همان داده‌ها به رزرو و پرونده حمل تبدیل می‌شود.</p></article>
                    <article class="process-item reveal delay-1"><span class="process-num">۴</span><h3>اجرای عملیات حمل</h3><p>رویدادها، مسئولیت‌ها، مهلت‌ها و وضعیت محموله مرحله‌به‌مرحله ثبت می‌شوند.</p></article>
                    <article class="process-item reveal delay-2"><span class="process-num">۵</span><h3>پرتال مشتری و رهگیری</h3><p>مشتری با OTP وارد می‌شود و استعلام، محموله، رویدادهای مجاز و اطلاعات مالی خود را می‌بیند.</p></article>
                    <article class="process-item reveal delay-3"><span class="process-num">۶</span><h3>مالی، سود و گزارش</h3><p>دریافت، پرداخت و سود پرونده برای گزارش مدیریتی نهایی تکمیل می‌شود.</p></article>
                </div>
            </div>
        </section>

        <section class="cta-wrap" id="contact">
            <div class="container">
                <div class="cta reveal">
                    <div class="cta-copy"><h2>فرایند واقعی شرکت خود را در سپند ببینید</h2><p>در یک جلسه دمو، سناریوی CRM، فروش، عملیات، مالی و تجربه پرتال مشتریان شما را روی نرم‌افزار بررسی می‌کنیم.</p></div>
                    <div class="cta-actions"><a class="btn" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="home_bottom_consultation">درخواست دمو و مشاوره <svg viewBox="0 0 24 24" fill="none"><path d="M19 12H5m6 6-6-6 6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></a></div>
                </div>
            </div>
        </section>
    </main>

    <footer class="site-footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand"><a href="{{ route('home') }}"><img src="{{ asset('assets/images/brand/sepand-provided-header.png') }}" alt="سپند"></a><p>سپند، نرم‌افزار یکپارچه CRM، فروش، عملیات، مالی و پرتال مشتریان برای شرکت‌های فورواردری، لجستیک و حمل‌ونقل بین‌المللی.</p></div>
                <div class="footer-col"><h3>دسترسی سریع</h3><a href="{{ route('modules') }}">ماژول‌ها</a><a href="{{ route('compare.index') }}">مرکز مقایسه نرم‌افزارها</a><a href="{{ route('pricing') }}">تعرفه‌ها</a><a href="{{ route('faq') }}">سؤالات متداول</a><a href="{{ route('about') }}">درباره ما</a></div>
                <div class="footer-col"><h3>راهکارها</h3><a href="{{ route('site.modules.show', ['module' => 'crm']) }}">CRM حمل‌ونقل</a><a href="{{ route('site.modules.show', ['module' => 'customer-portal-tracking']) }}">پرتال مشتریان و رهگیری</a><a href="{{ route('site.modules.show', ['module' => 'transport-operations']) }}">مدیریت عملیات</a><a href="{{ route('site.modules.show', ['module' => 'finance-accounting']) }}">مالی و سود پرونده</a></div>
                <div class="footer-col"><h3>ارتباط با ما</h3><a class="footer-contact" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="footer_consultation"><svg viewBox="0 0 24 24" fill="none"><path d="M4 5h16v14H4V5Zm0 1 8 7 8-7" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>درخواست دمو و مشاوره</a><a class="footer-contact" href="{{ route('login') }}"><svg viewBox="0 0 24 24" fill="none"><path d="M4 13a8 8 0 0 1 16 0v5a2 2 0 0 1-2 2h-2v-7h4M4 13v7H2a2 2 0 0 1-2-2v-5h4Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>ورود مشتریان</a></div>
            </div>
            <div class="footer-bottom"><span>© {{ date('Y') }} سپند؛ تمامی حقوق محفوظ است.</span><span class="footer-status"><i></i>سامانه‌های سپند فعال هستند</span></div>
        </div>
    </footer>

    @include('layouts.partials.floating-consultation-cta')

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

            const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

            const heroShowcase = document.querySelector('[data-hero-device-showcase]');
            if (heroShowcase) {
                const desktopSlides = Array.from(heroShowcase.querySelectorAll('[data-desktop-slide]'));
                const mobileSlides = Array.from(heroShowcase.querySelectorAll('[data-mobile-slide]'));
                const slideCount = Math.min(desktopSlides.length, mobileSlides.length);
                const autoplayDelay = Number.parseInt(heroShowcase.dataset.autoplay || '5200', 10);
                let currentIndex = 0;
                let timer = null;
                let isVisible = !('IntersectionObserver' in window);

                const render = index => {
                    currentIndex = (index + slideCount) % slideCount;
                    [desktopSlides, mobileSlides].forEach(slides => {
                        slides.forEach((slide, slideIndex) => {
                            const isActive = slideIndex === currentIndex;
                            slide.classList.toggle('is-active', isActive);
                            slide.setAttribute('aria-hidden', String(!isActive));
                        });
                    });
                };

                const stop = () => {
                    window.clearInterval(timer);
                    timer = null;
                };

                const start = () => {
                    stop();
                    if (reduceMotion || !isVisible || document.hidden || slideCount < 2) return;
                    timer = window.setInterval(() => render(currentIndex + 1), autoplayDelay);
                };

                document.addEventListener('visibilitychange', () => document.hidden ? stop() : start());
                render(0);

                if ('IntersectionObserver' in window) {
                    const showcaseObserver = new IntersectionObserver(entries => {
                        isVisible = entries[0].isIntersecting;
                        isVisible ? start() : stop();
                    }, { threshold: .2 });
                    showcaseObserver.observe(heroShowcase);
                } else {
                    start();
                }
            }

        })();
    </script>
</body>
</html>
