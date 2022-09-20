<?php

namespace App\Http\Controllers\SocietyAdmin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\NocType;
use App\Models\Province;
use App\Models\Society;
use App\Models\SocietyCategory;
use App\Models\SocietyCategoryData;
use App\Models\SocietyType;
use Illuminate\Http\Request;

class SocietyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $nocTypes = NocType::all();
        $societyTypes = SocietyType::all();
        $cities = City::all();
        $provinces = Province::all();
        $societyCategories = SocietyCategory::all();
        return view('society_admin.societies.index', array('nocTypes' => $nocTypes, 'societyTypes' => $societyTypes, 'cities' => $cities, 'provinces' => $provinces, 'societyCategories' => $societyCategories));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $society = Society::find($id);
        if($society != null){
            $nocTypes = NocType::all();
            $societyTypes = SocietyType::all();
            $cities = City::all();
            $provinces = Province::all();
            $societyCategories = SocietyCategory::all();
            $categoryPlotsData = SocietyCategoryData::where('society_id', $id)->where('category_name', 'Plot')->first();
            $categoryVillasData = SocietyCategoryData::where('society_id', $id)->where('category_name', 'Villa')->first();
            $categoryApartmentData = SocietyCategoryData::where('society_id', $id)->where('category_name', 'Apartment')->first();
            $categoryCOmmercialData = SocietyCategoryData::where('society_id', $id)->where('category_name', 'Commercial')->first();
            return view('society_admin.societies.detail', array(
                'nocTypes' => $nocTypes,
                'societyTypes' => $societyTypes,
                'cities' => $cities,
                'provinces' => $provinces,
                'societyCategories' => $societyCategories,
                'society_details' => $society,
                'plots' => $categoryPlotsData,
                'villas' => $categoryVillasData,
                'apartments' => $categoryApartmentData,
                'commercials' => $categoryCOmmercialData
            ));
        }else{
            return back()->with('error', 'Unexpected Error Please Contact Administrator');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    public function getJsonCategories(){
        $societyCategories = SocietyCategory::all();
        $jsonCategoryArray = array();
        foreach ($societyCategories as $cat){
            $tempArray = array(
                "id" => $cat->id,
                "text" => $cat->name,
                "value" => $cat->id,
                "jsonValues" => $cat->fields_json_array
            );
            $jsonCategoryArray[] = $tempArray;
        }

        return ($jsonCategoryArray);
    }
}
