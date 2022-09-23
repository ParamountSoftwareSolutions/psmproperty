<?php


namespace App\Helpers;


use App\Models\BuildingCustomer;
use App\Models\BuildingMobileApplication;
use Illuminate\Support\Facades\Auth;

class AppHelpers
{
    public function user_login_route($app_key = null)
    {
        $app_key = BuildingMobileApplication::where('app_key', $app_key)->first();
        return $app_key;
    }
}
