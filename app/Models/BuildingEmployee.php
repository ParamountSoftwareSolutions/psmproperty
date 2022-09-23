<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuildingEmployee extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function building()
    {
        return $this->belongsTo(Building::class, 'building_id');
    }

    public function job()
    {
        return $this->belongsTo(JobTitle::class, 'job_id');
    }

    public function building_employee_payroll()
    {
        return $this->hasOne(BuildingEmployeePayRoll::class, 'employee_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    public function sale_manager()
    {
        return $this->belongsTo(User::class, 'sale_manager_id');
    }
}
