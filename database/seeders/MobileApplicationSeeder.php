<?php

namespace Database\Seeders;

use App\Models\BuildingMobileApplication;
use App\Models\MobileApplication;
use Illuminate\Database\Seeder;

class MobileApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MobileApplication::create([
            'app_key' => 'mobile_app8',
            'customer_id' => 6,
            'society_id' => 1,
        ]);

        BuildingMobileApplication::create([
            'property_admin_id' => 10,
            'app_key' => 'mobile_app8',
        ]);
    }
}
