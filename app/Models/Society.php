<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Society extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function manager()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function city(){
        return $this->belongsTo(City::class, 'city_id');
    }
    public function province(){
        return $this->belongsTo(Province::class, 'province_id');
    }
    public function type(){
        return $this->belongsTo(SocietyType::class, 'society_type_id');
    }
    public function noc(){
        return $this->belongsTo(NocType::class, 'noc_type_id');
    }
    public function status(){
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function sales(){
        return $this->hasMany(SocietySale::class, 'society_id');
    }

    public function categoryData(){
        return $this->hasMany(SocietyCategoryData::class, 'society_id');
    }

    public function employees(){
        return $this->hasMany(SocietyEmployee::class, 'society_id');
    }

    public function leads(){
        return $this->hasMany(SocietyLead::class, 'society_id');
    }
}
