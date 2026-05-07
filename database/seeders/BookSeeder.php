<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookSeeder extends Seeder
{
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
                'synopsis' => 'Even bad code can function. But if code isn\'t clean, it can bring a development organization to its knees. Every year, countless hours and significant resources are lost because of poorly written code.',
                'cover_image' => 'https://images.unsplash.com/photo-1515879218367-8466d910aaa4?auto=format&fit=crop&q=80&w=400',
            ],
            [
                'judul' => 'The Pragmatic Programmer',
                'slug' => 'the-pragmatic-programmer',
                'penulis' => 'Andrew Hunt & David Thomas',
                'kategori' => 'Programming',
                'stok_total' => 3,
                'stok_tersedia' => 2,
                'rak_lokasi' => 'A1',
                'synopsis' => 'The Pragmatic Programmer is one of those rare tech books you’ll read, re-read, and read again over the years. Whether you’re new to the field or an experienced practitioner, you’ll come away with fresh insights each and every time.',
                'cover_image' => 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?auto=format&fit=crop&q=80&w=400',
            ],
            [
                'judul' => 'Design Patterns',
                'slug' => 'design-patterns',
                'penulis' => 'Erich Gamma, et al.',
                'kategori' => 'Programming',
                'stok_total' => 4,
                'stok_tersedia' => 4,
                'rak_lokasi' => 'A2',
                'synopsis' => 'Design Patterns: Elements of Reusable Object-Oriented Software is a software engineering book describing software design patterns.',
                'cover_image' => 'https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&q=80&w=400',
            ],
            [
                'judul' => 'Sapiens: A Brief History of Humankind',
                'slug' => 'sapiens',
                'penulis' => 'Yuval Noah Harari',
                'kategori' => 'History',
                'stok_total' => 10,
                'stok_tersedia' => 8,
                'rak_lokasi' => 'B1',
                'synopsis' => 'From a renowned historian comes a groundbreaking narrative of humanity’s creation and evolution—a #1 international bestseller—that explores the ways in which biology and history have defined us and enhanced our understanding of what it means to be “human.”',
                'cover_image' => 'https://images.unsplash.com/photo-1447069387593-a5de0862481e?auto=format&fit=crop&q=80&w=400',
            ],
            [
                'judul' => 'Atomic Habits',
                'slug' => 'atomic-habits',
                'penulis' => 'James Clear',
                'kategori' => 'Self-Help',
                'stok_total' => 15,
                'stok_tersedia' => 12,
                'rak_lokasi' => 'C1',
                'synopsis' => 'No matter your goals, Atomic Habits offers a proven framework for improving—every day. James Clear, one of the world\'s leading experts on habit formation, reveals practical strategies that will teach you exactly how to form good habits, break bad ones, and master the tiny behaviors that lead to remarkable results.',
                'cover_image' => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?auto=format&fit=crop&q=80&w=400',
            ],
            [
                'judul' => 'The Psychology of Money',
                'slug' => 'psychology-of-money',
                'penulis' => 'Morgan Housel',
                'kategori' => 'Finance',
                'stok_total' => 7,
                'stok_tersedia' => 0,
                'rak_lokasi' => 'C2',
                'synopsis' => 'Doing well with money isn’t necessarily about what you know. It’s about how you behave. And behavior is hard to teach, even to really smart people.',
                'cover_image' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&q=80&w=400',
            ],
            [
                'judul' => 'Astrophysics for People in a Hurry',
                'slug' => 'astrophysics-hurry',
                'penulis' => 'Neil deGrasse Tyson',
                'kategori' => 'Science',
                'stok_total' => 5,
                'stok_tersedia' => 5,
                'rak_lokasi' => 'D1',
                'synopsis' => 'What is the nature of space and time? How do we fit within the universe? How does the universe fit within us? There’s no better guide through these mind-expanding questions than acclaimed astrophysicist and best-selling author Neil deGrasse Tyson.',
                'cover_image' => 'https://images.unsplash.com/photo-1446776811953-b23d57bd21aa?auto=format&fit=crop&q=80&w=400',
            ],
            [
                'judul' => 'Thinking, Fast and Slow',
                'slug' => 'thinking-fast-slow',
                'penulis' => 'Daniel Kahneman',
                'kategori' => 'Psychology',
                'stok_total' => 8,
                'stok_tersedia' => 6,
                'rak_lokasi' => 'C1',
                'synopsis' => 'In his mega-bestseller, Thinking, Fast and Slow, Daniel Kahneman, the renowned psychologist and winner of the Nobel Prize in Economics, takes us on a groundbreaking tour of the mind and explains the two systems that drive the way we think.',
                'cover_image' => 'https://images.unsplash.com/photo-1507413245164-6160d8298b31?auto=format&fit=crop&q=80&w=400',
            ],
            [
                'judul' => 'The Great Gatsby',
                'slug' => 'great-gatsby',
                'penulis' => 'F. Scott Fitzgerald',
                'kategori' => 'Fiction',
                'stok_total' => 4,
                'stok_tersedia' => 4,
                'rak_lokasi' => 'E1',
                'synopsis' => 'The Great Gatsby is a 1925 novel by American writer F. Scott Fitzgerald. Set in the Jazz Age on Long Island, near New York City, the novel depicts first-person narrator Nick Carraway\'s interactions with mysterious millionaire Jay Gatsby and Gatsby\'s obsession to reunite with his former lover, Daisy Buchanan.',
                'cover_image' => 'https://images.unsplash.com/photo-1543004221-1f12796bb3d0?auto=format&fit=crop&q=80&w=400',
            ],
            [
                'judul' => 'The Alchemist',
                'slug' => 'the-alchemist',
                'penulis' => 'Paulo Coelho',
                'kategori' => 'Fiction',
                'stok_total' => 6,
                'stok_tersedia' => 3,
                'rak_lokasi' => 'E2',
                'synopsis' => 'The Alchemist is a novel by Brazilian author Paulo Coelho that was first published in 1988. Originally written in Portuguese, it became a widely translated international bestseller.',
                'cover_image' => 'https://images.unsplash.com/photo-1512820790803-83ca734da794?auto=format&fit=crop&q=80&w=400',
            ],
        ];

        DB::table('books')->truncate();

        foreach ($books as $book) {
            DB::table('books')->insert(array_merge($book, [
                'isbn' => Str::random(13),
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
