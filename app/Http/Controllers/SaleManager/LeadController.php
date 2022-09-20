<?php

namespace App\Http\Controllers\SaleManager;

use App\Helpers\NotificationHelper;
use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\BuildingCustomer;
use App\Models\BuildingEmployee;
use App\Models\BuildingMobileApplication;
use App\Models\BuildingSale;
use App\Models\BuildingSaleHistory;
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
        $building = Building::where('sale_manager_id', Auth::id())->get();
        $sales = BuildingSale::with('customer')->where(['property_admin_id' => $building[0]->user_id])->where(['order_type' => 'lead'])->get();
        $sale_person = BuildingEmployee::with('user')->where('job_title', 'sale_person')->where('sale_manager_id', Auth::id())->get();
        return view('sale_manager.sale.lead.index', compact('sales', 'building', 'sale_person'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $building = Building::where('sale_manager_id', Auth::id())->get();
        $client_id = BuildingCustomer::where('property_admin_id', $building[0]->user_id)->get()->pluck('customer_id');
        return view('sale_manager.sale.lead.create', compact('building'));
    }

    public function building($id)
    {
        $building = Building::where('sale_manager_id', Auth::id())->where('id', $id)->first();
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
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'building_id'=>'required',
            'interested_in'=>'required',
            'sale_person_id'=>'required',
            'source'=>'required',
            'username'=>'required',
            'phone_number'=>'required',
        ]);
        $building = Building::where('sale_manager_id', Auth::id())->first();
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
            $user=$customer;
        }
        $sale = new BuildingSale();
        $sale->building_id = $request->building_id;
        $sale->floor_detail_id = $request->floor_detail_id;
        $sale->customer_id = $user->id;
        $sale->property_admin_id = $building->user_id;
        $sale->interested_in = $request->interested_in;
        $sale->source = $request->source;
        $sale->sale_person_id = $request->sale_person_id;
        $sale->order_status = 'new';
        $sale->order_type = 'lead';
        $sale->save();
        if ($sale) {
            (new NotificationHelper)->web_panel_notification('lead_add');

            return redirect()->route('sale_manager.sale.lead.index')->with($this->message('Property Sale Lead Create Successfully', 'success'));
        } else {
            return redirect()->back()->with($this->message('Property Sale Lead Receipt Create Error', 'danger'));
        }
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
        $building = Building::where('sale_manager_id', Auth::id())->get();
        $building_sale = BuildingSale::with('customer')->where(['property_admin_id' => $building[0]->user_id, 'order_type' => 'lead'])->findOrFail($id);
        $sale_person = BuildingEmployee::with('user')->where('job_title', 'sale_person')->where('sale_manager_id', Auth::id())->get();
        return view('sale_manager.sale.lead.edit', compact('building_sale', 'building', 'sale_person'));

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
            'sale_person_id' => 'required',
            'source' => 'required',
            'username' => 'required',
            'phone_number' => 'required',
        ]);
        $building = Building::where('sale_manager_id', Auth::id())->first();

        $sale = BuildingSale::findOrFail($id);
        $sale->floor_detail_id = $request->floor_detail_id;
        $sale->property_admin_id = $building->user_id;
        $sale->registration_number = $request->registration_number;
        $sale->hidden_file_number = $request->hidden_file_number;
        $sale->due_date = $request->due_date;
        $sale->order_status = $request->status;
        $sale->comment = $request->comment;
        if ($request->status == 'mature') {
            $sale->order_type = 'sale';
        } else {
            $sale->order_type = 'lead';
        }
        $sale->save();
        if ($sale) {
            //notification Update
            (new NotificationHelper)->web_panel_notification('lead_update');
        }
        $customer = User::findOrFail($sale->customer_id);
        $customer->username = $request->username;
        $customer->father_name = $request->father_name;
        $customer->cnic = $request->cnic;
        $customer->email = $request->email;
        $customer->phone_number = $request->phone_number;
        $customer->save();
        $role = Role::where('name', 'user')->first();
        $customer->assignRole($role);
        if ($request->status == 'mature') {
            FloorDetail::where('id', $request->floor_detail_id)->update(['status' => 'sold']);
            $app_key = BuildingMobileApplication::where('property_admin_id', $building->user_id)->first();
            $customer_data = BuildingCustomer::where(['customer_id' => $customer->id])->first();
            if ($customer_data == null) {
                $customer_data = new BuildingCustomer();
                $customer_data->building_app_id = $app_key->id;
                $customer_data->property_admin_id = $building->user_id;
                $customer_data->sale_manager_id = Auth::id();
                $customer_data->customer_id = $customer->id;
                $customer_data->save();
            } else {
                $customer_data->building_app_id = $app_key->id;
                $customer_data->property_admin_id = $building->user_id;
                $customer_data->sale_manager_id = Auth::id();
                $customer_data->customer_id = $customer->id;
                $customer_data->save();
            }
        }
        if ($sale) {
            return redirect()->route('sale_manager.sale.lead.index')->with($this->message('Property Sale Lead Update Successfully', 'success'));
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

    public function lead_assign(Request $request)
    {
        if($request->sale_id !== null){
            $assign_lead = BuildingSale::where(['sale_manager_id' => Auth::id(), 'order_type' => 'lead', 'sale_person_id' => null])->whereIn('id', explode(',', $request->sale_id))
                ->update([
                    'sale_person_id' => $request->sale_person_id,
                ]);
            if ($assign_lead) {
                return redirect()->back()->with($this->message('Lead Assign Successfully', 'success'));
            } else {
                return redirect()->back()->with($this->message('Lead Assign Error', 'error'));
            }
        } else{
            return redirect()->back()->with($this->message('Please select first any lead', 'error'));
        }

    }


    public function filter(Request $request)
    {
        $sales_person=$request->sales_person;
        $status=$request->status;
        $filter_date=$request->filter_date;
        $building = Building::where('sale_manager_id', Auth::id())->get();
        if($sales_person){

            $sales = BuildingSale::with('customer')->where('property_admin_id', $building[0]->user_id)->where(['order_type' => 'lead'])->where('sale_person_id',$request->sales_person)->get();
        }
        if($status){

            $sales = BuildingSale::with('customer')->where('property_admin_id', $building[0]->user_id)->where(['order_type' => 'lead'])->where('order_status',$request->status)->get();
        }
        if($filter_date)
        {
            $current_date=Carbon::now();
            if($filter_date == 'today')
            {
                $sales = BuildingSale::with('customer')->where('property_admin_id', $building[0]->user_id)->where(['order_type' => 'lead'])->whereDate('created_at',$current_date)->get();

            }

            else if($filter_date == 'yesterday')
            {
                $date=Carbon::now()->subDay();
                $sales = BuildingSale::with('customer')->where('property_admin_id', $building[0]->user_id)->where(['order_type' => 'lead'])->whereDate('created_at',$date)->get();

            }

            else if($filter_date == 'this_week')
            {
                $date=Carbon::now()->subDays(7);
                $sales = BuildingSale::with('customer')->where('property_admin_id', $building[0]->user_id)->where(['order_type' => 'lead'])->whereBetween('created_at',[$date,$current_date])->get();

            }

            else if($filter_date == 'this_month')
            {
                $month=Carbon::now()->format('m');
                $year=Carbon::now()->format('Y');
                $sales = BuildingSale::with('customer')->where('property_admin_id', $building[0]->user_id)->where(['order_type' => 'lead'])->whereMonth('created_at',$month)->whereYear('created_at',$year)->get();
            }

            else
            {
                $last_month=Carbon::now()->subMonth();
                $month=$last_month->format('m');
                $year=$last_month->format('Y');
                $sales = BuildingSale::with('customer')->where('property_admin_id', $building[0]->user_id)->where(['order_type' => 'lead'])->whereMonth('created_at',$month)->whereYear('created_at',$year)->get();
            }
        }
        $sale_person = BuildingEmployee::with('user')->where('job_title', 'sale_person')->where('property_admin_id', $building[0]->user_id)->get();
        return view('sale_manager.sale.lead.index', compact('sales', 'building','sale_person'));
    }

    public function search(Request $request)
    {
        $id=$request->id;
        $name=$request->name;
        $country=$request->country;
        $number=$request->number;

        $building = Building::where('sale_manager_id', Auth::id())->get();

        if(!($id) && !($name) && !($country) && !($number))
        {
            $sales = BuildingSale::with('customer')->where('property_admin_id', $building[0]->user_id)->where(['order_type' => 'lead'])->get();
        }
        else
        {
            $sales = BuildingSale::with('floor_detail','customer')
                ->where('property_admin_id', $building[0]->user_id)
                ->where(['order_type' => 'lead'])
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


        $sale_person = BuildingEmployee::with('user')->where('job_title', 'sale_person')->where('property_admin_id', $building[0]->user_id)->get();
        return view('sale_manager.sale.lead.index', compact('sales', 'building','sale_person'));
    }

    public function searchByDate(Request $request)
    {
        $building = Building::where('sale_manager_id', Auth::id())->get();
        $from=$request->from;
        $to=$request->to;
        if(!($from) || !($to))
        {
            return redirect()->route('sale_manager.sale.lead.index')->with($this->message('Invalid Date Selected', 'error'));
        }
        else
        {
            if($from > $to)
            {
                return redirect()->route('sale_manager.sale.lead.index')->with($this->message('Invalid Date Selected', 'error'));

            }
            else
            {
                $from=Carbon::parse($from);
                $to=Carbon::parse($to)->addDay();
                $sales = BuildingSale::with('customer')->where('property_admin_id', $building[0]->user_id)->where(['order_type' => 'lead'])->whereBetween('created_at',[$from,$to])->get();

                $sale_person = BuildingEmployee::with('user')->where('job_title', 'sale_person')->where('property_admin_id', $building[0]->user_id)->get();
                return view('sale_manager.sale.lead.index', compact('sales', 'building','sale_person'));

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
        if($request->status == 'mature')
        {
            $sale->order_type="sale";
        }
        $sale->order_status=$request->status;
        $sale->update();

        $data=[
            'date'=>$request->date,
            'comment'=>$request->comment,
            'status'=>$request->status
        ];
        $history=new BuildingSaleHistory;
        $history->building_sale_id=$request->id;
        $history->key='lead';
        $history->data=json_encode($data);
        $history->save();
        if($sale && $history)
        {
            return redirect()->back()->with($this->message('Status Updated Successfully', 'success'));
        }

    }

    public function changePriority($priority,$id)
    {
        $sale =BuildingSale::find($id);
        $sale->priority=$priority;
        $sale->update();
        if($sale)
        {
            return redirect()->back()->with($this->message('Priority Updated Successfully', 'success'));
        }

    }

    public function buildingInfo($building_id)
    {
        $building=Building::find($building_id);
        $building_employee=BuildingEmployee::with('user')->where('building_id',$building_id)->get();
        $data=[
            'types'=>json_decode($building->type),
            'sales_person'=>$building_employee
        ];
        return $data;
    }

    public function comments($id)
    {
        $comments=BuildingSaleHistory::where('building_sale_id',$id)->where('key','lead')->get();
        return view('sale_manager.sale.lead.comments',compact('comments'));
    }
}
