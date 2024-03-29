<?php

/*
|--------------------------------------------------------------------------
| User API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use Modules\User\Http\Controllers\Ad\AdContactController;
use Modules\User\Http\Controllers\Ad\AdMainController;
use Modules\User\Http\Controllers\CityController;
use Tightenco\Ziggy\Ziggy;

Route::get('/routes', function (Request $request) {

    return response()->json(new Ziggy);
})->name('ziggy');

Route::get('/get/contacts/{ad}', [AdContactController::class, 'get'])->name('ad.contacts.get');

Route::get('/cities/get', [CityController::class, 'index'])->name('cities.get');

Route::put('/alerts/disable/ad-help', [AdMainController::class, 'disableHelpAlert'])->name('alerts.disable.ad-help');
