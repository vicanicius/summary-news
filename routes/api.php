<?php

use App\Http\Controllers\GetEverythingController;
use App\Http\Controllers\GetTopHeadlinesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('/v1')->name('.v1')->group(function () {
        Route::prefix('/news')->name('.news')->group(function () {
            Route::get('/everything', GetEverythingController::class)->name('.everything');
            Route::get('/top-headlines', GetTopHeadlinesController::class)->name('.top-headlines');
        });
    }
);
