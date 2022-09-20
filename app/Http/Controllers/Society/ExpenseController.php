<?php

namespace App\Http\Controllers\Society;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\ExpenseLabor;
use App\Models\Project;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Rap2hpoutre\FastExcel\FastExcel;

class ExpenseController extends Controller
{
    private $activePage;
    public function __construct(){
        $this->activePage = "Expense";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activePage = $this->activePage;
        $expenses = Expense::with('project', 'labor')->get();
        return view('society.expense.index', compact('expenses', 'activePage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $activePage = $this->activePage;
        $expense = Expense::with('labor', 'project')->get();
        $project = Project::where('society_id',  Auth::guard('web')->user()->Society->id)->get();
        return view('society.expense.create', compact('expense', 'activePage', 'project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'raw_material' => 'required',
            'qty' => 'required',
            'cost' => 'required',

        ]);
        $expense = new Expense();
        $expense->project_id = $request->project_id;
        $expense->raw_material = $request->raw_material;
        $expense->qty = $request->qty;
        $expense->cost = $request->cost;
        $expense->save();

        if ($request->has('labor')) {
            $labor = new ExpenseLabor();
            $labor->expense_id = $expense->id;
            $labor->labor = $request->labor;
            $labor->cost = $request->cost;
            $labor->save();
        }
        if($expense){
            return redirect()->route('expense.index')->with(['success' => 'Expense Create Successfully']);
        } else{
            return redirect()->back()->with(['error' => 'Expense Create Error']);
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expense = Expense::with('labor')->findOrFail($id);
        $project = Project::where('society_id',  Auth::guard('web')->user()->Society->id)->get();
        $activePage = $this->activePage;
        return view('society.expense.edit', compact('expense', 'activePage', 'project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'raw_material' => 'required',
            'qty' => 'required',
            'cost' => 'required',
        ]);
        $expense = Expense::findOrFail($id);
        $expense->raw_material = $request->raw_material;
        $expense->qty = $request->qty;
        $expense->cost = $request->cost;
        $expense->date = $request->date;
        $expense->save();

        if ($request->has('labor')) {
            $labor = ExpenseLabor::where('expense_id', $id)->first();
            $labor->labor = $request->labor;
            $labor->cost = $request->cost;
            $labor->save();
        }
        if($expense){
            return redirect()->route('expense.index')->with(['success' => 'Expense Update Successfully']);
        } else{
            return redirect()->back()->with(['error' => 'Expense Update Error']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expense = Expense::findOrFail($id);
        $expense->delete();
        if($expense){
            return redirect()->back()->with(['success' => 'Expense Delete Successfully']);
        } else{
            return redirect()->back()->with(['error' => 'Expense Delete Error']);
        }
    }

    public function generatePDF(Request $request)
    {
        $expense = Expense::with('labor', 'project')->where('date', '<=', $request->end_date)
        ->where('date', '>=', $request->start_date)
        ->get();

        /*$pdf = PDF::loadView('society.pdf.expense_report', $expense);
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
