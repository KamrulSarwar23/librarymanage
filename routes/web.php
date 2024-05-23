<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('frontend.index');
})->name('home.page');


Route::get('/admin/login', [AdminAuthController::class, 'adminLogin'])->name('admin.login');

Route::post('/admin/login', [AdminAuthController::class, 'adminLoginSubmit'])->name('admin-login.submit');

Route::get('/about', [PageController::class, 'about'])->name('about.page');
Route::get('/blog', [PageController::class, 'blog'])->name('blog.page');
Route::get('/contact', [PageController::class, 'contact'])->name('contact.page');
Route::get('/services', [PageController::class, 'services'])->name('services.page');


Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('//admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::post('/admin/logout', [AdminAuthController::class, 'adminDestroy'])->name('admin.logout');

    // Profile Routes
    Route::get('/profile', [AdminAuthController::class, 'index'])->name('admin.profile');
    Route::put('/profile', [AdminAuthController::class, 'updateProfile'])->name('admin.profile.update');
    Route::post('/profile', [AdminAuthController::class, 'updatePassword'])->name('admin.password.update');

    // Category Routes
    Route::resource('category', CategoryController::class);

    // Publisher Routes
    Route::resource('publisher', PublisherController::class);

    // Author Routes
    Route::resource('author', AuthorController::class);

    // Book Routes
    Route::resource('book', BookController::class);

    // User Routes
    Route::resource('user-manage', UserController::class);
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [DashboardController::class, 'userDashboard'])->name('user.dashboard');
});



require __DIR__ . '/auth.php';
