<?php if($relatedContentPages !== []): ?>
<section class="section" aria-labelledby="related-content-pages-title">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label">راهنماها و راهکارهای مرتبط</span>
            <h2 class="section-title" id="related-content-pages-title">از این ماژول در تصمیم و سناریوی درست استفاده کنید</h2>
            <p class="section-sub">هر لینک یک نیت مستقل دارد: راهنمای انتخاب برای مقایسه گزینه‌ها و صفحه راهکار برای اجرای یک فرایند بین‌ماژولی.</p>
        </div>
        <div class="crm-audience-grid">
            <?php $__currentLoopData = $relatedContentPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relatedPage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="crm-audience reveal">
                    <span class="section-label"><?php echo e($relatedPage['group'] === 'guide' ? 'راهنمای انتخاب' : 'راهکار تخصصی'); ?></span>
                    <h3><?php echo e($relatedPage['title']); ?></h3>
                    <p><?php echo e($relatedPage['description']); ?></p>
                    <a href="<?php echo e(route($relatedPage['route'], $relatedPage['parameters'] ?? [])); ?>"><?php echo e($relatedPage['anchor'] ?? $relatedPage['title']); ?> <span aria-hidden="true">←</span></a>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>
<?php /**PATH C:\project\sepand\portal-customer\resources\views/marketing/partials/related-content-pages.blade.php ENDPATH**/ ?>