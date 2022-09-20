<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuildingRequest extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function request_user()
    {
        return $this->belongsTo(User::class, 'transfer_to');
    }
}
