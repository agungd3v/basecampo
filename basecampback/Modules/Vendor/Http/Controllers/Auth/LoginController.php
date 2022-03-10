<?php

namespace Modules\Vendor\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController as DefaultLoginController;
use App\Providers\RouteServiceProvider;

class LoginController extends DefaultLoginController
{
  protected $redirectTo = RouteServiceProvider::HOME;

  public function __construct() {
    $this->middleware('guest:web')->except('logout');
  }

  public function showLoginForm() {
    return view('vendor::auth.login');
  }

  protected function guard() {
    return Auth::guard('web');
  }
}