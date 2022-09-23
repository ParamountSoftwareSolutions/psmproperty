<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileApplication extends Model
{
    use HasFactory;

    public function Society(){
        return $this->hasOne(Society::class, 'id', 'society_id');
    }
}
