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
use Modules\User\Http\Controllers\Ad\AdVariantController;

Route::get('/dashboard', 'UserController@index')->name('dashboard');

Route::name('ad.')->group(function () {

    Route::get('/ads/sell', [AdCreateController::class, 'show'])->name('create');

    Route::get('/ads/sell/{phone_brand}/{phone_model}', [AdStepController::class, 'chooseVariant'])->name('step_phone_model_variant');

    Route::get('/ads/sell/{phone_brand}', [AdStepController::class, 'chooseModel'])->name('step_phone_model');

    Route::post('/ads/sell/store/variant', [AdVariantController::class, 'store'])->name('step_store_variant');
});
