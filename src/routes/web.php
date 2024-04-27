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

Route::post('/login', [AtteController::class, 'login']);
Route::get('/register', [AtteController::class, 'store']);

Route::middleware('auth')->group(function (){
    Route::get('/', [AtteController::class, 'login']);
    Route::post('/stamp', [AtteController::class, 'stamp']);
    Route::get('/date', [AtteController::class, 'date']);
});
//Route::post('/works', [AtteController::class, 'date']);//

//Route::prefix('stamp')->group(function () {
    //Route::get('/', [WorkController::class, 'stamp']);
    //Route::post('/stamp', [WorkController::class, 'create']);
//});
