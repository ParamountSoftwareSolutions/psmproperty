<?php

namespace App\Http\Controllers\SocietyAdmin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\NocType;
use App\Models\Province;
use App\Models\SocietyCategory;
use App\Models\SocietyCategoryData;
use App\Models\SocietySale;
use App\Models\SocietyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $nocTypes = NocType::all();
        $societyTypes = SocietyType::all();
        $cities = City::all();
        $apartments = SocietyCategoryData::where('created_by', auth()->user()->id)->where('category_name', 'Apartment')->get();

        $apartmentsCount = 0;
        foreach($apartments as $apartment){
            $apartmentsCount += count(json_decode($apartment->data_array));
        }

        $provinces = Province::all();
        $societyCategories = SocietyCategory::all();

        $salesData = DB::select("SELECT SUM(installment_amount) AS amount,
                                    DATE_FORMAT(due_date, \"%m\") AS MONTH
                                    FROM
                                    society_installment_data
                                    GROUP BY
                                        MONTH");

        $salesCount = array();
        $labels = array();
        $months = ['01'=>'Jan', '02'=> 'Feb', '03'=>'Mar', '04'=>'Apr', '05'=>'May', '06'=>'Jun', '07'=>'Jul', '08'=>'Aug', '09'=>'Sep', '10'=>'Oct', '11'=>'Nov', '12'=>'Dec'];
        foreach ($salesData as $data){
         $labels[] = $months[$data->MONTH];
         $salesCount[] = $data->amount;
        }

        $calculatedData = array('sales' => $salesCount, 'months' => $labels);
        //return $calculatedData['months'];
        return view('society_admin.index', array('apartmentCount'=> $apartmentsCount ,'salesCount'=>$calculatedData, 'nocTypes' => $nocTypes, 'societyTypes' => $societyTypes, 'cities' => $cities, 'provinces' => $provinces, 'societyCategories' => $societyCategories));
    }
    public function receipt(){
        return view('society_admin.receipt', array('activePage' => $this->activePage));
    }

}
