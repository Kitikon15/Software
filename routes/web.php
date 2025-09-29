<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/admission', function () {
    return view('admission');
})->name('admission');

Route::get('/system', [AuthController::class, 'showSystem'])->name('system');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin login routes
Route::get('/admin/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login.post');
Route::post('/admin/logout', [AuthController::class, 'adminLogout'])->name('admin.logout');

// Demo route to show test credentials
Route::get('/test-credentials', [AuthController::class, 'createTestCredentials'])->name('test.credentials');

Route::get('/forgot', function () {
    return view('forgot');
})->name('forgot');

Route::get('/web', function () {
    return view('web');
})->name('web');

// Route สำหรับการส่งข้อมูลจากฟอร์ม
Route::post('/register-applicant', [ApplicantController::class, 'store'])->name('register.applicant');

Route::get('/registration/success', function () {
    return view('registration_success');
})->name('registration.success');

// Admin routes (protected by middleware in a real application)
Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/applicant/create', [AdminController::class, 'create'])->name('admin.applicant.create');
Route::post('/admin/applicant', [AdminController::class, 'store'])->name('admin.applicant.store');
Route::get('/admin/applicant/{id}/edit', [AdminController::class, 'edit'])->name('admin.applicant.edit');
Route::put('/admin/applicant/{id}', [AdminController::class, 'update'])->name('admin.applicant.update');
Route::get('/admin/applicant/{id}', [AdminController::class, 'show'])->name('admin.applicant.show');
Route::post('/admin/applicant/{id}/update-image', [AdminController::class, 'updateImage'])->name('admin.applicant.update.image');
Route::delete('/admin/applicant/{id}', [AdminController::class, 'destroy'])->name('admin.applicant.destroy');
Route::get('/admin/export', [AdminController::class, 'export'])->name('admin.export');