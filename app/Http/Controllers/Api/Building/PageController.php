<?php

namespace App\Http\Controllers\Api\Building;

use App\Helpers\AppHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\PageResource;
use App\Models\About;
use App\Models\BuildingAbout;
use App\Models\BuildingCustomer;
use App\Models\BuildingTermCondition;
use App\Models\PrivacyPolicy;
use App\Models\TermCondition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function about()
    {
        $admin = AppHelpers::user_admin();
        $about = BuildingAbout::where(['property_admin_id' => $admin])->first();
        if($about !== null){
            return new PageResource($about);
        } else {
            return $this->sendError('Data Not Found');
        }

    }

    public function termCondition()
    {
        $admin = AppHelpers::user_admin();
        $terms = BuildingTermCondition::where(['property_admin_id' => $admin])->first();
        if($terms !== null){
            return new PageResource($terms);
        } else {
            return $this->sendError('Data Not Found');
        }
    }

    public function privacyPolicy()
    {
        $admin = AppHelpers::user_admin();
        $privacyPolicy = BuildingAbout::where(['property_admin_id' => $admin])->first();
        if($privacyPolicy !== null){
            return new PageResource($privacyPolicy);
        } else {
            return $this->sendError('Data Not Found');
        }
    }

    public function faq()
    {
        $admin = AppHelpers::user_admin();
        $faq = BuildingAbout::where(['property_admin_id' => $admin])->first();
        if($faq !== null){
            return new PageResource($faq);
        } else {
            return $this->sendError('Data Not Found');
        }
    }
}
