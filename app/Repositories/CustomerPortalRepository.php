<?php

namespace App\Repositories;

use App\Models\Crm\Customer;
use App\Models\Crm\CustomerPersonal;
use App\Models\Crm\Inquiry;
use App\Models\Crm\Invoice;
use App\Models\Crm\Receipt;
use App\Models\Crm\Shipment;
use App\Models\Crm\Tracking;
use App\Support\MobileNumber;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class CustomerPortalRepository
{
    public function findPersonalByMobile(string $mobile): ?CustomerPersonal
    {
        return CustomerPersonal::query()
            ->with('customer')
            ->where('tenant_id', $this->tenantId())
            ->where(function ($query) use ($mobile): void {
                $variants = MobileNumber::databaseVariants($mobile);
                $normalizedColumn = "REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(mobile, ' ', ''), '-', ''), '(', ''), ')', ''), '.', '')";

                $query->whereIn('mobile', $variants)
                    ->orWhereIn(DB::raw($normalizedColumn), $variants);
            })
            ->whereHas('customer', fn ($query) => $query
                ->where('tenant_id', $this->tenantId())
                ->where('status', 'actual'))
            ->oldest('created_at')
            ->first();
    }

    public function authenticatedPersonal(array $identity): ?CustomerPersonal
    {
        return CustomerPersonal::query()
            ->with('customer')
            ->whereKey($identity['personal_id'] ?? null)
            ->where('customer_id', $identity['customer_id'] ?? null)
            ->where('tenant_id', $identity['tenant_id'] ?? null)
            ->whereHas('customer', fn ($query) => $query
                ->where('tenant_id', $identity['tenant_id'] ?? null)
                ->where('status', 'actual'))
            ->first();
    }

    /** @return array<string, mixed> */
    public function dashboard(Customer $customer): array
    {
        $inquiries = $this->inquiryQuery($customer);
        $shipments = $this->shipmentQuery($customer);

        return [
            'stats' => [
                'inquiries' => (clone $inquiries)->count(),
                'open_inquiries' => (clone $inquiries)->whereIn('status', ['running', 'proforma_invoice'])->count(),
                'shipments' => (clone $shipments)->count(),
                'active_shipments' => (clone $shipments)
                    ->whereHas('booking', fn ($query) => $query->whereIn('status', ['draft', 'pending', 'operational']))
                    ->count(),
            ],
            'recentInquiries' => (clone $inquiries)
                ->with('booking')
                ->latest('created_at')
                ->limit(5)
                ->get(),
            'activeShipments' => (clone $shipments)
                ->with(['booking.transaction', 'job', 'latestVisibleTracking'])
                ->latest('created_at')
                ->limit(4)
                ->get(),
            'recentTrackings' => Tracking::query()
                ->where('tenant_id', $customer->tenant_id)
                ->where('is_customer_visible', true)
                ->whereHas('shipment.booking', fn ($query) => $query
                    ->where('customer_id', $customer->getKey())
                    ->where('tenant_id', $customer->tenant_id))
                ->with('shipment')
                ->latest('event_time')
                ->limit(5)
                ->get(),
        ];
    }

    public function inquiries(Customer $customer, ?string $status, ?string $search): LengthAwarePaginator
    {
        return $this->inquiryQuery($customer)
            ->with('booking')
            ->when(in_array($status, ['running', 'success', 'failed', 'proforma_invoice'], true),
                fn ($query) => $query->where('status', $status))
            ->when(filled($search), function ($query) use ($search): void {
                $term = '%'.trim((string) $search).'%';
                $query->where(fn ($nested) => $nested
                    ->where('code', 'like', $term)
                    ->orWhere('name', 'like', $term)
                    ->orWhere('cargo_type', 'like', $term));
            })
            ->latest('created_at')
            ->paginate(10)
            ->withQueryString();
    }

    public function inquiry(Customer $customer, string $id): Inquiry
    {
        return $this->inquiryQuery($customer)
            ->with(['booking.shipments.job', 'booking.shipments.latestVisibleTracking'])
            ->findOrFail($id);
    }

    public function shipments(Customer $customer, ?string $search): LengthAwarePaginator
    {
        return $this->shipmentQuery($customer)
            ->with(['booking.transaction', 'job', 'latestVisibleTracking'])
            ->when(filled($search), function ($query) use ($search): void {
                $term = '%'.trim((string) $search).'%';
                $query->where(fn ($nested) => $nested
                    ->where('service_name', 'like', $term)
                    ->orWhere('origin_city', 'like', $term)
                    ->orWhere('origin_port', 'like', $term)
                    ->orWhere('destination_city', 'like', $term)
                    ->orWhere('destination_port', 'like', $term)
                    ->orWhereHas('job', fn ($job) => $job->where('code', 'like', $term))
                    ->orWhereHas('booking', fn ($booking) => $booking->where('code', 'like', $term)));
            })
            ->latest('created_at')
            ->paginate(8)
            ->withQueryString();
    }

    public function shipment(Customer $customer, string $id): Shipment
    {
        return $this->shipmentQuery($customer)
            ->with(['booking.transaction', 'job', 'visibleTrackings'])
            ->findOrFail($id);
    }

    /** @return array<string, mixed> */
    public function financials(Customer $customer): array
    {
        $invoices = Invoice::query()
            ->where('tenant_id', $customer->tenant_id)
            ->where('customer_id', $customer->getKey())
            ->whereIn('status', ['issued', 'sent', 'paid', 'cancelled']);
        $receipts = Receipt::query()
            ->where('tenant_id', $customer->tenant_id)
            ->where('customer_id', $customer->getKey());

        return [
            'stats' => [
                'invoiced' => (clone $invoices)->whereNotIn('status', ['draft', 'cancelled'])->sum('payable_amount'),
                'paid' => (clone $invoices)->where('status', 'paid')->sum('payable_amount'),
                'pendingReceipts' => (clone $receipts)->where('status', 'pending')->count(),
            ],
            'invoices' => (clone $invoices)->latest('created_at')->limit(30)->get(),
            'receipts' => (clone $receipts)->latest('created_at')->limit(20)->get(),
        ];
    }

    private function inquiryQuery(Customer $customer)
    {
        return Inquiry::query()
            ->where('tenant_id', $customer->tenant_id)
            ->where('customer_id', $customer->getKey());
    }

    private function shipmentQuery(Customer $customer)
    {
        return Shipment::query()
            ->where('tenant_id', $customer->tenant_id)
            ->whereHas('booking', fn ($query) => $query
                ->where('tenant_id', $customer->tenant_id)
                ->where('customer_id', $customer->getKey()));
    }

    private function tenantId(): string
    {
        return (string) config('customer_portal.tenant_id');
    }
}
