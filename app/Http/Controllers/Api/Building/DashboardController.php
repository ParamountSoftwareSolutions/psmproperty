<?php

namespace App\Http\Controllers\Api\Building;

use App\Helpers\AppHelpers;
use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\DashboardResource;
use App\Http\Resources\FilterResource;
use App\Http\Resources\UpdateResource;
use App\Models\Building;
use App\Models\BuildingCustomer;
use App\Models\BuildingMobileApplication;
use App\Models\BuildingProperty;
use App\Models\BuildingSlider;
use App\Models\BuildingUpdate;
use App\Models\FloorDetail;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /*public function __construct()
    {
        $app = AppHelpers::app();
        $admin = AppHelpers::user_admin();
        $building = AppHelpers::building_detail();
    }*/

    public function index()
    {
        $app = AppHelpers::app();
        $admin = AppHelpers::user_admin();
        $building = AppHelpers::building_detail();

        if ($app != null) {
            $data['slider'] = BuildingSlider::where('property_admin_id', $admin)->get();
            $data['building'] = $building;
            $data['update'] = BuildingUpdate::whereIn('building_id', $building->pluck('id')->toArray())->get();
            $data['property'] = BuildingProperty::with('property_image', 'property_video')->where('user_id', $app->property_admin_id)->get();
            return DashboardResource::collection($data);
        } else {
            return $this->sendError('API KEY IS NOT A VALID KEY');
        }
    }

    public function filter($building_id, $type){
        //['studio', 'apartment', 'flat', 'shop', 'penthouse', 'office']
        $app = AppHelpers::app();
        $building = AppHelpers::building_detail_single($building_id);

        if ($app != null) {
            //$data['building'] = Building::with('building_detail', 'building_images', 'building_floor_detail')->where('user_id', $customer->property_admin_id)->get();
            $data = FloorDetail::with('floor_detail_image', 'building')->where(['building_id' => $building->id, 'type' => $type])->get();
            return FilterResource::collection($data);
        } else {
            return $this->sendError('API KEY IS NOT A VALID KEY');
        }
    }

    public function filter_data($building_id, $floor_detail_id, $type){
        //['studio', 'apartment', 'flat', 'shop', 'penthouse', 'office']
        $app = AppHelpers::app();
        $building = AppHelpers::building_detail_single($building_id);

        if ($app != null) {
            //$data['building'] = Building::with('building_detail', 'building_images', 'building_floor_detail')->where('user_id', $customer->property_admin_id)->get();
            $data = FloorDetail::with('floor_detail_image', 'building')->where(['building_id' => $building->id, 'id' => $floor_detail_id,'type' => $type])->first();
            return new FilterResource($data);
        } else {
            return $this->sendError('API KEY IS NOT A VALID KEY');
        }
    }

    public function update_detail($building_id, $id){
        //['studio', 'apartment', 'flat', 'shop', 'penthouse', 'office']
        $app = AppHelpers::app();
        $building = AppHelpers::building_detail_single($building_id);

        if ($app != null) {
            $update = BuildingUpdate::where(['id' => $id, 'building_id' => $building->id])->first();
            return new UpdateResource($update);
        } else {
            return $this->sendError('API KEY IS NOT A VALID KEY');
        }
    }


}
