@extends('layouts.marketing')

@push('head')
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        ['@type' => 'Article', '@id' => $canonical.'#article', 'headline' => $page['h1'], 'description' => $description, 'image' => $image, 'datePublished' => '2026-09-06', 'dateModified' => '2026-09-06', 'inLanguage' => 'fa-IR', 'author' => ['@type' => 'Organization', 'name' => 'سپند'], 'publisher' => ['@type' => 'Organization', 'name' => 'سپند']],
        ['@type' => 'BreadcrumbList', 'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'صفحه اصلی', 'item' => route('home')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'چرا سپند', 'item' => route('why-sepand')],
            ['@type' => 'ListItem', 'position' => 3, 'name' => 'مطالعه موردی کنترل عملیات', 'item' => $canonical],
        ]],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endpush

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/marketing-case-study.css') }}?v=20260906-1">
@endpush

@section('content')
<section class="case-hero">
    <div class="container case-hero-grid">
        <div class="reveal">
            <nav class="breadcrumb" aria-label="مسیر صفحه"><a href="{{ route('home') }}">صفحه اصلی</a><span>/</span><a href="{{ route('why-sepand') }}">چرا سپند</a><span>/</span><span>مطالعه موردی</span></nav>
            <span class="case-eyebrow">{{ $page['eyebrow'] }}</span>
            <h1>{{ $page['h1'] }}</h1>
            <p>{{ $page['lead'] }}</p>
            <div class="case-meta"><span>تاریخ Snapshot: {{ $page['captured_at'] }}</span><span>داده واقعی، هویت ناشناس</span></div>
        </div>
        <figure class="case-hero-visual reveal"><img src="{{ asset('assets/images/marketing/'.$page['image']) }}" width="{{ $page['image_width'] }}" height="{{ $page['image_height'] }}" alt="{{ $page['image_alt'] }}"><figcaption>{{ $page['scope'] }}</figcaption></figure>
    </div>
</section>

<section class="section" aria-labelledby="case-kpi-title">
    <div class="container">
        <header class="section-head reveal"><span class="section-label">Observed KPI Snapshot</span><h2 class="section-title" id="case-kpi-title">اعداد مشاهده‌شده، نه وعده بازاریابی</h2><p class="section-sub">این KPIها وضعیت یک لحظه واقعی را نشان می‌دهند و با KPI بهبود یا نتیجه علّی اشتباه گرفته نمی‌شوند.</p></header>
        <div class="case-kpis">@foreach($page['metrics'] as $metric)<article class="reveal"><strong>{{ $metric['value'] }}</strong><h3>{{ $metric['label'] }}</h3><p>{{ $metric['meaning'] }}</p></article>@endforeach</div>
    </div>
</section>

<section class="section soft" aria-labelledby="case-story-title">
    <div class="container case-story-layout">
        <header class="reveal"><span class="section-label">Operational Narrative</span><h2 class="section-title" id="case-story-title">از مشاهده تا اقدام قابل سنجش</h2><p>داستان این استقرار را بدون پرکردن فاصله‌های داده با ادعای تخمینی می‌خوانیم.</p></header>
        <ol class="case-story">@foreach($page['story'] as $item)<li class="reveal"><span>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span><div><h3>{{ $item['title'] }}</h3><p>{{ $item['text'] }}</p></div></li>@endforeach</ol>
    </div>
</section>

<section class="section case-method" aria-labelledby="case-method-title">
    <div class="container case-method-grid">
        <div class="reveal"><span class="section-label">روش و محدودیت</span><h2 class="section-title" id="case-method-title">چگونه این مطالعه را قابل اعتماد نگه داشتیم؟</h2><ul>@foreach($page['methodology'] as $item)<li>{{ $item }}</li>@endforeach</ul></div>
        <aside class="reveal"><small>NEXT MEASUREMENT WINDOW</small><h2>چهار KPI برای مطالعه قبل/بعد واقعی</h2>@foreach($page['next_kpis'] as $item)<article><h3>{{ $item['title'] }}</h3><p>{{ $item['text'] }}</p></article>@endforeach</aside>
    </div>
</section>

<section class="cta-wrap"><div class="container"><div class="cta reveal"><div class="cta-copy"><h2>مطالعه موردی بعدی را با خط مبنای واقعی سازمان شما بسازیم</h2><p>دامنه، دوره پایه و KPIها را پیش از استقرار توافق می‌کنیم تا نتیجه پس از اجرا قابل دفاع باشد.</p></div><div class="cta-action"><a class="btn" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="case_study_demo">درخواست جلسه ارزیابی</a></div></div></div></section>
@endsection
