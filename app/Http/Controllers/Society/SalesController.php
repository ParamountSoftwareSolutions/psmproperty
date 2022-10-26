<?php

namespace App\Http\Controllers\Society;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ClientPaymentHistory;
use App\Models\ClientPlot;
use App\Models\InstallmentPaymentHistory;
use App\Models\SocietyCategory;
use App\Models\SocietyCategoryData;
use App\Models\SocietyInstallmentData;
use App\Models\SocietySale;
use App\Models\Status;
use App\Models\User;
use http\Exception\BadConversionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    private $activePage;
    public function __construct(){
        $this->activePage = "sales";
    }

    public function index(){
        $society = Auth::user()->Society;
        if($society == null){
            $society = Auth::user()->Employee->Society;
        }

        $societyCategories = $society->CategoryData;
        $societySales = SocietySale::where('society_id', $society->id)->get();
        return view('society.sales.index', array('activePage' => $this->activePage, 'societyCategories' => $societyCategories, 'societySales' => $societySales));
    }

    public function get($id){
        $society = Auth::user()->Society;
        if($society == null){
            $society = Auth::user()->Employee->Society;
        }

        $societyCategories = $society->CategoryData;
        $societySale = SocietySale::find($id);
        $statusPaid = Status::where('name', 'paid')->first();
        $installmentPaid = SocietyInstallmentData::where('society_sales_id', $id)->where('status_id', $statusPaid->id)->get();

        if($societySale != null){
            return view('society.sales.history', array('activePage' => $this->activePage, 'societyCategories' => $societyCategories, 'societySale' => $societySale, 'installmentPaid' => $installmentPaid));
        }
    }

    public function getCategoryHint(){
        $sCategory = SocietyCategoryData::find($_GET['id']);

        $unitValues = SocietyCategory::where('name', $sCategory->category_name)->first();
        $unitValues = json_decode($unitValues->fields_json_array);
        $dataaray = json_decode($sCategory->data_array);
        return response()->json(['data' => ['society_data_sizes' => $dataaray, 'unit_values' => $unitValues]]);
    }

    public function getCategoryDetails(){
        $sCategory = SocietyCategoryData::find($_GET['id']);
        $size = $_GET['size'];
        $dataarray = json_decode($sCategory->data_array);
        $returnArray = array();
        foreach ($dataarray as $da){
            if($da->size == $size){
                $returnArray[] = $da;
            }
        }
        return response()->json(['data' => ['society_data_sizes' => $dataarray, 'values' => $returnArray]]);
    }

    public function checkItemStatus(){
        $society = Auth::user()->Society;
dd($society);
        //check if items sold status..
        $item = SocietySale::where('registration_number', $_GET['reg_num'])->where('society_id', $society->id)->first();
        if($item == null){
            return response()->json(['data' => 'available']);
        }else{
            return response()->json(['data' => 'sold']);
        }
    }

    public function searchUser(){
        $user = User::where('username', $_GET['query'])->orWhere('email', $_GET['query'])->orWhere('phone_number', $_GET['query'])->first();
        if($user != null){
            return response()->json(['data' => ['code' => '200', 'user' => $user]]);
        }else{
            return response()->json(['data' => ['code' => '500', 'user' => null ]]);
        }
    }

    public function store(Request $request){

        $salesCategoryId = $request->get('sale_category_id');
        $salesSizeId = $request->get('sale_size_id');
        $registrationNumber = $request->get('registration_number');
        $processingFee = $request->get('processing_fee');
        $downPayment = $request->get('down_payment');
        $totalInstallment =$request->get('total_installment');
        $monthlyInstallments = $request->get('monthly_installment');
        $midTermInstallment = $request->get('mid_term_installment');
        $midTermPerYear = $request->get('mid_term_installment_per_year');
        $possessionFee = $request->get('possession_fee');
        $beltingFee = $request->get('belting_fee');

        //customer record
        $userType = $request->get('user_type');
       // return $userType;
        //$customer = null;
        if($userType == 'new_customer'){
            $customer = new User();
            $customer->username = $request->get('username');
            $customer->email = $request->get('email');
            $customer->phone_number = $request->get('phone_number');
            $customer->password = $request->get('password');
            $customer->save();
        }else{
            $customer = User::find($request->get('user_id'));
        }
dd($customer);
        $client = Client::where('user_id', $customer->id)->first();
        dd($client);
        if($client == null){
            $client = new Client();
        }
        $client->user_id = $customer->id;
        $client->cnic = $request->get('user_cnic');
        $client->address  =$request->get('address');
        $client->save();

        //save user record and fields in society sale table as well as in client plot tables
        $societySales = new SocietySale();
        $societySales->society_id = Auth::user()->Society->id;
        $societySales->society_cat_data_id = $salesCategoryId;
        $societySales->created_by = Auth::user()->id;

        $societySales->plot_size = $request->get('sale_size_id');

        $societySales->total_installment = $totalInstallment;
        $societySales->processing_fee = $processingFee;
        $societySales->monthly_installments = $monthlyInstallments;
        $societySales->mid_term_installment = $midTermInstallment;
        $societySales->mid_term_per_year = $midTermPerYear;
        $societySales->possession_fee =  $possessionFee;
        $societySales->belting_fee = $beltingFee;
        $societySales->down_payment = $downPayment;

        $societySales->sold_to_id = $customer->id;
        $societySales->registration_number = $registrationNumber;
        $societySales->hidden_file_number = Auth::user()->Society->id.$salesCategoryId;


        $societySales->save();

        //save client plot details
        $clientPlot = new ClientPlot();
        $clientPlot->client_id = $customer->id;
        $clientPlot->society_id = Auth::user()->Society->id;
        $clientPlot->agent_id = Auth::user()->id;
        $clientPlot->plot_number = $registrationNumber;

        $clientPlot->plot_size = $request->get('sale_size_id');

        $clientPlot->plot_number = $registrationNumber;
        $clientPlot->save();

        //add instalment 'society_installment_data' details via loop...

        $totalInstallmentyears = $totalInstallment / 12;
        $midTerm = 12/$midTermPerYear;

        $date = date('Y-m-d', strtotime('+'.$totalInstallmentyears.'years'));


        for($i = 1; $i<= $totalInstallment; $i++){
            $societyInstallmentData = new SocietyInstallmentData();
            $societyInstallmentData->society_sales_id = $societySales->id;

            $month = date('Y-m-d', strtotime('+'.$i.'months'));

            if($i % $midTerm == 0){
                $societyInstallmentData->installment_amount = $midTermInstallment;
            }else{
                $societyInstallmentData->installment_amount = $monthlyInstallments;
            }
            $societyInstallmentData->status_id = 9;
            $societyInstallmentData->due_date = $month;
            $societyInstallmentData->created_by = Auth::user()->id;
            $societyInstallmentData->save();
        }

        return back()->with('success', 'Data added successfully');
    }


    public function updateInstallment(Request $request){

        $societySales = SocietySale::find($request->get('sales_id'));
        if($societySales != null){
            $statusPaid = Status::where('name', 'paid')->first();
            $months = $request->get('months');
            $totalRequiredAmount = 0;
            for($i = 0; $i < $months; $i++){
                $currentInstallment = SocietyInstallmentData::where('society_sales_id', $societySales->id)->where('status_id', 9)->first();
                $currentInstallment->status_id = $statusPaid->id;
                $currentInstallment->fine_amount = $request->get('fine');
                $totalRequiredAmount += $currentInstallment->installment_amount;
                $currentInstallment->save();
            }

            $installmentHistory = new InstallmentPaymentHistory();
            $installmentHistory->sales_id = $societySales->id;
            $installmentHistory->amount_paid = $request->get('amount');
            $installmentHistory->fine_amount = $request->get('fine');
            $installmentHistory->total_amount = $totalRequiredAmount;
            $installmentHistory->created_by = Auth::user()->id;
            $installmentHistory->payment_method = $request->get('payment_method');
            $installmentHistory->comment = $request->get('comment');
            $installmentHistory->save();


            $clientPaymentHistory = new ClientPaymentHistory();
            $clientPaymentHistory->user_id = $societySales->sold_to_id;
            $clientPaymentHistory->created_by = Auth::user()->id;
            $clientPaymentHistory->amount = $request->get('amount');
            $clientPaymentHistory->society_id = $societySales->society_id;
            $clientPaymentHistory->months = $request->get('months');
            $clientPaymentHistory->method = $request->get('payment_method');
            $clientPaymentHistory->data_array = $request->get('data_array');
            $clientPaymentHistory->save();

            return back()->with('success', 'Installment Updated Successfully');

        }else{
            return back()->with('error', 'Unknown Error Occurred');
        }
    }
}
