<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Patient System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: radial-gradient(circle at top, #111 0%, #0a0a0a 100%); min-height: 100vh; }
        .glass { background: rgba(255,255,255,0.03); backdrop-filter: blur(18px); border: 1px solid rgba(255,255,255,0.08); }
        .cyan { color: #00f5d4; }
        .glow:hover { box-shadow: 0 0 30px rgba(0, 245, 212, 0.1); transform: translateY(-2px); transition: all 0.3s ease; }
    </style>
</head>
<body class="text-gray-200 p-6 md:p-12">

    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-12">
            <div>
                <h1 class="text-4xl font-bold text-white tracking-tight">🚀 Command Center</h1>
                <p class="text-gray-400 mt-2">Welcome back, <span class="cyan font-semibold">{{ auth()->user()->name }}</span>.</p>
            </div>
            
            <div class="flex gap-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="glass px-6 py-2 rounded-xl text-sm text-red-400 hover:bg-red-500/10 transition border-red-500/20">
                        Sign Out
                    </button>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <div class="glass p-8 rounded-3xl glow border-l-4 border-l-cyan-400">
                <p class="text-xs uppercase tracking-widest text-gray-500 mb-2">Total Access</p>
                <h2 class="text-3xl font-bold text-white">Authorized</h2>
                <p class="text-cyan-400 text-sm mt-4 italic">System Status: Active</p>
            </div>

            <div class="glass p-8 rounded-3xl glow border-l-4 border-l-purple-500">
                <p class="text-xs uppercase tracking-widest text-gray-500 mb-2">Role Tier</p>
                <h2 class="text-3xl font-bold text-white">{{ ucfirst(auth()->user()->role) }}</h2>
                <p class="text-purple-400 text-sm mt-4 italic">Permissions: Verified</p>
            </div>

            <div class="glass p-8 rounded-3xl glow border-l-4 border-l-blue-500">
                <p class="text-xs uppercase tracking-widest text-gray-500 mb-2">Security</p>
                <h2 class="text-3xl font-bold text-white">SSL Encrypted</h2>
                <p class="text-blue-400 text-sm mt-4 italic">Session: Protected</p>
            </div>
        </div>

        <div class="glass p-10 rounded-[2rem] text-center border-white/5 relative overflow-hidden">
            <div class="absolute -top-24 -right-24 w-64 h-64 bg-cyan-500/10 rounded-full blur-3xl"></div>
            
            <div class="relative z-10">
                <div class="w-20 h-20 bg-cyan-500/20 rounded-2xl flex items-center justify-center mx-auto mb-6 border border-cyan-500/30">
                    <svg class="w-10 h-10 cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 012-2M5 11V9a2 2 0 01-2-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                
                <h2 class="text-3xl font-bold text-white mb-4">Patient Management System</h2>
                <p class="text-gray-400 max-w-xl mx-auto mb-10 text-lg">
                    You are currently logged into the high-security health records portal. Use the button below to view, manage, and monitor patient data.
                </p>

                <a href="{{ route('patients.index') }}" class="inline-flex items-center gap-3 px-10 py-4 bg-cyan-500 hover:bg-cyan-400 text-black font-bold rounded-2xl shadow-lg shadow-cyan-500/20 transition duration-300 transform hover:scale-105">
                    Launch Patient Records
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

</body>
</html>