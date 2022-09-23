<?php

namespace App\Http\Middleware;

use App\Models\MobileApplication;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class ApplicationConfirmation
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
        if (Auth::check()) {
            $mobile_application = MobileApplication::where('customer_id', Auth::guard('api')->id())->first();
            if ($mobile_application !== null){
                return $next($request);
            } else {
                return Response::json(['status' => 404, 'message' => 'User Not found']);
            }
        }
        return Response::json(['status' => 401, 'message' => 'User Not Login']);

    }
}
