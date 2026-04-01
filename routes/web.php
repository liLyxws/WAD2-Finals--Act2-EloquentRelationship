<?php

use Illuminate\Support\Facades\Route;
use App\Models\Patient;

Route::get('/', function () {
    return view('welcome');
});

git 
Route::get('/test', function () {
    return Patient::with(['medicalRecord', 'prescriptions', 'appointments.doctor'])->get();
});