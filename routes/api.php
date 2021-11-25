<?php
use App\Http\Controllers\Api;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['as' => 'api.'], function () {
    Route::post('register', [Api\AuthController::class, 'register']);
    Route::post('login', [Api\AuthController::class, 'login']);
    Route::post('login/pin_verification', [Api\AuthController::class, 'pinVerification']);
    Route::get('category', [Api\CategoryController::class, 'index']);
    Route::get('item', [Api\ItemController::class, 'index']);
    Route::put('profile/{user}', [Api\ProfileController::class, 'update']);
    Route::get('user/{user}', [Api\UserController::class, 'index']);
    /*Updated Work*/

    Route::post('promotional_order', [Api\UpdatedController::class, 'AddPromotionalOrder']);
    Route::post('loginapi', [Api\UpdatedController::class, 'loginapi']);
    Route::post('pin-verification', [Api\UpdatedController::class, 'pinVerification']);
    Route::post('update-profile', [Api\UpdatedController::class, 'updateProfile']);
    Route::get('get-user', [Api\UpdatedController::class, 'getUser']);
    Route::get('get-earned-point-history', [Api\UpdatedController::class, 'getEarnedPointsHistory']);
    Route::get('get-benifits', [Api\UpdatedController::class, 'getBenifits']);
    Route::get('get-promotional-products', [Api\UpdatedController::class, 'getPromotionalProducts']);
    Route::post('add-to-favorite', [Api\UpdatedController::class, 'addtoFavorite']);
    Route::post('remove-from-favorite', [Api\UpdatedController::class, 'removefromFavorite']);
    Route::get('merchants', [Api\UpdatedController::class, 'getMerchants']);
    Route::get('dashboard', [Api\UpdatedController::class, 'getDashboard']);
    Route::get('get-products', [Api\UpdatedController::class, 'getProducts']);
    Route::post('add-to-products', [Api\UpdatedController::class, 'addtoCart']);
    Route::post('update-cart', [Api\UpdatedController::class, 'updateCart']);
    Route::get('get-card', [Api\UpdatedController::class, 'getCart']);
    Route::get('get-redeem-history', [Api\UpdatedController::class, 'getRedeemHistory']);
    Route::post('track-my-order', [Api\UpdatedController::class, 'trackMyorder']);
    /*Checkout*/
    Route::post('checkout', [Api\UpdatedController::class, 'checkout']);
    /*Membership*/
    Route::get('memberships', [Api\MembershipController::class, 'index']);
    /*Promotions*/
    Route::get('promotions', [Api\PromotionalController::class, 'index']);
    Route::post('promotions/update', [Api\PromotionalController::class, 'updateStatus']);
    Route::get('promotions_items', [Api\PromotionalController::class, 'promotionalItems']);
    /*Notifications*/
    Route::get('notifications', [Api\UpdatedController::class, 'notifications']);
    /*Orders Related History*/
    Route::get('earned_points', [Api\UpdatedController::class, 'earnedPoints']);
    Route::get('orders', [Api\UpdatedController::class, 'buyProductsHistory']);
});


