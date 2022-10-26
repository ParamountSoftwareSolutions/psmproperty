<?php

namespace App\Http\Controllers\Society;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAttendance;
use App\Models\SocietyEmployee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HRMController extends Controller
{

    private $activePage;
    public function __construct(){
        $this->activePage = "hrm";
    }

    public function index(){
        return view('society.hrm.index', array('activePage' => $this->activePage));
    }

    public function getAttendance(){
        //get attendance..
        $employees = auth()->user()->Society->Employees;
        return view('society.hrm.attendance', array('activePage' => $this->activePage, 'employees' => $employees));

    }

    public function getAttendanceHistory($employeeId){
        $employees = SocietyEmployee::find($employeeId);
        $attendanceHistory = EmployeeAttendance::where('employee_id', $employees->User->id)->get();
        return view('society.hrm.attendance_history', array('activePage' => $this->activePage, 'attendanceHistory' => $attendanceHistory, 'employee' => $employees));
    }
}
