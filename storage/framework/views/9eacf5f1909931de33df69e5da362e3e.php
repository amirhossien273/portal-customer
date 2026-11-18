<?php $__env->startSection('title', 'انتخاب سازمان'); ?>

<?php $__env->startSection('content'); ?>
    <div class="auth-card account-select-card">
        <span class="portal-pill"><i></i>حساب‌های متصل به شماره شما</span>
        <h1>کدام سازمان را می‌خواهید ببینید؟</h1>
        <p class="auth-lead">اطلاعات هر سازمان کاملاً جدا نمایش داده می‌شود. هر زمان بخواهید می‌توانید بدون دریافت دوباره کد ورود، سازمان فعال را تغییر دهید.</p>

        <?php if(session('success')): ?>
            <div class="alert alert-success" role="status">
                <svg viewBox="0 0 24 24"><path d="m6 12 4 4 8-9"/></svg>
                <span><?php echo e(session('success')); ?></span>
            </div>
        <?php endif; ?>

        <?php $__errorArgs = ['account'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="alert alert-danger" role="alert">
                <svg viewBox="0 0 24 24"><path d="M12 8v5m0 3h.01M10.3 4.5 2.8 17.4A2 2 0 0 0 4.5 20h15a2 2 0 0 0 1.7-2.6L13.7 4.5a2 2 0 0 0-3.4 0Z"/></svg>
                <span><?php echo e($message); ?></span>
            </div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

        <div class="account-options" role="list" aria-label="سازمان‌های قابل دسترس">
            <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $isActive = (string) $account['personal_id'] === $activePersonalId;
                    $tenantInitial = mb_substr($account['tenant_name'] ?: 'س', 0, 1);
                ?>
                <form method="POST" action="<?php echo e(route('portal.accounts.select')); ?>" role="listitem">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="account" value="<?php echo e($account['personal_id']); ?>">
                    <button class="account-option <?php echo e($isActive ? 'is-current' : ''); ?>" type="submit">
                        <span class="account-logo"><?php echo e($tenantInitial); ?></span>
                        <span class="account-copy">
                            <small>سازمان ارائه‌دهنده خدمات</small>
                            <strong><?php echo e($account['tenant_name']); ?></strong>
                            <em><?php echo e($account['customer_name']); ?></em>
                        </span>
                        <span class="account-action">
                            <?php if($isActive): ?>
                                <b><i></i>فعال</b>
                            <?php endif; ?>
                            <svg viewBox="0 0 24 24"><path d="M19 12H5m6 6-6-6 6-6"/></svg>
                        </span>
                    </button>
                </form>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="account-security-note">
            <svg viewBox="0 0 24 24"><path d="M12 21s7-3 7-9V5l-7-2-7 2v7c0 6 7 9 7 9Z"/><path d="m9 12 2 2 4-5"/></svg>
            <p><strong>دسترسی ایزوله و امن</strong><span>با تغییر سازمان فقط داده‌های همان مشتری و همان tenant از CRM خوانده می‌شود.</span></p>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.customer-auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\project\sepand\portal-customer\resources\views/auth/customer-account-select.blade.php ENDPATH**/ ?>