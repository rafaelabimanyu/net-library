<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks = DB::table('books')->count();
        $totalMembers = DB::table('users')->where('role', 'pengunjung')->count();
        $loansToday = DB::table('transactions')->whereDate('created_at', now())->count();
        $totalFines = DB::table('transactions')->sum('denda');

        // Recent Transactions
        $recentTransactions = DB::table('transactions')
            ->join('users', 'transactions.user_id', '=', 'users.id')
            ->join('books', 'transactions.book_id', '=', 'books.id')
            ->select('transactions.*', 'users.name as user_name', 'books.judul as book_title')
            ->orderBy('transactions.created_at', 'desc')
            ->limit(5)
            ->get();

        $pendingApprovalCount = DB::table('transactions')->where('status', 'pending')->count();

        if (auth()->user()->role === 'admin') {
            return view('admin.dashboard', compact('totalBooks', 'totalMembers', 'loansToday', 'totalFines', 'recentTransactions'));
        }

        return view('petugas.dashboard', compact('totalBooks', 'totalMembers', 'loansToday', 'totalFines', 'recentTransactions', 'pendingApprovalCount'));
    }
}
