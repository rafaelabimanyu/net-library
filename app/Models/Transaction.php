<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'tgl_pinjam',
        'tgl_kembali_seharusnya',
        'tgl_pengembalian_aktual',
        'denda',
        'status',
    ];

    protected $casts = [
        'tgl_pinjam' => 'date',
        'tgl_kembali_seharusnya' => 'date',
        'tgl_pengembalian_aktual' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
