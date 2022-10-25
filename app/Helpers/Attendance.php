<?php

namespace App\Helpers;


use App\Models\EmployeeAttendance;
use Carbon\Carbon;

class Attendance{

    public static function checkIn(){
        $attendance = EmployeeAttendance::where('employee_id', auth()->user()->id)->where('date', Carbon::now()->toDateString())->first();
        if($attendance == null) {

            $attendance = [];
            $attendance['employee_id'] = auth()->user()->id;
            $attendance['check_in_time'] = Carbon::now()->toTimeString();
            $attendance['date'] = Carbon::now()->toDateString();
            $attendance['check_out_time'] = '00:00:00';
            $attendance['comment'] = '';
            EmployeeAttendance::create($attendance);
        }

    }

    public static function checkOut(){
        //mark checkout here
        $attendance = EmployeeAttendance::where('employee_id', auth()->user()->id)->where('date', Carbon::now()->toDateString())->first();
        if($attendance != null){
            $attendance->check_out_time = Carbon::now()->toTimeString();
            $attendance->save();
        }
    }

}
