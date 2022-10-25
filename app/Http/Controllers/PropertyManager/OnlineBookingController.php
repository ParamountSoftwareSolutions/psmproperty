<?php

namespace App\Http\Controllers\PropertyManager;

use App\Helpers\Helpers;
use App\Helpers\NotificationHelper;
use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\BuildingCustomer;
use App\Models\BuildingMobileApplication;
use App\Models\BuildingSale;
use App\Models\BuildingSaleDetail;
use App\Models\BuildingSaleInstallment;
use App\Models\FloorDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class OnlineBookingController extends Controller
{
    public function index()
    {
        $building = Helpers::building_detail();
        $sales = BuildingSale::whereIn('building_id', $building->pluck('id')->toArray())->where(['order_type' => 'online_booking'])->get();
        return view('property_manager.sale.online_booking.index', compact('sales', 'building'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'floor_detail_id' => 'required',
            'registration_number' => 'required',
            'status' => 'required',
        ]);
        $client = User::where('id', Auth::id())->first();
        $client->username = $request->username;
        $client->email = $request->email;
        $client->phone_number = $request->phone_number;
        $client->cnic = $request->cnic;
        $client->save();
        $sale = new BuildingSale();
        $sale->building_id = $request->building_id;
        $sale->floor_detail_id = $request->floor_detail_id;
        $sale->customer_id = $client->id;
        $sale->registration_number = $request->registration_number;
        $sale->hidden_file_number = $request->hidden_file_number;
        $sale->due_date = $request->due_date;
        $sale->order_status = $request->status;
        $sale->order_type = 'online_booking';
        $sale->save();

        $sale_detail = new BuildingSaleDetail();
        $sale_detail->building_sale_id = $sale->id;
        $sale_detail->token_amount = $request->token_amount;
        $sale_detail->save();

        if ($sale) {
            return redirect()->route('property_manager.sale.lead.index')->with($this->message('Property Sale Lead Create Successfully', 'success'));
        } else {
            return redirect()->back()->with($this->message('Property Sale Lead Receipt Create Error', 'danger'));
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'floor_detail_id' => 'required',
            'registration_number' => 'required',
            'status' => 'required',
            'comment' => 'required',
        ]);

        $sale = BuildingSale::findOrFail($id);
        $sale->floor_detail_id = $request->floor_detail_id;
        $sale->building_id = $request->building_id;
        $sale->down_payment = $request->down_payment;
        $sale->registration_number = $request->registration_number;
        $sale->hidden_file_number = $request->hidden_file_number;
        $sale->due_date = $request->due_date;
        $sale->order_status = $request->status;
        $sale->order_type = 'online_booking';
        $sale->save();

        if ($request->status == 'mature') {
            $data = ['title' => 'Online Booking', 'description' => $request->comment];
            (new NotificationHelper)->send_notification_single_user('online_booking_accept', $request->customer_id, $data);
            (new NotificationHelper)->web_panel_notification('online_booking_accept');
        } elseif ($request->status == 'cancel') {
            $data = ['title' => 'Online Booking', 'description' => $request->comment];
            (new NotificationHelper)->send_notification_single_user('online_booking_rejected', $request->customer_id, $data);
            (new NotificationHelper)->web_panel_notification('online_booking_rejected');
        } else {
            return redirect()->back()->with($this->message('Status Incorrect Notification Error!', 'error'));
        }

        /*(new NotificationHelper)->send_notification_single_user('property_create');*/
        $client = User::where('id', $sale->customer->id)->first();
        $client->username = $request->username;
        $client->email = $request->email;
        $client->password = Hash::make($request->password);
        $client->phone_number = $request->phone_number;
        $client->save();

        /*$building_app_key = BuildingMobileApplication::where('property_admin_id', $assign_data->property_admin_id)->first();

        $client_detail = BuildingCustomer::where('customer_id', $client->id)->first();
        $client_detail->property_admin_id = $assign_data->property_admin_id;
        $client_detail->property_manager_id = Auth::id();
        $client_detail->save();

        $sale_detail = BuildingSaleDetail::where('building_sale_id', $id)->first();
        $sale_detail->token_amount = $request->token_amount;
        $sale_detail->save();*/

        $floor_detail = FloorDetail::where('id', $request->floor_detail_id)->first();
        if ($request->status == 'mature') {
            FloorDetail::where('id', $request->floor_detail_id)->update(['status' => 'sold']);
        } elseif ($request->status == 'approved') {
            FloorDetail::where('id', $request->floor_detail_id)->update(['status' => 'hold']);
        }
        if ($sale) {
            return redirect()->route('property_manager.sale.lead.index')->with($this->message('Property Sale Lead Create Successfully', 'success'));
        } else {
            return redirect()->back()->with($this->message('Property Sale Lead Receipt Create Error', 'error'));
        }
    }
}
