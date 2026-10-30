<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BorrowingController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.post');

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.post');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('books', BookController::class);
    Route::resource('categories', CategoryController::class);

    Route::get('/borrowings', [BorrowingController::class, 'index'])
        ->name('borrowings.index');

    Route::post('/books/{book}/borrow', [BorrowingController::class, 'store'])
        ->name('borrowings.store');

    Route::patch('/borrowings/{borrowing}/approve', [BorrowingController::class, 'approve'])
        ->name('borrowings.approve');

    Route::patch('/borrowings/{borrowing}/reject', [BorrowingController::class, 'reject'])
        ->name('borrowings.reject');

    Route::patch('/borrowings/{borrowing}/return', [BorrowingController::class, 'returnBook'])
        ->name('borrowings.return');
});