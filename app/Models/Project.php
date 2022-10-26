<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function manager()
    {
        return $this->belongsTo(User::class, 'assign_id');
    }

    public function society()
    {
        return $this->belongsTo(Society::class, 'society_id');
    }
}
