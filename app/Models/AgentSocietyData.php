<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentSocietyData extends Model
{
    use HasFactory;


    public function Agent(){
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function Society(){
        return $this->belongsTo(Society::class, 'society_id');
    }

    public function FileData(){
        return $this->hasOne(AgentFileData::class, 'agent_society_id');
    }
}
