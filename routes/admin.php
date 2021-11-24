<?php

use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'admin.'], function () {
    Route::get('dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::get('cal/psale',[Admin\UserController::class,'loyalityPoints']);
    Route::resource('user', Admin\UserController::class);
    Route::resource('merchant', Admin\MerchantController::class);
    Route::resource('marketing', Admin\MarketingController::class);
    Route::resource('order', Admin\OrderController::class);
    Route::resource('promotional_request', Admin\PromotionalRequestController::class);
    Route::resource('royality_point', Admin\RoyalityPointController::class);
    Route::get('statement', [Admin\StatementController::class, 'index'])->name('statement.index');
    Route::resource('custom_push', Admin\CustomPushController::class);
    Route::resource('tier', Admin\TierController::class);
    Route::resource('category', Admin\CategoryController::class);
    Route::resource('item', Admin\ItemController::class);
    Route::resource('document', Admin\DocumentController::class);
    Route::resource('membership', Admin\MemberShipController::class);
    Route::post('statement', [Admin\StatementController::class, 'store'])->name('statement.store');
    Route::get('document/merchant', [Admin\DocumentController::class, 'merchant_index'])->name('document.merchant_index');
    Route::post('serach/user',[Admin\UserController::class,'searchUser'])->name('search.user');
    Route::get('get/user',[Admin\CustomPushController::class,'fetchUser'])->name('fetch.name');

});
