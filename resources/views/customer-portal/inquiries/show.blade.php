@extends('layouts.customer-portal')

@section('title', 'جزئیات استعلام')
@section('eyebrow', 'استعلام‌های من')
@section('page-title', $inquiry->code ?: 'جزئیات استعلام')

@section('content')
    @php
        $status = \App\Support\CustomerPortalPresenter::inquiryStatus($inquiry->status);
        $bookingStatus = \App\Support\CustomerPortalPresenter::bookingStatus($inquiry->booking?->status);
        $routes = collect($inquiry->routes ?: []);
    @endphp
    <nav class="breadcrumb"><a href="{{ route('portal.inquiries.index') }}">استعلام‌ها</a><x-portal.icon name="chevron-left" /><span>{{ $inquiry->code ?: $inquiry->name }}</span></nav>
    <section class="detail-hero">
        <div class="detail-hero-title"><span><x-portal.icon name="inquiries" /></span><div><h2>{{ $inquiry->name }}</h2><p>{{ $inquiry->code ?: 'کد استعلام ثبت نشده' }} · ثبت در {{ \App\Support\CustomerPortalPresenter::date($inquiry->created_at) }}</p></div></div>
        <span class="status-badge status-{{ $status['tone'] }}">{{ $status['label'] }}</span>
    </section>

    <div class="detail-grid">
        <div>
            <section class="detail-panel">
                <header class="detail-panel-head"><span><x-portal.icon name="box" /></span><h3>مشخصات درخواست حمل</h3></header>
                <div class="spec-grid">
                    <div class="spec-item"><small>نوع حمل</small><strong>{{ \App\Support\CustomerPortalPresenter::shippingMode($inquiry->shipping_mode) }}</strong></div>
                    <div class="spec-item"><small>نوع سرویس</small><strong>{{ $inquiry->service_type ?: '—' }}</strong></div>
                    <div class="spec-item"><small>نوع کالا</small><strong>{{ $inquiry->cargo_type ?: '—' }}</strong></div>
                    <div class="spec-item"><small>وزن</small><strong>{{ $inquiry->weight ? number_format((float) $inquiry->weight).' کیلوگرم' : '—' }}</strong></div>
                    <div class="spec-item"><small>حجم کل</small><strong>{{ $inquiry->total_volume ? number_format((float) $inquiry->total_volume, 2).' CBM' : ($inquiry->volume_cbm ?: '—') }}</strong></div>
                    <div class="spec-item"><small>تعداد</small><strong>{{ $inquiry->quantity ? number_format($inquiry->quantity) : '—' }}</strong></div>
                    <div class="spec-item"><small>اینکوترمز</small><strong>{{ $inquiry->shipping_term ?: '—' }}</strong></div>
                    <div class="spec-item"><small>کد HS</small><strong>{{ $inquiry->hs_code ?: '—' }}</strong></div>
                    <div class="spec-item"><small>خدمات جانبی</small><strong>{{ collect([$inquiry->need_clearance ? 'ترخیص' : null, $inquiry->need_warehousing ? 'انبارداری' : null])->filter()->join('، ') ?: 'درخواستی ثبت نشده' }}</strong></div>
                </div>
                @if($inquiry->description)
                    <div class="profile-notice"><x-portal.icon name="inquiries" /><span><strong>توضیحات درخواست:</strong> {{ $inquiry->description }}</span></div>
                @endif
            </section>

            <section class="detail-panel">
                <header class="detail-panel-head"><span><x-portal.icon name="route" /></span><h3>مسیرهای حمل</h3></header>
                @if($routes->isNotEmpty())
                    <div class="route-list">
                        @foreach($routes as $index => $route)
                            @php
                                $origin = data_get($route, 'origin_city') ?: data_get($route, 'origin') ?: data_get($route, 'from') ?: 'مبدأ نامشخص';
                                $destination = data_get($route, 'destination_city') ?: data_get($route, 'destination') ?: data_get($route, 'to') ?: 'مقصد نامشخص';
                            @endphp
                            <div class="route-row"><span class="route-index">{{ $index + 1 }}</span><p><strong>{{ $origin }}</strong><small>مبدأ مسیر</small></p><span class="route-arrow"><x-portal.icon name="arrow-left" /></span><p><strong>{{ $destination }}</strong><small>مقصد مسیر</small></p></div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state"><span><x-portal.icon name="route" /></span><strong>مسیر تفصیلی ثبت نشده</strong><p>اطلاعات مسیر پس از تکمیل بررسی عملیاتی نمایش داده می‌شود.</p></div>
                @endif
            </section>
        </div>

        <aside>
            <section class="detail-panel side-summary">
                <header class="detail-panel-head"><span><x-portal.icon name="dashboard" /></span><h3>خلاصه پرونده</h3></header>
                <div class="summary-list">
                    <div class="summary-row"><span>وضعیت استعلام</span><strong><span class="status-badge status-{{ $status['tone'] }}">{{ $status['label'] }}</span></strong></div>
                    <div class="summary-row"><span>وضعیت بوکینگ</span><strong>{{ $inquiry->booking ? $bookingStatus['label'] : 'هنوز ایجاد نشده' }}</strong></div>
                    <div class="summary-row"><span>تاریخ ثبت</span><strong>{{ \App\Support\CustomerPortalPresenter::date($inquiry->created_at) }}</strong></div>
                    <div class="summary-row"><span>مبلغ تقریبی</span><strong>{{ $inquiry->approximate_amount ? number_format((float) $inquiry->approximate_amount).' ریال' : 'در انتظار قیمت‌گذاری' }}</strong></div>
                    <div class="summary-row"><span>تعداد محموله</span><strong>{{ $inquiry->booking?->shipments?->count() ?: 0 }} مورد</strong></div>
                </div>
                @if($inquiry->booking?->shipments?->isNotEmpty())
                    <a class="side-action" href="{{ route('portal.shipments.show', $inquiry->booking->shipments->first()) }}"><x-portal.icon name="shipments" />مشاهده رهگیری محموله</a>
                @endif
            </section>
        </aside>
    </div>
@endsection
