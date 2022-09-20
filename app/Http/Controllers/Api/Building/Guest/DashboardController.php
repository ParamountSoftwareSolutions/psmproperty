<?php

namespace App\Http\Controllers\Api\Building\Guest;

use App\Helpers\AppHelpers;
use App\Helpers\NotificationHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\BuildingResource;
use App\Http\Resources\DashboardResource;
use App\Http\Resources\FilterResource;
use App\Http\Resources\ReserveResource;
use App\Http\Resources\UpdateResource;
use App\Models\Building;
use App\Models\BuildingCustomer;
use App\Models\BuildingMobileApplication;
use App\Models\BuildingProperty;
use App\Models\BuildingRequest;
use App\Models\BuildingSlider;
use App\Models\BuildingUpdate;
use App\Models\FloorDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index($app_key)
    {
        $app = (new AppHelpers)->user_login_route($app_key);

        if ($app != null) {
            $data['slider'] = BuildingSlider::where('property_admin_id', $app->property_admin_id)->get();
            $data['building'] = Building::with('building_detail', 'building_images', 'building_floor_detail')->where('user_id', $app->property_admin_id)->get();
            $data['update'] = BuildingUpdate::whereIn('building_id', $data['building']->pluck('id')->toArray())->get();
            $data['property'] = BuildingProperty::with('property_image', 'property_video')->where('property_admin_id', $app->property_admin_id)->get();
            return DashboardResource::collection($data);
        } else {
            return $this->sendError('API KEY IS NOT A VALID KEY');
        }
    }

    public function filter($app_key, $building_id, $type)
    {
        $app = (new AppHelpers)->user_login_route($app_key);

        if ($app != null) {
            //$data['building'] = Building::with('building_detail', 'building_images', 'building_floor_detail')->where('user_id', $customer->property_admin_id)->get();
            $data = FloorDetail::with('floor_detail_image', 'building')->where(['building_id' => $building_id, 'type' => $type])->get();
            return FilterResource::collection($data);
        } else {
            return $this->sendError('API KEY IS NOT A VALID KEY');
        }
    }

    public function filter_data($app_key, $building_id, $floor_detail_id, $type)
    {
        $app = (new AppHelpers)->user_login_route($app_key);

        if ($app != null) {
            $data = FloorDetail::with('floor_detail_image', 'building')->where(['building_id' => $building_id, 'id' => $floor_detail_id, 'type' => $type])->first();
            return new FilterResource($data);
        } else {
            return $this->sendError('API KEY IS NOT A VALID KEY');
        }
    }

    public function update_detail($app_key, $building_id, $id)
    {
        $app = (new AppHelpers)->user_login_route($app_key);

        if ($app != null) {
            $update = BuildingUpdate::where(['id' => $id, 'building_id' => $building_id])->first();
            return new UpdateResource($update);
        } else {
            return $this->sendError('API KEY IS NOT A VALID KEY');
        }
    }

    public function building_all($app_key)
    {
        $app = (new AppHelpers)->user_login_route($app_key);
        if ($app != null) {
            $buildings = Building::with('building_detail')->where('user_id', $app->property_admin_id)->get();
            return BuildingResource::collection($buildings);
        } else {
            return $this->sendError('API KEY IS NOT A VALID KEY');
        }
    }

    public function single_building($app_key, $id)
    {
        $app = (new AppHelpers)->user_login_route($app_key);
        if ($app != null) {
            $buildings = Building::with('building_detail', 'building_images')->where('user_id', $app->property_admin_id)->findOrFail($id);
            return new BuildingResource($buildings);
        } else {
            return $this->sendError('API KEY IS NOT A VALID KEY');
        }
    }

    public function property($app_key)
    {
        $app = (new AppHelpers)->user_login_route($app_key);
        if ($app != null) {
            $property = BuildingProperty::with('building_detail', 'building_images')->where('property_admin_id', $app->property_admin_id)
                ->get();
            return new BuildingResource($property);
        } else {
            return $this->sendError('API KEY IS NOT A VALID KEY');
        }
    }

    public function single_property($app_key, $id)
    {
        $app = (new AppHelpers)->user_login_route($app_key);
        if ($app != null) {
            $property = BuildingProperty::with('building_detail', 'building_images')->where('property_admin_id', $app->property_admin_id)
                ->first($id);
            return new BuildingResource($property);
        } else {
            return $this->sendError('API KEY IS NOT A VALID KEY');
        }
    }

    public function reserve_building_detail($app_key, $id)
    {
        $app = (new AppHelpers)->user_login_route($app_key);
        if ($app != null) {
            //$buuilding = Where('id', $id)->where('property_admin_id', $app->property_admin_id)->first();
            $floor_detail = FloorDetail::where('building_id', $id)->get();
            return ReserveResource::collection($floor_detail);
        } else {
            return $this->sendError('API KEY IS NOT A VALID KEY');
        }
    }

    public function reserve(Request $request)
    {
        $check_data = BuildingRequest::where(['building_id' => $request->building_id, 'floor_detail_id' => $request->floor_detail_id, 'type' => 'reserve'])->first();

        if ($check_data == null) {
            $reserve = new BuildingRequest();
            $reserve->name = $request->name;
            $reserve->email = $request->email;
            $reserve->phone_number = $request->phone_number;
            $reserve->cnic = $request->cnic;
            $reserve->building_id = $request->building_id;
            //$reserve->transfer_to = Auth::guard('api')->id();
            $reserve->floor_detail_id = $request->floor_detail_id;
            $reserve->type = 'reserve';
            $reserve->save();
        } else {
            return $this->sendError('Property already in reserve!');
        }

        if ($reserve) {
            //notification Create
            (new NotificationHelper)->web_panel_notification('reserve_create');

            return $this->sendSuccess('Reserve Request Create Successfully');
        } else {
            return $this->sendError('Reserve Request Create Error');
        }
    }
}
