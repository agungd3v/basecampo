<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Vendor\Http\Controllers\DivisionController;

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

Route::group(['prefix' => 'vendor'], function() {
  Route::post('division', [DivisionController::class, 'getDivision']);
});