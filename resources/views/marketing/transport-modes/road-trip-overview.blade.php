@php
    $roadDemo = config('site_road_demo');
    $shipment = $roadDemo['shipment'];
@endphp

{{-- TODO: connect road trip overview to production shipment API --}}
{{-- TODO: connect vehicle and driver assignment to production operations data --}}

<section class="section road-overview-section" id="road-trip-overview" aria-labelledby="road-overview-title">
    <div class="container">
        <div class="road-split-head reveal">
            <div>
                <span class="section-label">سناریوی عملیاتی حمل زمینی</span>
                <h2 class="section-title" id="road-overview-title">از استانبول تا تهران؛ یک پرونده، یک سفر و یک تاریخچه عملیاتی</h2>
            </div>
            <p>پرونده نمونه <bdi dir="ltr">{{ $shipment['reference'] }}</bdi> نشان می‌دهد خودرو، راننده، مسیر، مرز، تحویل و هزینه‌های همان سفر چگونه به هم متصل می‌شوند. داده‌ها آزمایشی و غیرحساس‌اند.</p>
        </div>

        <p class="road-entity-declaration reveal">هر سفر زمینی به یک خودرو و راننده متصل می‌شود و رویدادهای مسیر و مرز تا زمان تحویل در خط زمانی همان پرونده باقی می‌مانند. در Road Freight Operations، مدیریت کامیون (Truck Management)، مدیریت راننده (Driver Management)، رهگیری مرز (Border Tracking)، Proof of Delivery و Trip Cost Management در سطح همان سفر به هم مرتبط‌اند.</p>

        <figure class="road-evidence road-overview-preview reveal" data-road-preview="trip-overview" aria-labelledby="road-overview-caption">
            <div role="img" aria-label="نمای پرونده حمل زمینی RD-2026-0148 از استانبول تا تهران از مسیر مرزی گوربولاک و بازرگان">
                <header class="road-preview-header">
                    <div>
                        <span>پرونده حمل زمینی</span>
                        <h3><bdi dir="ltr">{{ $shipment['reference'] }}</bdi></h3>
                        <p><bdi dir="ltr">Istanbul → Gürbulak → Bazargan → Tehran</bdi></p>
                    </div>
                    <span class="road-status is-{{ $shipment['status_tone'] }}">{{ $shipment['status'] }}</span>
                </header>

                <ol class="road-route-line" aria-label="مسیر نمونه سفر زمینی از استانبول به تهران">
                    <li><span>مبدأ</span><strong dir="ltr">{{ $shipment['origin']['city'] }}</strong><small>{{ $shipment['origin']['country'] }}</small></li>
                    <li class="is-border"><span>مرز خروجی</span><strong dir="ltr">{{ $shipment['border']['outbound'] }}</strong><small>Turkey</small></li>
                    <li class="is-border"><span>مرز ورودی</span><strong dir="ltr">{{ $shipment['border']['inbound'] }}</strong><small>Iran</small></li>
                    <li><span>مقصد</span><strong dir="ltr">{{ $shipment['destination']['city'] }}</strong><small>{{ $shipment['destination']['country'] }}</small></li>
                </ol>

                <div class="road-overview-grid">
                    <section><span>محموله</span><dl><div><dt>نوع کالا</dt><dd dir="ltr">{{ $shipment['cargo'] }}</dd></div><div><dt>تعداد</dt><dd dir="ltr">{{ $shipment['quantity'] }}</dd></div><div><dt>وزن ناخالص</dt><dd dir="ltr">{{ $shipment['gross_weight'] }}</dd></div></dl></section>
                    <section><span>برنامه سفر</span><dl><div><dt>خودروی موردنیاز</dt><dd dir="ltr">{{ $shipment['required_vehicle'] }}</dd></div><div><dt>بارگیری برنامه‌ریزی‌شده</dt><dd dir="ltr">{{ $shipment['planned_pickup'] }}</dd></div><div><dt>وضعیت سفر</dt><dd>{{ $shipment['status'] }}</dd></div></dl></section>
                </div>
            </div>
            <figcaption id="road-overview-caption">نمای نمونه یک Road Shipment مرزی؛ اطلاعات محموله و Route، مقدمه اجرای سفر هستند و تمرکز عملیاتی از تخصیص خودرو و راننده آغاز می‌شود.</figcaption>
        </figure>

        <div class="road-entity-graphs reveal" aria-label="ساختار موجودیت‌های سفر زمینی؛ ترتیب روابط از راست به چپ است">
            <article><strong>Trip Structure</strong><ol class="road-entity-flow"><li>Road Shipment</li><li>Trip</li><li>Vehicle</li><li>Driver</li><li>Route</li></ol></article>
            <article><strong>Border Structure</strong><ol class="road-entity-flow"><li>Trip</li><li>Border</li><li>Border Event</li><li>Waiting</li><li>Clearance</li><li>Border Exit</li></ol></article>
            <article><strong>Delivery Structure</strong><ol class="road-entity-flow"><li>Trip</li><li>Destination</li><li>Delivery</li><li>POD</li></ol></article>
            <article><strong>Cost Structure</strong><ol class="road-entity-flow"><li>Trip</li><li>Trip Costs</li><li>Finance</li></ol></article>
        </div>
    </div>
</section>

<section class="section soft road-journey-section" id="road-border-journey" aria-labelledby="road-journey-title">
    <div class="container">
        <div class="road-split-head reveal">
            <div>
                <span class="section-label">Border Journey · ۹ مرحله</span>
                <h2 class="section-title" id="road-journey-title">جریان واقعی سفر زمینی از تخصیص کامیون تا هزینه نهایی</h2>
            </div>
            <p>این Journey چرخه عمومی CRM، Pricing و Booking را تکرار نمی‌کند. پرونده اولیه فقط نقطه شروع است و مسیر اصلی از تخصیص کامیون و راننده تا مرز، POD و هزینه سفر ادامه دارد.</p>
        </div>

        <ol class="road-journey" aria-label="جریان نه مرحله‌ای اجرای سفر حمل زمینی">
            @foreach($roadDemo['journey'] as $step)
                <li class="road-journey-step is-{{ $step['scope'] }} reveal">
                    <span>{{ $step['number'] }}</span>
                    <article><h3>{{ $step['title'] }}</h3><p>{{ $step['text'] }}</p></article>
                </li>
            @endforeach
        </ol>
    </div>
</section>

<section class="section road-assignment-section" id="road-vehicle-driver" aria-labelledby="road-assignment-title">
    <div class="container">
        <div class="road-split-head reveal">
            <div>
                <span class="section-label">نمای عملیاتی حمل زمینی 01</span>
                <h2 class="section-title" id="road-assignment-title">تخصیص کامیون و راننده به همان Trip</h2>
            </div>
            <p>خودرو و راننده دو Feature جدا نیستند؛ هر دو با وضعیت و مشخصات مستقل به سفر <bdi dir="ltr">{{ $shipment['reference'] }}</bdi> متصل‌اند و تغییرات بعدی آن‌ها در تاریخچه سفر باقی می‌ماند.</p>
        </div>

        <figure class="road-evidence road-assignment-preview reveal" data-road-evidence="vehicle-driver-assignment" aria-labelledby="road-assignment-caption">
            <div role="img" aria-label="نمای تخصیص کامیون و راننده در پرونده حمل زمینی سپند">
                <header class="road-preview-header">
                    <div><span>Trip Assignment</span><h3><bdi dir="ltr">{{ $shipment['reference'] }}</bdi></h3><p>کامیون و راننده تخصیص‌یافته</p></div>
                    <span class="road-status is-assigned">تخصیص تکمیل‌شده</span>
                </header>

                <div class="road-assignment-grid">
                    <article class="road-vehicle-card">
                        <header><span aria-hidden="true">TRK</span><div><small>خودرو تخصیص‌یافته</small><h3 dir="ltr">{{ $roadDemo['vehicle']['tractor_plate'] }}</h3></div><span class="road-status is-assigned">{{ $roadDemo['vehicle']['status'] }}</span></header>
                        <dl>
                            <div><dt>پلاک کشنده</dt><dd dir="ltr">{{ $roadDemo['vehicle']['tractor_plate'] }}</dd></div>
                            <div><dt>پلاک تریلر</dt><dd dir="ltr">{{ $roadDemo['vehicle']['trailer_plate'] }}</dd></div>
                            <div><dt>نوع خودرو</dt><dd dir="ltr">{{ $roadDemo['vehicle']['type'] }}</dd></div>
                            <div><dt>ظرفیت</dt><dd dir="ltr">{{ $roadDemo['vehicle']['capacity'] }}</dd></div>
                            <div><dt>نوع ناوگان</dt><dd>{{ $roadDemo['vehicle']['fleet_type'] }}</dd></div>
                            <div><dt>وضعیت خودرو</dt><dd>{{ $roadDemo['vehicle']['status'] }}</dd></div>
                        </dl>
                    </article>

                    <article class="road-driver-card">
                        <header><span class="road-driver-avatar" aria-hidden="true">MK</span><div><small>راننده</small><h3 dir="ltr">{{ $roadDemo['driver']['name'] }}</h3></div><span class="road-status is-transit">{{ $roadDemo['driver']['status'] }}</span></header>
                        <dl>
                            <div><dt>شماره تماس نمونه</dt><dd dir="ltr">{{ $roadDemo['driver']['mobile'] }}</dd></div>
                            <div><dt>شماره مدرک راننده</dt><dd dir="ltr">{{ $roadDemo['driver']['driver_id'] }}</dd></div>
                            <div><dt>گواهینامه</dt><dd dir="ltr">{{ $roadDemo['driver']['license'] }}</dd></div>
                            <div><dt>گذرنامه</dt><dd dir="ltr">{{ $roadDemo['driver']['passport'] }}</dd></div>
                            <div><dt>خودروی تخصیص‌یافته</dt><dd dir="ltr">{{ $roadDemo['driver']['assigned_vehicle'] }}</dd></div>
                            <div><dt>وضعیت راننده</dt><dd>{{ $roadDemo['driver']['status'] }}</dd></div>
                        </dl>
                    </article>
                </div>

                <ol class="road-assignment-flow" aria-label="رابطه پرونده حمل زمینی با خودرو، راننده و مسیر">
                    <li>پرونده حمل زمینی</li><li>خودرو</li><li>راننده</li><li>مسیر</li><li>مرز</li>
                </ol>
            </div>
            <figcaption id="road-assignment-caption">تخصیص کامیون و راننده با داده‌های نمونه و غیرحساس؛ پلاک‌ها، مدارک و شماره تماس فقط برای نمایش ساختار رابط استفاده شده‌اند.</figcaption>
        </figure>
    </div>
</section>
