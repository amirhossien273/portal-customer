@extends('layouts.marketing')

@push('head')
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        ['@type' => 'CollectionPage', '@id' => $canonical.'#collection', 'url' => $canonical, 'name' => $title, 'description' => $description, 'inLanguage' => 'fa-IR', 'mainEntity' => [
            '@type' => 'ItemList',
            'numberOfItems' => $solutionItems->count(),
            'itemListElement' => $solutionItems->map(fn ($solution, $index) => ['@type' => 'ListItem', 'position' => $index + 1, 'name' => $solution['title'], 'url' => route($solution['route'], $solution['parameters'] ?? [])])->all(),
        ]],
        ['@type' => 'BreadcrumbList', 'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'خانه', 'item' => route('home')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'راهکارها', 'item' => $canonical],
        ]],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endpush

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/marketing-platform-solutions.css') }}?v=20261107-1">
@endpush

@section('content')
<section class="platform-hub-hero">
    <div class="container platform-hub-hero-simple">
        <nav class="platform-hub-breadcrumb" aria-label="مسیر صفحه"><a href="{{ route('home') }}">خانه</a><span aria-hidden="true">/</span><span>راهکارها</span></nav>
        <span class="section-label">انتخاب بر اساس مسئله شرکت</span>
        <h1>راهکارهای نرم‌افزاری برای شرکت‌های حمل‌ونقل بین‌المللی</h1>
        <p>در شرکت‌های حمل‌ونقل و فورواردری، پیگیری مشتری، نرخ‌گیری، اجرای حمل، تکمیل مدارک و کنترل هزینه‌ها به یکدیگر وابسته‌اند. وقتی اطلاعات و مسئولیت‌ها پراکنده باشند، پیگیری‌ها عقب می‌افتند و وضعیت پرونده روشن نمی‌ماند. راهکارهای سپند را بر اساس مسئله‌ای که در تیم شما وجود دارد بررسی کنید.</p>
        <div class="hero-actions">
            <a class="btn btn-primary" href="#solution-finder">پیدا کردن راهکار مناسب</a>
            <a class="btn btn-outline" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="solutions_hero_consultation">درخواست دمو و مشاوره</a>
        </div>
    </div>
</section>

<section class="section platform-finder-section" id="solution-finder" aria-labelledby="solution-finder-title">
    <div class="container">
        <header class="section-head reveal">
            <span class="section-label">راهنمای انتخاب</span>
            <h2 class="section-title" id="solution-finder-title">کدام مشکل شرکت شما را می‌خواهید حل کنید؟</h2>
            <p class="section-sub">موضوع را جست‌وجو کنید یا یکی از حوزه‌ها را انتخاب کنید. همه لینک‌ها بدون جست‌وجو نیز در همین صفحه در دسترس‌اند.</p>
        </header>

        <div class="platform-finder reveal" data-solution-finder>
            <div class="platform-finder-search">
                <label for="solution-search">جست‌وجو میان راهکارها</label>
                <div>
                    <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="11" cy="11" r="7"></circle><path d="m20 20-4-4"></path></svg>
                    <input id="solution-search" type="search" autocomplete="off" placeholder="مثلاً پیگیری فروش، نرخ، اسناد یا سود پرونده" data-solution-search>
                    <button type="button" data-solution-clear aria-label="پاک کردن جست‌وجو">×</button>
                </div>
            </div>
            <div class="platform-finder-filters" role="group" aria-label="فیلتر حوزه راهکار">
                <button type="button" class="is-active" data-solution-filter="all" aria-pressed="true">همه راهکارها</button>
                @foreach($problemGroups as $groupKey => $group)
                    <button type="button" data-solution-filter="{{ $groupKey }}" aria-pressed="false">{{ $group['title'] }}</button>
                @endforeach
            </div>
            <p class="platform-finder-status" data-solution-status aria-live="polite">نمایش {{ $solutionItems->count() }} راهکار</p>
        </div>

        <div class="solution-problem-groups" data-solution-groups>
            @foreach($problemGroups as $groupKey => $group)
                <section class="solution-problem-group reveal" data-solution-group="{{ $groupKey }}" aria-labelledby="group-{{ $groupKey }}">
                    <header class="solution-problem-group-head">
                        <div class="solution-problem-group-number" aria-hidden="true">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                        <div><h3 id="group-{{ $groupKey }}">{{ $group['title'] }}</h3><p>{{ $group['description'] }}</p></div>
                    </header>
                    <div class="platform-hub-grid">
                        @foreach($group['solutions'] as $solution)
                            <article class="platform-hub-card" data-solution-card data-category="{{ $groupKey }}" data-search="{{ implode(' ', [$solution['title'], $solution['problem'], $solution['help'], $solution['search'] ?? '']) }}">
                                <span class="platform-hub-card-category">{{ $group['title'] }}</span>
                                <h4>{{ $solution['title'] }}</h4>
                                <div class="platform-hub-card-copy">
                                    <p><b>مشکل</b>{{ $solution['problem'] }}</p>
                                    <p><b>سپند چگونه کمک می‌کند؟</b>{{ $solution['help'] }}</p>
                                </div>
                                <a href="{{ route($solution['route'], $solution['parameters'] ?? []) }}">{{ $solution['link_label'] }}<svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="m15 18-6-6 6-6"></path></svg></a>
                            </article>
                        @endforeach
                    </div>
                </section>
            @endforeach
        </div>

        <div class="platform-finder-empty" data-solution-empty hidden>
            <strong>راهکاری با این عبارت پیدا نشد</strong>
            <span>عبارت کوتاه‌تری مثل «نرخ»، «سند»، «ناوگان» یا «فروش» وارد کنید.</span>
            <button type="button" data-solution-reset>پاک‌کردن جست‌وجو و فیلتر</button>
        </div>
    </div>
</section>

<section class="platform-connected-section" aria-labelledby="connected-title">
    <div class="container platform-connected-grid">
        <div><span class="section-label">یک فرایند، چند تیم</span><h2 id="connected-title">وقتی چند بخش شرکت درگیر یک مسئله‌اند</h2></div>
        <div>
            <p>برای نمونه، یک استعلام مشتری با پیگیری فروش شروع می‌شود، برای پیشنهاد به نرخ معتبر نیاز دارد و پس از تأیید به رزرو و عملیات تحویل داده می‌شود. اسناد و هزینه‌های همان پرونده نیز باید تا نتیجه مالی قابل ردیابی بمانند. بنابراین انتخاب راهکار می‌تواند از یک مشکل مشخص شروع شود، اما اثر آن را باید در جریان کامل پرونده دید.</p>
            <div class="platform-connected-links"><a href="{{ route('product') }}">مشاهده فرایند یکپارچه محصول</a><a href="{{ route('modules') }}">بررسی امکانات و ماژول‌ها</a></div>
        </div>
    </div>
</section>

<section class="platform-hub-guide" aria-labelledby="guide-title">
    <div class="container platform-hub-guide-grid">
        <div class="reveal">
            <span class="section-label">دموی مسئله‌محور</span>
            <h2 id="guide-title">مطمئن نیستید کدام راهکار مناسب شرکت شماست؟</h2>
            <p>یک مشکل پرتکرار یا پرونده نمونه را مطرح کنید تا بخش مرتبط محصول و مرز قابلیت آماده با نیاز احتمالی به سفارشی‌سازی در دمو بررسی شود.</p>
            <a class="btn btn-primary" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="solutions_hub_consultation">درخواست دمو بر اساس نیاز شرکت</a>
        </div>
        <div class="platform-hub-guide-note reveal">
            <strong>برای یک گفت‌وگوی دقیق‌تر آماده کنید:</strong>
            <ul><li>یک نمونه استعلام یا پرونده حمل</li><li>نقطه‌ای که پیگیری یا اطلاعات در آن متوقف می‌شود</li><li>نقش فردی که باید اقدام بعدی را انجام دهد</li></ul>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
(() => {
    const finder = document.querySelector('[data-solution-finder]');
    if (!finder) return;
    const cards = [...document.querySelectorAll('[data-solution-card]')];
    const groups = [...document.querySelectorAll('[data-solution-group]')];
    const filters = [...finder.querySelectorAll('[data-solution-filter]')];
    const search = finder.querySelector('[data-solution-search]');
    const clear = finder.querySelector('[data-solution-clear]');
    const status = finder.querySelector('[data-solution-status]');
    const empty = document.querySelector('[data-solution-empty]');
    let category = 'all';
    const normalize = value => (value || '').toLocaleLowerCase('fa-IR').normalize('NFKC').replace(/[يى]/g, 'ی').replace(/ك/g, 'ک').replace(/[\u200c\u200d\s]+/g, ' ').trim();
    const apply = () => {
        const query = normalize(search.value);
        let visible = 0;
        cards.forEach(card => {
            const show = (category === 'all' || card.dataset.category === category) && (!query || normalize(card.dataset.search).includes(query));
            card.hidden = !show;
            if (show) visible += 1;
        });
        groups.forEach(group => { group.hidden = ![...group.querySelectorAll('[data-solution-card]')].some(card => !card.hidden); });
        status.textContent = visible ? `نمایش ${visible.toLocaleString('fa-IR')} راهکار` : 'هیچ راهکاری با این فیلتر پیدا نشد';
        empty.hidden = visible !== 0;
        clear.classList.toggle('is-visible', Boolean(search.value));
    };
    const selectCategory = nextCategory => {
        category = nextCategory;
        filters.forEach(button => { const active = button.dataset.solutionFilter === category; button.classList.toggle('is-active', active); button.setAttribute('aria-pressed', String(active)); });
        apply();
    };
    filters.forEach(button => button.addEventListener('click', () => selectCategory(button.dataset.solutionFilter)));
    search.addEventListener('input', apply);
    clear.addEventListener('click', () => { search.value = ''; search.focus(); apply(); });
    document.querySelector('[data-solution-reset]')?.addEventListener('click', () => { search.value = ''; selectCategory('all'); search.focus(); });
})();
</script>
@endpush
