<?php $__env->startSection('title', 'رهگیری محموله'); ?>
<?php $__env->startSection('eyebrow', 'محموله‌ها و رهگیری'); ?>
<?php $__env->startSection('page-title', $shipment->job?->code ?: $shipment->booking?->code ?: 'جزئیات محموله'); ?>

<?php $__env->startSection('content'); ?>
    <?php
        $origin = \App\Support\CustomerPortalPresenter::routePoint([$shipment->origin_city, $shipment->origin_port, $shipment->origin_country], 'مبدأ نامشخص');
        $destination = \App\Support\CustomerPortalPresenter::routePoint([$shipment->destination_city, $shipment->destination_port, $shipment->destination_country], 'مقصد نامشخص');
        $latest = $shipment->visibleTrackings->last();
        $latestStatus = \App\Support\CustomerPortalPresenter::trackingStatus($latest?->status);
    ?>
    <nav class="breadcrumb"><a href="<?php echo e(route('portal.shipments.index')); ?>">محموله‌ها</a><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
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
<?php endif; ?><span><?php echo e($shipment->job?->code ?: $shipment->booking?->code ?: 'جزئیات رهگیری'); ?></span></nav>

    <section class="tracking-route">
        <div class="tracking-locations">
            <div class="tracking-location"><small>مبدأ محموله</small><strong><?php echo e($origin); ?></strong></div>
            <div class="tracking-line"><span><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
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
<?php endif; ?></span></div>
            <div class="tracking-location"><small>مقصد محموله</small><strong><?php echo e($destination); ?></strong></div>
        </div>
        <div class="tracking-meta">
            <span><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.portal.icon','data' => ['name' => 'box']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('portal.icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'box']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $attributes = $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $component = $__componentOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?><?php echo e($shipment->service_name ?: 'سرویس ثبت نشده'); ?></span>
            <span><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.portal.icon','data' => ['name' => 'calendar']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('portal.icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'calendar']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $attributes = $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $component = $__componentOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?>حرکت: <?php echo e(\App\Support\CustomerPortalPresenter::date($shipment->departure_date)); ?></span>
            <span><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.portal.icon','data' => ['name' => 'inquiries']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('portal.icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'inquiries']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $attributes = $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $component = $__componentOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?>استعلام: <?php echo e($shipment->booking?->transaction?->code ?: '—'); ?></span>
            <span><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
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
<?php endif; ?>آخرین وضعیت: <?php echo e($latestStatus['label']); ?></span>
        </div>
    </section>

    <div class="detail-grid" style="margin-top:17px">
        <section class="detail-panel">
            <header class="detail-panel-head"><span><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
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
<?php endif; ?></span><h3>تایم‌لاین رهگیری محموله</h3></header>
            <?php if($shipment->visibleTrackings->isNotEmpty()): ?>
                <div class="timeline">
                    <?php $__currentLoopData = $shipment->visibleTrackings->sortByDesc(fn ($event) => $event->event_time ?? $event->created_at); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $eventStatus = \App\Support\CustomerPortalPresenter::trackingStatus($event->status);
                        ?>
                        <article class="timeline-event is-<?php echo e($event->status); ?>">
                            <span class="timeline-marker"><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.portal.icon','data' => ['name' => ''.e($event->status === 'completed' ? 'check' : 'clock').'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('portal.icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => ''.e($event->status === 'completed' ? 'check' : 'clock').'']); ?>
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
                            <div class="timeline-card">
                                <header class="timeline-head"><div><h4><?php echo e($event->event_title); ?></h4><small><?php echo e($event->event_code ?: 'رویداد عملیاتی'); ?></small></div><span class="status-badge status-<?php echo e($eventStatus['tone']); ?>"><?php echo e($eventStatus['label']); ?></span></header>
                                <div class="timeline-body">
                                    <div><small>موقعیت</small><strong><?php echo e(\App\Support\CustomerPortalPresenter::routePoint([$event->location, $event->country])); ?></strong></div>
                                    <div><small>زمان رویداد</small><strong><?php echo e(\App\Support\CustomerPortalPresenter::date($event->event_time, true)); ?></strong></div>
                                    <div><small>زمان مورد انتظار</small><strong><?php echo e(\App\Support\CustomerPortalPresenter::date($event->expected_time, true)); ?></strong></div>
                                </div>
                                <?php if($event->event_description): ?><p class="timeline-note"><?php echo e($event->event_description); ?></p><?php endif; ?>
                                <?php if($event->status === 'delayed' && $event->delay_days): ?><p class="timeline-note" style="color:var(--danger)">میزان تأخیر ثبت‌شده: <?php echo e($event->delay_days); ?> روز</p><?php endif; ?>
                            </div>
                        </article>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <div class="empty-state"><span><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
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
<?php endif; ?></span><strong>هنوز رویدادی برای مشتری منتشر نشده است</strong><p>رویدادهای عملیاتی پس از تأیید تیم سپند در این تایم‌لاین نمایش داده می‌شوند.</p></div>
            <?php endif; ?>
        </section>

        <aside>
            <section class="detail-panel side-summary">
                <header class="detail-panel-head"><span><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
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
<?php endif; ?></span><h3>مشخصات محموله</h3></header>
                <div class="summary-list">
                    <div class="summary-row"><span>کد عملیات</span><strong dir="ltr"><?php echo e($shipment->job?->code ?: '—'); ?></strong></div>
                    <div class="summary-row"><span>کد بوکینگ</span><strong dir="ltr"><?php echo e($shipment->booking?->code ?: '—'); ?></strong></div>
                    <div class="summary-row"><span>نوع سرویس</span><strong><?php echo e($shipment->service_name ?: '—'); ?></strong></div>
                    <div class="summary-row"><span>تاریخ حرکت</span><strong><?php echo e(\App\Support\CustomerPortalPresenter::date($shipment->departure_date)); ?></strong></div>
                    <div class="summary-row"><span>تعداد رویداد قابل مشاهده</span><strong><?php echo e($shipment->visibleTrackings->count()); ?> رویداد</strong></div>
                    <div class="summary-row"><span>آخرین وضعیت</span><strong><span class="status-badge status-<?php echo e($latestStatus['tone']); ?>"><?php echo e($latestStatus['label']); ?></span></strong></div>
                </div>
                <?php if($shipment->booking?->transaction): ?>
                    <a class="side-action" href="<?php echo e(route('portal.inquiries.show', $shipment->booking->transaction)); ?>"><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.portal.icon','data' => ['name' => 'inquiries']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('portal.icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'inquiries']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $attributes = $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $component = $__componentOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?>مشاهده استعلام مرتبط</a>
                <?php endif; ?>
            </section>
        </aside>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.customer-portal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\project\sepand\portal-customer\resources\views/customer-portal/shipments/show.blade.php ENDPATH**/ ?>