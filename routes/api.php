<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PaymentController;
<<<<<<< HEAD
use App\Http\Controllers\KonfirmasiController;
=======

>>>>>>> 677509a31649dcfc8a8179312642a63a034fd74a
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//swagger
use App\Http\Controllers\API\CategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

<<<<<<< HEAD
Route::apiResource('customers', CustomerController::class);
Route::apiResource('bookings', BookingController::class);
Route::apiResource('admins', AdminController::class);
Route::apiResource('products', ProductController::class);
Route::apiResource('payments', PaymentController::class);
Route::apiResource('konfirmasi', KonfirmasiController::class);

=======
>>>>>>> 677509a31649dcfc8a8179312642a63a034fd74a
Route::group([], function () {
    Route::get('product', [ProductController::class, 'ListProduct']);
});

Route::group([], function () {
    Route::get('customer', [CustomerController::class, 'ListCustomer']);
});

Route::group([], function () {
    Route::get('booking', [BookingController::class, 'ListBooking']);
});

Route::group([], function () {
    Route::get('payment', [PaymentController::class, 'ListPayment']);
});

Route::group([], function () {
    Route::get('admin', [AdminController::class, 'ListAdmin']);
});

Route::group([], function () {
    Route::get('konfirmasi', [KonfirmasiController::class, 'ListKonfirmasi']);
});