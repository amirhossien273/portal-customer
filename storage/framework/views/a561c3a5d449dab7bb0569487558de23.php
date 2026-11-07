<?php $__env->startSection('title', 'محموله‌ها و رهگیری'); ?>
<?php $__env->startSection('eyebrow', 'عملیات حمل'); ?>
<?php $__env->startSection('page-title', 'محموله‌ها و رهگیری'); ?>

<?php $__env->startSection('content'); ?>
    <section class="page-toolbar">
        <form class="filter-form" method="GET" action="<?php echo e(route('portal.shipments.index')); ?>">
            <div class="search-box"><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.portal.icon','data' => ['name' => 'search']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('portal.icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'search']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $attributes = $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $component = $__componentOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?><input name="q" value="<?php echo e(request('q')); ?>" placeholder="جست‌وجو با کد، سرویس، مبدأ یا مقصد"></div>
            <button class="filter-button" type="submit">جست‌وجو</button>
        </form>
        <span class="result-count"><strong><?php echo e($shipments->total()); ?></strong> محموله در حساب شما</span>
    </section>

    <?php if($shipments->isNotEmpty()): ?>
        <div class="shipment-grid">
            <?php $__currentLoopData = $shipments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shipment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $origin = \App\Support\CustomerPortalPresenter::routePoint([$shipment->origin_city, $shipment->origin_port, $shipment->origin_country], 'مبدأ نامشخص');
                    $destination = \App\Support\CustomerPortalPresenter::routePoint([$shipment->destination_city, $shipment->destination_port, $shipment->destination_country], 'مقصد نامشخص');
                    $trackingStatus = \App\Support\CustomerPortalPresenter::trackingStatus($shipment->latestVisibleTracking?->status);
                ?>
                <article class="shipment-card">
                    <div class="shipment-card-head">
                        <span class="shipment-card-icon"><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.portal.icon','data' => ['name' => 'shipments']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('portal.icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'shipments']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $attributes = $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $component = $__componentOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?></span>
                        <p class="shipment-card-title"><strong><?php echo e($shipment->service_name ?: 'محموله حمل‌ونقل'); ?></strong><small><?php echo e($shipment->job?->code ?: $shipment->booking?->code ?: 'بدون کد عملیاتی'); ?></small></p>
                        <span class="status-badge status-<?php echo e($trackingStatus['tone']); ?>"><?php echo e($trackingStatus['label']); ?></span>
                    </div>
                    <div class="shipment-route"><p class="route-city"><strong><?php echo e($origin); ?></strong><small>مبدأ</small></p><span class="route-flight"><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.portal.icon','data' => ['name' => 'route']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('portal.icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'route']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $attributes = $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $component = $__componentOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?></span><p class="route-city"><strong><?php echo e($destination); ?></strong><small>مقصد</small></p></div>
                    <footer class="shipment-card-foot">
                        <span><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.portal.icon','data' => ['name' => 'clock']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('portal.icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'clock']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $attributes = $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $component = $__componentOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?><?php echo e($shipment->latestVisibleTracking ? \App\Support\CustomerPortalPresenter::date($shipment->latestVisibleTracking->event_time, true) : 'در انتظار اولین رویداد'); ?></span>
                        <a href="<?php echo e(route('portal.shipments.show', $shipment)); ?>">مشاهده تایم‌لاین <?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.portal.icon','data' => ['name' => 'chevron-left']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('portal.icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'chevron-left']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $attributes = $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $component = $__componentOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?></a>
                    </footer>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php echo $__env->make('customer-portal.partials.pagination', ['paginator' => $shipments], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php else: ?>
        <section class="panel"><div class="empty-state"><span><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.portal.icon','data' => ['name' => 'shipments']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('portal.icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'shipments']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $attributes = $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $component = $__componentOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?></span><strong>محموله‌ای پیدا نشد</strong><p>اگر از جست‌وجو استفاده کرده‌اید، عبارت دیگری امتحان کنید. محموله‌های عملیاتی جدید به‌صورت خودکار اینجا ظاهر می‌شوند.</p></div></section>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.customer-portal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/portal-customer/resources/views/customer-portal/shipments/index.blade.php ENDPATH**/ ?>