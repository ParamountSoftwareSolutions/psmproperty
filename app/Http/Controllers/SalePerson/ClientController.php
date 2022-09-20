<?php

namespace App\Http\Controllers\SalePerson;

use App\Helpers\NotificationHelper;
use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\BuildingCustomer;
use App\Models\BuildingEmployee;
use App\Models\BuildingMobileApplication;
use App\Models\BuildingPaymentPlan;
use App\Models\BuildingSale;
use App\Models\BuildingSaleHistory;
use App\Models\City;
use App\Models\Country;
use App\Models\Floor;
use App\Models\FloorDetail;
use App\Models\State;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $sales = BuildingSale::where('sale_person_id', Auth::id())->where(['order_type' => 'sale'])->get();
        return view('sale_person.sale.client.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $country = Country::get();
        $property_admin_id = BuildingEmployee::where('employee_id', Auth::id())->first()->property_admin_id;
        $building = Building::where('user_id', $property_admin_id)->get();
        $client_id = BuildingCustomer::where('property_admin_id', $property_admin_id)->get()->pluck('customer_id');
        $client = User::whereIn('id', $client_id)->get();
        $payment_plan=BuildingPaymentPlan::all();
        return view('sale_person.sale.client.create', compact('country', 'building', 'client','payment_plan'));
    }

    public function state($country_id)
    {
        //$country = Country::where('sortname', $country_id)->first();
        $state = State::where('country_id', $country_id)->get();
        return json_encode($state);
    }

    public function city($country_id)
    {
        $state = City::where('state_id', $country_id)->get();
        return json_encode($state);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'floor_detail_id' => 'required',
            // 'registration_number' => 'required',
            // 'status' => 'required',
            'payment_plan_id' => 'required',
            'sale_person_id' => 'required',
        ]);
        if($request->client_type == 'new'){
            $this->validate($request,[
                'username'=>'required',
                'fathername'=>'required',
                'cnic'=>'required',
                'email'=>'required',
                'password'=>'required',
                'phone_number'=>'required',
                'address'=>'required',
                'dob'=>'required',
                /*'country_id'=>'required',
                'state_id'=>'required',
                'city_id'=>'required',*/
            ]);
        }
        $building = Building::where('sale_manager_id', Auth::id())->first();
        $property_admin_id = BuildingEmployee::where('employee_id', Auth::id())->first()->property_admin_id;

        if ($request->client_type == 'new') {
            $user = User::where('cnic', $request->cnic)->orWhere('email', $request->email)->orWhere('phone_number', $request->phone_number)->first();
            if ($user == null) {
                $customer = new User();
                $customer->username = $request->username;
                $customer->father_name = $request->fathername;
                $customer->email = $request->email;
                $customer->cnic = $request->cnic;
                $customer->address = $request->address;
                $customer->password = Hash::make($request->password);
                $customer->phone_number = $request->phone_number;
                $customer->alt_phone = $request->alt_phone;
                $customer->dob = $request->dob;

                /*$country=Country::find($request->country_id);
                $customer->country=$country->name;

                $state=State::find($request->state_id);
                $customer->state=$state->name;

                $city=City::find($request->city_id);
                $customer->city=$city->name;*/
                $customer->save();
                $role = Role::where('name', 'user')->first();
                $customer->assignRole($role);
            } else {
                return redirect()->back()->with($this->message('Client already create. Please change client data or select old client!', 'error'));
            }
        } elseif ($request->client_type == 'old') {
            $customer = User::findOrFail($request->client_id);
        }
        //$sale = BuildingSale::where(['floor_detail_id' => $request->floor_detail_id])->first();
        $sale = new BuildingSale();
        $sale->floor_detail_id = $request->floor_detail_id;
        $sale->customer_id = $customer->id;
        $sale->property_admin_id = $property_admin_id;
        // $sale->down_payment = $request->down_payment;
        // $sale->registration_number = $request->registration_number;
        // $sale->hidden_file_number = $request->hidden_file_number;
        $sale->order_status = $request->status;
        $sale->payment_plan_id = $request->payment_plan_id;
        $sale->sale_person_id = $request->sale_person_id;
        $sale->order_status = 'mature';
        $sale->order_type = 'sale';
        $sale->save();


        if ($sale) {
            FloorDetail::where('id', $request->floor_detail_id)->update(['status' => 'sold']);
            //Notification Create
            (new NotificationHelper)->web_panel_notification('sale_add');
            (new NotificationHelper)->web_panel_notification($request->status);
        }
        $building_app_key = BuildingMobileApplication::where('property_admin_id', $property_admin_id)->first();
        $customer_detail = BuildingCustomer::where('customer_id', $customer->id)->first();
        if ($customer_detail == null) {
            $customer_detail = new BuildingCustomer();
            $customer_detail->building_app_id = $building_app_key->id;
            $customer_detail->property_admin_id = $property_admin_id;
            $customer_detail->sale_person_id = Auth::id();
            $customer_detail->customer_id = $customer->id;
            $customer_detail->save();
        } else {
            $customer_detail->building_app_id = $building_app_key->id;
            $customer_detail->property_admin_id = $property_admin_id;
            $customer_detail->sale_person_id = Auth::id();
            $customer_detail->customer_id = $customer->id;
            $customer_detail->save();
        }

        // $floor_detail = FloorDetail::where('id', $request->floor_detail_id)->first();
        // if ($request->status == 'mature') {
        //     FloorDetail::where('id', $request->floor_detail_id)->update(['status' => 'sold']);

        //     // Calculation Payment Plan
        //     $total_month = $floor_detail->total_month_installment;
        //     if ($floor_detail->half_year_installment !== null) {
        //         $price_per_year = $floor_detail->half_year_installment;
        //         $total_per_year_price = $total_month / 6;
        //     } elseif ($floor_detail->quarterly_payment !== null) {
        //         $price_per_year = $floor_detail->quarterly_payment;
        //         $total_per_year_price = $total_month / 3;
        //     }
        //     $a1 = [];
        //     $a2 = [];
        //     $a3 = [];
        //     $b1 = [];
        //     $b2 = [];
        //     $b3 = [];
        //     $extra_total_price = [$floor_detail->booking_price, $floor_detail->form_submission, $floor_detail->balloting_price, $floor_detail->possession_price];
        //     /*$total_price = count($extra_total_price) + $total_per_year_price;*/
        //     for ($i = 0; count($extra_total_price) > $i; $i++) {
        //         $b1[$i] = 'Extra Price';
        //         $a1[$i] = $extra_total_price[$i];
        //     }
        //     for ($i = 0; $total_per_year_price > $i; $i++) {
        //         $b2[$i] = 'Yearly Price';
        //         $a2[$i] = $price_per_year;
        //     }
        //     for ($i = 0; $total_month > $i; $i++) {
        //         $b3[$i] = 'Monthly Installment';
        //         $a3[$i] = $floor_detail->per_month_installment;
        //     }
        //     $total_price = array_merge($a1, $a2, $a3);
        //     $title = array_merge($b1, $b2, $b3);

        //     if (array_sum($total_price) == $floor_detail->total_price) {
        //         for ($i = 0; count($total_price) > $i; $i++) {
        //             if ($total_price[$i] == null) {
        //                 continue;
        //             } else {
        //                 BuildingSaleInstallment::create([
        //                     'floor_detail_id' => $request->floor_detail_id,
        //                     'building_sale_id' => $sale->id,
        //                     'title' => $title[$i],
        //                     'installment_amount' => $total_price[$i],
        //                     'due_date' => $request->due_date,
        //                     'status' => 'not_paid',
        //                 ]);
        //             }
        //         }
        //     } else {
        //         return redirect()->back()->with($this->message('Property installment plan calculation problem Please check your plan calculation!', 'error'));
        //     }
        // }
        if ($sale) {
            return redirect()->route('sale_person.sale.client.index')->with($this->message('Property Sale Client Create Successfully', 'success'));
        } else {
            return redirect()->back()->with($this->message('Property Sale Client Receipt Create Error', 'error'));
        }
    }

    public function building($id)
    {
        $building = Building::where('id', $id)->first();
        $floor = Floor::whereIn('id', json_decode($building->floor_list))->get();
        return json_encode($floor);
    }

    public function floor($id, $building_id)
    {
        $floor = Floor::where('id', $id)->first();
        $floor_detail = FloorDetail::where(['floor_id' => $floor->id, 'building_id' => $building_id])->where('status', 'available')->get();
        return json_decode($floor_detail);
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
        $property_admin_id = BuildingEmployee::where('employee_id', Auth::id())->first()->property_admin_id;
        $building_sale = BuildingSale::where(['sale_person_id' => Auth::id(), 'order_type' => 'sale'])->findOrFail($id);
        $building = Building::where('user_id', $property_admin_id)->get();
        $payment_plan=BuildingPaymentPlan::all();
        $country = Country::get();
        return view('sale_person.sale.client.edit', compact('building_sale', 'building', 'payment_plan', 'country'));
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
        $request->validate([
            'floor_detail_id' => 'required',
            'payment_plan_id' => 'required',
            'sale_person_id' => 'required',
            'username'=>'required',
            'fathername'=>'required',
            'cnic'=>'required',
            'email'=>'required',
            'phone_number'=>'required',
            'address'=>'required',
            'dob'=>'required',
        ]);
        $property_admin_id = BuildingEmployee::where('employee_id', Auth::id())->first()->property_admin_id;
        $building = Building::where('user_id', $property_admin_id)->first();

        $sale = BuildingSale::findOrFail($id);
        $sale->floor_detail_id = $request->floor_detail_id;
        $sale->property_admin_id = $building->user_id;
        $sale->order_status = $request->status;
        $sale->payment_plan_id = $request->payment_plan_id;
        $sale->sale_person_id = $request->sale_person_id;
        $sale->order_status = $request->status;
        $sale->update();
        if ($sale) {
            FloorDetail::where('id', $request->floor_detail_id)->update(['status' => 'sold']);
            //notification Update
            (new NotificationHelper)->web_panel_notification('sale_update');
            (new NotificationHelper)->web_panel_notification($request->status);
        }
        $customer = User::where('id', $sale->customer->id)->first();
        $customer->username = $request->username;
        $customer->father_name = $request->fathername;
        $customer->email = $request->email;
        $customer->cnic = $request->cnic;
        $customer->address = $request->address;
        if($request->password)
        {
            $customer->password = Hash::make($request->password);
        }
        $customer->phone_number = $request->phone_number;
        if($request->alt_phone)
        {
            $customer->alt_phone = $request->alt_phone;
        }
        else
        {
            $customer->alt_phone = null;

        }
        $customer->dob = $request->dob;
        if($request->country_id)
        {
            $this->validate($request,[
                /*'state_id'=>'required',
                'city_id'=>'required',*/
            ]);
            $country=Country::find($request->country_id);
            $customer->country=$country->name;
            $state=State::find($request->state_id);
            $customer->state=$state->name;
            $city=City::find($request->city_id);
            $customer->city=$city->name;
        }
        $customer->save();

        $building_app_key = BuildingMobileApplication::where('property_admin_id', $building->user_id)->first();
        $customer_detail = BuildingCustomer::where('customer_id', $customer->id)->first();
        if ($customer_detail == null) {
            $customer_detail = new BuildingCustomer();
            $customer_detail->building_app_id = $building_app_key->id;
            $customer_detail->property_admin_id = $building->user_id;
            $customer_detail->sale_person_id = Auth::id();
            $customer_detail->customer_id = $customer->id;
            $customer_detail->save();
        } else {
            $customer_detail->building_app_id = $building_app_key->id;
            $customer_detail->property_admin_id = $building->user_id;
            $customer_detail->sale_person_id = Auth::id();
            $customer_detail->customer_id = $customer->id;
            $customer_detail->save();
        }


        //$floor_detail = FloorDetail::where('id', $request->floor_detail_id)->first();
        /*if ($request->status == 'mature') {
            FloorDetail::where('id', $request->floor_detail_id)->update(['status' => 'sold']);

            // Calculation Payment Plan
            $total_month = $floor_detail->total_month_installment;
            if ($floor_detail->half_year_installment !== null) {
                $price_per_year = $floor_detail->half_year_installment;
                $total_per_year_price = $total_month / 6;
            } elseif ($floor_detail->quarterly_payment !== null) {
                $price_per_year = $floor_detail->quarterly_payment;
                $total_per_year_price = $total_month / 3;
            }
            $a1 = [];
            $a2 = [];
            $a3 = [];
            $b1 = [];
            $b2 = [];
            $b3 = [];
            $extra_total_price = [$floor_detail->booking_price, $floor_detail->form_submission, $floor_detail->balloting_price, $floor_detail->possession_price];
            for ($i = 0; count($extra_total_price) > $i; $i++) {
                $b1[$i] = 'Extra Price';
                $a1[$i] = $extra_total_price[$i];
            }
            for ($i = 0; $total_per_year_price > $i; $i++) {
                $b2[$i] = 'Yearly Price';
                $a2[$i] = $price_per_year;
            }
            for ($i = 0; $total_month > $i; $i++) {
                $b3[$i] = 'Monthly Installment';
                $a3[$i] = $floor_detail->per_month_installment;
            }
            $total_price = array_merge($a1, $a2, $a3);
            $title = array_merge($b1, $b2, $b3);

            if (array_sum($total_price) == $floor_detail->total_price) {
                for ($i = 0; count($total_price) > $i; $i++) {
                    if ($total_price[$i] == null) {
                        continue;
                    } else {
                        BuildingSaleInstallment::update([
                            'floor_detail_id' => $request->floor_detail_id,
                        ], [
                            'building_sale_id' => $sale->id,
                            'title' => $title[$i],
                            'installment_amount' => $total_price[$i],
                            'due_date' => $request->due_date,
                            'status' => 'not_paid',
                        ]);
                    }
                }
            } else {
                return redirect()->back()->with($this->message('Property installment plan calculation problem Please check your plan calculation!', 'error'));
            }
        }*/

        if ($sale) {
            return redirect()->route('sale_person.sale.client.index')->with($this->message('Property Sale Client Update Successfully', 'success'));
        } else {
            return redirect()->back()->with($this->message('Property Sale Client Receipt Create Error', 'danger'));
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

    public function filter(Request $request)
    {
        $sales_person=$request->sales_person;
        $status=$request->status;
        $filter_date=$request->filter_date;
        $property_admin_id = BuildingEmployee::where('employee_id', Auth::id())->first()->property_admin_id;
        $building = Building::where('user_id', $property_admin_id)->get();
        if($sales_person){

            $sales = BuildingSale::with('customer')->where('property_admin_id', $property_admin_id)->where(['order_type' => 'sale'])->where('sale_person_id',
                $request->sales_person)->get();
        }
        if($status){

            $sales = BuildingSale::with('customer')->where('property_admin_id', $property_admin_id)->where(['order_type' => 'sale'])->where('order_status',
                $request->status)->get();
        }
        if($filter_date)
        {
            $current_date=Carbon::now();
            if($filter_date == 'today')
            {
                $sales = BuildingSale::with('customer')->where('property_admin_id', $property_admin_id)->where(['order_type' => 'sale'])->whereDate('created_at',
                    $current_date)->get();

            }

            else if($filter_date == 'yesterday')
            {
                $date=Carbon::now()->subDay();
                $sales = BuildingSale::with('customer')->where('property_admin_id', $property_admin_id)->where(['order_type' => 'sale'])->whereDate('created_at',$date)
                    ->get();

            }

            else if($filter_date == 'this_week')
            {
                $date=Carbon::now()->subDays(7);
                $sales = BuildingSale::with('customer')->where('property_admin_id', $property_admin_id)->where(['order_type' => 'sale'])->whereBetween('created_at',
                    [$date,$current_date])->get();

            }

            else if($filter_date == 'this_month')
            {
                $month=Carbon::now()->format('m');
                $year=Carbon::now()->format('Y');
                $sales = BuildingSale::with('customer')->where('property_admin_id', $property_admin_id)->where(['order_type' => 'sale'])->whereMonth('created_at',
                    $month)->whereYear('created_at',$year)->get();
            }

            else
            {
                $last_month=Carbon::now()->subMonth();
                $month=$last_month->format('m');
                $year=$last_month->format('Y');
                $sales = BuildingSale::with('customer')->where('property_admin_id', $property_admin_id)->where(['order_type' => 'sale'])->whereMonth('created_at',
                    $month)->whereYear('created_at',$year)->get();
            }
        }
        $sale_person = BuildingEmployee::with('user')->where('job_title', 'sale_person')->where('property_admin_id',$property_admin_id)->get();
        return view('sale_person.sale.client.index', compact('sales', 'building','sale_person'));
    }

    public function search(Request $request)
    {
        $id=$request->id;
        $name=$request->name;
        $country=$request->country;
        $number=$request->number;
        $property_admin_id = BuildingEmployee::where('employee_id', Auth::id())->first()->property_admin_id;
        $building = Building::where('user_id', $property_admin_id)->get();

        if(!($id) && !($name) && !($country) && !($number))
        {
            $sales = BuildingSale::with('customer')->where('property_admin_id', $property_admin_id)->where(['order_type' => 'sale'])->get();
        }
        else
        {
            $sales =BuildingSale::with('floor_detail','customer')->where('property_admin_id', $property_admin_id)->where(['order_type' => 'sale'])
                ->whereHas('floor_detail', function ($q) use($id) {
                    if($id)
                    {
                        $q->where('unit_id', $id);
                    }
                })
                ->whereHas('customer', function ($q) use($name,$number) {
                    if($name)
                    {
                        $q->where('username', $name);
                    }
                    if($number)
                    {
                        $q->where('phone_number', $number);
                    }
                })
                ->get();
        }


        $sale_person = BuildingEmployee::with('user')->where('job_title', 'sale_person')->where('property_admin_id',$property_admin_id)->get();
        return view('sale_person.sale.client.index', compact('sales', 'building','sale_person'));
    }

    public function searchByDate(Request $request)
    {
        $property_admin_id = BuildingEmployee::where('employee_id', Auth::id())->first()->property_admin_id;
        $building = Building::where('user_id', $property_admin_id)->get();
        $from=$request->from;
        $to=$request->to;
        if(!($from) || !($to))
        {
            return redirect()->route('sale_person.sale.client.index')->with($this->message('Invalid Date Selected', 'error'));
        }
        else
        {
            if($from > $to)
            {
                return redirect()->route('sale_person.sale.client.index')->with($this->message('Invalid Date Selected', 'error'));

            }
            else
            {
                $from=Carbon::parse($from);
                $to=Carbon::parse($to)->addDay();
                $sales = BuildingSale::with('customer')->where('property_admin_id', $property_admin_id)->where(['order_type' => 'sale'])->whereBetween('created_at',
                    [$from,$to])->get();

                $sale_person = BuildingEmployee::with('user')->where('job_title', 'sale_person')->where('property_admin_id',$property_admin_id)->get();
                return view('sale_person.sale.client.index', compact('sales', 'building','sale_person'));

            }
        }

    }


    public function changeStatus(Request $request)
    {
        $this->validate($request,[
            'date'=>'required',
            'comment'=>'required'
        ]);
        $sale =BuildingSale::find($request->id);
        $sale->order_status=$request->status;
        $sale->update();

        $data=[
            'date'=>$request->date,
            'comment'=>$request->comment,
            'status'=>$request->status
        ];
        $history=new BuildingSaleHistory;
        $history->building_sale_id=$request->id;
        $history->key='sale';
        $history->data=json_encode($data);
        $history->save();
        if($sale && $history)
        {
            return redirect()->back()->with($this->message('Status Updated Successfully', 'success'));
        }

    }
}
