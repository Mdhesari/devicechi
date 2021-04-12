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

use App\Http\Controllers\ShortLinkController;
use App\Http\Controllers\ViewPageController;

Route::get('p/{code}', [ShortLinkController::class, 'show'])->name('shortlink');

Route::fallback([ViewPageController::class, 'show']);
