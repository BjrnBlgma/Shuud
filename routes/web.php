<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\NewsController;
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
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/main', [MainController::class, 'showMainPage'])->name('main');

Route::get('/news', [NewsController::class, 'showNews'])->name('news');
Route::get('/posts/{id}', [NewsController::class, 'showPost'])->name('posts.show');

//Route::get('/create-post', [NewsController::class, 'showCreatePostForm'])->name('create-post');
//Route::post('/create-post', [NewsController::class, 'createPost'])->name('create-post');
Route::get('/images' , [ImageController::class, 'showCreateImageForm'])->name('images');
Route::post('/images', [ImageController::class, 'store'])->name('images.store');

//Route::middleware(['admin'])->group(function () {
//    Route::get('/admin', [AdminController::class, 'showAdminPage'])->name('admin');
//});


Route::get('/admin', [AdminController::class, 'showAdminPageAndAllNews'])->name('admin');
Route::get('/admin-tournaments-list', [AdminController::class, 'showAllTournaments'])->name('tournaments-list');

Route::get('/create-post', [AdminController::class, 'showCreatePostForm'])->name('create-post');
Route::post('/create-post', [AdminController::class, 'submitPost'])->name('create-post');

Route::get('/add-tournament', [AdminController::class, 'showAddTournamentForm'])->name('add-tournament');
Route::post('/add-tournament', [AdminController::class, 'addTournament'])->name('add-tournament');

Route::get('/edit-post/{id}', [AdminController::class, 'showEditPostForm'])->name('edit-post');
Route::post('/edit-post/{id}', [AdminController::class, 'updatePost'])->name('edit-post');
Route::get('/delete-post/{id}', [AdminController::class, 'deletePost'])->name('delete-post');
