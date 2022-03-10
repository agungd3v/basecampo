<?php

namespace Modules\V1\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Traits\ResponseApi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
  use ResponseApi;

  public function login(Request $request) {
    $request->validate([
      'email' => 'required',
      'password' => 'required'
    ]);
    try {
      $user = User::where('email', $request->email)->first();
      if (!$user) throw new \Exception('Kamu belum terdaftar');
      if (!Hash::check($request->password, $user->password)) throw new \Exception('Email atau password salah');
      $token = $user->createToken($user->name)->accessToken;
      $this->setData(['user' => $user, 'token' => $token]);
      return $this->success();
    } catch (\Exception $e) {
      $this->setMessage($e->getMessage());
      return $this->error();
    }
  }

  public function register(Request $request) {
    $request->validate([
      'name' => 'required',
      'email' => 'required',
      'password' => 'required'
    ]);
    DB::beginTransaction();
    try {
      $user = new User();
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = Hash::make($request->password);
      $user->email_verified_at = now();
      $user->save();
      DB::commit();

      $this->setData($user);
      return $this->success();
    } catch (\Exception $e) {
      DB::rollBack();
      $this->setMessage($e->getMessage());
      return $this->error();
    }
  }
}
