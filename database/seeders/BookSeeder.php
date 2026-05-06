<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'judul' => 'Clean Code: A Handbook of Agile Software Craftsmanship',
                'slug' => 'clean-code',
                'penulis' => 'Robert C. Martin',
                'kategori' => 'Programming',
                'stok_total' => 5,
                'stok_tersedia' => 5,
                'rak_lokasi' => 'A1',
            ],
            [
                'judul' => 'The Pragmatic Programmer',
                'slug' => 'the-pragmatic-programmer',
                'penulis' => 'Andrew Hunt & David Thomas',
                'kategori' => 'Programming',
                'stok_total' => 3,
                'stok_tersedia' => 2,
                'rak_lokasi' => 'A1',
            ],
            [
                'judul' => 'Design Patterns: Elements of Reusable Object-Oriented Software',
                'slug' => 'design-patterns',
                'penulis' => 'Erich Gamma, et al.',
                'kategori' => 'Programming',
                'stok_total' => 4,
                'stok_tersedia' => 4,
                'rak_lokasi' => 'A2',
            ],
            [
                'judul' => 'Sapiens: A Brief History of Humankind',
                'slug' => 'sapiens',
                'penulis' => 'Yuval Noah Harari',
                'kategori' => 'History',
                'stok_total' => 10,
                'stok_tersedia' => 8,
                'rak_lokasi' => 'B1',
            ],
            [
                'judul' => 'Atomic Habits',
                'slug' => 'atomic-habits',
                'penulis' => 'James Clear',
                'kategori' => 'Self-Help',
                'stok_total' => 15,
                'stok_tersedia' => 12,
                'rak_lokasi' => 'C1',
            ],
            [
                'judul' => 'The Psychology of Money',
                'slug' => 'psychology-of-money',
                'penulis' => 'Morgan Housel',
                'kategori' => 'Finance',
                'stok_total' => 7,
                'stok_tersedia' => 0,
                'rak_lokasi' => 'C2',
            ],
            [
                'judul' => 'Astrophysics for People in a Hurry',
                'slug' => 'astrophysics-hurry',
                'penulis' => 'Neil deGrasse Tyson',
                'kategori' => 'Science',
                'stok_total' => 5,
                'stok_tersedia' => 5,
                'rak_lokasi' => 'D1',
            ],
            [
                'judul' => 'Thinking, Fast and Slow',
                'slug' => 'thinking-fast-slow',
                'penulis' => 'Daniel Kahneman',
                'kategori' => 'Psychology',
                'stok_total' => 8,
                'stok_tersedia' => 6,
                'rak_lokasi' => 'C1',
            ],
            [
                'judul' => 'The Great Gatsby',
                'slug' => 'great-gatsby',
                'penulis' => 'F. Scott Fitzgerald',
                'kategori' => 'Fiction',
                'stok_total' => 4,
                'stok_tersedia' => 4,
                'rak_lokasi' => 'E1',
            ],
            [
                'judul' => 'The Alchemist',
                'slug' => 'the-alchemist',
                'penulis' => 'Paulo Coelho',
                'kategori' => 'Fiction',
                'stok_total' => 6,
                'stok_tersedia' => 3,
                'rak_lokasi' => 'E2',
            ],
        ];

        foreach ($books as $book) {
            \App\Models\User::first(); // Just to make sure DB is connected
            \DB::table('books')->insert(array_merge($book, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
