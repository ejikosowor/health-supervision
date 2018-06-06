<?php

namespace App\Http\Controllers;

use Hash;
use Auth;
use Session;
use App\User;
use App\Facility;
use App\Supervision;
use App\SupervisionCategory;
use Illuminate\Http\Request;
use App\Http\Requests\UpdatePassword;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $facilities = Facility::all();
        $categories = SupervisionCategory::all();
        $supervisions = Supervision::all();

        return view('home.index')->withUsers($users)->withFacilities($facilities)->withCategories($categories)->withSupervisions($supervisions);
    }

    /**
     * Show the form for changing password
     *
     * @return \Illuminate\Http\Response
     */
    public function changePassword()
    {        
        return view('users.changepass');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdatePassword  $request
     * @return \Illuminate\Http\Response
     */
    public function savePassword(UpdatePassword $request)
    {
        if(Hash::check($request->current_password, Auth::user()->password)){
            
            $user = Auth::user();
            $user->password = bcrypt($request->new_password);
            $user->save();

            Session::flash('status', 'Password Successfuly changed');

        } else {

            Session::flash('error', 'Incorrect password entered');
        }

        return view('users.changepass');    
    }
}