<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {/*dd(auth()->user()->hasRole('sale_person'));*/
        if (Auth::check() == false) {
            return redirect()->back()->with($this->message('Login User Problem!', 'error'));
        } else {
            if (Auth::user()->hasRole('society_admin')) {
                return redirect()->route('society_admin.dashboard');
            } else if (Auth::user()->hasRole('agent')) {
                return redirect()->route('agent.dashboard');
            } else if (Auth::user()->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            } else if (Auth::user()->hasRole('society')) {
                return redirect()->route('society_manager.dashboard');
            } else if (Auth::user()->hasRole('property_admin')) {
                return redirect()->route('property_admin.dashboard');
            } else if (Auth::user()->hasRole('property_manager')) {
                return redirect()->route('property_manager.dashboard');
            } else if (Auth::user()->hasRole('sale_manager')) {
                return redirect()->route('sale_manager.dashboard');
            } else if (Auth::user()->hasRole('sale_person')) {
                return redirect()->route('sale_person.dashboard');
            } else if (Auth::user()->hasRole('accountant')) {
                return redirect()->route('accountant.dashboard');
            }
            else {
                Auth::guard()->logout();

                return redirect()->back()->with($this->message('Login User Panel Not Found!', 'error'));
            }
        }

    }

    public function checkUsername(Request $request)
    {
        $username = $request->get('username');
        $user = User::where('username', $username)->first();
        if ($user == null) {
            return response()->json(["username" => "", "message" => "Username Not Found", "code" => "200"]);
        } else {
            return response()->json(["username" => $username, "message" => "Username Already Exists", "code" => "500"]);
        }
    }

    public function logout()
    {
        //mark attendance checkout here
        return $this->logout();
    }


    public function resetPassword(Request $request)
    {
        //Validate input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed',
            'token' => 'required']);

        //check if payload is valid before moving on
        if ($validator->fails()) {
            return redirect()->back()->withErrors(['email' => 'Please complete the form']);
        }

        $password = $request->password;
        // Validate the token
        $tokenData = DB::table('password_resets')
            ->where('token', $request->token)->first();
        // Redirect the user back to the password reset request form if the token is invalid
        if (!$tokenData) return view('auth.passwords.email');

        $user = User::where('email', $tokenData->email)->first();
        // Redirect the user back if the email is invalid
        if (!$user) return redirect()->back()->withErrors(['email' => 'Email not found']);
        //Hash and update the new password
        $user->password = Hash::make($password);
        $user->update(); //or $user->save();

        //login the user immediately they change password successfully
        Auth::login($user);

        //Delete the token
        DB::table('password_resets')->where('email', $user->email)
            ->delete();

        //Send Email Reset Success Email
        if ($this->sendSuccessEmail($tokenData->email)) {
            return view('welcome');
        } else {
            return redirect()->back()->withErrors(['email' => trans('A Network Error occurred. Please try again.')]);
        }
    }

    public function sendSuccessEmail($email)
    {
        $user = DB::table('users')->where('email', $email)->select('username', 'email')->first();
        try {
            //Here send the link with CURL with an external email API.
            $data = array('name' => $user->username);
            Mail::to($email)->send(new \App\Mail\PasswordChanged($data));
            return true;
        } catch (\Exception $e) {
            return var_dump($e->getMessage());
            return false;
        }
    }
}
