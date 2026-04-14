<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Patient Record</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; background: radial-gradient(circle at top, #111 0%, #0a0a0a 100%); min-height: 100vh; }
        .glass { background: rgba(255,255,255,0.04); backdrop-filter: blur(18px); border: 1px solid rgba(255,255,255,0.08); }
        .cyan { color: #00f5d4; }
    </style>
</head>
<body class="text-gray-200 p-10">
    <div class="max-w-2xl mx-auto">
        <a href="{{ route('patients.index') }}" class="text-gray-400 hover:text-cyan-300 transition mb-6 inline-block flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Cancel and Go Back
        </a>

        <div class="glass p-8 rounded-2xl shadow-2xl">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-white">📝 Edit Patient Record</h2>
                <p class="text-cyan-400 text-sm italic">Updating: {{ $patient->name }}</p>
            </div>

            <form action="{{ route('patients.update', $patient->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2 uppercase tracking-widest">Full Name</label>
                        <input type="text" name="name" value="{{ $patient->name }}" required 
                               class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-cyan-400/50 transition">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2 uppercase tracking-widest">Gender</label>
                            <select name="gender" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-cyan-400/50 transition">
                                <option value="Male" {{ $patient->gender == 'Male' ? 'selected' : '' }} class="bg-gray-900">Male</option>
                                <option value="Female" {{ $patient->gender == 'Female' ? 'selected' : '' }} class="bg-gray-900">Female</option>
                                <option value="Other" {{ $patient->gender == 'Other' ? 'selected' : '' }} class="bg-gray-900">Other</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2 uppercase tracking-widest">Birth Date</label>
                            <input type="date" name="birth_date" value="{{ $patient->birth_date }}" required 
                                   class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-cyan-400/50 transition">
                        </div>
                    </div>

                    <hr class="border-white/10 my-8">

                    <button type="submit" class="w-full py-4 bg-cyan-500 hover:bg-cyan-400 text-black font-bold rounded-xl shadow-lg shadow-cyan-500/20 transition duration-300">
                        Update Patient Record
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>