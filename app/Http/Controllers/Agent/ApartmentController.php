<?php
namespace App\Http\Controllers\Agent;
use App\Http\Controllers\Controller;
use App\Models\AgentApartment;
use App\Models\AgentApartmentDetail;
use App\Models\AgentApartmentInstallmentData;
use App\Models\AgentApartmentSales;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\AgentSalesData;
use Illuminate\Support\Facades\Auth;
class ApartmentController extends Controller
{
    private $activePage;
    public function __construct(){
        $this->activePage = "apartment";
    }
    public function index(){
        return view('agents.apartments.index', array('activePage' => $this->activePage));
    }
    public function getDetails($id){

        $agentApartment = AgentApartment::find($id);
        if($agentApartment != null){
            return view('agents.apartments.view', array('activePage' => $this->activePage, 'apartment' => $agentApartment));
        }
    }
    public function saleHistory($id){
        $agentApartmentDetails =AgentApartmentDetail::find($id);
        if($agentApartmentDetails != null) {
            return view('agents.apartments.history', array('activePage' => $this->activePage , 'apartmentDetail'=> $agentApartmentDetails) );
        }

    }
    public function insert(Request $request){
        $apartment = new AgentApartment();
        $apartment->user_id = auth()->user()->id;
        $apartment->title = $request->get('apartment_title');
        $apartment->location = $request->get('location');
        $apartment->address = $request->get('address');
        if( $request->hasFile( 'picture' ) ) {
            $file = $request->picture;
            $pic = $file->store('/', ['disk' => 'apartments']);
            $apartment->picture = $pic;
        }
        $apartment->save();
        return back()->with(["success" => "Apartment Added Successfully"]);
    }
    public function addFlats(Request $request){
        $flatDetail = new AgentApartmentDetail();
        $flatDetail->apartment_id = $request->get('apartment_id');
        $flatDetail->total_flats = $request->get('total_flats');
        $flatDetail->apartment_floor = $request->get('floor');
        $flatDetail->total_rooms = $request->get('rooms');
        $flatDetail->area = $request->get('area');
        $flatDetail->down_payment = $request->get('down_payment');
        $flatDetail->per_month_installment = $request->get('per_month_installment');
        $flatDetail->big_installment = $request->get('big_installment');
        $flatDetail->big_installment_per_year = $request->get('big_installment_per_year');
        $flatDetail->total_installments = $request->get('total_installments');
        $flatDetail->created_by = auth()->user()->id;
        $flatDetail->save();
        return back()->with(['success' => 'Flat Added Successfully']);
    }

    public function addInstallmentDetail(Request $request){
        $totalInstallment =$request->get('total_installment');
        $monthlyInstallments = $request->get('monthly_installment');
        $midTermInstallment = $request->get('mid_term_installment');
        $midTermPerYear = $request->get('mid_term_installment_per_year');
        $userType = $request->get('user_type');
        $user_id = null;
        if($userType == "new_customer"){
            $user = new User();
            //save all user fields
            $user->email = $request->get('email');
            $user->save();
            $user_id = $user->id;
        }else{
                $user_id = $request->get('user_id');
        }
        $agentSales = new AgentApartmentSales();
        $agentSales->user_id = $user_id;
        $agentSales->apartment_detail_id = $request->get('apartment_detail_id');
        $agentSales->created_by = auth()->user()->id;
        $agentSales->file_number = $request->get('file_number');
        $agentSales->save();

        //Installment details

        $midTerm = 12/$midTermPerYear; // 12/2 = 6

        for($i = 1; $i<= $totalInstallment; $i++){
            $agentApartmentInstallment = new AgentApartmentInstallmentData();
            $agentApartmentInstallment->apartment_sales_id = $agentSales->id;

            $month = date('Y-m-d', strtotime('+'.$i.'months'));

            if($i % $midTerm == 0){
                $agentApartmentInstallment->installment_amount = $midTermInstallment;
            }else{
                $agentApartmentInstallment->installment_amount = $monthlyInstallments;
            }
            $agentApartmentInstallment->status_id = 9;
            $agentApartmentInstallment->due_date = $month;
            $agentApartmentInstallment->created_by = Auth::user()->id;
            $agentApartmentInstallment->save();
        }
        return back();

    }



    public function getInstallmentDetails($id){
        $apartmentSales = AgentApartmentSales::find($id);

        return view('agents.apartments.installment', array('activePage' => $this->activePage, 'apartmentSales' => $apartmentSales));
    }

    public function updateInstallment(Request $request){
        $apartmentsales = AgentApartmentSales::find($request->get('apartment_sales_id')); //apartment sales
        if($apartmentsales != null){
            $statusPaid = Status::where('name', 'paid')->first();
            $months = $request->get('months');
            $totalRequiredAmount = 0;
            for($i = 0; $i < $months; $i++){
                $currentInstallment = AgentApartmentInstallmentData::where('apartment_sales_id', $apartmentsales->id)->where('status_id', 9)->first();
                $currentInstallment->status_id = $statusPaid->id;
                $currentInstallment->fine_amount = $request->get('fine');
                $totalRequiredAmount += $currentInstallment->installment_amount;
                $currentInstallment->save();
            }

            return back()->with('success', 'Installment Updated Successfully');

        }else{
            return back()->with('error', 'Unknown Error Occurred');
        }

    }
}
