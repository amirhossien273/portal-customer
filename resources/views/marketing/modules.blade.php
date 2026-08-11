@extends('layouts.marketing')

@php
    $title = 'ماژول‌های نرم‌افزار حمل‌ونقل و لجستیک | سپند';
    $description = 'ماژول‌های نرم‌افزار حمل‌ونقل سپند؛ از CRM و تحلیل مشتری تا مقایسه تأمین‌کننده، هشدار نرخ، Booking، عملیات، مالی و پرتال مشتریان.';
    $canonical = route('modules');
    $moduleListItems = collect(config('site_modules'))
        ->map(static fn (array $module, string $slug): array => [
            '@type' => 'ListItem',
            'position' => 0,
            'name' => $module['name'],
            'url' => route('site.modules.show', ['module' => $slug]),
        ])
        ->values();
    $moduleListItems->splice(1, 0, [[
        '@type' => 'ListItem',
        'position' => 0,
        'name' => 'بازاریابی و پیامک',
        'url' => route('site.modules.show', ['module' => 'crm']).'#crm-sms',
    ]]);
    $moduleListItems = $moduleListItems
        ->map(static fn (array $item, int $index): array => [...$item, 'position' => $index + 1])
        ->all();
@endphp

@push('head')
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'CollectionPage',
            '@id' => route('modules').'#webpage',
            'name' => $title,
            'description' => $description,
            'url' => route('modules'),
            'inLanguage' => 'fa-IR',
            'isPartOf' => ['@id' => route('home').'#website'],
        ],
        [
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'صفحه اصلی', 'item' => route('home')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'ماژول‌های نرم‌افزار', 'item' => route('modules')],
            ],
        ],
        [
            '@type' => 'ItemList',
            'name' => 'ماژول‌های نرم‌افزار سپند',
            'numberOfItems' => count($moduleListItems),
            'itemListElement' => $moduleListItems,
        ],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endpush

@section('content')
<section class="page-hero">
    <div class="container hero-inner">
        <div class="hero-copy reveal">
            <div class="breadcrumb"><a href="{{ route('home') }}">صفحه اصلی</a><svg viewBox="0 0 24 24" fill="none"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg><span>ماژول‌ها</span></div>
            <h1>ماژول‌های یکپارچه سپند؛<br><span>از جذب مشتری تا تصمیم‌گیری و عملیات</span></h1>
            <p>در نرم‌افزار یکپارچه حمل‌ونقل سپند، CRM، تحلیل مشتری، نرخ‌دهی، مقایسه تأمین‌کننده، Booking، عملیات، اسناد، مالی و پرتال مشتریان روی داده مشترک کار می‌کنند؛ بنابراین تیم شما هم فرایند را اجرا می‌کند و هم تصمیم‌های فروش را با داده قابل‌اعتماد می‌گیرد.</p>
            <div class="hero-actions"><a class="btn btn-primary" href="#all-modules">مشاهده ماژول‌ها <svg viewBox="0 0 24 24" fill="none"><path d="m8 10 4 4 4-4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></a><a class="btn btn-outline" href="{{ route('pricing') }}">مشاهده تعرفه‌ها</a></div>
        </div>
        <div class="hero-art reveal">
            <div class="art-panel"><div class="art-content"><div class="art-head"><span class="art-mark"><svg viewBox="0 0 24 24" fill="none"><path d="M4 4h6v6H4V4Zm10 0h6v6h-6V4ZM4 14h6v6H4v-6Zm10 0h6v6h-6v-6Z" stroke="currentColor" stroke-width="1.6"/></svg></span><span class="art-chip">اکوسیستم یکپارچه</span></div><h2 class="art-title">مرکز فرمان کسب‌وکار شما</h2><p class="art-desc">داده‌های هماهنگ، فرایندهای متصل و دید مدیریتی کامل</p><div class="art-bars"><i></i><i></i><i></i><i></i><i></i><i></i></div></div></div>
        </div>
    </div>
</section>

<section class="section" id="all-modules">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">ماژول‌های اصلی</span><h2 class="section-title">ابزارهای تخصصی برای<br><span>فروش، عملیات و خدمات مشتری</span></h2><p class="section-sub">هر ماژول به‌تنهایی کاربردی است و در کنار سایر بخش‌ها، تصویری کامل از ارتباطات مشتری، عملیات، وضعیت مالی و تجربه سلف‌سرویس مشتریان می‌سازد.</p></div>
        <div class="card-grid">
            @foreach(config('site_modules') as $slug => $module)
                <article class="content-card reveal">
                    <span class="card-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M4 5h16v14H4V5Zm4 4h8m-8 4h8m-8 4h5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg></span>
                    <h3>{{ $module['name'] }}</h3>
                    <p>{{ $module['summary'] }}</p>
                    <ul class="feature-list">@foreach($module['benefits'] as $benefit)<li>{{ $benefit }}</li>@endforeach</ul>
                    <a class="tag" href="{{ route('site.modules.show', ['module' => $slug]) }}" aria-label="مشاهده جزئیات ماژول {{ $module['name'] }}">مشاهده ماژول {{ $module['short_name'] }}</a>
                </article>
                @if($slug === 'crm')
                    <article class="content-card reveal">
                        <span class="card-icon"><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 5h16v11H8l-4 4V5Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M8 9h8m-8 3h5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg></span>
                        <h3>بازاریابی و پیامک</h3>
                        <p>از پنل فراز اس‌ام‌اس یا مستقیماً از پرونده مشتری، لید و استعلام پیامک بفرستید و نتیجه هر ارسال را در تاریخچه ارتباطات نگه دارید.</p>
                        <ul class="feature-list"><li>ارسال پیامک از پرونده CRM</li><li>لاگ متمرکز و پیگیری وضعیت ارسال</li><li>تنظیمات مستقل پنل برای هر سازمان</li></ul>
                        <a class="tag" href="{{ route('site.modules.show', ['module' => 'crm']) }}#crm-sms" aria-label="مشاهده امکانات بازاریابی پیامکی سپند">مشاهده بازاریابی پیامکی</a>
                    </article>
                @endif
            @endforeach
        </div>
    </div>
</section>

<section class="section" id="management-insights" aria-labelledby="management-insights-title">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label">هوشمندی فروش و پیگیری</span>
            <h2 class="section-title" id="management-insights-title">گزارش‌هایی که فقط عدد نشان نمی‌دهند؛<br><span>اقدام بعدی را مشخص می‌کنند</span></h2>
            <p class="section-sub">قابلیت‌های تحلیلی جدید سپند به مدیر فروش کمک می‌کنند مشتری ارزشمند، تأمین‌کننده مناسب و پرونده‌ای را که نیازمند اقدام فوری است سریع‌تر تشخیص دهد.</p>
        </div>
        <div class="crm-capability-grid">
            <article class="crm-capability reveal">
                <span class="crm-capability-num">01</span>
                <h3>تحلیل درآمد و سود مشتریان</h3>
                <p>مشتریان بر پایه دریافت‌های تأییدشده، پرداخت‌های انجام‌شده، سود خالص و تعداد کار عملیاتی رتبه‌بندی می‌شوند؛ نه بر اساس حدس یا حجم تماس.</p>
                <a class="tag" href="{{ route('site.modules.show', ['module' => 'crm']) }}#crm-analytics">مشاهده تحلیل مشتریان</a>
            </article>
            <article class="crm-capability reveal">
                <span class="crm-capability-num">02</span>
                <h3>شناسایی مشتری پرکار یا کم‌حجمِ ارزشمند</h3>
                <p>دو نمای مکمل نشان می‌دهند کدام مشتری کار زیادی با سود متوسط پایین ایجاد می‌کند و کدام مشتری با حجم کمتر، سود بیشتری به ازای هر کار دارد.</p>
                <a class="tag" href="{{ route('site.modules.show', ['module' => 'crm']) }}#crm-analytics">بررسی فرمول‌ها</a>
            </article>
            <article class="crm-capability reveal">
                <span class="crm-capability-num">03</span>
                <h3>مقایسه چندمعیاره تأمین‌کنندگان</h3>
                <p>نرخ خرید، زمان حمل، مستقیم یا غیرمستقیم‌بودن مسیر، اعتبار نرخ، Free Time، سابقه تأخیر، کیفیت پاسخ و شرایط پرداخت کنار هم دیده می‌شوند.</p>
                <a class="tag" href="{{ route('site.modules.show', ['module' => 'pricing-sales']) }}#pricing-intelligence">مشاهده مقایسه تأمین‌کننده</a>
            </article>
            <article class="crm-capability reveal">
                <span class="crm-capability-num">04</span>
                <h3>هشدار نرخ و پیش‌فاکتور نیازمند اقدام</h3>
                <p>داشبورد نرخ‌های رو به انقضا را پیش از پایان اعتبار برجسته می‌کند و گزارش ۴۸ ساعته، پیش‌فاکتورهای متوقف‌شده را با نام ایجادکننده نمایش می‌دهد.</p>
                <a class="tag" href="{{ route('site.modules.show', ['module' => 'pricing-sales']) }}#pricing-intelligence">مشاهده هشدارهای فروش</a>
            </article>
        </div>
    </div>
</section>

<section class="section soft">
    <div class="container split">
        <div class="split-copy reveal"><span class="section-label">یکپارچگی واقعی</span><h2 class="section-title">داده فقط یک‌بار ثبت می‌شود؛<br><span>در تمام چرخه جریان دارد</span></h2><p>ماژول‌های سپند جزیره‌های جدا از هم نیستند. اطلاعات مشتری از CRM و استعلام به Booking و عملیات می‌رسد، در مالی تکمیل می‌شود و بخش مجاز آن در پرتال اختصاصی همان مشتری نمایش داده می‌شود.</p><div class="check-grid"><span class="check"><i>✓</i>کاهش ورود اطلاعات تکراری</span><span class="check"><i>✓</i>گزارش‌های مدیریتی دقیق</span><span class="check"><i>✓</i>خدمات سلف‌سرویس مشتری</span><span class="check"><i>✓</i>دسترسی تفکیک‌شده و امن</span></div></div>
        <div class="visual-box reveal"><span class="section-label">نتیجه یکپارچگی</span><h2 class="marketing-visual-heading">یک منبع قابل‌اعتماد<br>برای تیم و مشتری</h2><div class="feature-list marketing-visual-list"><li>دید کامل بر عملکرد تیم‌ها</li><li>کاهش خطا و دوباره‌کاری</li><li>رهگیری شفاف‌تر برای مشتری</li><li>هماهنگی فروش، عملیات و مالی</li></div></div>
    </div>
</section>

<section class="cta-wrap"><div class="container"><div class="cta reveal"><div class="cta-copy"><h2>کدام ماژول‌ها برای فرایند شما مناسب‌اند؟</h2><p>از CRM و بازاریابی پیامکی تا عملیات، مالی و پرتال مشتریان، نیازهای فعلی شما را بررسی و ترکیب مناسب ماژول‌ها را پیشنهاد می‌کنیم.</p></div><div class="cta-action"><a class="btn" href="{{ route('pricing') }}">انتخاب پلن مناسب</a></div></div></div></section>
@endsection
