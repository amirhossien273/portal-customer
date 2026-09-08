@extends('layouts.marketing')

@php
    $isGuide = $group === 'guides';
    $depth = $page['depth'];
    $parentLabel = $isGuide ? 'مرکز مقایسه' : 'راهکارها';
    $parentUrl = $isGuide ? route('compare.index') : route('solutions.index');
    $linkUrl = static fn (array $link): string => route($link['route'], $link['parameters'] ?? []);
    $significantLinks = array_values(array_unique(array_merge(
        [$canonical, route('consultation.create')],
        $isGuide ? [route('compare.index')] : [],
        array_map(static fn (array $item): string => $linkUrl($item['link']), $page['pillars']),
        array_map(static fn (array $item): string => $linkUrl($item['link']), $page['boundaries']),
    )));
    $breadcrumbItems = [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'صفحه اصلی', 'item' => route('home')],
    ];
    if ($isGuide) {
        $breadcrumbItems[] = ['@type' => 'ListItem', 'position' => 2, 'name' => 'مرکز مقایسه', 'item' => route('compare.index')];
    }
    $breadcrumbItems[] = [
        '@type' => 'ListItem',
        'position' => count($breadcrumbItems) + 1,
        'name' => $page['nav_title'],
        'item' => $canonical,
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
            'isPartOf' => ['@id' => $parentUrl.'#webpage'],
            'breadcrumb' => ['@id' => $canonical.'#breadcrumb'],
            'mainEntity' => [
                ['@id' => $canonical.'#checklist'],
                ['@id' => $canonical.'#faq'],
            ],
            'about' => array_map(static fn (array $item): array => [
                '@type' => 'Thing',
                'name' => $item['title'],
            ], array_merge($page['pillars'], $depth['deep_dive']['items'])),
            'significantLink' => $significantLinks,
        ],
        [
            '@type' => 'BreadcrumbList',
            '@id' => $canonical.'#breadcrumb',
            'itemListElement' => $breadcrumbItems,
        ],
        [
            '@type' => 'ItemList',
            '@id' => $canonical.'#checklist',
            'name' => $page['checklist_heading'],
            'itemListElement' => array_map(static fn (array $item, int $index): array => [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'name' => $item['criterion'],
                'description' => $item['question'],
            ], $page['checklist'], array_keys($page['checklist'])),
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
<link rel="stylesheet" href="{{ asset('assets/css/marketing-content-page.css') }}?v=20260908-1">
@endpush

@section('content')
<section class="page-hero content-page-hero">
    <div class="container hero-inner">
        <div class="hero-copy reveal">
            <nav class="breadcrumb" aria-label="مسیر صفحه">
                <a href="{{ route('home') }}">صفحه اصلی</a>
                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                @if($parentUrl)<a href="{{ $parentUrl }}">{{ $parentLabel }}</a>@else<span>{{ $parentLabel }}</span>@endif
                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                <span>{{ $page['nav_title'] }}</span>
            </nav>
            <span class="content-eyebrow">{{ $page['eyebrow'] }}</span>
            <h1>{{ $page['h1'] }}</h1>
            <p>{{ $page['lead'] }}</p>
            <div class="hero-actions">
                <a class="btn btn-primary" href="#decision-framework">{{ $page['hero_primary_label'] ?? ($isGuide ? 'مشاهده معیارهای انتخاب' : 'مشاهده اجزای راهکار') }}</a>
                <a class="btn btn-outline" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="{{ $slug }}_hero_consultation">{{ $page['hero_secondary_label'] ?? 'درخواست دمو و مشاوره' }}</a>
            </div>
        </div>
        <aside class="content-answer-card reveal" aria-label="پاسخ کوتاه">
            <span>{{ $isGuide ? 'پاسخ کوتاه برای تصمیم‌گیرنده' : 'دامنه راهکار' }}</span>
            <p>{{ $page['answer'] }}</p>
            <ul>
                @foreach($page['outcomes'] as $outcome)
                    <li>{{ $outcome['title'] }}</li>
                @endforeach
            </ul>
        </aside>
    </div>
</section>

<section class="content-intent-strip" aria-labelledby="content-intent-title">
    <div class="container">
        <div class="content-intent-card reveal">
            <span aria-hidden="true">◎</span>
            <div><h2 id="content-intent-title">{{ $page['intent_title'] }}</h2><p>{{ $page['intent_text'] }}</p></div>
        </div>
    </div>
</section>

<section class="content-toc-section" aria-label="راهنمای مطالعه صفحه">
    <div class="container content-toc-wrap reveal">
        <div class="content-editorial-note">
            <div><strong>{{ $depth['editorial']['label'] }}</strong><span>{{ $depth['editorial']['reviewed'] }}</span></div>
            <p>{{ $depth['editorial']['note'] }}</p>
        </div>
        <nav class="content-toc" aria-label="فهرست مطالب">
            <span>در این صفحه</span>
            <a href="#outcomes-section">خروجی‌ها</a>
            @if(isset($page['specialist_difference']))<a href="#specialist-difference-section">تفاوت دو دسته</a>@endif
            <a href="#diagnostic-section">تشخیص نیاز</a>
            <a href="#decision-framework">اجزای اصلی</a>
            <a href="#workflow-section">جریان کار</a>
            <a href="#deep-dive-section">بررسی عمیق</a>
            <a href="#metrics-section">شاخص‌ها</a>
            <a href="#rollout-section">پیاده‌سازی</a>
            <a href="#content-faq-section">سؤالات متداول</a>
        </nav>
    </div>
</section>

<section class="section" id="outcomes-section" aria-labelledby="outcomes-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">خروجی مورد انتظار</span><h2 class="section-title" id="outcomes-title">{{ $page['outcomes_heading'] }}</h2></div>
        <div class="content-outcomes-grid">
            @foreach($page['outcomes'] as $outcome)
                <article class="content-outcome-card reveal"><span>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span><h3>{{ $outcome['title'] }}</h3><p>{{ $outcome['description'] }}</p></article>
            @endforeach
        </div>
    </div>
</section>

@if(isset($page['specialist_difference']))
<section class="section soft content-specialist-difference" id="specialist-difference-section" aria-labelledby="specialist-difference-title">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label">تفکیک موضوعی</span>
            <h2 class="section-title" id="specialist-difference-title">{{ $page['specialist_difference']['heading'] }}</h2>
            <p class="section-sub">{{ $page['specialist_difference']['intro'] }}</p>
        </div>
        <div class="content-difference-grid">
            @foreach(['general', 'forwarding'] as $differenceKey)
                @php($difference = $page['specialist_difference'][$differenceKey])
                <article class="content-difference-card reveal">
                    <span>{{ $loop->iteration === 1 ? 'دسته عمومی' : 'دسته تخصصی' }}</span>
                    <h3>{{ $difference['title'] }}</h3>
                    <p>{{ $difference['description'] }}</p>
                    <ul>@foreach($difference['items'] as $item)<li>{{ $item }}</li>@endforeach</ul>
                </article>
            @endforeach
        </div>
        <div class="content-difference-action reveal"><a href="{{ $linkUrl($page['specialist_difference']['link']) }}">{{ $page['specialist_difference']['link']['label'] }} <span aria-hidden="true">←</span></a></div>
    </div>
</section>
@endif

<section class="section content-diagnostic-section" id="diagnostic-section" aria-labelledby="diagnostic-title">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label">{{ $depth['diagnostic']['label'] }}</span>
            <h2 class="section-title" id="diagnostic-title">{{ $depth['diagnostic']['heading'] }}</h2>
            <p class="section-sub">{{ $depth['diagnostic']['intro'] }}</p>
        </div>
        <div class="content-diagnostic-grid">
            @foreach($depth['diagnostic']['items'] as $item)
                <article class="content-diagnostic-card reveal">
                    <span class="content-card-number">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    <h3>{{ $item['title'] }}</h3>
                    <p>{{ $item['description'] }}</p>
                    <strong>{{ $item['signal'] }}</strong>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="section soft" id="decision-framework" aria-labelledby="pillars-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">{{ $isGuide ? 'چارچوب ارزیابی' : 'معماری راهکار' }}</span><h2 class="section-title" id="pillars-title">{{ $page['pillars_heading'] }}</h2><p class="section-sub">{{ $page['pillars_intro'] }}</p></div>
        <div class="content-pillars-grid">
            @foreach($page['pillars'] as $pillar)
                <article class="content-pillar-card reveal">
                    <span class="content-pillar-index">۰{{ $loop->iteration }}</span>
                    <h3>{{ $pillar['title'] }}</h3>
                    <p>{{ $pillar['description'] }}</p>
                    <a href="{{ $linkUrl($pillar['link']) }}">{{ $pillar['link']['label'] }} <span aria-hidden="true">←</span></a>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="section content-workflow-section" id="workflow-section" aria-labelledby="workflow-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">جریان عملیاتی</span><h2 class="section-title" id="workflow-title">{{ $page['workflow_heading'] }}</h2><p class="section-sub">{{ $page['workflow_intro'] }}</p></div>
        <ol class="content-workflow">
            @foreach($page['workflow'] as $step)
                <li class="reveal"><span>{{ $loop->iteration }}</span><div><h3>{{ $step['title'] }}</h3><p>{{ $step['description'] }}</p></div></li>
            @endforeach
        </ol>
    </div>
</section>

<section class="section soft content-deep-dive-section" id="deep-dive-section" aria-labelledby="deep-dive-title">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label">{{ $depth['deep_dive']['label'] }}</span>
            <h2 class="section-title" id="deep-dive-title">{{ $depth['deep_dive']['heading'] }}</h2>
            <p class="section-sub">{{ $depth['deep_dive']['intro'] }}</p>
        </div>
        <div class="content-deep-dive-list">
            @foreach($depth['deep_dive']['items'] as $item)
                <article class="content-deep-dive-card reveal">
                    <div class="content-deep-dive-heading">
                        <span>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <div><h3>{{ $item['title'] }}</h3><p>{{ $item['description'] }}</p></div>
                    </div>
                    <ul>
                        @foreach($item['bullets'] as $bullet)<li>{{ $bullet }}</li>@endforeach
                    </ul>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="section content-metrics-section" id="metrics-section" aria-labelledby="metrics-title">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label">{{ $depth['metrics']['label'] }}</span>
            <h2 class="section-title" id="metrics-title">{{ $depth['metrics']['heading'] }}</h2>
            <p class="section-sub">{{ $depth['metrics']['intro'] }}</p>
        </div>
        <div class="content-metrics-grid">
            @foreach($depth['metrics']['items'] as $item)
                <article class="content-metric-card reveal">
                    <span>KPI {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    <h3>{{ $item['name'] }}</h3>
                    <p>{{ $item['description'] }}</p>
                    <small>{{ $item['source'] }}</small>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="section soft content-rollout-section" id="rollout-section" aria-labelledby="rollout-title">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label">{{ $depth['rollout']['label'] }}</span>
            <h2 class="section-title" id="rollout-title">{{ $depth['rollout']['heading'] }}</h2>
            <p class="section-sub">{{ $depth['rollout']['intro'] }}</p>
        </div>
        <ol class="content-rollout-list">
            @foreach($depth['rollout']['steps'] as $step)
                <li class="reveal">
                    <span>{{ $loop->iteration }}</span>
                    <div><h3>{{ $step['title'] }}</h3><p>{{ $step['description'] }}</p><strong>{{ $step['deliverable'] }}</strong></div>
                </li>
            @endforeach
        </ol>
    </div>
</section>

<section class="section" id="checklist-section" aria-labelledby="checklist-title">
    <div class="container content-checklist-layout">
        <div class="content-checklist-copy reveal"><span class="section-label">چک‌لیست اجرایی</span><h2 class="section-title" id="checklist-title">{{ $page['checklist_heading'] }}</h2><p>{{ $page['checklist_intro'] }}</p></div>
        <div class="content-checklist">
            @foreach($page['checklist'] as $item)
                <article class="reveal"><strong>{{ $item['criterion'] }}</strong><p>{{ $item['question'] }}</p></article>
            @endforeach
        </div>
    </div>
</section>

<section class="section soft" id="boundaries-section" aria-labelledby="boundaries-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">مسیرهای مرتبط</span><h2 class="section-title" id="boundaries-title">{{ $page['boundary_heading'] }}</h2><p class="section-sub">برای ادامه بررسی هر بخش، از مسیر تخصصی مرتبط استفاده کنید.</p></div>
        <div class="content-boundaries-grid">
            @foreach($page['boundaries'] as $boundary)
                <article class="content-boundary-card reveal"><h3>{{ $boundary['title'] }}</h3><p>{{ $boundary['description'] }}</p><a href="{{ $linkUrl($boundary['link']) }}">{{ $boundary['link']['label'] }} <span aria-hidden="true">←</span></a></article>
            @endforeach
        </div>
    </div>
</section>

<section class="section" id="content-faq-section" aria-labelledby="content-faq-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">پرسش‌های متداول</span><h2 class="section-title" id="content-faq-title">سؤالات متداول {{ $page['nav_title'] }}</h2></div>
        <div class="faq">@foreach($page['faqs'] as $faq)<details class="reveal"><summary>{{ $faq['question'] }}</summary><p>{{ $faq['answer'] }}</p></details>@endforeach</div>
    </div>
</section>

<section class="cta-wrap"><div class="container"><div class="cta reveal"><div class="cta-copy"><h2>{{ $page['cta_title'] }}</h2><p>{{ $page['cta_text'] }}</p></div><div class="cta-action"><a class="btn" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="{{ $slug }}_bottom_consultation">{{ $page['cta_button'] ?? 'درخواست دمو و مشاوره' }}</a></div></div></div></section>
@endsection
