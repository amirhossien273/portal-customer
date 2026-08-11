@extends('layouts.customer-portal')

@section('title', 'استعلام‌های من')
@section('eyebrow', 'درخواست‌های حمل')
@section('page-title', 'استعلام‌های من')

@section('content')
    <section class="page-toolbar">
        <form class="filter-form" method="GET" action="{{ route('portal.inquiries.index') }}">
            <div class="search-box"><x-portal.icon name="search" /><input name="q" value="{{ request('q') }}" placeholder="جست‌وجو با کد، عنوان یا نوع کالا"></div>
            <select class="filter-select" name="status" data-auto-submit aria-label="فیلتر وضعیت">
                <option value="">همه وضعیت‌ها</option>
                <option value="running" @selected(request('status') === 'running')>در حال بررسی</option>
                <option value="proforma_invoice" @selected(request('status') === 'proforma_invoice')>پیش‌فاکتور</option>
                <option value="success" @selected(request('status') === 'success')>نهایی‌شده</option>
                <option value="failed" @selected(request('status') === 'failed')>بسته‌شده</option>
            </select>
            <button class="filter-button" type="submit">جست‌وجو</button>
        </form>
        <span class="result-count"><strong>{{ $inquiries->total() }}</strong> استعلام پیدا شد</span>
    </section>

    <section class="list-panel">
        @if($inquiries->isNotEmpty())
            <table class="data-table">
                <thead><tr><th>عنوان و کد استعلام</th><th>تاریخ ثبت</th><th>نوع حمل</th><th>کالا / وزن</th><th>وضعیت</th><th></th></tr></thead>
                <tbody>
                @foreach($inquiries as $inquiry)
                    @php
                        $status = \App\Support\CustomerPortalPresenter::inquiryStatus($inquiry->status);
                    @endphp
                    <tr>
                        <td><div class="table-primary"><span><x-portal.icon name="inquiries" /></span><p><strong>{{ $inquiry->name }}</strong><small>{{ $inquiry->code ?: 'بدون کد استعلام' }}</small></p></div></td>
                        <td data-label="تاریخ:">{{ \App\Support\CustomerPortalPresenter::date($inquiry->created_at) }}</td>
                        <td data-label="حمل:">{{ \App\Support\CustomerPortalPresenter::shippingMode($inquiry->shipping_mode) }}</td>
                        <td data-label="محموله:">{{ $inquiry->cargo_type ?: '—' }} @if($inquiry->weight) · {{ number_format((float) $inquiry->weight) }} کیلو @endif</td>
                        <td data-label="وضعیت:"><span class="status-badge status-{{ $status['tone'] }}">{{ $status['label'] }}</span></td>
                        <td><a class="row-link" href="{{ route('portal.inquiries.show', $inquiry) }}" aria-label="نمایش جزئیات"><x-portal.icon name="chevron-left" /></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @include('customer-portal.partials.pagination', ['paginator' => $inquiries])
        @else
            <div class="empty-state"><span><x-portal.icon name="empty" /></span><strong>استعلامی مطابق جست‌وجوی شما پیدا نشد</strong><p>فیلترها را تغییر دهید یا عبارت جست‌وجوی ساده‌تری وارد کنید.</p></div>
        @endif
    </section>
@endsection
