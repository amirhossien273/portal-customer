@extends('layouts.marketing')

@php
    $scenario = [
        [
            'title' => 'پیشنهاد ارسال شد',
            'text' => 'کارشناس پس از انتخاب نرخ خرید و آماده‌سازی Quotation، ارسال پیشنهاد را در پرونده ثبت می‌کند. اگر قاعده پیگیری پس از ارسال پیشنهاد برای شرکت فعال باشد، سپند یک تسک با موعد دو روز بعد ساعت ۹ برای مالک استعلام می‌سازد؛ در غیر این صورت مسئول و موعد از بخش تسک همان استعلام دستی ثبت می‌شوند.',
            'result' => 'پیشنهاد ارسال‌شده، مالک استعلام و تسک پیگیری به همان پرونده متصل می‌مانند.',
        ],
        [
            'title' => 'موعد پیگیری رسید',
            'text' => 'کارشناس در داشبورد «پیگیری‌های من» تسک امروز یا استعلام عقب‌افتاده را پیدا می‌کند. فهرست عقب‌افتاده کد استعلام، مشتری، مالک، مرحله، آخرین فعالیت، عنوان تسک و میزان تأخیر را نشان می‌دهد.',
            'result' => 'پرونده نیازمند اقدام از میان کارهای روزانه قابل تشخیص است.',
        ],
        [
            'title' => 'مشتری برای تصمیم‌گیری فرصت خواست',
            'text' => 'نتیجه تماس یا یادداشت در سابقه پرونده ثبت می‌شود و کارشناس برای اقدام بعدی یک تسک تازه با مسئول و موعد مشخص می‌سازد. این پاسخ مشتری در قالب‌های فعلی تریگر مستقلی برای تعیین خودکار موعد دلخواه بعدی ندارد.',
            'result' => 'همکار بعدی می‌تواند آخرین نتیجه و زمان تماس بعدی را از همان پرونده ادامه دهد.',
        ],
        [
            'title' => 'مشتری پیشنهاد را تأیید کرد',
            'text' => 'پس از پذیرفته‌شدن Quotation و اجرای تبدیل، Booking به استعلام، مشتری و پیشنهاد پذیرفته‌شده متصل می‌شود. سپند snapshot اطلاعات تجاری و محموله را نگه می‌دارد و Operation مرتبط را برای ادامه تیم عملیات ایجاد می‌کند.',
            'result' => 'تیم عملیات از Booking و Operation مرتبط ادامه می‌دهد؛ تبدیل پیش از پذیرش پیشنهاد مجاز نیست.',
        ],
    ];

    $automationRows = [
        ['event' => 'ثبت لید جدید', 'manual' => 'کارشناس لید و مالک آن را ثبت می‌کند.', 'automatic' => 'با قاعده فعال، یک تسک پیگیری یک ساعت بعد برای مالک لید یا ایجادکننده ساخته می‌شود.'],
        ['event' => 'ثبت استعلام جدید', 'manual' => 'کارشناس مشتری، مسیر، خدمت و مالک استعلام را تکمیل می‌کند.', 'automatic' => 'با قاعده فعال، یک تسک پیگیری یک ساعت بعد برای مالک استعلام ساخته می‌شود.'],
        ['event' => 'ثبت ارسال پیشنهاد نرخ', 'manual' => 'کارشناس ارسال Quotation را در پرونده ثبت می‌کند.', 'automatic' => 'با قاعده فعال، تسک پیگیری دو روز بعد ساعت ۹ برای مالک استعلام ساخته می‌شود.'],
        ['event' => 'مشتری برای تصمیم‌گیری فرصت می‌خواهد', 'manual' => 'نتیجه تماس ثبت و تسک بعدی با مسئول و موعد دلخواه ساخته می‌شود.', 'automatic' => 'قالب آماده مستقلی برای تعیین موعد جدید از متن پاسخ مشتری وجود ندارد؛ این مرحله دستی است.'],
        ['event' => 'موفق یا ناموفق‌شدن استعلام', 'manual' => 'کارشناس نتیجه نهایی استعلام را ثبت می‌کند.', 'automatic' => 'با قواعد فعال، تسک‌های پیگیری باز و خودکار مرتبط لغو می‌شوند.'],
    ];

    $faqs = $page['faqs'];
    $breadcrumbItems = [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'صفحه اصلی', 'item' => route('home')],
        ['@type' => 'ListItem', 'position' => 2, 'name' => 'راهکارها', 'item' => route('solutions.index')],
        ['@type' => 'ListItem', 'position' => 3, 'name' => 'پیگیری استعلام و پیشنهاد قیمت حمل', 'item' => $canonical],
    ];
@endphp

@push('head')
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'WebPage',
            '@id' => $canonical.'#webpage',
            'url' => $canonical,
            'name' => $title,
            'description' => $description,
            'inLanguage' => 'fa-IR',
            'dateModified' => config('marketing.content_last_modified'),
            'breadcrumb' => ['@id' => $canonical.'#breadcrumb'],
            'mainEntity' => [['@id' => $canonical.'#scenario'], ['@id' => $canonical.'#faq']],
        ],
        ['@type' => 'BreadcrumbList', '@id' => $canonical.'#breadcrumb', 'itemListElement' => $breadcrumbItems],
        [
            '@type' => 'HowTo',
            '@id' => $canonical.'#scenario',
            'name' => 'پیگیری پیشنهاد قیمت حمل از ارسال تا Booking',
            'step' => array_map(static fn (array $step, int $index): array => [
                '@type' => 'HowToStep',
                'position' => $index + 1,
                'name' => $step['title'],
                'text' => $step['text'].' '.$step['result'],
            ], $scenario, array_keys($scenario)),
        ],
        [
            '@type' => 'FAQPage',
            '@id' => $canonical.'#faq',
            'mainEntity' => array_map(static fn (array $faq): array => [
                '@type' => 'Question',
                'name' => $faq['question'],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['answer']],
            ], $faqs),
        ],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endpush

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/marketing-sales-follow-up.css') }}?v=20261122-1">
@endpush

@section('content')
<section class="page-hero sales-follow-hero">
    <div class="container hero-inner">
        <div class="hero-copy reveal">
            <nav class="breadcrumb" aria-label="مسیر صفحه"><a href="{{ route('home') }}">صفحه اصلی</a><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg><a href="{{ route('solutions.index') }}">راهکارها</a><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg><span>پیگیری استعلام حمل</span></nav>
            <span class="sales-eyebrow">نرم‌افزار پیگیری استعلام حمل‌ونقل</span>
            <h1>پیگیری استعلام‌های حمل و پیشنهادهای قیمت در سپند</h1>
            <p>دیروز برای مشتری نرخ حمل نینگبو به بندرعباس را فرستادید. امروز هنوز جوابی نیامده و معلوم نیست چه کسی باید پیگیری کند. اگر کارشناس مسئول در دسترس نباشد، همکارش باید بداند آخرین بار چه اقدامی انجام شده و قدم بعدی چیست.</p>
            <p>در سپند، پیشنهاد قیمت، سابقه تماس، مسئول استعلام و موعد پیگیری در یک پرونده به هم مرتبط‌اند. کارشناس می‌تواند استعلام‌های نیازمند اقدام را پیدا کند و مدیر فروش می‌تواند ببیند کدام پیگیری‌ها عقب افتاده‌اند.</p>
            <div class="hero-actions"><a class="btn btn-primary" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="freight_sales_hero_demo">درخواست دموی پیگیری فروش</a><a class="btn btn-outline" href="#educational-scenario">مشاهده سناریوی نینگبو تا بندرعباس</a></div>
        </div>
        <aside class="sales-hero-card reveal" aria-label="خروجی قابل مشاهده نرم‌افزار پیگیری استعلام حمل‌ونقل">
            <span>برای هر پیشنهاد ارسال‌شده</span>
            <ul><li><strong>آخرین اقدام</strong><small>چه تماس یا فعالیتی ثبت شده است؟</small></li><li><strong>مسئول</strong><small>پیگیری بر عهده چه کسی است؟</small></li><li><strong>موعد بعدی</strong><small>اقدام بعدی چه زمانی است؟</small></li><li><strong>وضعیت</strong><small>امروز، آینده یا عقب‌افتاده؟</small></li></ul>
        </aside>
    </div>
</section>

<section class="section sales-scenario" id="educational-scenario" aria-labelledby="educational-scenario-title"><div class="container" id="sales-solutions">
    <header class="section-head reveal"><span class="section-label">سناریوی چهارمرحله‌ای</span><h2 class="section-title" id="educational-scenario-title">پیگیری پیشنهاد نینگبو به بندرعباس؛ از ارسال تا Booking</h2><p class="section-sub">این سناریو رفتار قابل مشاهده نسخه فعلی را توضیح می‌دهد و مطالعه موردی یک مشتری واقعی نیست.</p></header>
    <div class="sales-scenario-layout">
        <ol class="sales-scenario-list">
            @foreach($scenario as $step)
                <li class="reveal"><span>{{ $loop->iteration }}</span><div><h3>{{ $step['title'] }}</h3><p>{{ $step['text'] }}</p>
                    @if($loop->iteration === 1)<p class="sales-inline-links">برای مرحله قبل از ارسال، <a href="{{ route('solutions.platform.show', ['solution' => 'rate-management']) }}">انتخاب نرخ خرید</a> و <a href="{{ route('site.modules.show', ['module' => 'pricing-sales']) }}">ساخت و ارسال پیشنهاد قیمت</a> را ببینید.</p>@endif
                    @if($loop->iteration === 3)<p class="sales-inline-links">نتیجه تماس در زمینه <a href="{{ route('site.modules.show', ['module' => 'crm']) }}">پرونده مشتری و سابقه ارتباط</a> قابل مراجعه می‌ماند.</p>@endif
                    @if($loop->iteration === 4)<p class="sales-inline-links">تیم عملیات از <a href="{{ route('site.modules.show', ['module' => 'booking']) }}">Booking و اطلاعات منتقل‌شده</a> ادامه می‌دهد.</p>@endif
                    <strong>{{ $step['result'] }}</strong></div></li>
            @endforeach
        </ol>
        <div class="sales-scenario-proof reveal">
            <figure><a href="{{ asset('assets/images/marketing/modules/screenshots/crm-overdue-inquiries.webp') }}" target="_blank" rel="noopener" aria-label="مشاهده فهرست استعلام‌های عقب‌افتاده در اندازه کامل"><img src="{{ asset('assets/images/marketing/modules/screenshots/crm-overdue-inquiries.webp') }}" alt="فهرست واقعی استعلام‌های دارای تسک عقب‌افتاده با مالک، آخرین فعالیت، موعد و میزان تأخیر پیگیری در سپند" width="1600" height="879" loading="eager"></a><figcaption><strong>نمای واقعی محصول:</strong> فهرست استعلام‌های دارای تسک عقب‌افتاده، مالک پرونده، آخرین فعالیت و موعد هر تسک را نشان می‌دهد.</figcaption></figure>
            <dl class="sales-three-answers">
                <div><dt>آخرین اقدام چه بوده؟</dt><dd>آخرین فعالیت و تسک‌های ثبت‌شده در استعلام قابل مراجعه‌اند.</dd></div>
                <div><dt>مسئول پیگیری کیست؟</dt><dd>مالک استعلام و مسئول هر تسک در فهرست و جزئیات پرونده دیده می‌شوند.</dd></div>
                <div><dt>اقدام بعدی چه زمانی است؟</dt><dd>تاریخ و ساعت تسک فعال مشخص است؛ عبور از موعد، آن را در فهرست عقب‌افتاده قرار می‌دهد.</dd></div>
            </dl>
        </div>
    </div>
    <div class="sales-scenario-cta reveal"><a class="btn btn-primary" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="freight_sales_scenario_demo">پیگیری یک پیشنهاد قیمت را در سپند ببینید</a></div>
</div></section>

<section class="section soft sales-follow-mode" id="manual-and-automatic" aria-labelledby="manual-and-automatic-title"><div class="container">
    <header class="section-head reveal"><span class="section-label">ثبت دستی یا ساخت خودکار</span><h2 class="section-title" id="manual-and-automatic-title">قاعده تسک را می‌سازد؛ نتیجه تماس را کارشناس ثبت می‌کند</h2><p class="section-sub">قواعد زیر در نسخه فعلی وجود دارند، اما اثرشان به فعال‌بودن قاعده برای شرکت وابسته است. جزئیات فعال‌سازی در <a href="{{ route('site.modules.show', ['module' => 'automatic-tasks']) }}">ماژول قواعد ایجاد تسک</a> توضیح داده شده است.</p></header>
    <div class="sales-rule-table reveal" role="region" aria-label="تفاوت اقدام کارشناس و رفتار قواعد تسک خودکار" tabindex="0"><table><thead><tr><th>رویداد</th><th>اقدام کارشناس</th><th>رفتار سپند با قاعده فعال</th></tr></thead><tbody>@foreach($automationRows as $row)<tr><th>{{ $row['event'] }}</th><td>{{ $row['manual'] }}</td><td>{{ $row['automatic'] }}</td></tr>@endforeach</tbody></table></div>
    <p class="sales-note reveal">یادآوری پیگیری مشتریان بر پایه موعد تسک انجام می‌شود. استخراج خودکار پاسخ مشتری از تماس یا انتخاب خودکار موعد بعدی، در نسخه بررسی‌شده ادعا نمی‌شود.</p>
</div></section>

<section class="section sales-evidence" id="product-evidence" aria-labelledby="product-evidence-title"><div class="container">
    <header class="section-head reveal"><span class="section-label">شواهد واقعی محصول</span><h2 class="section-title" id="product-evidence-title">استعلام نیازمند اقدام و قواعد ساخت تسک کجا دیده می‌شوند؟</h2><p class="section-sub">این تصاویر از محصول‌اند؛ اعداد آن‌ها وضعیت همان محیط در زمان ثبت تصویر است و نتیجه تضمین‌شده برای شرکت دیگری نیست.</p></header>
    <div class="sales-evidence-grid">
        <figure class="sales-evidence-card reveal"><a href="{{ asset('assets/images/marketing/product-showcase/desktop-dashboard.webp') }}" target="_blank" rel="noopener"><img src="{{ asset('assets/images/marketing/product-showcase/desktop-dashboard.webp') }}" alt="داشبورد واقعی پیگیری‌های من با استعلام عقب‌افتاده، بدون اقدام بعدی، کارهای امروز و پیگیری آینده" width="1600" height="799" loading="lazy"></a><figcaption><strong>پیگیری‌های من</strong><span>چهار گروه عقب‌افتاده، بدون اقدام بعدی، امروز و آینده برای مدیریت استعلام‌های فروش حمل‌ونقل.</span></figcaption></figure>
        <figure class="sales-evidence-card reveal"><a href="{{ asset('assets/images/marketing/modules/screenshots/automatic-task-rules.webp') }}" target="_blank" rel="noopener"><img src="{{ asset('assets/images/marketing/modules/screenshots/automatic-task-rules.webp') }}" alt="نمای واقعی قواعد ساخت تسک خودکار با رویداد شروع، وضعیت شرکت و آخرین اجرا در سپند" width="1600" height="851" loading="lazy"></a><figcaption><strong>قواعد ساخت تسک خودکار</strong><span>رویداد شروع، نوع تسک ساخته‌شده، وضعیت فعال یا غیرفعال برای شرکت و نتیجه آخرین اجرا.</span></figcaption></figure>
    </div>
</div></section>

<section class="section soft sales-booking" id="booking-continuity" aria-labelledby="booking-continuity-title"><div class="container sales-booking-layout">
    <div class="reveal"><span class="section-label">تحویل فروش به عملیات</span><h2 class="section-title" id="booking-continuity-title">بعد از تأیید مشتری، چه چیزی به Booking می‌رود؟</h2><p>پذیرش پیشنهاد شرط تبدیل است. پس از اجرای تبدیل، Booking با وضعیت عملیاتی ساخته و Operation مرتبط ایجاد می‌شود. داده‌ها به‌صورت snapshot نگهداری می‌شوند تا تغییر بعدی رکوردهای فروش، مبنای اولیه Booking را مبهم نکند.</p><a class="btn btn-outline" href="{{ route('site.modules.show', ['module' => 'booking']) }}">مشاهده ادامه کار در Booking</a></div>
    <ul class="sales-booking-data reveal">
        <li><strong>مشتری و مرجع استعلام</strong><span>شناسه و اطلاعات ثبت‌شده مشتری، کد استعلام و ارتباط Booking با استعلام.</span></li>
        <li><strong>خدمت، مسیر و شرایط</strong><span>نوع خدمت، روش حمل، تجهیزات، مسیرها، Incoterm و شرایط پرداخت ثبت‌شده.</span></li>
        <li><strong>محموله</strong><span>اقلام، نوع کالا، HS Code، وزن، تعداد، حجم و نیازهای انبار یا ترخیص.</span></li>
        <li><strong>پیشنهاد پذیرفته‌شده</strong><span>کد و تأمین‌کننده، اعتبار، Transit Time، Free Time، اقلام هزینه و جمع هر ارز.</span></li>
    </ul>
</div></section>

<section class="section sales-results" id="verifiable-results" aria-labelledby="verifiable-results-title"><div class="container">
    <header class="section-head reveal"><span class="section-label">خروجی قابل بررسی</span><h2 class="section-title" id="verifiable-results-title">پیگیری پیشنهاد قیمت حمل را با این نشانه‌ها بسنجید</h2><p class="section-sub">این موارد معیار ارزیابی فرایندند و وجود گزارش آماده با همین نام‌ها در محصول ادعا نمی‌شود.</p></header>
    <div class="sales-result-grid"><article class="reveal"><strong>آخرین اقدام روشن</strong><p>سابقه فعالیت و نتیجه ثبت‌شده برای ادامه کار قابل مراجعه است.</p></article><article class="reveal"><strong>مسئول مشخص</strong><p>مالک استعلام و مسئول تسک در جزئیات پرونده دیده می‌شوند.</p></article><article class="reveal"><strong>موعد بعدی مشخص</strong><p>تاریخ و ساعت تسک فعال مبنای فهرست امروز، آینده یا عقب‌افتاده است.</p></article><article class="reveal"><strong>تحویل قابل ردیابی</strong><p>Booking به استعلام و پیشنهاد پذیرفته‌شده متصل می‌ماند.</p></article></div>
    <div class="sales-measurement reveal"><div><span>شاخص‌های پیشنهادی</span><h3>قبل و بعد از استقرار چه چیزی را اندازه بگیریم؟</h3></div><ul><li>استعلام باز بدون اقدام بعدی</li><li>پیگیری عقب‌افتاده</li><li>فاصله ارسال پیشنهاد تا نخستین پیگیری</li><li>استعلام دارای مسئول و موعد روشن</li></ul><p>بهبود عددی یا افزایش قطعی فروش بدون خط مبنا و داده واقعی شرکت وعده داده نمی‌شود.</p></div>
</div></section>

<section class="section soft" id="sales-faq" aria-labelledby="sales-faq-title"><div class="container">
    <header class="section-head reveal"><span class="section-label">پرسش‌های خریداران</span><h2 class="section-title" id="sales-faq-title">سؤال‌های رایج درباره نرم‌افزار پیگیری استعلام حمل‌ونقل</h2></header>
    <div class="faq">@foreach($faqs as $faq)<details class="reveal"><summary>{{ $faq['question'] }}</summary><p>{{ $faq['answer'] }}</p></details>@endforeach</div>
</div></section>

<section class="cta-wrap"><div class="container"><div class="cta reveal"><div class="cta-copy"><h2>پیگیری یک پیشنهاد قیمت را در سپند ببینید</h2><p>در دمو، ارسال پیشنهاد، ثبت نتیجه تماس، تعیین موعد بعدی و تحویل پیشنهاد پذیرفته‌شده به Booking را با یک استعلام نمونه بررسی کنید.</p></div><div class="cta-action"><a class="btn" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="freight_sales_bottom_demo">درخواست دموی پیگیری استعلام</a></div></div></div></section>
@endsection
