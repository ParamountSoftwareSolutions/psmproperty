<?php

namespace App\Http\Controllers\PropertyManager;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Notifications\OffersNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

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

    public function sendOfferNotification()
    {
        $userSchema = User::first();

        $offerData = [
            'name' => 'BOGO',
            'body' => 'You received an offer.',
            'thanks' => 'Thank you',
            'offerText' => 'Check out the offer',
            'offerUrl' => url('/'),
            'offer_id' => 007
        ];

        Notification::send($userSchema, new OffersNotification($offerData));

        dd('Task completed!');
    }

}
