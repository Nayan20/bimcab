<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Http\Request;
use Response;

class CityController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show City List
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::get();
        return view('city.list', compact('cities'));
    }

    /**
     * Create State
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::pluck('name','id')->toArray();
        $state = [];
        return view('city.form',compact('countries','state'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'country_id'  => 'required',
            'state_id'  => 'required',
            'name'  => 'required'
        ]);

        City::add($request->all());

        return redirect()->route('city_index')->with('success', 'City created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $city = [];

        if ((int) $id > 0) {
            $city = City::find($id);
        }
        $countries = Country::pluck('name','id')->toArray();
        $state = State::where('id',$city->state_id)->pluck('name','id')->toArray();

        return view('city.form', compact(['city','countries','state']));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'country_id'  => 'required',
            'state_id'  => 'required',
            'name'  => 'required'
        ]);

        City::updateRecords($id, $request->all());

        return redirect()->route('city_index')->with('success', 'City updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ((int) $id > 0) {

            $city = City::where('id', $id)->delete();
            return Response::json(["code" => 200,
                "response_status"             => "success",
                "message"                     => "Record deleted successfully",
                "data"                        => [],
            ]);

        }

        return Response::json(["code" => 500,
            "response_status"             => "error",
            "message"                     => "Something went wrong",
        ]);
    }

}
