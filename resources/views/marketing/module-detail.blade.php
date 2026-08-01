@extends('layouts.marketing')

@push('head')
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'SoftwareApplication',
    'name' => $module['name'].' سپند',
    'applicationCategory' => 'BusinessApplication',
    'operatingSystem' => 'Web',
    'description' => $module['meta_description'],
    'url' => route('site.modules.show', ['module' => $slug]),
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endpush

@push('styles')
    .module-problem{padding:24px;color:#fff;background:linear-gradient(135deg,var(--navy),var(--navy-900));border-radius:22px}
    .module-problem strong{display:block;margin-bottom:9px;color:var(--cyan);font-size:13px}.module-problem p{margin:0;color:rgba(255,255,255,.72);line-height:2.1}
    .module-features{display:grid;grid-template-columns:repeat(3,1fr);gap:18px}.module-feature{padding:27px;background:#fff;border:1px solid var(--line);border-radius:21px}.module-feature b{display:block;margin-bottom:9px;color:var(--navy);font-size:17px}.module-feature p{margin:0;color:var(--muted);font-size:14px;line-height:2}
    .benefit-list{display:grid;grid-template-columns:repeat(3,1fr);gap:13px;margin:28px 0 0;padding:0;list-style:none}.benefit-list li{padding:18px;color:#385269;background:#eaf5f5;border-radius:15px;font-weight:700;text-align:center}
    .related-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:17px}.related-card{display:block;padding:23px;background:#fff;border:1px solid var(--line);border-radius:18px;transition:.25s}.related-card:hover{border-color:var(--teal);transform:translateY(-4px)}.related-card b{display:block;color:var(--navy);font-size:16px}.related-card span{color:var(--teal-dark);font-size:12px;font-weight:700}
    @media(max-width:840px){.module-features,.benefit-list,.related-grid{grid-template-columns:1fr}}
@endpush

@section('content')
<section class="page-hero">
    <div class="container hero-inner">
        <div class="hero-copy reveal">
            <div class="breadcrumb"><a href="{{ route('home') }}">صفحه اصلی</a><svg viewBox="0 0 24 24" fill="none"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg><a href="{{ route('modules') }}">ماژول‌ها</a><svg viewBox="0 0 24 24" fill="none"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg><span>{{ $module['name'] }}</span></div>
            <h1>ماژول <span>{{ $module['name'] }}</span> سپند</h1>
            <p>{{ $module['summary'] }}</p>
            <div class="hero-actions">
                <a class="btn btn-primary" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="module_{{ $slug }}_consultation">درخواست دمو و مشاوره</a>
                <a class="btn btn-outline" href="{{ route('modules') }}">مشاهده همه ماژول‌ها</a>
            </div>
        </div>
        <div class="hero-art reveal">
            <div class="art-panel"><div class="art-content"><div class="art-head"><span class="art-mark"><svg viewBox="0 0 24 24" fill="none"><path d="M4 5h16v14H4V5Zm4 4h8m-8 4h8" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg></span><span class="art-chip">{{ $module['short_name'] }}</span></div><h2 class="art-title">{{ $module['name'] }}</h2><p class="art-desc">یک بخش متصل از نرم‌افزار یکپارچه سپند</p><div class="art-bars"><i></i><i></i><i></i><i></i><i></i><i></i></div></div></div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">مسئله و راهکار</span><h2 class="section-title">این ماژول چه مسئله‌ای را<br><span>حل می‌کند؟</span></h2></div>
        <div class="module-problem reveal"><strong>چالش رایج کسب‌وکار</strong><p>{{ $module['problem'] }}</p></div>
        <div class="module-features" style="margin-top:20px">
            @foreach($module['features'] as $feature)
                <article class="module-feature reveal"><b>{{ $feature['title'] }}</b><p>{{ $feature['description'] }}</p></article>
            @endforeach
        </div>
        <ul class="benefit-list">
            @foreach($module['benefits'] as $benefit)
                <li class="reveal">{{ $benefit }}</li>
            @endforeach
        </ul>
    </div>
</section>

<section class="section soft">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">ماژول‌های مرتبط</span><h2 class="section-title">فرایندهای متصل در<br><span>نرم‌افزار سپند</span></h2></div>
        <div class="related-grid">
            @foreach($relatedModules as $relatedSlug => $relatedModule)
                <a class="related-card reveal" href="{{ route('site.modules.show', ['module' => $relatedSlug]) }}"><b>{{ $relatedModule['name'] }}</b><span>مشاهده صفحه ماژول</span></a>
            @endforeach
        </div>
    </div>
</section>

<section class="cta-wrap"><div class="container"><div class="cta reveal"><div class="cta-copy"><h2>کاربرد این ماژول را در فرایند خودتان ببینید</h2><p>در جلسه دمو، سناریوی واقعی تیم شما را روی نرم‌افزار سپند بررسی می‌کنیم.</p></div><div class="cta-action"><a class="btn" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="module_{{ $slug }}_bottom_consultation">درخواست دمو</a></div></div></div></section>
@endsection
