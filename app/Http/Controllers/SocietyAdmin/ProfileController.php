<?php

namespace App\Http\Controllers\SocietyAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    private $activePage;

    public function __construct()
    {
        $this->activePage = "dashboard";
    }
    public function index(){
        return view('society_admin.profile.index', array('activePage' => $this->activePage));
    }
    public function edit(){
        return view('society_admin.profile.edit_profile', array('activePage' => $this->activePage));
    }

    public function update(Request $request){

        $user = User::find(auth()->user()->id);
        if($user != null){

            $user->username = $request->get('name');
            $user->phone_number = $request->get('phone_number');
            if( $request->hasFile( 'profile_image' ) ) {

                $file = $request->profile_image;
                $pic = $file->store('/', ['disk' => 'profile_pic']);
                $user->profile_pic_url = $pic;
                $user->save();
            }
        }
        return back();//->with(['success' => 'Profile Updated Successfully']);
    }
}
