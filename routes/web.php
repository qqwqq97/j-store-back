<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;

require __DIR__ . '/api.php';
// route순서에 주의 동적파라미터는 정적보다 밑에
Route::middleware('web')->prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AuthController::class, 'goLogin'])->name('login.create'); // admin/login, admin.login.create
    Route::post('login', [AuthController::class, 'login'])->name('login.store'); // admin/login, admin.login.store

    Route::middleware('admin.session')->group(function () {
        Route::get('dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
        Route::post('logout',[AuthController::class, 'logout'])->name('logout');
        Route::get('shohin/list', [ProductController::class, 'list'])->name('shohin.list');
        Route::get('shohin/create', [ProductController::class, 'create'])->name('shohin.create');
        Route::post('shohin/store', [ProductController::class, 'createShohin'])->name('shohin.store');
        Route::get('shohin/{id}', [ProductController::class, 'detail'])->name('shohin.detail');
        Route::get('shohin/{id}/edit', [ProductController::class, 'edit'])->name('shohin.edit');
        Route::put('shohin/{id}', [ProductController::class, 'update'])->name('shohin.update');
        Route::delete('shohin/{id}', [ProductController::class, 'delete'])->name('shohin.delete');
        Route::resource('users', UserController::class);
        Route::post('users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');
        Route::resource('orders', OrderController::class);
    });
});
