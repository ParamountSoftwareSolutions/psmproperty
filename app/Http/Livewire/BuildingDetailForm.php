<?php

namespace App\Http\Livewire;

use App\Models\Building;
use App\Models\BuildingDetail;
use App\Models\Floor;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;


class BuildingDetailForm extends Component
{
    use WithFileUploads;

    public $building_id;
    public $floor;
    public $totalSteps = 2;
    public $shop = [];
    public $apartment = [];
    public $office = [];
    public $pent_house = [];
    public $studio = [];
    public $flat = [];

    public function mount()
    {
        $this->currentStep = 1;
    }

    public function increaseStep()
    {
        $this->resetErrorBag();
        $this->validateData();
        $this->currentStep++;
        if ($this->currentStep > $this->totalSteps){
            $this->currentStep = $this->totalSteps;
        }
    }

    public function decreaseStep()
    {
        $this->resetErrorBag();
        $this->currentStep--;
        if ($this->currentStep < 1){
            $this->currentStep = 1;
        }
    }

    public function render()
    {
        //$floor = Floor::get();
        $building = Building::where('user_id', Auth::id())->get();
        return view('livewire.building-detail-form', compact('building'));
    }

    public function validateData()
    {
        if ($this->currentStep == 1) {
            $this->validate([
                'building_id' => 'required',
            ]);
            $building_data = Building::where('user_id', Auth::id())->where('id', $this->building_id)->first();
            $this->floor = Floor::whereIn('id', json_decode($building_data->floor_list))->get();
        } elseif ($this->currentStep == 2) {
            $this->validate([
                'floor' => 'required',
            ]);

        }
    }

    public function buildingDetail()
    {
        $this->resetErrorBag();
        if ($this->currentStep == 2) {
            /*$this->validate([
//                'file' => 'required|mimes:doc:docx',
            ]);
            $file = $this->file->getClientOriginalName();
            $upload_file = $this->cv->storeAs('building', $file);*/
            $building_data = Building::where('user_id', Auth::id())->where('id', $this->building_id)->first();
            $floor = Floor::whereIn('id', json_decode($building_data->floor_list))->get();
            foreach ($this->shop as $key => $data) {
                $building_detail = new BuildingDetail();
                $building_detail->building_id = $this->building_id;
                $building_detail->floor_id = $key;
                $building_detail->shop = $this->shop[$key];
                $building_detail->studio = $this->studio[$key];
                $building_detail->flat = $this->flat[$key];
                $building_detail->apartment = $this->apartment[$key];
                $building_detail->pent_house = $this->pent_house[$key];
                $building_detail->office = $this->office[$key];
                $building_detail->save();
            }
//            if ($building_detail) {
                return redirect()->route('property_admin.building.index')->with(['message' => 'Building Extra Detail Add SuccessFully', 'alert' => 'success',]);
            /*} else {
                return redirect()->back()->with($this->message("Building Extra Detail Collect Error", 'error'));
            }*/
        }
    }
}
