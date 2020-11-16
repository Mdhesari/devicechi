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
use Modules\User\Http\Controllers\Ad\AdAgeController;
use Modules\User\Http\Controllers\Ad\AdCreateController;
use Modules\User\Http\Controllers\Ad\AdModelController;
use Modules\User\Http\Controllers\Ad\AdPictureController;
use Modules\User\Http\Controllers\Ad\AdPriceController;
use Modules\User\Http\Controllers\Ad\AdVariantController;

Route::get('/dashboard', 'UserController@index')->name('dashboard');

Route::prefix('/ads/sell/mobile')->name('ad.')->group(function () {

    Route::get('/', [AdCreateController::class, 'show'])->name('create');

    Route::name('step_phone_')->group(function () {

        Route::get('/accessories', [AdAccessoryController::class, 'choose'])->name('accessories');

        Route::post('/accessories', [AdAccessoryController::class, 'store']);

        Route::get('/age', [AdAgeController::class, 'choose'])->name('age');

        Route::post('/age', [AdAgeController::class, 'store']);

        Route::get('/price', [AdPriceController::class, 'choose'])->name('price');

        Route::post('/price', [AdPriceController::class, 'store']);

        Route::get('/pictures', [AdPictureController::class, 'choose'])->name('pictures');

        Route::post('/pictures', [AdPictureController::class, 'store']);

        Route::delete('/pictures', [AdPictureController::class, 'delete'])->name('delete_picture');

        Route::get('/{phone_model}/variants', [AdVariantController::class, 'choose'])->name('model_variant');

        Route::post('/{phone_model}/variants', [AdVariantController::class, 'store']);

        Route::get('/{phone_brand}', [AdModelController::class, 'choose'])->name('model');

        Route::post('/{phone_brand}', [AdModelController::class, 'store']);
    });
});
