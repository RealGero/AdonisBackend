<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    public function login(Request $request)
    {
    //  $login =  $request->validate([
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required|string'
            
    //     ]);

    //     if (!Auth::attempt($login))
    //     {
    //         return response(['message' => 'invalid credentials']);

    //     }

    //     $authToken = Auth::user()->createToken('authToken')->accessToken;

    //     return response(['user' => Auth::user(), 'access_token' => $authToken]);

    }
}
