<?php

namespace App\Http\Controllers\Accountant;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\BuildingExpense;
use App\Models\BuildingExpenseLabor;
use App\Models\Expense;
use App\Models\ExpenseLabor;
use App\Models\Project;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Rap2hpoutre\FastExcel\FastExcel;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $building = Helpers::custom_building_detail();
        $expenses = BuildingExpense::with('building', 'labor')->whereIn('building_id', $building->pluck('id')->toArray())->get();
        return view('accountant.expense.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $building = Helpers::custom_building_detail();
        return view('accountant.expense.create', compact('building'));
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
            'raw_material' => 'required',
            'qty' => 'required',
            'cost' => 'required',
        ]);
        $expense = new BuildingExpense();
        $expense->building_id = $request->building_id;
        $expense->raw_material = $request->raw_material;
        $expense->qty = $request->qty;
        $expense->cost = $request->cost;
        $expense->date = $request->date;
        $expense->save();

        if ($request->labor !== null) {
            $labor = new BuildingExpenseLabor();
            $labor->building_expense_id = $expense->id;
            $labor->labor = $request->labor;
            $labor->cost = $request->labor_cost;
            $labor->save();
        }
        if($expense){
            return redirect()->route('accountant.expense.index')->with(['alert' => 'success', 'message' =>  'Expense Create Successfully']);
        } else{
            return redirect()->back()->with(['alert' => 'error', 'message' =>  'Expense Create Error']);
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
        $expense = BuildingExpense::with('labor')->findOrFail($id);
        $building = Helpers::custom_building_detail();
        return view('accountant.expense.edit', compact('expense', 'building'));
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
            'raw_material' => 'required',
            'qty' => 'required',
            'cost' => 'required',
        ]);
        $expense = BuildingExpense::findOrFail($id);
        $expense->raw_material = $request->raw_material;
        $expense->qty = $request->qty;
        $expense->cost = $request->cost;
        $expense->date = $request->date;
        $expense->save();

        if ($request->labor !== null) {
            $labor = BuildingExpenseLabor::where('building_expense_id', $id)->first();
            if ($labor !== null){
                $labor->labor = $request->labor;
                $labor->cost = $request->labor_cost;
                $labor->save();
            } else {
                $labor = new BuildingExpenseLabor();
                $labor->labor = $request->labor;
                $labor->cost = $request->labor_cost;
                $labor->save();
            }
        }
        if($expense){
            return redirect()->route('accountant.expense.index')->with(['alert' => 'success', 'message' => 'Expense Update Successfully']);
        } else{
            return redirect()->back()->with(['alert' => 'error', 'message' => 'Expense Update Error']);
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
        $expense = BuildingExpense::findOrFail($id);
        $labor = BuildingExpenseLabor::where('building_expense_id', $expense->id)->first();
        $expense->delete();
        $labor->delete();
        if($expense){
            return redirect()->back()->with(['alert' => 'success', 'message' =>  'Expense Delete Successfully']);
        } else{
            return redirect()->back()->with(['alert' => 'error', 'message' =>  'Expense Delete Error']);
        }
    }

    public function generatePDF(Request $request)
    {
        $expense = Expense::with('labor', 'project')->where('date', '<=', $request->end_date)
        ->where('date', '>=', $request->start_date)
        ->get();

        /*$pdf = PDF::loadView('accountant.pdf.expense_report', $expense);
        return $pdf->download('ExpenseReport.pdf');*/
        $storage = [];
        foreach ($expense as $item) {
            $storage[] = [
                'id' => $item['id'],
                'project_name' => $item['project']['name'],
                'raw_material' => $item['raw_material'],
                'qty' => $item['qty'],
                'cost' => $item['cost'],
                'labor' => $item['labor']['labor'],
                'cost_labor' => $item['labor']['cost'],
                'total_expense' => $item['cost'] + $item['labor']['cost'],
                'date' => $item['date'],
            ];
        }
        return (new FastExcel($storage))->download('expense.xlsx');

    }
}
