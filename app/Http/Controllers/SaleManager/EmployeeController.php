<?php

namespace App\Http\Controllers\SaleManager;

use App\Helpers\NotificationHelper;
use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\BuildingEmployee;
use App\Models\JobTitle;
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
        $building_manager = Building::where('sale_manager_id', Auth::id())->first();
        $employee_list = BuildingEmployee::where('property_admin_id', $building_manager->user_id)->get()->pluck('employee_id')->toArray();
        $employee = User::with('building_employee')->whereIn('id', $employee_list)->get();
        return view('sale_manager.employee.index', compact('employee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $building = Building::where('sale_manager_id', Auth::id())->get();
        $job = JobTitle::get();
        $sale_manager = User::with('roles')
            ->whereHas('roles', function ($q) {
                $q->Where('name', 'sale_manager');
            })
            ->get();
        return view('sale_manager.employee.create', compact('building', 'job', 'sale_manager'));
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
            'name' => 'required',
            'email' => 'required|unique:users',
            'cnic' => 'required',
            'building_id' => 'required',
        ]);
        /*if ($request->job_title == 'sale_person'){
            $request->validate([
                'sale_manager_id' => 'required',
            ]);
        }*/
        $building_manager = Building::where('sale_manager_id', Auth::id())->first();
        $employee = new User();
        $employee->username = $request->name;
        $employee->email = $request->email;
        if ($request->password == null) {
            $employee->password = Hash::make(12345678);
        } else {
            $employee->password = Hash::make($request->password);
        }
        $employee->phone_number = $request->phone_number;
        $employee->save();
        $employee->assignRole('employee');
        $employee_detail = new BuildingEmployee();
        $employee_detail->property_admin_id = $building_manager->user_id;
        $employee_detail->sale_manager_id = Auth::id();
        $employee_detail->building_id = $request->building_id;
        $employee_detail->employee_id = $employee->id;
        $employee_detail->cnic = $request->cnic;
        $employee_detail->address = $request->address;
        $employee_detail->account_no = $request->account_no;
        $employee_detail->salary = $request->salary;
        $employee_detail->job_title = $request->job_title;
        $employee_detail->commission = $request->commission;
        //picture
        if ($request->file('document')) {
            $document = $request->file('document');
            $document_name = hexdec(uniqid()) . '.' . strtolower($document->getClientOriginalExtension());
            $document->move('public/images/employee/', $document_name);
            $employee_detail->document = asset('public/images/employee/' . $document_name);
        }
        $employee_detail->save();
        if ($employee_detail) {
            (new NotificationHelper)->web_panel_notification('employee_create');
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
        $building_manager = Building::where('sale_manager_id', Auth::id())->first();
        $employee_list = BuildingEmployee::where('property_admin_id', $building_manager->user_id)->get()->pluck('employee_id')->toArray();
        $building = Building::where('sale_manager_id', Auth::id())->get();
        $employee = User::with('building_employee')->whereIn('id', $employee_list)->findOrFail($id);
        //dd($employee->building_employee);
        /*$sale_manager = User::with('roles')
            ->whereHas('roles', function ($q) {
                $q->Where('name', 'sale_manager');
            })
            ->get();*/
        return view('sale_manager.employee.edit', compact('building', 'employee'));
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
            'email' => 'required',
            'cnic' => 'required',
        ]);
        $building_manager = Building::where('sale_manager_id', Auth::id())->first();
        $employee = User::findOrFail($id);
        $employee->username = $request->name;
        $employee->email = $request->email;
        $employee->phone_number = $request->phone_number;
        $employee->save();

        $employee_detail = BuildingEmployee::where('property_admin_id', $building_manager->user_id)->where('employee_id', $id)->first();
        $employee_detail->building_id = $request->building_id;
        $employee_detail->sale_manager_id = Auth::id();
        $employee_detail->cnic = $request->cnic;
        $employee_detail->address = $request->address;
        $employee_detail->account_no = $request->account_no;
        $employee_detail->salary = $request->salary;
        $employee_detail->job_title = $request->job_title;
        $employee_detail->commission = $request->commission;
        //picture
        if ($request->file('document')) {
            $document = $request->file('document');
            $document_name = hexdec(uniqid()) . '.' . strtolower($document->getClientOriginalExtension());
            $document->move('public/images/employee/', $document_name);
            $employee_detail->document = asset('public/images/employee/' . $document_name);
        }
        $employee_detail->save();
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
                $q->Where('name', 'employee');
            })->findOrFail($id);
        $employee->delete();
        $employee_detail = BuildingEmployee::where('employee_id', $id)->first();
        $employee_detail->delete();
        if ($employee) {
            return redirect()->route('sale_manager.employee.index')->with($this->message('Employee Delete Successfully', 'success'));
        } else {
            return redirect()->back()->with($this->message('Employee Delete Error', 'danger'));
        }
    }
}
