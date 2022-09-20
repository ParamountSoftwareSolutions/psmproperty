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
use App\Models\BuildingSaleInstallment;
use App\Models\Floor;
use App\Models\FloorDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $property_admin_id = BuildingEmployee::where('employee_id', Auth::id())->first()->property_admin_id;
        $building = Building::where('user_id', $property_admin_id)->get();
        $sales = BuildingSale::with('customer')->where(['sale_person_id' => Auth::id()])->where(['order_type' => 'lead'])->get();

        return view('sale_person.sale.lead.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $property_admin_id = BuildingEmployee::where('employee_id', Auth::id())->first()->property_admin_id;
        $building = Building::where('user_id', $property_admin_id)->get();
        $client_id = BuildingCustomer::where('property_admin_id', $building[0]->user_id)->get()->pluck('customer_id');
        return view('sale_person.sale.lead.create', compact('building'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'building_id' => 'required',
            'interested_in' => 'required',
            'source' => 'required',
            'username' => 'required',
            'phone_number' => 'required',
        ]);
        $property_admin_id = BuildingEmployee::where('employee_id', Auth::id())->first()->property_admin_id;
        if ($request->status == 'mature') {
            $request->validate([
                'floor_detail_id' => 'required',
                'status' => 'required',
            ]);
            $floor_detail = FloorDetail::where('id', $request->floor_detail_id)->first();

            $payment_plan = BuildingPaymentPlan::findOrFail($request->payment_plan_id);
            $a1 = [];
            $a2 = [];
            $a3 = [];
            $b1 = [];
            $b2 = [];
            $b3 = [];
            $total_per_year_price = 0;
            // Calculation Payment Plan
            $total_month = $payment_plan->total_month_installment;
            if ($payment_plan->half_year_installment !== null && $total_month > 12) {
                $price_per_year = $payment_plan->half_year_installment;
                $total_per_year_price = $total_month / 6;
            } elseif ($payment_plan->quarterly_payment !== null && $total_month > 12) {
                $price_per_year = $payment_plan->quarterly_payment;
                $total_per_year_price = $total_month / 3;
            }

            $extra_total_price = [$payment_plan->booking_price, $payment_plan->balloting_price, $payment_plan->possession_price];
            /*$total_price = count($extra_total_price) + $total_per_year_price;*/
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
                $a3[$i] = $payment_plan->per_month_installment;
            }
            //dd($a1, $a2, $a3);
            $total_price = array_merge($a1, $a2, $a3);
            $title = array_merge($b1, $b2, $b3);
            $due_data = Carbon::now();
            //dd(array_sum($total_price) == $payment_plan->total_price, array_sum($total_price), $payment_plan->total_price);

            $check_down_payment = ($request->down_payment / 100) * $payment_plan->total_price;

            if (array_sum($total_price) == $payment_plan->total_price || $request->down_payment == $payment_plan->total_price) {
                $building = Building::where('user_id', $property_admin_id)->first();
                //$user = User::where(['phone_number' => $request->phone_number])->first();
                $user = User::where(['cnic' => $request->cnic, 'phone_number' => $request->phone_number])->first();

                if ($user == null) {
                    $customer = new User();
                    $customer->username = $request->username;
                    $customer->father_name = $request->father_name;
                    $customer->cnic = $request->cnic;
                    $customer->email = $request->email;
                    $customer->phone_number = $request->phone_number;
                    $customer->password = Hash::make($request->password);
                    $customer->save();
                    $role = Role::where('name', 'user')->first();
                    $customer->assignRole($role);
                    $user = $customer;
                } else {
                    return redirect()->back()->with($this->message('User already create. Please change client data or select old client!', 'error'));
                }

                $sale = new BuildingSale();
                $sale->building_id = $request->building_id;
                $sale->floor_detail_id = $request->floor_detail_id;
                $sale->customer_id = $user->id;
                $sale->property_admin_id = $building->user_id;
                $sale->interested_in = $request->interested_in;
                $sale->source = $request->source;
                $sale->sale_person_id = $request->sale_person_id;
                // $sale->registration_number = $request->registration_number;
                // $sale->hidden_file_number = $request->hidden_file_number;
                // $sale->due_date = $request->due_date;
                $sale->order_status = 'new';
                $sale->order_type = 'lead';
                // if ($request->status == 'mature') {
                //     $floor_detail->update(['status' => 'sold']);
                //     $sale->order_type = 'sale';
                // } else {
                //     $floor_detail->update(['status' => 'hold']);
                //     $sale->order_type = 'lead';
                // }
                $sale->save();
                $building_app_key = BuildingMobileApplication::where('property_admin_id', $building->user_id)->first();
                $customer_detail = BuildingCustomer::where('customer_id', $customer->id)->first();
                if ($customer_detail == null) {
                    $customer_detail = new BuildingCustomer();
                    $customer_detail->building_app_id = $building_app_key->app_key;
                    $customer_detail->property_admin_id = $building->user_id;
                    $customer_detail->property_manager_id = Auth::id();
                    $customer_detail->customer_id = $customer->id;
                    $customer_detail->credit = $customer->down_payment;
                    $customer_detail->save();
                } else {
                    $customer_detail->building_app_id = $building_app_key->app_key;
                    $customer_detail->property_admin_id = $building->user_id;
                    $customer_detail->property_manager_id = Auth::id();
                    $customer_detail->customer_id = $customer->id;
                    $customer_detail->credit = $customer->down_payment;
                    $customer_detail->save();
                }
                if ($sale) {
                    for ($i = 0; count($total_price) > $i; $i++) {
                        if ($total_price[$i] == null) {
                            continue;
                        } else {
                            BuildingSaleInstallment::create([
                                'floor_detail_id' => $request->floor_detail_id,
                                'building_sale_id' => $sale->id,
                                'title' => $title[$i],
                                'installment_amount' => $total_price[$i],
                                'due_date' => $due_data->addMonth(),
                                'type' => 'installment',
                                'status' => 'not_paid',
                            ]);
                        }
                    }
                    //notification Update
                    (new NotificationHelper)->web_panel_notification('lead_mature');
                    (new NotificationHelper)->web_panel_notification('lead_add');
                    return redirect()->route('property_manager.sale.lead.index')->with($this->message('Property Sale Lead Create Successfully', 'success'));

                }
            } else {
                return redirect()->back()->with($this->message('Property installment plan calculation problem Please check your plan calculation! Total Calculation:' . array_sum($total_price) . ' Total Price:' . $floor_detail->total_price, 'error'));
            }
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
    public function edit($id)
    {

        $building_sale = BuildingSale::with('customer')->where(['sale_person_id' => Auth::id(), 'order_type' => 'lead'])->findOrFail($id);
        $building = Building::where('sale_manager_id', $building_sale->sale_manager_id)->get();
        return view('sale_person.sale.lead.edit', compact('building_sale', 'building'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'building_id' => 'required',
            'interested_in' => 'required',
            'source' => 'required',
            'username' => 'required',
            'phone_number' => 'required',
        ]);
        $property_admin_id = BuildingEmployee::where('employee_id', Auth::id())->first()->property_admin_id;
        $building = Building::where('user_id', $property_admin_id)->first();
        $user = User::where(['phone_number' => $request->phone_number])->first();
        if ($user == null) {
            $customer = new User();
            $customer->username = $request->username;
            $customer->father_name = $request->father_name;
            $customer->cnic = $request->cnic;
            $customer->email = $request->email;
            $customer->phone_number = $request->phone_number;
            $customer->password = Hash::make($request->password);
            $customer->save();
            $role = Role::where('name', 'user')->first();
            $customer->assignRole($role);
            $user = $customer;
        }
        $sale = BuildingSale::findOrFail($id);
        $sale->building_id = $request->building_id;
        $sale->floor_detail_id = $request->floor_detail_id;
        $sale->customer_id = $user->id;
        $sale->property_admin_id = $building->user_id;
        $sale->interested_in = $request->interested_in;
        $sale->source = $request->source;
        $sale->sale_person_id = Auth::id();
        $sale->order_status = 'new';
        $sale->order_type = 'lead';
        $sale->save();
        if ($sale) {
            (new NotificationHelper)->web_panel_notification('lead_add');

            return redirect()->route('sale_person.sale.lead.index')->with($this->message('Property Sale Lead Create Successfully', 'success'));
        } else {
            return redirect()->back()->with($this->message('Property Sale Lead Receipt Create Error', 'danger'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /*public function lead_assign(Request $request)
    {
        $request->validate([
            'sale' => 'required',
        ]);
        $assign_lead = BuildingSale::where(['sale_manager_id' => Auth::id(), 'order_type' => 'lead', 'sale_person_id' => null])->whereIn('id', $request->sale)->update([
            'sale_person_id' => $request->sale_person,
        ]);
        if ($assign_lead) {
            return redirect()->back()->with($this->message('Lead Assign Successfully', 'success'));
        } else {
            return redirect()->back()->with($this->message('Lead Assign Error', 'error'));
        }
    }*/


    public function filter(Request $request)
    {
        $sales_person = $request->sales_person;
        $status = $request->status;
        $filter_date = $request->filter_date;
        $building = Building::where('manager_id', Auth::id())->get();
        if ($sales_person) {

            $sales = BuildingSale::with('customer')->where('property_admin_id', $building[0]->user_id)->where(['order_type' => 'lead'])->where('sale_person_id', $request->sales_person)->get();
        }
        if ($status) {

            $sales = BuildingSale::with('customer')->where('property_admin_id', $building[0]->user_id)->where(['order_type' => 'lead'])->where('order_status', $request->status)->get();
        }
        if ($filter_date) {
            $current_date = Carbon::now();
            if ($filter_date == 'today') {
                $sales = BuildingSale::with('customer')->where('property_admin_id', $building[0]->user_id)->where(['order_type' => 'lead'])->whereDate('created_at', $current_date)->get();

            } else if ($filter_date == 'yesterday') {
                $date = Carbon::now()->subDay();
                $sales = BuildingSale::with('customer')->where('property_admin_id', $building[0]->user_id)->where(['order_type' => 'lead'])->whereDate('created_at', $date)->get();

            } else if ($filter_date == 'this_week') {
                $date = Carbon::now()->subDays(7);
                $sales = BuildingSale::with('customer')->where('property_admin_id', $building[0]->user_id)->where(['order_type' => 'lead'])->whereBetween('created_at', [$date, $current_date])->get();

            } else if ($filter_date == 'this_month') {
                $month = Carbon::now()->format('m');
                $year = Carbon::now()->format('Y');
                $sales = BuildingSale::with('customer')->where('property_admin_id', $building[0]->user_id)->where(['order_type' => 'lead'])->whereMonth('created_at', $month)->whereYear('created_at', $year)->get();
            } else {
                $last_month = Carbon::now()->subMonth();
                $month = $last_month->format('m');
                $year = $last_month->format('Y');
                $sales = BuildingSale::with('customer')->where('property_admin_id', $building[0]->user_id)->where(['order_type' => 'lead'])->whereMonth('created_at', $month)->whereYear('created_at', $year)->get();
            }
        }
        $sale_person = BuildingEmployee::with('user')->where('job_title', 'sale_person')->where('property_admin_id', $building[0]->user_id)->get();
        return view('property_manager.sale.lead.index', compact('sales', 'building', 'sale_person'));
    }

    public function search(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $country = $request->country;
        $number = $request->number;

        $building = Building::where('manager_id', Auth::id())->get();

        if (!($id) && !($name) && !($country) && !($number)) {
            $sales = BuildingSale::with('customer')->where('property_admin_id', $building[0]->user_id)->where(['order_type' => 'lead'])->get();
        } else {
            $sales = BuildingSale::with('floor_detail', 'customer')
                ->where('property_admin_id', $building[0]->user_id)
                ->where(['order_type' => 'lead'])
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


        $sale_person = BuildingEmployee::with('user')->where('job_title', 'sale_person')->where('property_admin_id', $building[0]->user_id)->get();
        return view('property_manager.sale.lead.index', compact('sales', 'building', 'sale_person'));
    }

    public function searchByDate(Request $request)
    {
        $building = Building::where('manager_id', Auth::id())->get();
        $from = $request->from;
        $to = $request->to;
        if (!($from) || !($to)) {
            return redirect()->route('property_manager.sale.lead.index')->with($this->message('Invalid Date Selected', 'error'));
        } else {
            if ($from > $to) {
                return redirect()->route('property_manager.sale.lead.index')->with($this->message('Invalid Date Selected', 'error'));

            } else {
                $from = Carbon::parse($from);
                $to = Carbon::parse($to)->addDay();
                $sales = BuildingSale::with('customer')->where('property_admin_id', $building[0]->user_id)->where(['order_type' => 'lead'])->whereBetween('created_at', [$from, $to])->get();

                $sale_person = BuildingEmployee::with('user')->where('job_title', 'sale_person')->where('property_admin_id', $building[0]->user_id)->get();
                return view('property_manager.sale.lead.index', compact('sales', 'building', 'sale_person'));

            }
        }

    }

    public function changeStatus(Request $request)
    {
        $this->validate($request, [
            'date' => 'required',
            'comment' => 'required'
        ]);
        $sale = BuildingSale::find($request->id);
        if ($request->status == 'mature') {
            $sale->order_type = "sale";
        }
        $sale->order_status = $request->status;

        $sale->update();

        $data = [
            'date' => $request->date,
            'comment' => $request->comment,
            'status' => $request->status
        ];
        $history = new BuildingSaleHistory;
        $history->building_sale_id = $request->id;
        $history->key = 'lead';
        $history->data = json_encode($data);
        $history->save();
        if ($sale && $history) {
            return redirect()->back()->with($this->message('Status Updated Successfully', 'success'));
        }

    }

    public function changePriority($priority, $id)
    {
        $sale = BuildingSale::find($id);

        $sale->priority = $priority;

        $sale->update();

        if ($sale) {
            return redirect()->back()->with($this->message('Priority Updated Successfully', 'success'));

        }

    }

    public function buildingInfo($building_id)
    {
        $building = Building::find($building_id);
        $building_employee = BuildingEmployee::with('user')->where('building_id', $building_id)->get();
        $data = [
            'types' => json_decode($building->type),
            'sales_person' => $building_employee
        ];
        return $data;
    }

    public function comments($id)
    {
        $comments = BuildingSaleHistory::where('building_sale_id', $id)->where('key', 'lead')->get();
        return view('sale_person.sale.lead.comments', compact('comments'));
    }
}
