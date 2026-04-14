<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient; 

class PatientController extends Controller
{
    
    public function index()
    {
        $patients = Patient::with(['medicalRecord', 'prescriptions', 'appointments.doctor'])->get();
        return view('index', compact('patients'));
    }

  
    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients.index')->with('success', 'Patient deleted successfully.');
    }

    
    public function edit(Patient $patient)
    {
        
        return view('edit', compact('patient'));
    }

    
    public function update(Request $request, Patient $patient)
    {
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required',
            'birth_date' => 'required|date',
        ]);

      
        $patient->update($validated);

       
        return redirect()->route('patients.index')->with('success', 'Patient updated successfully!');
    }

    
    
    public function create()
    {
        return view('create');
    }

   
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required',
            'birth_date' => 'required|date',
        ]);

        
        Patient::create($validated);

        return redirect()->route('patients.index')->with('success', 'New patient added!');
    }
}