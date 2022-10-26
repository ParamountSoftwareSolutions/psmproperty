<?php

namespace App\Http\Controllers\Society;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ClientPlot;
use App\Models\SocietyInstallmentData;
use App\Models\SocietyLead;
use App\Models\SocietySale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeadController extends Controller
{
    //

    private $activePage;
    public function __construct(){
        $this->activePage = "leads";
    }

    public function index(){
        $society = Auth::user()->Society;
        if($society == null){
            $society = Auth::user()->Employee->Society;
        }
        $societyCategories = $society->CategoryData;
            $leads = $society->Leads;
        return view('society.leads.index', array('activePage' => $this->activePage, 'leads' => $leads, 'societyCategories' => $societyCategories));
    }

    public function matureLeads(){
        $society = Auth::user()->Society;
        if($society == null){
            $society = Auth::user()->Employee->Society;
        }
        $societyCategories = $society->CategoryData;
        $leads = $society->Leads;
        return view('society.leads.mature', array('activePage' => $this->activePage, 'leads' => $leads, 'societyCategories' => $societyCategories));
    }

    public function store(Request $request){

        $society = Auth::user()->Society;
        if($society == null){
            $society = Auth::user()->Employee->Society;
        }

        $lead = new SocietyLead();
        $lead->first_name = $request->get('first_name');
        $lead->last_name = $request->get('last_name');
        $lead->phone_number	 = $request->get('phone_number');
        $lead->address = $request->get('address');
        $lead->created_by = \auth()->user()->id;
        $lead->society_id = $society->id;
        $lead->comment = $request->get('comments');
        $lead->save();

        return back()->with('success', 'Lead Created Successfully');

    }

    public function makeClient(Request $request){


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

        $customer = new User();
        $customer->username = $request->get('first_name')."_".$request->get('last_name');
        $customer->email = $request->get('email');
        $customer->phone_number = $request->get('phone_number');
        $customer->password = $request->get('password');
        $customer->save();

        $lead = SocietyLead::find($request->get('lead_id'));
        if($lead != null){
            $lead->user_id = $customer->id;
            $lead->is_client = 0;
            $lead->save();
        }



        $client = Client::where('user_id', $customer->id)->first();
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
        $societySales->possession_fee=  $possessionFee;
        $societySales->belting_fee = $beltingFee;
        $societySales->down_payment = $downPayment;

        $societySales->sold_to_id = $customer->id;
        $societySales->registration_number = $registrationNumber;
        $societySales->hidden_file_number = Auth::user()->Society->id.$salesCategoryId;


        $societySales->save();

        //save client plot details
        $clientPlot = new ClientPlot();
        $clientPlot->user_id = $customer->id;
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
}


