@if($relatedContentPages !== [])
<section class="section" aria-labelledby="related-content-pages-title">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label">راهنماها و راهکارهای مرتبط</span>
            <h2 class="section-title" id="related-content-pages-title">از این ماژول در تصمیم و سناریوی درست استفاده کنید</h2>
            <p class="section-sub">هر لینک یک نیت مستقل دارد: راهنمای انتخاب برای مقایسه گزینه‌ها و صفحه راهکار برای اجرای یک فرایند بین‌ماژولی.</p>
        </div>
        <div class="crm-audience-grid">
            @foreach($relatedContentPages as $relatedPage)
                <article class="crm-audience reveal">
                    <span class="section-label">{{ $relatedPage['group'] === 'guide' ? 'راهنمای انتخاب' : 'راهکار تخصصی' }}</span>
                    <h3>{{ $relatedPage['title'] }}</h3>
                    <p>{{ $relatedPage['description'] }}</p>
                    <a href="{{ route($relatedPage['route']) }}">مشاهده صفحه <span aria-hidden="true">←</span></a>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif
