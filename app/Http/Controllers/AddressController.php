<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddressController extends Controller
{
    public function getCountries()
    {
        $countries = Country::get(['name','id']);
        return response()->json(['countries'=>$countries], Response::HTTP_OK);
    }

    public function getStates($id)
    {
        $states = State::where('country_id',$id)->get(['name','id']);
        return response()->json(['states'=>$states], Response::HTTP_OK);
    }


    public function getCities($id)
    {
        $cities = City::where('state_id',$id)->get(['name','id']);
        return response()->json(['cities'=>$cities], Response::HTTP_OK);
    }
}
