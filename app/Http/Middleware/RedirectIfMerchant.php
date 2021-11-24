<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfMerchant
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'merchant')
    {
        if (Auth::guard($guard)->check()) {
            return redirect(RouteServiceProvider::MERCHANT_HOME);
        }

        return $next($request);
    }
}
