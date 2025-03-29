<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

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
// Auth
Route::group(['middleware' => 'auth:web'], function () {
    Route::get('/eventos/criar', [EventsController::class, 'create'])->name('create_events');
    Route::post('/eventos', [EventsController::class, 'store'])->name('store_events');
    Route::delete('/eventos/deletar/{id}', [EventsController::class, 'destroy'])->name('destroy_events');
    Route::put('/eventos/atualizar/{id}', [EventsController::class, 'update'])->name('update_events');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('index_dashboard');
});
// Register
Route::get('/registro', [RegisterController::class, 'register'])->name('register_user');
Route::post('/registro', [RegisterController::class, 'registration'])->name('registration_user');
// Login
Route::get('/login', [LoginController::class, 'login'])->name('login_user');
Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate_user');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout_user');
// Eventos
Route::get('/', [EventsController::class, 'index'])->name('index_events');
Route::get('/eventos/{id}', [EventsController::class, 'show'])->name('show_events');

