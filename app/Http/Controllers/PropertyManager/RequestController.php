<?php

namespace App\Http\Controllers\PropertyManager;

use App\Helpers\Helpers;
use App\Helpers\NotificationHelper;
use App\Http\Controllers\Controller;
use App\Models\BuildingRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function index($type)
    {
        $building = Helpers::building_detail();
        $request = BuildingRequest::whereIn('building_id', $building->pluck('id')->toArray())->where('type', $type)->get();
        return view('property_manager.request.index', compact('request'));
    }

    public function edit($type, $id)
    {
        $building = Helpers::building_detail();
        $request = BuildingRequest::whereIn('building_id', $building->pluck('id')->toArray())->where('type', $type)->findOrFail($id);
        return view('property_manager.request.edit', compact('request'));
    }

    public function update(Request $req, $type, $id)
    {
        $req->validate([
            'status' => 'required',
            'title' => 'required',
            'description' => 'required',
            'transfer_to' => 'required',
        ]);
        $building = Helpers::building_detail();
        $request = BuildingRequest::whereIn('building_id', $building->pluck('id')->toArray())->where('type', $type)->findOrFail($id);
        $request->status = $req->status;
        $request->title = $req->title;
        $request->description = $req->description;
        $request->save();
//        $user = User::findOrFail($request->transfer_to);
//        if ($type == 'transfer') {
//            $data = ['title' => $req->title, 'description' => $req->description];
//            if ($req->status == 'accept') {
//                (new NotificationHelper)->send_notification_single_user('transfer_accept', $user, $data);
//                (new NotificationHelper)->web_panel_notification('transfer_accept');
//            } elseif ($req->status == 'rejected') {
//                (new NotificationHelper)->send_notification_single_user('transfer_rejected', $user, $data);
//                (new NotificationHelper)->web_panel_notification('transfer_rejected');
//            }
//        } elseif ($type == 'possession') {
//            $data = ['title' => $req->title, 'description' => $req->description];
//            if ($req->status == 'accept') {
//                (new NotificationHelper)->send_notification_single_user('possession_accept', $user, $data);
//                (new NotificationHelper)->web_panel_notification('possession_accept');
//            } elseif ($req->status == 'rejected') {
//                (new NotificationHelper)->send_notification_single_user('possession_rejected', $user, $data);
//                (new NotificationHelper)->web_panel_notification('possession_rejected');
//            }
//        } elseif ($type == 'file') {
//            $data = ['title' => $req->title, 'description' => $req->description];
//            if ($req->status == 'accept') {
//                (new NotificationHelper)->send_notification_single_user('file_accept', $user, $data);
//                (new NotificationHelper)->web_panel_notification('file_accept');
//            } elseif ($req->status == 'rejected') {
//                (new NotificationHelper)->send_notification_single_user('file_rejected', $user, $data);
//                (new NotificationHelper)->web_panel_notification('file_rejected');
//            }
//        } elseif ($type == 'reserve') {
//            $data = ['title' => $req->title, 'description' => $req->description];
//            if ($req->status == 'accept') {
//                (new NotificationHelper)->send_notification_single_user('reserve_accept', $user, $data);
//                (new NotificationHelper)->web_panel_notification('reserve_accept');
//            } elseif ($req->status == 'rejected') {
//                (new NotificationHelper)->send_notification_single_user('reserve_rejected', $user, $data);
//                (new NotificationHelper)->web_panel_notification('reserve_rejected');
//            }
//        } else {
//            return redirect()->back()->with(['alert' => 'error', 'message' => 'First select type and status']);
//        }

        if ($request) {
            return redirect('property-manager/request/' . $type)->with(['alert' => 'success', 'message' => ucwords($type) . ' Request Update Successfully']);
        } else {
            return redirect()->back()->with(['alert' => 'error', 'message' => ucwords($type) . ' Update Error']);
        }
    }

    public function destroy($type, $id)
    {
        $building = Helpers::building_detail();
        $request = BuildingRequest::whereIn('building_id', $building->pluck('id')->toArray())->where('type', $type)->findOrFail($id);
        $request->delete();
        if ($request) {
            return redirect()->back()->with(['alert' => 'success', 'message' => ucwords($type) . ' Delete Successfully']);
        } else {
            return redirect()->back()->with(['alert' => 'error', 'message' => ucwords($type) . ' Delete Error']);
        }
    }
}
