<?php

namespace App\Helpers;
use App\Models\Review;
use App\Models\Total;
use Validator;
use DB;
use Auth;
class ReviewHelper{

    public static function store ($request,$id)
    {
        
        $request->validate([
            'comment' => 'required|string|max:300',
            'ratings' => 'required|numeric',
            'review_image' => 'mimes:jpg,png,jpeg|max:1999'
            
        ]);
      

        // $validator = Validator::make($request->all(),$rules);
        $auth_id = Auth::user()->user_id;
     
        $review = new Review;
        $review->company_id = $id;
        $review->guest_id = $auth_id;
        $review->comment = $request->input('comment');
        $review->ratings = $request->input('ratings');


            if($request->hasFile('review_image')){
            
                $imageName  = time() .'.' .$request->file('review_image')->getClientOriginalExtension();
                $request->file('review_image')->storeAs('public/review/',$imageName); 
    
    
            $review->review_image = $imageName;
         
        }

      
     
        
        $check = DB::table('reviews')
        ->where([
           ['company_id','=',$id],
           [ 'guest_id','=',$auth_id],
        ])->exists();


        if($check){

            return response()->json([
                'message' => 'You already commented this company'
            ]);
         
        }else{

            $review->save();

            $numerator = Review::select('ratings')
            ->where('company_id', '=', $id)
            ->sum('ratings');
    
            $denominator = DB::table('reviews')
            ->where('company_id','=',$id)
            ->count();
    
            
          
            $total = new Total;
            if($denominator == 0)
            {
                $denominator = 1;
                
            $total->total_review = ($numerator /  $denominator );
            
                $total->company_id = $review->company_id;
                $total->save();
            }else{

                $total->total_review = ($numerator /  $denominator );
                $total->company_id = $review->company_id;
                $total->save();
            
            }


            return response()->json([
            'message' => 'Thank you for the review',
            'data' => $review
            ]);
                    
            }
                    
     }

}
