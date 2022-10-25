<?php

namespace Database\Seeders;

use App\Models\ClientPlot;
use Illuminate\Database\Seeder;

class ClientPlotsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ClientPlot::insert([
            [
                'client_id' => 1,
                'society_id' => 1,
                'agent_id' => 4,
                'plot_number' => 'ABC-5-MARLA',
                'plot_size' => mt_rand(1, 10),
                'amount' => 0,
                'status_id' => 0,
            ],
            [
                'client_id' => 2,
                'society_id' => 1,
                'agent_id' => 4,
                'plot_number' => 'ABC-3-MARLA',
                'plot_size' => mt_rand(1, 10),
                'amount' => 0,
                'status_id' => 0,
            ]
        ]);
    }
}
