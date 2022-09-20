<?php

namespace App\Http\Controllers\Society;

use App\Http\Controllers\Controller;
use App\Models\EmployeePermission;
use App\Models\JobTitle;
use App\Models\SocietyEmployee;
use App\Models\SocietySection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    private $activePage;
    public function __construct(){
        $this->activePage = "employee";
    }

    public function index(){
        $employeeRoles = JobTitle::all();
        $society = Auth::user()->Society;
        if($society == null){
            $society = Auth::user()->Employee->Society;
        }
        return view('society.employees.index', array('activePage' => $this->activePage, 'employeeRoles' => $employeeRoles, 'society' => $society));
    }

    public function getTrash(){
        $employeeRoles = JobTitle::all();
        $employees = SocietyEmployee::onlyTrashed()->get();
        return view('society.employees.trash', array('activePage' => $this->activePage, 'employeeRoles' => $employeeRoles, 'employees' => $employees));
    }

    public function restore($employeeId){
        $employee = SocietyEmployee::where('id', $employeeId)->withTrashed()->first();
        if($employee != null){
            $user = $employee->TrashUser->restore();
            $employee->restore();
            return back()->with('success', 'Employee Restored Successfully');
        }
        return back()->with('error', 'Employee Not Found!');
    }

    public function store(Request $request){
        //store employee in db
        $employee = new SocietyEmployee();
        $employee->society_id = auth()->user()->Society->id;
        $employee->created_by = auth()->user()->id;
        $employee->job_title_id = $request->get('job_title_id');
        $employee->employee_id = $request->get('employee_id');
        $employee->cnic = $request->get('cnic_id');
        $employee->address = $request->get('address');
        $employee->account_no = $request->get('account_no');
        $employee->salary = $request->get('salary');
        //picture
        $file=$request->file('additional_file');
        if($file){
            $finalFile = $file->store('/', ['disk' => 'documents']);
            $employee->documents = $finalFile;
        }

        $user = new User();
        $user->username = $request->get('username');
        $user->email = $request->get('email');
        $user->phone_number = $request->get('phone_number');
        $user->password = Hash::make($request->get('password'));
        //Profile Pic
        $pic=$request->file('profile');
        if($pic){
            $finalPic = $pic->store('/', ['disk' => 'profile_pic']);
            $user->profile_pic_url = $finalPic;
        }
        $user->save();
        $user->assignRole('society');
        $employee->user_id = $user->id;
        $employee->save();
        //send email later
        return redirect('society/employee')->with('success', 'Employee Created Successfully');

    }

    public function permission($employeeId){
        $employeePermissions = EmployeePermission::where('employee_id', $employeeId)->get();
        $societySections = SocietySection::all();
        $employeeRoles = JobTitle::all();

        return view('society.employees.permission', array('activePage' => $this->activePage, 'employee_id' => $employeeId ,'employeeRoles' => $employeeRoles, 'permissions' => $employeePermissions, 'societySections' => $societySections));

    }

    public function updatePermissions(Request $request){
       $employeeId = $request->get('employee_id');
       EmployeePermission::where('employee_id', $employeeId)->delete();

       //add create fields
       $createArray = $request->get('permission_create');
       if(isset($createArray)) {
           foreach ($createArray as $cFields) {
               $employeePermission = EmployeePermission::where('society_section_id', $cFields)->where('employee_id', $employeeId)->first();
               if ($employeePermission == null) {
                   $employeePermission = new EmployeePermission();
               }
               $employeePermission->employee_id = $employeeId;
               $employeePermission->society_section_id = $cFields;
               $employeePermission->can_create = 1;
               $employeePermission->save();
           }
       }

       //add read fields
        $readArray = $request->get('permission_read');
        if(isset($readArray)) {
            foreach ($readArray as $rFields) {
                $employeePermission = EmployeePermission::where('society_section_id', $rFields)->where('employee_id', $employeeId)->first();
                if ($employeePermission == null) {
                    $employeePermission = new EmployeePermission();
                }

                $employeePermission->employee_id = $employeeId;
                $employeePermission->society_section_id = $rFields;
                $employeePermission->can_view = 1;
                $employeePermission->save();

            }
        }

       //add update fields
        $updateArray = $request->get('permission_update');
        if(isset($updateArray)) {
            foreach ($updateArray as $uFields) {
                $employeePermission = EmployeePermission::where('society_section_id', $uFields)->where('employee_id', $employeeId)->first();
                if ($employeePermission == null) {
                    $employeePermission = new EmployeePermission();
                }

                $employeePermission->employee_id = $employeeId;
                $employeePermission->society_section_id = $uFields;
                $employeePermission->can_update = 1;
                $employeePermission->save();
            }
        }

       //add delete fields
        $deleteArray = $request->get('permission_delete');
        if(isset($deleteArray)) {
            foreach ($deleteArray as $dFields) {
                $employeePermission = EmployeePermission::where('society_section_id', $dFields)->where('employee_id', $employeeId)->first();
                if ($employeePermission == null) {
                    $employeePermission = new EmployeePermission();
                }

                $employeePermission->employee_id = $employeeId;
                $employeePermission->society_section_id = $dFields;
                $employeePermission->can_delete = 1;
                $employeePermission->save();

            }
        }
       return back()->with('success', 'Permission Updated Successfully');
    }

    public function delete($id){
        $employee = SocietyEmployee::find($id);
        if($employee != null){
            $user = $employee->User->delete();
            $employee->delete();
            return back()->with('success', 'Employee Deleted Successfully');
        }
        return back()->with('error', 'Employee Not Found!');
    }

}
