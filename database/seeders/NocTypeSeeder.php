<?php

namespace Database\Seeders;

use App\Models\NocType;
use Illuminate\Database\Seeder;

class NocTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NocType::create([
            'name' => 'LDA',
            'created_by' => 1,
            'status_id' => 2
        ]);

        NocType::create([
            'name' => 'LDPC',
            'created_by' => 1,
            'status_id' => 2
        ]);

        NocType::create([
            'name' => 'LDPC',
            'created_by' => 1,
            'status_id' => 2
        ]);
    }
}
