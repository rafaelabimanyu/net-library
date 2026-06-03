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

        $message = '';
        if ($wishlist) {
            $wishlist->delete();
            $message = __('Removed from wishlist.');
        } else {
            Wishlist::create([
                'user_id' => $userId,
                'book_id' => $book->id
            ]);
            $message = __('Added to wishlist.');
        }

        if (request()->isMethod('get')) {
            return redirect()->route('catalog')->with('success', $message);
        }

        return back()->with('success', $message);
    }
}
