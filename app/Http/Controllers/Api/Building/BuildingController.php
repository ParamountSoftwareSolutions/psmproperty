<?php

namespace App\Http\Controllers\Api\Building;

use App\Http\Controllers\Controller;
use App\Http\Resources\BuildingResource;
use App\Http\Resources\InstallmentResource;
use App\Http\Resources\ProjectResource;
use App\Models\Building;
use App\Models\BuildingCustomer;
use App\Models\BuildingDetail;
use App\Models\BuildingMobileApplication;
use App\Models\BuildingProperty;
use App\Models\BuildingSale;
use App\Models\FloorDetail;
use App\Models\Project;
use Illuminate\Http\Request;
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
