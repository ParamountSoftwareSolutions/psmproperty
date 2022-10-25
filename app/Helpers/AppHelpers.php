<?php


namespace App\Helpers;

use App\Models\Building;
use App\Models\BuildingAssignUser;
use App\Models\BuildingCustomer;
use App\Models\BuildingMobileApplication;
use Illuminate\Support\Facades\Auth;

class AppHelpers
{
    public static function user_login_route($app_key = null)
    {
        $app_key = BuildingMobileApplication::where('app_key', $app_key)->first();
        return $app_key;
    }

    public static function user_admin()
    {
        $admin = BuildingCustomer::where('customer_id', Auth::guard('api')->id())->first()->property_admin_id;
        return $admin;
    }

    public static function app()
    {
        $admin = AppHelpers::user_admin();
        $app = BuildingMobileApplication::where('property_admin_id', $admin)->first();
        return $app;
    }

    public static function building_assign_user()
    {
        $building_assign_user = BuildingAssignUser::where('user_id', AppHelpers::user_admin())->get();
        return $building_assign_user;
    }

    public static function building_detail()
    {
        $building_assign_user = AppHelpers::building_assign_user();
        $building = Building::with('building_detail', 'building_images')->whereIn('id', $building_assign_user->pluck('building_id')->toArray())->get();
        return $building;
    }

    public static function building_detail_single($id)
    {
        $building_assign_user = AppHelpers::building_assign_user();
        $building = Building::with('building_detail', 'building_images')->whereIn('id', $building_assign_user->pluck('building_id')->toArray())->findOrFail($id);
        return $building;
    }

    public static function gust_building_assign_user($app_key)
    {
        $app = BuildingMobileApplication::where('app_key', $app_key)->first();
        $building_assign_user = BuildingAssignUser::where('user_id', $app->property_admin_id)->get();
        return $building_assign_user;
    }

    public static function gust_building_detail($app_key)
    {
        $building_assign_user = AppHelpers::gust_building_assign_user($app_key);
        $building = Building::with('building_detail', 'building_images')->whereIn('id', $building_assign_user->pluck('building_id')->toArray())->get();
        return $building;
    }

    public static function gust_building_detail_single($app_key, $id)
    {
        $building_assign_user = AppHelpers::gust_building_assign_user($app_key);
        $building = Building::with('building_detail', 'building_images')->whereIn('id', $building_assign_user->pluck('building_id')->toArray())->findOrFail($id);
        return $building;
    }

}
