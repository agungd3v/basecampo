<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\V1\Http\Controllers\AuthController;
use Modules\V1\Http\Controllers\TaskController;

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

Route::group(['prefix' => 'v1'], function() {
  Route::post('register', [AuthController::class, 'register']);
  Route::post('login', [AuthController::class, 'login']);

  Route::group(['prefix' => 'task', 'middleware' => 'auth:api'], function() {
    Route::get('', [TaskController::class, 'getTask']);
    Route::post('', [TaskController::class, 'storeTask']);
    Route::post('user', [TaskController::class, 'getUserDivision']);
  });
});