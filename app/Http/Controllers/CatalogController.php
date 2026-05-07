<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BookReview;

class CatalogController extends Controller
{
    public function index()
    {
        $books = DB::table('books')->get();
        
        // Add average rating to each book
        foreach ($books as $book) {
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
