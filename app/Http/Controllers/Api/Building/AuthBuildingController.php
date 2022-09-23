<?php

namespace App\Http\Controllers\Api\Building;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\BuildingCustomer;
use App\Models\BuildingMobileApplication;
use App\Models\MobileApplication;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class AuthBuildingController extends Controller
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
        $app = BuildingMobileApplication::where('app_key', $request->app_key)->first();
        $remember = $request->has('remember_me') ? true : false;
        if($app != null) {
            if (is_numeric($request->get('email'))) {
                if (!auth()->attempt(['phone_number' => $request->get('email'), 'password' => $request->get('password')], $remember)) {
                    return $this->sendError("Invalid Phone Number or Password");
                }
            } elseif (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
                if (!auth()->attempt(['email' => $request->get('email'), 'password' => $request->get('password')], $remember)) {
                    return $this->sendError("Invalid Email or Password");
                }
            }
            $user = User::where('id', Auth::id())->first();
            $user->device_token = $request->device_token;
            $user->Save();
            $role= Role::where(['name' => 'user', 'guard_name' => 'api'])->first();
            if ($user !== null && $user->hasRole($role)) {
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
        $user_id = Auth::guard('api')->id();dd($user_id);
        $user = user::findOrFail($user_id);
        $user->username = $request->username;
        $user->phone_number = $request->phone_number;
        if ($request->file('image')){
            //$name = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->store('public/images/profile');
            $user->profile_pic_url = $path;
        }
        $user->save();
        if($user){
            return $this->sendSuccess('Profile Update Successfully', $user);
        }else{
            return $this->sendError('Profile Update Error');
        }
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }
        $user = Auth::user();
        if (Hash::check($request->current_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);
            //return new UserResource($user);
            return $this->sendSuccess('Password Update Successfully', $user);
        } else {
            return $this->sendError("Password Doesn't Match");
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





    /*public function quickRandom($length = 16){
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
        $app = BuildingMobileApplication::where('app_key', $request->app_key)->first();
        $remember = $request->has('remember_me') ? true : false;
        if($app != null) {
            if (is_numeric($request->get('email'))) {
                if (Auth::attempt(['phone_number' => $request->get('email'), 'password' => $request->get('password')], $remember)) {
                    $user = User::where('id', Auth::id())->first();
                } else {
                    return $this->sendError("Invalid Phone Number or Password");
                }
            } elseif (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
                if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')], $remember)) {
                    $user = User::where('id', Auth::id())->first();
                } else {
                    return $this->sendError("Invalid Email or Password");
                }
            }

            $building_customer = BuildingCustomer::where(['building_app_id' => $app->id,'customer_id' => Auth::id()])->first();
            if ($user !== null && $user->hasRole('user') && $building_customer !== null) {
                $accessToken = Auth::user()->createToken('authToken')->accessToken;
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

        if (is_numeric($request->get('email'))) {
            $email = $request->email;
            $user = User::where('phone_number', $email)->first();
            if($user != null){
                DB::table('password_resets')->insert([
                    'phone_number' => $email,
                    'token' => $this->quickRandom(),
                    'created_at' => Carbon::now()
                ]);
                $tokenData = DB::table('password_resets')
                    ->where('email', $email)->first();

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
        } elseif (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
            $email = $request->email;
            $user = User::where('email', $email)->first();
            if($user != null){
                DB::table('password_resets')->insert([
                    'email' => $email,
                    'token' => $this->quickRandom(),
                    'created_at' => Carbon::now()
                ]);
                $tokenData = DB::table('password_resets')->where('email', $email)->first();
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

    }


    private function sendResetEmail($email, $token)
    {
        $user = User::where('email', $email)->select('username', 'email')->first();
        $link = config('base_url') . 'password/reset/' . $token . '?email=' . urlencode($user->email);
        try {
            $data = array("reset_link" => $link, 'name'=> $user->username);
            Mail::to($email)->send(new \App\mail\Mail($data));
            return true;
        } catch (\Exception $e) {
            return var_dump($e->getMessage());
        }
    }

    public function profile(){
        $user = Auth::user();
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
        $user_id = Auth::user()->id;
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
        $accessToken = Auth::user()->token();
        $token = $request->user()->tokens->find($accessToken);
        $token->revoke();
        return $this->sendSuccess("Logout Successfully");
    }*/
}
