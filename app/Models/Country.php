<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $guarded =[

    ];


    /**
     * get a specific country information
     *
     * @param String $countryName
     */
    public static function getCountryInformation($countryName){
        return Country::where('name',$countryName)->first();
    }
}