<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function index(){}

    public function store(Request $request){
        
        $validated = $request->validate([
            'user_id' => 'required|exists:user,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string',
        ]);

        $rating = new Rating();
        $rating->user_id = $validated['user_id'];
        $rating->rating = $validated['rating'];
        $rating->review = $validated['review'];
        $rating->save();
    }
}
