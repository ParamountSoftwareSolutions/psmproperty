<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FaqResource;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faq = Faq::all();
        if ($faq){
            return FaqResource::collection($faq);
        } else {
            return $this->sendError('Some thing Went Wrong');
        }
    }
}
