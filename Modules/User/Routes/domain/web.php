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

Route::middleware(['auth:sanctum'])->group(__DIR__ . '/web/auth.php');

Route::name('user.')->group(function () {

    Route::get('/login', [LoginController::class, 'index'])->name('login');
});
