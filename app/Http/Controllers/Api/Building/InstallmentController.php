<?php

namespace App\Http\Controllers\Api\Building;

use App\Http\Controllers\Controller;
use App\Http\Resources\InstallmentResource;
use App\Models\BuildingCustomer;
use App\Models\BuildingSale;
use App\Models\BuildingSaleInstallment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class InstallmentController extends Controller
{
    public function index()
    {
        $sales = BuildingSale::with('floor_detail', 'building_installment')->where(['customer_id' => Auth::guard('api')->id(), 'order_type' => 'sale', 'order_status'
        => 'active'])->get();
        return InstallmentResource::collection($sales);
    }

    public function show($id)
    {
        $sales = BuildingSale::with('building_installment')->where(['customer_id' => Auth::guard('api')->id(), 'order_type' => 'sale', 'order_status' => 'active', 'id'
        =>
            $id])->first();
        return new InstallmentResource($sales);
    }

    public function store(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required',
            'months' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }
        $sales = BuildingSale::with('building_installment')->where(['customer_id' => Auth::guard('api')->id(), 'id' => $id])->first();
        $installment = BuildingSaleInstallment::where(['building_sale_id' => $sales->id])->where('status', 'not_paid')->get();
        $months = $request->get('months');
        $amount = $request->get('amount');
        $c = [];
        $totalRequiredAmount = 0;
        if ($sales != null) {
            if (count($installment) >= $months) {
                for ($i = 0; $i < $months; $i++) {
                    $currentInstallment = BuildingSaleInstallment::where('building_sale_id', $sales->id)->where('status', 'not_paid')->first();
                    if ($amount == $currentInstallment->installment_amount || $amount > $currentInstallment->installment_amount) {
                        $a = $amount - $currentInstallment->installment_amount;
                        if ($a == 0 || $a > 0) {
                            $b = $amount - $a;
                            if ($currentInstallment->installment_amount == $b) {
                                $currentInstallment->status = 'paid';
                                $currentInstallment->save();
                            } else {
                                return $this->sendError('Please Confirm Remaining Installment!');
                            }
                        } else {
                            return $this->sendError('Please Confirm Remaining Installment!');
                        }
                    } else {
                        return $this->sendError('Please Confirm Remaining Installment!');
                    }
                }
            } else {
                return $this->sendError('Please Confirm Remaining Installment!');
            }
        }
        $sales = BuildingSale::with('building_installment')->where(['customer_id' => Auth::guard('api')->id(), 'id' => $id])->first();
        return new InstallmentResource($sales);
    }

    public function installment_detail($id)
    {
        $sales = BuildingSale::with('building_installment')->where(['customer_id' => Auth::guard('api')->id(), 'order_type' => 'sale', 'order_status' => 'active', 'id'
        => $id])->first();
        $data['paid_amount'] = ($sales->building_installment->where('status', 'paid')->isEmpty()) ? 0 : $sales->building_installment->where('status', 'paid')->sum('installment_amount');
        //$data['not_paid_amount'] = ($sales->building_installment->where('status', 'not_paid')->isEmpty()) ? 0 : $sales->building_installment->where('status',
        // 'not_paid')->sum('installment_amount');
        $data['remaining_amount'] = ($sales->building_installment->where('status', 'not_paid')->isEmpty()) ? 0 : $sales->building_installment->where('status', 'not_paid')
            ->sum('installment_amount');
        $data['paid'] = ($sales->building_installment->where('status', 'paid')->isEmpty()) ? 0 : $sales->building_installment->where('status', 'paid')->count();
        $data['not_paid'] = $sales->building_installment->where('status', 'not_paid')->count();
        $data['total'] = $sales->building_installment->count();
        $data['purchase_amount'] = ($sales->building_installment->isEmpty()) ? 0 : $sales->building_installment->sum('installment_amount');
        $data['purchase_date'] = $sales->created_at;
        $data['payment_plan'] = $sales->building_installment;
        return new InstallmentResource($data);
    }

    /*public function updateOther(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }
        $sales = BuildingSale::with('building_installment')->where(['customer_id' => Auth::guard('api')->id(), 'id' => $id])->first();
        $installment = BuildingSaleInstallment::where(['building_sale_id' => $sales->id])->where('status', 'not_paid')->get();
        $amount = (int)$request->get('amount');
        $m = $amount;
        if ($sales != null) {
            $installment_list = [];
            $a = [];
            $b = [];
            $c = [];
            $credit_amount = 0;
            $months = 0;
            foreach ($installment as $data){
                $installment_list[] = $data->installment_amount;
                //dd($amount > $data->installment_amount || $amount == $data->installment_amount);
                if ($m > $data->installment_amount || $m == $data->installment_amount) {
                    $m -= $data->installment_amount;
                    BuildingSaleInstallment::where(['building_sale_id' => $data->building_sale_id, 'id' => $data->id, 'status' => 'not_paid'])->update([
                        'status' => 'paid',
                    ]);
                    $a[] = $amount;
                    $b[] = $data->installment_amount;
                    //$credit_amount = $amount % $data->installment_amount;
                } else {
                    BuildingCustomer::where('customer_id', Auth::guard('api')->id())->update([
                        'credit' => $credit_amount,
                    ]);
                }
            }
            /*for ($i = 0; count($installment_list)>$i; $i++){
                //dd($amount, $installment_list[$i], $amount >= $installment_list[$i]);
                if ($amount >= $installment_list[$i]) {
                    $amount -= $installment_list[$i];
                    $a[] = $amount;
                    $b[] = $installment_list[$i];
                    $credit_amount = $amount % $installment_list[$i];
                }
            }*/

    //dd($credit_amount, $a, $b, end($a) == $credit_amount);
    /*if (end($a) == $credit_amount){
        if (end($a)>0){
            array_pop($b);
            $c = $b;
        } else {
            $c =  $b;
        }
        dd($installment_list,$a, $b, end($a), end($a) == $credit_amount);
        for ($i=0; count($c)>$i; $i++){
            $currentInstallment =  BuildingSaleInstallment::where('building_sale_id', $sales->id)->where('status', 'not_paid')->first();
            if ($currentInstallment->installment_amount == ''){
                $currentInstallment->status = 'paid';
                $currentInstallment->save();
            }
        }
        //
        BuildingCustomer::where('customer_id', Auth::guard('api')->id())->update([
            'credit' => $credit_amount,
        ]);
    } else{
        BuildingCustomer::where('customer_id', Auth::guard('api')->id())->update([
            'credit' => $credit_amount,
        ]);
    }
}
return new InstallmentResource($sales);
}*/

    /*public function updateOther(Request $request, $sale_id)
    {
        $societySales = SocietySale::findOrFail($sale_id);
        $user = Auth::guard('api')->user();
        $amount = $request->amount;

        if ($societySales != null) {
            $statusPaid = Status::where('name', 'Paid')->first();
            $statusUnPaid = Status::where('name', 'Not Paid')->first();
            $totalRequiredAmount = 0;
            $currentInstallment = SocietyInstallmentData::where('society_sales_id', $societySales->id)->where('status_id', $statusUnPaid->id)->get();
            $client_credit_amount = ClientCreditPayment::where('client_id', $user->id)->first();
            if ($client_credit_amount == null) {
                $credit_amount = $amount % $societySales->InstallmentDataPerMonth->installment_amount;
                $months_count = $amount / $societySales->InstallmentDataPerMonth->installment_amount;
                $months = (int)$months_count;
                if (count($currentInstallment) >= $months) {
                    for ($i = 0; $i < $months; $i++) {
                        $currentInstallment = SocietyInstallmentData::where('society_sales_id', $societySales->id)->where('status_id', $statusUnPaid->id)->first();
                        $currentInstallment->status_id = $statusPaid->id;
                        $currentInstallment->fine_amount = "";
                        $totalRequiredAmount += $currentInstallment->installment_amount;
                        $currentInstallment->save();
                    }
                    ClientCreditPayment::updateOrCreate(['client_id' => $user->id], [
                        'credit_amount' => $credit_amount,
                    ]);

                } else {
                    return $this->sendError('Please Confirm Remaining Installment!');
                }
            } else {
                $total_amount = $client_credit_amount->credit_amount + $amount;
                $credit_amount = $total_amount % $societySales->InstallmentDataPerMonth->installment_amount;
                $months_count = $total_amount / $societySales->InstallmentDataPerMonth->installment_amount;
                $months = (int)$months_count;
                if (count($currentInstallment) >= $months) {
                    for ($i = 0; $i < $months; $i++) {
                        $currentInstallment = SocietyInstallmentData::where('society_sales_id', $societySales->id)->where('status_id', $statusUnPaid->id)->first();
                        $currentInstallment->status_id = $statusPaid->id;
                        $currentInstallment->fine_amount = "";
                        $totalRequiredAmount += $currentInstallment->installment_amount;
                        $currentInstallment->save();
                    }
                    ClientCreditPayment::updateOrCreate(['client_id' => $user->id], [
                        'credit_amount' => $credit_amount,
                    ]);
                } else {
                    return $this->sendError('Please Confirm Remaining Installment!');
                }
            }


            $installmentHistory = new InstallmentPaymentHistory();
            $installmentHistory->sales_id = $societySales->id;
            $installmentHistory->amount_per_month = $societySales->InstallmentDataPerMonth->installment_amount;
            $installmentHistory->total_amount = $totalRequiredAmount;
            $installmentHistory->created_by = $user->id;
            $installmentHistory->payment_method = $request->get('payment_method');
            $installmentHistory->save();

            //add in client history as well...

            $clientPaymentHistory = new ClientPaymentHistory();
            $clientPaymentHistory->client_id = $user->id;
            $clientPaymentHistory->society_id = $societySales->society_id;
            $clientPaymentHistory->created_by = $user->id;
            $clientPaymentHistory->amount = $request->get('amount');
            $clientPaymentHistory->months = $months;
            $clientPaymentHistory->method = $request->get('payment_method');
            $clientPaymentHistory->data_array = $request->get('data_array');
            $clientPaymentHistory->save();

            return $this->sendSuccess('Data Update Successfully');
        }
        return $this->sendError('Request is not a valid request');
    }*/



}
