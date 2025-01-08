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
Route::get('/laporan-kasir/global', [\App\Http\Controllers\LaporanController::class, 'cassierCetakLaporanGlobal']);
Route::get('/laporan-kasir/detail', [\App\Http\Controllers\LaporanController::class, 'cassierCetakLaporanDetail']);
Route::get('/laporan-kasir/detailglobal', [\App\Http\Controllers\LaporanController::class, 'cassierCetakLaporanGlobalDetail']);

Route::get('/laporan-sales/global', [\App\Http\Controllers\LaporanController::class, 'salesCetakLaporanGlobal']);
Route::get('/laporan-sales/detail', [\App\Http\Controllers\LaporanController::class, 'salesCetakLaporanDetail']);
Route::get('/laporan-sales/detailglobal', [\App\Http\Controllers\LaporanController::class, 'salesCetakLaporanGlobalDetail']);
Route::get('/laporan-sales/attendance', [\App\Http\Controllers\LaporanController::class, 'salesAttendace']);


Route::get('/storage/attendances/{filename}', function ($filename) {
    $path = storage_path('app/public/attendances/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path);
})->where('filename', '.*');
