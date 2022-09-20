<?php

namespace Database\Seeders;

use App\Models\BuildingFile;
use Illuminate\Database\Seeder;

class BuildingFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BuildingFile::insert([
            [
                'building_id' => 1,
                'image' => 'public/images/building/logo/1737429753099371.png',
                'type' => 'logo'
            ],
            [
                'building_id' => 1,
                'image' => 'public/images/building/1737523259978239.jpg',
                'type' => 'main'
            ],
            [
                'building_id' => 1,
                'image' => 'public/images/building/1737523259981873.jpg',
                'type' => 'normal'
            ],
            [
                'building_id' => 1,
                'image' => 'public/images/building/1737523259981873.jpg',
                'type' => 'normal'
            ],
            [
                'building_id' => 1,
                'image' => 'public/images/building/1737523259982791.jpg',
                'type' => 'normal'
            ],
            [
                'building_id' => 1,
                'image' => 'public/images/building/1737523259983413.jpg',
                'type' => 'normal'
            ],
            //2
            [
                'building_id' => 2,
                'image' => 'public/images/building/logo/1737429753099371.png',
                'type' => 'logo'
            ],
            [
                'building_id' => 2,
                'image' => 'public/images/building/1737523259978239.jpg',
                'type' => 'main'
            ],
            [
                'building_id' => 2,
                'image' => 'public/images/building/1737523259981873.jpg',
                'type' => 'normal'
            ],
            [
                'building_id' => 2,
                'image' => 'public/images/building/1737523259981873.jpg',
                'type' => 'normal'
            ],
            [
                'building_id' => 2,
                'image' => 'public/images/building/1737523259982791.jpg',
                'type' => 'normal'
            ],
            [
                'building_id' => 2,
                'image' => 'public/images/building/1737523259983413.jpg',
                'type' => 'normal'
            ],
            //3
            [
                'building_id' => 3,
                'image' => 'public/images/building/logo/1737429753099371.png',
                'type' => 'logo'
            ],
            [
                'building_id' => 3,
                'image' => 'public/images/building/1737523259978239.jpg',
                'type' => 'main'
            ],
            [
                'building_id' => 3,
                'image' => 'public/images/building/1737523259981873.jpg',
                'type' => 'normal'
            ],
            [
                'building_id' => 3,
                'image' => 'public/images/building/1737523259981873.jpg',
                'type' => 'normal'
            ],
            [
                'building_id' => 3,
                'image' => 'public/images/building/1737523259982791.jpg',
                'type' => 'normal'
            ],
            [
                'building_id' => 3,
                'image' => 'public/images/building/1737523259983413.jpg',
                'type' => 'normal'
            ],
        ]);
    }
}
