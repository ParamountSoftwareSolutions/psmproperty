<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Province;
use App\Models\Status;
use App\Models\StatusType;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    private $activePage;
    public function __construct(){
        $this->activePage = "location";
    }

    public function province(){
        $provinces = Province::all();
        $status  = StatusType::with('Status')->where('name', 'location')->get();
        return view('admin.location.province.index', array('activePage'=> $this->activePage, 'provinces' => $provinces, 'status' => $status));
    }

    public function city(){
        $cities = City::all();
        $provinces = Province::all();
        $status  = StatusType::with('Status')->where('name', 'location')->get();
        return view('admin.location.city.index', array('activePage'=> $this->activePage, 'cities' => $cities, 'provinces' => $provinces ,'status' => $status));
    }

    public function createProvince(Request $request){
        $province = new Province();
        $province->name = $request->get('province_name');
        $province->created_by = auth()->user()->id;
        $province->status_id = $request->get('status_id');
        $province->save();
        return redirect('admin/location/province')->with('success', 'Province Created Successfully');
    }

    public function createCity(Request $request){
        $city = new City();
        $city->name = $request->get('city_name');
        $city->created_by = auth()->user()->id;
        $city->status_id = $request->get('status_id');
        $city->province_id = $request->get('province_id');
        $city->save();
        return redirect('admin/location/city')->with('success', 'City Created Successfully');
    }

    public function deleteProvince($id){
        $province = Province::find($id);
        if($province != null){
            $province->delete();
            return back()->with('success', 'Record Deleted Successfully');
        }else{
            return back()->with('error', 'Record Not Found');
        }

    }
    public function deleteCity($id){
        $city = City::find($id);
        if($city != null){
            $city->delete();
            return back()->with('success', 'Record Deleted Successfully');
        }else{
            return back()->with('error', 'Record Not Found');
        }
    }
}
