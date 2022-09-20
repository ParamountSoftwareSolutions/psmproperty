<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentApartmentInstallmentData extends Model{

    public function Status(){
        return $this->hasOne(Status::class, 'id', 'status_id');
    }

}
