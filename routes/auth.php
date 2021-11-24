<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| AuthController Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(
    [
        'prefix'    => 'admin',
        'as'        => 'admin.',
        'namespace' => 'App\Http\Controllers\Admin'
    ],
    function () {
        Auth::routes([
            'register' => false,
            'reset'    => false,
            'confirm'  => false,
            'verify'   => false
        ]);
    });

Route::group(
    [
        'prefix'    => 'merchant',
        'as'        => 'merchant.',
        'namespace' => 'App\Http\Controllers\Merchant'
    ],
    function () {
        Auth::routes([
            'register' => false,
            'reset'    => false,
            'confirm'  => false,
            'verify'   => false
        ]);
    });

Route::group(
    [
        'prefix'    => 'marketing',
        'as'        => 'marketing.',
        'namespace' => 'App\Http\Controllers\Marketing'
    ],
    function () {
        Auth::routes([
            'register' => false,
            'reset'    => false,
            'confirm'  => false,
            'verify'   => false
        ]);
    });
