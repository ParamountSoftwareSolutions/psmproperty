<?php

namespace App\Http\Controllers\PropertyManager;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\BuildingPaymentPlan;
use App\Models\Floor;
use App\Models\FloorDetail;
use App\Models\FloorDetailFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FloorDetailController extends Controller
{
    public function index($building_id, $floor_id)
    {
        $floor = Floor::findOrFail($floor_id);
        $floor_detail = FloorDetail::with('payment_plan')->where(['building_id' => $building_id, 'floor_id' => $floor_id])->get();
//        dd($floor_detail);
        return view('property_manager.floor_detail.index', compact('floor_detail', 'floor', 'floor_id', 'building_id'));
    }

    public function create($building_id, $floor_id)
    {
        $payment_plan = BuildingPaymentPlan::where('property_admin_id', Helpers::user_admin())->get();
        return view('property_manager.floor_detail.create', compact('building_id', 'floor_id','payment_plan'));
    }

    public function store(Request $request, $building_id, $floor_id)
    {
        $request->validate([
            'unit_id' => 'required',
            'payment_plan_id' => 'required',
            'area' => 'required',
            'status' => 'required',
        ]);

        $floor_detail = new FloorDetail();
        $floor_detail->building_id = $building_id;
        $floor_detail->floor_id = $floor_id;
        $floor_detail->unit_id = $request->unit_id;
        $floor_detail->area = $request->area;
        $floor_detail->payment_plan_id = $request->payment_plan_id;
        $floor_detail->size = $request->size;
        $floor_detail->bath = $request->bath;
        $floor_detail->type = $request->type;
        $floor_detail->status = $request->status;
        $floor_detail->save();
        if ($request->has('images')) {
            foreach ($request->file('images') as $file) {
                $filename = hexdec(uniqid()) . '.' . strtolower($file->getClientOriginalExtension());
                $file->move('public/images/building/floor/', $filename);
                $file = 'public/images/building/floor/' . $filename;
                FloorDetailFile::Create(
                    [
                        'floor_detail_id' => $floor_detail->id,
                        'image' => $file,
                    ]);
            }
        } else{
            FloorDetailFile::Create(
                [
                    'floor_detail_id' => $floor_detail->id,
                    'image' => 'public/images/building/floor/apartment.png',
                ]);
        }
        if ($floor_detail) {
            return redirect()->route('property_manager.floor_detail.index', ['building_id' => $building_id, 'floor_id' => $floor_id])->with($this->message('Data Create SuccessFully', 'success'));
        } else {
            return redirect()->back()->with($this->message("Data Create Error", 'error'));
        }

    }

    public function edit($building_id, $floor_id, $id)
    {
        $floor_detail = FloorDetail::where(['id' => $id, 'building_id' => $building_id, 'floor_id' => $floor_id])->first();
        $payment_plan = BuildingPaymentPlan::where('property_admin_id', Helpers::user_admin())->get();
        return view('property_manager.floor_detail.edit', compact('building_id', 'floor_id', 'floor_detail','payment_plan'));
    }

    public function update(Request $request, $building_id, $floor_id, $id)
    {
        $request->validate([
            'unit_id' => 'required',
            'area' => 'required',
            'payment_plan_id' => 'required',
            'status' => 'required',
        ]);
        $floor_detail = FloorDetail::where(['id' => $id, 'building_id' => $building_id, 'floor_id' => $floor_id])->first();
        $floor_detail->building_id = $building_id;
        $floor_detail->floor_id = $floor_id;
        $floor_detail->payment_plan_id = $request->payment_plan_id;
        $floor_detail->unit_id = $request->unit_id;
        $floor_detail->area = $request->area;
        $floor_detail->size = $request->size;
        $floor_detail->bath = $request->bath;
        $floor_detail->type = $request->type;
        $floor_detail->status = $request->status;
        $floor_detail->save();
        if ($request->has('images')) {
            foreach ($request->file('images') as $file) {
                $filename = hexdec(uniqid()) . '.' . strtolower($file->getClientOriginalExtension());
                $file->move('public/images/building/floor/', $filename);
                $file = 'public/images/building/floor/' . $filename;
                FloorDetailFile::Create(
                    [
                        'floor_detail_id' => $floor_detail->id,
                        'image' => $file,
                    ]);
            }
        }
        if ($floor_detail) {
            return redirect()->route('property_manager.floor_detail.index', ['building_id' => $building_id, 'floor_id' => $floor_id])->with($this->message('Data Update SuccessFully', 'success'));
        } else {
            return redirect()->back()->with($this->message("Data Update Error", 'error'));
        }

    }

    public function destroy($building_id, $floor_id, $id)
    {
        $floor_detail = FloorDetail::where(['id' => $id, 'building_id' => $building_id, 'floor_id' => $floor_id])->first();
        $floor_detail->delete();
        if ($floor_detail) {
            return redirect()->route('property_manager.floor_detail.index', ['building_id' => $building_id, 'floor_id' => $floor_id])->with($this->message('Data Delete SuccessFully', 'success'));
        } else {
            return redirect()->back()->with($this->message("Data Delete Error", 'error'));
        }
    }

    public function remove_image(Request $request)
    {
        //$filename = explode('/', $request->name);dd($filename);
        $floor_detail_file = FloorDetailFile::where(['floor_detail_id' => $request->floor_detail_id, 'id' => $request->id])->first();

        $floor_detail_file->delete();
        if($floor_detail_file !== null){
            unlink($floor_detail_file->image);
        }

        return json_encode($request->name);
    }
}
