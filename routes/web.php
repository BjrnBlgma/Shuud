<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TournamentController;
use App\Http\Controllers\TournamentParticipantController;
use App\Http\Controllers\GuestController;

use App\Http\Controllers\MailController;


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

//Route::middleware(['admin'])->group(function () {
//    Route::get('/admin', [AdminController::class, 'showAdminPage'])->name('admin');
//});

Route::get('/admin', [AdminController::class, 'showAdminPageAndAllPosts'])->name('admin');
Route::get('/admin/tournaments-list', [TournamentController::class, 'showAllTournaments'])->name('tournaments-list');

Route::get('/admin/create-post', [PostController::class, 'showAddPostForm'])->name('create-post');
Route::post('/admin/create-post', [PostController::class, 'addPost'])->name('create-post');
Route::get('/admin/edit-post/{id}', [PostController::class, 'showEditPostForm'])->name('edit-post');
Route::post('/admin/edit-post/{id}', [PostController::class, 'updatePost'])->name('edit-post');
Route::get('/admin/delete-post/{id}', [PostController::class, 'deletePost'])->name('delete-post');

Route::get('/admin/add-tournament', [TournamentController::class, 'showAddTournamentForm'])->name('add-tournament');
Route::post('/admin/add-tournament', [TournamentController::class, 'addTournament'])->name('add-tournament');
Route::get('/admin/info-tournament/{id}', [TournamentController::class, 'showInfoAboutTournament'])->name('info-tournament');

Route::post('/tournament/{tournament_id}/generate-link', [TournamentController::class, 'generateRegistrationLink'])->name('generate-registration-link');


// админ сам пока добавляет у себя
Route::get('/tournament/{tournament_id}/add-athlete', [TournamentParticipantController::class, 'showAddAthleteForm'])->name('add-athlete');
Route::post('/tournament/{tournament_id}/add-athlete', [TournamentParticipantController::class, 'addAthlete'])->name('add-athlete');
Route::get('/tournament/{tournament_id}/list-of-participants', [TournamentParticipantController::class, 'showAllAthletes'])->name('list-of-participants');

// гости самостоятельно регистрируются на турнир по ссылке
Route::get('/registration-in-tournament/{tournament_id}/{registration_token}', [GuestController::class, 'showRegistrationGuestForm'])->name('register-guest');
Route::post('/registration-in-tournament/{tournament_id}/{registration_token}', [GuestController::class, 'registerGuest'])->name('register-guest');

Route::get('/success', function () { return view('success'); })->name('success.page');

Route::get('/admin/edit-tournament/{id}', [TournamentController::class, 'showEditTournamentForm'])->name('edit-tournament');
Route::post('/admin/edit-tournament/{id}', [TournamentController::class, 'updateTournament'])->name('edit-tournament');

Route::get('/tournament-applications/{tournament_id}', [TournamentParticipantController::class, 'showApplications'])->name('tournament-applications');
Route::get('/tournament-applications-allow/{tournament_id}/{participant_id}', [TournamentParticipantController::class, 'allowToTournament'])->name('applications-allow');
Route::get('/tournament-applications-deny/{tournament_id}/{participant_id}', [TournamentParticipantController::class, 'denyToParticipate'])->name('applications-deny');

Route::get('basic-email', [MailController::class, 'sendBasicEmail']);

Route::get('/participant-confirm/{uuid}', [GuestController::class, 'confirmParticipation'])->name('confirm');
Route::get('/participant-cancel/{uuid}', [GuestController::class, 'cancelParticipation'])->name('cancel');

Route::get('/about', [MainController::class, 'showAboutPage'])->name('about');
Route::get('/history', [MainController::class, 'showHistoryPage'])->name('history');
Route::get('/rules', [MainController::class, 'showRulesPage'])->name('rules');
