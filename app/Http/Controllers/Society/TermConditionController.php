<?php

namespace App\Http\Controllers\Society;

use App\Http\Controllers\Controller;
use App\Models\TermCondition;
use Illuminate\Http\Request;

class TermConditionController extends Controller
{
    private $activePage;
    public function __construct(){
        $this->activePage = "pages";
    }


    public function index()
    {
        $term = TermCondition::find(1);
        $activePage = $this->activePage;
        return view('society.term.index', compact('term', 'activePage'));
    }

    public function edit($id)
    {
        $term = TermCondition::find($id);
        $activePage = $this->activePage;
        return view('society.term.edit', compact('term', 'activePage'));
    }

    public function update(Request $request, $id){
        $term = TermCondition::where('id', $id)->update([
            'description' => $request->description
        ]);
        if($term){
            return redirect()->back()->with(['success' => 'Term Update Successfully']);
        } else{
            return redirect()->back()->with(['error' => 'Term Update Error']);
        }
    }

}
