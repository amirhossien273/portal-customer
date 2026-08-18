@extends('layouts.marketing')

@php
    $title = $comparison['title'];
    $description = $comparison['description'];
    $canonical = route($comparison['route']);
    $sepandFit = [
        'شرکت‌های فورواردری و حمل‌ونقل بین‌المللی که می‌خواهند CRM، استعلام، نرخ، Booking، عملیات، اسناد و مالی در یک زنجیره متصل باشند.',
        'مجموعه‌هایی که پیگیری وظایف، گزارش سود پرونده و پرتال مشتری متصل به اطلاعات عملیاتی برایشان مهم است.',
        'شرکت‌هایی که حمل دریایی، هوایی، زمینی یا ریلی دارند و می‌خواهند هر روش را با اطلاعات مشتری و مالی همان پرونده مدیریت کنند.',
    ];
    $moduleLinks = [
        ['label' => 'CRM', 'slug' => 'crm'],
        ['label' => 'استعلام و نرخ‌دهی', 'slug' => 'pricing-sales'],
        ['label' => 'Booking', 'slug' => 'booking'],
        ['label' => 'عملیات حمل', 'slug' => 'transport-operations'],
        ['label' => 'مدیریت اسناد', 'slug' => 'document-management'],
        ['label' => 'مالی و حسابداری', 'slug' => 'finance-accounting'],
        ['label' => 'Workflow و Task', 'slug' => 'workflow-tasks'],
        ['label' => 'پرتال مشتری', 'slug' => 'customer-portal-tracking'],
    ];
@endphp

@push('head')
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'WebPage',
            '@id' => $canonical.'#webpage',
            'name' => $title,
            'headline' => $comparison['h1'],
            'description' => $description,
            'url' => $canonical,
            'inLanguage' => 'fa-IR',
            'dateModified' => '2026-08-18',
            'isPartOf' => ['@id' => route('compare.index').'#webpage'],
            'about' => [
                ['@type' => 'SoftwareApplication', 'name' => 'نرم‌افزار سپند', 'url' => route('home')],
                ['@type' => 'SoftwareApplication', 'name' => $comparison['name'], 'url' => $comparison['source_url']],
            ],
            'significantLink' => array_merge(
                [route('compare.index'), route('pricing'), route('consultation.create')],
                array_map(static fn (array $item): string => route($item['route']), $comparisons),
                array_map(static fn (array $item): string => route('site.modules.show', ['module' => $item['slug']]), $moduleLinks),
            ),
        ],
        [
            '@type' => 'BreadcrumbList',
            '@id' => $canonical.'#breadcrumb',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'صفحه اصلی', 'item' => route('home')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'مرکز مقایسه', 'item' => route('compare.index')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => 'سپند در برابر '.$comparison['name'], 'item' => $canonical],
            ],
        ],
        [
            '@type' => 'FAQPage',
            '@id' => $canonical.'#faq',
            'mainEntity' => array_map(static fn (array $faq): array => [
                '@type' => 'Question',
                'name' => $faq['question'],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['answer']],
            ], $comparison['faqs']),
        ],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endpush

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/marketing-comparison.css') }}?v=20260818-2">
@endpush

@section('content')
<section class="page-hero comparison-competitor-hero">
    <div class="container hero-inner">
        <div class="hero-copy reveal">
            <div class="breadcrumb"><a href="{{ route('home') }}">صفحه اصلی</a><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg><a href="{{ route('compare.index') }}">مرکز مقایسه</a><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg><span>سپند و {{ $comparison['name'] }}</span></div>
            <h1>{{ $comparison['h1'] }}</h1>
            <p>{{ $comparison['direct_answer'] }}</p>
            <div class="hero-actions"><a class="btn btn-primary" href="#feature-comparison">جدول مقایسه قابلیت‌ها</a><a class="btn btn-outline" href="#demo-checklist">چک‌لیست دمو</a></div>
        </div>
        <div class="hero-art comparison-hero-art reveal" role="img" aria-label="مقایسه بی‌طرفانه نرم‌افزار سپند و {{ $comparison['name'] }}">
            <div class="comparison-visual competitor-visual">
                <div class="comparison-visual-option is-product"><span>راهکار سپند</span><strong>سپند CRM</strong><small>اطلاعات محصول و صفحات ماژول‌ها</small></div>
                <div class="comparison-visual-vs">مقایسه</div>
                <div class="comparison-visual-option is-market"><span>راهکار رقیب</span><strong>{{ $comparison['name'] }}</strong><small>فقط اطلاعات عمومی قابل تأیید</small></div>
            </div>
        </div>
    </div>
</section>

<section class="comparison-source-strip" aria-label="روش و منبع بررسی">
    <div class="container"><strong>روش بررسی بی‌طرفانه:</strong><span>اطلاعات رقیب از <a href="{{ $comparison['source_url'] }}" target="_blank" rel="noopener noreferrer">{{ $comparison['source_label'] }}</a> در تاریخ {{ $comparison['source_checked_at'] }} مرور شده است. نبود اطلاعات عمومی به معنای نبود قابلیت نیست.</span></div>
</section>

<section class="section soft" id="feature-comparison" aria-labelledby="feature-comparison-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">مقایسه قابلیت‌ها</span><h2 class="section-title" id="feature-comparison-title">جدول مقایسه سپند و {{ $comparison['name'] }}</h2><p class="section-sub">ستون وضعیت نشان می‌دهد آیا درباره رقیب اطلاعات عمومی وجود دارد یا موضوع باید در دمو و پیشنهاد رسمی تأیید شود.</p></div>
        <div class="mobile-table-hint" id="table-hint"><span aria-hidden="true">↔</span> جدول را به چپ و راست بکشید؛ ستون معیار هنگام پیمایش ثابت می‌ماند.</div>
        <div class="comparison-table-wrap competitor-table-wrap reveal" tabindex="0" role="region" aria-labelledby="feature-comparison-title" aria-describedby="table-hint">
            <table class="comparison-table competitor-table">
                <caption>مقایسه قابلیت‌های نرم‌افزار سپند و {{ $comparison['name'] }}</caption>
                <thead><tr><th scope="col">معیار</th><th scope="col">نرم‌افزار سپند</th><th scope="col">{{ $comparison['name'] }}</th><th scope="col">وضعیت اطلاعات رقیب</th></tr></thead>
                <tbody>
                    @foreach($comparison['rows'] as $row)
                        <tr><th scope="row">{{ $row['criterion'] }}</th><td class="is-strong">{{ $row['sepand'] }}</td><td>{{ $row['competitor'] }}</td><td><span @class(['evidence-status', 'needs-review' => str_contains($row['state'], 'نیازمند'), 'has-public-info' => $row['state'] === 'اطلاعات عمومی موجود'])>{{ $row['state'] }}</span></td></tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <p class="table-footnote reveal"><strong>تفسیر درست جدول:</strong> «نیازمند بررسی» یا «اطلاعات عمومی قابل تأیید یافت نشد» به معنی نبود قابلیت نیست. نسخه، پلن، جزئیات گردش کار و تعهد قراردادی را از فروشنده مربوط دریافت کنید.</p>
    </div>
</section>

<section class="section" aria-labelledby="capability-details-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">جزئیات تصمیم</span><h2 class="section-title" id="capability-details-title">قابلیت‌ها را در چه سطحی بررسی کنیم؟</h2></div>
        <div class="capability-detail-grid">
            @foreach($comparison['rows'] as $row)
                <article class="capability-detail-card reveal">
                    <h3>{{ $row['criterion'] }}</h3>
                    <p><strong>سپند:</strong> {{ $row['sepand'] }}</p>
                    <p><strong>{{ $comparison['name'] }}:</strong> {{ $row['competitor'] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="section soft" aria-labelledby="fit-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">تناسب با شرکت</span><h2 class="section-title" id="fit-title">هر راهکار برای چه شرکت‌هایی ارزش بررسی بیشتری دارد؟</h2></div>
        <div class="decision-grid">
            <article class="decision-card is-product reveal"><h3>سپند برای چه شرکت‌هایی مناسب‌تر است؟</h3><ul>@foreach($sepandFit as $item)<li>{{ $item }}</li>@endforeach</ul></article>
            <article class="decision-card is-market reveal"><h3>{{ $comparison['name'] }} برای چه شرکت‌هایی مناسب‌تر است؟</h3><ul>@foreach($comparison['competitor_fit'] as $item)<li>{{ $item }}</li>@endforeach</ul><p class="fit-disclaimer">این موارد از جایگاه‌سازی عمومی محصول استخراج شده‌اند و توصیه قطعی خرید نیستند.</p></article>
        </div>
    </div>
</section>

<section class="section" aria-labelledby="main-difference-title">
    <div class="container"><div class="comparison-answer reveal"><span class="section-label">پاسخ مستقیم</span><h2 id="main-difference-title">تفاوت اصلی سپند و {{ $comparison['name'] }} چیست؟</h2><p>{{ $comparison['main_difference'] }}</p></div></div>
</section>

<section class="section soft" id="demo-checklist" aria-labelledby="demo-checklist-title">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">قیمت و استقرار</span><h2 class="section-title" id="demo-checklist-title">قیمت، نحوه استقرار و چک‌لیست دموی مقایسه‌ای</h2><p class="section-sub">پیشنهادهای دو فروشنده را با دامنه یکسان دریافت کنید؛ قیمت خام بدون دامنه فنی قابل مقایسه نیست.</p></div>
        <div class="criteria-grid">
            <article class="criteria-card reveal"><span class="criteria-number">۰۱</span><h3>دامنه و کاربران</h3><p>تعداد کاربران، شرکت‌ها، شعب، روش‌های حمل، ماژول‌ها و سطح دسترسی موردنیاز را یکسان اعلام کنید.</p></article>
            <article class="criteria-card reveal"><span class="criteria-number">۰۲</span><h3>استقرار و امنیت</h3><p>Cloud یا On-Premise، محل داده، Backup، بازیابی، دسترس‌پذیری و مسئولیت‌های امنیتی را مکتوب کنید.</p></article>
            <article class="criteria-card reveal"><span class="criteria-number">۰۳</span><h3>پیاده‌سازی و Migration</h3><p>زمان‌بندی، پاک‌سازی و انتقال داده، آموزش، اتصال‌ها، سفارشی‌سازی و معیار تحویل را در برآورد بیاورید.</p></article>
            <article class="criteria-card reveal"><span class="criteria-number">۰۴</span><h3>هزینه کل و پشتیبانی</h3><p>لایسنس، زیرساخت، آموزش، پشتیبانی، ارتقا، توسعه‌های آتی و SLA را برای دوره یکسان جمع بزنید.</p></article>
        </div>
    </div>
</section>

<section class="comparison-links" aria-labelledby="comparison-product-links-title"><div class="container"><h2 id="comparison-product-links-title">جزئیات ماژول‌های سپند</h2><nav aria-label="صفحات مرتبط محصول">@foreach($moduleLinks as $item)<a href="{{ route('site.modules.show', ['module' => $item['slug']]) }}">{{ $item['label'] }}</a>@endforeach<a href="{{ route('pricing') }}">تعرفه‌ها</a><a href="{{ route('consultation.create') }}">درخواست دمو</a></nav></div></section>

@include('marketing.partials.comparison-cluster-links', ['comparisons' => $comparisons])

<section class="section soft" aria-labelledby="competitor-faq-title"><div class="container"><div class="section-head reveal"><span class="section-label">FAQ</span><h2 class="section-title" id="competitor-faq-title">سؤالات متداول مقایسه سپند و {{ $comparison['name'] }}</h2></div><div class="faq">@foreach($comparison['faqs'] as $faq)<details class="reveal"><summary>{{ $faq['question'] }}</summary><p>{{ $faq['answer'] }}</p></details>@endforeach</div></div></section>

<section class="cta-wrap"><div class="container"><div class="cta reveal"><div class="cta-copy"><h2>دموی سپند را با چک‌لیست خودتان برگزار کنید</h2><p>سناریوی واقعی شرکت را مطرح کنید تا قابلیت‌ها، موارد نیازمند تنظیم و محدوده قیمت بدون ادعای مقایسه‌ای بررسی شوند.</p></div><div class="cta-action"><a class="btn" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="comparison_{{ $comparison['slug'] }}_consultation">درخواست دمو سپند</a></div></div></div></section>
@endsection
