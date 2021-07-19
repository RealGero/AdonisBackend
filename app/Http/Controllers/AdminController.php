<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\User;
use App\Models\Guest;
use App\Models\Admin;
use App\Helpers\AdminHelper;

use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    public function getUsers(){

      
        if(Auth::check())
        {
            $users = DB::table('users')
            ->where('user_type','2')
            ->get();
    
            return response()->json([
                'message' => $users
            ]);
        }else{
            return response()->json([
                'message' => 'Please Logged in'
            ]);
        }
       
    }

    public function getCompany(){

        $data = AdminHelper::getCompany();

        return response()->json($data);
     
    }

    public function getGuest(){

        
        $data = AdminHelper::getCompany();

        return response()->json($data);
    }

  
   
    // public function showProfile($id)
    // {
    //     $profile = Admin::find($id)->first();


    //     return response()->json([

    //         'data' => $profile
    //     ]);
    // }
}
