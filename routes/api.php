<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PaymentController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//swagger
use App\Http\Controllers\API\CategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

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