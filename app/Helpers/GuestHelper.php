<?php

namespace App\Helpers;
use App\Models\Guest;
use Auth;
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
}