<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Administrator',
            'email' => 'admin@netlib.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'admin',
        ]);

        \App\Models\User::create([
            'name' => 'Petugas Perpustakaan',
            'email' => 'petugas@netlib.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'petugas',
        ]);

        \App\Models\User::create([
            'name' => 'Pengunjung Member',
            'email' => 'user@netlib.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'pengunjung',
        ]);
    }
}
