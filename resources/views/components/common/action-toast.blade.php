@php
    $actionToastType = $errors->any()
        ? 'error'
        : (session('error') ? 'error'
            : (session('warning') ? 'warning'
                : ((session('info') || session('status') || session('message')) ? 'info'
                    : (session('success') ? 'success' : null))));
    $actionToastMessage = $errors->any()
        ? $errors->first()
        : (session('error')
            ?? session('warning')
            ?? session('info')
            ?? session('status')
            ?? session('message')
            ?? session('success'));
    $actionToastTitle = match($actionToastType) {
        'error' => 'عملیات انجام نشد',
        'warning' => 'هشدار',
        'info' => 'پیام سیستم',
        default => 'عملیات موفق بود',
    };
@endphp

@if(filled($actionToastMessage))
    <div x-data="{ show: true }"
         x-show="show"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-3"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-3"
         x-init="setTimeout(() => show = false, 5000)"
         class="app-action-toast is-{{ $actionToastType }}"
         role="{{ $actionToastType === 'error' ? 'alert' : 'status' }}">
        <span class="app-action-toast__icon" aria-hidden="true">
            @if($actionToastType === 'error')
                <svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.8"/><path d="M12 7.5v6M12 17h.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
            @elseif($actionToastType === 'warning')
                <svg viewBox="0 0 24 24" fill="none"><path d="M12 4 3 20h18L12 4Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="M12 9v5M12 17h.01" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
            @elseif($actionToastType === 'info')
                <svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.8"/><path d="M12 11v5M12 8h.01" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
            @else
                <svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.8"/><path d="m8 12 2.5 2.5L16.5 9" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
            @endif
        </span>
        <div>
            <strong>{{ $actionToastTitle }}</strong>
            <span>{{ $actionToastMessage }}</span>
        </div>
        <button type="button" @click="show = false" aria-label="بستن">×</button>
    </div>
@endif

@once
    <style>
        .app-action-toast { position: fixed; top: 20px; left: 20px; z-index: 2147483000; display: grid; grid-template-columns: 38px minmax(0,1fr) 24px; align-items: center; gap: 10px; width: min(390px, calc(100vw - 32px)); padding: 13px 14px; border: 1px solid; border-radius: 14px; background: #fff; box-shadow: 0 18px 45px rgb(15 23 42 / 20%); direction: rtl; }
        .app-action-toast.is-success { border-color: rgb(0 171 85 / 25%); }
        .app-action-toast.is-error { border-color: rgb(231 81 90 / 25%); }
        .app-action-toast.is-warning { border-color: rgb(226 160 63 / 30%); }
        .app-action-toast.is-info { border-color: rgb(47 145 150 / 28%); }
        .app-action-toast__icon { display: grid; width: 38px; height: 38px; place-items: center; border-radius: 50%; }
        .app-action-toast.is-success .app-action-toast__icon { color: #079553; background: rgb(0 171 85 / 11%); }
        .app-action-toast.is-error .app-action-toast__icon { color: #d7434c; background: rgb(231 81 90 / 11%); }
        .app-action-toast.is-warning .app-action-toast__icon { color: #b87924; background: rgb(226 160 63 / 13%); }
        .app-action-toast.is-info .app-action-toast__icon { color: #287e84; background: rgb(47 145 150 / 12%); }
        .app-action-toast__icon svg { width: 22px; height: 22px; }
        .app-action-toast > div { min-width: 0; }
        .app-action-toast > div strong { display: block; color: #1f3446; font-size: 12px; font-weight: 900; }
        .app-action-toast > div span { display: block; margin-top: 3px; color: #758793; font-size: 9px; line-height: 1.7; overflow-wrap: anywhere; }
        .app-action-toast > button { display: grid; width: 24px; height: 24px; place-items: center; border: 0; border-radius: 50%; color: #82919b; background: #f0f3f4; font-size: 17px; line-height: 1; }
        .dark .app-action-toast { border-color: #294359; background: #102c42; box-shadow: 0 18px 45px rgb(0 0 0 / 35%); }
        .dark .app-action-toast > div strong { color: #e2eff3; }
        .dark .app-action-toast > div span { color: #adc0c8; }

        @media (max-width: 767px) {
            .app-action-toast { top: 12px; left: 12px; width: calc(100vw - 24px); padding: 11px 12px; border-radius: 12px; }
        }
    </style>
@endonce
