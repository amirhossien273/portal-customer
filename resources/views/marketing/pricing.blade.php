@extends('layouts.marketing')

@php
    $title = 'تعرفه‌های سپند | پلن مناسب کسب‌وکار شما';
    $description = 'پلن‌های منعطف سپند برای تیم‌های در حال رشد، شرکت‌های حرفه‌ای و سازمان‌های بزرگ.';
@endphp

@section('content')
<section class="page-hero">
    <div class="container hero-inner">
        <div class="hero-copy reveal"><div class="breadcrumb"><a href="{{ route('home') }}">صفحه اصلی</a><svg viewBox="0 0 24 24" fill="none"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg><span>تعرفه‌ها</span></div><h1>تعرفه‌ای متناسب با<br><span>اندازه و مسیر رشد شما</span></h1><p>از یک تیم کوچک تا یک سازمان چندواحدی، ساختار تعرفه سپند بر اساس ماژول‌ها، تعداد کاربران و سطح خدمات موردنیاز شما تنظیم می‌شود.</p><div class="hero-actions"><a class="btn btn-primary" href="#plans">مقایسه پلن‌ها</a><a class="btn btn-outline" href="{{ route('modules') }}">مشاهده ماژول‌ها</a></div></div>
        <div class="hero-art reveal"><div class="art-panel"><div class="art-content"><div class="art-head"><span class="art-mark"><svg viewBox="0 0 24 24" fill="none"><path d="M4 7h16v12H4V7Zm3-3h10v3H7V4Zm2 8h6m-3-3v6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg></span><span class="art-chip">تعرفه منعطف</span></div><h2 class="art-title">فقط برای آنچه نیاز دارید</h2><p class="art-desc">ترکیب ماژول و خدمات بر اساس ساختار واقعی سازمان شما</p><div class="art-bars"><i></i><i></i><i></i><i></i><i></i><i></i></div></div></div></div>
    </div>
</section>

<section class="section" id="plans">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">پلن‌های سپند</span><h2 class="section-title">ساده شروع کنید؛<br><span>بدون محدودیت رشد کنید</span></h2><p class="section-sub">مبلغ نهایی پس از شناخت تعداد کاربران، ماژول‌های منتخب و نیازهای استقرار اعلام می‌شود.</p></div>
        <div class="pricing-grid">
            <article class="price-card reveal"><span class="price-name">برای شروع منظم</span><h3>پایه</h3><p>برای تیم‌هایی که می‌خواهند مشتریان و فعالیت‌های روزانه را ساختاریافته مدیریت کنند.</p><div class="price">استعلام تعرفه<small>بر اساس کاربران و ماژول‌ها</small></div><ul class="feature-list"><li>مدیریت مشتریان و سرنخ‌ها</li><li>وظایف و تقویم کاری</li><li>یادداشت و فایل‌ها</li><li>گزارش‌های پایه</li><li>پشتیبانی استاندارد</li></ul><a class="btn btn-outline" href="{{ route('home') }}#contact">درخواست مشاوره</a></article>
            <article class="price-card featured reveal"><span class="popular">پیشنهاد سپند</span><span class="price-name">برای عملیات حرفه‌ای</span><h3>حرفه‌ای</h3><p>برای شرکت‌هایی که به مدیریت یکپارچه مشتری، حمل، عملیات و امور مالی نیاز دارند.</p><div class="price">استعلام تعرفه<small>طراحی‌شده برای فرایند شما</small></div><ul class="feature-list"><li>تمام امکانات پلن پایه</li><li>رزرو و مدیریت حمل</li><li>عملیات و رهگیری محموله</li><li>گردش کار پیشرفته</li><li>مالی، فاکتور و پرداخت</li><li>پشتیبانی اولویت‌دار</li></ul><a class="btn" href="{{ route('home') }}#contact">انتخاب پلن حرفه‌ای</a></article>
            <article class="price-card reveal"><span class="price-name">برای مقیاس سازمانی</span><h3>سازمانی</h3><p>برای ساختارهای چندتیمی که به سفارشی‌سازی، کنترل دسترسی و استقرار اختصاصی نیاز دارند.</p><div class="price">تعرفه اختصاصی<small>متناسب با معماری سازمان</small></div><ul class="feature-list"><li>تمام ماژول‌های موردنیاز</li><li>کاربران و تیم‌های متعدد</li><li>سطوح دسترسی سفارشی</li><li>گزارش‌ها و فرایندهای اختصاصی</li><li>همراهی در استقرار</li><li>پشتیبانی سازمانی</li></ul><a class="btn btn-outline" href="{{ route('home') }}#contact">گفت‌وگو با کارشناسان</a></article>
        </div>
    </div>
</section>

<section class="section soft">
    <div class="container"><div class="section-head reveal"><span class="section-label">شفافیت در انتخاب</span><h2 class="section-title">چه عواملی تعرفه را<br><span>مشخص می‌کنند؟</span></h2></div><div class="card-grid"><article class="content-card reveal"><span class="card-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M16 20v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M9 10a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm8-2h5m-2.5-2.5v5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg></span><h3>تعداد کاربران</h3><p>تعداد اعضای فعال و تیم‌هایی که در فرایندهای روزانه از سپند استفاده می‌کنند.</p></article><article class="content-card reveal"><span class="card-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M4 4h6v6H4V4Zm10 0h6v6h-6V4ZM4 14h6v6H4v-6Zm10 0h6v6h-6v-6Z" stroke="currentColor" stroke-width="1.6"/></svg></span><h3>ترکیب ماژول‌ها</h3><p>ماژول‌هایی که بر اساس نیاز واقعی کسب‌وکار و مراحل عملیاتی شما فعال می‌شوند.</p></article><article class="content-card reveal"><span class="card-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M12 3a9 9 0 1 0 9 9M12 7v5l3 2M17 3h4v4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg></span><h3>استقرار و پشتیبانی</h3><p>سطح آموزش، مهاجرت داده، سفارشی‌سازی و همراهی موردنیاز تیم شما.</p></article></div></div>
</section>

<section class="section"><div class="container"><div class="section-head reveal"><span class="section-label">سؤالات متداول</span><h2 class="section-title">پیش از انتخاب پلن</h2></div><div class="faq reveal"><details><summary>آیا می‌توانیم فقط ماژول‌های موردنیاز را انتخاب کنیم؟</summary><p>بله. ساختار سپند ماژولار است و ترکیب نهایی بر اساس فرایندهای فعلی و برنامه رشد شما پیشنهاد می‌شود.</p></details><details><summary>امکان ارتقای پلن در آینده وجود دارد؟</summary><p>بله. با رشد تیم یا اضافه‌شدن فرایندهای جدید می‌توانید کاربران و ماژول‌های بیشتری فعال کنید.</p></details><details><summary>آموزش و راه‌اندازی چگونه انجام می‌شود؟</summary><p>پس از تحلیل نیاز، برنامه استقرار و آموزش متناسب با نقش‌های تیم شما طراحی و اجرا می‌شود.</p></details><details><summary>آیا سفارشی‌سازی فرایندها امکان‌پذیر است؟</summary><p>در پلن‌های حرفه‌ای و سازمانی، سطح سفارشی‌سازی پس از بررسی دقیق نیازهای عملیاتی تعیین می‌شود.</p></details></div></div></section>

<section class="cta-wrap"><div class="container"><div class="cta reveal"><div class="cta-copy"><h2>برای دریافت پیشنهاد دقیق آماده‌اید؟</h2><p>چند دقیقه درباره ساختار تیم و فرایندها صحبت کنیم تا پلن مناسب شما مشخص شود.</p></div><div class="cta-action"><a class="btn" href="{{ route('home') }}#contact">درخواست برآورد تعرفه</a></div></div></div></section>
@endsection
