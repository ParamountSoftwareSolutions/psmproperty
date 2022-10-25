<?php

namespace App\Http\Controllers\PropertyManager;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\BuildingSaleHistory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Notifications\OffersNotification;
use Illuminate\Support\Facades\Auth;
use App\Models\TodayMeetingCount;
class NotificationController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('property_admin')) {
            $notification = Notification::whereIn('user_type', ['property_manager', 'sale_person', 'user'])->latest()->get();
        } elseif(Auth::user()->hasRole('property_manager')) {
            $notification = Notification::whereIn('user_type', ['sale_person', 'user'])->latest()->get();
        } elseif(Auth::user()->hasRole('sale_manager')) {
            $notification = Notification::whereIn('user_type', ['user'])->latest()->get();
        } elseif(Auth::user()->hasRole('sale_person')) {
            $notification = Notification::whereIn('user_type', ['user'])->latest()->get();
        } else {
            $notification = 'notification not found';
        }
        return view('property_manager.notification.index', compact('notification'));
    }

    public function latest()
    {
        if (Auth::user()->roles[0]->name == 'property_admin'){
            $notification = Notification::whereIn('user_type', ['property_manager', 'sale_person', 'user'])->where('read_at', null)->get();
        } elseif(Auth::user()->roles[0]->name == 'property_manager') {
            $notification = Notification::whereIn('user_type', ['sale_person', 'user'])->where('read_at', null)->get();
        } elseif(Auth::user()->roles[0]->name == 'sale_manager') {
            $notification = Notification::whereIn('user_type', ['user'])->where('read_at', null)->get();
        } elseif(Auth::user()->roles[0]->name == 'sale_person') {
            $notification = Notification::whereIn('user_type', ['user'])->where('read_at', null)->get();
        } else {
            $notification = 'notification not found';
        }
        return json_decode($notification);
    }

    public function mark_read_notification()
    {
        if (Auth::user()->roles[0]->name == 'property_admin'){
            $notification = Notification::whereIn('user_type', ['property_manager', 'sale_person', 'user'])->where('read_at', null)->update(['read_at' =>
                Carbon::now()]);
        } elseif(Auth::user()->roles[0]->name == 'property_manager') {
            $notification = Notification::whereIn('user_type', ['sale_person', 'user'])->where('read_at', null)->update(['read_at' => Carbon::now()]);
        } elseif(Auth::user()->roles[0]->name == 'sale_manager') {
            $notification = Notification::whereIn('user_type', ['user'])->where('read_at', null)->update(['read_at' => Carbon::now()]);
        } elseif(Auth::user()->roles[0]->name == 'sale_person') {
            $notification = Notification::whereIn('user_type', ['user'])->where('read_at', null)->update(['read_at' => Carbon::now()]);
        } else {
            $notification = 'notification not found';
        }
        if (request()->ajax()){
            return json_decode($notification);
        } else {
            return view('property_manager.notification.index', compact('notification'));
        }
    }

    public function mark_single_read_notification($panel, $id)
    {
        if (Auth::user()->roles[0]->name == 'property_admin'){
            $notification = Notification::whereIn('user_type', ['property_manager', 'sale_person', 'user'])->latest()->get();
            $update = Notification::whereIn('user_type', ['property_manager', 'sale_person', 'user'])->where('read_at', null)->where('id', $id)->update(['read_at' => Carbon::now()]);
        } elseif(Auth::user()->roles[0]->name == 'property_manager') {
            $notification = Notification::whereIn('user_type', ['sale_person', 'user'])->latest()->get();
            $update = Notification::whereIn('user_type', ['property_manager', 'sale_person', 'user'])->where('read_at', null)->where('id', $id)->update(['read_at' => Carbon::now()]);
        } elseif(Auth::user()->roles[0]->name == 'sale_manager') {
            $notification = Notification::whereIn('user_type', ['user'])->latest()->get();
            $update = Notification::whereIn('user_type', ['user'])->where('read_at', null)->where('id', $id)->update(['read_at' => Carbon::now()]);
        } elseif(Auth::user()->roles[0]->name == 'sale_person') {
            $notification = Notification::whereIn('user_type', ['user'])->latest()->get();
            $update = Notification::whereIn('user_type', ['user'])->where('read_at', null)->where('id', $id)->update(['read_at' => Carbon::now()]);
        } else {
            $notification = 'notification not found';
        }
        if (request()->ajax()){
            return json_decode($notification);
        } else {
            return view('property_manager.notification.index', compact('notification'));
        }

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
public function meeting_alert(){
        $meeting = BuildingSaleHistory::where(['key'=> 'lead','data->status'=> 'arrange_meeting','data->user_id'=> Auth::user()->id,'data->is_read'=> 0])->whereDate('data->date', '>=' ,Carbon::now())->first();
        $meeting_time = Carbon::parse(json_decode($meeting->data)->date)->format('Y-m-d H:i:s');
        $alert_time = Carbon::parse(json_decode($meeting->data)->date)->subMinutes(15)->format('Y-m-d H:i:s');
        $current_time = Carbon::now()->format('Y-m-d H:i:s');
		if($meeting_time > $current_time && $current_time > $alert_time){
				//dd('between 15 minitus');
				$send_time = Carbon::parse(json_decode($meeting->data)->date)->format('h:i A');
				return response()->json(['status' => 'success','id'=>$meeting->id,'time'=>$send_time]);
			}
			else{
				//dd('Not a time for alert');
				$meeting = null;
				return response()->json(['status' => 'error']);
			}
    }
	public function today_meeting_count()
    {
        $meetings = BuildingSaleHistory::where(['key'=> 'lead','data->status'=> 'arrange_meeting','data->user_id'=> Auth::user()->id,'data->is_read'=> 0])->whereDate('data->date',Carbon::now())->groupBy('building_sale_id')->get();
        if($meetings->count()){
            $has_record = TodayMeetingCount::where(['key'=>'today_meeting_count','user_id'=>Auth::user()->id])->whereDate('date',Carbon::now())->first();
            if(!$has_record) {
                $has_record = TodayMeetingCount::create([
                    'key' => 'today_meeting_count',
                    'user_id'=>Auth::user()->id,
                    'date' => Carbon::now(),
                ]);
            }
            if($has_record->is_read == 0){
                $count = $meetings->count().' Meetings';
                return response()->json(['status'=>'success','count'=>$count,'id'=>$has_record->id]);
            }
            else{
                return response()->json(['status' => 'error']);
            }
        }
        else{
            return response()->json(['status' => 'error']);
        }
    }

    public function today_count_read(Request $request)
    {
        $meeting_count = TodayMeetingCount::findOrFail($request->id);
        $meeting_count->is_read = 1;
        $meeting_count->save();
        return response()->json(['status'=>'success']);
    }

    public function check_count_read(Request $request)
    {
        $meeting_count = TodayMeetingCount::findOrFail($request->id);
        if($meeting_count->is_read == 0){
            $meetings = BuildingSaleHistory::where(['key'=> 'lead','data->status'=> 'arrange_meeting','data->user_id'=> Auth::user()->id,'data->is_read'=> 0])->whereDate('data->date',Carbon::now())->groupBy('building_sale_id')->get();
            return response()->json(['status'=>'success','count'=>$meetings->count(),'id'=>$meeting_count->id]);
        }
        else{
            return response()->json(['status'=>'success']);
        }
		 }
	

    public function today_follow_up_count()
    {
        $follow_ups = BuildingSaleHistory::where(['key'=> 'lead','data->status'=> 'follow_up','data->user_id'=> Auth::user()->id,'data->is_read'=> 0])->whereDate('data->date',Carbon::now())->groupBy('building_sale_id')->get();
        if($follow_ups->count()){
            $has_record = TodayMeetingCount::where(['key'=>'today_follow_up_count','user_id'=>Auth::user()->id])->whereDate('date',Carbon::now())->first();
            if(!$has_record) {
                $has_record = TodayMeetingCount::create([
                    'key' => 'today_follow_up_count',
                    'user_id'=>Auth::user()->id,
                    'date' => Carbon::now(),
                ]);
            }
            if($has_record->is_read == 0){
                $count = $follow_ups->count().' Follow Up';
                return response()->json(['status'=>'success','count'=>$count,'id'=>$has_record->id]);
            }
            else{
                return response()->json(['status' => 'error']);
            }
        }
        else{
            return response()->json(['status' => 'error']);
        }
    }
}
