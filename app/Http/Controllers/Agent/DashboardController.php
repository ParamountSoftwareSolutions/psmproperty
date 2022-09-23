<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    private $activePage;
    public function __construct(){
        $this->activePage = "dashboard";
    }

    public function index(){
        return view('agents.index', array('activePage' => $this->activePage));
    }
}
