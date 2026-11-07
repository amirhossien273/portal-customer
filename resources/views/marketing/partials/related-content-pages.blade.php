@if($relatedContentPages !== [])
<section class="section" aria-labelledby="related-content-pages-title">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label">راهنماها و راهکارهای مرتبط</span>
            <h2 class="section-title" id="related-content-pages-title">{{ $page['related_heading'] ?? 'آشنایی بیشتر با قابلیت‌های سپند' }}</h2>
            <p class="section-sub">{{ $page['related_intro'] ?? 'برای بررسی دقیق‌تر امکانات مرتبط، ماژول‌ها و راهکارهای تخصصی سپند را مشاهده کنید.' }}</p>
        </div>
        <div class="crm-audience-grid">
            @foreach($relatedContentPages as $relatedPage)
                <article class="crm-audience reveal">
                    <span class="section-label">{{ $relatedPage['group'] === 'guide' ? 'راهنمای انتخاب' : 'راهکار تخصصی' }}</span>
                    <h3>{{ $relatedPage['title'] }}</h3>
                    <p>{{ $relatedPage['description'] }}</p>
                    <a href="{{ route($relatedPage['route'], $relatedPage['parameters'] ?? []) }}">{{ $relatedPage['anchor'] ?? $relatedPage['title'] }} <span aria-hidden="true">←</span></a>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif
