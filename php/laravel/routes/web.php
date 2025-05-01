<?php

use App\Http\Controllers\AlbertController;
use App\Http\Controllers\TestsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/welcome', [TestsController::class, 'index'])->name('test.index');
Route::get('/login', [TestsController::class, 'login'])->name('test.login');
Route::get('/WelcomeAlbert', [AlbertController::class, 'index'])->name('albert.index');
Route::get('/login', [AlbertController::class, 'login'])->name('albert.login');
