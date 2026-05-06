<!DOCTYPE html>
<html lang="en" class="antialiased">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Net-Library - Modern & Futuristic Library')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Scripts/Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-dark-navy text-gray-100 font-sans min-h-screen flex selection:bg-sky-blue selection:text-dark-navy">

    <!-- Ambient Glow Background -->
    <div class="fixed inset-0 z-[-1] overflow-hidden pointer-events-none">
        <div class="absolute top-[-20%] left-[-10%] w-[50%] h-[50%] rounded-full bg-sky-blue/10 blur-[120px]"></div>
        <div class="absolute bottom-[-20%] right-[-10%] w-[40%] h-[40%] rounded-full bg-sky-blue/5 blur-[100px]"></div>
    </div>

    <!-- Sidebar: Glassmorphism -->
    <aside class="w-64 h-screen fixed top-0 left-0 flex flex-col backdrop-blur-md bg-glass-white border-r border-sky-blue/20 shadow-glow transition-all duration-300 z-50">
        <div class="p-8 flex items-center justify-center border-b border-sky-blue/20">
            <h1 class="text-2xl font-bold tracking-wider text-sky-blue drop-shadow-[0_0_8px_rgba(130,200,229,0.5)]">
                NET<span class="text-white font-light">-LIB</span>
            </h1>
        </div>
        
        <nav class="flex-1 p-6 space-y-4">
            <a href="#" class="flex items-center gap-4 px-4 py-3 rounded-xl bg-sky-blue/10 text-sky-blue border border-sky-blue/30 shadow-glow transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                <span class="font-medium tracking-wide">Dashboard</span>
            </a>
            <a href="#" class="flex items-center gap-4 px-4 py-3 rounded-xl text-gray-400 hover:text-sky-blue hover:bg-glass-white hover:border-sky-blue/20 border border-transparent transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                <span class="font-medium tracking-wide">Katalog Buku</span>
            </a>
            <!-- Add more links here -->
        </nav>
        
        <div class="p-6 border-t border-sky-blue/20">
            <div class="flex items-center gap-3 px-4 py-3">
                <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-sky-blue to-dark-navy p-[2px]">
                    <div class="w-full h-full rounded-full bg-dark-navy border-2 border-transparent"></div>
                </div>
                <div>
                    <p class="text-sm font-medium text-white">Admin User</p>
                    <p class="text-xs text-sky-blue">System Administrator</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="ml-64 flex-1 flex flex-col min-h-screen relative">
        <!-- Header: Glassmorphism -->
        <header class="h-20 sticky top-0 z-40 backdrop-blur-md bg-glass-white border-b border-sky-blue/10 flex items-center justify-between px-10">
            <div>
                <h2 class="text-xl font-light text-gray-200 tracking-wider">@yield('header_title', 'Overview')</h2>
            </div>
            
            <div class="flex items-center gap-6">
                <!-- Search -->
                <div class="relative group">
                    <input type="text" placeholder="Cari entitas..." class="w-64 bg-dark-navy/50 border border-sky-blue/30 rounded-full py-2 px-6 pl-10 text-sm text-white placeholder-gray-400 focus:outline-none focus:border-sky-blue focus:shadow-glow transition-all">
                    <svg class="w-4 h-4 text-sky-blue absolute left-4 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                
                <!-- Notification -->
                <button class="relative p-2 text-gray-400 hover:text-sky-blue transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    <span class="absolute top-1 right-1 w-2.5 h-2.5 bg-sky-blue rounded-full shadow-glow"></span>
                </button>
            </div>
        </header>

        <!-- Page Content -->
        <div class="flex-1 p-10 overflow-x-hidden">
            <div class="max-w-7xl mx-auto">
                @yield('content')
            </div>
        </div>
    </main>

</body>
</html>
