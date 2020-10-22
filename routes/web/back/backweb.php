<?php

/*
|--------------------------------------------------------------------------
| Web Authenticated Snactum Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Back\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');