<?php

namespace App\Http\Controllers\SaleManager;

use App\Helpers\Helpers;
use App\Helpers\NotificationHelper;
use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\BuildingAssignUser;
use App\Models\BuildingEmployee;
use App\Models\BuildingEmployeePayRoll;
use App\Models\JobTitle;
use App\Models\User;
use Carbon\Carbon;
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
        $employee = Helpers::sales_person();
        return view('sale_manager.employee.index', compact('employee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $building = Helpers::building_detail();
        $sale_manager = User::with('roles')
            ->whereHas('roles', function ($q) {
                $q->Where('name', 'sale_manager');
            })->where('property_admin_id', Helpers::user_admin())->get();
        return view('sale_manager.employee.create', compact('building', 'sale_manager'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'building_id' => 'required',
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'cnic' => 'required|unique:users,cnic',
            'job_title' => 'required',
            'phone_number' => 'unique:users,phone_number'
        ]);
        $employee = new User();
        $employee->username = $request->name;
        $employee->email = $request->email;
        if ($request->password == null) {
            $employee->password = Hash::make(12345678);
        } else {
            $employee->password = Hash::make($request->password);
        }
        $employee->phone_number = $request->phone_number;
		$employee->cnic = $request->cnic;
        $employee->property_admin_id = Helpers::user_admin();
        $employee->save();
        $employee_detail = new BuildingEmployee();
        $employee_detail->building_id = $request->building_id;
        $employee_detail->user_id = $employee->id;
        $employee_detail->sale_manager_id = Auth::id();
        $employee_detail->cnic = $request->cnic;
        $employee_detail->address = $request->address;
        $employee_detail->account_no = $request->account_no;
        $employee_detail->salary = $request->salary;
        $employee_detail->commission = $request->commission;
        //picture
        if ($request->file('document')) {
            $document = $request->file('document');
            $document_name = hexdec(uniqid()) . '.' . strtolower($document->getClientOriginalExtension());
            $document->move('public/images/employee/', $document_name);
            $employee_detail->document = asset('public/images/employee/' . $document_name);
        }
        $employee_detail->save();
        $employee->assignRole($request->job_title);
        if ($request->file('document')) {
            $document = $request->file('document');
            $document_name = hexdec(uniqid()) . '.' . strtolower($document->getClientOriginalExtension());
            $document->move('public/images/employee/', $document_name);
            $employee_detail->document = asset('public/images/employee/' . $document_name);
        }
        $employee_detail->save();
        BuildingAssignUser::create([
            'user_id' => $employee->id,
            'building_id' => $request->building_id,
        ]);
        $employee->assignRole($request->job_title);
        if ($employee_detail) {
            NotificationHelper::web_panel_notification('employee_create');
            return redirect()->route('sale_manager.employee.index')->with($this->message('Employee Create Successfully', 'success'));
        } else {
            return redirect()->back()->with($this->message('Employee Create Error', 'danger'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $building = Helpers::building_detail();
        $employee_list = BuildingEmployee::whereIn('building_id', $building->pluck('id')->toArray())->get()->pluck('user_id')->toArray();
        $employee = User::with('building_employee')->whereIn('id', $employee_list)->findOrFail($id);
        $sale_manager = User::with('roles')
            ->whereHas('roles', function ($q) {
                $q->Where('name', 'sale_manager');
            })
            ->where('property_admin_id', Helpers::user_admin())
            ->get();
        return view('sale_manager.employee.edit', compact('building', 'employee', 'sale_manager'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id,
            'cnic' => 'required|unique:users,cnic,' . $id,
            'job_title' => 'required',
            'phone_number' => 'required|unique:users,phone_number,' . $id,
        ]);
        if ($request->job_title == 'sale_person' && Auth::user()->hasRole('sale_manager') == false) {
            $request->validate([
                'sale_manager_id' => 'required',
            ]);
        }
        $building = Helpers::custom_building_detail();
        $employee_detail = BuildingEmployee::whereIn('building_id', $building->pluck('id')->toArray())->where('user_id', $id)->first();
        $employee = User::findOrFail($id);
        $employee->username = $request->name;
        $employee->email = $request->email;
        /*if ($request->password == null) {
            $employee->password = Hash::make(12345678);
        } else {
            $employee->password = Hash::make($request->password);
        }*/
        $employee->phone_number = $request->phone_number;
        $employee->property_admin_id = Helpers::user_admin();
        $employee->save();
        $employee_detail->building_id = $request->building_id;
        $employee_detail->user_id = $employee->id;
        $employee_detail->sale_manager_id = Auth::id();
        $employee_detail->cnic = $request->cnic;
        $employee_detail->address = $request->address;
        $employee_detail->account_no = $request->account_no;
        $employee_detail->salary = $request->salary;
        $employee_detail->commission = $request->commission;
        //picture
        if ($request->file('document')) {
            $document = $request->file('document');
            $document_name = hexdec(uniqid()) . '.' . strtolower($document->getClientOriginalExtension());
            $document->move('public/images/employee/', $document_name);
            $employee_detail->document = asset('public/images/employee/' . $document_name);
        }
        $employee_detail->save();
        $assign = BuildingAssignUser::where('user_id', $employee->id)->first();
        if (!empty($assign->building_id) == $request->building_id) {
            $assign->update(
                [
                    'user_id' => $employee->id,
                    'building_id' => $request->building_id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
        } else {
            BuildingAssignUser::create(
                [
                    'user_id' => $employee->id,
                    'building_id' => $request->building_id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
        }

        $employee->assignRole($request->job_title);
        if ($employee_detail) {
            return redirect()->route('sale_manager.employee.index')->with($this->message('Employee Update Successfully', 'success'));
        } else {
            return redirect()->back()->with($this->message('Employee Update Error', 'danger'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $employee = User::with('roles')
            ->whereHas('roles', function ($q) {
                $q->WhereIn('name', ['sale_person', 'office_staff', 'accountant']);
            })->findOrFail($id);
        $employee->forceDelete();
       /* $employee_detail = BuildingEmployee::where('employee_id', $id)->first();
        $employee_detail->delete(); */
        if ($employee) {
            return redirect()->route('sale_manager.employee.index')->with($this->message('Employee Delete Successfully', 'success'));
        } else {
            return redirect()->back()->with($this->message('Employee Delete Error', 'danger'));
        }
    }
}
