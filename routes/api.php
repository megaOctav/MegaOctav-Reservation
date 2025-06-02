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
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//schedules
Route::prefix('schedules')->group(function () {
    Route::get('/allSchedule', [ScheduleController::class, 'index']);
    Route::get('/Schedule{id}', [ScheduleController::class, 'show']);
    Route::post('/addSchedule', [ScheduleController::class, 'store']);
    Route::put('/editSchedule{id}', [ScheduleController::class, 'update']);
    Route::delete('/deleteSchedule{id}', [ScheduleController::class, 'destroy']);
});

//prices
Route::prefix('prices')->group(function () {
    Route::get('/allPrices', [PriceController::class, 'index']);
    Route::get('/Prices{id}', [PriceController::class, 'show']);
    Route::post('/addPrices', [PriceController::class, 'store']);
    Route::put('/editPrices{id}', [PriceController::class, 'update']);
    Route::delete('/deletePrices{id}', [PriceController::class, 'destroy']);
});

//seats
Route::prefix('seats')->group(function () {
    Route::get('/allSeats', [SeatsController::class, 'index']);
    Route::post('/addSeats', [SeatsController::class, 'store']);
    Route::get('/Seats{id}', [SeatsController::class, 'show']);
    Route::put('/editSeats{id}', [SeatsController::class, 'update']);
    Route::delete('/deleteSeats{id}', [SeatsController::class, 'destroy']);
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