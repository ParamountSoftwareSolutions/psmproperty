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
        $sales = BuildingSale::with('floor_detail', 'building_installment')->where(['customer_id' => Auth::guard('api')->id(), 'order_type' => 'sale', 'order_status' => 'active'])->get();
        return InstallmentResource::collection($sales);
    }

    public function show($id)
    {
        $sales = BuildingSale::with('building_installment')->where(['customer_id' => Auth::guard('api')->id(), 'order_type' => 'sale', 'order_status' => 'active', 'id'=> $id])->first();
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
}
