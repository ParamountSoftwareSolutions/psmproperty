<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\InstallmentResource;
use App\Models\ClientCreditPayment;
use App\Models\ClientPaymentHistory;
use App\Models\ClientPlot;
use App\Models\InstallmentPaymentHistory;
use App\Models\SocietyInstallmentData;
use App\Models\SocietySale;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstallmentController extends Controller
{
    public function index()
    {
        $data['salesData'] = SocietySale::with('CategoryData', 'InstallmentData')->where('sold_to_id', Auth::guard('api')->id())->first();
        if ($data['salesData'] != null) {
            $data['clientPlot'] = ClientPlot::where('client_id', Auth::guard('api')->id())->first();
            $data['type'] = $data['salesData']->CategoryData->category_name;
            $data["number"] = $data['salesData']->registration_number;
            $data["total_installments"] = count($data['salesData']->InstallmentData);
            $data["paid_installments"] = count($data['salesData']->PaidInstallments);
            $data["remaining_installments"] = count($data['salesData']->InstallmentData) - count($data['salesData']->PaidInstallments);
            return new InstallmentResource($data);
        } else {
            return $this->sendError('Data Not Found');
        }
    }

    public function update(Request $request, $sale_id)
    {
        $societySales = SocietySale::findOrFail($sale_id);
        $user = Auth::guard('api')->user();

        if ($societySales != null) {
            $statusPaid = Status::where('name', 'paid')->first();
            $months = $request->get('months');
            $totalRequiredAmount = 0;
            $currentInstallment = SocietyInstallmentData::where('society_sales_id', $societySales->id)->where('status_id', 9)->get();
            if (count($currentInstallment) >= $months) {
                for ($i = 0; $i < $months; $i++) {
                    $currentInstallment = SocietyInstallmentData::where('society_sales_id', $societySales->id)->where('status_id', 9)->first();
                    $currentInstallment->status_id = $statusPaid->id;
                    $currentInstallment->fine_amount = "";
                    $totalRequiredAmount += $currentInstallment->installment_amount;
                    $currentInstallment->save();
                }
            } else {
                return $this->sendError('Please Confirm Remaining Installment!');
            }

            $installmentHistory = new InstallmentPaymentHistory();
            $installmentHistory->sales_id = $societySales->id;
            $installmentHistory->amount_per_month = $request->get('amount');
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
            $clientPaymentHistory->months = $request->get('months');
            $clientPaymentHistory->method = $request->get('payment_method');
            $clientPaymentHistory->data_array = $request->get('data_array');
            $clientPaymentHistory->save();

            return $this->sendSuccess('Data Update Successfully');
        }
        return $this->sendError('Request is not a valid request');
    }

    public function updateOther(Request $request, $sale_id)
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
    }
}
