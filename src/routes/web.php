<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AtteController;
use App\Http\Controllers\WorkController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


    Route::get('/', [AtteController::class, 'index']);

    Route::middleware('auth')->group(function (){
        Route::get('/stamp', [AtteController::class, 'store']);
        Route::get('/work_start', [AtteController::class, 'work_start']);
        Route::post('/work_start', [AtteController::class, 'work_start']);
        Route::post('/work_end', [AtteController::class, 'work_end']);
        Route::post('/rest_start', [AtteController::class, 'rest_start']);
        Route::post('/rest_end', [AtteController::class, 'rest_end']);
        Route::get('/date', [AtteController::class, 'date']);
});

