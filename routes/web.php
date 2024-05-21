<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::get('/admin/login', [AdminAuthController::class, 'adminLogin'])->name('admin.login');

Route::post('/admin/login', [AdminAuthController::class, 'adminLoginSubmit'])->name('admin-login.submit');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');

    // Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    // Route::put('profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    // Route::post('profile', [ProfileController::class, 'updatePassword'])->name('profile.update.password');
    
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [DashboardController::class, 'userDashboard'])->name('user.dashboard');
    // Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    // Route::put('profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    // Route::post('profile', [ProfileController::class, 'updatePassword'])->name('profile.update.password');
    
});






require __DIR__.'/auth.php';
