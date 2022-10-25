<?php

namespace App\Http\Controllers\Api\Building;

use App\Helpers\AppHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\BuildingResource;
use App\Models\Building;
use App\Models\BuildingCustomer;
use App\Models\BuildingProperty;
use Illuminate\Support\Facades\Auth;

class BuildingController extends Controller
{
    public function index()
    {
        $buildings = AppHelpers::building_detail();
        return BuildingResource::collection($buildings);
    }

    public function single_building($id)
    {
        $buildings = AppHelpers::building_detail_single($id);
        return new BuildingResource($buildings);
    }

    public function property()
    {
        $admin = AppHelpers::user_admin();
        $property = BuildingProperty::with('property_video', 'property_image')->where('user_id', $admin)->get();
        return new BuildingResource($property);
    }

    public function single_property($id)
    {
        $admin = AppHelpers::user_admin();
        $property = BuildingProperty::with('property_video', 'property_image')->where('property_admin_id', $admin)->findOrFail($id);
        return new BuildingResource($property);
    }

}
