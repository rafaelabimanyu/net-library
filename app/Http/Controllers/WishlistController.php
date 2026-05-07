<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function toggle(Book $book)
    {
        $userId = Auth::id();
        
        $wishlist = Wishlist::where('user_id', $userId)
                            ->where('book_id', $book->id)
                            ->first();

        if ($wishlist) {
            $wishlist->delete();
            return back()->with('success', __('Removed from wishlist.'));
        }

        Wishlist::create([
            'user_id' => $userId,
            'book_id' => $book->id
        ]);

        return back()->with('success', __('Added to wishlist.'));
    }
}
