@php
    $airDemo = config('site_air_demo');
    $shipment = $airDemo['shipment'];
@endphp

{{-- TODO: connect Air Shipment Preview to production shipment API --}}

<section class="section air-overview-section" id="air-shipment-overview" aria-labelledby="air-overview-title">
    <div class="container">
        <div class="air-split-head reveal">
            <div>
                <span class="section-label">Air-specific Product Evidence 01</span>
                <h2 class="section-title" id="air-overview-title">Air Shipment Overview؛ اطلاعات کلیدی در یک Context</h2>
            </div>
            <p>Route، Weight، Air Waybill و وضعیت مسیر برای یک Shipment هوایی کنار هم دیده می‌شوند؛ این Preview از داده دمو و غیرحساس استفاده می‌کند.</p>
        </div>

        <p class="air-entity-declaration reveal">
            یک <bdi dir="ltr">Air Shipment</bdi> شامل Cargo و Weight Data است، به MAWB و HAWB متصل می‌شود و مسیر آن از یک یا چند Flight Segment با Airport، ETD، ETA و Status مستقل تشکیل می‌شود.
        </p>

        <figure class="air-evidence air-overview-evidence reveal" data-air-evidence="shipment-overview" aria-labelledby="air-overview-caption">
            <div class="air-preview" role="img" aria-label="نمای اطلاعات MAWB HAWB وزن قابل محاسبه و مسیر چندمرحله‌ای در پرونده حمل هوایی سپند">
                <header class="air-preview-header">
                    <div>
                        <span>Air Shipment</span>
                        <h3><bdi dir="ltr">{{ $shipment['reference'] }}</bdi></h3>
                        <p><bdi dir="ltr">{{ $shipment['origin']['code'] }} → {{ $shipment['transit']['code'] }} → {{ $shipment['destination']['code'] }}</bdi> · 2 Flight Segments</p>
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
                        <span class="air-preview-kicker">Air Waybill</span>
                        <dl class="air-data-list">
                            <div><dt>MAWB</dt><dd><bdi dir="ltr">{{ $shipment['mawb'] }}</bdi></dd></div>
                            <div><dt>HAWB</dt><dd><bdi dir="ltr">{{ $shipment['hawb'] }}</bdi></dd></div>
                            <div><dt>Pieces</dt><dd>{{ $shipment['pieces'] }}</dd></div>
                        </dl>
                    </section>
                    <section aria-label="اطلاعات وزن محموله هوایی">
                        <span class="air-preview-kicker">Cargo Weight</span>
                        <dl class="air-data-list">
                            <div><dt>Gross Weight</dt><dd dir="ltr">{{ $shipment['gross_weight'] }}</dd></div>
                            <div><dt>Volumetric Weight</dt><dd dir="ltr">{{ $shipment['volumetric_weight'] }}</dd></div>
                            <div class="is-emphasis"><dt>Chargeable Weight</dt><dd dir="ltr">{{ $shipment['chargeable_weight'] }}</dd></div>
                        </dl>
                    </section>
                    <section aria-label="اطلاعات مسیر و پرواز">
                        <span class="air-preview-kicker">Flight Route</span>
                        <dl class="air-data-list">
                            <div><dt>Origin</dt><dd dir="ltr">PVG · Shanghai</dd></div>
                            <div><dt>Transit</dt><dd dir="ltr">DXB · Dubai</dd></div>
                            <div><dt>Destination</dt><dd dir="ltr">IKA · Tehran</dd></div>
                        </dl>
                    </section>
                </div>
            </div>
            <figcaption id="air-overview-caption">نمای دمو و Product-style از Air Shipment؛ ثبت MAWB، HAWB، Airport Route و Actual/Volumetric/Chargeable Weight در پرونده حمل هوایی سپند.</figcaption>
        </figure>

        <div class="air-entity-graphs reveal" aria-label="روابط موجودیت‌های حمل هوایی">
            <div><strong>Weight</strong><span>Air Shipment</span><i>←</i><span>Cargo</span><i>←</i><span>Dimensions</span><i>←</i><span>Actual / Volumetric</span><i>←</i><span>Chargeable Weight</span></div>
            <div><strong>Flight</strong><span>Air Shipment</span><i>←</i><span>Flight Segment</span><i>←</i><span>Airport</span><i>←</i><span>Flight</span><i>←</i><span>ETD / ETA / Status</span></div>
        </div>
    </div>
</section>
