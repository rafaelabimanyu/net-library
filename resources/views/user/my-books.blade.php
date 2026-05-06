<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Books | Net-Library Antigravity</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .glass {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
    </style>
</head>
<body class="bg-dark-navy min-h-screen text-white font-sans selection:bg-sky-blue/30">
    
    <!-- Background Decor -->
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-sky-blue/5 rounded-full blur-[120px]"></div>
    </div>

    <!-- Navigation -->
    <nav class="sticky top-0 z-50 glass border-b border-white/5 px-6 py-4">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-sky-blue rounded-lg shadow-glow flex items-center justify-center">
                    <span class="text-dark-navy font-bold text-xl">N</span>
                </div>
                <h1 class="text-xl font-bold tracking-tight">Net-Library</h1>
            </div>
            
            <div class="flex items-center gap-6">
                <a href="{{ route('catalog') }}" class="text-xs uppercase tracking-widest text-white/40 hover:text-white transition-colors">Catalog</a>
                <a href="{{ route('user.my-books') }}" class="text-xs uppercase tracking-widest text-sky-blue font-bold">My Books</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-xs uppercase tracking-widest text-white/40 hover:text-white transition-colors">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-12">
        <header class="mb-12">
            <h2 class="text-4xl font-bold mb-2">My Library</h2>
            <p class="text-white/50">Manage your current loans and borrowing history.</p>
        </header>

        <!-- Stats Row -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="glass rounded-3xl p-6">
                <p class="text-white/40 text-[10px] uppercase tracking-widest mb-2">Currently Borrowed</p>
                <h3 class="text-3xl font-bold text-sky-blue">{{ $stats['borrowed'] }} <span class="text-lg font-light text-white/20 ml-2">Books</span></h3>
            </div>
            <div class="glass rounded-3xl p-6">
                <p class="text-white/40 text-[10px] uppercase tracking-widest mb-2">Total Fines</p>
                <h3 class="text-3xl font-bold text-red-400">Rp{{ number_format($stats['total_fines'], 0, ',', '.') }}</h3>
            </div>
            <div class="glass rounded-3xl p-6">
                <p class="text-white/40 text-[10px] uppercase tracking-widest mb-2">Borrowing History</p>
                <h3 class="text-3xl font-bold text-emerald-400">{{ $stats['history'] }} <span class="text-lg font-light text-white/20 ml-2">Records</span></h3>
            </div>
        </div>

        <!-- Books List -->
        <div class="space-y-6">
            <h3 class="text-xl font-semibold mb-6">Current & Pending Loans</h3>
            @forelse($loans->whereIn('status', ['borrowed', 'pending']) as $loan)
                <div class="glass rounded-[2rem] p-8 flex flex-col md:flex-row items-center gap-8 group hover:bg-white/5 transition-all">
                    <!-- Icon/Cover -->
                    <div class="w-20 h-20 bg-white/5 rounded-2xl flex items-center justify-center text-sky-blue/30 group-hover:text-sky-blue transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>

                    <div class="flex-grow">
                        <div class="flex items-center gap-3 mb-1">
                            <h4 class="text-lg font-semibold">{{ $loan->judul }}</h4>
                            @if($loan->status === 'pending')
                                <span class="px-2 py-0.5 rounded-full text-[8px] font-bold bg-amber-500/10 text-amber-400 border border-amber-500/20 uppercase tracking-widest">Awaiting Approval</span>
                            @else
                                <span class="px-2 py-0.5 rounded-full text-[8px] font-bold bg-sky-blue/10 text-sky-blue border border-sky-blue/20 uppercase tracking-widest">In Possession</span>
                            @endif
                        </div>
                        <p class="text-white/40 text-sm font-light mb-4">{{ $loan->penulis }}</p>
                        
                        @if($loan->status === 'borrowed')
                            @php
                                $due = \Carbon\Carbon::parse($loan->tgl_kembali_seharusnya);
                                $now = now();
                                $days = $now->diffInDays($due, false);
                            @endphp
                            <div class="flex items-center gap-4">
                                <div class="flex-grow bg-white/5 h-1.5 rounded-full overflow-hidden">
                                    <div class="h-full {{ $days < 0 ? 'bg-red-500' : ($days <= 2 ? 'bg-amber-400' : 'bg-sky-blue') }}" style="width: {{ max(0, min(100, (7 - $days) / 7 * 100)) }}%"></div>
                                </div>
                                <span class="text-xs font-medium {{ $days < 0 ? 'text-red-400' : ($days <= 2 ? 'text-amber-400' : 'text-white/60') }}">
                                    @if($days < 0)
                                        Overdue by {{ abs($days) }} days!
                                    @elseif($days == 0)
                                        Due Today
                                    @else
                                        {{ $days }} Days Left
                                    @endif
                                </span>
                            </div>
                        @endif
                    </div>

                    <div class="text-right">
                        <span class="text-[10px] text-white/20 uppercase tracking-widest block mb-1">Due Date</span>
                        <span class="text-sm font-mono text-white/60">{{ \Carbon\Carbon::parse($loan->tgl_kembali_seharusnya)->format('d M Y') }}</span>
                    </div>
                </div>
            @empty
                <div class="py-12 glass rounded-[2rem] text-center">
                    <p class="text-white/20">You have no active loans or pending requests.</p>
                </div>
            @endforelse

            <h3 class="text-xl font-semibold mb-6 pt-12">Return History</h3>
            <div class="glass rounded-[2.5rem] overflow-hidden">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-white/5">
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-white/30">Book</th>
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-white/30">Returned On</th>
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-white/30">Fine Paid</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($loans->where('status', 'returned') as $history)
                        <tr class="border-b border-white/5 hover:bg-white/2 transition-colors">
                            <td class="px-8 py-6">
                                <p class="font-medium">{{ $history->judul }}</p>
                                <span class="text-[10px] text-white/20">{{ $history->penulis }}</span>
                            </td>
                            <td class="px-8 py-6 text-sm text-white/60 font-mono">
                                {{ \Carbon\Carbon::parse($history->tgl_pengembalian_aktual)->format('d M Y') }}
                            </td>
                            <td class="px-8 py-6">
                                <span class="text-sm {{ $history->denda > 0 ? 'text-red-400' : 'text-emerald-400' }}">
                                    Rp{{ number_format($history->denda, 0, ',', '.') }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>

</body>
</html>
