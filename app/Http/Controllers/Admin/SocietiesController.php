<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NocType;
use App\Models\Society;
use App\Models\SocietyCategory;
use App\Models\StatusType;
use Illuminate\Http\Request;

class SocietiesController extends Controller
{
    private $activePage;
    public function __construct(){
        $this->activePage = "society";
    }

    public function index(){
        $societies = Society::all();
        return view('admin.societies.index', array('activePage' => $this->activePage, 'societies' => $societies));
    }




}
