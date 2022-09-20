<?php

namespace App\Http\Controllers\PropertyManager;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\BuildingPrivacyPolicie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\TextUI\Help;

class PrivacyPolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $privacyPolicy = BuildingPrivacyPolicie::get();
        $building = Helpers::building_detail();
        return view('property_manager.privacyPolicy.index', compact('privacyPolicy', 'building'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $building = Helpers::building_detail();
        return view('property_manager.privacyPolicy.create', compact('building'));
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
        $privacyPolicy = new BuildingPrivacyPolicie();
        $privacyPolicy->property_admin_id = $assign_data->property_admin_id;
        $privacyPolicy->building_id = json_encode($request->building_id);
        $privacyPolicy->description = $request->description;
        $privacyPolicy->save();
        if($privacyPolicy){
            return redirect()->route('property_manager.privacyPolicy.index')->with(['alert' => 'success', 'message' => 'Privacy Policy Page Update Successfully']);
        } else{
            return redirect()->back()->with(['alert' => 'error', 'message' => 'Privacy Policy Page Update Error']);
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
        $privacyPolicy = BuildingPrivacyPolicie::findOrFail($id);
        $building = Helpers::building_detail();
        return view('property_manager.privacyPolicy.edit', compact('privacyPolicy', 'building'));
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
        $privacyPolicy = BuildingPrivacyPolicie::findOrFail($id);
        $privacyPolicy->property_admin_id = Helpers::building_assign_user()->property_admin_id;
        $privacyPolicy->building_id = json_encode($request->building_id);
        $privacyPolicy->description = $request->description;
        $privacyPolicy->save();
        if($privacyPolicy){
            return redirect()->route('property_manager.privacyPolicy.index')->with(['success' => 'Privacy Policy Page Update Successfully']);
        } else{
            return redirect()->back()->with(['error' => 'Privacy Policy Page Update Error']);
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
        $privacyPolicy = BuildingPrivacyPolicie::findOrFail($id);
        $privacyPolicy->delete();
        if($privacyPolicy){
            return redirect()->route('property_manager.privacyPolicy.index')->with(['success' => 'Privacy Policy Delete Successfully']);
        } else{
            return redirect()->back()->with(['error' => 'Privacy Policy Delete Error']);
        }
    }
}
