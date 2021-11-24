<?php

use App\Http\Controllers\Marketing;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'marketing.'], function () {
    Route::get('dashboard', [Marketing\ItemPromotionController::class, 'index'])->name('dashboard');
    Route::resource('item_promotion', Marketing\ItemPromotionController::class);
    Route::resource('popup_promotion', Marketing\PopupPromotionController::class);
    Route::resource('promotion_category', Marketing\PromotionCategoryController::class);
    Route::resource('promotion_order', Marketing\PromotionalOrderController::class);
});
