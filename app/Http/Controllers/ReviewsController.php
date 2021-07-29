<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ReviewHelper;

class ReviewsController extends Controller
{
    public function store(Request $request,$id)
    {
        $review = ReviewHelper::store($request,$id);

        return response()->json( $review);
    }
}
