<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Net-Library | {{ __('The Future of Reading') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <style>
        .neon-glow {
            text-shadow: 0 0 20px rgba(130, 200, 229, 0.5);
        }
        .glass {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-[#0a0a0c] min-h-screen text-white font-sans overflow-x-hidden">
    
    <!-- Background Elements -->
    <div class="fixed inset-0 -z-10">
        <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] bg-sky-blue/10 rounded-full blur-[150px] animate-pulse"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-sky-blue/5 rounded-full blur-[120px] animate-pulse" style="animation-delay: 2s;"></div>
    </div>

    <!-- Nav -->
    <nav class="flex items-center justify-between px-10 py-8 relative z-50">
        <div class="flex items-center gap-2">
            <div class="w-10 h-10 bg-sky-blue rounded-xl shadow-[0_0_20px_rgba(130,200,229,0.5)] flex items-center justify-center">
                <span class="text-dark-navy font-black text-xl">N</span>
            </div>
            <span class="text-2xl font-black tracking-tighter">NET-LIB</span>
        </div>
        <div class="flex items-center gap-10">
            <a href="{{ route('catalog') }}" class="text-sm font-medium text-white/50 hover:text-white transition-colors">{{ __('Catalog') }}</a>
            <a href="{{ route('login') }}" class="px-8 py-3 glass rounded-2xl text-sm font-bold hover:bg-white/10 transition-all">{{ __('Login') }}</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative min-h-[80vh] flex items-center justify-center px-10 text-center">
        <div class="max-w-4xl relative">
            <!-- Glow background for text -->
            <div class="absolute inset-0 bg-sky-blue/5 blur-[100px] -z-10 rounded-full scale-150"></div>
            
            <h1 class="text-7xl md:text-8xl font-black tracking-tighter mb-8 leading-[0.9]">
                {{ __('The Future of') }} <br>
                <span class="text-sky-blue neon-glow">{{ __('Digital Reading') }}</span>
            </h1>
            <p class="text-lg md:text-xl text-white/40 font-light max-w-2xl mx-auto mb-12 tracking-wide leading-relaxed">
                {{ __('Experience the next generation of library management.') }} <br>
                {{ __('Deeply integrated, beautifully designed, and built for the future.') }}
            </p>
            
            <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
                <a href="{{ route('catalog') }}" class="px-10 py-5 bg-sky-blue text-dark-navy font-black rounded-3xl shadow-[0_0_30px_rgba(130,200,229,0.4)] hover:scale-105 transition-all">
                    {{ __('EXPLORE CATALOG') }}
                </a>
                <a href="{{ route('login') }}" class="px-10 py-5 glass rounded-3xl font-bold hover:bg-white/10 transition-all">
                    {{ __('GET STARTED') }}
                </a>
            </div>
        </div>

        <!-- Floating Elements -->
        <div class="absolute top-20 right-20 w-32 h-32 glass rounded-full blur-2xl animate-float opacity-30"></div>
        <div class="absolute bottom-20 left-40 w-16 h-16 bg-sky-blue rounded-full blur-xl animate-float opacity-20" style="animation-delay: 3s;"></div>
    </section>

    <!-- Footer -->
    <footer class="py-20 text-center">
        <span class="text-[10px] text-white/20 uppercase tracking-[0.8em] font-light">{{ __('Antigravity Experience') }} &bull; {{ __('Precision Engineering') }}</span>
    </footer>

</body>
</html>
