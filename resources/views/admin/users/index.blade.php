@extends('layouts.dashboard')

@section('title', 'Entity Management')

@section('content')
<div x-data="{ 
    openModal: {{ $errors->any() ? 'true' : 'false' }}, 
    editMode: {{ old('id') ? 'true' : 'false' }}, 
    currentUser: {
        id: '{{ old('id') }}',
        name: '{{ old('name') }}',
        email: '{{ old('email') }}',
        role: '{{ old('role') }}'
    } 
}">
    <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-16 gap-6">
        <div>
            <h2 class="text-4xl font-black tracking-tighter mb-2 text-slate-800 dark:text-white">User Management</h2>
            <p class="text-slate-400 dark:text-white/30 font-light italic">Orchestrate the node network and identity protocols.</p>
        </div>
        <button @click="openModal = true; editMode = false; currentUser = { role: 'pengunjung' }" class="px-8 py-4 bg-sky-blue text-dark-navy font-black rounded-2xl neon-glow hover:scale-105 transition-all uppercase tracking-widest text-[10px]">
            ADD NEW ENTITY
        </button>
    </header>

    <!-- Users Table -->
    <div class="bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-[3rem] overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50 dark:bg-white/5">
                        <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-slate-500 dark:text-white/20 whitespace-nowrap">Identity</th>
                        <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-slate-500 dark:text-white/20 whitespace-nowrap">Protocol Role</th>
                        <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-slate-500 dark:text-white/20 whitespace-nowrap">Status</th>
                        <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-slate-500 dark:text-white/20 whitespace-nowrap text-right">Commands</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-white/5">
                    @foreach($users as $user)
                    <tr class="hover:bg-slate-50 dark:hover:bg-white/2 transition-colors">
                        <td class="px-10 py-8">
                            <p class="font-black text-lg tracking-tight text-slate-800 dark:text-white">{{ $user->name }}</p>
                            <p class="text-xs text-slate-500 dark:text-white/30 font-light italic">{{ $user->email }}</p>
                        </td>
                        <td class="px-10 py-8">
                            <span class="px-3 py-1 rounded-full text-[8px] font-black uppercase tracking-widest 
                                {{ $user->role === 'admin' ? 'bg-red-500/10 text-red-500 dark:text-red-400 border border-red-500/20' : ($user->role === 'petugas' ? 'bg-sky-blue/10 text-sky-blue border border-sky-blue/20' : 'bg-slate-100 dark:bg-white/10 text-slate-500 dark:text-white/40') }}">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td class="px-10 py-8">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-emerald-500 shadow-sm"></div>
                                <span class="text-[10px] font-bold uppercase tracking-widest text-emerald-600 dark:text-emerald-400">Active</span>
                            </div>
                        </td>
                        <td class="px-10 py-8 text-right">
                            <div class="flex justify-end gap-4 items-center">
                                <button @click="openModal = true; editMode = true; currentUser = {{ json_encode($user) }}" class="text-sky-blue hover:neon-text transition-all text-[10px] font-black uppercase tracking-widest">Update</button>
                                @if($user->id !== auth()->id())
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Decommission this entity?')">
                                        @csrf @method('DELETE')
                                        <button class="text-red-500/40 hover:text-red-500 transition-all text-[10px] font-black uppercase tracking-widest">Purge</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Entity -->
    <div x-show="openModal" class="fixed inset-0 z-[100] flex items-center justify-center p-6 lg:p-10 bg-slate-900/60 dark:bg-dark-navy/80 backdrop-blur-md" x-transition x-cloak>
        <div class="bg-white dark:bg-dark-navy border border-slate-200 dark:border-white/10 w-full max-w-xl rounded-[3rem] p-10 lg:p-12 relative overflow-hidden shadow-2xl" @click.away="openModal = false">
            <h3 class="text-3xl font-black tracking-tighter mb-10 text-slate-800 dark:text-white" x-text="editMode ? 'Protocol Update' : 'New Identity Initiation'"></h3>
            
            <form :action="editMode ? '{{ route('admin.users.index') }}/' + currentUser.id : '{{ route('admin.users.store') }}'" method="POST" class="space-y-8">
                @csrf
                <template x-if="editMode"><input type="hidden" name="_method" value="PUT"></template>
                <input type="hidden" name="id" :value="currentUser.id">
                
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-white/20 ml-4">Entity Name</label>
                    <input type="text" name="name" x-model="currentUser.name" required class="w-full bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-2xl px-6 py-4 focus:outline-none focus:ring-2 focus:ring-sky-blue/30 focus:border-sky-blue/50 text-slate-800 dark:text-white font-bold transition-all">
                    @error('name') <p class="text-red-500 text-[10px] mt-1 ml-4 font-bold">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-white/20 ml-4">Sync Email</label>
                    <input type="email" name="email" x-model="currentUser.email" required class="w-full bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-2xl px-6 py-4 focus:outline-none focus:ring-2 focus:ring-sky-blue/30 focus:border-sky-blue/50 text-slate-800 dark:text-white font-bold transition-all">
                    @error('email') <p class="text-red-500 text-[10px] mt-1 ml-4 font-bold">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-white/20 ml-4" x-text="editMode ? 'New Key (Leave empty to persist)' : 'Access Key'"></label>
                    <input type="password" name="password" :required="!editMode" class="w-full bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-2xl px-6 py-4 focus:outline-none focus:ring-2 focus:ring-sky-blue/30 focus:border-sky-blue/50 text-slate-800 dark:text-white transition-all">
                    @error('password') <p class="text-red-500 text-[10px] mt-1 ml-4 font-bold">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-white/20 ml-4">Protocol Role</label>
                    <select name="role" x-model="currentUser.role" required class="w-full bg-slate-50 dark:bg-[#0a0a0c] border border-slate-200 dark:border-white/10 rounded-2xl px-6 py-4 focus:outline-none focus:ring-2 focus:ring-sky-blue/30 focus:border-sky-blue/50 appearance-none text-sm font-bold uppercase tracking-widest text-slate-800 dark:text-white transition-all">
                        <option value="pengunjung">Visitor</option>
                        <option value="petugas">Staff</option>
                        <option value="admin">Architect</option>
                    </select>
                    @error('role') <p class="text-red-500 text-[10px] mt-1 ml-4 font-bold">{{ $message }}</p> @enderror
                </div>

                <div class="flex flex-col sm:flex-row gap-4 pt-6">
                    <button type="submit" class="flex-grow bg-sky-blue text-dark-navy font-black py-5 rounded-2xl neon-glow hover:scale-[1.02] transition-all uppercase tracking-widest text-xs" x-text="editMode ? 'UPDATE PROTOCOL' : 'INITIATE ENTITY'"></button>
                    <button type="button" @click="openModal = false" class="px-8 py-5 bg-slate-100 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-2xl font-black text-xs uppercase tracking-widest text-slate-500 dark:text-white">Abort</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
