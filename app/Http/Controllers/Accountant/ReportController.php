<?php

namespace App\Http\Controllers\Accountant;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\BuildingExpense;
use App\Models\BuildingOfficeExpense;
use App\Models\BuildingRequest;
use App\Models\BuildingSale;
use App\Models\FloorDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /*public function index($type)
    {
        /*if ($type == 'sale'){
            $

        } elseif($type == 'expenses') {
            dd($type, 'expe');
        } elseif($type == 'employee') {
            dd($type, 'Wrong area');
        } else {
            dd($type, 'Wrong area');
        }
        $building = Building::where('manager_id', Auth::id())->get();
        $sale = [];
        $req{'building_id'} = '';
        dd($req);
        $req['start_date'] = '';
        $req['last_date'] = '';
        return view('property_manager.report.index', compact('building', 'sale', 'req'));
    }*/

    public function search(Request $req, $type, $time)
    {
        $req->validate([
            'building_id' => 'required',
            'start_date' => 'required',
            'last_date' => 'required',
        ]);
        $building = Helpers::building_detail();
        $total_sale = [];
        if ($type == 'sale') {
            $building_id = $building->where('id', $req->building_id)->first();

            $floor_detail = FloorDetail::where('building_id', $req->building_id)->whereIN('floor_id', json_decode($building_id->floor_list))->get()->pluck('id')->toArray();
            $sale = BuildingSale::with('building_installment_paid')->whereIn('floor_detail_id', $floor_detail)->whereBetween('created_at', [$req->start_date, $req->last_date])->get();
            foreach ($sale as $data) {
                $total_sale[] = $data->building_installment_paid->sum('installment_amount');
            }
            return view('property_manager.report.index', compact('building', 'sale', 'req', 'total_sale'));

        } elseif ($type == 'expenses') {
            dd($type, 'expe');
        } elseif ($type == 'employee') {
            dd($type, 'Wrong area');
        } else {
            dd($type, 'Wrong area');
        }

        if ($request) {
            return redirect('property-manager/report/' . $type)->with(['alert' => 'success', 'message' => ucwords($type) . ' Report Update Successfully']);
        } else {
            return redirect()->back()->with(['alert' => 'error', 'message' => ucwords($type) . ' Update Error']);
        }
    }

    public function accountStatement(Request $request)
    {
        $filter['account'] = __('All');
        $filter['type'] = __('Revenue');
        $reportData['revenues'] = '';
        $reportData['payments'] = '';
        $reportData['revenueAccounts'] = '';
        $reportData['paymentAccounts'] = '';

        $account = BuildingSale::where('created_by', '=', Auth::user()->creatorId())->get()->pluck('holder_name', 'id');
        $account->prepend('All', '');
        dd($account);
        $types = [
            'revenue' => __('Revenue'),
            'payment' => __('Payment'),
        ];

        if ($request->type == 'revenue' || !isset($request->type)) {

            $revenueAccounts = Revenue::select('bank_accounts.id', 'bank_accounts.holder_name', 'bank_accounts.bank_name')->leftjoin('bank_accounts', 'revenues.account_id', '=', 'bank_accounts.id')->groupBy('revenues.account_id')->selectRaw('sum(amount) as total');

            $revenues = Revenue::orderBy('id', 'desc');
        }

        if ($request->type == 'payment') {
            $paymentAccounts = Payment::select('bank_accounts.id', 'bank_accounts.holder_name', 'bank_accounts.bank_name')->leftjoin('bank_accounts', 'payments.account_id', '=', 'bank_accounts.id')->groupBy('payments.account_id')->selectRaw('sum(amount) as total');

            $payments = Payment::orderBy('id', 'desc');
        }


        if (!empty($request->start_month) && !empty($request->end_month)) {
            $start = strtotime($request->start_month);
            $end = strtotime($request->end_month);
        } else {
            $start = strtotime(date('Y-m'));
            $end = strtotime(date('Y-m', strtotime("-5 month")));
        }


        $currentdate = $start;
        while ($currentdate <= $end) {
            $data['month'] = date('m', $currentdate);
            $data['year'] = date('Y', $currentdate);

            if ($request->type == 'revenue' || !isset($request->type)) {
                $revenues->Orwhere(
                    function ($query) use ($data) {
                        $query->whereMonth('date', $data['month'])->whereYear('date', $data['year']);
                    }
                );

                $revenueAccounts->Orwhere(
                    function ($query) use ($data) {
                        $query->whereMonth('date', $data['month'])->whereYear('date', $data['year']);
                    }
                );
            }

            if ($request->type == 'payment') {
                $paymentAccounts->Orwhere(
                    function ($query) use ($data) {
                        $query->whereMonth('date', $data['month'])->whereYear('date', $data['year']);
                    }
                );
            }


            $currentdate = strtotime('+1 month', $currentdate);
        }

        if (!empty($request->account)) {
            if ($request->type == 'revenue' || !isset($request->type)) {
                $revenues->where('account_id', $request->account);
                $revenues->where('created_by', '=', \Auth::user()->creatorId());
                $revenueAccounts->where('account_id', $request->account);
            }

            if ($request->type == 'payment') {
                $payments->where('account_id', $request->account);
                $payments->where('created_by', '=', \Auth::user()->creatorId());

                $paymentAccounts->where('account_id', $request->account);
            }


            $bankAccount = BankAccount::find($request->account);
            $filter['account'] = !empty($bankAccount) ? $bankAccount->holder_name . ' - ' . $bankAccount->bank_name : '';
            if ($bankAccount->holder_name == 'Cash') {
                $filter['account'] = 'Cash';
            }

        }

        if ($request->type == 'revenue' || !isset($request->type)) {
            $reportData['revenues'] = $revenues->get();

            $revenueAccounts->where('revenues.created_by', '=', \Auth::user()->creatorId());
            $reportData['revenueAccounts'] = $revenueAccounts->get();

        }

        if ($request->type == 'payment') {
            $reportData['payments'] = $payments->get();

            $paymentAccounts->where('payments.created_by', '=', \Auth::user()->creatorId());
            $reportData['paymentAccounts'] = $paymentAccounts->get();
            $filter['type'] = __('Payment');
        }


        $filter['startDateRange'] = date('M-Y', $start);
        $filter['endDateRange'] = date('M-Y', $end);


        return view('report.statement_report', compact('reportData', 'account', 'types', 'filter'));
    }

    public function expenseSummary(Request $request)
    {
        if (!isset($request->building_id) || !isset($request->start_month) || !isset($request->last_month)){
            $req = null;
        }

        $building_list = Helpers::building_detail();
        $building_id = $building_list->pluck('id');
        $category = BuildingOfficeExpense::
        /*where('created_by', '=', \Auth::user()->creatorId())
            ->where('type', '=', 2)*/
        get()->pluck('category', 'id');
        $category->prepend('All', '');

        $data['monthList'] = $month = $this->yearMonth();
        $data['yearList'] = $this->yearList();
        $filter['category'] = __('All');

        if (isset($request->year)) {
            $year = $request->year;
        } else {
            $year = date('Y');
        }
        $data['currentYear'] = $year;

        $request_building_id[]  = $request->building_id;
        if ($request->building_id == 'all'){
            $building_id = $building_id;
        } else {
            $building_id = ($request->building_id !== null) ? $request_building_id : $building_id;
        }

        //   -----------------------------------------PAYMENT EXPENSE ------------------------------------------------------------
        $expenses = BuildingOfficeExpense::
        selectRaw('SUM(cost) as amount, MONTH(date) as month, YEAR(date) as year, category');
        if (isset($request->start_month) && isset($request->last_month)){
            $from = $request->start_month;
            $to = $request->last_month;
            $expenses->whereBetween('date', [$from, $to]);
        } else {
            $expenses->whereRAW('YEAR(date) =?', [$year]);
        }
        $expenses->whereIn('building_id', $building_id);
        if (!empty($request->category)) {
            $expenses->where('category', '=', $request->category);
            //$cat = BuildingExpenseCategory::find($request->category);
            $cat = BuildingOfficeExpense::where('category', $request->category)->first();
            $filter['category'] = !empty($cat) ? $cat->name : '';
        }
        $expenses->groupBy('month', 'year', 'category');
        $expenses = $expenses->get();

        $tmpArray = [];
        foreach ($expenses as $expense) {
            $tmpArray[$expense->category][$expense->month] = $expense->amount;
        }
        $array = [];
        foreach ($tmpArray as $cat_id => $record) {
            $tmp = [];
            $tmp['category'] = !empty(BuildingOfficeExpense::where('category', '=', $cat_id)->first()) ? BuildingOfficeExpense::where('category', '=', $cat_id)->first()->category : '';
            $tmp['data'] = [];
            for ($i = 1; $i <= 12; $i++) {
                $tmp['data'][$i] = array_key_exists($i, $record) ? $record[$i] : 0;
            }
            $array[] = $tmp;
        }
        $expensesDate = BuildingOfficeExpense::
        selectRaw('SUM(cost) as amount, MONTH(date) as month, YEAR(date) as year')
            ->groupBy('month', 'year')->get();

        $expenseArr = [];
        foreach ($expenses as $data_expense) {
            $expenseArr[$data_expense->month] = $data_expense->amount;
        }

        for ($i = 1; $i <= 12; $i++) {
            $expenseTotal[] = array_key_exists($i, $expenseArr) ? $expenseArr[$i] : 0;
        }

//     ------------------------------------BILL EXPENSE----------------------------------------------------
        $construction = BuildingExpense::selectRaw('SUM(cost) as amount, MONTH(date) as month,YEAR(date) as year');
        if (isset($request->start_month) && isset($request->last_month)){
            $from = $request->start_month;
            $to = $request->last_month;
            $construction->whereBetween('date', [$from, $to]);
        } else {
            $construction->whereRAW('YEAR(date) =?', [$year]);
        }
        $construction->whereIn('building_id', $building_id);
        $construction->groupBy('year', 'month');
        /*if(!empty($request->category))
        {
            $construction->where('category_id', '=', $request->category);
        }*/
        $construction = $construction->get();
        //dd($expenses, $construction);
        $construction_month_data = [];
        foreach ($construction as $bill) {
            $construction_month_data[$bill->month] = $bill->amount;
        }
        $billTmpArray[] = $construction_month_data;

        $billArray = [];
        foreach ($billTmpArray as $month_id => $record) {
            //dd($record);
            $bill = [];
//            $bill['category'] = !empty(ProductServiceCategory::where('id', '=', $cat_id)->first()) ? ProductServiceCategory::where('id', '=', $cat_id)->first()->name : '';
            //$bill['data']     = [];
            for ($i = 1; $i <= 12; $i++) {
                $bill[$i] = array_key_exists($i, $record) ? $record[$i] : 0;
            }
            $billArray[] = $bill;
        }

        $billTotalArray = [];
        foreach ($construction as $bill)
        {
            $billTotalArray[$bill->month] = $bill->amount;
        }


        for ($i = 1; $i <= 12; $i++) {
            $billTotal[] = array_key_exists($i, $billTotalArray) ? $billTotalArray[$i] : 0;
        }
        //dd($construction, $billTmpArray, $expenses, $tmpArray, $array, $expenseTotal);
        //dd($billTotalArray, $billTotal, $expenseArr, $expenseTotal);
        $chartExpenseArr = array_map(
            function () {
                return array_sum(func_get_args());
            }, $expenseTotal, $billTotal
        );
//dd($chartExpenseArr, $expenseTotal, $billTotal);
        /*  $data['chartExpenseArr'] = $chartExpenseArr;*/
        $data['expenseArr'] = $array;
        $data['billArray'] = $billArray;
        $data['chartExpenseArr'] = $chartExpenseArr;

        $filter['startDateRange'] = 'Jan-' . $year;
        $filter['endDateRange'] = 'Dec-' . $year;

        return view('property_manager.report.expense', compact('filter', 'building_list', 'request'), $data);
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
