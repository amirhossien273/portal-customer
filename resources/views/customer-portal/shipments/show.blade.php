@extends('layouts.customer-portal')

@section('title', 'رهگیری محموله')
@section('eyebrow', 'محموله‌ها و رهگیری')
@section('page-title', $shipment->job?->code ?: $shipment->booking?->code ?: 'جزئیات محموله')

@section('content')
    @php
        $origin = \App\Support\CustomerPortalPresenter::routePoint([$shipment->origin_city, $shipment->origin_port, $shipment->origin_country], 'مبدأ نامشخص');
        $destination = \App\Support\CustomerPortalPresenter::routePoint([$shipment->destination_city, $shipment->destination_port, $shipment->destination_country], 'مقصد نامشخص');
        $latest = $shipment->visibleTrackings->last();
        $latestStatus = \App\Support\CustomerPortalPresenter::trackingStatus($latest?->status);
    @endphp
    <nav class="breadcrumb"><a href="{{ route('portal.shipments.index') }}">محموله‌ها</a><x-portal.icon name="chevron-left" /><span>{{ $shipment->job?->code ?: $shipment->booking?->code ?: 'جزئیات رهگیری' }}</span></nav>

    <section class="tracking-route">
        <div class="tracking-locations">
            <div class="tracking-location"><small>مبدأ محموله</small><strong>{{ $origin }}</strong></div>
            <div class="tracking-line"><span><x-portal.icon name="shipments" /></span></div>
            <div class="tracking-location"><small>مقصد محموله</small><strong>{{ $destination }}</strong></div>
        </div>
        <div class="tracking-meta">
            <span><x-portal.icon name="box" />{{ $shipment->service_name ?: 'سرویس ثبت نشده' }}</span>
            <span><x-portal.icon name="calendar" />حرکت: {{ \App\Support\CustomerPortalPresenter::date($shipment->departure_date) }}</span>
            <span><x-portal.icon name="inquiries" />استعلام: {{ $shipment->booking?->transaction?->code ?: '—' }}</span>
            <span><x-portal.icon name="route" />آخرین وضعیت: {{ $latestStatus['label'] }}</span>
        </div>
    </section>

    <div class="detail-grid" style="margin-top:17px">
        <section class="detail-panel">
            <header class="detail-panel-head"><span><x-portal.icon name="route" /></span><h3>تایم‌لاین رهگیری محموله</h3></header>
            @if($shipment->visibleTrackings->isNotEmpty())
                <div class="timeline">
                    @foreach($shipment->visibleTrackings->sortByDesc(fn ($event) => $event->event_time ?? $event->created_at) as $event)
                        @php
                            $eventStatus = \App\Support\CustomerPortalPresenter::trackingStatus($event->status);
                        @endphp
                        <article class="timeline-event is-{{ $event->status }}">
                            <span class="timeline-marker"><x-portal.icon name="{{ $event->status === 'completed' ? 'check' : 'clock' }}" /></span>
                            <div class="timeline-card">
                                <header class="timeline-head"><div><h4>{{ $event->event_title }}</h4><small>{{ $event->event_code ?: 'رویداد عملیاتی' }}</small></div><span class="status-badge status-{{ $eventStatus['tone'] }}">{{ $eventStatus['label'] }}</span></header>
                                <div class="timeline-body">
                                    <div><small>موقعیت</small><strong>{{ \App\Support\CustomerPortalPresenter::routePoint([$event->location, $event->country]) }}</strong></div>
                                    <div><small>زمان رویداد</small><strong>{{ \App\Support\CustomerPortalPresenter::date($event->event_time, true) }}</strong></div>
                                    <div><small>زمان مورد انتظار</small><strong>{{ \App\Support\CustomerPortalPresenter::date($event->expected_time, true) }}</strong></div>
                                </div>
                                @if($event->event_description)<p class="timeline-note">{{ $event->event_description }}</p>@endif
                                @if($event->status === 'delayed' && $event->delay_days)<p class="timeline-note" style="color:var(--danger)">میزان تأخیر ثبت‌شده: {{ $event->delay_days }} روز</p>@endif
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="empty-state"><span><x-portal.icon name="clock" /></span><strong>هنوز رویدادی برای مشتری منتشر نشده است</strong><p>رویدادهای عملیاتی پس از تأیید تیم سپند در این تایم‌لاین نمایش داده می‌شوند.</p></div>
            @endif
        </section>

        <aside>
            <section class="detail-panel side-summary">
                <header class="detail-panel-head"><span><x-portal.icon name="shipments" /></span><h3>مشخصات محموله</h3></header>
                <div class="summary-list">
                    <div class="summary-row"><span>کد عملیات</span><strong dir="ltr">{{ $shipment->job?->code ?: '—' }}</strong></div>
                    <div class="summary-row"><span>کد بوکینگ</span><strong dir="ltr">{{ $shipment->booking?->code ?: '—' }}</strong></div>
                    <div class="summary-row"><span>نوع سرویس</span><strong>{{ $shipment->service_name ?: '—' }}</strong></div>
                    <div class="summary-row"><span>تاریخ حرکت</span><strong>{{ \App\Support\CustomerPortalPresenter::date($shipment->departure_date) }}</strong></div>
                    <div class="summary-row"><span>تعداد رویداد قابل مشاهده</span><strong>{{ $shipment->visibleTrackings->count() }} رویداد</strong></div>
                    <div class="summary-row"><span>آخرین وضعیت</span><strong><span class="status-badge status-{{ $latestStatus['tone'] }}">{{ $latestStatus['label'] }}</span></strong></div>
                </div>
                @if($shipment->booking?->transaction)
                    <a class="side-action" href="{{ route('portal.inquiries.show', $shipment->booking->transaction) }}"><x-portal.icon name="inquiries" />مشاهده استعلام مرتبط</a>
                @endif
            </section>
        </aside>
    </div>
@endsection
