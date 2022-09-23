<?php

namespace Database\Seeders;

use App\Models\SocietyType;
use Illuminate\Database\Seeder;

class SocietyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SocietyType::create([
            'name' => 'Govt',
            'created_by' => 1,
            'status_id' => 1,
        ]);

        SocietyType::create([
            'name' => 'Private',
            'created_by' => 1,
            'status_id' => 5,
        ]);
    }
}
