<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocietyInstallmentData extends Model
{
    use HasFactory;

    public function StatusName()
    {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }
}
