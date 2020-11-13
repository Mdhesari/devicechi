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

use Modules\User\Http\Controllers\Ad\AdAccessoryController;
use Modules\User\Http\Controllers\Ad\AdCreateController;
use Modules\User\Http\Controllers\Ad\AdModelController;
use Modules\User\Http\Controllers\Ad\AdVariantController;

Route::get('/dashboard', 'UserController@index')->name('dashboard');

Route::prefix('/ads/sell/mobile')->name('ad.')->group(function () {

    Route::get('', [AdCreateController::class, 'show'])->name('create');

    Route::get('/accessories', [AdAccessoryController::class, 'choose'])->name('step_phone_accessories');

    Route::post('/accessories', [AdAccessoryController::class, 'store']);

    Route::get('/{phone_model}/variants', [AdVariantController::class, 'choose'])->name('step_phone_model_variant');

    Route::post('/{phone_model}/variants', [AdVariantController::class, 'store']);

    Route::get('/{phone_brand}', [AdModelController::class, 'choose'])->name('step_phone_model');

    Route::post('/{phone_brand}', [AdModelController::class, 'store']);
});
