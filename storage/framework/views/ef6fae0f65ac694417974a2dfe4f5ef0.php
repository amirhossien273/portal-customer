<?php $__env->startSection('title', 'استعلام‌های من'); ?>
<?php $__env->startSection('eyebrow', 'درخواست‌های حمل'); ?>
<?php $__env->startSection('page-title', 'استعلام‌های من'); ?>

<?php $__env->startSection('content'); ?>
    <section class="page-toolbar">
        <form class="filter-form" method="GET" action="<?php echo e(route('portal.inquiries.index')); ?>">
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
<?php endif; ?><input name="q" value="<?php echo e(request('q')); ?>" placeholder="جست‌وجو با کد، عنوان یا نوع کالا"></div>
            <select class="filter-select" name="status" data-auto-submit aria-label="فیلتر وضعیت">
                <option value="">همه وضعیت‌ها</option>
                <option value="running" <?php if(request('status') === 'running'): echo 'selected'; endif; ?>>در حال بررسی</option>
                <option value="proforma_invoice" <?php if(request('status') === 'proforma_invoice'): echo 'selected'; endif; ?>>پیش‌فاکتور</option>
                <option value="success" <?php if(request('status') === 'success'): echo 'selected'; endif; ?>>نهایی‌شده</option>
                <option value="failed" <?php if(request('status') === 'failed'): echo 'selected'; endif; ?>>بسته‌شده</option>
            </select>
            <button class="filter-button" type="submit">جست‌وجو</button>
        </form>
        <span class="result-count"><strong><?php echo e($inquiries->total()); ?></strong> استعلام پیدا شد</span>
    </section>

    <section class="list-panel">
        <?php if($inquiries->isNotEmpty()): ?>
            <table class="data-table">
                <thead><tr><th>عنوان و کد استعلام</th><th>تاریخ ثبت</th><th>نوع حمل</th><th>کالا / وزن</th><th>وضعیت</th><th></th></tr></thead>
                <tbody>
                <?php $__currentLoopData = $inquiries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inquiry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $status = \App\Support\CustomerPortalPresenter::inquiryStatus($inquiry->status);
                    ?>
                    <tr>
                        <td><div class="table-primary"><span><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
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
<?php endif; ?></span><p><strong><?php echo e($inquiry->name); ?></strong><small><?php echo e($inquiry->code ?: 'بدون کد استعلام'); ?></small></p></div></td>
                        <td data-label="تاریخ:"><?php echo e(\App\Support\CustomerPortalPresenter::date($inquiry->created_at)); ?></td>
                        <td data-label="حمل:"><?php echo e(\App\Support\CustomerPortalPresenter::shippingMode($inquiry->shipping_mode)); ?></td>
                        <td data-label="محموله:"><?php echo e($inquiry->cargo_type ?: '—'); ?> <?php if($inquiry->weight): ?> · <?php echo e(number_format((float) $inquiry->weight)); ?> کیلو <?php endif; ?></td>
                        <td data-label="وضعیت:"><span class="status-badge status-<?php echo e($status['tone']); ?>"><?php echo e($status['label']); ?></span></td>
                        <td><a class="row-link" href="<?php echo e(route('portal.inquiries.show', $inquiry)); ?>" aria-label="نمایش جزئیات"><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
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
            <?php echo $__env->make('customer-portal.partials.pagination', ['paginator' => $inquiries], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
<?php endif; ?></span><strong>استعلامی مطابق جست‌وجوی شما پیدا نشد</strong><p>فیلترها را تغییر دهید یا عبارت جست‌وجوی ساده‌تری وارد کنید.</p></div>
        <?php endif; ?>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.customer-portal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/portal-customer/resources/views/customer-portal/inquiries/index.blade.php ENDPATH**/ ?>