<section class="section comparison-cluster" aria-labelledby="comparison-cluster-title">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label">Comparison Hub</span>
            <h2 class="section-title" id="comparison-cluster-title">مقایسه‌های دیگر نرم‌افزار حمل‌ونقل</h2>
            <p class="section-sub">برای تصمیم دقیق‌تر، صفحه‌های مرتبط را با همان چک‌لیست و سناریوی دمو بررسی کنید.</p>
        </div>
        <div class="comparison-cluster-grid">
            <?php $__currentLoopData = $comparisons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php ($isCurrent = request()->routeIs($item['route'])); ?>
                <a class="comparison-cluster-card reveal<?php echo e($isCurrent ? ' is-current' : ''); ?>" href="<?php echo e(route($item['route'])); ?>" <?php if($isCurrent): ?> aria-current="page" <?php endif; ?>>
                    <small><?php echo e($item['eyebrow']); ?></small>
                    <h3><?php echo e($item['title']); ?></h3>
                    <p><?php echo e($item['description']); ?></p>
                    <span><?php echo e($isCurrent ? 'صفحه فعلی' : 'مشاهده مقایسه'); ?> <b aria-hidden="true">←</b></span>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php /**PATH C:\project\sepand\portal-customer\resources\views/marketing/partials/comparison-cluster-links.blade.php ENDPATH**/ ?>