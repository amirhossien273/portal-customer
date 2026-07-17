@php
    $flashItems = collect([
        'success' => session('success'),
        'error' => session('error'),
        'warning' => session('warning'),
        'info' => session('info') ?? session('status') ?? session('message'),
    ])->filter(fn ($message) => filled($message));

    if ($errors->any()) {
        $flashItems->put('error', $errors->first());
    }

    $flashStyles = [
        'success' => ['title' => 'موفقیت', 'color' => '#00ab55', 'bg' => 'rgba(0, 171, 85, .12)', 'border' => 'rgba(0, 171, 85, .25)', 'icon' => 'M9 12.75 11.25 15 15 9.75', 'circle' => true],
        'error' => ['title' => 'خطا', 'color' => '#e7515a', 'bg' => 'rgba(231, 81, 90, .12)', 'border' => 'rgba(231, 81, 90, .25)', 'icon' => 'M6 18 18 6M6 6l12 12', 'circle' => false],
        'warning' => ['title' => 'هشدار', 'color' => '#e2a03f', 'bg' => 'rgba(226, 160, 63, .14)', 'border' => 'rgba(226, 160, 63, .28)', 'icon' => 'M12 9v4m0 4h.01', 'circle' => true],
        'info' => ['title' => 'پیام', 'color' => '#247387', 'bg' => 'rgba(47, 145, 150, .12)', 'border' => 'rgba(47, 145, 150, .25)', 'icon' => 'M12 16v-4m0-4h.01', 'circle' => true],
    ];
@endphp

{{--@if($flashItems->isNotEmpty())--}}
{{--    <div id="global-flash-alerts" style="position: fixed; top: 20px; right: 20px; z-index: 2147483647; width: min(420px, calc(100vw - 32px)); display: flex; flex-direction: column; gap: 12px; pointer-events: none;">--}}
{{--        @foreach($flashItems as $type => $message)--}}
{{--            @php($style = $flashStyles[$type] ?? $flashStyles['info'])--}}
{{--            <div class="global-flash-alert" dir="rtl" style="pointer-events: auto; display: flex; gap: 10px; align-items: flex-start; padding: 14px 16px; border-radius: 8px; border: 1px solid {{ $style['border'] }}; background: #fff; color: #1f2937; box-shadow: 0 12px 32px rgba(15, 23, 42, .18); transition: opacity .25s ease, transform .25s ease;">--}}
{{--                <span style="width: 32px; height: 32px; border-radius: 999px; background: {{ $style['bg'] }}; color: {{ $style['color'] }}; display: inline-flex; align-items: center; justify-content: center; flex: 0 0 auto;">--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">--}}
{{--                        @if($style['circle'])--}}
{{--                            <circle cx="12" cy="12" r="9"></circle>--}}
{{--                        @endif--}}
{{--                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $style['icon'] }}"></path>--}}
{{--                    </svg>--}}
{{--                </span>--}}
{{--                <span style="flex: 1; min-width: 0;">--}}
{{--                    <strong style="display: block; font-size: 14px; color: #111827; margin-bottom: 4px;">{{ $style['title'] }}</strong>--}}
{{--                    <span style="display: block; font-size: 14px; line-height: 1.8; overflow-wrap: anywhere;">{{ $message }}</span>--}}
{{--                </span>--}}
{{--                <button type="button" class="global-flash-close" onclick="this.closest('.global-flash-alert').remove()" style="border: 0; background: transparent; color: #64748b; cursor: pointer; padding: 0; line-height: 1; flex: 0 0 auto;" aria-label="بستن">--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">--}}
{{--                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"></path>--}}
{{--                    </svg>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        @endforeach--}}
{{--    </div>--}}
{{--    <script>--}}
{{--        window.setTimeout(() => {--}}
{{--            document.querySelectorAll('.global-flash-alert').forEach((alert) => {--}}
{{--                alert.style.opacity = '0';--}}
{{--                alert.style.transform = 'translateY(-8px)';--}}
{{--                window.setTimeout(() => alert.remove(), 260);--}}
{{--            });--}}
{{--        }, 4500);--}}
{{--    </script>--}}
{{--@endif--}}
