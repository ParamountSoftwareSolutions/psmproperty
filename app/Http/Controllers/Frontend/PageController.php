<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\BuildingPrivacyPolicie;
use App\Models\BuildingMobileApplication;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function privacy_policy($key)
    {
        $property_admin_id = BuildingMobileApplication::where('app_key',$key)->first()->property_admin_id;
        $privacyPolicy = BuildingPrivacyPolicie::where('property_admin_id', $property_admin_id)->get();
        return view('property_manager.privacyPolicy.privacy-policy', compact('privacyPolicy'));
    }
}
