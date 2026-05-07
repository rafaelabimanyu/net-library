@extends('layouts.dashboard')

@section('title', __('Identity Control'))

@section('content')
<div class="max-w-6xl mx-auto">
    <header class="mb-16">
        <h2 class="text-5xl font-black tracking-tighter mb-4 text-slate-800 dark:text-white transition-colors duration-300">{{ __('Identity Control') }}</h2>
        <p class="text-slate-500 dark:text-white/30 font-light text-lg">{{ __('Manage your neural presence and security protocols.') }}</p>
    </header>

    @if(session('success'))
        <div class="mb-10 p-6 bg-emerald-500/10 border border-emerald-500/20 rounded-3xl text-emerald-600 dark:text-emerald-400 text-sm font-bold tracking-tight shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        <!-- Profile Column -->
        <div class="lg:col-span-1">
            <div class="bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-[3rem] p-10 text-center shadow-sm sticky top-32">
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" x-data="{ 
                    preview: '{{ $user->avatar ? asset('storage/' . $user->avatar) : '' }}',
                    handleFile(e) {
                        const file = e.target.files[0];
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = (e) => this.preview = e.target.result;
                            reader.readAsDataURL(file);
                        }
                    }
                }">
                    @csrf
                    @method('PATCH')
                    <div class="relative inline-block group mb-8">
                        <div class="w-48 h-48 rounded-[2.5rem] border-2 border-sky-blue/30 overflow-hidden shadow-2xl relative">
                            <template x-if="preview">
                                <img :src="preview" class="w-full h-full object-cover">
                            </template>
                            <template x-if="!preview">
                                <div class="w-full h-full bg-slate-50 dark:bg-white/5 flex items-center justify-center text-sky-blue/20">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                            </template>
                        </div>
                        <label class="absolute inset-0 flex items-center justify-center bg-dark-navy/60 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-all cursor-pointer rounded-[2.5rem]">
                            <span class="text-white text-[10px] font-black uppercase tracking-widest">{{ __('Upload Avatar') }}</span>
                            <input type="file" name="avatar" class="hidden" @change="handleFile">
                        </label>
                    </div>
                    <h3 class="text-2xl font-black text-slate-800 dark:text-white mt-8 tracking-tighter">{{ $user->name }}</h3>
                    <p class="text-sky-blue font-black text-[10px] uppercase tracking-[0.4em] mt-2">{{ $user->role }}</p>
                    <div class="mt-8">
                        <button type="submit" class="w-full bg-sky-blue text-dark-navy font-black py-4 rounded-2xl neon-glow hover:scale-[1.02] transition-all uppercase tracking-widest text-[10px]">{{ __('Synchronize Info') }}</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Info Column -->
        <div class="lg:col-span-2 space-y-12">
            <!-- Basic Info -->
            <div class="bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-[3rem] p-12 shadow-sm">
                <h3 class="text-xl font-black text-slate-800 dark:text-white mb-10 tracking-tight flex items-center gap-4">
                    <span class="w-8 h-8 bg-sky-blue/10 rounded-lg flex items-center justify-center text-sky-blue">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </span>
                    {{ __('Basic Information') }}
                </h3>
                <form action="{{ route('profile.update') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @csrf
                    @method('PATCH')
                    <div class="space-y-3">
                        <label class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400 dark:text-white/20 mb-3 block">{{ __('Full Identity') }}</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/5 rounded-2xl px-6 py-4 text-slate-800 dark:text-white focus:border-sky-blue focus:ring-0 transition-all font-bold">
                    </div>
                    <div class="space-y-3">
                        <label class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400 dark:text-white/20 mb-3 block">{{ __('Neural Email') }}</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/5 rounded-2xl px-6 py-4 text-slate-800 dark:text-white focus:border-sky-blue focus:ring-0 transition-all font-bold">
                    </div>
                    <div class="md:col-span-2 pt-6">
                        <button type="submit" class="bg-slate-100 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-slate-800 dark:text-white font-black px-10 py-4 rounded-xl hover:bg-sky-blue hover:text-dark-navy hover:border-sky-blue transition-all uppercase tracking-widest text-[10px] shadow-sm">
                            {{ __('Synchronize Info') }}
                        </button>
                    </div>
                </form>
            </div>

            <!-- Security Info -->
            <div class="bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-[3rem] p-12 shadow-sm">
                <h3 class="text-xl font-black text-slate-800 dark:text-white mb-10 tracking-tight flex items-center gap-4">
                    <span class="w-8 h-8 bg-red-500/10 rounded-lg flex items-center justify-center text-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </span>
                    {{ __('Security Protocols') }}
                </h3>
                <form action="{{ route('password.update') }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-3">
                            <label class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400 dark:text-white/20 mb-3 block">{{ __('Current Password') }}</label>
                            <input type="password" name="current_password" class="w-full bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/5 rounded-2xl px-6 py-4 text-slate-800 dark:text-white focus:border-red-500/50 focus:ring-0 transition-all shadow-inner">
                        </div>
                        <div class="space-y-3">
                            <label class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400 dark:text-white/20 mb-3 block">{{ __('New Cipher') }}</label>
                            <input type="password" name="password" class="w-full bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/5 rounded-2xl px-6 py-4 text-slate-800 dark:text-white focus:border-sky-blue focus:ring-0 transition-all shadow-inner">
                        </div>
                        <div class="space-y-3">
                            <label class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400 dark:text-white/20 mb-3 block">{{ __('Confirm Cipher') }}</label>
                            <input type="password" name="password_confirmation" class="w-full bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/5 rounded-2xl px-6 py-4 text-slate-800 dark:text-white focus:border-sky-blue focus:ring-0 transition-all shadow-inner">
                        </div>
                    </div>
                    <div class="pt-6">
                        <button type="submit" class="bg-slate-100 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-slate-800 dark:text-white font-black px-10 py-4 rounded-xl hover:bg-red-500 hover:text-white hover:border-red-500 transition-all uppercase tracking-widest text-[10px] shadow-sm">
                            {{ __('Update Security') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
