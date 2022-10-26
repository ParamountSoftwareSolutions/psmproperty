<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\User;
use Database\Seeders\user_seeder;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //

    private $activePage;

    public function __construct()
    {
        $this->activePage = "dashboard";
    }

    public function index()
    {

        return view('agents.profile.index', array('activePage' => $this->activePage));
    }
    public function edit(){
        return view('agents.profile.edit_profile', array('activePage' => $this->activePage));
    }
    public function update(Request $request){
//        var_dump($request->all());

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
        $agent = Agent::where('user_id', $user->id)->first();
        if($agent != null){
            $agent->business_name = $request->get('first_name');
            $agent->registration_number = $request->get('registration');
            $agent->business_address = $request->get('business_address');
            $agent->contact_number = $request->get('contact_number');
            $agent->whatsapp_number = $request->get('whatapps_number');
            $agent->save();
        }

        return back();//->with(['success' => 'Profile Updated Successfully']);
    }

}
