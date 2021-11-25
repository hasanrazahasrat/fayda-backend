<?php

use App\Http\Controllers\Merchant;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'merchant.'], function () {
    Route::get('dashboard', [Merchant\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('order', Merchant\OrderController::class);
    Route::resource('item', Merchant\ItemController::class);
    Route::resource('category', Merchant\CategoryController::class);
    Route::resource('document', Merchant\DocumentController::class);

    Route::get('test', [Merchant\DashboardController::class, 'test']);
});
