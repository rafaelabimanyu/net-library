@if(session('success') || session('error'))
    <div x-data="{ show: true }" 
         x-show="show" 
         x-init="setTimeout(() => show = false, 5000)"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-2 translate-x-2"
         x-transition:enter-end="opacity-100 translate-y-0 translate-x-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed top-28 right-6 md:right-10 z-[100] space-y-4 max-w-md w-[calc(100%-3rem)] sm:w-96 pointer-events-auto">
        
        @if(session('success'))
            <div class="bg-emerald-500/10 dark:bg-emerald-950/30 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 p-5 rounded-2xl shadow-2xl flex items-center gap-4 backdrop-blur-xl">
                <div class="w-8 h-8 rounded-full bg-emerald-500/20 flex items-center justify-center flex-shrink-0 text-emerald-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="flex-grow">
                    <p class="text-xs font-black uppercase tracking-wider">{{ __('Success') }}</p>
                    <p class="text-sm font-bold tracking-tight mt-0.5">{{ session('success') }}</p>
                </div>
                <button @click="show = false" class="text-emerald-500/50 hover:text-emerald-500 transition-colors flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-500/10 dark:bg-red-950/30 border border-red-500/20 text-red-600 dark:text-red-400 p-5 rounded-2xl shadow-2xl flex items-center gap-4 backdrop-blur-xl">
                <div class="w-8 h-8 rounded-full bg-red-500/20 flex items-center justify-center flex-shrink-0 text-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div class="flex-grow">
                    <p class="text-xs font-black uppercase tracking-wider">{{ __('Error') }}</p>
                    <p class="text-sm font-bold tracking-tight mt-0.5">{{ session('error') }}</p>
                </div>
                <button @click="show = false" class="text-red-500/50 hover:text-red-500 transition-colors flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif
    </div>
@endif
