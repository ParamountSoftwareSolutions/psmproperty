<?php

namespace App\Http\Controllers\Society;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\OffersNotification;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
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
