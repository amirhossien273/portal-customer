@extends('layouts.customer-auth')

@section('title', 'انتخاب سازمان')

@section('content')
    <div class="auth-card account-select-card">
        <span class="portal-pill"><i></i>حساب‌های متصل به شماره شما</span>
        <h1>کدام سازمان را می‌خواهید ببینید؟</h1>
        <p class="auth-lead">اطلاعات هر سازمان کاملاً جدا نمایش داده می‌شود. هر زمان بخواهید می‌توانید بدون دریافت دوباره کد ورود، سازمان فعال را تغییر دهید.</p>

        @if(session('success'))
            <div class="alert alert-success" role="status">
                <svg viewBox="0 0 24 24"><path d="m6 12 4 4 8-9"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @error('account')
            <div class="alert alert-danger" role="alert">
                <svg viewBox="0 0 24 24"><path d="M12 8v5m0 3h.01M10.3 4.5 2.8 17.4A2 2 0 0 0 4.5 20h15a2 2 0 0 0 1.7-2.6L13.7 4.5a2 2 0 0 0-3.4 0Z"/></svg>
                <span>{{ $message }}</span>
            </div>
        @enderror

        <div class="account-options" role="list" aria-label="سازمان‌های قابل دسترس">
            @foreach($accounts as $account)
                @php
                    $isActive = (string) $account['personal_id'] === $activePersonalId;
                    $tenantInitial = mb_substr($account['tenant_name'] ?: 'س', 0, 1);
                @endphp
                <form method="POST" action="{{ route('portal.accounts.select') }}" role="listitem">
                    @csrf
                    <input type="hidden" name="account" value="{{ $account['personal_id'] }}">
                    <button class="account-option {{ $isActive ? 'is-current' : '' }}" type="submit">
                        <span class="account-logo">{{ $tenantInitial }}</span>
                        <span class="account-copy">
                            <small>سازمان ارائه‌دهنده خدمات</small>
                            <strong>{{ $account['tenant_name'] }}</strong>
                            <em>{{ $account['customer_name'] }}</em>
                        </span>
                        <span class="account-action">
                            @if($isActive)
                                <b><i></i>فعال</b>
                            @endif
                            <svg viewBox="0 0 24 24"><path d="M19 12H5m6 6-6-6 6-6"/></svg>
                        </span>
                    </button>
                </form>
            @endforeach
        </div>

        <div class="account-security-note">
            <svg viewBox="0 0 24 24"><path d="M12 21s7-3 7-9V5l-7-2-7 2v7c0 6 7 9 7 9Z"/><path d="m9 12 2 2 4-5"/></svg>
            <p><strong>دسترسی ایزوله و امن</strong><span>با تغییر سازمان فقط داده‌های همان مشتری و همان tenant از CRM خوانده می‌شود.</span></p>
        </div>
    </div>
@endsection
