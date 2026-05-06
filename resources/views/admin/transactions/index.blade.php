@extends('layouts.dashboard')

@section('title', 'Circulation Control')

@section('content')
<header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-16 gap-6">
    <div>
        <h2 class="text-4xl font-black tracking-tighter mb-2">Circulation</h2>
        <p class="text-white/30 font-light italic">Validation and oversight of asset streams.</p>
    </div>
    <a href="{{ route('admin.export') }}" target="_blank" class="px-8 py-4 glass rounded-2xl text-sky-blue font-black text-[10px] uppercase tracking-[0.3em] hover:bg-sky-blue/10 transition-all flex items-center gap-3">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 00-2 2h2m2 4h10a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
        </svg>
        Generate Report
    </a>
</header>

@if(session('success'))
    <div class="mb-10 p-6 glass border-emerald-500/20 bg-emerald-500/10 rounded-3xl text-emerald-400 text-sm font-bold tracking-tight">
        {{ session('success') }}
    </div>
@endif

<div class="glass rounded-[3rem] overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-white/5">
                    <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-white/20">Recipient</th>
                    <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-white/20">Resource</th>
                    <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-white/20">Status</th>
                    <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-white/20">Sync Date</th>
                    <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-white/20">Command</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @foreach($transactions as $tx)
                <tr class="hover:bg-white/2 transition-colors">
                    <td class="px-10 py-8">
                        <p class="font-black text-lg tracking-tight">{{ $tx->user_name }}</p>
                    </td>
                    <td class="px-10 py-8">
                        <p class="text-white/40 text-sm font-light italic">{{ $tx->book_title }}</p>
                    </td>
                    <td class="px-10 py-8">
                        @if($tx->status === 'pending')
                            <span class="px-3 py-1 rounded-full text-[8px] font-black uppercase tracking-widest bg-amber-500/10 text-amber-400 border border-amber-500/20">Awaiting</span>
                        @elseif($tx->status === 'borrowed')
                            <span class="px-3 py-1 rounded-full text-[8px] font-black uppercase tracking-widest bg-sky-blue/10 text-sky-blue border border-sky-blue/20">Streaming</span>
                        @elseif($tx->status === 'returned')
                            <span class="px-3 py-1 rounded-full text-[8px] font-black uppercase tracking-widest bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">Archived</span>
                        @endif
                    </td>
                    <td class="px-10 py-8 font-mono text-xs text-white/20 tracking-widest">
                        {{ \Carbon\Carbon::parse($tx->tgl_kembali_seharusnya)->format('d.m.Y') }}
                    </td>
                    <td class="px-10 py-8">
                        <div class="flex gap-4">
                            @if($tx->status === 'pending')
                                <form action="{{ route('admin.transactions.update', $tx->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="borrowed">
                                    <button class="px-6 py-2.5 bg-sky-blue text-dark-navy text-[10px] font-black rounded-xl neon-glow hover:scale-105 transition-all uppercase tracking-widest">Approve</button>
                                </form>
                            @elseif($tx->status === 'borrowed')
                                <form action="{{ route('admin.transactions.update', $tx->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="returned">
                                    <button class="px-6 py-2.5 glass text-emerald-400 border-emerald-500/20 text-[10px] font-black rounded-xl hover:bg-emerald-500/10 transition-all uppercase tracking-widest">Archive</button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
