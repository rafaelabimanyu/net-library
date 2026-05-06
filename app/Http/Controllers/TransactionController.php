<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = DB::table('transactions')
            ->join('users', 'transactions.user_id', '=', 'users.id')
            ->join('books', 'transactions.book_id', '=', 'books.id')
            ->select('transactions.*', 'users.name as user_name', 'books.judul as book_title')
            ->orderBy('transactions.created_at', 'desc')
            ->get();

        return view('admin.transactions.index', compact('transactions'));
    }

    public function borrow(Request $request, $bookId)
    {
        $book = DB::table('books')->where('id', $bookId)->first();

        if (!$book || $book->stok_tersedia <= 0) {
            return back()->with('error', 'Book is not available for borrowing.');
        }

        DB::table('transactions')->insert([
            'user_id' => Auth::id(),
            'book_id' => $bookId,
            'tgl_pinjam' => now(),
            'tgl_kembali_seharusnya' => now()->addDays(7),
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Borrow request sent! Please wait for validation.');
    }

    public function updateStatus(Request $request, $id)
    {
        $transaction = DB::table('transactions')->where('id', $id)->first();
        $status = $request->status;

        if ($status === 'borrowed' && $transaction->status === 'pending') {
            // Validate stock again just in case
            $book = DB::table('books')->where('id', $transaction->book_id)->first();
            if ($book->stok_tersedia <= 0) {
                return back()->with('error', 'Insufficient stock.');
            }

            DB::table('books')->where('id', $transaction->book_id)->decrement('stok_tersedia');
        } 
        
        elseif ($status === 'returned' && $transaction->status === 'borrowed') {
            DB::table('books')->where('id', $transaction->book_id)->increment('stok_tersedia');
            
            // Calculate Denda
            $tgl_kembali_seharusnya = \Carbon\Carbon::parse($transaction->tgl_kembali_seharusnya);
            $tgl_aktual = now();
            $denda = 0;

            if ($tgl_aktual->gt($tgl_kembali_seharusnya)) {
                $daysLate = $tgl_aktual->diffInDays($tgl_kembali_seharusnya);
                $denda = $daysLate * 2000; // 2000 per day
            }

            DB::table('transactions')->where('id', $id)->update([
                'tgl_pengembalian_aktual' => $tgl_aktual,
                'denda' => $denda,
                'updated_at' => now(),
            ]);
        }

        DB::table('transactions')->where('id', $id)->update([
            'status' => $status,
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Transaction status updated successfully.');
    }
}
