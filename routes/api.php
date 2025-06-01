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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//schedules
    Route::get('/schedules', [ScheduleController::class, 'index']);
    Route::get('/schedules/{id}', [ScheduleController::class, 'show']);
//prices
    Route::get('/prices', [PriceController::class, 'index']);
    Route::get('/prices/{id}', [PriceController::class, 'show']);
//seats
    Route::get('/seats', [SeatsController::class, 'index']);
    Route::get('/seats{id}', [SeatsController::class, 'show']);
//Locations
    Route::get('/locations', [LocationController::class, 'index']);
    Route::get('/locations/{id}', [LocationController::class, 'show']);
//transactions
    Route::get('/transactions', [TransactionController::class, 'index']);
    Route::get('/transactiona/{id}', [TransactionController::class, 'show']);
//users
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);
// film
    Route::get('/films', [FilmController::class, 'index']);       // GET /films - list semua film
    Route::get('/films/{id}', [FilmController::class, 'show']);    // GET /films/{id} - ambil satu film

