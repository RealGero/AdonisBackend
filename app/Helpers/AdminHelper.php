<?php


namespace App\Helpers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;
use DB;

class AdminHelper
{
    public static function getCompany()
    {

        $companies = DB::table('users')
        ->where('user_type','3')
        ->get();

        return response()->json([
            'companies' => $companies
        ]);
    }

    public static function getGuests()
    {

        $guests = DB::table('users')
        ->where('user_type','2')
        ->get();

        return response()->json([
            'guest' => $guests
        ]);
    }

   

}