<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Response;

class UserController extends Controller
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
     * Show Profile
     *
     * @return \Illuminate\Http\Response
     */
    public function profileView()
    {
        return view('profile.form');
    }

    public function profileUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'name'           => ['required', 'string', 'max:255'],
            'email'          => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'password'       => ['confirmed'],
            'contact_number' => 'required',
        ]);

        $user   = auth()->user();
        $params = $request->all();
        if ($user) {
            $image = "";
            if (!empty($params['profile_image'])) {
                $file     = $params['profile_image'];
                $fileName = uniqid() . '-' . $file->getClientOriginalName();

                //Move Uploaded File
                $destinationPath = 'user-image';
                $file->move($destinationPath, $fileName);
                $image = $fileName;
            }

            $user->name  = !empty($params['name']) ? $params['name'] : "";
            $user->email = !empty($params['email']) ? $params['email'] : "";
            if (!empty($params['password'])) {
                $user->password = !empty($params['password']) ? Hash::make($params['password']) : $user->password;
            }
            if (!empty($image)) {
                $user->profile_image = $image;
            }
            $user->contact_number = !empty($params['contact_number']) ? $params['contact_number'] : "";
            $user->save();
        }

        return redirect()->route('profile_view')->with('success', 'Profile updated successfully.');
    }

}
