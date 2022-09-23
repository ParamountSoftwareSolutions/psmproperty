<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuildingDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function building_detail_file(){
        return $this->belongsTo(BuildingDetailFile::class, 'building_detail_id');
    }

    public function building_detail_image()
    {
        return $this->hasMany(BuildingDetailFile::class, 'building_detail_id');
    }
}
