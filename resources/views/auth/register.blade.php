<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Patient System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { background: radial-gradient(circle at top, #111 0%, #0a0a0a 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; font-family: 'Inter', sans-serif; }
        .glass { background: rgba(255,255,255,0.03); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.08); }
        .cyan-glow { box-shadow: 0 0 20px rgba(0, 245, 212, 0.1); }
    </style>
</head>
<body class="p-6 text-gray-200">

    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-white tracking-tight"> </h1>
            <p class="text-gray-400 mt-2 text-sm">Create an account to access the system</p>
        </div>

        <div class="glass p-8 rounded-3xl shadow-2xl cyan-glow">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-xs uppercase tracking-widest text-cyan-400 font-bold mb-2">Full Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                           class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-cyan-400/50 transition">
                    @if($errors->has('name'))
                        <p class="text-red-400 text-xs mt-2">{{ $errors->first('name') }}</p>
                    @endif
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-xs uppercase tracking-widest text-cyan-400 font-bold mb-2">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                           class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-cyan-400/50 transition">
                    @if($errors->has('email'))
                        <p class="text-red-400 text-xs mt-2">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-xs uppercase tracking-widest text-cyan-400 font-bold mb-2">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                           class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-cyan-400/50 transition">
                    @if($errors->has('password'))
                        <p class="text-red-400 text-xs mt-2">{{ $errors->first('password') }}</p>
                    @endif
                </div>

                <div class="mb-6">
                    <label for="password_confirmation" class="block text-xs uppercase tracking-widest text-cyan-400 font-bold mb-2">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                           class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-cyan-400/50 transition">
                </div>

                <div class="space-y-4">
                    <button type="submit" class="w-full py-4 bg-cyan-500 hover:bg-cyan-400 text-black font-bold rounded-xl shadow-lg shadow-cyan-500/20 transition duration-300">
                        Create Account
                    </button>

                    <div class="relative flex items-center py-2">
                        <div class="flex-grow border-t border-white/10"></div>
                        <span class="flex-shrink mx-4 text-gray-500 text-xs uppercase tracking-widest">Already have an account?</span>
                        <div class="flex-grow border-t border-white/10"></div>
                    </div>

                    <a href="{{ route('login') }}" class="block w-full text-center py-3 border border-white/10 rounded-xl text-sm font-semibold text-gray-300 hover:bg-white/5 transition">
                        Login
                    </a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>