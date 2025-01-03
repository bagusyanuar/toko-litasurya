<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', App\Livewire\Pages\Auth\Login::class)->name('login');
Route::get('/dashboard', App\Livewire\Pages\Dashboard\Index::class)->name('dashboard');
Route::get('/category', App\Livewire\Pages\Category\Index::class)->name('category.list');
Route::group(['prefix' => 'item'], function () {
    Route::get('/', \App\Livewire\Pages\Item\Index::class)->name('item.list');
    Route::get('/create', \App\Livewire\Pages\Item\Create\Index::class)->name('item.create');
});


// LAPORAN PDF
Route::get('/laporan-kasir/global', [\App\Http\Controllers\LaporanController::class, 'cetakLaporanGlobal']);
Route::get('/laporan-kasir/detail', [\App\Http\Controllers\LaporanController::class, 'cetakLaporanDetail']);
Route::get('/laporan-kasir/detailglobal', [\App\Http\Controllers\LaporanController::class, 'cetakLaporanGlobalDetail']);
