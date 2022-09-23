<?php

namespace App\Http\Controllers\PropertyManager;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\BuildingEmployeePayRoll;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeePayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $building = Helpers::building_detail();
        $employee = User::with('building_employee', 'building_employee_payroll')
            ->whereHas('building_employee', function ($q) use ($building) {
                $q->whereIn('building_id', $building->pluck('id')->toArray());
            })
            /*->whereHas('building_employee_payroll', function ($q) {
                $q->whereIn('building_id', $building->pluck('id')->toArray());
            })*/
            ->whereHas('roles', function ($q) {
                $q->WhereIn('name', ['sale_person', 'office_staff', 'accountant']);
            })
            ->get();
        return view('property_manager.hrm.employee_payroll.index', compact('employee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $building = Helpers::building_detail();
        $employee = User::with('building_employee')
            ->whereHas('building_employee', function ($q) use ($building) {
                $q->whereIn('building_id', $building->pluck('id')->toArray());
            })
            ->whereHas('roles', function ($q) {
                $q->WhereIn('name', ['sale_person', 'office_staff', 'accountant']);
            })
            ->findOrFail($id);
        return view('property_manager.hrm.employee_payroll.edit', compact('employee'));
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
            'amount' => 'required',
            'date' => 'required',
        ]);
        $building = Helpers::building_detail();
        $employee = User::with('building_employee')
            ->whereHas('building_employee', function ($q) use ($building) {
                $q->whereIn('building_id', $building->pluck('id')->toArray());
            })
            ->whereHas('roles', function ($q) {
                $q->WhereIn('name', ['sale_person', 'office_staff', 'accountant']);
            })
            ->findOrFail($id);

        $employee_payroll = BuildingEmployeePayRoll::updateOrCreate(['user_id' => $employee->id], [
            'amount' => $request->amount,
            'comments' => $request->comments,
            'date' => $request->date,
            'payment_mode' => $request->payment_mode,
        ]);
        if ($employee_payroll) {
            return redirect()->route('property_manager.employee_payroll.index')->with($this->message('Employee Pay Update Successfully', 'success'));
        } else {
            return redirect()->back()->with($this->message('Employee Pay Update Error', 'danger'));
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
        $building = Helpers::building_detail();
        $employee = User::with('building_employee')
            ->whereHas('building_employee', function ($q) use ($building) {
                $q->whereIn('building_id', $building->pluck('id')->toArray());
            })
            ->whereHas('roles', function ($q) {
                $q->WhereIn('name', ['sale_person', 'office_staff', 'accountant']);
            })
            ->findOrFail($id);
        $employee_payroll = BuildingEmployeePayRoll::where('user_id', $employee->id)->first();
        $employee_payroll->delete();
        if ($employee) {
            return redirect()->route('property_manager.employee.index')->with($this->message('Employee Delete Successfully', 'success'));
        } else {
            return redirect()->back()->with($this->message('Employee Delete Error', 'danger'));
        }
    }
}
