<?php

namespace App\Http\Controllers\Property;

use App\Http\Controllers\Controller;
use App\Models\Floor;
use App\Models\FloorDetail;
use Illuminate\Http\Request;

class FloorDetailController extends Controller
{
    public function index($building_id, $floor_id)
    {
        $floor = Floor::findOrFail($floor_id);
        $floor_detail = FloorDetail::where(['building_id' => $building_id, 'floor_id' => $floor_id])->get();
        return view('property.floor_detail.index', compact('floor_detail', 'floor', 'floor_id', 'building_id'));
    }

    public function create($building_id, $floor_id)
    {
        return view('property.floor_detail.create', compact('building_id', 'floor_id'));
    }

    public function store(Request $request, $building_id, $floor_id)
    {
        $request->validate([
            'number' => 'required',
            'area' => 'required',
            'total_price' => 'required',
            'booking_price' => 'required',
            'per_month_installment' => 'required',
            'half_year_installment' => 'required',
            'balloting_price' => 'required',
            'possession_price' => 'required',
            'status' => 'required',
        ]);
        $floor_detail = new FloorDetail();
        $floor_detail->building_id = $building_id;
        $floor_detail->floor_id = $floor_id;
        $floor_detail->number = $request->number;
        $floor_detail->area = $request->area;
        $floor_detail->size = $request->size;
        $floor_detail->premium = $request->premium;
        $floor_detail->total_month_installment = $request->total_month_installment;
        $floor_detail->total_price = $request->total_price;
        $floor_detail->booking_price = $request->booking_price;
        $floor_detail->per_month_installment = $request->per_month_installment;
        $floor_detail->half_year_installment = $request->half_year_installment;
        $floor_detail->balloting_price = $request->balloting_price;
        $floor_detail->possession_price = $request->possession_price;
        $floor_detail->type = $request->type;
        $floor_detail->status = $request->status;
        $floor_detail->save();
        if ($floor_detail) {
            return redirect()->route('property_admin.floor_detail.index', ['building_id' => $building_id, 'floor_id' => $floor_id])->with($this->message('Data Create SuccessFully', 'success'));
        } else {
            return redirect()->back()->with($this->message("Data Create Error", 'error'));
        }

    }

    public function edit($building_id, $floor_id, $id)
    {
        $floor_detail = FloorDetail::where(['id' => $id, 'building_id' => $building_id, 'floor_id' => $floor_id])->first();
        return view('property.floor_detail.edit', compact('building_id', 'floor_id', 'floor_detail'));
    }

    public function update(Request $request, $building_id, $floor_id, $id)
    {
        $request->validate([
            'number' => 'required',
            'area' => 'required',
            'total_price' => 'required',
            'booking_price' => 'required',
            'per_month_installment' => 'required',
            'half_year_installment' => 'required',
            'balloting_price' => 'required',
            'possession_price' => 'required',
            'status' => 'required',
        ]);
        $floor_detail = FloorDetail::where(['id' => $id, 'building_id' => $building_id, 'floor_id' => $floor_id])->first();
        $floor_detail->building_id = $building_id;
        $floor_detail->floor_id = $floor_id;
        $floor_detail->number = $request->number;
        $floor_detail->area = $request->area;
        $floor_detail->size = $request->size;
        $floor_detail->premium = $request->premium;
        $floor_detail->total_month_installment = $request->total_month_installment;
        $floor_detail->total_price = $request->total_price;
        $floor_detail->booking_price = $request->booking_price;
        $floor_detail->per_month_installment = $request->per_month_installment;
        $floor_detail->half_year_installment = $request->half_year_installment;
        $floor_detail->balloting_price = $request->balloting_price;
        $floor_detail->possession_price = $request->possession_price;
        $floor_detail->type = $request->type;
        $floor_detail->status = $request->status;
        $floor_detail->save();
        if ($floor_detail) {
            return redirect()->route('property_admin.floor_detail.index', ['building_id' => $building_id, 'floor_id' => $floor_id])->with($this->message('Data Update SuccessFully', 'success'));
        } else {
            return redirect()->back()->with($this->message("Data Update Error", 'error'));
        }

    }

    public function destroy($building_id, $floor_id, $id)
    {
        $floor_detail = FloorDetail::where(['id' => $id, 'building_id' => $building_id, 'floor_id' => $floor_id])->first();
        $floor_detail->delete();
        if ($floor_detail) {
            return redirect()->route('property_admin.floor_detail.index', ['building_id' => $building_id, 'floor_id' => $floor_id])->with($this->message('Data Delete SuccessFully', 'success'));
        } else {
            return redirect()->back()->with($this->message("Data Delete Error", 'error'));
        }
    }
}
