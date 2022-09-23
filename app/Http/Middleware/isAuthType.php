<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isAuthType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->hasRole('property_admin')){
            return $next($request);
        } elseif(Auth::user()->hasRole('property_manager')){
            return $next($request);
        } elseif(Auth::user()->hasRole('sale_manager')){
            return $next($request);
        } elseif(Auth::user()->hasRole('sale_person')){
            return $next($request);
        }
        return redirect()->guest('/');
    }
}
