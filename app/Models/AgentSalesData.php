<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentSalesData extends Model
{
    use HasFactory;

    public function SocietySales(){
        return $this->hasOne(SocietySale::class, 'id','society_sales_id');
    }
}
