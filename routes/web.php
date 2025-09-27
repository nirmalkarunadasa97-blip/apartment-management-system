<?php

use App\Http\Controllers\AdDashController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LanadinController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('/', [LanadinController::class, 'index'])->name('landing');


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register/store', [RegisterController::class, 'store'])->name('register.store');


use App\Http\Controllers\ApartmentController;

Route::group(['middleware' => 'auth.role_id:1'], function () {
    Route::resource('addash', AdDashController::class);
    Route::resource('apartments', ApartmentController::class);

    Route::get('/apartment-applications', function () {
        return view('addash.maintenance.index');
    })->name('apartment-applications.index');

    Route::get('/maintenance', function () {
        return view('addash.maintenance.maintenance');
    })->name('maintenance.index');

    Route::get('/payments', function () {
        return view('addash.payments.index');
    })->name('payments.index');

    Route::get('/chats', function () {
        return view('addash.chats.index');
    })->name('chats.index');

    Route::get('/profile', function () {
        return view('addash.profile.index');
    })->name('profile.index');

    Route::get('/change-password', function () {
        return view('addash.change-password.index');
    })->name('change-password.index');

    Route::get('admin-users/create', [AdminUserController::class, 'create'])->name('admin-users.create');
    Route::post('admin-users', [AdminUserController::class, 'store'])->name('admin-users.store');
});
