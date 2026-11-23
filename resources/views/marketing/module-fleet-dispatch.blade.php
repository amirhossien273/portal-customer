@extends('layouts.marketing')

@php
    $moduleCanonical = $canonical ?? route('site.modules.show', ['module' => $slug]);
    $faqs = $page['faqs'];
    $scenario = $page['scenario'];
    $controls = $page['registration_controls'];
    $execution = $page['execution'];
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
            'url' => $moduleCanonical,
            'description' => $module['meta_description'],
            'featureList' => ['ثبت Assignment روی Shipment و اعزام زمینی', 'کنترل تداخل، ظرفیت و مدارک هنگام ثبت', 'پیگیری وضعیت مأموریت تا تکمیل یا لغو'],
            'audience' => ['@type' => 'BusinessAudience', 'audienceType' => 'کارشناس اعزام و مدیر عملیات حمل زمینی'],
        ],
        [
            '@type' => 'FAQPage',
            '@id' => $moduleCanonical.'#faq',
            'mainEntity' => array_map(static fn (array $faq): array => [
                '@type' => 'Question',
                'name' => $faq['question'],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['answer']],
            ], $faqs),
        ],
        [
            '@type' => 'BreadcrumbList',
            '@id' => $moduleCanonical.'#breadcrumb',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'صفحه اصلی', 'item' => route('home')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'ماژول‌ها', 'item' => route('modules')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => $module['name'], 'item' => $moduleCanonical],
            ],
        ],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endpush

@include('marketing.partials.module-rich-styles')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/marketing-fleet-dispatch.css') }}?v=20261123-1">
@endpush

@section('content')
<section class="fd-hero" aria-labelledby="fleet-dispatch-title">
    <div class="container fd-hero-grid">
        <div class="fd-hero-copy reveal">
            <nav class="breadcrumb" aria-label="مسیر راهنما"><a href="{{ route('home') }}">صفحه اصلی</a><span>/</span><a href="{{ route('modules') }}">ماژول‌ها</a><span>/</span><span>{{ $module['name'] }}</span></nav>
            <span class="fd-eyebrow">Fleet Dispatch · حمل زمینی</span>
            <h1 id="fleet-dispatch-title">{{ $page['h1'] }}</h1>
            @foreach($page['hero'] as $paragraph)
                <p>{{ $paragraph }}</p>
            @endforeach
            <div class="hero-actions">
                <a class="btn btn-primary" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="fleet_dispatch_hero_demo">{{ $page['cta']['primary'] }}</a>
                <a class="btn btn-outline" href="#dispatch-example">{{ $page['cta']['secondary'] }}</a>
            </div>
        </div>
        <aside class="fd-question reveal" aria-label="سؤال محوری صفحه">
            <span>سؤال کارشناس اعزام</span>
            <strong>{{ $page['problem_heading'] }}</strong>
            <p>{{ $page['problem_intro'] }}</p>
            <div><b>ورودی این صفحه</b><span>برنامه تأییدشده و خودرو و راننده مشخص</span></div>
            <div><b>خروجی این صفحه</b><span>Assignment ثبت‌شده و وضعیت اجرایی قابل پیگیری</span></div>
        </aside>
    </div>
</section>

<section class="section fd-definition" id="dispatch-definition" aria-labelledby="dispatch-definition-title">
    <div class="container fd-definition-grid">
        <div class="reveal">
            <span class="section-label">{{ $page['search_answer']['label'] }}</span>
            <h2 class="section-title" id="dispatch-definition-title">{{ $page['search_answer']['heading'] }}</h2>
        </div>
        <div class="fd-definition-copy reveal">
            <p>{{ $page['search_answer']['text'] }}</p>
            <ul>@foreach($page['search_answer']['items'] as $item)<li>{{ $item }}</li>@endforeach</ul>
        </div>
    </div>
</section>

<section class="section soft" id="dispatch-example" aria-labelledby="dispatch-example-title">
    <div class="container">
        <header class="section-head reveal">
            <span class="section-label">{{ $scenario['label'] }}</span>
            <h2 class="section-title" id="dispatch-example-title">{{ $scenario['heading'] }}</h2>
            <p class="section-sub">{{ $scenario['intro'] }}</p>
        </header>
        <div class="fd-scenario-grid">
            <ol class="fd-steps">
                @foreach($scenario['steps'] as $step)
                    <li class="reveal"><span>{{ $loop->iteration }}</span><div><h3>{{ $step['title'] }}</h3><p>{{ $step['description'] }}</p></div></li>
                @endforeach
            </ol>
            <figure class="fd-product-shot reveal">
                <a href="{{ asset('assets/images/marketing/'.$scenario['image']) }}" target="_blank" rel="noopener">
                    <img src="{{ asset('assets/images/marketing/'.$scenario['image']) }}" width="1264" height="600" loading="lazy" alt="{{ $scenario['image_alt'] }}">
                </a>
                <figcaption><span>تصویر واقعی محصول</span><strong>Workspace ناوگان و کنترل Trip</strong><p>{{ $scenario['image_caption'] }}</p></figcaption>
            </figure>
        </div>
        <p class="fd-boundary reveal">
            اگر خودرو و راننده هنوز انتخاب نشده‌اند، ابتدا <a href="{{ route('solutions.fleet-dispatch-planning') }}">برنامه اعزام و تداخل زمانی را پیش از ثبت نهایی بررسی کنید</a>؛
            برای کنترل پرونده، ظرفیت و اعتبار مدارک به <a href="{{ route('solutions.platform.show', ['solution' => 'fleet-management']) }}">آمادگی خودرو و راننده</a> بروید؛
            و اگر مسئله تعداد کامیون و مانده هر روز یا شیفت است، <a href="{{ route('solutions.truck-movement-planning') }}">برنامه‌ریزی اعزام چندنوبتی کامیون</a> را ببینید.
        </p>
        <div class="fd-section-cta reveal"><a class="btn btn-primary" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="fleet_dispatch_scenario_demo">تخصیص یک کامیون به سفارش حمل را در دمو ببینید</a></div>
    </div>
</section>

<section class="section" id="dispatch-controls" aria-labelledby="dispatch-controls-title">
    <div class="container">
        <header class="section-head reveal">
            <span class="section-label">کنترل‌های لحظه ثبت</span>
            <h2 class="section-title" id="dispatch-controls-title">{{ $controls['heading'] }}</h2>
            <p class="section-sub">{{ $controls['intro'] }}</p>
        </header>
        <div class="fd-control-grid">
            @foreach($controls['items'] as $item)
                <article class="fd-control-card reveal"><span>{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span><h3>{{ $item['title'] }}</h3><p>{{ $item['description'] }}</p></article>
            @endforeach
        </div>
        <p class="fd-note reveal">{{ $controls['note'] }}</p>
        <p class="fd-inline-links reveal">این کنترل‌ها هنگام ثبت نهایی اجرا می‌شوند؛ آموزش انتخاب گزینه و ساخت برنامه در <a href="{{ route('solutions.fleet-dispatch-planning') }}">راهکار برنامه‌ریزی اعزام ناوگان</a> و داده‌های پایه منبع در <a href="{{ route('solutions.platform.show', ['solution' => 'fleet-management']) }}">نرم‌افزار مدیریت ناوگان حمل‌ونقل</a> قرار دارند.</p>
    </div>
</section>

<section class="section soft" id="dispatch-execution" aria-labelledby="dispatch-execution-title">
    <div class="container">
        <header class="section-head reveal">
            <span class="section-label">پیگیری اجرای مأموریت</span>
            <h2 class="section-title" id="dispatch-execution-title">{{ $execution['heading'] }}</h2>
            <p class="section-sub">{{ $execution['intro'] }} دیسپچر از همین مسیر Start، Complete یا Cancel را ثبت می‌کند.</p>
        </header>
        <div class="fd-execution-grid">
            <div class="fd-status-table-wrap reveal">
                <table>
                    <caption>چرخه وضعیت تأییدشده Fleet Assignment</caption>
                    <thead><tr><th>وضعیت</th><th>معنا در اجرای مأموریت</th></tr></thead>
                    <tbody>@foreach($execution['statuses'] as $status)<tr><th dir="ltr">{{ $status['status'] }}</th><td>{{ $status['meaning'] }}</td></tr>@endforeach</tbody>
                </table>
            </div>
            <div class="fd-calendar-evidence reveal">
                @include('marketing.partials.module-screenshot-slider')
            </div>
        </div>
        <p class="fd-boundary reveal"><strong>مرز قابلیت:</strong> {{ $execution['boundary'] }}</p>
    </div>
</section>

<section class="section" id="module-faq" aria-labelledby="module-faq-title">
    <div class="container fd-faq-grid">
        <div class="reveal"><span class="section-label">پرسش‌های کارشناس اعزام</span><h2 class="section-title" id="module-faq-title">سؤالات متداول درباره ثبت تخصیص و اجرای مأموریت</h2><p>پاسخ‌ها بر اساس مسیر ثبت Assignment و تغییر وضعیت تأییدشده در نسخه فعلی سپند نوشته شده‌اند.</p></div>
        <div class="faq">@foreach($faqs as $faq)<details class="reveal"><summary>{{ $faq['question'] }}</summary><p>{{ $faq['answer'] }}</p></details>@endforeach</div>
    </div>
</section>

<section class="cta-wrap"><div class="container"><div class="cta reveal"><div class="cta-copy"><h2>{{ $page['cta']['title'] }}</h2><p>{{ $page['cta']['text'] }}</p></div><div class="cta-action"><a class="btn" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="fleet_dispatch_bottom_demo">{{ $page['cta']['primary'] }}</a></div></div></div></section>
@endsection
