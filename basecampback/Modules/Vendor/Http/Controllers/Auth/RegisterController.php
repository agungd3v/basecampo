<?php

namespace Modules\Vendor\Http\Controllers\Auth;

use App\Models\Vendor;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
  public function __construct() {
    $this->middleware('guest:web');
  }
  public function register() {
    return view('vendor::auth.register');
  }

  public function registerAccount(Request $request) {
    $request->validate([
      'email' => 'required|email',
      'password' => 'required|confirmed|min:8'
    ]);
    DB::beginTransaction();
    try {
      $vendor = new Vendor();
      $vendor->name = 'New Vendor';
      $vendor->email = $request->email;
      $vendor->password = Hash::make($request->password);
      $vendor->save();
      DB::commit();

      return redirect()->route('vendor.login');
    } catch (\Exception $e) {
      DB::rollBack();
      return redirect()->route('vendor.register')->withErrors($e->getMessage());
    }
  }
}
