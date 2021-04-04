<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Response;

class OperatorController extends Controller
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
     * Show Operator
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $operators = User::where('role_id', 2)->get();
        return view('operators.list', compact('operators'));
    }

    /**
     * Create Country
     *
     * @return \Illuminate\Http\Response
     */
    public function signup()
    {
        return view('auth.operator_signup');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed'],
        ]);

        User::create([
            'role_id'   => 2,
            'name'      => $request->get('name'),
            'email'     => $request->get('email'),
            'password'  => Hash::make($request->get('password')),
            'is_active' => 0,
        ]);

        return redirect()->route('login')->with('success', 'Operator has been created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $operator = [];

        if ((int) $id > 0) {
            $operator = User::find($id);
        }

        return view('operators.form', compact(['operator']));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'           => ['required', 'string', 'max:255'],
            'email'          => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'password'       => ['confirmed'],
            'contact_number' => 'required',
        ]);

        $operator = User::find($id);
        $params   = $request->all();
        if ($operator) {
            $image = "";
            if (!empty($params['profile_image'])) {
                $file     = $params['profile_image'];
                $fileName = uniqid() . '-' . $file->getClientOriginalName();

                //Move Uploaded File
                $destinationPath = 'user-image';
                $file->move($destinationPath, $fileName);
                $image = $fileName;
            }

            $operator->name  = !empty($params['name']) ? $params['name'] : "";
            $operator->email = !empty($params['email']) ? $params['email'] : "";
            if (!empty($params['password'])) {
                $operator->password = !empty($params['password']) ? Hash::make($params['password']) : $operator->password;
            }
            if (!empty($image)) {
                $operator->profile_image = $image;
            }
            $operator->contact_number = !empty($params['contact_number']) ? $params['contact_number'] : "";
            $operator->save();
        }

        return redirect()->route('operator_index')->with('success', 'Operator updated successfully.');
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

            $operator = User::where('id', $id)->delete();
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

    public function operatorStatusChange($id, Request $request)
    {
        $operator = User::where('id', $id)->first();
        if ($operator) {
            $is_active           = !$request->is_active;
            $operator->is_active = $is_active;
            $operator->save();
            return Response::json(["code" => 200,
                "response_status"             => "success",
                "message"                     => "status has been changed successfully",
                "data"                        => [],
            ]);
        }
        return Response::json(["code" => 500,
            "response_status"             => "error",
            "message"                     => "Something went wrong",
        ]);
    }

}
