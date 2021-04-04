<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\Vehicle;
use App\Models\Driver;
use Illuminate\Http\Request;
use Response;

class DriverController extends Controller
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
        if (auth()->user()->is_admin()) {
            $drivers = Driver::get();
        } else {
            $drivers = Driver::where('created_by',auth()->user()->id)->get();
        }
        $title = 'Drivers';
        return view('driver.list', compact('drivers','title'));
    }

    /**
     * Create State
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::pluck('name', 'id')->toArray();
        $vehicles  = Vehicle::pluck('name', 'id')->toArray();
        $state     = $cities     = [];
        return view('driver.form', compact('countries', 'state', 'cities', 'vehicles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name'     => 'required',
            'last_name'      => 'required',
            'email'          => 'required|email|unique:drivers',
            'password'       => ['required', 'string', 'min:8', 'confirmed'],
            'contact_number' => 'required',
            'country_id'     => 'required',
            'state_id'       => 'required',
            'city_id'        => 'required',
            'address'        => 'required',
            'vehicle_type'   => 'required',
        ]);

        Driver::add($request->all());

        return redirect()->route('driver_index')->with('success', 'Driver created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $driver = [];

        if ((int) $id > 0) {
            $driver = Driver::find($id);
        }

        $countries = Country::pluck('name', 'id')->toArray();
        $state     = State::where('id', $driver->state_id)->pluck('name', 'id')->toArray();
        $cities    = City::where('id', $driver->city_id)->pluck('name', 'id')->toArray();
        $vehicles  = Vehicle::pluck('name', 'id')->toArray();

        return view('driver.form', compact(['driver', 'countries', 'state', 'cities','vehicles']));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'first_name'     => 'required',
            'last_name'      => 'required',
            'email'          => 'required|email',
            'password'       => ['confirmed'],
            'contact_number' => 'required',
            'country_id'     => 'required',
            'state_id'       => 'required',
            'city_id'        => 'required',
            'address'        => 'required',
            'vehicle_type'   => 'required',
        ]);

        Driver::updateRecords($id, $request->all());

        return redirect()->route('driver_index')->with('success', 'Driver updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ((int) $id > 0) {

            $driver = Driver::where('id', $id)->delete();
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

    public function driverStatusChange($id, Request $request)
    {
        $driver = Driver::where('id', $id)->first();
        if ($driver) {
            $status = !$request->status;
            $driver->status = $status;
            $driver->save();
            return Response::json(["code" => 200,
                "response_status"             => "success",
                "message"                     => "status has been changed successfully",
                "data"                        => [],
            ]);
        }
        return Response::json(["code" => 500,
            "response_status" => "error",
            "message" => "Something went wrong",
        ]);
    }

    /**
     * Show City List
     *
     * @return \Illuminate\Http\Response
     */
    public function unApprovedDrivers()
    {
        if (auth()->user()->is_admin()) {
            $drivers = Driver::where('status',0)->get();
        } else {
            $drivers = Driver::where('created_by',auth()->user()->id)->where('status',0)->get();            
        }
        $title = 'Approved Drivers';
        return view('driver.list', compact('drivers','title'));
    }

}
