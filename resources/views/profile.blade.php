@extends('layouts.app')

@section('title', __('Control Center') . ' | Net-Library Profile')

@section('content')
<main class="max-w-7xl mx-auto px-10 py-10">
    <header class="mb-20">
        <h2 class="text-5xl font-black tracking-tighter mb-4 text-dark-navy dark:text-white transition-colors duration-300">{{ __('Identity Control') }}</h2>
        <p class="text-gray-400 dark:text-white/30 font-light text-lg">{{ __('Manage your neural presence and security protocols.') }}</p>
    </header>

    @if(session('success'))
        <div class="mb-10 p-6 bg-emerald-500/10 border border-emerald-500/20 rounded-[2rem] text-emerald-500 text-sm font-bold tracking-tight animate-pulse">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <!-- Avatar Section -->
        <div class="lg:col-span-1">
            <div class="bg-white/40 dark:bg-white/5 backdrop-blur-xl border border-sky-blue/20 dark:border-white/10 rounded-[3rem] p-10 flex flex-col items-center text-center">
                <div class="relative group">
                    <div class="absolute -inset-1 bg-sky-blue opacity-25 rounded-full blur group-hover:opacity-50 transition duration-1000 group-hover:duration-200 shadow-glow"></div>
                    <div class="relative w-48 h-48 rounded-full border-2 border-sky-blue p-2 bg-white dark:bg-dark-navy overflow-hidden shadow-glow">
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" class="w-full h-full object-cover rounded-full" alt="Avatar">
                        @else
                            <div class="w-full h-full bg-gray-100 dark:bg-white/5 flex items-center justify-center rounded-full text-sky-blue">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        @endif
                    </div>
                </div>
                
                <h3 class="text-2xl font-black text-dark-navy dark:text-white mt-8 tracking-tighter">{{ $user->name }}</h3>
                <p class="text-xs font-black uppercase tracking-[0.3em] text-sky-blue mb-6">{{ $user->role }}</p>
                
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="w-full">
                    @csrf
                    @method('PATCH')
                    <input type="file" name="avatar" id="avatar_input" class="hidden" onchange="this.form.submit()">
                    <label for="avatar_input" class="w-full py-4 bg-sky-blue/10 dark:bg-white/5 border border-sky-blue/20 dark:border-white/10 rounded-2xl text-[10px] font-black uppercase tracking-[0.3em] text-sky-blue hover:bg-sky-blue hover:text-dark-navy cursor-pointer transition-all duration-500 block">
                        {{ __('Upload Avatar') }}
                    </label>
                </form>
            </div>
        </div>

        <!-- Form Section -->
        <div class="lg:col-span-2 space-y-10">
            <!-- Basic Info -->
            <div class="bg-white/40 dark:bg-white/5 backdrop-blur-xl border border-sky-blue/20 dark:border-white/10 rounded-[3rem] p-12">
                <h3 class="text-xl font-black text-dark-navy dark:text-white mb-10 tracking-tight flex items-center gap-4">
                    <span class="w-2 h-2 bg-sky-blue rounded-full shadow-glow"></span>
                    {{ __('Basic Information') }}
                </h3>
                
                <form action="{{ route('profile.update') }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PATCH')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-400 dark:text-white/20 mb-3 block">{{ __('Full Identity') }}</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full bg-white/50 dark:bg-white/5 border-gray-200 dark:border-white/5 rounded-2xl px-6 py-4 text-dark-navy dark:text-white focus:border-sky-blue focus:ring-0 transition-all font-bold">
                            @error('name') <p class="text-red-500 text-[10px] mt-2 font-bold">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-400 dark:text-white/20 mb-3 block">{{ __('Neural Email') }}</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full bg-white/50 dark:bg-white/5 border-gray-200 dark:border-white/5 rounded-2xl px-6 py-4 text-dark-navy dark:text-white focus:border-sky-blue focus:ring-0 transition-all font-bold">
                            @error('email') <p class="text-red-500 text-[10px] mt-2 font-bold">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <button type="submit" class="px-10 py-4 bg-sky-blue text-dark-navy font-black text-[10px] uppercase tracking-[0.3em] rounded-2xl hover:shadow-glow transition-all duration-500">
                        {{ __('Synchronize Info') }}
                    </button>
                </form>
            </div>

            <!-- Security Info -->
            <div class="bg-white/40 dark:bg-white/5 backdrop-blur-xl border border-sky-blue/20 dark:border-white/10 rounded-[3rem] p-12">
                <h3 class="text-xl font-black text-dark-navy dark:text-white mb-10 tracking-tight flex items-center gap-4">
                    <span class="w-2 h-2 bg-red-500 rounded-full shadow-glow"></span>
                    {{ __('Security Protocols') }}
                </h3>
                
                <form action="{{ route('profile.password') }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div>
                            <label class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-400 dark:text-white/20 mb-3 block">{{ __('Current Password') }}</label>
                            <input type="password" name="current_password" class="w-full bg-white/50 dark:bg-white/5 border-gray-200 dark:border-white/5 rounded-2xl px-6 py-4 text-dark-navy dark:text-white focus:border-red-500/50 focus:ring-0 transition-all">
                            @error('current_password') <p class="text-red-500 text-[10px] mt-2 font-bold">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-400 dark:text-white/20 mb-3 block">{{ __('New Cipher') }}</label>
                            <input type="password" name="password" class="w-full bg-white/50 dark:bg-white/5 border-gray-200 dark:border-white/5 rounded-2xl px-6 py-4 text-dark-navy dark:text-white focus:border-sky-blue focus:ring-0 transition-all">
                            @error('password') <p class="text-red-500 text-[10px] mt-2 font-bold">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-400 dark:text-white/20 mb-3 block">{{ __('Confirm Cipher') }}</label>
                            <input type="password" name="password_confirmation" class="w-full bg-white/50 dark:bg-white/5 border-gray-200 dark:border-white/5 rounded-2xl px-6 py-4 text-dark-navy dark:text-white focus:border-sky-blue focus:ring-0 transition-all">
                        </div>
                    </div>

                    <button type="submit" class="px-10 py-4 bg-dark-navy dark:bg-white text-white dark:text-dark-navy font-black text-[10px] uppercase tracking-[0.3em] rounded-2xl hover:neon-border transition-all duration-500">
                        {{ __('Update Security') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
