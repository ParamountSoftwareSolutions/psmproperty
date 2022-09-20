<?php

namespace App\Http\Controllers\Property;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Floor;
use Illuminate\Http\Request;

class FloorController extends Controller
{
    public function index($id)
    {
        $building = Building::findOrFail($id);
        $floor = Floor::whereIn('id', json_decode($building->floor_list))->get();
        return view('property.floor.index', compact('floor', 'building'));
    }
}
