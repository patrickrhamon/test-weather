<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WeatherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

# Public Routes {
    Route::get('/weather',[WeatherController::class, 'index']);
    Route::post('/user',[UserController::class, 'create']);
    Route::post('/login',[UserController::class, 'login']);
    Route::post('/logout',[UserController::class, 'logout']);
# }

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
