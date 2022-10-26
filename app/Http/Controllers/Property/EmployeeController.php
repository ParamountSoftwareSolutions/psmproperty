<?php

namespace App\Http\Controllers\Property;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\BuildingEmployee;
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $building = BuildingEmployee::where('property_admin_id', Auth::id())->get()->pluck('employee_id')->toArray();

        $employee = User::
        /*with('roles')->whereHas('roles', function ($q) {
            $q->where('name', 'employee');
        })->*/
        whereIn('id', $building)->get();
        return view('property.employee.index', compact('employee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $building = Building::where('user_id', Auth::id())->get();
        $job = JobTitle::get();
        return view('property.employee.create', compact('building', 'job'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'cnic' => 'required',
        ]);
        $employee = new User();
        $employee->username = $request->name;
        $employee->email = $request->email;
        $employee->password = Hash::make($request->password);
        $employee->phone_number = $request->phone_number;
        $employee->save();
        $employee->assignRole('employee');
        $employee_detail = new BuildingEmployee();
        $employee_detail->property_admin_id = Auth::id();
        $employee_detail->building_id = $request->building_id;
        $employee_detail->employee_id = $employee->id;
        $employee_detail->job_id = $request->job_id;
        $employee_detail->cnic = $request->cnic;
        $employee_detail->address = $request->address;
        $employee_detail->account_no = $request->account_no;
        $employee_detail->salary = $request->salary;
        //picture
        if ($request->file('document')) {
            $document = $request->file('document');
            $document_name = hexdec(uniqid()) . '.' . strtolower($document->getClientOriginalExtension());
            $document->move('images/employee/', $document_name);
            $employee_detail->document = asset('images/employee/' . $document_name);
        }
        $employee_detail->save();
        if ($employee_detail) {
            return redirect()->route('property_admin.employee.index')->with($this->message('Employee Create Successfully', 'success'));
        } else {
            return redirect()->back()->with($this->message('Employee Create Error', 'danger'));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $building = Building::where('user_id', Auth::id())->get();
        $building_employee = BuildingEmployee::where('property_admin_id', Auth::id())->get()->pluck('employee_id')->toArray();
        $job = JobTitle::get();
        $employee = User::with('building_employee')->whereIn('id', $building_employee)->findOrFail($id);
        return view('property.employee.edit', compact('building', 'job', 'employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'cnic' => 'required',
        ]);
        $building_employee = BuildingEmployee::where('property_admin_id', Auth::id())->get()->pluck('employee_id')->toArray();
        $employee = User::whereIn('id', $building_employee)->findOrFail($id);
        $employee->username = $request->name;
        $employee->email = $request->email;
        $employee->password = Hash::make($request->password);
        $employee->phone_number = $request->phone_number;
        $employee->save();
        $employee->assignRole('employee');
        $employee_detail = BuildingEmployee::where('property_admin_id', Auth::id())->where('employee_id', $id)->first();

        $employee_detail->building_id = $request->building_id;
        $employee_detail->employee_id = $id;
        $employee_detail->job_id = $request->job_id;
        $employee_detail->cnic = $request->cnic;
        $employee_detail->address = $request->address;
        $employee_detail->account_no = $request->account_no;
        $employee_detail->salary = $request->salary;
        //picture
        if ($request->file('document')) {
            $document = $request->file('document');
            $document_name = hexdec(uniqid()) . '.' . strtolower($document->getClientOriginalExtension());
            $document->move('public/images/employee/', $document_name);
            $employee_detail->document = asset('public/images/employee/' . $document_name);
        }
        $employee_detail->save();
        if ($employee_detail) {
            return redirect()->route('property_admin.employee.index')->with($this->message('Employee Update Successfully', 'success'));
        } else {
            return redirect()->back()->with($this->message('Employee Update Error', 'danger'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $building_employee = BuildingEmployee::where('property_admin_id', Auth::id())->get()->pluck('employee_id')->toArray();
        $employee = User::findOrFail($id);

        $employee->forceDelete();
        if ($employee) {
            return redirect()->route('property_admin.employee.index')->with($this->message('Employee Delete Successfully', 'success'));
        } else {
            return redirect()->back()->with($this->message('Employee Delete Error', 'danger'));
        }

    }

    /*public function getTrash()
    {
        $employeeRoles = JobTitle::all();
        $employees = SocietyEmployee::onlyTrashed()->get();
        return view('society.employees.trash', array('activePage' => $this->activePage, 'employeeRoles' => $employeeRoles, 'employees' => $employees));
    }

    public function restore($employeeId)
    {
        $employee = SocietyEmployee::where('id', $employeeId)->withTrashed()->first();
        if ($employee != null) {
            $user = $employee->TrashUser->restore();
            $employee->restore();
            return back()->with('success', 'Employee Restored Successfully');
        }
        return back()->with('error', 'Employee Not Found!');
    }*/

    /*public function permission($employeeId)
    {
        $employeePermissions = EmployeePermission::where('employee_id', $employeeId)->get();
        $societySections = SocietySection::all();
        $employeeRoles = JobTitle::all();

        return view('society.employees.permission', array('activePage' => $this->activePage, 'employee_id' => $employeeId, 'employeeRoles' => $employeeRoles, 'permissions' => $employeePermissions, 'societySections' => $societySections));

    }*/
}
