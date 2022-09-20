<?php

namespace App\Http\Controllers\SaleManager;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('sale_manager.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        if($request->file('profile_pic_url')) {
            $imageName = $request->file('profile_pic_url')->extension();
            $request->profile_pic_url->move(public_path('images/profile/'), $imageName);
            $user->profile_pic_url = 'images/profile/' . $imageName;
        }

        $user->save();
        if ($user) {
            return redirect()->route('sale_manager.profile.index')->with($this->message('Profile Update SuccessFully', 'success'));
        } else {
            return redirect()->back()->with($this->message("Profile Update Error", 'error'));
        }
    }
}
