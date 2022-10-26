<?php

namespace App\Http\Controllers\Society;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    private $activePage;
    public function __construct(){
        $this->activePage = "pages";
    }

    public function index()
    {
        $privacyPolicy = PrivacyPolicy::find(1);
        $activePage = $this->activePage;
        return view('society.privacyPolicy.index', compact('privacyPolicy', 'activePage'));
    }

    public function edit($id)
    {
        $privacyPolicy = PrivacyPolicy::find($id);
        $activePage = $this->activePage;
        return view('society.privacyPolicy.edit', compact('privacyPolicy', 'activePage'));
    }

    public function update(Request $request, $id){

        $privacyPolicy = PrivacyPolicy::where('id', $id)->update([
            'description' => $request->description
        ]);
        if($privacyPolicy){
            return redirect()->back()->with(['success' => 'Privacy Policy Update Successfully']);
        } else{
            return redirect()->back()->with(['error' => 'Privacy Policy Update Error']);
        }

    }
}
