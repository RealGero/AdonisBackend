<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\User;
use App\Models\Guest;
use App\Models\Admin;
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

        
        $companies = DB::table('companies')
        ->where('user_type','3')
        ->get();

        return response()->json([
            'message' => $companies
        ]);
    }

    public function storeAdminProfile(Request $request)
    {

        $request->validate([
            'first_name'=> 'required|string|min:2|regex:/^[\pL\s\-]+$/u',
            'middle_name'=> 'required|string|min:2|regex:/^[\pL\s\-]+$/u',
            'last_name'=> 'required|string|min:2|regex:/^[\pL\s\-]+$/u',
          
        ]);

        // VALIDATION PROFILE TO GUEST
        $admin = new Admin;


        $admin->f_name = $request->input('first_name');
        $admin->m_name = $request->input('middle_name');
        $admin->l_name = $request->input('last_name');
        $admin->user_id = Auth::user()->user_id;
        
        $admin->save();

        return response()->json([

            'message'=>'Successfully Added',
            'admin' => $admin

        ]);


    }
}
