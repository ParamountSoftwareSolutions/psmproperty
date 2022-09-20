<?php

namespace App\Http\Controllers\Api\Building;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentHistoryResource;
use App\Models\BuildingSale;
use App\Models\BuildingSaleInstallment;
use App\Models\ClientPaymentHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    public function history(){
        $sales = BuildingSale::with('building_installment')->where(['customer_id' => Auth::guard('api')->id(), 'order_type' => 'sale', 'order_status' => 'mature'])->get();
        $installment = BuildingSaleInstallment::whereIn('building_sale_id', $sales->pluck('id')->toArray())->where('status', 'paid')->get();

        return PaymentHistoryResource::collection($installment);
    }
}
