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

use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Row;
use Modules\Admin\Entities\Admin;

use \Modules\Admin\Http\Controllers\AuthController;

use Modules\Admin\Http\Controllers\HomeController;

use Modules\Admin\Http\Controllers\ActivityLogController;
use Modules\Admin\Http\Controllers\AdminController;
use Modules\Admin\Http\Controllers\CategoryController;
use Modules\Admin\Http\Controllers\Media\AdminMediaController;
use Modules\Admin\Http\Controllers\Payment\PaymentController;
use Modules\Admin\Http\Controllers\RegisterController;
use Modules\Admin\Http\Controllers\RolePermissionController;
use Modules\Admin\Http\Controllers\UserController;

Route::middleware('auth.admin')->group(function () {

    // root endpoint
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    Route::post('logout', [AuthController::class, 'logout'])->name('admin.logout');

    Route::get('profile', [AdminController::class, 'index'])->name('admin.profile');
    Route::put('profile', [AdminController::class, 'update']);

    Route::prefix('/activity-log')->middleware('can:activity-log-management')->name('admin.activity.')->group(function () {

        Route::get('/', [ActivityLogController::class, 'index'])->name('report');
    });

    Route::prefix('role-permissions')->middleware('can:access-management')->name('admin.role-permission.')->group(function () {

        Route::post('/role/create', [RolePermissionController::class, 'store'])->name('create-role');

        Route::get('/{role?}', [RolePermissionController::class, 'index'])->name('index');

        Route::put('/{role}', [RolePermissionController::class, 'update']);
    });

    Route::prefix('users')->name('admin.users.')->group(function () {

        Route::middleware('can:update user')->group(function () {
            Route::get('/', [UserController::class, 'list'])->name('list');

            Route::get('/show/{user}', [UserController::class, 'show'])->name('show');
        });

        Route::middleware('can:create user')->group(function () {
            Route::get('/add', [UserController::class, 'create'])->name('add');

            Route::post('/add', [UserController::class, 'store']);
        });

        Route::middleware('can:read user')->group(function () {

            Route::get('/edit/{user}', [UserController::class, 'edit'])->name('edit');

            Route::post('/edit/{user}', [UserController::class, 'update']);
        });

        Route::middleware('can:delete user')->group(function () {

            Route::get('/delete/{user}', [UserController::class, 'approveDestroy'])->name('destroy');

            Route::delete('/delete/{user}', [UserController::class, 'destroy']);

            Route::delete('/force-delete/{user}', [UserController::class, 'forceDestroy'])->name('force-destroy');

            Route::put('/restore/{user}', [UserController::class, 'restore'])->name('restore');
        });
    });

    Route::prefix('admins')->middleware('can:read admin')->name('admin.admins.')->group(function () {

        Route::get('/', [AdminController::class, 'list'])->name('list');

        Route::middleware('can:create admin')->group(function () {

            Route::get('/add', [AdminController::class, 'create'])->name('add');

            Route::post('/add', [AdminController::class, 'store']);
        });

        Route::post('/{admin}', [AdminController::class, 'show'])->name('show');

        Route::middleware('can:update admin')->group(function () {

            Route::get('/edit/{admin}', [AdminController::class, 'edit'])->name('edit');

            Route::post('/edit/{admin}', [AdminController::class, 'update'])->name('update');
        });

        Route::middleware('can:delete admin')->group(function () {

            Route::get('/delete/{admin}', [AdminController::class, 'approveDestroy'])->name('destroy');

            Route::delete('/delete/{admin}', [AdminController::class, 'destroy']);

            Route::delete('/force-delete/{admin}', [AdminController::class, 'forceDestroy'])->name('force-destroy');

            Route::put('/restore/{admin}', [AdminController::class, 'restore'])->name('restore');
        });
    });


    Route::prefix('payments')->name('admin.payments.')->group(function () {

        Route::get('/', [PaymentController::class, 'index'])->name('list');

        Route::get('/show/{payment}', [PaymentController::class, 'show'])->name('show');

        Route::get('/add', [PaymentController::class, 'create'])->name('add');

        Route::post('/add', [PaymentController::class, 'store']);

        Route::get('/update', [PaymentController::class, 'update'])->name('update');

        Route::get('/delete', [PaymentController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('category')->name('admin.category.')->group(function () {

        Route::get('/', [CategoryController::class, 'list'])->name('list');

        Route::get('/add', [CategoryController::class, 'create'])->name('add');

        Route::post('/add', [CategoryController::class, 'store']);

        Route::get('/{category}', [CategoryController::class, 'edit'])->name('edit');

        Route::post('/{category}', [CategoryController::class, 'update']);

        Route::get('delete/{category}', [CategoryController::class, 'delete'])->name('delete');

        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');
    });
});

Route::middleware('guest.admin')->group(function () {

    Route::get('login', [AuthController::class, 'loginForm'])->name('admin.login');
    Route::post('login', [AuthController::class, 'login']);

    Route::get('register', [RegisterController::class, 'show'])->name('admin.register');
});
