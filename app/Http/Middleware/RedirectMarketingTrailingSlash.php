<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectMarketingTrailingSlash
{
    public function handle(Request $request, Closure $next): Response
    {
        $requestUri = $request->server->get('REQUEST_URI', '');
        $path = parse_url($requestUri, PHP_URL_PATH) ?: $request->getPathInfo();

        if (($request->isMethod('GET') || $request->isMethod('HEAD'))
            && $path !== '/'
            && str_ends_with($path, '/')) {
            $canonicalPath = rtrim($path, '/');
            $queryString = $request->getQueryString();

            return redirect()->to(
                $canonicalPath.($queryString ? '?'.$queryString : ''),
                Response::HTTP_MOVED_PERMANENTLY
            );
        }

        return $next($request);
    }
}
