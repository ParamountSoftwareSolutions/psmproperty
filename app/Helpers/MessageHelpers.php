<?php


namespace App\Helpers;


use App\Models\BuildingSale;
use App\Models\BuildingSetting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class MessageHelpers
{
    public static function sendMessage($key, $sale = null)
    {
        $building = Helpers::building_detail();
        $sales = BuildingSale::whereIn('building_id', $building->pluck('id')->toArray())->get();
        $client = User::whereIn('id', $sales->pluck('customer_id')->toArray())->get();
        $arr = [];
        if ($sale == null){
            foreach ($client as $keys => $data) {
                $to = $data->phone_number;
                if (substr($to, 0, 3) !== '+92') {
                    $newNumber = preg_replace('/^0?/', '+92', $to);
                    array_push($arr, $newNumber);
                } else {
                    array_push($arr, $to);
                }
            }
        } else {
            User::where('id', $sale->customer_id)->update(['password'=> Hash::make('12345678')]);
            $client = User::where('id', $sale->customer_id)->first();
            $to = $client->phone_number;
            if (substr($to, 0, 3) !== '+92') {
                $newNumber = preg_replace('/^0?/', '+92', $to);
                array_push($arr, $newNumber);
            } else {
                array_push($arr, $to);
            }
        }
        /*preg_replace('/^0?/', '+92', $to);*/
        $building_message = BuildingSetting::where(['key' => $key, 'user_id' => Auth::id()])->where('value->status', 1)->first();
        $message_api_key = BuildingSetting::where(['key' => 'message_api_key', 'user_id' => Auth::id()])->first();
        if ($building_message == null && $message_api_key == null) {
            return false;
        } else {
            $MessageBird = new \MessageBird\Client($message_api_key);
            if ($key == 'login_detail_message'){
                $Message = new \MessageBird\Objects\Message();
                $Message->originator = 'pss';
                $Message->recipients = $arr;
                $Message->body = $client->username . ' is your login detail: ' . '<br>' .
                    'phone number: ' . $client->phone_number . 'password: ' .  $client->password;
            } else {
                $Message = new \MessageBird\Objects\Message();
                $Message->originator = 'pss';
                $Message->recipients = $arr;
                $Message->body = $building_message;
            }
            try {
                $MessageBird->messages->create($Message);
            } catch(\Exception $e) {
                //dd($e->getMessage());
                return $e->getMessage();
            }

            return true;
        }
    }

    /*public static function message_login_detail()
    {
        $message = BuildingSetting::where('key', $key)->whereJsonContains('value->status', 1)->first();
        if ($message == null) {
            return true;
        } else {

            return true;
        }
    }*/
}
