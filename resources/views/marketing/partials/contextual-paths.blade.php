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
            <span class="section-label">مسیر ادامه بررسی</span>
            <h2 class="section-title" id="contextual-paths-title">این موضوع در کدام بخش فرایند ادامه پیدا می‌کند؟</h2>
            <p class="section-sub">این مسیرها بر اساس ارتباط واقعی فرایندها انتخاب شده‌اند؛ هر لینک دامنه مستقل صفحه مقصد را توضیح می‌دهد.</p>
        </header>
        <div class="contextual-paths-copy">
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
        </div>
    </div>
</section>
@endif
