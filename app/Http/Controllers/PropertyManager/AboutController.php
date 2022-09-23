<?php

namespace App\Http\Controllers\PropertyManager;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\BuildingAbout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $about = BuildingAbout::where('property_admin_id', Helpers::user_admin())->get();
        return view('property_manager.about.index', compact('about'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('property_manager.about.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
        ]);
        $about = BuildingAbout::where('property_admin_id', Helpers::user_admin())->first();
        if ($about == null) {
            $about = new BuildingAbout();
        }
        $about->property_admin_id = Helpers::user_admin();
        $about->description = $request->description;
        $about->save();
        if ($about) {
            return redirect()->route('property_manager.about.index')->with(['alert' => 'success', 'message' => 'About Page Update Successfully']);
        } else {
            return redirect()->back()->with(['alert' => 'error', 'message' => 'About Page Update Error']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $about = BuildingAbout::where('property_admin_id', Helpers::user_admin())->findOrFail($id);
        return view('property_manager.about.edit', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $about = BuildingAbout::where('property_admin_id', Helpers::user_admin())->findOrFail($id);
        $about->description = $request->description;
        $about->save();
        if ($about) {
            return redirect()->route('property_manager.about.index')->with(['success' => 'About Page Update Successfully']);
        } else {
            return redirect()->back()->with(['error' => 'About Page Update Error']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $about = BuildingAbout::where('property_admin_id', Helpers::user_admin())->findOrFail($id);
        $about->delete();
        if ($about) {
            return redirect()->route('property_manager.about.index')->with(['success' => 'About Delete Successfully']);
        } else {
            return redirect()->back()->with(['error' => 'About Delete Error']);
        }
    }
}
