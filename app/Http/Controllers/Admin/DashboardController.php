<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Society;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $societies = Society::get()->count();
        $block_societies = Society::with('manager')
            ->whereHas('manager', function ($q) {
                $q->where('status', 0);
            })->get()->count();
        $society_admin = User::with('roles')
            ->whereHas('roles', function ($q) {
                $q->where('name', 'society_admin');
            })->get()->count();
        return view('admin.index', compact('societies', 'block_societies', 'society_admin'));
    }
}
