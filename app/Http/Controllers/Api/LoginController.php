<?php

namespace App\Http\Controllers\Api;

use Auth;
use Hash;
use JWTAuth;
use JWTAuthException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePassword;

class LoginController extends Controller
{   

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

        } else {

            return response()->json(['message' => 'Incorrect Password Entered'], 422);
        }
        
        $response['message'] = 'Password Successfuly changed';

        return response()->json($response);
    }


    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function tokenRefresh(Request $request){

        try {
            $token = JWTAuth::getToken();
            
            $new_token = JWTAuth::refresh($token);
            
            $user = JWTAuth::setToken($new_token)->toUser();
            
            $response['token'] = $new_token;
            $response['user'] = $user;

        } catch (JWTException $e) {

                return response()->json(['Failed to create token'], 500);
        }

        return response()->json($response);
    }


    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function login(Request $request){

        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $token = null;

        try {
           if (!$token = JWTAuth::attempt($this->credentials($request))) {
            return response()->json(['Invalid Credentials'], 422);
           }
        } catch (JWTAuthException $e) {
            return response()->json(['Failed to create token'], 500);
        }
        
        $response = compact('token');        
        $response['user'] = Auth::user();

        return response()->json($response);
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function credentials(Request $request)
    {
        return [
            'username' => $request->username,
            'password' => $request->password,
            'role_id' => 2,
        ];
    }
}