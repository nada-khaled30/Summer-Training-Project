<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\StudentLoginController;
use App\Http\Controllers\Auth\StudentRegisterController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Admin Routes
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function() {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Book routes
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');

    Route::get('/profile/{id}/edit', [AdminController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile/update/{id}', [AdminController::class, 'updateProfile'])->name('profile.update');
    
    // Student search and view routes
    Route::get('/student/search', [AdminController::class, 'searchStudent'])->name('student.search');
    Route::get('/student/view', [AdminController::class, 'viewStudent'])->name('student.view');
});

// Student Authentication and Registration Routes
Route::get('/student/login', [StudentLoginController::class, 'showLoginForm'])->name('student.login');
Route::post('/student/login', [StudentLoginController::class, 'login'])->name('student.login.submit');
Route::post('/student/logout', [StudentLoginController::class, 'logout'])->name('student.logout');

// Student Register
Route::get('/student/register', [StudentRegisterController::class, 'showRegisterForm'])->name('student.register');
Route::post('/student/register', [StudentRegisterController::class, 'register'])->name('student.register.submit');


// Student Routes
Route::middleware(['auth:student'])->prefix('student')->name('student.')->group(function() {
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
    Route::get('/books', [StudentController::class, 'viewBooks'])->name('books');
    Route::post('/books/borrow', [StudentController::class, 'borrowBook'])->name('books.borrow');
    Route::post('/books/return', [StudentController::class, 'returnBook'])->name('books.return');

    Route::get('/profile/{id}/edit', [StudentController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile/{id}', [StudentController::class, 'updateProfile'])->name('profile.update');
});


// Default Authentication Routes
Auth::routes();

Route::get('/home', [HomeController::class, 'welcomePage']);


Route::get('/', function() {
    return response('Goodbye', 200)
                ->header('Content-Type', 'text/plain');
});
