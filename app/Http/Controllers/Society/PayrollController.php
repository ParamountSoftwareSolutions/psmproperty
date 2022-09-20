<?php

namespace App\Http\Controllers\Society;

use App\Http\Controllers\Controller;
use App\Models\EmployeePayRoll;
use App\Models\SocietyEmployee;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    private $activePage;
    public function __construct(){
        $this->activePage = "payroll";
    }

    public function index(){
        $employees = auth()->user()->Society->Employees;
        return view('society.payroll.index', array('activePage' => $this->activePage, 'employees' => $employees));
    }

    public function getUpdateView($id){
        $employee = SocietyEmployee::find($id);
        return view('society.payroll.status', array('activePage' => $this->activePage, 'employee' => $employee));
    }

    public function store(Request $request){
        $salary = new EmployeePayRoll();
        $salary->employee_id = $request->get('employee_id');
        $salary->amount = $request->get('salary');
        $salary->deduction = $request->get('deduction');
        $salary->bonus = $request->get('bonus');
        $salary->comments = $request->get('comments');
        $salary->created_by = auth()->user()->id;
        $salary->date = \Carbon\Carbon::now()->toDateString();

        $salary->save();

        return back()->with('success', 'Salary Updated Successfully');
    }
}
