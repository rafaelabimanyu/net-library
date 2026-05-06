<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Net-Library Antigravity</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        @keyframes float {
            0% { transform: translateY(0px) translateX(0px); }
            50% { transform: translateY(-20px) translateX(10px); }
            100% { transform: translateY(0px) translateX(0px); }
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        .animate-float-delayed {
            animation: float 8s ease-in-out infinite;
            animation-delay: 2s;
        }
        .glass {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body class="bg-dark-navy min-h-screen flex items-center justify-center overflow-hidden font-sans">
    
    <!-- Background Decorative Elements -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10">
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-sky-blue/20 rounded-full blur-[120px] animate-pulse"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-sky-blue/10 rounded-full blur-[100px] animate-pulse" style="animation-delay: 3s;"></div>
        
        <!-- Floating Antigravity Elements -->
        <div class="absolute top-[20%] right-[15%] w-12 h-12 bg-sky-blue/30 rounded-full blur-xl animate-float"></div>
        <div class="absolute bottom-[25%] left-[20%] w-8 h-8 bg-sky-blue/20 rounded-full blur-lg animate-float-delayed"></div>
        <div class="absolute top-[60%] right-[25%] w-4 h-4 bg-white/10 rounded-full blur-md animate-float" style="animation-delay: 1s;"></div>
    </div>

    <div class="w-full max-w-md p-6 relative">
        <!-- Login Card -->
        <div class="glass rounded-3xl p-8 shadow-2xl relative overflow-hidden">
            <!-- Glow Effect -->
            <div class="absolute top-0 right-0 -mt-8 -mr-8 w-32 h-32 bg-sky-blue/20 rounded-full blur-3xl"></div>
            
            <div class="relative z-10">
                <div class="text-center mb-10">
                    <h1 class="text-3xl font-bold text-white mb-2 tracking-tight">Net-Library</h1>
                    <p class="text-sky-blue/60 text-sm font-light uppercase tracking-[0.2em]">Antigravity Access</p>
                </div>

                <form action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="email" class="block text-xs font-medium text-sky-blue/70 mb-2 uppercase tracking-wider">Email Address</label>
                        <input type="email" name="email" id="email" required 
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/20 focus:outline-none focus:ring-2 focus:ring-sky-blue/50 focus:border-sky-blue/50 transition-all duration-300"
                            placeholder="name@example.com">
                        @error('email')
                            <p class="text-red-400 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-xs font-medium text-sky-blue/70 mb-2 uppercase tracking-wider">Password</label>
                        <input type="password" name="password" id="password" required 
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/20 focus:outline-none focus:ring-2 focus:ring-sky-blue/50 focus:border-sky-blue/50 transition-all duration-300"
                            placeholder="••••••••">
                        @error('password')
                            <p class="text-red-400 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between text-xs">
                        <label class="flex items-center text-white/50 cursor-pointer hover:text-white transition-colors">
                            <input type="checkbox" name="remember" class="mr-2 rounded border-white/10 bg-white/5 text-sky-blue focus:ring-sky-blue/30">
                            <span>Remember me</span>
                        </label>
                        <a href="#" class="text-sky-blue/70 hover:text-sky-blue transition-colors">Forgot Password?</a>
                    </div>

                    <button type="submit" 
                        class="w-full bg-sky-blue text-dark-navy font-bold py-3.5 rounded-xl shadow-glow hover:translate-y-[-2px] hover:brightness-110 active:translate-y-[0px] transition-all duration-300">
                        SIGN IN
                    </button>
                </form>

                <div class="mt-8 pt-8 border-t border-white/5 text-center">
                    <p class="text-white/40 text-xs">
                        Need access? <a href="#" class="text-sky-blue/70 hover:text-sky-blue font-medium transition-colors">Contact Administrator</a>
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Decorative Text Footer -->
        <div class="mt-8 text-center">
            <span class="text-[10px] text-white/20 uppercase tracking-[0.4em] font-light">Precision Engineering &bull; Modern Library Systems</span>
        </div>
    </div>

</body>
</html>
