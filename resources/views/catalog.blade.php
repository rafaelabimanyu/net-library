<!DOCTYPE html>
<html lang="en" x-data="{ search: '', category: 'All' }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalog | Net-Library Antigravity</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .animate-float {
            animation: float 4s ease-in-out infinite;
        }
        .glass {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        .glass-card:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(130, 200, 229, 0.3);
            transform: translateY(-8px);
            box-shadow: 0 0 30px rgba(130, 200, 229, 0.15);
        }
    </style>
</head>
<body class="bg-dark-navy min-h-screen text-white font-sans selection:bg-sky-blue/30">
    
    <!-- Background Decor -->
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-sky-blue/10 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-sky-blue/5 rounded-full blur-[100px]"></div>
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
                <span class="text-white/60 text-sm hidden md:block">Welcome, <span class="text-sky-blue font-medium">{{ auth()->user()->name }}</span></span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-xs uppercase tracking-widest text-white/40 hover:text-white transition-colors">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-12">
        <!-- Header & Search -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-16">
            <div>
                <h2 class="text-4xl font-bold mb-2">Book Catalog</h2>
                <p class="text-white/50">Explore our futuristic collection of digital and physical assets.</p>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto">
                <!-- Search Bar -->
                <div class="relative group">
                    <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-white/30 group-focus-within:text-sky-blue transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" x-model="search" placeholder="Search title or author..." 
                        class="w-full sm:w-80 bg-white/5 border border-white/10 rounded-2xl pl-12 pr-4 py-3.5 focus:outline-none focus:ring-2 focus:ring-sky-blue/50 focus:border-sky-blue/50 transition-all placeholder:text-white/20">
                </div>

                <!-- Category Filter -->
                <select x-model="category" class="bg-white/5 border border-white/10 rounded-2xl px-4 py-3.5 focus:outline-none focus:ring-2 focus:ring-sky-blue/50 text-white/70 appearance-none cursor-pointer min-w-[140px]">
                    <option value="All">All Categories</option>
                    @foreach($books->pluck('kategori')->unique() as $cat)
                        <option value="{{ $cat }}">{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Book Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($books as $book)
            <div x-show="(category === 'All' || '{{ $book->kategori }}' === category) && ('{{ strtolower($book->judul) }}'.includes(search.toLowerCase()) || '{{ strtolower($book->penulis) }}'.includes(search.toLowerCase()))"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 class="glass-card glass rounded-[2rem] p-6 transition-all duration-500 group flex flex-col h-full">
                
                <!-- Book Cover Placeholder -->
                <div class="aspect-[3/4] rounded-2xl bg-white/5 mb-6 overflow-hidden relative group-hover:shadow-glow transition-all duration-500">
                    <div class="absolute inset-0 flex items-center justify-center text-white/10 group-hover:text-sky-blue/20 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    
                    <!-- Availability Badge -->
                    <div class="absolute top-4 right-4">
                        @if($book->stok_tersedia > 0)
                            <span class="px-3 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-widest bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 backdrop-blur-md">Available</span>
                        @else
                            <span class="px-3 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-widest bg-red-500/10 text-red-400 border border-red-500/20 backdrop-blur-md">Borrowed</span>
                        @endif
                    </div>
                </div>

                <div class="flex-grow">
                    <span class="text-sky-blue/60 text-[10px] font-bold uppercase tracking-widest mb-2 block">{{ $book->kategori }}</span>
                    <h3 class="text-lg font-semibold mb-1 line-clamp-2 group-hover:text-sky-blue transition-colors">{{ $book->judul }}</h3>
                    <p class="text-white/40 text-sm font-light mb-4">{{ $book->penulis }}</p>
                </div>

                <div class="mt-auto pt-6 border-t border-white/5 flex items-center justify-between">
                    <div class="flex flex-col">
                        <span class="text-white/20 text-[10px] uppercase tracking-tighter">Location</span>
                        <span class="text-xs font-mono text-white/60">{{ $book->rak_lokasi }}</span>
                    </div>
                    <button class="bg-white/5 hover:bg-sky-blue hover:text-dark-navy p-2.5 rounded-xl transition-all duration-300 border border-white/10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </button>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Empty State -->
        <div x-show="document.querySelectorAll('.glass-card[style*=\'display: block\']').length === 0" 
             class="py-20 text-center">
            <p class="text-white/20 text-lg">No books found matching your criteria.</p>
        </div>
    </main>

    <footer class="py-12 border-t border-white/5 mt-20 text-center">
        <p class="text-white/20 text-[10px] uppercase tracking-[0.5em] font-light">&copy; 2026 Net-Library &bull; Antigravity Experience</p>
    </footer>

</body>
</html>
