<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeAttendance extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'employee_attendance';

    protected $fillable = ['employee_id', 'check_in_time', 'date', 'check_out_time', 'comment'];
}
