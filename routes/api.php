<?php

use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\BookingController;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\KonfirmasiController;
use App\Http\Controllers\API\FilmController;
use App\Http\Controllers\API\ScheduleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\SeatsController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//film
Route::prefix('films')->group(function () {
    Route::get('/', [FilmController::class, 'index']);         // GET semua film
    Route::get('/{id}', [FilmController::class, 'show']);      // GET film by ID
    Route::post('/', [FilmController::class, 'store']);        // POST tambah film
    Route::put('/{id}', [FilmController::class, 'update']);    // PUT update film
    Route::delete('/{id}', [FilmController::class, 'destroy']); // DELETE film
});

//Scedules
Route::prefix('schedules')->group(function () {
    Route::get('/', [ScheduleController::class, 'index']);         // GET semua schedule
    Route::get('/{id}', [ScheduleController::class, 'show']);      // GET schedule by ID
    Route::post('/', [ScheduleController::class, 'store']);        // POST tambah schedule
    Route::put('/{id}', [ScheduleController::class, 'update']);    // PUT update schedule
    Route::delete('/{id}', [ScheduleController::class, 'destroy']); // DELETE schedule
});

//Seats
Route::prefix('seats')->group(function () {
Route::get('/seats', [SeatsController::class, 'index']);
Route::post('/seats', [SeatsController::class, 'store']);
Route::get('/seats/{id}', [SeatsController::class, 'show']);
Route::put('/seats/{id}', [SeatsController::class, 'update']);
Route::delete('/seats/{id}', [SeatsController::class, 'destroy']);
});


