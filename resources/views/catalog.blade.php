@extends('layouts.app')

@section('title', __('Catalog') . ' | Net-Library Antigravity')

@section('content')
    <!-- Toast Notifications -->
    <div class="fixed top-28 right-10 z-[60] space-y-4 pointer-events-none">
        @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" 
                class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 px-8 py-5 rounded-[2rem] shadow-2xl flex items-center gap-4 pointer-events-auto backdrop-blur-xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm font-bold tracking-tight">{{ session('success') }}</span>
            </div>
        @endif
    </div>

    <main x-data="{ search: '', category: 'All', detailModal: false, selectedBook: null }" class="max-w-7xl mx-auto px-10 py-10">
        <!-- Header & Search -->
        <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-12 mb-24">
            <div class="max-w-xl">
                <h2 class="text-6xl font-black tracking-tighter mb-6 leading-[0.9] text-dark-navy dark:text-white transition-colors duration-300">
                    {{ __('Explore') }} <br><span class="text-sky-blue neon-text">{{ __('Knowledge') }}</span>
                </h2>
                <p class="text-gray-400 dark:text-white/30 font-light text-lg">{{ __('Access our high-performance repository of physical and digital assets curated for the next generation.') }}</p>
            </div>

            <div class="flex flex-col sm:flex-row gap-6 w-full lg:w-auto">
                <!-- Search Bar -->
                <div class="relative group flex-grow lg:flex-grow-0">
                    <div class="absolute inset-y-0 left-6 flex items-center pointer-events-none text-gray-400 dark:text-white/20 group-focus-within:text-sky-blue transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" x-model="search" placeholder="{{ __('Search by title or author...') }}" 
                        class="w-full sm:w-96 bg-white/40 dark:bg-white/5 backdrop-blur-md border border-sky-blue/20 dark:border-white/10 rounded-[2rem] pl-16 pr-8 py-5 focus:outline-none focus:ring-4 focus:ring-sky-blue/20 focus:border-sky-blue/50 transition-all placeholder:text-gray-400 dark:placeholder:text-white/10 text-dark-navy dark:text-white font-medium">
                </div>

                <!-- Category Filter -->
                <select x-model="category" class="bg-white/40 dark:bg-white/5 backdrop-blur-md border border-sky-blue/20 dark:border-white/10 rounded-[2rem] px-8 py-5 focus:outline-none focus:ring-4 focus:ring-sky-blue/20 text-gray-500 dark:text-white/50 appearance-none cursor-pointer min-w-[200px] font-bold text-xs uppercase tracking-widest">
                    <option value="All">{{ __('All Categories') }}</option>
                    @foreach($books->pluck('kategori')->unique() as $cat)
                        <option value="{{ $cat }}">{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Book Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-10">
            @foreach($books as $book)
            <div x-show="(category === 'All' || '{{ $book->kategori }}' === category) && ('{{ strtolower($book->judul) }}'.includes(search.toLowerCase()) || '{{ strtolower($book->penulis) }}'.includes(search.toLowerCase()))"
                 x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0 scale-90 translate-y-10"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 class="bg-white/40 dark:bg-white/5 backdrop-blur-md border border-sky-blue/10 dark:border-white/5 rounded-[3rem] p-8 transition-all duration-500 flex flex-col h-full group hover:translate-y-[-8px] hover:border-sky-blue/30 hover:shadow-glow">
                
                <!-- Book Cover Placeholder -->
                <div @click="detailModal = true; selectedBook = {{ json_encode($book) }}" class="aspect-[3/4] rounded-[2rem] bg-gray-100 dark:bg-white/5 mb-8 overflow-hidden relative transition-all duration-700 cursor-pointer">
                    <div class="absolute inset-0 flex items-center justify-center text-gray-200 dark:text-white/5 group-hover:text-sky-blue/10 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="0.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    
                    <!-- Availability Badge -->
                    <div class="absolute top-6 right-6">
                        @if($book->stok_tersedia > 0)
                            <span class="px-4 py-2 rounded-full text-[10px] font-black uppercase tracking-[0.2em] bg-emerald-500/10 text-emerald-500 dark:text-emerald-400 border border-emerald-500/20 backdrop-blur-xl">{{ __('In Stock') }}</span>
                        @else
                            <span class="px-4 py-2 rounded-full text-[10px] font-black uppercase tracking-[0.2em] bg-red-500/10 text-red-500 dark:text-red-400 border border-red-500/20 backdrop-blur-xl">{{ __('Unavailable') }}</span>
                        @endif
                    </div>
                </div>

                <div class="flex-grow mb-8 cursor-pointer" @click="detailModal = true; selectedBook = {{ json_encode($book) }}">
                    <span class="text-sky-blue text-[10px] font-black uppercase tracking-[0.3em] mb-2 block">{{ $book->kategori }}</span>
                    <div class="flex items-center gap-1 mb-4">
                        @for($i = 1; $i <= 5; $i++)
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 {{ $i <= round($book->avg_rating) ? 'text-sky-blue' : 'text-gray-200 dark:text-white/10' }}" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                        <span class="text-[10px] font-bold text-gray-400 dark:text-white/20 ml-2">({{ number_format($book->avg_rating, 1) }})</span>
                    </div>
                    <h3 class="text-2xl font-black mb-2 line-clamp-2 tracking-tighter leading-[1.1] text-dark-navy dark:text-white group-hover:text-sky-blue transition-colors">{{ $book->judul }}</h3>
                    <p class="text-gray-400 dark:text-white/20 text-sm font-light italic">{{ $book->penulis }}</p>
                </div>

                <div class="mt-auto pt-8 border-t border-gray-100 dark:border-white/5 flex items-center justify-between">
                    <div class="flex flex-col">
                        <span class="text-gray-300 dark:text-white/10 text-[10px] uppercase font-black tracking-widest">{{ __('Zone') }}</span>
                        <span class="text-xs font-mono text-gray-400 dark:text-white/40 tracking-widest">{{ $book->rak_lokasi }}</span>
                    </div>
                    
                    @if($book->stok_tersedia > 0)
                        <form action="{{ route('borrow.request', $book->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-sky-blue text-dark-navy px-8 py-3 text-[10px] font-black rounded-2xl shadow-glow hover:scale-110 active:scale-95 transition-all uppercase tracking-widest">
                                {{ __('ACCESS') }}
                            </button>
                        </form>
                    @else
                        <button disabled class="bg-gray-100 dark:bg-white/5 text-gray-300 dark:text-white/10 px-8 py-3 text-[10px] font-black rounded-2xl cursor-not-allowed uppercase tracking-widest">
                            {{ __('LOCKED') }}
                        </button>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        <!-- Detail Modal -->
        <template x-if="detailModal">
            <div class="fixed inset-0 z-[100] flex items-center justify-center p-10">
                <div @click="detailModal = false" class="absolute inset-0 bg-dark-navy/80 backdrop-blur-sm"></div>
                <div class="relative w-full max-w-4xl bg-white dark:bg-dark-navy border border-sky-blue/20 rounded-[4rem] p-16 shadow-2xl flex flex-col lg:flex-row gap-16 overflow-y-auto max-h-[90vh]">
                    <!-- Left: Info -->
                    <div class="w-full lg:w-1/3">
                        <div class="aspect-[3/4] rounded-[3rem] bg-gray-100 dark:bg-white/5 mb-10 overflow-hidden relative">
                             <div class="absolute inset-0 flex items-center justify-center text-gray-200 dark:text-white/5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="0.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-3xl font-black text-dark-navy dark:text-white tracking-tighter mb-4" x-text="selectedBook.judul"></h3>
                        <p class="text-sky-blue text-xs font-black uppercase tracking-[0.4em] mb-6" x-text="selectedBook.penulis"></p>
                        
                        <div class="flex items-center gap-2 mb-10">
                            <template x-for="i in 5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" :class="i <= Math.round(selectedBook.avg_rating) ? 'text-sky-blue shadow-glow' : 'text-gray-100 dark:text-white/5'" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </template>
                            <span class="text-sm font-black text-dark-navy dark:text-white ml-2" x-text="Number(selectedBook.avg_rating).toFixed(1)"></span>
                        </div>

                        <div class="p-8 bg-sky-blue/5 border border-sky-blue/10 rounded-[2.5rem]">
                            <span class="text-[10px] font-black uppercase tracking-widest text-sky-blue mb-2 block">{{ __('System Location') }}</span>
                            <p class="text-xl font-black text-dark-navy dark:text-white tracking-widest" x-text="selectedBook.rak_lokasi"></p>
                        </div>
                    </div>

                    <!-- Right: Reviews -->
                    <div class="flex-grow">
                        <h4 class="text-[10px] font-black uppercase tracking-[0.5em] text-gray-400 dark:text-white/20 mb-10">{{ __('Neural Impressions') }}</h4>
                        
                        <div class="space-y-8">
                            <template x-for="review in selectedBook.reviews">
                                <div class="bg-gray-50 dark:bg-white/5 rounded-[2.5rem] p-8 border border-gray-100 dark:border-white/5 transition-all hover:border-sky-blue/20">
                                    <div class="flex items-center justify-between mb-6">
                                        <div class="flex items-center gap-4">
                                            <div class="w-10 h-10 rounded-full border border-sky-blue/30 overflow-hidden bg-white dark:bg-dark-navy flex items-center justify-center">
                                                <template x-if="review.user_avatar">
                                                    <img :src="'{{ asset('storage') }}/' + review.user_avatar" class="w-full h-full object-cover">
                                                </template>
                                                <template x-if="!review.user_avatar">
                                                    <span class="text-sky-blue text-xs font-black" x-text="review.user_name.charAt(0)"></span>
                                                </template>
                                            </div>
                                            <span class="text-sm font-black text-dark-navy dark:text-white" x-text="review.user_name"></span>
                                        </div>
                                        <div class="flex gap-0.5">
                                            <template x-for="i in 5">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" :class="i <= review.rating ? 'text-sky-blue' : 'text-gray-200 dark:text-white/5'" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            </template>
                                        </div>
                                    </div>
                                    <p class="text-gray-500 dark:text-white/40 text-sm font-medium leading-relaxed" x-text="review.review"></p>
                                </div>
                            </template>

                            <template x-if="selectedBook.reviews.length === 0">
                                <div class="py-20 text-center border-2 border-dashed border-gray-100 dark:border-white/5 rounded-[3rem]">
                                    <p class="text-gray-400 dark:text-white/20 text-[10px] font-black uppercase tracking-[0.3em]">{{ __('No impressions registered yet.') }}</p>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <!-- Empty State -->
        <div x-show="document.querySelectorAll('.group').length === 0" 
             class="py-40 text-center">
            <div class="inline-block p-10 bg-white/40 dark:bg-white/5 backdrop-blur-md border border-sky-blue/20 dark:border-white/10 rounded-[3rem] mb-8">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-gray-200 dark:text-white/10 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 9.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <p class="text-gray-400 dark:text-white/20 text-xl font-light tracking-widest uppercase">{{ __('No assets found in current grid.') }}</p>
        </div>
    </main>
@endsection
