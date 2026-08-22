@if(! empty($screenshots))
    <div
        class="art-panel module-hero-image-panel module-screenshot-panel"
        data-module-screenshot-slider
        role="region"
        aria-roledescription="carousel"
        aria-label="تصاویر واقعی ماژول {{ $module['name'] }}"
    >
        <div class="module-screenshot-viewport">
            @foreach($screenshots as $screenshot)
                <figure
                    @class(['module-screenshot-slide', 'is-active' => $loop->first])
                    data-module-screenshot
                    data-caption="{{ $screenshot['caption'] }}"
                    aria-hidden="{{ $loop->first ? 'false' : 'true' }}"
                    aria-label="تصویر {{ $loop->iteration }} از {{ $loop->count }}"
                >
                    <img
                        src="{{ asset('assets/images/marketing/'.$screenshot['path']) }}"
                        alt="{{ $screenshot['alt'] }}"
                        width="{{ $screenshot['width'] }}"
                        height="{{ $screenshot['height'] }}"
                        loading="{{ $loop->first ? 'eager' : 'lazy' }}"
                        @if($loop->first) fetchpriority="high" @endif
                        decoding="async"
                    >
                </figure>
            @endforeach
        </div>

        <div class="module-screenshot-footer">
            <span class="module-screenshot-caption" data-module-screenshot-caption aria-live="polite">{{ $screenshots[0]['caption'] }}</span>
            @if(count($screenshots) > 1)
                <div class="module-screenshot-controls">
                    <button type="button" class="module-screenshot-arrow" data-module-screenshot-prev aria-label="تصویر قبلی ماژول {{ $module['short_name'] }}">
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 5 7 7-7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </button>
                    <div class="module-screenshot-dots" aria-label="انتخاب تصویر ماژول {{ $module['short_name'] }}">
                        @foreach($screenshots as $screenshot)
                            <button
                                type="button"
                                @class(['module-screenshot-dot', 'is-active' => $loop->first])
                                data-module-screenshot-dot="{{ $loop->index }}"
                                aria-label="نمایش تصویر {{ $loop->iteration }} ماژول {{ $module['short_name'] }}"
                                aria-current="{{ $loop->first ? 'true' : 'false' }}"
                            ></button>
                        @endforeach
                    </div>
                    <button type="button" class="module-screenshot-arrow" data-module-screenshot-next aria-label="تصویر بعدی ماژول {{ $module['short_name'] }}">
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m15 5-7 7 7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </button>
                </div>
            @endif
        </div>
    </div>
@else
    <div class="art-panel module-hero-image-panel">
        <img
            class="module-hero-image"
            src="{{ asset('assets/images/marketing/modules/'.$slug.'-hero.webp') }}"
            alt="{{ $imageAlt }}"
            width="1536"
            height="1024"
            loading="eager"
            fetchpriority="high"
        >
        <span class="module-hero-brand" aria-label="سپند، CRM هوشمند حمل‌ونقل">
            <img src="{{ asset('assets/images/brand/sepand-provided-header.png') }}" alt="" width="45" height="30">
            <span><strong>سپند</strong><small>CRM هوشمند حمل‌ونقل</small></span>
        </span>
    </div>
@endif

@if(! empty($screenshots))
    @once
        @push('scripts')
        <script>
            document.querySelectorAll('[data-module-screenshot-slider]').forEach(slider => {
                const slides = Array.from(slider.querySelectorAll('[data-module-screenshot]'));
                const dots = Array.from(slider.querySelectorAll('[data-module-screenshot-dot]'));
                const caption = slider.querySelector('[data-module-screenshot-caption]');
                const previous = slider.querySelector('[data-module-screenshot-prev]');
                const next = slider.querySelector('[data-module-screenshot-next]');
                let currentIndex = 0;
                let touchStartX = 0;

                const show = index => {
                    currentIndex = (index + slides.length) % slides.length;
                    slides.forEach((slide, slideIndex) => {
                        const isActive = slideIndex === currentIndex;
                        slide.classList.toggle('is-active', isActive);
                        slide.setAttribute('aria-hidden', String(!isActive));
                    });
                    dots.forEach((dot, dotIndex) => {
                        const isActive = dotIndex === currentIndex;
                        dot.classList.toggle('is-active', isActive);
                        dot.setAttribute('aria-current', String(isActive));
                    });
                    caption.textContent = slides[currentIndex].dataset.caption;
                };

                previous?.addEventListener('click', () => show(currentIndex - 1));
                next?.addEventListener('click', () => show(currentIndex + 1));
                dots.forEach(dot => dot.addEventListener('click', () => show(Number(dot.dataset.moduleScreenshotDot))));
                slider.addEventListener('touchstart', event => { touchStartX = event.changedTouches[0].clientX; }, { passive: true });
                slider.addEventListener('touchend', event => {
                    const distance = event.changedTouches[0].clientX - touchStartX;
                    if (Math.abs(distance) < 35 || slides.length < 2) return;
                    show(currentIndex + (distance < 0 ? 1 : -1));
                }, { passive: true });
            });
        </script>
        @endpush
    @endonce
@endif
