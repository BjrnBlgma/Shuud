<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImageController;

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Route::get('/register', [RegistrationController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegistrationController::class, 'register'])->name('register');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/main', [MainController::class, 'showMainPage'])->name('main');
