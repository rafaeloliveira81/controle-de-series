<?php

use App\Http\Controllers\SeriesController;
use App\Http\Controllers\TemporadasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

        
    Route::get('/v1/series', [SeriesController::class, 'index']);
    Route::prefix('/v1/serie')->group(function () {
        Route::post('/', [SeriesController::class, 'store']);
        Route::get('/{id}', [SeriesController::class, 'show']);
        Route::patch('/{id}', [SeriesController::class, 'update']);
        Route::put('/status/{id}', [SeriesController::class, 'status']);
        Route::delete('/{id}', [SeriesController::class, 'destroy']);
    });

    Route::get('/v1/temporadas', [TemporadasController::class, 'index']);
    Route::prefix('v1/temporada')->group(function () {
        Route::post('/', [TemporadasController::class, 'store']);
        Route::get('/{id}', [TemporadasController::class, 'show']);
        Route::patch('/{id}', [TemporadasController::class, 'update']);
        Route::delete('/{id}', [TemporadasController::class, 'destroy']);
    });
