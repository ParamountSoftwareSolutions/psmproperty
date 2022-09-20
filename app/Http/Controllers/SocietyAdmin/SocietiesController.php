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
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SocietiesController extends Controller
{
    private $activePage;
    public function __construct(){
        $this->activePage = "society";
    }
    public function index(){
        $nocTypes = NocType::all();
        $societyTypes = SocietyType::all();
        $cities = City::all();
        $provinces = Province::all();
        $societyCategories = SocietyCategory::all();
        return view('society_admin.societies.index', array('activePage' => $this->activePage, 'nocTypes' => $nocTypes, 'societyTypes' => $societyTypes, 'cities' => $cities, 'provinces' => $provinces, 'societyCategories' => $societyCategories));
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

    public function get($id){
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
            return view('society_admin.societies.detail', array('activePage' => $this->activePage,
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

    public function create(Request $request){

        $society = new Society();
        $society->user_id = auth()->user()->id;
        $society->owner_name = $request->get('owner_name');
        $society->society_name = $request->get('society_name');
        $society->city_id = 1;
        $society->province_id = 1;
        $society->address = $request->get('address');
        $society->society_type_id = $request->get('sector');
        $society->noc_type_id = $request->get('noc_type');
        $society->area = $request->get('area');
        $images=array();
        $files=$request->file('society_images');
        if($files){
            foreach($files as $file){
                $finalFile = $file->store('/', ['disk' => 'society_images']);
                $images[]=$finalFile;
            }
        }

        $society->images_array = json_encode($images);
        $society->details = $request->get('details');
        $society->status_id = 3;// update later
        // Save society login details
        $user= User::create([
            'username' => $request->get('society_username'),
            'phone_number'=> $request->get('society_phone'),
            'email' => $request->get('society_login'),
            'password' => Hash::make($request->get('society_password')),
        ]);
        $user->assignRole('society');
        $society->assignee_id = $user->id;
        $society->save();
        return redirect()->to('societyAdmin/all-societies')->with('success', 'Society added Successfully');
    }

    public function getPlotDetails(){
        //get society details and society category details related to plot

        $plotDetails = SocietyCategory::where('name', 'Plot')->first();
        $societyPlotData = SocietyCategoryData::where('category_id', $plotDetails->id)->first();
        $plotData=  json_decode($plotDetails->fields_json_array);
        $societyData = null;
        if($societyPlotData != null){
            $societyData = $societyPlotData->data_array;
        }
        return response()->json(['data' => array('plot_data' => $plotData, 'society_data' => $societyData)]);
    }

    public function getVillaDetails(){
        $villaDetails = SocietyCategory::where('name', 'Villa')->first();
        $societyVillaData = SocietyCategoryData::where('category_id', $villaDetails->id)->first();

        $villaData = json_decode($villaDetails->fields_json_array);
        $societyData = null;
        if($societyVillaData != null){
            $societyData = $societyVillaData->data_array;
        }
        return response()->json(['data' => array('villa_data' => $villaData, 'society_data' => $societyData)]);

    }



    public function getCommercialDetails(){
        $commercialDetails = SocietyCategory::where('name', 'Commercial')->first();
        $societyCommercialData = SocietyCategoryData::where('category_id', $commercialDetails->id)->first();

        $commercialData = json_decode($commercialDetails->fields_json_array);
        $societyData = null;
        if($societyCommercialData != null){
            $societyData = $societyCommercialData->data_array;
        }
        return response()->json(['data' => array('commercial_data' => $commercialData, 'society_data' => $societyData)]);

    }

    public function getApartmentDetails(){
        $apartmentDetails = SocietyCategory::where('name', 'Apartment')->first();
        $societyApartmentData = SocietyCategoryData::where('category_id', $apartmentDetails->id)->first();

        $apartmentData = json_decode($apartmentDetails->fields_json_array);
        $societyData = null;
        if($societyApartmentData != null){
            $societyData = $societyApartmentData->data_array;
        }
        return response()->json(['data' => array('apartment_data' => $apartmentData, 'society_data' => $societyData)]);
    }

    public function updateSocietyDetails(Request $request){
        //get society data and store in json format

        $sizesArray = $request->get('sizes');
        $typesArray = $request->get('type');
        $premiumArray = $request->get('premium');

        //"premium":{"Main-Boulevard":"300000","Corner":"4000000"}
        $finalArray = array();
        $premium = array();
        for($i = 0; $i < count($sizesArray); $i++){
            $tempArray = array();
            $tempArray["size"] = $sizesArray[$i];
            for($t = 0; $t < count($typesArray); $t++){
               //i = 3, t = Residential, need = 3_Marla-type
                $typesRow = $request->get($sizesArray[$i].'-type');
                $tempArray[$typesArray[$t]] =$typesRow[$t];
                $premium[$typesArray[$t]] = "0";
            }
            for($p = 0; $p < count($premiumArray); $p++){
                $premiumRow = $request->get($sizesArray[$i].'-premium');
                $tempArray[$premiumArray[$p]] =$premiumRow[$p];
                $premium[$premiumArray[$p]] = "0";
            }

            $installment_details = array("processing_amount"=> 0, "down_payment"=> 0, "monthly_installment" => 0,"total_installment" => 0, "large_payment" => 0, "large_payment_period_per_year" => 0, "possession_fee" => 0, "belting_fee" => 0, "start_date" => 0, "development_amount" => 0, "premium" => $premium);

            $tempArray["installment_details"] = $installment_details;
            $finalArray[] = $tempArray;
        }
       // return $finalArray;
        $typeName = SocietyCategory::where('name', $request->get('type_name'))->first();

        $dataArray = SocietyCategoryData::where('society_id', $request->get('society_id'))->where('category_name', $typeName->name)->first();
        if($dataArray == null){
            $dataArray = new SocietyCategoryData();
        }
        $dataArray->category_name = $typeName->name;
        $dataArray->data_array = json_encode($finalArray);
        $dataArray->society_id = $request->get('society_id');
        $dataArray->category_id = $typeName->id;
        $dataArray->created_by = \auth()->user()->id;
        $dataArray->status_id = 1;
        $dataArray->save();

        return back()->with('success', 'Data Added Successfully');
    }


    public function deleteApartmentDetails($id, $society_id){
        $dataArray = SocietyCategoryData::where('society_id', $society_id)->where('category_name', 'apartment')->first();
        if($dataArray != null){
            $orignalData = json_decode($dataArray->data_array);
            $finaData = array();
            foreach ($orignalData as $oData){
                if($oData->size != $id){
                    $finaData[] = $oData;
                }

                $dataArray->data_array = json_encode($finaData);
                $dataArray->save();
            }

            return back()->with('success', 'Data Deleted Successfully');

        }

    }

    public function deletePlotDetails($id, $society_id){

        $dataArray = SocietyCategoryData::where('society_id', $society_id)->where('category_name', 'plot')->first();
        if($dataArray != null){
            $orignalData = json_decode($dataArray->data_array);
            $finaData = array();
            foreach ($orignalData as $oData){
                if($oData->size != $id){
                    $finaData[] = $oData;
                }

                $dataArray->data_array = json_encode($finaData);
                $dataArray->save();
            }

            return back()->with('success', 'Data Deleted Successfully');

        }
    }

    function updatePaymentDetails(Request $request){
            $societyId = $request->get('society_id');
            $plotSize = $request->get('plot_size');

            $categoryDBData = SocietyCategoryData::find($request->get('society_category_data_id'));
            if($categoryDBData != null){

                $categoryDataArray = json_decode($categoryDBData->data_array);
                //loop on array and get appropriate size to add payment

                $installmentDetails = array(
                    "processing_amount" => $request->get('processing_amount'),
                    "down_payment" => $request->get('down_payment'),
                    "monthly_installment" => $request->get('monthly_installment'),
                    "total_installment" => $request->get('total_installment'),
                    "large_payment" => $request->get('big_installment'),
                    "large_payment_period_per_year" => $request->get('big_installment_period'),
                    "possession_fee" => $request->get('possession_amount'),
                    "belting_fee" => $request->get('belting_amount'),
                    "start_date" => $request->get('start_date'),
                    "development_amount" => $request->get('development_amount')
                );


                $premiumAmountArray = array();
                $premiumCharges = $request->get('premium_charges');

                foreach ($premiumCharges as $premiumCharge){
                    $premiumAmountArray[$premiumCharge] = $request->get($premiumCharge);
                }

                $installmentDetails['premium'] = $premiumAmountArray;

                foreach ($categoryDataArray as $categoryData){
                    if($categoryData->size == $plotSize){
                        $categoryData->installment_details = $installmentDetails;
                    }
                }

                $categoryDBData->data_array = json_encode($categoryDataArray);
                $categoryDBData->save();
            }

            return back()->with('success', 'Payment Details Updated Successfully');
    }

    public function view($id){
        $society = Society::find($id);
        if($society != null){
            $nocTypes = NocType::all();
            $societyTypes = SocietyType::all();
            $cities = City::all();
            $provinces = Province::all();

            $societySales = $society->Sales()->count();
            $societyEmployees = $society->Employees()->count();

            $societyCategories = SocietyCategory::all();
            $categoryPlotsData = SocietyCategoryData::where('society_id', $id)->where('category_name', 'Plot')->first();
            $categoryVillasData = SocietyCategoryData::where('society_id', $id)->where('category_name', 'Villa')->first();
            $categoryApartmentData = SocietyCategoryData::where('society_id', $id)->where('category_name', 'Apartment')->first();
            $categoryCOmmercialData = SocietyCategoryData::where('society_id', $id)->where('category_name', 'Commercial')->first();



            $categoryApartmentCount = 0;
            if(isset($categoryApartmentData)) {
                $apartmentJson = json_decode($categoryApartmentData->data_array);
                if(isset($apartmentJson[0]->Apartments)){
                    if ($apartmentJson[0]->Apartments != null) {
                        $categoryApartmentCount += (int)$apartmentJson[0]->Apartments;
                    }
                }
            }




            $salesData = DB::select("SELECT SUM(installment_amount) AS amount,
                                    DATE_FORMAT(due_date, \"%m\") AS MONTH
                                    FROM
                                    society_installment_data
                                    GROUP BY
                                        MONTH");


            $salesCount = array();
            $labels = array();
            $months = ['01'=>'Jan', '02'=> 'Feb', '03'=>'Mar', '04'=>'Apr', '05'=>'May', '06'=>'Jun', '07'=>'Jul', '08'=>'Aug', '09'=>'Sep', '10'=>'Oct', '11'=>'Nov', '12'=>'Dec'];
            foreach ($salesData as $data){
                $labels[] = $months[$data->MONTH];
                $salesCount[] = $data->amount;
            }

            $calculatedData = array('sales' => $salesCount, 'months' => $labels);

            return view('society_admin.societies.view', array('activePage' => $this->activePage,
                'nocTypes' => $nocTypes,
                'societyTypes' => $societyTypes,
                'cities' => $cities,
                'provinces' => $provinces,
                'sales' => $societySales,
                'salesCount'=>$calculatedData,
                'employees' => $societyEmployees,
                'societyCategories' => $societyCategories,
                'society_details' => $society,
                'plots' => $categoryPlotsData,
                'villas' => $categoryVillasData,
                'count_apartment'=> $categoryApartmentCount,
                'apartments' => $categoryApartmentData,
                'commercials' => $categoryCOmmercialData
            ));
        }else{
            return back()->with('error', 'Unexpected Error Please Contact Administrator');
        }
    }
}
