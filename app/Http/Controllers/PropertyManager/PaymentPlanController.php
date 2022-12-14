<?php

namespace App\Http\Controllers\PropertyManager;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\BuildingOfficeExpense;
use App\Models\BuildingPaymentPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $payment_plan = BuildingPaymentPlan::where('property_admin_id', Helpers::user_admin())->get();
        return view('property_manager.payment_plan.index', compact('payment_plan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('property_manager.payment_plan.create');
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
            'total_price' => 'required',
            'booking_price' => 'required',
            'per_month_installment' => 'required',
            'balloting_price' => 'required',
            'possession_price' => 'required',
            'total_month_installment' => 'required',
        ]);
        $payment_plan = new BuildingPaymentPlan();
        $payment_plan->property_admin_id = Helpers::user_admin();
        $payment_plan->name = $request->name;
        $payment_plan->total_month_installment = $request->total_month_installment;
        $payment_plan->total_price = $request->total_price;
        $payment_plan->booking_price = $request->booking_price;
        $payment_plan->per_month_installment = $request->per_month_installment;
        $payment_plan->half_year_installment = $request->half_year_installment;
        $payment_plan->quarterly_payment = $request->quarterly_payment;
        $payment_plan->balloting_price = $request->balloting_price;
        $payment_plan->possession_price = $request->possession_price;
        $payment_plan->rent_price = $request->rent_price;
        $payment_plan->number_of_payment = $request->number_of_payment;
        $payment_plan->confirmation_amount = $request->confirmation_amount;
        $payment_plan->save();
        if($payment_plan){
            return redirect()->route('property_manager.payment_plan.index')->with(['alert' => 'success', 'message' =>  'Payment Plan Create Successfully']);
        } else{
            return redirect()->back()->with(['alert' => 'error', 'message' =>  'Payment Plan Create Error']);
        }
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
        $payment_plan = BuildingPaymentPlan::where('property_admin_id', Helpers::user_admin())->findOrFail($id);
        return view('property_manager.payment_plan.edit', compact('payment_plan'));
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
            'total_price' => 'required',
            'booking_price' => 'required',
            'per_month_installment' => 'required',
            'balloting_price' => 'required',
            'possession_price' => 'required',
        ]);
        $payment_plan = BuildingPaymentPlan::findOrFail($id);
        $payment_plan->property_admin_id = Helpers::user_admin();
        $payment_plan->name = $request->name;
        $payment_plan->total_month_installment = $request->total_month_installment;
        $payment_plan->total_price = $request->total_price;
        $payment_plan->booking_price = $request->booking_price;
        $payment_plan->per_month_installment = $request->per_month_installment;
        $payment_plan->half_year_installment = $request->half_year_installment;
        $payment_plan->quarterly_payment = $request->quarterly_payment;
        $payment_plan->balloting_price = $request->balloting_price;
        $payment_plan->possession_price = $request->possession_price;
        $payment_plan->rent_price = $request->rent_price;
        $payment_plan->number_of_payment = $request->number_of_payment;
        $payment_plan->confirmation_amount = $request->confirmation_amount;
        $payment_plan->save();
        if($payment_plan){
            return redirect()->route('property_manager.payment_plan.index')->with(['alert' => 'success', 'message' =>  'Payment Plan Update Successfully']);
        } else{
            return redirect()->back()->with(['alert' => 'error', 'message' =>  'Payment Plan Update Error']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $payment_plan = BuildingPaymentPlan::findOrFail($id);
        $payment_plan->delete();
        if($payment_plan){
            return redirect()->back()->with(['alert' => 'success', 'message' =>  'Payment Plan Delete Successfully']);
        } else{
            return redirect()->back()->with(['alert' => 'error', 'message' =>  'Payment Plan Delete Error']);
        }
    }
}
