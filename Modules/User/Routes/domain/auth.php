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

use Modules\User\Http\Controllers\Ad\AdMainController;
use Modules\User\Http\Controllers\Ad\AdModelController;
use Modules\User\Http\Controllers\Ad\AdPictureController;
use Modules\User\Http\Controllers\Ad\AdPriceController;
use Modules\User\Http\Controllers\Ad\AdVariantController;
use Modules\User\Http\Controllers\Ad\BaseAdController;
use Modules\User\Http\Controllers\Auth\SessionController;
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

Route::prefix('/profile')->name('profile.')->group(function () {

    Route::middleware('english_numbers')->put('/update', [UserController::class, 'update'])->name('update');
});
