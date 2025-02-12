<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Reviews;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    public function ReviewStore(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'rating' => 'required',
            'review' => 'required',
            'user_id' => 'required|exists:users,id',
            'college_id' => 'required|exists:colleges,id',
        ]);

        $review = Reviews::create([
            'name' => $request->name,
            'rating' => $request->rating,
            'review' => $request->review,
            'user_id' => $request->user_id,
            'college_id' => $request->college_id,
        ]);

        return redirect()->back()->with('success', 'Review added successfully.');
    }
}
