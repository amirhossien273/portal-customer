@extends('layouts.marketing')

@php
    $categories = $hub['categories'] ?? [];
    $solutionMeta = $hub['solution_meta'] ?? [];
    $journey = $hub['journey'] ?? [];
    $evidenceItems = $hub['evidence'] ?? [];
@endphp

@push('head')
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'CollectionPage',
            '@id' => $canonical.'#collection',
            'url' => $canonical,
            'name' => $title,
            'description' => $description,
            'inLanguage' => 'fa-IR',
            'mainEntity' => [
                '@type' => 'ItemList',
                'numberOfItems' => count($solutions),
                'itemListElement' => collect($solutions)->values()->map(fn ($solution, $index) => [
                    '@type' => 'ListItem',
                    'position' => $index + 1,
                    'name' => $solution['nav_title'],
                    'url' => route('solutions.platform.show', ['solution' => $solution['slug']]),
                ])->all(),
            ],
        ],
        [
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'خانه', 'item' => route('home')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'راهکارها', 'item' => $canonical],
            ],
        ],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endpush

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/marketing-platform-solutions.css') }}?v=20260906-2">
@endpush

@section('content')
<section class="platform-hub-hero">
    <div class="container platform-hub-hero-grid">
        <div class="platform-hub-hero-copy reveal">
            <nav class="platform-hub-breadcrumb" aria-label="مسیر صفحه">
                <a href="{{ route('home') }}">خانه</a>
                <span aria-hidden="true">/</span>
                <span>راهکارها</span>
            </nav>
            <span class="platform-eyebrow">Solution Hub</span>
            <h1>از گلوگاه عملیاتی<br><span>به راهکار قابل اجرا</span></h1>
            <p>مسئله را از جایی که در سازمان دیده می‌شود انتخاب کنید؛ سپند مسیر مرتبط را از نرخ و برنامه‌ریزی تا عملیات، اسناد و نتیجه مالی نشان می‌دهد.</p>
            <div class="hero-actions">
                <a class="btn btn-primary" href="#solution-finder">پیدا کردن راهکار مناسب</a>
                <a class="btn btn-outline" href="#product-evidence">دیدن محصول در عمل</a>
            </div>
            <dl class="platform-hub-stats" aria-label="پوشش هاب راهکارها">
                <div><dt>{{ count($solutions) }}</dt><dd>راهکار پلتفرمی</dd></div>
                <div><dt>{{ $specializedSolutionsCount }}</dt><dd>سناریوی تخصصی</dd></div>
                <div><dt>۴</dt><dd>روش حمل متصل</dd></div>
            </dl>
        </div>

        <aside class="platform-hub-command reveal" aria-label="نقشه حوزه‌های راهکار سپند">
            <div class="platform-hub-command-head">
                <div>
                    <small>SEPAND SOLUTION MAP</small>
                    <strong>نقشه پوشش سازمان</strong>
                </div>
                <span><i></i> یکپارچه و فعال</span>
            </div>
            <div class="platform-hub-command-core">
                <span>پرونده حمل مرجع</span>
                <strong>یک داده مشترک؛<br>چند تصمیم هماهنگ</strong>
            </div>
            <div class="platform-hub-command-grid">
                @foreach(collect($categories)->except('all') as $categoryKey => $category)
                    <a href="#solution-finder" data-hub-preset="{{ $categoryKey }}">
                        <i aria-hidden="true"></i>
                        <span>{{ $category['label'] }}</span>
                        <small>{{ $category['description'] }}</small>
                    </a>
                @endforeach
            </div>
        </aside>
    </div>
</section>

<section class="section platform-finder-section" id="solution-finder" aria-labelledby="platform-title">
    <div class="container">
        <header class="section-head reveal">
            <span class="section-label">راهنمای انتخاب راهکار</span>
            <h2 class="section-title" id="platform-title">الان کدام مسئله برای شما مهم‌تر است؟</h2>
            <p class="section-sub">نام گلوگاه را جست‌وجو کنید یا حوزه را انتخاب کنید. فهرست بدون بارگذاری مجدد صفحه محدود می‌شود.</p>
        </header>

        <div class="platform-finder reveal" data-solution-finder>
            <div class="platform-finder-search">
                <label for="solution-search">جست‌وجو در راهکارها</label>
                <div>
                    <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="11" cy="11" r="7"></circle><path d="m20 20-4-4"></path></svg>
                    <input id="solution-search" type="search" autocomplete="off" placeholder="مثلاً تأخیر، نرخ، کانتینر، سود یا اسناد..." data-solution-search>
                    <button type="button" data-solution-clear aria-label="پاک کردن جست‌وجو">×</button>
                </div>
            </div>
            <div class="platform-finder-filters" role="group" aria-label="فیلتر حوزه راهکار">
                @foreach($categories as $categoryKey => $category)
                    <button type="button" class="{{ $categoryKey === 'all' ? 'is-active' : '' }}" data-solution-filter="{{ $categoryKey }}" aria-pressed="{{ $categoryKey === 'all' ? 'true' : 'false' }}">
                        <span>{{ $category['label'] }}</span>
                    </button>
                @endforeach
            </div>
            <p class="platform-finder-status" data-solution-status aria-live="polite">نمایش {{ count($solutions) }} راهکار پلتفرمی</p>
        </div>

        <div class="platform-hub-grid" data-solution-grid>
            @foreach($solutions as $solution)
                @php
                    $meta = $solutionMeta[$solution['slug']] ?? [];
                    $categoryKey = $meta['category'] ?? 'all';
                    $category = $categories[$categoryKey] ?? $categories['all'];
                    $searchText = implode(' ', [$solution['nav_title'], $solution['eyebrow'], $solution['nav_description'], $meta['problem'] ?? '', $meta['outcome'] ?? '']);
                @endphp
                <article class="platform-hub-card reveal" data-solution-card data-category="{{ $categoryKey }}" data-search="{{ $searchText }}">
                    <div class="platform-hub-card-top">
                        <span class="platform-hub-card-number">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <span class="platform-hub-card-category">{{ $category['label'] }}</span>
                    </div>
                    <div class="platform-hub-card-icon" aria-hidden="true">
                        @switch($categoryKey)
                            @case('commercial')
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M4 19V9m6 10V5m6 14v-7m4 7H2"></path></svg>
                                @break
                            @case('assets')
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M3 7h11v10H3zM14 11h4l3 3v3h-7z"></path><circle cx="7" cy="18" r="2"></circle><circle cx="18" cy="18" r="2"></circle></svg>
                                @break
                            @case('network')
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="5" cy="6" r="2"></circle><circle cx="19" cy="18" r="2"></circle><path d="M7 6h5a4 4 0 0 1 4 4v0a4 4 0 0 1-4 4H9a4 4 0 0 0-4 4v0"></path></svg>
                                @break
                            @case('documents')
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M6 2h8l4 4v16H6z"></path><path d="M14 2v5h5M9 12h6M9 16h6"></path></svg>
                                @break
                            @default
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M3 12h4l2-6 4 12 2-6h6"></path></svg>
                        @endswitch
                    </div>
                    <span class="platform-hub-card-eyebrow">{{ $solution['eyebrow'] }}</span>
                    <h3>{{ $solution['nav_title'] }}</h3>
                    <div class="platform-hub-card-copy">
                        <p><b>وقتی مناسب است که</b>{{ $meta['problem'] ?? $solution['problem'] }}</p>
                        <p><b>خروجی مورد انتظار</b>{{ $meta['outcome'] ?? $solution['nav_description'] }}</p>
                    </div>
                    <div class="platform-hub-card-tags" aria-label="قابلیت‌های کلیدی">
                        @foreach(array_slice($solution['capabilities'], 0, 2) as $capability)
                            <span>{{ $capability['title'] }}</span>
                        @endforeach
                    </div>
                    <a href="{{ route('solutions.platform.show', ['solution' => $solution['slug']]) }}">
                        بررسی کامل راهکار
                        <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="m15 18-6-6 6-6"></path></svg>
                    </a>
                </article>
            @endforeach
        </div>
        <div class="platform-finder-empty" data-solution-empty hidden>
            <strong>راهکاری با این عبارت پیدا نشد</strong>
            <span>عبارت کوتاه‌تری مثل «نرخ»، «سند» یا «ناوگان» وارد کنید.</span>
            <button type="button" data-solution-reset>نمایش همه راهکارها</button>
        </div>
    </div>
</section>

<section class="platform-journey-section" aria-labelledby="journey-title">
    <div class="container">
        <header class="platform-journey-head reveal">
            <div><span class="section-label">Connected Operations</span><h2 id="journey-title">یک پرونده؛ شش نقطه تصمیم متصل</h2></div>
            <p>راهکارها جزیره‌های جدا نیستند. داده هر مرحله باید تصمیم مرحله بعد را تغذیه کند و نتیجه دوباره به همان پرونده برگردد.</p>
        </header>
        <ol class="platform-journey">
            @foreach($journey as $stage)
                <li class="reveal">
                    <div class="platform-journey-number">{{ $stage['number'] }}</div>
                    <span>{{ $stage['eyebrow'] }}</span>
                    <h3>{{ $stage['title'] }}</h3>
                    <p>{{ $stage['text'] }}</p>
                    <div>
                        @foreach($stage['solutions'] as $slug)
                            @if(isset($solutions[$slug]))
                                <a href="{{ route('solutions.platform.show', ['solution' => $slug]) }}">{{ $solutions[$slug]['nav_title'] }}</a>
                            @endif
                        @endforeach
                    </div>
                </li>
            @endforeach
        </ol>
    </div>
</section>

<section class="section platform-hub-evidence" id="product-evidence" aria-labelledby="evidence-title">
    <div class="container">
        <header class="section-head reveal">
            <span class="section-label">Product Evidence</span>
            <h2 class="section-title" id="evidence-title">قبل از تصمیم، خود محصول را ببینید</h2>
            <p class="section-sub">هر نمونه به یک جریان واقعی در سپند متصل است؛ از داشبورد نمایشی و ادعای کلی استفاده نشده است.</p>
        </header>
        <div class="platform-hub-evidence-grid">
            @foreach($evidenceItems as $evidence)
                <article class="platform-hub-evidence-card reveal">
                    <a class="platform-hub-evidence-media" href="{{ route($evidence['route'], $evidence['parameters'] ?? []) }}" aria-label="مشاهده {{ $evidence['title'] }}">
                        <img src="{{ asset('assets/images/marketing/'.$evidence['image']) }}" alt="{{ $evidence['alt'] }}" width="1600" height="900" loading="lazy" decoding="async">
                    </a>
                    <div>
                        <span>{{ $evidence['eyebrow'] }}</span>
                        <h3>{{ $evidence['title'] }}</h3>
                        <p>{{ $evidence['description'] }}</p>
                        <a href="{{ route($evidence['route'], $evidence['parameters'] ?? []) }}">دیدن جریان مرتبط <b aria-hidden="true">←</b></a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="section soft platform-specialized-section" aria-labelledby="specialized-title">
    <div class="container">
        <header class="section-head reveal">
            <span class="section-label">سناریوهای تخصصی</span>
            <h2 class="section-title" id="specialized-title">اگر مسئله شما دقیق‌تر است</h2>
            <p class="section-sub">این مسیرها دامنه محدودتری دارند و برای نیت‌های مشخصی مثل NVOCC، HBL/MBL، Exception یا دیسپچ نوشته شده‌اند.</p>
        </header>
        <div class="platform-specialized-groups">
            @foreach($specializedGroups as $group)
                <section class="platform-specialized-group reveal">
                    <header><span>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span><div><h3>{{ $group['title'] }}</h3><p>{{ $group['description'] }}</p></div></header>
                    <div>
                        @foreach($group['solutions'] as $solution)
                            <a href="{{ route($solution['route']) }}">
                                <span><strong>{{ $solution['nav_title'] }}</strong><small>{{ $solution['nav_description'] }}</small></span>
                                <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="m15 18-6-6 6-6"></path></svg>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endforeach
        </div>
    </div>
</section>

<section class="platform-hub-guide" aria-labelledby="guide-title">
    <div class="container platform-hub-guide-grid">
        <div class="reveal">
            <span class="section-label">مسیر ارزیابی</span>
            <h2 id="guide-title">برای انتخاب راهکار، از نام ماژول شروع نکنید</h2>
            <p>یک گلوگاه واقعی، مالک فرایند و خروجی قابل اندازه‌گیری را مشخص کنید. در جلسه دمو همان سناریو را از داده ورودی تا اقدام و گزارش نهایی دنبال می‌کنیم.</p>
            <a class="btn btn-primary" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="solutions_hub_consultation">درخواست دمو بر اساس سناریو</a>
        </div>
        <ol class="platform-hub-guide-steps reveal">
            <li><span>۱</span><div><strong>گلوگاه را نام‌گذاری کنید</strong><p>مثلاً تأخیر در پاسخ، نرخ نامعتبر، سند ناقص یا سود نامشخص.</p></div></li>
            <li><span>۲</span><div><strong>پرونده نمونه بیاورید</strong><p>با یک Shipment یا Booking واقعی، مرز داده و تصمیم روشن‌تر می‌شود.</p></div></li>
            <li><span>۳</span><div><strong>خروجی را از ابتدا تعریف کنید</strong><p>زمان پاسخ، کاهش Override، کامل‌بودن سند یا Margin قابل اتکا.</p></div></li>
        </ol>
    </div>
</section>
@endsection

@push('scripts')
<script>
(() => {
    const finder = document.querySelector('[data-solution-finder]');
    if (!finder) return;

    const cards = [...document.querySelectorAll('[data-solution-card]')];
    const filters = [...finder.querySelectorAll('[data-solution-filter]')];
    const search = finder.querySelector('[data-solution-search]');
    const clear = finder.querySelector('[data-solution-clear]');
    const status = finder.querySelector('[data-solution-status]');
    const empty = document.querySelector('[data-solution-empty]');
    let category = 'all';

    const normalize = value => (value || '').toLocaleLowerCase('fa-IR').replace(/[يى]/g, 'ی').replace(/ك/g, 'ک').trim();
    const apply = () => {
        const query = normalize(search.value);
        let visible = 0;
        cards.forEach(card => {
            const categoryMatches = category === 'all' || card.dataset.category === category;
            const searchMatches = !query || normalize(card.dataset.search).includes(query);
            const show = categoryMatches && searchMatches;
            card.hidden = !show;
            if (show) visible += 1;
        });
        status.textContent = visible ? `نمایش ${visible.toLocaleString('fa-IR')} راهکار پلتفرمی` : 'هیچ راهکاری با این فیلتر پیدا نشد';
        empty.hidden = visible !== 0;
        clear.classList.toggle('is-visible', Boolean(search.value));
    };

    const selectCategory = nextCategory => {
        category = nextCategory;
        filters.forEach(button => {
            const active = button.dataset.solutionFilter === category;
            button.classList.toggle('is-active', active);
            button.setAttribute('aria-pressed', String(active));
        });
        apply();
    };

    filters.forEach(button => button.addEventListener('click', () => selectCategory(button.dataset.solutionFilter)));
    search.addEventListener('input', apply);
    clear.addEventListener('click', () => { search.value = ''; search.focus(); apply(); });
    document.querySelector('[data-solution-reset]')?.addEventListener('click', () => { search.value = ''; selectCategory('all'); search.focus(); });
    document.querySelectorAll('[data-hub-preset]').forEach(link => link.addEventListener('click', () => selectCategory(link.dataset.hubPreset)));
})();
</script>
@endpush
