<?php

use App\Http\Controllers\AdDashController;
use App\Http\Controllers\AdminMaintenanceController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LanadinController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ResidentDashController;

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


Route::group(['middleware' => 'auth.role_id:1'], function () {
    Route::resource('addash', AdDashController::class);
    Route::resource('apartments', ApartmentController::class);

    Route::get('admin-users/create', [AdminUserController::class, 'create'])->name('admin-users.create');
    Route::post('admin-users', [AdminUserController::class, 'store'])->name('admin-users.store');
    Route::resource('report', ReportController::class);
});

Route::group(['middleware' => 'auth.role_id:3'], function () {
    Route::resource('resdash', ResidentDashController::class);
    Route::resource('change_password', ChangePasswordController::class);
    Route::resource('profile_update', ProfileController::class);
    Route::resource('maintenance', MaintenanceController::class);
});

Route::group(['middleware' => 'auth.role_id:1||2'], function () {
    Route::resource('admin_maintenance', AdminMaintenanceController::class);
});

Route::group(['middleware' => 'auth.role_id:2'], function () {
    Route::put('/maintenances/{id}/done', '\App\Http\Controllers\AdminMaintenanceController@updateStatus')->name('maintenances.done');
});
