<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::create([
            'user_id' => mt_rand(5, 7),
            'society_id' => 1,
            'agent_id' => 5,
            'city_id' => 1,
            'province_id' => 1,
            'cnic' => 32123213112,
            'address' => 'Lahore, Pakistan'
        ]);

        Client::create([
            'user_id' => mt_rand(5, 7),
            'society_id' => 2,
            'agent_id' => 5,
            'city_id' => 1,
            'province_id' => 1,
            'cnic' => 32123213123,
            'address' => 'Lahore, Pakistan'
        ]);
    }
}
