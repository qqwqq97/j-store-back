<?php
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController; 
use App\Http\Controllers\PaymentController; 


Route::prefix('api')->group(function () {
  Route::post('/register', [AuthController::class, 'create']);
  Route::post('/login', [AuthController::class, 'login']);
  Route::post('/logout', [AuthController::class, 'logout']);
  Route::get('/categories', [CategoryController::class, 'get']);
  Route::get('/products/new', [ProductController::class, 'getNew']);
  Route::get('/products/detail/{id}', [ProductController::class, 'detail']);
  Route::middleware(['web', 'auth'])->group(function () {
    Route::post('/newAddress', [CartController::class, 'saveAddress']);
    Route::get('/getAddress', [CartController::class, 'getAddress']);
    Route::post('/checkout/pay', [PaymentController::class, 'pay']);
  });
});

// Route::prefix('api')->middleware([EnsureFrontendRequestsAreStateful::class, 'auth:sanctum'])->group(function () {
//   Route::get('/test', function () {
//     return response()->json(['message' => 'API 연결 성공!']);
//   });
// });


