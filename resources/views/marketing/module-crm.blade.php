@extends('layouts.marketing')

@php
    $capabilities = [
        [
            'title' => 'ثبت مشتریان حقیقی و حقوقی',
            'description' => 'مشخصات مشتریان حقیقی و حقوقی، اطلاعات تماس و افراد مرتبط با هر شرکت در یک ساختار منظم ثبت می‌شود. این اطلاعات مبنای مشترک واحدهای فروش، قرارداد و عملیات خواهد بود و جست‌وجوی داده‌ها را ساده‌تر می‌کند.',
        ],
        [
            'title' => 'مدیریت سرنخ‌ها و فرصت‌های فروش',
            'description' => 'هر سرنخ از لحظه ورود تا تبدیل‌شدن به مشتری قابل پیگیری است. برای فرصت فروش می‌توان مرحله مذاکره، مسئول پیگیری، ارزش احتمالی، اقدام بعدی و نتیجه نهایی را مشخص کرد.',
        ],
        [
            'title' => 'قیف فروش شرکت حمل‌ونقل',
            'description' => 'مراحل فروش متناسب با فرایند واقعی شرکت تعریف می‌شوند تا فرصت‌های جدید، در حال مذاکره، برنده یا ازدست‌رفته قابل تفکیک باشند. مدیر فروش می‌تواند وضعیت کلی مذاکرات را بدون جمع‌آوری گزارش‌های دستی بررسی کند.',
        ],
        [
            'title' => 'ثبت تماس، جلسه و یادداشت',
            'description' => 'تماس‌ها، جلسات، مکاتبات و یادداشت‌های کارشناسان در سابقه همان مشتری نگهداری می‌شود. در نتیجه، ادامه مذاکره به حافظه یک فرد یا جست‌وجو در پیام‌رسان‌ها وابسته نخواهد بود.',
        ],
        [
            'title' => 'وظیفه و یادآوری پیگیری',
            'description' => 'برای تماس، ارسال پیشنهاد، جلسه یا هر اقدام بعدی می‌توان مسئول و موعد مشخص کرد. فهرست وظایف زمان‌دار کمک می‌کند پیگیری مشتریان حمل‌ونقل در زمان مناسب انجام شود.',
        ],
        [
            'title' => 'ثبت استعلام و درخواست حمل',
            'description' => 'درخواست اولیه مشتری و اطلاعات موردنیاز برای بررسی خدمت حمل در پرونده او ثبت می‌شود. تیم فروش می‌تواند سابقه استعلام‌ها و نتیجه هر درخواست را کنار سایر تعاملات مشتری مشاهده کند.',
        ],
        [
            'title' => 'سوابق مذاکره و پیشنهاد قیمت',
            'description' => 'مذاکرات و پیشنهادهای مرتبط با هر فرصت فروش به سابقه مشتری متصل می‌مانند. این پیوستگی به کارشناس کمک می‌کند پیش از تماس بعدی، تصویر روشن‌تری از درخواست‌ها و توافق‌های قبلی داشته باشد.',
        ],
        [
            'title' => 'اتصال به قرارداد، Booking و عملیات',
            'description' => 'پس از تأیید مشتری، اطلاعات پایه بدون تشکیل پرونده‌های جداگانه در اختیار مراحل بعدی قرار می‌گیرد. این اتصال ورود تکراری داده را کاهش می‌دهد و هماهنگی فروش با تیم عملیات حمل را بیشتر می‌کند.',
        ],
        [
            'title' => 'گزارش عملکرد تیم فروش',
            'description' => 'وضعیت فرصت‌های باز و بسته، اقدامات انجام‌شده و مسئول هر پیگیری در گزارش‌ها قابل بررسی است. مدیران می‌توانند روند فعالیت کارشناسان و نقاط نیازمند اقدام را سریع‌تر تشخیص دهند.',
        ],
        [
            'title' => 'دسته‌بندی و شناخت بهتر مشتریان',
            'description' => 'مشتریان را می‌توان بر اساس نوع فعالیت، صنعت، وضعیت همکاری یا ارزش تجاری دسته‌بندی کرد. این دسته‌بندی برای اولویت‌بندی پیگیری‌ها و برنامه‌ریزی ارتباطات فروش کاربرد دارد.',
        ],
        [
            'title' => 'نگهداری فایل‌ها و اسناد مشتری',
            'description' => 'فایل‌ها و اسناد مرتبط در کنار اطلاعات و سوابق مشتری نگهداری می‌شوند. کاربران مجاز به‌جای جست‌وجو در پوشه‌ها و مکاتبات پراکنده، به مرجع مشترک پرونده دسترسی دارند.',
        ],
        [
            'title' => 'پرونده کامل و قابل‌جست‌وجوی مشتری',
            'description' => 'اطلاعات تماس، فعالیت‌ها، درخواست‌ها، فرصت‌ها و سوابق همکاری در نمایی یکپارچه جمع می‌شوند. این پرونده به پاسخ‌گویی سریع‌تر و انتقال شفاف‌تر اطلاعات میان اعضای تیم کمک می‌کند.',
        ],
    ];

    $faqs = [
        [
            'question' => 'نرم افزار CRM حمل و نقل چیست؟',
            'answer' => 'نرم افزار CRM حمل و نقل سیستمی برای ثبت و مدیریت اطلاعات مشتریان، استعلام‌ها، فرصت‌های فروش، مذاکرات و پیگیری‌های مرتبط با خدمات حمل است. در یک CRM تخصصی، اطلاعات مشتری به فرایندهایی مانند قرارداد، Booking و عملیات حمل متصل می‌شود.',
        ],
        [
            'question' => 'آیا CRM سپند فقط برای واحد فروش است؟',
            'answer' => 'خیر. اطلاعاتی که تیم فروش در CRM ثبت می‌کند می‌تواند در فرایندهای قرارداد، Booking، عملیات و گزارش‌های مدیریتی استفاده شود. این پیوستگی باعث می‌شود واحدهای مختلف روی داده مشترک مشتری کار کنند.',
        ],
        [
            'question' => 'آیا امکان ثبت یادآوری برای پیگیری مشتری وجود دارد؟',
            'answer' => 'بله. کارشناسان می‌توانند برای تماس، جلسه، ارسال پیشنهاد و اقدامات بعدی وظیفه زمان‌دار تعریف کنند. مسئول هر پیگیری و موعد انجام آن نیز مشخص می‌شود تا اقدام مهمی فراموش نشود.',
        ],
        [
            'question' => 'تفاوت CRM سپند با CRMهای عمومی چیست؟',
            'answer' => 'تفاوت اصلی در ارتباط پرونده مشتری با فرایندهای تخصصی شرکت‌های حمل‌ونقل است. استعلام، پیشنهاد، قرارداد، Booking و عملیات حمل می‌توانند در ادامه همان جریان اطلاعاتی قرار بگیرند و نیاز به ورود مجدد داده کاهش پیدا کند.',
        ],
        [
            'question' => 'CRM سپند برای چه شرکت‌هایی مناسب است؟',
            'answer' => 'این ماژول برای شرکت‌های حمل‌ونقل بین‌المللی، فورواردری، لجستیکی، کشتیرانی، حمل هوایی، زمینی و ریلی و همچنین شرکت‌های بازرگانی دارای تیم فروش سازمانی طراحی شده است.',
        ],
    ];
@endphp

@push('head')
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'SoftwareApplication',
            'name' => 'نرم افزار CRM حمل و نقل سپند',
            'applicationCategory' => 'BusinessApplication',
            'operatingSystem' => 'Web',
            'description' => $module['meta_description'],
            'url' => route('site.modules.show', ['module' => $slug]),
            'featureList' => array_column($capabilities, 'title'),
            'audience' => [
                '@type' => 'BusinessAudience',
                'audienceType' => 'شرکت‌های حمل‌ونقل، فورواردری، لجستیکی و بازرگانی',
            ],
        ],
        [
            '@type' => 'FAQPage',
            'mainEntity' => array_map(static fn (array $faq): array => [
                '@type' => 'Question',
                'name' => $faq['question'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $faq['answer'],
                ],
            ], $faqs),
        ],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endpush

@push('styles')
    .crm-hero-copy{max-width:690px}.crm-lead+.crm-lead{margin-top:11px}.crm-hero-art{min-height:430px}.crm-dashboard{position:absolute;inset:25px;z-index:2;padding:24px;color:#fff;background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.11);border-radius:22px}.crm-dashboard-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:22px}.crm-dashboard-head b{font-size:15px}.crm-dashboard-head span{padding:4px 9px;color:var(--cyan);background:rgba(18,214,210,.1);border:1px solid rgba(18,214,210,.2);border-radius:99px;font-size:10px}.crm-customer{display:flex;align-items:center;gap:11px;margin-bottom:12px;padding:13px;background:rgba(255,255,255,.06);border-radius:14px}.crm-avatar{display:grid;width:38px;height:38px;place-items:center;color:var(--navy);background:#fff;border-radius:12px;font-weight:900}.crm-customer div{flex:1}.crm-customer b,.crm-customer small{display:block}.crm-customer b{font-size:12px}.crm-customer small{color:rgba(255,255,255,.55);font-size:10px}.crm-state{color:var(--cyan);font-size:10px}.crm-pipeline{display:grid;grid-template-columns:repeat(3,1fr);gap:8px;margin-top:18px}.crm-pipeline div{padding:12px 8px;text-align:center;background:rgba(255,255,255,.055);border-radius:12px}.crm-pipeline b,.crm-pipeline span{display:block}.crm-pipeline b{color:var(--cyan);font-size:16px}.crm-pipeline span{color:rgba(255,255,255,.55);font-size:9px}
    .crm-intro{max-width:900px;margin:-25px auto 40px;color:var(--muted);font-size:15px;line-height:2.2;text-align:center}.crm-problem{padding:30px;color:#fff;background:linear-gradient(135deg,var(--navy),var(--navy-900));border-radius:23px}.crm-problem strong{display:block;margin-bottom:10px;color:var(--cyan);font-size:14px}.crm-problem p{margin:0;color:rgba(255,255,255,.74);font-size:14px;line-height:2.15}.crm-problem-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:18px;margin-top:20px}.crm-problem-card{padding:27px;background:#fff;border:1px solid var(--line);border-radius:21px}.crm-problem-card h3{margin:0 0 10px;color:var(--navy);font-size:17px}.crm-problem-card p{margin:0;color:var(--muted);font-size:14px;line-height:2.1}.crm-outcomes{display:grid;grid-template-columns:repeat(3,1fr);gap:13px;margin:28px 0 0;padding:0;list-style:none}.crm-outcomes li{padding:18px;color:#385269;background:#eaf5f5;border-radius:15px;font-weight:700;text-align:center}
    .crm-capability-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:18px}.crm-capability{position:relative;padding:28px 72px 28px 27px;background:#fff;border:1px solid var(--line);border-radius:21px;transition:.25s}.crm-capability:hover{border-color:var(--teal);transform:translateY(-4px);box-shadow:var(--shadow)}.crm-capability-num{position:absolute;top:27px;right:24px;display:grid;width:34px;height:34px;place-items:center;color:var(--teal-dark);background:#e7f4f4;border-radius:11px;font-size:11px;font-weight:900}.crm-capability h3{margin:0 0 9px;color:var(--navy);font-size:17px}.crm-capability p{margin:0;color:var(--muted);font-size:14px;line-height:2.05}
    .crm-process-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:18px}.crm-process{position:relative;padding:29px;background:#fff;border:1px solid var(--line);border-radius:21px}.crm-process-step{display:grid;width:43px;height:43px;margin-bottom:18px;place-items:center;color:#fff;background:var(--teal);border-radius:13px;font-weight:900}.crm-process h3{margin:0 0 10px;color:var(--navy);font-size:18px}.crm-process p{margin:0 0 17px;color:var(--muted);font-size:14px;line-height:2.1}.crm-process a{display:inline-flex;color:var(--teal-dark);font-size:12px;font-weight:700}.crm-process a:hover{color:var(--navy)}
    .crm-benefit-intro{max-width:850px;margin:16px auto 40px;color:rgba(255,255,255,.68);font-size:15px;line-height:2.2;text-align:center}.crm-benefits-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:13px;margin:0;padding:0;list-style:none}.crm-benefits-grid li{position:relative;padding:19px 48px 19px 18px;color:rgba(255,255,255,.82);background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:15px;font-weight:600}.crm-benefits-grid li:before{content:"✓";position:absolute;right:17px;top:18px;display:grid;width:22px;height:22px;place-items:center;color:var(--navy);background:var(--cyan);border-radius:7px;font-size:11px;font-weight:900}
    .crm-audience-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:14px}.crm-audience{padding:23px;background:#fff;border:1px solid var(--line);border-radius:18px}.crm-audience h3{margin:0 0 7px;color:var(--navy);font-size:15px}.crm-audience p{margin:0;color:var(--muted);font-size:13px;line-height:2}.crm-faq-intro{max-width:760px;margin:-22px auto 36px;color:var(--muted);font-size:14px;line-height:2.1;text-align:center}
    @media(max-width:1050px){.crm-audience-grid{grid-template-columns:repeat(2,1fr)}}
    @media(max-width:840px){.crm-hero-art{min-height:410px}.crm-problem-grid,.crm-outcomes,.crm-capability-grid,.crm-process-grid,.crm-benefits-grid{grid-template-columns:1fr}.crm-intro{margin-top:-10px}.crm-benefits-grid{max-width:650px;margin-inline:auto}}
    @media(max-width:580px){.crm-dashboard{inset:18px;padding:17px}.crm-pipeline{grid-template-columns:1fr}.crm-customer{padding:10px}.crm-problem{padding:24px}.crm-audience-grid{grid-template-columns:1fr}.crm-capability{padding:72px 23px 24px}.crm-capability-num{top:22px;right:22px}.crm-intro,.crm-benefit-intro{font-size:13px}}
@endpush

@section('content')
<section class="page-hero">
    <div class="container hero-inner">
        <div class="hero-copy crm-hero-copy reveal">
            <div class="breadcrumb"><a href="{{ route('home') }}">صفحه اصلی</a><svg viewBox="0 0 24 24" fill="none"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg><a href="{{ route('modules') }}">ماژول‌ها</a><svg viewBox="0 0 24 24" fill="none"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg><span>CRM حمل‌ونقل</span></div>
            <h1>نرم‌افزار CRM حمل‌ونقل و <span>مدیریت مشتریان سپند</span></h1>
            <p class="crm-lead">ماژول CRM نرم‌افزار سپند، راهکاری تخصصی برای مدیریت ارتباط با مشتریان در شرکت‌های حمل‌ونقل، لجستیک، فورواردری و بازرگانی است. اطلاعات مشتریان، سرنخ‌های فروش، استعلام‌ها، درخواست‌های حمل، مذاکرات و سوابق پیگیری در یک سیستم یکپارچه ثبت و مدیریت می‌شوند.</p>
            <p class="crm-lead">اتصال مستقیم اطلاعات مشتری به فروش، قرارداد، Booking و عملیات حمل باعث می‌شود تیم‌های مختلف بدون اطلاعات پراکنده و ورود دوباره داده، فرایند ارائه خدمات به مشتری را هماهنگ‌تر پیگیری کنند.</p>
            <div class="hero-actions">
                <a class="btn btn-primary" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="crm_hero_consultation">درخواست دموی نرم‌افزار CRM</a>
                <a class="btn btn-outline" href="#crm-features">مشاهده امکانات ماژول CRM</a>
            </div>
        </div>
        <div class="hero-art crm-hero-art reveal" role="img" aria-label="نمای شماتیک پرونده مشتری و قیف فروش در نرم افزار CRM حمل و نقل سپند">
            <div class="art-panel">
                <div class="crm-dashboard">
                    <div class="crm-dashboard-head"><b>پرونده‌های مشتریان</b><span>CRM سپند</span></div>
                    <div class="crm-customer"><span class="crm-avatar">آ</span><div><b>شرکت آریا ترابر</b><small>درخواست حمل دریایی</small></div><span class="crm-state">پیگیری امروز</span></div>
                    <div class="crm-customer"><span class="crm-avatar">پ</span><div><b>بازرگانی پارس</b><small>پیشنهاد قیمت ارسال‌شده</small></div><span class="crm-state">در مذاکره</span></div>
                    <div class="crm-customer"><span class="crm-avatar">ر</span><div><b>راهکار لجستیک</b><small>تبدیل‌شده به Booking</small></div><span class="crm-state">تأییدشده</span></div>
                    <div class="crm-pipeline"><div><b>۲۴</b><span>سرنخ فعال</span></div><div><b>۱۱</b><span>فرصت باز</span></div><div><b>۷</b><span>پیگیری امروز</span></div></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section" aria-labelledby="crm-problems-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">مسئله و راهکار</span><h2 class="section-title" id="crm-problems-title">نرم‌افزار CRM حمل‌ونقل چه<br><span>مشکلاتی را حل می‌کند؟</span></h2></div>
        <p class="crm-intro reveal">در بسیاری از شرکت‌های حمل‌ونقل، اطلاعات مشتریان میان فایل‌های Excel، پیام‌رسان‌ها، ایمیل‌ها و یادداشت‌های کارشناسان پراکنده است. این پراکندگی می‌تواند به فراموش‌شدن پیگیری‌ها، از دست رفتن فرصت‌های فروش و وابستگی اطلاعات به افراد منجر شود. CRM سپند تعاملات و سوابق مشتری را در یک پرونده واحد نگهداری می‌کند.</p>
        <div class="crm-problem reveal"><strong>چالش رایج شرکت‌های حمل‌ونقل و لجستیک</strong><p>وقتی آخرین مذاکره، درخواست حمل و اقدام بعدی مشتری در منابع مختلف ثبت شده باشد، تیم فروش تصویر کاملی از وضعیت رابطه با مشتری ندارد و واحد عملیات نیز اطلاعات اولیه را دوباره جمع‌آوری می‌کند.</p></div>
        <div class="crm-problem-grid">
            <article class="crm-problem-card reveal"><h3>پرونده یکپارچه مشتری</h3><p>اطلاعات تماس، سوابق مکالمات، استعلام‌ها، درخواست‌های حمل، اسناد و فعالیت‌های انجام‌شده برای هر مشتری در یک پرونده ثبت می‌شود. کارشناسان بدون جست‌وجو در فایل‌ها و پیام‌های پراکنده، سابقه همکاری را مشاهده می‌کنند.</p></article>
            <article class="crm-problem-card reveal"><h3>مدیریت سرنخ و فرصت فروش</h3><p>سرنخ‌های جدید از لحظه ورود تا تبدیل‌شدن به مشتری قابل پیگیری هستند. مرحله مذاکره، مسئول پیگیری، ارزش احتمالی، تاریخ اقدام بعدی و نتیجه نهایی هر فرصت مشخص باقی می‌ماند.</p></article>
            <article class="crm-problem-card reveal"><h3>برنامه‌ریزی بازاریابی و پیگیری</h3><p>تماس‌ها، جلسات، یادآوری‌ها و اقدامات بعدی کارشناسان در سیستم ثبت می‌شود تا هیچ مشتری بدون پیگیری نماند. مدیران نیز می‌توانند وضعیت مذاکرات و فعالیت تیم فروش را بررسی کنند.</p></article>
        </div>
        <ul class="crm-outcomes"><li class="reveal">کاهش وابستگی اطلاعات به کارشناسان</li><li class="reveal">جلوگیری از فراموش‌شدن پیگیری‌ها</li><li class="reveal">مشاهده سوابق کامل هر مشتری</li></ul>
    </div>
</section>

<section class="section soft" id="crm-features" aria-labelledby="crm-features-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">امکانات اصلی</span><h2 class="section-title" id="crm-features-title">امکانات ماژول CRM و<br><span>مدیریت مشتریان سپند</span></h2><p class="section-sub">ابزارهای موردنیاز تیم بازاریابی و فروش، از ثبت نخستین سرنخ تا انتقال اطلاعات مشتری به فرایند اجرایی، در یک مسیر قابل‌ردیابی کنار هم قرار می‌گیرند.</p></div>
        <div class="crm-capability-grid">
            @foreach($capabilities as $index => $capability)
                <article class="crm-capability reveal"><span class="crm-capability-num">{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</span><h3>{{ $capability['title'] }}</h3><p>{{ $capability['description'] }}</p></article>
            @endforeach
        </div>
    </div>
</section>

<section class="section" aria-labelledby="crm-integration-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">فرایند یکپارچه</span><h2 class="section-title" id="crm-integration-title">اتصال CRM به فروش، قرارداد و<br><span>عملیات حمل</span></h2><p class="section-sub">CRM سپند یک سیستم جدا از عملیات شرکت نیست. اطلاعات ثبت‌شده در بازاریابی و فروش می‌تواند بدون ورود مجدد، به مراحل قرارداد، Booking و عملیات منتقل شود؛ در نتیجه خطای ثبت اطلاعات و دوباره‌کاری کاهش می‌یابد.</p></div>
        <div class="crm-process-grid">
            <article class="crm-process reveal"><span class="crm-process-step">۱</span><h3>بازاریابی و فروش</h3><p>سرنخ‌ها، استعلام‌ها، مذاکرات، فعالیت‌های پیگیری و فرصت‌های فروش در این مرحله مدیریت می‌شوند. مدیر فروش وضعیت هر فرصت، مسئول پیگیری و مرحله فعلی مذاکره را مشاهده می‌کند.</p><a href="{{ route('site.modules.show', ['module' => 'pricing-sales']) }}">مشاهده ماژول نرخ‌دهی و فروش</a></article>
            <article class="crm-process reveal"><span class="crm-process-step">۲</span><h3>قرارداد و Booking</h3><p>پس از تأیید پیشنهاد و توافق با مشتری، مشخصات مشتری و درخواست حمل به ادامه فرایند منتقل می‌شود. به این ترتیب نیازی به ثبت مجدد اطلاعات پایه و جزئیات اولیه درخواست نیست.</p><a href="{{ route('site.modules.show', ['module' => 'booking']) }}">مشاهده ماژول Booking</a></article>
            <article class="crm-process reveal"><span class="crm-process-step">۳</span><h3>عملیات حمل</h3><p>تیم عملیات به اطلاعات مرتبط با مشتری، درخواست ثبت‌شده و سوابق موردنیاز دسترسی دارد. وضعیت پرونده حمل نیز مبنایی برای پاسخ‌گویی سریع‌تر و دقیق‌تر واحدهای مرتبط به مشتری خواهد بود.</p><a href="{{ route('site.modules.show', ['module' => 'transport-operations']) }}">مشاهده ماژول عملیات حمل</a></article>
        </div>
    </div>
</section>

<section class="dark-section" aria-labelledby="crm-benefits-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">مزیت‌های عملیاتی</span><h2 class="section-title" id="crm-benefits-title">مزایای استفاده از CRM سپند در<br><span>شرکت‌های حمل‌ونقل</span></h2></div>
        <p class="crm-benefit-intro reveal">استفاده از نرم‌افزار CRM حمل‌ونقل به شرکت کمک می‌کند نگهداری اطلاعات مشتری را به فرایند واقعی فروش و عملیات متصل کند. برخلاف یک CRM عمومی، ماژول سپند با استعلام حمل، قرارداد، Booking و پرونده عملیاتی در ارتباط است.</p>
        <ul class="crm-benefits-grid">
            <li class="reveal">افزایش نظم در پیگیری مشتریان</li>
            <li class="reveal">کاهش احتمال از دست رفتن فرصت‌های فروش</li>
            <li class="reveal">حذف فایل‌های پراکنده و اطلاعات شخصی کارشناسان</li>
            <li class="reveal">دسترسی سریع به سوابق کامل مشتری</li>
            <li class="reveal">کاهش ورود تکراری اطلاعات</li>
            <li class="reveal">افزایش هماهنگی میان فروش و عملیات</li>
            <li class="reveal">ارزیابی روشن‌تر فعالیت کارشناسان فروش</li>
            <li class="reveal">شناسایی مشتریان فعال، غیرفعال و ارزشمند</li>
            <li class="reveal">افزایش سرعت پاسخ‌گویی به درخواست مشتری</li>
        </ul>
    </div>
</section>

<section class="section" aria-labelledby="crm-audience-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">مخاطبان ماژول</span><h2 class="section-title" id="crm-audience-title">ماژول CRM سپند مناسب<br><span>چه شرکت‌هایی است؟</span></h2><p class="section-sub">این ماژول برای مجموعه‌هایی طراحی شده است که ارتباط مستمر با مشتری، پیگیری استعلام‌ها و هماهنگی میان فروش و عملیات بخش مهمی از فعالیت روزانه آن‌هاست.</p></div>
        <div class="crm-audience-grid">
            <article class="crm-audience reveal"><h3>شرکت‌های حمل‌ونقل بین‌المللی</h3><p>برای مدیریت مشتریان، درخواست‌های حمل و پیگیری فرصت‌ها در مسیرهای مختلف.</p></article>
            <article class="crm-audience reveal"><h3>شرکت‌های فورواردری و لجستیکی</h3><p>برای اتصال مذاکرات فروش و استعلام‌ها به Booking و اجرای عملیات.</p></article>
            <article class="crm-audience reveal"><h3>کشتیرانی و حمل چندوجهی</h3><p>برای هماهنگی ارتباط مشتری در خدمات دریایی، هوایی، زمینی و ریلی.</p></article>
            <article class="crm-audience reveal"><h3>شرکت‌های بازرگانی</h3><p>برای ثبت سوابق مشتریان و مدیریت فرصت‌های فروش سازمانی و درخواست‌های خدمات.</p></article>
            <article class="crm-audience reveal"><h3>تیم‌های فروش سازمانی</h3><p>برای تعیین مسئول، مرحله مذاکره و اقدام بعدی هر مشتری یا فرصت.</p></article>
            <article class="crm-audience reveal"><h3>مجموعه‌های متکی به Excel</h3><p>برای جایگزین‌کردن پیگیری‌های پراکنده با پرونده مشترک و قابل‌جست‌وجو.</p></article>
            <article class="crm-audience reveal"><h3>شرکت‌های واردات و صادرات</h3><p>برای نگهداری ارتباطات تجاری و هماهنگی بهتر درخواست‌های حمل مشتریان.</p></article>
            <article class="crm-audience reveal"><h3>مدیران فروش و عملیات</h3><p>برای داشتن دید مشترک از مشتری، مذاکره، تعهدات و مرحله اجرای خدمت.</p></article>
        </div>
    </div>
</section>

<section class="section soft" aria-labelledby="crm-faq-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">سؤالات متداول</span><h2 class="section-title" id="crm-faq-title">سؤالات متداول درباره<br><span>نرم‌افزار CRM حمل‌ونقل</span></h2></div>
        <p class="crm-faq-intro reveal">پاسخ پرسش‌های رایج شرکت‌های حمل‌ونقل و لجستیک درباره کاربرد CRM تخصصی سپند و ارتباط آن با سایر بخش‌های نرم‌افزار.</p>
        <div class="faq">
            @foreach($faqs as $faq)
                <details class="reveal"><summary>{{ $faq['question'] }}</summary><p>{{ $faq['answer'] }}</p></details>
            @endforeach
        </div>
    </div>
</section>

<section class="cta-wrap"><div class="container"><div class="cta reveal"><div class="cta-copy"><h2>CRM سپند را در فرایند واقعی شرکت خود ببینید</h2><p>در جلسه دمو، مسیر ثبت مشتری، پیگیری فرصت فروش و اتصال اطلاعات به Booking و عملیات حمل را متناسب با نیاز تیم شما بررسی می‌کنیم.</p></div><div class="cta-action"><a class="btn" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="crm_bottom_consultation">درخواست دموی نرم‌افزار CRM</a></div></div></div></section>
@endsection
