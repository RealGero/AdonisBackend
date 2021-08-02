<?php

namespace App\Http\Controllers;

use App\Helpers\GuestHelper;
use App\Models\Guest;
use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Facades\Hash;
class GuestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        
        $companies = GuestHelper::index();
        return response()->json($companies);

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
        
        $guest = GuestHelper::store($request);

        return response()->json($guest);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function show(Guest $guest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function edit(Guest $guest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $guest = GuestHelper::update($request);

        return response()->json($guest);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guest $guest)
    {
        //
    }

    
    public function guestUploadImage(Request $request)
    {
        $image = GuestHelper::guestUploadImage($request);

        return response()->json($image);
    }

    public function showSpecificCompany($id)
    {
       
      
        $show = GuestHelper::showSpecificCompany($id);

        return response()->json($show);
    }

    
}
