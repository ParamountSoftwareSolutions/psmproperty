<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Status;
use App\Models\StatusType;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class StatusController extends Controller
{
    private $activePage;
    public function __construct(){
        $this->activePage = "status";
    }

    public function user(){
        $status  = StatusType::with('Status')->where('name', 'user')->get();
        $statusType = StatusType::all();
        return view('admin.status.index', array('activePage' => $this->activePage, 'status' => $status, 'statusTypes' => $statusType));
    }

    public function employee(){
        $status  = StatusType::with('Status')->where('name', 'employee')->get();
        $statusType = StatusType::all();
        return view('admin.status.index', array('activePage' => $this->activePage, 'status' => $status, 'statusTypes' => $statusType));
    }
    public function society(){
        $status  = StatusType::with('Status')->where('name', 'society')->get();
        $statusType = StatusType::all();
        return view('admin.status.index', array('activePage' => $this->activePage, 'status' => $status, 'statusTypes' => $statusType));
    }
    public function agent(){
        $status  = StatusType::with('Status')->where('name', 'agent')->get();
        $statusType = StatusType::all();
        return view('admin.status.index', array('activePage' => $this->activePage, 'status' => $status, 'statusTypes' => $statusType));
    }

    public function create(Request $request){
        $status = new Status();
        $status->name = $request->get('status_name');
        $status->status_type_id = $request->get('statusType');
        $status->created_by = auth()->user()->id;
        $status->save();
        return back()->with('success', 'Status Added Successfully');
    }

    public function createStatusType(Request $request){
        $statusType = new StatusType();
        $statusType->name = $request->get('status_type_name');
        $statusType->created_by = auth()->user()->id;
        $statusType->save();
        return back()->with('success', 'Status Added Successfully');
    }

    public function delete($id){
        $status = Status::find($id);
        if($status != null){
            $status->delete();
            return back()->with('success', 'Status Deleted Successfully');
        }else{
            return back()->with('error', 'Status Not Found');
        }
    }
}
