<?php

namespace App\Http\Middleware;

use App\Repositories\CustomerPortalRepository;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class EnsureCustomerPortalAuthenticated
{
    public function __construct(private readonly CustomerPortalRepository $customers)
    {
    }

    public function handle(Request $request, Closure $next): Response
    {
        $identity = $request->session()->get('customer_portal');

        if (! is_array($identity) || ! $personal = $this->customers->authenticatedPersonal($identity)) {
            $request->session()->forget('customer_portal');

            return redirect()->guest(route('login'))
                ->with('auth_error', 'برای مشاهده این صفحه ابتدا وارد پورتال شوید.');
        }

        $request->attributes->set('portalPersonal', $personal);
        $request->attributes->set('portalCustomer', $personal->customer);
        $accounts = collect($request->session()->get('customer_portal_accounts', []))
            ->filter(fn ($account): bool => is_array($account))
            ->values();

        if ($accounts->isEmpty()) {
            $accounts = collect([$this->customers->accountSummary($personal)]);
            $request->session()->put('customer_portal_accounts', $accounts->all());
        }

        $activeAccount = $accounts->first(fn (array $account): bool =>
            (string) ($account['personal_id'] ?? '') === (string) $personal->getKey())
            ?? $this->customers->accountSummary($personal);

        View::share('portalPersonal', $personal);
        View::share('portalCustomer', $personal->customer);
        View::share('portalAccounts', $accounts);
        View::share('portalActiveAccount', $activeAccount);

        return $next($request);
    }
}
