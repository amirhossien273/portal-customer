<details class="nav-solutions" @if(request()->routeIs('solutions.*')) data-active="true" @endif>
    <summary @if(request()->routeIs('solutions.*')) aria-current="page" @endif>
        راهکارها
        <svg viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="m4 6 4 4 4-4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </summary>
    <div class="solutions-menu" aria-label="فهرست راهکارهای سپند">
        <a class="solutions-hub-link" href="{{ route('solutions.index') }}" @if(request()->routeIs('solutions.index')) aria-current="page" @endif>
            <span>همه راهکارها</span>
            <small>انتخاب بر اساس مسئله، شواهد محصول و عمق عملیاتی</small>
        </a>
        <span class="solutions-menu-heading">راهکارهای پلتفرمی</span>
        @foreach(config('site_platform_solutions.pages', []) as $slug => $solution)
            <a href="{{ route('solutions.platform.show', ['solution' => $slug]) }}" @if(request()->routeIs('solutions.platform.show') && request()->route('solution') === $slug) aria-current="page" @endif>
                <span>{{ $solution['nav_title'] }}</span>
                <small>{{ $solution['nav_description'] }}</small>
            </a>
        @endforeach
        <span class="solutions-menu-heading">سناریوهای تخصصی</span>
        @foreach(config('site_content_pages.solutions', []) as $solution)
            <a href="{{ route($solution['route']) }}" @if(request()->routeIs($solution['route'])) aria-current="page" @endif>
                <span>{{ $solution['nav_title'] }}</span>
                <small>{{ $solution['nav_description'] }}</small>
            </a>
        @endforeach
    </div>
</details>
