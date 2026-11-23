@extends('layouts.marketing')

@php
    $breadcrumb = [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'صفحه اصلی', 'item' => route('home')],
        ['@type' => 'ListItem', 'position' => 2, 'name' => 'راهکارها', 'item' => route('solutions.index')],
        ['@type' => 'ListItem', 'position' => 3, 'name' => $page['nav_title'], 'item' => $canonical],
    ];
@endphp

@push('head')
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        ['@type' => 'WebPage', '@id' => $canonical.'#webpage', 'url' => $canonical, 'name' => $title, 'description' => $description, 'inLanguage' => 'fa-IR', 'dateModified' => config('site_platform_solutions.updated_at'), 'breadcrumb' => ['@id' => $canonical.'#breadcrumb'], 'mainEntity' => [['@id' => $canonical.'#software'], ['@id' => $canonical.'#faq']]],
        ['@type' => 'SoftwareApplication', '@id' => $canonical.'#software', 'name' => 'مدیریت تأمین‌کنندگان حمل‌ونقل سپند', 'applicationCategory' => 'BusinessApplication', 'operatingSystem' => 'Web', 'url' => $canonical, 'description' => $description, 'featureList' => ['پرونده تأمین‌کننده', 'مقایسه آخرین پیشنهاد تأمین‌کنندگان', 'نمایش اعتبار نرخ و زمان حمل', 'محاسبه سابقه تأخیر رهگیری', 'محاسبه نسبت آفرهای پذیرفته‌شده']],
        ['@type' => 'BreadcrumbList', '@id' => $canonical.'#breadcrumb', 'itemListElement' => $breadcrumb],
        ['@type' => 'FAQPage', '@id' => $canonical.'#faq', 'mainEntity' => array_map(static fn (array $faq): array => ['@type' => 'Question', 'name' => $faq['q'], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['a']]], $page['faqs'])],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endpush

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/marketing-platform-solutions.css') }}?v=20261107-1">
<link rel="stylesheet" href="{{ asset('assets/css/marketing-supplier-management.css') }}?v=20261122-1">
@endpush

@section('content')
<section class="sm-hero"><div class="container sm-hero-grid">
    <div class="sm-hero-copy reveal">
        <nav class="breadcrumb" aria-label="مسیر صفحه"><a href="{{ route('home') }}">صفحه اصلی</a><span>/</span><a href="{{ route('solutions.index') }}">راهکارها</a><span>/</span><span>{{ $page['nav_title'] }}</span></nav>
        <span class="sm-eyebrow">{{ $page['eyebrow'] }}</span><h1>{{ $page['h1'] }}</h1>
        <p>برای حمل نینگبو به بندرعباس دو ایجنت نرخ معتبر داده‌اند. نرخ ایجنت اول پایین‌تر است و ایجنت دوم روی همین مسیر چند پرونده قبلی دارد. مشتری تا پایان روز تأیید رزرو می‌خواهد. تیم خرید باید بررسی کند هر ایجنت چه خدماتی پوشش می‌دهد، از همکاری‌های قبلی چه اطلاعاتی در دسترس است و چه زمانی می‌تواند ظرفیت را تأیید کند.</p>
        <p>در سپند، هویت و اطلاعات تماس در پرونده تأمین‌کننده (Supplier Master) نگهداری می‌شود. مسیر، سرویس و نرخ از پیشنهادها و تراکنش‌های مرتبط و سابقه عملکرد از آفرهای پذیرفته‌شده و رویدادهای رهگیری بررسی می‌شوند؛ بنابراین کارشناس می‌داند هر بخش تصمیم را در کدام نما پیدا کند.</p>
        <div class="hero-actions"><a class="btn btn-primary" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="supplier_management_hero_demo">درخواست دموی مدیریت تأمین‌کنندگان</a><a class="btn btn-outline" href="#agent-example">مشاهده مقایسه دو ایجنت</a></div>
    </div>
    <aside class="sm-question reveal"><span>سؤال تیم خرید</span><strong>برای این مسیر و مهلت رزرو، پیگیری از کدام ایجنت شروع شود؟</strong><dl><div><dt>پرونده</dt><dd>هویت، دسته‌بندی، وضعیت و تماس</dd></div><div><dt>پیشنهاد مرتبط</dt><dd>نرخ، اعتبار، زمان حمل و Free Time</dd></div><div><dt>سابقه</dt><dd>آفرهای پذیرفته‌شده و تأخیر رهگیری</dd></div><div><dt>پیگیری جداگانه</dt><dd>تأیید ظرفیت و موعد پاسخ</dd></div></dl></aside>
</div></section>

<section class="section sm-example" id="agent-example" aria-labelledby="agent-example-title"><div class="container">
    <header class="section-head reveal"><span class="section-label">مثال آموزشی</span><h2 class="section-title" id="agent-example-title">اولویت پیگیری ایجنت برای مسیر نینگبو به بندرعباس</h2><p class="section-sub">هر دو ایجنت سرویس موردنیاز و نرخ معتبر دارند و تأیید رزرو باید تا پایان روز انجام شود. مقدارها و موعدهای این جدول فرضی‌اند و از تصویر محصول برداشت نشده‌اند.</p></header>
    <div class="sm-example-grid">
        <div class="sm-example-copy">
            <div class="sm-table-wrap reveal" role="region" aria-label="جدول آموزشی مقایسه دو ایجنت حمل" tabindex="0"><table><caption>مقایسه آموزشی برای تصمیم پیگیری، نه رتبه‌بندی خودکار محصول</caption><thead><tr><th>معیار</th><th>ایجنت A</th><th>ایجنت B</th></tr></thead><tbody>
                <tr><th>نرخ خرید</th><td><span class="sm-value is-low">پایین‌تر</span></td><td>بالاتر</td></tr>
                <tr><th>سابقه همکاری در همین مسیر</th><td>سابقه ثبت‌شده محدود</td><td><strong>چند پرونده قبلی</strong></td></tr>
                <tr><th>پاسخ درباره ظرفیت</th><td>هنوز زمانی برای پاسخ نداده است</td><td><strong>اعلام کرده تا ساعت ۱۵ وضعیت ظرفیت را مشخص می‌کند</strong></td></tr>
                <tr><th>تصمیم پیگیری</th><td>گزینه پشتیبان تا روشن‌شدن ظرفیت</td><td><span class="sm-value is-priority">پیگیری B در اولویت</span></td></tr>
            </tbody></table></div>
            <div class="sm-decision reveal"><strong>چرا B اولویت دارد؟</strong><p>ساعت ۱۵ موعد پاسخ آموزشی ایجنت B است. کارشناس ابتدا پاسخ ظرفیت B را پیگیری می‌کند و پس از دریافت تأیید، تصمیم نهایی رزرو را می‌گیرد. ایجنت A با نرخ پایین‌تر، تا روشن‌شدن ظرفیت گزینه پشتیبان می‌ماند. موعد پاسخ و تأیید ظرفیت در نمای مقایسه فعلی محاسبه نمی‌شوند و باید جداگانه پیگیری شوند.</p></div>
            <p class="sm-rate-boundary reveal">برای مقایسه مبلغ، اعتبار و شرایط «پیشنهاد خرید» به <a href="{{ route('solutions.platform.show', ['solution' => 'rate-management']) }}">نرم‌افزار مدیریت و مقایسه نرخ حمل‌ونقل</a> بروید. این صفحه روی تناسب تأمین‌کننده با مسیر، پوشش سرویس و سابقه همکاری تمرکز دارد.</p>
        </div>
        <figure class="sm-primary-shot reveal"><a href="{{ asset('assets/images/marketing/modules/screenshots/pricing-supplier-comparison.webp') }}" target="_blank" rel="noopener"><img src="{{ asset('assets/images/marketing/modules/screenshots/pricing-supplier-comparison.webp') }}" width="1600" height="839" loading="eager" alt="نمای واقعی مقایسه تأمین‌کنندگان سپند شامل نرخ خرید، زمان حمل، اعتبار نرخ، Free Time، سابقه تأخیر و کیفیت پاسخ‌گویی"></a><figcaption><span>شاهد محصول 01 · Product Evidence</span><strong>نمای مقایسه تأمین‌کنندگان</strong><p>این نما آخرین پیشنهاد مرتبط، نرخ خرید، زمان حمل، نوع حمل، اعتبار، Free Time، سابقه تأخیر رهگیری و نسبت آفرهای پذیرفته‌شده را کنار هم نشان می‌دهد. داده A و B جدول آموزشی داخل تصویر نیست.</p></figcaption></figure>
    </div>
    <div class="sm-example-cta reveal"><a class="btn btn-primary" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="supplier_management_example_demo">انتخاب ایجنت برای یک مسیر را در سپند ببینید</a></div>
</div></section>

<section class="section soft sm-master" aria-labelledby="master-title"><div class="container">
    <header class="section-head reveal"><span class="section-label">پرونده تأمین‌کننده</span><h2 class="section-title" id="master-title">در Supplier Master چه چیزی مستقیم دیده می‌شود؟</h2><p class="section-sub">مدیریت ایجنت‌ها و نمایندگان حمل بین‌المللی از یک رکورد مرجع شروع می‌شود، اما همه داده‌های تصمیم خرید داخل همان رکورد نیستند.</p></header>
    <div class="sm-master-grid">
        <figure class="sm-shot reveal"><a href="{{ asset('assets/images/marketing/live/supplier-master.png') }}" target="_blank" rel="noopener"><img src="{{ asset('assets/images/marketing/live/supplier-master.png') }}" width="1264" height="600" loading="lazy" alt="نمای واقعی فهرست تأمین‌کنندگان سپند با تب فهرست و مقایسه تأمین‌کننده"></a><figcaption><span>شاهد محصول 02</span><strong>فهرست واقعی Supplier Master</strong><p>در فهرست، نام، مالکیت، شناسه ملی، دسته‌بندی، راه‌های تماس و وضعیت فعال دیده می‌شوند. پوشش مسیر، نرخ و سابقه پرونده‌ها ستون مستقیم این فهرست نیستند.</p></figcaption></figure>
        <div class="sm-data-map">
            <article class="reveal"><span>مستقیم در پرونده</span><h3>هویت و تماس</h3><p>نام فارسی و انگلیسی، مالکیت، شناسه ملی، دسته‌بندی، وضعیت فعال، موبایل، تلفن، ایمیل، وب‌سایت، لینکدین و توضیحات تماس.</p></article>
            <article class="reveal"><span>در نمای مرتبط</span><h3>مسیر، سرویس و نرخ</h3><p>آخرین پیشنهاد و تراکنش مرتبط، روش حمل و مسیر را فراهم می‌کنند؛ نرخ معتبر و جزئیات تجاری در Rate Master و Rate Finder بررسی می‌شوند.</p></article>
            <article class="reveal"><span>محاسبه‌شده از سابقه</span><h3>تأخیر و پذیرش آفر</h3><p>سابقه تأخیر از رویدادهای رهگیری Bookingهای مرتبط و «کیفیت پاسخ‌گویی» از نسبت آفرهای پذیرفته‌شده به کل آفرها ساخته می‌شود؛ این معیار، سرعت پاسخ درباره ظرفیت نیست.</p></article>
            <article class="reveal"><span>نیازمند بررسی جداگانه</span><h3>ظرفیت و موعد پاسخ</h3><p>تأیید ظرفیت، ساعت وعده پاسخ و دلیل انتخاب نهایی در نمای مقایسه Supplier به‌صورت فیلد مستقل ثبت یا محاسبه نمی‌شوند.</p></article>
        </div>
    </div>
</div></section>

<section class="section sm-decision-path" id="operational-depth" aria-labelledby="path-title"><div class="container">
    <header class="section-head reveal"><span class="section-label">Operational Depth · مسیر تصمیم خرید</span><h2 class="section-title" id="path-title">برای انتخاب ایجنت، هر معیار را کجا بررسی کنید؟</h2></header>
    <div class="sm-criteria-grid">
        <article class="reveal"><span>۱</span><h3>تناسب مسیر و سرویس</h3><p>مسیر و شیوه حمل را از تراکنش آخرین پیشنهاد و جست‌وجوی Rate Finder کنترل کنید. این داده داخل فیلدهای اصلی Supplier Master نیست.</p><strong>اثر تصمیم: حذف گزینه‌ای که پیشنهاد مرتبط با نیاز فعلی ندارد.</strong></article>
        <article class="reveal"><span>۲</span><h3>شرایط پیشنهاد خرید</h3><p>نرخ، ارز، اعتبار، زمان حمل و Free Time در نمای مقایسه و مدیریت نرخ دیده می‌شوند.</p><strong>اثر تصمیم: مقایسه گزینه‌های تجاری هم‌مبنا.</strong></article>
        <article class="reveal"><span>۳</span><h3>سابقه همکاری</h3><p>تعداد آفرها، آفرهای پذیرفته‌شده و رویدادهای دارای تأخیر برای ارزیابی عملکرد تأمین‌کنندگان حمل‌ونقل استفاده می‌شوند.</p><strong>اثر تصمیم: انتخاب ایجنت بر اساس سابقه همکاری، نه فقط مبلغ.</strong></article>
        <article class="reveal"><span>۴</span><h3>ظرفیت و مهلت رزرو</h3><p>پاسخ ظرفیت و موعد وعده‌داده‌شده باید توسط کارشناس پیگیری شوند؛ نمای فعلی امتیاز سرعت پاسخ یا موعد ظرفیت نمی‌سازد.</p><strong>اثر تصمیم: گزینه پشتیبان تا دریافت تأیید حفظ می‌شود.</strong></article>
    </div>
    <figure class="sm-rate-shot reveal"><a href="{{ asset('assets/images/marketing/live/rate-management.png') }}" target="_blank" rel="noopener"><img src="{{ asset('assets/images/marketing/live/rate-management.png') }}" width="1264" height="600" loading="lazy" alt="نمای واقعی Rate Finder سپند برای جست‌وجوی نرخ بر اساس شیوه حمل، تأمین‌کننده، تاریخ، مبدأ و مقصد"></a><figcaption><span>شاهد محصول 03</span><strong>Rate Finder برای بررسی پیشنهاد خرید مسیر</strong><p>کارشناس می‌تواند شیوه حمل، تأمین‌کننده، تاریخ، مبدأ و مقصد را فیلتر کند. این تصویر سابقه همکاری یا تأیید ظرفیت را نمایش نمی‌دهد.</p></figcaption></figure>
    <p class="sm-boundary reveal"><strong>دامنه و کاربرد راهکار:</strong> نمای مقایسه حداکثر سه تأمین‌کننده منتخب را کنار هم می‌گذارد، اما انتخاب نهایی را خودکار ثبت نمی‌کند. موتور پیشنهاد مسیر و رتبه‌بندی در بخش دیگری از مرکز فرمان وجود دارد؛ اتصال آن به همین سناریوی خرید و ثبت دلیل انتخاب نهایی در Supplier Master تأیید نشد، بنابراین این صفحه انتخاب خودکار ایجنت را ادعا نمی‌کند.</p>
</div></section>

<section class="section soft" id="solution-faq" aria-labelledby="faq-title"><div class="container sm-faq-layout"><div class="reveal"><span class="section-label">پرسش‌های تیم خرید</span><h2 class="section-title" id="faq-title">سؤال‌های رایج درباره مدیریت تأمین‌کنندگان حمل‌ونقل</h2><p>پاسخ‌ها بین داده مستقیم پرونده، داده نماهای مرتبط و پیگیری دستی کارشناس تفاوت می‌گذارند.</p></div><div class="faq">@foreach($page['faqs'] as $faq)<details class="reveal"><summary>{{ $faq['q'] }}</summary><p>{{ $faq['a'] }}</p></details>@endforeach</div></div></section>

<section class="cta-wrap"><div class="container"><div class="cta reveal"><div class="cta-copy"><h2>{{ $page['cta_title'] }}</h2><p>{{ $page['cta_text'] }}</p></div><div class="cta-action"><a class="btn" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="supplier_management_bottom_demo">{{ $page['cta_button'] }}</a></div></div></div></section>
@endsection
