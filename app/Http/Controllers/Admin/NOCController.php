<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NocType;
use App\Models\StatusType;
use Illuminate\Http\Request;

class NOCController extends Controller
{
    //
    private $activePage;
    public function __construct(){
        $this->activePage = "noc";
    }


    public function index(){
        $status = StatusType::with('Status')->where('name', 'noc')->get();
        $nocs = NocType::all();
        return view('admin.noc.index', array('activePage' => $this->activePage, 'nocs' => $nocs, 'status'=> $status[0]->status));
    }

    public function create(Request $request){
        $noc = new NocType();
        $noc->name = $request->get('noc_name');
        $noc->status_id = $request->get('status_id');
        $noc->created_by = auth()->user()->id;
        $noc->save();
        return back()->with('success', 'Status Added Successfully');


    }

    public function delete($id){
        $noc = NocType::find($id);

        if($noc != null){
           $noc->delete();
           return back()->with('success', 'NOC deleted Successfully');
        }else{
            return back()->with('error', 'Record Not Found');
        }
    }
}
