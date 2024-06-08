<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookBorrowController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\QuantityController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::get('/', [PageController::class, 'index'])->name('home.page');

Route::get('/all-books', [PageController::class, 'allBook'])->name('all.books');

Route::get('/admin/login', [AdminAuthController::class, 'adminLogin'])->name('admin.login');

Route::post('/admin/login', [AdminAuthController::class, 'adminLoginSubmit'])->name('admin-login.submit');

Route::get('/contact', [ContactController::class, 'contact'])->name('contact.page');

Route::post('/send-message', [ContactController::class, 'sendMessage'])->name('send.message');

Route::get('/books-details/{id}', [PageController::class, 'bookDetails'])->name('book.details');

Route::get('/books-search', [PageController::class, 'bookSearch'])->name('book.search');

Route::get('/books/by-category/{id}', [PageController::class, 'filterByCategory'])->name('book.by-category');

Route::get('/books/by-author/{id}', [PageController::class, 'filterByAuthor'])->name('book.by-author');

Route::get('/books/by-publisher/{id}', [PageController::class, 'filterByPublisher'])->name('book.by-publisher');



Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {

    // Dashboard Routes
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::post('/logout', [AdminAuthController::class, 'adminDestroy'])->name('admin.logout');

    // Profile Routes
    Route::get('/profile', [AdminAuthController::class, 'index'])->name('admin.profile');
    Route::put('/profile', [AdminAuthController::class, 'updateProfile'])->name('admin.profile.update');
    Route::post('/profile', [AdminAuthController::class, 'updatePassword'])->name('admin.password.update');

    // Category Routes
    Route::get('/active-category', [CategoryController::class, 'activeCategory'])->name('active.category');
    Route::get('/pending-category', [CategoryController::class, 'pendingCategory'])->name('pending.category');
    Route::put('/category/status', [CategoryController::class, 'changeStatus'])->name('category.status');
    Route::resource('category', CategoryController::class);


    // Publisher Routes
    Route::get('/active-publishers', [PublisherController::class, 'activePublisher'])->name('active.publisher');
    Route::get('/pending-publishers', [PublisherController::class, 'pendingPublisher'])->name('pending.publisher');
    Route::put('/publisher/status', [PublisherController::class, 'changeStatus'])->name('publisher.status');
    Route::resource('publisher', PublisherController::class);

    // Author Routes
    Route::get('/active-author', [AuthorController::class, 'activeAuthor'])->name('active.author');
    Route::get('/pending-author', [AuthorController::class, 'pendingAuthor'])->name('pending.author');
    Route::put('/author/status', [AuthorController::class, 'changeStatus'])->name('author.status');
    Route::resource('author', AuthorController::class);

    // Book Routes
    Route::get('/books/filterByType', [BookController::class, 'filterByType'])->name('books.filterByType');
    Route::get('/books/filterByDate', [BookController::class, 'filterByDate'])->name('books.filterByDate');
    Route::put('/book/type/change', [BookController::class, 'changeType'])->name('book.type.change');
    Route::put('/book/preview/change', [BookController::class, 'changePreview'])->name('book.preview.change');
    Route::get('/active-books', [BookController::class, 'activeBook'])->name('active.book');
    Route::get('/inactive-books', [BookController::class, 'inactiveBook'])->name('inactive.book');
    Route::get('/books/search-by-query', [BookController::class, 'bookSearch'])->name('books.search-by-query');
    Route::get('/books/by-category/{id}', [BookController::class, 'filterByCategory'])->name('admin.book-by-category');
    Route::get('/books/by-author/{id}', [BookController::class, 'filterByAuthor'])->name('admin.book-by-author');
    Route::get('/books/by-publisher/{id}', [BookController::class, 'filterByPublisher'])->name('admin.book-by-publisher');
    Route::get('/books/by-publisher/{id}', [BookController::class, 'filterByPublisher'])->name('admin.book-by-publisher');
    Route::get('/book-reviews', [ReviewController::class, 'bookReview'])->name('admin.book-review');
    Route::put('/book-reviews/status', [ReviewController::class, 'bookReviewStatus'])->name('book-reviews.status');
    Route::delete('/book-reviews/delete/{id}', [ReviewController::class, 'destroy'])->name('book-reviews.delete');
    Route::get('/active-review', [ReviewController::class, 'activeReview'])->name('active.review');
    Route::get('/pending-review', [ReviewController::class, 'pendingReview'])->name('pending.review');
    Route::resource('book', BookController::class);

    // Book Borrow
    Route::get('/book-borrow', [BookBorrowController::class, 'index'])->name('book.borrowinfo');
    // Route::put('/return-borrow/{id}', [BookBorrowController::class, 'returnBook'])->name('book.return');
    // Route::get('/book-borrow-edit/{id}', [BookBorrowController::class, 'edit'])->name('book-borrow.edit');
    Route::put('/book-borrow/update-info/{id}', [BookBorrowController::class, 'updateInfo'])->name('book-borrow.updateInfo');
    // Route::delete('/book/borrow/delete/{id}', [BookBorrowController::class, 'borrowBookDelete'])->name('book.borrow-delete');
    Route::get('/book/borrow/search', [BookBorrowController::class, 'borrowBookSearch'])->name('book.borrow-search');
    Route::get('/borrow-book-filter-by-status', [BookBorrowController::class, 'borrowBookFilterByStatus'])->name('borrow-book-filter-by-status');

    // User Routes
    Route::put('/user/status', [UserController::class, 'changeStatus'])->name('user.status');
    Route::resource('user-manage', UserController::class);
    Route::delete('/user/destroy/{id}', [MessageController::class, 'destroy'])->name('user.destroy');


    // Message Routes
    Route::get('/messages', [MessageController::class, 'index'])->name('message.index');
    Route::delete('/messages/destroy/{id}', [MessageController::class, 'destroy'])->name('message.destroy');


    //  ====== books quantity Manage =======
    Route::get('/book/{bookId}/quantity', [QuantityController::class, 'index'])->name('quantity.index');
    Route::put('/book/{bookId}/quantity/status', [QuantityController::class, 'changeStatus'])->name('quantity.status');
    Route::post('/book/add_quantity', [QuantityController::class, 'store'])->name('quantity.store');
    Route::delete('/book/quantity/{quantityId}', [QuantityController::class, 'destroy'])->name('quantity.delete');
});


Route::prefix('user')->middleware(['auth', 'role:user'])->group(function () {

    // Dashboard Routes
    Route::get('/dashboard', [DashboardController::class, 'userDashboard'])->name('user.dashboard');

    // Profile Routes
    Route::put('profile', [UserController::class, 'updateProfile'])->name('user.profile.update');
    Route::post('profile', [UserController::class, 'updatePassword'])->name('user.password.update');

    // Review Route
    Route::post('/send-review', [ReviewController::class, 'sendReview'])->name('send.review');

    // Book Borrow Route
    Route::post('/book/borrow', [PageController::class, 'borrowBook'])->name('book.borrow');
});
