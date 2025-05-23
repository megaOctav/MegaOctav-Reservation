<?php
use App\Http\Controllers\API\FilmController;
use App\Http\Controllers\API\ScheduleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\SeatsController;
use App\Http\Controllers\API\PriceController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//film
Route::prefix('films')->group(function () {
    Route::get('/', [FilmController::class, 'index']);
    Route::get('/{id}', [FilmController::class, 'show']);
    Route::post('/', [FilmController::class, 'store']);
    Route::put('/{id}', [FilmController::class, 'update']);
    Route::delete('/{id}', [FilmController::class, 'destroy']);
});

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
