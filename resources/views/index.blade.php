<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/dist/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); 
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            padding: 40px 0;
        }
        .main-title {
            color: #2d3436;
            font-weight: 700;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }
        .patient-card {
            background: white;
            border-radius: 15px;
            border: none;
            transition: transform 0.2s;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }
        .patient-card:hover {
            transform: translateY(-5px);
        }
        .card-header-custom {
            background: #4834d4;
            color: white;
            padding: 1.5rem;
            border: none;
        }
        .section-title {
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
            color: #6c5ce7;
            margin-bottom: 15px;
            display: block;
        }
        .info-box {
            background: #f9f9ff;
            border-radius: 10px;
            padding: 15px;
            height: 100%;
            border: 1px solid #edf2f7;
        }
        .badge-custom {
            padding: 6px 12px;
            border-radius: 50px;
            font-weight: 600;
        }
        .doctor-name { color: #2d3436; font-weight: 700; }
        .date-text { color: #0984e3; font-weight: 600; }
    </style>
</head>
<body>

<div class="container">
    <div class="text-center mb-5">
        <h1 class="main-title">🏥 Patient Management System</h1>
        <p class="text-muted">Structured Health Records & Appointments</p>
    </div>

    @foreach($patients as $patient)
    <div class="card patient-card">
        <div class="card-header-custom d-flex justify-content-between align-items-center">
            <div>
                <h3 class="mb-0 fw-bold">{{ $patient->name }}</h3>
                <small class="opacity-75">Patient ID: #00{{ $patient->id }}</small>
            </div>
            <div class="text-end">
                <span class="badge bg-light text-dark badge-custom">{{ $patient->gender }}</span>
                <div class="small mt-1">📅 {{ $patient->birth_date }}</div>
            </div>
        </div>
        <div class="card-body p-4">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="info-box">
                        <span class="section-title">📋 Medical Record</span>
                        <div class="d-flex align-items-center mb-3">
                            <div class="me-3">
                                <small class="text-muted d-block">Blood Type</small>
                                <span class="badge bg-danger badge-custom">{{ $patient->medicalRecord->blood_type ?? 'N/A' }}</span>
                            </div>
                        </div>
                        <p class="mb-1 text-dark"><strong>Allergies:</strong></p>
                        <p class="text-muted small">{{ $patient->medicalRecord->allergies ?? 'None' }}</p>
                        <p class="mb-1 text-dark"><strong>Chronic Conditions:</strong></p>
                        <p class="text-muted small">{{ $patient->medicalRecord->chronic_conditions ?? 'None' }}</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="info-box" style="background-color: #fff9f0;">
                        <span class="section-title" style="color: #e67e22;">💊 Prescriptions</span>
                        @forelse($patient->prescriptions as $prescription)
                            <div class="mb-3 border-bottom pb-2">
                                <div class="fw-bold text-dark">{{ $prescription->medication_name }}</div>
                                <div class="small text-muted">Dosage: {{ $prescription->dosage }}</div>
                                <div class="small text-muted italic">Issued: {{ date('M d, Y', strtotime($prescription->date_issued)) }}</div>
                            </div>
                        @empty
                            <p class="text-muted small italic">No active prescriptions.</p>
                        @endforelse
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="info-box" style="background-color: #f0fff4;">
                        <span class="section-title" style="color: #27ae60;">📅 Appointments</span>
                        @forelse($patient->appointments as $appointment)
                            <div class="p-2 rounded border border-success border-opacity-10">
                                <span class="badge bg-success badge-custom mb-2" style="font-size: 0.7rem;">{{ $appointment->status }}</span>
                                <div class="doctor-name">Dr. {{ $appointment->doctor->name }}</div>
                                <div class="small text-muted mb-1">{{ $appointment->doctor->specialization }}</div>
                                <div class="date-text small">📅 {{ date('F d, Y h:i A', strtotime($appointment->appointment_date)) }}</div>
                                <hr class="my-2">
                                <div class="small"><strong>Reason:</strong> {{ $appointment->reason_for_visit }}</div>
                            </div>
                        @empty
                            <p class="text-muted small italic">No upcoming appointments.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

</body>
</html>