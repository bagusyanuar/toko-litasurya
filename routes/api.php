<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ItemController;
use App\Http\Controllers\API\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/categories', [CategoryController::class, 'index']);

Route::post('/carts', [CartController::class, 'store']);
Route::get('/carts/{transaction_id}', [CartController::class, 'getCart']);

Route::prefix('items')->group(function () {
    Route::get('/', [ItemController::class, 'index']); // Semua item dengan filter/pagination
    Route::get('/category/{categoryId}', [ItemController::class, 'indexByCategory']); // Item berdasarkan kategori
    Route::get('/{id}', [ItemController::class, 'show']); // Detail item
});
