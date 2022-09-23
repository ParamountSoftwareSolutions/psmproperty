<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionSeeder::class,
            StatusSeeder::class,
            StatusTypeSeeder::class,
            StateSeeder::class,
            CitySeeder::class,
            ClientSeeder::class,
            AgentSeeder::class,
            NocTypeSeeder::class,
            NocTypeSeeder::class,
            SocietyTypeSeeder::class,
            SocietyCategorySeeder::class,
            SocietySeeder::class,
            SocietyCategoryDataSeeder::class,
            ClientPlotsSeeder::class,
            SocietySectionSeeder::class,
            MobileApplicationSeeder::class,
            SocietySaleSeeder::class,
            ProjectSeeder::class,
            SliderSeeder::class,
            SocietyInstallmentData::class,
            AboutSeeder::class,
            TermConditionSeeder::class,
            PrivecyPolicySeeder::class,
            //JobSeeder::class,
            BuildingSeeder::class,
            BuildingFileSeeder::class,
            BuildingDetailSeeder::class,
            Floor::class,
            FloorDetailSeeder::class,
            BuildingRequestSeeder::class,
            BuildingSaleSeeder::class,
            BuildingClientSeeder::class,
            BuildingSliderSeeder::class,
            BuildingExpenseSeeder::class,
            BuildingSettingSeeder::class,
        ]);
    }
}
