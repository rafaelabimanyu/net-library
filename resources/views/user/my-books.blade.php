@extends('layouts.app')

@section('title', __('My Assets'))

@section('content')
<div class="max-w-7xl mx-auto px-6 lg:px-10 py-12" x-data="{ openModal: false, selectedBook: {} }">
    <header class="mb-16">
        <h2 class="text-5xl font-black tracking-tighter mb-4 text-slate-800 dark:text-white transition-colors duration-300">{{ __('My Assets') }}</h2>
        <p class="text-slate-500 dark:text-white/30 font-light text-lg">{{ __('Detailed overview of your current loans and historical engagement.') }}</p>
    </header>

    <!-- Stats Row -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
        <div class="bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 p-10 rounded-[3rem] shadow-sm">
            <p class="text-slate-400 dark:text-white/20 text-[10px] font-black uppercase tracking-[0.3em] mb-4">{{ __('In Possession') }}</p>
            <h3 class="text-5xl font-black text-sky-blue">{{ $stats['borrowed'] }} <span class="text-sm font-light text-slate-400 dark:text-white/20 ml-2 tracking-widest uppercase">{{ __('Books') }}</span></h3>
        </div>
        <div class="bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 p-10 rounded-[3rem] shadow-sm">
            <p class="text-slate-400 dark:text-white/20 text-[10px] font-black uppercase tracking-[0.3em] mb-4">{{ __('Account Fines') }}</p>
            <h3 class="text-5xl font-black text-red-500">Rp{{ number_format($stats['fines'], 0, ',', '.') }}</h3>
        </div>
        <div class="bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 p-10 rounded-[3rem] shadow-sm">
            <p class="text-slate-400 dark:text-white/20 text-[10px] font-black uppercase tracking-[0.3em] mb-4">{{ __('Engagement History') }}</p>
            <h3 class="text-5xl font-black text-emerald-500 dark:text-emerald-400">{{ $stats['history'] }} <span class="text-sm font-light text-slate-400 dark:text-white/20 ml-2 tracking-widest uppercase">{{ __('Records') }}</span></h3>
        </div>
    </div>

    <!-- Active Streams -->
    <div class="mb-20">
        <h3 class="text-2xl font-black tracking-tighter mb-10 text-slate-800 dark:text-white">{{ __('Active & Pending Streams') }}</h3>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            @forelse($loans as $loan)
                <div class="bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 p-8 rounded-[2.5rem] flex flex-col sm:flex-row gap-8 hover:shadow-md transition-all">
                    <div class="w-full sm:w-32 h-48 rounded-2xl overflow-hidden shadow-lg flex-shrink-0">
                        <img src="{{ $loan->cover_image }}" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-grow">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h4 class="text-2xl font-black tracking-tight text-slate-800 dark:text-white transition-colors">{{ $loan->judul }}</h4>
                                <div class="mt-2">
                                    @if($loan->status === 'pending')
                                        <span class="px-3 py-1 bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-500/20 rounded-full text-[8px] font-black uppercase tracking-widest">{{ __('Pending Approval') }}</span>
                                    @else
                                        <span class="px-3 py-1 bg-sky-blue/10 text-sky-blue border border-sky-blue/20 rounded-full text-[8px] font-black uppercase tracking-widest">{{ __('Active Stream') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <p class="text-slate-500 dark:text-white/20 text-sm font-light italic mb-6">{{ $loan->penulis }}</p>
                        
                        @if($loan->status === 'borrowed')
                            @php
                                $days = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($loan->tgl_kembali_seharusnya), false);
                            @endphp
                            <div class="bg-slate-50 dark:bg-white/5 rounded-2xl p-4 border border-slate-100 dark:border-white/5">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-white/20">{{ __('Timeline') }}</span>
                                    <span class="text-xs font-black uppercase tracking-widest {{ $days < 0 ? 'text-red-500' : ($days <= 2 ? 'text-amber-500' : 'text-slate-500 dark:text-white/30') }}">
                                        @if($days < 0) {{ __('Overdue') }} ({{ abs($days) }}d)
                                        @elseif($days == 0) {{ __('Final Day') }}
                                        @else {{ $days }} {{ __('Remaining') }} @endif
                                    </span>
                                </div>
                                <div class="h-1 bg-slate-200 dark:bg-white/5 rounded-full overflow-hidden">
                                    <div class="h-full {{ $days < 0 ? 'bg-red-500 shadow-glow-red' : ($days <= 2 ? 'bg-amber-500 shadow-glow-amber' : 'bg-sky-blue shadow-glow') }}" 
                                         style="width: {{ max(0, min(100, (7 - $days) / 7 * 100)) }}%"></div>
                                </div>
                            </div>
                        @endif

                        @if($loan->status === 'borrowed')
                        <div class="mt-6">
                            <button @click="openModal = true; selectedBook = { id: {{ $loan->book_id }}, title: '{{ addslashes($loan->judul) }}' }" class="text-[10px] font-black text-sky-blue uppercase tracking-widest hover:neon-text transition-all">{{ __('Write a Review') }}</button>
                        </div>
                        @endif
                    </div>
                    <div class="text-right flex flex-col justify-center sm:border-l border-slate-100 dark:border-white/5 sm:pl-8">
                        <span class="text-[10px] text-slate-300 dark:text-white/10 uppercase font-black tracking-[0.3em] block mb-2">{{ __('Return Sync') }}</span>
                        <span class="text-lg font-black text-slate-500 dark:text-white/40 tracking-tighter">{{ \Carbon\Carbon::parse($loan->tgl_kembali_seharusnya)->format('d.m.Y') }}</span>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center glass rounded-[3rem] border-dashed border-slate-200 dark:border-white/5">
                    <p class="text-slate-400 dark:text-white/10 text-xs font-black uppercase tracking-[0.5em]">{{ __('No active asset streams detected.') }}</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Wishlist Section -->
    <div class="mb-20">
        <h3 class="text-2xl font-black tracking-tighter mb-10 text-slate-800 dark:text-white">{{ __('Saved to Wishlist') }}</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
            @forelse($wishlist as $item)
                <div class="bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-3xl p-4 hover:shadow-md transition-all group">
                    <div class="aspect-[3/4] rounded-2xl overflow-hidden mb-4 shadow-sm">
                        <img src="{{ $item->book->cover_image }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <h4 class="font-black text-slate-800 dark:text-white tracking-tight line-clamp-1">{{ $item->book->judul }}</h4>
                    <p class="text-xs text-slate-500 dark:text-white/20 italic mb-6">{{ $item->book->penulis }}</p>
                    <div class="flex gap-2">
                        <a href="{{ route('catalog') }}?search={{ $item->book->judul }}" class="flex-grow text-center py-3 bg-sky-blue text-dark-navy text-[8px] font-black rounded-xl uppercase tracking-widest hover:neon-glow transition-all">{{ __('Details') }}</a>
                        <form action="{{ route('wishlist.toggle', $item->book_id) }}" method="POST" class="flex-shrink-0">
                            @csrf
                            <button type="submit" class="p-3 bg-red-500/10 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 text-center bg-slate-50 dark:bg-white/5 border border-dashed border-slate-200 dark:border-white/5 rounded-3xl">
                    <p class="text-slate-400 dark:text-white/10 text-xs font-black uppercase tracking-[0.5em]">{{ __('No saved assets in your wishlist.') }}</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- History Logs -->
    <div class="mb-20">
        <h3 class="text-2xl font-black tracking-tighter mb-10 text-slate-800 dark:text-white">{{ __('Archive Logs') }}</h3>
        <div class="bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-[3rem] overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50 dark:bg-white/5">
                            <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-slate-500 dark:text-white/20 whitespace-nowrap">{{ __('Resource') }}</th>
                            <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-slate-500 dark:text-white/20 whitespace-nowrap">{{ __('Closed On') }}</th>
                            <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-slate-500 dark:text-white/20 whitespace-nowrap">{{ __('Adjustment') }}</th>
                            <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-slate-500 dark:text-white/20 whitespace-nowrap text-right">{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-white/5">
                        @forelse($history as $history)
                        <tr class="hover:bg-slate-50 dark:hover:bg-white/2 transition-colors">
                            <td class="px-10 py-8">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-14 rounded-lg overflow-hidden flex-shrink-0 shadow-sm border border-slate-100 dark:border-white/5">
                                        <img src="{{ $history->cover_image }}" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <p class="font-black text-lg tracking-tight text-slate-800 dark:text-white">{{ $history->judul }}</p>
                                        <span class="text-[10px] text-slate-500 dark:text-white/20 italic">{{ $history->penulis }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-10 py-8 text-sm text-slate-500 dark:text-white/40 font-mono whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($history->tgl_kembali)->format('d.m.Y') }}
                            </td>
                            <td class="px-10 py-8">
                                @if($history->denda > 0)
                                    <span class="text-sm font-black text-red-500 tracking-tight">Rp{{ number_format($history->denda, 0, ',', '.') }}</span>
                                @else
                                    <span class="text-[8px] font-black uppercase tracking-widest text-emerald-500 dark:text-emerald-400 bg-emerald-500/10 px-3 py-1 rounded-full border border-emerald-500/20">{{ __('SUCCESS') }}</span>
                                @endif
                            </td>
                            <td class="px-10 py-8 text-right">
                                <a href="{{ route('catalog') }}?search={{ $history->judul }}" class="text-[10px] font-black text-sky-blue uppercase tracking-widest hover:neon-text transition-all">{{ __('Review') }}</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-10 py-20 text-center text-slate-400 dark:text-white/5 italic font-light">{{ __('No archival records found.') }}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Review Modal -->
    <div x-show="openModal" class="fixed inset-0 z-[100] flex items-center justify-center p-6 lg:p-10 bg-slate-900/60 dark:bg-dark-navy/80 backdrop-blur-md" x-transition x-cloak>
        <div class="bg-white dark:bg-dark-navy border border-slate-200 dark:border-white/10 w-full max-w-xl rounded-[3rem] p-10 lg:p-12 relative overflow-hidden shadow-2xl" @click.away="openModal = false">
            <div class="relative z-10">
                <header class="mb-12">
                    <h3 class="text-3xl font-black text-slate-800 dark:text-white mb-2 tracking-tighter">{{ __('Share Experience') }}</h3>
                    <p class="text-slate-500 dark:text-white/30 text-sm font-light mb-10 italic" x-text="selectedBook.title"></p>
                </header>

                <form :action="'/books/' + selectedBook.id + '/review'" method="POST" x-data="{ selectedRating: 5, hoverRating: 0 }">
                    @csrf
                    <div class="mb-12">
                        <label class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-500 dark:text-white/20 mb-6 block text-center">{{ __('Efficiency Rating') }}</label>
                        <div class="flex justify-center gap-4">
                            <template x-for="i in 5">
                                <button type="button" @click="selectedRating = i" @mouseenter="hoverRating = i" @mouseleave="hoverRating = 0" class="focus:outline-none transform hover:scale-125 transition-transform">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 transition-all" :class="i <= (hoverRating || selectedRating) ? 'text-sky-blue drop-shadow-glow' : 'text-slate-100 dark:text-white/5'"
                                         fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                                    </svg>
                                </button>
                            </template>
                        </div>
                        <input type="hidden" name="rating" :value="selectedRating">
                    </div>

                    <div class="mb-12">
                        <label class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-500 dark:text-white/20 mb-4 block">{{ __('Detailed Log') }}</label>
                        <textarea name="review" rows="4" class="w-full bg-slate-50 dark:bg-white/5 border border-slate-100 dark:border-white/5 rounded-2xl p-6 text-slate-800 dark:text-white focus:border-sky-blue focus:ring-0 transition-all font-medium placeholder:text-slate-300 dark:placeholder:text-white/5 shadow-inner" placeholder="{{ __('Share your insights about this asset...') }}"></textarea>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <button type="submit" class="flex-grow bg-sky-blue text-dark-navy font-black py-5 rounded-2xl neon-glow hover:scale-[1.02] transition-all uppercase tracking-widest text-xs shadow-lg">{{ __('Transmit Review') }}</button>
                        <button type="button" @click="openModal = false" class="px-8 py-5 bg-slate-50 dark:bg-white/5 border border-slate-100 dark:border-white/5 rounded-2xl font-black text-xs uppercase tracking-widest text-slate-400 dark:text-white/40 hover:text-red-400 transition-colors">{{ __('Cancel') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
