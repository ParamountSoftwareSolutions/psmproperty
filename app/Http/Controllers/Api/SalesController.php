<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentHistoryResource;
use App\Models\ClientPaymentHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    public function history(){
        $user = Auth::guard('api')->user();
        $userHistory = ClientPaymentHistory::where('client_id', $user->id)->get();
        if($userHistory != null){
            return PaymentHistoryResource::collection($userHistory);
        } else {
            return $this->sendError('Data Not Found');
        }
    }
}
