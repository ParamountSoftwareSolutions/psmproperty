<?php

namespace App\Http\Controllers\Property;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        if (Auth::user()->roles[0]->name == 'property_admin'){
            $notification = \App\Models\Notification::whereIn('user_type', ['property_manager', 'employee', 'user'])->where('read_at', null)->get();
        } elseif(Auth::user()->roles[0]->name == 'property_manager') {
            $notification = \App\Models\Notification::whereIn('user_type', ['employee', 'user'])->where('read_at', null)->get();
        } else {
            $notification = 'notification not found';
        }
        return json_decode($notification);
    }

    public function mark_read_notification()
    {
        if (Auth::user()->roles[0]->name == 'property_admin'){
            $notification = \App\Models\Notification::whereIn('user_type', ['property_manager', 'employee', 'user'])->where('read_at', null)->update(['read_at' => Carbon::now()]);
        } elseif(Auth::user()->roles[0]->name == 'property_manager') {
            $notification = \App\Models\Notification::whereIn('user_type', ['employee', 'user'])->where('read_at', null)->update(['read_at' => Carbon::now()]);
        } else {
            $notification = 'notification not found';
        }
        return json_decode($notification);
    }
}
