<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Mail;
// use App\Mail\WelcomeMail;
use App\Events\UserRegistered;

class AuthController extends Controller 
{
  public function create(RegisterRequest $request) 
  {
    $registeredEmail = User::where('email', $request->email)->exists();
    // 유저 테이블에 있는 이메일의 경우제외하고 유저작성
    if(!$registeredEmail) {
      // return 필수
      $user = User::create([
        'name' => $request['name'],
        'email' => $request['email'],
        'password' => Hash::make($request['password'])
      ]);
      // Mail::to($user->email)
      //   ->send(new WelcomeMail($user));
      event(new UserRegistered($user));

      return response()->json([
        'message' => 'success!',
        'user' => $user
      ], 201);
    } else {
      return response()->json([
        'message' => 'fail',
      ], 400);
    }
  }

  public function login(LoginRequest $request)
  {
    if(!Auth::attempt($request->only('email', 'password'))) {
      return response()->json(['message' => '이메일 혹은 비밀번호가 잘못되었습니다'], 401);
    }
    
    $request->session()->regenerate();

    $user = Auth::user(); 
    
    if($user) {
      $user->update([
        'last_login_at' => now(),
      ]);
    }

    return response()->json([
      'message' => 'success',
      'user' => Auth::user()
    ]);
  }

  public function logout(Request $request)
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return response()->json([
      'message' => 'success'
    ]);
  }
}