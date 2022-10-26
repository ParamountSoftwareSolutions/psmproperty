<?php

namespace App\Http\Controllers\SocietyAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    private $activePage;
    public function __construct(){
        $this->activePage = "employees";
    }

    public function index(){
        $societies = auth()->user()->societies;
        return view('society_admin.employees.index', array('activePage' => $this->activePage, 'societies'=>$societies));
    }
}
