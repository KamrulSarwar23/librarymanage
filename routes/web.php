<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.layout');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::get('/admin/login', [AdminAuthController::class, 'adminLogin'])->name('admin.login');

Route::post('/admin/login', [AdminAuthController::class, 'adminLoginSubmit'])->name('admin-login.submit');

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('profile', [AdminAuthController::class, 'index'])->name('admin.profile');
    Route::put('profile', [AdminAuthController::class, 'updateProfile'])->name('admin.profile.update');
    Route::post('profile', [AdminAuthController::class, 'updatePassword'])->name('admin.password.update');
    
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [DashboardController::class, 'userDashboard'])->name('user.dashboard');
    
});






require __DIR__.'/auth.php';
