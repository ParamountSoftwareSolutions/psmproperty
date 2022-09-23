<?php

namespace Database\Seeders;

use App\Models\SocietyCategory;
use Illuminate\Database\Seeder;

class SocietyCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SocietyCategory::create([
            'name' => 'Plot',
            'fields_json_array' => '{"size":[{"value":"3","unit":"Marla"},{"value":"5","unit":"Marla"},{"value":"7","unit":"Marla"},{"value":"10","unit":"Marla"},{"value":"15","unit":"Marla"}],"type":[{"value":"Residential"},{"value":"Commercial"}],"premium":[{"value":"Corner"},{"value":"Main-Boulevard"},{"value":"Park-Facing"}]}',
            'created_by' => 1,
            'parent_id' => -1,
            'status_id' => 3,
        ]);

        SocietyCategory::create([
            'name' => 'Villa',
            'fields_json_array' => '{"size":[{"value":"3","unit":"room"},{"value":"5","unit":"room"}],"type":[{"value":"Residential"},{"value":"Commercial"}],"premium":[{"value":"Corner"},{"value":"Main-Boulevard"},{"value":"Park-Facing"}]}',
            'created_by' => 1,
            'parent_id' => -1,
            'status_id' => 3,
        ]);

        SocietyCategory::create([
            'name' => 'Apartment',
            'fields_json_array' => '{"size":[{"value":"1","unit":"bed"},{"value":"2","unit":"bed"},{"value":"3","unit":"bed"}],"type":[{"value":"Shops"},{"value":"Studio"},{"value":"Flats"},{"value":"Apartments"},{"value":"Pent House"}],"premium":[{"value":"Ground-floor"},{"value":"First-floor"},{"value":"Second-floor"},{"value":"Top-floor"}]}',
            'created_by' => 1,
            'parent_id' => -1,
            'status_id' => 3,
        ]);

        SocietyCategory::create([
            'name' => 'Commercial',
            'fields_json_array' => '{"size":[{"value":"300","unit":"sqft"},{"value":"500","unit":"sqft"}],"type":[{"value":"shop"},{"value":"studio"}],"premium":[{"value":"ground-floor"},{"value":"Top-floor"},{"value":"main-bolevard"}]}',
            'created_by' => 1,
            'parent_id' => -1,
            'status_id' => 3,
        ]);
    }
}
