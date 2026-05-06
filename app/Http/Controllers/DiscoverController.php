<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiscoverController extends Controller
{
    public function index()
    {
        $totalBooks = DB::table('books')->sum('stok_total');
        $totalLoans = DB::table('transactions')->where('status', 'borrowed')->count();
        $activeMembers = DB::table('users')->where('role', 'pengunjung')->count();

        $popularCategories = DB::table('books')
            ->select('kategori', DB::raw('count(*) as count'))
            ->groupBy('kategori')
            ->orderBy('count', 'desc')
            ->limit(6)
            ->get();

        $testimonials = [
            ['name' => 'Alex Rivers', 'text' => 'The antigravity interface is revolutionary. I found my research papers in seconds.', 'role' => 'Researcher'],
            ['name' => 'Sarah Chen', 'text' => 'Beautiful design and seamless borrowing process. The future is here.', 'role' => 'Student'],
            ['name' => 'Marcus Thorne', 'text' => 'A masterclass in UI/UX. Net-Library has completely changed how I read.', 'role' => 'Avid Reader'],
        ];

        return view('discover', compact('totalBooks', 'totalLoans', 'activeMembers', 'popularCategories', 'testimonials'));
    }
}
