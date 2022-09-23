<?php

namespace App\Http\Controllers\Property;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\BuildingAssignUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SaleManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $sale_manager = User::with('roles')
            ->whereHas('roles', function ($q) {
                $q->Where('name', 'sale_manager');
            })
            ->get();
        $building = Helpers::building_detail();
        return view("property.sale_manager.index", compact('sale_manager', 'building'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('property.sale_manager.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|unique:users',
            'phone_number' => 'required|unique:users',
            'cnic' => 'required|unique:users'
        ]);
        $building = Building::whereIn('id', $request->building_id)->get()->pluck('id');
        $sale_manager = new User();
        $sale_manager->username = $request->username;
        $sale_manager->email = $request->email;
        $sale_manager->phone_number = $request->phone_number;
        $sale_manager->cnic = $request->cnic;
        $sale_manager->password = Hash::make($request->password);
        $sale_manager->save();
        foreach($building as $id){
            $assign_data = new BuildingAssignUser();
            $assign_data->building_id = $id;
            $assign_data->user_id = $sale_manager->id;
            $assign_data->save();
        }
        $role = Role::where('name', 'sale_manager')->first();
        $sale_manager->assignRole($role);

        if ($sale_manager) {
            return redirect()->route('property_admin.sale_manager.index')->with($this->message('Sale Manager Create Successfully', 'success'));
        } else {
            return redirect()->back()->with($this->message('Sale Manager Create Error', 'danger'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $sale_manager = User::with('roles')
            ->whereHas('roles', function ($q) {
                $q->Where('name', 'sale_manager');
            })
            ->findOrFail($id);
        $building = Helpers::building_detail();
        return view('property.sale_manager.edit', compact('sale_manager', 'building'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|unique:users,email,' . $id,
        ]);
        $sale_manager = User::with('roles')
            ->whereHas('roles', function ($q) {
                $q->Where('name', 'sale_manager');
            })->findOrFail($id);
        $sale_manager->username = $request->username;
        $sale_manager->email = $request->email;
        $sale_manager->phone_number = $request->phone_number;
        $sale_manager->cnic = $request->cnic;
        $sale_manager->save();
        $assign_building = BuildingAssignUser::where('user_id', $sale_manager->id)->get()->pluck('building_id')->toArray();
        $building = Building::whereIn('id', $assign_building)->get()->pluck('id')->toArray();
        $building_reassign = array_diff($building, $request->building_id);
        if ($building_reassign !== null){
            BuildingAssignUser::where(['user_id' => $sale_manager->id])->whereIn('building_id', $building_reassign)->delete();
        }
        if ($request->building_id !== null) {
            foreach ($request->building_id as $id) {
                BuildingAssignUser::UpdateOrInsert([
                    'user_id' => $sale_manager->id,
                    'building_id' => $id,
                ], [
                    'user_id' => $sale_manager->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
        if ($sale_manager) {
            return redirect()->route('property_admin.sale_manager.index')->with($this->message('Sale Manager Update Successfully', 'success'));
        } else {
            return redirect()->back()->with($this->message('Sale Manager Update Error', 'danger'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        BuildingAssignUser::where('user_id', $id)->delete();

        if ($user) {
            return redirect()->route('property_admin.sale_manager.index')->with($this->message('Sale Manager Delete SuccessFully', 'success'));
        } else {
            return redirect()->back()->with($this->message("Sale Manager Delete Error", 'error'));
        }
    }

    public function activate($id)
    {
        $user = User::with('roles')
            ->whereHas('roles', function ($q) {
                $q->Where('name', 'sale_manager');
            })->findOrFail($id);
        if ($user->status == 0) {
            $user->status = 1;
            $user->save();
            return redirect()->route('property_admin.sale_manager.index')->with($this->message("Sale Manager Activate Successfully", 'success'));
        } else {
            return redirect()->back()->with($this->message("Sale Manager Activate Error", 'error'));
        }
    }

    public function deactivate($id)
    {
        $user = User::
        with('roles')
            ->whereHas('roles', function ($q) {
                $q->Where('name', 'sale_manager');
            })->findOrFail($id);
        if ($user->status == 1) {
            $user->status = 0;
            $user->save();
            return redirect()->route('property_admin.sale_manager.index')->with($this->message("Sale Manager DeActivate Successfully", 'success'));
        } else {
            return redirect()->back()->with($this->message("Sale Manager DeActivate Error", 'error'));
        }
    }
}
