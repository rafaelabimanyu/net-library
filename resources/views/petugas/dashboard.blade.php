@extends('layouts.dashboard')

@section('title', __('Staff Operations'))

@section('content')
<header class="flex justify-between items-center mb-16">
    <div>
        <h2 class="text-4xl font-black tracking-tighter mb-2 text-slate-800 dark:text-white">{{ __('Staff Operations') }}</h2>
        <p class="text-slate-400 dark:text-white/30 font-light italic">{{ __('Managing the flow of knowledge with') }} <span class="text-sky-blue font-medium">Antigravity</span>.</p>
    </div>
</header>

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
    <div class="bg-white dark:bg-white/10 border border-slate-200 dark:border-white/20 shadow-sm rounded-[2.5rem] p-6 md:p-8 transition-all duration-500 hover:shadow-md">
        <p class="text-sky-blue text-[10px] font-black uppercase tracking-widest mb-6">{{ __('Tasks Today') }}</p>
        <div class="flex items-end justify-between">
            <h3 class="text-5xl font-black text-slate-800 dark:text-white">{{ $pendingApprovalCount }}</h3>
            <span class="text-[10px] text-slate-400 dark:text-white/20 uppercase font-bold mb-1">{{ __('Awaiting') }}</span>
        </div>
    </div>

    <div class="bg-white dark:bg-white/10 border border-slate-200 dark:border-white/20 shadow-sm rounded-[2.5rem] p-6 md:p-8 transition-all duration-500 hover:shadow-md">
        <p class="text-slate-400 dark:text-white/20 text-[10px] font-bold uppercase tracking-widest mb-6">{{ __('Daily Loans') }}</p>
        <div class="flex items-end justify-between">
            <h3 class="text-5xl font-black text-slate-800 dark:text-white">{{ $loansToday }}</h3>
        </div>
    </div>

    <div class="bg-white dark:bg-white/10 border border-slate-200 dark:border-white/20 shadow-sm rounded-[2.5rem] p-6 md:p-8 transition-all duration-500 hover:shadow-md">
        <p class="text-slate-400 dark:text-white/20 text-[10px] font-bold uppercase tracking-widest mb-6">{{ __('Active Members') }}</p>
        <div class="flex items-end justify-between">
            <h3 class="text-5xl font-black text-slate-800 dark:text-white">{{ $totalMembers }}</h3>
        </div>
    </div>

    <div class="bg-white dark:bg-white/10 border border-slate-200 dark:border-white/20 shadow-sm rounded-[2.5rem] p-6 md:p-8 transition-all duration-500 hover:shadow-md">
        <p class="text-slate-400 dark:text-white/20 text-[10px] font-bold uppercase tracking-widest mb-6">{{ __('Total Books') }}</p>
        <div class="flex items-end justify-between">
            <h3 class="text-5xl font-black text-slate-800 dark:text-white">{{ $totalBooks }}</h3>
        </div>
    </div>
</div>

<!-- Recent Requests -->
<div class="bg-white dark:bg-white/10 border border-slate-200 dark:border-white/20 shadow-sm rounded-[3rem] p-6 md:p-10">
    <div class="flex items-center justify-between mb-10">
        <h4 class="text-xl font-bold tracking-tight text-slate-800 dark:text-white">{{ __('Pending Borrow Requests') }}</h4>
        <a href="{{ route('admin.transactions.index') }}" class="text-xs font-black text-sky-blue hover:neon-text transition-all uppercase tracking-widest">{{ __('View All') }}</a>
    </div>
    
    <div class="space-y-6">
        @forelse($recentTransactions->where('status', 'pending') as $tx)
        <div class="flex flex-col sm:flex-row items-center justify-between p-6 bg-slate-50 dark:bg-white/5 border border-slate-100 dark:border-white/5 rounded-2xl hover:bg-white/10 transition-all gap-6">
            <div class="flex items-center gap-6">
                <div class="w-12 h-12 bg-white dark:bg-white/5 rounded-xl flex items-center justify-center text-sky-blue/30 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-slate-800 dark:text-white/90">{{ $tx->user_name }}</p>
                    <p class="text-xs text-slate-400 dark:text-white/30 font-light italic">{{ $tx->book_title }}</p>
                </div>
            </div>
            <div class="flex gap-4">
                <form action="{{ route('admin.transactions.update', $tx->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="status" value="borrowed">
                    <button class="px-6 py-2.5 bg-sky-blue text-dark-navy text-[10px] font-black rounded-xl neon-glow hover:scale-105 transition-all uppercase tracking-widest">{{ __('Approve') }}</button>
                </form>
            </div>
        </div>
        @empty
        <div class="py-10 text-center text-slate-400 dark:text-white/20 font-light italic">{{ __('No pending requests at the moment.') }}</div>
        @endforelse
    </div>
</div>
@endsection
