<?php

namespace App\Http\Controllers\PropertyManager;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\BuildingEmployee;
use App\Models\BuildingExpense;
use App\Models\BuildingExpenseLabor;
use App\Models\BuildingOfficeExpense;
use App\Models\BuildingSale;
use App\Models\BuildingSaleInstallment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        //$data = [];
        $building = Helpers::building_detail();

        $sales = BuildingSale::with('customer')->whereIn('building_id', $building->pluck('id')->toArray())->where(['order_type' => 'sale'])->get();
        $leads = BuildingSale::whereIn('building_id', $building->pluck('id')->toArray())->where(['order_type' => 'lead'])->get();
        $sale = BuildingSale::whereIn('building_id', $building->pluck('id')->toArray())->where(['order_type' => 'sale'])->get();

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


        $data['monthList'] = $month = $this->yearMonth();
        $data['yearList'] = $this->yearList();
        $year = date('Y');
        $data['currentYear'] = $year;
        $min = 0;
        $max = 0;

        //   ----------------------------------------- Income ------------------------------------------------------------
        $income = BuildingSaleInstallment::whereIn('building_sale_id', $sale->pluck('id')->toArray())->where('status', 'paid')->
        selectRaw('SUM(installment_amount) as amount, MONTH(created_at) as month, YEAR(created_at) as year');
        /*if (isset($request->start_month) && isset($request->last_month)) {
            $from = $request->start_month;
            $to = $request->last_month;
            $income->whereBetween('created_at', [$from, $to]);
        } else {*/
            $income->whereRAW('YEAR(created_at) =?', [$year]);
        //}
        $income->groupBy('month', 'year');
        $income = $income->get();
        $tmpArray = [];
        if ($income->isEmpty()){
            array_push($tmpArray, 0);
        }
        foreach ($income as $value) {
            $tmpArray[$value->month] = $value->amount;
        }
        $tmp = [];
        foreach ($tmpArray as $month => $record) {
            for ($i = 1; $i <= 12; $i++) {
                $tmp[$i] = Arr::exists($tmpArray, $i) ? (int)$tmpArray[$i] : 0;
            }
        }

        //------------------------------------ Expense ----------------------------------------------------
        $expense = BuildingExpense::whereIn('building_id', $building->pluck('id')->toArray());
        $expense_labors = BuildingExpenseLabor::whereIn('building_expense_id', $expense->get()->pluck('id')->toArray());
        $expense_office = BuildingOfficeExpense::whereIn('building_id', $building->pluck('id')->toArray());
        $total_expense = $expense->sum('cost') + $expense_labors->sum('cost') + $expense_office->sum('cost');


        $expense->selectRaw('SUM(cost) as amount, MONTH(date) as month,YEAR(date) as year');
        $expense->whereRAW('YEAR(date) =?', [$year]);
        $expense->groupBy('year', 'month');
        $expense = $expense->get();

        $expense_labors->selectRaw('SUM(cost) as amount, MONTH(created_at) as month,YEAR(created_at) as year');
        $expense_labors->whereRAW('YEAR(created_at) =?', [$year]);
        $expense_labors->groupBy('year', 'month');
        $expense_labors = $expense_labors->get();

        $expense_office->selectRaw('SUM(cost) as amount, MONTH(date) as month,YEAR(date) as year');
        $expense_office->whereRAW('YEAR(date) =?', [$year]);
        $expense_office->groupBy('year', 'month');
        $expense_office = $expense_office->get();


        //dd($expense, $expense_labors, $expense_office);

        $expense_month_data = [];
        $expense_labors_month_data = [];
        $expense_office_month_data = [];
        if ($expense->isEmpty()){
            array_push($expense_month_data, 0);
        }
        if ($expense_labors->isEmpty()){
            array_push($expense_labors_month_data, 0);
        }
        if ($expense_office->isEmpty()){
            array_push($expense_office_month_data, 0);
        }
        foreach ($expense as $exp) {
            $expense_month_data[$exp->month] = $exp->amount;
        }
        foreach ($expense_labors as $labor) {
            $expense_labors_month_data[$labor->month] = $labor->amount;
        }
        foreach ($expense_office as $office) {
            $expense_office_month_data[$office->month] = $office->amount;
        }
        //dd($expense_month_data,$expense_labors_month_data, $expense_office_month_data);
        //$billTmpArray[] = $expense_month_data;
        //dd($billTmpArray);

        $expenseArray = [];
        $laborsExpenseArray = [];
        $officeExpenseArray = [];

        foreach ($expense_month_data as $month_id => $record) {
            for ($i = 1; $i <= 12; $i++) {
                $expenseArray[$i] = Arr::exists($expense_month_data, $i) ? $expense_month_data[$i] : 0;
            }
        }
        foreach ($expense_labors_month_data as $month_id => $record) {
            for ($i = 1; $i <= 12; $i++) {
                $laborsExpenseArray[$i] = Arr::exists($expense_labors_month_data, $i) ? $expense_labors_month_data[$i] : 0;
            }
        }
        foreach ($expense_office_month_data as $month_id => $record) {
            for ($i = 1; $i <= 12; $i++) {
                $officeExpenseArray[$i] = Arr::exists($expense_office_month_data, $i) ? $expense_office_month_data[$i] : 0;
            }
        }
        $totalExpenseArray = [];
        foreach ($expenseArray as $key => $value) {
            //dd($laborsExpenseArray[$key], $key, $value);
            $exp = $expenseArray[$key] + $laborsExpenseArray[$key] + $officeExpenseArray[$key];
            for ($i = 1; $i <= 12; $i++) {
                $totalExpenseArray[$key] = $exp;
            }
        }
        //dd($tmp, $expenseArray, $laborsExpenseArray, $officeExpenseArray, $totalExpenseArray, $min);
        $chartExpenseArr = array_map(
            function () {
                return array_sum(func_get_args());
            }, $tmp, $totalExpenseArray
        );
        //dd($chartExpenseArr, $tmp, $totalExpenseArray);

//dd($totalExpenseArray, $tmp);
        $data['incomeArr'] = $tmp;
        $data['expenseArr'] = $totalExpenseArray;
        $data['chartExpenseArr'] = $chartExpenseArr;

        $filter['startDateRange'] = 'Jan-' . $year;
        $filter['endDateRange'] = 'Dec-' . $year;

//dd($data);
        return view('property_manager.index', compact('sales', 'leads', 'un_paid_amount', 'paid_amount', 'total_expense', 'expense', 'expense_labors',
            'expense_office', 'previous_month', 'previous_week', 'previous_year', 'current_month', 'current_year', 'current_week'), $data);
    }

    public function custom_dashboard($id)
    {
        //$data = [];
        $building = Helpers::building_detail_single($id);

        $sales = BuildingSale::with('customer')->where('building_id', $building->id)->where(['order_type' => 'sale'])
        ->get();
        $leads = BuildingSale::where('building_id', $building->id)->where(['order_type' =>
            'lead'])->get();
        $sale = BuildingSale::where('building_id', $building->id)->where(['order_type' => 'sale'])->get();

        $expense = BuildingExpense::where('building_id', $building->id)->get();
        $expense_labors = BuildingExpenseLabor::whereIn('building_expense_id', $expense->pluck('id')->toArray())->get();
        $office = BuildingOfficeExpense::where('building_id', $building->id)->get();
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


        $data['monthList'] = $month = $this->yearMonth();
        $data['yearList'] = $this->yearList();
        $year = date('Y');
        $data['currentYear'] = $year;
        $min = 0;
        $max = 0;

        //   ----------------------------------------- Income ------------------------------------------------------------
        $income = BuildingSaleInstallment::whereIn('building_sale_id', $sale->pluck('id')->toArray())->where('status', 'paid')->
        selectRaw('SUM(installment_amount) as amount, MONTH(created_at) as month, YEAR(created_at) as year');
        /*if (isset($request->start_month) && isset($request->last_month)) {
            $from = $request->start_month;
            $to = $request->last_month;
            $income->whereBetween('created_at', [$from, $to]);
        } else {*/
        $income->whereRAW('YEAR(created_at) =?', [$year]);
        //}
        $income->groupBy('month', 'year');
        $income = $income->get();
        $tmpArray = [];
        if ($income->isEmpty()){
            array_push($tmpArray, 0);
        }
        foreach ($income as $value) {
            $tmpArray[$value->month] = $value->amount;
        }
        $tmp = [];
        foreach ($tmpArray as $month => $record) {
            for ($i = 1; $i <= 12; $i++) {
                $tmp[$i] = Arr::exists($tmpArray, $i) ? (int)$tmpArray[$i] : 0;
            }
        }

        //------------------------------------ Expense ----------------------------------------------------
        $expense = BuildingExpense::where('building_id', $building->id);
		 if (!empty($expense->first())) {
        $expense_labors = BuildingExpenseLabor::where('building_expense_id', $expense->first()->id);
        $expense_office = BuildingOfficeExpense::where('building_id', $building->id);
        $total_expense = $expense->sum('cost') + $expense_labors->sum('cost') + $expense_office->sum('cost');


        $expense->selectRaw('SUM(cost) as amount, MONTH(date) as month,YEAR(date) as year');
        $expense->whereRAW('YEAR(date) =?', [$year]);
        $expense->groupBy('year', 'month');
        $expense = $expense->get();

        $expense_labors->selectRaw('SUM(cost) as amount, MONTH(created_at) as month,YEAR(created_at) as year');
        $expense_labors->whereRAW('YEAR(created_at) =?', [$year]);
        $expense_labors->groupBy('year', 'month');
        $expense_labors = $expense_labors->get();

        $expense_office->selectRaw('SUM(cost) as amount, MONTH(date) as month,YEAR(date) as year');
        $expense_office->whereRAW('YEAR(date) =?', [$year]);
        $expense_office->groupBy('year', 'month');
        $expense_office = $expense_office->get();


        //dd($expense, $expense_labors, $expense_office);

        $expense_month_data = [];
        $expense_labors_month_data = [];
        $expense_office_month_data = [];
        if ($expense->isEmpty()){
            array_push($expense_month_data, 0);
        }
        if ($expense_labors->isEmpty()){
            array_push($expense_labors_month_data, 0);
        }
        if ($expense_office->isEmpty()){
            array_push($expense_office_month_data, 0);
        }
        foreach ($expense as $exp) {
            $expense_month_data[$exp->month] = $exp->amount;
        }
        foreach ($expense_labors as $labor) {
            $expense_labors_month_data[$labor->month] = $labor->amount;
        }
        foreach ($expense_office as $office) {
            $expense_office_month_data[$office->month] = $office->amount;
        }
        //dd($expense_month_data,$expense_labors_month_data, $expense_office_month_data);
        //$billTmpArray[] = $expense_month_data;
        //dd($billTmpArray);

        $expenseArray = [];
        $laborsExpenseArray = [];
        $officeExpenseArray = [];

        foreach ($expense_month_data as $month_id => $record) {
            for ($i = 1; $i <= 12; $i++) {
                $expenseArray[$i] = Arr::exists($expense_month_data, $i) ? $expense_month_data[$i] : 0;
            }
        }
        foreach ($expense_labors_month_data as $month_id => $record) {
            for ($i = 1; $i <= 12; $i++) {
                $laborsExpenseArray[$i] = Arr::exists($expense_labors_month_data, $i) ? $expense_labors_month_data[$i] : 0;
            }
        }
        foreach ($expense_office_month_data as $month_id => $record) {
            for ($i = 1; $i <= 12; $i++) {
                $officeExpenseArray[$i] = Arr::exists($expense_office_month_data, $i) ? $expense_office_month_data[$i] : 0;
            }
        }
        $totalExpenseArray = [];
        foreach ($expenseArray as $key => $value) {
            //dd($laborsExpenseArray[$key], $key, $value);
            $exp = $expenseArray[$key] + $laborsExpenseArray[$key] + $officeExpenseArray[$key];
            for ($i = 1; $i <= 12; $i++) {
                $totalExpenseArray[$key] = $exp;
            }
        }
        //dd($tmp, $expenseArray, $laborsExpenseArray, $officeExpenseArray, $totalExpenseArray, $min);
        $chartExpenseArr = array_map(
            function () {
                return array_sum(func_get_args());
            }, $tmp, $totalExpenseArray
        );
        //dd($chartExpenseArr, $tmp, $totalExpenseArray);

//dd($totalExpenseArray, $tmp);
        $data['incomeArr'] = $tmp;
        $data['expenseArr'] = $totalExpenseArray;
        $data['chartExpenseArr'] = $chartExpenseArr;

        $filter['startDateRange'] = 'Jan-' . $year;
        $filter['endDateRange'] = 'Dec-' . $year;

//dd($data);
        return view('property_manager.custom_dashboard', compact('sales', 'leads', 'un_paid_amount', 'paid_amount', 'total_expense', 'expense', 'expense_labors',
            'expense_office', 'previous_month', 'previous_week', 'previous_year', 'current_month', 'current_year', 'current_week'), $data);
			   } else {
            $expense_office = [];
            $data['incomeArr'] = $tmp;
            $data['expenseArr'] = [];
            $data['chartExpenseArr'] = [];
            return view('property_manager.custom_dashboard', compact(
                'sales',
                'leads',
                'un_paid_amount',
                'paid_amount',
                'total_expense',
                'expense',
                'expense_labors',
                'expense_office',
                'previous_month',
                'previous_week',
                'previous_year',
                'current_month',
                'current_year',
                'current_week'
            ), $data);
        }
    }

    public function yearMonth()
    {
        $month[] = __('January');
        $month[] = __('February');
        $month[] = __('March');
        $month[] = __('April');
        $month[] = __('May');
        $month[] = __('June');
        $month[] = __('July');
        $month[] = __('August');
        $month[] = __('September');
        $month[] = __('October');
        $month[] = __('November');
        $month[] = __('December');

        return $month;
    }

    public function yearList()
    {
        $starting_year = date('Y', strtotime('-5 year'));
        $ending_year = date('Y');

        foreach (range($ending_year, $starting_year) as $year) {
            $years[$year] = $year;
        }

        return $years;
    }
}
