@extends('layouts.customer-portal')

@section('title', 'اطلاعات حساب')
@section('eyebrow', 'حساب کاربری')
@section('page-title', 'اطلاعات حساب')

@section('content')
    @php
        $initial = mb_substr($portalPersonal->first_name ?: $portalPersonal->last_name ?: 'م', 0, 1);
    @endphp
    <section class="profile-grid">
        <article class="profile-card">
            <span class="profile-large-avatar">{{ $initial }}</span>
            <h2>{{ $portalPersonal->full_name ?: 'مشتری سپند' }}</h2>
            <p>{{ $customer->company ?: 'مشتری حقیقی' }}</p>
            <span class="profile-verified"><x-portal.icon name="check" />هویت تأییدشده با OTP</span>
        </article>

        <article class="profile-info">
            <header class="detail-panel-head"><span><x-portal.icon name="profile" /></span><h3>اطلاعات ثبت‌شده در CRM</h3></header>
            <div class="contact-list">
                <div class="contact-card"><span><x-portal.icon name="profile" /></span><p><small>نام و نام خانوادگی</small><strong>{{ $portalPersonal->full_name ?: 'ثبت نشده' }}</strong></p></div>
                <div class="contact-card"><span><x-portal.icon name="shipments" /></span><p><small>شرکت / سازمان</small><strong>{{ $customer->company ?: 'شخص حقیقی' }}</strong></p></div>
                <div class="contact-card"><span><x-portal.icon name="support" /></span><p><small>شماره موبایل ورود</small><strong dir="ltr">{{ $portalPersonal->mobile }}</strong></p></div>
                <div class="contact-card"><span><x-portal.icon name="inquiries" /></span><p><small>سمت سازمانی</small><strong>{{ $portalPersonal->position ?: 'ثبت نشده' }}</strong></p></div>
                <div class="contact-card"><span><x-portal.icon name="location" /></span><p><small>نشانی</small><strong>{{ $customer->address ?: 'ثبت نشده' }}</strong></p></div>
                <div class="contact-card"><span><x-portal.icon name="support" /></span><p><small>تلفن شرکت</small><strong dir="ltr">{{ $customer->company_phone ?: 'ثبت نشده' }}</strong></p></div>
            </div>
            <div class="profile-notice"><x-portal.icon name="support" /><span>اطلاعات این صفحه مستقیماً از پرونده مشتری شما در سپند خوانده می‌شود. برای اصلاح شماره موبایل یا مشخصات سازمانی با پشتیبانی تماس بگیرید.</span></div>
        </article>
    </section>
@endsection
