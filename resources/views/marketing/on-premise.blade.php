@extends('layouts.marketing')

@php
    $depth = $page['depth'];
    $consultationUrl = route('consultation.create', ['source_page' => $canonical]);
    $structuredData = [
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
                'isPartOf' => ['@id' => route('solutions.index').'#webpage'],
                'breadcrumb' => ['@id' => $canonical.'#breadcrumb'],
                'mainEntity' => [
                    ['@id' => $canonical.'#checklist'],
                    ['@id' => $canonical.'#faq'],
                ],
                'about' => [
                    ['@type' => 'Thing', 'name' => 'نصب نرم‌افزار حمل‌ونقل روی سرور شرکت'],
                    ['@type' => 'Thing', 'name' => 'استقرار داخلی نرم‌افزار حمل‌ونقل'],
                    ['@type' => 'Thing', 'name' => 'پیش‌نیازهای On-Premise'],
                ],
                'significantLink' => [$consultationUrl, route('product'), route('pricing')],
            ],
            [
                '@type' => 'BreadcrumbList',
                '@id' => $canonical.'#breadcrumb',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => 'صفحه اصلی', 'item' => route('home')],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => 'راهکارها', 'item' => route('solutions.index')],
                    ['@type' => 'ListItem', 'position' => 3, 'name' => $page['nav_title'], 'item' => $canonical],
                ],
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
    ];
@endphp

@push('head')
<script type="application/ld+json">{!! json_encode($structuredData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endpush

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/marketing-content-page.css') }}?v=20261114-1">
<link rel="stylesheet" href="{{ asset('assets/css/marketing-on-premise.css') }}?v=20261118-1">
@endpush

@section('content')
<section class="page-hero content-page-hero on-premise-hero">
    <div class="container hero-inner">
        <div class="hero-copy reveal">
            <nav class="breadcrumb" aria-label="مسیر صفحه">
                <a href="{{ route('home') }}">صفحه اصلی</a><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                <a href="{{ route('solutions.index') }}">راهکارها</a><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                <span>{{ $page['nav_title'] }}</span>
            </nav>
            <span class="content-eyebrow">{{ $page['eyebrow'] }}</span>
            <h1>{{ $page['h1'] }}</h1>
            <p>{{ $page['lead'] }}</p>
            <div class="hero-actions">
                <a class="btn btn-primary" href="{{ $consultationUrl }}" data-ga-event="cta_click" data-ga-label="on-premise_hero_technical_review">{{ $page['hero_primary_label'] }}</a>
                <a class="btn btn-outline" href="#installation-requirements">{{ $page['hero_secondary_label'] }}</a>
            </div>
        </div>
        <aside class="content-answer-card reveal" aria-label="پاسخ کوتاه درباره امکان نصب">
            <span>پاسخ کوتاه</span>
            <p>{{ $page['answer'] }}</p>
            <ul>@foreach($page['outcomes'] as $outcome)<li>{{ $outcome['title'] }}</li>@endforeach</ul>
        </aside>
    </div>
</section>

<section class="content-intent-strip" id="diagnostic-section" aria-labelledby="installation-answer-title">
    <div class="container">
        <div class="content-intent-card reveal"><span aria-hidden="true">◎</span><div><h2 id="installation-answer-title">{{ $page['intent_title'] }}</h2><p>{{ $page['intent_text'] }}</p></div></div>
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
            <a href="#evaluation-output">فرآیند ارزیابی</a><a href="#product-scope">دامنه محصول</a><a href="#installation-requirements">پیش‌نیازها</a><a href="#installation-cost">هزینه نصب</a><a href="#technical-meeting">اطلاعات جلسه</a><a href="#content-faq-section">سؤالات متداول</a>
        </nav>
    </div>
</section>

<section class="section" id="evaluation-output" aria-labelledby="evaluation-output-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">فرآیند ارزیابی و تأیید</span><h2 class="section-title" id="evaluation-output-title">{{ $page['outcomes_heading'] }}</h2><p class="section-sub">ابتدا اطلاعات فنی و عملیاتی جمع‌آوری می‌شود، سپس موارد نیازمند آزمون یا تصمیم قراردادی روشن می‌شوند و نتیجه در پیشنهاد رسمی می‌آید.</p></div>
        <div class="content-outcomes-grid">@foreach($page['outcomes'] as $outcome)<article class="content-outcome-card reveal"><span>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span><h3>{{ $outcome['title'] }}</h3><p>{{ $outcome['description'] }}</p></article>@endforeach</div>
    </div>
</section>

<section class="section soft content-evidence-section" id="product-scope" aria-labelledby="product-scope-title">
    <div class="container content-evidence-layout">
        <figure class="content-evidence-media reveal">
            <img src="{{ asset('assets/images/marketing/'.$page['image']) }}" alt="{{ $page['image_alt'] }}" width="{{ $page['image_width'] }}" height="{{ $page['image_height'] }}" loading="lazy">
            <figcaption>{{ $page['product_scope']['caption'] }}</figcaption>
        </figure>
        <div class="content-evidence-copy reveal">
            <span class="section-label">دامنه پیشنهادی</span><h2 class="section-title" id="product-scope-title">{{ $page['product_scope']['heading'] }}</h2><p>{{ $page['product_scope']['intro'] }}</p>
            <ul class="on-premise-scope-list">@foreach($page['product_scope']['items'] as $item)<li>{{ $item }}</li>@endforeach</ul>
            <a class="on-premise-text-link" href="{{ route('product') }}">مشاهده معرفی کامل محصول <span aria-hidden="true">←</span></a>
        </div>
    </div>
</section>

<section class="section" id="installation-requirements" aria-labelledby="installation-requirements-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">زیرساخت و نگهداری</span><h2 class="section-title" id="installation-requirements-title">{{ $page['requirements_heading'] }}</h2><p class="section-sub">{{ $page['requirements_intro'] }}</p></div>
        <div class="on-premise-table-wrap reveal" id="deep-dive-section">
            <table class="on-premise-table">
                <caption class="sr-only">موضوعات بررسی فنی و نحوه تعیین مسئولیت نگهداری</caption>
                <thead><tr><th scope="col">موضوع</th><th scope="col">مواردی که بررسی می‌شوند</th><th scope="col">تعیین مسئولیت</th></tr></thead>
                <tbody>@foreach($page['requirements'] as $requirement)<tr><th scope="row">{{ $requirement['topic'] }}</th><td>{{ $requirement['review'] }}</td><td><strong>{{ $requirement['responsibility'] }}</strong></td></tr>@endforeach</tbody>
            </table>
        </div>
    </div>
</section>

<section class="section soft" id="installation-cost" aria-labelledby="installation-cost-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">مبنای برآورد</span><h2 class="section-title" id="installation-cost-title">{{ $page['cost_heading'] }}</h2><p class="section-sub">{{ $page['cost_intro'] }}</p></div>
        <div class="content-pillars-grid" id="metrics-section">@foreach($page['cost_factors'] as $factor)<article class="content-pillar-card reveal"><span class="content-pillar-index">۰{{ $loop->iteration }}</span><h3>{{ $factor['title'] }}</h3><p>{{ $factor['description'] }}</p></article>@endforeach</div>
        <aside class="on-premise-note reveal"><strong>نکته درباره تعرفه:</strong><p>{{ $page['cost_note'] }}</p><a href="{{ route('pricing') }}">مشاهده محاسبه‌گر تعرفه <span aria-hidden="true">←</span></a></aside>
    </div>
</section>

<section class="section" id="technical-meeting" aria-labelledby="technical-meeting-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">آماده‌سازی درخواست</span><h2 class="section-title" id="technical-meeting-title">{{ $page['meeting_heading'] }}</h2><p class="section-sub">{{ $page['meeting_intro'] }}</p></div>
        <div class="on-premise-meeting-grid">@foreach($page['meeting_items'] as $item)<article class="content-diagnostic-card reveal"><span class="content-card-number">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span><h3>{{ $item['title'] }}</h3><p>{{ $item['description'] }}</p></article>@endforeach</div>
    </div>
</section>

<section class="section soft content-workflow-section" id="rollout-section" aria-labelledby="workflow-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">از درخواست تا پیشنهاد</span><h2 class="section-title" id="workflow-title">{{ $page['workflow_heading'] }}</h2><p class="section-sub">{{ $page['workflow_intro'] }}</p></div>
        <ol class="content-workflow">@foreach($page['workflow'] as $step)<li class="reveal"><span>{{ $loop->iteration }}</span><div><h3>{{ $step['title'] }}</h3><p>{{ $step['description'] }}</p></div></li>@endforeach</ol>
    </div>
</section>

<section class="section" id="checklist-section" aria-labelledby="checklist-title">
    <div class="container content-checklist-layout">
        <div class="content-checklist-copy reveal"><span class="section-label">چک‌لیست فنی</span><h2 class="section-title" id="checklist-title">{{ $page['checklist_heading'] }}</h2><p>{{ $page['checklist_intro'] }}</p></div>
        <div class="content-checklist">@foreach($page['checklist'] as $item)<article class="reveal"><strong>{{ $item['criterion'] }}</strong><p>{{ $item['question'] }}</p></article>@endforeach</div>
    </div>
</section>

<section class="section soft" id="boundaries-section" aria-labelledby="boundaries-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">ادامه بررسی</span><h2 class="section-title" id="boundaries-title">{{ $page['boundary_heading'] }}</h2></div>
        <div class="content-boundaries-grid">@foreach($page['boundaries'] as $boundary)<article class="content-boundary-card reveal"><h3>{{ $boundary['title'] }}</h3><p>{{ $boundary['description'] }}</p><a href="{{ route($boundary['link']['route'], $boundary['link']['parameters'] ?? []) }}">{{ $boundary['link']['label'] }} <span aria-hidden="true">←</span></a></article>@endforeach</div>
    </div>
</section>

<section class="section" id="content-faq-section" aria-labelledby="content-faq-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">پرسش‌های خریداران</span><h2 class="section-title" id="content-faq-title">سؤالات متداول نصب سپند روی سرور شرکت</h2></div>
        <div class="faq">@foreach($page['faqs'] as $faq)<details class="reveal"><summary>{{ $faq['question'] }}</summary><p>{{ $faq['answer'] }}</p></details>@endforeach</div>
    </div>
</section>

<section class="cta-wrap"><div class="container"><div class="cta reveal"><div class="cta-copy"><h2>{{ $page['cta_title'] }}</h2><p>{{ $page['cta_text'] }}</p></div><div class="cta-action"><a class="btn" href="{{ $consultationUrl }}" data-ga-event="cta_click" data-ga-label="on-premise_bottom_technical_review">{{ $page['cta_button'] }}</a></div></div></div></section>
@endsection
