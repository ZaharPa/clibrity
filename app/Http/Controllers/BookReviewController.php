<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookReviewController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'rating' => 'nullable|integer|min:1|max:5',
            'comment' => 'nullable|string|min:1|max:400',
            'book_id' => 'required|exists:books,id'
        ]);

        $review = Auth::user()->reviews()->updateOrCreate(
            ['book_id' => $request->book_id],
            [
                'rating' => $request->rating,
                'comment' => $request->comment
            ]
        );

        return response()->json(['review' => $review], 201);
    }
}
