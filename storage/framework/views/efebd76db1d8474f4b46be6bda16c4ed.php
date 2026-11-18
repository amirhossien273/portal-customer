<?php
    $roadDemo = config('site_road_demo');
    $shipment = $roadDemo['shipment'];
    $border = $roadDemo['border'];
?>





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
            <?php $__currentLoopData = $roadDemo['route']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="is-<?php echo e($point['tone']); ?>">
                    <span class="road-route-dot" aria-hidden="true"></span>
                    <article>
                        <span><?php echo e($point['role']); ?></span>
                        <h3 dir="ltr"><?php echo e($point['place']); ?></h3>
                        <dl><?php $__currentLoopData = $point['events']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><div><dt><?php echo e($event['label']); ?></dt><dd dir="ltr"><?php echo e($event['time']); ?></dd></div><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></dl>
                    </article>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
            <?php $__currentLoopData = $roadDemo['status_labels']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <span class="road-status is-<?php echo e($key); ?>"><?php echo e($label); ?></span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <figure class="road-evidence road-border-preview reveal" data-road-evidence="border-timeline" aria-labelledby="road-border-caption">
            <div role="img" aria-label="نمای Border Tracking و خط زمانی ورود، انتظار و عبور کامیون از مرز در حمل زمینی سپند">
                <header class="road-preview-header">
                    <div><span>عملیات مرزی · <bdi dir="ltr"><?php echo e($shipment['reference']); ?></bdi></span><h3 dir="ltr"><?php echo e($border['name']); ?></h3><p>ورود کامیون تا ادامه مسیر در کشور مقصد</p></div>
                    <span class="road-status is-crossed"><?php echo e($border['queue_status']); ?></span>
                </header>

                <div class="road-border-metrics">
                    <article><span>ورود برنامه‌ریزی‌شده</span><strong dir="ltr"><?php echo e($border['planned_arrival']); ?></strong></article>
                    <article><span>ورود واقعی</span><strong dir="ltr"><?php echo e($border['actual_arrival']); ?></strong></article>
                    <article class="is-emphasis"><span>مدت حضور در مرز</span><strong dir="ltr"><?php echo e($border['border_dwell_time']); ?></strong><small>انتظار ثبت‌شده <?php echo e($border['waiting_time']); ?></small></article>
                    <article><span>وضعیت گمرک</span><strong><?php echo e($border['customs_status']); ?></strong></article>
                </div>

                <ol class="road-border-timeline" aria-label="رویدادهای مرزی از ورود تا ادامه سفر">
                    <?php $__currentLoopData = $roadDemo['border_events']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="is-<?php echo e($event['tone']); ?>">
                            <span class="road-border-dot" aria-hidden="true"></span>
                            <article><span><?php echo e($event['status']); ?></span><h3><?php echo e($event['label']); ?></h3><time dir="ltr"><?php echo e($event['value']); ?></time><small><?php echo e($event['detail']); ?></small></article>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ol>

                <aside class="road-delay-panel" aria-labelledby="road-delay-title">
                    <header><div><span>رویداد استثنا</span><h3 id="road-delay-title">تأخیر مرزی و اثر آن بر برنامه تحویل</h3></div><span class="road-status is-delayed"><?php echo e($border['delay']); ?></span></header>
                    <dl>
                        <div><dt>خروج برنامه‌ریزی‌شده</dt><dd dir="ltr"><?php echo e($border['planned_exit']); ?></dd></div>
                        <div><dt>خروج واقعی</dt><dd dir="ltr"><?php echo e($border['actual_exit']); ?></dd></div>
                        <div><dt>دلیل</dt><dd dir="ltr"><?php echo e($border['delay_reason']); ?></dd></div>
                        <div><dt>ETA اولیه</dt><dd dir="ltr"><?php echo e($border['original_eta']); ?></dd></div>
                        <div class="is-updated"><dt>ETA به‌روزشده</dt><dd dir="ltr"><?php echo e($border['updated_eta']); ?></dd></div>
                    </dl>
                    <ol class="road-delay-flow" aria-label="اثر تأخیر مرزی روی زمان رسیدن و برنامه تحویل"><li>تأخیر مرزی</li><li>ETA به‌روزشده</li><li>برنامه تحویل</li></ol>
                </aside>
            </div>
            <figcaption id="road-border-caption">نمای خط زمانی مرزی با داده‌های آزمایشی؛ ورود واقعی 06:30، خروج 14:45 و تأخیر 3 ساعت و 15 دقیقه‌ای، ETA تهران را از 19:15 به 22:30 تغییر داده است.</figcaption>
        </figure>

        <div class="road-exception-layer reveal" aria-labelledby="road-exceptions-title">
            <div><span class="section-label">رویدادهای غیرعادی سفر</span><h3 id="road-exceptions-title">وضعیت‌های غیرعادی از رویدادهای عادی مسیر جدا دیده می‌شوند</h3><p>تأخیر مرزی، تغییر راننده یا خودرو، توقف به دلیل اسناد، بازرسی گمرکی، تغییر مسیر و تأخیر تحویل در تاریخچه رویدادها باقی می‌مانند.</p></div>
            <div class="road-exception-grid"><?php $__currentLoopData = $roadDemo['exceptions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exception): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><article class="is-<?php echo e($exception['tone']); ?>"><strong><?php echo e($exception['title']); ?></strong><span dir="auto"><?php echo e($exception['detail']); ?></span></article><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div>
        </div>

        <div class="road-change-grid">
            <article class="road-change-card reveal">
                <header><span>تاریخچه تغییر راننده</span><h3>تغییر راننده بدون حذف سابقه قبلی</h3></header>
                <ol><?php $__currentLoopData = $roadDemo['driver_change']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $change): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li class="is-<?php echo e($change['tone']); ?>"><span><?php echo e($change['label']); ?></span><strong dir="auto"><?php echo e($change['value']); ?></strong></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ol>
            </article>
            <article class="road-change-card reveal">
                <header><span>تاریخچه تغییر خودرو</span><h3>خودروی قبلی و جایگزین در همان سفر قابل تفکیک هستند</h3></header>
                <ol><?php $__currentLoopData = $roadDemo['vehicle_change']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $change): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li class="is-<?php echo e($change['tone']); ?>"><span><?php echo e($change['label']); ?></span><strong dir="auto"><?php echo e($change['value']); ?></strong></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ol>
            </article>
        </div>
    </div>
</section>
<?php /**PATH C:\project\sepand\portal-customer\resources\views/marketing/transport-modes/road-border-journey.blade.php ENDPATH**/ ?>