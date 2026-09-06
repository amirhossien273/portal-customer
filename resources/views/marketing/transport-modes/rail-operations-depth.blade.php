@php
    $railDemo = config('site_rail_demo');
@endphp

{{-- TODO: connect Wagon Allocation, independent wagon status and wagon event history to real rail operations data. --}}
{{-- TODO: connect Station Timeline and planned/actual rail events to dedicated rail station entities. --}}
{{-- TODO: connect Wagon/Bogie/Gauge Change events to real rail operations data. --}}

<section class="section rail-journey-section" id="rail-journey" aria-labelledby="rail-journey-title">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label">مسیر تخصصی پرونده ریلی</span>
            <h2 class="section-title" id="rail-journey-title">از تخصیص واگن تا آخرین ایستگاه؛ یک Journey نه‌مرحله‌ای</h2>
            <p class="section-sub">استعلام و نرخ، زمینه شروع پرونده‌اند؛ عمق عملیات ریلی از تخصیص واگن و حرکت بین ایستگاه‌ها تا ثبت رویدادهای مسیر شکل می‌گیرد.</p>
        </div>

        <p class="rail-entity-declaration reveal">
            یک <bdi dir="ltr">Rail Shipment</bdi> می‌تواند چند واگن داشته باشد؛ هر واگن وضعیت و تاریخچه رویداد مستقل خود را حفظ می‌کند و هم‌زمان روی مسیر مشترک مبدأ، ایستگاه‌های میانی و مقصد دیده می‌شود.
        </p>

        <ol class="rail-journey" aria-label="مراحل یک پرونده حمل ریلی">
            @foreach($railDemo['journey'] as $step)
                <li class="rail-journey-step is-{{ $step['scope'] }} reveal">
                    <span class="rail-journey-number">{{ $step['number'] }}</span>
                    <div>
                        <h3>{{ $step['title'] }}</h3>
                        <p>{{ $step['text'] }}</p>
                    </div>
                </li>
            @endforeach
        </ol>

        <div class="rail-entity-graph reveal" aria-label="رابطه موجودیت‌های پرونده حمل ریلی">
            <span><bdi dir="ltr">Rail Shipment</bdi><small>پرونده ریلی</small></span>
            <i aria-hidden="true">←</i>
            <span><bdi dir="ltr">Wagon</bdi><small>واگن‌های تخصیص‌یافته</small></span>
            <i aria-hidden="true">←</i>
            <span><bdi dir="ltr">Route</bdi><small>مسیر حرکت</small></span>
            <i aria-hidden="true">←</i>
            <span><bdi dir="ltr">Station</bdi><small>مبدأ، میانی و مقصد</small></span>
            <i aria-hidden="true">←</i>
            <span><bdi dir="ltr">Rail Event</bdi><small>حرکت، توقف یا تغییر</small></span>
        </div>
    </div>
</section>

<section class="section soft rail-wagons-section" id="rail-wagon-assignment" aria-labelledby="rail-wagon-title">
    <div class="container">
        <div class="rail-split-head reveal">
            <div>
                <span class="section-label">سناریوی نمونه ۰۱</span>
                <h2 class="section-title" id="rail-wagon-title">یک پرونده، چند واگن و وضعیت مستقل برای هر واگن</h2>
            </div>
            <p>واگن‌ها زیر یک پرونده عملیاتی قرار می‌گیرند، اما وضعیت و رویدادهای هرکدام جداگانه قابل تفکیک است.</p>
        </div>

        <figure class="rail-evidence rail-wagon-evidence reveal" data-rail-evidence="wagon-assignment" aria-labelledby="wagon-evidence-caption">
            <header class="rail-shipment-head">
                <div>
                    <span>نمونه نمای تخصیص واگن</span>
                    <h3>پرونده ریلی <bdi dir="ltr">#{{ $railDemo['shipment']['reference'] }}</bdi></h3>
                    <p>{{ $railDemo['shipment']['cargo'] }} · {{ $railDemo['shipment']['route'] }}</p>
                </div>
                <strong>{{ $railDemo['shipment']['wagon_count'] }} واگن</strong>
            </header>

            <div class="rail-wagon-grid">
                @foreach($railDemo['wagons'] as $index => $wagon)
                    <article class="rail-wagon-card is-{{ $wagon['tone'] }}">
                        <header>
                            <span>واگن {{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</span>
                            <strong>{{ $wagon['status'] }}</strong>
                        </header>
                        <h3><bdi dir="ltr">{{ $wagon['number'] }}</bdi></h3>
                        <dl>
                            <div><dt>نوع</dt><dd>{{ $wagon['type'] }}</dd></div>
                            <div><dt>ظرفیت</dt><dd><bdi dir="ltr">{{ $wagon['capacity'] }}</bdi></dd></div>
                            <div><dt>بهره‌بردار</dt><dd>{{ $wagon['operator'] }}</dd></div>
                        </dl>
                    </article>
                @endforeach
            </div>

            <div class="rail-wagon-relation" aria-label="رابطه پرونده ریلی با واگن‌ها و وضعیت مستقل آن‌ها">
                <span>یک پرونده ریلی</span><i aria-hidden="true">←</i><span>۴ واگن</span><i aria-hidden="true">←</i><span>وضعیت و رویداد مستقل</span>
            </div>

            <figcaption id="wagon-evidence-caption">
                تخصیص چند واگن به یک پرونده ریلی و مشاهده وضعیت مستقل هر واگن.
            </figcaption>
        </figure>
    </div>
</section>

<section class="section rail-delay-section" id="rail-station-timeline" aria-labelledby="rail-delay-title">
    <div class="container">
        <div class="rail-split-head reveal">
            <div>
                <span class="section-label">سناریوی نمونه ۰۲</span>
                <h2 class="section-title" id="rail-delay-title">وقتی مسیر طبق برنامه پیش نمی‌رود</h2>
            </div>
            <p>اختلاف زمان برنامه‌ریزی‌شده و زمان واقعی، به‌صورت یک رویداد تأخیر در خط زمانی همان ایستگاه دیده می‌شود.</p>
        </div>

        <div class="rail-delay-summary reveal" data-rail-delay-scenario>
            <article><span>ایستگاه</span><strong>{{ $railDemo['delay']['station'] }}</strong></article>
            <article><span>ورود برنامه‌ریزی‌شده</span><strong dir="ltr">{{ $railDemo['delay']['planned'] }}</strong></article>
            <article><span>ورود واقعی</span><strong dir="ltr">{{ $railDemo['delay']['actual'] }}</strong></article>
            <article class="is-delay"><span>میزان تأخیر</span><strong dir="ltr">{{ $railDemo['delay']['duration'] }}</strong><small>{{ $railDemo['delay']['event'] }}</small></article>
        </div>

        <figure class="rail-evidence rail-station-evidence reveal" data-rail-evidence="station-timeline" aria-labelledby="station-evidence-caption">
            <header class="rail-timeline-head">
                <div>
                    <span>نمونه خط زمانی ایستگاه‌ها</span>
                    <h3>مسیر <bdi dir="ltr">{{ $railDemo['shipment']['reference'] }}</bdi></h3>
                </div>
                <div class="rail-event-legend" aria-label="راهنمای نوع رویداد">
                    <span class="is-normal"><i></i>رویداد عادی</span>
                    <span class="is-delay"><i></i>تأخیر</span>
                    <span class="is-change"><i></i>تغییر واگن</span>
                </div>
            </header>

            <ol class="rail-station-timeline" aria-label="خط زمانی ایستگاه‌های مسیر ریلی">
                @foreach($railDemo['stations'] as $station)
                    <li class="rail-station is-{{ $station['tone'] }}">
                        <span class="rail-station-marker" aria-hidden="true"></span>
                        <div class="rail-station-card">
                            <header><span>{{ $station['role'] }}</span><h3>{{ $station['name'] }}</h3></header>
                            <ul>
                                @foreach($station['events'] as $event)
                                    <li class="is-{{ $event['state'] }}"><span>{{ $event['label'] }}</span><strong dir="ltr">{{ $event['value'] }}</strong></li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                @endforeach
            </ol>

            <figcaption id="station-evidence-caption">
                خط زمانی نمونه ایستگاه‌های مبدأ، میانی و مقصد همراه ورود، خروج، توقف، تأخیر و تغییر واگن.
            </figcaption>
        </figure>
    </div>
</section>

<section class="section soft rail-change-section" id="rail-wagon-change" aria-labelledby="rail-change-title">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label">سناریوی نمونه ۰۳</span>
            <h2 class="section-title" id="rail-change-title">تغییر واگن بدون حذف تاریخچه قبلی پرونده</h2>
            <p class="section-sub">واگن قبلی از خط زمانی حذف نمی‌شود؛ رویداد ایستگاه، علت تغییر، واگن جدید و ادامه مسیر باید به‌صورت یک زنجیره قابل‌ردیابی باقی بمانند.</p>
        </div>

        <ol class="rail-change-flow reveal" aria-label="تاریخچه نمونه تغییر واگن">
            @foreach($railDemo['wagon_change'] as $step)
                <li class="is-{{ $step['tone'] }}"><span>{{ $step['label'] }}</span><strong dir="ltr">{{ $step['value'] }}</strong></li>
            @endforeach
        </ol>

        <div class="rail-gauge-note reveal">
            <span class="rail-gauge-mark" aria-hidden="true"></span>
            <div>
                <h3>تغییر بوژی یا تغییر عرض خط به‌عنوان رویداد ریلی</h3>
                <p>در معماری این صفحه، <bdi dir="ltr">Bogie Change</bdi> و <bdi dir="ltr">Gauge Change</bdi> نوعی رویداد ایستگاهی‌اند که باید زمان، محل، واگن قبلی، واگن یا بوژی جدید و ادامه حرکت را به تاریخچه پرونده اضافه کنند.</p>
                <small>این ساختار اکنون پیش‌نمایش معماری است و اتصال آن به منطق واقعی محصول در مرحله بعد انجام می‌شود.</small>
            </div>
        </div>
    </div>
</section>
