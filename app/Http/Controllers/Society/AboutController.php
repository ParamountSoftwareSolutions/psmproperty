<?php

namespace App\Http\Controllers\Society;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    private $activePage;
    public function __construct(){
        $this->activePage = "pages";
    }

    public function index()
    {
        $about = About::find(1);
        $activePage = $this->activePage;
        return view('society.about.index', compact('about', 'activePage'));
    }

    public function edit($id)
    {
        $about = About::find($id);
        $activePage = $this->activePage;
        return view('society.about.edit', compact('about', 'activePage'));
    }

    public function update(Request $request, $id){

        $about = About::where('id', $id)->update([
            'description' => $request->description
        ]);
        if($about){
            return redirect()->back()->with(['success' => 'About Page Update Successfully']);
        } else{
            return redirect()->back()->with(['error' => 'About Page Update Error']);
        }
    }
}
