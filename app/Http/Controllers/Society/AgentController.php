<?php

namespace App\Http\Controllers\Society;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\AgentFileData;
use App\Models\AgentSocietyData;
use App\Models\SocietyCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgentController extends Controller
{
    //

    private $activePage;
    public function __construct(){
        $this->activePage = "agent";
    }

    public function index(){
        $agents = AgentSocietyData::where('society_id', Auth::user()->Society->id)->get();

        return view('society.agents.index', array('activePage' => $this->activePage, 'agents' => $agents));
    }

    public function search(){
        $agentList = Agent::where('name', 'like', '%'.$_GET['query'].'%')->orwhere('contact_number', 'like', '%'.$_GET['query'].'%')
            ->orwhere('business_address', 'like', '%'.$_GET['query'].'%')->get();

        if($agentList != null){
            return response()->json(['data' => ['code' => '200', 'agents' => $agentList]]);
        }else{
            return response()->json(['data' => ['code' => '500', 'agents' => null ]]);
        }
    }

    public function details($id){
        $agent = Agent::find($id);
        $agentSocietyData = AgentSocietyData::where('society_id', \auth()->user()->Society->id)->where('agent_id', $id)->first();

        return view('society.agents.view', array('agent'=>$agent, 'agentSocietyData'=> $agentSocietyData, 'activePage' => 'agent-edit'));

    }


    public function add(Request $request){

        $typeIds = $request->get('typeids');

        $agentSocietyData = AgentSocietyData::where('society_id', auth()->user()->Society->id)->where('agent_id', $request->get('agent_id'))->first();
        if($agentSocietyData == null){
            $agentSocietyData = new AgentSocietyData();
            $agentSocietyData->society_id = auth()->user()->Society->id;
            $agentSocietyData->agent_id = $request->get('agent_id');
            $agentSocietyData->status_id = 1;
            $agentSocietyData->save();
        }


        $superArray = array();
        foreach($typeIds as $typeId){ //required total_5_3_Residential
            //$typeId = 5, PLOT
            $superType = SocietyCategory::find($typeId);
            $typeDataArray = json_decode($superType->fields_json_array);
            $parentArray = array();
            foreach ($typeDataArray->size as $dataArray){
                //$dataArray->value = 3
                $childArray = array();
                foreach ($typeDataArray->type as $type){
                    // $type->value = Residential
                    //get name and loop through values


                    $Key = $typeId.'_'.$dataArray->value.'_'.preg_replace('/\s+/', '_', $type->value);
                    $total = $request->get('total_'.$Key);
                    $start = $request->get('start_'.$Key);
                    $end = $request->get('end_'.$Key);
                    //loop on total and get other related values..

                    if($total != null){
                        $filesArray = array();
                        for($i = 0; $i< count($total); $i++){
                            $currentArray  =array();
                            if($total[$i] != null) {
                                $currentArray["total"] = $total[$i];
                            }
                            if($start[$i] != null){
                                $currentArray["start"] = $start[$i];
                            }

                            if($end[$i] != null){
                                $currentArray["end"] = $end[$i];
                            }
                            if(!empty($currentArray)){
                                $filesArray[] = $currentArray;
                            }
                        }

                        if($filesArray != null) {
                            $childArray['type'] = $type->value;
                            $childArray['unit'] = $dataArray->unit;
                            $childArray['size'] = $dataArray->value;
                            $childArray["files"] = $filesArray;
                        }

                        if(!empty($childArray)){
                            $parentArray[$superType->name] = $childArray;
                            $superArray[] = $parentArray;
                        }
                    }
                }
            }
        }

        $finalArray = array_values( array_unique( $superArray, SORT_REGULAR ) );


        if(!empty($superArray)){
            $agentFileData = AgentFileData::where('agent_id', $request->get('agent_id'))->where('agent_society_id', $agentSocietyData->id)->first();
            if($agentFileData == null){
                $agentFileData = new AgentFileData();
                $agentFileData->agent_id = $request->get('agent_id');
                $agentFileData->agent_society_id = $agentSocietyData->id;
            }

            $agentFileData->data_array = json_encode($finalArray);
            $agentFileData->status_id = 1;
            $agentFileData->save();
        }

        return back()->with(['success'=> 'Agent Record added Successfully']);

    }
}
