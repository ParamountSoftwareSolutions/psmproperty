<?php
namespace App\Http\Controllers\PropertyManager;

use App\Helpers\Helpers;
use App\Helpers\NotificationHelper;
use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\BuildingCustomer;
use App\Models\BuildingEmployee;
use App\Models\BuildingMobileApplication;
use App\Models\BuildingPaymentPlan;
use App\Models\BuildingSale;
use App\Models\BuildingSaleInstallment;
use App\Models\BuildingSaleHistory;
use App\Models\Floor;
use App\Models\FloorDetail;
use App\Models\PropertySale;
use App\Models\User;
use App\Models\Country;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PHPUnit\TextUI\Help;
use Rap2hpoutre\FastExcel\FastExcel;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $building = Helpers::building_detail();
        $sales_details = BuildingSale::with('building_sale_history')->whereIn('building_id', $building->pluck('id')->toArray());
        if (Auth::user()->hasRole('sale_person')) {
            $sales_details->where('user_id', Auth::id());
        }
        $sales = $sales_details->where(['order_type' => 'lead'])->orderBy('id', 'desc')->get();
        $sale_person = Helpers::sales_person();
        $sale_manager = Helpers::sales_manager();
        $payment_plan = BuildingPaymentPlan::where('property_admin_id', Helpers::user_admin())->get();
        $sales_count_data = BuildingSale::whereIn('building_id', Helpers::building_detail()->pluck('id')->toArray())->where(['order_type' => 'lead']);
        if (Auth::user()->hasRole('sale_person')) {
            $sales_count_data->where('user_id', Auth::id());
        }
        $sales_count_data = $sales_count_data->get();
        $salesCount = BuildingSaleHistory::selectRaw('building_sale_id, COUNT(building_sale_id) as "total"')
            ->whereIn('building_sale_id', $sales_count_data->pluck('id')->toArray())->where('data->status', 'arrange_meeting')->where('data->date', '>=', Carbon::now()->format('Y-m-d'))
            ->groupBy('building_sale_id')
            ->get();

        $arrange_data = [];
        $pushed_data = [];
        foreach ($salesCount as $key => $val) {
            if ($val->total == 1) {
                $arrange_data[] = $val->building_sale_id;
            } else {
                $pushed_data[] = $val->building_sale_id;
            }
        }
        $arrange = count($arrange_data);
        $pushed = count($pushed_data);
        // dd($arrange,$salesCount);
        return view('property_manager.sale.lead.index', compact('sales', 'building', 'sale_person', 'payment_plan', 'arrange', 'pushed', 'sale_manager'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $country = Country::get();
        $sale_person = Helpers::sales_person();
        $building = Helpers::building_detail();
        return view('property_manager.sale.lead.create', compact('building', 'country', 'sale_person'));
    }

    public function building($panel, $id)
    {
        $building = Helpers::building_detail_single($id);
        $floor = Floor::whereIn('id', json_decode($building->floor_list))->get();
        return json_encode($floor);
    }

    public function floor($panel, $id, $building_id)
    {
        $floor = Floor::where('id', $id)->first();
        $floor_detail = FloorDetail::where(['floor_id' => $floor->id, 'building_id' => $building_id])->where('status', 'available')->get();
        return json_decode($floor_detail);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'building_id' => 'required',
            'interested_in' => 'required',
            'source' => 'required',
            'name' => 'required',
            'phone_number' => 'required|unique:users',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->first()]);
        }
        if (isset($request->email)) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|unique:users,email',
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'message' => $validator->errors()->first()]);
            }
        }
        if (isset($request->cnic)) {
            $validator = Validator::make($request->all(), [
                'cnic' => 'required|unique:users,cnic',
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'message' => $validator->errors()->first()]);
            }
        }

        /*if (Auth::user()->roles[0]->name !== 'employee') {
            $validator = Validator::make($request->all(), [
                'sale_person_id' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'message' => $validator->errors()->first()]);
            }
        }*/
        if ($request->status == 'mature') {
            $validator = Validator::make($request->all(), [
                'floor_detail_id' => 'required',
                'status' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'message' => $validator->errors()->first()]);
            }
        }
        $data['cnic'] = $request->cnic;
        $data['email'] = $request->email;
        $data['phone_number'] = $request->phone_number;
        $data['username'] = $request->name;
        $data['father_name'] = $request->father_name;
        $data['address'] = $request->address;
        $data['password'] = $request->password;
        $data['alt_phone'] = $request->alt_phone;
        $data['dob'] = $request->dob;
        $data['country_id'] = $request->country_id;
        $data['state_id'] = $request->state_id;
        $data['city_id'] = $request->city_id;
        $building = Helpers::building_detail();
        $sale = Helpers::sale_and_customer($request, $building, 'lead', $data);
        if ($sale) {
            NotificationHelper::web_panel_notification('lead_add', 'sale_id', $sale['sale']['id']);
            return response()->json(['status' => 'success', 'message' => 'Property Sale Lead Create Successfully']);
        }

        return response()->json(['status' => 'error', 'message' => 'Something Went Wrong....']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($panel, $id)
    {
        /*Ali code*/
        /*$country = Country::get();
        $building = Helpers::building_detail();
        $building_sale = BuildingSale::whereIn('building_id', $building->pluck('id')->toArray());
        if (Auth::user()->roles[0]->name == 'sale_person') {
            $building_sale->where('user_id', Auth::id());
        }
        $building_sale = $building_sale->findOrFail($id);
        $single_building = Helpers::building_detail_single($building_sale->building_id);
        $floor_detail = FloorDetail::where('building_id', $single_building->id)->get();
        $sales_person = Helpers::sales_person();*/

        /*Shabaz code*/
        $country = Country::get();
        $building = Helpers::building_detail();
        $building_sale = BuildingSale::whereIn('building_id', $building->pluck('id')->toArray());
        if (Auth::user()->roles[0]->name == 'sale_person') {
            $building_sale->where('user_id', Auth::id());
        }
        $building_sale = $building_sale->find($id);

        if (empty($building_sale)) {
            $building_sale = BuildingSale::whereIn('building_id', $building->pluck('id')->toArray())->first();
            // $single_building = Helpers::building_detail_single($building_sale->building_id);
            // $floor_detail = FloorDetail::where('building_id', $single_building->id)->get();
            $floor_detail = [];
            //Change Sale Person For Property Manager To All For Property Manager Only
            if (Auth::user()->hasRole("property_manager")) {
                $sales_person = User::with('building_employee')
                    ->whereHas('roles', function ($q) {
                        $q->where('name', 'sale_person');
                        $q->orWhere('name', 'sale_manager');
                    })->get();
            } else {
                $sales_person = Helpers::sales_person();
            }
            $building_sale = BuildingSale::with('customer')->where('id', $id)->first();
        } else {
            $single_building = Helpers::building_detail_single($building_sale->building_id);
            $floor_detail = FloorDetail::where('building_id', $single_building->id)->get();
            //Change Sale Person For Property Manager To All For Property Manager Only
            if (Auth::user()->hasRole("property_manager")) {
                $sales_person = User::with('building_employee')
                    ->whereHas('roles', function ($q) {
                        $q->where('name', 'sale_person');
                        $q->orWhere('name', 'sale_manager');
                    })->get();
            } else {
                $sales_person = Helpers::sales_person();
            }
        }
        return view('property_manager.sale.lead.edit', compact('building_sale', 'floor_detail', 'building_sale', 'building', 'sales_person', 'country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $panel, $id)
    {
        $sale = BuildingSale::findOrFail($id);
        $user = User::findOrFail($sale->customer_id);
        $validator = Validator::make($request->all(), [
            'building_id' => 'required',
            'interested_in' => 'required',
            'source' => 'required',
            'name' => 'required',
            'phone_number' => 'required|unique:users,phone_number,' . $user->id,
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->first()]);
        }
        if (isset($request->email) && $request->email !== null) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|unique:users,email,' . $user->id,
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'message' => $validator->errors()->first()]);
            }
        }
        if (isset($request->cnic) && $request->cnic !== null) {
            $validator = Validator::make($request->all(), [
                'cnic' => 'required|unique:users,cnic,' . $user->id,
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'message' => $validator->errors()->first()]);
            }
        }
        if ($request->filled('cnic')) {
            $data['cnic'] = $request->cnic;
        }
        if ($request->filled('email')) {
            $data['email'] = $request->email;
        }
        if ($request->filled('phone_number')) {
            $data['phone_number'] = $request->phone_number;
        }
        if ($request->filled('name')) {
            $data['username'] = $request->name;
        }
        if ($request->filled('father_name')) {
            $data['father_name'] = $request->father_name;
        }
        if ($request->filled('address')) {
            $data['address'] = $request->address;
        }
        if ($request->filled('password')) {
            $data['password'] = $request->password;
        }
        if ($request->filled('alt_phone')) {
            $data['alt_phone'] = $request->alt_phone;
        }
        if ($request->filled('dob')) {
            $data['dob'] = $request->dob;
        }
        if ($request->filled('country_id')) {
            $data['country_id'] = $request->country_id;
        }
        if ($request->filled('state_id')) {
            $data['state_id'] = $request->state_id;
        }
        if ($request->filled('city_id')) {
            $data['city_id'] = $request->city_id;
        }
        $building = Helpers::building_detail_single($request->building_id);
        $sale = Helpers::sale_and_customer($request, $building, 'lead', $data, $id);
        NotificationHelper::web_panel_notification('lead_update', 'sale_id', $sale['sale']['id']);
        if ($sale) {
            //  NotificationHelper::web_panel_notification('lead_update');
            return response()->json(['status' => 'success', 'message' => 'Property Sale Lead Update Successfully']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($panel, $id)
    {
        $sale = BuildingSale::findOrFail($id);
        $sale->delete();
        User::find($sale->customer_id)->forceDelete();
        $floor_detail = FloorDetail::where('id', $sale->floor_detail_id)->first();
        if ($floor_detail !== null) {
            $floor_detail->status = 'available';
            $floor_detail->save();
        }

        if ($sale) {
            return response()->json(['status' => 'success', 'message' => 'Property Sale Lead Delete Successfully']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Property Sale Lead Receipt Delete Error']);
        }
    }

    public function lead_assign(Request $request)
    {
        if ($request->sale_id !== null) {
            //Ali
            //            $assign_lead = BuildingSale::where(['order_type' => 'lead'])->whereIn('id', explode(',', $request->sale_id))
            //                ->update([
            //                    'user_id' => $request->sale_person_id,
            //                ]);
            //shahbaz
            $assign_lead = BuildingSale::whereIn('id', explode(',', $request->sale_id))
                ->update([
                    'user_id' => $request->sale_person_id,
                ]);
            if ($assign_lead) {
                return redirect()->route('property_manager.sale.lead.index', (new Helpers)->user_login_route()['panel'])->with($this->message('Lead Assign Updated Successfully', 'success'));
            } else {
                return redirect()->route('property_manager.sale.lead.index', (new Helpers)->user_login_route()['panel'])->with($this->message('Lead Assign Error', 'error'));
            }
        } else {
            return redirect()->route('property_manager.sale.lead.index', (new Helpers)->user_login_route()['panel'])->with($this->message('Please select first any lead', 'error'));
            return redirect()->back()->with($this->message('Please select first any lead', 'error'));
        }
    }

    public function filter(Request $request)
    {

        $sales_person = $request->sales_person;
        $status = $request->status;
		   if ($status == 'unassigned') {
            $unassigned = $request->status;
        }else{
            $unassigned = ""; 
        }
        $filter_date = $request->filter_date;
        $building = Helpers::building_detail()->pluck('id')->toArray();
        //shahbaz
        $fb_lead = $request->fb_lead;
        $sales_manager = $request->sales_manager;

        //shahbaz
        //shahbaz
        if ($sales_manager) {
			
            $sales = BuildingSale::with('customer')->whereIn('order_type',['facebook' , 'lead'])->where('user_id', $request->sales_manager);
            // if (Auth::user()->hasRole('sale_manager')) {
            //     $sales->where('user_id', Auth::id());
            // }
            $sales = $sales->get();
        }
        //shahbaz
        if ($sales_person) {
            $sales = BuildingSale::with('customer')->whereIn('building_id', $building)->where(['order_type' => 'lead'])->where('user_id', $request->sales_person);
            if (Auth::user()->hasRole('sale_person')) {
                $sales->where('user_id', Auth::id());
            }
            $sales = $sales->get();
        }
		    if ($unassigned) {
          
            $sales = BuildingSale::with('customer')->whereIn('building_id', $building)->where('user_id', Null);
            if (Auth::user()->hasRole('sale_person')) {
                $sales->where('user_id', Auth::id());
            }
            $sales = $sales->get();
           
        }
        if ($status != "unassigned" && $status != "") {
            $sales = BuildingSale::with('customer')->whereIn('building_id', $building)->where(['order_type' => 'lead'])->where('order_status', $request->status);
            if (Auth::user()->hasRole('sale_person')) {
                $sales->where('user_id', Auth::id());
            }
            $sales = $sales->get();
           
        }
    
        //shahbaz
        if ($fb_lead) {
            $sales = BuildingSale::with('customer')->where(['order_type' => 'facebook'])->orderBy('id', 'desc');

            if (Auth::user()->hasRole('sale_person')) {
                $sales->where('user_id', Auth::id());
            }
            if (Auth::user()->hasRole('sale_manager')) {
                $sales->where('user_id', Auth::id());
            }
            $sales = $sales->get();
        }
        //shahbaz
        if ($filter_date) {
            $current_date = Carbon::now();
            if ($filter_date == 'today') {
                $sales = BuildingSale::with('customer')->whereIn('building_id', $building)->where(['order_type' => 'lead'])->whereDate('created_at', $current_date);
                if (Auth::user()->hasRole('sale_person')) {
                    $sales->where('user_id', Auth::id());
                }
                $sales = $sales->get();
            } else if ($filter_date == 'yesterday') {
                $date = Carbon::now()->subDay();
                $sales = BuildingSale::with('customer')->whereIn('building_id', $building)->where(['order_type' => 'lead'])->whereDate('created_at', $date);
                if (Auth::user()->hasRole('sale_person')) {
                    $sales->where('user_id', Auth::id());
                }
                $sales = $sales->get();
            } else if ($filter_date == 'this_week') {
                $date = Carbon::now()->subDays(7);
                $sales = BuildingSale::with('customer')->whereIn('building_id', $building)->where(['order_type' => 'lead'])->whereBetween('created_at', [$date, $current_date]);
                if (Auth::user()->hasRole('sale_person')) {
                    $sales->where('user_id', Auth::id());
                }
                $sales = $sales->get();
            } else if ($filter_date == 'this_month') {
                $month = Carbon::now()->format('m');
                $year = Carbon::now()->format('Y');

                $sales = BuildingSale::with('customer')->whereIn('building_id', $building)->where(['order_type' => 'lead'])->whereMonth('created_at', $month)->whereYear('created_at', $year);
                if (Auth::user()->hasRole('sale_person')) {
                    $sales->where('user_id', Auth::id());
                }
                $sales = $sales->get();
            } else {
                $last_month = Carbon::now()->subMonth();
                $month = $last_month->format('m');
                $year = $last_month->format('Y');
                $sales = BuildingSale::with('customer')->whereIn('building_id', $building)->where(['order_type' => 'lead'])->whereMonth('created_at', $month)->whereYear('created_at', $year);
                if (Auth::user()->hasRole('sale_person')) {
                    $sales->where('user_id', Auth::id());
                }
                $sales = $sales->get();
            }
        }
        $sale_person = Helpers::sales_person();
        $sale_manager = Helpers::sales_manager();
        //ali
        //        $salesCount = BuildingSale::with('building_sale_history')->where('building_id', $building)->where(['order_type' => 'lead'])
        //            ->whereHas('building_sale_history', function ($q) {
        //                $q->where('data->status', 'arrange_meeting');
        //                $q->where('data->date', '>=', Carbon::now()->format('Y-m-d'));
        //            });
        //ali
        //shahbaz
        $sales_count_data = BuildingSale::whereIn('building_id', Helpers::building_detail()->pluck('id')->toArray())->where(['order_type' => 'lead']);
        if (Auth::user()->hasRole('sale_person')) {
            $sales_count_data->where('user_id', Auth::id());
        }
        $sales_count_data = $sales_count_data->get();
        $salesCount = BuildingSaleHistory::selectRaw('building_sale_id, COUNT(building_sale_id) as "total"')
            ->whereIn('building_sale_id', $sales_count_data->pluck('id')->toArray())->where('data->status', 'arrange_meeting')->where('data->date', '>=', Carbon::now()->format('Y-m-d'))
            ->groupBy('building_sale_id')
            ->get();

        $arrange_data = [];
        $pushed_data = [];
        foreach ($salesCount as $key => $val) {
            if ($val->total == 1) {
                $arrange_data[] = $val->building_sale_id;
            } else {
                $pushed_data[] = $val->building_sale_id;
            }
        }
        $arrange = count($arrange_data);
        $pushed = count($pushed_data);

        return view('property_manager.sale.lead.index', compact('sales', 'building', 'sale_person', 'arrange', 'pushed', 'sale_manager'));
    }
    //ali
    //    public function search(Request $request)
    //    {
    //        $id = $request->id;
    //        $name = $request->name;
    //        $country = $request->country;
    //        $number = $request->number;
    //
    //        $building = Helpers::building_detail();
    //
    //        if (!($id) && !($name) && !($country) && !($number)) {
    //            $sales = BuildingSale::with('customer')->whereIn('building_id', $building)->where(['order_type' => 'lead']);
    //        } else {
    //            $sales = BuildingSale::with('floor_detail', 'customer')
    //                ->whereIn('building_id', $building->pluck('id')->toArray())
    //                ->where('order_type', 'lead');
    //            if($id){
    //                $sales->whereHas('floor_detail', function ($q) use ($id) {
    //                    $q->where('unit_id', $id);
    //                });
    //            }
    //            if($name || $number || $country){
    //                $sales->whereHas('customer', function ($q) use ($name, $number, $country) {
    //                    if ($name) {
    //                        $q->where('username', $name);
    //                    }
    //                    if ($number) {
    //                        $q->where('phone_number', $number);
    //                    }
    //                    if ($country) {
    //                        $country_id = Country::where('name',$country)->first()->id;
    //                        $q->where('country_id', $country_id);
    //                    }
    //                });
    //            }
    //
    //        }
    //        $sales = $sales->get();
    //        $sale_person = Helpers::sales_person();
    //        $salesCount = BuildingSale::with('building_sale_history')->whereIn('building_id', $building->pluck('id')->toArray())->where(['order_type' => 'lead'])
    //            ->whereHas('building_sale_history', function ($q) {
    //                $q->where('data->status', 'arrange_meeting');
    //                $q->where('data->date', '>=', Carbon::now()->format('Y-m-d'));
    //            })->get();
    //        $arrange = 0;
    //        $pushed = 0;
    //        foreach ($salesCount as $val) {
    //            if ($val->building_sale_history->count() == '1') {
    //                $arrange++;
    //            }
    //            if ($val->building_sale_history->count() > '1') {
    //                $pushed++;
    //            }
    //        }
    //        return view('property_manager.sale.lead.index', compact('sales', 'building', 'sale_person', 'arrange', 'pushed'));
    //    }
    //shahbaz
    public function search(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $country = $request->country;
        $number = $request->number;

        $building = Helpers::building_detail();

        if (!($id) && !($name) && !($country) && !($number)) {
            // $sales = BuildingSale::with('customer')->whereIn('building_id', $building)->where(['order_type' => 'lead']);
            $sales = BuildingSale::with('floor_detail', 'customer')
             ->whereIn('building_id', $building->pluck('id')->toArray())
             ->where('order_type', 'lead');
			 if (Auth::user()->hasRole('sale_person')) {
                $sales->where('user_id', Auth::id());
            }
        } else {
            $sales = BuildingSale::with('floor_detail', 'customer')
             ->whereIn('building_id', $building->pluck('id')->toArray())
             ->where('order_type', 'lead');
		
           // $sales = BuildingSale::with('floor_detail', 'customer');
            if ($id) {
                $sales->whereHas('floor_detail', function ($q) use ($id) {
                    $q->where('unit_id', $id);
                });
            }
            if ($name || $number || $country) {
                $sales->whereHas('customer', function ($q) use ($name, $number, $country) {
                    if ($name) {
                        $q->where('username', $name);
                    }
                    if ($number) {
                        $q->where('phone_number', $number);
                    }
                    if ($country) {
                        $country_id = Country::where('name', $country)->first()->id;
                        $q->where('country_id', $country_id);
                    }
                });
            }
            if (Auth::user()->hasRole('sale_person')) {
            	$sales->where('user_id', Auth::id());
        	}
        }
        $sales = $sales->get();
        $sale_person = Helpers::sales_person();
        $sale_manager = Helpers::sales_manager();
        $sales_count_data = BuildingSale::whereIn('building_id', $building->pluck('id')->toArray())->where(['order_type' => 'lead']);
        if (Auth::user()->hasRole('sale_person')) {
            $sales_count_data->where('user_id', Auth::id());
        }
        $sales_count_data = $sales_count_data->get();
        $salesCount = BuildingSaleHistory::selectRaw('building_sale_id, COUNT(building_sale_id) as "total"')
            ->whereIn('building_sale_id', $sales_count_data->pluck('id')->toArray())->where('data->status', 'arrange_meeting')->where('data->date', '>=', Carbon::now()->format('Y-m-d'))
            ->groupBy('building_sale_id')
            ->get();

        $arrange_data = [];
        $pushed_data = [];
        foreach ($salesCount as $key => $val) {
            if ($val->total == 1) {
                $arrange_data[] = $val->building_sale_id;
            } else {
                $pushed_data[] = $val->building_sale_id;
            }
        }
        $arrange = count($arrange_data);
        $pushed = count($pushed_data);

        return view('property_manager.sale.lead.index', compact('sales', 'building', 'sale_person', 'arrange', 'pushed', 'sale_manager'));
    }

    public function searchByDate(Request $request)
    {
        $building = Helpers::building_detail();
        $from = $request->from;
        $to = $request->to;
        if (!($from) || !($to)) {
            return redirect()->route('property_manager.sale.lead.index', url((new Helpers)->user_login_route()['panel']))->with($this->message('Invalid Date Selected', 'error'));
        } else {
            if ($from > $to) {
                return redirect()->route('property_manager.sale.lead.index', url((new Helpers)->user_login_route()['panel']))->with($this->message('Invalid Date Selected', 'error'));
            } else {
                $from = Carbon::parse($from);
                $to = Carbon::parse($to)->addDay();
                $sales = BuildingSale::with('customer')->whereIn('building_id', $building->pluck('id')->toArray())->where(['order_type' => 'lead'])->whereBetween('created_at', [$from, $to]);
                if (Auth::user()->hasRole('sale_person')) {
                    $sales->where('user_id', Auth::id());
                }
                $sales = $sales->get();
                $sale_person = Helpers::sales_person();
                $sale_manager = Helpers::sales_manager();
                $sales_count_data = BuildingSale::whereIn('building_id', $building->pluck('id')->toArray())->where(['order_type' => 'lead']);
                if (Auth::user()->hasRole('sale_person')) {
                    $sales_count_data->where('user_id', Auth::id());
                }
                $sales_count_data = $sales_count_data->get();
                $salesCount = BuildingSaleHistory::selectRaw('building_sale_id, COUNT(building_sale_id) as "total"')
                    ->whereIn('building_sale_id', $sales_count_data->pluck('id')->toArray())->where('data->status', 'arrange_meeting')->where('data->date', '>=', Carbon::now()->format('Y-m-d'))
                    ->groupBy('building_sale_id')
                    ->get();

                $arrange_data = [];
                $pushed_data = [];
                foreach ($salesCount as $key => $val) {
                    if ($val->total == 1) {
                        $arrange_data[] = $val->building_sale_id;
                    } else {
                        $pushed_data[] = $val->building_sale_id;
                    }
                }
                $arrange = count($arrange_data);
                $pushed = count($pushed_data);

                return view('property_manager.sale.lead.index', compact('sales', 'building', 'sale_person', 'arrange', 'pushed', 'sale_manager'));
            }
        }
    }

    public function changeStatus(Request $request)
    {
        $sale = BuildingSale::find($request->id);
        if (empty($sale->building_id) && empty($sale->floor_detail_id)) {
            return response()->json(['status' => 'error', 'message' => 'Update Building First']);
        }
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'comment' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->first()]);
        }
        $sale = BuildingSale::find($request->id);
        if ($request->status == 'mature') {
            $sale->order_type = "sale";
            if ($sale->floor_detail_id !== null) {
                FloorDetail::where('id', $sale->floor_detail_id)->update(['status' => 'hold']);
            }
        }
		 $sale->updated_at = Carbon::parse($request->date)->format('Y-m-d H:i:s');
        $sale->order_status = $request->status;
        $sale->update();

        $data = [
             'date' => Carbon::parse($request->date)->format('Y-m-d H:i:s'),
            //'comment' => $request->comment,
            'status' => $request->status,
			'user_id' => Auth::user()->id,
        ];
        if($request->status == 'arrange_meeting' || $request->status == 'follow_up'){
			    $old_histories = BuildingSaleHistory::where('building_sale_id',$request->id)->get();
            foreach($old_histories as $his){
                $old_data = json_decode($his->data);
                $old_data->is_read = 1;
                $his->data = json_encode($old_data);
                $his->save();
            }
            $data['is_read'] = 0;
        }
        $history = new BuildingSaleHistory;
        $history->building_sale_id = $request->id;
        $history->key = 'lead';
		 $history->comment = $request->comment;
        $history->data = json_encode($data);
        $history->save();
		if ($request->status == 'follow_up') {
            $key = 'lead_follow_up';
        }  elseif ($request->status == 'arrange_meeting') {
            $key = 'lead_discussion';
        } elseif ($request->status == 'meet_client') {
            $key = 'lead_negotiation';
        } elseif ($request->status == 'mature') {
            $key = 'lead_mature';
        } elseif ($request->status == 'lost') {
            $key = 'lead_lost';
        } else {
            $key = null;
        }
        NotificationHelper::web_panel_notification($key, 'sale_id', $sale->id);
        if ($sale && $history) {
            return response()->json(['status' => 'success', 'message' => 'Status Updated Successfully']);
        }
    }

    public function changePriority($panel, $priority, $id)
    {
        $sale = BuildingSale::find($id);
        if (empty($sale->building_id) && empty($sale->floor_detail_id)) {
            return redirect()->route('property_manager.sale.lead.index', (new Helpers)->user_login_route()['panel'])->with($this->message('Update Building First', 'error'));
        }
        $building = Helpers::building_detail()->pluck('id')->toArray();
        $sale = BuildingSale::whereIn('building_id', $building)->findOrFail($id);
        $sale->priority = $priority;
        $sale->update();

        if ($sale) {
            return redirect()->route('property_manager.sale.lead.index', (new Helpers)->user_login_route()['panel'])->with($this->message('Priority Updated Successfully', 'success'));
        }
    }

    public function buildingInfo($panel, $building_id)
    {
        $building = Helpers::building_detail_single($building_id);
        $building_employee = User::with('building_employee')
            ->whereHas('roles', function ($q) {
                $q->where('name', 'sale_person');
            })
            ->whereHas('building_employee', function ($q) use ($building_id) {
                $q->where('building_id', $building_id);
            })
            ->where('property_admin_id', Helpers::user_admin())->get();
        $data = [
            'types' => json_decode($building->type),
            'sales_person' => $building_employee
        ];
        return $data;
    }

    public function comments($panel, $id)
    {
        $comments = BuildingSaleHistory::where('building_sale_id', $id)->where('key', 'lead')->get();
		
        return view('property_manager.sale.lead.comments', compact('comments'));
    }

    public function import_view()
    {
        return view('property_manager.sale.bulk_import');
    }

    public function bulk_import_data(Request $request)
    {
        try {
            $collections = (new FastExcel)->import($request->file('leads_file'));
        } catch (\Exception $exception) {
            return back()->with($this->message('You have uploaded a wrong format file, please upload the right file.', 'error'));
        }

        foreach ($collections as $key => $collection) {
            $user = User::where('phone_number', $collection['phone_number'])->first();
            if (!is_numeric($collection['building_id'])) {
                return back()->with($this->message('Please fill row ' . ($key + 2) . ' must be number, field: building_id', 'error'));
            } elseif ($collection['interested_in'] === "") {
                return back()->with($this->message('Please fill row:' . ($key + 2) . ' field: interested_in', 'error'));
            } elseif ($collection['source'] === "") {
                return back()->with($this->message('Please fill row:' . ($key + 2) . ' field: source', 'error'));
            } elseif (!is_numeric($collection['sale_person_id'])) {
                return back()->with($this->message('Please fill row:' . ($key + 2) . ' field: sale_person_id', 'error'));
            } elseif ($collection['username'] === "") {
                return back()->with($this->message('Please fill row:' . ($key + 2) . ' field: username', 'error'));
            } elseif ($collection['phone_number'] === "") {
                return back()->with($this->message('Please fill row:' . ($key + 2) . ' field: phone_number!', 'error'));
            }
        }
        $data = [];
        $data2 = [];
        $data3 = [];
        $data4 = [];

        //$property_admin_id = Building::where('manager_id', Auth::id())->first()->user_id;
        foreach ($collections as $key => $collection) {
            if ($collection['id'] == "") {
                $user = User::where('phone_number', $collection['phone_number'])->first();
                if ($user == null) {
                    $user = User::create([
                        'username' => $collection['username'],
                        'phone_number' => $collection['phone_number'],
                    ]);
                    BuildingSale::create([
                        'building_id' => $collection['building_id'],
                        //                        'user_id' => $property_admin_id,
                        'customer_id' => $user->id,
                        'interested_in' => $collection['interested_in'],
                        'source' => $collection['source'],
                    ]);
                } else {
                    $user->update([
                        'username' => $collection['username'],
                        'phone_number' => $collection['phone_number'],
                    ]);
                    BuildingSale::where('customer_id', $user->id)->update([
                        'building_id' => $collection['building_id'],
                        //'user_id' => $property_admin_id,
                        'customer_id' => $user->id,
                        'interested_in' => $collection['interested_in'],
                        'source' => $collection['source'],
                    ]);
                }
            } else {
                BuildingSale::where('id', $collection['id'])->update([
                    'id' => $collection['id'],
                    'building_id' => $collection['building_id'],
                    //'property_admin_id' => $property_admin_id,
                    'interested_in' => $collection['interested_in'],
                    'source' => $collection['source'],
                ]);
                $customer_id = BuildingSale::where('id', $collection['id'])->first()->customer_id;
                User::where('id', $customer_id)->update([
                    'username' => $collection['username'],
                    'phone_number' => $collection['phone_number'],
                ]);
            }
        }
        return back()->with($this->message('Leads imported successfully!', 'success'));
    }

    public function bulk_export_data()
    {
        $building = Helpers::building_detail();
        $sales = BuildingSale::with('customer')->whereIn('building_id', $building->pluck('id')->toArray());
        if (Auth::user()->hasRole('sale_person')) {
            $sales->where('user_id', Auth::id());
        }
        $sales = $sales->where(['order_type' => 'lead'])->orWhere(['order_type' => 'facebook'])->get();
        // $sales = $sales->where(['order_type' => 'lead'])->get();
        $storage = [];
        foreach ($sales as $item) {
            $storage[] = [
                'id' => $item['id'],
                'building_id' => $item['building_id'],
                'interested_in' => $item['interested_in'],
                'source' => $item['source'],
                'sale_person_id' => $item['user_id'],
                'username' => $item['customer']['username'],
                'phone_number' => $item['customer']['phone_number'],
            ];
        }
        return (new FastExcel($storage))->download('/public/panel/assets/lead.xlsx');
    }

    public function pushed(Request $request)
    {
        $building = Helpers::building_detail();


        //        $sales = BuildingSale::with('building_sale_history')->whereIn('building_id', $building->pluck('id')->toArray())->where(['order_type' => 'lead'])
        //            ->whereHas('building_sale_history', function ($q) {
        //                $q->where('data->status', 'arrange_meeting');
        //                $q->where('data->date', '>=', Carbon::now()->format('Y-m-d'));
        //            })->get();
        $sale_person = Helpers::sales_person();
        $sale_manager = Helpers::sales_manager();
        $payment_plan = BuildingPaymentPlan::where('property_admin_id', Helpers::user_admin())->get();
        $sales_count_data = BuildingSale::whereIn('building_id', $building->pluck('id')->toArray())->where(['order_type' => 'lead']);
        if (Auth::user()->hasRole('sale_person')) {
            $sales_count_data->where('user_id', Auth::id());
        }
        $sales_count_data = $sales_count_data->get();
        $salesCount = BuildingSaleHistory::selectRaw('building_sale_id, COUNT(building_sale_id) as "total"')
            ->whereIn('building_sale_id', $sales_count_data->pluck('id')->toArray())->where('data->status', 'arrange_meeting')->where('data->date', '>=', Carbon::now()->format('Y-m-d'))
            ->groupBy('building_sale_id')
            ->get();

        $arrange_data = [];
        $pushed_data = [];
        foreach ($salesCount as $key => $val) {
            if ($val->total == 1) {
                $arrange_data[] = $val->building_sale_id;
            } else {
                $pushed_data[] = $val->building_sale_id;
            }
        }
        $arrange = count($arrange_data);
        $pushed = count($pushed_data);
 		$sales = BuildingSale::whereIn('id', $pushed_data)->where('order_status' , 'arrange_meeting');
        //$sales = BuildingSale::whereIn('id', $pushed_data);
        if (Auth::user()->hasRole('sale_person')) {
            $sales->where('user_id', Auth::id());
        }
        $sales = $sales->get();
	
        //dd($pushed, $pushed_data, $salesCount);

        return view('property_manager.sale.lead.index', compact('sales', 'building', 'sale_person', 'payment_plan', 'arrange', 'pushed', 'sale_manager'));
    }

    public function arrange(Request $request)
    {
        $building = Helpers::building_detail();
        //        $sales = BuildingSale::with('building_sale_history')->whereIn('building_id', $building->pluck('id')->toArray())->where(['order_type' => 'lead'])
        //            ->whereHas('building_sale_history', function ($q) {
        //                $q->where('data->status', 'arrange_meeting');
        //                $q->where('data->date', '>=', Carbon::now()->format('Y-m-d'));
        //            })->get();
        $sales_count_data = BuildingSale::whereIn('building_id', $building->pluck('id')->toArray())->where(['order_type' => 'lead']);
        if (Auth::user()->hasRole('sale_person')) {
            $sales_count_data->where('user_id', Auth::id());
        }
        $sales_count_data = $sales_count_data->get();
        $salesCount = BuildingSaleHistory::selectRaw('building_sale_id, COUNT(building_sale_id) as "total"')
            ->whereIn('building_sale_id', $sales_count_data->pluck('id')->toArray())->where('data->status', 'arrange_meeting')->where('data->date', '>=', Carbon::now()->format('Y-m-d'))
            ->groupBy('building_sale_id')
            ->get();

        $arrange_data = [];
        $pushed_data = [];
        foreach ($salesCount as $key => $val) {
            if ($val->total == 1) {
                $arrange_data[] = $val->building_sale_id;
            } else {
                $pushed_data[] = $val->building_sale_id;
            }
        }
        $arrange = count($arrange_data);
        $pushed = count($pushed_data);

        $sale_person = Helpers::sales_person();
        $sale_manager = Helpers::sales_manager();
        $payment_plan = BuildingPaymentPlan::where('property_admin_id', Helpers::user_admin())->get();
        //$sales = BuildingSale::whereIn('id', $arrange_data);
         $sales = BuildingSale::whereIn('id', $arrange_data)->where('order_status' , 'arrange_meeting');
		if (Auth::user()->hasRole('sale_person')) {
            $sales->where('user_id', Auth::id());
        }
        $sales = $sales->get();
		
        //        dd($arrange, $arrange_data);
        return view('property_manager.sale.lead.index', compact('sales', 'building', 'sale_person', 'payment_plan', 'arrange', 'pushed', 'sale_manager'));
    }

    public function isread(Request $request)
    {
        $meeting = BuildingSaleHistory::where('id', $request->id)->first();
        $status = json_decode($meeting->data)->is_read;
        $time = Carbon::parse(json_decode($meeting->data)->date)->format('h:i A');

        return response()->json(['status' => $status, 'time' => $time, 'id' => $meeting->id]);
    }

    public function meetingread(Request $request)
    {
        $meeting = BuildingSaleHistory::where('id', $request->id)->first();
        $data = json_decode($meeting->data);
        if ($data->is_read == 0) {
            $data->is_read = 1;
            $meeting->data = json_encode($data);
            $meeting->save();
        }
        return true;
    }
    //aLI
    //    public function followup()
    //    {
    //        $building = Helpers::building_detail();
    //        $current_date = Carbon::now();
    //        $sales = BuildingSale::with('customer')->whereIn('building_id', $building->pluck('id')->toArray())->where(['order_type' => 'lead'])->whereDate('created_at', $current_date)->get();
    //        $sale_person = Helpers::sales_person();
    //        $salesCount = BuildingSale::with('building_sale_history')->whereIn('building_id', $building->pluck('id')->toArray())->where(['order_type' => 'lead'])
    //            ->whereHas('building_sale_history', function ($q) {
    //                $q->where('data->status', 'arrange_meeting');
    //                $q->where('data->date', '>=', Carbon::now()->format('Y-m-d'));
    //            })->get();
    //        $arrange = 0;
    //        $pushed = 0;
    //        foreach ($salesCount as $val) {
    //            if ($val->building_sale_history->count() == '1') {
    //                $arrange++;
    //            }
    //            if ($val->building_sale_history->count() > '1') {
    //                $pushed++;
    //            }
    //        }
    //        return view('property_manager.sale.lead.index', compact('sales', 'building', 'sale_person', 'arrange', 'pushed'));
    //    }
    public function followup()
    {
        $building = Helpers::building_detail();
        $current_date = Carbon::now();
		
        $sales = BuildingSale::with('customer')->where(['order_status' => 'follow_up'])->whereHas('building_sale_history', function ($q) use ($current_date) {
            $q->whereDate('data->date', $current_date);
        });
		if (Auth::user()->hasRole('sale_person')) {
            $sales->where('user_id', Auth::id());
        }
		
        $sales = $sales->get();

        $sale_person = Helpers::sales_person();
        $sale_manager = Helpers::sales_manager();
        $sales_count_data = BuildingSale::whereIn('building_id', Helpers::building_detail()->pluck('id')->toArray())->where(['order_type' => 'lead']);
        if (Auth::user()->hasRole('sale_person')) {
            $sales_count_data->where('user_id', Auth::id());
        }
        $sales_count_data = $sales_count_data->get();
        $salesCount = BuildingSaleHistory::selectRaw('building_sale_id, COUNT(building_sale_id) as "total"')
            ->whereIn('building_sale_id', $sales_count_data->pluck('id')->toArray())->where('data->status', 'arrange_meeting')->where('data->date', '>=', Carbon::now()->format('Y-m-d'))
            ->groupBy('building_sale_id')
            ->get();

        $arrange_data = [];
        $pushed_data = [];
        foreach ($salesCount as $key => $val) {
            if ($val->total == 1) {
                $arrange_data[] = $val->building_sale_id;
            } else {
                $pushed_data[] = $val->building_sale_id;
            }
        }
        $arrange = count($arrange_data);
        $pushed = count($pushed_data);

        return view('property_manager.sale.lead.index', compact('sales', 'building', 'sale_person', 'arrange', 'pushed', 'sale_manager'));
    }
}
