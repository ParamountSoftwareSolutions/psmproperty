<?php

namespace App\Http\Controllers\Property;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\BuildingCustomer;
use App\Models\BuildingSale;
use App\Models\BuildingSaleInstallment;
use App\Models\FloorDetail;
use App\Models\PropertySale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $sales = BuildingSale::where('property_admin_id', Auth::id())->get();
        return view('property.sale.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $building = Building::where('user_id', Auth::id())->get()->pluck('id')->toArray();
        $floor_detail = FloorDetail::whereIn('building_id', $building)->get();
        return view('property.sale.create', compact('floor_detail'));
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
            'floor_detail_id' => 'required',
            'registration_number' => 'required',
            'due_date' => 'required',
        ]);
        $customer = new User();
        $customer->username = $request->username;
        $customer->email = $request->email;
        $customer->password = Hash::make($request->password);
        $customer->phone_number = $request->phone_number;
        //$customer->save();

        $sale = new BuildingSale();
        $sale->floor_detail_id = $request->floor_detail_id;
        $sale->customer_id = $customer->id;
        $sale->property_admin_id = Auth::id();
        $sale->down_payment = $request->down_payment;
        $sale->registration_number = $request->registration_number;
        $sale->hidden_file_number = $request->hidden_file_number;
        //$sale->save();

        $floor_detail = FloorDetail::where('id', $request->floor_detail_id)->first();
        dd($floor_detail);
        $customer = new BuildingCustomer();
        $customer->property_admin_id = Auth::id();
        $customer->building_id = $request->email;
        $customer->customer_id = $customer->id;
        $customer->phone_number = $request->phone_number;
        $customer->save();

        for ($i = 0; $floor_detail->total_month_installment > $i; $i++) {
            $customer_installment = new BuildingSaleInstallment();
            $customer_installment->floor_detail_id = $request->floor_detail_id;
            $customer_installment->building_sale_id = $sale->id;
            $customer_installment->installment_amount = $floor_detail->per_month_installment;
            $customer_installment->due_date = $request->due_date;
            $customer_installment->status = 'not_paid';
            $customer_installment->save();
        }
        if ($sale) {
            return redirect()->route('property_admin.sale.index')->with($this->message('Property Sale Create Successfully', 'success'));
        } else {
            return redirect()->back()->with($this->message('Property Sale Receipt Create Error', 'danger'));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $building = Building::where('user_id', Auth::id())->get()->pluck('id')->toArray();
        $floor_detail = FloorDetail::whereIn('building_id', $building)->get();
        $building_sale_installment = BuildingSaleInstallment::with('building_sale')->where('building_sale_id', $id)->get();

        return view('property.sale.show', compact('building_sale_installment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $building = Building::where('user_id', Auth::id())->get()->pluck('id')->toArray();
        $floor_detail = FloorDetail::whereIn('building_id', $building)->get();
        $building_sale = BuildingSale::where('id', $id)->where('property_admin_id', Auth::id())->first();

        return view('property.sale.edit', compact('building_sale', 'floor_detail', 'building_sale'));
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
            'floor_detail_id' => 'required',
            'registration_number' => 'required',
        ]);

        $sale = BuildingSale::findOrFail($id);
        $sale->floor_detail_id = $request->floor_detail_id;
        $sale->property_admin_id = Auth::id();
        $sale->down_payment = $request->down_payment;
        $sale->registration_number = $request->registration_number;
        $sale->hidden_file_number = $request->hidden_file_number;
        $sale->save();
        $customer = User::where('id', $sale->customer->id)->first();
        $customer->username = $request->username;
        $customer->email = $request->email;
        $customer->password = Hash::make($request->password);
        $customer->phone_number = $request->phone_number;
        $customer->save();

        /*$floor_detail = FloorDetail::where('id', $request->floor_deetail_id)->first();*/

        /*$customer_installment = new BuildingSaleInstallment();
        $customer_installment->floor_detail_id = $request->floor_detail_id;
        $customer_installment->installment_amount =*/
        if ($sale) {
            return redirect()->route('property_admin.sale.index')->with($this->message('Property Sale Update Successfully', 'success'));
        } else {
            return redirect()->back()->with($this->message('Property Sale Receipt Create Error', 'danger'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $sale = BuildingSale::findOrFail($id);
        $sale->delete();
        if ($sale) {
            return redirect()->route('property_admin.sale.index')->with($this->message('Property Sale Delete Successfully', 'success'));
        } else {
            return redirect()->back()->with($this->message('Property Sale Receipt Delete Error', 'danger'));
        }
    }
}
