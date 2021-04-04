<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Response;

class CountryController extends Controller
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
        $country = Country::get();
        return view('country.list', compact('country'));
    }

    /**
     * Create Country
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('country.form');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'  => 'required'
        ]);

        Country::add($request->all());

        return redirect()->route('country_index')->with('success', 'Country created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = [];

        if ((int) $id > 0) {
            $country = Country::find($id);
        }

        return view('country.form', compact(['country']));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        Country::updateRecords($id, $request->all());

        return redirect()->route('country_index')->with('success', 'Country updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ((int) $id > 0) {

            $country = Country::where('id', $id)->delete();
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
