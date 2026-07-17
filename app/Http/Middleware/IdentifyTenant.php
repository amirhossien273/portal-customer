<?php

namespace App\Http\Middleware;

use App\Tenancy\TenantContext;
use App\Tenancy\TenantResolver;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IdentifyTenant
{
    public function __construct(
        private readonly TenantResolver $resolver,
        private readonly TenantContext $context
    ) {}

    public function handle(Request $request, Closure $next): Response
    {
        $tenant = $this->resolver->resolve($request->getHost());

        abort_if($tenant === null, 404, 'Tenant not found.');

        $this->context->set($tenant);
        $request->attributes->set('tenant', $tenant);

        try {
            return $next($request);
        } finally {
            $this->context->forget();
        }
    }
}
