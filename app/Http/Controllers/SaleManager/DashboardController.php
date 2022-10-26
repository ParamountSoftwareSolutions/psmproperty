<?php

namespace App\Http\Controllers\SaleManager;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\BuildingExpense;
use App\Models\BuildingExpenseLabor;
use App\Models\BuildingOfficeExpense;
use App\Models\BuildingSale;
use App\Models\BuildingSaleInstallment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $building = Helpers::building_detail();
        $assign_data = Helpers::building_assign_user();

        $sales = BuildingSale::with('customer')->whereIn('building_id', $building->pluck('id')->toArray())->where(['order_type' => 'sale'])->get();
        $leads = BuildingSale::whereIn('building_id', $building->pluck('id')->toArray())->where(['order_type' => 'lead'])->get();
        $sale = BuildingSale::whereIn('building_id', $building->pluck('id')->toArray())->where(['order_type' => 'sale', 'order_status' => 'active'])->get();
        $mature_leads = BuildingSale::whereIn('building_id', $building->pluck('id')->toArray())->where(['order_type' => 'sale', 'order_status' => 'mature'])->get();
        $meeting = BuildingSale::whereIn('building_id', $building->pluck('id')->toArray())->where(['order_type' => 'lead', 'order_status' => 'arrange_meeting'])->get();

        $expense = BuildingExpense::whereIn('building_id', $building->pluck('id')->toArray())->get();
        $expense_labors = BuildingExpenseLabor::whereIn('building_expense_id', $expense->pluck('id')->toArray())->get();
        $office = BuildingOfficeExpense::whereIn('building_id', $building->pluck('id')->toArray())->get();
        $total_expense = $expense->sum('cost') + $expense_labors->sum('cost') + $office->sum('cost');
        //dd($expense->sum('cost') + $expense_labors->sum('cost') + $expense_office->sum('cost'));

        $installment_paid = BuildingSaleInstallment::whereIn('building_sale_id', $sale->pluck('id')->toArray())->where('status', 'paid')->get();
        $installment_un_paid = BuildingSaleInstallment::whereIn('building_sale_id', $sale->pluck('id')->toArray())->where('status', 'not_paid')->get();
        $previous_month = BuildingSaleInstallment::whereIn('building_sale_id', $sale->pluck('id')->toArray())->where('status', 'paid')->whereBetween('created_at',
            [Carbon::now()->startOfMonth()->subMonth(), Carbon::now()->endOfMonth()->subMonth()])->get();
        $previous_year = BuildingSaleInstallment::whereIn('building_sale_id', $sale->pluck('id')->toArray())->where('status', 'paid')->whereBetween('created_at',
            [Carbon::now()->startOfYear()->subYear(), Carbon::now()->endOfYear()->subYear()])->get();
        $previous_week = BuildingSaleInstallment::whereIn('building_sale_id', $sale->pluck('id')->toArray())->where('status', 'paid')->whereBetween('created_at',
            [Carbon::now()->startOfWeek()->subWeek(), Carbon::now()->endOfWeek()->subWeek()])->get();

        $current_month = BuildingSaleInstallment::whereIn('building_sale_id', $sale->pluck('id')->toArray())->where('status', 'paid')->whereBetween('created_at',
            [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->get();
        $current_year = BuildingSaleInstallment::whereIn('building_sale_id', $sale->pluck('id')->toArray())->where('status', 'paid')->whereBetween('created_at',
            [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->get();
        $current_week = BuildingSaleInstallment::whereIn('building_sale_id', $sale->pluck('id')->toArray())->where('status', 'paid')->whereBetween('created_at',
            [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();


        if ($installment_paid->isEmpty()) {
            $paid_amount = 0;
        } else {
            $paid_amount = $installment_paid->sum('installment_amount');
        }
        if ($installment_un_paid->isEmpty()) {
            $un_paid_amount = 0;
        } else {
            $un_paid_amount = $installment_un_paid->sum('installment_amount');
        }

        return view('sale_manager.index', compact('sales', 'sale', 'leads', 'mature_leads', 'meeting'));
    }
}
