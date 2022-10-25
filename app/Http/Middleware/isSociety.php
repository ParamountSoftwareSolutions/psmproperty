<?php

namespace App\Http\Middleware;

use App\Helpers\Attendance;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isSociety
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->hasRole('society')){
            Attendance::checkIn();
            return $next($request);
        }
        return redirect()->guest('/');
    }
}
