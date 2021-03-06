<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsersAdminController;
use App\Http\Controllers\TicketsAdminController;
use App\Http\Controllers\CommentsAdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketUserController;
use App\Http\Controllers\DetailUserController;
use App\Http\Controllers\CommentUserController;
use App\Http\Controllers\TechnicianController;
use App\Http\Controllers\TechnicianTicketController;
use App\Http\Controllers\CommentssTechnicianController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Login - Regist
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('loginAttempt', [LoginController::class, 'loginAttempt'])->name('loginAttempt');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'admin', 'revalidate'])->group(function () {
    // Admin
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::resource('admin/users', UsersAdminController::class);
    Route::resource('admin/ticketss', TicketsAdminController::class);
    Route::get('admin/detail/{id}', [TicketsAdminController::class, 'detail'])->name('detail');
    Route::resource('admin/comments', CommentsAdminController::class);
});

Route::middleware(['auth', 'user', 'revalidate'])->group(function () {
    // User
    Route::get('/user', [UserController::class, 'index'])->name('user');

    // User Ticket
    Route::resource('user/tickets', TicketUserController::class);
    Route::post('user/store', [TicketUserController::class, 'store'])->name('storeTkt');
    Route::get('user/details/{id}', [TicketUserController::class, 'details']);
    Route::get('user/fetchall', [TicketUserController::class, 'fetchAll'])->name('fetchAll');
    Route::delete('user/delete', [TicketUserController::class, 'delete'])->name('deleteTkt');
    Route::get('user/edit', [TicketUserController::class, 'edit'])->name('editTkt');
    Route::post('user/update', [TicketUserController::class, 'update'])->name('updateTkt');
    
    // User Comment
    Route::resource('user/comments', CommentUserController::class);
    Route::get('/delete-comments/{id}', [CommentUserController::class, 'destroy'])->name('delete-comments');
});

Route::middleware(['auth', 'technician', 'revalidate'])->group(function () {
    // Technician
    Route::get('/technician', [TechnicianController::class, 'index'])->name('technician');
    Route::resource('technician/ticket', TechnicianTicketController::class);
    Route::get('technician/detailss/{id}', [TechnicianTicketController::class, 'detailss']);
    Route::resource('technician/commentss', CommentssTechnicianController::class);
    Route::get('/delete-commentss/{id}', [CommentssTechnicianController::class, 'destroy'])->name('delete-commentss');
});

