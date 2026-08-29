@php
    $roadDemo = config('site_road_demo');
    $shipment = $roadDemo['shipment'];
    $border = $roadDemo['border'];
@endphp

{{-- TODO: connect border journey to production road operations API --}}
{{-- TODO: connect border events to production road timeline --}}
{{-- TODO: connect vehicle change history to trip data --}}

<section class="section soft road-route-section" id="road-route-timeline" aria-labelledby="road-route-title">
    <div class="container">
        <div class="road-split-head reveal">
            <div>
                <span class="section-label">خط زمانی مسیر</span>
                <h2 class="section-title" id="road-route-title">مسیر قبل و بعد از مرز در یک خط زمانی پیوسته</h2>
            </div>
            <p>بارگیری در استانبول، توقف آنکارا، ورود به Gürbulak، عبور از Bazargan و ETA تهران روی همان سفر ثبت می‌شوند؛ مرز در این مسیر یک نقطه ساده نیست و خط زمانی عملیاتی مستقل دارد.</p>
        </div>

        <ol class="road-route-timeline reveal" aria-label="خط زمانی مسیر استانبول، آنکارا، گوربولاک، بازرگان و تهران">
            @foreach($roadDemo['route'] as $point)
                <li class="is-{{ $point['tone'] }}">
                    <span class="road-route-dot" aria-hidden="true"></span>
                    <article>
                        <span>{{ $point['role'] }}</span>
                        <h3 dir="ltr">{{ $point['place'] }}</h3>
                        <dl>@foreach($point['events'] as $event)<div><dt>{{ $event['label'] }}</dt><dd dir="ltr">{{ $event['time'] }}</dd></div>@endforeach</dl>
                    </article>
                </li>
            @endforeach
        </ol>
    </div>
</section>

<section class="section road-border-section" id="road-border-operations" aria-labelledby="road-border-title">
    <div class="container">
        <div class="road-split-head reveal">
            <div>
                <span class="section-label">نمای عملیاتی حمل زمینی 02</span>
                <h2 class="section-title" id="road-border-title">ورود، انتظار، کنترل و خروج از مرز؛ رویدادهای قابل سنجش</h2>
            </div>
            <p>هر رویداد مرزی با زمان و وضعیت مستقل ثبت می‌شود. زمان برنامه‌ریزی‌شده حذف نمی‌شود و زمان واقعی، مدت انتظار، دلیل تأخیر و ETA جدید در کنار آن باقی می‌مانند.</p>
        </div>

        <div class="road-status-legend reveal" aria-label="راهنمای وضعیت رویدادهای مرزی">
            @foreach($roadDemo['status_labels'] as $key => $label)
                <span class="road-status is-{{ $key }}">{{ $label }}</span>
            @endforeach
        </div>

        <figure class="road-evidence road-border-preview reveal" data-road-evidence="border-timeline" aria-labelledby="road-border-caption">
            <div role="img" aria-label="نمای Border Tracking و خط زمانی ورود، انتظار و عبور کامیون از مرز در حمل زمینی سپند">
                <header class="road-preview-header">
                    <div><span>عملیات مرزی · <bdi dir="ltr">{{ $shipment['reference'] }}</bdi></span><h3 dir="ltr">{{ $border['name'] }}</h3><p>ورود کامیون تا ادامه مسیر در کشور مقصد</p></div>
                    <span class="road-status is-crossed">{{ $border['queue_status'] }}</span>
                </header>

                <div class="road-border-metrics">
                    <article><span>ورود برنامه‌ریزی‌شده</span><strong dir="ltr">{{ $border['planned_arrival'] }}</strong></article>
                    <article><span>ورود واقعی</span><strong dir="ltr">{{ $border['actual_arrival'] }}</strong></article>
                    <article class="is-emphasis"><span>مدت حضور در مرز</span><strong dir="ltr">{{ $border['border_dwell_time'] }}</strong><small>انتظار ثبت‌شده {{ $border['waiting_time'] }}</small></article>
                    <article><span>وضعیت گمرک</span><strong>{{ $border['customs_status'] }}</strong></article>
                </div>

                <ol class="road-border-timeline" aria-label="رویدادهای مرزی از ورود تا ادامه سفر">
                    @foreach($roadDemo['border_events'] as $event)
                        <li class="is-{{ $event['tone'] }}">
                            <span class="road-border-dot" aria-hidden="true"></span>
                            <article><span>{{ $event['status'] }}</span><h3>{{ $event['label'] }}</h3><time dir="ltr">{{ $event['value'] }}</time><small>{{ $event['detail'] }}</small></article>
                        </li>
                    @endforeach
                </ol>

                <aside class="road-delay-panel" aria-labelledby="road-delay-title">
                    <header><div><span>رویداد استثنا</span><h3 id="road-delay-title">تأخیر مرزی و اثر آن بر برنامه تحویل</h3></div><span class="road-status is-delayed">{{ $border['delay'] }}</span></header>
                    <dl>
                        <div><dt>خروج برنامه‌ریزی‌شده</dt><dd dir="ltr">{{ $border['planned_exit'] }}</dd></div>
                        <div><dt>خروج واقعی</dt><dd dir="ltr">{{ $border['actual_exit'] }}</dd></div>
                        <div><dt>دلیل</dt><dd dir="ltr">{{ $border['delay_reason'] }}</dd></div>
                        <div><dt>ETA اولیه</dt><dd dir="ltr">{{ $border['original_eta'] }}</dd></div>
                        <div class="is-updated"><dt>ETA به‌روزشده</dt><dd dir="ltr">{{ $border['updated_eta'] }}</dd></div>
                    </dl>
                    <ol class="road-delay-flow" aria-label="اثر تأخیر مرزی روی زمان رسیدن و برنامه تحویل"><li>تأخیر مرزی</li><li>ETA به‌روزشده</li><li>برنامه تحویل</li></ol>
                </aside>
            </div>
            <figcaption id="road-border-caption">نمای خط زمانی مرزی با داده‌های آزمایشی؛ ورود واقعی 06:30، خروج 14:45 و تأخیر 3 ساعت و 15 دقیقه‌ای، ETA تهران را از 19:15 به 22:30 تغییر داده است.</figcaption>
        </figure>

        <div class="road-exception-layer reveal" aria-labelledby="road-exceptions-title">
            <div><span class="section-label">رویدادهای غیرعادی سفر</span><h3 id="road-exceptions-title">وضعیت‌های غیرعادی از رویدادهای عادی مسیر جدا دیده می‌شوند</h3><p>تأخیر مرزی، تغییر راننده یا خودرو، توقف به دلیل اسناد، بازرسی گمرکی، تغییر مسیر و تأخیر تحویل در تاریخچه رویدادها باقی می‌مانند.</p></div>
            <div class="road-exception-grid">@foreach($roadDemo['exceptions'] as $exception)<article class="is-{{ $exception['tone'] }}"><strong>{{ $exception['title'] }}</strong><span dir="auto">{{ $exception['detail'] }}</span></article>@endforeach</div>
        </div>

        <div class="road-change-grid">
            <article class="road-change-card reveal">
                <header><span>تاریخچه تغییر راننده</span><h3>تغییر راننده بدون حذف سابقه قبلی</h3></header>
                <ol>@foreach($roadDemo['driver_change'] as $change)<li class="is-{{ $change['tone'] }}"><span>{{ $change['label'] }}</span><strong dir="auto">{{ $change['value'] }}</strong></li>@endforeach</ol>
            </article>
            <article class="road-change-card reveal">
                <header><span>تاریخچه تغییر خودرو</span><h3>خودروی قبلی و جایگزین در همان سفر قابل تفکیک هستند</h3></header>
                <ol>@foreach($roadDemo['vehicle_change'] as $change)<li class="is-{{ $change['tone'] }}"><span>{{ $change['label'] }}</span><strong dir="auto">{{ $change['value'] }}</strong></li>@endforeach</ol>
            </article>
        </div>
    </div>
</section>
