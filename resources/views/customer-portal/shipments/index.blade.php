@extends('layouts.customer-portal')

@section('title', 'محموله‌ها و رهگیری')
@section('eyebrow', 'عملیات حمل')
@section('page-title', 'محموله‌ها و رهگیری')

@section('content')
    <section class="page-toolbar">
        <form class="filter-form" method="GET" action="{{ route('portal.shipments.index') }}">
            <div class="search-box"><x-portal.icon name="search" /><input name="q" value="{{ request('q') }}" placeholder="جست‌وجو با کد، سرویس، مبدأ یا مقصد"></div>
            <button class="filter-button" type="submit">جست‌وجو</button>
        </form>
        <span class="result-count"><strong>{{ $shipments->total() }}</strong> محموله در حساب شما</span>
    </section>

    @if($shipments->isNotEmpty())
        <div class="shipment-grid">
            @foreach($shipments as $shipment)
                @php
                    $origin = \App\Support\CustomerPortalPresenter::routePoint([$shipment->origin_city, $shipment->origin_port, $shipment->origin_country], 'مبدأ نامشخص');
                    $destination = \App\Support\CustomerPortalPresenter::routePoint([$shipment->destination_city, $shipment->destination_port, $shipment->destination_country], 'مقصد نامشخص');
                    $trackingStatus = \App\Support\CustomerPortalPresenter::trackingStatus($shipment->latestVisibleTracking?->status);
                @endphp
                <article class="shipment-card">
                    <div class="shipment-card-head">
                        <span class="shipment-card-icon"><x-portal.icon name="shipments" /></span>
                        <p class="shipment-card-title"><strong>{{ $shipment->service_name ?: 'محموله حمل‌ونقل' }}</strong><small>{{ $shipment->job?->code ?: $shipment->booking?->code ?: 'بدون کد عملیاتی' }}</small></p>
                        <span class="status-badge status-{{ $trackingStatus['tone'] }}">{{ $trackingStatus['label'] }}</span>
                    </div>
                    <div class="shipment-route"><p class="route-city"><strong>{{ $origin }}</strong><small>مبدأ</small></p><span class="route-flight"><x-portal.icon name="route" /></span><p class="route-city"><strong>{{ $destination }}</strong><small>مقصد</small></p></div>
                    <footer class="shipment-card-foot">
                        <span><x-portal.icon name="clock" />{{ $shipment->latestVisibleTracking ? \App\Support\CustomerPortalPresenter::date($shipment->latestVisibleTracking->event_time, true) : 'در انتظار اولین رویداد' }}</span>
                        <a href="{{ route('portal.shipments.show', $shipment) }}">مشاهده تایم‌لاین <x-portal.icon name="chevron-left" /></a>
                    </footer>
                </article>
            @endforeach
        </div>
        @include('customer-portal.partials.pagination', ['paginator' => $shipments])
    @else
        <section class="panel"><div class="empty-state"><span><x-portal.icon name="shipments" /></span><strong>محموله‌ای پیدا نشد</strong><p>اگر از جست‌وجو استفاده کرده‌اید، عبارت دیگری امتحان کنید. محموله‌های عملیاتی جدید به‌صورت خودکار اینجا ظاهر می‌شوند.</p></div></section>
    @endif
@endsection
