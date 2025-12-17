<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;

// Redirect Home to Login
Route::get('/', function () {
    return redirect('/login');
});

// --- Authentication Routes ---
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// --- Client Routes (Booking & History) ---
Route::get('/book', [AppointmentController::class, 'create']);
Route::post('/book', [AppointmentController::class, 'store']); // This is where the form sends data
Route::get('/my-appointments', [AppointmentController::class, 'clientDashboard']); // This is where it redirects after

Route::post('/appointments/{id}/cancel', [AppointmentController::class, 'cancel']);

// --- Staff Routes (Dashboard) ---
Route::get('/appointments', [AppointmentController::class, 'index']);
Route::post('/appointments/{id}/status', [AppointmentController::class, 'updateStatus']);
Route::post('/appointments/{id}/note', [AppointmentController::class, 'saveNote']);
Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy']);