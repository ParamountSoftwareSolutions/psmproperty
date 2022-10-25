<?php

namespace App\Http\Controllers\Api\Building;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentHistoryResource;
use App\Models\BuildingCustomer;
use App\Models\BuildingSale;
use App\Models\BuildingSaleInstallment;
use App\Models\ClientCreditPayment;
use App\Models\ClientPaymentHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceiptController extends Controller
{
    public function index()
    {
        $sales = BuildingSale::where('customer_id', Auth::guard('api')->id())->first();
        $data['history'] = BuildingSaleInstallment::where('building_sale_id', $sales->id)->where('status', 'paid')->get();
        $data['credit_amount'] = BuildingCustomer::where('customer_id', Auth::guard('api')->id())->first();
        if($data['history'] != null){
            return PaymentHistoryResource::collection($data);
        } else {
            return $this->sendError('Data Not Found');
        }
    }
}
