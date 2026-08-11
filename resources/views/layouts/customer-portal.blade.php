<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#102f52">
    <meta name="robots" content="noindex,nofollow,noarchive">
    <title>@yield('title', 'پورتال مشتریان') | سپند</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon.png') }}?v=20260811">
    <link rel="stylesheet" href="{{ asset('assets/customer-portal/portal.css') }}?v=20260811">
</head>
<body>
@php
    $personName = $portalPersonal->full_name ?: 'مشتری سپند';
    $initials = mb_substr($portalPersonal->first_name ?: $portalPersonal->last_name ?: 'م', 0, 1);
@endphp
<div class="portal-shell">
    <aside class="portal-sidebar" id="portal-sidebar">
        <div class="sidebar-head">
            <a class="portal-brand" href="{{ route('portal.dashboard') }}">
                <img src="{{ asset('assets/images/brand/sepand-provided-header-dark.png') }}" alt="سپند">
                <span><strong>سپند</strong><small>پورتال مشتریان</small></span>
            </a>
            <button class="sidebar-close" type="button" data-sidebar-close aria-label="بستن منو"><x-portal.icon name="close" /></button>
        </div>

        <div class="sidebar-customer">
            <span class="customer-avatar">{{ $initials }}</span>
            <p><strong>{{ $personName }}</strong><small>{{ $portalCustomer->company ?: 'مشتری حقیقی سپند' }}</small></p>
            <span class="verified-mark" title="هویت تأییدشده"><x-portal.icon name="check" /></span>
        </div>

        <nav class="sidebar-nav" aria-label="منوی اصلی پورتال">
            <span class="nav-title">میز کار من</span>
            <a class="{{ request()->routeIs('portal.dashboard') ? 'is-active' : '' }}" href="{{ route('portal.dashboard') }}">
                <i><x-portal.icon name="dashboard" /></i><span>نمای کلی</span>
            </a>
            <a class="{{ request()->routeIs('portal.inquiries.*') ? 'is-active' : '' }}" href="{{ route('portal.inquiries.index') }}">
                <i><x-portal.icon name="inquiries" /></i><span>استعلام‌های من</span>
            </a>
            <a class="{{ request()->routeIs('portal.shipments.*') ? 'is-active' : '' }}" href="{{ route('portal.shipments.index') }}">
                <i><x-portal.icon name="shipments" /></i><span>محموله‌ها و رهگیری</span>
            </a>
            <a class="{{ request()->routeIs('portal.financials') ? 'is-active' : '' }}" href="{{ route('portal.financials') }}">
                <i><x-portal.icon name="financials" /></i><span>امور مالی</span>
            </a>
            <span class="nav-title nav-title-second">حساب کاربری</span>
            <a class="{{ request()->routeIs('portal.profile') ? 'is-active' : '' }}" href="{{ route('portal.profile') }}">
                <i><x-portal.icon name="profile" /></i><span>اطلاعات حساب</span>
            </a>
        </nav>

        <div class="sidebar-help">
            <span><x-portal.icon name="support" /></span>
            <p><strong>نیاز به راهنمایی دارید؟</strong><small>{{ config('customer_portal.support_hours') }}</small></p>
            <a href="tel:{{ preg_replace('/\D+/', '', \App\Support\MobileNumber::toEnglishDigits(config('customer_portal.support_phone'))) }}">{{ config('customer_portal.support_phone') }}</a>
        </div>

        <form class="sidebar-logout" method="POST" action="{{ route('portal.logout') }}">
            @csrf
            <button type="submit"><x-portal.icon name="logout" />خروج امن از حساب</button>
        </form>
    </aside>
    <button class="sidebar-overlay" type="button" data-sidebar-close aria-label="بستن منو"></button>

    <div class="portal-main">
        <header class="portal-header">
            <div class="header-title">
                <button class="sidebar-open" type="button" data-sidebar-open aria-label="باز کردن منو"><x-portal.icon name="menu" /></button>
                <div><span>@yield('eyebrow', 'پورتال مشتریان')</span><h1>@yield('page-title', 'نمای کلی')</h1></div>
            </div>
            <div class="header-actions">
                <span class="system-online"><i></i><b>سامانه آنلاین است</b></span>
                <a class="header-notification" href="{{ route('portal.shipments.index') }}" aria-label="رویدادهای محموله">
                    <x-portal.icon name="bell" /><i></i>
                </a>
                <a class="header-profile" href="{{ route('portal.profile') }}">
                    <span>{{ $initials }}</span>
                    <p><strong>{{ $personName }}</strong><small dir="ltr">{{ \App\Support\MobileNumber::mask($portalPersonal->mobile) }}</small></p>
                    <x-portal.icon name="chevron-left" />
                </a>
            </div>
        </header>

        <main class="portal-content">
            @if(session('success'))
                <div class="portal-toast" role="status" data-toast>
                    <span><x-portal.icon name="check" /></span><p>{{ session('success') }}</p>
                    <button type="button" data-toast-close aria-label="بستن"><x-portal.icon name="close" /></button>
                </div>
            @endif
            @yield('content')
        </main>

        <nav class="mobile-nav" aria-label="دسترسی سریع موبایل">
            <a class="{{ request()->routeIs('portal.dashboard') ? 'is-active' : '' }}" href="{{ route('portal.dashboard') }}"><x-portal.icon name="dashboard" /><span>خانه</span></a>
            <a class="{{ request()->routeIs('portal.inquiries.*') ? 'is-active' : '' }}" href="{{ route('portal.inquiries.index') }}"><x-portal.icon name="inquiries" /><span>استعلام‌ها</span></a>
            <a class="{{ request()->routeIs('portal.shipments.*') ? 'is-active' : '' }}" href="{{ route('portal.shipments.index') }}"><x-portal.icon name="shipments" /><span>رهگیری</span></a>
            <a class="{{ request()->routeIs('portal.profile') ? 'is-active' : '' }}" href="{{ route('portal.profile') }}"><x-portal.icon name="profile" /><span>حساب</span></a>
        </nav>
    </div>
</div>
<script src="{{ asset('assets/customer-portal/portal.js') }}?v=20260811" defer></script>
@stack('scripts')
</body>
</html>
