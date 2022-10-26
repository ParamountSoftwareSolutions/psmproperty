<?php

namespace App\Http\Controllers\PropertyManager;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('property_manager.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        /*if($request->file('profile_pic_url')) {
            $imageName = $request->file('profile_pic_url')->extension();
            $request->profile_pic_url->move(public_path('images/profile/'), $imageName);
        }*/
        if ($request->has('profile_pic_url')) {
            $file = $request->file('profile_pic_url');
            $filename = hexdec(uniqid()) . '.' . strtolower($file->getClientOriginalExtension());
            $file->move('public/images/profile/', $filename);
            $file = 'public/images/profile/' . $filename;
            $user->profile_pic_url = $file;
        }
        $user->save();
        if ($user) {
            return redirect()->route('property_manager.profile.index')->with($this->message('Profile Update Successfully', 'success'));
        } else {
            return redirect()->back()->with($this->message("Profile Update Error", 'error'));
        }
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password_confirmation' => 'required',
            'password' => 'required|string|confirmed',
        ]);
        $user = User::findOrFail(Auth::id());
        if (Hash::check($request->old_password, $user->password)) {
            $user->fill([
                'password' => Hash::make($request->password)
            ])->save();

            return redirect()->back()->with($this->message("Update Password Successfully", 'success'));
        } else {
            return redirect()->back()->with($this->message("Update Password Error", 'error'));
        }
    }
}
