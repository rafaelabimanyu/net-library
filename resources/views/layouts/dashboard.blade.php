<!DOCTYPE html>
<html lang="en" x-data="{ sidebarOpen: false }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Net-Library Antigravity</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <style>
        .glass { background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(25px); border: 1px solid rgba(255, 255, 255, 0.1); }
        .neon-glow { box-shadow: 0 0 20px rgba(130, 200, 229, 0.3); }
        [x-cloak] { display: none !important; }
    </style>
    @stack('styles')
</head>
<body class="bg-[#0a0a0c] min-h-screen text-white font-sans selection:bg-sky-blue/30 overflow-x-hidden">
    
    <!-- Background Decor -->
    <div class="fixed inset-0 -z-10">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-sky-blue/5 rounded-full blur-[120px]"></div>
    </div>

    <div class="flex">
        <!-- Sidebar Mobile Toggle -->
        <button @click="sidebarOpen = !sidebarOpen" class="fixed top-6 left-6 z-[60] lg:hidden p-3 glass rounded-xl text-sky-blue neon-glow">
            <svg x-show="!sidebarOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg x-show="sidebarOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l18 18" />
            </svg>
        </button>

        <!-- Sidebar -->
        <aside 
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
            class="fixed lg:sticky top-0 left-0 z-50 w-72 h-screen glass border-r border-white/5 p-8 flex flex-col transition-transform duration-500">
            
            <div class="flex items-center gap-3 mb-16">
                <div class="w-10 h-10 bg-sky-blue rounded-xl neon-glow flex items-center justify-center">
                    <span class="text-dark-navy font-black text-xl">N</span>
                </div>
                <h1 class="text-xl font-black tracking-tighter">NET-LIBRARY</h1>
            </div>

            <nav class="space-y-3 flex-grow">
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-4 px-6 py-4 rounded-2xl {{ request()->routeIs('admin.dashboard') ? 'bg-sky-blue/10 text-sky-blue font-bold' : 'text-white/40 hover:text-white hover:bg-white/5' }} transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        Command Center
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="flex items-center gap-4 px-6 py-4 rounded-2xl {{ request()->routeIs('admin.users.*') ? 'bg-sky-blue/10 text-sky-blue font-bold' : 'text-white/40 hover:text-white hover:bg-white/5' }} transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Nodes
                    </a>
                @else
                    <a href="{{ route('petugas.dashboard') }}" class="flex items-center gap-4 px-6 py-4 rounded-2xl {{ request()->routeIs('petugas.dashboard') ? 'bg-sky-blue/10 text-sky-blue font-bold' : 'text-white/40 hover:text-white hover:bg-white/5' }} transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        Operations
                    </a>
                @endif

                <a href="{{ route('admin.transactions.index') }}" class="flex items-center gap-4 px-6 py-4 rounded-2xl {{ request()->routeIs('admin.transactions.*') ? 'bg-sky-blue/10 text-sky-blue font-bold' : 'text-white/40 hover:text-white hover:bg-white/5' }} transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                    </svg>
                    Circulation
                </a>
                <a href="{{ route('admin.books.index') }}" class="flex items-center gap-4 px-6 py-4 rounded-2xl {{ request()->routeIs('admin.books.*') ? 'bg-sky-blue/10 text-sky-blue font-bold' : 'text-white/40 hover:text-white hover:bg-white/5' }} transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    Repository
                </a>
            </nav>

            <form action="{{ route('logout') }}" method="POST" class="mt-auto">
                @csrf
                <button type="submit" class="w-full text-left px-6 py-4 text-white/20 hover:text-red-400 transition-colors text-[10px] font-black uppercase tracking-[0.4em]">Sign Out</button>
            </form>
        </aside>

        <!-- Main Content -->
        <main class="flex-grow p-6 lg:p-12 w-full overflow-x-hidden">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>
