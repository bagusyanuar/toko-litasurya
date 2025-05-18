<?php

use App\Http\Controllers\Mobile\AttendanceController;
use App\Http\Controllers\Mobile\CartController;
use App\Http\Controllers\Mobile\CategoryController;
use App\Http\Controllers\Mobile\CustomerController;
use App\Http\Controllers\Mobile\DailyTargetController;
use App\Http\Controllers\Mobile\ItemController;
use App\Http\Controllers\Mobile\TransactionController;
use App\Http\Controllers\Mobile\AuthController;
use Illuminate\Support\Facades\Route;

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

        Route::get('/categories', [CategoryController::class, 'index']);

        Route::get('/profile', [AuthController::class, 'getUserData']);

        Route::group(['prefix' => 'carts'], function () {
            Route::post('/', [CartController::class, 'store']);
            Route::get('/{transaction_id}', [CartController::class, 'getCart']);
            Route::post('/upload', [TransactionController::class, 'uploadCart']);
        });



        Route::group(['prefix' => 'transactions'], function () {
            Route::get('/', [TransactionController::class, 'index']);
            Route::get('/{id}', [TransactionController::class, 'show']);
            Route::post('/{id}/complete', [TransactionController::class, 'markAsComplete']);
            Route::get('/total/today/{user_id}', [TransactionController::class, 'getTotalTransactionsToday']);
        });


        Route::get('/target-today', [DailyTargetController::class, 'getTodayTarget']);

        Route::prefix('items')->group(function () {
            Route::get('/', [ItemController::class, 'index']); // Semua item dengan filter/pagination
            Route::get('/category/{categoryId}', [ItemController::class, 'indexByCategory']); // Item berdasarkan kategori
            Route::get('/{id}', [ItemController::class, 'show']); // Detail item
        });

        //CUSTOMERS
        Route::get('/customers/toko', [CustomerController::class, 'getTokoCustomers']);
        Route::get('/customers/detail/{id}', [CustomerController::class, 'getTokoCustomerById']);

        Route::get('/attendance/weekly-schedule', [AttendanceController::class, 'getWeeklySchedule']);
        Route::get('/attendance/today-schedule', [AttendanceController::class, 'getTodaySchedule']);
        Route::post('/attendance/store', [AttendanceController::class, 'store']);
    });
});
