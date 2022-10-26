<?php

namespace App\Http\Controllers\Property;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\BuildingSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function push_notification()
    {
        if (BuildingSetting::where(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'property_create'])->first() == false) {
            BuildingSetting::insert([
                'user_id' => Auth::id(),
                'user_type' => Auth::user()->roles[0]->name,
                'key' => 'property_create',
                'value' => json_encode([
                    'status' => 0,
                    'message' => '',
                ]),
            ]);
        }

        if (BuildingSetting::where(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'lead_add'])->first() == false) {
            BuildingSetting::insert([
                'user_id' => Auth::id(),
                'user_type' => Auth::user()->roles[0]->name,
                'key' => 'lead_add',
                'value' => json_encode([
                    'status' => 0,
                    'message' => '',
                ]),
            ]);
        }

        if (BuildingSetting::where(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'lead_update'])->first() == false) {
            BuildingSetting::insert([
                'user_id' => Auth::id(),
                'user_type' => Auth::user()->roles[0]->name,
                'key' => 'lead_update',
                'value' => json_encode([
                    'status' => 0,
                    'message' => '',
                ]),
            ]);
        }

        if (BuildingSetting::where(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'lead_follow_up'])->first() == false) {
            BuildingSetting::insert([
                'user_id' => Auth::id(),
                'user_type' => Auth::user()->roles[0]->name,
                'key' => 'lead_follow_up',
                'value' => json_encode([
                    'status' => 0,
                    'message' => '',
                ]),
            ]);
        }

        if (BuildingSetting::where(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'lead_discussion'])->first() == false) {
            BuildingSetting::insert([
                'user_id' => Auth::id(),
                'user_type' => Auth::user()->roles[0]->name,
                'key' => 'lead_discussion',
                'value' => json_encode([
                    'status' => 0,
                    'message' => '',
                ]),
            ]);
        }

        if (BuildingSetting::where(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'lead_negotiation'])->first() == false) {
            BuildingSetting::insert([
                'user_id' => Auth::id(),
                'user_type' => Auth::user()->roles[0]->name,
                'key' => 'lead_negotiation',
                'value' => json_encode([
                    'status' => 0,
                    'message' => '',
                ]),
            ]);
        }

        if (BuildingSetting::where(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'lead_lost'])->first() == false) {
            BuildingSetting::insert([
                'user_id' => Auth::id(),
                'user_type' => Auth::user()->roles[0]->name,
                'key' => 'lead_lost',
                'value' => json_encode([
                    'status' => 0,
                    'message' => '',
                ]),
            ]);
        }

        if (BuildingSetting::where(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'lead_mature'])->first() == false) {
            BuildingSetting::insert([
                'user_id' => Auth::id(),
                'user_type' => Auth::user()->roles[0]->name,
                'key' => 'lead_mature',
                'value' => json_encode([
                    'status' => 0,
                    'message' => '',
                ]),
            ]);
        }

        if (BuildingSetting::where(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'sale_add'])->first() == false) {
            BuildingSetting::insert([
                'user_id' => Auth::id(),
                'user_type' => Auth::user()->roles[0]->name,
                'key' => 'sale_add',
                'value' => json_encode([
                    'status' => 0,
                    'message' => '',
                ]),
            ]);
        }

        if (BuildingSetting::where(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'sale_update'])->first() == false) {
            BuildingSetting::insert([
                'user_id' => Auth::id(),
                'user_type' => Auth::user()->roles[0]->name,
                'key' => 'sale_update',
                'value' => json_encode([
                    'status' => 0,
                    'message' => '',
                ]),
            ]);
        }

        if (BuildingSetting::where(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'sale_active'])->first() == false) {
            BuildingSetting::insert([
                'user_id' => Auth::id(),
                'user_type' => Auth::user()->roles[0]->name,
                'key' => 'sale_active',
                'value' => json_encode([
                    'status' => 0,
                    'message' => '',
                ]),
            ]);
        }

        if (BuildingSetting::where(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'sale_suspended'])->first() == false) {
            BuildingSetting::insert([
                'user_id' => Auth::id(),
                'user_type' => Auth::user()->roles[0]->name,
                'key' => 'sale_suspended',
                'value' => json_encode([
                    'status' => 0,
                    'message' => '',
                ]),
            ]);
        }

        if (BuildingSetting::where(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'sale_transfer'])->first() == false) {
            BuildingSetting::insert([
                'user_id' => Auth::id(),
                'user_type' => Auth::user()->roles[0]->name,
                'key' => 'sale_transfer',
                'value' => json_encode([
                    'status' => 0,
                    'message' => '',
                ]),
            ]);
        }

        if (BuildingSetting::where(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'sale_cancel'])->first() == false) {
            BuildingSetting::insert([
                'user_id' => Auth::id(),
                'user_type' => Auth::user()->roles[0]->name,
                'key' => 'sale_cancel',
                'value' => json_encode([
                    'status' => 0,
                    'message' => '',
                ]),
            ]);
        }

        if (BuildingSetting::where(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'employee_create'])->first() == false) {
            BuildingSetting::insert([
                'user_id' => Auth::id(),
                'user_type' => Auth::user()->roles[0]->name,
                'key' => 'employee_create',
                'value' => json_encode([
                    'status' => 0,
                    'message' => '',
                ]),
            ]);
        }

        if (BuildingSetting::where(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'possession_create'])->first() == false) {
            BuildingSetting::insert([
                'user_id' => Auth::id(),
                'user_type' => Auth::user()->roles[0]->name,
                'key' => 'possession_create',
                'value' => json_encode([
                    'status' => 0,
                    'message' => '',
                ]),
            ]);
        }

        if (BuildingSetting::where(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'possession_accept'])->first() == false) {
            BuildingSetting::insert([
                'user_id' => Auth::id(),
                'user_type' => Auth::user()->roles[0]->name,
                'key' => 'possession_accept',
                'value' => json_encode([
                    'status' => 0,
                    'message' => '',
                ]),
            ]);
        }

        if (BuildingSetting::where(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'possession_rejected'])->first() == false) {
            BuildingSetting::insert([
                'user_id' => Auth::id(),
                'user_type' => Auth::user()->roles[0]->name,
                'key' => 'possession_rejected',
                'value' => json_encode([
                    'status' => 0,
                    'message' => '',
                ]),
            ]);
        }

        if (BuildingSetting::where(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'possession_pending'])->first() == false) {
            BuildingSetting::insert([
                'user_id' => Auth::id(),
                'user_type' => Auth::user()->roles[0]->name,
                'key' => 'possession_pending',
                'value' => json_encode([
                    'status' => 0,
                    'message' => '',
                ]),
            ]);
        }
        if (BuildingSetting::where(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'transfer_create'])->first() == false) {
            BuildingSetting::insert([
                'user_id' => Auth::id(),
                'user_type' => Auth::user()->roles[0]->name,
                'key' => 'transfer_create',
                'value' => json_encode([
                    'status' => 0,
                    'message' => '',
                ]),
            ]);
        }

        if (BuildingSetting::where(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'transfer_accept'])->first() == false) {
            BuildingSetting::insert([
                'user_id' => Auth::id(),
                'user_type' => Auth::user()->roles[0]->name,
                'key' => 'transfer_accept',
                'value' => json_encode([
                    'status' => 0,
                    'message' => '',
                ]),
            ]);
        }

        if (BuildingSetting::where(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'transfer_rejected'])->first() == false) {
            BuildingSetting::insert([
                'user_id' => Auth::id(),
                'user_type' => Auth::user()->roles[0]->name,
                'key' => 'transfer_rejected',
                'value' => json_encode([
                    'status' => 0,
                    'message' => '',
                ]),
            ]);
        }

        if (BuildingSetting::where(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'transfer_pending'])->first() == false) {
            BuildingSetting::insert([
                'user_id' => Auth::id(),
                'user_type' => Auth::user()->roles[0]->name,
                'key' => 'transfer_pending',
                'value' => json_encode([
                    'status' => 0,
                    'message' => '',
                ]),
            ]);
        }

        if (BuildingSetting::where(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'file_create'])->first() == false) {
            BuildingSetting::insert([
                'user_id' => Auth::id(),
                'user_type' => Auth::user()->roles[0]->name,
                'key' => 'file_create',
                'value' => json_encode([
                    'status' => 0,
                    'message' => '',
                ]),
            ]);
        }

        if (BuildingSetting::where(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'file_accept'])->first() == false) {
            BuildingSetting::insert([
                'user_id' => Auth::id(),
                'user_type' => Auth::user()->roles[0]->name,
                'key' => 'file_accept',
                'value' => json_encode([
                    'status' => 0,
                    'message' => '',
                ]),
            ]);
        }

        if (BuildingSetting::where(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'file_rejected'])->first() == false) {
            BuildingSetting::insert([
                'user_id' => Auth::id(),
                'user_type' => Auth::user()->roles[0]->name,
                'key' => 'file_rejected',
                'value' => json_encode([
                    'status' => 0,
                    'message' => '',
                ]),
            ]);
        }

        if (BuildingSetting::where(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'file_pending'])->first() == false) {
            BuildingSetting::insert([
                'user_id' => Auth::id(),
                'user_type' => Auth::user()->roles[0]->name,
                'key' => 'file_pending',
                'value' => json_encode([
                    'status' => 0,
                    'message' => '',
                ]),
            ]);
        }

        if (BuildingSetting::where(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'reserve_create'])->first() == false) {
            BuildingSetting::insert([
                'user_id' => Auth::id(),
                'user_type' => Auth::user()->roles[0]->name,
                'key' => 'reserve_create',
                'value' => json_encode([
                    'status' => 0,
                    'message' => '',
                ]),
            ]);
        }

        if (BuildingSetting::where(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'reserve_accept'])->first() == false) {
            BuildingSetting::insert([
                'user_id' => Auth::id(),
                'user_type' => Auth::user()->roles[0]->name,
                'key' => 'reserve_accept',
                'value' => json_encode([
                    'status' => 0,
                    'message' => '',
                ]),
            ]);
        }

        if (BuildingSetting::where(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'reserve_rejected'])->first() == false) {
            BuildingSetting::insert([
                'user_id' => Auth::id(),
                'user_type' => Auth::user()->roles[0]->name,
                'key' => 'reserve_rejected',
                'value' => json_encode([
                    'status' => 0,
                    'message' => '',
                ]),
            ]);
        }

        if (BuildingSetting::where(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'reserve_pending'])->first() == false) {
            BuildingSetting::insert([
                'user_id' => Auth::id(),
                'user_type' => Auth::user()->roles[0]->name,
                'key' => 'reserve_pending',
                'value' => json_encode([
                    'status' => 0,
                    'message' => '',
                ]),
            ]);
        }

        return view('property.setting.push_notification');
    }

    public function update_server_key(Request $request)
    {
        $server_key = User::updateOrCreate(['id' => Auth::id()], [
            'server_key' => $request->server_key,
        ]);

        if ($server_key) {
            return redirect()->route('property_admin.setting.push_notification')->with(['alert' => 'success', 'message' => 'Server Key Update Successfully']);
        } else {
            return redirect()->back()->with(['alert' => 'error', 'message' => 'Server Key Update Error']);
        }
    }

    public function update_push_notification(Request $request)
    {
        BuildingSetting::updateOrInsert(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'property_create'], [
            'value' => json_encode([
                'status' => $request['property_create_status'] == 'on' ? 1 : 0,
                'message' => $request['property_create_message'],
            ]),
        ]);

        BuildingSetting::updateOrInsert(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'lead_add'], [
            'value' => json_encode([
                'status' => $request['lead_add_status'] == 'on' ? 1 : 0,
                'message' => $request['lead_add_message'],
            ]),
        ]);

        BuildingSetting::updateOrInsert(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'lead_update'], [
            'value' => json_encode([
                'status' => $request['lead_update_status'] == 'on' ? 1 : 0,
                'message' => $request['lead_update_message'],
            ]),
        ]);

        BuildingSetting::updateOrInsert(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'lead_follow_up'], [
            'value' => json_encode([
                'status' => $request['lead_follow_up_status'] == 'on' ? 1 : 0,
                'message' => $request['lead_follow_up_message'],
            ]),
        ]);

        BuildingSetting::updateOrInsert(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'lead_discussion'], [
            'value' => json_encode([
                'status' => $request['lead_discussion_status'] == 'on' ? 1 : 0,
                'message' => $request['lead_discussion_message'],
            ]),
        ]);

        BuildingSetting::updateOrInsert(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'lead_negotiation'], [
            'value' => json_encode([
                'status' => $request['lead_negotiation_status'] == 'on' ? 1 : 0,
                'message' => $request['lead_negotiation_message'],
            ]),
        ]);

        BuildingSetting::updateOrInsert(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'lead_lost'], [
            'value' => json_encode([
                'status' => $request['lead_lost_status'] == 'on' ? 1 : 0,
                'message' => $request['lead_lost_message'],
            ]),
        ]);

        BuildingSetting::updateOrInsert(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'lead_mature'], [
            'value' => json_encode([
                'status' => $request['lead_mature_status'] == 'on' ? 1 : 0,
                'message' => $request['lead_mature_message'],
            ]),
        ]);

        BuildingSetting::updateOrInsert(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'sale_add'], [
            'value' => json_encode([
                'status' => $request['sale_add_status'] == 'on' ? 1 : 0,
                'message' => $request['sale_add_message'],
            ]),
        ]);

        BuildingSetting::updateOrInsert(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'sale_update'], [
            'value' => json_encode([
                'status' => $request['sale_update_status'] == 'on' ? 1 : 0,
                'message' => $request['sale_update_message'],
            ]),
        ]);

        BuildingSetting::updateOrInsert(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'sale_active'], [
            'value' => json_encode([
                'status' => $request['sale_active_status'] == 'on' ? 1 : 0,
                'message' => $request['sale_active_message'],
            ]),
        ]);

        BuildingSetting::updateOrInsert(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'sale_suspended'], [
            'value' => json_encode([
                'status' => $request['sale_suspended_status'] == 'on' ? 1 : 0,
                'message' => $request['sale_suspended_message'],
            ]),
        ]);

        BuildingSetting::updateOrInsert(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'sale_cancel'], [
            'value' => json_encode([
                'status' => $request['sale_cancel_status'] == 'on' ? 1 : 0,
                'message' => $request['sale_cancel_message'],
            ]),
        ]);

        BuildingSetting::updateOrInsert(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'sale_transfer'], [
            'value' => json_encode([
                'status' => $request['sale_transfer_status'] == 'on' ? 1 : 0,
                'message' => $request['sale_transfer_message'],
            ]),
        ]);

        BuildingSetting::updateOrInsert(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'employee_create'], [
            'value' => json_encode([
                'status' => $request['employee_create_status'] == 'on' ? 1 : 0,
                'message' => $request['employee_create_message'],
            ]),
        ]);

        BuildingSetting::updateOrInsert(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'property_create'], [
            'value' => json_encode([
                'status' => $request['property_create_status'] == 'on' ? 1 : 0,
                'message' => $request['property_create_message'],
            ]),
        ]);

        BuildingSetting::updateOrInsert(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'possession_create'], [
            'value' => json_encode([
                'status' => $request['possession_create_status'] == 'on' ? 1 : 0,
                'message' => $request['possession_create_message'],
            ]),
        ]);

        BuildingSetting::updateOrInsert(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'possession_accept'], [
            'value' => json_encode([
                'status' => $request['possession_accept_status'] == 'on' ? 1 : 0,
                'message' => $request['possession_accept_message'],
            ]),
        ]);

        BuildingSetting::updateOrInsert(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'possession_rejected'], [
            'value' => json_encode([
                'status' => $request['possession_rejected_status'] == 'on' ? 1 : 0,
                'message' => $request['possession_rejected_message'],
            ]),
        ]);

        BuildingSetting::updateOrInsert(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'possession_pending'], [
            'value' => json_encode([
                'status' => $request['possession_pending_status'] == 'on' ? 1 : 0,
                'message' => $request['possession_pending_message'],
            ]),
        ]);

        BuildingSetting::updateOrInsert(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'transfer_create'], [
            'value' => json_encode([
                'status' => $request['transfer_create_status'] == 'on' ? 1 : 0,
                'message' => $request['transfer_create_message'],
            ]),
        ]);

        BuildingSetting::updateOrInsert(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'transfer_accept'], [
            'value' => json_encode([
                'status' => $request['transfer_accept_status'] == 'on' ? 1 : 0,
                'message' => $request['transfer_accept_message'],
            ]),
        ]);

        BuildingSetting::updateOrInsert(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'transfer_rejected'], [
            'value' => json_encode([
                'status' => $request['transfer_rejected_status'] == 'on' ? 1 : 0,
                'message' => $request['transfer_rejected_message'],
            ]),
        ]);

        BuildingSetting::updateOrInsert(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'transfer_pending'], [
            'value' => json_encode([
                'status' => $request['transfer_pending_status'] == 'on' ? 1 : 0,
                'message' => $request['transfer_pending_message'],
            ]),
        ]);

        BuildingSetting::updateOrInsert(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'file_create'], [
            'value' => json_encode([
                'status' => $request['file_create_status'] == 'on' ? 1 : 0,
                'message' => $request['file_create_message'],
            ]),
        ]);

        BuildingSetting::updateOrInsert(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'file_accept'], [
            'value' => json_encode([
                'status' => $request['file_accept_status'] == 'on' ? 1 : 0,
                'message' => $request['file_accept_message'],
            ]),
        ]);

        BuildingSetting::updateOrInsert(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'file_rejected'], [
            'value' => json_encode([
                'status' => $request['file_rejected_status'] == 'on' ? 1 : 0,
                'message' => $request['file_rejected_message'],
            ]),
        ]);

        BuildingSetting::updateOrInsert(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'file_pending'], [
            'value' => json_encode([
                'status' => $request['file_pending_status'] == 'on' ? 1 : 0,
                'message' => $request['file_pending_message'],
            ]),
        ]);

        BuildingSetting::updateOrInsert(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'reserve_create'], [
            'value' => json_encode([
                'status' => $request['reserve_create_status'] == 'on' ? 1 : 0,
                'message' => $request['reserve_create_message'],
            ]),
        ]);

        BuildingSetting::updateOrInsert(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'reserve_accept'], [
            'value' => json_encode([
                'status' => $request['reserve_accept_status'] == 'on' ? 1 : 0,
                'message' => $request['reserve_accept_message'],
            ]),
        ]);

        BuildingSetting::updateOrInsert(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'reserve_rejected'], [
            'value' => json_encode([
                'status' => $request['reserve_rejected_status'] == 'on' ? 1 : 0,
                'message' => $request['reserve_rejected_message'],
            ]),
        ]);

        BuildingSetting::updateOrInsert(['user_id' => Auth::id(), 'user_type' => Auth::user()->roles[0]->name, 'key' => 'reserve_pending'], [
            'value' => json_encode([
                'status' => $request['reserve_pending_status'] == 'on' ? 1 : 0,
                'message' => $request['reserve_pending_message'],
            ]),
        ]);


        return redirect()->route('property_admin.setting.push_notification')->with(['alert' => 'success', 'message' => 'Notification Update Successfully']);
    }
}
