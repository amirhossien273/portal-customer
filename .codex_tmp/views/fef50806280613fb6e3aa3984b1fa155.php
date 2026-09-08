<?php
    $roadDemo = config('site_road_demo');
    $costs = $roadDemo['costs'];
?>



<section class="section road-cost-section" id="road-trip-costs" aria-labelledby="road-cost-title">
    <div class="container">
        <div class="road-split-head reveal">
            <div>
                <span class="section-label">نمای عملیاتی حمل زمینی 04</span>
                <h2 class="section-title" id="road-cost-title">هزینه‌های واقعی سفر و اتصال کوتاه عملیات به مالی</h2>
            </div>
            <p>هزینه راننده، سوخت، عوارض، مرز و انتظار به سفر مربوط متصل می‌شوند و جمع آن‌ها در ادامه وارد پرونده مالی همان حمل می‌شود؛ این بخش فقط اتصال کوتاه عملیات به مالی را نشان می‌دهد.</p>
        </div>

        <figure class="road-evidence road-cost-preview reveal" data-road-evidence="trip-cost-flow" aria-labelledby="road-cost-caption">
            <div role="img" aria-label="نمای هزینه‌های سفر و اتصال Trip Cost به مالی در سپند">
                <header class="road-preview-header">
                    <div><span>هزینه سفر</span><h3>هزینه‌های سفر <bdi dir="ltr"><?php echo e($roadDemo['shipment']['reference']); ?></bdi></h3><p>رویداد مسیر ← هزینه عملیاتی ← هزینه سفر ← مالی</p></div>
                    <span class="road-status is-finance">ثبت آزمایشی هزینه</span>
                </header>

                <div class="road-cost-layout">
                    <section class="road-cost-table-wrap" aria-labelledby="road-cost-table-title">
                        <h3 id="road-cost-table-title">ریز هزینه‌های همان سفر</h3>
                        <div class="road-cost-table" role="table" aria-label="جدول هزینه‌های سفر زمینی">
                            <?php $__currentLoopData = $costs['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div role="row"><span role="cell"><?php echo e($item['label']); ?></span><strong role="cell" dir="ltr"><?php echo e(number_format($item['amount'])); ?> <?php echo e($costs['currency']); ?></strong></div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <div class="is-total" role="row"><span role="cell">جمع هزینه سفر</span><strong role="cell" dir="ltr"><?php echo e(number_format($costs['total'])); ?> <?php echo e($costs['currency']); ?></strong></div>
                        </div>
                    </section>

                    <section class="road-cost-route-wrap" aria-labelledby="road-cost-route-title">
                        <h3 id="road-cost-route-title">رویداد مسیر چگونه هزینه می‌سازد؟</h3>
                        <ol class="road-cost-route" aria-label="ارتباط هزینه‌های سفر با نقاط مسیر">
                            <?php $__currentLoopData = $roadDemo['cost_route']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><span dir="ltr"><?php echo e($point['place']); ?></span><div><?php $__currentLoopData = $point['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><p><b><?php echo e($item['label']); ?></b><strong dir="ltr"><?php echo e($item['amount']); ?></strong></p><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <li class="is-total"><span>جمع هزینه سفر</span><div><strong dir="ltr"><?php echo e(number_format($costs['total'])); ?> <?php echo e($costs['currency']); ?></strong></div></li>
                        </ol>
                    </section>
                </div>

                <div class="road-finance-connection">
                    <article><span>هزینه سفر</span><strong dir="ltr"><?php echo e(number_format($costs['total'])); ?> <?php echo e($costs['currency']); ?></strong></article>
                    <i aria-hidden="true">←</i>
                    <article><span>درآمد مشتری</span><strong dir="ltr"><?php echo e(number_format($costs['customer_revenue'])); ?> <?php echo e($costs['currency']); ?></strong></article>
                    <i aria-hidden="true">←</i>
                    <article class="is-margin"><span>حاشیه سود ناخالص</span><strong dir="ltr"><?php echo e(number_format($costs['gross_margin'])); ?> <?php echo e($costs['currency']); ?></strong></article>
                    <i aria-hidden="true">←</i>
                    <article class="is-finance"><span>اتصال به مالی</span><strong>پرونده مالی همان حمل</strong></article>
                </div>

                <ol class="road-cost-flow" aria-label="رابطه رویداد سفر با هزینه عملیاتی و پرونده مالی"><li>رویداد سفر</li><li>هزینه عملیاتی</li><li>هزینه سفر</li><li>مالی</li></ol>
            </div>
            <figcaption id="road-cost-caption">در این نمای Trip Cost، جمع 3,000 USD از هزینه‌های همان مسیر ساخته شده و برای مقایسه با درآمد 4,250 USD به پرونده مالی همان حمل متصل می‌شود.</figcaption>
        </figure>

        <div class="road-cost-categories reveal" aria-label="دسته‌های آماده برای ثبت هزینه سفر">
            <strong>دسته‌بندی هزینه‌های سفر</strong>
            <?php $__currentLoopData = $costs['available_categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><span><?php echo e($category); ?></span><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php /**PATH C:\project\sepand\portal-customer\resources\views/marketing/transport-modes/road-trip-costs.blade.php ENDPATH**/ ?>