<?php

namespace App\Http\Livewire;

use App\Models\Floor;
use Livewire\Component;

class BuildingForm extends Component
{
    public function render()
    {
        $floor = Floor::get();
        return view('livewire.building-form', compact('floor'));
    }
}
