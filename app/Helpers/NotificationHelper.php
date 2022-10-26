<?php

namespace App\Helpers;

use App\Models\Building;
use App\Models\BuildingAssignUser;
use App\Models\BuildingCustomer;
use App\Models\BuildingRequest;
use App\Models\BuildingSale;
use App\Models\BuildingSetting;
use App\Models\Notification;
use App\Models\State;
use App\Models\User;
use Doctrine\DBAL\Driver\Middleware\AbstractConnectionMiddleware;
use Illuminate\Support\Facades\Auth;

class NotificationHelper
{
    public static function web_panel_notification($key, $data_type, $data_id = null)
    {
        $data = null;
        $notification_message = BuildingSetting::where('key', $key)->whereJsonContains('value->status', 1)->first();

        /*$property_keys = ['property_create'];
        $sale_keys = ['lead_add', 'lead_update', 'lead_follow_up', 'lead_arrange_meeting', 'lead_meet_client', 'lead_lost', 'lead_mature', 'sale_add', 'sale_update', 'sale_mature', 'sale_cancel', 'sale_lost'];
        $hrm_keys = ['employee_create'];*/
        $request_keys = ['possession_create', 'transfer_create', 'file_create'];
        $data = [$data_type => $data_id];
        $users = null;
        $user = null;
        
        if (Auth::user()->hasRole('property_admin')) {
            if ($data_type == 'property_id') {
                $users = User::where('property_admin_id', Helpers::user_admin())->whereHas('roles', function ($q) {
                    $q->where('name', 'user');
                })->get();

            } elseif ($data_type == 'employee_id') {
                $employee = User::with('building_employee')->find($data_id);
                $user_assign = BuildingAssignUser::where('building_id', $employee->building_employee->building_id)->where('user_id', '!=', Auth::id())->get();
                $users = User::with('roles')
                    ->whereHas('roles', function ($q) {
                        $q->whereIn('name', ['property_admin', 'property_manager', 'sale_manager']);
                    })
                    ->whereIn('id', $user_assign->pluck('user_id')->toArray())->get();

            } else if ($data_type == 'sale_id') {
                $sale = BuildingSale::find($data_id);
                $user_assign = BuildingAssignUser::where('building_id', $sale->building_id)->where('user_id', '!=', Auth::id())->get();
                $users = User::with('roles')->whereHas('roles', function ($q) {
                    $q->whereIn('name', ['property_manager', 'sale_manager']);
                })
                    ->whereIn('id', $user_assign->pluck('user_id')->toArray())->get();
                $user = User::with('roles')->whereHas('roles', function ($q) {
                    $q->whereIn('name', ['property_admin', 'property_manager', 'sale_manager', 'sale_person']);
                })->find($sale->user_id);

            } elseif ($data_type == 'request_id') {
                if (in_array($key, $request_keys)) {
                    // user su request kis kis ko jy gi.
                    $users = User::where('property_admin_id', Helpers::user_admin())->whereHas('roles', function ($q) {
                        $q->whereIn('name', ['property_admin', 'property_manager']);
                    })->get();
                } else {
                    $request = BuildingRequest::find($data_id);
                    $user = User::where('property_admin_id', Helpers::user_admin())->whereHas('roles', function ($q) {
                        $q->where('name', 'user');
                    })->find($request->transfer_to);
                }
            }


        } elseif (Auth::user()->hasRole('property_manager')) {
            if ($data_type == 'employee_id') {
                $employee = User::with('building_employee')->find($data_id);
                $user_assign = BuildingAssignUser::where('building_id', $employee->building_employee->building_id)->where('user_id', '!=', Auth::id())->get();
                $users = User::with('roles')->whereHas('roles', function ($q) {
                    $q->whereIn('name', ['property_admin', 'property_manager', 'sale_manager']);
                })
                    ->whereIn('id', $user_assign->pluck('user_id')->toArray())->get();

            } else if ($data_type == 'sale_id') {
                $sale = BuildingSale::find($data_id);
                $user_assign = BuildingAssignUser::where('building_id', $sale->building_id)->where('user_id', '!=', Auth::id())->get();
                $users = User::with('roles')->whereHas('roles', function ($q) {
                    $q->whereIn('name', ['property_admin', 'property_manager', 'sale_manager']);
                })
                    ->whereIn('id', $user_assign->pluck('user_id')->toArray())->get();
                $user = User::with('roles')->whereHas('roles', function ($q) {
                    $q->whereIn('name', ['property_admin', 'property_manager', 'sale_manager', 'sale_person']);
                })->find($sale->user_id);

            } else if ($data_type == 'request_id') {
                if (in_array($key, $request_keys)) {
                    $users = User::where('property_admin_id', Helpers::user_admin())->whereHas('roles', function ($q) {
                        $q->whereIn('name', ['property_admin', 'property_manager']);
                    })->get();
                } else {
                    $request = BuildingRequest::find($data_id);
                    $user = User::where('property_admin_id', Helpers::user_admin())->whereHas('roles', function ($q) {
                        $q->where('name', 'user');
                    })->find($request->transfer_to);
                }
            }

        } elseif (Auth::user()->hasRole('sale_manager')) {
            if ($data_type == 'employee_id') {
                $employee = User::with('building_employee')->find($data_id);
                $user_assign = BuildingAssignUser::where('building_id', $employee->building_employee->building_id)->where('user_id', '!=', Auth::id())->get();
                $users = User::with('roles')->whereHas('roles', function ($q) {
                    $q->whereIn('name', ['property_admin', 'property_manager', 'sale_manager']);
                })
                    ->whereIn('id', $user_assign->pluck('user_id')->toArray())->get();

            } else if ($data_type == 'sale_id') {
                $sale = BuildingSale::find($data_id);
                $user_assign = BuildingAssignUser::where('building_id', $sale->building_id)->where('user_id', '!=', Auth::id())->get();
                $users = User::with('roles')->whereHas('roles', function ($q) {
                    $q->whereIn('name', ['property_admin', 'property_manager', 'sale_manager']);
                })
                    ->whereIn('id', $user_assign->pluck('user_id')->toArray())->get();
                $user = User::with('roles')->whereHas('roles', function ($q) {
                    $q->whereIn('name', ['property_admin', 'property_manager', 'sale_manager', 'sale_person']);
                })->find($sale->user_id);

            }

        } elseif (Auth::user()->hasRole('sale_person')) {
            $sale = BuildingSale::find($data_id);
            $user_assign = BuildingAssignUser::where('building_id', $sale->building_id)->where('user_id', '!=', Auth::id())->get();
            $users = User::whereIn('id', $user_assign->pluck('user_id')->toArray())->get();
        } else {
            $notification = 'notification Key not found';
        }

        if ($notification_message !== null) {
            if (Auth::user()->hasRole('property_admin')) {
                NotificationHelper::notification_create_multiple($key, $notification_message, $data, $users, $user);
                NotificationHelper::notification_create_single($key, $notification_message, $data, $user);
            } elseif (Auth::user()->roles[0]->name == 'property_manager') {
                NotificationHelper::notification_create_multiple($key, $notification_message, $data, $users, $user);
                NotificationHelper::notification_create_single($key, $notification_message, $data, $user);
            } elseif (Auth::user()->roles[0]->name == 'sale_manager') {
                NotificationHelper::notification_create_multiple($key, $notification_message, $data, $users, $user);
                NotificationHelper::notification_create_single($key, $notification_message, $data, $user);
            } elseif (Auth::user()->hasRole('sale_person')) {
                NotificationHelper::notification_create_multiple($key, $notification_message, $data, $users, $user);
                NotificationHelper::notification_create_single($key, $notification_message, $data, $user);
            } else {
                return 'role not found';
            }
        } else {
            return false;
        }
        return true;
    }

    public static function notification_create_multiple($key, $notification_message, $data, $users, $user)
    {
        foreach ($users as $value) {
            if ( $value->id !== !empty($user->id)) {
                $notification = new Notification();
                $notification->user_id = Auth::id();
                $notification->user_type = Auth::user()->roles[0]->name;
                $notification->receiver_id = $value->id;
                $notification->type = $key;
                $notification->description = json_decode($notification_message->value)->message;
                $notification->data = json_encode($data);
                $notification->save();
            }
        }
        return true;
    }

    public static function notification_create_single($key, $notification_message, $data, $user)
    {
        if ($key == 'lead_add' || $key == 'lead_update') {
            $key = 'lead_assign';
        }
        if ($user !== null) {
            $notification = new Notification();
            $notification->user_id = Auth::id();
            $notification->user_type = Auth::user()->roles[0]->name;
            $notification->receiver_id = $user->id;
            $notification->type = $key;
            $notification->description = json_decode($notification_message->value)->message;
            $notification->data = json_encode($data);
            $notification->save();
        }
        return true;
    }

    public function send_notification_all_user($key)
    {
        $users = User::with('roles')
            ->whereHas('roles', function ($q) {
                $q->Where('name', 'user');
            })
            ->get();
        //dd($users);
        foreach ($users as $user) {
            $building_customer = BuildingCustomer::where('customer_id', $user->id)->first();
            if ($building_customer !== null) {
                $property_admin_id = User::where('id', $building_customer->property_admin_id)->first();
                $notification_message = BuildingSetting::where('user_id', $property_admin_id)->where('key', $key)->whereJsonContains('value->status', 1)->first();

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

//                dd($result);
                    return $result;
                } else {
                    return false;
                }
            }
        }
    }

    public static function send_notification_single_user($key, $user, $data = null)
    {
        /*$users = User::with('roles')
            ->whereHas('roles', function ($q) {
                $q->Where('name', 'user');
            })
            ->get();*/
        //$building_customer = BuildingSale::where('customer_id', $user->id)->first();
        //$building_customer = BuildingCustomer::where('customer_id', $user->id)->first();
        $property_admin_id = $user->property_admin_id;
        $notification_message = BuildingSetting::where('user_id', $property_admin_id)->where('key', $key)->whereJsonContains('value->status', 1)->first();
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
