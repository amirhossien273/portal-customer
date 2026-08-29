@php
    $roadDemo = config('site_road_demo');
    $costs = $roadDemo['costs'];
@endphp

{{-- TODO: connect trip costs to production finance records --}}

<section class="section road-cost-section" id="road-trip-costs" aria-labelledby="road-cost-title">
    <div class="container">
        <div class="road-split-head reveal">
            <div>
                <span class="section-label">نمای عملیاتی حمل زمینی 04</span>
                <h2 class="section-title" id="road-cost-title">هزینه‌های واقعی سفر و اتصال کوتاه عملیات به مالی</h2>
            </div>
            <p>هزینه راننده، سوخت، عوارض، مرز و انتظار به Trip مربوط متصل می‌شوند و جمع آن‌ها در ادامه وارد پرونده مالی همان Shipment می‌شود؛ بدون بازسازی کامل ماژول Finance در این صفحه.</p>
        </div>

        <figure class="road-evidence road-cost-preview reveal" data-road-evidence="trip-cost-flow" aria-labelledby="road-cost-caption">
            <div role="img" aria-label="نمای هزینه‌های سفر و اتصال Trip Cost به مالی در سپند">
                <header class="road-preview-header">
                    <div><span>Trip Cost</span><h3>هزینه‌های سفر <bdi dir="ltr">{{ $roadDemo['shipment']['reference'] }}</bdi></h3><p>Route Event → Operational Cost → Trip Cost → Finance</p></div>
                    <span class="road-status is-finance">ثبت آزمایشی هزینه</span>
                </header>

                <div class="road-cost-layout">
                    <section class="road-cost-table-wrap" aria-labelledby="road-cost-table-title">
                        <h3 id="road-cost-table-title">ریز هزینه‌های همان Trip</h3>
                        <div class="road-cost-table" role="table" aria-label="جدول هزینه‌های سفر زمینی">
                            @foreach($costs['items'] as $item)
                                <div role="row"><span role="cell">{{ $item['label'] }}</span><strong role="cell" dir="ltr">{{ number_format($item['amount']) }} {{ $costs['currency'] }}</strong></div>
                            @endforeach
                            <div class="is-total" role="row"><span role="cell">جمع هزینه سفر</span><strong role="cell" dir="ltr">{{ number_format($costs['total']) }} {{ $costs['currency'] }}</strong></div>
                        </div>
                    </section>

                    <section class="road-cost-route-wrap" aria-labelledby="road-cost-route-title">
                        <h3 id="road-cost-route-title">رویداد مسیر چگونه هزینه می‌سازد؟</h3>
                        <ol class="road-cost-route" aria-label="ارتباط هزینه‌های سفر با نقاط مسیر">
                            @foreach($roadDemo['cost_route'] as $point)
                                <li><span dir="ltr">{{ $point['place'] }}</span><div>@foreach($point['items'] as $item)<p><b>{{ $item['label'] }}</b><strong dir="ltr">{{ $item['amount'] }}</strong></p>@endforeach</div></li>
                            @endforeach
                            <li class="is-total"><span>جمع هزینه سفر</span><div><strong dir="ltr">{{ number_format($costs['total']) }} {{ $costs['currency'] }}</strong></div></li>
                        </ol>
                    </section>
                </div>

                <div class="road-finance-connection">
                    <article><span>Trip Cost</span><strong dir="ltr">{{ number_format($costs['total']) }} {{ $costs['currency'] }}</strong></article>
                    <i aria-hidden="true">←</i>
                    <article><span>درآمد مشتری</span><strong dir="ltr">{{ number_format($costs['customer_revenue']) }} {{ $costs['currency'] }}</strong></article>
                    <i aria-hidden="true">←</i>
                    <article class="is-margin"><span>حاشیه ناخالص</span><strong dir="ltr">{{ number_format($costs['gross_margin']) }} {{ $costs['currency'] }}</strong></article>
                    <i aria-hidden="true">←</i>
                    <article class="is-finance"><span>اتصال به مالی</span><strong>پرونده مالی همان حمل</strong></article>
                </div>

                <ol class="road-cost-flow" aria-label="رابطه رویداد سفر با هزینه عملیاتی و پرونده مالی"><li>رویداد سفر</li><li>هزینه عملیاتی</li><li>هزینه سفر</li><li>Finance</li></ol>
            </div>
            <figcaption id="road-cost-caption">نمای نمونه هزینه سفر؛ جمع 3,000 USD از هزینه‌های همان Route ساخته شده و برای مقایسه با درآمد 4,250 USD به پرونده مالی همان حمل متصل می‌شود.</figcaption>
        </figure>

        <div class="road-cost-categories reveal" aria-label="دسته‌های آماده برای ثبت هزینه سفر">
            <strong>Cost Categories</strong>
            @foreach($costs['available_categories'] as $category)<span dir="ltr">{{ $category }}</span>@endforeach
        </div>
    </div>
</section>
