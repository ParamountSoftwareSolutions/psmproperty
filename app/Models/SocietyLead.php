<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocietyLead extends Model
{
    use HasFactory, SoftDeletes;

    public function CreatedBy(){
       return  $this->hasOne(User::class, 'id', 'created_by');
    }

}
