@php
    $requestPath = '/'.ltrim(request()->path(), '/');
    $requestPath = $requestPath === '//' ? '/' : rtrim($requestPath, '/');
    $requestPath = $requestPath === '' ? '/' : $requestPath;
    $linkingPages = config('site_internal_linking.pages', []);
    $linkingPage = $linkingPages[$requestPath] ?? null;
    $linkTargets = config('site_internal_linking.targets', []);
    $resolvedLinks = collect($linkingPage['links'] ?? [])
        ->map(function (string $targetKey) use ($linkTargets, $linkingPages, $requestPath): ?array {
            $target = $linkTargets[$targetKey] ?? null;
            if (! is_array($target) || ($target['path'] ?? null) === $requestPath) {
                return null;
            }

            $anchors = $target['anchors'] ?? [];
            if ($anchors === []) {
                return null;
            }

            $sourcePaths = array_keys(array_filter(
                $linkingPages,
                static fn (array $page): bool => in_array($targetKey, $page['links'] ?? [], true),
            ));
            $sourceIndex = array_search($requestPath, $sourcePaths, true);
            $variant = (int) sprintf('%u', crc32($requestPath.'>'.$targetKey));
            $target['anchor'] = $anchors[($sourceIndex === false ? $variant : $sourceIndex) % count($anchors)];
            $target['sentence_variant'] = $variant % 4;

            return $target;
        })
        ->filter()
        ->values();
@endphp

@if(is_array($linkingPage) && $resolvedLinks->isNotEmpty())
<section class="section soft contextual-paths" aria-labelledby="contextual-paths-title" data-internal-link-tier="{{ $linkingPage['tier'] }}" data-internal-link-cluster="{{ $linkingPage['cluster'] }}">
    <div class="container">
        <header class="section-head reveal">
            @if(request()->routeIs('product'))
                <span class="section-label">قابلیت‌های مرتبط</span>
                <h2 class="section-title" id="contextual-paths-title">آشنایی بیشتر با قابلیت‌های سپند</h2>
                <p class="section-sub">برای بررسی دقیق‌تر هر بخش از نرم‌افزار فورواردری سپند، می‌توانید امکانات مدیریت مشتریان، نرخ‌دهی و فروش، عملیات حمل، مالی چندارزی و پرتال مشتریان را به‌صورت جداگانه مشاهده کنید.</p>
            @elseif(request()->routeIs('modules'))
                <span class="section-label">انتخاب و ارزیابی</span>
                <h2 class="section-title" id="contextual-paths-title">ماژول مناسب کسب‌وکار خود را انتخاب کنید</h2>
                <p class="section-sub">هر شرکت حمل‌ونقل بر اساس نوع خدمات، ساختار تیم و فرآیندهای عملیاتی خود به امکانات متفاوتی نیاز دارد. می‌توانید قابلیت‌های هر ماژول را به‌صورت جداگانه بررسی کنید یا برای شناسایی ترکیب مناسب ماژول‌های سپند، درخواست مشاوره و دموی نرم‌افزار ثبت کنید.</p>
            @else
                <span class="section-label">مسیر ادامه بررسی</span>
                <h2 class="section-title" id="contextual-paths-title">این موضوع در کدام بخش فرایند ادامه پیدا می‌کند؟</h2>
                <p class="section-sub">این مسیرها بر اساس ارتباط واقعی فرایندها انتخاب شده‌اند؛ هر لینک دامنه مستقل صفحه مقصد را توضیح می‌دهد.</p>
            @endif
        </header>
        <div class="contextual-paths-copy">
            @if(request()->routeIs('product', 'modules'))
                <p class="crm-intro reveal">
                    @foreach($resolvedLinks as $link)
                        <a class="contextual-link" href="{{ route($link['route'], $link['parameters']) }}">{{ $link['anchor'] }}</a>@unless($loop->last)<span aria-hidden="true">، </span>@endunless
                    @endforeach
                </p>
                @if(request()->routeIs('modules'))
                    <div class="contextual-paths-action reveal">
                        <a class="btn btn-primary" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="modules_consultation">درخواست دمو و مشاوره</a>
                        <a class="btn btn-outline" href="{{ route('pricing') }}" data-ga-event="cta_click" data-ga-label="modules_pricing">انتخاب پلن مناسب</a>
                    </div>
                @endif
            @else
                @foreach($resolvedLinks->chunk(3) as $linkGroup)
                    <p class="crm-intro reveal">
                        @foreach($linkGroup as $link)
                            @switch($link['sentence_variant'])
                                @case(0)
                                    برای {{ $link['context'] }}، <a class="contextual-link" href="{{ route($link['route'], $link['parameters']) }}">{{ $link['anchor'] }}</a> را بررسی کنید.@break
                                @case(1)
                                    اگر مسئله شما {{ $link['context'] }} است، <a class="contextual-link" href="{{ route($link['route'], $link['parameters']) }}">{{ $link['anchor'] }}</a> ادامه طبیعی این مسیر است.@break
                                @case(2)
                                    جزئیات {{ $link['context'] }} در <a class="contextual-link" href="{{ route($link['route'], $link['parameters']) }}">{{ $link['anchor'] }}</a> توضیح داده شده است.@break
                                @default
                                    برای تصمیم دقیق‌تر درباره {{ $link['context'] }}، <a class="contextual-link" href="{{ route($link['route'], $link['parameters']) }}">{{ $link['anchor'] }}</a> را کنار این صفحه ببینید.
                            @endswitch
                            @unless($loop->last) <span aria-hidden="true"> </span> @endunless
                        @endforeach
                    </p>
                @endforeach
            @endif
        </div>
    </div>
</section>
@endif
