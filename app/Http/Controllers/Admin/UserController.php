<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Session;
use App\Role;
use App\User;
use App\Facility;
use Illuminate\Http\Request;
use App\Http\Requests\CreateUser;
use App\Http\Requests\UpdateUser;
use App\Http\Requests\UpdatePassword;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        $allroles = Role::all();
        $roles = [];
        foreach($allroles as $allrole){
            $roles[$allrole->id] = $allrole->name;
        }

        $allfacilites = Facility::all();
        $facilities =[];
        foreach ($allfacilites as $allfacility) {
            $facilities[$allfacility->id] = $allfacility->name;
        }

        return view('users.index')->withUsers($users)->withRoles($roles)->withFacilities($facilities);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateUser  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUser $request)
    {
        $user = New User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        //$user->password = bcrypt(904310813);
        $user->password = bcrypt($request->password);
        $user->role_id = $request->role_id;

        if($request->role_id == 4){
            $user->facility_id = $request->facility_id;
        }

        $user->save();

        Session::flash('status', 'User successfully created');                   

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $allroles = Role::all();
        $roles = [];
        foreach($allroles as $allrole){
            $roles[$allrole->id] = $allrole->name;
        }

        $allfacilites = Facility::all();
        $facilities =[];
        foreach ($allfacilites as $allfacility) {
            $facilities[$allfacility->id] = $allfacility->name;
        }
        return view('users.edit')->withUser($user)->withRoles($roles)->withFacilities($facilities);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateUser  $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, User $user)
    {
        if($user->id == Auth::user()->id) {

            Session::flash('error', 'Sorry You cannot change role of a logged in user');            

        } else if($user->role_id == 1 && $request->facility_id != null) {

            Session::flash('error', 'Sorry Super Admin cannot be assinged a health facility');
        } else {
            $user->role_id = $request->role_id;
            $user->facility_id = $request->facility_id;
            $user->save();

            Session::flash('status', 'User successfully updated');            

        }
        return redirect()->route('users.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdatePassword  $request
     * @return \Illuminate\Http\Response
     */
    public function savePassword(UpdatePassword $request)
    {
        $current_password = Auth::user()->password;

        Session::flash('status', 'Password matches');


        if(Hash::make($request->current_password) == $current_password){
            
            Session::flash('status', 'Password matches'); 
        } else {
            Session::flash('error', 'Password does not match');
        }

        return redirect()->route('password.new');
    }
}
