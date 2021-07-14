<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "company_name" => 'required|string',
            "address" => 'required|string',
        ]);

        $company = new Company;
        $company->company_name = $request->input('company_name');
        $company->address = $request->input('address');
        $company->user_id = Auth::user()->user_id;

        $company->save();

        return response()->json([
            'message' =>'Successfully updated your profile',
            'company' => $company
        ]);


    }

    public function uploadImage(Request $request)
    {
        

        $request->validate([
            'image' => 'mimes:jpg,png,jpeg|max:1999'
        ]);

        $id = Auth::user()->user_id;

        $company = User::find($id)->company;
        $user_name = $company->company_name;    
       
      if($request->hasFile('image')){

        $newImage  = time(). '-'. $user_name . $request->image->extension();
        $test =  $request->file('image')->storeAs('public/company',$newImage);

        $company->image = $test;
        $company->save();

        return response()->json([
            'message' => 'Successfully updated your profile',
            'data' => $company

        ]);

      }
 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }
}


    // UPDATE IMAGE FOR COMPANY
        // if($request->hasFile('image'))
        // {
        //     $filenameWithExt = $request->file('image')->getClientOriginalName();
        //     $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME); 
        //     $extension = $request->file('image')->getClientOriginalExtension();
        //     $filenameToStore = $filename.'.'.time().'.'.$extension;
        //     $path = $request->file('image')->storeAs('public/company',$filenameToStore); 
            
       
        //     $company->image = $filenameToStore;
      
        // };