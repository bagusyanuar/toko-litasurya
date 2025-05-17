<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//cek docker lagi
Route::post('/test-purchase', [\App\Http\Controllers\TestController::class, 'addPurchase']);

Route::group(['prefix' => '/v1'], function () {
    Route::post('/auth/login', [\App\Http\Controllers\Mobile\AuthController::class, 'login']);

    Route::group(['middleware' => [\App\Http\Middleware\JWTMiddleware::class]], function () {
        Route::group(['prefix' => 'product'], function () {
            Route::get('/', [\App\Http\Controllers\Mobile\ProductController::class, 'findAll']);
            Route::get('/{id}', [\App\Http\Controllers\Mobile\ProductController::class, 'findByID']);
        });

        Route::group(['prefix' => 'purchase'], function () {
            Route::get('/', [\App\Http\Controllers\Mobile\PurchaseController::class, 'findAll']);
            Route::post('/', [\App\Http\Controllers\Mobile\PurchaseController::class, 'create']);
            Route::get('/{id}', [\App\Http\Controllers\Mobile\PurchaseController::class, 'findByID']);
        });

        Route::group(['prefix' => 'return'], function () {
            Route::post('/', [\App\Http\Controllers\Mobile\TransactionReturnController::class, 'create']);
        });

    });
});
