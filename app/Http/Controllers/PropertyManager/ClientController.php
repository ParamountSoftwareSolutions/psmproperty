<?php

namespace App\Http\Controllers\PropertyManager;

use App\Helpers\Helpers;
use App\Helpers\MessageHelpers;
use App\Helpers\NotificationHelper;
use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\BuildingCustomer;
use App\Models\BuildingPaymentPlan;
use App\Models\BuildingMobileApplication;
use App\Models\BuildingSale;
use App\Models\BuildingSaleHistory;
use App\Models\BuildingSaleInstallment;
use App\Models\City;
use App\Models\Country;
use App\Models\FloorDetail;
use App\Models\State;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\BuildingEmployee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $building = Helpers::building_detail();
        $sales = BuildingSale::with('customer')->whereIn('building_id', $building->pluck('id')->toArray())->where(['order_type' => 'sale'])->get();
        $sale_person = Helpers::sales_person();
        $client_id = BuildingCustomer::where('property_admin_id', Helpers::user_admin())->get()->pluck('customer_id');
        $client = User::whereIn('id', $client_id)->get();
        $country = Country::get();
        return view('property_manager.sale.client.index', compact('sales', 'building', 'sale_person', 'client', 'country'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $country = Country::get();
        $building = Helpers::building_detail();
        $client_id = BuildingCustomer::where('property_admin_id', Helpers::user_admin())->get()->pluck('customer_id');
        $client = User::whereIn('id', $client_id)->get();
        $payment_plan = BuildingPaymentPlan::all();
        $sales_person = Helpers::sales_person();
        return view('property_manager.sale.client.create', compact('country', 'building', 'client', 'payment_plan','sales_person'));
    }

    public function state($panel, $country_id)
    {
        //$country = Country::where('sortname', $country_id)->first();
        $state = State::where('country_id', $country_id)->get();
        return json_encode($state);
    }

    public function city($panel, $country_id)
    {
        $state = City::where('state_id', $country_id)->get();
        return json_encode($state);
    }

    public function old_client($panel, $id)
    {
        $client = User::findOrFail($id);
        return json_encode($client);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = [];
        $validator = Validator::make($request->all(), [
            'building_id' => 'required',
            'floor_id' => 'required',
            'floor_detail_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->first()]);
        }
        if (Auth::user()->roles[0]->name !== 'sale_person') {
            $validator = Validator::make($request->all(), [
                'sale_person_id' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'message' => $validator->errors()->first()]);
            }
        }
        if ($request->client_type == 'new') {
            $errors = [
                'email_new.required' => 'Email is Required..',
                'email_new.unique' => 'Email Has Already been Taken..',
                'phone_number_new.required' => 'Phone Number is Required..',
                'phone_number_new.unique' => 'Phone Number Has Already been Taken..',
                'name_new.required' => 'Name is Required',
                'father_name_new.required' => 'Father Name is Required',
                'cnic_new.required' => 'CNIC is Required',
                'password_new.required' => 'Password is Required',
                'address_new.required' => 'Address is Required',
                'dob_new.required' => 'Date of Birth is Required',
                'country_id_new.required' => 'Country is Required',
                'state_id_new.required' => 'State is Required',
            ];
            $validator = Validator::make($request->all(), [
                'name_new' => 'required',
                'father_name_new' => 'required',
                'cnic_new' => 'required|unique:users,cnic',
                'email_new' => 'required|email|unique:users,email',
                'password_new' => 'required',
                'phone_number_new' => 'required|unique:users,phone_number',
                'address_new' => 'required',
                'dob_new' => 'required',
                'country_id_new' => 'required',
                'state_id_new' => 'required',
            ],$errors);
            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'message' => $validator->errors()->first()]);
            }

            $data['username'] = $request->name_new;
            $data['father_name'] = $request->father_name_new;
            $data['email'] = $request->email_new;
            $data['cnic'] = $request->cnic_new;
            $data['address'] = $request->address_new;
            $data['password'] = $request->password_new;
            $data['phone_number'] = $request->phone_number_new;
            $data['alt_phone'] = $request->alt_phone_new;
            $data['dob'] = $request->dob_new;
            $data['country_id'] = $request->country_id_new;
            $data['state_id'] = $request->state_id_new;
            $data['city_id'] = $request->city_id_new;
        } else {
            if ($request->client_type == 'old') {
                if (isset($request->name)){
                    $data['username'] = $request->name;
                }
                if (isset($request->father_name)) {
                    $data['father_name'] = $request->father_name;
                }
                if (isset($request->email)) {
                    $data['email'] = $request->email;
                }
                if (isset($request->cnic)) {
                    $data['cnic'] = $request->cnic;
                }
                if (isset($request->address)) {
                    $data['address'] = $request->address;
                }
                if (isset($request->password)) {
                    $data['password'] = $request->password;
                }
                if (isset($request->phone_number)) {
                    $data['phone_number'] = $request->phone_number;
                }
                if (isset($request->alt_phone)) {
                    $data['alt_phone'] = $request->alt_phone;
                }
                if (isset($request->dob)) {
                    $data['dob'] = $request->dob;
                }
                if (isset($request->country_id)) {
                    $data['country_id'] = $request->country_id;
                }
                if (isset($request->state_id)) {
                    $data['state_id'] = $request->state_id;
                }
                if (isset($request->city_id)) {
                    $data['city_id'] = $request->city_id;
                }
            }
        }
        $building = Helpers::building_detail_single($request->building_id);
        $installment = Helpers::installment($request);
        $payment_plan_id = $installment['payment_plan']->id;
        $data['payment_plan_id'] = $payment_plan_id;
        if ($installment['total_price'] == $installment['payment_plan']->total_price) {
            FloorDetail::where('id', $request->floor_detail_id)->update(['status' => 'sold']);
            $sale = Helpers::sale_and_customer($request, $building, 'sale', $data);
            if ($sale) {
                //Notification Create
                NotificationHelper::web_panel_notification('sale_add', 'sale_id', $sale['sale']['id']);
                Helpers::customer_create($sale);
                Helpers::create_installment_plan($sale['sale'], $installment, $request);
                return response()->json(['status' => 'success', 'message' => 'Property Sale Client Create Successfully']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Property Sale Client Receipt Create Error']);
            }
        } else {
            return response()->json(['status' => 'error', 'message' => 'Property installment plan calculation problem Please check your plan calculation!']);
        }

    }
    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show($panel, $id)
    {
        $building_sale = BuildingSale::with('customer')->where('id', $id)->first();
        if ($building_sale->floor_detail_id == null) {
            return redirect()->route('property_manager.sale.client.index', Helpers::user_login_route())->with($this->message('Please select first property!', 'error'));
        } else {
            return view('property_manager.sale.client.show', compact('building_sale'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($panel, $client)
    {
        $building = Helpers::building_detail();
        $building_list = Helpers::building_detail()->pluck('id')->toArray();
        $floor_detail = FloorDetail::whereIn('building_id', $building_list)->get();
        $customer_id = BuildingCustomer::where('property_admin_id', $building[0]->user_id)->get()->pluck('customer_id');
        $customer = User::whereIn('id', $customer_id)->get();
        $payment_plan = BuildingPaymentPlan::all();
        $building_sale = BuildingSale::with('customer')->where('id', $client)->whereIn('building_id', $building_list)->first();
        $country = Country::get();
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
        //dd($building_sale, $client, $panel);
        return view('property_manager.sale.client.edit', compact('country', 'building_sale', 'floor_detail', 'building', 'customer', 'customer_id', 'payment_plan','sales_person'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $panel, $id)
    {
        $sale = BuildingSale::findOrFail($id);
        $user = User::findOrFail($sale->customer_id);
        $validator = Validator::make($request->all(), [
            'floor_detail_id' => 'required',
            'sale_person_id' => 'required',
            'name' => 'required',
            'fathername' => 'required',
            'cnic_new' => 'unique:users,cnic,'.$user->id,
            'email' => 'required|unique:users,email,'.$user->id,
            'phone_number' => 'required|unique:users,phone_number,'.$user->id,
            'address' => 'required',
            'dob' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->first()]);
        }
//        dd($request->all());
        $data = [];
        if ($request->has('name')){
            $data['username'] = $request->name;
        }
        if ($request->has('fathername')) {
            $data['father_name'] = $request->fathername;
        }
        if ($request->has('email')) {
            $data['email'] = $request->email;
        }
        if ($request->has('cnic')) {
            $data['cnic'] = $request->cnic;
        }
        if ($request->has('address')) {
            $data['address'] = $request->address;
        }
        if ($request->has('password')) {
            $data['password'] = Hash::make($request->password);
        }
        if ($request->has('phone_number')) {
            $data['phone_number'] = $request->phone_number;
        }
        if ($request->has('alt_phone')) {
            $data['alt_phone'] = $request->alt_phone;
        }
        if ($request->has('dob')) {
            $data['dob'] = $request->dob;
        }
        if ($request->has('country_id')) {
            $data['country_id'] = $request->country_id;
        }
        if ($request->has('state_id')) {
            $data['state_id'] = $request->state_id;
        }
        if ($request->has('city_id')) {
            $data['city_id'] = $request->city_id;
        }
        $building = Helpers::building_detail_single($sale->building_id);
        $installment = Helpers::installment($request);
        $payment_plan_id = $installment['payment_plan']->id;
        $data['payment_plan_id'] = $payment_plan_id;
        if ($installment['total_price'] == $installment['payment_plan']->total_price) {
            FloorDetail::where('id', $request->floor_detail_id)->update(['status' => 'sold']);
            $sale = Helpers::sale_and_customer($request, $building, 'sale',$data, $id);
            if ($sale) {
                //Notification Create
                NotificationHelper::web_panel_notification('sale_update', 'sale_id', $sale['sale']['id']);
                Helpers::customer_create($sale);
                Helpers::create_installment_plan($sale['sale'], $installment, $request);
                return response()->json(['status' => 'success', 'message' => 'Property Sale Client Update Successfully']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Property Sale Client Receipt Update Error']);
            }
        } else {
            return response()->json(['status' => 'error', 'message' => 'Property installment plan calculation problem Please check your plan calculation!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($panel, $id)
    {
        $sale = BuildingSale::findOrFail($id);
        $sale->delete();
        $floor_detail = FloorDetail::where('id', $sale->floor_detail_id)->first();
        $floor_detail->status = 'available';
        $floor_detail->save();
        User::findOrFail($sale->customer_id)->forceDelete();
        if ($sale) {
            return response()->json(['status' => 'success', 'message' => 'Property Sale Client Delete Successfully']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Property Sale Client Receipt Delete Error']);
        }
    }

    public function installment_edit($panel, Request $request, $id)
    {
        $installment = BuildingSaleInstallment::findOrFail($id);
        $installment->payment_method = $request->payment_method;
        $installment->status = $request->status;
        $installment->save();
        if ($installment) {
            return redirect()->back()->with($this->message('Installment Update Successfully', 'success'));
        } else {
            return redirect()->back()->with($this->message('Installment Update Error', 'danger'));
        }
    }

    public function filter(Request $request)
    {
        $sales_person = $request->sales_person;
        $status = $request->status;
        $filter_date = $request->filter_date;
        $building = Helpers::building_detail();

        $sales = BuildingSale::with('customer')->whereIn('building_id', $building->pluck('id')->toArray())->where(['order_type' => 'sale']);
        // dd($status,$sales->get());
        if ($sales_person) {
            $sales->where('user_id', $request->sales_person);
        }
        if ($status) {
            $sales->where('order_status', $request->status);
        }
        if ($filter_date) {
            $current_date = Carbon::now();
            if ($filter_date == 'today') {
                $sales->whereDate('created_at',$current_date);
            } else if ($filter_date == 'yesterday') {
                $date = Carbon::now()->subDay();
                $sales->whereDate('created_at',$date);
            } else if ($filter_date == 'this_week') {
                $date = Carbon::now()->subDays(7);
                $sales->whereBetween('created_at',[$date,$current_date]);

            } else if ($filter_date == 'this_month') {
                $month = Carbon::now()->format('m');
                $year = Carbon::now()->format('Y');
                $sales->whereMonth('created_at',$month)->whereYear('created_at', $year);
            } else {
                $last_month = Carbon::now()->subMonth();
                $month = $last_month->format('m');
                $year = $last_month->format('Y');
                $sales->whereMonth('created_at',$month)->whereYear('created_at', $year);
            }
        }
        $sales = $sales->get();
        $sale_person = Helpers::sales_person();
        $client_id = BuildingCustomer::where('property_admin_id', Helpers::user_admin())->get()->pluck('customer_id');
        $client = User::whereIn('id', $client_id)->get();
        $country = Country::get();
        return view('property_manager.sale.client.index', compact('sales', 'building', 'sale_person', 'client', 'country'));
    }

    public function search(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $country = $request->country;
        $number = $request->number;

        $building = Helpers::building_detail();

        if (!($id) && !($name) && !($country) && !($number)) {
            $sales = BuildingSale::with('customer')->whereIn('building_id', $building->pluck('id')->toArray())->where(['order_type' => 'sale'])->get();
        } else {
            $sales = BuildingSale::with('floor_detail', 'customer')->whereIn('building_id', $building->pluck('id')->toArray())->where(['order_type' => 'sale'])
                ->whereHas('floor_detail', function ($q) use ($id) {
                    if ($id) {
                        $q->where('unit_id', $id);
                    }
                })
                ->whereHas('customer', function ($q) use ($name, $number) {
                    if ($name) {
                        $q->where('username', $name);
                    }
                    if ($number) {
                        $q->where('phone_number', $number);

                    }
                })
                ->get();
        }

        $client_id = BuildingCustomer::where('property_admin_id', Helpers::user_admin())->get()->pluck('customer_id');
        $client = User::whereIn('id', $client_id)->get();
        $country = Country::get();
        $sale_person = Helpers::sales_person();
        return view('property_manager.sale.client.index', compact('sales', 'building', 'sale_person', 'client', 'country'));
    }

    public function searchByDate(Request $request)
    {
        $request->validate([
            'from' => 'required',
            'to' => 'required',
        ]);
        $building = Helpers::building_detail();
        $from = $request->from;
        $to = $request->to;
        if (!($from) || !($to)) {
            return redirect()->route('property_manager.sale.client.index', url(Helpers::user_login_route()['panel']))->with($this->message('Invalid Date Selected',
                'error'));
        } else {
            if ($from > $to) {
                return redirect()->route('property_manager.sale.client.index', url(Helpers::user_login_route()['panel']))->with($this->message('Invalid Date Selected', 'error'));

            } else {
                $from = Carbon::parse($from);
                $to = Carbon::parse($to)->addDay();
                $sales = BuildingSale::with('customer')->where('property_admin_id', $building[0]->user_id)->where(['order_type' => 'sale'])->whereBetween('created_at',
                    [$from, $to])
                    ->get();

                $client_id = BuildingCustomer::where('property_admin_id', $building[0]->user_id)->get()->pluck('customer_id');
                $client = User::whereIn('id', $client_id)->get();
                $country = Country::get();
                $sale_person = BuildingEmployee::with('user')->where('job_title', 'sale_person')->where('property_admin_id', $building[0]->user_id)->get();
                return view('property_manager.sale.client.index', compact('sales', 'building', 'sale_person', 'client', 'country'));
            }
        }
    }

    public function checkData($panel, $id)
    {
        $sale = BuildingSale::find($id);

        if ($sale->floor_detail_id == null) {
            return json_encode('null');
        } else {
            return json_encode('not_null');
        }
    }

    public function changeStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'status' => 'required',
            'date' => 'required',
            'comment' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->first()]);
        }
        $sale = BuildingSale::find($request->id);

        if ($request->status == 'transferred') {
            $validator = Validator::make($request->all(), [
                'transfer_fee' => 'required',
                'client_type' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'message' => $validator->errors()->first()]);
            }
            if ($request->client_type == 'new') {
                $errors = [
                    'email_new.required' => 'Email is Required..',
                    'email_new.unique' => 'Email Has Already been Taken..',
                    'phone_number_new.required' => 'Phone Number is Required..',
                    'phone_number_new.unique' => 'Phone Number Has Already been Taken..',
                    'name_new.required' => 'Name is Required',
                    'father_name_new.required' => 'Father Name is Required',
                    'cnic_new.required' => 'CNIC is Required',
                    'password_new.required' => 'Password is Required',
                    'address_new.required' => 'Address is Required',
                    'dob_new.required' => 'Date of Birth is Required',
                    'country_id_new.required' => 'Country is Required',
                    'state_id_new.required' => 'State is Required',
                ];
                $validator = Validator::make($request->all(), [
                    'name_new' => 'required',
                    'father_name_new' => 'required',
                    'cnic_new' => 'unique:users,cnic',
                    'email_new' => 'required|email|unique:users,email',
                    'password_new' => 'required',
                    'phone_number_new' => 'required|unique:users,phone_number',
                    'address_new' => 'required',
                    'dob_new' => 'required',
                    'country_id_new' => 'required',
                    'state_id_new' => 'required',
                ],$errors);
                if ($validator->fails()) {
                    return response()->json(['status' => 'error', 'message' => $validator->errors()->first()]);
                }
                $user = User::where('email', $request->email_new)->orWhere('cnic', $request->cnic_new)->orWhere('phone_number', $request->phone_number_new)->first();
                if ($user == null) {
                    $customer = new User();
                    $customer->username = $request->name_new;
                    $customer->father_name = $request->father_name;
                    $customer->email = $request->email;
                    $customer->cnic = $request->cnic;
                    $customer->password = Hash::make($request->password);
                    $customer->phone_number = $request->phone_number;
                    $customer->alt_phone = $request->alt_phone;
                    $customer->dob = $request->dob;
                    $customer->country_id = $request->country_id;
                    // $customer->state_id = $request->state_id;
                    // $customer->city_id = $request->city_id;
                    $customer->save();
                    $role = Role::where('name', 'user')->first();
                    $customer->assignRole($role);
                }else{
                    return response()->json(['status' => 'error', 'message' => 'Client already create. Please change client data or select old client!']);
                }
            }else{
                $request->validate([
                    'client_id' => 'required',
                ]);
                $customer = User::find($request->client_id);
                if($customer->username == null || $customer->father_name == null || $customer->cnic == null || $customer->email == null || $customer->phone_number == null || $customer->address == null || $customer->dob == null){
                    return response()->json(['status' => 'error', 'message' => 'Please First Fill The Client Fields']);
                }
            }
            $data = [
                'date' => $request->date,
                'sale_person' => $sale->sale_person_id,
                'from' => $sale->customer_id,
                'to' => $customer->id,
                'fee' => $request->transfer_fee,
                'status' => $request->status,
            ];
            $key = 'transfer';

            $sale->customer_id = $customer->id;
            $sale->order_status = $request->status;
        } else {
            $sale->order_status = $request->status;
            $data = [
                'date' => $request->date,
                'status' => $request->status
            ];
            $key = 'sale';
        }
        $sale->update();
        $history = new BuildingSaleHistory();
        $history->building_sale_id = $request->id;
        $history->key = $key;
        $history->data = json_encode($data);
        $history->comment = $request->comment;
        $history->save();
        if ($request->status == 'active') {
            $key = 'sale_active';
        }  elseif ($request->status == 'suspended') {
            $key = 'sale_suspended';
        } elseif ($request->status == 'cancelled') {
            $key = 'sale_cancel';
        } elseif ($request->status == 'transferred') {
            $key = 'sale_transfer';
        } else {
            $key = null;
        }
        NotificationHelper::web_panel_notification($key, 'sale_id', $sale->id);
        MessageHelpers::sendMessage('login_detail_message', $sale);
        if ($sale && $history) {
            return response()->json(['status' => 'success', 'message' => 'Status Updated Successfully']);
        }
    }

    public function history()
    {
        $building = Helpers::building_detail()->pluck('id')->toArray();
        $sale = BuildingSale::whereIn('building_id', $building)->pluck('id')->toArray();
        $sale_history = BuildingSaleHistory::where('key', 'transfer')->whereIn('building_sale_id', $sale)->get();
//        dd($sale_history);
        return view('property_manager.sale.sale_history.index', compact('sale_history'));
    }

    public function comments($panel, $id)
    {
        $comments = BuildingSaleHistory::where('building_sale_id', $id)->whereIn('key', ['transfer','sale'])->get();
        return view('property_manager.sale.client.comments', compact('comments'));
    }
}
