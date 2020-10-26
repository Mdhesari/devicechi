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

use Modules\User\Http\Controllers\Auth\LoginController;
use Modules\User\Http\Controllers\Auth\RegisterController;
use Modules\User\Http\Controllers\Home\HomeController;
use Modules\User\Http\Controllers\UserController;

Route::middleware(['auth:sanctum'])->group(__DIR__ . '/web/auth.php');

Route::middleware('guest')->name('user.')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/login', [LoginController::class, 'index'])->name('login');

    Route::post('/auth', [RegisterController::class, 'store'])->name('auth');
});
