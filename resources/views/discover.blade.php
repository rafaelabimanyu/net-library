<!DOCTYPE html>
<html lang="en" x-data="{ scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 50)">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discover | Net-Library Antigravity</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
        .neon-text {
            text-shadow: 0 0 15px rgba(130, 200, 229, 0.5);
        }
        @keyframes scroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .animate-scroll {
            animation: scroll 30s linear infinite;
        }
        .footer-glow {
            box-shadow: 0 -10px 40px rgba(130, 200, 229, 0.05);
        }
    </style>
</head>
<body class="bg-[#0a0a0c] min-h-screen text-white font-sans selection:bg-sky-blue/30 overflow-x-hidden">
    
    <!-- Background Decor -->
    <div class="fixed inset-0 -z-10">
        <div class="absolute top-[10%] left-[10%] w-[400px] h-[400px] bg-sky-blue/5 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-[10%] right-[10%] w-[300px] h-[300px] bg-sky-blue/5 rounded-full blur-[100px]"></div>
    </div>

    <!-- Navigation -->
    <nav :class="scrolled ? 'glass py-4' : 'py-8'" class="fixed top-0 left-0 right-0 z-50 px-10 transition-all duration-500">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-sky-blue rounded-xl neon-glow flex items-center justify-center">
                    <span class="text-dark-navy font-black text-xl">N</span>
                </div>
                <h1 class="text-2xl font-black tracking-tighter">NET-LIBRARY</h1>
            </div>
            
            <div class="flex items-center gap-10">
                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('discover') }}" class="text-sm font-bold text-sky-blue neon-text uppercase tracking-widest">Discover</a>
                    <a href="{{ route('catalog') }}" class="text-sm font-medium text-white/40 hover:text-white transition-colors uppercase tracking-widest">Archive</a>
                    <a href="{{ route('user.my-books') }}" class="text-sm font-medium text-white/40 hover:text-white transition-colors uppercase tracking-widest">My Streams</a>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-[10px] font-black uppercase tracking-[0.4em] text-white/20 hover:text-red-400 transition-colors">Sign Out</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-40 pb-20 px-10 text-center relative overflow-hidden">
        <div class="max-w-4xl mx-auto relative z-10">
            <span class="text-sky-blue text-[10px] font-black uppercase tracking-[0.8em] mb-6 block opacity-50 animate-pulse">Neural Knowledge Network</span>
            <h1 class="text-7xl md:text-8xl font-black tracking-tighter mb-12 leading-[0.9]">
                Temukan <br><span class="text-sky-blue neon-text">Buku Favoritmu</span>
            </h1>
            
            <!-- Giant Floating Search -->
            <div class="relative max-w-2xl mx-auto mb-20 group">
                <div class="absolute inset-0 bg-sky-blue/20 blur-[40px] opacity-0 group-focus-within:opacity-100 transition-all duration-700"></div>
                <form action="{{ route('catalog') }}" method="GET" class="relative">
                    <input type="text" name="search" placeholder="Type to explore the void..." 
                        class="w-full glass rounded-[3rem] px-10 py-8 text-xl font-medium focus:outline-none focus:ring-4 focus:ring-sky-blue/20 transition-all placeholder:text-white/10 text-center">
                    <button type="submit" class="absolute right-6 top-1/2 -translate-y-1/2 w-12 h-12 bg-sky-blue rounded-full flex items-center justify-center text-dark-navy hover:scale-110 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </form>
            </div>

            <!-- Live Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div x-data="{ count: 0, target: {{ $totalBooks }} }" x-init="let interval = setInterval(() => { if(count < target) count += Math.ceil(target/100); else { count = target; clearInterval(interval); } }, 20)" 
                    class="glass rounded-[2rem] p-10 group hover:border-sky-blue/30 transition-all">
                    <p class="text-white/20 text-[10px] font-black uppercase tracking-widest mb-4">Total Assets</p>
                    <h3 class="text-5xl font-black group-hover:text-sky-blue transition-colors" x-text="count">0</h3>
                </div>
                <div x-data="{ count: 0, target: {{ $totalLoans }} }" x-init="let interval = setInterval(() => { if(count < target) count += Math.ceil(target/100); else { count = target; clearInterval(interval); } }, 20)" 
                    class="glass rounded-[2rem] p-10 group hover:border-sky-blue/30 transition-all">
                    <p class="text-white/20 text-[10px] font-black uppercase tracking-widest mb-4">Active Streams</p>
                    <h3 class="text-5xl font-black group-hover:text-sky-blue transition-colors" x-text="count">0</h3>
                </div>
                <div x-data="{ count: 0, target: {{ $activeMembers }} }" x-init="let interval = setInterval(() => { if(count < target) count += Math.ceil(target/100); else { count = target; clearInterval(interval); } }, 20)" 
                    class="glass rounded-[2rem] p-10 group hover:border-sky-blue/30 transition-all">
                    <p class="text-white/20 text-[10px] font-black uppercase tracking-widest mb-4">Neural Nodes</p>
                    <h3 class="text-5xl font-black group-hover:text-sky-blue transition-colors" x-text="count">0</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Categories -->
    <section class="py-40">
        <div class="max-w-7xl mx-auto px-10 mb-16 flex items-end justify-between">
            <div>
                <h2 class="text-4xl font-black tracking-tighter mb-2">High-Frequency Categories</h2>
                <p class="text-white/20 font-light italic">Most explored domains in the repository.</p>
            </div>
            <a href="{{ route('catalog') }}" class="text-xs font-black uppercase tracking-widest text-sky-blue hover:neon-text transition-all">View Full Archive &rarr;</a>
        </div>

        <div class="relative overflow-hidden">
            <div class="flex gap-10 px-10 animate-scroll hover:pause" style="width: 200%;">
                @foreach(array_merge($popularCategories->toArray(), $popularCategories->toArray()) as $cat)
                <div class="glass flex-shrink-0 w-80 p-10 rounded-[3rem] group hover:bg-sky-blue transition-all duration-700 cursor-pointer">
                    <div class="w-16 h-16 bg-white/5 rounded-2xl mb-8 flex items-center justify-center text-sky-blue group-hover:bg-dark-navy transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <h4 class="text-2xl font-black tracking-tighter mb-2 group-hover:text-dark-navy transition-colors">{{ $cat->kategori }}</h4>
                    <p class="text-white/20 text-xs font-bold uppercase tracking-widest group-hover:text-dark-navy/40 transition-colors">{{ $cat->count }} Resources</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-40 bg-white/[0.02]">
        <div class="max-w-5xl mx-auto px-10 text-center">
            <h2 class="text-4xl font-black tracking-tighter mb-20">Voices from the <span class="text-sky-blue">Void</span></h2>
            
            <div x-data="{ active: 0, items: {{ json_encode($testimonials) }} }" class="relative">
                <div class="overflow-hidden">
                    <template x-for="(item, index) in items" :key="index">
                        <div x-show="active === index" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-x-20" x-transition:enter-end="opacity-100 translate-x-0" class="py-10">
                            <p class="text-3xl md:text-4xl font-light italic text-white/60 leading-relaxed mb-12" x-text="'&ldquo;' + item.text + '&rdquo;'"></p>
                            <h5 class="text-xl font-black tracking-tighter text-sky-blue" x-text="item.name"></h5>
                            <span class="text-[10px] text-white/20 uppercase tracking-[0.4em]" x-text="item.role"></span>
                        </div>
                    </template>
                </div>
                
                <div class="flex justify-center gap-4 mt-12">
                    <template x-for="(item, index) in items" :key="index">
                        <button @click="active = index" :class="active === index ? 'bg-sky-blue w-12' : 'bg-white/10 w-3'" class="h-1 rounded-full transition-all duration-500"></button>
                    </template>
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced Footer -->
    <footer class="pt-40 pb-20 px-10 relative footer-glow border-t border-sky-blue/5">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-20 mb-40">
            <div class="md:col-span-2">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-12 h-12 bg-sky-blue rounded-xl neon-glow flex items-center justify-center">
                        <span class="text-dark-navy font-black text-2xl">N</span>
                    </div>
                    <h1 class="text-3xl font-black tracking-tighter">NET-LIBRARY</h1>
                </div>
                <p class="text-white/20 font-light text-lg max-w-sm mb-10 leading-relaxed">Architecting the future of human knowledge accessibility through high-precision digital experiences.</p>
                
                <form class="flex max-w-sm group">
                    <input type="email" placeholder="Neural Newsletter..." class="flex-grow glass rounded-l-2xl px-6 py-4 text-sm focus:outline-none focus:ring-2 focus:ring-sky-blue/30 border-r-0">
                    <button class="bg-sky-blue text-dark-navy px-8 py-4 rounded-r-2xl font-black text-xs uppercase tracking-widest hover:brightness-110 transition-all">Sync</button>
                </form>
            </div>
            
            <div>
                <h4 class="text-white/40 text-[10px] font-black uppercase tracking-[0.4em] mb-10">Protocols</h4>
                <ul class="space-y-6">
                    <li><a href="#" class="text-sm font-medium text-white/20 hover:text-sky-blue transition-all">Privacy Encryption</a></li>
                    <li><a href="#" class="text-sm font-medium text-white/20 hover:text-sky-blue transition-all">Data Persistence</a></li>
                    <li><a href="#" class="text-sm font-medium text-white/20 hover:text-sky-blue transition-all">Neural Guidelines</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white/40 text-[10px] font-black uppercase tracking-[0.4em] mb-10">Connectivity</h4>
                <ul class="space-y-6">
                    <li><a href="#" class="text-sm font-medium text-white/20 hover:text-sky-blue transition-all">Global Node Map</a></li>
                    <li><a href="#" class="text-sm font-medium text-white/20 hover:text-sky-blue transition-all">Satellite Support</a></li>
                    <li><a href="#" class="text-sm font-medium text-white/20 hover:text-sky-blue transition-all">System Status</a></li>
                </ul>
            </div>
        </div>
        
        <div class="text-center pt-20 border-t border-white/5">
            <span class="text-[10px] text-white/10 uppercase tracking-[1em] font-light">&copy; 2026 Net-Library &bull; Synchronized in Real-Time</span>
        </div>
    </footer>

</body>
</html>
