<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentHistoryResource;
use App\Models\ClientCreditPayment;
use App\Models\ClientPaymentHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceiptController extends Controller
{
    public function index()
    {
        $user = Auth::guard('api')->user();
        $data['userHistory'] = ClientPaymentHistory::where('client_id', $user->id)->get();
        $data['credit_amount'] = ClientCreditPayment::where('client_id', $user->id)->first();
        if($data['userHistory'] != null){
            return PaymentHistoryResource::collection($data);
        } else {
            return $this->sendError('Data Not Found');
        }
    }
}
