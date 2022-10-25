<?php

namespace App\Http\Controllers\SalePerson;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\BuildingEmployee;
use App\Models\BuildingSale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $building = Helpers::building_detail();
        $sale_person = User::findOrFail(Auth::id())->id;

        $sales = BuildingSale::with('customer')->whereIn('building_id', $building->pluck('id')->toArray())->where(['user_id' => $sale_person])->where(['order_type' => 'sale'])->get();
        $leads = BuildingSale::whereIn('building_id', $building->pluck('id')->toArray())->where(['user_id' => $sale_person, 'order_type' => 'lead'])->get();
        $sale = BuildingSale::whereIn('building_id', $building->pluck('id')->toArray())->where(['user_id' => $sale_person, 'order_type' => 'sale', 'order_status' => 'active'])->get();
        $mature_leads = BuildingSale::whereIn('building_id', $building->pluck('id')->toArray())->where(['user_id' => $sale_person, 'order_type' => 'sale', 'order_status' => 'mature'])->get();
        $meeting = BuildingSale::whereIn('building_id', $building->pluck('id')->toArray())->where(['user_id' => $sale_person, 'order_type' => 'lead', 'order_status' => 'arrange_meeting'])->get();

        return view('sale_person.index', compact('sales', 'sale', 'leads', 'mature_leads', 'meeting'));
    }
}
