<details class="nav-solutions" @if(request()->routeIs('solutions.*')) data-active="true" @endif>
    <summary @if(request()->routeIs('solutions.*')) aria-current="page" @endif>
        راهکارها
        <svg viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="m4 6 4 4 4-4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </summary>
    <div class="solutions-menu" aria-label="فهرست راهکارهای سپند">
        @foreach(config('site_content_pages.solutions', []) as $solution)
            <a href="{{ route($solution['route']) }}" @if(request()->routeIs($solution['route'])) aria-current="page" @endif>
                <span>{{ $solution['nav_title'] }}</span>
                <small>{{ $solution['nav_description'] }}</small>
            </a>
        @endforeach
    </div>
</details>
