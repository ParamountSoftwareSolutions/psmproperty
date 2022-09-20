<?php

namespace App\Http\Controllers\Property;

use App\Helpers\Helpers;
use App\Helpers\NotificationHelper;
use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\BuildingFile;
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
        return view('property.building.index', compact('buildings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $floor = Floor::get();
        return view('property.building.create', compact('floor'));
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
            'name' => 'required',
            'floor_list' => 'required',
            'type' => 'required',
            'logo_images' => 'required',
            'main_images' => 'required',
            'banner_images' => 'required',
        ]);
        $assign_data = Helpers::building_assign_user();
        $building = Helpers::building_detail()->count();
        if (Auth::user()->building == $building) {
            return redirect()->back()->with($this->message('Building Limit Complete. Please Contact Super Admin', 'warning'));
        } else {
            $building = new Building();
            $building->building_assign_id = $assign_data->id;
            $building->name = $request->name;
            $building->floor_list = json_encode($request->floor_list);
            $building->type = json_encode($request->type);
            $building->apartment_size = json_encode($request->apartment_size);
            $building->total_area = $request->total_area;
            $building->save();
            if ($request->has('logo_images')) {
                foreach ($request->file('logo_images') as $file) {
                    $filename = hexdec(uniqid()) . '.' . strtolower($file->getClientOriginalExtension());
                    $file->move('public/images/building/logo/', $filename);
                    $file = 'public/images/building/logo/' . $filename;
                    BuildingFile::create([
                        'building_id' => $building->id,
                        'image' => $file,
                        'type' => 'logo',
                    ]);
                }
            }
            if ($request->has('main_images')) {
                foreach ($request->file('main_images') as $file) {
                    $filename = hexdec(uniqid()) . '.' . strtolower($file->getClientOriginalExtension());
                    $file->move('public/images/building/', $filename);
                    $file = 'public/images/building/' . $filename;
                    BuildingFile::create([
                        'building_id' => $building->id,
                        'image' => $file,
                        'type' => 'main',
                    ]);
                }
            }
            if ($request->file('banner_images')) {
                foreach ($request->file('banner_images') as $file) {
                    $filename = hexdec(uniqid()) . '.' . strtolower($file->getClientOriginalExtension());
                    $file->move('public/images/building/banner/', $filename);
                    $file = 'public/images/building/banner/' . $filename;
                    BuildingFile::create([
                        'building_id' => $building->id,
                        'image' => $file,
                        'type' => 'normal',
                    ]);
                }
            }

            if ($building) {
                (new NotificationHelper)->send_notification_all_user('property_create');
                return redirect()->route('property_admin.building.index')->with($this->message('Building Create SuccessFully', 'success'));
            } else {
                return redirect()->back()->with($this->message("Building Create Error", 'error'));
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $floor = Floor::get();
        $building = Helpers::building_detail_single($id);
        return view('property.building.edit', compact('floor', 'building'));
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
            'name' => 'required',
            'floor_list' => 'required',
            'type' => 'required',
        ]);
        $assign_data = Helpers::building_assign_user();
        $building = Building::findOrFail($id);
        $building->building_assign_id = $assign_data->id;
        $building->name = $request->name;
        $building->floor_list = json_encode($request->floor_list);
        $building->type = json_encode($request->type);
        $building->apartment_size = json_encode($request->apartment_size);
        $building->total_area = $request->total_area;
        $building->save();
        if ($request->has('logo_images')) {
            foreach ($request->file('logo_images') as $file) {
                $filename = hexdec(uniqid()) . '.' . strtolower($file->getClientOriginalExtension());
                $file->move('public/images/building/logo/', $filename);
                $file = 'public/images/building/logo/' . $filename;
                BuildingFile::updateOrCreate(['building_id' => $building->id, 'type' => 'logo'], [
                    'image' => $file,
                ]);
            }
        }
        if ($request->has('main_images')) {
            foreach ($request->file('main_images') as $file) {
                $filename = hexdec(uniqid()) . '.' . strtolower($file->getClientOriginalExtension());
                $file->move('public/images/building/', $filename);
                $file = 'public/images/building/' . $filename;
                BuildingFile::updateOrCreate(['building_id' => $id, 'type' => 'main'], [
                    'image' => $file,
                ]);
            }
        }
        if ($request->file('banner_images')) {
            foreach ($request->file('banner_images') as $file) {
                $filename = hexdec(uniqid()) . '.' . strtolower($file->getClientOriginalExtension());
                $file->move('public/images/building/banner/', $filename);
                $file = 'public/images/building/banner/' . $filename;
                BuildingFile::create([
                    'building_id' => $building->id,
                    'image' => $file,
                    'type' => 'normal',
                ]);
            }
        }
        if ($building) {
            (new NotificationHelper)->send_notification_all_user('property_update');
            return redirect()->route('property_admin.building.index')->with($this->message('Building update SuccessFully', 'success'));
        } else {
            return redirect()->back()->with($this->message("Building update Error", 'error'));
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
        $building = Building::findOrFail($id);
        $building->delete();
        if ($building) {
            return redirect()->route('property_admin.building.index')->with($this->message('Building delete SuccessFully', 'success'));
        } else {
            return redirect()->back()->with($this->message("Building delete Error", 'error'));
        }
    }

    public function detail_form()
    {
        return view('property.building.building_extra_detail');
    }

    public function remove_image_banner(Request $request)
    {
        $building_file = BuildingFile::where(['id' => $request->id, 'building_id' => $request->building_id])->first();
        //$filename = explode('/', $request->name);dd($filename);
        // $img_arr = [];
        // foreach (json_decode($building_file->banner_images, true) as $img) {
        //     if (strcmp($img, $request->name) != 0) {
        //         array_push($img_arr, $img);
        //     }
        // }

        $building_file->delete();
        if ($building_file !== null) {
            unlink($building_file->image);
        }
        return json_encode('success');
    }
}
