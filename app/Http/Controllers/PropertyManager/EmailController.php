<?php

namespace App\Http\Controllers\PropertyManager;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\BuildingSale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class EmailController extends Controller
{
    public function email_compose()
    {
        return view('property_manager.email.compose');
    }

    public function email_compose_send(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'subject' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with($this->message($validator->errors()->first(), 'danger'));
        }
        $data = [];
        $data['subject'] = $request->subject;
        $data['body'] = $request->body;
        if($request->email != 'both' && $request->email != 'clients' && $request->email != 'leads'){
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->with($this->message($validator->errors()->first(), 'danger'));
            }
            $data['emails'] = [$request->email];
        }
        else{
            $building = Helpers::building_detail();
            $sales = BuildingSale::whereIn('building_id', $building->pluck('id')->toArray());
            if($request->email == 'leads'){
                if (Auth::user()->roles[0]->name == 'sale_person') {
                    $sales->where('user_id', Auth::id());
                }
                $sales->where('order_type','lead');
            }
            elseif($request->email == 'clients'){
                $sales->where('order_type','sale');
            }
            elseif($request->email == 'both'){
                $sales->whereIn('order_type',['lead','sale']);
            }
            $sales = $sales->get();
            $email_list = [];
            foreach($sales as $sale){
                $value = $sale->customer->email;
                if($value == null){
                    continue;
                }
                $email_list[] = $value;
            }
            $data['emails'] = $email_list;
        }
        if(isset($request->images)){
            $images = $request->images;
            foreach($images as $img){
                $ext = $img->getClientOriginalExtension();
                $name = time().'-'.rand().'.'.$ext;
                $path = 'mail-media/images';
                $img->move(public_path($path),$name);
                $data['image'][] = 'public/'.$path."/".$name;
            }
        }
        if(isset($request->videos)){
            $videos = $request->videos;
            foreach($videos as $vid){
                $ext = $vid->getClientOriginalExtension();
                $name = time().'-'.rand().'.'.$ext;
                $path = 'mail-media/videos';
                $vid->move(public_path($path),$name);
                $data['video'][] = 'public/'.$path."/".$name;
            }
        }
        try {
            foreach($data['emails'] as $email){
                $data['email'] = $email;
                Mail::send('mail.email_template', $data, function($message) use ($data) {
                    $message->to($data['email'])->subject($data['subject']);
                });
            }
            return redirect()->route('property_manager.email.compose')->with($this->message('Email Sent Successfully', 'success'));
        }
        catch(Exception $e) {
            return redirect()->route('property_manager.email.compose')->with($this->message('Something went Wrong....', 'danger'));
        }
    }
}
