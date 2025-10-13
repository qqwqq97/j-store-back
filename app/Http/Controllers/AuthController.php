<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller 
{
  public function create(RegisterRequest $request) 
  {
      // return 필수
      $user = User::create([
        'name' => $request['name'],
        'email' => $request['email'],
        'password' => Hash::make($request['password'])
      ]);
      return response()->json([
        'message' => 'success!',
        'user' => $user
      ], 201);
  }

  public function login(LoginRequest $request)
  {
    if(!Auth::attempt($request->only('email', 'password'))) {
      return response()->json(['message' => '이메일 혹은 비밀번호가 잘못되었습니다'], 401);
    }
    
    $request->session()->regenerate();

    return response()->json([
      'message' => 'success',
      'user' => Auth::user()
    ]);
  }

  public function logout(Request $request)
  {
    
  }
}