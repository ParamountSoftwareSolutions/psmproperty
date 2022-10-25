<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Floor;
use App\Models\Building;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class PropertyAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $property_admin = User::with('roles')
            ->whereHas('roles', function ($q) {
                $q->Where('name', 'property_admin');
            })
            ->get();
        return view("admin.property_admin.index", compact('property_admin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.property_admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'building' => 'required',
        ]);
        foreach(explode(",", $request->floor) as $floorName) {
            if (Floor::where('name', $floorName)->exists()) {
                return redirect()->back()->with($this->message('Floor Name Already Exist', 'error'));
            } else{
                continue;
            }
        }
        $property_admin = new User();
        $property_admin->username = $request->username;
        $property_admin->email = $request->email;
        $property_admin->phone_number = $request->phone_number;
        $property_admin->password = $request->password;
        $property_admin->building = $request->building;
        $property_admin->save();
        $floors = explode(",", $request->floor);
        foreach($floors as $floorName){
            $floor = new Floor();
            $floor->name = $floorName;
            $floor->save();
        }
        $role = Role::where('name', 'property_admin')->first();
        $property_admin->assignRole($role);
        if ($property_admin) {
            return redirect()->route('admin.property_admin.index')->with($this->message('Property Admin Create Successfully', 'success'));
        } else {
            return redirect()->back()->with($this->message('Property Admin Create Error', 'error'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $property_admin = User::with('roles')
            ->whereHas('roles', function ($q) {
                $q->Where('name', 'property_admin');
            })
            ->findOrFail($id);
        return view('admin.property_admin.edit', compact('property_admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required',
            'building' => 'required',
        ]);
//        foreach(explode(",", $request->floor) as $floorName) {
//            if (Floor::where('name', $floorName)->exists()) {
//                return redirect()->back()->with($this->message('Floor Name Already Exist', 'error'));
//            } else{
//                continue;
//            }
//        }
        $property_admin = User::findOrFail($id);
        $property_admin->username = $request->username;
        $property_admin->email = $request->email;
        $property_admin->phone_number = $request->phone_number;
        $property_admin->building = $request->building;
        $property_admin->save();
        $floors = explode(",", $request->floor);
        foreach($floors as $floorName){
            $floor = new Floor();
            $floor->name = $floorName;
            $floor->save();
        }
        $role = Role::where('name', 'property_admin')->first();
        $property_admin->assignRole($role);
        if ($property_admin) {
            return redirect()->route('admin.property_admin.index')->with($this->message('Property Admin Update Successfully', 'success'));
        } else {
            return redirect()->back()->with($this->message('Property Admin Update Error', 'error'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $user = User::with('roles')
            ->whereHas('roles', function ($q) {
                $q->Where('name', 'property_admin');
            })->findOrFail($id);
        $user->forceDelete();

        if ($user) {
            return redirect()->route('admin.property_admin.index')->with($this->message('User Delete SuccessFully', 'success'));
        } else {
            return redirect()->back()->with($this->message("User Delete Error", 'error'));
        }
    }

    public function activate($id)
    {
        $user = User::with('roles')
            ->whereHas('roles', function ($q) {
                $q->Where('name', 'property_admin');
            })->findOrFail($id);
        if ($user->status == 0) {
            $user->status = 1;
            $user->save();
            $propertyManager = Building::where('user_id',$id)->groupBy('manager_id')->pluck('manager_id')->toArray();
            $salePerson = Building::where('user_id',$id)->groupBy('sale_manager_id')->pluck('sale_manager_id')->toArray();
            $salePerson = $propertyManager+$salePerson;
            $users = User::whereIn('id',$salePerson)->get();
            foreach($users as $a){
                $a->status = 1;
                $a->save();
            }
            return redirect()->route('admin.property_admin.index')->with($this->message("User Activate Successfully", 'success'));
        } else {
            return redirect()->back()->with($this->message("User Activate Error", 'error'));
        }
    }

    public function deactivate($id)
    {
        $user = User::with('roles')
            ->whereHas('roles', function ($q) {
                $q->Where('name', 'property_admin');
            })->findOrFail($id);
        if ($user->status == 1) {
            $user->status = 0;
            $user->save();

            $propertyManager = Building::where('user_id',$id)->groupBy('manager_id')->pluck('manager_id')->toArray();
            $salePerson = Building::where('user_id',$id)->groupBy('sale_manager_id')->pluck('sale_manager_id')->toArray();
            $salePerson = $propertyManager+$salePerson;
            $users = User::whereIn('id',$salePerson)->get();
            foreach($users as $a){
                $a->status = 0;
                $a->save();
            }
            return redirect()->route('admin.property_admin.index')->with($this->message("User DeActivate Successfully", 'success'));
        } else {
            return redirect()->back()->with($this->message("User DeActivate Error", 'error'));
        }
    }
}
