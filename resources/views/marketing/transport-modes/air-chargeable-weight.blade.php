@php
    $airDemo = config('site_air_demo');
    $weight = $airDemo['weight'];
    $dimensions = $weight['dimensions'];
@endphp

{{-- TODO: connect Chargeable Weight calculation to production air rating data --}}

<section class="section soft air-weight-section" id="air-chargeable-weight" aria-labelledby="air-chargeable-weight-title">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label">Weight Logic · Air Rating Input</span>
            <h2 class="section-title" id="air-chargeable-weight-title">محاسبه Chargeable Weight در حمل هوایی</h2>
            <p class="section-sub">در حمل هوایی، Chargeable Weight از مقایسه Actual/Gross Weight و Volumetric Weight به دست می‌آید و عدد بزرگ‌تر مبنای Air Freight Rating قرار می‌گیرد.</p>
        </div>

        <figure class="air-evidence air-weight-example reveal" data-air-evidence="chargeable-weight" data-air-weight-example aria-labelledby="air-weight-caption">
            <div class="air-weight-preview" role="img" aria-label="محاسبه Actual Weight Volumetric Weight و Chargeable Weight در Air Shipment سپند">
                <header class="air-weight-example__head">
                    <div>
                        <span>Product-style Calculation Panel</span>
                        <h3>Shipment · {{ $weight['cartons'] }} Cartons</h3>
                    </div>
                    <div class="air-divisor-control" aria-label="ضریب محاسبه وزن حجمی">
                        <span>Volumetric Divisor</span>
                        <strong dir="ltr">{{ $weight['divisor'] }}</strong>
                        <small>{{ $weight['divisor_mode'] === 'configurable' ? 'Configurable' : 'Fixed' }} · {{ implode(' / ', $weight['available_divisors']) }}</small>
                    </div>
                </header>

                <div class="air-weight-inputs" aria-label="ورودی‌های مثال محاسبه وزن حجمی">
                    <div><span>Number of Cartons</span><strong>{{ $weight['cartons'] }}</strong></div>
                    <div><span>Dimensions per Carton</span><strong dir="ltr">{{ $dimensions['length'] }} × {{ $dimensions['width'] }} × {{ $dimensions['height'] }} {{ $dimensions['unit'] }}</strong></div>
                    <div><span>Actual / Gross Weight</span><strong dir="ltr">{{ $weight['actual_weight'] }} {{ $weight['weight_unit'] }}</strong></div>
                </div>

                <div class="air-weight-formula" aria-label="فرمول نمونه وزن حجمی">
                    <span>Volumetric Weight</span>
                    <code dir="ltr">{{ $dimensions['length'] }} × {{ $dimensions['width'] }} × {{ $dimensions['height'] }} × {{ $weight['cartons'] }} ÷ {{ $weight['divisor'] }} = {{ $weight['volumetric_weight'] }} {{ $weight['weight_unit'] }}</code>
                </div>

                <div class="air-weight-results" aria-label="نتیجه مقایسه وزن واقعی و حجمی">
                    <article><span>Actual Weight</span><strong dir="ltr">{{ $weight['actual_weight'] }} {{ $weight['weight_unit'] }}</strong></article>
                    <article><span>Volumetric Weight</span><strong dir="ltr">{{ $weight['volumetric_weight'] }} {{ $weight['weight_unit'] }}</strong></article>
                    <article class="is-chargeable"><span>Chargeable Weight</span><strong dir="ltr">{{ $weight['chargeable_weight'] }} {{ $weight['weight_unit'] }}</strong><small>عدد بزرگ‌تر انتخاب می‌شود</small></article>
                </div>

                <ol class="air-weight-flow" aria-label="رابطه داده‌های وزن محموله هوایی با نرخ حمل">
                    <li><span>Shipment Dimensions &amp; Weight</span><small>Input</small></li>
                    <li><span>Volumetric Weight</span><small>Calculation</small></li>
                    <li><span>Chargeable Weight</span><small>Rating Basis</small></li>
                    <li><span>Air Freight Rating</span><small>Air Rate Input</small></li>
                </ol>
            </div>
            <figcaption id="air-weight-caption">محاسبه و ثبت Chargeable Weight در اطلاعات محموله هوایی؛ این داده‌ها نمونه‌اند و Divisor برای اتصال آینده به تنظیمات Air Rating به‌صورت ماژولار نگهداری می‌شود.</figcaption>
        </figure>
    </div>
</section>
