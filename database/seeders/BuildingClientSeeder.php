<?php

namespace Database\Seeders;

use App\Models\BuildingCustomer;
use Illuminate\Database\Seeder;

class BuildingClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BuildingCustomer::create([
            'building_app_id' => 1,
            'property_admin_id' => 10,
            'building_sale_id' => 1,
        ]);
    }
}
