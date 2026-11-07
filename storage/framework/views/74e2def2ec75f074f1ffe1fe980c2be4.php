<?php $__env->startSection('title', 'نمای کلی'); ?>
<?php $__env->startSection('eyebrow', 'امروز در سپند'); ?>
<?php $__env->startSection('page-title', 'نمای کلی حساب'); ?>

<?php $__env->startSection('content'); ?>
    <?php
        $firstName = $portalPersonal->first_name ?: $portalPersonal->full_name ?: 'همراه عزیز';
    ?>
    <section class="welcome-panel">
        <div class="welcome-copy">
            <span><i></i>مرکز کنترل حمل‌ونقل شما</span>
            <h2><?php echo e($firstName); ?>، سلام!</h2>
            <p>از اینجا می‌توانید آخرین وضعیت استعلام‌ها، رزروها و رویدادهای قابل‌نمایش محموله‌های خود را یک‌جا دنبال کنید.</p>
        </div>
        <a class="welcome-action" href="<?php echo e(route('portal.shipments.index')); ?>">
            <span><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
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
            <p><strong>رهگیری محموله‌ها</strong><small><?php echo e($stats['active_shipments']); ?> محموله فعال دارید</small></p>
            <?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
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
<?php endif; ?>
        </a>
    </section>

    <section class="stats-grid" aria-label="خلاصه وضعیت حساب">
        <article class="stat-card is-blue"><span class="stat-icon"><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
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
<?php endif; ?></span><p><small>کل استعلام‌ها</small><strong><?php echo e($stats['inquiries']); ?> <em>مورد</em></strong></p></article>
        <article class="stat-card is-gold"><span class="stat-icon"><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
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
<?php endif; ?></span><p><small>در حال بررسی</small><strong><?php echo e($stats['open_inquiries']); ?> <em>استعلام</em></strong></p></article>
        <article class="stat-card is-teal"><span class="stat-icon"><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
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
<?php endif; ?></span><p><small>کل محموله‌ها</small><strong><?php echo e($stats['shipments']); ?> <em>محموله</em></strong></p></article>
        <article class="stat-card is-green"><span class="stat-icon"><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
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
<?php endif; ?></span><p><small>محموله فعال</small><strong><?php echo e($stats['active_shipments']); ?> <em>در مسیر</em></strong></p></article>
    </section>

    <section class="content-grid">
        <article class="panel">
            <header class="panel-head">
                <div class="panel-title"><span><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
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
<?php endif; ?></span><div><h2>آخرین استعلام‌ها</h2><p>تازه‌ترین درخواست‌های ثبت‌شده شما</p></div></div>
                <a class="text-link" href="<?php echo e(route('portal.inquiries.index')); ?>">مشاهده همه <?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.portal.icon','data' => ['name' => 'arrow-left']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('portal.icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'arrow-left']); ?>
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
            </header>
            <?php if($recentInquiries->isNotEmpty()): ?>
                <table class="data-table">
                    <thead><tr><th>استعلام</th><th>تاریخ ثبت</th><th>نوع حمل</th><th>وضعیت</th><th></th></tr></thead>
                    <tbody>
                    <?php $__currentLoopData = $recentInquiries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inquiry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $status = \App\Support\CustomerPortalPresenter::inquiryStatus($inquiry->status);
                        ?>
                        <tr>
                            <td><div class="table-primary"><span><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
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
<?php endif; ?></span><p><strong><?php echo e($inquiry->name); ?></strong><small><?php echo e($inquiry->code ?: 'بدون کد'); ?></small></p></div></td>
                            <td data-label="ثبت:"><?php echo e(\App\Support\CustomerPortalPresenter::date($inquiry->created_at)); ?></td>
                            <td data-label="روش:"><?php echo e(\App\Support\CustomerPortalPresenter::shippingMode($inquiry->shipping_mode)); ?></td>
                            <td data-label="وضعیت:"><span class="status-badge status-<?php echo e($status['tone']); ?>"><?php echo e($status['label']); ?></span></td>
                            <td><a class="row-link" href="<?php echo e(route('portal.inquiries.show', $inquiry)); ?>" aria-label="جزئیات استعلام"><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
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
<?php endif; ?></a></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="empty-state"><span><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.portal.icon','data' => ['name' => 'empty']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('portal.icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'empty']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $attributes = $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $component = $__componentOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?></span><strong>هنوز استعلامی ندارید</strong><p>پس از ثبت نخستین استعلام در CRM، وضعیت آن در این بخش نمایش داده می‌شود.</p></div>
            <?php endif; ?>
        </article>

        <article class="panel">
            <header class="panel-head"><div class="panel-title"><span><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.portal.icon','data' => ['name' => 'bell']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('portal.icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'bell']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $attributes = $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $component = $__componentOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?></span><div><h2>رویدادهای تازه</h2><p>آخرین تغییرات محموله‌ها</p></div></div></header>
            <?php if($recentTrackings->isNotEmpty()): ?>
                <div class="activity-list">
                    <?php $__currentLoopData = $recentTrackings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tracking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="activity-item is-<?php echo e($tracking->status); ?>">
                            <span class="activity-dot"><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.portal.icon','data' => ['name' => ''.e($tracking->status === 'completed' ? 'check' : 'clock').'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('portal.icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => ''.e($tracking->status === 'completed' ? 'check' : 'clock').'']); ?>
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
                            <div><p><strong><?php echo e($tracking->event_title); ?></strong><small><?php echo e($tracking->event_description ?: 'یک رویداد جدید برای محموله ثبت شده است.'); ?></small></p><div class="activity-meta"><span><?php echo e($tracking->location ?: $tracking->country ?: 'موقعیت ثبت نشده'); ?></span><span><?php echo e(\App\Support\CustomerPortalPresenter::date($tracking->event_time, true)); ?></span></div></div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <div class="empty-state"><span><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.portal.icon','data' => ['name' => 'bell']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('portal.icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'bell']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $attributes = $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $component = $__componentOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?></span><strong>رویداد تازه‌ای نیست</strong><p>به‌محض ثبت تغییر جدید، اینجا به شما اطلاع می‌دهیم.</p></div>
            <?php endif; ?>
        </article>
    </section>

    <section>
        <header class="section-head"><div><h2>محموله‌های اخیر</h2><p>مسیر و آخرین رویداد محموله‌های عملیاتی</p></div><a class="text-link" href="<?php echo e(route('portal.shipments.index')); ?>">همه محموله‌ها <?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.portal.icon','data' => ['name' => 'arrow-left']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('portal.icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'arrow-left']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $attributes = $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $component = $__componentOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?></a></header>
        <?php if($activeShipments->isNotEmpty()): ?>
            <div class="shipment-grid">
                <?php $__currentLoopData = $activeShipments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shipment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $origin = \App\Support\CustomerPortalPresenter::routePoint([$shipment->origin_city, $shipment->origin_port, $shipment->origin_country], 'مبدأ نامشخص');
                        $destination = \App\Support\CustomerPortalPresenter::routePoint([$shipment->destination_city, $shipment->destination_port, $shipment->destination_country], 'مقصد نامشخص');
                        $trackingStatus = \App\Support\CustomerPortalPresenter::trackingStatus($shipment->latestVisibleTracking?->status);
                    ?>
                    <article class="shipment-card">
                        <div class="shipment-card-head"><span class="shipment-card-icon"><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
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
<?php endif; ?></span><p class="shipment-card-title"><strong><?php echo e($shipment->service_name ?: 'محموله حمل‌ونقل'); ?></strong><small><?php echo e($shipment->job?->code ?: $shipment->booking?->code ?: 'بدون کد عملیاتی'); ?></small></p><span class="status-badge status-<?php echo e($trackingStatus['tone']); ?>"><?php echo e($trackingStatus['label']); ?></span></div>
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
                        <footer class="shipment-card-foot"><span><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
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
<?php endif; ?><?php echo e($shipment->latestVisibleTracking ? \App\Support\CustomerPortalPresenter::date($shipment->latestVisibleTracking->event_time, true) : 'در انتظار اولین رویداد'); ?></span><a href="<?php echo e(route('portal.shipments.show', $shipment)); ?>">جزئیات رهگیری <?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
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
<?php endif; ?></a></footer>
                    </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <article class="panel"><div class="empty-state"><span><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
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
<?php endif; ?></span><strong>محموله‌ای برای رهگیری وجود ندارد</strong><p>محموله‌ها بعد از تبدیل استعلام موفق به بوکینگ عملیاتی در این بخش ظاهر می‌شوند.</p></div></article>
        <?php endif; ?>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.customer-portal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/portal-customer/resources/views/customer-portal/dashboard.blade.php ENDPATH**/ ?>