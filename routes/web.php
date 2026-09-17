<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AdminDoctorController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\ResepsionisController;

// Route bawaan Laravel
Route::get('/', function () {
    return view('auth.login');
});

// Routes untuk pasien dan janji temu
Route::get('/patients', [PatientController::class, 'index']);
Route::get('/patients/create', [PatientController::class, 'create']);
Route::post('/patients', [PatientController::class, 'store']);
Route::get('/patients/{id}', [PatientController::class, 'show']);
Route::get('/patients/{id}/edit', [PatientController::class, 'edit']);
Route::put('/patients/{id}', [PatientController::class, 'update']);
Route::delete('/patients/{id}', [PatientController::class, 'destroy']);
Route::get('/patients/export', [PatientController::class, 'export']);

// Routes untuk menambahkan appointment pasien - dokter
Route::get('/appointments/create', [AppointmentController::class, 'create']);
Route::post('/appointments', [AppointmentController::class, 'store']);

// Routes untuk resepsionis
Route::get('/resepsionis/dashboard', [ResepsionisController::class, 'dashboard']);

// Routes untuk dokter
Route::get('/doctor/dashboard', [DoctorController::class, 'dashboard']);
Route::get('/doctor/examine/{id}', [MedicalRecordController::class, 'create']);
Route::post('/doctor/examine/{id}', [MedicalRecordController::class, 'store']);
Route::get('/doctor/history', [DoctorController::class, 'history']);
Route::get('/doctor/profile', [DoctorController::class, 'profile']);
Route::get('/doctors/export', [AdminDoctorController::class, 'export']);

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
Route::get('/admin/employees', [EmployeeController::class, 'index']);

// Routes untuk manajemen karyawan
Route::get('/admin/employees/create', [EmployeeController::class, 'create']);
Route::post('/admin/employees', [EmployeeController::class, 'store']);
Route::get('/admin/employees/{id}/edit', [EmployeeController::class, 'edit']);
Route::put('/admin/employees/{id}', [EmployeeController::class, 'update']);
Route::delete('/admin/employees/{id}', [EmployeeController::class, 'destroy']);

// Routes untuk manajemen dokter
Route::get('/admin/doctors', [AdminDoctorController::class, 'index']);
Route::get('/admin/doctors/create', [AdminDoctorController::class, 'create']);
Route::post('/admin/doctors', [AdminDoctorController::class, 'store']);
Route::get('/admin/doctors/{id}/edit', [AdminDoctorController::class, 'edit']);
Route::put('/admin/doctors/{id}', [AdminDoctorController::class, 'update']);
Route::delete('/admin/doctors/{id}', [AdminDoctorController::class, 'destroy']);

// Routes untuk manajemen ruang
Route::get('/rooms', [RoomController::class, 'index']);
Route::get('/rooms/create', [RoomController::class, 'create']);
Route::post('/rooms', [RoomController::class, 'store']);
Route::get('/rooms/{id}/edit', [RoomController::class, 'edit']);
Route::put('/rooms/{id}', [RoomController::class, 'update']);
Route::delete('/rooms/{id}', [RoomController::class, 'destroy']);
Route::get('/rooms/export', [RoomController::class, 'export']);

// Routes untuk manajemen obat
Route::get('/medicines', [MedicineController::class, 'index']);
Route::get('/medicines/create', [MedicineController::class, 'create']);
Route::post('/medicines', [MedicineController::class, 'store']);
Route::get('/medicines/{id}/edit', [MedicineController::class, 'edit']);
Route::put('/medicines/{id}', [MedicineController::class, 'update']);
Route::delete('/medicines/{id}', [MedicineController::class, 'destroy']);
Route::get('/medicines/export', [MedicineController::class, 'export']);
