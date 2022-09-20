<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FloorDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function floor()
    {
        return $this->belongsTo(Floor::class, 'floor_id');
    }

    public function building()
    {
        return $this->belongsTo(Building::class, 'building_id');
    }

    public function floor_detail_image()
    {
        return $this->hasMany(FloorDetailFile::class, 'floor_detail_id');
    }
}
