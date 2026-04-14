<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Patient Management System</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>

<style>
body {
    font-family: 'Inter', sans-serif;
    background: radial-gradient(circle at top, #111 0%, #0a0a0a 100%);
}


.glass {
    background: rgba(255,255,255,0.04);
    backdrop-filter: blur(18px);
    border: 1px solid rgba(255,255,255,0.08);
}

.glow:hover {
    box-shadow: 0 0 25px rgba(0,255,200,0.15);
    transform: translateY(-5px) scale(1.01);
}

.cyan {
    color: #00f5d4;
}
</style>
</head>

<body class="text-gray-200 p-10">

<div class="max-w-6xl mx-auto">

    <div class="flex justify-between items-end mb-10">
        <div>
            <h1 class="text-3xl font-bold text-white">🏥 Patient Management System</h1>
            <p class="text-gray-400">Structured Health Records & Appointments</p>
        </div>
        
        @if(auth()->user()->role === 'admin')
        <a href="{{ route('patients.create') }}" class="glass px-6 py-2 rounded-xl border-cyan-400/30 text-cyan-300 hover:bg-cyan-400/10 transition flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add New Patient
        </a>
        @endif
    </div>

    @foreach($patients as $patient)
    <div class="glass glow rounded-2xl mb-8 overflow-hidden transition duration-300">

        <div class="flex justify-between items-center p-6 border-b border-white/10 bg-gradient-to-r from-cyan-400/10 to-transparent">
            <div>
                <h3 class="text-xl font-bold text-white">{{ $patient->name }}</h3>
                <p class="text-gray-400 text-sm">Patient ID: #00{{ $patient->id }}</p>
            </div>

            <div class="flex items-center gap-6">
                <div class="text-right">
                    <span class="px-4 py-1 rounded-full border border-cyan-400/30 text-cyan-300 text-sm">
                        {{ $patient->gender }}
                    </span>
                    <p class="text-sm text-gray-400 mt-1">📅 {{ $patient->birth_date }}</p>
                </div>

                @if(auth()->user()->role === 'admin')
                <div class="flex gap-2 border-l border-white/10 pl-6">
                    <a href="{{ route('patients.edit', $patient->id) }}" 
                       class="p-2 rounded-lg bg-white/5 hover:bg-cyan-400/20 text-cyan-300 transition border border-white/10" title="Edit Patient">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </a>

                    <button type="button" 
                            onclick="openDeleteModal('{{ route('patients.destroy', $patient->id) }}')" 
                            class="p-2 rounded-lg bg-white/5 hover:bg-red-500/20 text-red-400 transition border border-white/10" 
                            title="Delete Patient">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </div>
                @endif
            </div>
        </div>

        <div class="p-6 grid md:grid-cols-3 gap-6">

            <div class="glass p-5 rounded-xl border-white/10 hover:border-cyan-400/30 transition">
                <h6 class="text-xs uppercase tracking-widest cyan mb-4">📋 Medical Record</h6>

                <p class="text-gray-400 text-sm">Blood Type</p>
                <span class="inline-block px-3 py-1 mt-1 mb-3 rounded-full border border-cyan-400/30 text-cyan-300 text-sm">
                    {{ $patient->medicalRecord->blood_type ?? 'N/A' }}
                </span>

                <p class="text-cyan-300 text-sm font-semibold">Allergies:</p>
                <p class="text-white text-sm mb-2">{{ $patient->medicalRecord->allergies ?? 'None' }}</p>

                <p class="text-cyan-300 text-sm font-semibold">Chronic Conditions:</p>
                <p class="text-white text-sm">{{ $patient->medicalRecord->chronic_conditions ?? 'None' }}</p>
            </div>

            <div class="glass p-5 rounded-xl border-white/10 hover:border-cyan-400/30 transition">
                <h6 class="text-xs uppercase tracking-widest cyan mb-4">💊 Prescriptions</h6>

                @forelse($patient->prescriptions as $prescription)
                    <div class="border-b border-white/10 pb-2 mb-2">
                        <p class="font-semibold text-white">{{ $prescription->medication_name }}</p>
                        <p class="text-sm text-gray-400">Dosage: {{ $prescription->dosage }}</p>
                        <p class="text-sm text-gray-400">
                            Issued: {{ date('M d, Y', strtotime($prescription->date_issued)) }}
                        </p>
                    </div>
                @empty
                    <p class="text-gray-400 text-sm">No active prescriptions.</p>
                @endforelse
            </div>

            <div class="glass p-5 rounded-xl border-white/10 hover:border-cyan-400/30 transition">
                <h6 class="text-xs uppercase tracking-widest cyan mb-4">📅 Appointments</h6>

                @forelse($patient->appointments as $appointment)
                    <div class="mb-3 p-3 rounded-lg border border-cyan-400/20 bg-cyan-400/5 hover:shadow-lg transition">
                        <span class="px-3 py-1 text-xs rounded-full border border-cyan-400/30 text-cyan-300">
                            {{ $appointment->status }}
                        </span>

                        <p class="text-white font-semibold mt-2">
                            Dr. {{ $appointment->doctor->name ?? 'Unknown' }}
                        </p>

                        <p class="text-gray-400 text-sm">
                            {{ $appointment->doctor->specialization ?? 'General' }}
                        </p>

                        <p class="text-cyan-300 text-sm">
                            📅 {{ date('F d, Y h:i A', strtotime($appointment->appointment_date)) }}
                        </p>

                        <hr class="border-white/10 my-2">

                        <p class="text-sm text-white">
                            <strong class="text-cyan-300">Reason:</strong>
                            {{ $appointment->reason_for_visit }}
                        </p>
                    </div>
                @empty
                    <p class="text-gray-400 text-sm">No upcoming appointments.</p>
                @endforelse
            </div>

        </div>
    </div>
    @endforeach

</div>

@if(session('success'))
    <div id="toast" class="fixed top-5 right-5 z-50 flex items-center w-full max-w-xs p-4 rounded-2xl glass shadow-2xl transition-all duration-500 transform translate-y-0" style="border-left: 4px solid #00f5d4;">
        <div class="flex-shrink-0">
            <svg class="w-6 h-6 cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        <div class="ml-3 text-sm font-semibold text-white">
            {{ session('success') }}
        </div>
        <button type="button" onclick="document.getElementById('toast').remove()" class="ml-auto text-gray-400 hover:text-white transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <script>
        setTimeout(() => {
            const toast = document.getElementById('toast');
            if(toast) {
                toast.style.opacity = '0';
                toast.style.transform = 'translateY(-20px)';
                setTimeout(() => toast.remove(), 500);
            }
        }, 3000);
    </script>
@endif

<div id="deleteModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm">
    <div class="glass max-w-sm w-full p-8 rounded-3xl shadow-2xl border border-white/10 transform transition-all">
        <div class="text-center">
            <div class="w-16 h-16 bg-red-500/20 rounded-full flex items-center justify-center mx-auto mb-4 border border-red-500/30">
                <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-white mb-2">Confirm Delete</h3>
            <p class="text-gray-400 text-sm mb-8">Permanent Removal: Are you certain you wish to delete this patient record? Data recovery is not possible once confirmed.</p>
            
            <div class="flex gap-3">
                <button onclick="closeDeleteModal()" class="flex-1 py-3 rounded-xl bg-white/5 hover:bg-white/10 text-white font-semibold transition">
                    Cancel
                </button>
                <form id="deleteForm" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full py-3 rounded-xl bg-red-500 hover:bg-red-600 text-white font-semibold shadow-lg shadow-red-500/20 transition">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function openDeleteModal(actionUrl) {
        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');
        
      
        form.action = actionUrl;
        
        
        modal.classList.remove('hidden');
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        modal.classList.add('hidden');
    }

  
    window.onclick = function(event) {
        const modal = document.getElementById('deleteModal');
        if (event.target == modal) {
            closeDeleteModal();
        }
    }
</script>

</body>
</html>