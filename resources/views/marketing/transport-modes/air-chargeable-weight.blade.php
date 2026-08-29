@php
    $airDemo = config('site_air_demo');
    $weight = $airDemo['weight'];
    $dimensions = $weight['dimensions'];
    $toPersianDigits = static fn ($value) => strtr((string) $value, ['0' => '۰', '1' => '۱', '2' => '۲', '3' => '۳', '4' => '۴', '5' => '۵', '6' => '۶', '7' => '۷', '8' => '۸', '9' => '۹']);
@endphp

{{-- TODO: connect Chargeable Weight calculation to production air rating data --}}

<section class="section soft air-weight-section" id="air-chargeable-weight" aria-labelledby="air-chargeable-weight-title">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label">منطق وزن · ورودی محاسبه نرخ هوایی</span>
            <h2 class="section-title" id="air-chargeable-weight-title">محاسبه Chargeable Weight در حمل هوایی</h2>
            <p class="section-sub">در عملیات Air Freight، Chargeable Weight از مقایسه وزن واقعی/ناخالص و وزن حجمی به دست می‌آید و عدد بزرگ‌تر مبنای محاسبه نرخ حمل هوایی قرار می‌گیرد.</p>
        </div>

        <figure class="air-evidence air-weight-example reveal" data-air-evidence="chargeable-weight" data-air-weight-example aria-labelledby="air-weight-caption">
            <div class="air-weight-preview" role="img" aria-label="محاسبه وزن واقعی Actual Weight، وزن حجمی Volumetric Weight و Chargeable Weight در پرونده حمل هوایی سپند">
                <header class="air-weight-example__head">
                    <div>
                        <span>پنل محاسبه وزن</span>
                        <h3>محموله · {{ $toPersianDigits($weight['cartons']) }} کارتن</h3>
                    </div>
                    <div class="air-divisor-control" aria-label="ضریب محاسبه وزن حجمی">
                        <span>ضریب محاسبه وزن حجمی</span>
                        <strong>{{ $toPersianDigits($weight['divisor']) }}</strong>
                        <small>{{ $weight['divisor_mode'] === 'configurable' ? 'قابل تنظیم' : 'ثابت' }} · {{ $toPersianDigits(implode(' / ', $weight['available_divisors'])) }}</small>
                    </div>
                </header>

                <div class="air-weight-inputs" aria-label="ورودی‌های مثال محاسبه وزن حجمی">
                    <div><span>تعداد کارتن‌ها</span><strong>{{ $toPersianDigits($weight['cartons']) }}</strong></div>
                    <div><span>ابعاد هر کارتن</span><strong dir="ltr">{{ $dimensions['length'] }} × {{ $dimensions['width'] }} × {{ $dimensions['height'] }} {{ $dimensions['unit'] }}</strong></div>
                    <div><span>وزن واقعی / ناخالص</span><strong dir="ltr">{{ $weight['actual_weight'] }} {{ $weight['weight_unit'] }}</strong></div>
                </div>

                <div class="air-weight-formula" aria-label="فرمول نمونه وزن حجمی">
                    <span>وزن حجمی</span>
                    <code dir="ltr">{{ $dimensions['length'] }} × {{ $dimensions['width'] }} × {{ $dimensions['height'] }} × {{ $weight['cartons'] }} ÷ {{ $weight['divisor'] }} = {{ $weight['volumetric_weight'] }} {{ $weight['weight_unit'] }}</code>
                </div>

                <div class="air-weight-results" aria-label="نتیجه مقایسه وزن واقعی و حجمی">
                    <article><span>وزن واقعی</span><strong dir="ltr">{{ $weight['actual_weight'] }} {{ $weight['weight_unit'] }}</strong></article>
                    <article><span>وزن حجمی</span><strong dir="ltr">{{ $weight['volumetric_weight'] }} {{ $weight['weight_unit'] }}</strong></article>
                    <article class="is-chargeable"><span>Chargeable Weight</span><strong dir="ltr">{{ $weight['chargeable_weight'] }} {{ $weight['weight_unit'] }}</strong><small>عدد بزرگ‌تر انتخاب می‌شود</small></article>
                </div>

                <ol class="air-weight-flow" aria-label="رابطه داده‌های وزن محموله هوایی با نرخ حمل">
                    <li><span>ورودی ابعاد و وزن محموله</span><small>ورودی</small></li>
                    <li><span>محاسبه وزن حجمی</span><small>محاسبه</small></li>
                    <li><span>تعیین Chargeable Weight</span><small>مبنای نرخ</small></li>
                    <li><span>ورودی محاسبه نرخ حمل هوایی</span><small>محاسبه نرخ</small></li>
                </ol>
            </div>
            <figcaption id="air-weight-caption">محاسبه Chargeable Weight براساس ابعاد و وزن محموله؛ ضریب وزن حجمی در ساختار محاسبه قابل تنظیم است.</figcaption>
        </figure>
    </div>
</section>
