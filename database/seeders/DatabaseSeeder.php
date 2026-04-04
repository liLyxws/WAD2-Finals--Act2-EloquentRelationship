<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\MedicalRecord;
use App\Models\Prescription;
use App\Models\Appointment;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Gumawa muna ng Doctors (kailangan sila para sa foreign key ng appointment)
        $doctors = Doctor::factory(5)->create();

        // 2. Gumawa ng Patients
        Patient::factory(10)->create()->each(function ($patient) use ($doctors) {
            
            // A. One-to-One: Medical Record
            // Siguraduhin na ang fields na 'to ay nasa migration mo
            $patient->medicalRecord()->create([
                'blood_type' => fake()->randomElement(['A+', 'B+', 'O+', 'AB-']),
                'allergies' => 'None',
                'chronic_conditions' => 'None',
            ]);

            // B. One-to-Many: Prescriptions
            $patient->prescriptions()->createMany([
                [
                    'medication_name' => 'Amoxicillin',
                    'dosage' => '500mg',
                    'date_issued' => now(),
                ]
            ]);

            // C. One-to-Many: Appointment (Ito ang nag-uugnay sa Patient at Doctor)
            $patient->appointments()->create([
                'doctor_id' => $doctors->random()->id, // Kumukuha ng random doctor ID
                'appointment_date' => now()->addDays(rand(1, 30)),
                'reason_for_visit' => 'Regular Checkup',
                'status' => 'Scheduled',
            ]);
        });
    }
}