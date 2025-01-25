<?php

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
Route::get('/master-data', App\Livewire\Pages\MasterData\Index::class)->name('master-data');
Route::get('/category', App\Livewire\Pages\Category\Index::class)->name('category.list');
Route::group(['prefix' => 'item'], function () {
    Route::get('/', \App\Livewire\Pages\Item\Index::class)->name('item.list');
    Route::get('/create', \App\Livewire\Pages\Item\Create\Index::class)->name('item.create');
});

