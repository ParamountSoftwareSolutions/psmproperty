<?php

namespace App\Http\Controllers\Property;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\BuildingDetail;
use App\Models\BuildingDetailFile;
use App\Models\Floor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuildingDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $buildings = Building::where('manager_id', Auth::id())->get();
        return view('property_manager.building_detail.index', compact('buildings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $floor = Floor::get();
        return view('property_manager.building_detail.create', compact('floor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $building = Building::where('manager_id', Auth::id())->findOrFail($id);
        $floor = Floor::whereIn('id', json_decode($building->floor_list))->get();
        return view('property_manager.building_detail.edit', compact('building', 'floor'));
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
        $building = Building::where('id', $id)->first();
        $building_detail_check = BuildingDetail::where('building_id', $building->id)->first();
        if ($building_detail_check == null){
            $building_detail = new BuildingDetail();
        } else {
            $building_detail = BuildingDetail::where('building_id', $id)->first();
        }
        $building_detail->building_id = $building->id;
        $building_detail->address = $request->address;
        $building_detail->developer = $request->developer;
        $building_detail->price = $request->price;
        $building_detail->description = $request->description;
        $building_detail->plot_feature = json_encode(['sewerage' => $request->sewerage, 'electricity' => $request->electricity, 'water_supply' => $request->water]);
        $building_detail->business_feature = json_encode(['broadband' => $request->broadband, 'atm' => $request->atm]);
        $building_detail->community_feature = json_encode(['gym' => $request->gym]);
        $building_detail->healthcare_feature = json_encode(['swimming_pool' => $request->swimming_pool, 'suna' => $request->suna, 'jacuzzi' => $request->jacuzzi]);
        $building_detail->other_facilities = json_encode(['school' => $request->school, 'hospitial' => $request->hospitial, 'shopping_mall' => $request->shopping_mall, 'restaurant' => $request->restaurant, 'transport' => $request->transport, 'services' => $request->services]);
        $building_detail->property_type = json_encode(['shop_detail' => ['floor' => $request->floor, 'area' => $request->area, 'price' => $request->price],
            '1bed_flat' => ['building' => $request->building_1bed, 'area' => $request->area_1bed, 'bed' => $request->bed_1bed, 'bath' => $request->bath_1bed, 'price' => $request->price_1bed],
            '2bed_flat' => ['building' => $request->building_2bed, 'area' => $request->area_2bed, 'bed' => $request->bed_2bed, 'bath' => $request->bath_2bed, 'price' => $request->price_2bed],
            '1bed_flat' => ['building' => $request->building_studio, 'area' => $request->area_studio, 'bed' => $request->studio, 'bath' => $request->bath_studio, 'price' => $request->price_studio],

        ]);
        $building_detail->save();

        $floor = Floor::whereIn('id', json_decode($building->floor_list))->get();
        foreach ($floor as $data){
            BuildingDetailFile::updateOrCreate(['building_detail_id' => $building_detail->id], ['floor_image_id' => $data->id]);
        }
        if ($request->has('payment_plan')) {
            foreach ($request->file('payment_plan') as $file) {
                $filename = hexdec(uniqid()) . '.' . strtolower($file->getClientOriginalExtension());
                $file->move('images/building/payment/', $filename);
                $file = asset('images/building/payment/' . $filename);
                BuildingDetailFile::updateOrCreate([
                    'building_detail_id' => $building_detail->id],
                    ['payment_plan' => $file
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
