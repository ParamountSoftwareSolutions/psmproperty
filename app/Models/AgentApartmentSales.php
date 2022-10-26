<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class AgentApartmentSales extends Model
{
    public function Apartments(){
        return $this->hasOne(Agent::class, 'id', 'apartment_sales_id');
    }

    public function User(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function InstallmentData(){
        return $this->hasMany(AgentApartmentInstallmentData::class, 'apartment_sales_id', 'id');
    }
}
