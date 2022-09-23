<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocietyCategory extends Model
{
    use HasFactory, SoftDeletes;

    public function Parent(){
        return $this->hasOne(SocietyCategory::class, 'id','parent_id');
    }

    public function Status(){
        return $this->hasOne(Status::class, 'id','status_id');
    }
}
