<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class MReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::where('status', '=', 'pending')->paginate(16);
        return view('admin.review.review', compact('reviews'));
    }

    public function acceptReview(Request $request) {
        Review::where('review_id', '=', $request->review_id)->first()->update([
            'status' => 'accepted'
        ]);
        return redirect()->back();
    }

    public function declineReview(Request $request) {
        Review::where('review_id', '=', $request->review_id)->delete();
        return redirect()->back();
    }
}
