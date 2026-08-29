@php
    $airDemo = config('site_air_demo');
    $segments = $airDemo['segments'];
    $transshipment = $airDemo['transshipment'];
@endphp

{{-- TODO: connect flight segments to production shipment API --}}
{{-- TODO: connect Flight Segment Timeline to air operations backend --}}

<section class="section air-flight-section" id="air-flight-segments" aria-labelledby="air-flight-title">
    <div class="container">
        <div class="air-split-head reveal">
            <div>
                <span class="section-label">Multi-leg &amp; Transshipment Flights</span>
                <h2 class="section-title" id="air-flight-title">مدیریت مسیرهای چندمرحله‌ای در حمل هوایی</h2>
            </div>
            <p>در Air Freight، یک Shipment ممکن است پیش از Destination از Transit Airport عبور کند. سپند مسیر را به Flight Segmentهای مستقل تفکیک می‌کند تا Flight، زمان‌بندی و Status هر Leg جدا دیده شود.</p>
        </div>

        <p class="air-entity-declaration reveal">یک <bdi dir="ltr">Air Shipment</bdi> می‌تواند چند Flight Segment داشته باشد و هر Segment دارای Origin Airport، Destination Airport، Flight Number، Segment ETD، Segment ETA و Status مستقل است.</p>

        <div class="air-status-legend reveal" aria-label="راهنمای وضعیت Flight Segment">
            @foreach($airDemo['status_labels'] as $key => $label)
                <span class="air-status is-{{ $key }}">{{ $label }}</span>
            @endforeach
        </div>

        <figure class="air-evidence air-flight-evidence reveal" data-air-evidence="flight-segment-timeline" aria-labelledby="air-flight-caption">
            <div class="air-flight-preview" role="img" aria-label="Timeline مسیر پرواز چندمرحله‌ای از Shanghai PVG به Dubai DXB و Tehran IKA همراه Transshipment و Delay در سپند">
                <header class="air-preview-header">
                    <div>
                        <span>Shipment <bdi dir="ltr">{{ $airDemo['shipment']['reference'] }}</bdi></span>
                        <h3>Flight Segment Timeline</h3>
                        <p><bdi dir="ltr">PVG → DXB → IKA</bdi> · 2 Flight Segments · 1 Transshipment</p>
                    </div>
                    <span class="air-status is-transit">In Transit</span>
                </header>

                <ol class="air-segment-timeline" aria-label="Flight Segmentهای مسیر چندمرحله‌ای محموله هوایی">
                    @foreach($segments as $segment)
                        <li class="air-segment is-{{ $segment['status_key'] }}">
                            <div class="air-segment-route">
                                <span>Leg {{ $segment['number'] }}</span>
                                <div><strong dir="ltr">{{ $segment['origin']['code'] }}</strong><small>{{ $segment['origin']['city'] }}</small></div>
                                <i aria-hidden="true">←</i>
                                <div><strong dir="ltr">{{ $segment['destination']['code'] }}</strong><small>{{ $segment['destination']['city'] }}</small></div>
                            </div>
                            <div class="air-segment-card">
                                <header>
                                    <div><span>Flight</span><strong dir="ltr">{{ $segment['flight'] }}</strong><small>{{ $segment['airline'] }}</small></div>
                                    <span class="air-status is-{{ $segment['status_key'] }}">{{ $segment['status'] }}</span>
                                </header>
                                <dl>
                                    <div><dt>Segment ETD</dt><dd dir="ltr">{{ $segment['planned_etd'] }}</dd></div>
                                    <div><dt>Segment ETA</dt><dd dir="ltr">{{ $segment['planned_eta'] }}</dd></div>
                                    <div><dt>Date</dt><dd dir="ltr">{{ $segment['date'] }}</dd></div>
                                </dl>
                                @if($segment['updated_etd'])
                                    <aside class="air-delay-event" aria-label="رویداد تأخیر Flight Segment {{ $segment['number'] }}">
                                        <span>Delay Event</span>
                                        <dl>
                                            <div><dt>Planned Departure</dt><dd dir="ltr">{{ $segment['planned_etd'] }}</dd></div>
                                            <div><dt>Updated Departure</dt><dd dir="ltr">{{ $segment['updated_etd'] }}</dd></div>
                                            <div><dt>Updated ETA</dt><dd dir="ltr">{{ $segment['updated_eta'] }}</dd></div>
                                            <div class="is-delay"><dt>Delay</dt><dd dir="ltr">{{ $segment['delay'] }}</dd></div>
                                        </dl>
                                    </aside>
                                @endif
                            </div>
                        </li>

                        @if($loop->first)
                            <li class="air-transshipment-event">
                                <div class="air-hub-marker" aria-hidden="true"><span>DXB</span></div>
                                <article>
                                    <header><div><span>Hub Event</span><h3>Transshipment · {{ $transshipment['city'] }}</h3></div><span class="air-status is-connection">{{ $transshipment['status'] }}</span></header>
                                    <dl>
                                        <div><dt>Airport</dt><dd dir="ltr">{{ $transshipment['airport'] }}</dd></div>
                                        <div><dt>Inbound Flight</dt><dd dir="ltr">{{ $transshipment['inbound_flight'] }}</dd></div>
                                        <div><dt>Outbound Flight</dt><dd dir="ltr">{{ $transshipment['outbound_flight'] }}</dd></div>
                                        <div><dt>Planned Connection</dt><dd dir="ltr">{{ $transshipment['planned_connection_time'] }}</dd></div>
                                        <div><dt>Updated Connection</dt><dd dir="ltr">{{ $transshipment['updated_connection_time'] }}</dd></div>
                                    </dl>
                                </article>
                            </li>
                        @endif
                    @endforeach
                </ol>
            </div>
            <figcaption id="air-flight-caption">نمایش مسیر چندمرحله‌ای Shipment از Origin تا Destination؛ هر Flight Leg زمان‌بندی و Status مستقل دارد و Transshipment در DXB به‌عنوان Event متفاوت از Segment نمایش داده می‌شود.</figcaption>
        </figure>

        <div class="air-flight-entity-graph reveal" aria-label="رابطه موجودیت‌های پرواز در پرونده حمل هوایی">
            <span>Air Shipment</span><i>←</i><span>Flight Segment</span><i>←</i><span>Origin / Destination Airport</span><i>←</i><span>Flight Number</span><i>←</i><span>ETD / ETA</span><i>←</i><span>Status</span>
        </div>
    </div>
</section>

<section class="section soft air-milestones-section" id="air-milestones" aria-labelledby="air-milestones-title">
    <div class="container">
        <div class="air-split-head reveal">
            <div>
                <span class="section-label">Airport Milestones</span>
                <h2 class="section-title" id="air-milestones-title">رویدادهای Air Shipment روی یک Timeline عملیاتی</h2>
            </div>
            <p>Milestoneها رخدادهای Airport و Flight را به ترتیب زمانی نشان می‌دهند؛ Delay زمان برنامه‌ریزی‌شده را حذف نمی‌کند و Updated Time کنار آن باقی می‌ماند.</p>
        </div>
        <ol class="air-milestone-timeline reveal" aria-label="Timeline رویدادهای فرودگاهی محموله هوایی">
            @foreach($airDemo['milestones'] as $milestone)
                <li class="is-{{ $milestone['tone'] }}">
                    <span class="air-milestone-dot" aria-hidden="true"></span>
                    <article>
                        <span>{{ $milestone['airport'] }}</span>
                        <h3>{{ $milestone['label'] }}</h3>
                        <time dir="ltr">{{ $milestone['time'] }}</time>
                        <small>{{ $milestone['status'] }}</small>
                    </article>
                </li>
            @endforeach
        </ol>
    </div>
</section>
