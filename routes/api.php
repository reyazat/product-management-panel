<?php

use App\Http\Controllers\api\v1\AuthController;
use App\Http\Controllers\api\v1\ProductController;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {

    Route::controller(AuthController::class)->middleware(['guest'])->group(function () {
        Route::post('/first', 'first');
        Route::post('/verify', 'doVerify');
        Route::get('/verify', 'getVerify');
        Route::post('/register', 'register');
        Route::post('/login', 'login');

        Route::get('/logout', 'logout')->middleware('auth:api');
    });
    Route::controller(ProductController::class)->middleware(['auth:api'])->group(function () {
        Route::get('/products', 'index');
    });
});
