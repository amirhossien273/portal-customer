<?php if(! empty($screenshots)): ?>
    <div
        class="art-panel module-hero-image-panel module-screenshot-panel"
        data-module-screenshot-slider
        role="region"
        aria-roledescription="carousel"
        aria-label="<?php echo e(($screenshots[0]['kind'] ?? 'product') === 'conceptual' ? 'نمای مفهومی ماژول '.$module['name'] : 'تصاویر واقعی ماژول '.$module['name']); ?>"
    >
        <div class="module-screenshot-viewport">
            <?php $__currentLoopData = $screenshots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $screenshot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <figure
                    class="<?php echo \Illuminate\Support\Arr::toCssClasses(['module-screenshot-slide', 'is-active' => $loop->first]); ?>"
                    data-module-screenshot
                    data-caption="<?php echo e($screenshot['caption']); ?>"
                    aria-hidden="<?php echo e($loop->first ? 'false' : 'true'); ?>"
                    aria-label="تصویر <?php echo e($loop->iteration); ?> از <?php echo e($loop->count); ?>"
                >
                    <img
                        src="<?php echo e(asset('assets/images/marketing/'.$screenshot['path'])); ?>"
                        alt="<?php echo e($screenshot['alt']); ?>"
                        width="<?php echo e($screenshot['width']); ?>"
                        height="<?php echo e($screenshot['height']); ?>"
                        loading="<?php echo e($loop->first ? 'eager' : 'lazy'); ?>"
                        <?php if($loop->first): ?> fetchpriority="high" <?php endif; ?>
                        decoding="async"
                    >
                </figure>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="module-screenshot-footer">
            <span class="module-screenshot-caption" data-module-screenshot-caption aria-live="polite"><?php echo e($screenshots[0]['caption']); ?></span>
            <?php if(count($screenshots) > 1): ?>
                <div class="module-screenshot-controls">
                    <button type="button" class="module-screenshot-arrow" data-module-screenshot-prev aria-label="تصویر قبلی ماژول <?php echo e($module['short_name']); ?>">
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 5 7 7-7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </button>
                    <div class="module-screenshot-dots" aria-label="انتخاب تصویر ماژول <?php echo e($module['short_name']); ?>">
                        <?php $__currentLoopData = $screenshots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $screenshot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <button
                                type="button"
                                class="<?php echo \Illuminate\Support\Arr::toCssClasses(['module-screenshot-dot', 'is-active' => $loop->first]); ?>"
                                data-module-screenshot-dot="<?php echo e($loop->index); ?>"
                                aria-label="نمایش تصویر <?php echo e($loop->iteration); ?> ماژول <?php echo e($module['short_name']); ?>"
                                aria-current="<?php echo e($loop->first ? 'true' : 'false'); ?>"
                            ></button>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <button type="button" class="module-screenshot-arrow" data-module-screenshot-next aria-label="تصویر بعدی ماژول <?php echo e($module['short_name']); ?>">
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m15 5-7 7 7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php else: ?>
    <div class="art-panel module-hero-image-panel">
        <img
            class="module-hero-image"
            src="<?php echo e(asset('assets/images/marketing/modules/'.$slug.'-hero.webp')); ?>"
            alt="<?php echo e($imageAlt); ?>"
            width="1536"
            height="1024"
            loading="eager"
            fetchpriority="high"
        >
        <span class="module-hero-brand" aria-label="سپند، CRM هوشمند حمل‌ونقل">
            <img src="<?php echo e(asset('assets/images/brand/sepand-provided-header.png')); ?>" alt="" width="45" height="30">
            <span><strong>سپند</strong><small>CRM هوشمند حمل‌ونقل</small></span>
        </span>
    </div>
<?php endif; ?>

<?php if(! empty($screenshots)): ?>
    <?php if (! $__env->hasRenderedOnce('253bb558-2e87-4599-9100-57f2a88167a5')): $__env->markAsRenderedOnce('253bb558-2e87-4599-9100-57f2a88167a5'); ?>
        <?php $__env->startPush('scripts'); ?>
        <script>
            document.querySelectorAll('[data-module-screenshot-slider]').forEach(slider => {
                const slides = Array.from(slider.querySelectorAll('[data-module-screenshot]'));
                const dots = Array.from(slider.querySelectorAll('[data-module-screenshot-dot]'));
                const caption = slider.querySelector('[data-module-screenshot-caption]');
                const previous = slider.querySelector('[data-module-screenshot-prev]');
                const next = slider.querySelector('[data-module-screenshot-next]');
                let currentIndex = 0;
                let touchStartX = 0;

                const show = index => {
                    currentIndex = (index + slides.length) % slides.length;
                    slides.forEach((slide, slideIndex) => {
                        const isActive = slideIndex === currentIndex;
                        slide.classList.toggle('is-active', isActive);
                        slide.setAttribute('aria-hidden', String(!isActive));
                    });
                    dots.forEach((dot, dotIndex) => {
                        const isActive = dotIndex === currentIndex;
                        dot.classList.toggle('is-active', isActive);
                        dot.setAttribute('aria-current', String(isActive));
                    });
                    caption.textContent = slides[currentIndex].dataset.caption;
                };

                previous?.addEventListener('click', () => show(currentIndex - 1));
                next?.addEventListener('click', () => show(currentIndex + 1));
                dots.forEach(dot => dot.addEventListener('click', () => show(Number(dot.dataset.moduleScreenshotDot))));
                slider.addEventListener('touchstart', event => { touchStartX = event.changedTouches[0].clientX; }, { passive: true });
                slider.addEventListener('touchend', event => {
                    const distance = event.changedTouches[0].clientX - touchStartX;
                    if (Math.abs(distance) < 35 || slides.length < 2) return;
                    show(currentIndex + (distance < 0 ? 1 : -1));
                }, { passive: true });
            });
        </script>
        <?php $__env->stopPush(); ?>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH C:\project\sepand\portal-customer\resources\views/marketing/partials/module-screenshot-slider.blade.php ENDPATH**/ ?>