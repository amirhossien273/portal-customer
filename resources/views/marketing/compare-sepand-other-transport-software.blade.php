@extends('layouts.marketing')

@php
    $title = 'مقایسه انواع نرم‌افزار حمل‌ونقل؛ TMS، CRM و مالی | سپند';
    $description = 'انواع نرم‌افزار حمل‌ونقل را مقایسه کنید: تفاوت ERP و TMS، CRM، مالی و ناوگان؛ برای هر گلوگاه، گزینه مناسب و سؤال‌های دمو را مشخص کنید.';
    $canonical = route('compare.sepand-other-transport-software');
    $dateModified = '2026-11-23';
    $comparisons = config('site_comparisons.pages');
    $decisionRows = [
        ['problem' => 'رزرو، مدارک و وضعیت حمل در چند ابزار پراکنده‌اند', 'option' => 'TMS تخصصی', 'demo' => 'یک سفارش را از رزرو تا ثبت رویداد و تحویل دنبال کنید.'],
        ['problem' => 'گلوگاه در حسابداری، خرید و بودجه کل سازمان است', 'option' => 'ERP', 'demo' => 'گردش تأیید و ثبت مالی بین واحدهای مرتبط را با نقش‌های واقعی ببینید.'],
        ['problem' => 'شرکت ERP دارد و به اجرای تخصصی حمل نیاز دارد', 'option' => 'TMS در کنار ERP', 'demo' => 'مرجع سفارش، هزینه و ثبت نهایی مالی و روش تبادل داده را مشخص کنید.'],
        ['problem' => 'اطلاعات از فروش به عملیات دوباره وارد می‌شود', 'option' => 'TMS با CRM یکپارچه', 'demo' => 'بررسی کنید پس از تأیید پیشنهاد، کدام اطلاعات برای رزرو و اجرای حمل در دسترس‌اند.'],
    ];
    $faqs = [
        [
            'question' => 'تفاوت ERP و TMS چیست؟',
            'answer' => 'ERP دامنه‌ای سازمانی دارد و معمولاً فرایندهایی مانند حسابداری، خرید، بودجه و منابع را به هم متصل می‌کند. TMS روی برنامه‌ریزی و اجرای حمل، وضعیت محموله، مدارک و هزینه حمل متمرکز است. دامنه واقعی هر محصول و ماژول‌های خریداری‌شده باید جداگانه در دمو سنجیده شود.',
        ],
        [
            'question' => 'اگر ERP داریم، چه زمانی TMS جداگانه لازم می‌شود؟',
            'answer' => 'وقتی ERP فرایند تخصصی رزرو، رویدادهای اجرای حمل، مدارک و وضعیت محموله را با عمق موردنیاز پوشش نمی‌دهد، TMS کنار ERP قابل بررسی است. پیش از انتخاب، مرجع سفارش و هزینه و روش تبادل داده میان دو سیستم را مشخص کنید.',
        ],
        [
            'question' => 'چه زمانی TMS با CRM یکپارچه ارزش دارد؟',
            'answer' => 'وقتی تیم عملیات پس از تأیید پیشنهاد، اطلاعات مشتری، مسیر، محموله یا توافق فروش را دوباره جمع‌آوری و وارد می‌کند، اتصال CRM و TMS ارزش بررسی دارد. در دمو ببینید کدام داده‌ها منتقل می‌شوند و کدام بخش را کارشناس باید تکمیل کند.',
        ],
        [
            'question' => 'آیا سپند یک ERP کامل است؟',
            'answer' => 'سپند در این راهنما ERP کامل معرفی نمی‌شود. دامنه تأییدشده آن CRM و فروش تخصصی حمل، Booking، عملیات و اسناد و مالی مرتبط با پرونده حمل است. اتصال به ERP بیرونی باید برای سامانه مقصد، داده‌ها و روش تبادل به‌صورت فنی تأیید شود.',
        ],
        [
            'question' => 'سپند چه تفاوتی با CRM عمومی دارد؟',
            'answer' => 'CRM عمومی بر ارتباطات و قیف فروش تمرکز دارد. سپند پرونده مشتری و استعلام را به نرخ‌دهی، Booking، عملیات، اسناد و مالی پرونده حمل متصل می‌کند.',
        ],
        [
            'question' => 'آیا اطلاعات نرم‌افزار قبلی یا Excel قابل انتقال است؟',
            'answer' => 'انتقال خودکار و عمومی برای هر ساختار داده در اطلاعات فعلی محصول تأیید نشده است. قالب فایل‌ها، کیفیت داده و دامنه Migration باید با نمونه واقعی پیش از قرارداد بررسی شود.',
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
                ['@type' => 'Thing', 'name' => 'مقایسه دسته‌های نرم‌افزار حمل‌ونقل'],
            ],
            'significantLink' => [
                route('compare.index'),
                route('compare.sepand-vs-royan'),
                route('compare.sepand-vs-saba'),
                route('compare.best-transport-software'),
                route('solutions.platform.show', ['solution' => 'transportation-management-system']),
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
            '@id' => $canonical.'#erp-tms-decision',
            'name' => 'راهنمای انتخاب ERP، TMS یا TMS با CRM یکپارچه',
            'itemListElement' => array_map(static fn (array $row, int $index): array => [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'name' => $row['problem'].' — '.$row['option'],
                'description' => $row['demo'],
                'url' => $canonical.'#erp-tms-row-'.($index + 1),
            ], $decisionRows, array_keys($decisionRows)),
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
<link rel="stylesheet" href="{{ asset('assets/css/marketing-comparison.css') }}?v=20261123-1">
@endpush

@section('content')
<section class="page-hero comparison-hero">
    <div class="container hero-inner">
        <div class="hero-copy reveal">
            <div class="breadcrumb"><a href="{{ route('home') }}">صفحه اصلی</a><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg><a href="{{ route('compare.index') }}">مرکز مقایسه</a><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg><span>سایر نرم‌افزارها</span></div>
            <h1>مقایسه انواع نرم‌افزار حمل‌ونقل؛<br><span>TMS، CRM، مالی و راهکار یکپارچه</span></h1>
            <p>این صفحه معماری‌ها را مقایسه می‌کند، نه برندها را: راهکار یکپارچه، TMS عملیاتی، CRM عمومی، نرم‌افزار حسابداری‌محور و سیستم مدیریت ناوگان از نقطه شروع، داده مرجع و خروجی متفاوتی ساخته شده‌اند. جدول صفحه نشان می‌دهد هر دسته کدام مسئله را عمیق‌تر حل می‌کند و در کدام Handoff به اتصال یا ابزار مکمل نیاز دارد. برای دیدن مصداق اجرایی سپند، صفحه <a href="{{ route('solutions.platform.show', ['solution' => 'transportation-management-system']) }}">نرم‌افزار TMS با CRM یکپارچه</a> را بررسی کنید.</p>
            <div class="hero-actions"><a class="btn btn-primary" href="#comparison-table">مشاهده جدول دسته‌ها</a><a class="btn btn-outline" href="#selection-criteria">شناخت مرز هر معماری</a><a class="btn btn-outline" href="#erp-vs-tms">تفاوت ERP و TMS</a></div>
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
            <h2 class="section-title" id="selection-criteria-title">دامنه و نقطه شروع هر دسته نرم‌افزار را چگونه تشخیص دهیم؟</h2>
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

<section class="section erp-tms-section" id="erp-vs-tms" aria-labelledby="erp-vs-tms-title">
    <div class="container">
        <header class="section-head reveal">
            <span class="section-label">راهنمای انتخاب معماری</span>
            <h2 class="section-title" id="erp-vs-tms-title">تفاوت ERP و TMS برای شرکت‌های حمل‌ونقل چیست؟</h2>
            <p class="section-sub">در مقایسه ERP و TMS، پاسخ درست از نام نرم‌افزار شروع نمی‌شود. اگر پرسش شما «ERP یا TMS برای شرکت حمل‌ونقل» است، ابتدا مشخص کنید گلوگاه در مدیریت کل سازمان است یا در اجرای تخصصی سفارش حمل.</p>
        </header>

        <div class="erp-tms-definitions">
            <article class="erp-tms-definition reveal">
                <span>دامنه سازمان</span>
                <h3>ERP؛ برنامه‌ریزی منابع سازمان</h3>
                <p>ERP در سطح سازمان، فرایندهای روزمره‌ای مانند حسابداری، خرید، بودجه، پروژه و زنجیره تأمین را به هم متصل می‌کند. این تعریف بر مبنای <a href="https://www.oracle.com/erp/what-is-erp/" rel="noopener">راهنمای رسمی ERP اوراکل</a> است؛ اما دامنه هر محصول و ماژول‌های خریداری‌شده را باید جداگانه سنجید.</p>
            </article>
            <article class="erp-tms-definition reveal">
                <span>دامنه عملیات حمل</span>
                <h3>TMS؛ سیستم مدیریت حمل‌ونقل</h3>
                <p>TMS در سطح عملیات حمل برای برنامه‌ریزی و اجرای جابه‌جایی کالا، مشاهده وضعیت و کنترل مدارک و هزینه‌های حمل به کار می‌رود. <a href="https://www.oracle.com/scm/logistics/transportation-management/what-is-transportation-management-system/" rel="noopener">تعریف رسمی TMS اوراکل</a> نیز بر برنامه‌ریزی، اجرا و بهینه‌سازی حرکت فیزیکی کالا تأکید دارد؛ پوشش رزرو، مالی و روش‌های حمل در هر محصول باید در دمو تأیید شود.</p>
            </article>
        </div>

        <div class="erp-tms-decision-head reveal">
            <h3>مسئله شرکت شما کدام گزینه را به Shortlist می‌رساند؟</h3>
            <p>این جدول حکم خرید نیست؛ برای هر گزینه همان گلوگاه را با داده واقعی شرکت در دمو اجرا کنید.</p>
        </div>
        <p class="mobile-table-hint"><span aria-hidden="true">↔</span>جدول را به طرفین بکشید.</p>
        <div class="comparison-table-wrap reveal">
            <table class="comparison-table erp-tms-table">
                <caption>راهنمای انتخاب ERP، TMS تخصصی، TMS در کنار ERP یا TMS با CRM یکپارچه بر اساس مسئله شرکت حمل‌ونقل</caption>
                <thead><tr><th scope="col">مسئله شرکت</th><th scope="col">گزینه‌ای که باید بررسی کند</th><th scope="col">چه چیزی را در دمو بسنجد؟</th></tr></thead>
                <tbody>
                    @foreach($decisionRows as $index => $row)
                        <tr id="erp-tms-row-{{ $index + 1 }}"><th scope="row">{{ $row['problem'] }}</th><td class="is-strong">{{ $row['option'] }}</td><td>{{ $row['demo'] }}</td></tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <p class="erp-tms-integration reveal"><strong>اتصال TMS به ERP:</strong> اگر هر دو سیستم را کنار هم نگه می‌دارید، پیش از خرید تعیین کنید سفارش و هزینه در کدام سیستم مرجع‌اند، چه داده‌ای در چه زمانی جابه‌جا می‌شود و خطا چگونه پیگیری می‌شود. مستند رسمی <a href="https://help.sap.com/docs/SAP_ERP/930f133a36a843318dc3347afe00a9d6/c75d4350be0c4c6fb73284dc73abdcdf.html" rel="noopener">یکپارچگی سفارش ERP و TMS در SAP</a> نمونه‌ای از تبادل سفارش و تحویل میان دو سامانه را نشان می‌دهد؛ این لینک به معنی وجود اتصال آماده سپند به SAP یا ERP دیگری نیست.</p>

        <div class="erp-tms-connected reveal">
            <span class="section-label">فروش تا اجرا</span>
            <h3>نرم‌افزار TMS با CRM یکپارچه چه زمانی مناسب است؟</h3>
            <p>فرض کنید مشتری پیشنهاد قیمت را تأیید کرده، اما تیم عملیات برای ساخت رزرو باید دوباره مشخصات بار، مسیر و توافق‌های فروش را از ایمیل و پیام‌ها جمع کند. در این وضعیت، فقط داشتن CRM یا TMS جداگانه کافی نیست؛ باید مسیر تحویل اطلاعات میان فروش و عملیات را بسنجید.</p>
            <p>در دمو بررسی کنید پیشنهاد تأییدشده چگونه به رزرو و عملیات می‌رسد، کدام داده‌ها منتقل می‌شوند و کدام موارد را کارشناس تکمیل می‌کند. در سپند، سرنخ، استعلام و پیشنهاد نرخ به Booking و ادامه پرونده عملیات مرتبط می‌مانند؛ دامنه تأییدشده محصول CRM، عملیات حمل و مالی پرونده است و سپند در این صفحه «ERP کامل» معرفی نمی‌شود.</p>
            <a class="erp-tms-context-link" href="{{ route('solutions.platform.show', ['solution' => 'transportation-management-system']) }}">ببینید CRM و TMS در سپند چگونه به هم وصل می‌شوند</a>
        </div>

        <article class="erp-tms-scenario reveal" id="erp-tms-demo-checklist">
            <div>
                <span>مثال تصمیم خرید</span>
                <h3>اگر شرکت ERP دارد، سفارش و هزینه حمل در کدام سیستم ثبت شوند؟</h3>
                <p>فرض کنید شرکت حسابداری و ثبت نهایی مالی را در ERP انجام می‌دهد و به یک سیستم تخصصی برای بوکینگ، وضعیت محموله و هزینه‌های هر پرونده حمل نیاز دارد. پیش از خرید، مشخص کنید سفارش در کدام سیستم ایجاد می‌شود، تیم عملیات هزینه‌ها را کجا ثبت می‌کند و مالی کدام اطلاعات را برای ثبت نهایی لازم دارد.</p>
            </div>
            <div>
                <strong>سه سؤال جلسه دمو</strong>
                <ol>
                    <li>سفارش حمل در کدام سیستم ایجاد می‌شود و شناسه آن در سیستم دیگر چطور قابل پیگیری است؟</li>
                    <li>هزینه برآوردی و هزینه قطعی حمل کجا ثبت می‌شوند و ثبت نهایی مالی در کدام سیستم انجام می‌شود؟</li>
                    <li>چه داده‌ای، در چه مرحله‌ای و با چه روشی بین دو سیستم منتقل می‌شود؟ اگر انتقال انجام نشد، چه کسی آن را پیگیری می‌کند؟</li>
                </ol>
            </div>
        </article>
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
            <a href="{{ route('solutions.platform.show', ['solution' => 'transportation-management-system']) }}">اجرای TMS با CRM یکپارچه</a>
            <a href="{{ route('consultation.create') }}">درخواست دمو</a>
        </nav>
    </div>
</section>

@include('marketing.partials.comparison-cluster-links', ['comparisons' => $comparisons])

<section class="cta-wrap"><div class="container"><div class="cta reveal"><div class="cta-copy"><h2>حالا اجرای راهکار مرتبط را ببینید</h2><p>اگر گلوگاه شما تحویل فروش به رزرو و عملیات است، سناریوی اجرایی سپند را ببینید؛ برای ارزیابی ERP یا اتصال دو سیستم نیز از سؤال‌های همین چک‌لیست در دمو استفاده کنید.</p></div><div class="cta-action"><a class="btn" href="{{ route('solutions.platform.show', ['solution' => 'transportation-management-system']) }}" data-ga-event="cta_click" data-ga-label="comparison_erp_tms_solution">مشاهده اجرای TMS با CRM یکپارچه</a></div></div></div></section>
@endsection

@push('scripts')
<script>
(() => {
    const scrollToErpTms = () => {
        if (window.location.hash !== '#erp-vs-tms') return;
        const target = document.getElementById('erp-vs-tms');
        if (!target) return;
        const alignTarget = () => window.requestAnimationFrame(() => target.scrollIntoView({ block: 'start' }));
        alignTarget();
        window.setTimeout(alignTarget, 250);
        if (document.fonts?.ready) document.fonts.ready.then(alignTarget);
    };

    if (document.readyState === 'complete') scrollToErpTms();
    else window.addEventListener('load', scrollToErpTms, { once: true });
    window.addEventListener('hashchange', scrollToErpTms);
})();
</script>
@endpush
