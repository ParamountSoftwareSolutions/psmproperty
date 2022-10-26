<?php

namespace App\Http\Controllers\PropertyManager;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\BuildingAssignUser;
use App\Models\BuildingSale;
use App\Models\TaskTarget;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TargetController extends Controller
{
    public function my_targets()
    {
        $targets = TaskTarget::where('assign_to',Auth::user()->id)->get();
        return view('property_manager.task_targets.index',compact('targets'));
    }

    public function staff_targets()
    {
        $targets = TaskTarget::where('user_id',Auth::user()->id)->get();
        return view('property_manager.task_targets.staff',compact('targets'));
    }

    public function assign_target()
    {
        return view('property_manager.task_targets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'assign_to' => 'required',
            'type' => 'required',
            'target' => 'required',
            'date' => 'required',
        ]);

        $date = explode(" - ",$request->date);
        $from = $date[0];
        $to = $date[1];

        $assign_to = $request->assign_to;
        $assign_to_list = Helpers::check_target_assign($assign_to);
        if(is_array($assign_to_list)){
            foreach ($assign_to_list as $assign_to_id){
                $target = new TaskTarget();
                $target->user_id = Auth::user()->id;
                $target->assign_to = $assign_to_id;
                $target->type = $request->type;
                $target->target = $request->target;
                $target->from = $from;
                $target->to = $to;
                $target->save();
                $target_arr[] = $target;
            }
            return redirect()->route('property_manager.my_targets',Helpers::user_login_route())->with($this->message('Target Assign Successfully', 'success'));
        }else{
            return redirect()->back()->with($this->message('Target Assign Error', 'error'));
        }
    }
    public function edit_task($panel,$id)
    {
        $target = TaskTarget::findOrFail($id);
        return view('property_manager.task_targets.edit',compact('target'));
    }
    public function update_task(Request $request,$panel,$id)
    {
        $request->validate([
            'type' => 'required',
            'target' => 'required',
            'date' => 'required',
        ]);
        $date = explode(" - ",$request->date);
        $from = $date[0];
        $to = $date[1];

        $target = TaskTarget::findOrFail($id);
        $target->type = $request->type;
        $target->target = $request->target;
        $target->from = $from;
        $target->to = $to;
        $target->save();
        if($target){
            return redirect()->route('property_manager.staff_targets',Helpers::user_login_route())->with($this->message('Target Updated Successfully', 'success'));
        }else{
            return redirect()->back()->with($this->message('Target Updated Error', 'error'));
        }
    }
    public function get_role_list($panel,$role)
    {
        $buildings = Helpers::building_detail()->pluck('id')->toArray();
        $users = BuildingAssignUser::whereIn('building_id',$buildings)->pluck('user_id')->toArray();
        $manager = User::select('id','username')->whereIn('id',$users)->with('roles')
            ->whereHas('roles', function ($q) use ($role) {
                $q->Where('name', $role);
            })
            ->get();
        return response()->json($manager);
    }
    public function task_reports($panel)
    {
        $targets = TaskTarget::where('user_id',Auth::user()->id)->groupBy('assign_to')->get();
        return view('property_manager.task_targets.reports',compact('targets'));
    }
}
