<?php $__env->startSection('title', 'تأیید کد ورود'); ?>

<?php $__env->startSection('content'); ?>
    <div class="auth-card verify-card">
        <a class="back-step" href="<?php echo e(route('login')); ?>">
            <svg viewBox="0 0 24 24"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
            اصلاح شماره موبایل
        </a>
        <span class="portal-pill"><i></i>تأیید هویت</span>
        <h1><?php echo e($customerName); ?>، کد را وارد کنید</h1>
        <p class="auth-lead">کد ۶ رقمی ورود برای شماره <b dir="ltr"><?php echo e($maskedMobile); ?></b> ایجاد شد. این کد تا دو دقیقه معتبر است.</p>

        <?php if($previewOtp): ?>
            <div class="otp-preview" role="status">
                <span class="preview-lock"><svg viewBox="0 0 24 24"><path d="M7 10V7a5 5 0 0 1 10 0v3M5 10h14v11H5V10Z"/></svg></span>
                <p><small>کد ورود آزمایشی شما</small><strong dir="ltr"><?php echo e($previewOtp); ?></strong></p>
                <span class="preview-badge">نمایش موقت</span>
            </div>
        <?php endif; ?>

        <?php $__errorArgs = ['otp'];
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

        <form class="auth-form" method="POST" action="<?php echo e(route('login.verify.submit')); ?>" data-loading-form data-otp-form>
            <?php echo csrf_field(); ?>
            <fieldset class="otp-fieldset">
                <legend>کد یک‌بارمصرف</legend>
                <div class="otp-inputs" dir="ltr">
                    <?php for($digit = 0; $digit < 6; $digit++): ?>
                        <input name="digits[]" type="text" inputmode="numeric" pattern="[0-9]*" maxlength="1"
                               autocomplete="<?php echo e($digit === 0 ? 'one-time-code' : 'off'); ?>" aria-label="رقم <?php echo e($digit + 1); ?>">
                    <?php endfor; ?>
                </div>
            </fieldset>

            <div class="otp-timer" data-expire-at="<?php echo e($expiresAt); ?>">
                <span><svg viewBox="0 0 24 24"><path d="M12 7v5l3 2M7 3h10M12 3v2a8 8 0 1 1-8 8"/></svg>زمان باقی‌مانده</span>
                <strong dir="ltr" data-countdown>۰۲:۰۰</strong>
            </div>

            <button class="primary-button" type="submit">
                <span class="button-label">ورود به پورتال</span>
                <svg class="button-arrow" viewBox="0 0 24 24"><path d="M19 12H5m6 6-6-6 6-6"/></svg>
                <i class="button-spinner"></i>
            </button>
        </form>

        <form class="resend-form" method="POST" action="<?php echo e(route('login.resend')); ?>">
            <?php echo csrf_field(); ?>
            <span>کدی دریافت نکردید؟</span>
            <button type="submit" data-resend-button data-resend-at="<?php echo e($resendAt); ?>" disabled>ارسال دوباره کد</button>
            <small data-resend-wait></small>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.customer-auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\project\sepand\portal-customer\resources\views/auth/customer-verify.blade.php ENDPATH**/ ?>