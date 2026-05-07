@php
    $user = Auth::user();
    $role = $user ? $user->role : 'visitor';
@endphp

<nav x-data="{ 
    scrolled: false, 
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
}" 
@scroll.window="scrolled = (window.pageYOffset > 50)"
:class="scrolled ? 'glass py-4' : 'py-8'" 
class="fixed top-0 left-0 right-0 z-50 px-10 transition-all duration-500 bg-transparent dark:bg-transparent">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
        <!-- Logo -->
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-sky-blue rounded-xl shadow-glow flex items-center justify-center">
                <span class="text-dark-navy font-black text-xl">N</span>
            </div>
            <h1 class="text-2xl font-black tracking-tighter text-dark-navy dark:text-white transition-colors duration-300">NET-LIBRARY</h1>
        </div>
        
        <!-- Menu Items -->
        <div class="flex items-center gap-8">
            <div class="hidden lg:flex items-center gap-6">
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
            </div>

            <!-- Toggles & Actions -->
            <div class="flex items-center gap-4 border-l border-gray-200 dark:border-white/10 pl-6 ml-2 transition-colors duration-300">
                <!-- Language Toggle -->
                <div class="flex items-center bg-gray-100 dark:bg-white/5 rounded-full p-1 border border-gray-200 dark:border-white/10">
                    <a href="{{ route('lang.switch', 'id') }}" 
                        class="px-3 py-1 rounded-full text-[10px] font-bold transition-all {{ App::getLocale() == 'id' ? 'bg-sky-blue text-dark-navy shadow-sm' : 'text-gray-500 dark:text-white/40 hover:text-sky-blue' }}">ID</a>
                    <a href="{{ route('lang.switch', 'en') }}" 
                        class="px-3 py-1 rounded-full text-[10px] font-bold transition-all {{ App::getLocale() == 'en' ? 'bg-sky-blue text-dark-navy shadow-sm' : 'text-gray-500 dark:text-white/40 hover:text-sky-blue' }}">EN</a>
                </div>

                <!-- Theme Toggle -->
                <button @click="toggleTheme()" class="p-2 rounded-full bg-gray-100 dark:bg-white/5 text-gray-500 dark:text-sky-blue border border-gray-200 dark:border-white/10 hover:border-sky-blue transition-all">
                    <!-- Sun Icon -->
                    <svg x-show="theme === 'dark'" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707M16.05 16.05l.707.707M7.757 7.757l.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z" />
                    </svg>
                    <!-- Moon Icon -->
                    <svg x-show="theme === 'light'" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>

                @auth
                <div class="flex items-center gap-4">
                    <a href="{{ route('profile.show') }}" class="w-8 h-8 rounded-full border border-sky-blue/30 overflow-hidden hover:shadow-glow transition-all">
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
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 dark:text-white/20 hover:text-red-400 transition-colors">{{ __('Sign Out') }}</button>
                    </form>
                </div>
                @else
                <a href="{{ route('login') }}" class="text-[10px] font-black uppercase tracking-[0.2em] text-sky-blue hover:neon-text transition-all">Login</a>
                @endauth
            </div>
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
