<?php

namespace App\Helpers;
use App\Models\Guest;
use App\Models\User;
use App\Models\Company;
use Auth;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
class GuestHelper
{

    public static function index(){


    $companies = DB::select(DB::raw("SELECT 
        a.company_name, b.total_review
        FROM companies AS a
        LEFT JOIN (
            SELECT
            b.total_review,
            b.company_id
            FROM (
                SELECT
                MAX(total_id) as total_id
                FROM totals
                GROUP BY company_id
            ) as a
        JOIN totals as b ON b.total_id = a.total_id
        ) as b ON b.company_id = a.company_id"));
        

        return response()->json($companies);
    }
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
            'user_image' => 'mimes:jpg,png,jpeg|max:1999'
        ]);

        $id = Auth::user()->user_id;

        $guest = User::find($id)->guest;
        
       
      if($request->hasFile('user_image')){
        
         $imageName  = time() .'.' .$request->file('user_image')->getClientOriginalExtension();
         $request->file('user_image')->storeAs('public/guest/',$imageName); 


        $guest->user_image = $imageName;
        $guest->save();

        return response()->json([
            'message' => 'Successfully updated your image',
            'image' => $guest->user_image
            

        ]);

      }
    }

    public static function showSpecificCompany($id)
    {
        $total_review = DB::table('totals')
        ->select('total_review')
        ->where('company_id',$id)
        ->latest()
        ->first();


        $company_details = DB::table('companies as a')
        ->select('a.company_name','a.address','a.phone_number','a.image')
        ->where('company_id',$id)
        ->first();
        
        $company_reviews = DB::table('reviews as a')
        ->leftJoin('guests as b','b.guest_id','a.guest_id')
        ->where('a.company_id',$id)
        ->get();
       
        

        return  response()->json([
            'total' =>  $total_review,
            'company_detail' => $company_details,
            'company_reviews' =>  $company_reviews,
           
        ]);

    }
   
 
}