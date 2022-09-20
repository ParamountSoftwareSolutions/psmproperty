<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\AgentHistory;
use App\Models\AgentPropertyData;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    //

    private $activePage;
    public function __construct(){
        $this->activePage = "properties";
    }

    public function index(){
        $properties = AgentPropertyData::where('agent_id', auth()->user()->id)->get(); // array

        return view('agents.properties.index', array('properties'=> $properties, 'activePage' => $this->activePage));
    }

    public function add(Request $request){
        $property = new AgentPropertyData();
        $property->agent_id = auth()->user()->id;
        $property->status_id = 1;
        $dataArray = array(
            "title"=> $request->get('title'),
            "area"=> $request->get('area'),
            "area_type"=> $request->get('area_type'),
            "property_type"=> $request->get('property_type'),
            "owner_name" => $request->get('owner_name'),
            "owner_phone" => $request->get('owner_phone'),
            "location" => $request->get('location'),
            "ask_price" => $request->get('price'),
            "estimated_price" => $request->get('estimated_price')
        );

        $property->data_array = json_encode($dataArray);
        $property->save();

        return redirect('agent/properties/active')->with('success', 'Property Added Successfully');
    }

    public function view($id){
        $property = AgentPropertyData::find($id);
        $this->activePage="property_view";
        $propertyHistory = AgentHistory::where('data_type', 'property')->where('agent_id', auth()->user()->id)->where('property_id', $id)->get();
        return view('agents.properties.view', array('property' => $property, 'history'=> $propertyHistory ,'activePage' => $this->activePage));
    }

    public function updateStatus(Request $request){
        $type="property";
        $status = $request->get('property-status');
        $comments = $request->get('property-comment');

       $property = AgentPropertyData::find($request->get('property_id'));
       if($property != null){
           $property->status_id = $status;
           $property->save();
           $history = new AgentHistory();
           $history->data_type=$type;
           $history->property_id = $request->get('property_id');
           $history->history = $comments;
           $history->agent_id = auth()->user()->id;
           $history->save();
       }
       return redirect('agent/properties/view/'. $request->get('property_id'));
    }

    public function update(Request $request){
        $property = AgentPropertyData::find($request->get('property_id'));
        $property->status_id = 1;
        $dataArray = array(
            "title"=> $request->get('title'),
            "area"=> $request->get('area'),
            "area_type"=> $request->get('area_type'),
            "property_type"=> $request->get('property_type'),
            "owner_name" => $request->get('owner_name'),
            "owner_phone" => $request->get('owner_phone'),
            "location" => $request->get('location'),
            "ask_price" => $request->get('price'),
            "estimated_price" => $request->get('estimated_price')
        );

        $property->data_array = json_encode($dataArray);
        $property->save();

        $history = new AgentHistory();
        $history->data_type="property";
        $history->property_id = $request->get('property_id');
        $history->history = "Property Data Updated";
        $history->agent_id = auth()->user()->id;
        $history->save();
        return redirect('agent/properties/active')->with('success', 'Property Added Successfully');
    }

    public function delete($id){
        $property = AgentPropertyData::find($id);
        if($property != null){
            $property->delete();
        }
        return redirect('agent/properties/active');
    }

    public function restore($id){
        AgentPropertyData::onlyTrashed()->where('id', $id)->restore();
        return redirect('agent/properties/active');
    }

    public function trashView(){
        $properties = AgentPropertyData::where('agent_id', auth()->user()->id)->onlyTrashed()->get();
        return view('agents.properties.trash', array('properties'=> $properties, 'activePage' => $this->activePage));
    }


}
