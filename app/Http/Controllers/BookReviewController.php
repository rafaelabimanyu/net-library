<?php

namespace App\Http\Controllers;

use App\Models\BookReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookReviewController extends Controller
{
    public function store(Request $request, $bookId)
    {
        $user = Auth::user();

        // Check if user has borrowed this book before
        $hasBorrowed = DB::table('transactions')
            ->where('user_id', $user->id)
            ->where('book_id', $bookId)
            ->whereIn('status', ['borrowed', 'returned'])
            ->exists();

        if (!$hasBorrowed) {
            return back()->with('error', 'You can only review books you have borrowed.');
        }

        $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'review' => ['nullable', 'string', 'max:1000'],
        ]);

        BookReview::updateOrCreate(
            ['user_id' => $user->id, 'book_id' => $bookId],
            ['rating' => $request->rating, 'review' => $request->review]
        );

        return back()->with('success', 'Review submitted successfully.');
    }
}
