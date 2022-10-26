<?php

namespace Database\Seeders;

use App\Models\Building;
use App\Models\BuildingAssignUser;
use App\Models\BuildingEmployee;
use Illuminate\Database\Seeder;

class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Building::insert([
            [
                'name' => 'Zaitoon City',
                'floor_list' => '["1","2","6"]',
                'type' => '["apartment","shop","studio"]',
                'apartment_size' => "['1', '2', '3', '4', '5']",
                'total_area' => '120 sq',
            ],
            [
                'name' => 'Al Fathy',
                'floor_list' => '["1", "3", "5"]',
                'type' => '["apartment","shop","studio"]',
                'apartment_size' => "['1', '2', '3', '4', '5']",
                'total_area' => '120 sq',
            ],
            [
                'name' => 'Maham Apartment',
                'floor_list' => '["2","3","4","5"]',
                'type' => '["apartment","shop","studio"]',
                'apartment_size' => "['1', '2', '3', '4', '5']",
                'total_area' => '120 sq',
            ],
        ]);

        BuildingAssignUser::insert([
            //admin
            [
                'building_id' => 1,
                'user_id' => 10,
            ],
            [
                'building_id' => 2,
                'user_id' => 10,
            ],
            [
                'building_id' => 3,
                'user_id' => 10,
            ],
            //manager
            [
                'building_id' => 1,
                'user_id' => 11,
            ],
            [
                'building_id' => 1,
                'user_id' => 12,
            ],
            [
                'building_id' => 2,
                'user_id' => 12,
            ],
            //Employee 7 id
            [
                'building_id' => 1,
                'user_id' => 13,
            ],

        ]);


        BuildingEmployee::create([
            'building_id' => 1,
            'user_id' => 13,
            'sale_manager_id' => 12,
            'cnic' => '123456784534',
            'address' => 'lahore',
            'account_no' => '1234521312',
            'salary' => 20000,
            'commission' => 5,
        ]);
    }
}
