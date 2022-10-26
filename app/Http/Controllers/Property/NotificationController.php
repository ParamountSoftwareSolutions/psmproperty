<?php

namespace App\Http\Controllers\Property;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notification = Notification::whereIn('user_type', ['property_manager', 'employee', 'user'])->get();
        return view('property.notification.index', compact('notification'));
    }

    public function latest()
    {
        if (Auth::user()->roles[0]->name == 'property_admin'){
            $notification = Notification::whereIn('user_type', ['property_manager', 'employee', 'user'])->where('read_at', null)->get();
        } elseif(Auth::user()->roles[0]->name == 'property_manager') {
            $notification = Notification::whereIn('user_type', ['employee', 'user'])->where('read_at', null)->get();
        } else {
            $notification = 'notification not found';
        }
        return json_decode($notification);
    }

    public function mark_read_notification()
    {
        if (Auth::user()->roles[0]->name == 'property_admin'){
            $notification = Notification::whereIn('user_type', ['property_manager', 'employee', 'user'])->where('read_at', null)->update(['read_at' => Carbon::now()]);
        } elseif(Auth::user()->roles[0]->name == 'property_manager') {
            $notification = Notification::whereIn('user_type', ['employee', 'user'])->where('read_at', null)->update(['read_at' => Carbon::now()]);
        } else {
            $notification = 'notification not found';
        }
        return json_decode($notification);
    }

    public function mark_single_read_notification($id)
    {
        if (Auth::user()->roles[0]->name == 'property_admin'){
            $notification = Notification::whereIn('user_type', ['property_manager', 'sale_person', 'user'])->where('read_at', null)->where('id', $id)->update
            (['read_at' =>
                Carbon::now()]);
        }  else {
            $notification = 'notification not found';
        }
        return json_decode($notification);
    }
}
