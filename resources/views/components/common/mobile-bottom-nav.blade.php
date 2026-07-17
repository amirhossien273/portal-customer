@php
    $availableRoutes = auth()->user()
        ->menus('slider')
        ->flatMap(fn ($menu) => $menu->children->pluck('route')->push($menu->route))
        ->filter()
        ->unique();

    $pickRoute = fn (array $routes) => collect($routes)
        ->first(fn ($route) => $availableRoutes->contains($route) && \Illuminate\Support\Facades\Route::has($route));

    $items = collect([
        ['route' => null, 'href' => url('/'), 'label' => 'خانه', 'active' => request()->routeIs('dashboard') || request()->is('/')],
        ['route' => $pickRoute(['transaction.index', 'transaction.myTransaction']), 'label' => 'استعلام', 'active' => request()->routeIs('transaction.*')],
        ['route' => $pickRoute(['customer.index', 'customer.myCustomer']), 'label' => 'مشتریان', 'active' => request()->routeIs('customer.*')],
        ['route' => $pickRoute(['lead.index', 'lead.myLead']), 'label' => 'لیدها', 'active' => request()->routeIs('lead.*')],
    ])->filter(fn ($item) => array_key_exists('href', $item) || $item['route']);
@endphp

<nav class="mobile-bottom-nav" aria-label="ناوبری اصلی موبایل" data-testid="mobile-bottom-nav">
    @foreach($items as $item)
        <a href="{{ $item['href'] ?? route($item['route']) }}"
           class="mobile-bottom-nav__item {{ $item['active'] ? 'is-active' : '' }}"
           @if($item['active']) aria-current="page" @endif>
            @switch($item['label'])
                @case('خانه')
                    <svg viewBox="0 0 24 24" fill="none"><path d="m3 10 9-7 9 7v9a2 2 0 0 1-2 2h-4v-6H9v6H5a2 2 0 0 1-2-2v-9Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/></svg>
                    @break
                @case('استعلام')
                    <svg viewBox="0 0 24 24" fill="none"><path d="M7 3h8l4 4v14H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Z" stroke="currentColor" stroke-width="1.7"/><path d="M15 3v5h4M9 12h6M9 16h6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
                    @break
                @case('مشتریان')
                    <svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="8" r="4" stroke="currentColor" stroke-width="1.7"/><path d="M4 21c.5-4.2 3.2-6.5 8-6.5s7.5 2.3 8 6.5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
                    @break
                @case('لیدها')
                    <svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="8" stroke="currentColor" stroke-width="1.7"/><circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.7"/><path d="M12 2v3M22 12h-3M12 22v-3M2 12h3" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
                    @break
            @endswitch
            <span>{{ $item['label'] }}</span>
        </a>
    @endforeach

    <button type="button" class="mobile-bottom-nav__item" @click="$store.app.toggleSidebar()" aria-label="باز کردن منوی کامل">
        <svg viewBox="0 0 24 24" fill="none"><path d="M4 7h16M4 12h16M4 17h16" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
        <span>منو</span>
    </button>
</nav>
