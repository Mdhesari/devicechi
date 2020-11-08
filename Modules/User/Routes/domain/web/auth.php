<?php

/*
|--------------------------------------------------------------------------
| User Web Auth Routes [auth:sanctum]
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Modules\User\Http\Controllers\Ad\AdCreateController;
use Modules\User\Http\Controllers\Ad\AdStepController;

Route::get('/dashboard', 'UserController@index')->name('dashboard');

Route::name('ad.')->group(function () {

    Route::get('/ads/sell', [AdCreateController::class, 'show'])->name('create');

    Route::get('/ads/sell/{phone_brand}', [AdStepController::class, 'chooseModel']);
});
