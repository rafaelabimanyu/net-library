<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Circulation | Net-Library Antigravity</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <style>
        .glass {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .neon-glow {
            box-shadow: 0 0 20px rgba(130, 200, 229, 0.3);
        }
    </style>
</head>
<body class="bg-[#0a0a0c] min-h-screen text-white font-sans selection:bg-sky-blue/30 overflow-x-hidden">
    
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-72 min-h-screen glass border-r border-white/5 p-8 flex flex-col sticky top-0">
            <div class="flex items-center gap-3 mb-16">
                <div class="w-10 h-10 bg-sky-blue rounded-xl neon-glow flex items-center justify-center">
                    <span class="text-dark-navy font-black text-xl">N</span>
                </div>
                <h1 class="text-xl font-black tracking-tighter">NET-LIBRARY</h1>
            </div>

            <nav class="space-y-3 flex-grow">
                <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('petugas.dashboard') }}" class="flex items-center gap-4 px-6 py-4 rounded-2xl text-white/40 hover:text-white hover:bg-white/5 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    Overview
                </a>
                <a href="{{ route('admin.transactions.index') }}" class="flex items-center gap-4 px-6 py-4 rounded-2xl bg-sky-blue/10 text-sky-blue font-bold transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                    </svg>
                    Circulation
                </a>
                <a href="{{ route('catalog') }}" class="flex items-center gap-4 px-6 py-4 rounded-2xl text-white/40 hover:text-white hover:bg-white/5 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    Repository
                </a>
            </nav>

            <form action="{{ route('logout') }}" method="POST" class="mt-auto">
                @csrf
                <button type="submit" class="w-full text-left px-6 py-4 text-white/20 hover:text-red-400 transition-colors text-xs font-bold uppercase tracking-widest">Sign Out</button>
            </form>
        </aside>

        <main class="flex-grow p-12">
            <header class="flex justify-between items-center mb-16">
                <div>
                    <h2 class="text-4xl font-black tracking-tighter mb-2">Circulation</h2>
                    <p class="text-white/30 font-light">Validation and oversight of asset streams.</p>
                </div>
                <a href="{{ route('admin.export') }}" target="_blank" class="px-8 py-4 glass rounded-2xl text-sky-blue font-bold text-[10px] uppercase tracking-[0.3em] hover:bg-sky-blue/10 transition-all flex items-center gap-3">
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
        </main>
    </div>

</body>
</html>
