<?php

namespace App\Http\Controllers\Api\Building;

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
use App\Models\MobileApplication;
use App\Models\Project;
use App\Models\Slider;
use App\Models\Society;
use App\Models\SocietyCategoryData;
use App\Models\SocietySale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isEmpty;

class DashboardController extends Controller
{
    public function index()
    {
        $customer = BuildingCustomer::where('customer_id', Auth::guard('api')->id())->first();
        $app = BuildingMobileApplication::where('property_admin_id', $customer->property_admin_id)->first();

        if ($app != null) {
            $data['slider'] = BuildingSlider::where('property_admin_id', $customer->property_admin_id)->get();
            $data['building'] = Building::with('building_detail', 'building_images', 'building_floor_detail')->where('user_id', $customer->property_admin_id)->get();
            $data['update'] = BuildingUpdate::whereIn('building_id', $data['building']->pluck('id')->toArray())->get();
            $data['property'] = BuildingProperty::with('property_image', 'property_video')->where('property_admin_id', $app->property_admin_id)->get();
            return DashboardResource::collection($data);
        } else {
            return $this->sendError('API KEY IS NOT A VALID KEY');
        }
    }

    public function filter($building_id, $type){
        //['studio', 'apartment', 'flat', 'shop', 'penthouse', 'office']
        $customer = BuildingCustomer::where('customer_id', Auth::guard('api')->id())->first();
        $app = BuildingMobileApplication::where('property_admin_id', $customer->property_admin_id)->first();

        if ($app != null) {
            //$data['building'] = Building::with('building_detail', 'building_images', 'building_floor_detail')->where('user_id', $customer->property_admin_id)->get();
            $data = FloorDetail::with('floor_detail_image', 'building')->where(['building_id' => $building_id, 'type' => $type])->get();
            return FilterResource::collection($data);
        } else {
            return $this->sendError('API KEY IS NOT A VALID KEY');
        }
    }

    public function filter_data($building_id, $floor_detail_id, $type){
        //['studio', 'apartment', 'flat', 'shop', 'penthouse', 'office']
        $customer = BuildingCustomer::where('customer_id', Auth::guard('api')->id())->first();
        $app = BuildingMobileApplication::where('property_admin_id', $customer->property_admin_id)->first();

        if ($app != null) {
            //$data['building'] = Building::with('building_detail', 'building_images', 'building_floor_detail')->where('user_id', $customer->property_admin_id)->get();
            $data = FloorDetail::with('floor_detail_image', 'building')->where(['building_id' => $building_id, 'id' => $floor_detail_id,'type' => $type])->first();
            return new FilterResource($data);
        } else {
            return $this->sendError('API KEY IS NOT A VALID KEY');
        }
    }

    public function update_detail($building_id, $id){
        //['studio', 'apartment', 'flat', 'shop', 'penthouse', 'office']
        $customer = BuildingCustomer::where('customer_id', Auth::guard('api')->id())->first();
        $app = BuildingMobileApplication::where('property_admin_id', $customer->property_admin_id)->first();

        if ($app != null) {
            $update = BuildingUpdate::where(['id' => $id, 'building_id' => $building_id])->first();
            return new UpdateResource($update);
        } else {
            return $this->sendError('API KEY IS NOT A VALID KEY');
        }
    }


}
