<?php
use App\Http\Controllers\API\FilmController;
use App\Http\Controllers\API\ScheduleController;
use App\Http\Controllers\API\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;


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

//Transaction
Route::prefix('transactions')->group(function () {
    Route::get('/', [TransactionController::class, 'index']);         // GET semua schedule
    Route::get('/{id}', [TransactionController::class, 'show']);      // GET schedule by ID
    Route::post('/', [TransactionController::class, 'store']);        // POST tambah schedule
    Route::put('/{id}', [TransactionController::class, 'update']);    // PUT update schedule
    Route::delete('/{id}', [TransactionController::class, 'destroy']); // DELETE schedule
});