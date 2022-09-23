<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class AgentApartmentDetail extends Model
{

    public function ApartmentSales(){
        return $this->hasMany(AgentApartmentSales::class, 'apartment_detail_id', 'id');
    }

}
