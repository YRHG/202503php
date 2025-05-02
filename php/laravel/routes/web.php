<?php

use app\Http\Controllers\AlbertController;
use app\Http\Controllers\IndexController;
use app\Http\Controllers\SessionsController;
use app\Http\Controllers\TestsController;
use app\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/welcome', [TestsController::class, 'index'])->name('test.index');
Route::get('/login', [TestsController::class, 'login'])->name('test.login');
Route::get('/WelcomeAlbert', [AlbertController::class, 'index'])->name('albert.index');
Route::get('/login', [AlbertController::class, 'login'])->name('albert.login');

//home page of the application
Route::get('/', [IndexController::class, 'home'])->name('home');

// Show the login form
Route::get('/', [\app\Http\Controllers\SessionsController::class, 'create'])->name('login');

// Login the user
Route::post('/login', [SessionsController::class, 'store'])->name('login.store');

// Logout the user
Route::post('/logout', [SessionsController::class, 'destroy'])->name('logout');

// Show the registration form
Route::get('/register', [UsersController::class, 'create'])->name('register');

// Register the user
Route::post('/register', [UsersController::class, 'store'])->name('register.store');

// Show the user profile
Route::get('/users/{id?}', [UsersController::class, 'show'])->name('users.show');
