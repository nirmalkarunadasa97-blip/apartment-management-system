<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LanadinController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdDashController;
use App\Http\Controllers\AdminMaintenanceController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ResidentDashController;
use App\Http\Controllers\AnnouncementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::get('/', [LanadinController::class, 'index'])->name('landing');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register/store', [RegisterController::class, 'store'])->name('register.store');
Route::resource('apartments', ApartmentController::class);
Route::resource('announcements', AnnouncementController::class);
// ============================
// ADMIN ROUTES (role_id = 1)
// ============================
Route::group(['middleware' => 'auth.role_id:1'], function () {
    Route::resource('addash', AdDashController::class);

    Route::resource('report', ReportController::class);

    // User management
    Route::get('admin-users/create', [AdminUserController::class, 'create'])->name('admin-users.create');
    Route::post('admin-users', [AdminUserController::class, 'store'])->name('admin-users.store');

    // Residents management
    Route::resource('residents', ResidentDashController::class);

});


// ============================
// MAINTENANCE ADMIN (role_id = 2)
// ============================
Route::group(['middleware' => 'auth.role_id:2'], function () {
    Route::resource('admin_maintenance', AdminMaintenanceController::class);
    Route::put('/maintenances/{id}/done', [AdminMaintenanceController::class, 'updateStatus'])
        ->name('maintenances.done');
});


// ============================
// RESIDENT ROUTES (role_id = 3)
// ============================
Route::group(['middleware' => 'auth.role_id:3'], function () {
    Route::get('/resdash', [ResidentDashController::class, 'dashboard'])->name('resdash.index');
    //Route::resource('apartments', ApartmentController::class)->only(['index', 'show']);

    Route::resource('change_password', ChangePasswordController::class);
    Route::resource('profile_update', ProfileController::class);
    Route::resource('maintenance', MaintenanceController::class);
});
