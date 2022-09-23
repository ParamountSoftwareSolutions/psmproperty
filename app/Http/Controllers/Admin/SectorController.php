<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocietyType;
use App\Models\StatusType;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    private $activePage;
    public function __construct(){
        $this->activePage = "sector";
    }

    public function index(){
        $status  = StatusType::with('Status')->where('name', 'sector')->get();
        $societyTypes = SocietyType::all();
        return view('admin.sector.index', array('activePage' => $this->activePage, 'status' => $status, 'societyTypes' => $societyTypes));
    }

    public function create(Request $request){
        $noc = new SocietyType();
        $noc->name = $request->get('sector_name');
        $noc->status_id = $request->get('status_id');
        $noc->created_by = auth()->user()->id;
        $noc->save();
        return back()->with('success', 'Status Added Successfully');
    }

    public function delete($id){
        $noc = SocietyType::find($id);
        if($noc != null){
            $noc->delete();
            return back()->with('success', 'Sector deleted Successfully');
        }else{
            return back()->with('error', 'Record Not Found');
        }
    }
}
