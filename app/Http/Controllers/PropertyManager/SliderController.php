<?php

namespace App\Http\Controllers\PropertyManager;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\BuildingSlider;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SliderController extends Controller
{
    public function index()
    {
        $banners = BuildingSlider::where('property_admin_id', Helpers::user_admin())->get();
        return view('property_manager.banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('property_manager.banner.create');
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
            'images' => 'required',
        ]);
        $banner = new BuildingSlider();
        $banner->property_admin_id = Helpers::user_admin();
        if ($request->has('images')) {
            foreach($request->images as $image) {
                $filename = hexdec(uniqid()) . '.' . strtolower($image->getClientOriginalExtension());
                $image->move('public/images/property/banner/', $filename);
                $file = 'public/images/property/banner/' . $filename;
                $banner->image = $file;
            }
        }
        $banner->save();
        if ($banner) {
            return redirect()->route('property_manager.banner.index')->with($this->message('Banner Create Successfully', 'success'));
        } else {
            return redirect()->back()->with($this->message('Banner Create Error', 'danger'));
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
        $banner = BuildingSlider::where('property_admin_id', Helpers::user_admin())->findOrFail($id);
        return view('property_manager.banner.edit', compact('banner'));
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
        $request->validate([
            'images' => 'required',
        ]);
        $admin = Helpers::user_admin();
        $banner = BuildingSlider::where('property_admin_id', $admin)->findOrFail($id);
        $banner->property_admin_id = $admin;
        if ($request->has('images')) {
            foreach($request->images as $image) {
                $filename = hexdec(uniqid()) . '.' . strtolower($image->getClientOriginalExtension());
                $image->move('public/images/property/banner/', $filename);
                $file = 'public/images/property/banner/' . $filename;
                $banner->image = $file;
            }
        }
        $banner->save();
        if ($banner) {
            return redirect()->route('property_manager.banner.index')->with($this->message('Banner Update Successfully', 'success'));
        } else {
            return redirect()->back()->with($this->message('Banner Update Error', 'danger'));
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
        $banner = BuildingSlider::where('property_admin_id', Helpers::user_admin())->findOrFail($id);
        $banner->delete();
        if ($banner) {
            return redirect()->route('property_manager.banner.index')->with($this->message('Banner Delete Successfully', 'success'));
        } else {
            return redirect()->back()->with($this->message('Banner Delete Error', 'danger'));
        }
    }
}
