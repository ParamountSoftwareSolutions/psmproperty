<?php

namespace App\Http\Controllers\Property;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('property.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        if ($request->has('profile_pic_url')) {
            $file = $request->file('profile_pic_url');
            $filename = hexdec(uniqid()) . '.' . strtolower($file->getClientOriginalExtension());
            $file->move('public/images/profile/', $filename);
            $file = 'public/images/profile/' . $filename;
            $user->profile_pic_url = $file;
        }

        $user->save();
        if ($user) {
            return redirect()->route('property_admin.profile.index')->with($this->message('Profile Update SuccessFully', 'success'));
        } else {
            return redirect()->back()->with($this->message("Profile Update Error", 'error'));
        }
    }
}
