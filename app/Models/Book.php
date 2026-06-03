<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'slug',
        'penulis',
        'synopsis',
        'kategori',
        'isbn',
        'stok_total',
        'stok_tersedia',
        'rak_lokasi',
        'cover_image',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($book) {
            if (empty($book->slug)) {
                $book->slug = Str::slug($book->judul);
            }
        });

        static::updating(function ($book) {
            if ($book->isDirty('judul')) {
                $book->slug = Str::slug($book->judul);
            }
        });
    }

    /**
     * Get the formatted cover image.
     */
    public function getCoverImageAttribute($value)
    {
        if (empty($value)) {
            return 'https://images.unsplash.com/photo-1543004221-1f12796bb3d0?auto=format&fit=crop&q=80&w=400';
        }

        if (filter_var($value, FILTER_VALIDATE_URL) || str_starts_with($value, 'http://') || str_starts_with($value, 'https://')) {
            return $value;
        }

        return asset('storage/' . $value);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function reviews()
    {
        return $this->hasMany(BookReview::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
