<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatusType extends Model
{
    use HasFactory, SoftDeletes;

    public function Status(){
        return $this->hasMany(Status::class, 'status_type_id');
    }
}
