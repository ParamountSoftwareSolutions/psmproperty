<?php

namespace App\Http\Controllers\PropertyManager;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAttendance;
use App\Models\SocietyEmployee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HRMController extends Controller
{
    public function index(){
        return view('society.hrm.index');
    }

    public function getAttendance(){
        //get attendance..
        $employees = auth()->user()->Society->Employees;
        return view('society.hrm.attendance', compact('employees'));

    }

    public function getAttendanceHistory($employeeId){
        $employees = SocietyEmployee::find($employeeId);
        $attendanceHistory = EmployeeAttendance::where('employee_id', $employees->User->id)->get();
        return view('society.hrm.attendance_history', compact('attendanceHistory', 'employee'));
    }
}
