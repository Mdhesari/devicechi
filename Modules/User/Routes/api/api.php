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

use Tightenco\Ziggy\Ziggy;
Route::get('/routes', function (Request $request) {

    return response()->json(new Ziggy);
})->name('ziggy');
