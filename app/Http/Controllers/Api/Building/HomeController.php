<?php

namespace App\Http\Controllers\Api\Building;

use App\Http\Controllers\Controller;
use App\Models\MobileApplication;
use App\Models\Society;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function societies(){
        $societies = Society::all();
        if($societies != null) {
            return response()->json([
                'code'=>200,
                'status'=> 'Data Found Successfully',
                'societies' => $societies
            ]);
        }else{
            return response()->json([
                'code'=>201,
                'status'=> 'Data Not Found',
                'societies' => []
            ]);
        }
    }

    public function societyDetails(Request $request){
        $mobileApplication = MobileApplication::where('app_key', $request->get('API_KEY'))->first();

        if($mobileApplication->Society != null){
            $society = array();
            $society["details"] = $mobileApplication->Society;

            $categoryData = $mobileApplication->Society->CategoryData;


            return response()->json([
                'code'=>200,
                'status'=> 'Data Found Successfully',
                'society' => $society
            ]);
        }else{
            return response()->json([
                'code'=>201,
                'status'=> 'Data Not Found',
                'society' => []
            ]);
        }

    }
}
