<?php

namespace App\Http\Controllers\PropertyManager;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\BuildingDetail;
use App\Models\BuildingDetailFile;
use App\Models\Floor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuildingDetailController extends Controller
{
    public function index()
    {
        $buildings = Helpers::building_detail();
        return view('property_manager.building_detail.index', compact('buildings'));
    }

    public function create($panel,$id)
    {
        $building = Helpers::building_detail_single($id);
        $floor = Floor::whereIn('id', json_decode($building->floor_list))->get();
        return view('property_manager.building_detail.create', compact('id', 'floor'));
    }

    public function store(Request $request, $panel,$id)
    {
        $building = Helpers::building_detail_single($id);
        $building_detail_check = BuildingDetail::where('building_id', $building->id)->first();
        if ($building_detail_check == null){
            $building_detail = new BuildingDetail();
        } else {
            return redirect()->back()->with($this->message("Building Extra Detail already create", 'error'));
        }
        $data = json_encode([
            'shop_detail' => ['floor' => $request->floor, 'area' => $request->area, 'price' => $request->price],
            'single_bed_flat' => ['building' => $request->building_1bed, 'area' => $request->area_1bed, 'bed' => $request->bed_1bed, 'bath' => $request->bath_1bed, 'price' => $request->price_1bed],
            'double_bed_flat' => ['building' => $request->building_2bed, 'area' => $request->area_2bed, 'bed' => $request->bed_2bed, 'bath' => $request->bath_2bed, 'price' => $request->price_2bed],
            'studio_bed_flat' => ['building' => $request->building_studio, 'area' => $request->area_studio, 'bed' => $request->studio, 'bath' => $request->bath_studio, 'price' => $request->price_studio],
        ]);
        $building_detail->building_id = $building->id;
        $building_detail->address = $request->address;
        $building_detail->developer = $request->developer;
        $building_detail->price = $request->price;
        $building_detail->description = $request->description;
        $building_detail->plot_feature = json_encode(['sewerage' => $request->sewerage, 'electricity' => $request->electricity, 'water_supply' => $request->water]);
        $building_detail->business_feature = json_encode(['broadband' => $request->broadband, 'atm' => $request->atm]);
        $building_detail->community_feature = json_encode(['gym' => $request->gym]);
        $building_detail->healthcare_feature = json_encode(['swimming_pool' => $request->swimming_pool, 'suna' => $request->suna, 'jacuzzi' => $request->jacuzzi]);
        $building_detail->other_facilities = json_encode(['school' => $request->school, 'hospital' => $request->hospital, 'shopping_mall' => $request->shopping_mall, 'restaurant' => $request->restaurant, 'transport' => $request->transport, 'services' => $request->services, 'maintenance' => $request->maintenance, 'security' => $request->security]);
        $building_detail->property_type = $data;
        $building_detail->save();

        /*$floor = Floor::whereIn('id', json_decode($building->floor_list))->get();
        foreach ($floor as $data){
            BuildingDetailFile::updateOrCreate(['building_detail_id' => $building_detail->id], ['floor_image_id' => $data->id]);
        }*/

        if ($request->has('images')) {
            foreach ($request->file('images') as $file) {
                $filename = hexdec(uniqid()) . '.' . strtolower($file->getClientOriginalExtension());
                $file->move('public/images/building/payment/', $filename);
                $file = 'public/images/building/payment/' . $filename;
                BuildingDetailFile::updateOrCreate([
                    'building_detail_id' => $building_detail->id],
                    ['image' => $file,
                        'type' => 'payment_plan'
                    ]);
            }
            /*if ($request->has('old_image')) {
                $old_image = $request->image;
                unlink($old_image);
            }*/
        }
        if ($request->has('floor_images')) {
            foreach ($request->file('floor_images') as $file) {
                $filename = hexdec(uniqid()) . '.' . strtolower($file->getClientOriginalExtension());
                $file->move('public/images/building/floor/', $filename);
                $file = 'public/images/building/floor/' . $filename;
                BuildingDetailFile::updateOrCreate([
                    'building_detail_id' => $building_detail->id],
                    [
                        'image' => $file,
                        'type' => 'floor_plan'
                    ]);
            }
            /*if ($request->has('old_image')) {
                $old_image = $request->image;
                unlink($old_image);
            }*/
        }
        if ($building_detail) {
            return redirect()->route('property_manager.building_details.index')->with($this->message('Building Extra Detail update SuccessFully', 'success'));
        } else {
            return redirect()->back()->with($this->message("Building Extra Detail update Error", 'error'));
        }
    }

    public function edit($panel,$id)
    {
        $building = Helpers::building_detail_single($id);
        $building_detail = BuildingDetail::where('building_id', $id)->first();
        $floor = Floor::whereIn('id', json_decode($building->floor_list))->get();
        return view('property_manager.building_detail.edit', compact('building', 'building_detail', 'floor'));
    }

    public function update(Request $request,$panel, $id)
    {
        /*$request->validate([
            'floor_images' => 'required',
            'images' => 'required',
        ]);*/
        $building = Helpers::building_detail_single($id);
        $building_detail_check = BuildingDetail::where('building_id', $building->id)->first();
        if ($building_detail_check == null){
            return redirect()->back()->with($this->message("Building Extra Detail not exist", 'error'));
        } else {
            $building_detail = BuildingDetail::where('building_id', $building->id)->first();
        }

        $data = json_encode([
            'shop_detail' => ['floor' => $request->floor, 'area' => $request->area, 'price' => $request->price],
            'single_bed_flat' => ['building' => $request->building_1bed, 'area' => $request->area_1bed, 'bed' => $request->bed_1bed, 'bath' => $request->bath_1bed, 'price' => $request->price_1bed],
            'double_bed_flat' => ['building' => $request->building_2bed, 'area' => $request->area_2bed, 'bed' => $request->bed_2bed, 'bath' => $request->bath_2bed, 'price' => $request->price_2bed],
            'studio_bed_flat' => ['building' => $request->building_studio, 'area' => $request->area_studio, 'bed' => $request->studio, 'bath' => $request->bath_studio, 'price' => $request->price_studio],
        ]);
        $building_detail->building_id = $building->id;
        $building_detail->address = $request->address;
        $building_detail->developer = $request->developer;
        $building_detail->price = $request->price;
        $building_detail->description = $request->description;
        $building_detail->plot_feature = json_encode(['sewerage' => $request->sewerage, 'electricity' => $request->electricity, 'water_supply' => $request->water]);
        $building_detail->business_feature = json_encode(['broadband' => $request->broadband, 'atm' => $request->atm]);
        $building_detail->community_feature = json_encode(['gym' => $request->gym]);
        $building_detail->healthcare_feature = json_encode(['swimming_pool' => $request->swimming_pool, 'suna' => $request->suna, 'jacuzzi' => $request->jacuzzi]);
        $building_detail->other_facilities = json_encode(['school' => $request->school, 'hospital' => $request->hospital, 'shopping_mall' => $request->shopping_mall, 'restaurant' => $request->restaurant, 'transport' => $request->transport, 'services' => $request->services, 'maintenance' => $request->maintenance, 'security' => $request->security]);
        $building_detail->property_type = $data;
        $building_detail->save();

        /*$floor = Floor::whereIn('id', json_decode($building->floor_list))->get();
        foreach ($floor as $data){
            BuildingDetailFile::updateOrCreate(['building_detail_id' => $building_detail->id], ['floor_image_id' => $data->id]);
        }*/

        if ($request->has('images')) {
            foreach ($request->file('images') as $file) {
                $filename = hexdec(uniqid()) . '.' . strtolower($file->getClientOriginalExtension());
                $file->move('public/images/building/payment/', $filename);
                $file = 'public/images/building/payment/' . $filename;
                BuildingDetailFile::Create(
                    [
                        'building_detail_id' => $building_detail->id,
                        'image' => $file,
                        'type' => 'payment_plan'
                    ]);
            }
            /*if ($request->has('old_image')) {
                $old_image = $request->image;
                unlink($old_image);
            }*/
        }
        if ($request->has('floor_images')) {
            foreach ($request->file('floor_images') as $file) {
                $filename = hexdec(uniqid()) . '.' . strtolower($file->getClientOriginalExtension());
                $file->move('public/images/building/floor/', $filename);
                $file = 'public/images/building/floor/' . $filename;
                BuildingDetailFile::Create(
                    [
                        'building_detail_id' => $building_detail->id,
                        'image' => $file,
                        'type' => 'floor_plan'
                    ]);
            }
            /*if ($request->has('old_image')) {
                $old_image = $request->image;
                unlink($old_image);
            }*/
        }
        if ($building_detail) {
            return redirect()->route('property_manager.building_details.index')->with($this->message('Building Extra Detail update SuccessFully', 'success'));
        } else {
            return redirect()->back()->with($this->message("Building Extra Detail update Error", 'error'));
        }
    }

    public function destroy($id)
    {
        //
    }

    public function remove_image_payment(Request $request)
    {
        //$filename = explode('/', $request->name);dd($filename);
        $building_detail_file = BuildingDetailFile::where(['building_detail_id' => $request->building_detail_id, 'type' => $request->type])->first();
        // $img_arr = [];
        // foreach (json_decode($building_detail_file->banner_images, true) as $img) {
        //     if (strcmp($img, $request->name) != 0) {
        //         array_push($img_arr, $img);
        //     }
        // }

        $building_detail_file->delete();
        if($building_detail_file !== null){
            unlink($building_detail_file->image);
        }

        return json_encode($request->name);
    }
}
