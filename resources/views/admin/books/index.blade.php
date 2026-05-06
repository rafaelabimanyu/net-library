@extends('layouts.dashboard')

@section('title', 'Repository Management')

@section('content')
<header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-16 gap-6">
    <div>
        <h2 class="text-4xl font-black tracking-tighter mb-2">Repository</h2>
        <p class="text-white/30 font-light italic">Managing the flow of physical and digital assets.</p>
    </div>
    <button class="px-8 py-4 bg-sky-blue text-dark-navy font-black rounded-2xl neon-glow hover:scale-105 transition-all uppercase tracking-widest text-[10px]">
        CATALOG NEW ASSET
    </button>
</header>

@if(session('success'))
    <div class="mb-10 p-6 glass border-emerald-500/20 bg-emerald-500/10 rounded-3xl text-emerald-400 text-sm font-bold tracking-tight">
        {{ session('success') }}
    </div>
@endif

<div class="glass rounded-[3rem] overflow-hidden">
    <table class="w-full text-left">
        <thead>
            <tr class="bg-white/5">
                <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-white/20">Asset</th>
                <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-white/20">Category</th>
                <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-white/20">Stock Status</th>
                <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-white/20">Command</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-white/5">
            @foreach($books as $book)
            <tr class="hover:bg-white/2 transition-colors">
                <td class="px-10 py-8">
                    <p class="font-black text-lg tracking-tight">{{ $book->judul }}</p>
                    <p class="text-xs text-white/30 font-light">{{ $book->penulis }}</p>
                </td>
                <td class="px-10 py-8">
                    <span class="px-3 py-1 rounded-full text-[8px] font-black uppercase tracking-widest bg-sky-blue/10 text-sky-blue border border-sky-blue/20">
                        {{ $book->kategori }}
                    </span>
                </td>
                <td class="px-10 py-8">
                    <div class="flex items-center gap-3">
                        <div class="flex-grow bg-white/5 h-1.5 w-24 rounded-full overflow-hidden">
                            <div class="h-full bg-sky-blue neon-glow" style="width: {{ ($book->stok_tersedia / $book->stok_total) * 100 }}%"></div>
                        </div>
                        <span class="text-xs font-mono text-white/40">{{ $book->stok_tersedia }}/{{ $book->stok_total }}</span>
                    </div>
                </td>
                <td class="px-10 py-8">
                    <div class="flex gap-4">
                        <button class="text-sky-blue hover:neon-text transition-all text-[10px] font-black uppercase tracking-widest">Update</button>
                        <button class="text-red-400/40 hover:text-red-400 transition-all text-[10px] font-black uppercase tracking-widest">Delete</button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
