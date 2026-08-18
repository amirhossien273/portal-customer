@extends('layouts.marketing')

@php
    $title = 'مقایسه نرم‌افزارهای مدیریت حمل‌ونقل بین‌المللی | سپند';
    $description = 'مقایسه نرم‌افزار مدیریت حمل‌ونقل سپند با انواع راهکارها از نظر CRM، Booking، عملیات، اسناد، مالی، گزارش سود، پرتال مشتری و یکپارچگی اطلاعات.';
    $canonical = route('compare.sepand-other-transport-software');
    $dateModified = '2026-08-18';
    $comparisons = config('site_comparisons.pages');
    $workflowSteps = [
        ['label' => 'Lead / Customer', 'title' => 'سرنخ و مشتری', 'description' => 'اطلاعات سرنخ، مشتری، سوابق ارتباط و مسئول پیگیری در CRM شرکت حمل‌ونقل ثبت می‌شود.', 'href' => route('site.modules.show', ['module' => 'crm'])],
        ['label' => 'Inquiry', 'title' => 'استعلام', 'description' => 'مسیر، روش حمل، محموله و نیاز مشتری در استعلام ساختاریافته قرار می‌گیرد.', 'href' => route('site.modules.show', ['module' => 'pricing-sales'])],
        ['label' => 'Quotation', 'title' => 'پیشنهاد قیمت', 'description' => 'نرخ خرید، مبلغ فروش و اطلاعات پیشنهاد برای تصمیم مشتری و ادامه فرایند آماده می‌شود.', 'href' => route('site.modules.show', ['module' => 'pricing-sales'])],
        ['label' => 'Booking', 'title' => 'رزرو حمل', 'description' => 'پس از تأیید پیشنهاد، اطلاعات پایه بدون تشکیل پرونده مستقل وارد Booking می‌شود.', 'href' => route('site.modules.show', ['module' => 'booking'])],
        ['label' => 'Operation', 'title' => 'عملیات حمل', 'description' => 'رویدادها، وضعیت محموله، مسئول هر اقدام و موارد متوقف‌شده در پرونده عملیاتی پیگیری می‌شوند.', 'href' => route('site.modules.show', ['module' => 'transport-operations'])],
        ['label' => 'Documents', 'title' => 'اسناد', 'description' => 'نسخه، وضعیت بررسی و مهلت اسناد در ارتباط با Booking و همان پرونده حمل مدیریت می‌شود.', 'href' => route('site.modules.show', ['module' => 'document-management'])],
        ['label' => 'Financial', 'title' => 'مالی', 'description' => 'درآمد، هزینه، دریافت و پرداخت هر پرونده به تفکیک ارز ثبت و کنترل می‌شود.', 'href' => route('site.modules.show', ['module' => 'finance-accounting'])],
        ['label' => 'Profit Report', 'title' => 'گزارش سود', 'description' => 'درآمد و هزینه واقعی کنار هم قرار می‌گیرند تا سود پرونده برای تصمیم‌گیری قابل مشاهده باشد.', 'href' => route('site.modules.show', ['module' => 'finance-accounting'])],
    ];
    $faqs = [
        [
            'question' => 'بهترین نرم‌افزار مدیریت حمل‌ونقل بین‌المللی چه ویژگی‌هایی دارد؟',
            'answer' => 'گزینه مناسب باید CRM تخصصی، استعلام و نرخ‌دهی، Booking، عملیات چندروش حمل، اسناد، مالی چندارزی، سود پرونده، سطح دسترسی و گزارش‌گیری را متناسب با فرایند واقعی شرکت پوشش دهد.',
        ],
        [
            'question' => 'سپند چه تفاوتی با CRM عمومی دارد؟',
            'answer' => 'CRM عمومی بر ارتباطات و قیف فروش تمرکز دارد. سپند CRM اطلاعات مشتری و استعلام را به نرخ‌دهی، Booking، عملیات، اسناد و مالی حمل متصل می‌کند.',
        ],
        [
            'question' => 'سپند چه تفاوتی با نرم‌افزار حسابداری حمل‌ونقل دارد؟',
            'answer' => 'نرم‌افزارهای حسابداری‌محور معمولاً از ثبت مالی شروع می‌کنند. نرم‌افزار حمل‌ونقل سپند فروش، Booking و عملیات را نیز پوشش می‌دهد و درآمد و هزینه را به پرونده حمل مرتبط می‌کند.',
        ],
        [
            'question' => 'آیا سپند برای Freight Forwarder مناسب است؟',
            'answer' => 'بله. سپند برای شرکت‌های فورواردری و حمل‌ونقل بین‌المللی طراحی شده و فرایند مشتری، نرخ، Booking، عملیات، اسناد و مالی پرونده را پوشش می‌دهد.',
        ],
        [
            'question' => 'آیا سپند حمل هوایی، دریایی، زمینی و ریلی را مدیریت می‌کند؟',
            'answer' => 'بله. برای هر چهار روش حمل صفحه و فرایند تخصصی وجود دارد و اطلاعات آن‌ها به پرونده مشتری، عملیات، اسناد و مالی مرتبط می‌شود.',
        ],
        [
            'question' => 'آیا اطلاعات نرم‌افزار قبلی یا Excel قابل انتقال است؟',
            'answer' => 'انتقال خودکار و عمومی برای هر ساختار داده در اطلاعات فعلی محصول تأیید نشده است. قالب فایل‌ها، کیفیت داده و دامنه Migration باید با نمونه واقعی پیش از قرارداد بررسی شود.',
        ],
        [
            'question' => 'آیا سپند سیستم مالی دارد؟',
            'answer' => 'بله. ماژول مالی و حسابداری چندارزی، درآمد، هزینه، دریافت، پرداخت، مطالبات، تعهدات و سود هر پرونده حمل را مدیریت می‌کند.',
        ],
        [
            'question' => 'آیا امکان اتصال سپند به سیستم‌های دیگر وجود دارد؟',
            'answer' => 'اتصال داخلی ماژول‌های سپند تأییدشده است؛ اما API یا Integration با هر سامانه بیرونی باید بر اساس سیستم مقصد، داده‌های موردنیاز و مستندات فنی جداگانه تأیید شود.',
        ],
        [
            'question' => 'آیا سپند برای شرکت‌های کوچک هم مناسب است؟',
            'answer' => 'اگر شرکت کوچک چند مرحله فروش، عملیات و مالی یا چند روش حمل دارد، سپند می‌تواند قابل بررسی باشد. برای نیاز صرفاً حسابداری ساده یا فقط مدیریت ناوگان، راهکار تخصصی محدودتر ممکن است مناسب‌تر باشد.',
        ],
    ];
@endphp

@push('head')
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'WebPage',
            '@id' => $canonical.'#webpage',
            'name' => $title,
            'description' => $description,
            'url' => $canonical,
            'inLanguage' => 'fa-IR',
            'dateModified' => $dateModified,
            'isPartOf' => ['@id' => route('home').'#website'],
            'about' => [
                ['@type' => 'SoftwareApplication', 'name' => 'نرم‌افزار مدیریت حمل‌ونقل سپند', 'url' => route('home')],
                ['@type' => 'Thing', 'name' => 'مقایسه نرم‌افزارهای مدیریت حمل‌ونقل بین‌المللی'],
            ],
            'significantLink' => [
                route('compare.index'),
                route('compare.sepand-vs-royan'),
                route('compare.sepand-vs-saba'),
                route('compare.best-transport-software'),
                route('modules'),
                route('site.modules.show', ['module' => 'crm']),
                route('site.modules.show', ['module' => 'transport-operations']),
                route('site.modules.show', ['module' => 'document-management']),
                route('site.modules.show', ['module' => 'finance-accounting']),
                route('site.modules.show', ['module' => 'customer-portal-tracking']),
                route('consultation.create'),
            ],
        ],
        [
            '@type' => 'BreadcrumbList',
            '@id' => $canonical.'#breadcrumb',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'صفحه اصلی', 'item' => route('home')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'مرکز مقایسه', 'item' => route('compare.index')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => 'سپند در برابر سایر نرم‌افزارهای حمل‌ونقل', 'item' => $canonical],
            ],
        ],
        [
            '@type' => 'ItemList',
            '@id' => $canonical.'#shipment-workflow',
            'name' => 'مراحل مدیریت پرونده حمل در نرم‌افزار سپند',
            'itemListElement' => array_map(static fn (array $step, int $index): array => [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'name' => $step['label'].' — '.$step['title'],
                'description' => $step['description'],
                'url' => $canonical.'#workflow-step-'.($index + 1),
            ], $workflowSteps, array_keys($workflowSteps)),
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
<link rel="stylesheet" href="{{ asset('assets/css/marketing-comparison.css') }}?v=20260818-1">
@endpush

@section('content')
<section class="page-hero comparison-hero">
    <div class="container hero-inner">
        <div class="hero-copy reveal">
            <div class="breadcrumb"><a href="{{ route('home') }}">صفحه اصلی</a><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg><a href="{{ route('compare.index') }}">مرکز مقایسه</a><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg><span>سایر نرم‌افزارها</span></div>
            <h1>مقایسه نرم‌افزارهای مدیریت حمل‌ونقل بین‌المللی؛<br><span>سپند چه تفاوتی دارد؟</span></h1>
            <p>برای مقایسه نرم‌افزارهای مدیریت حمل‌ونقل بین‌المللی نباید فقط فهرست امکانات یا قیمت را دید. انتخاب درست زمانی انجام می‌شود که CRM تخصصی، استعلام و نرخ‌دهی، Booking، عملیات حمل، مدیریت اسناد، مالی چندارزی، گزارش سود پرونده، پرتال مشتری و یکپارچگی اطلاعات با فرایند واقعی شرکت سنجیده شوند. همچنین باید سطح دسترسی، شیوه استقرار، امکان انتقال داده و کیفیت پشتیبانی روشن باشد. بهترین نرم‌افزار حمل‌ونقل بین‌المللی برای هر شرکت گزینه‌ای است که سناریوی واقعی آن مجموعه را با کمترین ورود دوباره اطلاعات و ابهام عملیاتی پوشش دهد.</p>
            <div class="hero-actions"><a class="btn btn-primary" href="#comparison-table">مشاهده جدول مقایسه</a><a class="btn btn-outline" href="#selection-criteria">معیارهای انتخاب نرم‌افزار</a></div>
        </div>
        <div class="hero-art comparison-hero-art reveal" role="img" aria-label="مقایسه نرم‌افزار مدیریت حمل‌ونقل سپند با دسته‌های مختلف نرم‌افزار حمل‌ونقل">
            <div class="comparison-visual">
                <div class="comparison-visual-option is-product"><span>راهکار تخصصی فورواردری</span><strong>سپند CRM</strong><small>CRM، فروش، عملیات، اسناد و مالی پرونده</small></div>
                <div class="comparison-visual-vs">در برابر</div>
                <div class="comparison-visual-option is-market"><span>دسته‌های دیگر</span><strong>حسابداری، CRM،<br>عملیات یا ناوگان</strong><small>هر دسته با هدف و دامنه متفاوت</small></div>
            </div>
        </div>
    </div>
</section>

<section class="section comparison-criteria" id="selection-criteria" aria-labelledby="selection-criteria-title">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label">چک‌لیست ارزیابی</span>
            <h2 class="section-title" id="selection-criteria-title">برای مقایسه نرم‌افزارهای مدیریت حمل‌ونقل باید چه معیارهایی را بررسی کنیم؟</h2>
            <p class="section-sub">هر معیار را با داده و سناریوی خودتان در دمو بررسی کنید؛ وجود یک عنوان در بروشور لزوماً به معنای پوشش کامل فرایند شرکت شما نیست.</p>
        </div>
        <div class="criteria-grid">
            <article class="criteria-card reveal">
                <span class="criteria-number">۰۱</span>
                <h3>فروش و تبدیل درخواست به پرونده</h3>
                <ul>
                    <li><a href="{{ route('site.modules.show', ['module' => 'crm']) }}">CRM تخصصی شرکت حمل‌ونقل</a> برای لید، مشتری و پیگیری</li>
                    <li><a href="{{ route('site.modules.show', ['module' => 'pricing-sales']) }}">مدیریت استعلام، نرخ و پیشنهاد قیمت</a></li>
                    <li><a href="{{ route('site.modules.show', ['module' => 'booking']) }}">Booking</a> و انتقال اطلاعات فروش به اجرای حمل</li>
                </ul>
            </article>
            <article class="criteria-card reveal">
                <span class="criteria-number">۰۲</span>
                <h3>روش حمل، عملیات و اسناد</h3>
                <ul>
                    <li><a href="{{ route('site.transport-modes.show', ['mode' => 'air']) }}">حمل هوایی</a>، <a href="{{ route('site.transport-modes.show', ['mode' => 'sea']) }}">دریایی</a>، <a href="{{ route('site.transport-modes.show', ['mode' => 'road']) }}">زمینی</a> و <a href="{{ route('site.transport-modes.show', ['mode' => 'rail']) }}">ریلی</a></li>
                    <li><a href="{{ route('site.modules.show', ['module' => 'transport-operations']) }}">عملیات حمل</a>، رویدادها، مسئولیت و موارد متوقف‌شده</li>
                    <li><a href="{{ route('site.modules.show', ['module' => 'document-management']) }}">مدیریت اسناد حمل</a>، نسخه، تأیید و مهلت</li>
                </ul>
            </article>
            <article class="criteria-card reveal">
                <span class="criteria-number">۰۳</span>
                <h3>مالی و تصمیم‌گیری مدیریتی</h3>
                <ul>
                    <li><a href="{{ route('site.modules.show', ['module' => 'finance-accounting']) }}">حسابداری و مالی چندارزی</a></li>
                    <li>محاسبه درآمد، هزینه و سود هر پرونده حمل</li>
                    <li>گزارش‌گیری عملیاتی، مالی و پیگیری متناسب با سطح دسترسی</li>
                </ul>
            </article>
            <article class="criteria-card reveal">
                <span class="criteria-number">۰۴</span>
                <h3>فناوری، حاکمیت و استقرار</h3>
                <ul>
                    <li><a href="{{ route('site.modules.show', ['module' => 'customer-portal-tracking']) }}">Customer Portal</a>، سطح دسترسی کاربران و تاریخچه فعالیت</li>
                    <li>API و Integration موردنیاز، امنیت، دوره Backup و مسئول بازیابی</li>
                    <li>Migration داده، آموزش، پشتیبانی، سفارشی‌سازی و هزینه کل اجرا</li>
                    <li>مدل Cloud یا On-Premise؛ برای سپند استقرار داخلی تأیید شده و مدل‌های دیگر باید در پیشنهاد رسمی بررسی شوند</li>
                </ul>
            </article>
        </div>
        <p class="verification-note reveal"><strong>موارد نیازمند تأیید فنی:</strong> اتصال به سامانه‌های بیرونی، انتقال خودکار داده، سیاست Backup، مدل Cloud، دامنه آموزش و سطح سفارشی‌سازی برای همه پروژه‌ها یکسان فرض نشده‌اند و باید در دمو، مستند فنی یا قرارداد همان استقرار تأیید شوند.</p>
    </div>
</section>

<section class="section soft" id="comparison-table" aria-labelledby="comparison-table-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">جدول تصمیم‌گیری</span><h2 class="section-title" id="comparison-table-title">مقایسه دسته‌های مختلف<br><span>نرم‌افزار حمل‌ونقل</span></h2><p class="section-sub">این جدول تفاوت هدف و دامنه رایج هر دسته را نشان می‌دهد، نه حکم قطعی درباره تمام محصولات بازار. وضعیت هر قابلیت را در نسخه، پلن و قرارداد گزینه نهایی تأیید کنید.</p></div>
        <div class="comparison-table-wrap reveal">
            <table class="comparison-table">
                <caption>مقایسه نرم‌افزار مدیریت حمل‌ونقل سپند با نرم‌افزارهای حسابداری‌محور، CRM عمومی، عملیات حمل و مدیریت ناوگان</caption>
                <thead><tr><th scope="col">معیار</th><th scope="col">نرم‌افزار سپند</th><th scope="col">حسابداری‌محور</th><th scope="col">CRM عمومی</th><th scope="col">عملیات حمل</th><th scope="col">مدیریت ناوگان</th></tr></thead>
                <tbody>
                    <tr><th scope="row">تمرکز اصلی</th><td class="is-strong">حمل بین‌المللی و فورواردری</td><td>ثبت مالی و حسابداری</td><td>فروش و ارتباط با مشتری</td><td>اجرای عملیات حمل</td><td>خودرو، راننده و سفر ناوگان</td></tr>
                    <tr><th scope="row">CRM تخصصی حمل</th><td class="is-strong">تخصصی</td><td>معمولاً محدود</td><td>عمومی؛ نیازمند سفارشی‌سازی</td><td>محدود یا وابسته به راهکار</td><td>معمولاً ندارد</td></tr>
                    <tr><th scope="row">استعلام، نرخ و Booking</th><td class="is-strong">دارد</td><td>محدود یا نیازمند Integration</td><td>نیازمند Integration</td><td>در راهکارهای تخصصی دارد</td><td>معمولاً ندارد</td></tr>
                    <tr><th scope="row">حمل هوایی، دریایی، زمینی و ریلی</th><td class="is-strong">دارد</td><td>اطلاعات مالی؛ عملیات محدود</td><td>نیازمند توسعه یا اتصال</td><td>پوشش روش‌ها متفاوت است</td><td>عمدتاً ناوگان زمینی</td></tr>
                    <tr><th scope="row">عملیات و رویدادهای پرونده</th><td class="is-strong">تخصصی</td><td>محدود</td><td>نیازمند Integration</td><td>تخصصی</td><td>تخصصی برای سفر و ناوگان</td></tr>
                    <tr><th scope="row">مدیریت اسناد حمل</th><td class="is-strong">دارد</td><td>پیوست یا آرشیو محدود</td><td>نیازمند Integration</td><td>دامنه اسناد متفاوت است</td><td>معمولاً محدود به اسناد سفر</td></tr>
                    <tr><th scope="row">مالی و حسابداری چندارزی</th><td class="is-strong">دارد</td><td>تخصصی؛ چندارزی بودن تأیید شود</td><td>نیازمند Integration</td><td>داخلی یا نیازمند اتصال مالی</td><td>معمولاً محدود یا نیازمند اتصال</td></tr>
                    <tr><th scope="row">محاسبه سود هر پرونده</th><td class="is-strong">دارد</td><td>دارد؛ اتصال به عملیات تأیید شود</td><td>نیازمند Integration</td><td>دامنه هزینه و درآمد تأیید شود</td><td>سود سفر در برخی راهکارها</td></tr>
                    <tr><th scope="row">Customer Portal</th><td class="is-strong">دارد</td><td>معمولاً محدود</td><td>پرتال فروش یا پشتیبانی</td><td>بسته به دامنه راهکار</td><td>پرتال راننده یا صاحب ناوگان</td></tr>
                    <tr><th scope="row">گردش کار و سطح دسترسی</th><td class="is-strong">دارد</td><td>سطح دسترسی مالی</td><td>گردش کار فروش</td><td>گردش کار عملیاتی</td><td>گردش کار ناوگان</td></tr>
                    <tr><th scope="row">API و اتصال بیرونی</th><td>موردبه‌مورد تأیید شود</td><td>نیازمند بررسی مستندات</td><td>بسته به پلن و مستندات</td><td>نیازمند بررسی مستندات</td><td>نیازمند بررسی مستندات</td></tr>
                    <tr><th scope="row">استقرار Cloud / On-Premise</th><td>استقرار داخلی تأییدشده؛ مدل دیگر بررسی شود</td><td>مدل استقرار تأیید شود</td><td>مدل استقرار و نسخه محصول تأیید شود</td><td>مدل استقرار متفاوت است</td><td>مدل استقرار متفاوت است</td></tr>
                    <tr><th scope="row">Migration، Backup، آموزش و پشتیبانی</th><td>دامنه در پیشنهاد اجرا تأیید شود</td><td>در قرارداد تأیید شود</td><td>در پلن خدمات تأیید شود</td><td>در قرارداد تأیید شود</td><td>در قرارداد تأیید شود</td></tr>
                </tbody>
            </table>
        </div>
        <p class="table-footnote reveal">عبارت‌هایی مانند «معمولاً» یا «نیازمند بررسی» برای پرهیز از ادعای قطعی درباره محصولات نامشخص استفاده شده‌اند. معیار نهایی، دموی سناریوی یکسان و پیشنهاد رسمی هر تأمین‌کننده است.</p>
    </div>
</section>

<section class="section category-differences" aria-label="تفاوت دسته‌های نرم‌افزار حمل‌ونقل">
    <div class="container">
        <div class="comparison-section-intro reveal"><span class="section-label">شناخت دسته‌های نرم‌افزار</span><p>پیش از مقایسه برندها باید مشخص شود هر محصول اساساً برای حل چه مسئله‌ای ساخته شده است.</p></div>
        <div class="category-difference-list">
            <article class="category-difference-card reveal">
                <span class="category-index">۰۱</span>
                <div><h2>تفاوت سپند با نرم‌افزارهای حسابداری حمل‌ونقل چیست؟</h2><p>نرم‌افزار حسابداری‌محور معمولاً بر ثبت سند، دریافت، پرداخت و گزارش مالی تمرکز دارد. نرم‌افزار مدیریت حمل‌ونقل سپند از CRM و استعلام آغاز می‌کند و Booking، عملیات و اسناد را نیز تا ثبت درآمد و هزینه پرونده ادامه می‌دهد. اگر محصول حسابداری دیگری همین فرایندها را پوشش می‌دهد، اتصال واقعی آن‌ها را در دمو بررسی کنید؛ نام ماژول به‌تنهایی کافی نیست.</p></div>
            </article>
            <article class="category-difference-card reveal">
                <span class="category-index">۰۲</span>
                <div><h2>تفاوت سپند با CRMهای عمومی چیست؟</h2><p>CRM عمومی برای مدیریت تماس، فرصت فروش و فعالیت تیم ساخته می‌شود، اما مفاهیم مسیر، روش حمل، استعلام نرخ، Booking و پرونده عملیاتی را لزوماً به‌صورت تخصصی نمی‌شناسد. سپند CRM این اطلاعات را در زمینه شرکت فورواردری نگهداری می‌کند. در مقایسه، میزان سفارشی‌سازی و Integration موردنیاز CRM عمومی را هم در هزینه و زمان اجرا حساب کنید.</p></div>
            </article>
            <article class="category-difference-card reveal">
                <span class="category-index">۰۳</span>
                <div><h2>تفاوت سپند با نرم‌افزارهای مدیریت ناوگان چیست؟</h2><p>نرم‌افزار مدیریت ناوگان معمولاً بر خودرو، راننده، سفر، موقعیت، سوخت یا نگهداری تمرکز دارد. سپند اطلاعات خودرو و راننده را در عملیات حمل زمینی نگه می‌دارد، اما در اطلاعات فعلی محصول جایگزین سامانه تخصصی GPS، تلماتیک یا نگهداری ناوگان معرفی نشده است. شرکتی که فقط همین نیاز را دارد، باید راهکار ناوگان را جداگانه ارزیابی کند.</p></div>
            </article>
        </div>
    </div>
</section>

<section class="section soft workflow-section" id="shipment-workflow" aria-labelledby="shipment-workflow-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">سناریوی واقعی</span><h2 class="section-title" id="shipment-workflow-title">یک پرونده حمل در سپند از استعلام تا محاسبه سود چگونه مدیریت می‌شود؟</h2><p class="section-sub workflow-formula" dir="ltr">Lead / Customer → Inquiry → Quotation → Booking → Operation → Documents → Financial → Profit Report</p></div>
        <ol class="workflow-grid">
            @foreach($workflowSteps as $index => $step)
                <li class="workflow-card reveal" id="workflow-step-{{ $index + 1 }}">
                    <span class="workflow-number">{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</span>
                    <small dir="ltr">{{ $step['label'] }}</small>
                    <h3><a href="{{ $step['href'] }}">{{ $step['title'] }}</a></h3>
                    <p>{{ $step['description'] }}</p>
                </li>
            @endforeach
        </ol>
    </div>
</section>

<section class="section" id="decision" aria-labelledby="decision-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">تناسب با کسب‌وکار</span><h2 class="section-title" id="decision-title">سپند برای چه شرکت‌هایی مناسب‌تر است؟</h2><p class="section-sub">تناسب محصول به پیچیدگی فرایند، تعداد واحدها و نوع حمل وابسته است؛ اندازه شرکت به‌تنهایی معیار کافی نیست.</p></div>
        <div class="decision-grid">
            <article class="decision-card is-product reveal">
                <h3>سپند برای چه شرکت‌هایی قابل بررسی است؟</h3>
                <ul>
                    <li>Freight Forwarder و شرکت حمل‌ونقل بین‌المللی</li>
                    <li>شرکت‌های دارای حمل هوایی، دریایی، زمینی یا ریلی</li>
                    <li>تیم‌هایی با واحدهای فروش، عملیات، اسناد و مالی جدا</li>
                    <li>مجموعه‌هایی که اطلاعاتشان در Excel و چند سیستم پراکنده است</li>
                    <li>شرکت‌هایی که سود هر پرونده و وضعیت اقدامات را جداگانه پیگیری می‌کنند</li>
                </ul>
            </article>
            <article class="decision-card is-market reveal">
                <h3>سپند برای چه کسب‌وکارهایی ممکن است انتخاب مناسبی نباشد؟</h3>
                <ul>
                    <li>کسب‌وکاری که فقط حسابداری ساده و بدون فرایند حمل می‌خواهد</li>
                    <li>مجموعه‌ای که تنها نیازش GPS، تلماتیک یا نگهداری ناوگان است</li>
                    <li>شرکتی که قابلیت حیاتی آن خارج از دامنه تأییدشده فعلی سپند است</li>
                    <li>سازمانی که مدل استقرار یا Integration موردنیازش در بررسی فنی تأیید نمی‌شود</li>
                </ul>
            </article>
        </div>
    </div>
</section>

<section class="section soft" aria-labelledby="comparison-faq-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">پرسش‌های تصمیم‌ساز</span><h2 class="section-title" id="comparison-faq-title">سؤالات متداول مقایسه و انتخاب نرم‌افزار حمل‌ونقل</h2></div>
        <div class="faq">
            @foreach($faqs as $faq)
                <details class="reveal"><summary>{{ $faq['question'] }}</summary><p>{{ $faq['answer'] }}</p></details>
            @endforeach
        </div>
    </div>
</section>

<section class="comparison-links" aria-labelledby="comparison-links-title">
    <div class="container">
        <h2 id="comparison-links-title">برای تصمیم دقیق‌تر این بخش‌ها را ببینید</h2>
        <nav aria-label="لینک‌های مرتبط با مقایسه">
            <a href="{{ route('site.modules.show', ['module' => 'crm']) }}">CRM شرکت حمل‌ونقل</a>
            <a href="{{ route('site.modules.show', ['module' => 'transport-operations']) }}">عملیات حمل</a>
            <a href="{{ route('site.modules.show', ['module' => 'document-management']) }}">مدیریت اسناد</a>
            <a href="{{ route('site.modules.show', ['module' => 'finance-accounting']) }}">مالی و سود پرونده</a>
            <a href="{{ route('site.modules.show', ['module' => 'customer-portal-tracking']) }}">پرتال مشتریان</a>
            <a href="{{ route('consultation.create') }}">درخواست دمو</a>
        </nav>
    </div>
</section>

@include('marketing.partials.comparison-cluster-links', ['comparisons' => $comparisons])

<section class="cta-wrap"><div class="container"><div class="cta reveal"><div class="cta-copy"><h2>سپند را با فرایند واقعی شرکت خودتان مقایسه کنید</h2><p>در یک جلسه کوتاه، فرایند فعلی فروش، عملیات و مالی شرکت شما بررسی می‌شود تا مشخص شود سپند تا چه حد با نیازهای شما تطابق دارد.</p></div><div class="cta-action"><a class="btn" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="comparison_other_software_consultation">درخواست دمو و مشاوره</a></div></div></div></section>
@endsection
