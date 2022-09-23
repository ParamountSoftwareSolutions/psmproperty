<?php

namespace App\Helpers;

use App\Models\State;

class ExtraDate
{
    public function state($country_id)
    {
        return State::where('country_id', $country_id)->get();
    }

    public function city($state_id)
    {
        return State::where('state_id', $state_id)->get();
    }

}
