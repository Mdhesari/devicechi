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

use Modules\User\Http\Controllers\Ad\AdCreateController;
use Modules\User\Http\Controllers\Auth\LoginController;
use Modules\User\Http\Controllers\Auth\SessionController;
use Modules\User\Http\Controllers\Home\HomeController;
use Modules\User\Http\Controllers\UserController;

Route::middleware('auth.user:sanctum')->name('user.')->group(__DIR__ . '/auth.php');

Route::middleware('guest:sanctum')->name('user.')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/login', [LoginController::class, 'index'])->name('login');

    Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');

    Route::middleware('english_numbers')->post('/auth', [SessionController::class, 'store'])->name('auth');

    Route::post('/auth/validate', [SessionController::class, 'verify'])->name('verify');
});
