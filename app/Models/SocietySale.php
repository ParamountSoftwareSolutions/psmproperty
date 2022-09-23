<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocietySale extends Model
{
    use HasFactory;
    protected $table="society_sales";

    public function SoldTo(){
        return $this->hasOne(User::class, 'id','sold_to_id');
    }

    public function CategoryData(){
        return $this->hasOne(SocietyCategoryData::class, 'id', 'society_cat_data_id');
    }

    public function Society(){
        return $this->hasOne(Society::class, 'id', 'society_id');
    }


    public function InstallmentData(){
        return $this->hasMany(SocietyInstallmentData::class, 'society_sales_id','id')->with('StatusName');
    }

    public function InstallmentDataPerMonth(){
        return $this->hasOne(SocietyInstallmentData::class, 'society_sales_id');
    }

    public function PaidInstallments(){
        return $this->hasMany(SocietyInstallmentData::class, 'society_sales_id','id')->where('status_id','=', 10);
    }

    public function Status(){
        return $this->hasOne(Status::class, 'id', 'status_id');
    }
}
