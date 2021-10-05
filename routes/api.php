<?php

use App\Http\Controllers\SeriesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

        
    Route::get('/v1/serie', [SeriesController::class, 'index']);

    Route::prefix('/v1/serie')->group(function () {
        Route::post('/v1/serie', [SeriesController::class, 'store']);
        Route::put('/v1/serie', [SeriesController::class, 'update']);
        Route::delete('/v1/serie', [SeriesController::class, 'destroy']);
    });
