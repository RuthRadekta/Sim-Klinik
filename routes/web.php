<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

// Route bawaan Laravel
Route::get('/', function () {
    return view('auth.login');
});

// Routes untuk pasien dan janji temu
Route::get('/patients', [PatientController::class, 'index']);
Route::get('/appointments/create', [AppointmentController::class, 'create']);
Route::post('/appointments', [AppointmentController::class, 'store']);

// Routes untuk dokter
Route::get('/doctor/dashboard', [DoctorController::class, 'dashboard']);
Route::get('/doctor/examine/{id}', [MedicalRecordController::class, 'create']);
Route::post('/doctor/examine/{id}', [MedicalRecordController::class, 'store']);
Route::get('/doctor/history', [DoctorController::class, 'history']);

// Routes untuk kasir
Route::get('/cashier', [TransactionController::class, 'index']);
Route::get('/cashier/invoice/{id}', [TransactionController::class, 'invoice']);
Route::post('/cashier/pay/{id}', [TransactionController::class, 'pay']);

// Routes untuk autentikasi
Route::get('/', function () { return view('auth.login'); })->name('login');
Route::post('/login-proses', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout']);

// Route Dashboard Admin
Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);