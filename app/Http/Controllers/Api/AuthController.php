<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MobileApplication;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Console\Input\Input;

class AuthController extends Controller
{


    public function quickRandom($length = 16){
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }
        $app = MobileApplication::where('app_key', $request->app_key)->first();
        $remember = $request->has('remember_me') ? true : false;
        if($app != null) {
            if (is_numeric($request->get('email'))) {
                if (!auth()->attempt(['phone' => $request->get('email'), 'password' => $request->get('password')], $remember)) {
                    return $this->sendError("Invalid Phone Number or Password");
                }
            } elseif (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
                if (!auth()->attempt(['email' => $request->get('email'), 'password' => $request->get('password')], $remember)) {
                    return $this->sendError("Invalid Email or Password");
                }
            }
            $user = User::where('id', auth()->id())->first();
            if ($user !== null && $user->hasRole('user')) {
                $accessToken = auth()->user()->createToken('authToken')->accessToken;
                $user['accessToken'] = $accessToken;
                return $this->sendSuccess('Success', $user);
            } else {
                return $this->sendError('You do not have the required authorization!');
            }
        } else {
            return $this->sendError('App key not found!');
        }
    }

    public function register(Request $request){
        //register onl clients from api..

        $request->validate([
            'username'=>'required|string|unique:users',
            'phone_number' => 'required|string|unique:users',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string',
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->password = Hash::make($request->password);
        $user->save();
        $user->assignRole('client');

        return $this->login($request);

    }

    public function forgetPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }
        $user = User::where('email', $request->email)->first();
        if($user != null){
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $this->quickRandom(),
                'created_at' => Carbon::now()
            ]);
            $tokenData = DB::table('password_resets')
                ->where('email', $request->email)->first();

            if ($this->sendResetEmail($request->email, $tokenData->token)) {
                return $this->sendSuccess("Password Link Sent Successfully");
            }
            else{
                return $this->sendError("Error in Sending Email");
            }

        }else{
            return response()->json([
                'code'=>201,
                'status'=> 'No User Found',
                'data' => []
            ]);
        }
    }


    private function sendResetEmail($email, $token)
    {
        $user = DB::table('users')->where('email', $email)->select('username', 'email')->first();
        $link = config('base_url') . 'password/reset/' . $token . '?email=' . urlencode($user->email);
        try {
            //Here send the link with CURL with an external email API.
            $data = array("reset_link" => $link, 'name'=> $user->username);
            Mail::to($email)->send(new \App\mail\Mail($data));
            return true;
        } catch (\Exception $e) {
            return var_dump($e->getMessage());
        }
    }

    public function profile(){
        $user = Auth::guard('api')->user();
        if($user != null){
            return $this->sendSuccess('Data Found Successfully', $user);
        }else{
            return $this->sendError('Data not found');
        }
    }

    public function updateProfile(Request $request){
        $validator = Validator::make($request->all(), [
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',

        ]);
        if ($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }
        $user_id = Auth::guard('api')->id();
        $user = user::findOrFail($user_id);
        $user->username = $request->username;
        $user->phone_number = $request->phone_number;
        if ($request->file('image')){
            //$name = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->store('public/images/profile');
            $user->profile_pic_url = $path;
        }
        $user->save();
        if($user    ){
            return $this->sendSuccess('Profile Update Successfully', $user);
        }else{
            return $this->sendError('Profile Update Error');
        }
    }


    public function logout(Request $request)
    {
        $user = Auth::user()->token();
        $user->revoke();
        $accessToken = auth()->user()->token();
        $token = $request->user()->tokens->find($accessToken);
        $token->revoke();
        return $this->sendSuccess("Logout Successfully");
    }

}
