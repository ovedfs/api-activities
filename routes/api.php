<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LogController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ArrendadorController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


Route::group(['middleware' => ["auth:sanctum"]], function(){
    Route::get('profile', [AuthController::class, 'profile']);
    Route::get('logout', [AuthController::class, 'logout']);
    
    Route::get('arrendador/contracts', [ArrendadorController::class, 'listContracts']);
    Route::post('arrendador/contracts', [ArrendadorController::class, 'storeContract']);
    Route::get('arrendador/properties', [ArrendadorController::class, 'listProperties']);
    Route::post('arrendador/properties', [ArrendadorController::class, 'storeProperty']);

    // Logs
    Route::get('logs', [LogController::class, 'history']);
    Route::get('logs/{user}', [LogController::class, 'historyByUser']);
});
