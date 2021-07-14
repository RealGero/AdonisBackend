<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Guest;
use Illuminate\Support\Facades\Hash;
use Auth;

class UsersController extends Controller
{
    public function index()
    {
       $users = User::all();

       return $users;
    }
    public function login(Request $request)
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

    public function register(Request $request)
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
        
   
        
        // $guest->user_id = $user->user_id;
        // $guest->save();
      
    
        $authToken = $user->createToken('authToken')->accessToken;
       
        return response([
            'message' => 'You are already registered Welcome',
            'user' => $user,
            'auth_token' =>$authToken
        ]);

         
    }

    public function logout(Request $request)
    {
      
      
            // Auth::user()->AuthAccessToken()->delete();
            // $request->user()->tokens()->revoke();
            auth()->user()->token()->revoke();
           
            return response()->json(['message'=>'Logged out']);
        
    }


}