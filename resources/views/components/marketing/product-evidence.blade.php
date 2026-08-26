@props(['section'])

<section
    class="product-evidence{{ ! empty($section['reverse']) ? ' is-reverse' : '' }}{{ ! empty($section['featured']) ? ' is-featured' : '' }}"
    id="{{ $section['id'] }}"
    aria-labelledby="{{ $section['id'] }}-title"
>
    <div class="container">
        <div class="product-evidence-grid">
            <header class="product-evidence-heading reveal">
                <span class="product-evidence-eyebrow">{{ $section['eyebrow'] }}</span>
                <h2 id="{{ $section['id'] }}-title">{{ $section['title'] }}</h2>
                @if(! empty($section['lead']))
                    <p>{{ $section['lead'] }}</p>
                @endif
            </header>

            <div class="product-evidence-media reveal" aria-label="شواهد واقعی بخش {{ $section['title'] }}">
                @if(! empty($section['images']))
                    <div
                        class="product-evidence-gallery"
                        data-evidence-gallery
                        role="region"
                        aria-roledescription="carousel"
                        aria-label="تصاویر واقعی {{ $section['title'] }} در سپند"
                    >
                        <div class="product-evidence-viewport">
                            @foreach($section['images'] as $image)
                                <figure
                                    class="product-evidence-slide{{ $loop->first ? ' is-active' : '' }}"
                                    data-evidence-slide
                                    data-caption="{{ $image['caption'] }}"
                                    aria-hidden="{{ $loop->first ? 'false' : 'true' }}"
                                >
                                    <button
                                        class="product-screenshot-button"
                                        type="button"
                                        data-product-lightbox-open
                                        data-image-src="{{ asset('assets/images/marketing/'.$image['path']) }}"
                                        data-image-alt="{{ $image['alt'] }}"
                                        data-image-caption="{{ $image['caption'] }}"
                                        aria-label="نمایش بزرگ‌تر: {{ $image['alt'] }}"
                                    >
                                        <img
                                            src="{{ asset('assets/images/marketing/'.$image['path']) }}"
                                            alt="{{ $image['alt'] }}"
                                            width="{{ $image['width'] }}"
                                            height="{{ $image['height'] }}"
                                            loading="lazy"
                                            decoding="async"
                                        >
                                        <span class="product-screenshot-zoom" aria-hidden="true">
                                            <svg viewBox="0 0 24 24" fill="none"><circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="1.7"/><path d="m20 20-4-4M8 11h6M11 8v6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
                                            بزرگ‌نمایی
                                        </span>
                                    </button>
                                </figure>
                            @endforeach
                        </div>
                        <div class="product-evidence-gallery-footer">
                            <span class="product-real-badge">تصویر واقعی نرم‌افزار سپند</span>
                            <p data-evidence-caption aria-live="polite">{{ $section['images'][0]['caption'] }}</p>
                            @if(count($section['images']) > 1)
                                <div class="product-gallery-controls">
                                    <button type="button" data-evidence-previous aria-label="تصویر قبلی {{ $section['title'] }}">
                                        <svg viewBox="0 0 24 24" fill="none"><path d="m9 5 7 7-7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    </button>
                                    <div class="product-gallery-dots" aria-label="انتخاب تصویر {{ $section['title'] }}">
                                        @foreach($section['images'] as $image)
                                            <button
                                                type="button"
                                                class="{{ $loop->first ? 'is-active' : '' }}"
                                                data-evidence-dot="{{ $loop->index }}"
                                                aria-label="نمایش تصویر {{ $loop->iteration }} از {{ $loop->count }}"
                                                aria-current="{{ $loop->first ? 'true' : 'false' }}"
                                            ></button>
                                        @endforeach
                                    </div>
                                    <button type="button" data-evidence-next aria-label="تصویر بعدی {{ $section['title'] }}">
                                        <svg viewBox="0 0 24 24" fill="none"><path d="m15 5-7 7 7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                    @if(! empty($section['missing_evidence']))
                        <aside class="product-missing-evidence" role="note" aria-label="تصاویر تکمیلی موردنیاز برای {{ $section['title'] }}">
                            <strong>Evidence تصویری تکمیلی موردنیاز</strong>
                            <ul>
                                @foreach($section['missing_evidence'] as $missing)
                                    <li>
                                        <span>{{ $missing['label'] }}</span>
                                        <code dir="ltr">{{ $missing['file'] }}</code>
                                    </li>
                                @endforeach
                            </ul>
                            {{-- TODO: Replace this note only after the exact real Sepand screen(s) above are supplied. --}}
                        </aside>
                    @endif
                @else
                    {{-- TODO: Replace with a real Sepand document-management screenshot showing shipment-linked files, version and approval status. --}}
                    <div class="product-screenshot-placeholder" role="note" data-missing-screenshot="document-management">
                        <span class="product-placeholder-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none"><path d="M7 3h7l4 4v14H7V3Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M14 3v5h5M10 12h5M10 16h5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
                        </span>
                        <strong>اسکرین واقعی این بخش هنوز موجود نیست</strong>
                        <p>{{ $section['placeholder'] }}</p>
                        <code dir="ltr">document-management-shipment-files.webp</code>
                    </div>
                @endif
            </div>

            <div class="product-evidence-details reveal">
                <article>
                    <span>مسئله</span>
                    <p>{{ $section['problem'] }}</p>
                </article>
                <article>
                    <span>اقدام سپند</span>
                    <p>{{ $section['action'] }}</p>
                </article>
                <article class="is-outcome">
                    <span>خروجی قابل مشاهده</span>
                    <p>{{ $section['outcome'] }}</p>
                </article>
            </div>

            <div class="product-evidence-link reveal">
                <a href="{{ $section['cta_url'] ?? route('site.modules.show', ['module' => $section['module']]) }}">
                    {{ $section['cta'] }}
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M19 12H5m6 6-6-6 6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>
