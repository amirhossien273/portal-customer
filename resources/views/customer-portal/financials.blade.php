@extends('layouts.customer-portal')

@section('title', 'امور مالی')
@section('eyebrow', 'صورتحساب‌ها و پرداخت‌ها')
@section('page-title', 'امور مالی')

@section('content')
    <section class="finance-stats">
        <article class="money-card"><span><i><x-portal.icon name="financials" /></i>جمع صورتحساب‌های صادرشده</span><strong>{{ number_format((float) $stats['invoiced']) }} <small>ریال</small></strong></article>
        <article class="money-card"><span><i><x-portal.icon name="check" /></i>مبلغ پرداخت‌شده</span><strong>{{ number_format((float) $stats['paid']) }} <small>ریال</small></strong></article>
        <article class="money-card"><span><i><x-portal.icon name="clock" /></i>رسیدهای در انتظار بررسی</span><strong>{{ $stats['pendingReceipts'] }} <small>رسید</small></strong></article>
    </section>

    <section class="tabs" data-tabs>
        <nav class="tab-nav" aria-label="بخش‌های مالی">
            <button class="is-active" type="button" data-tab-target="invoices">صورتحساب‌ها ({{ $invoices->count() }})</button>
            <button type="button" data-tab-target="receipts">رسیدهای دریافتی ({{ $receipts->count() }})</button>
        </nav>

        <div data-tab-panel="invoices">
            @if($invoices->isNotEmpty())
                <table class="data-table">
                    <thead><tr><th>شماره صورتحساب</th><th>تاریخ</th><th>مبلغ قابل پرداخت</th><th>روش پرداخت</th><th>وضعیت</th></tr></thead>
                    <tbody>
                    @foreach($invoices as $invoice)
                        @php
                            $status = \App\Support\CustomerPortalPresenter::invoiceStatus($invoice->status);
                        @endphp
                        <tr><td><div class="table-primary"><span><x-portal.icon name="financials" /></span><p><strong>{{ $invoice->invoice_number ?: 'پیش‌فاکتور' }}</strong><small>{{ $invoice->proforma_invoice_number }}</small></p></div></td><td data-label="تاریخ:">{{ \App\Support\CustomerPortalPresenter::date($invoice->proforma_at ?: $invoice->created_at) }}</td><td data-label="مبلغ:">{{ number_format((float) $invoice->payable_amount) }} ریال</td><td data-label="روش:">{{ ['cash' => 'نقدی', 'card' => 'کارت', 'online' => 'آنلاین'][$invoice->payment_type] ?? '—' }}</td><td data-label="وضعیت:"><span class="status-badge status-{{ $status['tone'] }}">{{ $status['label'] }}</span></td></tr>
                    @endforeach
                    </tbody>
                </table>
            @else<div class="empty-state"><span><x-portal.icon name="financials" /></span><strong>صورتحسابی صادر نشده است</strong><p>صورتحساب‌های مرتبط با حساب شما پس از صدور در این بخش نمایش داده می‌شوند.</p></div>@endif
        </div>

        <div data-tab-panel="receipts" hidden>
            @if($receipts->isNotEmpty())
                <table class="data-table"><thead><tr><th>کد رسید</th><th>تاریخ ثبت</th><th>بابت</th><th>مبلغ</th><th>وضعیت</th></tr></thead><tbody>
                @foreach($receipts as $receipt)
                    @php
                        $tone = ['approved' => 'success', 'rejected' => 'danger'][$receipt->status] ?? 'warning';
                        $label = ['approved' => 'تأییدشده', 'rejected' => 'ردشده'][$receipt->status] ?? 'در انتظار بررسی';
                    @endphp
                    <tr><td><div class="table-primary"><span><x-portal.icon name="money" /></span><p><strong>{{ $receipt->code ?: 'رسید پرداخت' }}</strong><small>{{ $receipt->invoice_number ?: 'بدون شماره فاکتور' }}</small></p></div></td><td data-label="تاریخ:">{{ \App\Support\CustomerPortalPresenter::date($receipt->created_at) }}</td><td data-label="بابت:">{{ $receipt->purpose }}</td><td data-label="مبلغ:">{{ number_format((float) $receipt->amount) }} ریال</td><td data-label="وضعیت:"><span class="status-badge status-{{ $tone }}">{{ $label }}</span></td></tr>
                @endforeach</tbody></table>
            @else<div class="empty-state"><span><x-portal.icon name="money" /></span><strong>رسیدی ثبت نشده است</strong><p>سوابق رسیدهای پرداخت مرتبط با پرونده‌های شما اینجا نمایش داده می‌شود.</p></div>@endif
        </div>
    </section>
@endsection
