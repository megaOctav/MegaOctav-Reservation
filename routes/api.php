<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\SeatsController;
use App\Http\Controllers\API\PriceController;
use App\Http\Controllers\API\FilmController;
use App\Http\Controllers\API\LocationController;
use App\Http\Controllers\API\ScheduleController;
use App\Http\Controllers\API\TransactionController;
use App\Http\Controllers\API\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//schedules
Route::prefix('schedules')->group(function () {
    Route::get('/', [ScheduleController::class, 'index']);
    Route::get('/{id}', [ScheduleController::class, 'show']);
    Route::post('/', [ScheduleController::class, 'store']);
    Route::put('/{id}', [ScheduleController::class, 'update']);
    Route::delete('/{id}', [ScheduleController::class, 'destroy']);
});

//prices
Route::prefix('prices')->group(function () {
    Route::get('/', [PriceController::class, 'index']);
    Route::get('/{id}', [PriceController::class, 'show']);
    Route::post('/', [PriceController::class, 'store']);
    Route::put('/{id}', [PriceController::class, 'update']);
    Route::delete('/{id}', [PriceController::class, 'destroy']);
});

//seats
Route::prefix('seats')->group(function () {
    Route::get('/', [SeatsController::class, 'index']);
    Route::post('/', [SeatsController::class, 'store']);
    Route::get('/{id}', [SeatsController::class, 'show']);
    Route::put('/{id}', [SeatsController::class, 'update']);
    Route::delete('/{id}', [SeatsController::class, 'destroy']);
});

//Locations
Route::prefix('locations')->group(function () {
    Route::get('/', [LocationController::class, 'index']);
    Route::post('/', [LocationController::class, 'store']);
    Route::get('/{id}', [LocationController::class, 'show']);
    Route::put('/{id}', [LocationController::class, 'update']);
    Route::delete('/{id}', [LocationController::class, 'destroy']);
});

//transactions
Route::prefix('transactions')->group(function () {
    Route::get('/', [TransactionController::class, 'index']);
    Route::post('/', [TransactionController::class, 'store']);
    Route::get('/{id}', [TransactionController::class, 'show']);
    Route::put('/{id}', [TransactionController::class, 'update']);
    Route::delete('/{id}', [TransactionController::class, 'destroy']);
});

//users
Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/', [UserController::class, 'store']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
});

// film
Route::prefix('films')->group(function () {
    Route::get('/', [FilmController::class, 'index']);       // GET /films - list semua film
    Route::get('/{id}', [FilmController::class, 'show']);    // GET /films/{id} - ambil satu film
    Route::post('/', [FilmController::class, 'store']);      // POST /films - tambah film
    Route::put('/{id}', [FilmController::class, 'update']);  // PUT /films/{id} - edit film
    Route::delete('/{id}', [FilmController::class, 'destroy']); // DELETE /films/{id} - hapus film
});


//custom route
Route::get('/schedules/{id}/film', [FilmController::class, 'filmBySchedule']);