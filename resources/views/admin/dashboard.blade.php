@extends('layouts.dashboard')

@section('title', __('Admin Command Center'))

@section('content')
<header class="flex justify-between items-center mb-16">
    <div>
        <h2 class="text-4xl font-black tracking-tighter mb-2 text-slate-800 dark:text-white">{{ __('Administrator') }}</h2>
        <p class="text-slate-400 dark:text-white/30 font-light italic">{{ __('System overview and strategic management.') }}</p>
    </div>
    <div class="hidden sm:flex items-center gap-4">
        <div class="px-6 py-3 bg-white dark:bg-white/5 rounded-2xl text-xs font-bold text-slate-500 dark:text-white/50 border border-slate-200 dark:border-white/5 uppercase tracking-widest shadow-sm">
            {{ now()->isoFormat('dddd, DD MMM YYYY') }}
        </div>
    </div>
</header>

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
    <div class="bg-white dark:bg-white/10 border border-slate-200 dark:border-white/20 shadow-sm rounded-[2.5rem] p-6 md:p-8 transition-all duration-500 hover:shadow-md">
        <p class="text-sky-blue text-[10px] font-black uppercase tracking-widest mb-6">{{ __('Strategic Status') }}</p>
        <div class="flex items-end justify-between">
            <h3 class="text-3xl font-black text-slate-800 dark:text-white">{{ __('OPTIMAL') }}</h3>
            <span class="text-[10px] text-slate-400 dark:text-white/20 uppercase font-bold mb-1">{{ __('Online') }}</span>
        </div>
    </div>

    <div class="bg-white dark:bg-white/10 border border-slate-200 dark:border-white/20 shadow-sm rounded-[2.5rem] p-6 md:p-8 transition-all duration-500 hover:shadow-md">
        <p class="text-slate-400 dark:text-white/20 text-[10px] font-bold uppercase tracking-widest mb-6">{{ __('Total Assets') }}</p>
        <div class="flex items-end justify-between">
            <h3 class="text-4xl font-black text-slate-800 dark:text-white">{{ $totalBooks }}</h3>
        </div>
    </div>

    <div class="bg-white dark:bg-white/10 border border-slate-200 dark:border-white/20 shadow-sm rounded-[2.5rem] p-6 md:p-8 transition-all duration-500 hover:shadow-md">
        <p class="text-slate-400 dark:text-white/20 text-[10px] font-black uppercase tracking-widest mb-6">{{ __('Active Members') }}</p>
        <div class="flex items-end justify-between">
            <h3 class="text-4xl font-black text-slate-800 dark:text-white">{{ $totalMembers }}</h3>
        </div>
    </div>

    <div class="bg-white dark:bg-white/10 border border-slate-200 dark:border-white/20 shadow-sm rounded-[2.5rem] p-6 md:p-8 transition-all duration-500 hover:shadow-md">
        <p class="text-slate-400 dark:text-white/20 text-[10px] font-bold uppercase tracking-widest mb-6">{{ __('Daily Loans') }}</p>
        <div class="flex items-end justify-between">
            <h3 class="text-4xl font-black text-slate-800 dark:text-white">{{ $loansToday }}</h3>
        </div>
    </div>
</div>

<!-- Secondary Stats Row (For the 5th stat: Total Fines) -->
<div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-16">
    <div class="lg:col-span-1 bg-white dark:bg-white/10 border border-slate-200 dark:border-white/20 shadow-sm rounded-[2.5rem] p-6 md:p-8 transition-all duration-500 hover:shadow-md">
        <p class="text-slate-400 dark:text-white/20 text-[10px] font-bold uppercase tracking-widest mb-6">{{ __('Total Fines') }}</p>
        <div class="flex items-end justify-between">
            <h3 class="text-2xl font-black text-red-500 dark:text-red-400">Rp{{ number_format($totalFines, 0, ',', '.') }}</h3>
        </div>
    </div>
</div>

<!-- Charts Section -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2 bg-white dark:bg-white/10 border border-slate-200 dark:border-white/20 shadow-sm rounded-[3rem] p-6 md:p-10">
        <div class="flex items-center justify-between mb-10">
            <h4 class="text-xl font-bold tracking-tight text-slate-800 dark:text-white">{{ __('Circulation Dynamics') }}</h4>
        </div>
        <div class="h-72">
            <canvas id="circulationChart"></canvas>
        </div>
    </div>

    <div class="bg-white dark:bg-white/10 border border-slate-200 dark:border-white/20 shadow-sm rounded-[3rem] p-6 md:p-10">
        <h4 class="text-xl font-bold tracking-tight mb-10 text-sky-blue">{{ __('Strategic Logs') }}</h4>
        <div class="space-y-8">
            @foreach($recentTransactions as $tx)
            <div class="flex items-start gap-4">
                <div class="w-1.5 h-1.5 rounded-full mt-2 {{ $tx->status === 'pending' ? 'bg-amber-400' : ($tx->status === 'borrowed' ? 'bg-sky-blue' : 'bg-emerald-400') }}"></div>
                <div>
                    <p class="text-sm text-slate-600 dark:text-white/80 font-medium leading-relaxed">{{ $tx->user_name }} {{ __('requested') }} {{ $tx->book_title }}</p>
                    <span class="text-[10px] text-slate-400 dark:text-white/20 uppercase tracking-widest">{{ \Carbon\Carbon::parse($tx->created_at)->diffForHumans() }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('circulationChart').getContext('2d');
    const isDark = document.documentElement.classList.contains('dark');
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'Loans',
                data: [12, 19, 3, 5, 2, 3, 9],
                borderColor: '#82c8e5',
                backgroundColor: 'rgba(130, 200, 229, 0.05)',
                borderWidth: 4,
                pointRadius: 0,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: isDark ? 'rgba(255, 255, 255, 0.03)' : 'rgba(0, 0, 0, 0.03)' },
                    ticks: { color: isDark ? 'rgba(255, 255, 255, 0.4)' : 'rgba(0, 0, 0, 0.4)', font: { size: 10 } }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: isDark ? 'rgba(255, 255, 255, 0.4)' : 'rgba(0, 0, 0, 0.4)', font: { size: 10 } }
                }
            }
        }
    });
</script>
@endpush
