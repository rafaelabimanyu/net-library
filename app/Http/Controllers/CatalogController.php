<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CatalogController extends Controller
{
    public function index()
    {
        $books = Book::orderBy('created_at', 'desc')->get();
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
        $books = Book::orderBy('created_at', 'desc')->get();
        return view('admin.books.index', compact('books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'synopsis' => 'nullable|string',
            'kategori' => 'required|string|max:255',
            'isbn' => 'nullable|string|max:50',
            'stok_total' => 'required|integer|min:0',
            'rak_lokasi' => 'nullable|string|max:50',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $coverPath = null;
        if ($request->hasFile('cover_image')) {
            $coverPath = $request->file('cover_image')->store('covers', 'public');
        }

        Book::create([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'synopsis' => $request->synopsis,
            'kategori' => $request->kategori,
            'isbn' => $request->isbn,
            'stok_total' => $request->stok_total,
            'stok_tersedia' => $request->stok_total, // initially all available
            'rak_lokasi' => $request->rak_lokasi,
            'cover_image' => $coverPath,
        ]);

        return back()->with('success', 'Book asset created successfully.');
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'synopsis' => 'nullable|string',
            'kategori' => 'required|string|max:255',
            'isbn' => 'nullable|string|max:50',
            'stok_total' => 'required|integer|min:0',
            'rak_lokasi' => 'nullable|string|max:50',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Recompute stok_tersedia
        $activeLoansCount = DB::table('transactions')
            ->where('book_id', $id)
            ->where('status', 'borrowed')
            ->count();
        $stokTersedia = max(0, $request->stok_total - $activeLoansCount);

        $updateData = [
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'synopsis' => $request->synopsis,
            'kategori' => $request->kategori,
            'isbn' => $request->isbn,
            'stok_total' => $request->stok_total,
            'stok_tersedia' => $stokTersedia,
            'rak_lokasi' => $request->rak_lokasi,
        ];

        if ($request->hasFile('cover_image')) {
            // Delete old cover image if it exists and is not a URL
            if ($book->getRawOriginal('cover_image') && !filter_var($book->getRawOriginal('cover_image'), FILTER_VALIDATE_URL)) {
                Storage::disk('public')->delete($book->getRawOriginal('cover_image'));
            }
            $updateData['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        $book->update($updateData);

        return back()->with('success', 'Book asset updated successfully.');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        // Check if there are active loans (borrowed or pending)
        $activeLoans = DB::table('transactions')
            ->where('book_id', $id)
            ->whereIn('status', ['borrowed', 'pending'])
            ->count();

        if ($activeLoans > 0) {
            return back()->with('error', 'Cannot purge book asset. There are active or pending loan transactions registered.');
        }

        // Delete cover image file if it's local
        if ($book->getRawOriginal('cover_image') && !filter_var($book->getRawOriginal('cover_image'), FILTER_VALIDATE_URL)) {
            Storage::disk('public')->delete($book->getRawOriginal('cover_image'));
        }

        $book->delete();

        return back()->with('success', 'Book asset purged successfully.');
    }
}
