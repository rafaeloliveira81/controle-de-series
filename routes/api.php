<?php

use App\Http\Controllers\SeriesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

        
<<<<<<< HEAD
    Route::get('/v1/serie', [SeriesController::class, 'index']);
=======
        Route::get('/v1/series', [SeriesController::class, 'index']);
>>>>>>> d7b8b46388a6d75cc75a365983e64be2e9ce8635

    Route::prefix('/v1/serie')->group(function () {
        Route::post('/v1/serie', [SeriesController::class, 'store']);
        Route::put('/v1/serie', [SeriesController::class, 'update']);
        Route::delete('/v1/serie', [SeriesController::class, 'destroy']);
    });
