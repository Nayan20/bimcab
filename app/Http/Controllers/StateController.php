<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Response;

class StateController extends Controller
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
        $state = State::get();
        return view('state.list', compact('state'));
    }

    /**
     * Create State
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::pluck('name','id')->toArray();
        return view('state.form',compact('countries'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'country_id'  => 'required',
            'name'  => 'required'
        ]);

        State::add($request->all());

        return redirect()->route('state_index')->with('success', 'State created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $state = [];

        if ((int) $id > 0) {
            $state = State::find($id);
        }
        $countries = Country::pluck('name','id')->toArray();

        return view('state.form', compact(['state','countries']));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'country_id'  => 'required',
            'name' => 'required'
        ]);

        State::updateRecords($id, $request->all());

        return redirect()->route('state_index')->with('success', 'State updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ((int) $id > 0) {

            $state = State::where('id', $id)->delete();
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
