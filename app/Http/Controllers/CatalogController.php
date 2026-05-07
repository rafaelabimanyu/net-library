<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;

class CatalogController extends Controller
{
    public function index()
    {
        $books = DB::table('books')->get();
        $userId = Auth::id();
        
        $wishlistedIds = [];
        if ($userId) {
            $wishlistedIds = Wishlist::where('user_id', $userId)->pluck('book_id')->toArray();
        }

        foreach ($books as $book) {
            $book->is_wishlisted = in_array($book->id, $wishlistedIds);
            
            $book->avg_rating = DB::table('book_reviews')
                ->where('book_id', $book->id)
                ->avg('rating') ?: 0;
            
            $book->reviews = DB::table('book_reviews')
                ->join('users', 'book_reviews.user_id', '=', 'users.id')
                ->where('book_id', $book->id)
                ->select('book_reviews.*', 'users.name as user_name', 'users.avatar as user_avatar')
                ->orderBy('book_reviews.created_at', 'desc')
                ->get();
        }

        return view('catalog', compact('books'));
    }

    public function adminIndex()
    {
        $books = DB::table('books')->get();
        return view('admin.books.index', compact('books'));
    }
}
