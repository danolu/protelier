<?php

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

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\SettingController;

// Auth::routes();
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'authenticate'])->name('login.submit');
Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'requestLink'])->name('password.email');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::middleware('auth')->group(function () {

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resources([
    'users' => UserController::class,
    'employees' => EmployeeController::class,
    'roomtypes' => RoomTypeController::class,
    'rooms' => RoomController::class,
    'guests' => GuestController::class,
    'bookings' => BookingController::class,
    'payments' => PaymentController::class,
    'services' => ServiceController::class,
    'facilities' => FacilityController::class,
]);
    Route::get('getguestdata/{id}', [BookingController::class, 'getGuestData'])->name('getguestdata');
    Route::get('getavailablerooms/{checkin}/{checkout}/{roomtype_id}', [BookingController::class, 'getAvailableRooms'])->name('getavailablerooms');
    Route::get('gettotalcost/{roomtype_id}/{no_of_rooms}/{duration}', [BookingController::class, 'getTotalCost'])->name('gettotalcost');
    Route::post('book-service', [ServiceController::class, 'book'])->name('services.book');
    Route::post('service-receipt', [ServiceController::class, 'receipt'])->name('services.receipt');
    Route::get('payroll', [EmployeeController::class, 'payroll'])->name('payroll');
    Route::get('activity', [DashboardController::class, 'activity'])->name('activity');
    Route::get('statistics', [DashboardController::class, 'stats'])->name('stats');
    Route::get('settings', [SettingController::class, 'index'])->name('settings');
    Route::get('account', [SettingController::class, 'account'])->name('account');
    Route::get('payment-methods', [PaymentController::class, 'paymentMethods'])->name('paymentmethods');
    Route::get('activate-payment-method/{id}', [PaymentController::class, 'activatePM'])->name('pm.activate');
    Route::get('deactivate-payment-method/{id}', [PaymentController::class, 'deactivatePM'])->name('pm.deactivate');
    Route::post('settings/updatebank', [SettingController::class, 'updateBank'])->name('bank.update');
    Route::post('settings/updatehotel', [SettingController::class, 'updateHotel'])->name('hotel.update');
    Route::post('settings/updateloyalty', [SettingController::class, 'updateLoyalty'])->name('loyalty.update');
    Route::post('change-password', [UserController::class, 'changePassword'])->name('password.change');

    Route::get('available-rooms', [RoomController::class, 'available'])->name('rooms.available');
    Route::get('activate-room/{id}', [RoomController::class, 'activate'])->name('rooms.activate');
    Route::get('deactivate-room/{id}', [RoomController::class, 'deactivate'])->name('rooms.deactivate');
    Route::get('book-room{id}', [RoomController::class, 'book'])->name('rooms.book');
    Route::get('active-guests', [GuestController::class, 'active'])->name('guests.active');
    Route::post('cancel-booking{id}', [BookingController::class, 'cancel'])->name('bookings.cancel');
    Route::get('booking-details{id}', [BookingController::class, 'details'])->name('bookings.details');
    Route::post('book-room', [BookingController::class, 'bookRoom'])->name('book.room');
    Route::get('booking-receipt{id}', [BookingController::class, 'receipt'])->name('bookings.receipt');
    Route::get('payment-receipt{id}', [PaymentController::class, 'receipt'])->name('payments.receipt');
    Route::get('checkin/{id}', [BookingController::class, 'checkin'])->name('checkin');
    Route::post('checkout/{id}', [BookingController::class, 'checkout'])->name('checkout');
    Route::get('loyalty', [GuestController::class, 'loyalty'])->name('loyalty');
});    
Route::get('logout', [LoginController::class, 'logout'])->name('logout');