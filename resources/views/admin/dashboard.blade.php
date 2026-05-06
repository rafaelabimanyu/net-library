<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Net-Library Antigravity</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .glass {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        .stat-card:hover {
            border-color: rgba(130, 200, 229, 0.3);
            box-shadow: 0 0 20px rgba(130, 200, 229, 0.1);
        }
    </style>
</head>
<body class="bg-dark-navy min-h-screen text-white font-sans selection:bg-sky-blue/30">
    
    <!-- Background Decor -->
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="absolute top-0 left-0 w-[600px] h-[600px] bg-sky-blue/5 rounded-full blur-[150px]"></div>
    </div>

    <!-- Layout Wrapper -->
    <div class="flex">
        <!-- Sidebar Placeholder (Simple for now) -->
        <aside class="w-64 min-h-screen glass border-r border-white/5 p-6 flex flex-col">
            <div class="flex items-center gap-2 mb-12">
                <div class="w-8 h-8 bg-sky-blue rounded-lg shadow-glow flex items-center justify-center">
                    <span class="text-dark-navy font-bold">N</span>
                </div>
                <h1 class="text-lg font-bold tracking-tight">Net-Library</h1>
            </div>

            <nav class="space-y-2 flex-grow">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-sky-blue/10 text-sky-blue font-medium transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.transactions.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-white/40 hover:text-white hover:bg-white/5 transition-all">
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

            <form action="{{ route('logout') }}" method="POST" class="mt-auto">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-3 text-white/20 hover:text-red-400 transition-colors text-sm uppercase tracking-widest font-semibold">Logout</button>
            </form>
        </aside>

        <!-- Main Content -->
        <main class="flex-grow p-10">
            <header class="flex justify-between items-center mb-12">
                <div>
                    <h2 class="text-3xl font-bold tracking-tight">System Overview</h2>
                    <p class="text-white/40 text-sm">Welcome back, Commander <span class="text-sky-blue font-medium">{{ auth()->user()->name }}</span>.</p>
                </div>
                <div class="flex items-center gap-4">
                    <div class="px-4 py-2 glass rounded-xl text-xs font-mono text-white/40 border border-white/5">
                        {{ now()->format('D, d M Y') }}
                    </div>
                </div>
            </header>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <div class="glass stat-card rounded-3xl p-6 transition-all duration-300">
                    <p class="text-white/40 text-xs uppercase tracking-widest mb-4">Total Assets</p>
                    <div class="flex items-end justify-between">
                        <h3 class="text-4xl font-bold">{{ $totalBooks }}</h3>
                        <div class="p-2 bg-sky-blue/10 rounded-lg text-sky-blue">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="glass stat-card rounded-3xl p-6 transition-all duration-300">
                    <p class="text-white/40 text-xs uppercase tracking-widest mb-4">Active Members</p>
                    <div class="flex items-end justify-between">
                        <h3 class="text-4xl font-bold">{{ $totalMembers }}</h3>
                        <div class="p-2 bg-emerald-500/10 rounded-lg text-emerald-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="glass stat-card rounded-3xl p-6 transition-all duration-300">
                    <p class="text-white/40 text-xs uppercase tracking-widest mb-4">Loans Today</p>
                    <div class="flex items-end justify-between">
                        <h3 class="text-4xl font-bold">{{ $loansToday }}</h3>
                        <div class="p-2 bg-amber-500/10 rounded-lg text-amber-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="glass stat-card rounded-3xl p-6 transition-all duration-300">
                    <p class="text-white/40 text-xs uppercase tracking-widest mb-4">Total Fines</p>
                    <div class="flex items-end justify-between">
                        <h3 class="text-4xl font-bold">Rp{{ number_format($totalFines, 0, ',', '.') }}</h3>
                        <div class="p-2 bg-red-500/10 rounded-lg text-red-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts & Recent Activity -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Chart -->
                <div class="lg:col-span-2 glass rounded-[2.5rem] p-8">
                    <div class="flex items-center justify-between mb-8">
                        <h4 class="font-semibold text-lg">Circulation Activity</h4>
                        <div class="flex gap-2">
                            <span class="px-3 py-1 rounded-full bg-sky-blue/10 text-sky-blue text-[10px] font-bold uppercase tracking-wider">Weekly View</span>
                        </div>
                    </div>
                    <div class="h-64">
                        <canvas id="circulationChart"></canvas>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="glass rounded-[2.5rem] p-8">
                    <h4 class="font-semibold text-lg mb-8">Recent Activity</h4>
                    <div class="space-y-6">
                        @foreach($recentTransactions as $tx)
                        <div class="flex items-start gap-4">
                            <div class="w-2 h-2 rounded-full mt-2 {{ $tx->status === 'pending' ? 'bg-amber-400' : ($tx->status === 'borrowed' ? 'bg-sky-blue' : 'bg-emerald-400') }}"></div>
                            <div>
                                <p class="text-sm text-white/80 font-medium line-clamp-1">{{ $tx->user_name }} requested {{ $tx->book_title }}</p>
                                <span class="text-[10px] text-white/20 uppercase tracking-wider">{{ \Carbon\Carbon::parse($tx->created_at)->diffForHumans() }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        const ctx = document.getElementById('circulationChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Loans',
                    data: [12, 19, 3, 5, 2, 3, 9],
                    borderColor: '#82c8e5',
                    backgroundColor: 'rgba(130, 200, 229, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(255, 255, 255, 0.05)' },
                        ticks: { color: 'rgba(255, 255, 255, 0.3)' }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: 'rgba(255, 255, 255, 0.3)' }
                    }
                }
            }
        });
    </script>
</body>
</html>
