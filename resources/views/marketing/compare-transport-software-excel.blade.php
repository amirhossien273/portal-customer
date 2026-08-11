@extends('layouts.marketing')

@php
    $title = 'نرم‌افزار حمل‌ونقل یا Excel؟ مقایسه کاربردی | سپند';
    $description = 'مقایسه نرم‌افزار تخصصی حمل‌ونقل با Excel از نظر یکپارچگی، خطا، گزارش‌گیری، امنیت و رشد؛ ببینید کدام گزینه برای شرکت شما مناسب‌تر است.';
    $canonical = route('compare.transport-software-excel');
    $faqs = [
        [
            'question' => 'Excel تا چه زمانی برای مدیریت شرکت حمل‌ونقل کافی است؟',
            'answer' => 'تا زمانی که حجم پرونده‌ها کم، فرایندها ساده و مسئول ثبت و پیگیری اطلاعات یک یا دو نفر باشند، Excel می‌تواند پاسخ‌گو باشد. با افزایش کاربران، فایل‌ها، تأییدها و نیاز به گزارش مشترک، نگهداری این ساختار دشوارتر می‌شود.',
        ],
        [
            'question' => 'آیا اطلاعات فعلی Excel را می‌توان به نرم‌افزار منتقل کرد؟',
            'answer' => 'اصل انتقال امکان‌پذیر است، اما روش و دامنه آن به کیفیت فایل‌ها، یکنواختی ستون‌ها و حجم داده بستگی دارد. پیش از استقرار، نمونه فایل‌ها بررسی می‌شوند تا مسیر پاک‌سازی و انتقال مشخص شود.',
        ],
        [
            'question' => 'آیا نرم‌افزار تخصصی باید کاملاً جای Excel را بگیرد؟',
            'answer' => 'لزومی ندارد. نرم‌افزار بهتر است مرجع اصلی فرایندها و داده‌های مشترک باشد؛ Excel همچنان می‌تواند برای تحلیل‌های موقت، محاسبات شخصی یا خروجی‌های موردی استفاده شود.',
        ],
        [
            'question' => 'هزینه نرم‌افزار حمل‌ونقل در مقایسه با Excel چگونه سنجیده می‌شود؟',
            'answer' => 'مقایسه فقط با هزینه لایسنس دقیق نیست. زمان ورود تکراری داده، خطا، تأخیر در پیگیری، تهیه گزارش و وابستگی به افراد نیز باید در هزینه واقعی هر روش محاسبه شود.',
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
                ['@type' => 'Thing', 'name' => 'نرم‌افزار تخصصی مدیریت حمل‌ونقل'],
                ['@type' => 'Thing', 'name' => 'Microsoft Excel'],
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
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'مقایسه نرم‌افزار حمل‌ونقل با Excel', 'item' => $canonical],
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
<link rel="stylesheet" href="{{ asset('assets/css/marketing-comparison.css') }}?v=20260811-1">
@endpush

@section('content')
<section class="page-hero comparison-hero">
    <div class="container hero-inner">
        <div class="hero-copy reveal">
            <div class="breadcrumb"><a href="{{ route('home') }}">صفحه اصلی</a><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg><span>مقایسه نرم‌افزار با Excel</span></div>
            <h1>نرم‌افزار تخصصی حمل‌ونقل یا Excel؛<br><span>کدام مناسب‌تر است؟</span></h1>
            <p>این مقایسه به مدیران شرکت‌های حمل‌ونقل و فورواردری کمک می‌کند تفاوت دو روش را سریع ببینند. معیار انتخاب، اندازه تیم، پیچیدگی فرایند و نیاز به کنترل داده‌هاست.</p>
            <div class="hero-actions"><a class="btn btn-primary" href="#comparison-table">مشاهده جدول مقایسه</a><a class="btn btn-outline" href="#decision">انتخاب بر اساس نیاز</a></div>
        </div>
        <div class="hero-art comparison-hero-art reveal" role="img" aria-label="مقایسه نرم‌افزار تخصصی حمل‌ونقل سپند با Excel">
            <div class="comparison-visual">
                <div class="comparison-visual-option is-product"><span>راهکار یکپارچه</span><strong>نرم‌افزار<br>حمل‌ونقل</strong><small>فرایند و داده مشترک</small></div>
                <div class="comparison-visual-vs">یا</div>
                <div class="comparison-visual-option is-sheet"><span>ابزار عمومی</span><strong>Excel</strong><small>جدول و محاسبه منعطف</small></div>
            </div>
        </div>
    </div>
</section>

<section class="comparison-summary" aria-labelledby="quick-comparison-title">
    <div class="container">
        <div class="quick-verdict reveal">
            <span class="quick-verdict-label">پاسخ کوتاه</span>
            <h2 id="quick-comparison-title">تفاوت اصلی در «ثبت داده» و «مدیریت فرایند» است</h2>
            <p>Excel برای ثبت و تحلیل سریع داده‌ها در یک تیم کوچک، کم‌حجم و با فرایند ساده، انتخابی آشنا و کم‌هزینه است. اما وقتی چند واحد باید روی اطلاعات مشترک مشتری، نرخ، Booking، عملیات، اسناد و مالی کار کنند، نرم‌افزار تخصصی سپند کنترل و ردیابی بیشتری فراهم می‌کند. انتخاب نهایی به حجم عملیات، تعداد کاربران، نیاز به گردش کار و هزینه خطا یا دوباره‌کاری بستگی دارد.</p>
        </div>
    </div>
</section>

<section class="section" aria-labelledby="options-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">دو گزینه در یک نگاه</span><h2 class="section-title" id="options-title">هر گزینه برای چه شرایطی<br><span>طراحی شده است؟</span></h2></div>
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
            <article class="option-card is-sheet reveal">
                <span class="option-badge">گزینه جدول‌محور</span>
                <h3>Microsoft Excel</h3>
                <dl>
                    <div><dt>تعریف کوتاه</dt><dd>ابزار عمومی صفحه‌گسترده برای ثبت، محاسبه و تحلیل انعطاف‌پذیر داده‌ها.</dd></div>
                    <div><dt>مناسب برای</dt><dd>کار فردی یا تیم کوچک با حجم داده کم و فرایند ساده.</dd></div>
                    <div><dt>مهم‌ترین مزیت</dt><dd>شروع سریع و انعطاف بالا در ساخت جدول.</dd></div>
                </dl>
            </article>
        </div>
    </div>
</section>

<section class="section soft" id="comparison-table" aria-labelledby="comparison-table-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">جدول تصمیم‌گیری</span><h2 class="section-title" id="comparison-table-title">مقایسه نرم‌افزار حمل‌ونقل<br><span>با Excel</span></h2><p class="section-sub">معیارها بر اساس نیازهای روزانه شرکت‌های حمل‌ونقل، فورواردری و لجستیک انتخاب شده‌اند.</p></div>
        <div class="comparison-table-wrap reveal">
            <table class="comparison-table">
                <caption>مقایسه نرم‌افزار تخصصی حمل‌ونقل سپند و Excel بر اساس معیارهای مؤثر در انتخاب</caption>
                <thead><tr><th scope="col">معیار</th><th scope="col">نرم‌افزار تخصصی سپند</th><th scope="col">Excel</th></tr></thead>
                <tbody>
                    <tr><th scope="row">شروع و راه‌اندازی</th><td>نیازمند تحلیل و استقرار</td><td class="is-strong">سریع و آشنا</td></tr>
                    <tr><th scope="row">هزینه اولیه</th><td>نیازمند بودجه نرم‌افزار</td><td class="is-strong">کم</td></tr>
                    <tr><th scope="row">کار فردی و فرایند ساده</th><td>ممکن؛ گاهی بیش از نیاز</td><td class="is-strong">قوی</td></tr>
                    <tr><th scope="row">همکاری چند واحد</th><td class="is-strong">داده و دسترسی مشترک</td><td>امکان‌پذیر؛ کنترل محدود</td></tr>
                    <tr><th scope="row">CRM، لید و استعلام</th><td class="is-strong">یکپارچه</td><td>نیازمند فایل و طراحی دستی</td></tr>
                    <tr><th scope="row">پیامک و سابقه ارتباطات</th><td class="is-strong">ارسال و لاگ در پرونده</td><td>نیازمند ابزار جانبی</td></tr>
                    <tr><th scope="row">Booking، عملیات و اسناد</th><td class="is-strong">فرایند متصل</td><td>چند فایل یا شیت مجزا</td></tr>
                    <tr><th scope="row">وظیفه، موعد و گردش کار</th><td class="is-strong">قابل‌تخصیص و ردیابی</td><td>نیازمند طراحی و پیگیری دستی</td></tr>
                    <tr><th scope="row">سطح دسترسی و تاریخچه</th><td class="is-strong">نقش‌محور و ثبت فعالیت</td><td>عمدتاً در سطح فایل</td></tr>
                    <tr><th scope="row">گزارش مدیریتی</th><td class="is-strong">از داده عملیاتی مشترک</td><td>وابسته به فرمول و تجمیع</td></tr>
                    <tr><th scope="row">انعطاف محاسبات موردی</th><td>در چارچوب سیستم</td><td class="is-strong">قوی</td></tr>
                    <tr><th scope="row">رشد حجم و کاربران</th><td class="is-strong">مناسب توسعه فرایند</td><td>نگهداری دشوارتر می‌شود</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<section class="section" aria-labelledby="differences-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">تفاوت‌های کلیدی</span><h2 class="section-title" id="differences-title">چه چیزی نتیجه انتخاب را<br><span>تغییر می‌دهد؟</span></h2></div>
        <div class="difference-grid">
            <article class="difference-card reveal"><span>۰۱</span><h3>ابزار ثبت در برابر سیستم فرایند</h3><p>Excel داده را در جدول نگه می‌دارد؛ نرم‌افزار تخصصی مسئول، مرحله، موعد و ارتباط بین واحدها را نیز مدیریت می‌کند.</p></article>
            <article class="difference-card reveal"><span>۰۲</span><h3>انعطاف شخصی در برابر استاندارد سازمانی</h3><p>ساختار Excel سریع تغییر می‌کند؛ نرم‌افزار ساختار مشترکی می‌سازد تا اعضای تیم یک فرایند هماهنگ را اجرا کنند.</p></article>
            <article class="difference-card reveal"><span>۰۳</span><h3>گزارش‌سازی در برابر گزارش آماده</h3><p>گزارش Excel به کیفیت فایل و فرمول وابسته است؛ گزارش نرم‌افزار از داده‌های ثبت‌شده در جریان واقعی کار ساخته می‌شود.</p></article>
            <article class="difference-card reveal"><span>۰۴</span><h3>شروع ارزان در برابر هزینه قابل‌کنترل رشد</h3><p>Excel هزینه شروع را پایین نگه می‌دارد؛ با رشد تیم باید هزینه دوباره‌کاری، خطا، تجمیع فایل‌ها و وابستگی به افراد را هم سنجید.</p></article>
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
                    <li>حجم فایل‌ها و دوباره‌کاری، رشد تیم را کند کرده است.</li>
                </ul>
            </article>
            <article class="decision-card is-sheet reveal">
                <h3>Excel مناسب‌تر است اگر:</h3>
                <ul>
                    <li>تعداد پرونده‌ها کم و فرایند روزانه ساده است.</li>
                    <li>یک نفر مسئول اصلی ثبت و کنترل اطلاعات است.</li>
                    <li>فعلاً فقط جدول، محاسبه یا تحلیل موردی نیاز دارید.</li>
                    <li>بودجه استقرار نرم‌افزار ندارید و هزینه خطا نیز پایین است.</li>
                    <li>فرایندها هنوز تثبیت نشده‌اند و مرتب تغییر می‌کنند.</li>
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
            <p>اگر مسئله شما فقط ثبت و محاسبه داده‌های محدود است، Excel انتخاب منطقی‌تری است. اگر مسئله اصلی هماهنگی چند واحد، ردیابی فرایند، کنترل دسترسی و دسترسی به گزارش قابل‌اعتماد است، نرم‌افزار تخصصی ارزش بیشتری ایجاد می‌کند. تصمیم را بر اساس هزینه کل فرایند—نه فقط هزینه خرید ابزار—بگیرید.</p>
        </div>
    </div>
</section>

<section class="section soft" aria-labelledby="comparison-faq-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">پرسش‌های تصمیم‌ساز</span><h2 class="section-title" id="comparison-faq-title">پیش از مهاجرت از<br><span>Excel به نرم‌افزار</span></h2></div>
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

<section class="cta-wrap"><div class="container"><div class="cta reveal"><div class="cta-copy"><h2>هنوز مطمئن نیستید کدام گزینه مناسب شماست؟</h2><p>فرایند فعلی، تعداد کاربران و فایل‌های شما را بررسی می‌کنیم تا مشخص شود ادامه با Excel منطقی است یا زمان مهاجرت رسیده است.</p></div><div class="cta-action"><a class="btn" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="comparison_excel_consultation">درخواست مشاوره</a></div></div></div></section>
@endsection
