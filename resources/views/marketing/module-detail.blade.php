@extends('layouts.marketing')

@php
    $capabilities = $page['capabilities'];
    $faqs = $page['faqs'];
    $moduleCanonical = $canonical ?? route('site.modules.show', ['module' => $slug]);
@endphp

@push('head')
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'WebPage',
            '@id' => $moduleCanonical.'#webpage',
            'url' => $moduleCanonical,
            'name' => $module['seo_title'],
            'description' => $module['meta_description'],
            'inLanguage' => 'fa-IR',
            'breadcrumb' => ['@id' => $moduleCanonical.'#breadcrumb'],
            'mainEntity' => [['@id' => $moduleCanonical.'#software'], ['@id' => $moduleCanonical.'#faq']],
        ],
        [
            '@type' => 'SoftwareApplication',
            '@id' => $moduleCanonical.'#software',
            'name' => $page['h1'],
            'applicationCategory' => 'BusinessApplication',
            'operatingSystem' => 'Web',
            'description' => $module['meta_description'],
            'url' => $moduleCanonical,
            'featureList' => array_column($capabilities, 'title'),
            'audience' => [
                '@type' => 'BusinessAudience',
                'audienceType' => implode('، ', array_column($page['audiences'], 'title')),
            ],
        ],
        [
            '@type' => 'FAQPage',
            '@id' => $moduleCanonical.'#faq',
            'mainEntity' => array_map(static fn (array $faq): array => [
                '@type' => 'Question',
                'name' => $faq['question'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $faq['answer'],
                ],
            ], $faqs),
        ],
        [
            '@type' => 'BreadcrumbList',
            '@id' => $moduleCanonical.'#breadcrumb',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'صفحه اصلی', 'item' => route('home')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'ماژول‌ها', 'item' => route('modules')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => $module['name'], 'item' => route('site.modules.show', ['module' => $slug])],
            ],
        ],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endpush

@include('marketing.partials.module-rich-styles')

@section('content')
<section class="page-hero">
    <div class="container hero-inner">
        <div class="hero-copy crm-hero-copy reveal">
            <nav class="breadcrumb" aria-label="مسیر راهنما"><a href="{{ route('home') }}">صفحه اصلی</a><svg viewBox="0 0 24 24" fill="none"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg><a href="{{ route('modules') }}">ماژول‌ها</a><svg viewBox="0 0 24 24" fill="none"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg><span>{{ $module['name'] }}</span></nav>
            <h1 class="module-hero-title">
                <span class="module-hero-title-main">{{ $page['h1_main'] }}</span>
                <span class="module-hero-title-accent">{{ $page['h1_accent'] }}</span>
            </h1>
            @foreach($page['hero'] as $paragraph)
                <p class="crm-lead">{{ $paragraph }}</p>
            @endforeach
            <div class="hero-actions">
                <a class="btn btn-primary" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="module_{{ $slug }}_hero_consultation">{{ $page['cta']['primary'] }}</a>
                <a class="btn btn-outline" href="#module-features">{{ $page['cta']['secondary'] }}</a>
            </div>
        </div>
        <div class="hero-art crm-hero-art reveal">
            @include('marketing.partials.module-screenshot-slider')
        </div>
    </div>
</section>

<section class="section" aria-labelledby="module-problems-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">مسئله و راهکار</span><h2 class="section-title" id="module-problems-title">{{ $page['problem_heading'] }}</h2></div>
        <p class="crm-intro reveal">{{ $page['problem_intro'] }}</p>
        <div class="crm-problem reveal"><strong>چالش رایج کسب‌وکار</strong><p>{{ $page['problem_summary'] }}</p></div>
        <div class="crm-problem-grid">
            @foreach($page['problems'] as $problem)
                <article class="crm-problem-card reveal"><h3>{{ $problem['title'] }}</h3><p>{{ $problem['description'] }}</p></article>
            @endforeach
        </div>
        <ul class="crm-outcomes">
            @foreach($page['outcomes'] as $outcome)
                <li class="reveal">{{ $outcome }}</li>
            @endforeach
        </ul>
    </div>
</section>

<section class="section soft" id="module-features" aria-labelledby="module-features-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">امکانات اصلی</span><h2 class="section-title" id="module-features-title">{{ $page['features_heading'] }}</h2><p class="section-sub">{{ $page['features_intro'] }}</p></div>
        <div class="crm-capability-grid">
            @foreach($capabilities as $index => $capability)
                <article class="crm-capability reveal"><span class="crm-capability-num">{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</span><h3>{{ $capability['title'] }}</h3><p>{{ $capability['description'] }}</p></article>
            @endforeach
        </div>
    </div>
</section>

{{-- Module-specific narrative blocks are rendered only when their configuration is present. --}}
@if(! empty($page['workflow_stages']))
<section class="section email-workflow-section" id="email-workflow-path" aria-labelledby="email-workflow-path-title">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label">مسیر Email-to-Workflow</span>
            <h2 class="section-title" id="email-workflow-path-title">{{ $page['workflow_heading'] }}</h2>
            <p class="section-sub">{{ $page['workflow_intro'] }}</p>
        </div>
        <ol class="email-flow-grid" aria-label="مراحل تبدیل ایمیل به گردش کار حمل">
            @foreach($page['workflow_stages'] as $stage)
                <li @class(['email-flow-step', 'is-available' => $stage['status'] === 'available', 'is-planned' => $stage['status'] !== 'available', 'reveal'])>
                    <span class="email-flow-number" aria-hidden="true">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    <span class="email-flow-status">{{ $stage['status'] === 'available' ? 'زیرساخت فعال' : 'Roadmap' }}</span>
                    <h3 dir="ltr">{{ $stage['label'] }}</h3>
                    <p>{{ $stage['description'] }}</p>
                </li>
            @endforeach
        </ol>
    </div>
</section>
@endif

@if(! empty($page['scenarios']))
<section class="section soft" id="email-classification-scenarios" aria-labelledby="email-scenarios-title">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label">P1 · در مسیر توسعه</span>
            <h2 class="section-title" id="email-scenarios-title">{{ $page['scenarios_heading'] }}</h2>
            <p class="section-sub">{{ $page['scenarios_intro'] }}</p>
        </div>
        <div class="email-scenario-grid">
            @foreach($page['scenarios'] as $scenario)
                <article class="email-scenario-card reveal">
                    <span class="email-scenario-type" dir="ltr">{{ $scenario['type'] }}</span>
                    <blockquote dir="ltr">“{{ $scenario['example'] }}”</blockquote>
                    <div class="email-scenario-action"><span>اقدام هدف</span><p>{{ $scenario['action'] }}</p></div>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif

@if(! empty($page['roadmap']))
<section class="section email-roadmap-section" id="email-workflow-roadmap" aria-labelledby="email-roadmap-title">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label">Roadmap محصول</span>
            <h2 class="section-title" id="email-roadmap-title">{{ $page['roadmap_heading'] }}</h2>
            <p class="section-sub">{{ $page['roadmap_intro'] }}</p>
        </div>
        <div class="email-roadmap-grid">
            @foreach($page['roadmap'] as $phase)
                <article class="email-roadmap-card is-{{ $phase['tone'] }} reveal">
                    <header><span class="email-roadmap-phase">{{ $phase['phase'] }}</span><span class="email-roadmap-status">{{ $phase['status'] }}</span></header>
                    <h3>{{ $phase['title'] }}</h3>
                    <ul>@foreach($phase['items'] as $item)<li>{{ $item }}</li>@endforeach</ul>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif

@if(! empty($page['insights']))
<section class="section" id="{{ $slug === 'pricing-sales' ? 'pricing-intelligence' : 'module-insights' }}" aria-labelledby="module-insights-title">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label">داشبورد تصمیم‌گیری</span>
            <h2 class="section-title" id="module-insights-title">{{ $page['insights_heading'] }}</h2>
            <p class="section-sub">{{ $page['insights_intro'] }}</p>
        </div>
        <div class="crm-capability-grid">
            @foreach($page['insights'] as $index => $insight)
                <article class="crm-capability reveal">
                    <span class="crm-capability-num">{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</span>
                    <h3>{{ $insight['title'] }}</h3>
                    <p>{{ $insight['description'] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="section" aria-labelledby="module-integration-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">فرایند یکپارچه</span><h2 class="section-title" id="module-integration-title">{{ $page['integration_heading'] }}</h2><p class="section-sub">{{ $page['integration_intro'] }}</p></div>
        @if($slug === 'transport-operations')
            <nav class="section-sub reveal" aria-label="روش‌های حمل مرتبط">مدیریت عملیات در سپند برای <a href="{{ route('site.transport-modes.show', ['mode' => 'air']) }}">حمل هوایی</a>، <a href="{{ route('site.transport-modes.show', ['mode' => 'sea']) }}">حمل دریایی</a>، <a href="{{ route('site.transport-modes.show', ['mode' => 'road']) }}">حمل زمینی</a> و <a href="{{ route('site.transport-modes.show', ['mode' => 'rail']) }}">حمل ریلی</a> در دسترس است.</nav>
        @endif
        <div class="crm-process-grid">
            @foreach($page['connections'] as $connection)
                <article class="crm-process reveal"><span class="crm-process-step">{{ $loop->iteration }}</span><h3>{{ $connection['title'] }}</h3><p>{{ $connection['description'] }}</p><a href="{{ route('site.modules.show', ['module' => $connection['slug']]) }}">مشاهده ماژول {{ config('site_modules.'.$connection['slug'].'.short_name') }}</a></article>
            @endforeach
        </div>
    </div>
</section>

<section class="dark-section" aria-labelledby="module-benefits-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">مزیت‌های عملیاتی</span><h2 class="section-title" id="module-benefits-title">{{ $page['benefits_heading'] }}</h2></div>
        <p class="crm-benefit-intro reveal">{{ $page['benefits_intro'] }}</p>
        <ul class="crm-benefits-grid">
            @foreach($page['benefits'] as $benefit)
                <li class="reveal">{{ $benefit }}</li>
            @endforeach
        </ul>
    </div>
</section>

<section class="section" aria-labelledby="module-audience-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">مخاطبان ماژول</span><h2 class="section-title" id="module-audience-title">{{ $page['audience_heading'] }}</h2><p class="section-sub">{{ $page['audience_intro'] }}</p></div>
        <div class="crm-audience-grid">
            @foreach($page['audiences'] as $audience)
                <article class="crm-audience reveal"><h3>{{ $audience['title'] }}</h3><p>{{ $audience['description'] }}</p></article>
            @endforeach
        </div>
    </div>
</section>

@include('marketing.partials.related-content-pages')

<section class="section soft" aria-labelledby="module-faq-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">سؤالات متداول</span><h2 class="section-title" id="module-faq-title">{{ $page['faq_heading'] }}</h2></div>
        <p class="crm-faq-intro reveal">{{ $page['faq_intro'] }}</p>
        <div class="faq">
            @foreach($faqs as $faq)
                <details class="reveal"><summary>{{ $faq['question'] }}</summary><p>{{ $faq['answer'] }}</p></details>
            @endforeach
        </div>
    </div>
</section>

<section class="cta-wrap"><div class="container"><div class="cta reveal"><div class="cta-copy"><h2>{{ $page['cta']['title'] }}</h2><p>{{ $page['cta']['text'] }}</p></div><div class="cta-action"><a class="btn" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="module_{{ $slug }}_bottom_consultation">{{ $page['cta']['primary'] }}</a></div></div></div></section>
@endsection
