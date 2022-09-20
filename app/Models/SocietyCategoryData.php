<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocietyCategoryData extends Model
{
    use HasFactory;
    protected $table="society_category_data";

    public function SocietySales(){
        return $this->hasMany(SocietySale::class, 'society_cat_data_id');
    }

    public function Category(){
        return $this->hasOne(SocietyCategory::class, 'id' ,'category_id');
    }
}
