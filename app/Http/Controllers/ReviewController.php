<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    
    public function sendReview(Request $request){
        $request->validate([
            'comment' => 'required',
            'rating' => 'required'
        ]);


        $review = Review::create([
            'user_id' => Auth::user()->id,
            'book_id' => $request->book_id,
            'comment' => $request->comment,
            'rating' => $request->rating,
        ]);

        flash()->success('Review Send Successfully');
        return redirect()->back();
    }
}
