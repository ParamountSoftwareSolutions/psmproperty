<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Floor extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Floor::insert([
           [
               'name' => 'Lower Ground'
           ],
            [
                'name' => 'Ground'
            ],
            [
                'name' => 'First'
            ],
            [
                'name' => 'Second'
            ],
            [
                'name' => 'Third'
            ],
            [
                'name' => 'Forth'
            ],
            [
                'name' => 'Top'
            ]
        ]);
    }
}
