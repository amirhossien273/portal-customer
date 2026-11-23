@extends('layouts.marketing')

@php
    $breadcrumb = [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'صفحه اصلی', 'item' => route('home')],
        ['@type' => 'ListItem', 'position' => 2, 'name' => 'راهکارها', 'item' => route('solutions.index')],
        ['@type' => 'ListItem', 'position' => 3, 'name' => $page['nav_title'], 'item' => $canonical],
    ];
    $howTo = [
        ['@type' => 'HowToStep', 'position' => 1, 'name' => 'ثبت ETA جدید', 'text' => 'کارشناس ETA جدید را در پرونده عملیات ثبت می‌کند.'],
        ['@type' => 'HowToStep', 'position' => 2, 'name' => 'پایش شرط Rule', 'text' => 'پایش زمان‌بندی‌شده شرط را روی داده فعلی پرونده می‌سنجد.'],
        ['@type' => 'HowToStep', 'position' => 3, 'name' => 'ساخت Exception', 'text' => 'در صورت برقرار بودن شرط، Exception با شدت، مسئول و مهلت ساخته می‌شود.'],
        ['@type' => 'HowToStep', 'position' => 4, 'name' => 'ثبت نتیجه رسیدگی', 'text' => 'کارشناس اقدام و نتیجه را در صف کار عملیات ثبت می‌کند.'],
    ];
@endphp

@push('head')
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        ['@type' => 'WebPage', '@id' => $canonical.'#webpage', 'url' => $canonical, 'name' => $title, 'description' => $description, 'inLanguage' => 'fa-IR', 'dateModified' => config('site_platform_solutions.updated_at'), 'breadcrumb' => ['@id' => $canonical.'#breadcrumb'], 'mainEntity' => [['@id' => $canonical.'#software'], ['@id' => $canonical.'#rule-cycle'], ['@id' => $canonical.'#faq']]],
        ['@type' => 'SoftwareApplication', '@id' => $canonical.'#software', 'name' => 'اتوماسیون عملیات حمل‌ونقل سپند', 'applicationCategory' => 'BusinessApplication', 'operatingSystem' => 'Web', 'url' => $canonical, 'description' => $description, 'featureList' => ['تعریف قواعد خودکار عملیات حمل', 'پایش دوره‌ای داده عملیات', 'ساخت Exception با مسئول و مهلت', 'ثبت نتیجه و تاریخچه رسیدگی']],
        ['@type' => 'BreadcrumbList', '@id' => $canonical.'#breadcrumb', 'itemListElement' => $breadcrumb],
        ['@type' => 'HowTo', '@id' => $canonical.'#rule-cycle', 'name' => 'چرخه Rule تا Exception در عملیات حمل', 'step' => $howTo],
        ['@type' => 'FAQPage', '@id' => $canonical.'#faq', 'mainEntity' => array_map(static fn (array $faq): array => ['@type' => 'Question', 'name' => $faq['q'], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['a']]], $page['faqs'])],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endpush

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/marketing-platform-solutions.css') }}?v=20261107-1">
<link rel="stylesheet" href="{{ asset('assets/css/marketing-operations-automation.css') }}?v=20261122-1">
@endpush

@section('content')
<section class="oa-hero"><div class="container oa-hero-grid">
    <div class="oa-hero-copy reveal">
        <nav class="breadcrumb" aria-label="مسیر صفحه"><a href="{{ route('home') }}">صفحه اصلی</a><span>/</span><a href="{{ route('solutions.index') }}">راهکارها</a><span>/</span><span>{{ $page['nav_title'] }}</span></nav>
        <span class="oa-eyebrow">{{ $page['eyebrow'] }}</span>
        <h1>{{ $page['h1'] }}</h1>
        <p>قرار بود کانتینر پنج‌شنبه به بندرعباس برسد، اما زمان تخمینی رسیدن محموله (ETA) به جمعه تغییر کرده است. تیم عملیات باید برنامه تحویل را بازبینی کند. اگر تغییر فقط در ایمیل بماند، مشخص نیست چه کسی آن را دیده و چه زمانی باید اقدام کند.</p>
        <p>در سپند می‌توانید برای داده‌های مهم یک قاعده تعریف کنید. پس از ثبت ETA جدید، پایش زمان‌بندی‌شده شرط قاعده را روی مقدار فعلی می‌سنجد و اگر شرط برقرار باشد، Exception به پرونده حمل مرتبط می‌شود تا مسئول، مهلت و نتیجه رسیدگی قابل پیگیری باشند.</p>
        <div class="hero-actions"><a class="btn btn-primary" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="operations_automation_hero_demo">درخواست دموی اتوماسیون عملیات</a><a class="btn btn-outline" href="#eta-scenario">مشاهده سناریوی ETA تا Exception</a></div>
    </div>
    <aside class="oa-answer reveal"><span>پاسخ کوتاه مدیر عملیات</span><strong>چه چیزی، چه اقدامی را شروع می‌کند؟</strong><dl><div><dt>ورودی</dt><dd>داده فعلی پرونده، نه ایمیل بیرون از سپند</dd></div><div><dt>شرط</dt><dd>شاخص، عملگر و آستانه Rule</dd></div><div><dt>خروجی</dt><dd>Exception با مسئول و مهلت</dd></div><div><dt>اقدام انسانی</dt><dd>بررسی، ثبت نتیجه و بستن مورد</dd></div></dl></aside>
</div></section>

<section class="section oa-scenario" id="eta-scenario" aria-labelledby="eta-scenario-title"><div class="container">
    <header class="section-head reveal"><span class="section-label">{{ $page['demo']['title'] }}</span><h2 class="section-title" id="eta-scenario-title">از تغییر ETA حمل نینگبو–بندرعباس تا صف رسیدگی</h2><p class="section-sub">ETA مثال از پنج‌شنبه ساعت ۱۰ به جمعه ساعت ۱۰ تغییر می‌کند. این فاصله ۲۴ ساعته داده آموزشی سناریو است؛ نسخه فعلی مقدار تغییر ETA را با مقدار قبلی مقایسه نمی‌کند.</p></header>
    <div class="oa-boundary reveal"><strong>شفافیت داده:</strong><p>در کد بررسی‌شده، ETA جدید در فرم عملیات دریایی توسط کاربر ثبت یا ویرایش می‌شود. دریافت خودکار ETA از کریر تأیید نشد. Rule می‌تواند «ساعت باقی‌مانده تا ETA فعلی» را بسنجد، نه این‌که تشخیص دهد ETA دقیقاً ۲۴ ساعت عقب افتاده است.</p></div>
    <ol class="oa-steps">
        <li class="reveal"><span>۱</span><div><h3>تغییر ثبت شد</h3><p>کارشناس عملیات در پرونده دریایی، زمان به‌روزشده رسیدن را از پنج‌شنبه ساعت ۱۰ به جمعه ساعت ۱۰ ثبت می‌کند. برای مشاهده آخرین وضعیت و رویداد محموله، <a href="{{ route('solutions.shipment-visibility') }}">راهکار دیدپذیری محموله</a> را ببینید.</p><b>اقدام انسانی: ثبت یا اصلاح ETA.</b></div></li>
        <li class="reveal"><span>۲</span><div><h3>قاعده بررسی شد</h3><p>پایش زمان‌بندی‌شده روی پرونده فعال اجرا می‌شود. در Rule Builder، روش حمل، شاخص «ساعت تا ETA»، عملگر و آستانه تنظیم می‌شوند؛ آستانه باید بر اساس رویه شرکت انتخاب شود.</p><b>خودکار: ارزیابی شرط روی ETA فعلی ثبت‌شده.</b></div></li>
        <li class="reveal"><span>۳</span><div><h3>مورد به صف رسیدگی رفت</h3><p>اگر شرط برقرار باشد، سیستم یک Exception یکتا می‌سازد. شدت، مسئول و مهلت از Rule می‌آیند و مورد در «صف کار عملیات» قابل فیلتر است.</p><b>خودکار: ساخت و اتصال Exception به پرونده.</b></div></li>
        <li class="reveal"><span>۴</span><div><h3>نتیجه ثبت شد</h3><p>کارشناس برنامه تحویل را بازبینی می‌کند و وضعیت و شرح اقدام را در همان Exception ثبت می‌کند. اطلاع‌رسانی خودکار به مشتری در این جریان تأیید نشد.</p><b>اقدام انسانی: تصمیم، ثبت نتیجه و بستن مورد.</b></div></li>
    </ol>
    <div class="oa-shot-grid">
        <figure class="oa-shot reveal"><a href="{{ asset('assets/images/marketing/live/control-center-rules.png') }}" target="_blank" rel="noopener"><img src="{{ asset('assets/images/marketing/live/control-center-rules.png') }}" width="1264" height="600" loading="eager" alt="نمای واقعی Rule Builder سپند با Templateهای حمل و فرم تعریف شاخص، آستانه، مسئول و مهلت"></a><figcaption><span>شاهد محصول 01 · Product Evidence</span><strong>تعریف قاعده در Rule Builder</strong><p>کاربر Templateها و ورودی ساخت قانون سفارشی را می‌بیند. داده پنج‌شنبه و جمعه این سناریو داخل تصویر نیست.</p></figcaption></figure>
        <figure class="oa-shot reveal"><a href="{{ asset('assets/images/marketing/live/control-center-exceptions.png') }}" target="_blank" rel="noopener"><img src="{{ asset('assets/images/marketing/live/control-center-exceptions.png') }}" width="1264" height="600" loading="lazy" alt="نمای واقعی صف کار عملیات سپند با فیلتر جست‌وجو، شدت و وضعیت Exception"></a><figcaption><span>شاهد محصول 02</span><strong>صف کار عملیات برای Exception</strong><p>فیلتر جست‌وجو، شدت و وضعیت دیده می‌شود؛ در لحظه ثبت تصویر، مورد فعالی مطابق فیلتر وجود نداشته است.</p></figcaption></figure>
    </div>
    <div class="oa-demo-cta reveal"><a class="btn btn-primary" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="operations_automation_scenario_demo">اجرای یک قاعده عملیاتی را در سپند ببینید</a></div>
</div></section>

<section class="section soft oa-rule" id="operational-depth" aria-labelledby="rule-title"><div class="container">
    <header class="section-head reveal"><span class="section-label">Operational Depth · اجزای قاعده</span><h2 class="section-title" id="rule-title">تعریف قواعد خودکار عملیات حمل؛ از ورودی تا اقدام</h2><p class="section-sub">Rule روی داده داخلی ثبت‌شده اجرا می‌شود و بخش خودکار را از تصمیم تخصصی کارشناس جدا نگه می‌دارد.</p></header>
    <div class="oa-rule-grid"><article class="reveal"><span>IF · ورودی</span><h3>داده قابل‌اندازه‌گیری</h3><p>روش حمل و یکی از شاخص‌های ساعت تا ETA، تعداد اسناد اجباری تأییدنشده، مغایرت مسدودکننده یا تعداد هشدار Free Time.</p></article><article class="reveal"><span>IF · شرط</span><h3>عملگر و آستانه</h3><p>بیشتر، بیشتر یا مساوی، کمتر، کمتر یا مساوی و مساوی روی مقدار عددی اعمال می‌شوند.</p></article><article class="reveal"><span>THEN · خروجی</span><h3>Exception قابل پیگیری</h3><p>عنوان، شدت، مسئول و مهلت اقدام همراه Exception ساخته می‌شوند و رکورد تکراری همان Rule و پرونده تجمیع می‌شود.</p></article><article class="reveal"><span>HUMAN · نتیجه</span><h3>ثبت اقدام کارشناس</h3><p>کارشناس مورد را در دست اقدام می‌گذارد و برای حل یا بستن، شرح نتیجه را ثبت می‌کند.</p></article></div>
    <p class="oa-link-note reveal"><strong>دامنه و کاربرد راهکار:</strong> پس از ساخت مورد، ثبت مسئول، نتیجه و بستن آن در <a href="{{ route('solutions.operation-exception-management') }}">مدیریت Exceptionهای عملیات حمل</a> ادامه پیدا می‌کند. کنترل مرحله‌ها، مدارک و معیار عبور طبق رویه شرکت در <a href="{{ route('solutions.operational-workflow-management') }}">مدیریت گردش کار عملیاتی</a> توضیح داده شده است.</p>
</div></section>

<section class="section oa-uses" aria-labelledby="uses-title"><div class="container">
    <header class="section-head reveal"><span class="section-label">کاربردهای تأییدشده</span><h2 class="section-title" id="uses-title">قواعد دیگری که در نسخه فعلی پشتوانه فنی دارند</h2></header>
    <div class="oa-use-grid"><article class="reveal"><span>هشدار کسری مدارک حمل</span><h3>اسناد اجباری تأییدنشده</h3><p>پایش تعداد اقلام اجباری چک‌لیست را که هنوز تأیید نشده‌اند می‌سنجد. در Template هوایی، این شرط با نزدیک‌بودن ETA ترکیب می‌شود؛ رفع یا تأیید مدرک به اقدام کارشناس نیاز دارد.</p></article><article class="reveal"><span>هشدار پایان مهلت رایگان</span><h3>مهلت رایگان (Free Time)</h3><p>Policy فعال، روزهای مصرف‌شده را با Free Time و محدوده هشدار مقایسه می‌کند. ورود به محدوده هشدار می‌تواند Exception بسازد؛ بررسی عملیات و اقدام بعدی انسانی است.</p></article><article class="reveal"><span>هشدار تغییر زمان رسیدن محموله</span><h3>مرز قابلیت ETA</h3><p>Rule Builder ساعت باقی‌مانده تا ETA فعلی را بررسی می‌کند. هشدار بر اساس اختلاف ETA جدید و قبلی یا دریافت خودکار تغییر از کریر در نسخه بررسی‌شده تأیید نشد.</p></article></div>
    <figure class="oa-dashboard reveal"><a href="{{ asset('assets/images/marketing/live/operations-dashboard.png') }}" target="_blank" rel="noopener"><img src="{{ asset('assets/images/marketing/live/operations-dashboard.png') }}" width="1264" height="600" loading="lazy" alt="نمای واقعی داشبورد سپند برای مرور شاخص‌های عملیاتی و موارد نیازمند پیگیری"></a><figcaption><span>شاهد محصول 03</span><strong>نمای مدیریتی پس از تعریف کنترل‌ها</strong><p>داشبورد برای مرور وضعیت جاری و موارد نیازمند توجه است؛ جای ثبت نتیجه Exception، همان صف کار عملیات است.</p></figcaption></figure>
</div></section>

<section class="section soft" id="solution-faq" aria-labelledby="faq-title"><div class="container oa-faq-layout"><div class="reveal"><span class="section-label">پرسش‌های مدیر عملیات</span><h2 class="section-title" id="faq-title">سؤال‌های رایج درباره اتوماسیون عملیات حمل‌ونقل</h2><p>پاسخ‌ها با موتور پایش زمان‌بندی‌شده، Rule Builder و Exception Workbench نسخه بررسی‌شده هماهنگ‌اند.</p></div><div class="faq">@foreach($page['faqs'] as $faq)<details class="reveal"><summary>{{ $faq['q'] }}</summary><p>{{ $faq['a'] }}</p></details>@endforeach</div></div></section>

<section class="cta-wrap"><div class="container"><div class="cta reveal"><div class="cta-copy"><h2>{{ $page['cta_title'] }}</h2><p>{{ $page['cta_text'] }}</p></div><div class="cta-action"><a class="btn" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="operations_automation_bottom_demo">{{ $page['cta_button'] }}</a></div></div></div></section>
@endsection
