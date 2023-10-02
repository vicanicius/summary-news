<?php

use App\Http\Controllers\EverythingController;
use App\Http\Controllers\GetEverythingController;
use App\Http\Controllers\GetTopHeadlinesController;
use App\Http\Controllers\TopHeadlinesController;
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
            Route::post('/everything', EverythingController::class)->name('.everything');
            Route::post('/top-headlines', TopHeadlinesController::class)->name('.top-headlines');
            Route::get('/everything', GetEverythingController::class)->name('.get.everything');
            Route::get('/top-headlines', GetTopHeadlinesController::class)->name('.get.top-headlines');
        });
    }
);
