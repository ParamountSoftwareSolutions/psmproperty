<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function floor_detail(){
        return $this->hasMany(FloorDetail::class,'floor_id');
    }
}
