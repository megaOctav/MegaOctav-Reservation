<?php

use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\BookingController;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\KonfirmasiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;



//swagger
use App\Http\Controllers\API\CategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('customers', CustomerController::class);
Route::apiResource('bookings', BookingController::class);
Route::apiResource('admins', AdminController::class);
Route::apiResource('products', ProductController::class);
Route::apiResource('payments', PaymentController::class);
Route::apiResource('konfirmasi', KonfirmasiController::class);
Route::apiResource('users', UserController::class); 

Route::group([], function () {
    // Produk
    Route::get('product', [ProductController::class, 'ListProduct']);
    Route::post('product', [ProductController::class, 'store']);

    // Customer
    Route::get('customer', [CustomerController::class, 'ListCustomer']);

    // Booking
    Route::get('booking', [BookingController::class, 'ListBooking']);

    // Payment
    Route::get('payment', [PaymentController::class, 'ListPayment']);

    // Admin
    Route::get('admin', [AdminController::class, 'ListAdmin']);

    // Konfirmasi
    Route::get('konfirmasi', [KonfirmasiController::class, 'ListKonfirmasi']);

    // User (tambahan)
    Route::get('user', [UserController::class, 'index']);
    Route::post('user', [UserController::class, 'store']);
    Route::put('user/{id}', [UserController::class, 'update']);
    Route::delete('user/{id}', [UserController::class, 'destroy']);
});