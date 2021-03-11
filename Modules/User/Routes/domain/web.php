<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Modules\User\Http\Controllers\Ad\AdHomeController;
use Modules\User\Http\Controllers\Auth\LoginController;
use Modules\User\Http\Controllers\Auth\SessionController;
use Modules\User\Http\Controllers\Home\HomeController;
use Modules\User\Http\Controllers\UserContactUsController;

Route::get('/', [HomeController::class, 'index'])->name('user.home');

Route::get('/contact-us', [UserContactUsController::class, 'index'])->name('contact-us');

Route::post('/contact-us', [UserContactUsController::class, 'store']);

Route::get('/rules', [HomeController::class, 'rules'])->name('rules');

Route::middleware('auth.user:sanctum')->name('user.')->group(__DIR__ . '/auth.php');

Route::middleware('guest:sanctum')->name('user.')->group(function () {
    Route::get('/auth', [LoginController::class, 'index'])->name('login');

    Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');

    Route::middleware('english_numbers')->post('/auth', [SessionController::class, 'store'])->name('auth');

    Route::post('/auth/validate', [SessionController::class, 'verify'])->name('verify');
});

Route::prefix('/ads')->name('user.ad.')->group(function () {
    // Route::get('/s', [AdHomeController::class, 'all'])->name('all');

    Route::post('/s', [AdHomeController::class, 'search']);

    Route::get('/s/{city?}', [AdHomeController::class, 'index'])->name('home');

    Route::get('/get/brands', [AdMainController::class, 'getBrands'])->name('get.brands');

    Route::get('/get/models', [AdMainController::class, 'getModels'])->name('get.models');

    Route::get('/get/status/{status}', [AdMainController::class, 'getStatus'])->name('get.status');

    Route::get('/{ad}', [AdHomeController::class, 'show'])->name('show');

    Route::get('/p/{ad}', [AdHomeController::class, 'show'])->name('show.short-link');
});
