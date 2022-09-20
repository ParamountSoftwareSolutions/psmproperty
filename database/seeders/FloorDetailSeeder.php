<?php

namespace Database\Seeders;

use App\Models\BuildingPaymentPlan;
use App\Models\FloorDetail;
use App\Models\FloorDetailFile;
use App\Models\PaymentPlan;
use Illuminate\Database\Seeder;

class FloorDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BuildingPaymentPlan::create([
            'property_admin_id' => 10,
            'name' => 'Default',
            'total_month_installment' => 48,
            'total_price' => 2100000,
            'booking_price' => 200000,
            //'form_submission' => 50000,
            'per_month_installment' => 15000,
            'half_year_installment' => 60000,
            'balloting_price' => 400000,
            'possession_price' => 300000,
        ]);

        FloorDetail::insert([
            [
                'building_id' => 1,
                'floor_id' => mt_rand(1, 7),
                'unit_id' => '1201',
                'area' => '120',
                'total_month_installment' => 48,
                'total_price' => 2150000,
                'booking_price' => 200000,
                'form_submission' => 50000,
                'per_month_installment' => 15000,
                'half_year_installment' => 60000,
                'balloting_price' => 400000,
                'possession_price' => 300000,
                'type' => 'studio',
                'status' => 'available',
            ],
            [
                'building_id' => 1,
                'floor_id' => mt_rand(1, 7),
                'unit_id' => '1202',
                'area' => '120',
                'total_month_installment' => 48,
                'total_price' => 2150000,
                'booking_price' => 200000,
                'form_submission' => 50000,
                'per_month_installment' => 15000,
                'half_year_installment' => 60000,
                'balloting_price' => 400000,
                'possession_price' => 300000,
                'type' => 'studio',
                'status' => 'available',
            ],
            [
                'building_id' => 1,
                'floor_id' => mt_rand(1, 7),
                'unit_id' => '1203',
                'area' => '120',
                'total_month_installment' => 48,
                'total_price' => 2150000,
                'booking_price' => 200000,
                'form_submission' => 50000,
                'per_month_installment' => 15000,
                'half_year_installment' => 60000,
                'balloting_price' => 400000,
                'possession_price' => 300000,
                'type' => 'apartment',
                'status' => 'available',
            ],
            [
                'building_id' => 2,
                'floor_id' => mt_rand(1, 7),
                'unit_id' => '1204',
                'area' => '120',
                'total_month_installment' => 48,
                'total_price' => 2150000,
                'booking_price' => 200000,
                'form_submission' => 50000,
                'per_month_installment' => 15000,
                'half_year_installment' => 60000,
                'balloting_price' => 400000,
                'possession_price' => 300000,
                'type' => 'studio',
                'status' => 'available',
            ],
            [
                'building_id' => 2,
                'floor_id' => mt_rand(1, 7),
                'unit_id' => '1205',
                'area' => '120',
                'total_month_installment' => 48,
                'total_price' => 2150000,
                'booking_price' => 200000,
                'form_submission' => 50000,
                'per_month_installment' => 15000,
                'half_year_installment' => 60000,
                'balloting_price' => 400000,
                'possession_price' => 300000,
                'type' => 'studio',
                'status' => 'available',
            ],
            [
                'building_id' => 2,
                'floor_id' => mt_rand(1, 7),
                'unit_id' => '1206',
                'area' => '120',
                'total_month_installment' => 48,
                'total_price' => 2150000,
                'booking_price' => 200000,
                'form_submission' => 50000,
                'per_month_installment' => 15000,
                'half_year_installment' => 60000,
                'balloting_price' => 400000,
                'possession_price' => 300000,
                'type' => 'studio',
                'status' => 'available',
            ],
            [
                'building_id' => 3,
                'floor_id' => mt_rand(1, 7),
                'unit_id' => '1207',
                'area' => '120',
                'total_month_installment' => 48,
                'total_price' => 2150000,
                'booking_price' => 200000,
                'form_submission' => 50000,
                'per_month_installment' => 15000,
                'half_year_installment' => 60000,
                'balloting_price' => 400000,
                'possession_price' => 300000,
                'type' => 'studio',
                'status' => 'available',
            ],
            [
                'building_id' => 3,
                'floor_id' => mt_rand(1, 7),
                'unit_id' => '1208',
                'area' => '120',
                'total_month_installment' => 48,
                'total_price' => 2150000,
                'booking_price' => 200000,
                'form_submission' => 50000,
                'per_month_installment' => 15000,
                'half_year_installment' => 60000,
                'balloting_price' => 400000,
                'possession_price' => 300000,
                'type' => 'studio',
                'status' => 'available',
            ],
            [
                'building_id' => 3,
                'floor_id' => mt_rand(1, 7),
                'unit_id' => '1209',
                'area' => '120',
                'total_month_installment' => 48,
                'total_price' => 2150000,
                'booking_price' => 200000,
                'form_submission' => 50000,
                'per_month_installment' => 15000,
                'half_year_installment' => 60000,
                'balloting_price' => 400000,
                'possession_price' => 300000,
                'type' => 'studio',
                'status' => 'available',
            ],
        ]);
        /*FloorDetailFile::insert([

        ]);*/
    }
}
