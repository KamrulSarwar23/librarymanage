<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AssignRoleController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookBorrowController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookInventoryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OfflineBookBorrowController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\QuantityController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPolicyController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';


Route::get('/', [PageController::class, 'index'])->name('home.page');

Route::get('all-books', [PageController::class, 'allBook'])->name('all.books');

Route::get('/admin/login', [AdminAuthController::class, 'adminLogin'])->name('admin.login');

Route::post('/admin/login', [AdminAuthController::class, 'adminLoginSubmit'])->name('admin-login.submit');

Route::get('/contact', [ContactController::class, 'contact'])->name('contact.page');

Route::get('/user-policy', [PageController::class, 'policy'])->name('policy.page');

Route::post('/send-message', [ContactController::class, 'sendMessage'])->name('send.message');

Route::get('/books-details/{id}', [PageController::class, 'bookDetails'])->name('book.details');

Route::get('/books-search', [PageController::class, 'bookSearch'])->name('book.search');

Route::get('/books/by-category/{id}', [PageController::class, 'filterByCategory'])->name('book.by-category');

Route::get('/books/by-author/{id}', [PageController::class, 'filterByAuthor'])->name('book.by-author');

Route::get('/books/by-publisher/{id}', [PageController::class, 'filterByPublisher'])->name('book.by-publisher');



Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {

    // Role & Permission
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions')->middleware('permission:Role Permission');
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create')->middleware('permission:Role Permission');
    Route::post('/permissions/store', [PermissionController::class, 'store'])->name('permissions.store')->middleware('permission:Role Permission');
    Route::get('/permissions/edit/{id}', [PermissionController::class, 'edit'])->name('permissions.edit')->middleware('permission:Role Permission');
    Route::put('/permissions/update/{id}', [PermissionController::class, 'update'])->name('permissions.update')->middleware('permission:Role Permission');
    Route::get('/permissions/delete/{id}', [PermissionController::class, 'destroy'])->name('permissions.delete')->middleware('permission:Role Permission');


    Route::get('/roles', [RoleController::class, 'index'])->name('roles')->middleware('permission:Role Permission');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create')->middleware('permission:Role Permission');
    Route::post('/roles/store', [RoleController::class, 'store'])->name('roles.store')->middleware('permission:Role Permission');
    Route::get('/roles/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit')->middleware('permission:Role Permission');
    Route::put('/roles/update/{id}', [RoleController::class, 'update'])->name('roles.update')->middleware('permission:Role Permission');
    Route::get('/roles/delete/{id}', [RoleController::class, 'destroy'])->name('roles.delete')->middleware('permission:Role Permission');


    Route::get('/users', [AssignRoleController::class, 'index'])->name('users')->middleware('permission:Role Permission');
    Route::get('/users/create', [AssignRoleController::class, 'create'])->name('users.create')->middleware('permission:Role Permission');
    Route::post('/users/store', [AssignRoleController::class, 'store'])->name('users.store')->middleware('permission:Role Permission');
    Route::get('/users/edit/{id}', [AssignRoleController::class, 'edit'])->name('users.edit')->middleware('permission:Role Permission');
    Route::put('/users/update/{id}', [AssignRoleController::class, 'update'])->name('users.update')->middleware('permission:Role Permission');
    Route::get('/users/delete/{id}', [AssignRoleController::class, 'destroy'])->name('users.delete')->middleware('permission:Role Permission');


    // Dashboard Routes
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard')->middleware('permission:Dashboard');
    Route::post('/logout', [AdminAuthController::class, 'adminDestroy'])->name('admin.logout')->middleware('permission:Dashboard');

    // Profile Routes
    Route::get('/profile', [AdminAuthController::class, 'index'])->name('admin.profile')->middleware('permission:Profile');
    Route::put('/profile', [AdminAuthController::class, 'updateProfile'])->name('admin.profile.update')->middleware('permission:Profile');
    Route::post('/profile', [AdminAuthController::class, 'updatePassword'])->name('admin.password.update')->middleware('permission:Profile');

    // Category Routes
    Route::get('/active-category', [CategoryController::class, 'activeCategory'])->name('active.category')->middleware('permission:Category');
    Route::get('/pending-category', [CategoryController::class, 'pendingCategory'])->name('pending.category')->middleware('permission:Category');
    Route::put('/category/status', [CategoryController::class, 'changeStatus'])->name('category.status')->middleware('permission:Category');
    Route::resource('category', CategoryController::class)->middleware('permission:Category');

    // Publisher Routes
    Route::get('/active-publishers', [PublisherController::class, 'activePublisher'])->name('active.publisher')->middleware('permission:Publisher');
    Route::get('/pending-publishers', [PublisherController::class, 'pendingPublisher'])->name('pending.publisher')->middleware('permission:Publisher');
    Route::put('/publisher/status', [PublisherController::class, 'changeStatus'])->name('publisher.status')->middleware('permission:Publisher');
    Route::resource('publisher', PublisherController::class)->middleware('permission:Publisher');

    // Author Routes
    Route::get('/active-author', [AuthorController::class, 'activeAuthor'])->name('active.author')->middleware('permission:Author');
    Route::get('/pending-author', [AuthorController::class, 'pendingAuthor'])->name('pending.author')->middleware('permission:Author');
    Route::put('/author/status', [AuthorController::class, 'changeStatus'])->name('author.status')->middleware('permission:Author');
    Route::resource('author', AuthorController::class)->middleware('permission:Author');


    // Book Routes
    Route::get('/books/filterByType', [BookController::class, 'filterByType'])->name('books.filterByType')->middleware('permission:Book');
    Route::get('/books/filterByDate', [BookController::class, 'filterByDate'])->name('books.filterByDate')->middleware('permission:Book');
    Route::put('/book/type/change', [BookController::class, 'changeType'])->name('book.type.change')->middleware('permission:Book');
    Route::put('/book/preview/change', [BookController::class, 'changePreview'])->name('book.preview.change')->middleware('permission:Book');
    Route::get('/active-books', [BookController::class, 'activeBook'])->name('active.book')->middleware('permission:Book');
    Route::get('/inactive-books', [BookController::class, 'inactiveBook'])->name('inactive.book')->middleware('permission:Book');
    Route::get('/books/search-by-query', [BookController::class, 'bookSearch'])->name('books.search-by-query')->middleware('permission:Book');
    Route::get('/books/by-category/{id}', [BookController::class, 'filterByCategory'])->name('admin.book-by-category')->middleware('permission:Book');
    Route::get('/books/by-author/{id}', [BookController::class, 'filterByAuthor'])->name('admin.book-by-author')->middleware('permission:Book');

    Route::get('/books/by-publisher/{id}', [BookController::class, 'filterByPublisher'])->name('admin.book-by-publisher')->middleware('permission:Book');
    Route::get('/books/by-publisher/{id}', [BookController::class, 'filterByPublisher'])->name('admin.book-by-publisher')->middleware('permission:Book');

    Route::resource('book', BookController::class)->middleware('permission:Book');

    // Review Routes
    Route::get('/book-reviews', [ReviewController::class, 'bookReview'])->name('admin.book-review')->middleware('permission:Review');
    Route::put('/book-reviews/status', [ReviewController::class, 'bookReviewStatus'])->name('book-reviews.status')->middleware('permission:Review');
    Route::delete('/book-reviews/delete/{id}', [ReviewController::class, 'destroy'])->name('book-reviews.delete')->middleware('permission:Review');
    Route::get('/active-review', [ReviewController::class, 'activeReview'])->name('active.review')->middleware('permission:Review');
    Route::get('/pending-review', [ReviewController::class, 'pendingReview'])->name('pending.review')->middleware('permission:Review');

  


    // Book Borrow offline
    Route::get('/ajax-books', [OfflineBookBorrowController::class, 'getBooks'])->name('ajax.books')->middleware('permission:Offline Book Borrow');
    Route::get('/ajax-users', [OfflineBookBorrowController::class, 'getUsers'])->name('ajax.users')->middleware('permission:Offline Book Borrow');
    Route::get('/book/offline-borrow/system', [OfflineBookBorrowController::class, 'index'])->name('offline-book-borrow')->middleware('permission:Offline Book Borrow');


    Route::post('/book/offline-borrow/system/submit', [OfflineBookBorrowController::class, 'store'])->name('offline-book-borrow-store')->middleware('permission:Offline Book Borrow');
    Route::get('online/book/borrow/search', [OfflineBookBorrowController::class, 'offlineBorrowBookSearch'])->name('offline-book-borrow-search')->middleware('permission:Offline Book Borrow');
    Route::get('borrow-book-details/{id}', [OfflineBookBorrowController::class, 'borrowDetails'])->name('borrow-book-details')->middleware('permission:Offline Book Borrow');
    Route::put('/offline-book-borrow/update-info/{id}', [OfflineBookBorrowController::class, 'updateOfflineInfo'])->name('book-borrow.updateOfflineInfo')->middleware('permission:Offline Book Borrow');
    


    // Book Borrow online
    Route::get('online-borrow-book-details/{id}', [BookBorrowController::class, 'onLineborrowDetails'])->name('online-borrow-book-details')->middleware('permission:Online Book Borrow');
    Route::get('/book-borrow', [BookBorrowController::class, 'index'])->name('book.borrowinfo')->middleware('permission:Online Book Borrow');
    Route::put('/book-borrow/update-info/{id}', [BookBorrowController::class, 'updateInfo'])->name('book-borrow.updateInfo')->middleware('permission:Online Book Borrow');
    Route::get('offline/book/borrow/search', [BookBorrowController::class, 'borrowBookSearch'])->name('book.borrow-search')->middleware('permission:Online Book Borrow');

    // User Routes
    Route::put('/user/status', [UserController::class, 'changeStatus'])->name('user.status')->middleware('permission:User');
    Route::resource('user-manage', UserController::class)->middleware('permission:User')->middleware('permission:User');
    Route::delete('/user/destroy/{id}', [MessageController::class, 'destroy'])->name('user.destroy')->middleware('permission:User');

    // Message Routes
    Route::get('/messages', [MessageController::class, 'index'])->name('message.index')->middleware('permission:Message');
    Route::delete('/messages/destroy/{id}', [MessageController::class, 'destroy'])->name('message.destroy')->middleware('permission:Message');

    //  books quantity Manage
    Route::get('/book/{bookId}/quantity', [QuantityController::class, 'index'])->name('quantity.index')->middleware('permission:Book');
    Route::put('/book/{bookId}/quantity/status', [QuantityController::class, 'changeStatus'])->name('quantity.status')->middleware('permission:Book');
    Route::post('/book/add_quantity', [QuantityController::class, 'store'])->name('quantity.store')->middleware('permission:Book');
    Route::delete('/book/quantity/{quantityId}', [QuantityController::class, 'destroy'])->name('quantity.delete')->middleware('permission:Book');

    // Reader by books
    Route::get('/book/{bookId}/readers', [BookInventoryController::class, 'index'])->name('readers.index')->middleware('permission:Book');

    // reports route
    Route::get('/report', [ReportController::class, 'report'])->name('report')->middleware('permission:Report');
    Route::post('/generate-report', [ReportController::class, 'generateReport'])->name('generate.report')->middleware('permission:Report');

    //User Policy
    Route::get('/user-policy', [UserPolicyController::class, 'create'])->name('user-policy.create')->middleware('permission:Policy');
    Route::post('/user-policy', [UserPolicyController::class, 'store'])->name('user-policy.store')->middleware('permission:Policy');
});



Route::prefix('user')->middleware(['auth', 'role:user'])->group(function () {

    // Dashboard Routes
    Route::get('/dashboard', [DashboardController::class, 'userDashboard'])->name('user.dashboard');

    // Profile Routes
    Route::put('profile', [UserController::class, 'updateProfile'])->name('user.profile.update');
    Route::post('profile', [UserController::class, 'updatePassword'])->name('user.password.update');

    // Review Route
    Route::post('/send-review', [ReviewController::class, 'sendReview'])->name('send.review');

    Route::get('user-borrow-book-details/{id}', [UserController::class, 'userborrowDetails'])->name('user-borrow-book-details');

    // Book Borrow Route
    Route::post('/book/borrow', [PageController::class, 'borrowBook'])->name('book.borrow');
});
