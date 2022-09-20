<?php

namespace Database\Seeders;

use App\Models\SocietySection;
use Illuminate\Database\Seeder;

class SocietySectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SocietySection::insert([
            [
               'name' => 'Employee',
                'created_by' => 1,
                'status_id' => 1,
            ],
            [
                'name' => 'Sales',
                'created_by' => 1,
                'status_id' => 1,
            ],
            [
                'name' => 'Hrm',
                'created_by' => 1,
                'status_id' => 1,
            ],
            [
                'name' => 'Agent',
                'created_by' => 1,
                'status_id' => 1,
            ],
        ]);
    }
}
