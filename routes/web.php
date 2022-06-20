<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerContoller;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeDepartment;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index']);

Route::get('admin/login', [AdminController::class, 'login']);
Route::post('admin/login', [AdminController::class, 'validate_login']);
Route::get('admin', function () {
    return view('dashboard');
});



//Route::get('test', function () {
//    return view('test');
//});
//
//
//Route::get('egzamin', function () {
//    return view('egzaminPHP');
//});

// Room type routes
//Admin Routes
//Roomtypes
Route::resource('admin/rooms', RoomTypeController::class);
//Route::get('roomtype', [RoomTypeController::class, 'index']);
//Route::post('roomtype', [RoomTypeController::class, 'index']);
//Route::put('roomtype', [RoomTypeController::class, 'index']);
//Route::delete('roomtype', [RoomTypeController::class, 'index']);
Route::get('admin/rooms/{id}/delete', [RoomTypeController::class, 'destroy']);
//Room
Route::get('admin/room/{id}/delete', [RoomController::class, 'destroy']);
Route::resource('admin/room', RoomController::class);

//Customer
Route::get('admin/customers/{id}/delete', [CustomerContoller::class, 'destroy']);
Route::resource('admin/customers', CustomerContoller::class);



Route::get('admin/login', [AdminController::class, 'login']);
Route::get('admin/logout', [AdminController::class, 'logout']);


//Delete images

Route::get('admin/roomimage/delete/{id}',[RoomTypeController::class, 'delete_image']);

//Department
Route::get('admin/department/{id}/delete', [EmployeeDepartment::class, 'destroy']);
Route::resource('admin/department', EmployeeDepartment::class);
//Employee
Route::get('admin/employee/{id}/delete', [EmployeeController::class, 'destroy']);
Route::resource('admin/employee', EmployeeController::class);
//Booking
Route::get('admin/booking/{id}/delete', [BookingController::class, 'destroy']);
Route::get('admin/booking/available-rooms/{checkindate}', [BookingController::class, 'available_rooms']);
Route::resource('admin/booking', BookingController::class);

//
Route::get('login', [CustomerContoller::class, 'login']);
Route::get('register', [CustomerContoller::class, 'register']);


Route::post('customer/login', [CustomerContoller::class, 'customer_login']);
Route::get('logout', [CustomerContoller::class, 'logout']);

Route::get('booking', [BookingController::class, 'customerbooking']);
Route::get('booking/success', [BookingController::class, 'booking_payment_success']);
Route::get('booking/fail', [BookingController::class, 'booking_payment_fail']);


//Uslugi
Route::get('admin/services/{id}/delete', [ServiceController::class, 'destroy']);
Route::resource('admin/services', ServiceController::class);
Route::get('service/{id}', [HomeController::class, 'servicePage']);


Route::get('employee/login', [EmployeeController::class, 'login']);
Route::post('employee/login', [EmployeeController::class, 'validate_login']);
Route::get('employee/logout', [EmployeeController::class, 'logout']);

//Galeria

Route::get('galery', [HomeController::class, 'galery']);
Route::get('services', [HomeController::class, 'services']);


Route::get('profile/{id}', [CustomerContoller::class, 'profile']);

Route::get('accountValidation', [CustomerContoller::class, 'accountValidationPage']);
Route::post('accountValidation', [CustomerContoller::class, 'accountValidation']);


Route::get('searchRoom', [RoomController::class, 'searchRoom']);

Route::get('profile/{id}/delete', [BookingController::class, 'destroy_front']);
