<?php

namespace Database\Seeders;

use App\Models\BuildingRequest;
use Illuminate\Database\Seeder;

class BuildingRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BuildingRequest::insert([
            [
                'building_id' => 1,
                'transfer_to' => 6,
                'unit_id' => '1201',
                'date' => '2000-01-01',
                'type' => 'possession',
                'status' => 'pending'
            ],
            [
                'building_id' => 1,
                'transfer_to' => 6,
                'unit_id' => '1202',
                'date' => '2000-01-01',
                'type' => 'possession',
                'status' => 'pending'
            ],
            [
                'building_id' => 1,
                'transfer_to' => 6,
                'unit_id' => '1203',
                'date' => '2000-01-01',
                'type' => 'possession',
                'status' => 'pending'
            ],
            [
                'building_id' => 2,
                'transfer_to' => 6,
                'unit_id' => '1204',
                'date' => '2000-01-01',
                'type' => 'file',
                'status' => 'pending'
            ],
            [
                'building_id' => 2,
                'transfer_to' => 6,
                'unit_id' => '1205',
                'date' => '2000-01-01',
                'type' => 'file',
                'status' => 'pending'
            ],
            [
                'building_id' => 2,
                'transfer_to' => 6,
                'unit_id' => '1206',
                'date' => '2000-01-01',
                'type' => 'file',
                'status' => 'pending'
            ],
            [
                'building_id' => 3,
                'transfer_to' => 6,
                'unit_id' => '1207',
                'date' => '2000-01-01',
                'type' => 'file',
                'status' => 'pending'
            ],
            [
                'building_id' => 3,
                'transfer_to' => 6,
                'unit_id' => '1208',
                'date' => '2000-01-01',
                'type' => 'transfer',
                'status' => 'pending'
            ],
            [
                'building_id' => 3,
                'transfer_to' => 6,
                'unit_id' => '1209',
                'date' => '2000-01-01',
                'type' => 'transfer',
                'status' => 'pending'
            ],
        ]);
    }
}
