<?php

namespace Database\Seeders;

use App\Models\StatusType;
use Illuminate\Database\Seeder;

class StatusTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusType::create([
            'name' => 'location',
            'created_by' => 1,
        ]);
        StatusType::create([
            'name' => 'noc',
            'created_by' => 1,
        ]);
        StatusType::create([
            'name' => 'society',
            'created_by' => 1,
        ]);
        StatusType::create([
            'name' => 'Employee',
            'created_by' => 1,
        ]);
        StatusType::create([
            'name' => 'sector',
            'created_by' => 1,
        ]);
        StatusType::create([
            'name' => 'Sales',
            'created_by' => 1,
        ]);
    }
}
