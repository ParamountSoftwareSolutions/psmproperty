<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create([
            'name' => 'active',
            'status_type_id' => 1,
            'created_by' => 1,
        ]);
        Status::create([
            'name' => 'active',
            'status_type_id' => 2,
            'created_by' => 1,
        ]);
        Status::create([
            'name' => 'active',
            'status_type_id' => 3,
            'created_by' => 1,
        ]);
        Status::create([
            'name' => 'pending',
            'status_type_id' => 3,
            'created_by' => 1,
        ]);
        Status::create([
            'name' => 'deleted',
            'status_type_id' => 3,
            'created_by' => 1,
        ]);
        Status::create([
            'name' => 'delete',
            'status_type_id' => 3,
            'created_by' => 1,
        ]);
        Status::create([
            'name' => 'active',
            'status_type_id' => 5,
            'created_by' => 1,
        ]);
        Status::create([
            'name' => 'pending',
            'status_type_id' => 1,
            'created_by' => 1,
        ]);
        Status::create([
            'name' => 'Not Paid',
            'status_type_id' => 6,
            'created_by' => 1,
        ]);
        Status::create([
            'name' => 'Paid',
            'status_type_id' => 1,
            'created_by' => 1,
        ]);
    }
}
