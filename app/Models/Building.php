<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function building_floor_detail()
    {
        return $this->hasMany(FloorDetail::class, 'building_id')->with('floor');
    }

    public function building_images()
    {
        return $this->hasMany(BuildingFile::class, 'building_id');
    }

    public function building_detail()
    {
        return $this->hasOne(BuildingDetail::class, 'building_id')->with('building_detail_image');
    }


}
