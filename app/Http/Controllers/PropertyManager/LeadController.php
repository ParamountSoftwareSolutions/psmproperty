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
        $sales = BuildingSale::with('building_sale_history')->whereIn('building_id', $building->pluck('id')->toArray());
        if (Auth::user()->roles[0]->name == 'sale_person') {
            $sales->where('user_id', Auth::id());
        }
        $sales = $sales->where(['order_type' => 'lead'])->get();
        $sale_person = User::whereHas('building_employee', function ($q) use ($building) {
            $q->whereIn('building_id', $building->pluck('id')->toArray());
        })
            ->whereHas('roles', function ($q) {
                $q->WhereIn('name', ['sale_person', 'office_staff', 'accountant']);
            })
            ->get();
        $payment_plan = BuildingPaymentPlan::where('property_admin_id', Helpers::user_admin())->get();
        $salesCount = BuildingSale::with('building_sale_history')->whereIn('building_id', $building->pluck('id')->toArray())->where(['order_type' => 'lead'])
            ->whereHas('building_sale_history', function ($q) {
                $q->where('data->status', 'arrange_meeting');
                $q->where('data->date', '>=', Carbon::now()->format('Y-m-d'));
            })->get();
        $arrange = 0;
        $pushed = 0;
        foreach ($salesCount as $val) {
            if ($val->building_sale_history->count() == '1') {
                $arrange++;
            }
            if ($val->building_sale_history->count() > '1') {
                $pushed++;
            }
        }
        // dd($arrange,$salesCount);
        return view('property_manager.sale.lead.index', compact('sales', 'building', 'sale_person', 'payment_plan', 'arrange', 'pushed'));
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
        return view('property_manager.sale.lead.create', compact('building', 'country'));
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'building_id' => 'required',
            'interested_in' => 'required',
            'source' => 'required',
            'username' => 'required',
            'phone_number' => 'required|unique:users',
        ]);
        if (Auth::user()->roles[0]->name !== 'sale_person') {
            $request->validate([
                'sale_person_id' => 'required',
            ]);
        }
        if ($request->status == 'mature') {
            $request->validate([
                'floor_detail_id' => 'required',
                'status' => 'required',
            ]);
        }
        //dd();
        $building = Helpers::building_detail();

        //$installment = (new Helpers)->installment($request);
        //if (array_sum($installment['total_price']) == $installment['payment_plan']->total_price) {
        $sale = (new Helpers)->sale_and_customer($request, $building, 'lead', '');
        if ($sale) {
            // dd($sale);
            //FloorDetail::where('id', $request->floor_detail_id)->update(['status' => 'hold']);
            //(new NotificationHelper)->web_panel_notification('lead_mature');
            (new NotificationHelper)->web_panel_notification('lead_add');

            //(new Helpers)->customer_create($building, $sale['customer']);
            //(new Helpers)->create_installment_plan($sale['sale'], $installment, $request);


            return redirect()->route('property_manager.sale.lead.index', (new Helpers)->user_login_route()['panel'])->with($this->message('Property Sale Lead Create Successfully', 'success'));
        }
        /* } else {
             return redirect()->back()->with($this->message('Property installment plan calculation problem Please check your plan calculation! Total Calculation:' .
                 array_sum($installment['total_price']) . ' Total Price:' . $floor_detail->total_price, 'error'));
         }*/

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
        $building = Helpers::building_detail();
        $building_list = Helpers::building_detail()->pluck('id')->toArray();
        $property_admin = (new Helpers)->building_detail_single();
        $floor_detail = FloorDetail::whereIn('building_id', $building_list)->get();
        $building_sale = BuildingSale::where('id', $id)->where('property_admin_id', $property_admin->user_id);
        if (Auth::user()->roles[0]->name == 'sale_person') {
            $building_sale->where('user_id', Auth::id());
        }
        $building_sale = $building_sale = $building_sale->first();

        return view('property_manager.sale.lead.edit', compact('building_sale', 'floor_detail', 'building_sale', 'building'));
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
        $request->validate([
            'building_id' => 'required',
            'interested_in' => 'required',
            'sale_person_id' => 'required',
            'source' => 'required',
            'username' => 'required',
            'phone_number' => 'required',
        ]);
        $building = (new Helpers)->building_detail_single();

        //$installment = (new Helpers)->installment($request);
        //if (array_sum($installment['total_price']) == $installment['payment_plan']->total_price) {
        $sale = (new Helpers)->sale_and_customer($request, $building, 'lead', $id);
        if ($sale) {
            //FloorDetail::where('id', $request->floor_detail_id)->update(['status' => 'hold']);
            //(new NotificationHelper)->web_panel_notification('lead_mature');
            (new NotificationHelper)->web_panel_notification('lead_update');

            //(new Helpers)->customer_create($building, $sale['customer']);
            //(new Helpers)->create_installment_plan($sale['sale'], $installment, $request);

            return redirect()->route('property_manager.sale.lead.index', (new Helpers)->user_login_route()['panel'])->with($this->message('Property Sale Lead Update Successfully', 'success'));
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
        User::find($sale->customer_id)->delete();
        $floor_detail = FloorDetail::where('id', $sale->floor_detail_id)->first();
        if ($floor_detail !== null) {
            $floor_detail->status = 'available';
            $floor_detail->save();
        }

        if ($sale) {
            return redirect()->route('property_manager.sale.lead.index', (new Helpers)->user_login_route()['panel'])->with($this->message('Property Sale Lead Delete Successfully', 'success'));
        } else {
            return redirect()->back()->with($this->message('Property Sale Lead Receipt Delete Error', 'danger'));
        }
    }

    public function lead_assign(Request $request)
    {
        if ($request->sale_id !== null) {
            $assign_lead = BuildingSale::where(['order_type' => 'lead'])->whereIn('id', explode(',', $request->sale_id))
                ->update([
                    'user_id' => $request->sale_person_id,
                ]);
            if ($assign_lead) {
                return redirect()->back()->with($this->message('Lead Assign Successfully', 'success'));
            } else {
                return redirect()->back()->with($this->message('Lead Assign Error', 'error'));
            }
        } else {
            return redirect()->back()->with($this->message('Please select first any lead', 'error'));
        }

    }


    public function filter(Request $request)
    {
        $sales_person = $request->sales_person;
        $status = $request->status;
        $filter_date = $request->filter_date;
        $building = Helpers::building_detail()->pluck('id')->toArray();
        if ($sales_person) {
            $sales = BuildingSale::with('customer')->whereIn('building_id', $building)->where(['order_type' => 'lead'])->where('user_id', $request->sales_person)->get();
        }
        if ($status) {
            $sales = BuildingSale::with('customer')->whereIn('building_id', $building)->where(['order_type' => 'lead'])->where('order_status', $request->status)->get();
        }
        if ($filter_date) {
            $current_date = Carbon::now();
            if ($filter_date == 'today') {
                $sales = BuildingSale::with('customer')->whereIn('building_id', $building)->where(['order_type' => 'lead'])->whereDate('created_at', $current_date)->get();

            } else if ($filter_date == 'yesterday') {
                $date = Carbon::now()->subDay();
                $sales = BuildingSale::with('customer')->whereIn('building_id', $building)->where(['order_type' => 'lead'])->whereDate('created_at', $date)->get();

            } else if ($filter_date == 'this_week') {
                $date = Carbon::now()->subDays(7);
                $sales = BuildingSale::with('customer')->whereIn('building_id', $building)->where(['order_type' => 'lead'])->whereBetween('created_at', [$date, $current_date])->get();

            } else if ($filter_date == 'this_month') {
                $month = Carbon::now()->format('m');
                $year = Carbon::now()->format('Y');
                $sales = BuildingSale::with('customer')->whereIn('building_id', $building)->where(['order_type' => 'lead'])->whereMonth('created_at', $month)->whereYear('created_at', $year)->get();
            } else {
                $last_month = Carbon::now()->subMonth();
                $month = $last_month->format('m');
                $year = $last_month->format('Y');
                $sales = BuildingSale::with('customer')->whereIn('building_id', $building)->where(['order_type' => 'lead'])->whereMonth('created_at', $month)->whereYear('created_at', $year)->get();
            }
        }
        $sale_person = User::with('building_employee')
            ->whereHas('roles', function ($q) {
                $q->where('name', 'sale_person');
            })
            ->whereHas('building_employee', function ($q) use ($building) {
                $q->whereIn('building_id', $building);
            })
            ->where('property_admin_id', Helpers::user_admin())->get();
        $salesCount = BuildingSale::with('building_sale_history')->where('building_id', $building)->where(['order_type' => 'lead'])
            ->whereHas('building_sale_history', function ($q) {
                $q->where('data->status', 'arrange_meeting');
                $q->where('data->date', '>=', Carbon::now()->format('Y-m-d'));
            })->get();
        $arrange = 0;
        $pushed = 0;
        foreach ($salesCount as $val) {
            if ($val->building_sale_history->count() == '1') {
                $arrange++;
            }
            if ($val->building_sale_history->count() > '1') {
                $pushed++;
            }
        }
        return view('property_manager.sale.lead.index', compact('sales', 'building', 'sale_person', 'arrange', 'pushed'));
    }

    public function search(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $country = $request->country;
        $number = $request->number;

        $building = Helpers::building_detail();

        if (!($id) && !($name) && !($country) && !($number)) {
            $sales = BuildingSale::with('customer')->whereIn('building_id', $building)->where(['order_type' => 'lead'])->get();
        } else {
            $sales = BuildingSale::with('floor_detail', 'customer')
                ->whereIn('building_id', $building)
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


        $sale_person = User::with('building_employee')
            ->whereHas('roles', function ($q) {
                $q->where('name', 'sale_person');
            })
            ->whereHas('building_employee', function ($q) use ($building) {
                $q->whereIn('building_id', $building);
            })
            ->where('property_admin_id', Helpers::user_admin())->get();
        $salesCount = BuildingSale::with('building_sale_history')->whereIn('building_id', $building)->where(['order_type' => 'lead'])
            ->whereHas('building_sale_history', function ($q) {
                $q->where('data->status', 'arrange_meeting');
                $q->where('data->date', '>=', Carbon::now()->format('Y-m-d'));
            })->get();
        $arrange = 0;
        $pushed = 0;
        foreach ($salesCount as $val) {
            if ($val->building_sale_history->count() == '1') {
                $arrange++;
            }
            if ($val->building_sale_history->count() > '1') {
                $pushed++;
            }
        }
        return view('property_manager.sale.lead.index', compact('sales', 'building', 'sale_person', 'arrange', 'pushed'));
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
                $sales = BuildingSale::with('customer')->whereIn('building_id', $building)->where(['order_type' => 'lead'])->whereBetween('created_at', [$from, $to])->get();

                $sale_person = User::with('building_employee')
            ->whereHas('roles', function ($q) {
                $q->where('name', 'sale_person');
            })
            ->whereHas('building_employee', function ($q) use ($building) {
                $q->whereIn('building_id', $building);
            })
            ->where('property_admin_id', Helpers::user_admin())->get();
                $salesCount = BuildingSale::with('building_sale_history')->whereIn('building_id', $building)->where(['order_type' => 'lead'])
                    ->whereHas('building_sale_history', function ($q) {
                        $q->where('data->status', 'arrange_meeting');
                        $q->where('data->date', '>=', Carbon::now()->format('Y-m-d'));
                    })->get();
                $arrange = 0;
                $pushed = 0;
                foreach ($salesCount as $val) {
                    if ($val->building_sale_history->count() == '1') {
                        $arrange++;
                    }
                    if ($val->building_sale_history->count() > '1') {
                        $pushed++;
                    }
                }
                return view('property_manager.sale.lead.index', compact('sales', 'building', 'sale_person', 'arrange', 'pushed'));
            }
        }

    }

    public function changeStatus(Request $request)
    {
        /*if ($request->status == 'mature') {
            return redirect()->back()->with($this->message('First select any property!', 'error'));
            //$sale->order_type="sale";
        } else {
            $this->validate($request, [
                'date' => 'required',
                'comment' => 'required'
            ]);
            $sale = BuildingSale::find($request->id);
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
        }*/
        $this->validate($request, [
            'date' => 'required',
            'comment' => 'required'
        ]);
        $sale = BuildingSale::find($request->id);
        if ($request->status == 'mature') {
            $sale->order_type = "sale";
            if ($sale->floor_detail_id !== null) {
                FloorDetail::where('id', $sale->floor_detail_id)->update(['status' => 'hold']);
            }
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
            return redirect()->route('property_manager.sale.lead.index', (new Helpers)->user_login_route()['panel'])->with($this->message('Status Updated Successfully', 'success'));
        }
    }

    public function changePriority($panel, $priority, $id)
    {
        $building = Helpers::building_detail()->pluck('id')->toArray();
        $sale = BuildingSale::whereIn('building_id', $building)->findOrFail($id);
        $sale->priority = $priority;
        $sale->update();

        if ($sale) {
            return redirect()->back()->with($this->message('Priority Updated Successfully', 'success'));

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
            /*$customer_id = BuildingSale::where('id', $collection['id'])->first()->customer_id;*/
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
            /*elseif ($collection['password'] === "") {
                return back()->with($this->message('Please fill row:' . ($key + 2) . ' field: password', 'error'));
            } */

//            $lead = [
//                'discount_type' => $collection['discount_type'],
//                'discount' => $collection['discount'],
//            ];
        }
        $data = [];
        $data2 = [];
        $data3 = [];
        $data4 = [];

        $property_admin_id = Building::where('manager_id', Auth::id())->first()->user_id;
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
                        'property_admin_id' => $property_admin_id,
                        'customer_id' => $user->id,
                        'interested_in' => $collection['interested_in'],
                        'source' => $collection['source'],
                        'sale_person_id' => $collection['sale_person_id'],
                    ]);
                } else {
                    $user->update([
                        'username' => $collection['username'],
                        'phone_number' => $collection['phone_number'],
                    ]);
                    BuildingSale::where('customer_id', $user->id)->update([
                        'building_id' => $collection['building_id'],
                        'property_admin_id' => $property_admin_id,
                        'customer_id' => $user->id,
                        'interested_in' => $collection['interested_in'],
                        'source' => $collection['source'],
                        'sale_person_id' => $collection['sale_person_id'],
                    ]);
                    /*return back()->with($this->message('Index Key:' . ($key) . ' Phone Number Duplicate!', 'error'));*/
                }
            } else {
                /*$user = User::where('phone_number', $collection['phone_number'])->get()->count();
                if ($user == 1) {*/
                BuildingSale::where('id', $collection['id'])->update([
                    'id' => $collection['id'],
                    'building_id' => $collection['building_id'],
                    'property_admin_id' => $property_admin_id,
                    'interested_in' => $collection['interested_in'],
                    'source' => $collection['source'],
                    'sale_person_id' => $collection['sale_person_id'],
                ]);
                $customer_id = BuildingSale::where('id', $collection['id'])->first()->customer_id;
                User::where('id', $customer_id)->update([
                    'username' => $collection['username'],
                    'phone_number' => $collection['phone_number'],
                ]);
                /*} else {
                    return back()->with($this->message('Index Key:' . ($key) . ' Phone Number Duplicate!', 'error'));
                }*/
            }
        }
        return back()->with($this->message('Leads imported successfully!', 'success'));
    }

    public function bulk_export_data()
    {
        $building = Helpers::building_detail();
        $sales = BuildingSale::with('customer')->whereIn('building_id', $building);
        if (Auth::user()->roles[0]->name == 'sale_person') {
            $sales->where('user_id', Auth::id());
        }
        $sales = $sales->where(['order_type' => 'lead'])->get();
        $storage = [];
        foreach ($sales as $item) {
            //dd();
            /*$category_id = 0;
            $sub_category_id = 0;
            $child_category_id = 0;*/

            /*foreach (json_decode($item->category_ids, true) as $category) {
                if ($category['position'] == 0) {
                    $category_id = (int) $category['id'];
                } else if ($category['position'] == 1) {
                    $sub_category_id = (int) $category['id'];
                } else if ($category['position'] == 2) {
                    $child_category_id = (int) $category['id'];
                }
            }*/

            /*if (!isset($item['description'])) {
                $item['description'] = 'No description available';
            }*/

            /*if (!isset($item['capacity'])) {
                $item['capacity'] = 0;
            }*/

            $storage[] = [
                'id' => $item['id'],
                'building_id' => $item['building_id'],
                //'customer_id' => $item['customer_id'],
                'interested_in' => $item['interested_in'],
                'source' => $item['source'],
                'sale_person_id' => $item['sale_person_id'],
                'username' => $item['customer']['username'],
                'phone_number' => $item['customer']['phone_number'],
            ];

        }
        return (new FastExcel($storage))->download('/public/panel/assets/lead.xlsx');
    }

    public function pushed(Request $request)
    {
        $building = Helpers::building_detail();
        $sales = BuildingSale::with('building_sale_history')->whereIn('building_id', $building)->where(['order_type' => 'lead'])
            ->whereHas('building_sale_history', function ($q) {
                $q->where('data->status', 'arrange_meeting');
                $q->where('data->date', '>=', Carbon::now()->format('Y-m-d'));
            })->get();
        $sale_person = User::with('building_employee')
            ->whereHas('roles', function ($q) {
                $q->where('name', 'sale_person');
            })
            ->whereHas('building_employee', function ($q) use ($building) {
                $q->whereIn('building_id', $building);
            })
            ->where('property_admin_id', Helpers::user_admin())->get();
        $payment_plan = BuildingPaymentPlan::where('property_admin_id', Helpers::user_admin())->get();
        $arrange = 0;
        $pushed = 0;
        foreach ($sales as $val) {
            if ($val->building_sale_history->count() == '1') {
                $arrange++;
            }
            if ($val->building_sale_history->count() > '1') {
                $pushed++;
            }
        }
        return view('property_manager.sale.lead.index', compact('sales', 'building', 'sale_person', 'payment_plan', 'arrange', 'pushed'));
    }

    public function arrange(Request $request)
    {
        $building = Helpers::building_detail();
        $sales = BuildingSale::with('building_sale_history')->whereIn('building_id', $building)->where(['order_type' => 'lead'])
            ->whereHas('building_sale_history', function ($q) {
                $q->where('data->status', 'arrange_meeting');
                $q->where('data->date', '>=', Carbon::now()->format('Y-m-d'));
            })->get();
        $arrange = 0;
        $pushed = 0;
        foreach ($sales as $val) {
            if ($val->building_sale_history->count() == '1') {
                $arrange++;
            }
            if ($val->building_sale_history->count() > '1') {
                $pushed++;
            }
        }
        $sale_person = User::with('building_employee')
            ->whereHas('roles', function ($q) {
                $q->where('name', 'sale_person');
            })
            ->whereHas('building_employee', function ($q) use ($building) {
                $q->whereIn('building_id', $building);
            })
            ->where('property_admin_id', Helpers::user_admin())->get();
        $payment_plan = BuildingPaymentPlan::where('property_admin_id', Helpers::user_admin())->get();
        return view('property_manager.sale.lead.index', compact('sales', 'building', 'sale_person', 'payment_plan', 'arrange', 'pushed'));
    }


}
