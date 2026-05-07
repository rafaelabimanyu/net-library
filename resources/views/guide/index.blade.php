@extends(Auth::user()->role === 'pengunjung' ? 'layouts.app' : 'layouts.dashboard')

@section('title', __('Help Center'))

@section('content')
<div class="{{ Auth::user()->role === 'pengunjung' ? 'max-w-4xl mx-auto px-10 py-12' : 'max-w-4xl mx-auto' }}">
    <header class="mb-16">
        <h2 class="text-4xl font-black tracking-tighter mb-4 text-slate-800 dark:text-white">{{ __('User Guide') }}</h2>
        <p class="text-slate-400 dark:text-white/30 font-light italic">
            @if($role === 'admin')
                {{ __('Administrative Protocols & System Management') }}
            @elseif($role === 'petugas')
                {{ __('Operational Workflows & Inventory Control') }}
            @else
                {{ __('Member Handbook & Discovery Guide') }}
            @endif
        </p>
    </header>

    <div x-data="{ active: 1 }" class="space-y-6">
        @if($role === 'admin')
            <!-- Admin Guide -->
            <div class="bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-[2.5rem] overflow-hidden shadow-sm">
                <button @click="active = (active === 1 ? null : 1)" class="w-full px-10 py-8 flex items-center justify-between hover:bg-slate-50 dark:hover:bg-white/5 transition-all">
                    <span class="text-lg font-black tracking-tight text-slate-800 dark:text-white">{{ __('Managing Nodes (Users)') }}</span>
                    <svg :class="active === 1 ? 'rotate-180' : ''" class="h-5 w-5 text-sky-blue transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="active === 1" x-collapse class="px-10 pb-8">
                    <p class="text-slate-500 dark:text-white/40 leading-relaxed font-light">
                        {{ __('As an Architect, you have the authority to initiate new entities (users) or decommission existing nodes. Navigate to the "Nodes" section to manage identity protocols, update roles, or purge inactive accounts from the neural network.') }}
                    </p>
                </div>
            </div>

            <div class="bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-[2.5rem] overflow-hidden shadow-sm">
                <button @click="active = (active === 2 ? null : 2)" class="w-full px-10 py-8 flex items-center justify-between hover:bg-slate-50 dark:hover:bg-white/5 transition-all">
                    <span class="text-lg font-black tracking-tight text-slate-800 dark:text-white">{{ __('System Reports & Data Export') }}</span>
                    <svg :class="active === 2 ? 'rotate-180' : ''" class="h-5 w-5 text-sky-blue transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="active === 2" x-collapse class="px-10 pb-8">
                    <p class="text-slate-500 dark:text-white/40 leading-relaxed font-light">
                        {{ __('Strategic reports can be generated from the Circulation panel. Use the "Generate Report" command to extract a high-fidelity snapshot of all asset movements, including return syncs and fine adjustments for the entire system.') }}
                    </p>
                </div>
            </div>

            <div class="bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-[2.5rem] overflow-hidden shadow-sm">
                <button @click="active = (active === 3 ? null : 3)" class="w-full px-10 py-8 flex items-center justify-between hover:bg-slate-50 dark:hover:bg-white/5 transition-all">
                    <span class="text-lg font-black tracking-tight text-slate-800 dark:text-white">{{ __('Advanced Configuration') }}</span>
                    <svg :class="active === 3 ? 'rotate-180' : ''" class="h-5 w-5 text-sky-blue transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="active === 3" x-collapse class="px-10 pb-8">
                    <p class="text-slate-500 dark:text-white/40 leading-relaxed font-light">
                        {{ __('The Command Center provides a real-time overview of circulation dynamics. Monitor the neural logs to detect any anomalies in the asset stream and ensure the system is operating at optimal capacity.') }}
                    </p>
                </div>
            </div>

        @elseif($role === 'petugas')
            <!-- Staff Guide -->
            <div class="bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-[2.5rem] overflow-hidden shadow-sm">
                <button @click="active = (active === 1 ? null : 1)" class="w-full px-10 py-8 flex items-center justify-between hover:bg-slate-50 dark:hover:bg-white/5 transition-all">
                    <span class="text-lg font-black tracking-tight text-slate-800 dark:text-white">{{ __('Processing Circulation') }}</span>
                    <svg :class="active === 1 ? 'rotate-180' : ''" class="h-5 w-5 text-sky-blue transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="active === 1" x-collapse class="px-10 pb-8">
                    <p class="text-slate-500 dark:text-white/40 leading-relaxed font-light">
                        {{ __('Your primary directive is to validate asset streams. When a member requests a borrow, approve it to decrease stock and initiate the loan. Use the "Archive" command when the asset is physically returned to adjust stock and calculate potential adjustments.') }}
                    </p>
                </div>
            </div>

            <div class="bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-[2.5rem] overflow-hidden shadow-sm">
                <button @click="active = (active === 2 ? null : 2)" class="w-full px-10 py-8 flex items-center justify-between hover:bg-slate-50 dark:hover:bg-white/5 transition-all">
                    <span class="text-lg font-black tracking-tight text-slate-800 dark:text-white">{{ __('Inventory Management') }}</span>
                    <svg :class="active === 2 ? 'rotate-180' : ''" class="h-5 w-5 text-sky-blue transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="active === 2" x-collapse class="px-10 pb-8">
                    <p class="text-slate-500 dark:text-white/40 leading-relaxed font-light">
                        {{ __('Maintain the repository by cataloging new assets. Ensure each entry has an accurate ISBN, stock count, and repository zone assignment for efficient retrieval.') }}
                    </p>
                </div>
            </div>

        @else
            <!-- User Guide -->
            <div class="bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-[2.5rem] overflow-hidden shadow-sm">
                <button @click="active = (active === 1 ? null : 1)" class="w-full px-10 py-8 flex items-center justify-between hover:bg-slate-50 dark:hover:bg-white/5 transition-all">
                    <span class="text-lg font-black tracking-tight text-slate-800 dark:text-white">{{ __('Discovering Assets') }}</span>
                    <svg :class="active === 1 ? 'rotate-180' : ''" class="h-5 w-5 text-sky-blue transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="active === 1" x-collapse class="px-10 pb-8">
                    <p class="text-slate-500 dark:text-white/40 leading-relaxed font-light">
                        {{ __('Navigate to the "Discover" or "Catalog" section to explore our repository. Use the search bar to filter by title or author, and view detailed synopses and neural impressions from other members before borrowing.') }}
                    </p>
                </div>
            </div>

            <div class="bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-[2.5rem] overflow-hidden shadow-sm">
                <button @click="active = (active === 2 ? null : 2)" class="w-full px-10 py-8 flex items-center justify-between hover:bg-slate-50 dark:hover:bg-white/5 transition-all">
                    <span class="text-lg font-black tracking-tight text-slate-800 dark:text-white">{{ __('Wishlist & Bookmarks') }}</span>
                    <svg :class="active === 2 ? 'rotate-180' : ''" class="h-5 w-5 text-sky-blue transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="active === 2" x-collapse class="px-10 pb-8">
                    <p class="text-slate-500 dark:text-white/40 leading-relaxed font-light">
                        {{ __('Save interesting assets for later by clicking the heart icon. Your personalized wishlist can be accessed from the "My Repository" dashboard for quick access and tracking.') }}
                    </p>
                </div>
            </div>

            <div class="bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-[2.5rem] overflow-hidden shadow-sm">
                <button @click="active = (active === 3 ? null : 3)" class="w-full px-10 py-8 flex items-center justify-between hover:bg-slate-50 dark:hover:bg-white/5 transition-all">
                    <span class="text-lg font-black tracking-tight text-slate-800 dark:text-white">{{ __('Loan Rules & Fines') }}</span>
                    <svg :class="active === 3 ? 'rotate-180' : ''" class="h-5 w-5 text-sky-blue transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="active === 3" x-collapse class="px-10 pb-8">
                    <p class="text-slate-500 dark:text-white/40 leading-relaxed font-light">
                        {{ __('Assets can be borrowed for a standard period of 7 days. Ensure return syncs are performed on time to avoid fine adjustments (Rp2,000 per day). You can track your active streams and due dates in your personal dashboard.') }}
                    </p>
                </div>
            </div>
        @endif
    </div>

    <footer class="mt-20 pt-10 border-t border-slate-200 dark:border-white/5 text-center">
        <p class="text-slate-400 dark:text-white/20 text-xs font-bold uppercase tracking-[0.4em]">
            {{ __('Neural Support System') }} &bull; v2.0 Enterprise
        </p>
    </footer>
</div>
@endsection
