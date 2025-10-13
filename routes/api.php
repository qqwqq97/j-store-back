<?php
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;

Route::prefix('api')->group(function () {
  Route::post('/register', [AuthController::class, 'create']);
  Route::post('/login', [AuthController::class, 'login']);
  Route::post('/logout', [AuthController::class, 'logout']);
});

// Route::prefix('api')->middleware([EnsureFrontendRequestsAreStateful::class, 'auth:sanctum'])->group(function () {
//   Route::get('/test', function () {
//     return response()->json(['message' => 'API 연결 성공!']);
//   });
// });


