<?php

namespace Database\Seeders;

use App\Models\Society;
use Illuminate\Database\Seeder;

class SocietySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Society::insert([
            [
                'user_id' => 2,
                'owner_name' => 'zain',
                'society_name' => 'Lake City',
                'assign_id' => 3,
                'city_id' => 1,
                'province_id' => 1,
                'address' => 'Lahore, Pakistan',
                'society_type_id' => mt_rand(1, 2),
                'noc_type_id' => mt_rand(1, 3),
                'area' => 3000,
                'images_array' => '["Toyda6PBa21fFPcNbJVaGInu7jAIshwNfRUkVQBw.png"]',
                'details' => 'Testing',
                'status_id' => 3,
            ],
            [
                'user_id' => 2,
                'owner_name' => 'tahir',
                'society_name' => 'Pia city',
                'assign_id' => 4,
                'city_id' => 1,
                'province_id' => 1,
                'address' => 'Lahore, Pakistan',
                'society_type_id' => mt_rand(1, 2),
                'noc_type_id' => mt_rand(1, 3),
                'area' => 3000,
                'images_array' => '["Toyda6PBa21fFPcNbJVaGInu7jAIshwNfRUkVQBw.png"]',
                'details' => 'Testing',
                'status_id' => 3,
            ],

        ]);
    }
}
