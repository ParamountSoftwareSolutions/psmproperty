<?php

namespace App\Http\Controllers\PropertyManager;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\BuildingExpenseLabor;
use App\Models\BuildingOfficeExpense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfficeExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $building = Helpers::building_detail();
        $office_expenses = BuildingOfficeExpense::with('building')->whereIn('building_id', $building->pluck('id')->toArray())->get();
        return view('property_manager.office_expense.index', compact('office_expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $building = Helpers::building_detail();
        return view('property_manager.office_expense.create', compact('building'));
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
            'category' => 'required',
            'cost' => 'required',
        ]);
        $expense = new BuildingOfficeExpense();
        $expense->building_id = $request->building_id;
        $expense->category = $request->category;
        $expense->cost = $request->cost;
        $expense->date = $request->date;
        $expense->save();
        if($expense){
            return redirect()->route('property_manager.office_expense.index')->with(['alert' => 'success', 'message' =>  'Expense Create Successfully']);
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
        $office_expense = BuildingOfficeExpense::findOrFail($id);
        $building = Helpers::building_detail();
        return view('property_manager.office_expense.edit', compact('office_expense', 'building'));
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
            'category' => 'required',
            'cost' => 'required',
        ]);
        $office_expense = BuildingOfficeExpense::findOrFail($id);
        $office_expense->category = $request->category;
        $office_expense->cost = $request->cost;
        $office_expense->date = $request->date;
        $office_expense->save();
        if($office_expense){
            return redirect()->route('property_manager.office_expense.index')->with(['alert' => 'success', 'message' => 'Office Expense Update Successfully']);
        } else{
            return redirect()->back()->with(['alert' => 'error', 'message' => 'Office Expense Update Error']);
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
        $office_expense = BuildingOfficeExpense::findOrFail($id);
        $office_expense->delete();
        if($office_expense){
            return redirect()->back()->with(['alert' => 'success', 'message' =>  'Office Expense Delete Successfully']);
        } else{
            return redirect()->back()->with(['alert' => 'error', 'message' =>  'Office Expense Delete Error']);
        }
    }
}
