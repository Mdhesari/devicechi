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

use App\Models\Role;
use Modules\User\Http\Controllers\Ad\AdAccessoryController;
use Modules\User\Http\Controllers\Ad\AdAgeController;
use Modules\User\Http\Controllers\Ad\AdContactController;
use Modules\User\Http\Controllers\Ad\AdCreateController;
use Modules\User\Http\Controllers\Ad\AdDemoController;
use Modules\User\Http\Controllers\Ad\AdDetailsController;
use Modules\User\Http\Controllers\Ad\AdLocationController;
use Modules\User\Http\Controllers\Ad\AdMainController;
use Modules\User\Http\Controllers\Ad\AdModelController;
use Modules\User\Http\Controllers\Ad\AdPictureController;
use Modules\User\Http\Controllers\Ad\AdPriceController;
use Modules\User\Http\Controllers\Ad\AdVariantController;
use Modules\User\Http\Controllers\Ad\BaseAdController;
use Modules\User\Http\Controllers\AdPromoteController;
use Modules\User\Http\Controllers\Auth\SessionController;
use Modules\User\Http\Controllers\BlogController;
use Modules\User\Http\Controllers\UserContactUsController;
use Modules\User\Http\Controllers\UserController;
use Modules\User\Http\Controllers\UserPaymentController;

Route::post('/session/logout', [SessionController::class, 'destroy'])->name('session.logout');

Route::prefix('/dashboard')->group(function () {

    Route::get('/', [UserController::class, 'index'])->name('dashboard');

    Route::get('/ads', [AdMainController::class, 'get'])->name('ad.get');

    Route::get('/bookmarked-ads', [UserController::class, 'bookmarks'])->name('ad.bookmarked');

    Route::post('/bookmark-ad', [AdMainController::class, 'bookmark'])->name('ad.bookmark');

    Route::get('/visited-ads', [UserController::class, 'seens'])->name('ad.seen');

    Route::prefix('/payments')->name('payments.')->group(function () {

        Route::get('/', [UserPaymentController::class, 'index'])->name('list');
    });
});

Route::prefix('/ads')->name('ad.')->group(function () {

    Route::prefix('/sell/mobile')->group(function () {

        Route::get('/{ad?}', [AdCreateController::class, 'show'])->name('create');

        Route::get('/routes/steps/{step}', [BaseAdController::class, 'getStepRoute'])->name('routes');

        Route::prefix('/process')->name('step_phone_')->group(function () {

            Route::prefix('{ad}')->group(function () {

                Route::prefix('/payment')->name('payment.')->group(function () {

                    Route::put('/gateway', [UserPaymentController::class, 'gateway'])->name('gateway');

                    Route::get('/verify', [UserPaymentController::class, 'verify'])->name('verify');

                    Route::get('/successPurchase/{refID}', [UserPaymentController::class, 'successPurchase'])->name('successPurchase');

                    Route::get('/failedPurchase', [UserPaymentController::class, 'failedPurchase'])->name('failedPurchase');
                });

                Route::get('/accessories', [AdAccessoryController::class, 'choose'])->name('accessories');

                Route::post('/accessories', [AdAccessoryController::class, 'store']);

                Route::get('/age', [AdAgeController::class, 'choose'])->name('age');

                Route::post('/age', [AdAgeController::class, 'store']);

                Route::get('/price', [AdPriceController::class, 'choose'])->name('price');

                Route::middleware('english_numbers')->post('/price', [AdPriceController::class, 'store']);

                Route::get('/pictures', [AdPictureController::class, 'choose'])->name('pictures');

                Route::post('/pictures', [AdPictureController::class, 'store']);

                Route::post('/pictures-upload', [AdPictureController::class, 'storeUploads'])->name('pictures_upload');

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

                Route::get('/ad-promote', [AdPromoteController::class, 'index'])->name('promote');

                Route::post('/ad-promote/finalPrice', [AdPromoteController::class, 'getFinalPrice'])->name('promote.finalPrice');

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
});

Route::prefix('/profile')->name('profile.')->group(function () {

    Route::middleware('english_numbers')->put('/update', [UserController::class, 'update'])->name('update');
});
