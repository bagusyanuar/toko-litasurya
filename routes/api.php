<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/test-purchase', [\App\Http\Controllers\TestController::class, 'addPurchase']);
