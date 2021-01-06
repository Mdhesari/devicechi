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

use Composer\Package\RootPackage;
use Modules\User\Http\Controllers\Ad\AdAccessoryController;
use Modules\User\Http\Controllers\Ad\AdAgeController;
use Modules\User\Http\Controllers\Ad\AdContactController;
use Modules\User\Http\Controllers\Ad\AdCreateController;
use Modules\User\Http\Controllers\Ad\AdDemoController;
use Modules\User\Http\Controllers\Ad\AdDetailsController;
use Modules\User\Http\Controllers\Ad\AdHomeController;
use Modules\User\Http\Controllers\Ad\AdLocationController;
use Modules\User\Http\Controllers\Ad\AdMainController;
use Modules\User\Http\Controllers\Ad\AdModelController;
use Modules\User\Http\Controllers\Ad\AdPictureController;
use Modules\User\Http\Controllers\Ad\AdPriceController;
use Modules\User\Http\Controllers\Ad\AdVariantController;
use Modules\User\Http\Controllers\Ad\BaseAdController;
use Modules\User\Http\Controllers\Auth\SessionController;
use Modules\User\Http\Controllers\UserController;

Route::post('/session/logout', [SessionController::class, 'destroy'])->name('session.logout');

Route::prefix('/ads')->name('ad.')->group(function () {

    Route::prefix('/sell/mobile')->group(function () {

        Route::get('/{ad?}', [AdCreateController::class, 'show'])->name('create');

        Route::get('/routes/steps/{step}', [BaseAdController::class, 'getStepRoute'])->name('routes');

        Route::prefix('/process')->name('step_phone_')->group(function () {

            Route::prefix('{ad}')->group(function () {

                Route::get('/accessories', [AdAccessoryController::class, 'choose'])->name('accessories');

                Route::post('/accessories', [AdAccessoryController::class, 'store']);

                Route::get('/age', [AdAgeController::class, 'choose'])->name('age');

                Route::post('/age', [AdAgeController::class, 'store']);

                Route::get('/price', [AdPriceController::class, 'choose'])->name('price');

                Route::middleware('english_numbers')->post('/price', [AdPriceController::class, 'store']);

                Route::get('/pictures', [AdPictureController::class, 'choose'])->name('pictures');

                Route::post('/pictures', [AdPictureController::class, 'store']);

                Route::delete('/pictures', [AdPictureController::class, 'delete']);

                Route::get('/location', [AdLocationController::class, 'choose'])->name('location');

                Route::post('/location', [AdLocationController::class, 'store']);

                Route::get('/location/states/{city}', [AdLocationController::class, 'getState'])->name('location.states');

                Route::get('/contact', [AdContactController::class, 'choose'])->name('contact');

                Route::post('/contact', [AdContactController::class, 'store']);

                Route::middleware('english_numbers')->post('/contact/add', [AdContactController::class, 'add'])->name('contact.add');

                Route::delete('/contact/remove', [AdContactController::class, 'remove'])->name('contact.delete');

                Route::middleware('english_numbers')->put('/contact/verify', [AdContactController::class, 'verify'])->name('contact.verify');

                Route::get('/details', [AdDetailsController::class, 'choose'])->name('details');

                Route::post('/details', [AdDetailsController::class, 'store']);

                Route::get('/demo', [AdDemoController::class, 'show'])->name('demo');

                Route::get('/{phone_model}/variants', [AdVariantController::class, 'choose'])->name('model_variant');

                Route::post('/{phone_model}/variants', [AdVariantController::class, 'store']);
            });

            Route::put('/demo/publish', [AdDemoController::class, 'publish'])->name('demo.publish');

            Route::put('/demo/delete', [AdDemoController::class, 'delete'])->name('demo.delete');

            Route::put('/demo/archive', [AdDemoController::class, 'archive'])->name('demo.archive');

            Route::get('/{phone_brand}/{ad?}', [AdModelController::class, 'choose'])->name('model');

            Route::post('/{phone_brand}/{ad?}', [AdModelController::class, 'store']);
        });
    });

    Route::get('/', [AdHomeController::class, 'index'])->name('home');

    Route::get('/get/brands', [AdMainController::class, 'getBrands'])->name('get.brands');

    Route::get('/get/models', [AdMainController::class, 'getModels'])->name('get.models');

    Route::get('/get/status/{status}', [AdMainController::class, 'getStatus'])->name('get.status');

    Route::get('/{ad}', [AdHomeController::class, 'show'])->name('show');

    Route::get('/p/{ad}', [AdHomeController::class, 'show'])->name('show.short-link');
});

Route::prefix('/dashboard')->group(function () {

    Route::get('/', 'UserController@index')->name('dashboard');

    Route::get('/ads', [AdMainController::class, 'get'])->name('ad.get');
});

Route::prefix('/profile')->name('profile.')->group(function () {

    Route::middleware('english_numbers')->put('/update', [UserController::class, 'update'])->name('update');
});
