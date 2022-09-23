<?php

namespace App\Http\Controllers\Society;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PossessionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */


    private $activePage;

    public function __construct()
    {
        $this->activePage = "possessions";

    }

    public function index()
    {
        return view('society.Recieve.possession', array('activePage' => $this->activePage));
    }
    public function trans()
    {
        return view('society.Recieve.transfer', array('activePage' => $this->activePage));
    }
    public function account()
    {
        return view('society.accounts.index', array('activePage' => $this->activePage));
    }


}