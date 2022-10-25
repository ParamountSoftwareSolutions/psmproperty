<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuildingProperty extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function property_image()
    {
        return $this->hasMany(BuildingPropertyFile::class, 'property_id');
    }

    public function property_video()
    {
        return $this->hasOne(BuildingPropertyFile::class, 'property_id')->where('type', 'video');
    }
}
