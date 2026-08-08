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
        [
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'صفحه اصلی', 'item' => route('home')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'حالت‌های حمل', 'item' => route('home').'#transport-modes'],
                ['@type' => 'ListItem', 'position' => 3, 'name' => $mode['name'], 'item' => route('site.transport-modes.show', ['mode' => $slug])],
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
            <nav class="breadcrumb" aria-label="مسیر راهنما">
                <a href="{{ route('home') }}">صفحه اصلی</a>
                <svg viewBox="0 0 24 24" fill="none"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                <a href="{{ route('home') }}#transport-modes">حالت‌های حمل</a>
                <svg viewBox="0 0 24 24" fill="none"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                <span>{{ $mode['name'] }}</span>
            </nav>
            <h1 class="module-hero-title">
                <span class="module-hero-title-main">{{ $mode['h1_main'] }}</span>
                <span class="module-hero-title-accent">{{ $mode['h1_accent'] }}</span>
            </h1>
            @foreach($mode['hero'] as $paragraph)
                <p class="crm-lead">{{ $paragraph }}</p>
            @endforeach
            <div class="hero-actions">
                <a class="btn btn-primary" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="transport_{{ $slug }}_hero_consultation">{{ $mode['cta']['primary'] }}</a>
                <a class="btn btn-outline" href="#transport-features">{{ $mode['cta']['secondary'] }}</a>
            </div>
        </div>
        <div class="hero-art crm-hero-art reveal">
            <div class="art-panel module-hero-image-panel">
                <img
                    class="module-hero-image"
                    src="{{ asset('assets/images/marketing/transport-modes/'.$slug.'-hero.webp') }}"
                    alt="تصویر سه‌بعدی {{ $mode['name'] }} در نرم‌افزار سپند"
                    width="1536"
                    height="1024"
                    loading="eager"
                    fetchpriority="high"
                >
                <span class="module-hero-brand" aria-label="سپند، CRM هوشمند حمل‌ونقل">
                    <img src="{{ asset('assets/images/brand/sepand-provided-header.png') }}" alt="" width="45" height="30">
                    <span>
                        <strong>سپند</strong>
                        <small>CRM هوشمند حمل‌ونقل</small>
                    </span>
                </span>
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
        <div class="section-head reveal"><span class="section-label">سایر حالت‌های حمل</span><h2 class="section-title" id="related-transport-title">مدیریت حمل چندوجهی در سپند</h2><p class="section-sub">پرونده‌های دریایی، هوایی، زمینی و ریلی در یک ساختار مشترک به فروش، <a href="{{ route('site.modules.show', ['module' => 'transport-operations']) }}">مدیریت عملیات حمل</a>، @if($slug === 'sea')<a href="{{ route('site.modules.show', ['module' => 'document-management']) }}">مدیریت اسناد حمل</a>@else اسناد @endif و مالی متصل می‌شوند.</p></div>
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
