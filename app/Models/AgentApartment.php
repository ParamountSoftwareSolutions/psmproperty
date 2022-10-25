<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentApartment extends Model
{
    use HasFactory;

    public function ApartmentDetails(){
        return $this->hasMany(AgentApartmentDetail::class, 'apartment_id');
    }
    public function agent_apartment_installment_data(){
        return $this->hasMany(AgentApartmentDetail::class, 'id','apartment_sales_id');
    }
}
