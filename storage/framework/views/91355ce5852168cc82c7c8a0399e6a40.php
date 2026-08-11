<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#102f52">
    <meta name="robots" content="noindex,nofollow,noarchive">
    <title><?php echo $__env->yieldContent('title', 'پورتال مشتریان'); ?> | سپند</title>
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('assets/images/favicon.png')); ?>?v=20260811">
    <link rel="stylesheet" href="<?php echo e(asset('assets/customer-portal/portal.css')); ?>?v=20260811">
</head>
<body>
<?php
    $personName = $portalPersonal->full_name ?: 'مشتری سپند';
    $initials = mb_substr($portalPersonal->first_name ?: $portalPersonal->last_name ?: 'م', 0, 1);
?>
<div class="portal-shell">
    <aside class="portal-sidebar" id="portal-sidebar">
        <div class="sidebar-head">
            <a class="portal-brand" href="<?php echo e(route('portal.dashboard')); ?>">
                <img src="<?php echo e(asset('assets/images/brand/sepand-provided-header-dark.png')); ?>" alt="سپند">
                <span><strong>سپند</strong><small>پورتال مشتریان</small></span>
            </a>
            <button class="sidebar-close" type="button" data-sidebar-close aria-label="بستن منو"><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.portal.icon','data' => ['name' => 'close']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('portal.icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'close']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $attributes = $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $component = $__componentOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?></button>
        </div>

        <div class="sidebar-customer">
            <span class="customer-avatar"><?php echo e($initials); ?></span>
            <p><strong><?php echo e($personName); ?></strong><small><?php echo e($portalCustomer->company ?: 'مشتری حقیقی سپند'); ?></small></p>
            <span class="verified-mark" title="هویت تأییدشده"><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.portal.icon','data' => ['name' => 'check']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('portal.icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'check']); ?>
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
        </div>

        <nav class="sidebar-nav" aria-label="منوی اصلی پورتال">
            <span class="nav-title">میز کار من</span>
            <a class="<?php echo e(request()->routeIs('portal.dashboard') ? 'is-active' : ''); ?>" href="<?php echo e(route('portal.dashboard')); ?>">
                <i><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.portal.icon','data' => ['name' => 'dashboard']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('portal.icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'dashboard']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $attributes = $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $component = $__componentOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?></i><span>نمای کلی</span>
            </a>
            <a class="<?php echo e(request()->routeIs('portal.inquiries.*') ? 'is-active' : ''); ?>" href="<?php echo e(route('portal.inquiries.index')); ?>">
                <i><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
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
<?php endif; ?></i><span>استعلام‌های من</span>
            </a>
            <a class="<?php echo e(request()->routeIs('portal.shipments.*') ? 'is-active' : ''); ?>" href="<?php echo e(route('portal.shipments.index')); ?>">
                <i><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
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
<?php endif; ?></i><span>محموله‌ها و رهگیری</span>
            </a>
            <a class="<?php echo e(request()->routeIs('portal.financials') ? 'is-active' : ''); ?>" href="<?php echo e(route('portal.financials')); ?>">
                <i><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.portal.icon','data' => ['name' => 'financials']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('portal.icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'financials']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $attributes = $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $component = $__componentOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?></i><span>امور مالی</span>
            </a>
            <span class="nav-title nav-title-second">حساب کاربری</span>
            <a class="<?php echo e(request()->routeIs('portal.profile') ? 'is-active' : ''); ?>" href="<?php echo e(route('portal.profile')); ?>">
                <i><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.portal.icon','data' => ['name' => 'profile']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('portal.icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'profile']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $attributes = $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $component = $__componentOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?></i><span>اطلاعات حساب</span>
            </a>
        </nav>

        <div class="sidebar-help">
            <span><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.portal.icon','data' => ['name' => 'support']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('portal.icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'support']); ?>
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
            <p><strong>نیاز به راهنمایی دارید؟</strong><small><?php echo e(config('customer_portal.support_hours')); ?></small></p>
            <a href="tel:<?php echo e(preg_replace('/\D+/', '', \App\Support\MobileNumber::toEnglishDigits(config('customer_portal.support_phone')))); ?>"><?php echo e(config('customer_portal.support_phone')); ?></a>
        </div>

        <form class="sidebar-logout" method="POST" action="<?php echo e(route('portal.logout')); ?>">
            <?php echo csrf_field(); ?>
            <button type="submit"><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.portal.icon','data' => ['name' => 'logout']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('portal.icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'logout']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $attributes = $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $component = $__componentOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?>خروج امن از حساب</button>
        </form>
    </aside>
    <button class="sidebar-overlay" type="button" data-sidebar-close aria-label="بستن منو"></button>

    <div class="portal-main">
        <header class="portal-header">
            <div class="header-title">
                <button class="sidebar-open" type="button" data-sidebar-open aria-label="باز کردن منو"><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.portal.icon','data' => ['name' => 'menu']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('portal.icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'menu']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $attributes = $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $component = $__componentOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?></button>
                <div><span><?php echo $__env->yieldContent('eyebrow', 'پورتال مشتریان'); ?></span><h1><?php echo $__env->yieldContent('page-title', 'نمای کلی'); ?></h1></div>
            </div>
            <div class="header-actions">
                <span class="system-online"><i></i><b>سامانه آنلاین است</b></span>
                <a class="header-notification" href="<?php echo e(route('portal.shipments.index')); ?>" aria-label="رویدادهای محموله">
                    <?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
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
<?php endif; ?><i></i>
                </a>
                <a class="header-profile" href="<?php echo e(route('portal.profile')); ?>">
                    <span><?php echo e($initials); ?></span>
                    <p><strong><?php echo e($personName); ?></strong><small dir="ltr"><?php echo e(\App\Support\MobileNumber::mask($portalPersonal->mobile)); ?></small></p>
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
            </div>
        </header>

        <main class="portal-content">
            <?php if(session('success')): ?>
                <div class="portal-toast" role="status" data-toast>
                    <span><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.portal.icon','data' => ['name' => 'check']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('portal.icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'check']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $attributes = $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $component = $__componentOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?></span><p><?php echo e(session('success')); ?></p>
                    <button type="button" data-toast-close aria-label="بستن"><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.portal.icon','data' => ['name' => 'close']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('portal.icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'close']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $attributes = $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $component = $__componentOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?></button>
                </div>
            <?php endif; ?>
            <?php echo $__env->yieldContent('content'); ?>
        </main>

        <nav class="mobile-nav" aria-label="دسترسی سریع موبایل">
            <a class="<?php echo e(request()->routeIs('portal.dashboard') ? 'is-active' : ''); ?>" href="<?php echo e(route('portal.dashboard')); ?>"><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.portal.icon','data' => ['name' => 'dashboard']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('portal.icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'dashboard']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $attributes = $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $component = $__componentOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?><span>خانه</span></a>
            <a class="<?php echo e(request()->routeIs('portal.inquiries.*') ? 'is-active' : ''); ?>" href="<?php echo e(route('portal.inquiries.index')); ?>"><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
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
<?php endif; ?><span>استعلام‌ها</span></a>
            <a class="<?php echo e(request()->routeIs('portal.shipments.*') ? 'is-active' : ''); ?>" href="<?php echo e(route('portal.shipments.index')); ?>"><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
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
<?php endif; ?><span>رهگیری</span></a>
            <a class="<?php echo e(request()->routeIs('portal.profile') ? 'is-active' : ''); ?>" href="<?php echo e(route('portal.profile')); ?>"><?php if (isset($component)) { $__componentOriginal521d2f2530af53bb74d9e325c280cd3c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.portal.icon','data' => ['name' => 'profile']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('portal.icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'profile']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $attributes = $__attributesOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__attributesOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c)): ?>
<?php $component = $__componentOriginal521d2f2530af53bb74d9e325c280cd3c; ?>
<?php unset($__componentOriginal521d2f2530af53bb74d9e325c280cd3c); ?>
<?php endif; ?><span>حساب</span></a>
        </nav>
    </div>
</div>
<script src="<?php echo e(asset('assets/customer-portal/portal.js')); ?>?v=20260811" defer></script>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\project\sepand\portal-customer\resources\views/layouts/customer-portal.blade.php ENDPATH**/ ?>