<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuildingCustomer extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function property_admin()
    {
        return $this->belongsTo(BuildingMobileApplication::class, 'building_app_id');
    }

}
