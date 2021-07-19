<?php

namespace App\Helpers;
use App\Models\Guest;
use Auth;
use Illuminate\Support\Facades\Hash;
class GuestHelper
{

    public static function store($request)
    {
        // return  response()->json(Auth::user());
         // VALIDATION PROFILE TO GUEST
         $request->validate([
            'first_name'=> 'required|string|min:2|regex:/^[\pL\s\-]+$/u',
            'middle_name'=> 'required|string|min:2|regex:/^[\pL\s\-]+$/u',
            'last_name'=> 'required|string|min:2|regex:/^[\pL\s\-]+$/u',
            'address'=> 'required|string|min:2'
        ]);

        // VALIDATION PROFILE TO GUEST
        $guest = new Guest;


        $guest->f_name = $request->input('first_name');
        $guest->m_name = $request->input('middle_name');
        $guest->l_name = $request->input('last_name');
        $guest->address = $request->input('address');
        $guest->user_id = Auth::id();
        
        $guest->save();
      

        return response()->json([

            'message'=>'Successfully Added',
            'guest' => $guest

        ]);
    }


    public static function update($request, $id)
    {
               // VALIDATION PROFILE TO GUEST
               $request->validate([
                'first_name'=> 'required|string|min:2|regex:/^[\pL\s\-]+$/u',
                'middle_name'=> 'required|string|min:2|regex:/^[\pL\s\-]+$/u',
                'last_name'=> 'required|string|min:2|regex:/^[\pL\s\-]+$/u',
                'address'=> 'required|string|min:2'
            ]);
    
            // VALIDATION PROFILE TO GUEST
            $guest = new Guest;
    
    
            $guest->f_name = $request->input('first_name');
            $guest->m_name = $request->input('middle_name');
            $guest->l_name = $request->input('last_name');
            $guest->address = $request->input('address');
            $guest->user_id = Auth::user()->user_id;
            
            $guest->save();
          
    
            return response()->json([
    
                'message'=>'Successfully Added',
                'guest' => $guest
    
            ]);


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