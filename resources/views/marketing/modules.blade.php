@extends('layouts.marketing')

@php
    $title = 'ماژول‌های سپند | یک پلتفرم، تمام فرایندها';
    $description = 'ماژول‌های یکپارچه سپند برای مدیریت مشتریان، عملیات حمل، مالی، گردش کار و ارتباطات سازمانی.';
@endphp

@section('content')
<section class="page-hero">
    <div class="container hero-inner">
        <div class="hero-copy reveal">
            <div class="breadcrumb"><a href="{{ route('home') }}">صفحه اصلی</a><svg viewBox="0 0 24 24" fill="none"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg><span>ماژول‌ها</span></div>
            <h1>هر فرایند، یک ماژول؛<br><span>همه در یک پلتفرم</span></h1>
            <p>از اولین ارتباط با مشتری تا آخرین مرحله تحویل و تسویه، ماژول‌های سپند کنار هم یک جریان کاری منسجم، شفاف و قابل‌اندازه‌گیری می‌سازند.</p>
            <div class="hero-actions"><a class="btn btn-primary" href="#all-modules">مشاهده ماژول‌ها <svg viewBox="0 0 24 24" fill="none"><path d="m8 10 4 4 4-4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></a><a class="btn btn-outline" href="{{ route('pricing') }}">مشاهده تعرفه‌ها</a></div>
        </div>
        <div class="hero-art reveal">
            <div class="art-panel"><div class="art-content"><div class="art-head"><span class="art-mark"><svg viewBox="0 0 24 24" fill="none"><path d="M4 4h6v6H4V4Zm10 0h6v6h-6V4ZM4 14h6v6H4v-6Zm10 0h6v6h-6v-6Z" stroke="currentColor" stroke-width="1.6"/></svg></span><span class="art-chip">اکوسیستم یکپارچه</span></div><h2 class="art-title">مرکز فرمان کسب‌وکار شما</h2><p class="art-desc">داده‌های هماهنگ، فرایندهای متصل و دید مدیریتی کامل</p><div class="art-bars"><i></i><i></i><i></i><i></i><i></i><i></i></div></div></div>
        </div>
    </div>
</section>

<section class="section" id="all-modules">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">ماژول‌های اصلی</span><h2 class="section-title">ابزارهایی که همراه با<br><span>رشد شما توسعه پیدا می‌کنند</span></h2><p class="section-sub">هر ماژول به‌تنهایی کاربردی است و در کنار سایر بخش‌ها، تصویری کامل از کسب‌وکار شما می‌سازد.</p></div>
        <div class="card-grid">
            @foreach(config('site_modules') as $slug => $module)
                <article class="content-card reveal">
                    <span class="card-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M4 5h16v14H4V5Zm4 4h8m-8 4h8m-8 4h5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg></span>
                    <h3>{{ $module['name'] }}</h3>
                    <p>{{ $module['summary'] }}</p>
                    <ul class="feature-list">@foreach($module['benefits'] as $benefit)<li>{{ $benefit }}</li>@endforeach</ul>
                    <a class="tag" href="{{ route('site.modules.show', ['module' => $slug]) }}" aria-label="مشاهده جزئیات ماژول {{ $module['name'] }}">مشاهده ماژول {{ $module['short_name'] }}</a>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="section soft">
    <div class="container split">
        <div class="split-copy reveal"><span class="section-label">یکپارچگی واقعی</span><h2 class="section-title">داده فقط یک‌بار ثبت می‌شود؛<br><span>همه‌جا در دسترس است</span></h2><p>ماژول‌های سپند جزیره‌های جدا از هم نیستند. هر تغییر در پرونده مشتری، عملیات، وظایف و امور مالی به‌صورت ساختاریافته در کل سامانه جریان پیدا می‌کند.</p><div class="check-grid"><span class="check"><i>✓</i>کاهش ورود اطلاعات تکراری</span><span class="check"><i>✓</i>گزارش‌های مدیریتی دقیق</span><span class="check"><i>✓</i>تاریخچه کامل فعالیت‌ها</span><span class="check"><i>✓</i>سطوح دسترسی منعطف</span></div></div>
        <div class="visual-box reveal"><span class="section-label">نتیجه یکپارچگی</span><h2 style="margin:12px 0 30px;font-size:28px;line-height:1.7">یک منبع قابل‌اعتماد<br>برای تمام تصمیم‌ها</h2><div class="feature-list"><li style="color:#fff">دید کامل بر عملکرد تیم‌ها</li><li style="color:#fff">کاهش خطا و دوباره‌کاری</li><li style="color:#fff">پاسخ‌گویی سریع‌تر به مشتری</li><li style="color:#fff">آمادگی برای رشد سازمان</li></div></div>
    </div>
</section>

<section class="cta-wrap"><div class="container"><div class="cta reveal"><div class="cta-copy"><h2>ماژول مناسب کسب‌وکار شما کدام است؟</h2><p>نیازهای فعلی را بررسی می‌کنیم و ترکیب مناسبی از ماژول‌ها پیشنهاد می‌دهیم.</p></div><div class="cta-action"><a class="btn" href="{{ route('pricing') }}">انتخاب پلن مناسب</a></div></div></div></section>
@endsection
