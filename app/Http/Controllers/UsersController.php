<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Guest;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Helpers\CredentialHelper;
class UsersController extends Controller
{
    public function index()
    {
       $users = User::all();

       return $users;
    }
    public function login(Request $request)
    {
        $user = CredentialHelper::login($request);
        return response()->json($user);

    }

    public function register(Request $request)
    {
        
        $user = CredentialHelper::registerUser($request);
     
        return response()->json($user);

         
    }

    public function logout(Request $request)
    {
      
      
            auth()->user()->token()->revoke();
           
            return response()->json(['message'=>'Logged out']);
        
    }


}