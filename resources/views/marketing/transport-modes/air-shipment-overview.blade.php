@php
    $airDemo = config('site_air_demo');
    $shipment = $airDemo['shipment'];
@endphp

{{-- TODO: connect Air Shipment Preview to production shipment API --}}

<section class="section air-overview-section" id="air-shipment-overview" aria-labelledby="air-overview-title">
    <div class="container">
        <div class="air-split-head reveal">
            <div>
                <span class="section-label">نمای عملیاتی حمل هوایی 01</span>
                <h2 class="section-title" id="air-overview-title">نمای کلی پرونده حمل هوایی؛ اطلاعات کلیدی در یک ساختار</h2>
            </div>
            <p>مسیر، وزن، بارنامه هوایی و وضعیت حمل در یک نمای نمونه کنار هم دیده می‌شوند. تمام اطلاعات این بخش، داده‌های آزمایشی و غیرحساس هستند.</p>
        </div>

        <p class="air-entity-declaration reveal">
            یک پرونده حمل هوایی شامل اطلاعات محموله و وزن است، به MAWB و HAWB متصل می‌شود و مسیر آن از یک یا چند بخش پرواز با ETD، ETA و وضعیت مستقل تشکیل می‌شود.
        </p>

        <figure class="air-evidence air-overview-evidence reveal" data-air-evidence="shipment-overview" aria-labelledby="air-overview-caption">
            <div class="air-preview" role="img" aria-label="نمای اطلاعات MAWB HAWB وزن قابل محاسبه و مسیر چندمرحله‌ای در پرونده حمل هوایی سپند">
                <header class="air-preview-header">
                    <div>
                        <span>پرونده حمل هوایی</span>
                        <h3><bdi dir="ltr">{{ $shipment['reference'] }}</bdi></h3>
                        <p><bdi dir="ltr">{{ $shipment['origin']['code'] }} → {{ $shipment['transit']['code'] }} → {{ $shipment['destination']['code'] }}</bdi> · ۲ بخش پرواز</p>
                    </div>
                    <span class="air-status is-{{ $shipment['status_tone'] }}">{{ $shipment['status'] }}</span>
                </header>

                <ol class="air-airport-route" aria-label="مسیر فرودگاهی Shanghai PVG به Dubai DXB و Tehran IKA">
                    @foreach([$shipment['origin'], $shipment['transit'], $shipment['destination']] as $airport)
                        <li class="{{ $loop->iteration === 2 ? 'is-hub' : '' }}">
                            <span>{{ $airport['role'] }}</span>
                            <strong dir="ltr">{{ $airport['code'] }}</strong>
                            <small>{{ $airport['city'] }}</small>
                        </li>
                    @endforeach
                </ol>

                <div class="air-overview-grid">
                    <section aria-label="اسناد بارنامه هوایی">
                        <span class="air-preview-kicker">بارنامه هوایی</span>
                        <dl class="air-data-list">
                            <div><dt>MAWB</dt><dd><bdi dir="ltr">{{ $shipment['mawb'] }}</bdi></dd></div>
                            <div><dt>HAWB</dt><dd><bdi dir="ltr">{{ $shipment['hawb'] }}</bdi></dd></div>
                            <div><dt>تعداد بسته‌ها</dt><dd>{{ $shipment['pieces'] }}</dd></div>
                        </dl>
                    </section>
                    <section aria-label="اطلاعات وزن محموله هوایی">
                        <span class="air-preview-kicker">وزن محموله</span>
                        <dl class="air-data-list">
                            <div><dt>وزن ناخالص</dt><dd dir="ltr">{{ $shipment['gross_weight'] }}</dd></div>
                            <div><dt>وزن حجمی</dt><dd dir="ltr">{{ $shipment['volumetric_weight'] }}</dd></div>
                            <div class="is-emphasis"><dt>Chargeable Weight</dt><dd dir="ltr">{{ $shipment['chargeable_weight'] }}</dd></div>
                        </dl>
                    </section>
                    <section aria-label="اطلاعات مسیر و پرواز">
                        <span class="air-preview-kicker">مسیر پرواز</span>
                        <dl class="air-data-list">
                            <div><dt>مبدأ</dt><dd dir="ltr">PVG · Shanghai</dd></div>
                            <div><dt>ترانزیت</dt><dd dir="ltr">DXB · Dubai</dd></div>
                            <div><dt>مقصد</dt><dd dir="ltr">IKA · Tehran</dd></div>
                        </dl>
                    </section>
                </div>
            </div>
            <figcaption id="air-overview-caption">نمای نمونه پرونده حمل هوایی با داده‌های آزمایشی و غیرحساس؛ MAWB، HAWB، مسیر فرودگاهی و اطلاعات وزن در یک ساختار نمایش داده می‌شوند.</figcaption>
        </figure>

        <div class="air-entity-graphs reveal" aria-label="روابط موجودیت‌های حمل هوایی؛ ترتیب هر رابطه از راست به چپ است">
            <article><strong>منطق وزن</strong><ol class="air-entity-flow"><li>پرونده حمل هوایی</li><li>محموله</li><li>ابعاد</li><li>وزن واقعی / وزن حجمی</li><li>Chargeable Weight</li></ol></article>
            <article><strong>مسیر پرواز</strong><ol class="air-entity-flow"><li>پرونده حمل هوایی</li><li>بخش پرواز</li><li>فرودگاه</li><li>پرواز</li><li>ETD / ETA</li><li>وضعیت</li></ol></article>
        </div>
    </div>
</section>
