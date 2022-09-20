<?php

namespace Database\Seeders;

use App\Models\BuildingSlider;
use Illuminate\Database\Seeder;

class BuildingSliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BuildingSlider::insert([
            [
                'property_admin_id' => 10,
                'image' => 'public/images/building/1737523259983413.jpg',
            ],
            [
                'property_admin_id' => 10,
                'image' => 'public/images/building/1737523259983413.jpg',
            ],
            [
                'property_admin_id' => 10,
                'image' => 'public/images/building/1737523259981873.jpg',
            ],
            [
                'property_admin_id' => 10,
                'image' => 'public/images/building/1737523259982791.jpg',
            ],
        ]);
    }
}
