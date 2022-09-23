<?php

namespace App\Models;

use App\Helpers\Helpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuildingAssignUser extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function building()
    {
        return $this->belongsTo(Building::class, 'building_id');
    }

}
