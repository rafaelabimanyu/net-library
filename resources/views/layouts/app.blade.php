<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="antialiased">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Net-Library - Modern & Futuristic Library')</title>
    
    <!-- Theme Script (Prevent Flash) -->
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    
    <!-- Scripts/Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        .neon-glow {
            box-shadow: 0 0 20px rgba(130, 200, 229, 0.3);
        }
        .neon-text {
            text-shadow: 0 0 15px rgba(130, 200, 229, 0.5);
        }
        .glass {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .dark .glass {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .light .glass {
            background: rgba(130, 200, 229, 0.1);
            border: 1px solid rgba(130, 200, 229, 0.2);
        }
    </style>
</head>
<body class="bg-[#f8fafc] dark:bg-[#0a0a0c] text-gray-900 dark:text-gray-100 font-sans min-h-screen transition-colors duration-300 selection:bg-sky-blue/30 overflow-x-hidden">

    <!-- Ambient Glow Background -->
    <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
        <div class="absolute top-[10%] left-[10%] w-[400px] h-[400px] bg-sky-blue/10 dark:bg-sky-blue/5 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-[10%] right-[10%] w-[300px] h-[300px] bg-sky-blue/10 dark:bg-sky-blue/5 rounded-full blur-[100px]"></div>
    </div>

    @include('layouts.navigation')

    <!-- Main Content -->
    <main class="pt-20">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="py-20 px-10 border-t border-gray-200 dark:border-white/5 transition-colors duration-300">
        <div class="max-w-7xl mx-auto text-center">
            <div class="flex items-center justify-center gap-3 mb-6">
                <div class="w-10 h-10 bg-sky-blue rounded-xl shadow-glow flex items-center justify-center">
                    <span class="text-dark-navy font-black text-xl">N</span>
                </div>
                <h1 class="text-2xl font-black tracking-tighter text-dark-navy dark:text-white">NET-LIBRARY</h1>
            </div>
            <p class="text-gray-400 dark:text-white/20 text-xs font-medium uppercase tracking-[0.5em] mb-4">
                &copy; 2026 Net-Library &bull; {{ __('Synchronized in Real-Time') }}
            </p>
        </div>
    </footer>

</body>
</html>
