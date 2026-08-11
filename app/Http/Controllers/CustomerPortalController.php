<?php

namespace App\Http\Controllers;

use App\Models\Crm\Customer;
use App\Repositories\CustomerPortalRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerPortalController extends Controller
{
    public function __construct(private readonly CustomerPortalRepository $portal)
    {
    }

    public function dashboard(Request $request): View
    {
        return view('customer-portal.dashboard', $this->portal->dashboard($this->customer($request)));
    }

    public function inquiries(Request $request): View
    {
        return view('customer-portal.inquiries.index', [
            'inquiries' => $this->portal->inquiries(
                $this->customer($request),
                $request->string('status')->toString(),
                $request->string('q')->toString(),
            ),
        ]);
    }

    public function inquiry(Request $request, string $inquiry): View
    {
        return view('customer-portal.inquiries.show', [
            'inquiry' => $this->portal->inquiry($this->customer($request), $inquiry),
        ]);
    }

    public function shipments(Request $request): View
    {
        return view('customer-portal.shipments.index', [
            'shipments' => $this->portal->shipments(
                $this->customer($request),
                $request->string('q')->toString(),
            ),
        ]);
    }

    public function shipment(Request $request, string $shipment): View
    {
        return view('customer-portal.shipments.show', [
            'shipment' => $this->portal->shipment($this->customer($request), $shipment),
        ]);
    }

    public function financials(Request $request): View
    {
        return view('customer-portal.financials', $this->portal->financials($this->customer($request)));
    }

    public function profile(Request $request): View
    {
        return view('customer-portal.profile', [
            'customer' => $this->customer($request)->load('personals'),
        ]);
    }

    private function customer(Request $request): Customer
    {
        return $request->attributes->get('portalCustomer');
    }
}
