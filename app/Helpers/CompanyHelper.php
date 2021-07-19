<?php

namespace App\Helpers;

use App\Models\Company;
use Auth;

class CompanyHelper
{

    public static function store($request)
    {
       
        $request->validate([
            "company_name" => 'required|string',
            "address" => 'required|string',
        ]);

        $company = new Company;
        $company->company_name = $request->input('company_name');
        $company->address = $request->input('address');
        $company->user_id = Auth::id();

        $company->save();

        return response()->json([
            'message' =>'Successfully updated your profile',
            'company' => $company
        ]);

    }
}