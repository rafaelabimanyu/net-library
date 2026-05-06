@extends('layouts.app')

@section('title', 'My Repository | Net-Library Antigravity')

@section('content')
    <main class="max-w-7xl mx-auto px-10 py-10">
        <header class="mb-20">
            <h2 class="text-5xl font-black tracking-tighter mb-4 text-dark-navy dark:text-white transition-colors duration-300">My Assets</h2>
            <p class="text-gray-400 dark:text-white/30 font-light text-lg">Detailed overview of your current loans and historical engagement.</p>
        </header>

        <!-- Stats Row -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-20">
            <div class="bg-white/40 dark:bg-white/5 backdrop-blur-md border border-sky-blue/10 dark:border-white/5 rounded-[2.5rem] p-10">
                <p class="text-gray-400 dark:text-white/20 text-[10px] font-black uppercase tracking-[0.3em] mb-4">In Possession</p>
                <h3 class="text-5xl font-black text-sky-blue">{{ $stats['borrowed'] }} <span class="text-sm font-light text-gray-400 dark:text-white/20 ml-2 tracking-widest uppercase">Books</span></h3>
            </div>
            <div class="bg-white/40 dark:bg-white/5 backdrop-blur-md border border-sky-blue/10 dark:border-white/5 rounded-[2.5rem] p-10">
                <p class="text-gray-400 dark:text-white/20 text-[10px] font-black uppercase tracking-[0.3em] mb-4">Account Fines</p>
                <h3 class="text-4xl font-black text-red-500">Rp{{ number_format($stats['total_fines'], 0, ',', '.') }}</h3>
            </div>
            <div class="bg-white/40 dark:bg-white/5 backdrop-blur-md border border-sky-blue/10 dark:border-white/5 rounded-[2.5rem] p-10">
                <p class="text-gray-400 dark:text-white/20 text-[10px] font-black uppercase tracking-[0.3em] mb-4">Engagement History</p>
                <h3 class="text-5xl font-black text-emerald-500 dark:text-emerald-400">{{ $stats['history'] }} <span class="text-sm font-light text-gray-400 dark:text-white/20 ml-2 tracking-widest uppercase">Records</span></h3>
            </div>
        </div>

        <!-- Books List -->
        <div class="space-y-10">
            <h3 class="text-2xl font-black tracking-tighter mb-10 text-dark-navy dark:text-white">Active & Pending Streams</h3>
            @forelse($loans->whereIn('status', ['borrowed', 'pending']) as $loan)
                <div class="bg-white/40 dark:bg-white/5 backdrop-blur-md border border-sky-blue/10 dark:border-white/5 rounded-[3rem] p-10 flex flex-col lg:flex-row items-center gap-10 group hover:bg-sky-blue/10 dark:hover:bg-white/5 transition-all duration-500">
                    <!-- Icon/Cover -->
                    <div class="w-24 h-24 bg-gray-100 dark:bg-white/5 rounded-[2rem] flex items-center justify-center text-sky-blue/20 group-hover:text-sky-blue/40 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>

                    <div class="flex-grow">
                        <div class="flex items-center gap-4 mb-3">
                            <h4 class="text-2xl font-black tracking-tight text-dark-navy dark:text-white transition-colors">{{ $loan->judul }}</h4>
                            @if($loan->status === 'pending')
                                <span class="px-3 py-1 rounded-full text-[8px] font-black bg-amber-500/10 text-amber-500 border border-amber-500/20 uppercase tracking-[0.2em]">Pending Approval</span>
                            @else
                                <span class="px-3 py-1 rounded-full text-[8px] font-black bg-sky-blue/10 text-sky-blue border border-sky-blue/20 uppercase tracking-[0.2em]">Active Stream</span>
                            @endif
                        </div>
                        <p class="text-gray-400 dark:text-white/20 text-sm font-light italic mb-6">{{ $loan->penulis }}</p>
                        
                        @if($loan->status === 'borrowed')
                            @php
                                $due = \Carbon\Carbon::parse($loan->tgl_kembali_seharusnya);
                                $now = now();
                                $days = $now->diffInDays($due, false);
                            @endphp
                            <div class="flex items-center gap-6">
                                <div class="flex-grow bg-gray-100 dark:bg-white/5 h-2 rounded-full overflow-hidden">
                                    <div class="h-full {{ $days < 0 ? 'bg-red-500' : ($days <= 2 ? 'bg-amber-400' : 'bg-sky-blue') }} shadow-glow" style="width: {{ max(0, min(100, (7 - $days) / 7 * 100)) }}%"></div>
                                </div>
                                <span class="text-xs font-black uppercase tracking-widest {{ $days < 0 ? 'text-red-500' : ($days <= 2 ? 'text-amber-500' : 'text-gray-400 dark:text-white/30') }}">
                                    @if($days < 0)
                                        Overdue {{ abs($days) }}D
                                    @elseif($days == 0)
                                        Final Day
                                    @else
                                        {{ $days }}D Remaining
                                    @endif
                                </span>
                            </div>
                        @endif
                    </div>

                    <div class="text-right">
                        <span class="text-[10px] text-gray-300 dark:text-white/10 uppercase font-black tracking-[0.3em] block mb-2">Return Sync</span>
                        <span class="text-lg font-black text-gray-400 dark:text-white/40 tracking-tighter">{{ \Carbon\Carbon::parse($loan->tgl_kembali_seharusnya)->format('d.m.Y') }}</span>
                    </div>
                </div>
            @empty
                <div class="py-20 bg-white/40 dark:bg-white/5 backdrop-blur-md border border-sky-blue/20 dark:border-white/10 rounded-[3rem] text-center">
                    <p class="text-gray-400 dark:text-white/10 text-xs font-black uppercase tracking-[0.5em]">No active asset streams detected.</p>
                </div>
            @endforelse

            <h3 class="text-2xl font-black tracking-tighter mb-10 pt-20 text-dark-navy dark:text-white">Archive Logs</h3>
            <div class="bg-white/40 dark:bg-white/5 backdrop-blur-md border border-sky-blue/20 dark:border-white/10 rounded-[3rem] overflow-hidden">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-100/50 dark:bg-white/5">
                            <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-gray-400 dark:text-white/20">Resource</th>
                            <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-gray-400 dark:text-white/20">Closed On</th>
                            <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-gray-400 dark:text-white/20">Adjustment</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                        @foreach($loans->where('status', 'returned') as $history)
                        <tr class="hover:bg-gray-50 dark:hover:bg-white/2 transition-colors">
                            <td class="px-10 py-8">
                                <p class="font-black text-lg tracking-tight text-dark-navy dark:text-white">{{ $history->judul }}</p>
                                <span class="text-[10px] text-gray-400 dark:text-white/20 italic">{{ $history->penulis }}</span>
                            </td>
                            <td class="px-10 py-8 text-sm text-gray-400 dark:text-white/40 font-mono">
                                {{ \Carbon\Carbon::parse($history->tgl_pengembalian_aktual)->format('d.m.Y') }}
                            </td>
                            <td class="px-10 py-8">
                                <span class="text-sm font-black {{ $history->denda > 0 ? 'text-red-500' : 'text-emerald-500 dark:text-emerald-400' }}">
                                    @if($history->denda > 0)
                                        +Rp{{ number_format($history->denda, 0, ',', '.') }}
                                    @else
                                        SUCCESS
                                    @endif
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
