<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DashboardResource;
use App\Models\MobileApplication;
use App\Models\Project;
use App\Models\Slider;
use App\Models\Society;
use App\Models\SocietyCategoryData;
use App\Models\SocietySale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isEmpty;

class DashboardController extends Controller
{
    public function index()
    {
        //get all data of user related to societies, apartments bla bla bla..
        $app = MobileApplication::where('customer_id', Auth::guard('api')->id())->first();
        if ($app != null) {
            $data['slider'] = Slider::where('society_id', $app->society_id)->get();
            $data['society'] = Society::with('categoryData', 'type', 'noc', 'city', 'province', 'status')->first();
            $data['project'] = Project::where('society_id', $app->society_id)->get();

            return DashboardResource::collection($data);
        } else {
            return $this->sendError('API KEY IS NOT A VALID KEY');
        }


        /*$society_sale = SocietySale::where('society_id', $app->society_id)->where('sold_to_id', $user->id)->first();
        if($society_sale == null){
            return $this->sendError('Data not found');
        }
        $currentSociety = array();
        $currentSociety["id"] = $society_sale->id;
        $currentSociety["name"] = $society_sale->Society->society_name;
        $currentSociety["image"] = "";
        $currentSociety["address"] = $society_sale->Society->address;

        //get plot data
        $plot = array();
        $plot['id'] = $society_sale->id;
        $plot['type'] = $society_sale->CategoryData->category_name;
        $plot["number"] = $society_sale->registration_number;
        $plot["total_installments"] = count($society_sale->InstallmentData);
        $plot["paid_installments"] = count($society_sale->PaidInstallments);
        $plot["remaining_installments"] = count($society_sale->InstallmentData) - count($society_sale->PaidInstallments);

        $currentSociety['plot'] = $plot;
        $societies = array("societies" => array($currentSociety));*/
    }


}
