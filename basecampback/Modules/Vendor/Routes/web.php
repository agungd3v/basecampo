<?php

use Illuminate\Support\Facades\Route;
use Modules\Vendor\Http\Controllers\Auth\LoginController;
use Modules\Vendor\Http\Controllers\Auth\RegisterController;
use Modules\Vendor\Http\Controllers\VendorController;

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

Route::prefix('vendor')->group(function() {
  Route::group(['middleware' => 'auth:web'], function() {

    Route::get('dashboard', [VendorController::class, 'dashboard'])->name('vendor.dashboard');

    Route::group(['prefix' => 'company'], function() {
      Route::get('', [VendorController::class, 'company'])->name('vendor.company');
      Route::get('create', [VendorController::class, 'companyCreate'])->name('vendor.company.create');
      Route::post('create', [VendorController::class, 'companyStore'])->name('vendor.company.store');
    });

    Route::group(['prefix' => 'division'], function() {
      Route::post('{companyId}', [VendorController::class, 'divisionStore'])->name('vendor.division.store');
    });

    Route::group(['prefix' => 'employee'], function() {
      Route::get('', [VendorController::class, 'employee'])->name('vendor.employee');
      Route::post('', [VendorController::class, 'employeeStore'])->name('vendor.employee.store');
    });

  });
  
  Route::get('register', [RegisterController::class, 'register'])->name('vendor.register');
  Route::post('register', [RegisterController::class, 'registerAccount'])->name('vendor.register.account');
  Route::get('login', [LoginController::class, 'showLoginForm'])->name('vendor.login');
  Route::post('login', [LoginController::class, 'login'])->name('vendor.login.account');
  Route::post('logout', [LoginController::class, 'logout'])->name('vendor.logout');
});
