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
        View::share('portalPersonal', $personal);
        View::share('portalCustomer', $personal->customer);

        return $next($request);
    }
}
