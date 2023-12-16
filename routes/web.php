<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ConsultaController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');
Auth::routes();

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/logout', [HomeController::class, 'logout'])->name('logout');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/profile/edit/{id}', [ProfileController::class, 'editUser'])->name('profile.editUser');
Route::put('/profile/update/{id}', [ProfileController::class, 'updateUser'])->name('profile.updateUser');

Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');


Route::middleware(['auth', 'can:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});

Route::middleware(['auth', 'can:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'listUsers'])->name('admin.index');
    Route::get('/admin/user/{id}', [AdminController::class, 'showUser'])->name('admin.showUser');
});


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/edit-user/{id}', [ProfileController::class, 'editUser'])->name('admin.editUser');
    Route::put('/admin/update-user/{id}', [ProfileController::class, 'updateUser'])->name('admin.updateUser');
});


Route::get('/consultas/create', [ConsultaController::class, 'create'])->name('consultas.create');
Route::post('/consultas/store', [ConsultaController::class, 'store'])->name('consultas.store');

Route::post('/consultas', [ConsultaController::class, 'store'])->name('consultas.store');
Route::get('/consultas', [ConsultaController::class, 'index'])->name('consultas.index');
