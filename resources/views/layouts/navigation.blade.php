@php
    $user = Auth::user();
    $role = $user ? $user->role : 'visitor';
@endphp

<nav x-data="{ 
    scrolled: false, 
    theme: localStorage.getItem('theme') || 'dark',
    open: false,
    toggleTheme() {
        this.theme = this.theme === 'dark' ? 'light' : 'dark';
        localStorage.setItem('theme', this.theme);
        if (this.theme === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    }
}" 
@scroll.window="scrolled = (window.pageYOffset > 50)"
:class="scrolled ? 'glass py-4' : 'py-8'" 
class="fixed top-0 left-0 right-0 z-50 px-6 md:px-10 transition-all duration-500 bg-transparent dark:bg-transparent">
    <div class="max-w-7xl mx-auto">
        <div class="flex items-center justify-between w-full">
            <!-- Logo (Sisi Kiri) -->
            <div class="flex items-center gap-2 md:gap-3 flex-shrink-0">
                <div class="w-10 h-10 bg-sky-blue rounded-xl shadow-glow flex items-center justify-center">
                    <span class="text-dark-navy font-black text-xl">N</span>
                </div>
                <h1 class="text-xl md:text-2xl font-black tracking-tighter text-dark-navy dark:text-white transition-colors duration-300">NET-LIBRARY</h1>
            </div>
            
            <!-- Menu & Controls (Sisi Kanan) -->
            <div class="flex items-center gap-4 md:gap-8">
                <!-- Desktop Menu Links (hidden on mobile, visible on md) -->
                <div class="hidden md:flex items-center gap-6">
                    @if($role === 'admin')
                        <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">{{ __('Dashboard') }}</x-nav-link>
                        <x-nav-link href="{{ route('admin.users.index') }}" :active="request()->routeIs('admin.users.index')">{{ __('Users') }}</x-nav-link>
                        <x-nav-link href="{{ route('admin.transactions.index') }}" :active="request()->routeIs('admin.transactions.index')">{{ __('Reports') }}</x-nav-link>
                    @elseif($role === 'petugas')
                        <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">{{ __('Dashboard') }}</x-nav-link>
                        <x-nav-link href="{{ route('admin.transactions.index') }}" :active="request()->routeIs('admin.transactions.index')">{{ __('Circulation') }}</x-nav-link>
                        <x-nav-link href="{{ route('admin.books.index') }}" :active="request()->routeIs('admin.books.index')">{{ __('Inventory') }}</x-nav-link>
                    @else
                        <x-nav-link href="{{ route('discover') }}" :active="request()->routeIs('discover')">{{ __('Discover') }}</x-nav-link>
                        <x-nav-link href="{{ route('catalog') }}" :active="request()->routeIs('catalog')">{{ __('Catalog') }}</x-nav-link>
                        <x-nav-link href="{{ route('user.my-books') }}" :active="request()->routeIs('user.my-books')">{{ __('My Books') }}</x-nav-link>
                    @endif
                    <x-nav-link href="{{ route('guide.index') }}" :active="request()->routeIs('guide.index')">{{ __('Guide') }}</x-nav-link>
                </div>

                <!-- Toggles & Actions -->
                <div class="flex items-center gap-2 md:gap-4 md:border-l md:border-gray-200 dark:md:border-white/10 md:pl-6 md:ml-2 transition-colors duration-300">
                    <!-- Language Toggle -->
                    <div class="flex items-center bg-gray-100 dark:bg-white/5 rounded-full p-1 border border-gray-200 dark:border-white/10 flex-shrink-0">
                        <a href="{{ route('lang.switch', 'id') }}" 
                            class="px-2 md:px-3 py-1 rounded-full text-[9px] md:text-[10px] font-bold transition-all {{ App::getLocale() == 'id' ? 'bg-sky-blue text-dark-navy shadow-sm' : 'text-gray-500 dark:text-white/40 hover:text-sky-blue' }}">ID</a>
                        <a href="{{ route('lang.switch', 'en') }}" 
                            class="px-2 md:px-3 py-1 rounded-full text-[9px] md:text-[10px] font-bold transition-all {{ App::getLocale() == 'en' ? 'bg-sky-blue text-dark-navy shadow-sm' : 'text-gray-500 dark:text-white/40 hover:text-sky-blue' }}">EN</a>
                    </div>

                    <!-- Theme Toggle -->
                    <button @click="toggleTheme()" class="p-2 rounded-full bg-gray-100 dark:bg-white/5 text-gray-500 dark:text-sky-blue border border-gray-200 dark:border-white/10 hover:border-sky-blue transition-all flex items-center justify-center flex-shrink-0">
                        <!-- Sun Icon -->
                        <svg x-show="theme === 'dark'" xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5 md:h-5 md:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707M16.05 16.05l.707.707M7.757 7.757l.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z" />
                        </svg>
                        <!-- Moon Icon -->
                        <svg x-show="theme === 'light'" xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5 md:h-5 md:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                    </button>

                    @auth
                    <div class="flex items-center gap-4">
                        <a href="{{ route('profile.show') }}" class="w-8 h-8 rounded-full border border-sky-blue/30 overflow-hidden hover:shadow-glow transition-all hidden md:block">
                            @if(Auth::user()->avatar)
                                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-sky-blue/10 flex items-center justify-center text-sky-blue">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                            @endif
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="hidden md:block">
                            @csrf
                            <button type="submit" class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 dark:text-white/20 hover:text-red-400 transition-colors">{{ __('Sign Out') }}</button>
                        </form>
                    </div>
                    @else
                    <a href="{{ route('login') }}" class="text-[10px] font-black uppercase tracking-[0.2em] text-sky-blue hover:neon-text transition-all hidden md:block flex-shrink-0">Login</a>
                    @endauth

                    <!-- Hamburger Button -->
                    <button @click="open = !open" class="md:hidden p-2 rounded-full bg-gray-100 dark:bg-white/5 text-gray-500 dark:text-sky-blue border border-gray-200 dark:border-white/10 hover:border-sky-blue transition-all flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5 md:h-5 md:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Drawer -->
        <div x-show="open" 
             x-cloak 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
             class="md:hidden mt-4 p-6 bg-zinc-900/95 backdrop-blur-md border border-white/10 rounded-[2rem] flex flex-col gap-4 shadow-2xl">
             
             @if($role === 'admin')
                 <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">{{ __('Dashboard') }}</x-nav-link>
                 <x-nav-link href="{{ route('admin.users.index') }}" :active="request()->routeIs('admin.users.index')">{{ __('Users') }}</x-nav-link>
                 <x-nav-link href="{{ route('admin.transactions.index') }}" :active="request()->routeIs('admin.transactions.index')">{{ __('Reports') }}</x-nav-link>
             @elseif($role === 'petugas')
                 <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">{{ __('Dashboard') }}</x-nav-link>
                 <x-nav-link href="{{ route('admin.transactions.index') }}" :active="request()->routeIs('admin.transactions.index')">{{ __('Circulation') }}</x-nav-link>
                 <x-nav-link href="{{ route('admin.books.index') }}" :active="request()->routeIs('admin.books.index')">{{ __('Inventory') }}</x-nav-link>
             @else
                 <x-nav-link href="{{ route('discover') }}" :active="request()->routeIs('discover')">{{ __('Discover') }}</x-nav-link>
                 <x-nav-link href="{{ route('catalog') }}" :active="request()->routeIs('catalog')">{{ __('Catalog') }}</x-nav-link>
                 <x-nav-link href="{{ route('user.my-books') }}" :active="request()->routeIs('user.my-books')">{{ __('My Books') }}</x-nav-link>
             @endif
             <x-nav-link href="{{ route('guide.index') }}" :active="request()->routeIs('guide.index')">{{ __('Guide') }}</x-nav-link>
             
             <div class="h-px bg-gray-200 dark:bg-white/10 my-2"></div>
             
             @auth
             <div class="flex items-center justify-between gap-4">
                 <a href="{{ route('profile.show') }}" class="flex items-center gap-3">
                     <div class="w-8 h-8 rounded-full border border-sky-blue/30 overflow-hidden">
                         @if(Auth::user()->avatar)
                             <img src="{{ asset('storage/' . Auth::user()->avatar) }}" class="w-full h-full object-cover">
                         @else
                             <div class="w-full h-full bg-sky-blue/10 flex items-center justify-center text-sky-blue">
                                 <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                 </svg>
                             </div>
                         @endif
                     </div>
                     <span class="text-xs font-bold text-slate-800 dark:text-white">{{ Auth::user()->name }}</span>
                 </a>
                 <form action="{{ route('logout') }}" method="POST">
                     @csrf
                     <button type="submit" class="text-[10px] font-black uppercase tracking-[0.2em] text-red-500 hover:text-red-600 transition-colors">{{ __('Sign Out') }}</button>
                 </form>
             </div>
             @else
             <a href="{{ route('login') }}" class="text-[10px] font-black uppercase tracking-[0.2em] text-sky-blue hover:neon-text transition-all text-center py-3 bg-sky-blue/10 rounded-xl border border-sky-blue/20">Login</a>
             @endauth
        </div>
    </div>
</nav>

@unless(View::exists('components.nav-link'))
    @php
        // Simple inline component for nav-link if not exists
    @endphp
@endunless

<style>
    .glass {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(20px);
        border-bottom: 1px solid rgba(130, 200, 229, 0.2);
    }
    .dark .glass {
        background: rgba(10, 10, 12, 0.7);
        backdrop-filter: blur(20px);
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }
</style>
