<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['section']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['section']); ?>
<?php foreach (array_filter((['section']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<section
    class="product-evidence<?php echo e(! empty($section['reverse']) ? ' is-reverse' : ''); ?><?php echo e(! empty($section['featured']) ? ' is-featured' : ''); ?>"
    id="<?php echo e($section['id']); ?>"
    aria-labelledby="<?php echo e($section['id']); ?>-title"
>
    <div class="container">
        <div class="product-evidence-grid">
            <header class="product-evidence-heading reveal">
                <span class="product-evidence-eyebrow"><?php echo e($section['eyebrow']); ?></span>
                <h2 id="<?php echo e($section['id']); ?>-title"><?php echo e($section['title']); ?></h2>
                <?php if(! empty($section['lead'])): ?>
                    <p><?php echo e($section['lead']); ?></p>
                <?php endif; ?>
            </header>

            <div class="product-evidence-media reveal" aria-label="شواهد واقعی بخش <?php echo e($section['title']); ?>">
                <?php if(! empty($section['images'])): ?>
                    <div
                        class="product-evidence-gallery"
                        data-evidence-gallery
                        role="region"
                        aria-roledescription="carousel"
                        aria-label="تصاویر واقعی <?php echo e($section['title']); ?> در سپند"
                    >
                        <div class="product-evidence-viewport">
                            <?php $__currentLoopData = $section['images']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <figure
                                    class="product-evidence-slide<?php echo e($loop->first ? ' is-active' : ''); ?>"
                                    data-evidence-slide
                                    data-caption="<?php echo e($image['caption']); ?>"
                                    aria-hidden="<?php echo e($loop->first ? 'false' : 'true'); ?>"
                                >
                                    <button
                                        class="product-screenshot-button"
                                        type="button"
                                        data-product-lightbox-open
                                        data-image-src="<?php echo e(asset('assets/images/marketing/'.$image['path'])); ?>"
                                        data-image-alt="<?php echo e($image['alt']); ?>"
                                        data-image-caption="<?php echo e($image['caption']); ?>"
                                        aria-label="نمایش بزرگ‌تر: <?php echo e($image['alt']); ?>"
                                    >
                                        <img
                                            src="<?php echo e(asset('assets/images/marketing/'.$image['path'])); ?>"
                                            alt="<?php echo e($image['alt']); ?>"
                                            width="<?php echo e($image['width']); ?>"
                                            height="<?php echo e($image['height']); ?>"
                                            loading="lazy"
                                            decoding="async"
                                        >
                                        <span class="product-screenshot-zoom" aria-hidden="true">
                                            <svg viewBox="0 0 24 24" fill="none"><circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="1.7"/><path d="m20 20-4-4M8 11h6M11 8v6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
                                            بزرگ‌نمایی
                                        </span>
                                    </button>
                                </figure>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="product-evidence-gallery-footer">
                            <span class="product-real-badge">تصویر واقعی نرم‌افزار سپند</span>
                            <p data-evidence-caption aria-live="polite"><?php echo e($section['images'][0]['caption']); ?></p>
                            <?php if(count($section['images']) > 1): ?>
                                <div class="product-gallery-controls">
                                    <button type="button" data-evidence-previous aria-label="تصویر قبلی <?php echo e($section['title']); ?>">
                                        <svg viewBox="0 0 24 24" fill="none"><path d="m9 5 7 7-7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    </button>
                                    <div class="product-gallery-dots" aria-label="انتخاب تصویر <?php echo e($section['title']); ?>">
                                        <?php $__currentLoopData = $section['images']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <button
                                                type="button"
                                                class="<?php echo e($loop->first ? 'is-active' : ''); ?>"
                                                data-evidence-dot="<?php echo e($loop->index); ?>"
                                                aria-label="نمایش تصویر <?php echo e($loop->iteration); ?> از <?php echo e($loop->count); ?>"
                                                aria-current="<?php echo e($loop->first ? 'true' : 'false'); ?>"
                                            ></button>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <button type="button" data-evidence-next aria-label="تصویر بعدی <?php echo e($section['title']); ?>">
                                        <svg viewBox="0 0 24 24" fill="none"><path d="m15 5-7 7 7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    </button>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if(! empty($section['missing_evidence'])): ?>
                        <aside class="product-missing-evidence" role="note" aria-label="تصاویر تکمیلی موردنیاز برای <?php echo e($section['title']); ?>">
                            <strong>Evidence تصویری تکمیلی موردنیاز</strong>
                            <ul>
                                <?php $__currentLoopData = $section['missing_evidence']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $missing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <span><?php echo e($missing['label']); ?></span>
                                        <code dir="ltr"><?php echo e($missing['file']); ?></code>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            
                        </aside>
                    <?php endif; ?>
                <?php else: ?>
                    
                    <div class="product-screenshot-placeholder" role="note" data-missing-screenshot="document-management">
                        <span class="product-placeholder-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none"><path d="M7 3h7l4 4v14H7V3Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M14 3v5h5M10 12h5M10 16h5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
                        </span>
                        <strong>اسکرین واقعی این بخش هنوز موجود نیست</strong>
                        <p><?php echo e($section['placeholder']); ?></p>
                        <code dir="ltr">document-management-shipment-files.webp</code>
                    </div>
                <?php endif; ?>
            </div>

            <div class="product-evidence-details reveal">
                <article>
                    <span>مسئله</span>
                    <p><?php echo e($section['problem']); ?></p>
                </article>
                <article>
                    <span>اقدام سپند</span>
                    <p><?php echo e($section['action']); ?></p>
                </article>
                <article class="is-outcome">
                    <span>خروجی قابل مشاهده</span>
                    <p><?php echo e($section['outcome']); ?></p>
                </article>
            </div>

            <div class="product-evidence-link reveal">
                <a href="<?php echo e($section['cta_url'] ?? route('site.modules.show', ['module' => $section['module']])); ?>">
                    <?php echo e($section['cta']); ?>

                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M19 12H5m6 6-6-6 6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>
<?php /**PATH C:\project\sepand\portal-customer\resources\views/components/marketing/product-evidence.blade.php ENDPATH**/ ?>