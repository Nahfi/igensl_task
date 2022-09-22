<?php

use App\Models\Country;
use App\Models\GeneralSettings;

    function generalSettings(){
        $generalSettings = GeneralSettings::latest()->first();
        return $generalSettings;

    }

    /**
     * get all countries
     */
    function getCountry(){
        $countries = Country::get();
        return $countries;
    }