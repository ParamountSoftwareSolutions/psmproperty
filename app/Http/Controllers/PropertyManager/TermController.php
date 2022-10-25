<?php

namespace App\Http\Controllers\PropertyManager;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\BuildingTermCondition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TermController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $terms = BuildingTermCondition::where('property_admin_id', Helpers::user_admin())->get();
        return view('property_manager.term.index', compact('terms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('property_manager.term.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
        ]);
        $term = BuildingTermCondition::where('property_admin_id', Helpers::user_admin())->first();
        if($term == null){
            $term = new BuildingTermCondition();
        }
        $term->property_admin_id = Helpers::user_admin();
        $term->description = $request->description;
        $term->save();
        if($term){
            return redirect()->route('property_manager.term.index')->with(['success' => 'Term Create Successfully']);
        } else{
            return redirect()->back()->with(['error' => 'Faq Create Error']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $term = BuildingTermCondition::findOrFail($id);
        return view('property_manager.term.edit', compact('term'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required',
        ]);
        $faq = BuildingTermCondition::where('property_admin_id', Helpers::user_admin())->findOrFail($id);
        $faq->description = $request->description;
        $faq->save();
        if($faq){
            return redirect()->route('property_manager.term.index')->with(['success' => 'Term Update Successfully']);
        } else{
            return redirect()->back()->with(['error' => 'Term Update Error']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $term = BuildingTermCondition::where('property_admin_id', Helpers::user_admin())->findOrFail($id);
        $term->delete();
        if($term){
            return redirect()->route('property_manager.term.index')->with(['success' => 'Faq Delete Successfully']);
        } else{
            return redirect()->back()->with(['error' => 'Faq Delete Error']);
        }
    }
}
