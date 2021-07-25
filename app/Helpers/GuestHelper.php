<?php

namespace App\Helpers;
use App\Models\Guest;
use App\Models\User;
use App\Models\Company;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
class GuestHelper
{

    public static function store($request)
    {
        // return  response()->json(Auth::user());
         // VALIDATION PROFILE TO GUEST
         $request->validate([
            'first_name'=> 'required|string|min:2|regex:/^[\pL\s\-]+$/u',
            'middle_name'=> 'string|min:2|regex:/^[\pL\s\-]+$/u',
            'last_name'=> 'required|string|min:2|regex:/^[\pL\s\-]+$/u',
            'extension_name' => 'min:2|string|max:5',
            'address'=> 'required|string|min:2',
            'phone_number' => 'required|digits:11|unique:guests|unique:companies',
            'birth_date' => 'required|date'
        ]);

     
        // VALIDATION PROFILE TO GUEST
        $guest = new Guest;


        $guest->f_name = $request->input('first_name');
        $guest->m_name = $request->input('middle_name');
        $guest->l_name = $request->input('last_name');
        $guest->address = $request->input('address');
        $guest->phone_number = $request->input('phone_number');
        $guest->extension_name = $request->input('extension_name');
        $guest->birth_date = $request->input('birth_date');
        $guest->user_id = Auth::id();
        
        $guest->save();
      

        return response()->json([

            'message'=>'Successfully Added',
            'guest' => $guest

        ]);
    }


    public static function update($request)
    {
               // VALIDATION PROFILE TO GUEST
               $request->validate([
                'first_name'=> 'required|string|min:2|regex:/^[\pL\s\-]+$/u',
                'middle_name'=> 'required|string|min:2|regex:/^[\pL\s\-]+$/u',
                'last_name'=> 'required|string|min:2|regex:/^[\pL\s\-]+$/u',
                'address'=> 'required|string|min:2'
            ]);
    
            // VALIDATION PROFILE TO GUEST
           $id = Auth::user()->user_id;
          $guest = User::find($id)->guest;
    
    
            $guest->f_name = $request->input('first_name');
            $guest->m_name = $request->input('middle_name');
            $guest->l_name = $request->input('last_name');
            $guest->address = $request->input('address');
            $guest->user_id = $id;
            
            $guest->save();
          
    
            return response()->json([
    
                'message'=>'Successfully Updated',
                'guest' => $guest
    
            ]);


    }

    public static function guestUploadImage($request)
    {
           
        $request->validate([
            'image' => 'mimes:jpg,png,jpeg|max:1999'
        ]);

        $id = Auth::user()->user_id;

       return $guest = User::find($id)->guest;
        $user_name = $company->company_name;    
       
      if($request->hasFile('image')){
        
         $newImage  = time(). '-'. $user_name .'.' .$request->image->extension();
        $test =  $request->file('image')->storeAs('public/company',$newImage);

        $company->image = $test;
        $company->save();

        return response()->json([
            'message' => 'Successfully updated your image',
            

        ]);

      }
    }

    public static function showSpecificCompany($id)
    {
        $company = Company::find($id)->first();

        return  $company;

    }
   
}