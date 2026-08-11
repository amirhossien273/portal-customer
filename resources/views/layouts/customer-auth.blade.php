<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    @include('layouts.partials.google-analytics')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#102f52">
    <meta name="robots" content="noindex,nofollow,noarchive">
    <meta name="description" content="ورود امن مشتریان به پورتال سپند">
    <title>@yield('title', 'ورود به پورتال مشتریان') | سپند</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon.png') }}?v=20260811">
    <link rel="stylesheet" href="{{ asset('assets/customer-portal/auth.css') }}?v=20260811">
</head>
<body>
<main class="auth-page">
    <section class="auth-main">
        <header class="auth-topbar">
            <a class="auth-brand" href="{{ route('home') }}" aria-label="سپند، صفحه اصلی">
                <img src="{{ asset('assets/images/brand/sepand-provided-header.png') }}" alt="سپند">
                <span><strong>سپند</strong><small>پورتال هوشمند مشتریان</small></span>
            </a>
            <a class="home-link" href="{{ route('home') }}">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
                بازگشت به وب‌سایت
            </a>
        </header>

        <div class="auth-content">
            @yield('content')
        </div>

        <footer class="auth-support">
            <span class="support-icon">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 13a8 8 0 0 1 16 0v5a2 2 0 0 1-2 2h-2v-7h4M4 13v7H2a2 2 0 0 1-2-2v-5h4Z"/></svg>
            </span>
            <span>برای ورود به راهنمایی نیاز دارید؟</span>
            <a href="{{ route('home') }}#contact">ارتباط با پشتیبانی</a>
        </footer>
    </section>

    <aside class="auth-visual" aria-label="امکانات پورتال مشتریان سپند">
        <div class="visual-orbit orbit-one"></div>
        <div class="visual-orbit orbit-two"></div>
        <div class="visual-grid"></div>
        <div class="visual-content">
            <div class="visual-copy">
                <span class="eyebrow"><i></i>همراه محموله، از درخواست تا مقصد</span>
                <h2>همه‌چیز را <em>شفاف</em><br>دنبال کنید.</h2>
                <p>وضعیت استعلام‌ها، مسیر محموله و رویدادهای عملیاتی شما در یک نمای ساده و همیشه در دسترس.</p>
            </div>

            <div class="tracking-preview">
                <div class="preview-head">
                    <span class="preview-icon">
                        <svg viewBox="0 0 24 24"><path d="M3 7h11v10H3V7Zm11 3h4l3 3v4h-7v-7ZM7 20a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm10 0a2 2 0 1 0 0-4 2 2 0 0 0 0 0 4Z"/></svg>
                    </span>
                    <span><strong>محموله SP-1405-0182</strong><small>حمل دریایی · کانتینر 40HC</small></span>
                    <b><i></i>در حال حمل</b>
                </div>
                <div class="route-map">
                    <div class="route-line"><span></span></div>
                    <div class="route-points">
                        <span class="done"><i><svg viewBox="0 0 24 24"><path d="m7 12 3 3 7-7"/></svg></i><strong>شانگهای</strong><small>بارگیری</small></span>
                        <span class="active"><i><svg viewBox="0 0 24 24"><path d="M3 7h11v10H3V7Zm11 3h4l3 3v4h-7v-7Z"/></svg></i><strong>در مسیر</strong><small>اکنون</small></span>
                        <span><i><svg viewBox="0 0 24 24"><path d="M4 20V9l8-5 8 5v11M9 20v-6h6v6"/></svg></i><strong>بندرعباس</strong><small>مقصد</small></span>
                    </div>
                </div>
                <div class="preview-stats">
                    <span><small>آخرین به‌روزرسانی</small><strong>امروز، ۱۰:۴۵</strong></span>
                    <span><small>زمان تقریبی ورود</small><strong>۲۸ مرداد</strong></span>
                    <span><small>پیشرفت مسیر</small><strong>۶۸٪</strong></span>
                </div>
                <div class="preview-notice">
                    <span><svg viewBox="0 0 24 24"><path d="m7 12 3 3 7-7"/></svg></span>
                    <p><strong>رویداد تازه ثبت شد</strong><small>محموله از بندر مبدأ حرکت کرد.</small></p>
                </div>
            </div>

            <div class="visual-trust">
                <span><svg viewBox="0 0 24 24"><path d="M12 21s7-3 7-9V5l-7-2-7 2v7c0 6 7 9 7 9Z"/></svg>ورود امن و رمزنگاری‌شده</span>
                <span class="trust-dots"><i></i><i></i><i></i></span>
            </div>
        </div>
    </aside>
</main>
<script src="{{ asset('assets/customer-portal/auth.js') }}?v=20260811" defer></script>
@stack('scripts')
</body>
</html>
