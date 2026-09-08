<?php $__env->startSection('title', 'ورود به پورتال مشتریان'); ?>

<?php $__env->startSection('content'); ?>
    <div class="auth-card">
        <span class="portal-pill"><i></i>پورتال مشتریان سپند</span>
        <h1>خوش آمدید</h1>
        <p class="auth-lead">برای مشاهده استعلام‌ها و پیگیری لحظه‌به‌لحظه محموله‌های خود، شماره موبایل ثبت‌شده در سپند را وارد کنید.</p>

        <?php if(session('auth_error')): ?>
            <div class="alert alert-danger" role="alert">
                <svg viewBox="0 0 24 24"><path d="M12 8v5m0 3h.01M10.3 4.5 2.8 17.4A2 2 0 0 0 4.5 20h15a2 2 0 0 0 1.7-2.6L13.7 4.5a2 2 0 0 0-3.4 0Z"/></svg>
                <span><?php echo e(session('auth_error')); ?></span>
            </div>
        <?php endif; ?>

        <?php if(session('logged_out')): ?>
            <div class="alert alert-success" role="status">
                <svg viewBox="0 0 24 24"><path d="m7 12 3 3 7-7"/></svg>
                <span><?php echo e(session('logged_out')); ?></span>
            </div>
        <?php endif; ?>

        <form class="auth-form" method="POST" action="<?php echo e(route('login.otp')); ?>" data-loading-form>
            <?php echo csrf_field(); ?>
            <div class="form-field <?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                <label for="mobile">شماره موبایل</label>
                <div class="input-shell">
                    <span class="input-icon">
                        <svg viewBox="0 0 24 24"><path d="M7 2h10a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2Zm3 17h4"/></svg>
                    </span>
                    <input id="mobile" name="mobile" type="tel" inputmode="numeric" autocomplete="tel" maxlength="15"
                           value="<?php echo e(old('mobile')); ?>" placeholder="۰۹۱۲۱۲۳۴۵۶۷" autofocus aria-describedby="mobile-help mobile-error">
                </div>
                <?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="field-error" id="mobile-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <span class="field-help" id="mobile-help">همان شماره‌ای که در اطلاعات مشتری CRM ثبت شده است.</span>
            </div>

            <button class="primary-button" type="submit">
                <span class="button-label">دریافت کد ورود</span>
                <svg class="button-arrow" viewBox="0 0 24 24"><path d="M19 12H5m6 6-6-6 6-6"/></svg>
                <i class="button-spinner"></i>
            </button>
        </form>

        <div class="secure-note">
            <svg viewBox="0 0 24 24"><path d="M12 21s7-3 7-9V5l-7-2-7 2v7c0 6 7 9 7 9Z"/><path d="m9 12 2 2 4-5"/></svg>
            <p><strong>ورود بدون رمز عبور</strong><span>کد یک‌بارمصرف فقط برای تأیید هویت شما استفاده می‌شود.</span></p>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.customer-auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\project\sepand\portal-customer\resources\views/auth/customer-login.blade.php ENDPATH**/ ?>