<?php

namespace App\Http\Controllers\Api\Building\Guest;

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
    public function about($app_key, $building_id)
    {
        $app = (new AppHelpers)->user_login_route($app_key);;
        if ($app != null) {
            $about = BuildingAbout::where(['property_admin_id' => $app->property_admin_id])->firstOrFail();
            if (in_array($building_id, json_decode($about->building_id)) == true) {
                return new PageResource($about);
            } else {
                return $this->sendError('About Us page not exist for this building');
            }
        } else {
            return $this->sendError('API KEY IS NOT A VALID KEY');
        }

    }

    public function termCondition($app_key, $building_id)
    {
        $app = (new AppHelpers)->user_login_route($app_key);
        if ($app != null) {
            $terms = BuildingTermCondition::where(['property_admin_id' => $app->property_admin_id])->firstOrFail();
            if (in_array($building_id, json_decode($terms->building_id)) == true) {
                return new PageResource($terms);
            } else {
                return $this->sendError('Term And Condition page not exist for this building');
            }
        } else {
            return $this->sendError('API KEY IS NOT A VALID KEY');
        }
    }

    public function privacyPolicy($app_key, $building_id)
    {
        $app = (new AppHelpers)->user_login_route($app_key);
        if ($app != null) {
            $privacyPolicy = BuildingAbout::where(['property_admin_id' => $app->property_admin_id])->firstOrFail();
            if (in_array($building_id, json_decode($privacyPolicy->building_id)) == true) {
                return new PageResource($privacyPolicy);
            } else {
                return $this->sendError('PrivacyPolicy page not exist for this building');
            }
        } else {
            return $this->sendError('API KEY IS NOT A VALID KEY');
        }
    }

    public function faq($app_key, $building_id)
    {
        $app = (new AppHelpers)->user_login_route($app_key);
        if ($app != null) {
            $faq = BuildingAbout::where(['property_admin_id' => $app->property_admin_id])->firstOrFail();
            if (in_array($building_id, json_decode($faq->building_id)) == true) {
                return new PageResource($faq);
            } else {
                return $this->sendError('Faq page not exist for this building');
            }
        } else {
            return $this->sendError('API KEY IS NOT A VALID KEY');
        }
    }
}
