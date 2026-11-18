<?php
    $airDemo = config('site_air_demo');
    $segments = $airDemo['segments'];
    $transshipment = $airDemo['transshipment'];
?>





<section class="section air-flight-section" id="air-flight-segments" aria-labelledby="air-flight-title">
    <div class="container">
        <div class="air-split-head reveal">
            <div>
                <span class="section-label">نمای عملیاتی حمل هوایی 02 · پروازهای چندمرحله‌ای و ترانشیپمنت</span>
                <h2 class="section-title" id="air-flight-title">مدیریت مسیرهای چندمرحله‌ای در حمل هوایی</h2>
            </div>
            <p>در حمل هوایی، یک محموله ممکن است پیش از رسیدن به مقصد از یک فرودگاه ترانزیت عبور کند. مسیر به بخش‌های مستقل پرواز تقسیم می‌شود تا اطلاعات پرواز، زمان‌بندی و وضعیت هر بخش جداگانه دیده شود.</p>
        </div>

        <p class="air-entity-declaration reveal">هر پرونده حمل هوایی می‌تواند چند بخش پرواز (Flight Segment) داشته باشد و هر بخش دارای فرودگاه مبدأ، فرودگاه مقصد، شماره پرواز، ETD، ETA و وضعیت مستقل باشد.</p>

        <div class="air-status-legend reveal" aria-label="راهنمای وضعیت بخش‌های پرواز">
            <?php $__currentLoopData = $airDemo['status_labels']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <span class="air-status is-<?php echo e($key); ?>"><?php echo e($label); ?></span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <figure class="air-evidence air-flight-evidence reveal" data-air-evidence="flight-segment-timeline" aria-labelledby="air-flight-caption">
            <div class="air-flight-preview" role="img" aria-label="خط زمانی مسیر پرواز چندمرحله‌ای از شانگهای PVG به دبی DXB و تهران IKA همراه ترانشیپمنت و تأخیر در سپند">
                <header class="air-preview-header">
                    <div>
                        <span>پرونده حمل هوایی <bdi dir="ltr"><?php echo e($airDemo['shipment']['reference']); ?></bdi></span>
                        <h3>خط زمانی بخش‌های پرواز</h3>
                        <p><bdi dir="ltr">PVG → DXB → IKA</bdi> · ۲ بخش پرواز · ۱ ترانشیپمنت</p>
                    </div>
                    <span class="air-status is-transit"><?php echo e($airDemo['shipment']['status']); ?></span>
                </header>

                <ol class="air-segment-timeline" aria-label="بخش‌های پرواز مسیر چندمرحله‌ای محموله هوایی">
                    <?php $__currentLoopData = $segments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $segment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="air-segment is-<?php echo e($segment['status_key']); ?>">
                            <div class="air-segment-route">
                                <span>بخش پرواز <?php echo e($segment['number']); ?></span>
                                <div><strong dir="ltr"><?php echo e($segment['origin']['code']); ?></strong><small><?php echo e($segment['origin']['city']); ?></small></div>
                                <i aria-hidden="true">←</i>
                                <div><strong dir="ltr"><?php echo e($segment['destination']['code']); ?></strong><small><?php echo e($segment['destination']['city']); ?></small></div>
                            </div>
                            <div class="air-segment-card">
                                <header>
                                    <div><span>شماره پرواز</span><strong dir="ltr"><?php echo e($segment['flight']); ?></strong><small><?php echo e($segment['airline']); ?></small></div>
                                    <span class="air-status is-<?php echo e($segment['status_key']); ?>"><?php echo e($segment['status']); ?></span>
                                </header>
                                <dl>
                                    <div><dt>زمان حرکت (ETD)</dt><dd dir="ltr"><?php echo e($segment['departure_date']); ?> · <?php echo e($segment['planned_etd']); ?></dd></div>
                                    <div><dt>زمان رسیدن (ETA)</dt><dd dir="ltr"><?php echo e($segment['arrival_date']); ?> · <?php echo e($segment['planned_eta']); ?></dd></div>
                                </dl>
                                <?php if($segment['updated_etd']): ?>
                                    <aside class="air-delay-event" aria-label="رویداد تأخیر بخش پرواز <?php echo e($segment['number']); ?>">
                                        <span>رویداد تأخیر</span>
                                        <dl>
                                            <div><dt>زمان حرکت برنامه‌ریزی‌شده</dt><dd dir="ltr"><?php echo e($segment['departure_date']); ?> · <?php echo e($segment['planned_etd']); ?></dd></div>
                                            <div><dt>زمان حرکت به‌روزشده</dt><dd dir="ltr"><?php echo e($segment['departure_date']); ?> · <?php echo e($segment['updated_etd']); ?></dd></div>
                                            <div><dt>ETA به‌روزشده</dt><dd dir="ltr"><?php echo e($segment['arrival_date']); ?> · <?php echo e($segment['updated_eta']); ?></dd></div>
                                            <div class="is-delay"><dt>تأخیر</dt><dd dir="ltr"><?php echo e($segment['delay']); ?></dd></div>
                                        </dl>
                                    </aside>
                                <?php endif; ?>
                            </div>
                        </li>

                        <?php if($loop->first): ?>
                            <li class="air-transshipment-event">
                                <div class="air-hub-marker" aria-hidden="true"><span>DXB</span></div>
                                <article>
                                    <header><div><span>رویداد فرودگاه ترانزیت</span><h3>ترانشیپمنت · <?php echo e($transshipment['city']); ?></h3></div><span class="air-status is-connection"><?php echo e($transshipment['status']); ?></span></header>
                                    <dl>
                                        <div><dt>فرودگاه</dt><dd dir="ltr"><?php echo e($transshipment['airport']); ?></dd></div>
                                        <div><dt>پرواز ورودی</dt><dd dir="ltr"><?php echo e($transshipment['inbound_flight']); ?></dd></div>
                                        <div><dt>پرواز خروجی</dt><dd dir="ltr"><?php echo e($transshipment['outbound_flight']); ?></dd></div>
                                        <div><dt>زمان اتصال برنامه‌ریزی‌شده</dt><dd dir="ltr"><?php echo e($transshipment['planned_connection_time']); ?></dd></div>
                                        <div><dt>زمان اتصال به‌روزشده</dt><dd dir="ltr"><?php echo e($transshipment['updated_connection_time']); ?></dd></div>
                                    </dl>
                                </article>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ol>
            </div>
            <figcaption id="air-flight-caption">نمایش مسیر چندمرحله‌ای محموله از مبدأ تا مقصد؛ هر بخش پرواز زمان‌بندی و وضعیت مستقل دارد و ترانشیپمنت در DXB به‌عنوان یک رویداد مجزا نمایش داده می‌شود.</figcaption>
        </figure>

        <div class="air-flight-entity-graph reveal" aria-label="رابطه موجودیت‌های پرواز؛ ترتیب از راست به چپ است">
            <strong>مسیر پرواز</strong><ol class="air-entity-flow"><li>پرونده حمل هوایی</li><li>بخش پرواز</li><li>فرودگاه مبدأ / مقصد</li><li>شماره پرواز</li><li>ETD / ETA</li><li>وضعیت</li></ol>
        </div>
    </div>
</section>

<section class="section soft air-milestones-section" id="air-milestones" aria-labelledby="air-milestones-title">
    <div class="container">
        <div class="air-split-head reveal">
            <div>
                <span class="section-label">نقاط عطف فرودگاهی</span>
                <h2 class="section-title" id="air-milestones-title">رویدادهای پرونده حمل هوایی روی یک خط زمانی عملیاتی</h2>
            </div>
            <p>نقاط عطف، رویدادهای فرودگاه و پرواز را به ترتیب زمانی نشان می‌دهند. در صورت تأخیر، زمان برنامه‌ریزی‌شده حذف نمی‌شود و زمان به‌روزشده در کنار آن باقی می‌ماند.</p>
        </div>
        <ol class="air-milestone-timeline reveal" aria-label="خط زمانی رویدادهای فرودگاهی محموله هوایی">
            <?php $__currentLoopData = $airDemo['milestones']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $milestone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="is-<?php echo e($milestone['tone']); ?>">
                    <span class="air-milestone-dot" aria-hidden="true"></span>
                    <article>
                        <span><?php echo e($milestone['airport']); ?></span>
                        <h3><?php echo e($milestone['label']); ?></h3>
                        <time dir="ltr"><?php echo e($milestone['time']); ?></time>
                        <small><?php echo e($milestone['status']); ?></small>
                    </article>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ol>
    </div>
</section>
<?php /**PATH C:\project\sepand\portal-customer\resources\views/marketing/transport-modes/air-flight-journey.blade.php ENDPATH**/ ?>