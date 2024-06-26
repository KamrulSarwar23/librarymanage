<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{

    public function sendReview(Request $request)
    {
        $request->validate([
            'comment' => 'required',
            'rating' => 'required'
        ]);

        Review::create([
            'user_id' => Auth::user()->id,
            'book_id' => $request->book_id,
            'comment' => $request->comment,
            'rating' => $request->rating,
            'status' => $request->status ?? 'inactive',
        ]);

        return response()->json(['success' => 'Review sent successfully! Your review will be added soon.']);
    }


    public function bookReview()
    {
        $reviews = Review::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.review.index', compact('reviews'));
    }


    public function bookReviewStatus(Request $request)
    {
        $reviews = Review::findOrFail($request->id);
        $reviews->status = $request->status == 'true' ? 'active' : 'inactive';
        $reviews->save();

        return response()->json(['message' => 'Status has been Updated!']);
    }

    public function destroy(string $id)
    {
        $reviews = Review::findOrFail($id);
        $reviews->delete();

        return response()->json(['status' => 'success', 'message' => 'Review Deleted Successfully']);
    }

    public function activeReview(){
        $reviews = Review::where('status', 'active')->orderBy('created_at', 'DESC')->paginate(10);

        if (count($reviews) == null) {
            flash()->error('No Data Found');
        }

        return view('admin.review.index', compact('reviews'));
    }

    public function pendingReview(){
        $reviews = Review::where('status', 'inactive')->orderBy('created_at', 'DESC')->paginate(10);

        if (count($reviews) == null) {
            flash()->error('No Data Found');
        }

        return view('admin.review.index', compact('reviews'));
    }
}
