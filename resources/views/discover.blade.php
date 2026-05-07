@extends('layouts.app')

@section('title', __('Discover') . ' | Net-Library Antigravity')

@section('content')
    <!-- Hero Section -->
    <section class="pt-20 pb-20 px-10 text-center relative overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0 -z-10">
            <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] bg-sky-blue/10 rounded-full blur-[150px] animate-pulse"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-sky-blue/5 rounded-full blur-[120px] animate-pulse" style="animation-delay: 2s;"></div>
        </div>

        <div class="max-w-4xl mx-auto relative z-10">
            <span class="text-sky-blue text-[10px] font-black uppercase tracking-[0.8em] mb-6 block opacity-50 animate-pulse">{{ __('Neural Knowledge Network') }}</span>
            <h1 class="text-6xl md:text-8xl font-black tracking-tighter mb-12 leading-[0.9] text-dark-navy dark:text-white transition-colors duration-300">
                {{ __('Discover') }} <br><span class="text-sky-blue neon-text">{{ __('Your Favorite Books') }}</span>
            </h1>
            
            <!-- Giant Floating Search -->
            <div class="relative max-w-2xl mx-auto mb-20 group">
                <div class="absolute inset-0 bg-sky-blue/20 blur-[40px] opacity-0 group-focus-within:opacity-100 transition-all duration-700"></div>
                <form action="{{ route('catalog') }}" method="GET" class="relative">
                    <input type="text" name="search" placeholder="{{ __('Type to explore the void...') }}" 
                        class="w-full bg-white/50 dark:bg-white/5 backdrop-blur-xl border border-sky-blue/20 dark:border-white/10 rounded-[3rem] px-10 py-8 text-xl font-medium focus:outline-none focus:ring-4 focus:ring-sky-blue/20 transition-all placeholder:text-gray-400 dark:placeholder:text-white/10 text-center text-dark-navy dark:text-white">
                    <button type="submit" class="absolute right-6 top-1/2 -translate-y-1/2 w-12 h-12 bg-sky-blue rounded-full flex items-center justify-center text-dark-navy hover:scale-110 transition-all shadow-glow">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </form>
            </div>

            <!-- Live Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div x-data="{ count: 0, target: {{ $totalBooks }} }" x-init="let interval = setInterval(() => { if(count < target) count += Math.ceil(target/100); else { count = target; clearInterval(interval); } }, 20)" 
                    class="bg-white/40 dark:bg-white/5 backdrop-blur-md border border-sky-blue/10 dark:border-white/5 rounded-[2rem] p-10 group hover:border-sky-blue/30 transition-all">
                    <p class="text-gray-400 dark:text-white/20 text-[10px] font-black uppercase tracking-widest mb-4">{{ __('Total Assets') }}</p>
                    <h3 class="text-5xl font-black text-dark-navy dark:text-white group-hover:text-sky-blue transition-colors" x-text="count">0</h3>
                </div>
                <div x-data="{ count: 0, target: {{ $totalLoans }} }" x-init="let interval = setInterval(() => { if(count < target) count += Math.ceil(target/100); else { count = target; clearInterval(interval); } }, 20)" 
                    class="bg-white/40 dark:bg-white/5 backdrop-blur-md border border-sky-blue/10 dark:border-white/5 rounded-[2rem] p-10 group hover:border-sky-blue/30 transition-all">
                    <p class="text-gray-400 dark:text-white/20 text-[10px] font-black uppercase tracking-widest mb-4">{{ __('Active Streams') }}</p>
                    <h3 class="text-5xl font-black text-dark-navy dark:text-white group-hover:text-sky-blue transition-colors" x-text="count">0</h3>
                </div>
                <div x-data="{ count: 0, target: {{ $activeMembers }} }" x-init="let interval = setInterval(() => { if(count < target) count += Math.ceil(target/100); else { count = target; clearInterval(interval); } }, 20)" 
                    class="bg-white/40 dark:bg-white/5 backdrop-blur-md border border-sky-blue/10 dark:border-white/5 rounded-[2rem] p-10 group hover:border-sky-blue/30 transition-all">
                    <p class="text-gray-400 dark:text-white/20 text-[10px] font-black uppercase tracking-widest mb-4">{{ __('Neural Nodes') }}</p>
                    <h3 class="text-5xl font-black text-dark-navy dark:text-white group-hover:text-sky-blue transition-colors" x-text="count">0</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Categories -->
    <section class="py-40">
        <div class="max-w-7xl mx-auto px-10 mb-16 flex items-end justify-between">
            <div>
                <h2 class="text-4xl font-black tracking-tighter mb-2 text-dark-navy dark:text-white transition-colors">{{ __('High-Frequency Categories') }}</h2>
                <p class="text-gray-400 dark:text-white/20 font-light italic">{{ __('Most explored domains in the repository.') }}</p>
            </div>
            <a href="{{ route('catalog') }}" class="text-xs font-black uppercase tracking-widest text-sky-blue hover:neon-text transition-all">{{ __('Catalog') }} &rarr;</a>
        </div>

        <div class="relative overflow-hidden">
            <div class="flex gap-10 px-10 animate-scroll hover:pause" style="width: 200%;">
                @foreach(array_merge($popularCategories->toArray(), $popularCategories->toArray()) as $cat)
                <div class="bg-white/40 dark:bg-white/5 backdrop-blur-md border border-sky-blue/10 dark:border-white/5 flex-shrink-0 w-80 p-10 rounded-[3rem] group hover:bg-sky-blue transition-all duration-700 cursor-pointer">
                    <div class="w-16 h-16 bg-sky-blue/10 dark:bg-white/5 rounded-2xl mb-8 flex items-center justify-center text-sky-blue group-hover:bg-dark-navy transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <h4 class="text-2xl font-black tracking-tighter mb-2 text-dark-navy dark:text-white group-hover:text-dark-navy transition-colors">{{ $cat->kategori }}</h4>
                    <p class="text-gray-400 dark:text-white/20 text-xs font-bold uppercase tracking-widest group-hover:text-dark-navy/40 transition-colors">{{ $cat->count }} {{ __('Resources') }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-40 bg-gray-100/50 dark:bg-white/[0.02] transition-colors duration-300">
        <div class="max-w-5xl mx-auto px-10 text-center">
            <h2 class="text-4xl font-black tracking-tighter mb-20 text-dark-navy dark:text-white">{{ __('Voices from the Void') }}</h2>
            
            <div x-data="{ active: 0, items: {{ json_encode($testimonials) }} }" class="relative">
                <div class="overflow-hidden">
                    <template x-for="(item, index) in items" :key="index">
                        <div x-show="active === index" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-x-20" x-transition:enter-end="opacity-100 translate-x-0" class="py-10">
                            <p class="text-3xl md:text-4xl font-light italic text-gray-500 dark:text-white/60 leading-relaxed mb-12" x-text="'&ldquo;' + item.text + '&rdquo;'"></p>
                            <h5 class="text-xl font-black tracking-tighter text-sky-blue" x-text="item.name"></h5>
                            <span class="text-[10px] text-gray-400 dark:text-white/20 uppercase tracking-[0.4em]" x-text="item.role"></span>
                        </div>
                    </template>
                </div>
                
                <div class="flex justify-center gap-4 mt-12">
                    <template x-for="(item, index) in items" :key="index">
                        <button @click="active = index" :class="active === index ? 'bg-sky-blue w-12' : 'bg-gray-300 dark:bg-white/10 w-3'" class="h-1 rounded-full transition-all duration-500"></button>
                    </template>
                </div>
            </div>
        </div>
    </section>

    <style>
        @keyframes scroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .animate-scroll {
            animation: scroll 30s linear infinite;
        }
        .animate-scroll:hover {
            animation-play-state: paused;
        }
    </style>
@endsection
