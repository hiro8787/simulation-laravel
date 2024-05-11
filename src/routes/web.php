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
    //Route::post('/register', [AtteController::class, 'register']);
    //Route::get('/stamp', [AtteController::class, 'stamp']);

//Route::prefix('work')->group(function () {
    //Route::get('/date', [AtteController::class, 'add']);
    //Route::post('/date', [AtteController::class, 'create']);
    //});
Route::middleware('auth')->group(function (){
    Route::post('/stamp', [AtteController::class, 'store']);
    Route::get('/stamp', [AtteController::class, 'store']);
    Route::get('/date', [AtteController::class, 'date']);
    Route::post('/date', [AtteController::class, 'create']);
    //Route::get('/date', [AtteController::class, 'aaa']);
});
//Route::post('/works', [AtteController::class, 'date']);//

//Route::prefix('stamp')->group(function () {
    //Route::get('/', [WorkController::class, 'stamp']);
    //Route::post('/stamp', [WorkController::class, 'create']);
//});
