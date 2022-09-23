<?php

namespace App\Http\Controllers\PropertyManager;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\BuildingFaq;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $faqs = BuildingFaq::get();
        $building = Helpers::building_detail();
        return view('property_manager.faq.index', compact('faqs', 'building'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $building = Helpers::building_detail();
        return view('property_manager.faq.create', compact('building'));
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
        $faq = new BuildingFaq();
        $faq->property_admin_id = Helpers::building_assign_user()->property_admin_id;
        $faq->building_id = json_encode($request->building_id);
        $faq->description = $request->description;
        $faq->save();
        if($faq){
            return redirect()->route('property_manager.faq.index')->with(['success' => 'Faq Create Successfully']);
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
        $faq = BuildingFaq::findOrFail($id);
        $building = Helpers::building_detail();
        return view('property_manager.faq.edit', compact('building', 'faq'));
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
        $faq = BuildingFaq::findOrFail($id);
        $faq->property_admin_id = Helpers::building_assign_user()->property_admin_id;
        $faq->building_id = json_encode($request->building_id);
        $faq->description = $request->description;
        $faq->save();
        if($faq){
            return redirect()->route('property_manager.faq.index')->with(['success' => 'Faq Update Successfully']);
        } else{
            return redirect()->back()->with(['error' => 'Faq Update Error']);
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
        $faq = BuildingFaq::findOrFail($id);
        $faq->delete();
        if($faq){
            return redirect()->route('property_manager.faq.index')->with(['success' => 'Faq Delete Successfully']);
        } else{
            return redirect()->back()->with(['error' => 'Faq Delete Error']);
        }
    }
}
