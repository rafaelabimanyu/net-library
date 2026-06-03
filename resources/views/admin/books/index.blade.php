@extends('layouts.dashboard')

@section('title', 'Repository Management')

@section('content')
<div x-data="{ 
    openModal: {{ $errors->any() ? 'true' : 'false' }}, 
    editMode: {{ old('id') ? 'true' : 'false' }}, 
    currentBook: {
        id: '{{ old('id') }}',
        judul: '{{ old('judul') }}',
        penulis: '{{ old('penulis') }}',
        kategori: '{{ old('kategori') }}',
        isbn: '{{ old('isbn') }}',
        stok_total: '{{ old('stok_total') }}',
        rak_lokasi: '{{ old('rak_lokasi') }}',
        synopsis: '{{ old('synopsis') }}'
    } 
}">
    <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-16 gap-6">
        <div>
            <h2 class="text-4xl font-black tracking-tighter mb-2 text-slate-800 dark:text-white">Repository</h2>
            <p class="text-slate-400 dark:text-white/30 font-light italic">Managing the flow of physical and digital assets.</p>
        </div>
        <button @click="openModal = true; editMode = false; currentBook = {}" class="px-8 py-4 bg-sky-blue text-dark-navy font-black rounded-2xl neon-glow hover:scale-105 transition-all uppercase tracking-widest text-[10px]">
            CATALOG NEW ASSET
        </button>
    </header>

    <!-- Books Table -->
    <div class="bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-[3rem] overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50 dark:bg-white/5">
                        <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-slate-500 dark:text-white/20 whitespace-nowrap">Asset</th>
                        <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-slate-500 dark:text-white/20 whitespace-nowrap">Category</th>
                        <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-slate-500 dark:text-white/20 whitespace-nowrap">Shelf Code</th>
                        <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-slate-500 dark:text-white/20 whitespace-nowrap">Stock Status</th>
                        <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-slate-500 dark:text-white/20 whitespace-nowrap text-right">Command</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-white/5">
                    @foreach($books as $book)
                    <tr class="hover:bg-slate-50 dark:hover:bg-white/2 transition-colors">
                        <td class="px-10 py-8">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-14 rounded-lg overflow-hidden flex-shrink-0 shadow-sm border border-slate-100 dark:border-white/5 bg-slate-100 dark:bg-white/5">
                                    <img src="{{ Str::startsWith($book->cover_image, ['http://', 'https://']) ? $book->cover_image : asset('storage/' . $book->cover_image) }}" class="w-full h-full object-cover">
                                </div>
                                <div class="min-w-0">
                                    <p class="font-black text-lg tracking-tight text-slate-800 dark:text-white truncate max-w-xs md:max-w-md">{{ $book->judul }}</p>
                                    <p class="text-xs text-slate-500 dark:text-white/30 font-light truncate max-w-xs md:max-w-md">{{ $book->penulis }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-10 py-8">
                            <span class="px-3 py-1 rounded-full text-[8px] font-black uppercase tracking-widest bg-sky-blue/10 text-sky-blue border border-sky-blue/20">
                                {{ $book->kategori }}
                            </span>
                        </td>
                        <td class="px-10 py-8 font-mono text-xs text-slate-500 dark:text-white/40 tracking-wider">
                            {{ $book->rak_lokasi ?: '-' }}
                        </td>
                        <td class="px-10 py-8">
                            <div class="flex items-center gap-3">
                                <div class="flex-grow bg-slate-100 dark:bg-white/5 h-1.5 w-24 rounded-full overflow-hidden">
                                    <div class="h-full bg-sky-blue shadow-glow" style="width: {{ $book->stok_total > 0 ? ($book->stok_tersedia / $book->stok_total) * 100 : 0 }}%"></div>
                                </div>
                                <span class="text-xs font-mono text-slate-500 dark:text-white/40">{{ $book->stok_tersedia }}/{{ $book->stok_total }}</span>
                            </div>
                        </td>
                        <td class="px-10 py-8 text-right">
                            <div class="flex justify-end gap-4 items-center">
                                <button @click="openModal = true; editMode = true; currentBook = { id: '{{ $book->id }}', judul: '{{ addslashes($book->judul) }}', penulis: '{{ addslashes($book->penulis) }}', kategori: '{{ addslashes($book->kategori) }}', isbn: '{{ addslashes($book->isbn) }}', stok_total: '{{ $book->stok_total }}', rak_lokasi: '{{ addslashes($book->rak_lokasi) }}', synopsis: '{{ addslashes($book->synopsis) }}' }" class="text-sky-blue hover:neon-text transition-all text-[10px] font-black uppercase tracking-widest">Update</button>
                                <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Purge this asset from library database?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500/40 hover:text-red-500 transition-all text-[10px] font-black uppercase tracking-widest">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Form (Create / Update) -->
    <div x-show="openModal" class="fixed inset-0 z-[100] flex items-center justify-center p-6 lg:p-10 bg-slate-900/60 dark:bg-dark-navy/80 backdrop-blur-md" x-transition x-cloak>
        <div class="bg-white dark:bg-dark-navy border border-slate-200 dark:border-white/10 w-full max-w-2xl rounded-[3rem] p-10 lg:p-12 relative overflow-hidden shadow-2xl max-h-[90vh] overflow-y-auto" @click.away="openModal = false">
            <h3 class="text-3xl font-black tracking-tighter mb-10 text-slate-800 dark:text-white" x-text="editMode ? 'Asset Metadata Update' : 'New Asset Catalogs'"></h3>
            
            <form :action="editMode ? '{{ route('admin.books.index') }}/' + currentBook.id : '{{ route('admin.books.store') }}'" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <template x-if="editMode"><input type="hidden" name="_method" value="PUT"></template>
                <input type="hidden" name="id" :value="currentBook.id">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-white/20 ml-4">Title / Judul</label>
                        <input type="text" name="judul" x-model="currentBook.judul" required class="w-full bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-2xl px-6 py-4 focus:outline-none focus:ring-2 focus:ring-sky-blue/30 focus:border-sky-blue/50 text-slate-800 dark:text-white font-bold transition-all">
                        @error('judul') <p class="text-red-500 text-[10px] mt-1 ml-4 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-white/20 ml-4">Author / Penulis</label>
                        <input type="text" name="penulis" x-model="currentBook.penulis" required class="w-full bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-2xl px-6 py-4 focus:outline-none focus:ring-2 focus:ring-sky-blue/30 focus:border-sky-blue/50 text-slate-800 dark:text-white font-bold transition-all">
                        @error('penulis') <p class="text-red-500 text-[10px] mt-1 ml-4 font-bold">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-white/20 ml-4">Category / Kategori</label>
                        <input type="text" name="kategori" x-model="currentBook.kategori" required class="w-full bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-2xl px-6 py-4 focus:outline-none focus:ring-2 focus:ring-sky-blue/30 focus:border-sky-blue/50 text-slate-800 dark:text-white font-bold transition-all">
                        @error('kategori') <p class="text-red-500 text-[10px] mt-1 ml-4 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-white/20 ml-4">ISBN</label>
                        <input type="text" name="isbn" x-model="currentBook.isbn" class="w-full bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-2xl px-6 py-4 focus:outline-none focus:ring-2 focus:ring-sky-blue/30 focus:border-sky-blue/50 text-slate-800 dark:text-white font-bold transition-all">
                        @error('isbn') <p class="text-red-500 text-[10px] mt-1 ml-4 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-white/20 ml-4">Total Stock</label>
                        <input type="number" name="stok_total" x-model="currentBook.stok_total" required min="0" class="w-full bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-2xl px-6 py-4 focus:outline-none focus:ring-2 focus:ring-sky-blue/30 focus:border-sky-blue/50 text-slate-800 dark:text-white font-bold transition-all">
                        @error('stok_total') <p class="text-red-500 text-[10px] mt-1 ml-4 font-bold">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-white/20 ml-4">Shelf Zone / Rak Lokasi</label>
                        <input type="text" name="rak_lokasi" x-model="currentBook.rak_lokasi" class="w-full bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-2xl px-6 py-4 focus:outline-none focus:ring-2 focus:ring-sky-blue/30 focus:border-sky-blue/50 text-slate-800 dark:text-white font-bold transition-all">
                        @error('rak_lokasi') <p class="text-red-500 text-[10px] mt-1 ml-4 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-white/20 ml-4">Cover Image File</label>
                        <input type="file" name="cover_image" class="w-full bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-2xl px-6 py-3.5 focus:outline-none text-slate-500 text-sm">
                        <p class="text-[8px] text-slate-400 dark:text-white/20 ml-4 mt-1" x-show="editMode">Leave empty to keep existing cover.</p>
                        @error('cover_image') <p class="text-red-500 text-[10px] mt-1 ml-4 font-bold">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-white/20 ml-4">Synopsis / Sinopsis</label>
                    <textarea name="synopsis" rows="4" x-model="currentBook.synopsis" class="w-full bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-2xl px-6 py-4 focus:outline-none focus:ring-2 focus:ring-sky-blue/30 focus:border-sky-blue/50 text-slate-800 dark:text-white font-medium transition-all"></textarea>
                    @error('synopsis') <p class="text-red-500 text-[10px] mt-1 ml-4 font-bold">{{ $message }}</p> @enderror
                </div>

                <div class="flex flex-col sm:flex-row gap-4 pt-6">
                    <button type="submit" class="flex-grow bg-sky-blue text-dark-navy font-black py-5 rounded-2xl neon-glow hover:scale-[1.02] transition-all uppercase tracking-widest text-xs" x-text="editMode ? 'UPDATE METADATA' : 'CATALOG ASSET'"></button>
                    <button type="button" @click="openModal = false" class="px-8 py-5 bg-slate-100 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-2xl font-black text-xs uppercase tracking-widest text-slate-500 dark:text-white">Abort</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
