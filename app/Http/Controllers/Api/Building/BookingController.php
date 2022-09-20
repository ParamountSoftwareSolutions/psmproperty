<?php

namespace App\Http\Controllers\Api\Building;

use App\Helpers\NotificationHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReserveResource;
use App\Models\BuildingPossession;
use App\Models\BuildingRequest;
use App\Models\FloorDetail;
use App\Models\PossessionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function request(Request $request)
    {
        $floor_detail = FloorDetail::where(['building_id' => $request->building_id, 'unit_id' => $request->unit_id])->first();
        $building_request = BuildingRequest::where(['unit_id' => $request->unit_id, 'type' => $request->type])->first();
        if ($floor_detail !== null) {
            if ($building_request == null) {
                $request = BuildingRequest::create([
                    'building_id' => $request->building_id,
                    'unit_id' => $request->unit_id,
                    'transfer_to' => Auth::guard('api')->id(),
                    'date' => $request->date,
                    'type' => $request->type,
                ]);
                if ($request) {
                    if ($request->type == 'possession') {
                        //notification Create
                        (new NotificationHelper)->web_panel_notification('possession_create');
                        return $this->sendSuccess(ucfirst($request->type) . ' Create Successfully');
                    } elseif ($request->type == 'transfer') {
                        //notification Create
                        (new NotificationHelper)->web_panel_notification('transfer_create');
                        return $this->sendSuccess(ucfirst($request->type) . ' Create Successfully');
                    } elseif ($request->type == 'file') {
                        //notification Create
                        (new NotificationHelper)->web_panel_notification('file_create');
                        return $this->sendSuccess(ucfirst($request->type) . ' Create Successfully');
                    } else {
                        return $this->sendError('Request type error');
                    }
                } else {
                    return $this->sendError(ucfirst($request->type) . ' Create Error');
                }
            } else {
                return $this->sendError('This Unit ID request already is Create');
            }
        } else {
            return $this->sendError('Unit ID Or Building Id is not exist');
        }

    }

    /*public function transfer(Request $request)
    {
        $transfer = BuildingRequest::create([
            'name' => $request->name,
            'transfer_to' => Auth::guard('api')->id(),
            'registration_number' => $request->registration_number,
            'date' => $request->date,
            'type' => 'transfer',
        ]);
        if ($transfer) {
            //notification Create
            (new NotificationHelper)->web_panel_notification('transfer_create');

            return $this->sendSuccess('Data Create Successfully');
        } else {
            return $this->sendError('Data Create Error');
        }
    }

    public function file(Request $request)
    {
        $file = BuildingRequest::create([
            'name' => $request->name,
            'transfer_to' => Auth::guard('api')->id(),
            'registration_number' => $request->registration_number,
            'date' => $request->date,
            'type' => 'file',
        ]);
        if ($file) {
            //notification Create
            (new NotificationHelper)->web_panel_notification('file_create');

            return $this->sendSuccess('Data Create Successfully');
        } else {
            return $this->sendError('Data Create Error');
        }
    }*/

    public function reserve_building_detail($building_id)
    {
        $floor_detail = FloorDetail::where('building_id', $building_id)->get();
        return ReserveResource::collection($floor_detail);
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
            $reserve->transfer_to = Auth::guard('api')->id();
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
