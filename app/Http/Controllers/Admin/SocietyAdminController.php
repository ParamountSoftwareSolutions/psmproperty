<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SocietyAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $society_admin = User::with('roles')
            ->whereHas('roles', function ($q) {
                $q->Where('name', 'society_admin');
            })
            ->get();
        return view("admin.society_admin.index", compact('society_admin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.society_admin.create');
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
            'society_allow' => 'required',
        ]);
        $society_admin = new User();
        $society_admin->username = $request->username;
        $society_admin->email = $request->email;
        $society_admin->phone_number = $request->phone_number;
        $society_admin->society_allow = $request->society_allow;
        $society_admin->project_allow = $request->project_allow;
        $society_admin->password = Hash::make($request->password);
        $society_admin->save();
        $role = Role::where('name', 'society_admin')->first();
        $society_admin->assignRole($role);
        if ($society_admin) {
            return redirect()->route('admin.society_admin.index')->with($this->message('Society Admin Create Successfully', 'success'));
        } else {
            return redirect()->back()->with($this->message('Society Admin Create Error', 'danger'));
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
        $society_admin = User::with('roles')
            ->whereHas('roles', function ($q) {
                $q->Where('name', 'society_admin');
            })
            ->findOrFail($id);
        return view('admin.society_admin.edit', compact('society_admin'));
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
            'society_allow' => 'required',
        ]);
        $society_admin = User::with('roles')
            ->whereHas('roles', function ($q) {
                $q->Where('name', 'society_admin');
            })->findOrFail($id);
        $society_admin->username = $request->username;
        $society_admin->email = $request->email;
        $society_admin->phone_number = $request->phone_number;
        $society_admin->society_allow = $request->society_allow;
        $society_admin->project_allow = $request->project_allow;
        $society_admin->save();
        if ($society_admin) {
            return redirect()->route('admin.society_admin.index')->with($this->message('Society Admin Update Successfully', 'success'));
        } else {
            return redirect()->back()->with($this->message('Society Admin Update Error', 'danger'));
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
                $q->Where('name', 'society_admin');
            })->findOrFail($id);
        $user->delete();

        if ($user) {
            return redirect()->route('admin.society_admin.index')->with($this->message('User Delete SuccessFully', 'success'));
        } else {
            return redirect()->back()->with($this->message("User Delete Error", 'error'));
        }
    }

    public function activate($id)
    {
        $user = User::with('roles')
            ->whereHas('roles', function ($q) {
                $q->Where('name', 'society_admin');
            })->findOrFail($id);
        if ($user->status == 0) {
            $user->status = 1;
            $user->save();
            return redirect()->route('admin.society_admin.index')->with($this->message("User Activate Successfully", 'success'));
        } else {
            return redirect()->back()->with($this->message("User Activate Error", 'error'));
        }
    }

    public function deactivate($id)
    {
        $user = User::
        with('roles')
            ->whereHas('roles', function ($q) {
                $q->Where('name', 'society_admin');
            })->findOrFail($id);
        if ($user->status == 1) {
            $user->status = 0;
            $user->save();
            return redirect()->route('admin.society_admin.index')->with($this->message("User DeActivate Successfully", 'success'));
        } else {
            return redirect()->back()->with($this->message("User DeActivate Error", 'error'));
        }
    }
}
