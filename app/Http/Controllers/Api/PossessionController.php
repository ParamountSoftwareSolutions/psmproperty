<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PossessionRequest;
use Illuminate\Http\Request;

class PossessionController extends Controller
{
    public function create(Request $request)
    {
        $possession = PossessionRequest::create([
            'name' => $request->name,
            'membership' => $request->membership,
            'plot' => $request->plot,
            'transfer_to' => $request->transfer_to,
            'number' => $request->number,
            'date' => $request->date,
        ]);
        if($possession){
            return $this->sendSuccess('Data Create Successfully');
        }else{
            return $this->sendError('Data Create Error');
        }
    }
}
