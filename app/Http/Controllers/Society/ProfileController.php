<?php

namespace App\Http\Controllers\Society;

use App\Http\Controllers\Controller;
use App\Models\Society;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private $activePage;

    public function __construct()
    {
        $this->activePage = "dashboard";
    }
    public function index(){
        return view('society.profile.index', array('activePage' => $this->activePage));
    }
    public function edit(){
        return view('society.profile.edit_profile', array('activePage' => $this->activePage));
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
        $societies = Society::where('user_id', $user->id)->first();
        if($societies != null){
            $societies->owner_name = $request->get('owner_name');
            $societies->society_name = $request->get('society_name');
            $societies->address = $request->get('address');
            $societies->society_type_id = $request->get('society_type_id');
            $societies->noc_type_id = $request->get('noc_type_id');
            $societies->area = $request->get('area');
            $societies->details = $request->get('details');
            $societies->status_id = $request->get('status_id');
            $societies->save();
        }

        return back();//->with(['success' => 'Profile Updated Successfully']);
    }
}
