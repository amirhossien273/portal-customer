@extends('layouts.marketing')

@php
    $title = 'مقایسه سپند با رویان، سبا سیستم و زمزم رایانه گستر';
    $description = 'مقایسه نرم‌افزار حمل‌ونقل سپند با رویان، سبا سیستم و زمزم رایانه گستر از نظر CRM، عملیات، مالی، رهگیری، پرتال مشتری و استقرار.';
    $canonical = route('compare.sepand-other-transport-software');
    $faqs = [
        [
            'question' => 'آیا سپند از رویان، سبا سیستم و زمزم رایانه گستر بهتر است؟',
            'answer' => 'هیچ پاسخ یکسانی برای همه شرکت‌ها وجود ندارد. سپند، رویان، سبا سیستم و زمزم رایانه گستر دامنه محصول، شیوه استقرار و ساختار ماژول متفاوتی دارند. انتخاب درست باید با اجرای سناریوی واقعی شرکت شما در دموی هر محصول انجام شود.',
        ],
        [
            'question' => 'چطور سپند را منصفانه با رویان، سبا سیستم و زمزم رایانه گستر مقایسه کنیم؟',
            'answer' => 'یک سناریوی واقعی و یکسان—از ثبت لید و استعلام تا Booking، عملیات، اسناد، مالی و پرتال مشتری—را در دموی هر گزینه اجرا کنید. سپس تعداد ورود دوباره اطلاعات، پوشش فرایند، دسترسی‌ها و گزارش نهایی را مقایسه کنید.',
        ],
        [
            'question' => 'اطلاعات این مقایسه از کجا آمده است؟',
            'answer' => 'اطلاعات رقبا از توضیحات عمومی وب‌سایت رسمی آن‌ها در مرداد ۱۴۰۵ گردآوری شده است. چون امکانات، پلن‌ها و شرایط استقرار ممکن است تغییر کنند، وضعیت نهایی هر قابلیت باید در دمو و پیشنهاد رسمی همان شرکت تأیید شود.',
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
                ['@type' => 'SoftwareApplication', 'name' => 'رویان TMS', 'url' => 'https://royantms.com/'],
                ['@type' => 'SoftwareApplication', 'name' => 'سبا سیستم', 'url' => 'https://sabanetsystem.com/'],
                ['@type' => 'SoftwareApplication', 'name' => 'نرم‌افزار جامع مدیریت حمل‌ونقل بین‌المللی زمزم رایانه گستر', 'url' => 'https://zrgco.ir/zrgtransport/'],
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
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'مقایسه سپند با رویان، سبا سیستم و زمزم رایانه گستر', 'item' => $canonical],
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
<link rel="stylesheet" href="{{ asset('assets/css/marketing-comparison.css') }}?v=20260811-3">
@endpush

@section('content')
<section class="page-hero comparison-hero">
    <div class="container hero-inner">
        <div class="hero-copy reveal">
            <div class="breadcrumb"><a href="{{ route('home') }}">صفحه اصلی</a><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg><span>مقایسه نرم‌افزارهای حمل‌ونقل</span></div>
            <h1>سپند در مقایسه با<br><span>رویان، سبا سیستم و زمزم رایانه گستر</span></h1>
            <p>در این صفحه سپند را با سه نرم‌افزار نام‌دار بازار ایران مقایسه می‌کنیم. مبنا، امکانات اعلام‌شده در وب‌سایت رسمی هر محصول در مرداد ۱۴۰۵ است؛ جزئیات نهایی هر قابلیت، پلن و استقرار را در دموی همان محصول بررسی کنید.</p>
            <div class="hero-actions"><a class="btn btn-primary" href="#comparison-table">مشاهده جدول مقایسه</a><a class="btn btn-outline" href="#decision">انتخاب بر اساس نیاز</a></div>
        </div>
        <div class="hero-art comparison-hero-art reveal" role="img" aria-label="مقایسه نرم‌افزار مدیریت حمل‌ونقل سپند با رویان، سبا سیستم و زمزم رایانه گستر">
            <div class="comparison-visual">
                <div class="comparison-visual-option is-product"><span>راهکار تخصصی</span><strong>سپند</strong><small>از CRM تا عملیات و مالی</small></div>
                <div class="comparison-visual-vs">یا</div>
                <div class="comparison-visual-option is-market"><span>گزینه‌های بازار</span><strong>رویان، سبا سیستم<br>و زمزم رایانه گستر</strong><small>سه راهکار تخصصی حمل‌ونقل</small></div>
            </div>
        </div>
    </div>
</section>

<section class="comparison-summary" aria-labelledby="quick-comparison-title">
    <div class="container">
        <div class="quick-verdict reveal">
            <span class="quick-verdict-label">پاسخ کوتاه</span>
            <h2 id="quick-comparison-title">هر چهار محصول تخصصی‌اند؛ تفاوت در ترکیب ماژول‌ها و شیوه ارائه است</h2>
            <p>سپند، رویان، سبا سیستم و زمزم رایانه گستر همگی برای فرایندهای حمل‌ونقل بین‌المللی معرفی شده‌اند، اما روی یک معماری و مدل ارائه یکسان بنا نشده‌اند. سپند بر اتصال CRM، فروش، عملیات، مالی، پیامک و پرتال مشتری در یک جریان مشترک تأکید دارد؛ رویان محصولی تحت وب برای عملیات بین‌المللی است؛ سبا سیستم مجموعه‌ای ماژولار برای فورواردری و حمل ترکیبی ارائه می‌کند؛ و زمزم رایانه گستر که نسخه اولیه راهکارش را متعلق به سال ۱۳۸۰ معرفی کرده، عملیات چهار شیوه حمل و زیرسیستم‌های قابل‌افزودن را پوشش می‌دهد.</p>
        </div>
    </div>
</section>

<section class="section" aria-labelledby="options-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">چهار گزینه در یک نگاه</span><h2 class="section-title" id="options-title">هر نرم‌افزار چگونه<br><span>خود را معرفی می‌کند؟</span></h2></div>
        <div class="option-grid named-option-grid">
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
                <span class="option-badge">راهکار تحت وب</span>
                <h3>رویان TMS</h3>
                <dl>
                    <div><dt>تعریف رسمی</dt><dd>سامانه تحت وب برای فرایندهای حمل بین‌المللی، اسناد، ارتباط مشتری، گزارش‌گیری، امور مالی و رهگیری.</dd></div>
                    <div><dt>دامنه اعلام‌شده</dt><dd>حمل هوایی، زمینی و دریایی برای فورواردرها و کریرها.</dd></div>
                    <div><dt>ارائه</dt><dd>پلن اختصاصی، ابری اشتراکی و ابری اختصاصی.</dd></div>
                </dl>
                <a class="option-source" href="https://royantms.com/" target="_blank" rel="nofollow noopener noreferrer">اطلاعات رسمی رویان</a>
            </article>
            <article class="option-card is-market reveal">
                <span class="option-badge">راهکار ماژولار</span>
                <h3>سبا سیستم</h3>
                <dl>
                    <div><dt>تعریف رسمی</dt><dd>نرم‌افزار فورواردری و حمل ترکیبی با ماژول‌های CRM، رهگیری، مالی، هوش تجاری و باشگاه مشتریان.</dd></div>
                    <div><dt>دامنه اعلام‌شده</dt><dd>عملیات فورواردری و حمل چندوجهی، همراه با محصولات تخصصی کریری و نمایندگی کشتیرانی.</dd></div>
                    <div><dt>ارائه</dt><dd>تحت وب، ماژولار و قابل‌اتصال به سامانه‌های دیگر از طریق API.</dd></div>
                </dl>
                <a class="option-source" href="https://sabanetsystem.com/" target="_blank" rel="nofollow noopener noreferrer">اطلاعات رسمی سبا سیستم</a>
            </article>
            <article class="option-card is-market reveal">
                <span class="option-badge">نسخه اولیه از سال ۱۳۸۰</span>
                <h3>زمزم رایانه گستر</h3>
                <dl>
                    <div><dt>تعریف رسمی</dt><dd>سیستم جامع مدیریت حمل‌ونقل بین‌المللی برای شرکت‌های فورواردری، کریری یا ترکیبی.</dd></div>
                    <div><dt>دامنه اعلام‌شده</dt><dd>حمل زمینی، هوایی، دریایی و ریلی، اسناد، مانیفست، هزینه‌ها و رهگیری.</dd></div>
                    <div><dt>ارائه</dt><dd>محیط شبکه؛ دسترسی اینترنتی، استقرار ابری و زیرسیستم‌ها با برآورد جداگانه.</dd></div>
                </dl>
                <a class="option-source" href="https://zrgco.ir/zrgtransport/" target="_blank" rel="nofollow noopener noreferrer">اطلاعات رسمی زمزم رایانه گستر</a>
            </article>
        </div>
    </div>
</section>

<section class="section soft" id="comparison-table" aria-labelledby="comparison-table-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">جدول تصمیم‌گیری</span><h2 class="section-title" id="comparison-table-title">سپند، رویان، سبا سیستم و<br><span>زمزم رایانه گستر در یک جدول</span></h2><p class="section-sub">اطلاعات ستون رقبا از وب‌سایت رسمی آن‌ها در مرداد ۱۴۰۵ استخراج شده است. عبارت «اعلام نشده» به معنی نبود قابلیت نیست؛ یعنی در صفحه عمومی بررسی‌شده، تصریح روشنی برای آن پیدا نشد.</p></div>
        <div class="comparison-table-wrap reveal">
            <table class="comparison-table">
                <caption>مقایسه نرم‌افزار مدیریت حمل‌ونقل سپند با رویان، سبا سیستم و زمزم رایانه گستر بر اساس اطلاعات عمومی محصولات</caption>
                <thead><tr><th scope="col">معیار</th><th scope="col">سپند</th><th scope="col">رویان</th><th scope="col">سبا سیستم</th><th scope="col">زمزم رایانه گستر</th></tr></thead>
                <tbody>
                    <tr><th scope="row">تمرکز اصلی</th><td class="is-strong">فورواردری و حمل بین‌المللی یکپارچه</td><td>حمل بین‌المللی برای فورواردر و کریر</td><td>فورواردری، حمل ترکیبی و راهکارهای کریری</td><td>حمل بین‌المللی برای فورواردر و کریر</td></tr>
                    <tr><th scope="row">شیوه‌های حمل اعلام‌شده</th><td class="is-strong">دریایی، هوایی، زمینی و ریلی</td><td>هوایی، زمینی و دریایی</td><td>حمل ترکیبی؛ دریایی، زمینی و هوایی</td><td>زمینی، هوایی، دریایی و ریلی</td></tr>
                    <tr><th scope="row">CRM، فروش و استعلام</th><td class="is-strong">CRM، لید و استعلام متصل به پرونده حمل</td><td>ارتباط مشتری و فرایند استعلام</td><td>CRM و مدیریت بازاریابی و فروش</td><td>ثبت استعلام؛ اتصال Microsoft CRM با هزینه جداگانه</td></tr>
                    <tr><th scope="row">عملیات و اسناد حمل</th><td class="is-strong">Booking، پرونده، اسناد و وظایف در یک جریان</td><td>عملیات صادرات و واردات و اتوماسیون اسناد</td><td>عملیات فورواردری، بارنامه و مستندسازی</td><td>سفر، مانیفست، بارنامه، راه‌نامه و بایگانی اسناد</td></tr>
                    <tr><th scope="row">مالی و هزینه پرونده</th><td class="is-strong">مالی چندارزی، دریافت‌وپرداخت و سود پرونده</td><td>امور مالی و اتصال به سیستم‌های مالی</td><td>کنترل مالی چندارزی و مدیریت یکپارچه مالی</td><td>هزینه و صورتحساب حمل؛ اتصال به سیستم مالی به‌صورت زیرسیستم</td></tr>
                    <tr><th scope="row">رهگیری و پرتال مشتری</th><td class="is-strong">پرتال استعلام، محموله، رهگیری و مالی</td><td>رهگیری محموله و اطلاع‌رسانی خودکار</td><td>رهگیری و پرتال متمرکز مشتریان</td><td>رهگیری عملیاتی؛ اطلاع‌رسانی وب‌سایت به‌صورت زیرسیستم</td></tr>
                    <tr><th scope="row">پیامک و ارتباطات</th><td class="is-strong">ارسال پیامک و ثبت سابقه در پرونده</td><td>پیام‌رسانی داخلی و پیام‌های خودکار</td><td>اطلاع‌رسانی خودکار و ماژول‌های ارتباط با مشتری</td><td>اطلاع‌رسانی پیامکی با برآورد هزینه جداگانه</td></tr>
                    <tr><th scope="row">نوع استقرار اعلام‌شده</th><td>متناسب با تحلیل و قرارداد استقرار</td><td>اختصاصی، ابری اشتراکی یا ابری اختصاصی</td><td>تحت وب و ماژولار</td><td>شبکه داخلی؛ اینترنت و ابر با برآورد جداگانه</td></tr>
                    <tr><th scope="row">سفارشی‌سازی و اتصال</th><td>ترکیب ماژول‌ها و استقرار متناسب با فرایند</td><td>ماژول‌های قابل تنظیم و API؛ توسعه اختصاصی مشتری اعلام نشده</td><td>ساختار ماژولار، قابل توسعه و دارای API</td><td>گزارش‌ها و زیرسیستم‌های درخواستی با برآورد جداگانه</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<section class="section" aria-labelledby="differences-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">تفاوت‌های کلیدی</span><h2 class="section-title" id="differences-title">چه چیزی نتیجه انتخاب را<br><span>تغییر می‌دهد؟</span></h2></div>
        <div class="difference-grid">
            <article class="difference-card reveal"><span>۰۱</span><h3>دامنه حمل</h3><p>سپند و زمزم رایانه گستر هر چهار شیوه دریایی، هوایی، زمینی و ریلی را صریحاً معرفی کرده‌اند؛ رویان سه شیوه هوایی، زمینی و دریایی و سبا سیستم حمل ترکیبی را برجسته می‌کند.</p></article>
            <article class="difference-card reveal"><span>۰۲</span><h3>معماری CRM تا مالی</h3><p>سپند این مسیر را در یک پرونده مشترک عرضه می‌کند. سبا سیستم نیز مجموعه ماژولار گسترده دارد؛ رویان بر عملیات تحت وب و زمزم بر زیرسیستم‌های قابل‌افزودن تکیه دارند.</p></article>
            <article class="difference-card reveal"><span>۰۳</span><h3>تجربه مشتری</h3><p>سپند و سبا سیستم پرتال مشتری را صریح معرفی کرده‌اند. رویان رهگیری و اطلاع‌رسانی را پوشش می‌دهد و زمزم، اطلاع‌رسانی از طریق وب‌سایت و پیامک را به‌صورت زیرسیستم ارائه می‌کند.</p></article>
            <article class="difference-card reveal"><span>۰۴</span><h3>شیوه استقرار</h3><p>رویان سه مدل اختصاصی و ابری را اعلام کرده است؛ سبا سیستم تحت وب است؛ زمزم شبکه داخلی را مبنا قرار داده و اینترنت یا ابر را جداگانه ارائه می‌کند؛ استقرار سپند پس از تحلیل فرایند پیشنهاد می‌شود.</p></article>
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
                <h3>رویان، سبا سیستم یا زمزم رایانه گستر را جدی‌تر بررسی کنید اگر:</h3>
                <ul>
                    <li>مدل ابری پلن‌بندی‌شده و قیمت عمومی رویان با نیازتان هم‌راستاست.</li>
                    <li>سبد ماژولار و راهکارهای تخصصی کریری یا نمایندگی کشتیرانی سبا سیستم برایتان مهم است.</li>
                    <li>ساختار شبکه داخلی و زیرسیستم‌های جداگانه زمزم با زیرساخت سازمانتان هماهنگ‌تر است.</li>
                    <li>اکوسیستم فعلی شرکت شما از قبل با یکی از این محصولات یکپارچه شده است.</li>
                    <li>دموی یکی از رقبا سناریوی واقعی شما را با تغییر فرایند کمتر پوشش می‌دهد.</li>
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
            <p>سپند زمانی گزینه جدی‌تری است که اتصال CRM، فروش، عملیات، مالی، پیامک و پرتال مشتری برایتان معیار اصلی باشد. رویان را برای تجربه تحت وب و مدل‌های استقرار اعلام‌شده، سبا سیستم را برای سبد ماژولار فورواردری و کریری، و زمزم رایانه گستر را برای فرایندهای چهار شیوه حمل و استقرار شبکه‌ای بررسی کنید. تصمیم نهایی را با اجرای یک سناریوی واقعی و یکسان در دموی هر چهار محصول و مقایسه هزینه کل استقرار بگیرید.</p>
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

<section class="cta-wrap"><div class="container"><div class="cta reveal"><div class="cta-copy"><h2>هنوز بین سپند، رویان، سبا سیستم و زمزم رایانه گستر مردد هستید؟</h2><p>سناریوی واقعی، ابزارهای موجود و نیازهای تیم شما را بررسی می‌کنیم تا معیارهای انتخاب و تناسب سپند با سازمانتان روشن شود.</p></div><div class="cta-action"><a class="btn" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="comparison_named_software_consultation">درخواست مشاوره</a></div></div></div></section>
@endsection
