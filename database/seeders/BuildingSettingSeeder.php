<?php

namespace Database\Seeders;

use App\Models\BuildingSetting;
use Illuminate\Database\Seeder;

class BuildingSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BuildingSetting::insert([
            [
                'user_id' => 10,
                'user_type' => 'property_admin',
                'key' => 'lead_add',
                'value' => '{"status":0,"message":"New Lead Add Successfully"}',
            ],
            [
                'user_id' => 10,
                'user_type' => 'property_admin',
                'key' => 'lead_update',
                'value' => '{"status":0,"message":"Lead Update Successfully"}',
            ],
            [
                'user_id' => 10,
                'user_type' => 'property_admin',
                'key' => 'lead_follow_up',
                'value' => '{"status":0,"message":"Lead Follow up on Time"}',
            ],[
                'user_id' => 10,
                'user_type' => 'property_admin',
                'key' => 'lead_discussion',
                'value' => '{"status":0,"message":"Lead Discussion"}',
            ],[
                'user_id' => 10,
                'user_type' => 'property_admin',
                'key' => 'lead_negotiation',
                'value' => '{"status":0,"message":"Lead Negotiation"}',
            ],[
                'user_id' => 10,
                'user_type' => 'property_admin',
                'key' => 'lead_lost',
                'value' => '{"status":0,"message":"Lead Lost"}',
            ],[
                'user_id' => 10,
                'user_type' => 'property_admin',
                'key' => 'lead_mature',
                'value' => '{"status":0,"message":"Lead Mature"}',
            ],
            [
                'user_id' => 10,
                'user_type' => 'property_admin',
                'key' => 'sale_add',
                'value' => '{"status":0,"message":"Sale Add"}',
            ],
            [
                'user_id' => 10,
                'user_type' => 'property_admin',
                'key' => 'sale_update',
                'value' => '{"status":0,"message":"Sale Update"}',
            ],
            [
                'user_id' => 10,
                'user_type' => 'property_admin',
                'key' => 'sale_active',
                'value' => '{"status":0,"message":"Sale Active"}',
            ],
            [
                'user_id' => 10,
                'user_type' => 'property_admin',
                'key' => 'sale_cancel',
                'value' => '{"status":0,"message":"Sale Cancel"}',
            ],
            [
                'user_id' => 10,
                'user_type' => 'property_admin',
                'key' => 'sale_lost',
                'value' => '{"status":0,"message":"Sale Lost"}',
            ],
            [
                'user_id' => 10,
                'user_type' => 'property_admin',
                'key' => 'employee_create',
                'value' => '{"status":0,"message":"Employee Create"}',
            ],
            [
                'user_id' => 10,
                'user_type' => 'property_admin',
                'key' => 'property_create',
                'value' => '{"status":0,"message":"Property Create"}',
            ],
            [
                'user_id' => 10,
                'user_type' => 'property_admin',
                'key' => 'possession_update',
                'value' => '{"status":0,"message":""}',
            ],
            [
                'user_id' => 10,
                'user_type' => 'property_admin',
                'key' => 'possession_accept',
                'value' => '{"status":0,"message":"Possession Accept"}',
            ],
            [
                'user_id' => 10,
                'user_type' => 'property_admin',
                'key' => 'possession_rejected',
                'value' => '{"status":0,"message":"Possession Rejected"}',
            ],
            [
                'user_id' => 10,
                'user_type' => 'property_admin',
                'key' => 'transfer_pending',
                'value' => '{"status":0,"message":"Transfer Pending"}',
            ],
            [
                'user_id' => 10,
                'user_type' => 'property_admin',
                'key' => 'transfer_create',
                'value' => '{"status":0,"message":"Transfer Create"}',
            ],
            [
                'user_id' => 10,
                'user_type' => 'property_admin',
                'key' => 'transfer_accept',
                'value' => '{"status":0,"message":"Transfer Accept"}',
            ],
            [
                'user_id' => 10,
                'user_type' => 'property_admin',
                'key' => 'transfer_rejected',
                'value' => '{"status":0,"message":"Transfer Rejected"}',
            ],
            [
                'user_id' => 10,
                'user_type' => 'property_admin',
                'key' => 'transfer_pending',
                'value' => '{"status":0,"message":"Transfer Pending"}',
            ],
            [
                'user_id' => 10,
                'user_type' => 'property_admin',
                'key' => 'file_create',
                'value' => '{"status":0,"message":"File create"}',
            ],
            [
                'user_id' => 10,
                'user_type' => 'property_admin',
                'key' => 'file_accept',
                'value' => '{"status":0,"message":"File accept"}',
            ],
            [
                'user_id' => 10,
                'user_type' => 'property_admin',
                'key' => 'file_rejected',
                'value' => '{"status":0,"message":"file rejected"}',
            ],
            [
                'user_id' => 10,
                'user_type' => 'property_admin',
                'key' => 'file_pending',
                'value' => '{"status":0,"message":"file pending"}',
            ],
            [
                'user_id' => 10,
                'user_type' => 'property_admin',
                'key' => 'reserve_create',
                'value' => '{"status":0,"message":"reserve create"}',
            ],
            [
                'user_id' => 10,
                'user_type' => 'property_admin',
                'key' => 'reserve_accept',
                'value' => '{"status":0,"message":"reserve accept"}',
            ],
            [
                'user_id' => 10,
                'user_type' => 'property_admin',
                'key' => 'reserve_rejected',
                'value' => '{"status":0,"message":"reserve rejected"}',
            ],
            [
                'user_id' => 10,
                'user_type' => 'property_admin',
                'key' => 'reserve_pending',
                'value' => '{"status":0,"message":"reserve pending"}',
            ],
            [
                'user_id' => 10,
                'user_type' => 'property_admin',
                'key' => 'online_booking_accept',
                'value' => '{"status":0,"message":"Online Booking Accept"}',
            ],
            [
                'user_id' => 10,
                'user_type' => 'property_admin',
                'key' => 'online_booking_rejected',
                'value' => '{"status":0,"message":"Online Booking Rejected"}',
            ],
            [
                'user_id' => 10,
                'user_type' => 'property_admin',
                'key' => 'installment_reminder',
                'value' => '{"status":1,"message":"Please clear your due amount"}',
            ],

        ]);
    }
}
