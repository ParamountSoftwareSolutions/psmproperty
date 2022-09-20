<?php

namespace App\Helpers;

use App\Models\BuildingCustomer;
use App\Models\BuildingSetting;
use App\Models\State;
use App\Models\User;
use Doctrine\DBAL\Driver\Middleware\AbstractConnectionMiddleware;
use Illuminate\Support\Facades\Auth;

class NotificationHelper
{
    public function web_panel_notification($key)
    {
        $notification_message = BuildingSetting::where('key', $key)->whereJsonContains('value->status', 1)->first();
        if ($notification_message == null) {
            return true;
        } else {
            $notification = new \App\Models\Notification();
            $notification->user_id = Auth::id();
            $notification->user_type = Auth::user()->roles[0]->name;
            $notification->type = $key;
            $notification->data = json_decode($notification_message->value)->message;
            $notification->save();
            return true;
        }
    }

    public function send_notification_all_user($key)
    {
        $users = User::with('roles')
            ->whereHas('roles', function ($q) {
                $q->Where('name', 'user');
            })
            ->get();
        foreach ($users as $user) {
            $building_customer = BuildingCustomer::where('customer_id', $user->id)->first();
            $property_admin_id = User::where('id', $building_customer->property_admin_id)->first();
            $notification_message = BuildingSetting::where('key', $key)->whereJsonContains('value->status', 1)->first();
            if ($notification_message !== null && $property_admin_id->server_key !== null) {
                /*$project_id = BusinessSetting::where(['key' => 'fcm_project_id'])->first()->value;*/

                $url = "https://fcm.googleapis.com/fcm/send";
                $header = array("authorization: key=" . $property_admin_id->server_key . "",
                    "content-type: application/json"
                );
                $title = str_replace('_', ' ', $notification_message->key, $count);

                $postdata = '{
                        "to" : "' . $user->notification_token . '",
                        "mutable-content": "true",
                        "data" : {
                            "title":"' . $title . '",
                            "body" : "' . json_decode($notification_message->value)->message . '",
                            "is_read": 0
                        },
                        "notification" : {
                            "title" :"' . $title . '",
                            "body" : "' . json_decode($notification_message->value)->message . '",
                            "is_read": 0,
                            "icon" : "new",
                            "sound" : "default"
                        }
                    }';

                $ch = curl_init();
                $timeout = 120;
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

                // Get URL content
                $result = curl_exec($ch);
                // close handle to release resources
                curl_close($ch);

                dd($result);
                return $result;
            } else {
                return false;
            }
        }
    }

    public function send_notification_single_user($key, $user, $data = null)
    {
        /*$users = User::with('roles')
            ->whereHas('roles', function ($q) {
                $q->Where('name', 'user');
            })
            ->get();*/
        $building_customer = BuildingCustomer::where('customer_id', $user->id)->first();
        $property_admin_id = User::where('id', $building_customer->property_admin_id)->first();
        $notification_message = BuildingSetting::where('key', $key)->whereJsonContains('value->status', 1)->first();
        if ($notification_message !== null && $property_admin_id->server_key !== null) {
            /*$project_id = BusinessSetting::where(['key' => 'fcm_project_id'])->first()->value;*/

            $url = "https://fcm.googleapis.com/fcm/send";
            $header = array("authorization: key=" . $property_admin_id->server_key . "",
                "content-type: application/json"
            );
            $title = str_replace('_', ' ', $notification_message->key, $count);
            if ($data == null) {
                $data['title'] = $title;
                $data['message'] = json_decode($notification_message->value)->message;
            }
            $postdata = '{
                        "to" : "' . $user->notification_token . '",
                        "mutable-content": "true",
                        "data" : {
                            "title":"' . $data['title'] . '",
                            "body" : "' . $data['message'] . '",
                            "is_read": 0
                        },
                        "notification" : {
                            "title":"' . $data['title'] . '",
                            "body" : "' . $data['message'] . '",
                            "is_read": 0,
                            "icon" : "new",
                            "sound" : "default"
                        }
                    }';

            $ch = curl_init();
            $timeout = 120;
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

            // Get URL content
            $result = curl_exec($ch);
            // close handle to release resources
            curl_close($ch);

            return $result;
        } else {
            return false;
        }
    }

    public function city($state_id)
    {
        return State::where('state_id', $state_id)->get();
    }

}
