<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Helpers\CompanyHelper;
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
        
        $data = CompanyHelper::store($request);

        return response()->json($data);


    }

    public function uploadImage(Request $request)
    {
       
     $company = CompanyHelper::uploadImage($request);

     return response()->json($company);
 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        
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
       $company = CompanyHelper::update($request);


       return response()->json($company);
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