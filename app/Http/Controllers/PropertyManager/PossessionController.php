<?php

namespace App\Http\Controllers\PropertyManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PossessionController extends Controller
{
    public function index()
    {
        return view('society.Recieve.possession');
    }
    public function trans()
    {
        return view('society.Recieve.transfer');
    }
    public function account()
    {
        return view('society.accounts.index');
    }


}
