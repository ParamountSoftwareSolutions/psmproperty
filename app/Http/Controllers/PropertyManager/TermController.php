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
        $terms = BuildingTermCondition::get();
        $building = Helpers::building_detail();
        return view('property_manager.term.index', compact('terms', 'building'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $building = Helpers::building_detail();
        return view('property_manager.term.create', compact('building'));
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
            'building_id' => 'required',
            'description' => 'required',
        ]);
        $assign_data = Helpers::building_assign_user();
        $term = new BuildingTermCondition();
        $term->property_admin_id = $assign_data->property_admin_id;
        $term->building_id = json_encode($request->building_id);
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
        $building = Helpers::building_detail();
        return view('property_manager.term.edit', compact('building', 'term'));
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
            'building_id' => 'required',
            'description' => 'required',
        ]);
        $assign_data = Helpers::building_assign_user();
        $faq = BuildingTermCondition::findOrFail($id);
        $faq->property_admin_id = $assign_data->property_admin_id;
        $faq->building_id = json_encode($request->building_id);
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
        $term = BuildingTermCondition::findOrFail($id);
        $term->delete();
        if($term){
            return redirect()->route('property_manager.term.index')->with(['success' => 'Faq Delete Successfully']);
        } else{
            return redirect()->back()->with(['error' => 'Faq Delete Error']);
        }
    }
}
