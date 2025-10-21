<?php

use App\Http\Controllers\AdDashController;
use App\Http\Controllers\AdminChatController;
use App\Http\Controllers\AdminDetailsController;
use App\Http\Controllers\AdminMaintenanceController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ApartmentApplicationAdminontroller;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LanadinController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\ApartmentPaymentController;
use App\Http\Controllers\ApartmentResidentController;
use App\Http\Controllers\ApplyApartmentController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\LeaseExtentionController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ResidentChatController;
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
    Route::resource('report', ReportController::class);
    Route::get('admin-users/create', [AdminUserController::class, 'create'])->name('admin-users.create');
    Route::post('admin-users', [AdminUserController::class, 'store'])->name('admin-users.store');
    Route::resource('residents', ResidentDashController::class);
    Route::resource('admin_chat', AdminChatController::class)->only(['index', 'create', 'store']);
    Route::put('admin_chat/{chat_id}/update-read', [AdminChatController::class, 'updateRead'])->name('admin_chat.update_read');
    Route::resource('apply_apartment_admin', ApartmentApplicationAdminontroller::class);
    Route::resource('admin_staff', AdminDetailsController::class);
});

Route::group(['middleware' => 'auth.role_id:3'], function () {
    Route::resource('change_password', ChangePasswordController::class);
    Route::resource('profile_update', ProfileController::class);
    Route::resource('maintenance', MaintenanceController::class);
    Route::resource('resident_chat', ResidentChatController::class)->only(['create', 'store']);
    Route::post('update_user_read_status', [ResidentChatController::class, 'updateUserReadStatus'])->name('update_user_read_status');
    Route::resource('apply_apartment', ApplyApartmentController::class);
    Route::resource('apartment_resident', ApartmentResidentController::class);
    Route::resource('application_extention', LeaseExtentionController::class);
    Route::get('/payment', [PaymentController::class, 'showPaymentForm'])->name('payment.form');
    Route::post('/process-payment', [PaymentController::class, 'processPayment'])->name('payment.process');
});

Route::group(['middleware' => 'auth.role_id:1||2'], function () {
    Route::resource('admin_maintenance', AdminMaintenanceController::class);
});

Route::group(['middleware' => 'auth.role_id:2'], function () {
    Route::put('/maintenances/{id}/done', '\App\Http\Controllers\AdminMaintenanceController@updateStatus')->name('maintenances.done');
});

Route::group(['middleware' => 'auth.role_id:1||3'], function () {
    Route::resource('apartment_payment', ApartmentPaymentController::class);
    Route::resource('announcements', AnnouncementController::class);
    Route::resource('apartments', ApartmentController::class);
});
