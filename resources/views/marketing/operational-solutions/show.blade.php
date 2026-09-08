@extends('layouts.marketing')

@php
    $isTower = $slug === 'operations-control-tower';
    $relatedUrls = array_map(
        static fn (array $item): string => route($item['route'], $item['parameters'] ?? []),
        $page['related']
    );
    $breadcrumb = [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'صفحه اصلی', 'item' => route('home')],
        ['@type' => 'ListItem', 'position' => 2, 'name' => 'راهکارها', 'item' => route('solutions.index')],
        ['@type' => 'ListItem', 'position' => 3, 'name' => $page['nav_title'], 'item' => $canonical],
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
            'isPartOf' => ['@id' => route('solutions.index').'#collection'],
            'breadcrumb' => ['@id' => $canonical.'#breadcrumb'],
            'mainEntity' => [['@id' => $canonical.'#software'], ['@id' => $canonical.'#faq']],
            'significantLink' => array_merge([route('product'), route('consultation.create')], $relatedUrls),
        ],
        [
            '@type' => 'SoftwareApplication',
            '@id' => $canonical.'#software',
            'name' => $page['nav_title'].' سپند',
            'applicationCategory' => 'BusinessApplication',
            'operatingSystem' => 'Web',
            'url' => $canonical,
            'description' => $description,
            'image' => $image,
            'featureList' => array_column($page[$isTower ? 'signals' : 'capabilities'], 'title'),
        ],
        [
            '@type' => 'BreadcrumbList',
            '@id' => $canonical.'#breadcrumb',
            'itemListElement' => $breadcrumb,
        ],
        [
            '@type' => 'FAQPage',
            '@id' => $canonical.'#faq',
            'mainEntity' => array_map(static fn (array $faq): array => [
                '@type' => 'Question',
                'name' => $faq['question'],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['answer']],
            ], $page['faqs']),
        ],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endpush

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/marketing-operational-solutions.css') }}?v=20260908-1">
@endpush

@section('content')
<section class="ops-hero">
    <div class="container ops-hero-grid">
        <div class="ops-hero-copy reveal">
            <nav class="breadcrumb" aria-label="مسیر صفحه">
                <a href="{{ route('home') }}">صفحه اصلی</a>
                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                <a href="{{ route('solutions.index') }}">راهکارها</a>
                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                <span>{{ $page['nav_title'] }}</span>
            </nav>
            <span class="ops-eyebrow">{{ $page['eyebrow'] }}</span>
            <h1>{{ $page['h1'] }}</h1>
            <p>{{ $page['lead'] }}</p>
            <div class="ops-hero-actions">
                <a class="btn btn-primary" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="{{ $slug }}_hero_consultation">{{ $page['hero_primary_label'] }}</a>
                <a class="btn btn-outline" href="{{ route('product') }}">{{ $page['hero_secondary_label'] }}</a>
            </div>
            <blockquote>{{ $page['promise'] }}</blockquote>
        </div>
        <figure class="ops-hero-media reveal">
            <div class="ops-window-bar"><span></span><span></span><span></span><strong>{{ $isTower ? 'نمای پایش عملیات' : 'طراح گردش کار عملیات' }}</strong></div>
            <img src="{{ $image }}" width="{{ $page['image_width'] }}" height="{{ $page['image_height'] }}" alt="{{ $page['image_alt'] }}" fetchpriority="high">
            <figcaption>نمای واقعی از نرم‌افزار سپند</figcaption>
        </figure>
    </div>
</section>

<nav class="ops-page-nav" aria-label="فهرست بخش‌های صفحه">
    <div class="container">
        <a href="#problem-section">چالش امروز</a>
        <a href="#solution-section">نحوه کار</a>
        <a href="#benefits-section">مزایا</a>
        <a href="#related-section">راهکارهای مرتبط</a>
        <a href="#faq-section">پرسش‌های متداول</a>
    </div>
</nav>

<section class="section ops-problem" id="problem-section" aria-labelledby="problem-title">
    <div class="container ops-problem-grid">
        <div class="ops-problem-copy reveal">
            <span class="section-label">چالش عملیاتی</span>
            <h2 class="section-title" id="problem-title">{{ $page['problem_heading'] }}</h2>
            <p>{{ $page['problem_intro'] }}</p>
            @if(!$isTower)<aside class="ops-inline-example"><strong>نمونه واقعی</strong><p>{{ $page['example'] }}</p></aside>@endif
        </div>
        <div class="ops-problem-panel reveal">
            <ul>
                @foreach($page['problems'] as $problem)<li><span aria-hidden="true">!</span>{{ $problem }}</li>@endforeach
            </ul>
            @if($isTower)
                <div class="ops-morning">
                    <strong>مدیر عملیات باید در آغاز روز پاسخ این پرسش‌ها را بداند:</strong>
                    @foreach($page['morning_questions'] as $question)<p>{{ $question }}</p>@endforeach
                </div>
            @endif
        </div>
    </div>
</section>

@if($isTower)
    <section class="section soft" id="solution-section" aria-labelledby="signals-title">
        <div class="container">
            <header class="section-head reveal">
                <span class="section-label">مرکز توجه روزانه</span>
                <h2 class="section-title" id="signals-title">{{ $page['monitor_heading'] }}</h2>
                <p class="section-sub">{{ $page['monitor_intro'] }}</p>
            </header>
            <div class="ops-signal-grid">
                @foreach($page['signals'] as $signal)
                    <article class="ops-signal-card reveal">
                        <div class="ops-signal-number">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                        <h3>{{ $signal['title'] }}</h3>
                        <p>{{ $signal['description'] }}</p>
                        <dl><div><dt>نمونه</dt><dd>{{ $signal['example'] }}</dd></div><div><dt>اقدام</dt><dd>{{ $signal['action'] }}</dd></div></dl>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@else
    <section class="section soft" id="solution-section" aria-labelledby="templates-title">
        <div class="container">
            <header class="section-head reveal">
                <span class="section-label">الگوی استاندارد هر حمل</span>
                <h2 class="section-title" id="templates-title">{{ $page['templates_heading'] }}</h2>
                <p class="section-sub">{{ $page['templates_intro'] }}</p>
            </header>
            <div class="ops-template-grid">
                @foreach($page['templates'] as $template)
                    <article class="ops-template-card reveal">
                        <div><span>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span><h3>{{ $template['title'] }}</h3></div>
                        <ol>@foreach($template['items'] as $item)<li><span>{{ $loop->iteration }}</span>{{ $item }}</li>@endforeach</ol>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section" aria-labelledby="capabilities-title">
        <div class="container">
            <header class="section-head reveal"><span class="section-label">اجزای راهکار</span><h2 class="section-title" id="capabilities-title">{{ $page['capabilities_heading'] }}</h2></header>
            <div class="ops-capability-grid">
                @foreach($page['capabilities'] as $capability)
                    <article class="ops-capability-card reveal"><span>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span><h3>{{ $capability['title'] }}</h3><p>{{ $capability['description'] }}</p><strong>{{ $capability['example'] }}</strong></article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section ops-controls-section" aria-labelledby="controls-title">
        <div class="container">
            <header class="section-head reveal"><span class="section-label">پیشگیری از خطا</span><h2 class="section-title" id="controls-title">{{ $page['controls_heading'] }}</h2><p class="section-sub">{{ $page['controls_intro'] }}</p></header>
            <div class="ops-controls-grid">
                @foreach($page['controls'] as $control)
                    <article @class(['ops-control-card', 'reveal', 'is-'.$control['tone']])><span aria-hidden="true">{{ $control['tone'] === 'danger' ? '×' : ($control['tone'] === 'warning' ? '!' : '✓') }}</span><h3>{{ $control['title'] }}</h3><p>{{ $control['description'] }}</p><strong>{{ $control['example'] }}</strong></article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section" aria-labelledby="scenario-title">
        <div class="container ops-scenario-grid">
            <div class="ops-scenario-copy reveal"><span class="section-label">سناریوی روزانه</span><h2 class="section-title" id="scenario-title">{{ $page['scenario']['title'] }}</h2><dl><div><dt>مسیر</dt><dd>{{ $page['scenario']['route'] }}</dd></div><div><dt>روش حمل</dt><dd>{{ $page['scenario']['mode'] }}</dd></div></dl><p>{{ $page['scenario']['result'] }}</p></div>
            <div class="ops-scenario-table reveal">
                <table>
                    <thead><tr><th>فعالیت</th><th>مسئول</th><th>وضعیت</th></tr></thead>
                    <tbody>@foreach($page['scenario']['rows'] as $row)<tr><td>{{ $row['task'] }}</td><td>{{ $row['owner'] }}</td><td><span class="is-{{ $row['tone'] }}">{{ $row['status'] }}</span></td></tr>@endforeach</tbody>
                </table>
            </div>
        </div>
    </section>
@endif

<section class="section {{ $isTower ? '' : 'soft' }}" id="benefits-section" aria-labelledby="benefits-title">
    <div class="container">
        <header class="section-head reveal"><span class="section-label">نتیجه برای تیم عملیات</span><h2 class="section-title" id="benefits-title">{{ $page['benefits_heading'] }}</h2></header>
        <div class="ops-benefit-grid">
            @foreach($page['benefits'] as $benefit)<article class="ops-benefit-card reveal"><span aria-hidden="true">✓</span><h3>{{ $benefit['title'] }}</h3><p>{{ $benefit['description'] }}</p></article>@endforeach
        </div>
    </div>
</section>

@if($isTower)
    <section class="section ops-before-after" aria-labelledby="change-title">
        <div class="container">
            <header class="section-head reveal"><span class="section-label">تغییر روش کار</span><h2 class="section-title" id="change-title">از پیگیری پراکنده تا فرماندهی یکپارچه</h2></header>
            <div class="ops-change-grid">
                <article class="ops-change-card is-before reveal"><span>پیش از سپند</span><ul>@foreach($page['before'] as $item)<li>{{ $item }}</li>@endforeach</ul></article>
                <div class="ops-change-arrow reveal" aria-hidden="true">←</div>
                <article class="ops-change-card is-after reveal"><span>با سپند</span><ul>@foreach($page['after'] as $item)<li>{{ $item }}</li>@endforeach</ul></article>
            </div>
        </div>
    </section>
@else
    <section class="ops-bridge" aria-labelledby="bridge-title">
        <div class="container ops-bridge-grid">
            <div class="reveal"><span class="section-label">ارتباط دو راهکار</span><h2 id="bridge-title">{{ $page['bridge_heading'] }}</h2><p>{{ $page['bridge_text'] }}</p><a class="btn" href="{{ route('solutions.operations-control-tower') }}">مشاهده برج کنترل عملیات</a></div>
            <div class="ops-bridge-signals reveal" aria-label="داده‌های منتقل‌شده به برج کنترل"><span>مرحله ناقص</span><span>مدرک ثبت‌نشده</span><span>کار عقب‌افتاده</span><span>اقدام در انتظار</span></div>
        </div>
    </section>
@endif

<section class="section soft" id="related-section" aria-labelledby="related-title">
    <div class="container">
        <header class="section-head reveal"><span class="section-label">ادامه مسیر</span><h2 class="section-title" id="related-title">راهکارهای مرتبط با این فرایند</h2></header>
        <div class="ops-related-grid">
            @foreach($page['related'] as $item)
                <a class="ops-related-card reveal" href="{{ route($item['route'], $item['parameters'] ?? []) }}"><span>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span><h3>{{ $item['title'] }}</h3><p>{{ $item['description'] }}</p><strong>مشاهده راهکار <b aria-hidden="true">←</b></strong></a>
            @endforeach
        </div>
        <div class="ops-mode-links reveal">
            <span>بررسی بر اساس روش حمل:</span>
            <a href="{{ route('site.transport-modes.show', ['mode' => 'air']) }}">حمل هوایی</a>
            <a href="{{ route('site.transport-modes.show', ['mode' => 'road']) }}">حمل جاده‌ای</a>
            <a href="{{ route('site.transport-modes.show', ['mode' => $isTower ? 'sea' : 'rail']) }}">{{ $isTower ? 'حمل دریایی' : 'حمل ریلی' }}</a>
        </div>
    </div>
</section>

<section class="section" id="faq-section" aria-labelledby="faq-title">
    <div class="container">
        <header class="section-head reveal"><span class="section-label">پرسش‌های متداول</span><h2 class="section-title" id="faq-title">سؤالات متداول {{ $page['nav_title'] }}</h2></header>
        <div class="faq">@foreach($page['faqs'] as $faq)<details class="reveal"><summary>{{ $faq['question'] }}</summary><p>{{ $faq['answer'] }}</p></details>@endforeach</div>
    </div>
</section>

<section class="cta-wrap"><div class="container"><div class="cta reveal"><div class="cta-copy"><h2>{{ $page['cta_title'] }}</h2><p>{{ $page['cta_text'] }}</p></div><div class="cta-action"><a class="btn" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="{{ $slug }}_bottom_consultation">{{ $page['cta_button'] }}</a></div></div></div></section>
@endsection
