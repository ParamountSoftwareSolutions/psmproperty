<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgentEmployee extends Model
{
    use HasFactory, SoftDeletes;

    public function User(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function TrashUser(){
        return $this->hasOne(User::class, 'id', 'user_id')->withTrashed();
    }

    public function Society(){
        return $this->hasOne(Society::class, 'id', 'society_id');
    }

    public function JobTitle(){
        return $this->hasOne(JobTitle::class, 'id', 'job_title_id');
    }

    public function CreatedBy(){
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function EmployeePermissions(){
        return $this->hasMany(EmployeePermission::class, 'employee_id', 'id');
    }

    public function Salaries(){
        return $this->hasMany(EmployeePayRoll::class, 'employee_id', 'id');
    }
}
