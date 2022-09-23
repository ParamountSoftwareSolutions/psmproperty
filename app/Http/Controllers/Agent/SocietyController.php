<?php

namespace App\Http\Controllers\Agent;
use App\Http\Controllers\Controller;
use App\Models\AgentFileData;
use App\Models\AgentPropertyData;
use App\Models\AgentSalesData;
use App\Models\AgentSocietyData;
use App\Models\Client;
use App\Models\ClientPlot;
use App\Models\InstallmentPaymentHistory;
use App\Models\SocietyCategoryData;
use App\Models\SocietyInstallmentData;
use App\Models\SocietySale;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SocietyController extends Controller
{
    private $activePage;
    public function __construct(){
        $this->activePage = "societies";
    }

    public function index(){
        $societies = AgentSocietyData::where('agent_id', auth()->user()->id)->get();
        return view('agents.societies.index', array('societies'=> $societies, 'activePage' => $this->activePage));
    }


    public function view($id){
       $data = AgentSocietyData::find( $id);
        return view('agents.societies.view', array('activePage' => $this->activePage, 'agentSocietyData'=> $data));
    }

    public function checkPlotStatus(){
        // $_GET['reg_num']
        $societySales = AgentSalesData::where('complete_number', $_GET['reg_num'])->where('agent_id', auth()->user()->id)->first();
        if($societySales == null){
            return response()->json(['result'=>'false']);
        }else{
            return response()->json(['result'=>'true']);
        }
    }

    public function saleData($id){
        $agentSale = AgentSalesData::find($id);
        $societySale = $agentSale->SocietySales;

        $societyCategories = $agentSale->SocietySales->CategoryData;
        $statusPaid = Status::where('name', 'paid')->first();
        $installmentPaid = SocietyInstallmentData::where('society_sales_id', $societySale->$id)->where('status_id', $statusPaid->id)->get();

        return view('agents.societies.sales', array('activePage' => $this->activePage, 'societyCategories' => $societyCategories, 'societySale' => $societySale, 'installmentPaid' => $installmentPaid));

    }


    public function searchUser(){
        $user = User::where('username', $_GET['query'])->orWhere('email', $_GET['query'])->orWhere('phone_number', $_GET['query'])->first();
        if($user != null){
            return response()->json(['data' => ['code' => '200', 'user' => $user]]);
        }else{
            return response()->json(['data' => ['code' => '500', 'user' => null ]]);
        }
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

    public function history($start){
        $fileData = preg_split('/(?<=[0-9])(?=[a-z]+)/i',$start);
        $agentSales = AgentSalesData::where('agent_id', \auth()->user()->id)->where('file_number', $fileData[1])->get();

        return view('agents.societies.history', array('activePage' => $this->activePage, 'history' => $agentSales));
    }


    public function sale(Request $request){

        $salesCategoryId = $request->get('sale_category_id');
        $salesSizeId = $request->get('sale_size_id');
        $registrationNumber = $request->get('file_number');
        $processingFee = $request->get('processing_fee');
        $downPayment = $request->get('down_payment');
        $totalInstallment =$request->get('total_installment');
        $monthlyInstallments = $request->get('monthly_installment');
        $midTermInstallment = $request->get('mid_term_installment');
        $midTermPerYear = $request->get('mid_term_installment_per_year');
        $possessionFee = $request->get('possession_fee');
        $beltingFee = $request->get('belting_fee');
        $userType = $request->get('user_type');
        if($userType == 'new_customer'){
            $customer = new User();
            $customer->username = $request->get('username');
            $customer->email = $request->get('email');
            $customer->phone_number = $request->get('phone_number');
            $customer->password = $request->get('password');
            $customer->save();

        }
        else{
            $customer = User::find($request->get('user_id'));
        }

        $client = Client::where('user_id', $customer->id)->first();
        if($client == null){
            $client = new Client();
            $client->cnic = $request->get('user_cnic');
            $client->address  =$request->get('address');
            $client->user_id = $customer->id;
            $client->save();
        }
        $societySales = new SocietySale();
        $societySales->society_id = $request->get('society_id');
        $societySales->society_cat_data_id = $salesCategoryId;
        $societySales->created_by = Auth::user()->id;

        $societySales->plot_size = $request->get('plot_size');

        $societySales->total_installment = $totalInstallment;
        $societySales->processing_fee = $processingFee;
        $societySales->monthly_installments = $monthlyInstallments;
        $societySales->mid_term_installment = $midTermInstallment;
        $societySales->mid_term_per_year = $midTermPerYear;
        $societySales->possession_fee=  $possessionFee;
        $societySales->belting_fee = $beltingFee;
        $societySales->down_payment = $downPayment;

        $societySales->sold_to_id = $customer->id;
        $societySales->registration_number = $registrationNumber;
        $societySales->hidden_file_number = $request->get('society_id').$salesCategoryId;


        $societySales->save();

        //agent Sales Data

        $fileData = preg_split('/(?<=[0-9])(?=[a-z]+)/i',$registrationNumber);



        $agentSales = new AgentSalesData();
        $agentSales->agent_id = \auth()->user()->id;
        $agentSales->type = 1;
        $agentSales->sale_type = "society";
        $agentSales->file_number =
        $agentSales->complete_number = $registrationNumber;
        $agentSales->society_sales_id = $societySales->id;
        if(count($fileData) >= 1){
            $agentSales->number = $fileData[0];
            $agentSales->file_number = $fileData[1];
        }else{
            $agentSales->number = $registrationNumber;
            $agentSales->file_number = $registrationNumber;
        }

        $agentSales->save();


        //save client plot details
        $clientPlot = new ClientPlot();
        $clientPlot->user_id = $customer->id;
        $clientPlot->society_id = $request->get('society_id');
        $clientPlot->agent_id = Auth::user()->id;
        $clientPlot->plot_number = $registrationNumber;

        $clientPlot->plot_size = $request->get('sale_size_id');

        $clientPlot->plot_number = $registrationNumber;
        $clientPlot->save();

        //add instalment 'society_installment_data' details via loop...

        $totalInstallmentyears = $totalInstallment / 12;
        $midTerm = 12/$midTermPerYear; // 12/2 = 6

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

            return back()->with('success', 'Installment Updated Successfully');

        }else{
            return back()->with('error', 'Unknown Error Occurred');
        }
    }
}
