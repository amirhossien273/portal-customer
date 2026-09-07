@extends('layouts.marketing')

@php
    $solutionUrl = static fn (string $relatedSlug): string => route('solutions.platform.show', ['solution' => $relatedSlug]);
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
        ['@type' => 'WebPage', '@id' => $canonical.'#webpage', 'url' => $canonical, 'name' => $title, 'description' => $description, 'inLanguage' => 'fa-IR', 'dateModified' => config('site_platform_solutions.updated_at'), 'breadcrumb' => ['@id' => $canonical.'#breadcrumb'], 'mainEntity' => [['@id' => $canonical.'#software'], ['@id' => $canonical.'#faq']]],
        ['@type' => 'SoftwareApplication', '@id' => $canonical.'#software', 'name' => 'راهکار '.$page['nav_title'].' سپند', 'applicationCategory' => 'BusinessApplication', 'operatingSystem' => 'Web', 'url' => $canonical, 'description' => $description, 'featureList' => array_column($page['capabilities'], 'title')],
        ['@type' => 'BreadcrumbList', '@id' => $canonical.'#breadcrumb', 'itemListElement' => $breadcrumb],
        ['@type' => 'FAQPage', '@id' => $canonical.'#faq', 'mainEntity' => array_map(static fn (array $faq): array => ['@type' => 'Question', 'name' => $faq['q'], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['a']]], $page['faqs'])],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endpush

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/marketing-platform-solutions.css') }}?v=20260906-1">
@if(isset($page['demo']))<link rel="stylesheet" href="{{ asset('assets/css/marketing-real-demo.css') }}?v=20260906-1">@endif
@endpush

@section('content')
<section class="platform-hero">
    <div class="container platform-hero-grid">
        <div class="platform-hero-copy reveal">
            <nav class="breadcrumb" aria-label="مسیر صفحه">
                <a href="{{ route('home') }}">صفحه اصلی</a><span aria-hidden="true">/</span>
                <a href="{{ route('solutions.index') }}">راهکارها</a><span aria-hidden="true">/</span>
                <span>{{ $page['nav_title'] }}</span>
            </nav>
            <span class="platform-eyebrow">{{ $page['eyebrow'] }}</span>
            <h1>{{ $page['h1'] }}</h1>
            <p>{{ $page['lead'] }}</p>
            <div class="hero-actions">
                <a class="btn btn-primary" href="#product-evidence">{{ $page['hero_primary_label'] ?? 'مشاهده شواهد واقعی محصول' }}</a>
                <a class="btn btn-outline" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="{{ $slug }}_hero_demo">{{ $page['hero_secondary_label'] ?? 'درخواست دمو' }}</a>
            </div>
        </div>
        <aside class="platform-hero-panel reveal" aria-label="دامنه این راهکار">
            <span>مسئله‌ای که حل می‌شود</span>
            <h2>{{ $page['intent_heading'] ?? ($page['nav_title'].' چه زمانی ضروری است؟') }}</h2>
            <p>{{ $page['problem'] }}</p>
            <div class="platform-mini-metrics">
                @foreach(array_slice($page['metrics'], 0, 3) as $metric)<small>{{ $metric }}</small>@endforeach
            </div>
        </aside>
    </div>
</section>

<section class="platform-boundary" aria-labelledby="intent-title">
    <div class="container">
        <article class="platform-boundary-card reveal">
            <span aria-hidden="true">◎</span>
            <div><small>دامنه و کاربرد راهکار</small><h2 id="intent-title">این صفحه دقیقاً درباره چیست؟</h2><p>{{ $page['boundary'] }}</p></div>
        </article>
    </div>
</section>

<nav class="platform-toc" aria-label="فهرست بخش‌های راهکار">
    <div class="container">
        <span>در این صفحه</span>
        <a href="#capabilities">قابلیت‌ها</a><a href="#product-evidence">شواهد محصول</a>@if(isset($page['demo']))<a href="#real-demo">دموی واقعی</a>@endif<a href="#workflow">جریان اجرا</a><a href="#operational-depth">عمق عملیاتی</a><a href="#controls">کنترل‌ها</a><a href="#metrics">شاخص‌ها</a><a href="#related-solutions">راهکارهای مرتبط</a><a href="#solution-faq">پرسش‌ها</a>
    </div>
</nav>

<section class="section" id="capabilities" aria-labelledby="capabilities-title">
    <div class="container">
        <header class="section-head reveal"><span class="section-label">معماری راهکار</span><h2 class="section-title" id="capabilities-title">سه قابلیت محوری {{ $page['nav_title'] }}</h2><p class="section-sub">هر قابلیت به داده عملیاتی و خروجی قابل پیگیری متصل است؛ نه یک داشبورد جدا از فرایند.</p></header>
        <div class="platform-capability-grid">
            @foreach($page['capabilities'] as $capability)
                <article class="platform-capability-card reveal"><span>۰{{ $loop->iteration }}</span><h3>{{ $capability['title'] }}</h3><p>{{ $capability['text'] }}</p></article>
            @endforeach
        </div>
    </div>
</section>

<section class="section platform-evidence-section" id="product-evidence" aria-labelledby="evidence-title">
    <div class="container">
        <header class="section-head reveal"><span class="section-label">Product Evidence</span><h2 class="section-title" id="evidence-title">شواهد واقعی محصول؛ این راهکار در سپند کجا دیده می‌شود؟</h2><p class="section-sub">تصاویر زیر اسکرین‌شات واقعی محصول‌اند. هر شاهد به صفحه قابلیت مرتبط لینک شده تا ادعا، زمینه و مرز فعلی محصول قابل بررسی باشد.</p></header>
        <div class="platform-evidence-list">
            @foreach($page['evidence'] as $evidence)
                <article class="platform-evidence-card reveal">
                    <a class="platform-evidence-media" href="{{ route($evidence['route'], $evidence['parameters'] ?? []) }}" aria-label="{{ $evidence['cta'] }}">
                        <img src="{{ asset('assets/images/marketing/'.$evidence['image']) }}" width="1600" height="900" loading="lazy" alt="{{ $evidence['alt'] }}">
                    </a>
                    <div><span>شاهد محصول {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span><h3>{{ $evidence['title'] }}</h3><p>{{ $evidence['text'] }}</p><a href="{{ route($evidence['route'], $evidence['parameters'] ?? []) }}">{{ $evidence['cta'] }} <b aria-hidden="true">←</b></a></div>
                </article>
            @endforeach
        </div>
    </div>
</section>

@if(isset($page['demo']))
<section class="section platform-real-demo" id="real-demo" aria-labelledby="real-demo-title">
    <div class="container">
        <header class="platform-real-demo-head reveal">
            <div><span class="section-label">REAL PRODUCT WALKTHROUGH</span><h2 class="section-title" id="real-demo-title">{{ $page['demo']['title'] }}</h2></div>
            <p>{{ $page['demo']['intro'] }}</p>
        </header>
        <div class="platform-demo-strip" role="list">
            @foreach($page['demo']['steps'] as $step)
                <article class="platform-demo-step reveal" role="listitem">
                    <div class="platform-demo-media"><img src="{{ asset('assets/images/marketing/'.$step['image']) }}" width="1600" height="900" loading="lazy" alt="{{ $step['alt'] }}"><span aria-hidden="true">{{ $loop->iteration }}</span></div>
                    <small>{{ $step['label'] }}</small><h3>{{ $step['title'] }}</h3><p>{{ $step['text'] }}</p>
                </article>
            @endforeach
        </div>
        <p class="platform-demo-note reveal"><strong>شفافیت داده:</strong> {{ $page['demo']['note'] }}</p>
    </div>
</section>
@endif

<section class="section soft" id="workflow" aria-labelledby="workflow-title">
    <div class="container">
        <header class="section-head reveal"><span class="section-label">جریان عملیاتی</span><h2 class="section-title" id="workflow-title">{{ $page['nav_title'] }} از کجا شروع و چگونه پایدار می‌شود؟</h2><p class="section-sub">این توالی، مرز میان ثبت داده، کنترل سیستمی و تصمیم انسانی را روشن می‌کند.</p></header>
        <ol class="platform-workflow">
            @foreach($page['workflow'] as $step)<li class="reveal"><span>{{ $loop->iteration }}</span><div><h3>{{ $step['title'] }}</h3><p>{{ $step['text'] }}</p></div></li>@endforeach
        </ol>
    </div>
</section>

<section class="section platform-depth-section" id="operational-depth" aria-labelledby="depth-title">
    <div class="container platform-depth-layout">
        <header class="platform-depth-heading reveal"><span class="section-label">Operational Depth</span><h2 class="section-title" id="depth-title">عمق عملیاتی {{ $page['nav_title'] }}</h2><p>برای ارزیابی حرفه‌ای، فقط وجود یک فرم یا گزارش کافی نیست. باید ببینید داده از کجا می‌آید، چه کنترلی روی آن اجرا می‌شود و خروجی تا کجا قابل ردیابی است.</p></header>
        <div class="platform-depth-grid">
            @foreach($page['depth'] as $item)<article class="reveal"><span>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span><h3>{{ $item['title'] }}</h3><p>{{ $item['text'] }}</p></article>@endforeach
        </div>
    </div>
</section>

<section class="section soft" id="controls" aria-labelledby="controls-title">
    <div class="container platform-controls-layout">
        <div class="reveal"><span class="section-label">کنترل و مسئولیت</span><h2 class="section-title" id="controls-title">کنترل‌هایی که کیفیت اجرا را حفظ می‌کنند</h2><ul class="platform-check-list">@foreach($page['controls'] as $control)<li>{{ $control }}</li>@endforeach</ul></div>
        <aside class="platform-role-card reveal"><small>مالکیت فرایند</small><h2>چه کسانی در این راهکار نقش دارند؟</h2><ul>@foreach($page['roles'] as $role)<li>{{ $role }}</li>@endforeach</ul></aside>
    </div>
</section>

<section class="section" id="metrics" aria-labelledby="metrics-title">
    <div class="container">
        <header class="section-head reveal"><span class="section-label">شاخص‌های نتیجه</span><h2 class="section-title" id="metrics-title">چهار KPI برای سنجش اثربخشی {{ $page['nav_title'] }}</h2><p class="section-sub">مقدار هدف باید با خط مبنای واقعی سازمان تعیین شود؛ این شاخص‌ها نقطه شروع اندازه‌گیری‌اند.</p></header>
        <div class="platform-metric-grid">@foreach($page['metrics'] as $metric)<article class="reveal"><span>KPI {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span><h3>{{ $metric }}</h3><p>به تفکیک دوره، مسئول و نوع عملیات پایش شود تا علت تغییر قابل پیگیری بماند.</p></article>@endforeach</div>
    </div>
</section>

<section class="section soft" id="related-solutions" aria-labelledby="related-title">
    <div class="container">
        <header class="section-head reveal"><span class="section-label">مسیرهای مرتبط</span><h2 class="section-title" id="related-title">راهکارها و صفحات مکمل</h2><p class="section-sub">برای ادامه بررسی فرایند، صفحه تخصصی مرتبط را انتخاب کنید.</p></header>
        <div class="platform-related-grid">
            @foreach($page['related'] as $relatedSlug)
                @php($related = $allSolutions[$relatedSlug])
                <a class="platform-related-card reveal" href="{{ $solutionUrl($relatedSlug) }}"><span>{{ $related['eyebrow'] }}</span><h3>{{ $related['nav_title'] }}</h3><p>{{ $related['nav_description'] }}</p><b>مطالعه راهکار ←</b></a>
            @endforeach
            @foreach($page['existing_links'] as $link)
                <a class="platform-related-card is-existing reveal" href="{{ route($link['route'], $link['parameters'] ?? []) }}"><span>صفحه تخصصی</span><h3>{{ $link['label'] }}</h3><p>{{ $link['description'] ?? 'جزئیات این بخش را در صفحه تخصصی مرتبط ببینید.' }}</p><b>مشاهده صفحه ←</b></a>
            @endforeach
        </div>
    </div>
</section>

<section class="section" id="solution-faq" aria-labelledby="faq-title">
    <div class="container platform-faq-layout">
        <header class="reveal"><span class="section-label">پرسش‌های متداول</span><h2 class="section-title" id="faq-title">سؤالات متداول {{ $page['nav_title'] }}</h2><p>پاسخ‌های کوتاه برای روشن‌شدن دامنه، داده و نحوه ارزیابی راهکار.</p></header>
        <div class="faq">@foreach($page['faqs'] as $faq)<details class="reveal"><summary>{{ $faq['q'] }}</summary><p>{{ $faq['a'] }}</p></details>@endforeach</div>
    </div>
</section>

<section class="cta-wrap"><div class="container"><div class="cta reveal"><div class="cta-copy"><h2>{{ $page['cta_title'] ?? ($page['nav_title'].' را با یک سناریوی واقعی ارزیابی کنید') }}</h2><p>{{ $page['cta_text'] ?? 'یک پرونده نمونه و گلوگاه اصلی تیم را آماده کنید تا داده، کنترل، مسئولیت و خروجی در جلسه دمو بررسی شوند.' }}</p></div><div class="cta-action"><a class="btn" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="{{ $slug }}_bottom_demo">{{ $page['cta_button'] ?? 'درخواست دمو و مشاوره' }}</a></div></div></div></section>
@endsection
