<?php

namespace App\Http\Controllers\PropertyManager;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\BuildingCustomer;
use App\Models\Floor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $buildings = Helpers::building_detail();
        return view('property_manager.building.index', compact('buildings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $floor = Floor::get();
        return view('property_manager.building.create', compact('floor'));
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
            'name' => 'required',
            'floor_list' => 'required',
            'type' => 'required',
        ]);
        $images = [];
        $property_admin_id = BuildingCustomer::where('manager_id', Auth::id())->first();
        $building = Building::where('user_id', Auth::id())->count();
        if (Auth::user()->building == $building){
            return redirect()->back()->with($this->message('Building Limit Complete. Please Contact Super Admin', 'warning'));
        } else {
            $building = new Building();
            $building->user_id = Auth::id();
            $building->name = $request->name;
            $building->floor_list = json_encode($request->floor_list);
            $building->type = json_encode($request->type);
            if ($request->file('logo')){
                $file = $request->file('logo');
                $filename = hexdec(uniqid()) . '.' . strtolower($file->getClientOriginalExtension());
                $file->move('images/building/logo/', $filename);
                $building->logo = asset('images/building/logo/' . $filename);
            }
            if ($request->file('logo')){
                $file = $request->file('logo');
                $filename = hexdec(uniqid()) . '.' . strtolower($file->getClientOriginalExtension());
                $file->move('images/building/logo/', $filename);
                $building->logo = asset('images/building/logo/' . $filename);
            }
            if ($request->file('images')) {
                foreach ($request->file('images') as $file) {
                    $filename = hexdec(uniqid()) . '.' . strtolower($file->getClientOriginalExtension());
                    $file->move('images/building/', $filename);
                    $file = asset('images/building/' . $filename);
                    $images[] = $file;
                }
                $building->images = json_encode($images);
                if ($request->has('old_image')) {
                    $old_image = $request->image;
                    unlink($old_image);
                }
            }
            $building->save();

            if ($building) {
                return redirect()->route('property_manager.building.index')->with($this->message('Building Create SuccessFully', 'success'));
            } else {
                return redirect()->back()->with($this->message("Building Create Error", 'error'));
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $floor = Floor::get();
        $building = Building::findOrFail($id);
        return view('property_manager.building.edit', compact('floor', 'building'));
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
            'name' => 'required',
            'floor_list' => 'required',
            'type' => 'required',
        ]);
        $building = Building::findOrFail($id);
        $building->user_id = Auth::id();
        $building->name = $request->name;
        $building->floor_list = json_encode($request->floor_list);
        $building->type = json_encode($request->type);
        if ($request->file('logo')){
            $file = $request->file('logo');
            $filename = hexdec(uniqid()) . '.' . strtolower($file->getClientOriginalExtension());
            $file->move('public/images/building/logo/', $filename);
            $file = 'public/images/building/logo/' . $filename;
            $building->logo = $file;
        }
        if ($request->file('images')) {
            foreach ($request->file('images') as $file) {
                $filename = hexdec(uniqid()) . '.' . strtolower($file->getClientOriginalExtension());
                $file->move('public/images/building/', $filename);
                $file = 'public/images/building/' . $filename;
                $images[] = $file;
            }
            $building->images = json_encode($images);
            if ($request->has('old_image')) {
                $old_image = $request->image;
                unlink($old_image);
            }
        }
        $building->save();
        if ($building) {
            return redirect()->route('property_manager.building.index')->with($this->message('Building update SuccessFully', 'success'));
        } else {
            return redirect()->back()->with($this->message("Building update Error", 'error'));
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
        $building = Building::findOrFail($id);
        $building->delete();
        if ($building) {
            return redirect()->route('property_manager.building.index')->with($this->message('Building delete SuccessFully', 'success'));
        } else {
            return redirect()->back()->with($this->message("Building delete Error", 'error'));
        }
    }

    public function detail_form()
    {
        return view('property_manager.building.building_extra_detail');
    }
}
