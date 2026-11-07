@extends('layouts.marketing')

@php
    $issues = [
        [
            'title' => 'سابقه مشتری بین فایل‌ها و پیام‌ها پراکنده است',
            'impact' => 'کارشناس پیش از پاسخ‌گویی باید آخرین مذاکره، درخواست حمل و نتیجه تماس‌ها را از چند محل جمع کند.',
            'action' => 'مشتری، افراد مرتبط، استعلام و فعالیت‌های ثبت‌شده را در پرونده همان مشتری مرور می‌کند.',
            'output' => 'کاربر مجاز به سابقه‌ای واحد و قابل مراجعه دسترسی دارد و می‌بیند آخرین اقدام چه بوده است.',
            'example' => 'مثال: پیش از پاسخ به درخواست نرخ جدید، کارشناس استعلام قبلی و یادداشت آخرین تماس را در همان پرونده می‌بیند.',
        ],
        [
            'title' => 'پیشنهاد نرخ ارسال شده، اما پیگیری نمی‌شود',
            'impact' => 'وضعیت فرصت و پاسخ مشتری نامشخص می‌ماند و پیشنهاد باز، بدون اقدام بعدی در میان کارهای روزانه گم می‌شود.',
            'action' => 'برای استعلام، مسئول، تسک زمان‌دار و اقدام بعدی ثبت می‌شود؛ موارد بدون پیگیری آینده نیز در فهرست جدا دیده می‌شوند.',
            'output' => 'کارشناس می‌داند کدام پیشنهاد اکنون به تماس، دریافت پاسخ یا ثبت نتیجه نیاز دارد.',
            'example' => 'مثال: پس از ثبت ارسال پیشنهاد، موعد تماس دو روز بعد تعیین و نتیجه تماس در سابقه استعلام ثبت می‌شود.',
        ],
        [
            'title' => 'کارهای عقب‌افتاده میان کارهای روزانه پنهان می‌شوند',
            'impact' => 'اولویت‌بندی به حافظه کارشناس وابسته می‌شود و تسکی که از موعد گذشته ممکن است دیر دیده شود.',
            'action' => 'داشبورد «پیگیری‌های من» را باز می‌کند و استعلام‌های عقب‌افتاده، بدون اقدام بعدی، کارهای امروز و پیگیری‌های آینده را جدا می‌بیند.',
            'output' => 'فهرست اولویت‌های روز بر اساس موعد واقعی تسک‌ها مشخص است.',
            'example' => 'مثال: تسکی که موعد آن گذشته، از گروه امروز خارج و در فهرست عقب‌افتاده نمایش داده می‌شود.',
        ],
        [
            'title' => 'مدیر برای اطلاع از وضعیت فروش باید از همه گزارش بگیرد',
            'impact' => 'تصمیم‌گیری به پیام‌ها و گزارش‌های دستی وابسته می‌شود و موارد نیازمند اقدام به‌موقع جمع‌بندی نمی‌شوند.',
            'action' => 'نماهای موجودِ پیگیری‌های عقب‌افتاده، بدون اقدام بعدی، امروز و آینده را بررسی می‌کند و از پرونده هر مورد به جزئیات می‌رود.',
            'output' => 'وضعیت پیگیری‌ها و موارد نیازمند اقدام در خود محصول قابل مشاهده است و گزارش‌های تحلیلی تأییدنشده وعده داده نمی‌شوند.',
            'example' => 'مثال: مدیر ابتدا تعداد استعلام‌های بدون اقدام بعدی را می‌بیند و سپس مسئول و سابقه هر پرونده را بررسی می‌کند.',
        ],
        [
            'title' => 'با جابه‌جایی کارشناس، سابقه پیگیری در دسترس تیم نیست',
            'impact' => 'مذاکره از ابتدا تکرار می‌شود و تیم نمی‌داند مشتری قبلاً چه پاسخی داده یا چه قولی ثبت شده است.',
            'action' => 'سوابق فعالیت، مذاکره، پیامک و تسک‌های ثبت‌شده را در پرونده سازمانی نگه می‌دارد و دسترسی را بر اساس نقش کاربر مدیریت می‌کند.',
            'output' => 'کاربر مجاز می‌تواند ادامه پیگیری را بر پایه سابقه ثبت‌شده انجام دهد؛ انتقال خودکار مسئولیت ادعا نمی‌شود.',
            'example' => 'مثال: کارشناس جدید پیش از تماس، یادداشت آخرین گفت‌وگو و موعد پیگیری قبلی را مرور می‌کند.',
        ],
        [
            'title' => 'فروش تأیید شده، اما عملیات دوباره اطلاعات می‌خواهد',
            'impact' => 'اطلاعات پایه مشتری، مسیر، محموله و پیشنهاد پذیرفته‌شده دوباره وارد می‌شود و احتمال اختلاف افزایش پیدا می‌کند.',
            'action' => 'پس از تأیید پیشنهاد، Booking مرتبط از استعلام ساخته می‌شود و تصویر ثابتی از اطلاعات مشتری، مسیر، محموله و پیشنهاد پذیرفته‌شده نگه می‌دارد.',
            'output' => 'عملیات از داده‌های مشخصِ استعلام و پیشنهاد تأییدشده شروع می‌کند؛ انتقال همه تعهدات یا مدارک وعده داده نمی‌شود.',
            'example' => 'مثال: مسیر نینگبو به بندرعباس، مشخصات محموله و اقلام پیشنهاد پذیرفته‌شده در Booking قابل استفاده‌اند.',
        ],
    ];

    $scenario = [
        ['title' => 'ثبت مشتری و درخواست حمل', 'action' => 'کارشناس مشتری، افراد مرتبط و درخواست حمل دریایی نینگبو به بندرعباس را ثبت می‌کند.', 'result' => 'نتیجه در پرونده مشتری و فهرست استعلام‌ها دیده می‌شود.'],
        ['title' => 'مشخص‌کردن مسئول و اطلاعات موردنیاز', 'action' => 'مالک استعلام، مشخصات مسیر، محموله و داده‌های لازم برای بررسی نرخ تکمیل می‌شوند.', 'result' => 'مسئول پرونده و جزئیات درخواست در استعلام قابل مشاهده‌اند.'],
        ['title' => 'بررسی نرخ', 'action' => 'کارشناس نرخ، بررسی و مقایسه تأمین‌کننده را در ماژول نرخ‌دهی ادامه می‌دهد.', 'result' => 'نرخ‌ها و اقلام مورد استفاده برای پیشنهاد در همان جریان استعلام باقی می‌مانند.'],
        ['title' => 'ثبت ارسال پیشنهاد', 'action' => 'پس از آماده‌شدن پیشنهاد، ارسال آن به مشتری در پرونده ثبت می‌شود.', 'result' => 'زمان ارسال و پیشنهاد مرتبط با استعلام قابل مراجعه‌اند.'],
        ['title' => 'تعیین موعد و اقدام بعدی', 'action' => 'کاربر تسک پیگیری را با مسئول و موعد مشخص ثبت می‌کند یا از قالب خودکار مرتبط استفاده می‌شود.', 'result' => 'پیگیری در فهرست امروز، آینده یا عقب‌افتاده قرار می‌گیرد.'],
        ['title' => 'ثبت پاسخ یا ادامه پیگیری', 'action' => 'پاسخ مشتری یا فعالیت انجام‌شده ثبت و در صورت بازماندن تصمیم، اقدام بعدی تازه ساخته می‌شود.', 'result' => 'آخرین اقدام و موعد بعدی در سابقه پرونده باقی می‌مانند.'],
        ['title' => 'ادامه پیشنهاد تأییدشده در Booking', 'action' => 'پس از موفق‌شدن استعلام و تأیید پیشنهاد، Booking مرتبط ساخته می‌شود.', 'result' => 'مشتری، مسیر، محموله و تصویر پیشنهاد پذیرفته‌شده مبنای ادامه پرونده هستند.'],
    ];

    $faqs = [
        ['question' => 'چگونه استعلام‌های بدون پیگیری را پیدا کنیم؟', 'answer' => 'در داشبورد «پیگیری‌های من»، استعلام‌های بازِ بدون تسک فعال و زمان‌دار در فهرست «بدون اقدام بعدی» نمایش داده می‌شوند تا کارشناس برای آن‌ها پیگیری ثبت کند.'],
        ['question' => 'کارشناس از کجا بداند امروز کدام مشتری را پیگیری کند؟', 'answer' => 'تسک‌های فعال تا پایان همان روز در فهرست کارهای امروز و موارد عبورکرده از موعد در فهرست عقب‌افتاده دیده می‌شوند.'],
        ['question' => 'آیا برای پیشنهاد ارسال‌شده می‌توان اقدام بعدی تعیین کرد؟', 'answer' => 'بله. کاربر می‌تواند برای استعلام مرتبط، تسک زمان‌دار با مسئول و موعد مشخص ثبت کند و نتیجه تماس یا پاسخ مشتری را در سابقه پرونده نگه دارد.'],
        ['question' => 'چه پیگیری‌هایی به‌صورت خودکار ساخته می‌شوند؟', 'answer' => 'قالب‌های فعلی محصول برای لید جدید، استعلام جدید، پیشنهاد نرخ ارسال‌شده و لید یا استعلام فعالِ بدون پیگیری آینده تسک می‌سازند. فعال‌بودن و تنظیم هر قاعده در سازمان قابل مدیریت است.'],
        ['question' => 'اطلاعات فروش چگونه به Booking متصل می‌شود؟', 'answer' => 'پس از تأیید پیشنهاد، Booking با ارتباط به استعلام، مشتری و پیشنهاد پذیرفته‌شده ساخته می‌شود و تصویر اطلاعات مسیر، محموله و اقلام پیشنهاد را نگه می‌دارد.'],
    ];

    $breadcrumbItems = [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'صفحه اصلی', 'item' => route('home')],
        ['@type' => 'ListItem', 'position' => 2, 'name' => 'راهکارها', 'item' => route('solutions.index')],
        ['@type' => 'ListItem', 'position' => 3, 'name' => 'پیگیری مشتریان و استعلام‌های حمل‌ونقل', 'item' => $canonical],
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
            'name' => 'سناریوی آموزشی پیگیری استعلام حمل دریایی',
            'step' => array_map(static fn (array $step, int $index): array => [
                '@type' => 'HowToStep',
                'position' => $index + 1,
                'name' => $step['title'],
                'text' => $step['action'].' '.$step['result'],
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
<link rel="stylesheet" href="{{ asset('assets/css/marketing-sales-follow-up.css') }}?v=20261107-1">
@endpush

@section('content')
<section class="page-hero sales-follow-hero">
    <div class="container hero-inner">
        <div class="hero-copy reveal">
            <nav class="breadcrumb" aria-label="مسیر صفحه">
                <a href="{{ route('home') }}">صفحه اصلی</a><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                <a href="{{ route('solutions.index') }}">راهکارها</a><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                <span>پیگیری فروش حمل‌ونقل</span>
            </nav>
            <span class="sales-eyebrow">راهکار پیگیری مشتریان حمل‌ونقل</span>
            <h1>راهکار مدیریت پیگیری مشتریان و فروش حمل‌ونقل</h1>
            <p>مشتری درخواست نرخ داده و پیشنهاد ارسال شده است؛ اما آخرین پیگیری، پاسخ مشتری و مسئول اقدام بعدی روشن نیست. سپند مشتری، استعلام، مسئول، سابقه ارتباط و تسک بعدی را در یک مسیر مرتبط نگه می‌دارد تا کارشناس بداند کدام پرونده اکنون به اقدام نیاز دارد.</p>
            <div class="hero-actions">
                <a class="btn btn-primary" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="freight_sales_hero_demo">درخواست دموی پیگیری فروش</a>
                <a class="btn btn-outline" href="#sales-solutions">ببینید سپند چگونه کمک می‌کند</a>
            </div>
        </div>
        <aside class="sales-hero-card reveal" aria-label="خروجی قابل مشاهده راهکار">
            <span>در پایان هر پیگیری چه چیزی روشن است؟</span>
            <ul>
                <li><strong>مسئول</strong><small>پیگیری بر عهده چه کسی است؟</small></li>
                <li><strong>آخرین اقدام</strong><small>چه تماس یا فعالیتی ثبت شده است؟</small></li>
                <li><strong>موعد</strong><small>اقدام بعدی چه زمانی انجام می‌شود؟</small></li>
                <li><strong>وضعیت</strong><small>پرونده امروز، آینده یا عقب‌افتاده است؟</small></li>
            </ul>
        </aside>
    </div>
</section>

<section class="section sales-issues" id="sales-solutions" aria-labelledby="sales-solutions-title">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label">مسئله و راهکار</span>
            <h2 class="section-title" id="sales-solutions-title">شش نقطه‌ای که پیگیری فروش حمل<br><span>از کنترل تیم خارج می‌شود</span></h2>
            <p class="section-sub">هر مورد از یک مشکل روزمره شروع می‌شود و با اقدامی که در محصول قابل انجام است پایان می‌گیرد.</p>
        </div>
        <div class="sales-issue-list">
            @foreach($issues as $issue)
                <article class="sales-issue reveal">
                    <div class="sales-issue-heading"><span>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span><h3>{{ $issue['title'] }}</h3></div>
                    <div class="sales-issue-details">
                        <div><strong>پیامد روزانه</strong><p>{{ $issue['impact'] }}</p></div>
                        <div><strong>اقدام در سپند</strong><p>{{ $issue['action'] }}</p></div>
                        <div><strong>خروجی قابل مشاهده</strong><p>{{ $issue['output'] }}</p></div>
                        <p class="sales-example">{{ $issue['example'] }}</p>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="section soft sales-evidence" id="product-evidence" aria-labelledby="product-evidence-title">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label">شواهد واقعی محصول</span>
            <h2 class="section-title" id="product-evidence-title">پیگیری‌ها و قواعد ساخت تسک<br><span>در محیط واقعی سپند</span></h2>
            <p class="section-sub">این دو تصویر از خود محصول انتخاب شده‌اند و نام یا اطلاعات مشتری مشخصی نمایش نمی‌دهند.</p>
        </div>
        <div class="sales-evidence-grid">
            <figure class="sales-evidence-card reveal">
                <a href="{{ asset('assets/images/marketing/product-showcase/desktop-dashboard.webp') }}" target="_blank" rel="noopener">
                    <img src="{{ asset('assets/images/marketing/product-showcase/desktop-dashboard.webp') }}" alt="داشبورد واقعی پیگیری‌های من با تفکیک استعلام عقب‌افتاده، بدون اقدام بعدی، کارهای امروز و پیگیری آینده" width="1600" height="799" loading="lazy">
                </a>
                <figcaption><strong>پیگیری‌های من</strong><span>چهار فهرست مستقل برای عقب‌افتاده، بدون اقدام بعدی، امروز و آینده؛ برای بزرگ‌نمایی تصویر را باز کنید.</span></figcaption>
            </figure>
            <figure class="sales-evidence-card reveal">
                <a href="{{ asset('assets/images/marketing/modules/screenshots/automatic-task-rules.webp') }}" target="_blank" rel="noopener">
                    <img src="{{ asset('assets/images/marketing/modules/screenshots/automatic-task-rules.webp') }}" alt="نمای واقعی قوانین ساخت تسک خودکار در سپند همراه رویداد شروع، وضعیت و آخرین اجرا" width="1600" height="851" loading="lazy">
                </a>
                <figcaption><strong>قوانین ساخت تسک خودکار</strong><span>فهرست قواعد، رویداد شروع، وضعیت فعال یا غیرفعال و نتیجه اجرای قواعد؛ بدون نمایش داده شخصی مشتری.</span></figcaption>
            </figure>
        </div>
    </div>
</section>

<section class="section sales-scenario" id="educational-scenario" aria-labelledby="educational-scenario-title">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label">سناریوی آموزشی</span>
            <h2 class="section-title" id="educational-scenario-title">درخواست حمل دریایی از نینگبو<br><span>تا بندرعباس چگونه پیگیری می‌شود؟</span></h2>
            <p class="section-sub">این مثال برای آموزش مسیر محصول است و مطالعه موردی یک مشتری واقعی نیست.</p>
        </div>
        <ol class="sales-scenario-list">
            @foreach($scenario as $step)
                <li class="reveal">
                    <span>{{ $loop->iteration }}</span>
                    <div><h3>{{ $step['title'] }}</h3><p>{{ $step['action'] }}</p><strong>{{ $step['result'] }}</strong></div>
                </li>
            @endforeach
        </ol>
        <p class="sales-scenario-links reveal">جزئیات آماده‌سازی پیشنهاد در <a href="{{ route('site.modules.show', ['module' => 'pricing-sales']) }}">ماژول نرخ‌دهی و فروش</a> و ادامه پرونده تأییدشده در <a href="{{ route('site.modules.show', ['module' => 'booking']) }}">ماژول Booking</a> توضیح داده شده است.</p>
    </div>
</section>

<section class="section soft sales-follow-mode" id="manual-and-automatic" aria-labelledby="manual-and-automatic-title">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label">پیگیری دستی و خودکار</span>
            <h2 class="section-title" id="manual-and-automatic-title">اقدام بعدی را کاربر ثبت می‌کند؛<br><span>رویدادهای مشخص می‌توانند تسک بسازند</span></h2>
            <p class="section-sub">در مدیریت فروش شرکت‌های حمل‌ونقل، پیگیری پیشنهاد قیمت حمل همیشه یکسان نیست؛ بخشی با تصمیم کارشناس و بخش تکرارشونده با قواعد اتوماسیون فروش فورواردری انجام می‌شود.</p>
        </div>
        <div class="sales-mode-grid">
            <article class="sales-mode-card reveal">
                <span>ثبت دستی</span><h3>وقتی زمان و نوع پیگیری به تصمیم کارشناس وابسته است</h3>
                <p>کاربر در پرونده مشتری یا استعلام، عنوان تسک، مسئول و موعد را ثبت می‌کند. پس از تماس یا دریافت پاسخ، فعالیت انجام‌شده ثبت می‌شود و در صورت نیاز اقدام بعدی تازه‌ای ساخته می‌شود.</p>
                <strong>خروجی: مسئول، سررسید و سابقه نتیجه در پرونده قابل مشاهده‌اند.</strong>
            </article>
            <article class="sales-mode-card reveal">
                <span>قواعد موجود محصول</span><h3>وقتی یک رویداد پرتکرار باید پیگیری استاندارد بسازد</h3>
                <ul>
                    <li>ایجاد لید جدید: پیگیری برای مالک لید یا ایجادکننده</li>
                    <li>لید فعال بدون تسک آینده: ساخت پیگیری زمان‌بندی‌شده</li>
                    <li>ایجاد استعلام جدید: پیگیری برای مالک استعلام</li>
                    <li>ثبت ارسال پیشنهاد نرخ: پیگیری دو روز بعد برای مالک استعلام</li>
                    <li>استعلام فعال بدون تسک آینده: ساخت پیگیری زمان‌بندی‌شده</li>
                    <li>موفق یا ناموفق‌شدن استعلام: لغو پیگیری‌های باز و خودکار مرتبط</li>
                </ul>
                <a href="{{ route('site.modules.show', ['module' => 'automatic-tasks']) }}">جزئیات پیگیری خودکار در سپند <span aria-hidden="true">←</span></a>
            </article>
        </div>
        <p class="sales-note reveal">کنترل خودکار زمان پاسخ، ارجاع مرحله‌ای فرصت بی‌پاسخ، تأیید حاشیه سود و بازگرداندن خودکار پرونده ناقص در این صفحه به‌عنوان قابلیت موجود وعده داده نمی‌شوند.</p>
    </div>
</section>

<section class="section sales-booking" id="booking-continuity" aria-labelledby="booking-continuity-title">
    <div class="container sales-booking-layout">
        <div class="reveal">
            <span class="section-label">ادامه فروش تأییدشده</span>
            <h2 class="section-title" id="booking-continuity-title">چه اطلاعاتی واقعاً<br><span>به Booking ادامه پیدا می‌کند؟</span></h2>
            <p>Booking به استعلام، مشتری و پیشنهاد پذیرفته‌شده متصل می‌شود. محصول از اطلاعات مشخص استعلام و پیشنهاد تصویر ثابتی نگه می‌دارد؛ نه اینکه انتقال همه مدارک یا تعهدهای فروش را بدون بررسی وعده دهد.</p>
            <a class="btn btn-outline" href="{{ route('site.modules.show', ['module' => 'booking']) }}">مشاهده ماژول Booking</a>
        </div>
        <ul class="sales-booking-data reveal">
            <li><strong>مشتری</strong><span>شناسه، نام، شرکت، موبایل و نشانی ثبت‌شده</span></li>
            <li><strong>درخواست حمل</strong><span>نوع خدمت، روش حمل، مسیرها، شرایط حمل و پرداخت</span></li>
            <li><strong>محموله</strong><span>اقلام، نوع کالا، وزن، تعداد، حجم و نیازهای ثبت‌شده</span></li>
            <li><strong>پیشنهاد پذیرفته‌شده</strong><span>کد، تأمین‌کننده، اعتبار، زمان حمل و اقلام هزینه</span></li>
        </ul>
    </div>
</section>

<section class="section soft sales-results" id="verifiable-results" aria-labelledby="verifiable-results-title">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label">نتیجه قابل بررسی</span>
            <h2 class="section-title" id="verifiable-results-title">به‌جای وعده افزایش قطعی فروش،<br><span>این خروجی‌ها را در محصول ببینید</span></h2>
        </div>
        <div class="sales-result-grid">
            <article class="reveal"><strong>مسئول مشخص</strong><p>مالک استعلام یا تسک در جزئیات پرونده دیده می‌شود.</p></article>
            <article class="reveal"><strong>آخرین اقدام قابل مراجعه</strong><p>فعالیت و نتیجه ثبت‌شده در سابقه پرونده باقی می‌ماند.</p></article>
            <article class="reveal"><strong>موعد و اقدام بعدی</strong><p>تسک فعال و زمان‌بندی پیگیری بعدی قابل مشاهده است.</p></article>
            <article class="reveal"><strong>عقب‌افتادگی قابل شناسایی</strong><p>موارد عبورکرده از موعد در فهرست جدا نمایش داده می‌شوند.</p></article>
        </div>
        <div class="sales-measurement reveal">
            <div><span>شاخص پیشنهادی ارزیابی</span><h3>قبل و بعد از استقرار چه چیزی را اندازه بگیریم؟</h3></div>
            <ul><li>تعداد استعلام بازِ بدون اقدام بعدی</li><li>تعداد پیگیری‌های عقب‌افتاده</li><li>فاصله ارسال پیشنهاد تا نخستین پیگیری ثبت‌شده</li><li>سهم استعلام‌های دارای مسئول و موعد روشن</li></ul>
            <p>این موارد پیشنهاد ارزیابی فرایند هستند و به معنی وجود گزارش آماده با همین نام‌ها در نرم‌افزار نیستند.</p>
        </div>
    </div>
</section>

<section class="section sales-related" id="related-pages" aria-labelledby="related-pages-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">صفحات مرتبط</span><h2 class="section-title" id="related-pages-title">هر بخش تخصصی را<br><span>در صفحه خودش بررسی کنید</span></h2></div>
        <div class="sales-related-grid">
            <a class="reveal" href="{{ route('site.modules.show', ['module' => 'crm']) }}"><strong>امکانات CRM حمل‌ونقل سپند</strong><span>پرونده مشتری، فعالیت‌ها و پیگیری‌های من</span></a>
            <a class="reveal" href="{{ route('site.modules.show', ['module' => 'pricing-sales']) }}"><strong>آماده‌سازی پیشنهاد نرخ حمل</strong><span>نرخ، تأمین‌کننده و پیشنهاد مشتری</span></a>
            <a class="reveal" href="{{ route('site.modules.show', ['module' => 'automatic-tasks']) }}"><strong>پیگیری خودکار فروش</strong><span>رویدادها، مسئول و زمان ساخت تسک</span></a>
            <a class="reveal" href="{{ route('site.modules.show', ['module' => 'booking']) }}"><strong>ادامه پرونده در Booking</strong><span>استفاده از استعلام و پیشنهاد پذیرفته‌شده</span></a>
        </div>
    </div>
</section>

<section class="section soft" id="sales-faq" aria-labelledby="sales-faq-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">پرسش‌های متداول</span><h2 class="section-title" id="sales-faq-title">پرسش‌های رایج درباره<br><span>پیگیری استعلام حمل</span></h2></div>
        <div class="faq">@foreach($faqs as $faq)<details class="reveal"><summary>{{ $faq['question'] }}</summary><p>{{ $faq['answer'] }}</p></details>@endforeach</div>
    </div>
</section>

<section class="cta-wrap"><div class="container"><div class="cta reveal"><div class="cta-copy"><h2>پیگیری یک استعلام واقعی را در سپند ببینید</h2><p>در دمو، مسیر ثبت درخواست، تعیین مسئول، آماده‌سازی و ارسال پیشنهاد، ثبت موعد و پیگیری پاسخ مشتری با یک سناریوی نزدیک به روال تیم شما نمایش داده می‌شود.</p></div><div class="cta-action"><a class="btn" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="freight_sales_bottom_demo">درخواست دموی پیگیری فروش</a></div></div></div></section>
@endsection
