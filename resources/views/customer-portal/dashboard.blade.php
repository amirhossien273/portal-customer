@extends('layouts.customer-portal')

@section('title', 'نمای کلی')
@section('eyebrow', 'امروز در سپند')
@section('page-title', 'نمای کلی حساب')

@section('content')
    @php
        $firstName = $portalPersonal->first_name ?: $portalPersonal->full_name ?: 'همراه عزیز';
    @endphp
    <section class="welcome-panel">
        <div class="welcome-copy">
            <span><i></i>مرکز کنترل حمل‌ونقل شما</span>
            <h2>{{ $firstName }}، سلام!</h2>
            <p>از اینجا می‌توانید آخرین وضعیت استعلام‌ها، رزروها و رویدادهای قابل‌نمایش محموله‌های خود را یک‌جا دنبال کنید.</p>
        </div>
        <a class="welcome-action" href="{{ route('portal.shipments.index') }}">
            <span><x-portal.icon name="shipments" /></span>
            <p><strong>رهگیری محموله‌ها</strong><small>{{ $stats['active_shipments'] }} محموله فعال دارید</small></p>
            <x-portal.icon name="chevron-left" />
        </a>
    </section>

    <section class="stats-grid" aria-label="خلاصه وضعیت حساب">
        <article class="stat-card is-blue"><span class="stat-icon"><x-portal.icon name="inquiries" /></span><p><small>کل استعلام‌ها</small><strong>{{ $stats['inquiries'] }} <em>مورد</em></strong></p></article>
        <article class="stat-card is-gold"><span class="stat-icon"><x-portal.icon name="clock" /></span><p><small>در حال بررسی</small><strong>{{ $stats['open_inquiries'] }} <em>استعلام</em></strong></p></article>
        <article class="stat-card is-teal"><span class="stat-icon"><x-portal.icon name="shipments" /></span><p><small>کل محموله‌ها</small><strong>{{ $stats['shipments'] }} <em>محموله</em></strong></p></article>
        <article class="stat-card is-green"><span class="stat-icon"><x-portal.icon name="route" /></span><p><small>محموله فعال</small><strong>{{ $stats['active_shipments'] }} <em>در مسیر</em></strong></p></article>
    </section>

    <section class="content-grid">
        <article class="panel">
            <header class="panel-head">
                <div class="panel-title"><span><x-portal.icon name="inquiries" /></span><div><h2>آخرین استعلام‌ها</h2><p>تازه‌ترین درخواست‌های ثبت‌شده شما</p></div></div>
                <a class="text-link" href="{{ route('portal.inquiries.index') }}">مشاهده همه <x-portal.icon name="arrow-left" /></a>
            </header>
            @if($recentInquiries->isNotEmpty())
                <table class="data-table">
                    <thead><tr><th>استعلام</th><th>تاریخ ثبت</th><th>نوع حمل</th><th>وضعیت</th><th></th></tr></thead>
                    <tbody>
                    @foreach($recentInquiries as $inquiry)
                        @php
                            $status = \App\Support\CustomerPortalPresenter::inquiryStatus($inquiry->status);
                        @endphp
                        <tr>
                            <td><div class="table-primary"><span><x-portal.icon name="box" /></span><p><strong>{{ $inquiry->name }}</strong><small>{{ $inquiry->code ?: 'بدون کد' }}</small></p></div></td>
                            <td data-label="ثبت:">{{ \App\Support\CustomerPortalPresenter::date($inquiry->created_at) }}</td>
                            <td data-label="روش:">{{ \App\Support\CustomerPortalPresenter::shippingMode($inquiry->shipping_mode) }}</td>
                            <td data-label="وضعیت:"><span class="status-badge status-{{ $status['tone'] }}">{{ $status['label'] }}</span></td>
                            <td><a class="row-link" href="{{ route('portal.inquiries.show', $inquiry) }}" aria-label="جزئیات استعلام"><x-portal.icon name="chevron-left" /></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state"><span><x-portal.icon name="empty" /></span><strong>هنوز استعلامی ندارید</strong><p>پس از ثبت نخستین استعلام در CRM، وضعیت آن در این بخش نمایش داده می‌شود.</p></div>
            @endif
        </article>

        <article class="panel">
            <header class="panel-head"><div class="panel-title"><span><x-portal.icon name="bell" /></span><div><h2>رویدادهای تازه</h2><p>آخرین تغییرات محموله‌ها</p></div></div></header>
            @if($recentTrackings->isNotEmpty())
                <div class="activity-list">
                    @foreach($recentTrackings as $tracking)
                        <div class="activity-item is-{{ $tracking->status }}">
                            <span class="activity-dot"><x-portal.icon name="{{ $tracking->status === 'completed' ? 'check' : 'clock' }}" /></span>
                            <div><p><strong>{{ $tracking->event_title }}</strong><small>{{ $tracking->event_description ?: 'یک رویداد جدید برای محموله ثبت شده است.' }}</small></p><div class="activity-meta"><span>{{ $tracking->location ?: $tracking->country ?: 'موقعیت ثبت نشده' }}</span><span>{{ \App\Support\CustomerPortalPresenter::date($tracking->event_time, true) }}</span></div></div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state"><span><x-portal.icon name="bell" /></span><strong>رویداد تازه‌ای نیست</strong><p>به‌محض ثبت تغییر جدید، اینجا به شما اطلاع می‌دهیم.</p></div>
            @endif
        </article>
    </section>

    <section>
        <header class="section-head"><div><h2>محموله‌های اخیر</h2><p>مسیر و آخرین رویداد محموله‌های عملیاتی</p></div><a class="text-link" href="{{ route('portal.shipments.index') }}">همه محموله‌ها <x-portal.icon name="arrow-left" /></a></header>
        @if($activeShipments->isNotEmpty())
            <div class="shipment-grid">
                @foreach($activeShipments as $shipment)
                    @php
                        $origin = \App\Support\CustomerPortalPresenter::routePoint([$shipment->origin_city, $shipment->origin_port, $shipment->origin_country], 'مبدأ نامشخص');
                        $destination = \App\Support\CustomerPortalPresenter::routePoint([$shipment->destination_city, $shipment->destination_port, $shipment->destination_country], 'مقصد نامشخص');
                        $trackingStatus = \App\Support\CustomerPortalPresenter::trackingStatus($shipment->latestVisibleTracking?->status);
                    @endphp
                    <article class="shipment-card">
                        <div class="shipment-card-head"><span class="shipment-card-icon"><x-portal.icon name="shipments" /></span><p class="shipment-card-title"><strong>{{ $shipment->service_name ?: 'محموله حمل‌ونقل' }}</strong><small>{{ $shipment->job?->code ?: $shipment->booking?->code ?: 'بدون کد عملیاتی' }}</small></p><span class="status-badge status-{{ $trackingStatus['tone'] }}">{{ $trackingStatus['label'] }}</span></div>
                        <div class="shipment-route"><p class="route-city"><strong>{{ $origin }}</strong><small>مبدأ</small></p><span class="route-flight"><x-portal.icon name="route" /></span><p class="route-city"><strong>{{ $destination }}</strong><small>مقصد</small></p></div>
                        <footer class="shipment-card-foot"><span><x-portal.icon name="clock" />{{ $shipment->latestVisibleTracking ? \App\Support\CustomerPortalPresenter::date($shipment->latestVisibleTracking->event_time, true) : 'در انتظار اولین رویداد' }}</span><a href="{{ route('portal.shipments.show', $shipment) }}">جزئیات رهگیری <x-portal.icon name="chevron-left" /></a></footer>
                    </article>
                @endforeach
            </div>
        @else
            <article class="panel"><div class="empty-state"><span><x-portal.icon name="shipments" /></span><strong>محموله‌ای برای رهگیری وجود ندارد</strong><p>محموله‌ها بعد از تبدیل استعلام موفق به بوکینگ عملیاتی در این بخش ظاهر می‌شوند.</p></div></article>
        @endif
    </section>
@endsection
