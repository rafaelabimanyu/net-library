<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petugas Dashboard | Net-Library Antigravity</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <style>
        .glass {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .neon-glow {
            box-shadow: 0 0 20px rgba(130, 200, 229, 0.3);
        }
        .card-hover:hover {
            transform: translateY(-8px);
            border-color: rgba(130, 200, 229, 0.4);
            box-shadow: 0 0 30px rgba(130, 200, 229, 0.15);
        }
    </style>
</head>
<body class="bg-[#0a0a0c] min-h-screen text-white font-sans selection:bg-sky-blue/30 overflow-x-hidden">
    
    <!-- Background Decor -->
    <div class="fixed inset-0 -z-10">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-sky-blue/5 rounded-full blur-[120px]"></div>
    </div>

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
                <a href="{{ route('petugas.dashboard') }}" class="flex items-center gap-4 px-6 py-4 rounded-2xl bg-sky-blue/10 text-sky-blue font-bold transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    Overview
                </a>
                <a href="{{ route('admin.transactions.index') }}" class="flex items-center gap-4 px-6 py-4 rounded-2xl text-white/40 hover:text-white hover:bg-white/5 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                    </svg>
                    Circulation
                </a>
                <a href="{{ route('catalog') }}" class="flex items-center gap-4 px-6 py-4 rounded-2xl text-white/40 hover:text-white hover:bg-white/5 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    Inventory
                </a>
            </nav>

            <form action="{{ route('logout') }}" method="POST" class="mt-auto">
                @csrf
                <button type="submit" class="w-full text-left px-6 py-4 text-white/20 hover:text-red-400 transition-colors text-xs font-bold uppercase tracking-widest">Sign Out</button>
            </form>
        </aside>

        <!-- Main Content -->
        <main class="flex-grow p-12">
            <header class="flex justify-between items-center mb-16">
                <div>
                    <h2 class="text-4xl font-black tracking-tighter mb-2">Petugas Panel</h2>
                    <p class="text-white/30 font-light">Managing the flow of knowledge with <span class="text-sky-blue font-medium">Antigravity</span>.</p>
                </div>
                <div class="flex items-center gap-4">
                    <div class="px-6 py-3 glass rounded-2xl text-xs font-bold text-white/50 border border-white/5 uppercase tracking-widest">
                        {{ now()->format('l, d M Y') }}
                    </div>
                </div>
            </header>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                <div class="glass card-hover rounded-[2.5rem] p-8 transition-all duration-500">
                    <p class="text-white/20 text-[10px] font-bold uppercase tracking-widest mb-6">Daily Loans</p>
                    <div class="flex items-end justify-between">
                        <h3 class="text-5xl font-black">{{ $loansToday }}</h3>
                        <div class="p-4 bg-sky-blue/10 rounded-2xl text-sky-blue neon-glow">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="glass card-hover rounded-[2.5rem] p-8 transition-all duration-500">
                    <p class="text-white/20 text-[10px] font-bold uppercase tracking-widest mb-6">Active Members</p>
                    <div class="flex items-end justify-between">
                        <h3 class="text-5xl font-black">{{ $totalMembers }}</h3>
                        <div class="p-4 bg-emerald-500/10 rounded-2xl text-emerald-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="glass card-hover rounded-[2.5rem] p-8 transition-all duration-500">
                    <p class="text-white/20 text-[10px] font-bold uppercase tracking-widest mb-6">Total Books</p>
                    <div class="flex items-end justify-between">
                        <h3 class="text-5xl font-black">{{ $totalBooks }}</h3>
                        <div class="p-4 bg-amber-500/10 rounded-2xl text-amber-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Requests -->
            <div class="glass rounded-[3rem] p-10">
                <div class="flex items-center justify-between mb-10">
                    <h4 class="text-xl font-bold tracking-tight">Pending Borrow Requests</h4>
                    <a href="{{ route('admin.transactions.index') }}" class="text-xs font-bold text-sky-blue hover:brightness-110 transition-all uppercase tracking-widest">View All</a>
                </div>
                
                <div class="space-y-6">
                    @forelse($recentTransactions->where('status', 'pending') as $tx)
                    <div class="flex items-center justify-between p-6 glass rounded-2xl hover:bg-white/5 transition-all">
                        <div class="flex items-center gap-6">
                            <div class="w-12 h-12 bg-white/5 rounded-xl flex items-center justify-center text-sky-blue/30">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-white/90">{{ $tx->user_name }}</p>
                                <p class="text-xs text-white/30 font-light">{{ $tx->book_title }}</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <form action="{{ route('admin.transactions.update', $tx->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="borrowed">
                                <button class="px-6 py-2.5 bg-sky-blue text-dark-navy text-[10px] font-black rounded-xl neon-glow hover:scale-105 transition-all uppercase tracking-widest">Approve</button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="py-10 text-center text-white/20 font-light italic">No pending requests at the moment.</div>
                    @endforelse
                </div>
            </div>
        </main>
    </div>

</body>
</html>
