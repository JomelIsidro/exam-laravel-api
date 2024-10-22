<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GeoController;
use App\Http\Controllers\AuthController;

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('geo/{ip}', [GeoController::class, 'getGeoData']);
    Route::post('history', [GeoController::class, 'storeHistory']);
    Route::get('history', [GeoController::class, 'getHistory']);
    Route::delete('history/{id}', [GeoController::class, 'deleteHistory']);
    Route::delete('history', [GeoController::class, 'deleteMultipleHistories']);
});

Route::get('test', [GeoController::class, 'index']);