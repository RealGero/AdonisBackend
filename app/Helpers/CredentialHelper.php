<?php

namespace App\Helpers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
class CredentialHelper
{

    public static function registerUser($request)
    {

        $rules = array(
            'email' => 'email|unique:users|required|string',
            'password'=>'required|min:6|string|confirmed'
        );

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){

            return response()->json([
                'message' => $validator->errors()
            ],403);

        }else{
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
            ],200);
    

        }
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
        return response()->json(['message' => 'invalid credentials']);

    }

    $authToken = Auth::user()->createToken('authToken')->accessToken;

        return response(['user' => Auth::user(), 'auth_token' => $authToken]);

    }

    public static function updatePassword($request)
    {

        $request->validate([

            'current_password'=> 'required',
            'new_password'=>'required|string|min:8',
            'password_confirmation' =>'required|min:8|same:new_password'
    
            ]);

        if(!(Hash::check($request->get('current_password'),Auth::user()->password)))
        {
            return response()->json([
                'error' => 'The current password does not match with your old password'
            ]);
        }

        if(strcmp($request->get('current_password'),$request->get('new_password'))==0)
        {
            return response()->json([
                'error' => 'The current password cannot be the same with the new password'
            ]);
        }
        $user = Auth::user();

        $user->password = bcrypt($request->get('new_password'));
        $user->save();

        return response()->json([
            'message' => 'Password successfully changed'  
          ]);
    }

}
