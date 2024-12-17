<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ItemController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/categories', [CategoryController::class, 'index']);


// CART AND TRANSACTIONS
Route::post('/carts', [CartController::class, 'store']);
Route::get('/carts/{transaction_id}', [CartController::class, 'getCart']);
Route::post('/cart/upload', [TransactionController::class, 'uploadCart']);
Route::get('/transactions', [TransactionController::class, 'index']);
Route::get('/transaction/{id}', [TransactionController::class, 'show']);

Route::prefix('items')->group(function () {
    Route::get('/', [ItemController::class, 'index']); // Semua item dengan filter/pagination
    Route::get('/category/{categoryId}', [ItemController::class, 'indexByCategory']); // Item berdasarkan kategori
    Route::get('/{id}', [ItemController::class, 'show']); // Detail item
});

//CUSTOMERS
Route::get('/customers/toko', [CustomerController::class, 'getTokoCustomers']);
