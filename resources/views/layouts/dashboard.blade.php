<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="antialiased" x-data="{ 
    sidebarOpen: false,
    theme: localStorage.getItem('theme') || 'dark',
    toggleTheme() {
        this.theme = this.theme === 'dark' ? 'light' : 'dark';
        localStorage.setItem('theme', this.theme);
        if (this.theme === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    }
}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Net-Library Antigravity</title>
    
    <!-- Theme Script -->
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    
    <style>
        .neon-glow { box-shadow: 0 0 20px rgba(130, 200, 229, 0.3); }
        .glass { 
            background: rgba(255, 255, 255, 0.05); 
            backdrop-filter: blur(25px); 
            border: 1px solid rgba(255, 255, 255, 0.1); 
        }
        .dark .glass { 
            background: rgba(255, 255, 255, 0.05); 
            border: 1px solid rgba(255, 255, 255, 0.1); 
        }
        .light .glass { 
            background: rgba(130, 200, 229, 0.1); 
            border: 1px solid rgba(130, 200, 229, 0.2); 
        }
        [x-cloak] { display: none !important; }
    </style>
    @stack('styles')
</head>
<body class="bg-slate-50 dark:bg-[#0a0a0c] min-h-screen text-slate-800 dark:text-white font-sans selection:bg-sky-blue/30 overflow-x-hidden transition-colors duration-300">
    
    <!-- Background Decor -->
    <div class="fixed inset-0 -z-10 pointer-events-none">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-sky-blue/10 dark:bg-sky-blue/5 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-sky-blue/10 dark:bg-sky-blue/5 rounded-full blur-[100px]"></div>
    </div>

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside 
            x-cloak
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
            class="fixed lg:sticky top-0 left-0 z-50 w-72 h-screen bg-white dark:bg-[#0f172a] border-r border-slate-200 dark:border-white/10 p-8 flex flex-col transition-transform duration-500 lg:translate-x-0">
            
            <div class="flex items-center gap-3 mb-16">
                <div class="w-10 h-10 bg-sky-blue rounded-xl shadow-glow flex items-center justify-center">
                    <span class="text-dark-navy font-black text-xl">N</span>
                </div>
                <h1 class="text-xl font-black tracking-tighter text-dark-navy dark:text-white">NET-LIBRARY</h1>
            </div>

            <nav class="space-y-3 flex-grow overflow-y-auto">
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-4 px-6 py-4 rounded-2xl {{ request()->routeIs('admin.dashboard') ? 'bg-sky-blue text-dark-navy font-bold shadow-glow' : 'text-slate-500 dark:text-white/40 hover:text-sky-blue hover:bg-sky-blue/10' }} transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        {{ __('Command Center') }}
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="flex items-center gap-4 px-6 py-4 rounded-2xl {{ request()->routeIs('admin.users.*') ? 'bg-sky-blue text-dark-navy font-bold shadow-glow' : 'text-slate-500 dark:text-white/40 hover:text-sky-blue hover:bg-sky-blue/10' }} transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        {{ __('Nodes') }}
                    </a>
                @else
                    <a href="{{ route('petugas.dashboard') }}" class="flex items-center gap-4 px-6 py-4 rounded-2xl {{ request()->routeIs('petugas.dashboard') ? 'bg-sky-blue text-dark-navy font-bold shadow-glow' : 'text-slate-500 dark:text-white/40 hover:text-sky-blue hover:bg-sky-blue/10' }} transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        {{ __('Operations') }}
                    </a>
                @endif

                <a href="{{ route('admin.transactions.index') }}" class="flex items-center gap-4 px-6 py-4 rounded-2xl {{ request()->routeIs('admin.transactions.*') ? 'bg-sky-blue text-dark-navy font-bold shadow-glow' : 'text-slate-500 dark:text-white/40 hover:text-sky-blue hover:bg-sky-blue/10' }} transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                    </svg>
                    {{ __('Circulation') }}
                </a>
                <a href="{{ route('admin.books.index') }}" class="flex items-center gap-4 px-6 py-4 rounded-2xl {{ request()->routeIs('admin.books.*') ? 'bg-sky-blue text-dark-navy font-bold shadow-glow' : 'text-slate-500 dark:text-white/40 hover:text-sky-blue hover:bg-sky-blue/10' }} transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    {{ __('Inventory') }}
                </a>
            </nav>

            <div class="mt-auto pt-10 border-t border-slate-200 dark:border-white/5 space-y-6">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-left px-6 py-4 text-slate-400 dark:text-white/20 hover:text-red-400 transition-colors text-[10px] font-black uppercase tracking-[0.4em]">{{ __('Sign Out') }}</button>
                </form>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-grow flex flex-col min-w-0">
            <!-- Header with Toggles -->
            <header class="sticky top-0 z-40 h-20 bg-white/80 dark:bg-[#0a0a0c]/80 backdrop-blur-xl border-b border-slate-200 dark:border-white/5 flex items-center justify-between px-6 lg:px-12 transition-all">
                <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-3 bg-slate-100 dark:bg-white/5 rounded-xl text-sky-blue border border-slate-200 dark:border-white/10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <div class="flex items-center gap-6 ml-auto">
                    <!-- Language Toggle -->
                    <div class="flex items-center bg-slate-100 dark:bg-white/5 rounded-full p-1 border border-slate-200 dark:border-white/10">
                        <a href="{{ route('lang.switch', 'id') }}" 
                            class="px-3 py-1 rounded-full text-[10px] font-bold transition-all {{ App::getLocale() == 'id' ? 'bg-sky-blue text-dark-navy shadow-sm' : 'text-slate-500 dark:text-white/40 hover:text-sky-blue' }}">ID</a>
                        <a href="{{ route('lang.switch', 'en') }}" 
                            class="px-3 py-1 rounded-full text-[10px] font-bold transition-all {{ App::getLocale() == 'en' ? 'bg-sky-blue text-dark-navy shadow-sm' : 'text-slate-500 dark:text-white/40 hover:text-sky-blue' }}">EN</a>
                    </div>

                    <!-- Theme Toggle -->
                    <button @click="toggleTheme()" class="p-2 rounded-full bg-slate-100 dark:bg-white/5 text-slate-500 dark:text-sky-blue border border-slate-200 dark:border-white/10 hover:border-sky-blue transition-all">
                        <svg x-show="theme === 'dark'" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707M16.05 16.05l.707.707M7.757 7.757l.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z" />
                        </svg>
                        <svg x-show="theme === 'light'" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                    </button>

                    <div class="w-px h-6 bg-slate-200 dark:border-white/10 mx-2"></div>

                    <a href="{{ route('profile.show') }}" class="flex items-center gap-4 group">
                        <div class="text-right hidden sm:block">
                            <p class="text-xs font-black text-slate-800 dark:text-white tracking-tight group-hover:text-sky-blue transition-colors">{{ auth()->user()->name }}</p>
                            <p class="text-[8px] font-black uppercase tracking-widest text-slate-400 dark:text-white/20">{{ auth()->user()->role }}</p>
                        </div>
                        <div class="w-10 h-10 rounded-xl border border-sky-blue/30 overflow-hidden group-hover:shadow-glow transition-all">
                            @if(auth()->user()->avatar)
                                <img src="{{ asset('storage/' . auth()->user()->avatar) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-sky-blue/10 flex items-center justify-center text-sky-blue">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </a>
                </div>
            </header>

            <!-- Main Content Scrollable -->
            <main class="flex-grow p-6 lg:p-12 overflow-y-auto max-w-[100vw]">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Mobile Overlay -->
    <div 
        x-cloak
        x-show="sidebarOpen" 
        @click="sidebarOpen = false" 
        class="fixed inset-0 z-40 bg-slate-900/60 backdrop-blur-sm lg:hidden transition-all duration-500"></div>

    @stack('scripts')
</body>
</html>
