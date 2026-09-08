<?php
    $railDemo = config('site_rail_demo');
?>





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
            <?php $__currentLoopData = $railDemo['journey']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="rail-journey-step is-<?php echo e($step['scope']); ?> reveal">
                    <span class="rail-journey-number"><?php echo e($step['number']); ?></span>
                    <div>
                        <h3><?php echo e($step['title']); ?></h3>
                        <p><?php echo e($step['text']); ?></p>
                    </div>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                    <h3>پرونده ریلی <bdi dir="ltr">#<?php echo e($railDemo['shipment']['reference']); ?></bdi></h3>
                    <p><?php echo e($railDemo['shipment']['cargo']); ?> · <?php echo e($railDemo['shipment']['route']); ?></p>
                </div>
                <strong><?php echo e($railDemo['shipment']['wagon_count']); ?> واگن</strong>
            </header>

            <div class="rail-wagon-grid">
                <?php $__currentLoopData = $railDemo['wagons']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $wagon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <article class="rail-wagon-card is-<?php echo e($wagon['tone']); ?>">
                        <header>
                            <span>واگن <?php echo e(str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT)); ?></span>
                            <strong><?php echo e($wagon['status']); ?></strong>
                        </header>
                        <h3><bdi dir="ltr"><?php echo e($wagon['number']); ?></bdi></h3>
                        <dl>
                            <div><dt>نوع</dt><dd><?php echo e($wagon['type']); ?></dd></div>
                            <div><dt>ظرفیت</dt><dd><bdi dir="ltr"><?php echo e($wagon['capacity']); ?></bdi></dd></div>
                            <div><dt>بهره‌بردار</dt><dd><?php echo e($wagon['operator']); ?></dd></div>
                        </dl>
                    </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
            <article><span>ایستگاه</span><strong><?php echo e($railDemo['delay']['station']); ?></strong></article>
            <article><span>ورود برنامه‌ریزی‌شده</span><strong dir="ltr"><?php echo e($railDemo['delay']['planned']); ?></strong></article>
            <article><span>ورود واقعی</span><strong dir="ltr"><?php echo e($railDemo['delay']['actual']); ?></strong></article>
            <article class="is-delay"><span>میزان تأخیر</span><strong dir="ltr"><?php echo e($railDemo['delay']['duration']); ?></strong><small><?php echo e($railDemo['delay']['event']); ?></small></article>
        </div>

        <figure class="rail-evidence rail-station-evidence reveal" data-rail-evidence="station-timeline" aria-labelledby="station-evidence-caption">
            <header class="rail-timeline-head">
                <div>
                    <span>نمونه خط زمانی ایستگاه‌ها</span>
                    <h3>مسیر <bdi dir="ltr"><?php echo e($railDemo['shipment']['reference']); ?></bdi></h3>
                </div>
                <div class="rail-event-legend" aria-label="راهنمای نوع رویداد">
                    <span class="is-normal"><i></i>رویداد عادی</span>
                    <span class="is-delay"><i></i>تأخیر</span>
                    <span class="is-change"><i></i>تغییر واگن</span>
                </div>
            </header>

            <ol class="rail-station-timeline" aria-label="خط زمانی ایستگاه‌های مسیر ریلی">
                <?php $__currentLoopData = $railDemo['stations']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $station): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="rail-station is-<?php echo e($station['tone']); ?>">
                        <span class="rail-station-marker" aria-hidden="true"></span>
                        <div class="rail-station-card">
                            <header><span><?php echo e($station['role']); ?></span><h3><?php echo e($station['name']); ?></h3></header>
                            <ul>
                                <?php $__currentLoopData = $station['events']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="is-<?php echo e($event['state']); ?>"><span><?php echo e($event['label']); ?></span><strong dir="ltr"><?php echo e($event['value']); ?></strong></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
            <?php $__currentLoopData = $railDemo['wagon_change']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="is-<?php echo e($step['tone']); ?>"><span><?php echo e($step['label']); ?></span><strong dir="ltr"><?php echo e($step['value']); ?></strong></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php /**PATH C:\project\sepand\portal-customer\resources\views/marketing/transport-modes/rail-operations-depth.blade.php ENDPATH**/ ?>