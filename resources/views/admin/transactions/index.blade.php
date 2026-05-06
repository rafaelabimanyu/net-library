<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Transactions | Net-Library Antigravity</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .glass {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        tr { border-bottom: 1px solid rgba(255, 255, 255, 0.03); transition: all 0.3s; }
        tr:hover { background: rgba(255, 255, 255, 0.02); }
    </style>
</head>
<body class="bg-dark-navy min-h-screen text-white font-sans selection:bg-sky-blue/30">
    
    <div class="flex">
        <!-- Sidebar (Reuse logic or keep simple) -->
        <aside class="w-64 min-h-screen glass border-r border-white/5 p-6 flex flex-col">
            <div class="flex items-center gap-2 mb-12">
                <div class="w-8 h-8 bg-sky-blue rounded-lg shadow-glow flex items-center justify-center">
                    <span class="text-dark-navy font-bold">N</span>
                </div>
                <h1 class="text-lg font-bold tracking-tight">Net-Library</h1>
            </div>

            <nav class="space-y-2 flex-grow">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-white/40 hover:text-white hover:bg-white/5 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.transactions.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-sky-blue/10 text-sky-blue font-medium transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                    </svg>
                    Transactions
                </a>
                <a href="{{ route('catalog') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-white/40 hover:text-white hover:bg-white/5 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    Catalog
                </a>
            </nav>
        </aside>

        <main class="flex-grow p-10">
            <header class="flex justify-between items-center mb-12">
                <div>
                    <h2 class="text-3xl font-bold tracking-tight">Circulation Management</h2>
                    <p class="text-white/40 text-sm">Validate and manage book loans.</p>
                </div>
            </header>

            @if(session('success'))
                <div class="mb-8 p-4 glass border-emerald-500/30 bg-emerald-500/10 rounded-2xl text-emerald-400 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="glass rounded-[2.5rem] overflow-hidden">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-white/5">
                            <th class="px-6 py-5 text-xs font-bold uppercase tracking-widest text-sky-blue/60">Borrower</th>
                            <th class="px-6 py-5 text-xs font-bold uppercase tracking-widest text-sky-blue/60">Book Title</th>
                            <th class="px-6 py-5 text-xs font-bold uppercase tracking-widest text-sky-blue/60">Status</th>
                            <th class="px-6 py-5 text-xs font-bold uppercase tracking-widest text-sky-blue/60">Date Due</th>
                            <th class="px-6 py-5 text-xs font-bold uppercase tracking-widest text-sky-blue/60">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $tx)
                        <tr>
                            <td class="px-6 py-6">
                                <p class="font-medium">{{ $tx->user_name }}</p>
                            </td>
                            <td class="px-6 py-6">
                                <p class="text-white/60 text-sm">{{ $tx->book_title }}</p>
                            </td>
                            <td class="px-6 py-6">
                                @if($tx->status === 'pending')
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-tighter bg-amber-500/10 text-amber-400 border border-amber-500/20">Pending</span>
                                @elseif($tx->status === 'borrowed')
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-tighter bg-sky-blue/10 text-sky-blue border border-sky-blue/20">Borrowed</span>
                                @elseif($tx->status === 'returned')
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-tighter bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">Returned</span>
                                @endif
                            </td>
                            <td class="px-6 py-6 font-mono text-xs text-white/40">
                                {{ \Carbon\Carbon::parse($tx->tgl_kembali_seharusnya)->format('d M Y') }}
                            </td>
                            <td class="px-6 py-6">
                                <div class="flex gap-2">
                                    @if($tx->status === 'pending')
                                        <form action="{{ route('admin.transactions.update', $tx->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="borrowed">
                                            <button class="px-4 py-2 bg-sky-blue text-dark-navy text-xs font-bold rounded-lg hover:brightness-110 transition-all">APPROVE</button>
                                        </form>
                                    @elseif($tx->status === 'borrowed')
                                        <form action="{{ route('admin.transactions.update', $tx->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="returned">
                                            <button class="px-4 py-2 glass text-emerald-400 border-emerald-500/30 text-xs font-bold rounded-lg hover:bg-emerald-500/10 transition-all">MARK AS RETURNED</button>
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
