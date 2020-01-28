<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  public function login()
  {
    if (Auth::attempt(['username' => request('username'), 'password' => request('password')])) {
      $user = Auth::user();
      $user->role;
      $user->branch;
      $tkn =  $user->createToken('TotalPOS')->accessToken;
      return response()->json(
        [
          'error' => 0,
          'user' => $user,
          'access_token' => $tkn
        ],
        200
      );
    } else {
      return response()->json([
        'error' => 1,
        'message' => 'Las credenciales que ha ingresado no son correctas.'
      ], 401);
    }
  }

  public function logout(Request $request)
  {
    Auth::user()->token()->revoke();
    return response()->json([
      'error' => 0,
      'message' => 'deslogueado correctamente'
    ], 200);
  }
}
