<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access | Net-Library Antigravity</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <style>
        .glass {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .neon-glow {
            text-shadow: 0 0 20px rgba(130, 200, 229, 0.5);
        }
        .shadow-neon {
            box-shadow: 0 0 30px rgba(130, 200, 229, 0.3);
        }
    </style>
</head>
<body class="bg-[#0a0a0c] min-h-screen flex items-center justify-center overflow-hidden font-sans selection:bg-sky-blue/30">
    
    <!-- Background Decor -->
    <div class="fixed inset-0 -z-10">
        <div class="absolute top-[-20%] left-[-20%] w-[70%] h-[70%] bg-sky-blue/10 rounded-full blur-[180px] animate-pulse"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[50%] h-[50%] bg-sky-blue/5 rounded-full blur-[150px] animate-pulse" style="animation-delay: 3s;"></div>
    </div>

    <div class="w-full max-w-[450px] p-10 relative">
        <!-- Brand -->
        <div class="text-center mb-16">
            <div class="w-14 h-14 bg-sky-blue rounded-2xl shadow-neon flex items-center justify-center mx-auto mb-6">
                <span class="text-dark-navy font-black text-2xl">N</span>
            </div>
            <h1 class="text-4xl font-black tracking-tighter mb-2">NET-LIBRARY</h1>
            <p class="text-white/20 text-[10px] font-black uppercase tracking-[0.6em]">System Authentication</p>
        </div>

        <!-- Login Card -->
        <div class="glass rounded-[3rem] p-12 shadow-2xl relative overflow-hidden">
            <!-- Subtle pendaran -->
            <div class="absolute top-0 right-0 w-32 h-32 bg-sky-blue/10 rounded-full blur-[60px] -z-10"></div>
            
            <form action="{{ route('login') }}" method="POST" class="space-y-8">
                @csrf
                <div class="space-y-4">
                    <label for="email" class="block text-[10px] font-black text-white/30 uppercase tracking-[0.3em] ml-4">Credential Identity</label>
                    <input type="email" name="email" id="email" required 
                        class="w-full bg-white/5 border border-white/10 rounded-[2rem] px-8 py-5 text-white placeholder-white/10 focus:outline-none focus:ring-4 focus:ring-sky-blue/20 focus:border-sky-blue/50 transition-all duration-500 font-medium"
                        placeholder="identity@netlib.com">
                    @error('email')
                        <p class="text-red-400 text-xs mt-2 ml-4 font-light italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-4">
                    <label for="password" class="block text-[10px] font-black text-white/30 uppercase tracking-[0.3em] ml-4">Access Key</label>
                    <input type="password" name="password" id="password" required 
                        class="w-full bg-white/5 border border-white/10 rounded-[2rem] px-8 py-5 text-white placeholder-white/10 focus:outline-none focus:ring-4 focus:ring-sky-blue/20 focus:border-sky-blue/50 transition-all duration-500 font-medium"
                        placeholder="••••••••">
                </div>

                <div class="flex items-center justify-between px-4">
                    <label class="flex items-center gap-3 text-[10px] text-white/30 cursor-pointer hover:text-white transition-colors group uppercase font-bold tracking-widest">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded-lg border-white/10 bg-white/5 text-sky-blue focus:ring-sky-blue/30 focus:ring-offset-0 transition-all">
                        <span>Persist Session</span>
                    </label>
                    <a href="#" class="text-[10px] font-bold text-sky-blue/40 hover:text-sky-blue transition-colors uppercase tracking-widest">Recovery</a>
                </div>

                <button type="submit" 
                    class="w-full bg-sky-blue text-dark-navy font-black py-6 rounded-[2rem] shadow-neon hover:scale-[1.02] hover:brightness-110 active:scale-95 transition-all duration-500 uppercase tracking-[0.2em] text-xs">
                    INITIATE ACCESS
                </button>
            </form>
        </div>
        
        <!-- Footer -->
        <div class="mt-16 text-center">
            <a href="{{ route('catalog') }}" class="text-[10px] text-white/20 hover:text-sky-blue uppercase tracking-[0.4em] font-light transition-all">
                &larr; Back to Landing Page
            </a>
        </div>
    </div>

</body>
</html>
