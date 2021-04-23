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

use App\Models\Ad\AdContact;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Row;
use Modules\Admin\Entities\Admin;

use \Modules\Admin\Http\Controllers\AuthController;

use Modules\Admin\Http\Controllers\HomeController;

use Modules\Admin\Http\Controllers\ActivityLogController;
use Modules\Admin\Http\Controllers\AdController;
use Modules\Admin\Http\Controllers\AdExportController;
use Modules\Admin\Http\Controllers\AdminBrandController;
use Modules\Admin\Http\Controllers\AdminCitiesController;
use Modules\Admin\Http\Controllers\AdminContactUsController;
use Modules\Admin\Http\Controllers\AdminController;
use Modules\Admin\Http\Controllers\AdminModelsController;
use Modules\Admin\Http\Controllers\AdminPromotionController;
use Modules\Admin\Http\Controllers\AdminStatesController;
use Modules\Admin\Http\Controllers\CKEditorController;
use Modules\Admin\Http\Controllers\FileManagerController;
use Modules\Admin\Http\Controllers\Media\AdminMediaController;
use Modules\Admin\Http\Controllers\MenuEditorController;
use Modules\Admin\Http\Controllers\PageController;
use Modules\Admin\Http\Controllers\Payment\PaymentController;
use Modules\Admin\Http\Controllers\RegisterController;
use Modules\Admin\Http\Controllers\RolePermissionController;
use Modules\Admin\Http\Controllers\UserController;

Route::name('admin.')->middleware('auth.admin')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('dashboard');

    Route::prefix('profile')->group(function () {

        Route::post('logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/', [AdminController::class, 'index'])->name('profile');

        Route::put('/', [AdminController::class, 'update']);
    });

    Route::prefix('/activity-log')->middleware('can:activity-log-management')->name('activity.')->group(function () {

        Route::get('/', [ActivityLogController::class, 'index'])->name('report');
    });

    Route::prefix('role-permissions')->middleware('can:access-management')->name('role-permission.')->group(function () {

        Route::post('/role/create', [RolePermissionController::class, 'store'])->name('create-role');

        Route::get('/{role?}', [RolePermissionController::class, 'index'])->name('index');

        Route::put('/{role}', [RolePermissionController::class, 'update']);
    });

    Route::prefix('users')->name('users.')->group(function () {

        Route::get('search', [UserController::class, 'search'])->name('search');

        Route::middleware('can:create user')->group(function () {

            Route::get('/add', [UserController::class, 'create'])->name('add');

            Route::post('/add', [UserController::class, 'store']);

            Route::get('/edit/{user}', [UserController::class, 'edit'])->name('edit');

            Route::post('/edit/{user}', [UserController::class, 'update']);
        });

        Route::middleware('can:read user')->group(function () {

            Route::get('/', [UserController::class, 'list'])->name('list');

            Route::get('/show/{user}', [UserController::class, 'show'])->name('show');
        });

        Route::middleware('can:delete user')->group(function () {

            Route::get('/delete/{user}', [UserController::class, 'approveDestroy'])->name('destroy');

            Route::delete('/delete/{user}', [UserController::class, 'destroy']);

            Route::delete('/force-delete/{user}', [UserController::class, 'forceDestroy'])->name('force-destroy');

            Route::put('/restore/{user}', [UserController::class, 'restore'])->name('restore');
        });
    });

    Route::prefix('admins')->name('admins.')->group(function () {

        Route::middleware('can:create admin')->group(function () {

            Route::get('/add', [AdminController::class, 'create'])->name('add');

            Route::post('/add', [AdminController::class, 'store']);

            Route::get('/edit/{admin}', [AdminController::class, 'edit'])->name('edit');

            Route::post('/edit/{admin}', [AdminController::class, 'update']);
        });

        Route::middleware('can:delete admin')->group(function () {

            Route::get('/delete/{admin}', [AdminController::class, 'approveDestroy'])->name('destroy');

            Route::delete('/delete/{admin}', [AdminController::class, 'destroy']);

            Route::delete('/force-delete/{admin}', [AdminController::class, 'forceDestroy'])->name('force-destroy');

            Route::put('/restore/{user}', [UserController::class, 'restore'])->name('restore');
            Route::put('/restore/{admin}', [AdminController::class, 'restore'])->name('restore');
        });

        Route::middleware('can:read admin')->group(function () {

            Route::get('/', [AdminController::class, 'list'])->name('list');

            Route::get('/show/{admin}', [AdminController::class, 'show'])->name('show');
        });
    });

    Route::prefix('payments')->name('payments.')->group(function () {

        Route::middleware('can:read payment')->group(function () {

            Route::get('/', [PaymentController::class, 'index'])->name('list');

            Route::get('/show/{payment}', [PaymentController::class, 'show'])->name('show');
        });

        Route::middleware('can:create payment')->group(function () {

            Route::get('/add', [PaymentController::class, 'create'])->name('add');

            Route::post('/add', [PaymentController::class, 'store']);

            Route::get('/update', [PaymentController::class, 'update'])->name('update');

            Route::get('/delete', [PaymentController::class, 'destroy'])->name('destroy');
        });
    });

    Route::prefix('promotions')->name('promotions.')->group(function () {
        Route::middleware('can:read promotion')->group(function () {
            Route::get('/', [AdminPromotionController::class, 'index'])->name('index');
        });

        Route::middleware('can:create promotion')->group(function () {
            Route::get('/add', [AdminPromotionController::class, 'create'])->name('create');
        });
    });

    Route::prefix('ads')->name('ads.')->group(function () {

        Route::middleware('can:read ad')->group(function () {

            Route::get('/', [AdController::class, 'index'])->name('list');

            Route::prefix('brands')->name('brands.')->group(function () {
                Route::get('search', [AdminBrandController::class, 'search'])->name('search');
            });

            Route::prefix('models')->name('models.')->group(function () {
                Route::get('search', [AdminModelsController::class, 'search'])->name('search');
            });

            Route::prefix('cities')->name('cities.')->group(function () {
                Route::get('search', [AdminCitiesController::class, 'search'])->name('search');
            });

            Route::prefix('states')->name('states.')->group(function () {
                Route::get('search', [AdminStatesController::class, 'search'])->name('search');
            });

            Route::get('/renew-caption/{ad}', [AdExportController::class, 'renewCaption'])->name('export.renew-caption');

            Route::post('/export/{ad}', [AdExportController::class, 'index'])->name('export');

            Route::get('/show/{ad:id}', [AdController::class, 'show'])->name('show');
        });

        Route::middleware('can:create ad')->group(function () {

            Route::get('/add', [AdController::class, 'create'])->name('add');

            Route::post('/add', [AdController::class, 'store']);

            Route::get('/update', [AdController::class, 'update'])->name('update');

            Route::get('/delete/{ad:id}', [AdController::class, 'approveDestroy'])->name('destroy');

            Route::delete('/force-delete/{ad:id}', [AdController::class, 'forceDestroy'])->name('force-destroy');

            Route::delete('/delete/{ad:id}', [AdController::class, 'destroy']);

            Route::put('/restore/{ad}', [AdController::class, 'restore'])->name('restore');

            Route::put('/update/accept/{ad}', [AdController::class, 'accept'])->name('accept');

            Route::put('/update/ignore/{ad}', [AdController::class, 'ignore'])->name('ignore');
        });
    });

    Route::prefix('file-manager')->middleware('can:read media')->name('media.')->group(function () {

        Route::get('/', [FileManagerController::class, 'index'])->name('home');
    });

    Route::prefix('contact-us')->middleware('can:contact user')->name('contact-us.')->group(function () {

        Route::get('/', [AdminContactUsController::class, 'index'])->name('list');

        Route::get('/show/{contactu}', [AdminContactUsController::class, 'show'])->name('show');

        Route::get('/delete/{contactu}', [AdminContactUsController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('brands')->name('brands.')->group(function () {

        Route::middleware('can:read ad')->group(function () {

            Route::get('/', [AdminBrandController::class, 'index'])->name('list');

            // Route::get('/show/{ad:id}', [AdController::class, 'show'])->name('show');
        });
    });

    Route::prefix('menu-editor')->middleware('can:read menu-editor')->name('menu-editor.')->group(function () {

        Route::get('/', [MenuEditorController::class, 'index'])->name('show');

        Route::get('/groups/add', [MenuEditorController::class, 'create'])->name('store.group');

        Route::post('/groups/add', [MenuEditorController::class, 'store']);

        Route::get('/groups/delete/{menu}', [MenuEditorController::class, 'delete'])->name('delete.group');

        Route::delete('/groups/delete/{menu}', [MenuEditorController::class, 'destroy']);

        Route::post('/groups/{menu}', [MenuEditorController::class, 'storeItems'])->name('store');
    });

    Route::prefix('pages')->middleware('can:read pages')->name('pages.')->group(function () {
        Route::middleware('can:create pages')->group(function () {
            Route::get('/new', [PageController::class, 'create'])->name('create');
            Route::post('/new', [PageController::class, 'store']);

            Route::get('/edit/{page}', [PageController::class, 'edit'])->name('edit');
            Route::post('/edit/{page}', [PageController::class, 'update']);
        });

        Route::middleware('can:delete pages')->group(function () {
            Route::get('/destroy/{page}', [PageController::class, 'delete'])->name('destroy');
            Route::delete('/destroy/{page}', [PageController::class, 'destroy']);
        });

        Route::get('/', [PageController::class, 'index'])->name('list');
    });

    Route::post('/ckeditor/upload', [CKEditorController::class, 'store'])->name('ckeditor.upload');
});

Route::middleware('guest.admin')->group(function () {

    Route::get('login', [AuthController::class, 'loginForm'])->name('admin.login');
    Route::post('login', [AuthController::class, 'login']);

    // Route::get('register', [RegisterController::class, 'show'])->name('admin.register');
});
