<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Response;

class VehicleController extends Controller
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
     * Show Service List
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicle = Vehicle::get();
        return view('vehicle.list', compact('vehicle'));
    }

    /**
     * Create Vehicle
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vehicle.form');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'  => 'required',
            'cost'  => 'required',
            'image' => 'required',
        ]);

        Vehicle::add($request->all());

        return redirect()->route('vehicle_index')->with('success', 'Vehicle created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vehicle = [];

        if ((int) $id > 0) {
            $vehicle = Vehicle::find($id);
        }

        return view('vehicle.form', compact(['vehicle']));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'cost' => 'required',
        ]);

        Vehicle::updateRecords($id, $request->all());

        return redirect()->route('vehicle_index')->with('success', 'Vehicle updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ((int) $id > 0) {

            $vehicle = Vehicle::where('id', $id)->delete();
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
