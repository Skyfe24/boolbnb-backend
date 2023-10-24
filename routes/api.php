<?php

use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\EstateController;
use App\Http\Controllers\Api\ServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VisitController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/users', [UserController::class, 'index']);
Route::get('/services', [ServiceController::class, 'index']);
Route::post('/estates/filter', [EstateController::class, 'filter']);

// Rotta per l'inserimento dei messaggi nello store
Route::post('/messages', [MessageController::class, 'store']);

// Visits
Route::post('/visits', [VisitController::class, 'store']);

// All Api Estate Route
Route::apiResource('estates', EstateController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
