<?php

namespace Database\Seeders;

use App\Models\BuildingDetail;
use Illuminate\Database\Seeder;

class BuildingDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BuildingDetail::insert([
            [
                'building_id' => 1,
                'developer' => 'Orlando Estate Homes',
                'address' => 'Paragon City  Lahore, PunjabPakistan',
                'latitude' => '31.5299629600301',
                'longitude' => '74.45718407340188',
                'plot_feature' => '{"sewerage":"on","electricity":"on","water_supply":"on"}',
                'business_feature' => '{"broadband":"on","atm":null}',
                'community_feature' => '{"gym":"on"}',
                'healthcare_feature' => '{"swimming_pool":"on","suna":null,"jacuzzi":null}',
                'other_facilities' => '{"school":null,"hospital":null,"shopping_mall":"on","restaurant":null,"transport":null,"services":null,"maintenance":null,"security":null}',
                'property_type' => '{"shop_detail":{"floor":"Necessitatibus facer","area":"Ex id neque qui ex m","price":"199"},"single_bed_flat":{"building":"Nihil pariatur Iust","area":"Rerum nesciunt cons","bed":null,"bath":"57","price":"636"},"double_bed_flat":{"building":"Eiusmod sunt sed re","area":"Voluptatum quisquam","bed":null,"bath":"27","price":"414"}}',
            ],
            [
                'building_id' => 2,
                'developer' => 'Orlando Estate Homes',
                'address' => 'Paragon City  Lahore, PunjabPakistan',
                'latitude' => '31.5299629600301',
                'longitude' => '74.45718407340188',
                'plot_feature' => '{"sewerage":"on","electricity":"on","water_supply":"on"}',
                'business_feature' => '{"broadband":"on","atm":null}',
                'community_feature' => '{"gym":"on"}',
                'healthcare_feature' => '{"swimming_pool":"on","suna":null,"jacuzzi":null}',
                'other_facilities' => '{"school":null,"hospital":null,"shopping_mall":"on","restaurant":null,"transport":null,"services":null,"maintenance":null,"security":null}',
                'property_type' => '{"shop_detail":{"floor":"Necessitatibus facer","area":"Ex id neque qui ex m","price":"199"},"single_bed_flat":{"building":"Nihil pariatur Iust","area":"Rerum nesciunt cons","bed":null,"bath":"57","price":"636"},"double_bed_flat":{"building":"Eiusmod sunt sed re","area":"Voluptatum quisquam","bed":null,"bath":"27","price":"414"}}',
            ],
            [
                'building_id' => 3,
                'developer' => 'Orlando Estate Homes',
                'address' => 'Paragon City , Lahore, PunjabPakistan',
                'latitude' => '31.5299629600301',
                'longitude' => '74.45718407340188',
                'plot_feature' => '{"sewerage":"on","electricity":"on","water_supply":"on"}',
                'business_feature' => '{"broadband":"on","atm":null}',
                'community_feature' => '{"gym":"on"}',
                'healthcare_feature' => '{"swimming_pool":"on","suna":null,"jacuzzi":null}',
                'other_facilities' => '{"school":null,"hospital":null,"shopping_mall":"on","restaurant":null,"transport":null,"services":null,"maintenance":null,"security":null}',
                'property_type' => '{"shop_detail":{"floor":"Necessitatibus facer","area":"Ex id neque qui ex m","price":"199"},"single_bed_flat":{"building":"Nihil pariatur Iust","area":"Rerum nesciunt cons","bed":null,"bath":"57","price":"636"},"double_bed_flat":{"building":"Eiusmod sunt sed re","area":"Voluptatum quisquam","bed":null,"bath":"27","price":"414"}}',
            ],
        ]);
    }
}
