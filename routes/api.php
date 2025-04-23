<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//swagger
use App\Http\Controllers\API\CategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('customers', CustomerController::class);
Route::apiResource('bookings', BookingController::class);
Route::apiResource('admins', AdminController::class);
Route::apiResource('products', ProductController::class);

Route::group([], function () {
    Route::get('category', [CategoryController::class, 'ListCategory']);
});