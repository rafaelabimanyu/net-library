<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Report | Net-Library</title>
    @vite(['resources/css/app.css'])
    <style>
        @media print {
            .no-print { display: none; }
            body { background: white; color: black; }
            .glass { border: 1px solid #ddd; background: none; backdrop-filter: none; }
            th { background: #f3f4f6 !important; color: black !important; }
        }
    </style>
</head>
<body class="bg-slate-50 min-h-screen text-slate-900 font-sans p-8">
    
    <div class="max-w-5xl mx-auto">
        <!-- Control Header -->
        <div class="no-print flex justify-between items-center mb-8 bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
            <div>
                <h1 class="text-xl font-bold">Transaction Report Preview</h1>
                <p class="text-slate-500 text-sm">Use the print button to save as PDF or print directly.</p>
            </div>
            <div class="flex gap-4">
                <a href="{{ route('admin.transactions.index') }}" class="px-4 py-2 text-slate-600 hover:bg-slate-100 rounded-xl transition-all">Back</a>
                <button onclick="window.print()" class="px-6 py-2 bg-sky-600 text-white font-bold rounded-xl hover:bg-sky-700 shadow-lg transition-all flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 00-2 2h2m2 4h10a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Print / Export PDF
                </button>
            </div>
        </div>

        <!-- The Report -->
        <div class="bg-white p-12 rounded-[2.5rem] shadow-xl border border-slate-200 printable-area">
            <div class="flex justify-between items-start mb-12">
                <div>
                    <h2 class="text-3xl font-black text-slate-900 tracking-tighter">NET-LIBRARY</h2>
                    <p class="text-sky-600 font-bold text-xs uppercase tracking-widest">Antigravity Circulation System</p>
                </div>
                <div class="text-right">
                    <p class="font-bold">Transaction Report</p>
                    <p class="text-slate-500 text-xs">Generated on: {{ now()->format('d F Y, H:i') }}</p>
                </div>
            </div>

            <div class="border-y border-slate-100 py-6 mb-12 flex justify-between">
                <div>
                    <span class="text-slate-400 text-[10px] uppercase font-bold tracking-widest block mb-1">Total Records</span>
                    <span class="text-2xl font-bold">{{ $transactions->count() }}</span>
                </div>
                <div>
                    <span class="text-slate-400 text-[10px] uppercase font-bold tracking-widest block mb-1">Total Fines Collected</span>
                    <span class="text-2xl font-bold">Rp{{ number_format($transactions->sum('denda'), 0, ',', '.') }}</span>
                </div>
            </div>

            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-4 py-4 text-xs font-bold uppercase text-slate-500">ID</th>
                        <th class="px-4 py-4 text-xs font-bold uppercase text-slate-500">Member</th>
                        <th class="px-4 py-4 text-xs font-bold uppercase text-slate-500">Book</th>
                        <th class="px-4 py-4 text-xs font-bold uppercase text-slate-500">Status</th>
                        <th class="px-4 py-4 text-xs font-bold uppercase text-slate-500">Borrowed At</th>
                        <th class="px-4 py-4 text-xs font-bold uppercase text-slate-500">Fines</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($transactions as $tx)
                    <tr>
                        <td class="px-4 py-4 text-xs font-mono text-slate-400">#{{ str_pad($tx->id, 5, '0', STR_PAD_LEFT) }}</td>
                        <td class="px-4 py-4 text-sm font-semibold">{{ $tx->user_name }}</td>
                        <td class="px-4 py-4 text-sm text-slate-600">{{ $tx->book_title }}</td>
                        <td class="px-4 py-4 text-xs">
                            <span class="uppercase tracking-tighter font-bold">{{ $tx->status }}</span>
                        </td>
                        <td class="px-4 py-4 text-sm text-slate-500 font-mono">{{ \Carbon\Carbon::parse($tx->created_at)->format('d/m/Y') }}</td>
                        <td class="px-4 py-4 text-sm font-bold {{ $tx->denda > 0 ? 'text-red-600' : 'text-emerald-600' }}">
                            Rp{{ number_format($tx->denda, 0, ',', '.') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-20 flex justify-between items-end">
                <div class="text-[10px] text-slate-300 uppercase tracking-[0.3em]">
                    &copy; 2026 Net-Library System
                </div>
                <div class="text-center w-48 border-t border-slate-200 pt-4">
                    <p class="text-xs font-bold uppercase">Administrator</p>
                    <div class="h-16"></div>
                    <p class="text-xs">{{ auth()->user()->name }}</p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
