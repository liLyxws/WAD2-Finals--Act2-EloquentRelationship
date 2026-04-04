<?php

use Illuminate\Support\Facades\Route;
// use App\Models\Patient;
use App\Http\Controllers\PatientController;


Route::get('/', function () {
    return view('welcome');
});

    
Route::get('/test', [PatientController::class, 'index']);