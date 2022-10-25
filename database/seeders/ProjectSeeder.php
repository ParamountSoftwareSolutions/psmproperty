<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::insert([
            [
                'society_id' => 1,
                'name' => 'building',
                'type' => 'plza',
                'start_date' => '2021-12-23',
                'area' => '10knal',
                'image' => 'https://psspropertiesmanager.com/public/images/project/I8rSzOS6vZdW3hIZarq8PdvU4vFk3lRhemqY9f23.jpg',
                'start_price' => '1.0 cror',
                'end_price' => '5.0 cror',
                'address' => 'paragon lahore pakistan'
            ],
            [
                'society_id' => 1,
                'name' => 'Plot',
                'type' => 'town',
                'start_date' => '2021-12-23',
                'area' => '10knal',
                'image' => 'https://psspropertiesmanager.com/public/images/project/I8rSzOS6vZdW3hIZarq8PdvU4vFk3lRhemqY9f23.jpg',
                'start_price' => '1.0 cror',
                'end_price' => '5.0 cror',
                'address' => 'paragon lahore pakistan'
            ],
            [
                'society_id' => 1,
                'name' => 'plaza',
                'type' => 'town',
                'start_date' => '2021-12-23',
                'area' => '10knal',
                'image' => 'https://psspropertiesmanager.com/public/images/project/I8rSzOS6vZdW3hIZarq8PdvU4vFk3lRhemqY9f23.jpg',
                'start_price' => '1.0 cror',
                'end_price' => '5.0 cror',
                'address' => 'paragon lahore pakistan'
            ],
        ]);
    }
}
