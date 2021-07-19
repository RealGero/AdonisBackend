<?php

namespace App\Helpers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;

class CredentialHelper
{

    public static function registerUser($request)
    {


        $request->validate([
            'email' => 'email|unique:users|required|string',
            'password'=>'required|min:6|string|confirmed',
          
        ]);
 
            $user = new User([
            'email' => strtolower($request->email),
            'password' => Hash::make($request->password),
            'user_type' => $request->user_type
        ]);

       
        $user->save();
        
    
        $authToken = $user->createToken('authToken')->accessToken;
       
        return response([
            'message' => 'You are already registered Welcome',
            'user' => $user,
            'auth_token' =>$authToken
        ]);

    }

    public static function  login($request)
    {
            strtolower($request->email);

            $login =  $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        
     ]);
    
    if (!Auth::attempt($login))
    {
        return response(['message' => 'invalid credentials']);

    }

    $authToken = Auth::user()->createToken('authToken')->accessToken;

        return response(['user' => Auth::user(), 'access_token' => $authToken]);

    }

}
