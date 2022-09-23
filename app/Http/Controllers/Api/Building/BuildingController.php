<?php

namespace App\Http\Controllers\Api\Building;

use App\Http\Controllers\Controller;
use App\Http\Resources\BuildingResource;
use App\Models\Building;
use App\Models\BuildingCustomer;
use Illuminate\Support\Facades\Auth;

class BuildingController extends Controller
{
    public function index()
    {
        $building_customer = BuildingCustomer::where('customer_id', Auth::id())->first();
        $buildings = Building::with('building_detail')->where('user_id', $building_customer->property_admin->property_admin_id)->get();
        return BuildingResource::collection($buildings);
    }

    public function single_building($id)
    {
        $building_customer = BuildingCustomer::where('customer_id', Auth::id())->first();
        $buildings = Building::with('building_detail', 'building_images')->where('user_id', $building_customer->property_admin->property_admin_id)->findOrFail($id);
        //$buildings['building_detail_file'] = $buildings->building_detail;
        return new BuildingResource($buildings);
    }

    public function property()
    {
        $building_customer = BuildingCustomer::where('customer_id', Auth::id())->first();
        $property = BuildingProperty::with('property_video', 'property_image')->where('property_admin_id', $building_customer->property_admin->property_admin_id)
            ->get();
        return new BuildingResource($property);
    }

    public function single_property($id)
    {
        $building_customer = BuildingCustomer::where('customer_id', Auth::id())->first();
        $property = BuildingProperty::with('property_video', 'property_image')->where('property_admin_id', $building_customer->property_admin->property_admin_id)
            ->findOrFail($id);
        return new BuildingResource($property);
    }

}
