<?php

use App\Http\Controllers\API\AttendanceController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ItemController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\Api\DailyTargetController;
use App\Http\Controllers\API\TransactionController;
use App\Http\Middleware\JwtMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware([JwtMiddleware::class])->group(function () {
    Route::get('/categories', [CategoryController::class, 'index']);

    Route::middleware('auth:api')->get('/profile', [AuthController::class, 'getUserData'])->middleware('auth:api');

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

    Route::get('/attendance/weekly-schedule', [AttendanceController::class, 'getWeeklySchedule']);
    Route::get('/attendance/today-schedule', [AttendanceController::class, 'getTodaySchedule']);
    Route::post('/attendance/store', [AttendanceController::class, 'store']);
});





Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login'])->withoutMiddleware(JwtMiddleware::class);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth.jwt');
    Route::get('me', [AuthController::class, 'me'])->middleware('auth.jwt');
    Route::post('refresh', [AuthController::class, 'refresh'])->middleware('auth.jwt');
});
