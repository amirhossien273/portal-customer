@extends('layouts.marketing')

@php
    $capabilities = $mode['capabilities'];
    $faqs = $mode['faqs'];
@endphp

@push('head')
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'SoftwareApplication',
            'name' => $mode['h1'],
            'applicationCategory' => 'BusinessApplication',
            'operatingSystem' => 'Web',
            'description' => $mode['meta_description'],
            'url' => route('site.transport-modes.show', ['mode' => $slug]),
            'featureList' => array_column($capabilities, 'title'),
        ],
        [
            '@type' => 'FAQPage',
            'mainEntity' => array_map(static fn (array $faq): array => [
                '@type' => 'Question',
                'name' => $faq['question'],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['answer']],
            ], $faqs),
        ],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endpush

@include('marketing.partials.module-rich-styles')

@push('styles')
    .mode-related{display:block;height:100%;transition:.25s}.mode-related:hover{border-color:var(--teal);transform:translateY(-4px);box-shadow:var(--shadow)}.mode-related .mode-related-link{display:inline-flex;margin-top:13px;color:var(--teal-dark);font-size:12px;font-weight:700}
@endpush

@section('content')
<section class="page-hero">
    <div class="container hero-inner">
        <div class="hero-copy crm-hero-copy reveal">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">صفحه اصلی</a>
                <svg viewBox="0 0 24 24" fill="none"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                <a href="{{ route('home') }}#transport-modes">حالت‌های حمل</a>
                <svg viewBox="0 0 24 24" fill="none"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                <span>{{ $mode['name'] }}</span>
            </div>
            <h1>{{ $mode['h1'] }}</h1>
            @foreach($mode['hero'] as $paragraph)
                <p class="crm-lead">{{ $paragraph }}</p>
            @endforeach
            <div class="hero-actions">
                <a class="btn btn-primary" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="transport_{{ $slug }}_hero_consultation">{{ $mode['cta']['primary'] }}</a>
                <a class="btn btn-outline" href="#transport-features">{{ $mode['cta']['secondary'] }}</a>
            </div>
        </div>
        <div class="hero-art crm-hero-art reveal" role="img" aria-label="نمای شماتیک پرونده‌های {{ $mode['name'] }} در نرم‌افزار سپند">
            <div class="art-panel">
                <div class="crm-dashboard">
                    <div class="crm-dashboard-head"><b>{{ $mode['art']['title'] }}</b><span>{{ $mode['short_name'] }} سپند</span></div>
                    @foreach($mode['art']['items'] as $item)
                        <div class="crm-customer"><span class="crm-avatar">{{ $loop->iteration }}</span><div><b>{{ $item['name'] }}</b><small>{{ $item['meta'] }}</small></div><span class="crm-state">{{ $item['state'] }}</span></div>
                    @endforeach
                    <div class="crm-pipeline">
                        @foreach($mode['art']['stats'] as $stat)
                            <div><b>{{ $stat['value'] }}</b><span>{{ $stat['label'] }}</span></div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section soft" id="transport-features" aria-labelledby="transport-features-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">امکانات تخصصی</span><h2 class="section-title" id="transport-features-title">{{ $mode['features_heading'] }}</h2><p class="section-sub">{{ $mode['features_intro'] }}</p></div>
        <div class="crm-capability-grid">
            @foreach($capabilities as $index => $capability)
                <article class="crm-capability reveal"><span class="crm-capability-num">{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</span><h3>{{ $capability['title'] }}</h3><p>{{ $capability['description'] }}</p></article>
            @endforeach
        </div>
    </div>
</section>

<section class="section" aria-labelledby="transport-workflow-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">فرایند یکپارچه</span><h2 class="section-title" id="transport-workflow-title">{{ $mode['workflow_heading'] }}</h2><p class="section-sub">{{ $mode['workflow_intro'] }}</p></div>
        <div class="crm-process-grid">
            @foreach($mode['workflow'] as $step)
                <article class="crm-process reveal"><span class="crm-process-step">{{ $loop->iteration }}</span><h3>{{ $step['title'] }}</h3><p>{{ $step['description'] }}</p></article>
            @endforeach
        </div>
    </div>
</section>

<section class="dark-section" aria-labelledby="transport-benefits-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">مزیت‌های عملیاتی</span><h2 class="section-title" id="transport-benefits-title">{{ $mode['benefits_heading'] }}</h2></div>
        <p class="crm-benefit-intro reveal">{{ $mode['benefits_intro'] }}</p>
        <ul class="crm-benefits-grid">
            @foreach($mode['benefits'] as $benefit)
                <li class="reveal">{{ $benefit }}</li>
            @endforeach
        </ul>
    </div>
</section>

<section class="section" aria-labelledby="related-transport-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">سایر حالت‌های حمل</span><h2 class="section-title" id="related-transport-title">مدیریت حمل چندوجهی در سپند</h2><p class="section-sub">پرونده‌های دریایی، هوایی، زمینی و ریلی در یک ساختار مشترک به فروش، عملیات، اسناد و مالی متصل می‌شوند.</p></div>
        <div class="crm-process-grid">
            @foreach($relatedModes as $relatedSlug => $relatedMode)
                <a class="crm-process mode-related reveal" href="{{ route('site.transport-modes.show', ['mode' => $relatedSlug]) }}"><span class="crm-process-step">{{ $loop->iteration }}</span><h3>{{ $relatedMode['name'] }}</h3><p>{{ $relatedMode['card_summary'] }}</p><span class="mode-related-link">مشاهده جزئیات ←</span></a>
            @endforeach
        </div>
    </div>
</section>

<section class="section soft" aria-labelledby="transport-faq-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">سؤالات متداول</span><h2 class="section-title" id="transport-faq-title">{{ $mode['faq_heading'] }}</h2></div>
        <p class="crm-faq-intro reveal">{{ $mode['faq_intro'] }}</p>
        <div class="faq">
            @foreach($faqs as $faq)
                <details class="reveal"><summary>{{ $faq['question'] }}</summary><p>{{ $faq['answer'] }}</p></details>
            @endforeach
        </div>
    </div>
</section>

<section class="cta-wrap"><div class="container"><div class="cta reveal"><div class="cta-copy"><h2>{{ $mode['cta']['title'] }}</h2><p>{{ $mode['cta']['text'] }}</p></div><div class="cta-action"><a class="btn" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="transport_{{ $slug }}_bottom_consultation">{{ $mode['cta']['primary'] }}</a></div></div></div></section>
@endsection
