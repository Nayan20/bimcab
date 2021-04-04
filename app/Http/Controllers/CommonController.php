<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\State;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CommonController extends Controller
{
    public function getState(Request $request)
    {
        $state = State::orderBy('name', 'asc')->where(["country_id" => $request->countryId])->pluck('id', 'name')->toArray();
        return Response::json(['state' => $state]);
    }

    public function getCities(Request $request)
    {
        $cities = City::orderBy('name', 'asc')->where(["state_id" => $request->stateId])->pluck('id', 'name')->toArray();
        return Response::json(['cities' => $cities]);
    }
}
