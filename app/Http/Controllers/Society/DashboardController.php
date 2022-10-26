<?php

namespace App\Http\Controllers\Society;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\NocType;
use App\Models\Province;
use App\Models\SocietyCategory;
use App\Models\SocietySale;
use App\Models\SocietyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    private $activePage;
    public function __construct(){
        $this->activePage = "dashboard";
    }

    public function index(){

        $society = Auth::user()->Society;
        if($society == null){
            $society = Auth::user()->Employee->Society;
        }

        $societyCategories = $society->CategoryData;
        $societySales = $society->Sales;
        $employees = $society->Employees;

        $totalcash = 0;
        $pendingCash = 0;

        //calc this month sales

        //calc last month sales

        //calc last year sales with respect to months

        foreach ($societySales as $sale){
            $installmentData = DB::select('SELECT SUM(installment_amount) AS installment FROM society_installment_data WHERE society_installment_data.society_sales_id = '. $sale->id .' AND status_id = 10');
            $totalcash += $installmentData[0]->installment;

            $pendingInstallment = DB::select('SELECT SUM(installment_amount) AS pendingCash FROM society_installment_data WHERE society_installment_data.society_sales_id = '. $sale->id .' AND status_id = 9');
            $pendingCash += $pendingInstallment[0]->pendingCash;
        }

        return view('society.index', array('activePage' => $this->activePage, 'societySales' => $societySales, 'societyCategories' => $societyCategories, 'employees' => $employees, 'totalCash'=>$totalcash, 'pendingCash' => $pendingCash));
    }

}
