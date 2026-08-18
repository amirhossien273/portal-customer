<section class="section comparison-cluster" aria-labelledby="comparison-cluster-title">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label">Comparison Hub</span>
            <h2 class="section-title" id="comparison-cluster-title">مقایسه‌های دیگر نرم‌افزار حمل‌ونقل</h2>
            <p class="section-sub">برای تصمیم دقیق‌تر، صفحه‌های مرتبط را با همان چک‌لیست و سناریوی دمو بررسی کنید.</p>
        </div>
        <div class="comparison-cluster-grid">
            @foreach($comparisons as $item)
                @php($isCurrent = request()->routeIs($item['route']))
                <a class="comparison-cluster-card reveal{{ $isCurrent ? ' is-current' : '' }}" href="{{ route($item['route']) }}" @if($isCurrent) aria-current="page" @endif>
                    <small>{{ $item['eyebrow'] }}</small>
                    <h3>{{ $item['title'] }}</h3>
                    <p>{{ $item['description'] }}</p>
                    <span>{{ $isCurrent ? 'صفحه فعلی' : 'مشاهده مقایسه' }} <b aria-hidden="true">←</b></span>
                </a>
            @endforeach
        </div>
    </div>
</section>
