<?php

namespace App\Http\Controllers\SalePerson;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\BuildingEmployee;
use App\Models\BuildingSale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $building = (new Helpers)->building_detail();
        $sale_person = BuildingEmployee::where('employee_id', Auth::id())->first()->employee_id;

        $sales = BuildingSale::with('customer')->where(['property_admin_id' => $building[0]->user_id, 'sale_person_id' => $sale_person])->where(['order_type' => 'sale'])->get();
        $leads = BuildingSale::where(['property_admin_id' => $building[0]->user_id, 'sale_person_id' => $sale_person, 'order_type' => 'lead'])->get();
        $sale = BuildingSale::where(['property_admin_id' => $building[0]->user_id, 'sale_person_id' => $sale_person, 'order_type' => 'sale', 'order_status' => 'active'])->get();
        $mature_leads = BuildingSale::where(['property_admin_id' => $building[0]->user_id, 'sale_person_id' => $sale_person, 'order_type' => 'sale', 'order_status' => 'mature'])->get();
        $meeting = BuildingSale::where(['property_admin_id' => $building[0]->user_id, 'sale_person_id' => $sale_person, 'order_type' => 'lead', 'order_status' => 'arrange_meeting'])->get();

        return view('sale_person.index', compact('sales', 'sale', 'leads', 'mature_leads', 'meeting'));
    }
}
