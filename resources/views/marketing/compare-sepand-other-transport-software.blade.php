@extends('layouts.marketing')

@php
    $title = 'مقایسه سپند با نرم‌افزارهای دیگر حمل‌ونقل';
    $description = 'مقایسه نرم‌افزار حمل‌ونقل سپند با نرم‌افزارهای دیگر بازار از نظر یکپارچگی CRM، عملیات، مالی، رهگیری، پرتال مشتری و شیوه استقرار.';
    $canonical = route('compare.sepand-other-transport-software');
    $faqs = [
        [
            'question' => 'آیا سپند همیشه از نرم‌افزارهای دیگر انتخاب بهتری است؟',
            'answer' => 'خیر. نرم‌افزارهای دیگر دامنه محصول، شیوه استقرار و ساختار ماژول متفاوتی دارند. انتخاب درست باید بر اساس فرایندها، زیرساخت، بودجه و اجرای یک سناریوی واقعی در دموی گزینه‌های نهایی انجام شود.',
        ],
        [
            'question' => 'چطور سپند را منصفانه با نرم‌افزارهای دیگر مقایسه کنیم؟',
            'answer' => 'یک سناریوی واقعی و یکسان—از ثبت لید و استعلام تا Booking، عملیات، اسناد، مالی و پرتال مشتری—را در دموی هر گزینه اجرا کنید. سپس تعداد ورود دوباره اطلاعات، پوشش فرایند، دسترسی‌ها و گزارش نهایی را مقایسه کنید.',
        ],
        [
            'question' => 'آیا امکانات همه نرم‌افزارهای دیگر یکسان است؟',
            'answer' => 'خیر. عبارت «نرم‌افزارهای دیگر» به مجموعه‌ای از راهکارها با امکانات و مدل‌های ارائه متفاوت اشاره دارد. وضعیت نهایی هر قابلیت، پلن و شیوه استقرار باید در دمو و پیشنهاد رسمی محصول موردنظر تأیید شود.',
        ],
        [
            'question' => 'برای انتخاب نرم‌افزار حمل‌ونقل چه هزینه‌هایی را باید مقایسه کرد؟',
            'answer' => 'علاوه بر لایسنس، هزینه استقرار، آموزش، سفارشی‌سازی، انتقال داده، پشتیبانی و اتصال به ابزارهای فعلی را بررسی کنید. زمان دوباره‌کاری و تهیه گزارش دستی نیز بخشی از هزینه واقعی هر انتخاب است.',
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
            'dateModified' => config('marketing.content_last_modified'),
            'isPartOf' => ['@id' => route('home').'#website'],
            'about' => [
                ['@type' => 'SoftwareApplication', 'name' => 'نرم‌افزار مدیریت حمل‌ونقل سپند', 'url' => route('home')],
                ['@type' => 'Thing', 'name' => 'نرم‌افزارهای دیگر مدیریت حمل‌ونقل و فورواردری'],
            ],
            'significantLink' => [
                route('modules'),
                route('site.modules.show', ['module' => 'crm']),
                route('site.modules.show', ['module' => 'transport-operations']),
                route('pricing'),
            ],
        ],
        [
            '@type' => 'BreadcrumbList',
            '@id' => $canonical.'#breadcrumb',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'صفحه اصلی', 'item' => route('home')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'مقایسه سپند با نرم‌افزارهای دیگر', 'item' => $canonical],
            ],
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
<link rel="stylesheet" href="{{ asset('assets/css/marketing-comparison.css') }}?v=20260811-4">
@endpush

@section('content')
<section class="page-hero comparison-hero">
    <div class="container hero-inner">
        <div class="hero-copy reveal">
            <div class="breadcrumb"><a href="{{ route('home') }}">صفحه اصلی</a><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg><span>مقایسه نرم‌افزارهای حمل‌ونقل</span></div>
            <h1>سپند در مقایسه با<br><span>نرم‌افزارهای دیگر حمل‌ونقل</span></h1>
            <p>این صفحه سپند را بر اساس معیارهای مهم انتخاب نرم‌افزار با راهکارهای دیگر بازار مقایسه می‌کند. چون دامنه امکانات، پلن‌ها و شیوه استقرار محصولات متفاوت است، جزئیات نهایی را در دموی گزینه موردنظر بررسی کنید.</p>
            <div class="hero-actions"><a class="btn btn-primary" href="#comparison-table">مشاهده جدول مقایسه</a><a class="btn btn-outline" href="#decision">انتخاب بر اساس نیاز</a></div>
        </div>
        <div class="hero-art comparison-hero-art reveal" role="img" aria-label="مقایسه نرم‌افزار مدیریت حمل‌ونقل سپند با نرم‌افزارهای دیگر بازار">
            <div class="comparison-visual">
                <div class="comparison-visual-option is-product"><span>راهکار تخصصی</span><strong>سپند</strong><small>از CRM تا عملیات و مالی</small></div>
                <div class="comparison-visual-vs">یا</div>
                <div class="comparison-visual-option is-market"><span>گزینه‌های بازار</span><strong>نرم‌افزارهای<br>دیگر</strong><small>راهکارهایی با دامنه و ساختار متفاوت</small></div>
            </div>
        </div>
    </div>
</section>

<section class="comparison-summary" aria-labelledby="quick-comparison-title">
    <div class="container">
        <div class="quick-verdict reveal">
            <span class="quick-verdict-label">پاسخ کوتاه</span>
            <h2 id="quick-comparison-title">تفاوت اصلی در دامنه فرایند، یکپارچگی و شیوه استقرار است</h2>
            <p>سپند برای اتصال فرایندهای شرکت‌های حمل‌ونقل بین‌المللی و فورواردری، از CRM و نرخ‌دهی تا Booking، عملیات، اسناد، مالی و پرتال مشتری طراحی شده است. نرم‌افزارهای دیگر ممکن است تمام این مسیر یا فقط بخشی از آن را پوشش دهند، به ابزارهای جانبی متصل شوند یا مدل استقرار متفاوتی داشته باشند. بنابراین مقایسه دقیق باید بر اساس سناریوی واقعی شرکت شما انجام شود.</p>
        </div>
    </div>
</section>

<section class="section" aria-labelledby="options-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">دو مسیر در یک نگاه</span><h2 class="section-title" id="options-title">هر گزینه برای چه شرایطی<br><span>مناسب‌تر است؟</span></h2></div>
        <div class="option-grid">
            <article class="option-card is-product reveal">
                <span class="option-badge">گزینه فرایندمحور</span>
                <h3>نرم‌افزار تخصصی حمل‌ونقل سپند</h3>
                <dl>
                    <div><dt>تعریف کوتاه</dt><dd>سامانه‌ای برای اتصال CRM، فروش، Booking، عملیات، اسناد، مالی و گردش کار.</dd></div>
                    <div><dt>مناسب برای</dt><dd>تیم‌های چندواحدی و شرکت‌های دارای پرونده‌ها و پیگیری‌های پرتعداد.</dd></div>
                    <div><dt>مهم‌ترین مزیت</dt><dd>یک مرجع مشترک برای داده و فرایند.</dd></div>
                </dl>
            </article>
            <article class="option-card is-market reveal">
                <span class="option-badge">راهکارهای متنوع بازار</span>
                <h3>نرم‌افزارهای دیگر</h3>
                <dl>
                    <div><dt>تعریف کوتاه</dt><dd>راهکارهایی با تمرکز، معماری، ماژول‌ها و مدل‌های استقرار متفاوت.</dd></div>
                    <div><dt>مناسب برای</dt><dd>شرکت‌هایی که نیاز مشخصی دارند یا زیرساخت فعلی آن‌ها با محصول دیگری هماهنگ است.</dd></div>
                    <div><dt>مهم‌ترین مزیت</dt><dd>تنوع انتخاب و امکان تمرکز بیشتر بر یک حوزه خاص.</dd></div>
                </dl>
            </article>
        </div>
    </div>
</section>

<section class="section soft" id="comparison-table" aria-labelledby="comparison-table-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">جدول تصمیم‌گیری</span><h2 class="section-title" id="comparison-table-title">مقایسه سپند با<br><span>نرم‌افزارهای دیگر بازار</span></h2><p class="section-sub">ستون «نرم‌افزارهای دیگر» یک نمای کلی از بازار است و درباره همه محصولات حکم یکسانی صادر نمی‌کند. برای تصمیم نهایی، همین معیارها را در دموی گزینه موردنظر بررسی کنید.</p></div>
        <div class="comparison-table-wrap reveal">
            <table class="comparison-table">
                <caption>مقایسه نرم‌افزار مدیریت حمل‌ونقل سپند با نرم‌افزارهای دیگر بازار بر اساس معیارهای مؤثر در انتخاب</caption>
                <thead><tr><th scope="col">معیار</th><th scope="col">سپند</th><th scope="col">نرم‌افزارهای دیگر</th></tr></thead>
                <tbody>
                    <tr><th scope="row">تمرکز اصلی</th><td class="is-strong">حمل بین‌المللی و فورواردری</td><td>بسته به محصول؛ تخصصی یا حوزه‌محور</td></tr>
                    <tr><th scope="row">CRM، لید و استعلام</th><td class="is-strong">متصل به پرونده حمل</td><td>بسته به دامنه و ماژول‌های محصول</td></tr>
                    <tr><th scope="row">نرخ‌دهی و Booking</th><td class="is-strong">در جریان مشترک فروش و عملیات</td><td>ممکن است داخلی یا نیازمند ابزار مکمل باشد</td></tr>
                    <tr><th scope="row">حمل دریایی، هوایی، زمینی و ریلی</th><td class="is-strong">در یک پلتفرم</td><td>پوشش شیوه‌های حمل در محصولات متفاوت است</td></tr>
                    <tr><th scope="row">عملیات، اسناد و وظایف</th><td class="is-strong">فرایند متصل و قابل‌ردیابی</td><td>بسته به معماری و دامنه محصول</td></tr>
                    <tr><th scope="row">مالی چندارزی و سود پرونده</th><td class="is-strong">متصل به عملیات حمل</td><td>ممکن است داخلی یا نیازمند اتصال مالی باشد</td></tr>
                    <tr><th scope="row">پیامک و سابقه ارتباطات</th><td class="is-strong">ارسال و ثبت سابقه در پرونده</td><td>بسته به محصول، پلن یا افزونه</td></tr>
                    <tr><th scope="row">پرتال مشتری و رهگیری</th><td class="is-strong">استعلام، محموله، رهگیری و مالی</td><td>دامنه خدمات پرتال متفاوت است</td></tr>
                    <tr><th scope="row">گردش کار و سطح دسترسی</th><td class="is-strong">قابل‌تعریف بر اساس نقش</td><td>بسته به معماری محصول</td></tr>
                    <tr><th scope="row">استقرار و سفارشی‌سازی</th><td>پس از تحلیل فرایند شرکت</td><td>از راهکار آماده تا استقرار سفارشی</td></tr>
                    <tr><th scope="row">تعرفه و زمان راه‌اندازی</th><td>متناسب با ماژول و استقرار</td><td>بسته به محصول، پلن و قرارداد</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<section class="section" aria-labelledby="differences-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">تفاوت‌های کلیدی</span><h2 class="section-title" id="differences-title">چه چیزی نتیجه انتخاب را<br><span>تغییر می‌دهد؟</span></h2></div>
        <div class="difference-grid">
            <article class="difference-card reveal"><span>۰۱</span><h3>دامنه فرایند</h3><p>سپند زنجیره CRM، نرخ‌دهی، Booking، عملیات، اسناد و مالی را به هم متصل می‌کند؛ دامنه پوشش در نرم‌افزارهای دیگر باید برای هر محصول جداگانه بررسی شود.</p></article>
            <article class="difference-card reveal"><span>۰۲</span><h3>یکپارچگی داده‌ها</h3><p>در سپند اطلاعات مشتری و پرونده حمل میان واحدها مشترک است؛ در نرم‌افزارهای دیگر ممکن است همین یکپارچگی وجود داشته باشد یا به اتصال چند ماژول نیاز باشد.</p></article>
            <article class="difference-card reveal"><span>۰۳</span><h3>تجربه مشتری</h3><p>پیامک، سابقه ارتباطات، استعلام، رهگیری و اطلاعات مالی در پرتال سپند کنار هم قرار می‌گیرند؛ سطح پوشش این مسیر در گزینه‌های دیگر متفاوت است.</p></article>
            <article class="difference-card reveal"><span>۰۴</span><h3>استقرار و توسعه</h3><p>سپند پس از شناخت ساختار شرکت و ترکیب ماژول‌ها پیشنهاد می‌شود؛ نرم‌افزارهای دیگر ممکن است آماده، ماژولار، ابری یا متناسب با فرایند سازمان ارائه شوند.</p></article>
        </div>
    </div>
</section>

<section class="section soft" id="decision" aria-labelledby="decision-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">انتخاب بر اساس نیاز</span><h2 class="section-title" id="decision-title">کدام گزینه برای شما<br><span>مناسب‌تر است؟</span></h2></div>
        <div class="decision-grid">
            <article class="decision-card is-product reveal">
                <h3>نرم‌افزار سپند مناسب‌تر است اگر:</h3>
                <ul>
                    <li>فروش، عملیات، اسناد و مالی باید روی داده مشترک کار کنند.</li>
                    <li>پیگیری لید، مشتری، استعلام و وظایف بین چند نفر توزیع می‌شود.</li>
                    <li>به سطح دسترسی، تاریخچه فعالیت و مسئول مشخص نیاز دارید.</li>
                    <li>گزارش سود پرونده و وضعیت عملیات نباید با تجمیع دستی ساخته شود.</li>
                    <li>یک پلتفرم تخصصی را به اتصال چند ابزار جدا ترجیح می‌دهید.</li>
                </ul>
            </article>
            <article class="decision-card is-market reveal">
                <h3>نرم‌افزارهای دیگر را جدی‌تر بررسی کنید اگر:</h3>
                <ul>
                    <li>دامنه تخصصی یک محصول دیگر دقیق‌تر با مدل فعالیت شما هماهنگ است.</li>
                    <li>زیرساخت فعلی شرکت از قبل با راهکار دیگری یکپارچه شده است.</li>
                    <li>به قابلیت ویژه‌ای خارج از دامنه فعلی سپند نیاز دارید.</li>
                    <li>مدل استقرار یا قرارداد محصول دیگری برای سازمانتان مناسب‌تر است.</li>
                    <li>دموی گزینه دیگری سناریوی واقعی شما را با تغییر فرایند کمتر پوشش می‌دهد.</li>
                </ul>
            </article>
        </div>
    </div>
</section>

<section class="section final-decision-section" aria-labelledby="final-decision-title">
    <div class="container">
        <div class="final-decision reveal">
            <span class="section-label">نتیجه مقایسه</span>
            <h2 id="final-decision-title">در نهایت کدام را انتخاب کنیم؟</h2>
            <p>اگر اتصال CRM، فروش، عملیات، مالی، پیامک و پرتال مشتری در یک مسیر تخصصی برایتان معیار اصلی است، سپند گزینه جدی‌تری برای بررسی است. اگر نیاز، زیرساخت یا مدل استقرار متفاوتی دارید، نرم‌افزارهای دیگر نیز می‌توانند انتخاب مناسب‌تری باشند. تصمیم نهایی را با اجرای یک سناریوی واقعی و یکسان در دموی گزینه‌های نهایی و مقایسه هزینه کل استقرار بگیرید.</p>
        </div>
    </div>
</section>

<section class="section soft" aria-labelledby="comparison-faq-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">پرسش‌های تصمیم‌ساز</span><h2 class="section-title" id="comparison-faq-title">پیش از انتخاب<br><span>نرم‌افزار حمل‌ونقل</span></h2></div>
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
            <a href="{{ route('modules') }}">ماژول‌های نرم‌افزار حمل‌ونقل</a>
            <a href="{{ route('site.modules.show', ['module' => 'crm']) }}">CRM تخصصی حمل‌ونقل</a>
            <a href="{{ route('site.modules.show', ['module' => 'transport-operations']) }}">مدیریت عملیات حمل</a>
            <a href="{{ route('pricing') }}">قیمت نرم‌افزار حمل‌ونقل</a>
        </nav>
    </div>
</section>

<section class="cta-wrap"><div class="container"><div class="cta reveal"><div class="cta-copy"><h2>هنوز بین سپند و نرم‌افزارهای دیگر مردد هستید؟</h2><p>سناریوی واقعی، ابزارهای موجود و نیازهای تیم شما را بررسی می‌کنیم تا معیارهای انتخاب و تناسب سپند با سازمانتان روشن شود.</p></div><div class="cta-action"><a class="btn" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="comparison_other_software_consultation">درخواست مشاوره</a></div></div></div></section>
@endsection
