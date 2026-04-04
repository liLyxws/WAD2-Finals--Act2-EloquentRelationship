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
}