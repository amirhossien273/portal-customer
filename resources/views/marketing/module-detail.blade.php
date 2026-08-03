@extends('layouts.marketing')

@php
    $capabilities = $page['capabilities'];
    $faqs = $page['faqs'];
@endphp

@push('head')
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'SoftwareApplication',
            'name' => $page['h1'],
            'applicationCategory' => 'BusinessApplication',
            'operatingSystem' => 'Web',
            'description' => $module['meta_description'],
            'url' => route('site.modules.show', ['module' => $slug]),
            'featureList' => array_column($capabilities, 'title'),
            'audience' => [
                '@type' => 'BusinessAudience',
                'audienceType' => implode('، ', array_column($page['audiences'], 'title')),
            ],
        ],
        [
            '@type' => 'FAQPage',
            'mainEntity' => array_map(static fn (array $faq): array => [
                '@type' => 'Question',
                'name' => $faq['question'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $faq['answer'],
                ],
            ], $faqs),
        ],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endpush

@include('marketing.partials.module-rich-styles')

@section('content')
<section class="page-hero">
    <div class="container hero-inner">
        <div class="hero-copy crm-hero-copy reveal">
            <div class="breadcrumb"><a href="{{ route('home') }}">صفحه اصلی</a><svg viewBox="0 0 24 24" fill="none"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg><a href="{{ route('modules') }}">ماژول‌ها</a><svg viewBox="0 0 24 24" fill="none"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg><span>{{ $module['name'] }}</span></div>
            <h1>{{ $page['h1'] }}</h1>
            @foreach($page['hero'] as $paragraph)
                <p class="crm-lead">{{ $paragraph }}</p>
            @endforeach
            <div class="hero-actions">
                <a class="btn btn-primary" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="module_{{ $slug }}_hero_consultation">{{ $page['cta']['primary'] }}</a>
                <a class="btn btn-outline" href="#module-features">{{ $page['cta']['secondary'] }}</a>
            </div>
        </div>
        <div class="hero-art crm-hero-art reveal" role="img" aria-label="نمای شماتیک {{ $module['name'] }} در نرم‌افزار سپند">
            <div class="art-panel">
                <div class="crm-dashboard">
                    <div class="crm-dashboard-head"><b>{{ $page['art']['title'] }}</b><span>{{ $module['short_name'] }} سپند</span></div>
                    @foreach($page['art']['items'] as $item)
                        <div class="crm-customer"><span class="crm-avatar">{{ $loop->iteration }}</span><div><b>{{ $item['name'] }}</b><small>{{ $item['meta'] }}</small></div><span class="crm-state">{{ $item['state'] }}</span></div>
                    @endforeach
                    <div class="crm-pipeline">
                        @foreach($page['art']['stats'] as $stat)
                            <div><b>{{ $stat['value'] }}</b><span>{{ $stat['label'] }}</span></div>
                        @endforeach
                    </div>
                </div>
            </div>
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

<section class="section" aria-labelledby="module-integration-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">فرایند یکپارچه</span><h2 class="section-title" id="module-integration-title">{{ $page['integration_heading'] }}</h2><p class="section-sub">{{ $page['integration_intro'] }}</p></div>
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
