<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    @include('layouts.partials.google-analytics')
    @php
        $pageTitle = $title ?? 'نرم‌افزار CRM و مدیریت عملیات حمل‌ونقل | سپند';
        $pageDescription = $description ?? 'سپند؛ نرم‌افزار یکپارچه CRM، فروش، عملیات، اسناد و مالی برای شرکت‌های حمل‌ونقل، فورواردری و لجستیک.';
        $canonicalUrl = $canonical ?? url()->current();
    @endphp
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#0f305b">
    <meta name="robots" content="index,follow,max-image-preview:large">
    <meta name="googlebot" content="index,follow,max-image-preview:large,max-snippet:-1,max-video-preview:-1">
    <meta name="description" content="{{ $pageDescription }}">
    <meta property="og:locale" content="fa_IR">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $pageDescription }}">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:site_name" content="سپند">
    <meta property="og:image" content="{{ asset('assets/images/marketing/sepand-cargo-details.webp') }}">
    <meta property="og:image:alt" content="نرم‌افزار CRM و مدیریت عملیات حمل‌ونقل سپند">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $pageTitle }}">
    <meta name="twitter:description" content="{{ $pageDescription }}">
    <meta name="twitter:image" content="{{ asset('assets/images/marketing/sepand-cargo-details.webp') }}">
    <link rel="canonical" href="{{ $canonicalUrl }}">
    <title>{{ $pageTitle }}</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon.png') }}?v=20260801">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=20260801">
    @stack('head')
    <script>document.documentElement.classList.add('js');</script>
    <link rel="stylesheet" href="{{ asset('assets/css/marketing.css') }}?v=20260805-1">
    @stack('styles')
</head>
<body>
<a class="skip" href="#main-content">رفتن به محتوای اصلی</a>
<header class="site-header">
    <div class="container nav-wrap">
        <a class="brand" href="{{ route('home') }}" aria-label="سپند، صفحه اصلی">
            <img src="{{ asset('assets/images/brand/sepand-provided-header.png') }}" alt="" aria-hidden="true">
            <span class="brand-copy" aria-hidden="true"><strong>سپند</strong><small>CRM هوشمند حمل‌ونقل</small></span>
        </a>
        <nav class="main-nav" id="main-nav" aria-label="منوی اصلی">
            <a href="{{ route('modules') }}" @class(['active' => request()->routeIs('modules', 'site.modules.show', 'site.transport-modes.show')])>ماژول‌ها</a>
            <a href="{{ route('pricing') }}" @class(['active' => request()->routeIs('pricing')])>تعرفه‌ها</a>
            <a href="{{ route('about') }}" @class(['active' => request()->routeIs('about')])>درباره ما</a>
            <a href="{{ route('faq') }}" @class(['active' => request()->routeIs('faq')])>سؤالات متداول</a>
            <a href="{{ route('home') }}#why-us">چرا سپند؟</a>
            <div class="portal-actions mobile-portals">
                <a class="portal-link tracking" href="{{ route('tracking') }}" data-ga-event="portal_click" data-ga-label="mobile_tracking"><span class="new-badge">جدید</span>رهگیری محموله</a>
                <a class="portal-link" href="{{ route('login') }}">پورتال مشتریان</a>
                <a class="portal-link primary" href="{{ route('organization.portal') }}" data-ga-event="portal_click" data-ga-label="mobile_organization_portal">پرتال سازمان</a>
            </div>
        </nav>
        <div class="portal-actions desktop-portals">
            <a class="portal-link tracking" href="{{ route('tracking') }}" data-ga-event="portal_click" data-ga-label="desktop_tracking"><span class="new-badge">جدید</span>رهگیری محموله</a>
            <a class="portal-link" href="{{ route('login') }}">پورتال مشتریان</a>
            <a class="portal-link primary" href="{{ route('organization.portal') }}" data-ga-event="portal_click" data-ga-label="desktop_organization_portal">پرتال سازمان</a>
        </div>
        <button class="menu-toggle" id="menu-toggle" type="button" aria-expanded="false" aria-controls="main-nav" aria-label="باز کردن منو"><svg viewBox="0 0 24 24" fill="none"><path d="M4 7h16M4 12h16M4 17h16" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></button>
    </div>
</header>
<main id="main-content">@yield('content')</main>
<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-brand"><a href="{{ route('home') }}"><img src="{{ asset('assets/images/brand/sepand-provided-header.png') }}" alt="سپند"></a><p>نرم‌افزار یکپارچه سپند برای مدیریت CRM، فروش، عملیات حمل، اسناد و مالی شرکت‌های فورواردری و لجستیک.</p></div>
            <div class="footer-col"><h3>محصول</h3><a href="{{ route('modules') }}">ماژول‌های نرم‌افزار</a><a href="{{ route('pricing') }}">تعرفه‌ها</a><a href="{{ route('site.modules.show', ['module' => 'transport-operations']) }}">عملیات حمل</a></div>
            <div class="footer-col"><h3>سپند</h3><a href="{{ route('about') }}">درباره ما</a><a href="{{ route('faq') }}">سؤالات متداول نرم‌افزار</a><a href="{{ route('home') }}#why-us">مزیت‌های قابل سنجش</a><a href="{{ route('home') }}#process">گردش کار هوشمند محصول</a></div>
            <div class="footer-col"><h3>شروع همکاری</h3><a href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="footer_consultation">درخواست دمو و مشاوره</a><a href="{{ route('login') }}">پورتال مشتریان</a><a href="{{ route('organization.portal') }}">پرتال سازمان</a></div>
        </div>
        <div class="footer-bottom"><span>© {{ date('Y') }} سپند؛ تمامی حقوق محفوظ است.</span><span>طراحی‌شده برای تجربه‌ای شفاف‌تر</span></div>
    </div>
</footer>
<script>
(()=>{const menu=document.getElementById('main-nav'),toggle=document.getElementById('menu-toggle');toggle.addEventListener('click',()=>{const open=menu.classList.toggle('open');toggle.setAttribute('aria-expanded',String(open));document.body.classList.toggle('menu-open',open)});menu.querySelectorAll('a').forEach(a=>a.addEventListener('click',()=>{menu.classList.remove('open');toggle.setAttribute('aria-expanded','false');document.body.classList.remove('menu-open')}));const track=(eventName,eventLabel,url)=>{const payload={event_category:'marketing',event_label:eventLabel,link_url:url||window.location.href};if(typeof window.gtag==='function')window.gtag('event',eventName,payload);else{window.dataLayer=window.dataLayer||[];window.dataLayer.push({event:eventName,...payload})}};document.addEventListener('click',event=>{const link=event.target.closest('[data-ga-event]');if(link)track(link.dataset.gaEvent,link.dataset.gaLabel||link.textContent.trim(),link.href)});document.querySelectorAll('[data-ga-form]').forEach(form=>form.addEventListener('submit',()=>track(form.dataset.gaForm,'consultation_form_submit',form.action)));const items=document.querySelectorAll('.reveal');if('IntersectionObserver'in window){const observer=new IntersectionObserver(entries=>entries.forEach(entry=>{if(entry.isIntersecting){entry.target.classList.add('visible');observer.unobserve(entry.target)}}),{threshold:.1});items.forEach(item=>observer.observe(item))}else items.forEach(item=>item.classList.add('visible'))})();
</script>
@stack('scripts')
</body>
</html>
