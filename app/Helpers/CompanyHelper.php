<?php

namespace App\Helpers;

use App\Models\Company;
use App\Models\User;
use DB;
use Auth;

class CompanyHelper
{

    public static function store($request)
    {
       
        $request->validate([
            "company_name" => 'required|string',
            "address" => 'required|string',
            'phone_number' => 'required|digits:11|unique:guests|unique:companies',

        ]);

        $company = new Company;
        $company->company_name = $request->input('company_name');
        $company->address = $request->input('address');
        $company->phone_number = $request->input('phone_number');
        $company->user_id = Auth::id();

        $company->save();

        return response()->json([
            'message' =>'Successfully updated your profile',
            'company' => $company
        ]);

    }

    public static function companyUploadImage($request)
    {
           
        $request->validate([
            'image' => 'mimes:jpg,png,jpeg|max:1999'
        ]);

        $id = Auth::user()->user_id;

        $company = User::find($id)->company;
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

    public static function update($request)
    {
        $request->validate([
            "company_name" => 'required|string',
            "address" => 'required|string',
        ]);

       $user = Auth::user()->user_id;
        
        $company = User::find($user)->company;

        $company->company_name = $request->input('company_name');
        $company->address = $request->input('address');
        $company->save();

        return response()->json([
            'message' => 'Successfully updated your profile'
        ]);
    }

    public static function index()
    {
       
        $id = Auth::user()->user_id;
        $company_id = User::find($id)->company->company_id;
    
        $users = DB::table('reviews as a')
        ->leftJoin('guests as b','b.guest_id','a.guest_id')
        // ->select('a.*','b.f_name','b.m_name','b.l_name','b.extension_name')
        ->where('a.company_id', $company_id)
        ->get();

        return response()->json($users);
    }
}