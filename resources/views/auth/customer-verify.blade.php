@extends('layouts.customer-auth')

@section('title', 'تأیید کد ورود')

@section('content')
    <div class="auth-card verify-card">
        <a class="back-step" href="{{ route('login') }}">
            <svg viewBox="0 0 24 24"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
            اصلاح شماره موبایل
        </a>
        <span class="portal-pill"><i></i>تأیید هویت</span>
        <h1>{{ $customerName }}، کد را وارد کنید</h1>
        <p class="auth-lead">کد ۶ رقمی ورود برای شماره <b dir="ltr">{{ $maskedMobile }}</b> ایجاد شد. این کد تا دو دقیقه معتبر است.</p>

        @if($previewOtp)
            <div class="otp-preview" role="status">
                <span class="preview-lock"><svg viewBox="0 0 24 24"><path d="M7 10V7a5 5 0 0 1 10 0v3M5 10h14v11H5V10Z"/></svg></span>
                <p><small>کد ورود آزمایشی شما</small><strong dir="ltr">{{ $previewOtp }}</strong></p>
                <span class="preview-badge">نمایش موقت</span>
            </div>
        @endif

        @error('otp')
            <div class="alert alert-danger" role="alert">
                <svg viewBox="0 0 24 24"><path d="M12 8v5m0 3h.01M10.3 4.5 2.8 17.4A2 2 0 0 0 4.5 20h15a2 2 0 0 0 1.7-2.6L13.7 4.5a2 2 0 0 0-3.4 0Z"/></svg>
                <span>{{ $message }}</span>
            </div>
        @enderror

        <form class="auth-form" method="POST" action="{{ route('login.verify.submit') }}" data-loading-form data-otp-form>
            @csrf
            <fieldset class="otp-fieldset">
                <legend>کد یک‌بارمصرف</legend>
                <div class="otp-inputs" dir="ltr">
                    @for($digit = 0; $digit < 6; $digit++)
                        <input name="digits[]" type="text" inputmode="numeric" pattern="[0-9]*" maxlength="1"
                               autocomplete="{{ $digit === 0 ? 'one-time-code' : 'off' }}" aria-label="رقم {{ $digit + 1 }}">
                    @endfor
                </div>
            </fieldset>

            <div class="otp-timer" data-expire-at="{{ $expiresAt }}">
                <span><svg viewBox="0 0 24 24"><path d="M12 7v5l3 2M7 3h10M12 3v2a8 8 0 1 1-8 8"/></svg>زمان باقی‌مانده</span>
                <strong dir="ltr" data-countdown>۰۲:۰۰</strong>
            </div>

            <button class="primary-button" type="submit">
                <span class="button-label">ورود به پورتال</span>
                <svg class="button-arrow" viewBox="0 0 24 24"><path d="M19 12H5m6 6-6-6 6-6"/></svg>
                <i class="button-spinner"></i>
            </button>
        </form>

        <form class="resend-form" method="POST" action="{{ route('login.resend') }}">
            @csrf
            <span>کدی دریافت نکردید؟</span>
            <button type="submit" data-resend-button data-resend-at="{{ $resendAt }}" disabled>ارسال دوباره کد</button>
            <small data-resend-wait></small>
        </form>
    </div>
@endsection
